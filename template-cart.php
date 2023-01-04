<?php
// Template Name:Cart
get_header();  ?>

<section class="breadcrumb-section set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/breadcrumb.jpg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
               <h2><?php the_title(); ?></h2>
               <div class="breadcrumb__option">
                  <a href="<?php echo site_url(); ?>">Home</a>
                  <span><?php the_title(); ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php
echo do_shortcode('[woocommerce_cart]');


?>

<?php get_footer();  ?>