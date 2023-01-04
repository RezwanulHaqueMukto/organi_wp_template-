<?php


get_header();
?>
<section class="breadcrumb-section set-bg" data-setbg="<?php echo get_template_directory_uri(); ?>/img/breadcrumb.jpg">

   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
               <h2><?php woocommerce_page_title(); ?></h2>
               <div class="breadcrumb__option">
                  <a href="<?php echo site_url(); ?>">Home</a>
                  <span><?php woocommerce_page_title(); ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="content-container">
   <!-- <h1 class="page-title"><?php //_e('Search results for:', 'nd_dosth'); 
                                 ?></h1>
   <div class="search-query"><?php //echo get_search_query(); 
                              ?></div> -->
   <div class="container search_content">
      <div class="row">
         <!-- <div class="search-results-container col-md-8"> -->
         <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
               <?php the_post(); ?>
               <div class="col-lg-4">
                  <?php
                  wc_get_template_part('content', 'product');
                  ?>
               </div>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
         <?php else : ?>
            <p><?php _e('No Search Results found', 'nd_dosth'); ?></p>
         <?php endif; ?>
         <!-- </div> -->

      </div>
   </div>
</div>
<?php
get_footer();
