<div class="component side-by-side-links <?php echo($block_count == 1 ? 'first-block' : ''); ?>">
    <?php while ( have_rows('links') ) : the_row(); ?>
        <?php
            if(get_sub_field('link_type') === 'internal') {
                $url = get_sub_field('internal_url');
            } else {
                $url = get_sub_field('external_url');
            }
        ?>
        <a href="<?php echo $url; ?>" class="side-by-side-link side-by-side-link--<?php echo get_sub_field('content_background_color'); ?>">
            <div class="side-by-side-link__content">
                <?php if(get_sub_field('link_title')): ?>
                    <p class="side-by-side-link__title"><?php echo the_sub_field('link_title'); ?></p>
                <?php endif; ?>
                <p class="side-by-side-link__text"><?php echo the_sub_field('description'); ?></p>
            </div>
            <div class="side-by-side-link__background" style="background-image: url('<?php echo get_sub_field('content_background_image')['url']; ?>');"></div>
        </a>
    <?php endwhile; ?>
</div>