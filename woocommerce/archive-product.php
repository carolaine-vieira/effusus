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
        <aside>
          <h2>Filtros</h2>
          <div class="box">
            <?php 
              wp_nav_menu(
                array( 
                  'theme_location' => 'woo-store-categories',
                  'menu_class'     => 'categories',
                )
              ); 
            ?>
          </div>
          <div class="box">
            <?php 
              $attribute_taxonomies = wc_get_attribute_taxonomies();

              foreach($attribute_taxonomies as $attribute) {
                the_widget('WC_Widget_Layered_Nav', [
                  'title' => $attribute -> attribute_label,
                  'attribute' => $attribute -> attribute_name,
                ]);
              }
            ?>
          </div>
          
          <div class="box">
            <form class="filtro-preco">
              <?php 
                isset($_GET['min_price']) ? $min = $_GET['min_price'] : $min = "";                
                isset($_GET['max_price']) ? $max = $_GET['max_price'] : $max = "";                
              ?>
              <div>
                <label for="min_price">De R$</label>
                <input type="number" name="min_price" id="min_price" value="<?php echo $min ?>" required>
              </div>
              <div>
                <label for="max_price">Até R$</label>
                <input type="number" name="max_price" id="max_price" value="<?php echo $max ?>" required>
              </div>
              <button type="submit">Filtrar</button>
            </form>
          </div>
        </aside>

        <div class="search-box">
        <?php effusus_products_search_box(); ?>
        </div>
        
        <?php 
          $products = [];
          if( have_posts() ) {
            while ( have_posts() ) {
              the_post();
              $id = get_the_ID();
              $products[] = wc_get_product($id);      
            }

            effusus_common_product($products);
          } else {
            printf("No posts found");
          }
        ?>
        
      </div>
    </section>

    <div id="navigation">
      <?php 
        $args = array(
          'mid_size'           => 2,
          'prev_next'          => true,
          'prev_text'          => __('Previous'),
          'next_text'          => __('Next'),
        );

        the_posts_pagination( array($args)
        ); 
      ?>
    </div>

<?php get_footer(); ?>