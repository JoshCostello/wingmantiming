<div class="component basic basic--<?php echo $block_count; ?> basic--bg-<?php echo get_sub_field('background'); ?> basic--fba-<?php echo get_sub_field('false_bottom_approach'); ?> <?php echo($block_count == 1 ? 'first-block' : ''); ?>">
    <div class="basic__content">
        <?php echo the_sub_field('content'); ?>
    </div>
</div>