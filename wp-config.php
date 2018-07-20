<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'codigode_sweet');

/** MySQL database username */
define('DB_USER', 'root'); //codigode_sweetus

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define( 'ALLOW_UNFILTERED_UPLOADS', true );
/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '@Na&]S,E,qp@D}sE/s%IP*;Se9eQR.8d6pvqc<`rT-62u0`u{H0%&*R4>@m=LjJT');
define('SECURE_AUTH_KEY', 'wI_SUK2Gi8r!ANw5N<$(h].JgEwuD6yye~HxcvUCo_71!D8+?w0iTitK-tUA6#:A');
define('LOGGED_IN_KEY', '{]O}c?~@wt+cJv=;m{a$:jj{iP1w6G?R367{9OZ0n?{O]*S8%xW$F2erQ0bmn~iX');
define('NONCE_KEY', 'bmS(pIo^x_Wtz%Y5uQ!b/MYjCf9^<]z&bO+<IXM.F z*,6o8my|*ZAvCfF`-d V8');
define('AUTH_SALT', 'h)w;?WAY(%CY2<=[Z|yi^VuBY-9e ,d^mNpLj-y*qgUG#  VkRdBf[w~Ti|%Jsy<');
define('SECURE_AUTH_SALT', '}$ir 8@oj0,)kht.|WRHWS.Wcw*Tm4r^0X;AVG?$Cw_XAj%$U7aj6O$ngYaq/wOe');
define('LOGGED_IN_SALT', 'AG-f<rs<YkC=9e%5/-]6=6e&Ii_VB#!<(kJop$R}N*Ov]9lwl>)9L8-+7m~QVAt.');
define('NONCE_SALT', 'R_(`b,SrCfw!cLS!@z]^QJQV@WqB6uWk-}&|C[c9Cb`0TQ[i&={[r0O1:Cs.6w^r');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);
define('FS_METHOD', 'direct');
/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

