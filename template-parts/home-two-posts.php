        <div class="product">
          <a href="single.html">
            <div class="product-image">              
              <img
                <?php
                  if( get_field('product_image') ) :
                    the_field('product_image');
                ?>
                src="<?php echo the_field("product_image"); ?>"
                <?php endif; ?>
                alt=""
              />
            </div>
            <div class="product-info">
              <span class="brand"><i>by</i> Effusus</span>
              <h3>Product name</h3>
              <span class="price">$ 129.99</span>
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