<?php

/* 
 * Eight Degree Fly Menu - How to use plugin
 */
defined('ABSPATH') or die("No script kiddies please!");?>
<div class="edfm-wrap edfm-clear">
  <div class="edfm-body-wrapper edfm-add-bar-wrapper">
    <div class="edfm-panel">
      <div class="edfm-panel-head">
       <div class="edfm-head-social-link">
        <span class="edfm-header-close">X</span>
        <p class="edfm-follow-us"><?php _e('Follow us for new updates','eight-degree-fly-menu');?></p>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        <a href="https://twitter.com/8degreethemes" class="twitter-follow-button" data-show-count="false"></a>
        <div class="fb-like" data-href="https://www.facebook.com/8DegreeThemes" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>

      </div>
    </div>
    <div class="edfm-panel-body">
      <div class="edfm-backend-h-title"><?php _e('How to use','edfm-plugin-pro');?></div>
      <div class="edfm-use-content-wrap">
        <h1><span >8 Degree Fly Menu Lite - Free Responsive Off Canvas Menu Plugin for WordPress</span><span class="edfm-version">Version <?php echo EDFML_VERSION;?></span></h1>
        <h2 id="createmenu"><span >Creating a Menu for Eight Degree Fly Menu Lite</span></h2>
        <p>You will need to need to configure a WordPress Menu before you can begin creating your fly menu. So,</p>
        <ul>
          <li ><span >Go to Dashboard-&gt; Appearance-&gt; Menus.</span></li>
          <li ><span >Click on Create a Menu, to create a new menu.</span></li>
          <li ><span >Provide a menu name and click on Create Menu.</span></li>
          <li ><span >Go to Screen Option on the top of the Menu Page and check 8Degree Fly Menu under Boxes.</span></li>
          <li ><span >Locate the 8Degree Fly Menu Lite Meta boxes, Check on Use as fly menu option if you want use the current menu as fly menu.</span></li>
          <li ><span >Select the Menu items you can to add to be menu and click on save menu.</span></li>
          <li ><span >You will see the 8Degree Fly Menu Lite icon on each Menu item, click on it to open a modular setting menu </span><br/>
            <p>Unlike a normal menu this menu allows you to add things like, an icon, a sub-menu title to your individual menu item.</p>
            <h5>General Settings</h5>
            <ul>
              <li ><b>Select Menu Icon:</b><span > Choose a menu icon from either the default provided icons or upload a custom icon.   You can also add direct icon code such as fa|fa-align-left in the input field.</span></li>
              <li ><b>Menu Short Description:</b><span > A sub label to your menu label.</span></li>
            </ul>
          </li>
        </ul>
        <h2><span >Configure 8Degree Fly Menu</span></h2>
        <ul>
          <li>Click on 8Degree fly Menu lite on the left admin panel.</li>
          <li>Click on add new.</li>
          <li ><span >Enter title for your fly menu.</span></li>
          <p>You can configure the fly menu in couple of steps, Let's begin with</p>
        </ul>
        <h2 id="buildmenu"><strong>1) Build Menu</strong> </h2>

<p>Here you will set all the content for your fly menu here. Fly menu is divided into 3 parts: Header, Body and Footer. These sections may vary in position according to the layout you choose. You can choose to disable the Header/ Footer section.</span>
  <h5 ><span >Header section</span></h5>
  <p>The header section is where you can set the identity of your website, user or anything you like. You can set custom text, custom image or a search bar. Enable/ disable each section as you like.</p>
  <ul>
    <li ><b>Enable Header Section:</b><span > Activate header section in the menu.</span></li>
    <li ><b>Add Fly Menu Top Text:</b><span > Choose Top Menu Text.</span></li>
    <li ><b>Add Fly Menu Header Image:</b><span > Choose header image type.</span></li>
    <li ><b>Add Fly Menu Bottom Text:</b><span > Choose bottom header text type.</span></li>
    <li ><b>Add Search form in Header:</b><span > Check to enable Search Box in the header section.</span></li>
  </ul>
  <h5 ><span >Body Section</span></h5>
  <p>The awesome thing about fly menu is that you are not limited to just using the WordPress menu in your Fly-menu. Instead you can choose to add custom content in place of the WordPress Menu. This can be used to make awesome Call to Actions as well.</p>
  <ul>
    <li ><b>Body Content:</b><span > Choose body content type.</span>
      <ul>
        <li ><b>Custom content:</b><span > You can place custom content or shortcodes here.</span></li>
        <li ><b>Fly Menu: </b><span >Select the assigned Fly Menu here. Check <a href="#createmenu">Creating a Menu for Eight Degree Fly Menu</a> to learn how to create a fly menu.</span></li>
      </ul>
    </li>
  </ul>
  <h5 ><span >Footer section</span></h5>
  <ul>
    <li ><b>Enable Footer Section:</b><span > Activate footer section in the menu.</span></li>
    <li ><b>Add Search form in Footer:</b><span > Check to enable Search Box in the footer section.</span></li>
    <li ><b>Add Social Icons in Footer:</b><span > Check to enable social icons in the footer section. You can drag and drop to position the social icons accordingly. There are 5+ social icons.</span></li>
    <li ><b>Additional Footer Content:</b><span > Enter additional footer content or shortcodes here. It is the perfect place to place your Copyright/ Credit notes.</span></li>
  </ul>
</li>
</ul>


<h2 id="layout"><strong>2) Fly Menu Layout</strong> </h2>
<p> The fly menu comes in 2 different layouts. These include a Side Menu and a Skew Menu to add something new to your site. Please note that all the menu content may not appear in all the menu layouts due to the structure of the layouts.</p>
<ol>
  <li>
    <h5><b>Full Side Menu: </b></h5>
    <ul>
      <li ><b>Choose Template:</b><span > You can choose from 2 different templates</span></li>
      <li ><b>Menu Position:</b><span > You can choose from top, bottom, left, right</span></li>
      <li ><b>Sub Menu Type:</b><span > You can choose a drop menu or a push menu</span></li>
    </ul>
    <h6><b>Animation Settings: </b></h6>
    <ul>
      <li ><strong>Menu Animation:</strong><span > Set how the menu appears.</span></li>
      <li ><strong>Sub Menu Animation:</strong><span > Set animation on sub-menu</span></li>
      <li ><strong>Menu Item Animation:</strong><span > Set animation on menu-items</span></li>
      <li ><strong>Content Blur Effect:</strong><span > Set the content blur effect</span></li>
    </ul>
  </li>
  <li><h5><b>Skew Menu: </b></h5>
      <ul>
        <li ><b>Choose Template:</b><span > You can choose from 2 different templates.</span></li>
        <li ><b>Menu Position:</b><span > You can set the menu trigger at left and right position.</span></li>
        <li ><b>Sub Menu Type:</b><span > You can only choose a drop menu.</span></li>
      </ul>
      <h6><b>Animation Settings: </b></h6>
      <ul>
        <li ><b>Menu Animation:</b><span > Set how the menu appears.</span></li>
        <li ><b>Sub Menu Animation:</b><span > Set animation on sub-menu</span></li>
        <li ><b>Menu Item Animation:</b><span > Set animation on menu-items</span></li>
        <li ><b>Content Blur Effect:</b><span > Set the content blur effect</span></li>
      </ul></li>
    </ol>
    

    <h2 id="font"><strong>3) Font and Colors</strong> </h2>
    <p>The fly menu is a very customizable plugin with option to change typography, color, backgrounds, sub-menu navigation icon and so on. You can set customization for the parent menu/ first level menu and submenus. You can leave any field blank to use the default template CSS.</p>
    <strong>Select Template type: </strong> For quick setup you can choose the default template type. If the default settings do not work for you, choose custom template type and start setting the custom options. All the colors are initially set to the default template of side menu-> template 1.
    <h5><b>Menu Font Settings:</b> Change the menu font color, size and family from here</h5>
    <ul>
      <li ><b>Font Family:</b><span > Select from all available Google fonts.</span></li>
      <li ><b>Text Transform:</b><span > Set the menu font to uppercase/ lowercase/ capitalized/ normal </span></li>
      <li ><b>Font Weight:</b><span > Set the menu font weight. All font weight may not be compatible with all fonts. Please check <a href="https://fonts.google.com/" target="_blank">Google Fonts</a> for font weight capability. </span></li>
      <li ><b>Text Align:</b><span > Align text to left/ right/ center </span></li>
      <li ><b>Font Color:</b><span > Set the menu font color</span></li>
    </ul>

    <h5><b>Parent Menu Settings:</b><span > Set the first menu level settings here</span></h5>
    <h6><b >Color and Background</b></h6>
    <ul>
      <li ><b>Background Type:</b><span > Choose between a color background or an image background.</span></li>
      <li ><b>Background color:</b><span > Set the background color you can also set alpha value for transparency. This setting can also be used as a overlay color while using image background.</span></li>
      <li ><b>Image URL:</b><span > Click on the upload icon button to add a background from the Media Library or simply paste a URL source in the text field. Image background setting is not available for Skew menu.</span></li>
    </ul>
    <h6><b >Hover Settings</b></h6>
    <ul>
      <li ><span ><strong>Menu Hover Color:</strong></span> Set the  menu item hover text color here.</li>
      <li ><span ><strong>Menu Hover Background:</strong> </span> Set the menu item background color here. This setting varies with the animation settings.</li>
    </ul>
    
    <h5><span ><strong>Child Menus Settings</strong></span></h5>
    <p>These settings will be same for all sub menu levels</p>
    <h6><b >Color and Background</b></h6>
    <ul>
      <li ><span ><strong>Background color: </strong></span>Set the sub menu background color.</li>
      <li ><span ><strong>Font color: </strong></span>Set the sub menu text color.</li>
      <li ><span ><strong>Background Type:</strong></span> Set a color background.</li>
    </ul>

    <h5><span ><strong>Nav Icon Options</strong></span></h5>
    <h6><b >Choose Nav Icon: </b></h6>
    <p>You can choose from the given Icons.</p>
  </li>
  
  <h2 id="toggle"><strong>4) Toggle Button Settings</strong> </h2>
  <p>You can choose the Default option for easy ready to go toggle menu button or click on Custom to make use of the provided custom Settings.</p>
  <ul>
    <li><strong>Define Custom Toggle Element:</strong> If you what to make the Fly Menu show only when someone click in a certain element on your website then this plugin has the feature to do this as well. This can be useful to create a quick call to action or create a separate additional menu to your site.</li>
    <li><strong>Custom Toggle Element ID:</strong> You can set the Element Id here. Whenever you click on this element it will trigger the menu on or off. <p>For example: </p><p><code>&lt;p>&lt;span id="edfm-menu-trigger-example">Click here&lt;/span> to open your fly menu.&lt;/p></code></p>
      Then <code>edfm-menu-trigger-example</code> is your element id.</li> 
      <li><strong>Toggle Button Behavior:</strong> You can make the toggle menu fixed to a certain location, make it scrollable or hide the button completely. The hide option can be utilized while using the Custom Toggle Element feature.</li>
      <li><strong>Choose Button Icon :</strong> You can use the default 3 line hamburger trigger button or you can choose from the given Icon set or upload custom image as well.</li>
      <li><strong>Button Background color:</strong> Change the background of the toggle button. You can also set the alpha value for a transparent background.</li>
      <li><strong>Icon open color:</strong> Set the open state Icon color</li>
      <li><strong>Icon close color:</strong> Set the close state Icon color</li>
      <li><strong>Icon hover color:</strong> Set the hover state Icon color</li>
      <li><strong>Button width:</strong> Set the button width to create a rectangular button.</li>
      <li><strong>Button border:</strong> Set the thickness of the button border. Set to 0 for no border</li>
      <li><strong>Border color:</strong> Set the button border color. You can also set the alpha value for a transparent border.</li>
      <li><strong>Button border radius:</strong> Set the button border radius. Can be used to create a oval or circular toggle button.</li>
      <p>Top and Left settings can be used to manage the overlapping to the toggle buttons.</p>
      <li><strong>Button Position Top:</strong> Set the button Top position in px. Leave blank to use default value.</li>
      <li><strong>Button Position Left:</strong> Set the button Left position in px. Leave blank to use default value.</li>
    </ul>
    
    <h2 id="display"><strong>5) Display Settings</strong> </h2>
    <p>You can set where to show or hide the fly menu. These settings can be used to manage multiple menus in different pages. by default all menus are set to show in all pages. You can set where to show the menu.</p>
   
    <h2 id="css"><strong>6) Custom CSS</strong> </h2>
    <p>Since the plugin supports a lot of Custom Content in the plugin editors. This custom CSS section can be handy to provide CSS rules or modify any of the default settings or cover any settings that we might have missed in the Custom Settings. 
      Turn the style you have written on or off from Enable Custom CSS Section option.</p>
      
      </div>
    </div>
  </div>
</div>
</div>

