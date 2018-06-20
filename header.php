<!doctype html >
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta name="google-site-verification" content="NDNB3oNz8Und1bThWM8mt3B0_fvwjeYta_cv_jp50Bo" />
    <meta name="google-site-verification" content="w-BsM3QtmROV10Xbx4BVJH-sCl8M1wE99XcS5cASHKg" />
    <?php
    wp_head(); /** we hook up in wp_booster @see td_wp_booster_functions::hook_wp_head */
    ?>
    <script async type="text/javascript" src="https://dap.digitalgov.gov/Universal-Federated-Analytics-Min.js?agency=DOS&siteplatform=ShareAmerica" id="_fed_an_ua_tag"></script>

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
</head>

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

<body <?php body_class() ?> itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WebPage">

    <?php locate_template('parts/menu-mobile.php', true);?>
    <?php locate_template('parts/search.php', true);?>


    <div id="td-outer-wrap" class="td-theme-wrap">
    <?php //this is closing in the footer.php file ?>

        <?php
        /*
         * loads the header template set in Theme Panel -> Header area
         * the template files are located in ../parts/header
         */
        td_api_header_style::_helper_show_header();

        do_action('td_wp_booster_after_header'); //used by unique articles
