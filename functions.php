<?php

/**
 *? enqueue theme setups
 * 
 */
function organi_setup()
{
   load_theme_textdomain('organi', get_template_part('/languages'));
   add_theme_support('title-tag');
   add_theme_support('post-thumbnails');
   register_nav_menus(array(
      'main-menu' => __('Main menu', 'organi')
   ));
   add_theme_support('woocommerce');
}
add_action('after_setup_theme',  'organi_setup');
/**
 * ?enqueue scripts and styles
 * 
 */
function organi_enqueue_scripts()
{
   // ?enqueue-styles
   wp_enqueue_style('google-font', '//fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap', array(), '1.0.0', 'all');
   wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', 'all');
   wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0.0', 'all');
   wp_enqueue_style('elegant-icons', get_template_directory_uri() . '/css/elegant-icons.css', array(), '1.0.0', 'all');
   wp_enqueue_style('nice-select', get_template_directory_uri() . '/css/nice-select.css', array(), '1.0.0', 'all');
   wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui.min.css', array(), '1.0.0', 'all');
   wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '1.0.0', 'all');
   wp_enqueue_style('slicknav.min.css', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.0.0', 'all');
   wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');
   wp_enqueue_style('style-name', get_stylesheet_uri());

   //? enqueue scripts
   wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true);
   wp_enqueue_script('nice-js', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array('jquery'), '1.0.0', true);
   wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.0.0', true);
   wp_enqueue_script('slicknav-js', get_template_directory_uri() . '/js/jquery.slicknav.js', array('jquery'), '1.0.0', true);
   wp_enqueue_script('mixitup-js', get_template_directory_uri() . '/js/mixitup.min.js', array('jquery'), '1.0.0', true);
   wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.0.0', true);
   wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'organi_enqueue_scripts');

/**
 * ?Change number or products per row to 3
 * this return 3 products per row
 */
if (!function_exists('loop_columns')) {
   function loop_columns()
   {
      return 3; // 3 products per row
   }
}
add_filter('loop_shop_columns', 'loop_columns', 999);



// Display the Woocommerce Discount Percentage on the Sale Badge for variable products and single products

function display_percentage_on_sale_badge($html, $post, $product)
{

   if ($product->is_type('variable')) {
      $percentages = array();

      // This will get all the variation prices and loop throughout them
      $prices = $product->get_variation_prices();

      foreach ($prices['price'] as $key => $price) {
         // Only on sale variations
         if ($prices['regular_price'][$key] !== $price) {
            // Calculate and set in the array the percentage for each variation on sale
            $percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
         }
      }
      // Displays maximum discount value
      $percentage = max($percentages) . '%';
   } elseif ($product->is_type('grouped')) {
      $percentages = array();

      // This will get all the variation prices and loop throughout them
      $children_ids = $product->get_children();

      foreach ($children_ids as $child_id) {
         $child_product = wc_get_product($child_id);

         $regular_price = (float) $child_product->get_regular_price();
         $sale_price    = (float) $child_product->get_sale_price();

         if ($sale_price != 0 || !empty($sale_price)) {
            // Calculate and set in the array the percentage for each child on sale
            $percentages[] = round(100 - ($sale_price / $regular_price * 100));
         }
      }
      // Displays maximum discount value
      $percentage = max($percentages) . '%';
   } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ($sale_price != 0 || !empty($sale_price)) {
         $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
         return $html;
      }
   }
   return '<div class="product__discount__percent">' . esc_html__('-', 'woocommerce') . $percentage . '</div>'; // If needed then change or remove "up to -" text
}
add_filter('woocommerce_sale_flash', 'display_percentage_on_sale_badge', 20, 3);


//? this is plus and minus in quantity 

add_action('woocommerce_after_add_to_cart_quantity', 'ts_quantity_plus_sign');

function ts_quantity_plus_sign()
{
   echo '<button type="button" class="plus" >+</button>';
}

add_action('woocommerce_before_add_to_cart_quantity', 'ts_quantity_minus_sign');

function ts_quantity_minus_sign()
{
   echo '<button type="button" class="minus" >-</button>';
}

add_action('wp_footer', 'ts_quantity_plus_minus');

function ts_quantity_plus_minus()
{
   // To run this on the single product page
   if (!is_product()) return;
?>
   <script type="text/javascript">
      jQuery(document).ready(function($) {

         $('form.cart').on('click', 'button.plus, button.minus', function() {

            // Get current quantity values
            var qty = $(this).closest('form.cart').find('.qty');
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr('max'));
            var min = parseFloat(qty.attr('min'));
            var step = parseFloat(qty.attr('step'));

            // Change the value if plus or minus
            if ($(this).is('.plus')) {
               if (max && (max <= val)) {
                  qty.val(max);
               } else {
                  qty.val(val + step);
               }
            } else {
               if (min && (min >= val)) {
                  qty.val(min);
               } else if (val > 1) {
                  qty.val(val - step);
               }
            }

         });

      });
   </script>
<?php
}

// ?acf custom field setting

if (
   function_exists('acf_add_options_page')
) {

   acf_add_options_page(array(
      'page_title'    => 'Theme General Settings',
      'menu_title'    => 'Theme Settings',
      'menu_slug'     => 'theme-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false
   ));

   acf_add_options_sub_page(array(
      'page_title'    => 'Theme Header Settings',
      'menu_title'    => 'Header',
      'parent_slug'   => 'theme-general-settings',
   ));

   acf_add_options_sub_page(array(
      'page_title'    => 'Theme Footer Settings',
      'menu_title'    => 'Footer',
      'parent_slug'   => 'theme-general-settings',
   ));
   acf_add_options_sub_page(array(
      'page_title'    => 'Theme Banner Settings',
      'menu_title'    => 'Banner',
      'parent_slug'   => 'theme-general-settings',
   ));
   acf_add_options_sub_page(array(
      'page_title'    => 'Theme Adds Settings',
      'menu_title'    => 'Adds',
      'parent_slug'   => 'theme-general-settings',
   ));
   acf_add_options_sub_page(array(
      'page_title'    => 'Theme Contact Settings',
      'menu_title'    => 'Contact',
      'parent_slug'   => 'theme-general-settings',
   ));
}


// ?sidebar register
// ?acf custom field setting


// function remove_dashboard_widgets()
// {
//    unregister_widget('WP_Widget_Recent_Comments');
// }
// add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function wpdocs_theme_slug_widgets_init()
{
   register_sidebar(array(
      'name'          => __('Footer-sidebar-1', 'organi'),
      'id'            => 'footer-sidebar-1',
      'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
      // 'before_widget' => '<div class="footer__widget">',
      // 'after_widget'  => '</div>',
      // 'before_title'  => '<h6>',
      // 'after_title'   => '</h6>',
   ));
   register_sidebar(array(
      'name'          => __('Footer-sidebar-2', 'organi'),
      'id'            => 'footer-sidebar-2',
      'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
   ));
   register_sidebar(array(
      'name'          => __('Woocommerce-sidebar', 'organi'),
      'id'            => 'woocommerce-widget-2',
      'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
   ));
}
add_action('widgets_init', 'wpdocs_theme_slug_widgets_init');