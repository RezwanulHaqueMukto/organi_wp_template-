<?php get_header(); ?>

<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="<?php the_post_thumbnail_url(); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2><?php the_title(); ?></h2>
                    <ul>
                        <li><?php
                            $author_id = $post->post_author;
                            the_author_meta('display_name', $author_id); ?></li>
                        <li><?php echo get_the_date(); ?></li>
                        <li><?php echo  get_comments_number(); ?> Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">All</a></li>
                            <li><a href="#">Beauty (20)</a></li>
                            <li><a href="#">Food (5)</a></li>
                            <li><a href="#">Life Style (9)</a></li>
                            <li><a href="#">Travel (10)</a></li>
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-1.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-2.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>Tips You To Balance<br /> Nutrition Meal Day</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-3.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>4 Principles Help You Lose <br />Weight With Vegetables</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Search By</h4>
                        <div class="blog__sidebar__item__tags">
                            <a href="#">Apple</a>
                            <a href="#">Beauty</a>
                            <a href="#">Vegetables</a>
                            <a href="#">Fruit</a>
                            <a href="#">Healthy Food</a>
                            <a href="#">Lifestyle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">

                    <img src="img/blog/details/details-pic.jpg" alt="">
                    <?php the_content(); ?>
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">

                                <div class="blog__details__author__pic">

                                    <img src="<?php echo esc_url(get_avatar_url($author_id));  ?>" alt="">

                                </div>
                                <div class="blog__details__author__text">
                                    <h6><?php echo get_the_author_meta('display_name', $author_id); ?></h6>
                                    <span>
                                        <?php
                                        $user_meta = get_userdata($author_id);
                                        echo ($user_meta->roles[0]);


                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span>
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            $output = '';
                                            foreach ($categories as $category) {
                                                $output .= $category->name . ', ';
                                            }
                                            $output = rtrim($output, ', ');
                                            echo $output;
                                        }

                                        ?>

                                    </li>
                                    <li><span>Tags:</span>
                                        <?php
                                        $tags = get_the_tags();
                                        if (!empty($tags)) {
                                            $output = '';
                                            foreach ($tags as $tag) {
                                                $output .= $tag->name . ', ';
                                            }
                                            $output = rtrim($output, ', ');
                                            echo $output;
                                        }

                                        ?>
                                    </li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>

                                    <a href="https://www.twitter.com/share?url=<?= get_permalink(); ?>&text=<?= get_the_title(); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>

                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= get_permalink(); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>

                                    <a href="mailto:?subject=<?= get_the_title(); ?> - <?= site_url(); ?>&body=I found this post on <?= site_url(); ?> and thought it would interest you.%0D%0A%0D%0A<?= get_the_title(); ?>%0D%0A<?= get_permalink(); ?>" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Post You May Like</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $related_posts = get_field('post_related');
            if ($related_posts) {
                foreach ($related_posts as $single) {
                    $featured_img_url = get_the_post_thumbnail_url($single->ID);
            ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="<?php echo $featured_img_url; ?>" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> <?php echo $single->post_date; ?></li>
                                    <li><i class="fa fa-comment-o"></i> <?php echo $single->comment_count; ?></li>
                                </ul>
                                <h5><a href="<?php the_permalink(); ?>"><?php echo $single->post_title; ?></a></h5>
                                <?php echo $single->post_excerpt; ?>
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
<!-- Related Blog Section End -->

<?php get_footer(); ?>