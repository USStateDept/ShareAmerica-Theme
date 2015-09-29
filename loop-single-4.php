<?php
/**
 * The single post loop for post template 4
 **/

if (have_posts()) {
    the_post();

    $td_mod_single = new td_module_1($post);

    if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
        <p class="td-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
<?php
    }

    // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
    if (!empty(td_global::$load_featured_img_from_template)) {
        echo $td_mod_single->get_image(td_global::$load_featured_img_from_template);
    } else {
        echo $td_mod_single->get_image('featured-image');
    }
    ?>

        <div class="td-post-text-content">
    <div class="toprelated"><?php echo $td_mod_single->related_posts();?></div>
            <?php echo $td_mod_single->get_content();?>
        </div>

        <div class="td-social-sharing-xdiv">
            <?php echo $td_mod_single->get_social_sharing_bottom();?>
            <?php echo $td_mod_single->get_social_like_tweet();?>
        </div>



	<div class="tags-info3">
		<?php echo $td_mod_single->get_the_tags();?>
	</div>
	<!--div class="meta-info2">
		<span class="readrelatedto">Read more posts related to: </span> <?php echo $td_mod_single->get_category();?> 
        </div-->

        <div class="clearfix"></div>

        <footer>
            <?php echo $td_mod_single->get_post_pagination();?>
            <?php echo $td_mod_single->get_review();?>
            <?php echo $td_mod_single->get_source_and_via();?>
            <?php echo $td_mod_single->get_next_prev_posts();?>
            <?php //echo $td_mod_single->get_author();?>


        <?php echo $td_mod_single->get_item_scope_meta();?>
    </footer>

    <?php echo $td_mod_single->related_posts();?>

<?php
} else {
    //no posts
    echo td_page_generator::no_posts();
}