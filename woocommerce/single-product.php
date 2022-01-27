<?php get_header(); ?>

    <?php 
      function format_single_product($id) {
        $product = wc_get_product($id);

        $gallery_ids = $product -> get_gallery_image_ids();
        $gallery = [];
        if($gallery_ids){
          $gallery[] = wp_get_attachment_image_src($product -> get_image_id(), 'full')[0];
          foreach($gallery_ids as $img_id){
            $gallery[] = wp_get_attachment_image_src($img_id, 'full')[0];
          }
        }

        return [
          'img'         => wp_get_attachment_image_src($product -> get_image_id(), 'full')[0],
          'name'        => $product -> get_name(),
          'price'       => $product -> get_price_html(),
          'link'        => $product -> get_permalink(),
          'id'          => $product -> get_id(),
          'cart_link'   => $product -> add_to_cart_url(),
          'sku'         => $product -> get_sku(),
          'description' => $product -> get_description(),
          'gallery'     => $gallery,
        ];
      }
    ?>

    <div id="effusus-single">
      <?php 
        if( have_posts() ) :
          while( have_posts() ) :
            the_post();     
            $product_obj = format_single_product(get_the_ID());
      ?>

      <div id="shop-notifications">
        <?php wc_print_notices(); ?>
      </div>

      <section id="main-section">
        <div id="content-info">
          <div class="category">
          <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
          </div>
          <span class="model"><?php echo $product_obj['sku']; ?></span>
        </div>

        <div id="products-section">
          <div id="products">
            <div class="product-single">
              <div class="product-image">
                <img
                  src="<?php echo $product_obj['img']; ?>"
                  alt="<?php echo $product_obj['name']; ?>"
                />                
              </div>
              <?php 
                if($product_obj['gallery']) : 
                  echo "<div class='wrap'>";
                  foreach($product_obj['gallery'] as $img) {
              ?>                    
                    <div class="gallery-item">
                      <img src="<?php echo $img ?>" alt="">
                    </div>                 
              <?php                                      
                  }
                  echo "</div>";
                endif; ?>
            </div>
          </div>

          <div class="product-buttons">
            <div class="top-content">
              <div class="product-info">
                <span class="name"><?php echo $product_obj['name']; ?></span>
                <span class="price"><?php echo $product_obj['price']; ?></span>
                <a href="" class="reviews">29 reviews</a>
              </div>

              <div class="favorite-button">
                <a href=""><span class="lnr lnr-heart"></span></a>
              </div>
            </div>

            <div class="size">
              <h2>Size</h2>
              <ul>
                <li><a href="" class="active">S</a></li>
                <li><a href="">M</a></li>
                <li><a href="">X</a></li>
                <li><a href="">XX</a></li>
                <li><a href="">XXX</a></li>
                <li><a href="">XXXX</a></li>
              </ul>
            </div>
          </div>          

          <div class="product-recomendation">
            <h4>Also bought with</h4>
            <a href=""
              ><img
                src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1472&q=80"
                alt=""
            /></a>

            <a href=""
              ><img
                src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1472&q=80"
                alt=""
            /></a>

            <a href=""
              ><img
                src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1472&q=80"
                alt=""
            /></a>

            <a href=""
              ><img
                src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1472&q=80"
                alt=""
            /></a>
          </div>
        </div>
      </section>

      <?php
          endwhile;
        endif;
      ?>
      
      <?php get_footer(); ?>
    </div>

