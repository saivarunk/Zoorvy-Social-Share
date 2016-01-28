<?php

/**
 *
 * @link              http://saivarun.me/
 * @since             0.1.1
 * @package           Zoorvy_Social_Share
 *
 * @wordpress-plugin
 * Plugin Name:       Zoorvy Social Share
 * Plugin URI:        http://www.zoorvy.com/
 * Description:       Simple Social Sharing buttons for WordPress that dosent effect the pageload speeds.
 * Version:           0.1.1
 * Author:            Sai Varun KN
 * Author URI:        http://saivarun.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zoorvy-social-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zoorvy-social-share-activator.php
 */
function activate_zoorvy_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zoorvy-social-share-activator.php';
	Zoorvy_Social_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zoorvy-social-share-deactivator.php
 */
function deactivate_zoorvy_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zoorvy-social-share-deactivator.php';
	Zoorvy_Social_Share_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zoorvy_social_share' );
register_deactivation_hook( __FILE__, 'deactivate_zoorvy_social_share' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zoorvy-social-share.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zoorvy_social_share() {

	$plugin = new Zoorvy_Social_Share();
	$plugin->run();

}

//Initialize Settings Menu item 

function zoorvy_social_share_menu_item()
{
  add_submenu_page("options-general.php", "Zoorvy Social Share", "Zoorvy Social Share", "manage_options", "zoorvy-social-share", "zoorvy_social_share_page"); 
}

add_action("admin_menu", "zoorvy_social_share_menu_item");

function zoorvy_social_share_page()
{
   ?>
      <div class="wrap">
         <h1>Zoorvy Social Share Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("zoorvy_social_share_config_section");
 
               do_settings_sections("zoorvy-social-share");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}

function zoorvy_social_share_settings()
{
    add_settings_section("zoorvy_social_share_config_section", "", null, "zoorvy-social-share");
 
    add_settings_field("zoorvy-social-share-facebook", "Do you want to display Facebook share button?", "zoorvy_social_share_facebook_checkbox", "zoorvy-social-share", "zoorvy_social_share_config_section");
    add_settings_field("zoorvy-social-share-twitter", "Do you want to display Twitter share button?", "zoorvy_social_share_twitter_checkbox", "zoorvy-social-share", "zoorvy_social_share_config_section");
    add_settings_field("zoorvy-social-share-linkedin", "Do you want to display LinkedIn share button?", "zoorvy_social_share_linkedin_checkbox", "zoorvy-social-share", "zoorvy_social_share_config_section");
    add_settings_field("zoorvy-social-share-reddit", "Do you want to display Reddit share button?", "zoorvy_social_share_reddit_checkbox", "zoorvy-social-share", "zoorvy_social_share_config_section");
 
    register_setting("zoorvy_social_share_config_section", "zoorvy-social-share-facebook");
    register_setting("zoorvy_social_share_config_section", "zoorvy-social-share-twitter");
    register_setting("zoorvy_social_share_config_section", "zoorvy-social-share-linkedin");
    register_setting("zoorvy_social_share_config_section", "zoorvy-social-share-reddit");
}

function zoorvy_social_share_facebook_checkbox()
{  
   ?>
        <input type="checkbox" name="zoorvy-social-share-facebook" value="1" <?php checked(1, get_option('zoorvy-social-share-facebook'), true); ?> /> Check for Yes
   <?php
}

function zoorvy_social_share_twitter_checkbox()
{  
   ?>
        <input type="checkbox" name="zoorvy-social-share-twitter" value="1" <?php checked(1, get_option('zoorvy-social-share-twitter'), true); ?> /> Check for Yes
   <?php
}

function zoorvy_social_share_linkedin_checkbox()
{  
   ?>
        <input type="checkbox" name="zoorvy-social-share-linkedin" value="1" <?php checked(1, get_option('zoorvy-social-share-linkedin'), true); ?> /> Check for Yes
   <?php
}

function zoorvy_social_share_reddit_checkbox()
{  
   ?>
        <input type="checkbox" name="zoorvy-social-share-reddit" value="1" <?php checked(1, get_option('zoorvy-social-share-reddit'), true); ?> /> Check for Yes
   <?php
}
 
add_action("admin_init", "zoorvy_social_share_settings");

//Social Buttons filter

function add_zoorvy_social_share_icons($content)
{
    $html = "<div class='zoorvy-social-share-wrapper'><div class='share-on'>Share this post: </div>";

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);

    if(get_option("zoorvy-social-share-facebook") == 1)
    {
        $html = $html . "<div class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'>Facebook</a></div>";
    }

    if(get_option("zoorvy-social-share-twitter") == 1)
    {
       	$html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'>Twitter</a></div>";
    }

    if(get_option("zoorvy-social-share-linkedin") == 1)
    {
        $html = $html . "<div class='linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'>LinkedIn</a></div>";
    }

    if(get_option("zoorvy-social-share-reddit") == 1)
    {
        $html = $html . "<div class='reddit'><a target='_blank' href='http://reddit.com/submit?url=" . $url . "'>Reddit</a></div>";
    }

    $html = $html . "<div class='clear'></div></div>";

    return $content = $content . $html;

}

add_filter("the_content", "add_zoorvy_social_share_icons");


run_zoorvy_social_share();
