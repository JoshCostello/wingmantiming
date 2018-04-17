<?php
//meet layout
get_header();

    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <header class="meet__header meet__header--<?php echo(get_field('logo')['url'] ? 'has-logo' : 'no-logo'); ?>">
        <div class="meet__banner-background" style="background-image: url('<?php echo get_field('banner_background')['url']; ?>');"></div>
        <div class="meet__name-wrapper meet__name-wrapper--<?php echo get_field('overlay_color'); ?>">
            <h1 class="meet__name"><?php the_title(); ?></h1>
        </div>
    </header>

    <div class="meet__body meet__body--<?php echo(get_field('logo')['url'] ? 'has-logo' : 'no-logo'); ?> meet__body--<?php echo get_field('overlay_color'); ?>">
        <?php if(get_field('logo')['url']): ?>
            <div class="meet__logo meet__logo--<?php echo get_field('overlay_color'); ?>">
                <img src="<?php echo get_field('logo')['url']; ?>" />
            </div>
        <?php endif; ?>

        <div class="meet__content meet__content--<?php echo(get_field('logo')['url'] ? 'has-logo' : 'no-logo'); ?>">
            <div class="meet__details meet__details--<?php echo get_field('overlay_color'); ?>">
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
                            <a href="<?php echo get_field('final_results'); ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Final Results</a>
                        </li>
                    <?php endif; ?>
                    <?php if(get_field('heat_sheet')): ?>
                        <li class="meet__links-list-item">
                            <a href="<?php echo get_field('heat_sheet')['url']; ?>" class="meet__link meet__link--<?php echo get_field('overlay_color'); ?>">Heat Sheet</a>
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
    var image = {
        path: "M74.49239,43.2614642 C78.14864,44.0739629 80.911141,44.7645851 82.77989,45.3333344 C84.323641,45.7395828 85.298641,46.1052069 85.70489,46.4302068 C86.029891,46.5927058 86.19239,46.8364552 86.19239,47.161455 C86.19239,47.4864549 86.029891,47.7302043 85.70489,47.8927033 C85.298641,48.2177032 84.323641,48.5833273 82.77989,48.9895757 C80.911141,49.558325 78.14864,50.2489471 74.49239,51.0614458 L58.892389,53.0114412 L53.042389,54.9614366 L50.117389,54.9614366 L35.858014,72.9988941 L40.733014,72.9988941 C41.383013,72.9988941 41.972077,73.0598314 42.500201,73.1817061 C43.028326,73.3035808 43.292389,73.4863929 43.292389,73.7301423 C43.292389,73.9738918 43.028326,74.1567038 42.500201,74.2785785 C41.972077,74.4004533 41.383013,74.4613906 40.733014,74.4613906 L26.717389,74.4613906 L26.717389,72.9988941 L28.667389,72.9988941 L28.667389,53.0114412 L22.817389,53.0114412 L14.651763,62.7614182 L10.508013,62.7614182 L9.16738804,61.4207964 L9.16738804,53.0114412 L10.142388,53.0114412 L10.142388,51.0614458 L15.992388,51.0614458 L15.992388,50.6958217 L8.19238804,49.720824 L8.19238804,44.6020861 L15.992388,43.6270884 L15.992388,43.2614642 L10.142388,43.2614642 L10.142388,41.3114688 L9.16738804,41.3114688 L9.16738804,32.9021137 L10.508013,31.5614918 L14.651763,31.5614918 L22.817389,41.3114688 L28.667389,41.3114688 L28.667389,21.324016 L26.717389,21.324016 L26.717389,19.8615195 L40.733014,19.8615195 C41.383013,19.8615195 41.972077,19.9224568 42.500201,20.0443315 C43.028326,20.1662062 43.292389,20.3490183 43.292389,20.5927677 C43.292389,20.8365172 43.028326,21.0193292 42.500201,21.1412039 C41.972077,21.2630787 41.383013,21.324016 40.733014,21.324016 L35.858014,21.324016 L50.117389,39.3614734 L53.042389,39.3614734 L58.892389,41.3114688 L74.49239,43.2614642 Z",
        fillColor: '#3D4852',
        fillOpacity: 1,
        strokeWeight: 0,
        scale: 0.5,
        rotation: -45
    };
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
