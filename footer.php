<?php // show the footer
if (td_util::get_option('tds_footer') != 'hide') { ?>
    <div class="td-footer-wrap">
        <div class="container">
            <div class="row">
                <?php
                $tds_footer_widget_cols = td_util::get_option('tds_footer_widget_cols');

                //reset global columns
                global $td_row_count, $td_column_count;
                $td_row_count = 1;

                switch ($tds_footer_widget_cols) {
                    case '23-13':

                        ?>

                        <div class="span12">
                            <div class="td-grid-wrap">
                                <div class="container-fluid">
                                    <div class="wpb_row row-fluid ">
                                        <div class="span8 wpb_column column_container">
                                            <?php
                                            $td_column_count = '2/3'; //2 cols widget
                                            dynamic_sidebar('Footer 1')
                                            ?>
                                        </div>

                                        <div class="span4 wpb_column column_container">
                                            <?php
                                            $td_column_count = '1/3'; //1 col widget
                                            dynamic_sidebar('Footer 2')
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        break;

                    case '13-23':
                        ?>

                        <div class="span12">
                            <div class="td-grid-wrap">
                                <div class="container-fluid">
                                    <div class="wpb_row row-fluid ">
                                        <div class="span4 wpb_column column_container">
                                            <?php
                                            $td_column_count = '1/3'; //1 col widget
                                            dynamic_sidebar('Footer 1')
                                            ?>
                                        </div>
                                        <div class="span8 wpb_column column_container">
                                            <?php
                                            $td_column_count = '2/3'; //2 cols widget
                                            dynamic_sidebar('Footer 2')
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        break;

                    case '33':
                        $td_column_count = '1/1'; //3 cols widget
                        ?>

                        <div class="span12">
                            <div class="td-grid-wrap">
                                <div class="container-fluid">
                                    <div class="wpb_row row-fluid ">
                                        <div class="span12 wpb_column column_container">
                                            <?php dynamic_sidebar('Footer 1')?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        break;

                    default:
                        $td_column_count = '1/3'; //1 col widget - all!
                        ?>

                            <div class="span12">
                                <div class="td-grid-wrap">
                                    <div class="container-fluid">
                                        <div class="wpb_row row-fluid ">
                                            <div class="span4 wpb_column column_container">
                                                <?php dynamic_sidebar('Footer 1')?>
                                            </div>

                                            <div class="span4 wpb_column column_container">
                                                <?php dynamic_sidebar('Footer 2')?>
                                            </div>
                                            <div class="span4 wpb_column column_container">
                                                <?php dynamic_sidebar('Footer 3')?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        break;


                }
                ?>
            </div>
        </div>
    </div> <!-- /.td-footer-wrap  -->
<?php } ?>


<?php // show the sub-footer
if (td_util::get_option('tds_sub_footer') != 'hide') { ?>

<div class="td-sub-footer-wrap">
    <div class="container ">
        <div class="row">
            <div class="span12">
                <div class="td-grid-wrap">
                    <div class="container-fluid">
                        <div class="row-fluid ">
                            <div class="span12 td-sub-footer-copy">
                                <?php
                                  // Hard coded the Footer and added it to the en_US.pot file because WPML String translation isn't finding it from the Theme Panel
                                  _e('This site is managed by the <a href="http://www.state.gov/r/iip">Bureau of International Information Programs</a> within the  <a href="http://www.state.gov">U.S. Department of State</a>. External links to other Internet sites should not be construed as an endorsement of the views or privacy policies contained therein.', 'shareamerica');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

</div>
<!--/#inner-wrap-->
</div>
<!--/#outer-wrap-->

<div class="td-sp td-scroll-up"></div>

<?php
//echo '<div style="position:fixed; top:100px; left:10px; z-index=9999">' . get_permalink() . '</div>';
//add the comments reply to script on single pages
if (is_singular()) {
    wp_enqueue_script('comment-reply');
}
wp_footer();


/**
 * AJAX POST VIEW COUNT
 * has to be after wp_footer();
 */
if(td_util::get_option('tds_ajax_post_view_count') == 'enabled') {

    //Ajax get & update counter views
    if(is_single()) {
        //echo 'post page: '.  $post->ID;
        if($post->ID > 0) {
            echo '
            <script language="javascript">
                td_ajax_count.td_get_views_counts_ajax("post",' . json_encode('[' .$post->ID . ']') . ');
            </script>
            ';
        }
    } else {
        if(count(td_unique_posts::$rendered_posts_ids) > 0) {
            $td_post_id_on_page = array_unique(td_unique_posts::$rendered_posts_ids);
            //print_r($td_post_id_on_page);

            //creating the array of id's that will be passed to ajax
            $td_param_for_js = '';
            foreach($td_post_id_on_page as $unique_post_id) {

                if(!empty($td_param_for_js)) {
                    $td_param_for_js .= ', ';
                }
                $td_param_for_js .= $unique_post_id;
            }

            $td_param_for_js = '[' . $td_param_for_js . ']';

            echo '
            <script language="javascript">
                td_ajax_count.td_get_views_counts_ajax("page",' . json_encode($td_param_for_js) . ');
            </script>
            ';
        }

    }
}
?>
</body>
</html>
