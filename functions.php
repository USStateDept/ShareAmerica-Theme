<?php

//* Load the child theme version number instead of the Newspaper version number. This will help cache bust during upgrades.
function _fix_child_css_version( $src ) {
  $parts = explode( '?', $src );
  if ( stristr( $parts[0], 'shareamerica/style.css' ) ) {
    $child_ver = wp_get_theme()->get('Version');
    return $parts[0] . '?v=' . $child_ver;
  }
  else {
    return $src;
  }
}
add_filter( 'style_loader_src', '_fix_child_css_version', 15, 1 );

//* Child theme enqueued scripts
function share_add_scripts() {
  wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-571e3cf05c3fa72e', array(), '1.0.0', true );
  wp_enqueue_script( 'facebook', get_stylesheet_directory_uri() . '/js/facebook-sdk.js', array(), '1.0.0', true );
  wp_enqueue_script( 'track-page-refresh', get_stylesheet_directory_uri() . '/js/track-page-refresh.js', array(), '1.0.0', false );

  // Prints out the url under the page title on all browsers
  wp_enqueue_script( 'print-page-url', get_stylesheet_directory_uri() . '/js/print-page-url.js', array('jquery'), '1.0.0', false );

  // Hide the formidable bottom bar
  wp_enqueue_script( 'formidable-js', get_stylesheet_directory_uri() . '/js/formidable-js.js', array('jquery'), '1.0.0', false );

  // Subscribe button functionality
  wp_enqueue_script( 'subscribe-js', get_stylesheet_directory_uri() . '/js/subscribe-js.js', array(), '1.0.1', false );

  wp_enqueue_script( 'share-js', get_stylesheet_directory_uri() . '/js/script.js', array());
  // If Timeline plugin is active, load the opacity 0 image fix
  // This fix is necessary because Tagdiv's lazy loading causes photos in the timeline to not display properly.
  // Uses the ready_init: function() in tagdiv_theme.js - if this code is updated, timelinefix.js must be updated.
  if ( is_plugin_active( 'knight-lab-timelinejs/knightlab-timeline.php' ) && is_single() ) {
    //plugin is activated
    wp_enqueue_script( 'timelinefixjs', get_stylesheet_directory_uri() . '/js/timelinefix.js', array());
  }
}
add_action( 'wp_enqueue_scripts', 'share_add_scripts' );

//* Child theme equeued styles
function share_add_styles() {
  wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css');

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

// Disable All Wordpress/plugin/theme update notifications for non-admins
function remove_core_updates() {
    if ( !current_user_can('update_core') ) {
        add_filter('pre_site_transient_update_core','remove_core_updates');
        add_filter('pre_site_transient_update_plugins','remove_core_updates');
        add_filter('pre_site_transient_update_themes','remove_core_updates');
    }
}
add_action('after_setup_theme','remove_core_updates');

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
    add_filter( 'rss2_item', 'feedContentFilter' );
  }

  return $query;
}
add_filter('pre_get_posts','feedFilter');

// Activating child theme tranlsations and namespace
function share_locale() {
    load_child_theme_textdomain( 'shareamerica', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'share_locale' );

function addUploadMimes($mimes) {

  $mimes = array_merge($mimes, array(
  'epub|mobi' => 'application/octet-stream'
  ));
  return $mimes;

}

add_filter('upload_mimes', 'addUploadMimes');

register_nav_menus( array(
  'sharefooter' => __( 'Footer Navigation', 'shareamerica' )
) );

function youtube_enable_js_api( $html, $url, $args ) {

    /* Modify video parameters. */
    if ( strstr( $html,'youtube.com/' ) ) {
        $html = str_replace( 'feature=oembed', 'feature=oembed&enablejsapi=1', $html );
    }

    return $html;
}
add_filter( 'embed_oembed_html', 'youtube_enable_js_api', 10, 3 );

/* Use the TD API to change the icon for template 12 and remove pull quote styles */
function hook_td_global_after() {
  td_api_single_template::update_key('single_template_12', 'img' , get_stylesheet_directory_uri() . '/images/panel/single_templates/single_template_12.png');
  td_api_tinymce_formats::delete('td_blockquote_1');
  td_api_tinymce_formats::delete('td_blockquote_2');
  td_api_tinymce_formats::delete('td_blockquote_6');
  td_api_tinymce_formats::delete('td_blockquote_7');
  td_api_tinymce_formats::delete('td_blockquote_8');
}
add_action('td_global_after','hook_td_global_after');

/* Enable excerpts for pages */
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

function remove_theme_scripts() {
  if ( is_page_template('template_blank_page_wide.php') || is_page_template('template_blank_page.php') ) {
    wp_dequeue_script( 'td-site' );
    wp_deregister_script( 'td-site' );
  }
}
add_action('wp_print_scripts', 'remove_theme_scripts', 100);


/**
 * Require badge generation class
 *
 * @since 3.0.6
 */
include( get_stylesheet_directory() . '/badge/class-america-badge-generation.php');

/**
 * Add attachment using the Formidable 'frm_notification_attachment' hook
 *
 * @since 3.0.6
 */

function share_add_attachment( $attachments, $form, $args ) {
	if ( $form->form_key == 'ytili_certificate' ) {

		$params = array (
			'key'				=>  $form->form_key,				// form identifier (i.e. project id used to find config)
			'metas'			=>  $args['entry']->metas		// formidable metas passed in via $args that hold field values
		);

		$generator = new America_Badge_Generation ();
    $attachments[] =  $generator->create_image( $params );
 }
  return $attachments;
}

// Formidable email hooks that enables adding attachments
add_filter( 'frm_notification_attachment', 'share_add_attachment', 10, 3 );

// Keep email subject from being encode twice
add_filter('frm_encode_subject', '__return_false');

/*
// Allow multiple consecutive submissions during image testing
add_filter( 'frm_time_to_check_duplicates', '__return_false' );
 */


 /**
   * Validate token data for Course
   *
   * @since 3.0.6
   */

 add_filter('frm_validate_entry', 'check_nonce', 20, 2);
 function check_nonce( $errors, $values ) {

   include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   $requiredplugin = 'wp-simple-nonce/wp-simple-nonce.php';

   if ( is_plugin_active($requiredplugin) ) {

     if( $values['form_key'] == 'ytili_certificate' ) {

       $result = WPSimpleNonce::checkNonce($_GET['tokenName'], $_GET['tokenValue']);

       if ( ! $result ) {
          $errors['my_error'] = 'This certificate page has expired. Please return to the quiz and complete it again to generate your certificate.';
       }

     }

   }

   return $errors;
 }

 /**
   * Send token data for Course
   *
   * @since 3.0.6
   */

 function localize_nonce() {

   include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   $requiredplugin = 'wp-simple-nonce/wp-simple-nonce.php';

   if ( is_plugin_active($requiredplugin) ) {
     global $post;

     if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'course' ) ) {
       $nonce = WPSimpleNonce::init( 'certificate', 2592000, true );
       wp_localize_script( 'share-js', 'token', $nonce );
     }
   }
 }

 add_action('wp_enqueue_scripts', 'localize_nonce');

function add_chartbeat_body_code() {

  if ( ! is_admin_bar_showing() ) {
    
    ?> 
      <!-- Chartbeat body tag -->
      <script type="text/javascript">
        (function() {
          var categoryList = dataLayer[0].pageCategory;
          var tagList = dataLayer[0].pageAttributes;
      
          if ( categoryList !== undefined && tagList !== undefined) {
            sectionList = categoryList.concat(tagList);
          } else if ( categoryList === undefined && tagList !== undefined ) {
            sectionList = tagList;
          } else if ( categoryList !== undefined && tagList === undefined ) {
            sectionList = categoryList;
          } else {
            sectionList = 'none';
          }
      
          var authorMeta = document.querySelector('meta[name="author"]');
      
          if ( authorMeta === null ) {
            author = 'none';
          } else {
            author = authorMeta.getAttribute("content");
          }
      
          /** CONFIGURATION START **/
          var _sf_async_config = window._sf_async_config = (window._sf_async_config || {});
          _sf_async_config.sections = sectionList;
          _sf_async_config.authors = author;
          var _cbq = window._cbq = (window._cbq || []);
          _cbq.push(['_acct', 'anon']);
          /** CONFIGURATION END **/
          function loadChartbeat() {
              var e = document.createElement('script');
              var n = document.getElementsByTagName('script')[0];
              e.type = 'text/javascript';
              e.async = true;
              e.src = '//static.chartbeat.com/js/chartbeat_video.js';;
              n.parentNode.insertBefore(e, n);
          }
          loadChartbeat();
        })();
      </script>
      <!-- End Chartbeat body tag -->
    <?php
  }
}

add_action('after_body_open_tag', 'add_chartbeat_body_code');

function add_chartbeat_head_code() {

  if ( ! is_admin_bar_showing() ) {
    
    ?>
      <!-- Chartbeat head tag -->
      <script type="text/javascript">
        (function() {
          /** CONFIGURATION START **/
          var _sf_async_config = window._sf_async_config = (window._sf_async_config || {});
          _sf_async_config.uid = 65772;
          _sf_async_config.domain = 'share.america.gov';
          _sf_async_config.useCanonical = true;
          _sf_async_config.useCanonicalDomain = true;
          /** CONFIGURATION END **/
        })();
      </script>

      <script async="true" src="//static.chartbeat.com/js/chartbeat_mab.js"></script>
      <!-- End Chartbeat head tag -->
    <?php
  }
}

add_action('wp_head', 'add_chartbeat_head_code');

// Adding Subscribe menu item
function new_nav_menu_items( $items, $args ) {
  
  if ( $args->theme_location == 'header-menu') {
    $subscribelink .= '<li class="menu-item-subscribe menu-item-subscribe-position menu-item"><a href="' . home_url( '/' ) . '">' . __('Subscribe') . '<i class="fa fa-envelope-open-o" aria-hidden="true"></i></a></li>';
  
    // add the home link to the end of the menu
    $items = $items . $subscribelink;
  }
  return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );

add_action( 'after_setup_theme', 'add_theme_posts_format_image', 11 );
function add_theme_posts_format_image(){
 add_theme_support( 'post-formats', array(
    'image',
    'video',
    ) );
}

// Remove canonical url from head
add_filter( 'wpseo_canonical', '__return_false' );

// Filter out edit from opengraph urls
function filter_edit_opengraph_url( $wpseo_frontend ) {
  $rewritten = str_replace ( 'share.edit', 'share', $wpseo_frontend );

  return $rewritten;
};

add_filter( 'wpseo_opengraph_url', 'filter_edit_opengraph_url', 10, 1 );
