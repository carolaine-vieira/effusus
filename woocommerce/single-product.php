<?php get_header(); ?>
    <?php 
      function format_single_product($id) {
        $product = wc_get_product($id);

        $gallery_ids = $product -> get_gallery_image_ids();
        $gallery = [];
        if($gallery_ids){
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
                data-gallery="main"
                src="<?php echo $product_obj['img']; ?>"
                alt="<?php echo $product_obj['name']; ?>"
              />                
            </div>
            <?php 
              if($product_obj['gallery']) : 
                echo "<div class='wrap' data-gallery='gallery'>";
                foreach($product_obj['gallery'] as $img) {
            ?>                    
                  <div class="gallery-item">
                    <img src="<?php echo $img ?>" alt="<?php echo $product_obj['name']; ?>" data-gallery="list">
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

            <!-- <div class="favorite-button">
              <a href=""><span class="lnr lnr-heart"></span></a>
            </div> -->
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

          <div class="">
            <?php woocommerce_template_single_add_to_cart(); ?>
          </div>
        </div>          

        <div class="product-recomendation">
          <h4>Related products</h4>
          <div class="list">
            <?php 
              $related_p = wc_get_related_products($product_obj['id'], 3); 

              function format_related_product($ids) {
                $treated_product = [];                                        

                foreach($ids as $id) {
                  $related = wc_get_product($id);                    
                  $treated_product[] = [
                    'img' => wp_get_attachment_image_src($related -> get_image_id(), 'full')[0],
                    'name' => $related -> get_name(),
                    'link' => $related -> get_permalink(),
                  ];                  
                }                                    

                return $treated_product;
              }

              if($related_p) :
                $related_products_list = format_related_product($related_p);
                foreach($related_products_list as $related) :
            ?>
                  <div class="related-product">
                    <a href="<?php echo $related['link']; ?>" target="_blank">
                      <img src="<?php echo $related['img']; ?>" alt="<?php echo $related['name']; ?>">
                    </a>
                  </div>
            <?php
                endforeach;
              endif;
            ?>                    
          </div>
        </div>
      </div>
    </section>

    <?php
        endwhile;
      endif;
    ?>
    
<?php get_footer(); ?>
    

