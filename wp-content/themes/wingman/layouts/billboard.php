<div id="billboard-<?php echo $block_count; ?>" class="component billboard billboard--<?php echo $block_count; ?> <?php echo($block_count == 1 ? 'first-block' : 'not-first-block'); ?> <?php echo(get_sub_field('should_rotate') ? 'slider' : 'no-slider'); ?>">
    <?php $board_count = 1; ?>
    <?php while ( have_rows('boards') ) : the_row(); ?>
        <div class="board board--<?php echo $board_count; ?>">
            <div class="board__content board__content--<?php echo get_sub_field('content_alignment'); ?>">
                <?php echo the_sub_field('content'); ?>
            </div>

            <div class="board__background board__background--<?php echo get_sub_field('color_overlay'); ?> <?php echo (get_sub_field('blur') == 'yes' ? 'board__background--blurred' : ''); ?>" style="background-image: url(<?php echo get_sub_field('background_image')['url']; ?>)"></div>
        </div>

        <?php $board_count++; ?>
    <?php endwhile; ?>
</div>

<?php if(get_sub_field('should_rotate') && count(get_sub_field('boards')) > 1): ?>
    <?php
        $slider = [
            'target' => '#billboard-'.$block_count
        ];
        wp_localize_script('slider', 'billboard', $slider);
        wp_enqueue_script('slider');
    ?>
<?php endif; ?>