<?php


/*  ----------------------------------------------------------------------------
    WordPress booster framework - this is our theme framework - all the content and settings are there
    It is not necessary to include it in the child theme only if you want to use the API
*/
if (!defined('TD_THEME_WP_BOOSTER')) {
  include TEMPLATEPATH . '/includes/td_wordpres_booster.php';
}


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
function ssl_post_thumbnail_urls( $url, $post_id ) {
  //Skip file attachments
  if( !wp_attachment_is_image( $post_id ) ) {
    return $url;
  }

  //Correct protocol for https connections
  list( $protocol, $uri ) = explode( '://', $url, 2 );

  if( is_ssl() ) {
    if( 'http' == $protocol ) {
      $protocol = 'https';
    }
  } else {
    if( 'https' == $protocol ) {
      $protocol = 'http';
    }
  }

  return $protocol.'://'.$uri;
}

add_filter('wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2);
