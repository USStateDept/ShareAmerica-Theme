<?php
/*
  Template Name: Blank Landing Page
*/
?>
<html>
<head>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<title><?php wp_title( '|', true, 'right' ); bloginfo('url'); ?></title>
<?php wp_head(); ?>
</head>

<body>
<?php while (have_posts()) : the_post(); ?>
<div id="td-outer-wrap">
  <div class="td-main-content-wrap td-main-page-wrap">
    <div class="td-container">
      <?php the_content(); endwhile; ?>
    </div>
  </div>
</div>
</body>
</html>