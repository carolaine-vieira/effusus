        <div class="product">
          <a href="single.html">
            <div class="product-image">              
            <?php the_post_thumbnail( 'full' ); ?>
            </div>
            <div class="product-info">
              <span class="brand"><i>by</i> Effusus</span>
              <h3><?php the_title(); ?></h3>
              <span class="price">
                <?php 
                  $lang = get_locale();

                  if ( $lang == 'en' ) {
                    printf("$");
                  } else if ( $lang == 'pt' ) {
                    printf("R$");
                  } else {
                    printf("$");
                  }
                ?>
                <?php the_field("product_price"); ?>
              </span>
            </div>
          </a>
          <div class="buttons">
            <ul>
              <li class="add-to-cart">
                <a href=""><span class="lnr lnr-cart"></span></a>
              </li>
              <li class="add-to-favs">
                <a href=""><span class="lnr lnr-heart"></span></a>
              </li>
            </ul>
          </div>
        </div>