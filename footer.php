    <section id="contact">
      <div class="left-container">
        <img src="http://eky.hk/upload/file/png61e5e77d3b200.png" alt="" />
      </div>
      <div class="right-container">
        <div class="container">
          <h2>Subscribe to our newsletter</h2>
          <input type="text" name="" id="" placeholder="Name" />
          <input type="email" name="" id="" placeholder="Email" />
          <input type="submit" value="Send" />
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="site-info">
          <h2><?php bloginfo('name'); ?></h2>
        </div>
        <?php if( has_nav_menu('footer-menu-1') || has_nav_menu('footer-menu-2') ) : ?>
        <div class="links">
          <?php 
            $menu_locations = get_nav_menu_locations(); 

            if( has_nav_menu('footer-menu-1') ) :
              $effusus_menu_1 = wp_get_nav_menu_object($menu_locations['footer-menu-1']) -> name;
              
              echo '<div class="footer-links">';
                echo '<span class="label">' . $effusus_menu_1 . '</span>';
                wp_nav_menu(
                  array( 
                    'theme_location' => 'footer-menu-1',
                    'menu_class'     => 'footer-menu',
                  )
                ); 
              echo '</div>';
            endif;
           
            if( has_nav_menu('footer-menu-2') ) :
              $effusus_menu_2 = wp_get_nav_menu_object($menu_locations['footer-menu-2']) -> name;
              
              echo '<div class="footer-links">';
                echo '<span class="label">' . $effusus_menu_2 . '</span>';
                wp_nav_menu(
                  array( 
                    'theme_location' => 'footer-menu-2',
                    'menu_class'     => 'footer-menu',
                  )
                ); 
              echo '</div>';
            endif;
          ?>
        </div>
        <?php endif; ?>
        <div class="payment-methods">
          <h3>Payment</h3>
        </div>
      </div>
      <div class="bottom-bar">
        <span class="since">&copy; All rights reserved &mdash; <?php echo date('Y'); ?></span>
        <span class="credit">Developed <i>by</i> Carolaine Vieira</span>
      </div>
    </footer>

    <a href="#first-section" id="scroll-top" title="<?php _e("Scroll back to top", "twisted") ?>"><i class="fas fa-chevron-up"></i></a>

    <?php wp_footer(); ?>
  </body>
</html>