<?php
/*  ----------------------------------------------------------------------------
    the author template
 */

get_header();




//set the template id, used to get the template specific settings
$template_id = 'tag';

//prepare the loop variables
global $loop_module_id, $loop_sidebar_position;
$loop_module_id = td_util::get_option('tds_' . $template_id . '_page_layout', 1); //module 1 is default
$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)

// sidebar position used to align the breadcrumb on sidebar left + sidebar first on mobile issue
$td_sidebar_position = '';
if($loop_sidebar_position == 'sidebar_left') {
	$td_sidebar_position = 'td-sidebar-left';
}

$current_tag_name = single_tag_title( '', false );

//Simple function to add a banner if Tag = Coronavirus
function coronavirus_banner($tag_name) {
    if ($tag_name === "coronavirus" || $tag_name === "冠状病毒") {
        ?>
        <div style="max-width:610px; min-height:46px; background:#d8e7f0; margin: 0 0 65px 0;">
            <div style="transform: translateY(50%); font-weight: bold; text-align: center;">
                <span><?php  _e('Latest news from the CDC on Coronavirus Disease 2019 (COVID-19)', 'covid-banner-text'); ?></span>
                <a href="https://www.cdc.gov/coronavirus/2019-ncov/index.html" style="color: black;">
                    <span style="vertical-align: middle; font-size: 20pt; padding-left: 8px;">
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                    </span>
                </a>
            </div>
        </div>
    <?php
    }
}

?>
<div class="td-main-content-wrap td-container-wrap">

    <div class="td-container <?php echo $td_sidebar_position; ?>">
        <div class="td-crumb-container">
            <?php echo td_page_generator::get_tag_breadcrumbs($current_tag_name);?>
        </div>
        <div class="td-pb-row">
            <?php
            switch ($loop_sidebar_position) {
                default:
                    ?>
                        <div class="td-pb-span8 td-main-content">
                            <div class="td-ss-main-content">
                                <div class="td-page-header">
                                    <h1 class="entry-title td-page-title">
                                        <span><?php echo __td('Tag', TD_THEME_NAME);?>: <?php echo $current_tag_name ?></span>
                                    </h1>
                                    <?php coronavirus_banner($current_tag_name); ?>
                                </div>
                                <?php
                                $td_tag_description = tag_description();
                                if (!empty($td_tag_description)) {
                                    echo '<div class="entry-content">';
                                    echo $td_tag_description;
                                    echo '</div>';
                                }
                                locate_template('loop.php', true);

                                echo td_page_generator::get_pagination();
                                ?>
                            </div>
                        </div>
                        <div class="td-pb-span4 td-main-sidebar">
                            <div class="td-ss-main-sidebar">
                                <?php get_sidebar(); ?>
                            </div>
                        </div>
                    <?php
                    break;

                case 'sidebar_left':
                    ?>
                    <div class="td-pb-span8 td-main-content <?php echo $td_sidebar_position; ?>-content">
                        <div class="td-ss-main-content">
                            <div class="td-page-header">
                                <h1 class="entry-title td-page-title">
                                    <?php /*<a itemprop="url" href="<?php echo get_tag_link(get_query_var('tag_id'));?>" rel="bookmark" title="<?php echo __td('Posts in ') . $current_tag_name?>">Tag: <?php echo $current_tag_name ?></a>*/?>
                                    <span><?php echo __td('Tag', TD_THEME_NAME);?>: <?php echo $current_tag_name ?></span>
                                </h1>
                                <?php coronavirus_banner($current_tag_name); ?>
                            </div>

                            <?php
                            $td_tag_description = tag_description();
                            if (!empty($td_tag_description)) {
                                echo '<div class="entry-content">';
                                echo $td_tag_description;
                                echo '</div>';
                            }
                            locate_template('loop.php', true);

                            echo td_page_generator::get_pagination();
                            ?>
                        </div>
                    </div>
	                <div class="td-pb-span4 td-main-sidebar">
		                <div class="td-ss-main-sidebar">
			                <?php get_sidebar(); ?>
		                </div>
	                </div>
                    <?php
                    break;

                case 'no_sidebar':
                    ?>
                    <div class="td-pb-span12 td-main-content">
                        <div class="td-ss-main-content">
                            <div class="td-page-header">
                                <h1 class="entry-title td-page-title">
                                    <?php /*<a itemprop="url" href="<?php echo get_tag_link(get_query_var('tag_id'));?>" rel="bookmark" title="<?php echo __td('Posts in ') . $current_tag_name?>"><?php echo $current_tag_name ?></a>*/?>
                                    <span><?php echo ucwords( $current_tag_name ) ?></span>
                                </h1>
                                <?php coronavirus_banner($current_tag_name); ?>
                            </div>
                            <?php

                            $td_tag_description = tag_description();
                            if (!empty($td_tag_description)) {
                                echo '<div class="entry-content">';
                                echo $td_tag_description;
                                echo '</div>';
                            }
                            locate_template('loop.php', true);

                            echo td_page_generator::get_pagination();
                            ?>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>
        </div> <!-- /.td-pb-row -->
    </div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php
get_footer();
?>