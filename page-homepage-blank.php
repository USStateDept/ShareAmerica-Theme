<?php
/* Template Name: Homepage - blank */

get_header();
?>


<!-- <div id="td-full-screen-header-image" class="td-big-slide-background" style="position: relative; z-index: 0; background: none repeat scroll 0% 0% transparent;">
    <div class="container">
        <div class="row">
            
        </div>
    </div>

</div> -->
<div id="td-full-screen-header-image" class="td-big-slide-background" style="position: relative; z-index: 0; background: none repeat scroll 0% 0% transparent;">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="td-grid-wrap">
                            <div class="container-fluid">

            <div class="row-fluid">
        <div class="span12 column_container">
            <div class=" td_block_wrap td_block_big_grid hometitlewhite"><?php the_title(); ?></div>
        </div>
      </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 582px; width: 1768px; z-index: -999998; position: absolute;"><img style="position: absolute; margin: 0px; padding: 0px; border: medium none; width: 1768px; height: 930.931px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -174.466px;" class="td-backstretch" src="/wp-content/uploads/2014/07/seattle.png">
    <video id="bgvid" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
      <source src="/wp-content/uploads/2014/09/SA_Banner-9_26.mp4" type="video/mp4">
      <source src="/wp-content/uploads/2014/09/VIDEO-SA_Banner_9_26.ogv" type="video/ogg">
      <source src="/wp-content/uploads/2014/09/VIDEO-SA_Banner_9_26.webm" type="video/webm">
    </video>
  </div>
</div>

<div class="td-main-page-wrap">
    <div class="td-container">
        <div class="td-pb-row">
            <div class="td-pb-span12 td-main-content" role="main" itemscope="itemscope" itemprop="mainContentOfPage" itemtype="<?php echo td_global::$http_or_https?>://schema.org/CreativeWork">

                <?php
                if (have_posts()) {
                    while ( have_posts() ) : the_post();
                    ?>
                    <div class="td-page-content">
                        <?php
                        the_content();
                            endwhile; //end loop
                        }
                        ?>
                    </div>
                    <?php
                    if($td_enable_or_disable_page_comments == 'show_comments') {
                        comments_template('', true);
                    }?>
                </div>
            </div> <!-- /.td-pb-row -->
        </div> <!-- /.td-container -->
    </div> <!-- /.td-main-content-wrap -->

    <?php
    get_footer();
