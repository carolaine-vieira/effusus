<?php get_header(); ?>

    <section id="main-section">
      <div id="single-post">
      <?php 
        if ( have_posts() ) {
          while ( have_posts() ) {
            the_post();          
            get_template_part( 'template-parts/content/single');
          }
        
          $args = array(
            'mid_size'           => 2,
            'prev_next'          => true,
            'prev_text'          => __('« Previous'),
            'next_text'          => __('Next »'),
          );
          the_posts_pagination($args); 

        } else {
          get_template_part( 'template-parts/content/content-none' );          
        }
      ?>    
      
        <div class="permalink-navigation">
          <?php
            the_post_navigation(array(
              'prev_text' => '<b>' . __('Previous:', 'twisted') . '</b> ' .
                  '<span class="screen-reader-text">' . __('Previous post:', 'twisted') . '</span> ' .
                  '<span class="post-title">%title</span>',
                  
              'next_text' => '<b>' . __('Next:', 'twisted') . '</b> ' .
                  '<span class="screen-reader-text">' . __('Next post:', 'twisted') . '</span> ' .
                  '<span class="post-title">%title</span>',
            ));
          ?>
        </div>
      </div>   
    </section>

<?php get_footer(); ?>
