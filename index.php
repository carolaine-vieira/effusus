<?php get_header(); ?>
    <!-- <section id="main-slide" class="slide-container">
      <div class="slide-wrap">
        <div
          class="slide"
          style="
            background-image: url('https://images.unsplash.com/photo-1520006403909-838d6b92c22e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');
          "
        >
          <div class="container">
            <a href="">Week Sales</a>
          </div>
        </div>

        <div
          class="slide"
          style="
            background-image: url('https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80');
          "
        >
          <div class="container">
            <a href="">Week Sales</a>
          </div>
        </div>

        <div class="previous">
          <a><span class="lnr lnr-chevron-left"></span></a>
        </div>
        <div class="next">
          <a><span class="lnr lnr-chevron-right"></span></a>
        </div>
      </div>
    </section>

    <section id="recommended" class="slide-container">
      <h2>Recommended</h2>
      <div class="slide-wrap">
        <div
          class="slide active"
          style="
            background-image: url('https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=871&q=80');
          "
        >
          <div class="container">
            <a href="">Week Sales</a>
          </div>
        </div>

        <div
          class="slide"
          style="
            background-image: url('https://images.unsplash.com/photo-1475180098004-ca77a66827be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=386&q=80');
          "
        >
          <div class="container">
            <a href="">Week Sales</a>
          </div>
        </div>

        <div class="previous">
          <a><span class="lnr lnr-chevron-left"></span></a>
        </div>
        <div class="next">
          <a><span class="lnr lnr-chevron-right"></span></a>
        </div>
      </div>
    </section> -->

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