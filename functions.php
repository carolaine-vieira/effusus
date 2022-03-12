<?php

// Enqueue scripts and styles
function effusus_theme_scripts() {
  wp_enqueue_style('global template', get_template_directory_uri().'/assets/css/style.css', array(), '1.0', 'all');	
  wp_enqueue_style('linear icons', 'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css', array(), '1.0.0', 'all');
  wp_enqueue_script('global scripts', get_template_directory_uri().'/assets/js/script.js', array(), '1.0', 'all');  
  wp_enqueue_script('awesome icons', 'https://kit.fontawesome.com/eb5e14c15e.js', array(), '5.15', 'all');  
  // wp_enqueue_script('isotope masonry', 'https://npmcdn.com/isotope-layout@3.0.6/dist/isotope.pkgd.js', array(), '3.0.6', 'all');
}
add_action('wp_enqueue_scripts', 'effusus_theme_scripts');

// Twisted theme setup
if ( !function_exists('effusus_setup') ) {
  function effusus_setup() {
    // Adding theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('image'));
    add_theme_support('editor-styles');

    // Custom menus
    function register_my_menus() {
      register_nav_menus(
        array(
          'header-menu'          => __('Header Menu'),
          'footer-menu-1'        => __('Footer Menu 1'),
          'footer-menu-2'        => __('Footer Menu 2'),
          'woo-store-categories' => __('Store Categories')
        )
      );
    }
    add_action('init', 'register_my_menus');    

    // Translate
    $textdomain = 'effusus';
    load_theme_textdomain( $textdomain, get_stylesheet_directory().'/languages/');
    load_theme_textdomain( $textdomain, get_template_directory().'/languages/');    
  }
  add_action( 'after_setup_theme', 'effusus_setup' );
}

// Woocomerce support
add_action( 'after_setup_theme', 'effusus_setup_woocommerce_support' );
function effusus_setup_woocommerce_support() {
  add_theme_support('woocommerce');
}

// Another woocomerce add to cart button
// function custom_button_after_product_summary($product) {
//   global $product;
//   return $product->add_to_cart_url();
// }
// add_action( 'woocommerce_single_product_summary', 'custom_button_after_product_summary', 30 );

// Products custom post type
// function products_custom_post_type() {
//   register_post_type('product',
//     array(
//       'labels' => array(
//         'name'            => __('Products', 'effusus'),
//         'singular_name'   => __('Product', 'effusus'),              
//       ),
//       'public'            => true,
//       'has_archive'       => true,
//       'rewrite'           => array( 'slug' => 'product' ),
//       'menu_icon'         => 'dashicons-money-alt',
//       'taxonomies'        => array('category'),
//       'supports'          => array( 'title', 'thumbnail', 'author'),
//       'menu_position'     => 4,
//     )
//   );
// }
// add_action('init', 'products_custom_post_type');

// Slide custom post type
function slide_custom_post_type() {
  register_post_type('slide',
    array(
      'labels' => array(
        'name'            => __('Slides', 'effusus'),
        'singular_name'   => __('Slide', 'effusus'),              
      ),
      'public'            => true,
      'has_archive'       => true,
      'rewrite'           => array( 'slug' => 'slide' ),
      'menu_icon'         => 'dashicons-slides',
      'supports'          => array( 'title', 'thumbnail'),
      'menu_position'     => 5,
    )
  );
}
add_action('init', 'slide_custom_post_type');

// Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'effusus_new_loop_shop_per_page', 20 );

function effusus_new_loop_shop_per_page( $cols ) {
  $cols = 20;
  return $cols;
}

/* filter added to prevent automatic regeneration of thumbnail images and causing server hikes  */
add_filter( 'woocommerce_background_image_regeneration', '__return_false' );

// Create a basic form of Effusus Theme products
function effusus_format_commmon_products($products) {
  $products_final = [];
  foreach($products as $product){
    $products_final[] = [
      'name'        => $product -> get_name(),
      'price'       => $product -> get_price_html(),
      'link'        => $product -> get_permalink(),
      'img'         => wp_get_attachment_image_src($product -> get_image_id(), 'full')[0],
      'id'          => $product -> get_id(),
      'cart_link'   => $product -> add_to_cart_url(),
      'is_variable' => $product -> is_type('variable'),
    ];
  }
  return $products_final;
}

function effusus_common_product($products) {
  $products_final_version = effusus_format_commmon_products($products);

  foreach ($products_final_version as $product) { ?>

    <div class="product">
      <a href="<?php echo $product['link']; ?>">
        <div class="product-image">
          <img
            src="<?php echo $product['img']; ?>"
            alt="<?php echo $product['name']; ?>"
          />
        </div>
        <div class="product-info">
          <span class="brand"><i>by</i> Effusus</span>
          <h3><?php echo $product['name']; ?></h3>
          <span class="price"><?php echo $product['price']; ?></span>
        </div>
      </a>
      <div class="buttons">
        <ul>
          <li class="add-to-cart">               
            <a 
            href="<?php echo $product['cart_link']; ?>"
            >
              <span class="lnr lnr-cart"></span>
            </a>
          </li>
          <li class="add-to-favs">
            <a href=""><span class="lnr lnr-heart"></span></a>
          </li>
        </ul>
      </div>
    </div>

    <?php 
  } 
}

// Filter except length to 20 words
function effusus_custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'effusus_custom_excerpt_length', 999 );

// Effusus products search box
function effusus_products_search_box() {
  $shop_page_url = get_permalink( woocommerce_get_page_id('shop') );
  ?>
  <form action="<?php echo $shop_page_url; ?>" method="get" class="products-search-box">
    <input type="text" name="s" id="s" placeholder="<?php _e("Search", "effusus"); ?>" value="<?php the_search_query(); ?>">
    <input type="text" name="post_type" value="product" class="hidden">
    <button type="submit" id="searchbutton"><span class="lnr lnr-magnifier"></span></button>
  </form>
  <?php
}

// Get customer shipping location
function effusus_get_customer_shipping_location($user_id) {
  $customer = new WC_Customer( $user_id );
  $customer_address = [
    'city'    => $customer -> get_shipping_city(),
    'state'   => $customer -> get_shipping_state(),
    'country' => $customer -> get_shipping_country(),
  ];

  return $customer_address;
}

// Register Sidebars
function effusus_register_custom_sidebar() {
	$woo_archive_sidebar = array(
		'id'            => 'effusus-woo-archive-sidebar',
		'name'          => __('WooCommerce Store', 'effusus'),
		'description'   => __('Widgets to be displayed in the WooCommerce store page.', 'effusus'),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="box box-%2$s">',
		'after_widget'  => '</div>',
	);

  $blog_index = array(
		'id'            => 'effusus-blog-index-sidebar',
		'name'          => __('Blog Page', 'effusus'),
		'description'   => __('Widgets to be displayed in the Blog page.', 'effusus'),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="box box-%2$s">',
		'after_widget'  => '</div>',
	);

	register_sidebar( $woo_archive_sidebar );
  register_sidebar( $blog_index );
}
add_action( 'widgets_init', 'effusus_register_custom_sidebar' );

// // TGM Plugin Activation Class
// require_once locate_template('/lib/TGM-Plugin-Activation-2.6.1/class-tgm-plugin-activation.php');

// // Require Advanced Custom Fields Plugin
// function effusus_required_plugins() {
// 	$plugins = array(
// 		// Require ACF
// 		array(
// 			'name'     				    => 'Advanced Custom Fields', // The plugin name
// 			'slug'     				    => 'advanced-custom-fields', // The plugin slug (typically the folder name)
// 			'source'   				    => 'http://downloads.wordpress.org/plugin/advanced-custom-fields.zip', // The plugin source
// 			'required' 				    => true, // If false, the plugin is only 'recommended' instead of required
// 			'version' 				    => '5.11.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
// 			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
// 			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
// 			'external_url' 			  => '', // If set, overrides default API URL and points to an external URL
//     ),
//     array(
// 			'name'     				    => 'Classic Editor', // The plugin name
// 			'slug'     				    => 'classic-editor', // The plugin slug (typically the folder name)
// 			'source'   				    => 'http://downloads.wordpress.org/plugin/classic-editor.zip', // The plugin source
// 			'required' 				    => false, // If false, the plugin is only 'recommended' instead of required
// 			'version' 				    => '1.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
// 			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
// 			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
// 			'external_url' 			  => '', // If set, overrides default API URL and points to an external URL
//     ),
//     array(
// 			'name'     				    => 'Contact Form 7', // The plugin name
// 			'slug'     				    => 'contact-form-7', // The plugin slug (typically the folder name)
// 			'source'   				    => 'http://downloads.wordpress.org/plugin/contact-form-7.zip', // The plugin source
// 			'required' 				    => false, // If false, the plugin is only 'recommended' instead of required
// 			'version' 				    => '5.5.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
// 			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
// 			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
// 			'external_url' 			  => '', // If set, overrides default API URL and points to an external URL
//     )
// 	);

// 	$theme_text_domain = 'effusus';

// 	$config = array(
// 		'domain'       		  => $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
// 		'default_path' 		  => '',                         	// Default absolute path to pre-packaged plugins
// 		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
// 		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
// 		'menu'         		  => 'install-required-plugins', 	// Menu slug
// 		'has_notices'      	=> true,                       	// Show admin notices or not
// 		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
// 		'message' 			    => '',							// Message to output right before the plugins table
// 		'strings' => array(
// 			'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),
// 			'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),
// 			'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
// 			'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
// 			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
// 			'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
// 			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
// 			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
// 			'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
// 			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
// 			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
// 			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
// 			'install_link' 					  			  => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
// 			'activate_link' 				  			  => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
// 			'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),
// 			'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),
// 			'complete' 									      => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
// 			'nag_type'									      => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
// 		)
// 	);

// 	tgmpa( $plugins, $config );
// }
// add_action( 'tgmpa_register', 'effusus_required_plugins' );

// //Returns effusus Theme Configuration Page
// function effusus_config_page() {
//   global $effususConfigID;

//   $args = [
//     'post_type' => 'page',
//     'fields' => 'ids',
//     'nopaging' => true,
//     'meta_key' => '_wp_page_template',
//     'meta_value' => 'effusus-config.php'
//   ];
//   $pages = get_posts( $args );

//   empty($pages) ? $effususConfigID = 0 : $effususConfigID = $pages[0];  

//   return $effususConfigID;
// }

?>