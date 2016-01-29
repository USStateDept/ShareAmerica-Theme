
<!-- Footer -->
<?php
if (td_util::get_option('tds_footer') != 'no') {
    td_api_footer_template::_helper_show_footer();
}
?>


<!-- Sub Footer -->
<?php if (td_util::get_option('tds_sub_footer') != 'no') { ?>
    <div class="td-sub-footer-container">
        <div class="td-container">
            <div class="td-pb-row">
                <div class="td-pb-span11 td-sub-footer-copy">
                                <?php
                                  // Hard coded the Footer and added it to the en_US.pot file because WPML String translation isn't finding it from the Theme Panel
                                  _e('This site is managed by the <a href="http://www.state.gov/r/iip">Bureau of International Information Programs</a> within the  <a href="http://www.state.gov">U.S. Department of State</a>. External links to other Internet sites should not be construed as an endorsement of the views or privacy policies contained therein.', 'shareamerica');
                        ?>
                </div>
                <?php /* scroll to top */?>
                <div class="td-pb-span1">
                    <div class="td-scroll-up"><i class="td-icon-menu-up"></i></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    </div><!--close content div-->
</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

</body>
</html>