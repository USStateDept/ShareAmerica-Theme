<?php

class td_module_10 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="td_mod6 td_mod_wrap <?php echo $this->get_no_thumb_class();?>" <?php echo $this->get_item_scope();?>>
        <?php echo $this->get_image('art-wide');?>

<?php echo '<a class="td-social-sharing-buttons td-social-facebook" href="https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink($this->post->ID)) . '?utm_source=sa&utm__medium=pfb-' . urlencode(date('Y-m-d')) . '" onclick="window.open(this.href, \'mywin\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><div class="td-sp td-sp-share-facebook"></div><div class="td-social-but-text">Share This</div></a><a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . $this->title . '&url=' . urlencode(get_permalink($this->post->ID)) . '?utm_source=sa&utm_medium=ptw-' . urlencode(date('Y-m-d')) . '&via=' . get_bloginfo('name'). '" onclick="window.open(this.href, \'mywin\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;" ><div class="td-sp td-sp-share-twitter"></div><div class="td-social-but-text">Tweet This</div></a>'; ?>


        <?php echo $this->get_title(td_util::get_option('tds_mod6_title_excerpt'));?>

        <div class="meta-info">
            <?php //echo $this->get_author();?>
            <?php echo $this->get_date();?>
            <?php echo $this->get_commentsAndViews();?>
        </div>

        <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}
