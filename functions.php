<?php

//* Child theme enqueued scripts
function share_add_scripts() {
  wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-548862977b7e4fe5', array(), '1.0.0', true );
  wp_enqueue_script( 'facebook', get_stylesheet_directory_uri() . '/js/facebook-sdk.js', array(), '1.0.0', true );
  wp_enqueue_script( 'track-page-refresh', get_stylesheet_directory_uri() . '/js/track-page-refresh.js', array(), '1.0.0', false );

  // Prints out the url under the page title on all browsers
  wp_enqueue_script( 'print-page-url', get_stylesheet_directory_uri() . '/js/print-page-url.js', array('jquery'), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'share_add_scripts' );


//* Child theme equeued styles
function share_add_styles() {
  wp_enqueue_style( 'print-styles', get_stylesheet_directory_uri() . '/print-styles.css', array(), '1.0.0', 'print' );
}
add_action( 'wp_enqueue_scripts', 'share_add_styles' );


//* Additional Custom Image Sizes
add_image_size('rss_featured_image', 700, 441, true);

//* Add back old module_3 image size to prevent 404 errors. See https://iiphelp.zendesk.com/agent/tickets/4030
add_image_size( 'old_module_3', 326, 159, TRUE );

//* Visual Composer Settings
function td_disable_visual_composer_features() {
  //if you want to enable all the features from visual composer delete this code
  if (function_exists('vc_remove_element')) {
      // remove unused composer elements;
      // vc_remove_element("vc_separator");
      // vc_remove_element("vc_text_separator");
      // vc_remove_element("vc_message");
      // vc_remove_element("vc_toggle");
      // vc_remove_element("vc_gallery");
      vc_remove_element("vc_tour"); //wtf
      // vc_remove_element("vc_accordion");
      // vc_remove_element("vc_teaser_grid");
      // vc_remove_element("vc_posts_slider");
      // vc_remove_element("vc_posts_grid");
      // vc_remove_element("vc_cta_button");
      // vc_remove_element("vc_progress_bar");
      // vc_remove_element("vc_wp_links");
      // vc_remove_element("vc_facebook");

      //remove unused styles and visual composer scripts
      add_action( 'wp_print_scripts', 'td_remove_visual_composer_assets', 100 );
  }
}


//* WPML Change Date Format
function translate_date_format($format) {
  if (function_exists('icl_translate'))
    $format = icl_translate('Formats', $format, $format);
return $format;
}
add_filter('option_date_format', 'translate_date_format');


//* Filter to fix the Post Author Dropdown
function author_override( $output ) {
    global $post, $user_ID;

    // return if this isn't the theme author override dropdown
    if (!preg_match('/post_author_override/', $output)) return $output;

    // return if we've already replaced the list (end recursion)
    if (preg_match ('/post_author_override_replaced/', $output)) return $output;

    // replacement call to wp_dropdown_users
      $output = wp_dropdown_users(array(
        'echo' => 0,
        'name' => 'post_author_override_replaced',
        'selected' => empty($post->ID) ? $user_ID : $post->post_author,
        'include_selected' => true
      ));

      // put the original name back
      $output = preg_replace('/post_author_override_replaced/', 'post_author_override', $output);

    return $output;
}
add_filter('wp_dropdown_users', 'author_override');


// Fix WP < 4.0 ssl bug
// function ssl_post_thumbnail_urls( $url, $post_id ) {
//   //Skip file attachments
//   if( !wp_attachment_is_image( $post_id ) ) {
//     return $url;
//   }

//   //Correct protocol for https connections
//   list( $protocol, $uri ) = explode( '://', $url, 2 );

//   if( is_ssl() ) {
//     if( 'http' == $protocol ) {
//       $protocol = 'https';
//     }
//   } else {
//     if( 'https' == $protocol ) {
//       $protocol = 'http';
//     }
//   }

//   return $protocol.'://'.$uri;
// }

// add_filter('wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2);


// Remove unwanted wp-cron jobs
// function remove_cron_job() {
//    wp_clear_scheduled_hook("wsal_cleanup");
// }
// add_action("init", "remove_cron_job");


// Disable All Wordpress/plugin/theme update notifications for non-admins
function remove_core_updates() {
    if ( !current_user_can('update_core') ) {
        add_filter('pre_site_transient_update_core','remove_core_updates');
        add_filter('pre_site_transient_update_plugins','remove_core_updates');
        add_filter('pre_site_transient_update_themes','remove_core_updates');
    }
}
add_action('after_setup_theme','remove_core_updates');


// // Suppress Newspaper plugin nags
// remove_action('tgmpa_register', 'td_required_plugins');

// if ( current_user_can('manage_network') ) {
//     function share_required_plugins() {

//         /**
//          * Array of plugin arrays. Required keys are name and slug.
//          * If the source is NOT from the .org repo, then source is also required.
//          */
//         $plugins = array(

//             array(
//                 'name'     				=> 'tagDiv social counter', // The plugin name
//                 'slug'     				=> 'td-social-counter', // The plugin slug (typically the folder name)
//                 'source'   				=> get_template_directory_uri() . '/includes/plugins/td-social-counter.zip', // The plugin source
//                 'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
//                 'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
//                 'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
//                 'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
//                 'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
//             ),
//             array(
//                 'name'     				=> 'Revolution slider', // The plugin name
//                 'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
//                 'source'   				=> get_template_directory_uri() . '/includes/plugins/revslider.zip', // The plugin source
//                 'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
//                 'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
//                 'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
//                 'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
//                 'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
//             ),


//             // This is an example of how to include a plugin pre-packaged with a theme
//             array(
//                 'name'			=> 'WPBakery Visual Composer', // The plugin name
//                 'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
//                 'source'			=> get_stylesheet_directory() . '/includes/plugins/js_composer.zip', // The plugin source
//                 'required'			=> true, // If false, the plugin is only 'recommended' instead of required
//                 'version'			=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
//                 'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
//                 'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
//                 'external_url'		=> '', // If set, overrides default API URL and points to an external URL
//             ),


//             // This is an example of how to include a plugin from the WordPress Plugin Repository
//             array(
//                 'name' 		=> 'Jetpack',
//                 'slug' 		=> 'jetpack',
//                 'required' 	=> false,
//             ),
//             //array(
//             //    'name' 		=> 'Animated Gif Resize',
//             //    'slug' 		=> 'animated-gif-resize',
//             //    'required' 	=> false,
//             //),
//             array(
//                 'name' 		=> 'Contact form 7',
//                 'slug' 		=> 'contact-form-7',
//                 'required' 	=> false,
//             )

//         );  @td_block::td_cake();
//         // Change this to your theme text domain, used for internationalising strings
//         $theme_text_domain = 'tgmpa';

//         /**
//          * Array of configuration settings. Amend each line as needed.
//          * If you want the default strings to be available under your own theme domain,
//          * leave the strings uncommented.
//          * Some of the strings are added into a sprintf, so see the comments at the
//          * end of each line for what each argument will be.
//          */
//         $config = array(
//             'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
//             'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
//             'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
//             'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
//             'menu'         		=> 'install-required-plugins', 	// Menu slug
//             'has_notices'      	=> true,                       	// Show admin notices or not
//             'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
//             'message' 			=> '',							// Message to output right before the plugins table
//             'strings'      		=> array(
//                 'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
//                 'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
//                 'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
//                 'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
//                 'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
//                 'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
//                 'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
//                 'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
//                 'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
//                 'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
//                 'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
//                 'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
//                 'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
//                 'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
//                 'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
//                 'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
//                 'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
//                 'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
//             )
//         );

//         tgmpa( $plugins, $config );
//     }
//     add_action('tgmpa_register', 'share_required_plugins');
// }

//Generates the RSS enclosure for the first audio attachment
function feedContentFilter($item) {
  global $post;

  $args = array(
    'order'          => 'ASC',
    'post_type'      => 'attachment',
    'post_parent'    => $post->ID,
    'post_mime_type' => 'audio',
    'post_status'    => null,
    'numberposts'    => 1,
  );

  $attachments = get_posts($args);

  if ($attachments) {
    foreach ($attachments as $attachment) {
      $audio = wp_get_attachment_url( $attachments[0]->ID );
      $mime = get_post_mime_type($attachment->ID);
    }
  }

  if ($audio) {
    echo '<enclosure url="'.$audio.'" length="1" type="'.$mime.'"/>';
  }
  return $item;
}

// First remove audio enclosures, and then add them back

function delete_enclosure() {
  return '';
}

function feedFilter($query) {
  if ($query->is_feed) {
    add_filter( 'get_enclosed', 'delete_enclosure' );
    add_filter( 'rss_enclosure', 'delete_enclosure' );
    add_filter( 'atom_enclosure', 'delete_enclosure' );
    add_filter('rss2_item', 'feedContentFilter');
  }

  return $query;
}
add_filter('pre_get_posts','feedFilter');


//* Activaating child theme tranlsations and namespace
function share_locale() {
    load_child_theme_textdomain( 'shareamerica', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'share_locale' ); 

// Enable multiple language support for the Mailchimp Bar

function share_filter_mctb_list( $default_list ) {
   $language_lists = array(
      'en' => '294a7b0e3a',
      'zh-hans' => 'a8cc0bf55f',
      'fr' => '7b0c8f6e2a',
      'ru' => '954cd6a6fe',
      'es' => '33948f3033',
      'ar' => 'ae762c96e5',
      'id' => '59d01344c7',
      'pt-br' => 'c27054beb5',
      'fa' => 'f9e72cb897'
   );
  $language_code = defined( 'ICL_LANGUAGE_CODE' ) ? strtolower( ICL_LANGUAGE_CODE ) : '';
  if( isset( $language_lists[ $language_code] ) ) {
      return $language_lists[ $language_code ];
  }
  return $default_list;
}
add_filter( 'mctb_mailchimp_list', 'share_filter_mctb_list' );

