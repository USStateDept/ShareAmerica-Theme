<!doctype html >
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta name="google-site-verification" content="NDNB3oNz8Und1bThWM8mt3B0_fvwjeYta_cv_jp50Bo" />
    <?php
    wp_head(); /** we hook up in wp_booster @see td_wp_booster_functions::hook_wp_head */
    ?>
</head>

<!-- Track Page Refresh -->
<body onLoad="checkRefresh();" onUnload="prepareForRefresh();" <?php body_class() ?> itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WebPage">

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MCRX2G"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MCRX2G');</script>
<!-- End Google Tag Manager -->

<!-- Facebook Sidebar Share -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
window.twttr = (function (d, s, id) {
  var t, js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src= "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
  return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
}(document, "script", "twitter-wjs"));
</script>
<!-- End Facebook Sidebar Share -->

<?php //this is closing in the footer.php file ?>

<?php /* scroll to top */?>
<div class="td-scroll-up"><i class="td-icon-menu-up"></i></div>

<div id="td-outer-wrap">

    <div class="td-transition-content-and-menu td-mobile-nav-wrap">
        <?php locate_template('parts/menu-mobile.php', true);?>
    </div>

    <?php //this is closing in the footer.php file ?>
    <div class="td-transition-content-and-menu td-content-wrap">



<?php
td_api_header_style::_helper_show_header();

do_action('td_wp_booster_after_header'); //used by unique articles