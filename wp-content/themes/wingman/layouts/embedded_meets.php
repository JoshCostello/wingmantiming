<div class="component embedded-meets embedded-meets--<?php echo the_sub_field('background'); ?>">

    <div class="embedded-meets__content embedded-meets__content--<?php echo the_sub_field('background'); ?> embedded-meets__content--<?php echo the_sub_field('arrangement'); ?>">
        <?php echo the_sub_field('content'); ?>
    </div>

    <div class="embedded-meets__meets embedded-meets__meets--<?php echo the_sub_field('display'); ?> embedded-meets__meets--content-<?php echo (get_sub_field('arrangement') == 'top' ? 'top' : 'even'); ?>">
        <?php 
            // args
            $args = array(
                'post_type'     => 'meet',
                'post_status'   => 'publish',
                'meta_key'      => 'start_date',
                'orderby'       => 'meta_value_num',
                'order'         => 'ASC',
            );

            switch (get_sub_field('which_meets')) {
                case 'all_year':

                    $year_start = get_sub_field('year') . '-01-01';
                    $year_end = get_sub_field('year') . '-12-31';

                    $args['posts_per_page'] = -1;
                    $args['meta_query'] = array(
                        array(
                            'key' => 'start_date',
                            'value' => array( date('Y-m-d', strtotime($year_start)), date('Y-m-d', strtotime($year_end)) ),
                            'type' => 'DATE',
                            'compare' => 'BETWEEN'
                        ),
                    );
                    break;

                case 'complete':
                    $args['posts_per_page'] = get_sub_field('to_show');
                    $args['meta_query'] = array(
                        array(
                            'key' => 'start_date',
                            'value' => date('Y-m-d'),
                            'type' => 'DATE',
                            'compare' => '<='
                        ),
                    );
                    break;

                case 'upcoming':
                    $args['posts_per_page'] = get_sub_field('to_show');
                    $args['meta_query'] = array(
                        array(
                            'key' => 'start_date',
                            'value' => date('Y-m-d'),
                            'type' => 'DATE',
                            'compare' => '>='
                        ),
                    );
                    break;
                
                default:
                    $args['posts_per_page'] = -1;
                    break;
            }

            if(get_sub_field('type') !== 'both') {
                $args['meta_query']['relation'] = 'AND';
                $args['meta_query'][] = array(
                        'key' => 'type',
                        'value' => get_sub_field('type'),
                        'compare' => '='
                );
            }

            $the_query = new WP_Query( $args );
        ?>
        <?php if($the_query->have_posts()): ?>
            <ol class="embedded-meets__list embedded-meets__list--<?php echo the_sub_field('background'); ?> embedded-meets__list--<?php echo the_sub_field('display'); ?>">
                <?php while( $the_query->have_posts() ): $the_query->the_post(); ?>
                    <?php setup_postdata( $post ); ?>
                    <li class="embedded-meet embedded-meet--<?php echo the_sub_field('background'); ?>">
                        <a  class="embedded-meet__link" href="<?php the_permalink(); ?>">
                            <div class="embedded-meet__logo">
                                <img src="<?php echo get_field('logo')['sizes']['thumbnail']; ?>"/>
                            </div>
                            <div class="embedded-meet__date">
                                <?php echo get_field('start_date'); ?>
                            </div>
                            <div class="embedded-meet__name">
                                <?php the_title(); ?>
                            </div>
                            <div class="embedded-meet__cta">
                                Details
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ol>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>