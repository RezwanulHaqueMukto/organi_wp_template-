<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
   return;
}
?>

<li <?php wc_product_class('', $product); ?>>
   <div class="product__item">
      <div class="product__item__pic set-bg" data-setbg="<?php the_post_thumbnail_url(); ?>" style="background-image: url(&quot;<?php the_post_thumbnail_url(); ?>&quot;);">
         <?php woocommerce_show_product_loop_sale_flash(); ?>
         <ul class="product__item__pic__hover">
            <?php

            // $product = wc_get_product($id);
            // echo wc_get_rating_html($product->get_average_rating());
            ?>
            <ul class="woocommerce">
               <li>
                  <?php if ($average = $product->get_average_rating()) : ?>
                     <?php echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __('out of 5', 'woocommerce') . '</span></div>'; ?>
                  <?php endif; ?>
               </li>
            </ul>
            <li> <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?></li>

            <li><a href="<?php echo site_url(); ?>/?action=yith-woocompare-view-table&amp;iframe=yes" class="compare button" data-product_id="<?php echo get_the_ID(); ?>" rel="nofollow"><i class="fa fa-retweet"></i></a></li>
            <li>
               <a href="<?php echo site_url(); ?>/?add-to-cart=<?php echo get_the_ID(); ?>" data-quantity="1" class="button wp-element-button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo get_the_ID(); ?>"><i class="fa fa-shopping-cart"></i></a>
            </li>
         </ul>
      </div>

      <div class="product__item__text">
         <span> <?php
                  $categ = $product->get_categories();
                  echo $categ; ?> </span>
         <a href="<?php the_permalink(); ?>"><?php do_action('woocommerce_shop_loop_item_title'); ?></a>
         <h5><?php woocommerce_template_loop_price(); ?></h5>
      </div>
   </div>





</li>