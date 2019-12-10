<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 03.02.2015
 * Time: 10:05
 */

class td_module_mx11 extends td_module {

    function __construct($post, $module_atts = array()) {
        parent::__construct($post, $module_atts);
    }

    function render($order_no) {
        ob_start();
        $title_length = $this->get_shortcode_att('mx11_tl');
        $postID = get_post_format($this->post->ID); // Variable to get Post Format by Type
        $postFormat = ( ! $postID == "image" || ! $postID == "video" ? "standard" : $postID ); // Variable to determine whether to concat standard or post-format onto the created format class

        ?>

        <div class="<?php echo $this->get_module_classes(array("td-big-grid-post-$order_no", "td-big-grid-post", "td-medium-thumb", "post-format-$postFormat")); ?>"> <!-- Add class based on post format -->
            <?php
                echo $this->get_image('td_533x261');
            ?>
            <div class="td-meta-info-container">
                <div class="td-meta-align">
                    <div class="td-big-grid-meta">
                        <?php if (td_util::get_option('tds_category_module_mx11') == 'yes') { echo $this->get_category(); }?>
                        <?php echo $this->get_title($title_length);?>
                    </div>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}