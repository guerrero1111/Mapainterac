<?php
/**
 * License Page for all plugins by Gambit Technologies.
 *
 * @version 1.1
 * @package Parallax Backgrounds for VC
 */

if ( ! class_exists( 'GambitAdminLicensePage' ) ) {

	/**
	 * Renders the licensing backend for every plugin.
	 *
	 * @class GambitAdminLicensePage
	 */
	class GambitAdminLicensePage {

		// The URL to our EDD store.
		const STORE_URL = 'http://www.gambit.ph';
		// The URL to a JSON array of all our plugins.
		const PLUGIN_LIST_URL = 'http://www.gambit.ph/wp-admin/admin-ajax.php?action=get_all_plugins';
		// The URL to a notice to display on top of the activation admin page.
		const SALE_NOTICE_URL = 'http://www.gambit.ph/wp-admin/admin-ajax.php?action=get_sale_notice';
		// The URL to verify the purchase code.
		const VERIFY_PURCHASE_CODE_URL = 'http://www.gambit.ph/wp-admin/admin-ajax.php?action=activate_envato_license';

		// Set to true when we are still testing the class.
		const DEBUG = false;

		const LICENSES_ADMIN_SLUG = 'gambit_plugins';
		const PLUGIN_LIST_TRANSIENT = 'gambit_plugin_list_transient';
		const SALE_NOTICE_TRANSIENT = 'gambit_plugin_sale_transient';
		const UPDATE_CHECKER_TRANSIENT = 'gambit_plugin_updater_';

		/**
		 * How many plugins from Gambit are installed?
		 *
		 * @var array $installed_plugins
		 */
		public $installed_plugins = array();

		/**
		 * Everything here will run immediately.
		 */
		function __construct() {

			if ( ! is_multisite() ) {
				add_action( 'admin_menu', array( $this, 'create_licenses_page' ) );
			} else {
				add_action( 'network_admin_menu', array( $this, 'create_licenses_page' ) );
			}

			add_action( 'admin_notices', array( $this, 'display_sale_notice' ) );
			add_action( 'wp_ajax_gambit_plugin_activate', array( $this, 'save_purchase_code' ) );
			add_action( 'admin_init', array( $this, 'check_for_updates' ), 2 );
			add_filter( 'extra_plugin_headers', array( $this, 'add_sku_header' ) );
		}

		/**
		 * Read each product's SKU for parsing.
		 *
		 * @param array $headers - read it and include it into the headers array.
		 */
		public function add_sku_header( $headers ) {
			$headers[] = 'SKU';
			return $headers;
		}


		/**
		 * Displays a sale notice inside the Gambit plugin license page, also caches the sale notice.
		 *
		 * @return void
		 */
		public function display_sale_notice() {
			if ( self::DEBUG ) {
				delete_transient( self::SALE_NOTICE_TRANSIENT );
			}

			// Check whether we are in the Gambit plugin license page.
			$screen = get_current_screen();
			if ( ! preg_match( '/_' . self::LICENSES_ADMIN_SLUG . '$/', $screen->base ) ) {
				return;
			}

			// Check whether we have data cached.
			$notice = false;
			if ( ! is_multisite() ) {
				$notice = get_transient( self::SALE_NOTICE_TRANSIENT );
			} else {
				$notice = get_site_transient( self::SALE_NOTICE_TRANSIENT );
			}
			if ( false === $notice ) {

				// Get the remote sale notice.
				$notice = '';
				$request = wp_remote_get( self::SALE_NOTICE_URL );
				if ( ! empty( $request ) ) {

					if ( ! is_wp_error( $notice ) ) {
						// Check request status.
						if ( ! empty( $request['response']['code'] ) && in_array( $request['response']['code'], array( 200, 304 ) ) ) {
							$response = wp_remote_retrieve_body( $request );
							$notice = $response;
						}
					}

					// Cache to save calls.
					if ( ! is_multisite() ) {
						set_transient( self::SALE_NOTICE_TRANSIENT, $notice, DAY_IN_SECONDS );
					} else {
						set_site_transient( self::SALE_NOTICE_TRANSIENT, $notice, DAY_IN_SECONDS );
					}
				}
			}

			// Display the notice.
			if ( ! empty( $notice ) ) {
				echo "<div class='notice updated' style='border-color: #F7CA18'><p>" . wp_kses( $notice, wp_kses_allowed_html( 'post' ) ) . '</p></div>';
			}

		}

		/**
		 * Gathers all plugins produced by Gambit Technologies.
		 *
		 * @return array
		 */
		public function gather_installed_plugins() {
			if ( ! empty( $this->installed_plugins ) ) {
				return $this->installed_plugins;
			}

			$all_plugins = get_plugins();
			foreach ( $all_plugins as $plugin_file => $plugin_meta ) {

				if ( empty( $plugin_meta['SKU'] ) ) {
					continue;
				}

				$this->installed_plugins[] = array(
					'sku' => $plugin_meta['SKU'], // Should be the same in our site.
			   	  	'store_url' => self::STORE_URL, // Our main site URL.
			   	  	'name' => $plugin_meta['Name'], // Should be the same with our site.
			   	  	'url' => $plugin_meta['PluginURI'],
			   	  	'file' => $plugin_file,
			   	  	'version' => $plugin_meta['Version'], // The version of this current plugin.
			   	  	'author' => $plugin_meta['Author'],
				);

			}

			return $this->installed_plugins;
		}


		/**
		 * Adds the license admin page
		 *
		 * @return void
		 */
		public function create_licenses_page() {
			$this->gather_installed_plugins();

			// $this->installed_plugins = apply_filters( 'gambit_plugin_updater', array() );
			if ( empty( $this->installed_plugins ) ) {
				return;
			}

			add_submenu_page( 'plugins.php', 'Gambit Plugins', 'Gambit Plugins', 'manage_options', self::LICENSES_ADMIN_SLUG, array( $this, 'render_licenses_page' ) );

		}


		/**
		 * Gets the remote list of all of our plugins. Also uses a cache to save page loading time.
		 *
		 * @return Array of plugin data
		 */
		public function get_plugin_remote_list() {
			if ( self::DEBUG ) {
				delete_transient( self::PLUGIN_LIST_TRANSIENT );
			}

			// Check whether we have data cached.
			$transient_exists = false;
			if ( ! is_multisite() ) {
				$transient_exists = get_transient( self::PLUGIN_LIST_TRANSIENT );
			} else {
				$transient_exists = get_site_transient( self::PLUGIN_LIST_TRANSIENT );
			}
			if ( $transient_exists ) {
				return $transient_exists;
			}

			// Get the list of plugins.
			$request = wp_remote_get( self::PLUGIN_LIST_URL );
			$other_plugins = array();
			if ( ! empty( $request ) ) {

				// Check request status.
				if ( ! empty( $request['response']['code'] ) && in_array( $request['response']['code'], array( 200, 304 ) ) ) {

					$response = wp_remote_retrieve_body( $request );
					if ( ! is_wp_error( $response ) ) {

						$plugins = json_decode( $response );
						if ( ! empty( $plugins ) ) {

							$other_plugins = $plugins;

						}
					}
				}

				// Cache to save calls.
				if ( ! is_multisite() ) {
					set_transient( self::PLUGIN_LIST_TRANSIENT, $other_plugins, DAY_IN_SECONDS );
				} else {
					set_site_transient( self::PLUGIN_LIST_TRANSIENT, $other_plugins, DAY_IN_SECONDS );
				}

				return $other_plugins;
			}

			return array();
		}


		/**
		 * Renders the Gambit Plugin license activation admin page.
		 *
		 * @return void
		 */
		public function render_licenses_page() {

			// Get all the SKUs of the installed Gambit Plugins.
			$installed_skus = array();
			foreach ( $this->installed_plugins as $installed_plugin ) {
				if ( ! empty( $installed_plugin['sku'] ) ) {
					$installed_skus[] = $installed_plugin['sku'];
				}
			}

			// Don't display installed plugins since those are already displayed.
			$remote_plugins = array();
			$faqs = array();
			foreach ( $this->get_plugin_remote_list() as $remote_plugin ) {
				if ( ! in_array( $remote_plugin->sku, $installed_skus ) ) {
					$remote_plugins[] = $remote_plugin;

					// Collect the FAQ links.
				} elseif ( ! empty( $remote_plugin->faq ) ) {
					$faqs[ $remote_plugin->sku ] = $remote_plugin->faq;
				}
			}

			?>
			<script>
			jQuery(document).ready(function($) {
				<?php

				// Trigger button on enter.
				?>
				$('body').on('keypress', '#gambit_plugin_activation input[type="text"]', function(e) {
					if ( e.which === 13 ) {
						$(this).parent().find('button').trigger('click');
						return false;
					}
				});
				<?php

				// Show the button when the field is deleted.
				?>
				$('body').on('keyup', '#gambit_plugin_activation input[type="text"]', function(e) {
					if ( $(this).val().length === 0 ) {
						$(this).parent().find('.edd_license_activate').fadeIn();
					}
				});
				<?php

				// Activate license.
				?>
				$('body').on('click', '#gambit_plugin_activation .edd_license_activate', function(e) {
					e.preventDefault();
					
					$(this).parent().find('.dashicons').hide().end().find('.spinner').fadeIn();
					
					var data = {
						'action': 'gambit_plugin_activate',
						'sku': $(this).parent().find('[type="hidden"]').val(),
						'code': $(this).parent().find('[type="text"]').val(),
						'nonce': '<?php echo esc_attr( wp_create_nonce( 'gambit-license' ) ) ?>'
					};

					var $this = $(this);
					
					$.post(ajaxurl, data, function(response) {

						$this.parent().find('.spinner').stop().hide();
						if ( response === '' ) {
							$this.parent().find('.dashicons-yes').fadeIn();
						} else {
							$this.parent().find('.dashicons-no').fadeIn();
						}
						
					});
					
					return false;
				});
			});
			</script>
			
			<style>
			#gambit_plugin_activation th, #gambit_plugin_activation td {
				padding: 20px !important;
				position: relative;
				vertical-align: top;
			}
			#gambit_plugin_activation thead {
			    background-color: #22A7F0;
				text-transform: uppercase;
			}
			#gambit_plugin_activation thead th {
				color: #fff;
			}
			#gambit_plugin_activation tbody {
				background: #fff;
			}
			#gambit_plugin_activation th,
			#gambit_plugin_activation td {
				display: table-cell !important;
			}
			#gambit_plugin_activation thead th,
			#gambit_plugin_activation td {
				width: 65% !important;
			}
			#gambit_plugin_activation thead th:first-child,
			#gambit_plugin_activation tbody th {
				width: 35% !important;
			}
			#gambit_plugin_activation tbody th {
				padding-top: 25px !important;
			}
			#gambit_plugin_activation tbody tr {
				border-top: 1px solid #f1f1f1;
			}
			#gambit_plugin_activation tbody tr:first-child {
				border-top: none;
			}
			#gambit_plugin_activation i {
			    float: none;
			    margin: 0;
			    position: absolute;
			    top: 25px;
			    left: -10px;
			}
			#gambit_plugin_activation .dashicons {
			    color: #26A65B;
			    font-size: 30px;
			    top: 21px;
			    left: -15px;
			}
			#gambit_plugin_activation .dashicons.dashicons-no {
			    color: #F64747;
			}
			#gambit_plugin_activation .dashicons {
				pointer-events: none;
			}
			#gambit_plugin_activation .plugin-desc {
			    margin: 0 0 1em;
			    font-style: italic;
				color: #888;
			}
			#gambit_plugin_activation .other-plugins thead {
				background-color: #F64747;
			}
			#gambit_plugin_activation .other-plugins td {
				width: 20% !important;
			}
			#gambit_plugin_activation .other-plugins td:nth-child(1),
			#gambit_plugin_activation .other-plugins td:nth-child(3) {
				padding-right: 0 !important;
			}
			#gambit_plugin_activation .other-plugins td:nth-child(2),
			#gambit_plugin_activation .other-plugins td:nth-child(4) {
				width: 30% !important;
			}
			#gambit_plugin_activation .other-plugins td .mobile_preview {
				display: none !important;
			}
			#gambit_plugin_activation .other-plugins td:nth-child(2) {
				border-right: 1px solid #f1f1f1;
			}
			#gambit_plugin_activation .other-plugins td *:first-child {
				margin-top: 0;
			}
			@media screen and (max-width: 1100px) {
				#gambit_plugin_activation .other-plugins td {
					width: 50% !important;
				}
				#gambit_plugin_activation .other-plugins td:nth-child(1),
				#gambit_plugin_activation .other-plugins td:nth-child(3) {
					display: none !important;
				}
				#gambit_plugin_activation .other-plugins td .mobile_preview {
					display: block !important;
				}
			}
			#gambit_plugin_activation .other-plugins img {
				width: 100%;
				height: auto;
			}
			#gambit_plugin_activation .form-table {
				margin-top: 50px;
			}
			#gambit_plugin_activation > p {
				margin-top: 20px;
			}
			#gambit_plugin_activation .support thead,
			#gambit_plugin_activation .support tbody {
				background: transparent;
			}
			#gambit_plugin_activation .support thead th:first-child,
			#gambit_plugin_activation .support thead th:last-child {
				background: #F7CA18;
			}
			#gambit_plugin_activation .support tr > *:first-child {
				width: auto !important;
				background: #fff;
			}
			#gambit_plugin_activation .support tr > *:nth-child(2) {
				width: 50px !important;
				padding: 0 !important;
			}
			#gambit_plugin_activation .support tr > *:last-child {
				width: 30% !important;
				background: #fff;
			}
			#gambit_plugin_activation .support .button-secondary {
				float: right;
			}
			#gambit_plugin_activation .installed-plugins thead tr th:nth-child(3) {
				text-align: right;
			}
			</style>
			<div class="wrap" id="gambit_plugin_activation">
				
				<h2><?php esc_html_e( 'Plugin Activation Page for Gambit Plugins', 'default' ) ?></h2>
				
				<p class="desc"><?php printf( esc_html_e( 'Get notified of plugin updates right here in your WordPress admin! Just enter your purchase code for our plugins in the field/s below to get automatic updates. Don&apos;t know how to get your purchase code? %1$sHere&apos;s how.%1$s', 'default' ), '<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-" target="_how">', '</a>' ) ?></p>
				
				<form method="post" action="<?php admin_url( 'plugins.php?page=' . self::LICENSES_ADMIN_SLUG ) ?>" id="pbs_licenses">
				
					<table class="form-table installed-plugins">
					
						<thead>
							<tr>
								<th><?php esc_html_e( 'Plugin', 'default' ) ?></th>
								<th><?php esc_html_e( 'Purchase Code', 'default' ) ?></th>
								<?php if ( count( $faqs ) ) : ?>
									<th>?</th>
								<?php endif; ?>
							</tr>
						</thead>
					
						<tbody>
							<?php foreach ( $this->installed_plugins as $plugin ) : ?>
								<?php
								if ( ! is_multisite() ) {
									$license_edd_key = get_option( 'gambit_edd_license_key_' . $plugin['sku'] );
									$purchase_code = get_option( 'gambit_purchase_code_' . $plugin['sku'] );
								} else {
									$license_edd_key = get_site_option( 'gambit_edd_license_key_' . $plugin['sku'] );
									$purchase_code = get_site_option( 'gambit_purchase_code_' . $plugin['sku'] );
								}
								?>
								<tr valign="top">	
									<th>
										<?php echo esc_attr( $plugin['name'] ) ?>
									</th>
									<td>
										<i class="spinner is-active" style="display: none"></i>
										<i class="dashicons dashicons-no" style="display: none"></i>
										<i class="dashicons dashicons-yes" <?php echo ! empty( $license_edd_key ) ? '' : 'style="display: none"' ?>></i>
										<input type="hidden" name="sku" value="<?php echo esc_attr( $plugin['sku'] ) ?>"/>
										<input id="license_key_<?php echo esc_attr( $plugin['sku'] ) ?>" name="license_key_<?php echo esc_attr( $plugin['sku'] ) ?>" type="text" class="regular-text" value="<?php echo esc_attr( $purchase_code ) ?>" placeholder="<?php echo esc_attr( __( 'Purcahse Code', 'default' ) ) ?>"/>
										<button class="button-secondary edd_license_activate" <?php echo ! empty( $license_edd_key ) ? 'style="display: none"' : '' ?>><?php esc_html_e( 'Save & Activate Automatic Updates', 'default' ) ?></button>
									</td>
									<?php if ( count( $faqs ) ) : ?>
										<td>
											<?php if ( ! empty( $faqs[ $plugin['sku'] ] ) ) : ?>
												<a href='<?php echo esc_url( $faqs[ $plugin['sku'] ] ) ?>' class='button-secondary' target="_blank"><?php esc_html_e( 'FAQ', 'default' ) ?></a>
											<?php endif; ?>
										</td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
					
					
					<?php if ( ! empty( $remote_plugins ) ) : ?>
				
						<table class="form-table other-plugins">
							<thead>
								<tr>
									<th colspan="4"><?php esc_html_e( 'Other Gambit Plugins That You Might Find Useful', 'default' ) ?></th>
								</tr>
							</thead>
						
							<tbody>

								<?php foreach ( $remote_plugins as $i => $plugin ) : ?>
									<?php
									if ( ( $i + 1 ) % 2 === 1 ) :
									?>
										<tr valign="top">
									<?php
									endif;
									?>
										<td>
											<?php if ( ! empty( $plugin->demo ) ) : ?>
												<a href="<?php echo esc_url( $plugin->demo ) ?>" target="_gambitdemo">
											<?php endif; ?>
											<?php if ( ! empty( $plugin->image ) ) : ?>
												<img src="<?php echo esc_url( $plugin->image ) ?>" alt="<?php echo esc_attr( $plugin->name ) ?> Preview Image"/>
											<?php endif; ?>
											<?php if ( ! empty( $plugin->demo ) ) : ?>
												</a>
											<?php endif; ?>
										</td>
										<td>
											<?php if ( ! empty( $plugin->demo ) ) : ?>
												<a href="<?php echo esc_url( $plugin->demo ) ?>" target="_gambitdemo" class="mobile_preview">
											<?php endif; ?>
											<?php if ( ! empty( $plugin->image ) ) : ?>
												<img src="<?php echo esc_url( $plugin->image ) ?>" alt="<?php echo esc_attr( $plugin->name ) ?> Preview Image"  class="mobile_preview"/>
											<?php endif; ?>
											<?php if ( ! empty( $plugin->demo ) ) : ?>
												</a>
											<?php endif; ?>
											<h3 id="<?php echo esc_attr( str_replace( ' ', '_', strtolower( $plugin->name ) ) ) ?>"><?php echo esc_attr( $plugin->name ) ?></h3>
											<p class="plugin-desc"><?php echo wp_kses( $plugin->desc, wp_kses_allowed_html( 'post' ) ) ?></p>
											<?php if ( ! empty( $plugin->demo ) ) : ?>
												<a href="<?php echo esc_url( $plugin->demo ) ?>" class="button-primary" target="_gambitdemo"><?php esc_html_e( 'View Demo', 'default' ) ?></a>
											<?php endif; ?>
											<?php if ( ! empty( $plugin->buy ) ) : ?>
												<a href="<?php echo esc_url( $plugin->buy ) ?>" class="button-secondary" target="_gambitdemo"><?php esc_html_e( 'Learn More', 'default' ) ?></a>
											<?php endif; ?>
										</td>
									<?php
									if ( $i % 2 || count( $remote_plugins ) - 1 === $i ) :
									?>
										</tr>
									<?php
									endif;
									?>
								<?php endforeach; ?>
							</tbody>
					
						</table>
					
					<?php endif; ?>
					
			
					<table class="form-table support">
						<thead>
							<tr>
								<th><?php esc_html_e( 'Need Support?', 'default' ) ?></th>
								<th></th>
								<th><?php esc_html_e( 'Enjoying Our Plugin?', 'default' ) ?></th>
							</tr>
						</thead>
				
						<tbody>
							<tr>
								<td><a href="http://support.gambit.ph" class="button-secondary" target="_blank">Go to the Support Forum</a><p>Having trouble with our plugins? Let us know how we can help resolve your problem.</p></td>
								<td></td>
								<td><?php esc_html_e( 'Show your appreciation by <strong>rating our plugins 5 stars in CodeCanyon</strong>. Doing that will greatly help us and will allow us to provide you with better support and even more awesome plugins. :)', 'default' ) ?></td>
							</tr>
						</tbody>
					</table>
				
				</form>
			
			</div>
			<?php
		}

		/**
		 * Deletes license key when requested to do so.
		 *
		 * @param string $sku - The SKU id of a product.
		 * @return void
		 */
		public function delete_license_key( $sku ) {
			if ( ! is_multisite() ) {
				delete_option( 'gambit_edd_license_key_' . $sku );
			} else {
				delete_site_option( 'gambit_edd_license_key_' . $sku );
			}
		}


		/**
		 * Ajax handler for activating purchase codes. Saves the activation status as 'valid' or 'invalid'.
		 *
		 * @return void
		 */
		public function save_purchase_code() {

			if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'gambit-license' ) ) {
				die( 'nonced' );
			}

			if ( empty( $_POST ) || empty( $_POST['sku'] ) || empty( $_POST['code'] ) ) {
				die( 'missing_params' );
			}

			$sku = esc_attr( $_POST['sku'] );
			$code = esc_attr( $_POST['code'] );

			// Verify SKU.
			$this->installed_plugins = $this->gather_installed_plugins();
			if ( empty( $this->installed_plugins ) ) {
				$this->delete_license_key( $sku );
				die( 'no_plugins' );
			}
			foreach ( $this->installed_plugins as $installed_plugin ) {
				if ( $installed_plugin['sku'] !== $sku ) {
					continue;
				}

				// Save the entered code.
				if ( ! is_multisite() ) {
					update_option( 'gambit_purchase_code_' . $sku, $code );
				} else {
					update_site_option( 'gambit_purchase_code_' . $sku, $code );
				}

				/*
				 * Verify purchase code.
				 */

				// Data to send in our API request.
				$api_params = array(
					'purchase_code' => $code,
					'sku' => $sku,
					'url' => home_url(),
				);
				$response = wp_remote_get( add_query_arg( $api_params, self::VERIFY_PURCHASE_CODE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

				if ( is_wp_error( $response ) ) {
					die( esc_html( $response->get_error_message() ) );
				}
				$license_key = wp_remote_retrieve_body( $response );

				if ( empty( $license_key ) ) {
					$this->delete_license_key( $sku );
					die( 'invalid_purchase_code' );
				}

				if ( ! is_multisite() ) {
					update_option( 'gambit_edd_license_key_' . $sku, $license_key );
				} else {
					update_site_option( 'gambit_edd_license_key_' . $sku, $license_key );
				}

				die();
			}

			$this->delete_license_key( $sku );
			die( 'invalid_sku' );
		}


		/**
		 * Checks for updates.
		 *
		 * @return void
		 */
		public function check_for_updates() {

			// $this->installed_plugins = apply_filters( 'gambit_plugin_updater', array() );
			$this->gather_installed_plugins();
			if ( empty( $this->installed_plugins ) ) {
				return;
			}

			foreach ( $this->installed_plugins as $installed_plugin ) {
				// Only check ones with an SKU.
				if ( empty( $installed_plugin['sku'] ) ) {
					continue;
				}
				$sku = esc_attr( $installed_plugin['sku'] );

				// Retrieve our license key.
				$license_edd_key = self::get_edd_license_key( $sku );
				if ( ! $license_edd_key ) {
					continue;
				}

				// Setup the updater.
				$edd_updater = new GAMBIT_EDD_SL_Plugin_Updater( $installed_plugin['store_url'], $installed_plugin['file'],
					array(
						'version' => $installed_plugin['version'], // Current version number.
						'license' => $license_edd_key, // License key - used get_option above to retrieve from DB.
						'item_name' => $installed_plugin['name'], // Name of this plugin.
						'author' => $installed_plugin['author'], // Author of this plugin.
						'item_id' => $sku,
					)
				);
			}
		}


		/**
		 * Gets the EDD license key if any.
		 *
		 * @param string $sku - The SKU of a product.
		 * @return mixed False if no license key, the license key if available.
		 */
		public static function get_edd_license_key( $sku ) {
			if ( ! is_multisite() ) {
				$license_edd_key = get_option( 'gambit_edd_license_key_' . $sku );
				$purchase_code = get_option( 'gambit_purchase_code_' . $sku );
			} else {
				$license_edd_key = get_site_option( 'gambit_edd_license_key_' . $sku );
				$purchase_code = get_site_option( 'gambit_purchase_code_' . $sku );
			}
			if ( empty( $purchase_code ) || empty( $license_edd_key ) ) {
				return false;
			}
			return $license_edd_key;
		}
	}

	new GambitAdminLicensePage();

}


if ( ! class_exists( 'GAMBIT_EDD_SL_Plugin_Updater' ) ) {

	/**
	 * Add this line when testing:
	 * set_site_transient( 'update_plugins', null );
	 */

	/**
	 * Allows plugins to use their own update API.
	 *
	 * @author Pippin Williamson
	 * @version 1.6
	 */
	class GAMBIT_EDD_SL_Plugin_Updater {
		// Namespaced to PBS for error protection.
		/**
		 * The API URL.
		 *
		 * @var $api_url
		 */
		private $api_url = '';

		/**
		 * The API data.
		 *
		 * @var $api_data
		 */
		private $api_data  = array();

		/**
		 * The plugin name.
		 *
		 * @var $name
		 */
		private $name      = '';

		/**
		 * The plugin slug.
		 *
		 * @var $slug
		 */
		private $slug      = '';

		/**
		 * Class constructor.
		 *
		 * @uses plugin_basename()
		 * @uses hook()
		 *
		 * @param string $_api_url     The URL pointing to the custom API endpoint.
		 * @param string $_plugin_file Path to the plugin file.
		 * @param array  $_api_data    Optional data to send with API calls.
		 * @return void
		 */
		function __construct( $_api_url, $_plugin_file, $_api_data = null ) {
			$this->api_url  = trailingslashit( $_api_url );
			$this->api_data = $_api_data;
			$this->name     = plugin_basename( $_plugin_file );
			$this->slug     = basename( $_plugin_file, '.php' );
			$this->version  = $_api_data['version'];

			// Set up hooks.
			$this->init();
			add_action( 'admin_init', array( $this, 'show_changelog' ) );
		}

		/**
		 * Set up WordPress filters to hook into WP's update process.
		 *
		 * @uses add_filter()
		 *
		 * @return void
		 */
		public function init() {

			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );
			add_filter( 'plugins_api', array( $this, 'plugins_api_filter' ), 10, 3 );

			add_action( 'after_plugin_row_' . $this->name, array( $this, 'show_update_notification' ), 10, 2 );
		}

		/**
		 * Check for Updates at the defined API endpoint and modify the update array.
		 *
		 * This function dives into the update API just when WordPress creates its update array,
		 * then adds a custom API call and injects the custom plugin data retrieved from the API.
		 * It is reassembled from parts of the native WordPress plugin update code.
		 * See wp-includes/update.php line 121 for the original wp_update_plugins() function.
		 *
		 * @uses api_request()
		 *
		 * @param array $_transient_data Update array build by WordPress.
		 * @return array Modified update array with custom plugin data.
		 */
		function check_update( $_transient_data ) {

			global $pagenow;

			if ( ! is_object( $_transient_data ) ) {
				$_transient_data = new stdClass;
			}

			if ( 'plugins.php' == $pagenow && is_multisite() ) {
				return $_transient_data;
			}

			if ( empty( $_transient_data->response ) || empty( $_transient_data->response[ $this->name ] ) ) {

				$version_info = $this->api_request( 'plugin_latest_version', array( 'slug' => $this->slug ) );

				if ( false !== $version_info && is_object( $version_info ) && isset( $version_info->new_version ) ) {

					$this->did_check = true;

					if ( version_compare( $this->version, $version_info->new_version, '<' ) ) {

						$_transient_data->response[ $this->name ] = $version_info;

					}

					$_transient_data->last_checked = time();
					$_transient_data->checked[ $this->name ] = $this->version;

				}
			}

			return $_transient_data;
		}

		/**
		 * Show update nofication row -- needed for multisite subsites, because WP won't tell you otherwise!
		 *
		 * @param string $file - Filename of plugin.
		 * @param array  $plugin - The plugin name.
		 */
		public function show_update_notification( $file, $plugin ) {

			if ( ! current_user_can( 'update_plugins' ) ) {
				return;
			}

			if ( ! is_multisite() ) {
				return;
			}

			if ( $this->name !== $file ) {
				return;
			}

			// Remove our filter on the site transient.
			remove_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ), 10 );

			$update_cache = get_site_transient( 'update_plugins' );

			if ( ! is_object( $update_cache ) || empty( $update_cache->response ) || empty( $update_cache->response[ $this->name ] ) ) {

				$cache_key    = md5( 'edd_plugin_' . sanitize_key( $this->name ) . '_version_info' );
				$version_info = get_transient( $cache_key );

				if ( false === $version_info ) {

					$version_info = $this->api_request( 'plugin_latest_version', array( 'slug' => $this->slug ) );

					set_transient( $cache_key, $version_info, 3600 );
				}

				if ( ! is_object( $version_info ) ) {
					return;
				}

				if ( version_compare( $this->version, $version_info->new_version, '<' ) ) {

					$update_cache->response[ $this->name ] = $version_info;

				}

				$update_cache->last_checked = time();
				$update_cache->checked[ $this->name ] = $this->version;

				set_site_transient( 'update_plugins', $update_cache );

			} else {

				$version_info = $update_cache->response[ $this->name ];

			}

			// Restore our filter.
			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );

			if ( ! empty( $update_cache->response[ $this->name ] ) && version_compare( $this->version, $version_info->new_version, '<' ) ) {

				// Build a plugin list row, with update notification.
				$wp_list_table = _get_list_table( 'WP_Plugins_List_Table' );
				echo '<tr class="plugin-update-tr"><td colspan="' . esc_html( $wp_list_table->get_column_count() ) . '" class="plugin-update colspanchange"><div class="update-message">';

				$changelog_link = self_admin_url( 'index.php?edd_sl_action=view_plugin_changelog&plugin=' . $this->name . '&slug=' . $this->slug . '&TB_iframe=true&width=772&height=911' );

				if ( empty( $version_info->download_link ) ) {
					printf(
						esc_html_e( 'There is a new version of %1$s available. <a target="_blank" class="thickbox" href="%2$s">View version %3$s details</a>.', 'edd' ),
						esc_html( $version_info->name ),
						esc_url( $changelog_link ),
						esc_html( $version_info->new_version )
					);
				} else {
					printf(
						esc_html_e( 'There is a new version of %1$s available. <a target="_blank" class="thickbox" href="%2$s">View version %3$s details</a> or <a href="%4$s">update now</a>.', 'edd' ),
						esc_html( $version_info->name ),
						esc_url( $changelog_link ),
						esc_html( $version_info->new_version ),
						esc_url( wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $this->name, 'upgrade-plugin_' . $this->name ) )
					);
				}

				echo '</div></td></tr>';
			}
		}


		/**
		 * Updates information on the "View version x.x details" page with custom data.
		 *
		 * @uses api_request()
		 *
		 * @param mixed  $_data - Information passed to the function.
		 * @param string $_action - Normally blank.
		 * @param object $_args - Optional.
		 * @return object $_data
		 */
		function plugins_api_filter( $_data, $_action = '', $_args = null ) {

			if ( 'plugin_information' !== $_action ) {

				return $_data;

			}

			if ( ! isset( $_args->slug ) || ( $_args->slug !== $this->slug ) ) {

				return $_data;

			}

			$to_send = array(
				'slug'   => $this->slug,
				'is_ssl' => is_ssl(),
				'fields' => array(
					'banners' => false, // These will be supported soon hopefully.
					'reviews' => false,
				),
			);

			$api_response = $this->api_request( 'plugin_information', $to_send );

			if ( false !== $api_response ) {
				$_data = $api_response;
			}

			return $_data;
		}


		/**
		 * Disable SSL verification in order to prevent download update failures.
		 *
		 * @param array  $args - Request arguments.
		 * @param string $url - The URL to check.
		 * @return object $array
		 */
		function http_request_args( $args, $url ) {
			// If it is an https request and we are performing a package download, disable ssl verification.
			if ( false !== strpos( $url, 'https://' ) && strpos( $url, 'edd_action=package_download' ) ) {
				$args['sslverify'] = false;
			}
			return $args;
		}

		/**
		 * Calls the API and, if successfull, returns the object delivered by the API.
		 *
		 * @uses get_bloginfo()
		 * @uses wp_remote_post()
		 * @uses is_wp_error()
		 *
		 * @param string $_action The requested action.
		 * @param array  $_data   Parameters for the API action.
		 * @return false||object
		 */
		private function api_request( $_action, $_data ) {

			global $wp_version;

			$data = array_merge( $this->api_data, $_data );

			if ( $data['slug'] !== $this->slug ) {
				return; }

			if ( empty( $data['license'] ) ) {
				return; }

			if ( home_url() == $this->api_url ) {
				return false; // Don't allow a plugin to ping itself.
			}

			$api_params = array(
				'edd_action' => 'get_version',
				'license'    => $data['license'],
				'item_name'  => isset( $data['item_name'] ) ? $data['item_name'] : false,
				'item_id'    => isset( $data['item_id'] ) ? $data['item_id'] : false,
				'slug'       => $data['slug'],
				'author'     => $data['author'],
				'url'        => home_url(),
			);

			$request = wp_remote_post( $this->api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			if ( ! is_wp_error( $request ) ) {
				$request = json_decode( wp_remote_retrieve_body( $request ) );
			}

			if ( $request && isset( $request->sections ) ) {
				$request->sections = maybe_unserialize( $request->sections );
			} else {
				$request = false;
			}

			return $request;
		}

		/**
		 * Show changelogs.
		 *
		 * @return void
		 */
		public function show_changelog() {
			// Sanitize $_REQUEST before use.
			$the_request = wp_unslash( $_REQUEST );

			if ( empty( $the_request['edd_sl_action'] ) || 'view_plugin_changelog' !== $the_request['edd_sl_action'] ) {
				return;
			}

			if ( empty( $the_request['plugin'] ) ) {
				return;
			}

			if ( empty( $the_request['slug'] ) ) {
				return;
			}

			if ( ! current_user_can( 'update_plugins' ) ) {
				wp_die( esc_attr__( 'You do not have permission to install plugin updates', 'default' ), esc_attr__( 'Error', 'edd' ), array( 'response' => 403 ) );
			}

			$response = $this->api_request( 'plugin_latest_version', array( 'slug' => $the_request['slug'] ) );

			if ( $response && isset( $response->sections['changelog'] ) ) {
				echo '<div style="background:#fff;padding:10px;">' . esc_html( $response->sections['changelog'] ) . '</div>';
			}

			exit;
		}
	}

}
