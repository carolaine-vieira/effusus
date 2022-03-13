<?php get_header(); ?>

    <section id="main-section">
      <div id="content-info">
        <div class="category">
          <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
        </div>
        <div class="filters">
          <?php woocommerce_catalog_ordering(); ?>
        </div>
      </div>

      <div id="products-section">
        <aside> <?php dynamic_sidebar( 'effusus-woo-archive-sidebar' ); ?> </aside>

        <div class="right-content">
          <div id="search-box"><?php effusus_products_search_box(); ?></div>                
          
          <?php 
            $products = [];
            if( have_posts() ) {
              echo '<div class="wrap">';

                while ( have_posts() ) {
                  the_post();
                  $id = get_the_ID();
                  $products[] = wc_get_product($id);      
                }
                effusus_common_product($products);

              echo '</div>';
            } else {
              get_template_part('/template-parts/content/empty');
            }
          ?>

          <?php if(get_the_posts_pagination()) : ?>
            <div id="navigation">
              <?php 
                $args = array(
                  'mid_size'           => 2,
                  'prev_next'          => true,
                  'prev_text'          => __('Previous'),
                  'next_text'          => __('Next'),
                );

                the_posts_pagination( array($args) ); 
              ?> 
            </div>
          <?php endif; ?>
        </div>

      </div>
    </section>    

<?php get_footer(); ?>