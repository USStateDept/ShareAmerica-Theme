<?php
// Template 8  -post-final-8.psd
//get the global sidebar position from td_single_template_vars.php

locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_sidebar_position, $td_sidebar_position, $post;

$td_mod_single = new td_module_single($post);
$featured_image_id = get_post_thumbnail_id($post->ID);
$featured_image_info = td_util::attachment_get_full_info($featured_image_id, $thumbType);

?>
<article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class('td-post-template-8'));?>" <?php echo $td_mod_single->get_item_scope();?>>
<?php 
    $heading_shift_value = get_post_meta( $post->ID, "_add_heading_title_shift", true );
    if ($heading_shift_value) { ?>
        <style>
            .td-post-template-8 .header-contain {
                background: white;
                width: 100%;
            }

            .td-post-template-8 .wp-caption-text {
                padding-left: 48px;
            }

            .td-post-template-8 .td-post-title {
                width: 100%;
            }

/*             .td-post-template-8 .td-post-header-holder {
                padding: 20px 0 !important;
            } */

            .td-post-template-8 .td-post-title, .td-post-title .entry-title, .td-post-title .td-post-author-name, .td-post-title .td-author-line, .td-post-title .td-post-date, .td-post-title a {
                color: black !important;
            }
        </style>

        <div class="td-post-header td-image-gradient-style8">
            <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>
        </div>

        <div class="td-container header-contain">
            <div class="wp-caption-text">
                <?php echo $featured_image_info['caption'];?>
            </div>
            <div class="td-post-header-holder">
                <header class="td-post-title">
                    <?php echo $td_mod_single->get_category(); ?>
                    <?php echo $td_mod_single->get_title();?>

                    <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                        <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle']; ?></p>
                    <?php } ?>

                    <div class="td-module-meta-info">
                        <?php echo $td_mod_single->get_author();?>
                        <?php echo $td_mod_single->get_date(false);?>
                        <?php echo $td_mod_single->get_views();?>
                        <?php echo $td_mod_single->get_comments();?>
                    </div>
                </header>
            </div>
        </div>

        <div class="td-post-template-8-box">
        <div class="td-container">

<?php } else { ?>
    <div class="td-post-header td-image-gradient-style8">
        <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>
        <div class="td-post-header-holder">
            <header class="td-post-title">
                <?php echo $td_mod_single->get_category(); ?>
                <?php echo $td_mod_single->get_title();?>

                <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                    <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle']; ?></p>
                <?php } ?>

                <div class="td-module-meta-info">
                    <?php echo $td_mod_single->get_author();?>
                    <?php echo $td_mod_single->get_date(false);?>
                    <?php echo $td_mod_single->get_views();?>
                    <?php echo $td_mod_single->get_comments();?>
                </div>
            </header>
        </div>
    </div>

    <div class="td-post-template-8-box">
        <div class="td-container">
            <div class="wp-caption-text">
                <?php echo $featured_image_info['caption'];?>
            </div>
<?php } ?>
            <div class="td-pb-row">
                <?php

                //the default template
                switch ($loop_sidebar_position) {
                    default:
                        ?>
                            <div class="td-pb-span8 td-main-content" role="main">
                                <div class="td-ss-main-content">
                                    <?php
                                    locate_template('loop-single-8.php', true);
                                    comments_template('', true);
                                    ?>
                                </div>
                            </div>
                            <div class="td-pb-span4 td-main-sidebar" role="complementary">
                                <div class="td-ss-main-sidebar">
                                    <?php get_sidebar(); ?>
                                </div>
                            </div>
                        <?php
                        break;

                    case 'sidebar_left':
                        ?>
                        <div class="td-pb-span8 td-main-content <?php echo $td_sidebar_position; ?>-content" role="main">
                            <div class="td-ss-main-content">
                                <?php
                                locate_template('loop-single-8.php', true);
                                comments_template('', true);
                                ?>
                            </div>
                        </div>
                        <div class="td-pb-span4 td-main-sidebar" role="complementary">
                            <div class="td-ss-main-sidebar">
                                <?php get_sidebar(); ?>
                            </div>
                        </div>
                        <?php
                        break;

                    case 'no_sidebar':
                        ?>
                        <div class="td-pb-span12 td-main-content" role="main">
                            <div class="td-ss-main-content">
                                <?php
                                locate_template('loop-single-8.php', true);
                                comments_template('', true);
                                ?>
                            </div>
                        </div>
                        <?php
                        break;

                }
                ?>
            </div> <!-- /.td-pb-row -->
        </div> <!-- /.td-container -->
    </div> <!-- /.td-post-template-8-box -->
</article> <!-- /.post -->

<?php

get_footer();
