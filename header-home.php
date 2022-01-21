<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/page-home.css" />
    <link
      rel="stylesheet"
      href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css"
    />
    <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/script.js" defer></script>
    <!-- WooCommerce Version -->
    <meta name="generator" content="WooCommerce 6.1.0" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="home-header">
      <div id="top-bar">
        <div class="ship-to">
          <span class="label">Shipping to:</span>
          <span class="location">United States</span>
        </div>
        <div class="site-language">
          <span>PT</span>
          <span class="current">EN</span>
        </div>
      </div>
      <div id="bottom-bar">
        <h1><a href="">Effusus</a></h1>
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
                <a href="<?php echo wc_get_cart_url(); ?>"><span class="lnr lnr-cart"></span></a>
                <?php 
                  $cart_count = WC() -> cart -> get_cart_contents_count();
                  if( $cart_count ) :
                ?>
                  <span class="count"><?php echo $cart_count ?></span>
                <?php endif; ?>
              </li>
              <li class="user-profile">
                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
                  ><img
                    src="https://64.media.tumblr.com/84675567022db3104c64ebf19b74b23a/5f6e58167639110c-9f/s400x600/8c4f1a359cc2faebb51b776707be2a6b47f65142.png"
                    alt=""
                /></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>