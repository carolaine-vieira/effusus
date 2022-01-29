<?php get_header(); ?>

    <section id="main-section">
      <div class="wrap">        
        <?php 
          if ( have_posts() ) {
            while ( have_posts() ) {
              the_post();          
              if (in_array('blog', get_body_class())) {
                get_template_part('template-parts/other/home-blog-post');
              } else {
                get_template_part('template-parts/content/content');
              }              
            }
          } else {
            get_template_part( 'template-parts/content/content-none' );          
          }
        ?>        
      </div>
    </section>

    <?php
      if (in_array('blog', get_body_class())) :
    ?>
      <div id="navigation">
        <?php
          $args = array(
            'mid_size'           => 2,
            'prev_next'          => true,
            'prev_text'          => __('Previous'),
            'next_text'          => __('Next'),
          );
          the_posts_pagination($args);       
        ?>
      </div>
    <?php
        endif;
    ?>

<?php get_footer(); ?>