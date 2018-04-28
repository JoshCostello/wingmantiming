<?php
//meet layout
get_header();

    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <header class="meet__header">
        <div class="meet__banner-background" style="background-image: url('<?php echo get_field('banner_background')['url']; ?>');"></div>
        <div class="meet__name-wrapper meet__name-wrapper--<?php echo get_field('overlay_color'); ?>">
            <h1 class="meet__name"><?php the_title(); ?></h1>
        </div>
    </header>

    <div class="meet__body meet__body--<?php echo(get_field('logo')['url'] ? 'has-logo' : 'no-logo'); ?> meet__body--<?php echo get_field('overlay_color'); ?>">
        <div class="meet__content meet__content--<?php echo(get_field('logo')['url'] ? 'has-logo' : 'no-logo'); ?>">
            <div class="meet__details meet__details--<?php echo get_field('overlay_color'); ?>">
                <div class="meet__logo">
                    <?php if(get_field('logo')['url']): ?>
                        <img class="meet__logo-image" src="<?php echo get_field('logo')['url']; ?>" />
                    <?php endif; ?>
                </div>

                <div class="meet__details-inner meet__details-inner--<?php echo get_field('overlay_color'); ?>">
                    <p>
                        <small class="meet__details--small">Dates</small>
                        <?php
                            $start_date = get_field('start_date');
                            $end_date = get_field('end_date');
                        ?>
                        <?php if($start_date == $end_date): ?>
                            <?php echo get_field('start_date'); ?>
                        <?php else: ?>
                            <?php echo get_field('start_date'); ?> &ndash; <?php echo get_field('end_date'); ?>
                        <?php endif; ?>
                    </p>
                    <p><small class="meet__details--small">Location</small>
                        <?php echo get_field('address')['address']; ?>
                    </p>

                    <ul class="meet__links-list">
                        <?php if(get_field('results')): ?>
                            <li class="meet__links-list-item">
                                <a href="<?php echo get_field('results'); ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Live Results</a>
                            </li>
                        <?php endif; ?>
                        <?php if(get_field('final_results')): ?>
                            <li class="meet__links-list-item">
                                <a href="<?php echo get_field('final_results')['url']; ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Final Results</a>
                            </li>
                        <?php endif; ?>
                        <?php if(get_field('heat_sheet')): ?>
                            <li class="meet__links-list-item">
                                <a href="<?php echo get_field('heat_sheet')['url']; ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Meet Program</a>
                            </li>
                        <?php endif; ?>
                        <?php if(get_field('meet_details')): ?>
                            <li class="meet__links-list-item">
                                <a href="<?php echo get_field('meet_details')['url']; ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Meet Details</a>
                            </li>
                        <?php endif; ?>
                        <?php if(get_field('website')): ?>
                            <li class="meet__links-list-item">
                                <a href="<?php echo get_field('website'); ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Meet Website</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="meet__map">
                <div class="meet__map-embed" id="map"></div>
            </div>
        </div>
    </div>

    <?php
        if(have_rows('components')) :
            $block_count = 2;
            while(have_rows('components')) : the_row();
                ACF_Layout::render(get_row_layout(), $block_count);
                $block_count++;
            endwhile;
        endif;
        endwhile; endif;
    ?>

<script>
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: <?php echo get_field('address')['lat']; ?>, lng: <?php echo get_field('address')['lng']; ?>},
      zoom: 14
    });
    var image = '<?php echo get_template_directory_uri()."/images/mark.svg"; ?>';
    var marker = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
      title: '<?php the_title(); ?>',
      icon: image,
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&callback=initMap" async defer></script>

<?php 
    get_footer();
?>
