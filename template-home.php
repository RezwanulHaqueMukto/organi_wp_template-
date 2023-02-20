<?php
// Template Name:Home

global $woocommerce;
get_header();

?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>

                    <ul>
                        <?php
                        $args = array(
                            'taxonomy'     => 'product_cat',
                            'hide_empty'   => true
                        );
                        $cats = get_categories($args);
                        // echo "<pre>";
                        // print_r($cats);
                        // echo "</pre>";
                        foreach ($cats as $cat) {

                        ?>
                            <li><a href="<?php echo get_term_link($cat->slug, 'product_cat') ?>"><?php echo $cat->cat_name ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="<?php echo esc_url(home_url('/')); ?> " method="get">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <!-- <input type="text" placeholder="What do yo u need?"> -->
                            <input type="text" placeholder="What do yo u need?" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <?php
                            if (get_field('phone', 'option')) {
                                $phone = get_field('phone', 'option');
                            ?>
                                <h5><?php echo esc_html('+' . $phone['number']); ?></h5>
                                <span><?php echo esc_html($phone['number_text']); ?></span>

                            <?php  } ?>
                        </div>
                    </div>
                </div>

                <?php

                if (have_rows('banner', 'option')) {
                    while (have_rows('banner', 'option')) {
                        the_row();
                        $image = get_sub_field('banner_image_');
                        $sub_title = get_sub_field('sub_title');
                        $title = get_sub_field('title');
                        $Banner_text = get_sub_field('banner_text');
                        $Banner_btn_text = get_sub_field('banner_button_text');
                        $Banner_btn_url = get_sub_field('banner_button_url');

                ?>
                        <div class="hero__item set-bg" data-setbg="<?php echo $image['url']; ?>">
                            <div class="hero__text">
                                <span><?php echo $sub_title; ?></span>
                                <h2><?php echo $title; ?></h2>
                                <p><?php echo $Banner_text; ?></p>
                                <a href="<?php echo $Banner_btn_url; ?>" class="primary-btn"><?php echo $Banner_btn_text ?></a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php
                $cat_item = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC'));

                foreach ($cat_item as $cat_item) {

                    $thumbnail_id = get_woocommerce_term_meta($cat_item->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    $cat_link = get_term_link($cat_item);
                ?>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?php echo $image_url; ?>">
                            <h5><a href="<?php echo $cat_link; ?>"><?php echo $cat_item->name; ?></a></h5>
                        </div>
                    </div>
                <?php       } ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php
                        $cat_item = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC'));

                        foreach ($cat_item as $cat_item) {
                            $cat_link = get_term_link($cat_item);
                            $cat_name = $cat_item->name;
                        ?>
                            <li data-filter=".<?php echo $cat_item->slug; ?>"><?php echo $cat_name; ?></li>
                        <?php       } ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
            $args = array(
                'post_type'   => 'product',
                'post_status' => 'publish',
                'posts_per_page' => 12,
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $cat_item = get_the_terms($post->ID, 'product_cat');
                    foreach ($cat_item as $cat_items) {
                        $cat_slug = $cat_items->slug;
            ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $cat_slug; ?>">


                            <?php
                            wc_get_template_part('content', 'product'); ?>
                        </div>



            <?php
                    }
                }
            } else {
                echo __('No products found');
            }
            wp_reset_postdata();
            ?>



        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">

                    <?php

                    if (get_field('add_one', 'option')) {
                        $add_image = get_field('add_one', 'option');

                    ?>
                        <img src="<?php echo $add_image['url']; ?>" alt="">
                    <?php   } ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <?php

                    if (get_field('add_two', 'option')) {
                        $add_image = get_field('add_two', 'option');

                    ?>
                        <img src="<?php echo $add_image['url']; ?>" alt="">
                    <?php   } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php
                            $args = array(
                                'post_type'   => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();


                            ?>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo wp_get_attachment_url($product->get_image_id());  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $product->get_name(); ?></h6>
                                            <span><?php echo $product->get_price_html(); ?></span>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
                            ?>

                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php
                            $args = array(
                                'post_type'   => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'offset' => 3
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();

                            ?>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo wp_get_attachment_url($product->get_image_id());  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $product->get_name(); ?></h6>
                                            <span><?php echo $product->get_price_html(); ?></span>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php
                            $args = array(
                                'post_type'   => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'orderby' => 'meta_value_num',
                                'meta_key' => 'total_sales'
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();

                            ?>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo wp_get_attachment_url($product->get_image_id());  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $product->get_name(); ?></h6>
                                            <span><?php echo $product->get_price_html(); ?></span>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
                            ?>

                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php
                            $args = array(
                                'post_type'   => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'orderby' => 'meta_value_num',
                                'meta_key' => 'total_sales',
                                'offset' => 3,
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();

                            ?>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo wp_get_attachment_url($product->get_image_id());  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $product->get_name(); ?></h6>
                                            <span><?php echo $product->get_price_html(); ?></span>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php
                            $args = array(
                                'post_type'   => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'orderby' => 'meta_value_num',
                                'meta_key' => '_wc_average_rating',
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();

                            ?>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo wp_get_attachment_url($product->get_image_id());  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $product->get_name(); ?></h6>
                                            <span><?php echo $product->get_price_html(); ?></span>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php
                            $args = array(
                                'post_type'   => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'orderby' => 'meta_value_num',
                                'meta_key' => '_wc_average_rating',
                                'offset' => 3,
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();

                            ?>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?php echo wp_get_attachment_url($product->get_image_id());  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?php echo $product->get_name(); ?></h6>
                                            <span><?php echo $product->get_price_html(); ?></span>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
            ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                            </div>
                            <div class=" blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> <?php echo  get_the_date(); ?></li>
                                    <li><i class="fa fa-comment-o"></i> <?php echo get_comments_number(); ?></li>
                                </ul>
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <p><?php the_excerpt(); ?> </p>
                            </div>
                        </div>
                    </div>

            <?php

                }
            }
            ?>



        </div>
    </div>
</section>
<!-- Blog Section End -->
<?php get_footer();  ?>