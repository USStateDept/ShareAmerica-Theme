
<!-- Instagram -->

<?php if (td_util::get_option('tds_footer_instagram') == 'show') { ?>

<div class="td-main-content-wrap td-footer-instagram-container td-container-wrap <?php echo td_util::get_option('td_full_footer_instagram'); ?>">
    <?php
    //get the instagram id from the panel
    $tds_footer_instagram_id = td_util::get_option('tds_footer_instagram_id');
    ?>

    <div class="td-instagram-user">
        <h4 class="td-footer-instagram-title">
            <?php echo  __td('Follow us on Instagram', TD_THEME_NAME); ?>
            <a class="td-footer-instagram-user-link" href="https://www.instagram.com/<?php echo $tds_footer_instagram_id ?>" target="_blank">@<?php echo $tds_footer_instagram_id ?></a>
        </h4>
    </div>

    <?php
    //get the other panel seetings
    $tds_footer_instagram_nr_of_row_images = intval(td_util::get_option('tds_footer_instagram_on_row_images_number'));
    $tds_footer_instagram_nr_of_rows = intval(td_util::get_option('tds_footer_instagram_rows_number'));
    $tds_footer_instagram_img_gap = td_util::get_option('tds_footer_instagram_image_gap');
    $tds_footer_instagram_header = td_util::get_option('tds_footer_instagram_header_section');

    //show the insta block
    echo td_global_blocks::get_instance('td_block_instagram')->render(
        array(
            'instagram_id' => $tds_footer_instagram_id,
            'instagram_header' => /*td_util::get_option('tds_footer_instagram_header_section')*/ 1,
            'instagram_images_per_row' => $tds_footer_instagram_nr_of_row_images,
            'instagram_number_of_rows' => $tds_footer_instagram_nr_of_rows,
            'instagram_margin' => $tds_footer_instagram_img_gap
        )
    );

    ?>
</div>

<?php } ?>


<!-- Footer -->
<?php
if (td_util::get_option('tds_footer') != 'no') {
    td_api_footer_template::_helper_show_footer();
}
?>


<!-- Sub Footer -->
<?php if (td_util::get_option('tds_sub_footer') != 'no') { ?>
    <div class="td-sub-footer-container td-container-wrap <?php echo td_util::get_option('td_full_footer'); ?>">
        <div class="td-container">
          <div class="td-pb-row">
              <div class="td-pb-span3 bottomMenu">
                  <?php wp_nav_menu( array( 'theme_location' => 'sharefooter' ) ); ?>
              </div>
              <div class="td-pb-span3 td-sub-footer-logo">
                  <a itemprop="url" href="<?php echo esc_url(home_url( '/' )); ?>"><img class="footer-logo" src="<?php echo( td_util::get_option('tds_logo_upload') ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" /></a>
              </div>
              <div class="td-pb-span6 td-sub-footer-copy">
                  <span>
                  <?php // Hard coded the Footer and added it to the en_US.pot file because WPML String translation isn't finding it from the Theme Panel
                      _e('This site is managed by the <a href="https://www.state.gov/bureaus-offices/under-secretary-for-public-diplomacy-and-public-affairs/bureau-of-global-public-affairs/">Bureau of Global Public Affairs</a> within the  <a href="http://www.state.gov">U.S. Department of State</a>. External links to other Internet sites should not be construed as an endorsement of the views or privacy policies contained therein.', 'shareamerica');
                  ?>
                  </span>
              </div>
              <?php /* scroll to top */?>
          </div>
        </div>
    </div>
<?php } ?>
</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

</body>
</html>
