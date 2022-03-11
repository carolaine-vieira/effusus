<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- WooCommerce Version -->
    <meta name="generator" content="WooCommerce 6.1.0" />
    <script
    type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
  ></script>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <div id="top-bar">
        <div class="ship-to">
          <?php 
            if( is_user_logged_in() ) :
              $ul = effusus_get_customer_shipping_location(get_current_user_id());     
              if( $ul['country'] ) :
          ?>
                <span class="label"><?php _e('Shipping to', 'effusus'); ?>:</span>              
          <span class="location">
            <?php            
              endif;

              $ul['country'] ? printf($ul['country']) : null; 
              $ul['state'] ? printf(', ' . $ul['state']) : null;
              $ul['city'] ? printf(', ' . $ul['city']) : null;
            ?>
          </span>
          <?php
            endif;
          ?>
        </div>
        <div class="site-language">
          <span>PT</span>
          <span class="current">EN</span>
        </div>
      </div>
      <div id="bottom-bar">
        <h1><a href="/"><?php bloginfo('name'); ?></a></h1>
        <div class="right-content">
          <nav>
            <button
              data-menu="button"
              aria-expanded="false"
              aria-controls="menu"
            >
              <span class="lnr lnr-menu"></span>
            </button>
            <ul data-menu="list" id="header-menu">
              <li><a href="">Kids</a></li>
              <li><a href="">Man</a></li>
              <li data-dropdown>
                <a href="#">Woman</a>
                <ol>
                  <div class="image">
                    <img
                      src="https://images.unsplash.com/photo-1637615212982-459337fd74c5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
                      alt=""
                    />
                  </div>

                  <div class="container">
                    <div class="box">
                      <span class="label">Dress</span>
                      <li><a href="">Acessories Item 1</a></li>
                      <li><a href="">Item 2</a></li>
                      <li><a href="">Item 3</a></li>
                      <li><a href="">Item 4</a></li>
                      <li><a href="">Item 5</a></li>
                    </div>

                    <div class="box">
                      <span class="label">T-shirt</span>
                      <li><a href="">Acessories Item 1</a></li>
                      <li><a href="">Item 2</a></li>
                      <li><a href="">Item 3</a></li>
                      <li><a href="">Item 4</a></li>
                      <li><a href="">Item 5</a></li>
                      <li><a href="">Item 2</a></li>
                      <li><a href="">Item 3</a></li>
                      <li><a href="">Item 4</a></li>
                      <li><a href="">Item 5</a></li>
                    </div>

                    <div class="box">
                      <span class="label">Skirts</span>
                      <li><a href="">Acessories Item 1</a></li>
                      <li><a href="">Item 2</a></li>
                      <li><a href="">Item 3</a></li>
                      <li><a href="">Item 4</a></li>
                      <li><a href="">Item 5</a></li>
                      <li><a href="">Item 2</a></li>
                      <li><a href="">Item 3</a></li>
                      <li><a href="">Item 4</a></li>
                      <li><a href="">Item 5</a></li>
                    </div>
                  </div>
                </ol>
              </li>
              <li><a href="">Acessories</a></li>
              <li><a href="">Bottom</a></li>
              <li><a href="">Top</a></li>
            </ul>
          </nav>

          <div class="header-admin-buttons">
            <ul>
              <li class="user-admin-link">
                <a href="/minha-conta/"><span class="lnr lnr-heart"></span></a>
              </li>
              <li class="cart-link">
                <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('My Account', 'effusus'); ?>">
                <span class="lnr lnr-cart"></span>
                <?php 
                  $cart_count = WC() -> cart -> get_cart_contents_count();
                  if( $cart_count ) :
                ?>
                  <span class="count"></span>
                <?php endif; ?>
                </a>                
              </li>
              <li class="user-profile">
              <?php 
                if( is_user_logged_in() ) { 
              ?>
                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account', 'effusus'); ?>">
                  <img src="<?php echo get_avatar_url( get_current_user_id() ); ?>" alt="<?php bloginfo( 'name' ) ?>" />
                </a>
              <?php } else { ?>
                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><span class="lnr lnr-user"></span></a>
              <?php } ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>