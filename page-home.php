<?php 
// Template Name: Home

get_header('home');

?>

    <section id="home-main-section">
      <div class="left-container">
        <h1>Et harum quidem rerum facilis est et expedita distinctio</h1>
        <div class="bottom">
          <div class="search-box">
            <?php effusus_products_search_box(); ?>
          </div>
          <div class="links">
            <ul>
              <li class="log-in"><a href="/minha-conta/">Log In</a></li>
              <li class="best-sellers"><a href="">Best Sellers</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="right-container">
       <?php
          $last_products = wc_get_products([
            'limit' => 2,
            'order' => 'DESC'
          ]);

          effusus_common_product($last_products);
        ?>
      </div>
    </section>

    <section id="slide-one">
      <div class="content">
        <div class="slide-wrap">
          <?php 
            $args = array(
              'post_type' => 'slide',
            );
            $query = new WP_Query($args);
      
            if( $query -> have_posts() ) :      
              while ($query -> have_posts()) :
                $query -> the_post();
                get_template_part('template-parts/other/slide-one');
              endwhile;
            endif;

            wp_reset_postdata();
          ?>          
        </div>
      </div>
    </section>

    <section id="best-sellers">
      <div class="left-container">
        <div class="container">
          <h2><span>Best Sellers</span></h2>          
          <p>
            Temporibus autem quibusdam et aut officiis debitis aut rerum
            necessitatibus saepe eveniet ut et voluptatesrepellat.
          </p>
          <a href="">View All</a>
        </div>
      </div>
      <div class="right-container">
        <div class="block-left">
        <?php
          $products_sales = wc_get_products([
            'limit' => 1,
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
          ]);

          effusus_common_product($products_sales);
        ?>

        </div>

        <div class="block-right">
          <?php
            $products_sales = wc_get_products([
              'limit' => 5,
              'meta_key' => 'total_sales',
              'orderby' => 'meta_value_num',
              'order' => 'DESC'
            ]);

            effusus_common_product($products_sales);
          ?>
        </div>
      </div>
    </section>

    <section id="blog">
      <div class="wrap">
        <?php
          $args = array(
            'post_type' => 'post',
            'order' => 'DESC',
            'posts_per_page' => 3,
          );
          $query = new WP_Query($args);

          if( $query -> have_posts() ) :      
            while ( $query -> have_posts() ) :
              $query -> the_post();
              get_template_part('template-parts/other/page-home-blog');
            endwhile;
          else:
            printf("No posts reached");
          endif;

          wp_reset_postdata();
        ?>        
      </div>
      
      <div class="read-more">
        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php _e('Read More'); ?><span class="lnr lnr-arrow-right"></span></a>
      </div>
    </section>

<?php get_footer(); ?>
