<?php 
// Template Name: Home

get_header('home');

?>

    <section id="home-main-section">
      <div class="left-container">
        <h1>Et harum quidem rerum facilis est et expedita distinctio</h1>
        <div class="bottom">
          <div class="search-box">
            <form action="<?php bloginfo('url'); ?>/loja/" method="get">
              <input type="text" name="s" id="s" placeholder="Buscar" value="<?php the_search_query(); ?>">
              <input type="text" name="post_type" value="product" class="hidden" style="display: none;">
              <input type="submit" id="searchbutton" value="Buscar">
            </form>
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
          $two_products = wc_get_products([
            'limit' => 2,
            // 'meta_key' => 'total_sales',
            // 'orderby' => 'meta_value_num',
            'order' => 'DESC',
          ]);

          effusus_common_product($two_products);
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
    </section>

    <section id="blog">
      <div class="wrap">
        <div
          class="post active"
          style="
            background-image: url('http://eky.hk/upload/file/png61e4c08f96a83.png');
          "
        >
          <div class="container">
            <div class="info">
              <h2>Et harum quidem rerum facilis est et expedita distinctio</h2>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi
                pariatur dolore ad quos aperiam tenetur nihil rem adipisci sint,
                quae aut fuga, quisquam earum. At, voluptatum. Dicta nisi nulla
                dolore?
              </p>
              <a href="">View</a>
            </div>
          </div>
        </div>

        <div
          class="post"
          style="
            background-image: url('https://images.unsplash.com/photo-1475180098004-ca77a66827be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=386&q=80');
          "
        >
          <div class="container">
            <div class="info">
              <h2>Et harum quidem rerum facilis est et expedita distinctio</h2>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi
                pariatur dolore ad quos aperiam tenetur nihil rem adipisci sint,
                quae aut fuga, quisquam earum. At, voluptatum. Dicta nisi nulla
                dolore?
              </p>
              <a href="">View</a>
            </div>
          </div>
        </div>

        <div
          class="post"
          style="
            background-image: url('https://images.unsplash.com/photo-1475180098004-ca77a66827be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=386&q=80');
          "
        >
          <div class="container">
            <div class="info">
              <h2>Et harum quidem rerum facilis est et expedita distinctio</h2>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi
                pariatur dolore ad quos aperiam tenetur nihil rem adipisci sint,
                quae aut fuga, quisquam earum. At, voluptatum. Dicta nisi nulla
                dolore?
              </p>
              <a href="">View</a>
            </div>
          </div>
        </div>

        <div class="read-more">
          <a href="">Read More<span class="lnr lnr-arrow-right"></span></a>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
