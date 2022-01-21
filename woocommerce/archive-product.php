<?php get_header(); ?>

    <section id="main-section">
      <div id="content-info">
        <ul class="category">
          <li><?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?></li>
        </ul>
        <div class="filters">
          <label for="columns">View:</label>
          <select name="columns" id="columns-count">
            <option value="3">3 column</option>
            <option value="4">4 column</option>
            <option value="5">5 column</option>
          </select>

          <label for="order">Order by:</label>
          <select name="order" id="order">
            <option value="p-l-h">Price Low to High</option>
            <option value="p-h-l">Price High to Low</option>
            <option value="relevance">Relevance</option>
            <option value="date">Date</option>
          </select>
        </div>
      </div>

      <div id="products-section">
        <aside>
          <h2>Filtros</h2>
          <div class="box">

          </div>
        </aside>
        
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
      <a href="" class="previous">Previous</a>
      <div class="count">1 2 3 4 5 6 7 8 9 10 5369...</div>
      <a href="" class="next">Next</a>
    </div>

<?php get_footer(); ?>