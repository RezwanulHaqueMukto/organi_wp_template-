<!-- Footer Section Begin -->
<footer class="footer spad">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer__about">

               <div class="footer__about__logo">
                  <?php
                  if (get_field('footer_logo', 'option')) {
                     $logo = get_field('footer_logo', 'option');
                  ?>
                     <a href="<?php echo  get_site_url(); ?>"><img src="<?php echo  esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']) ?>"></a>

                  <?php
                  } ?>
               </div>
               <ul>
                  <li>Address:<?php if (get_field('footer_address_', 'option')) {
                                 $address = get_field('footer_address_', 'option');
                                 echo $address;
                              } ?></li>
                  <li>Phone:<?php if (get_field('footer_phone', 'option')) {
                                 $phone = get_field('footer_phone', 'option');
                                 echo $phone;
                              } ?></li>
                  <li>Email: <?php if (get_field('footer_email', 'option')) {
                                 $email = get_field('footer_email', 'option');
                                 echo $email;
                              } ?></li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
            <div class="footer__widget">
               <h6>Useful Links</h6>
               <ul>
                  <?php if (is_active_sidebar('footer-sidebar-1')) { ?>

                     <?php dynamic_sidebar('footer-sidebar-1'); ?>

                  <?php } ?>
               </ul>
               <ul>
                  <?php if (is_active_sidebar('footer-sidebar-2')) { ?>

                     <?php dynamic_sidebar('footer-sidebar-2'); ?>

                  <?php } ?>
               </ul>
            </div>
         </div>
         <div class="col-lg-4 col-md-12">
            <div class="footer__widget">
               <h6>Join Our Newsletter Now</h6>
               <p>Get E-mail updates about our latest shop and special offers.</p>
               <?php echo do_shortcode('[contact-form-7 id="154" title="Subscribe"]'); ?>
               <div class="footer__widget__social">
                  <?php
                  if (have_rows('footer_social_', 'option')) {
                     while (have_rows('footer_social_', 'option')) {
                        the_row();
                        $icon = get_sub_field('icon');
                        $icon_link = get_sub_field('link');


                  ?>
                        <a href="<?php echo $icon_link; ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>

                  <?php

                     }
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="footer__copyright">
               <div class="footer__copyright__text">
                  <p>
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                     </script>
                     <?php if (get_field('footer_copyright_', 'option')) {
                        $footer_copyright = get_field('footer_copyright_', 'option');
                        echo $footer_copyright;
                     } ?>
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  </p>
               </div>
               <div class="footer__copyright__payment"><img src=" <?php echo  get_template_directory_uri(); ?>/img/payment-item.png" alt=""></div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- Footer Section End -->


<?php wp_footer(); ?>

</body>

</html>