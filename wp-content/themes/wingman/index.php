<?php
//default page layout
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  if(have_rows('components')) :

    $block_count = 1;

    while(have_rows('components')) : the_row();

      ACF_Layout::render(get_row_layout(), $block_count);
      $block_count++;

    endwhile;

  endif;

endwhile; endif;

get_footer();
?>
