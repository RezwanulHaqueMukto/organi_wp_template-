<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
   <meta charset="<?php bloginfo('charset');  ?>">
  
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">


   <?php
   global $woocommerce;
   global $current_user;
   wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   <!-- Page Preloder -->
   <!-- <div id="preloder">
      <div class="loader"></div>
   </div> -->

   <!-- Humberger Begin -->
   <div class="humberger__menu__overlay"></div>
   <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
         <?php
         if (get_field('logo', 'option')) {
            $logo = get_field('logo', 'option');
         ?>
            <a href="<?php echo  get_site_url(); ?>"><img src="<?php echo  esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']) ?>"></a>
         <?php } ?>
      </div>
      <!-- <div class="humberger__menu__cart">
         <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
         </ul>
         <div class="header__cart__price">item: <span><?php echo $woocommerce->cart->get_cart_total() ?></span></div>
      </div> -->
      <div class="humberger__menu__cart">
         <ul>
            <li><a href="<?php echo get_page_link(104) ?>">
                  <i class="fa fa-heart"></i>
                  <span>
                     <?php
                     $count = 0;
                     if (function_exists('yith_wcwl_count_products')) {
                        $count = yith_wcwl_count_products();
                        echo $count;
                     } else {
                        echo "0";
                     }

                     ?></span>

               </a></li>

            <li><a href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-shopping-bag"></i> <span><?php echo $woocommerce->cart->get_cart_contents_count() ?></span></a></li>
         </ul>
         <div class="header__cart__price">item: <span><?php echo $woocommerce->cart->get_cart_total() ?></span></div>
      </div>
      <div class="humberger__menu__widget">

         <div class="header__top__right__language">
            <img src="<?php echo  get_template_directory_uri(); ?>/img/language.png" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
               <li><a href="#">Spanis</a></li>
               <li><a href="#">English</a></li>
            </ul>
         </div>

         <div class="header__top__right__auth">
            <?php
            if (is_user_logged_in()) {
               $current_user = wp_get_current_user();
               echo $current_user->display_name;
            } else {
            ?>
               <a href="<?php echo esc_url(wp_login_url()); ?>"><i class="fa fa-user"></i> Login</a>

               </a>
            <?php
            }
            ?>

            <!-- <a href="#"><i class="fa fa-user"></i> Login</a> -->

         </div>
      </div>
      <nav class="humberger__menu__nav mobile-menu">
         <ul>

            <?php

            wp_nav_menu(array(
               'theme-location' => 'main-menu'
            ))

            ?>

         </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
         <?php

         if (have_rows('top_header_social_', 'option')) {
            while (have_rows('top_header_social_', 'option')) {
               the_row();
               $icon = get_sub_field('icon');
               $icon_link = get_sub_field('icon_link');


         ?>
               <a href="<?php echo $icon_link; ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>

         <?php

            }
         }

         ?>
      </div>

      <div class="humberger__menu__contact">
         <ul>
            <li><i class="fa fa-envelope"></i>
               <?php
               if (the_field('email', 'option')) {
                  the_field('email', 'option');
               } ?>
            </li>
            <li><?php
                  if (the_field('message_', 'option')) {
                     the_field('message_', 'option');
                  } ?>

         </ul>
      </div>
   </div>
   <!-- Humberger End -->

   <!-- Header Section Begin -->
   <header class="header">
      <div class="header__top">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <div class="header__top__left">
                     <ul>
                        <li><i class="fa fa-envelope"></i>
                           <?php
                           if (the_field('email', 'option')) {
                              the_field('email', 'option');
                           } ?>
                        </li>
                        <li><?php
                              if (the_field('message_', 'option')) {
                                 the_field('message_', 'option');
                              } ?>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="header__top__right">
                     <div class="header__top__right__social">
                        <?php

                        if (have_rows('top_header_social_', 'option')) {
                           while (have_rows('top_header_social_', 'option')) {
                              the_row();
                              $icon = get_sub_field('icon');
                              $icon_link = get_sub_field('icon_link');


                        ?>
                              <a href="<?php echo $icon_link; ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>

                        <?php

                           }
                        }

                        ?>

                     </div>
                     <div class="header__top__right__language">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/language.png" alt="">
                        <div>English</div>
                        <span class="arrow_carrot-down"></span>
                        <ul>
                           <li><a href="#">Spanis</a></li>
                           <li><a href="#">English</a></li>
                        </ul>
                     </div>
                     <div class="header__top__right__auth">
                        <?php
                        if (is_user_logged_in()) {
                           $current_user = wp_get_current_user();
                           echo $current_user->display_name;
                        } else {
                        ?>
                           <a href="<?php echo esc_url(wp_login_url()); ?>"><i class="fa fa-user"></i> Login</a>

                           </a>
                        <?php
                        }
                        ?>

                        <!-- <a href="#"><i class="fa fa-user"></i> Login</a> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-lg-3">
               <div class="header__logo">
                  <?php

                  if (get_field('logo', 'option')) {
                     $logo = get_field('logo', 'option');
                  ?>
                     <a href="<?php echo  get_site_url(); ?>"><img src="<?php echo  esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']) ?>"></a>
                  <?php } ?>
               </div>
            </div>
            <div class="col-lg-6">
               <nav class="header__menu">
                  <?php
                  wp_nav_menu(array(
                     'theme-location' => 'main-menu'
                  ))

                  ?>
               </nav>
            </div>
            <div class="col-lg-3">
               <div class="header__cart">
                  <ul>
                     <li><a href="<?php echo get_page_link(104) ?>">
                           <i class="fa fa-heart"></i>
                           <span>
                              <?php
                              $count = 0;
                              if (function_exists('yith_wcwl_count_products')) {
                                 $count = yith_wcwl_count_products();
                                 echo $count;
                              } else {
                                 echo "0";
                              }

                              ?></span>

                        </a></li>

                     <li><a href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-shopping-bag"></i> <span><?php echo $woocommerce->cart->get_cart_contents_count() ?></span></a></li>
                  </ul>
                  <div class="header__cart__price">item: <span><?php echo $woocommerce->cart->get_cart_total() ?></span></div>
               </div>
            </div>
         </div>
         <div class="humberger__open">
            <i class="fa fa-bars"></i>
         </div>
      </div>
   </header>
   <!-- Header Section End -->