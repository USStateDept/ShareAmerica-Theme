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
    add_filter('rss2_item', 'feedContentFilter');
  }

  return $query;
}
add_filter('pre_get_posts','feedFilter');

// Activating child theme tranlsations and namespace
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
