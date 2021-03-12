<footer class="footer">
            <div class="container">
                <?php
                /**
                 * The sidebar containing the main widget area
                 *
                 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
                 *
                 * @package universal-example
                 */

                if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
                    return;
                }
                ?>

                <div class="footer-menu-bar">
                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </div>
                <!-- ./footer-menu-bar -->

                
                <div class="footer-info">
                    <a href="<? echo home_url( '/' ) ?>" class="custom-logo-link" rel="home" aria-current="page">
                        <img width="50" height="50" src="<? echo get_template_directory_uri() ?>/assets/images/logo.png" class="custom-logo" alt="Universal" srcset="" sizes="(max-width: 163px) 100vw, 163px" />
                    </a>
                    <? 
                        wp_nav_menu( [
                            'theme_location'  => 'footer_menu',
                            'container'       => 'nav', 
                            'container_class' => 'footer-nav-wrapper', 
                            'menu_class'      => 'footer-nav', 
                            'echo'            => true,
                            'items_wrap'      => '<ul id="menu-footer-menu" class="footer-nav">%3$s</ul>',
                        ] );

                        $instance = array(
                            'linkVk' => 'https://vk.com/ivanovdimanpsk',
                            'linkInst' => 'https://www.instagram.com/diman_ivanov_official/',
                            'linkTelegram' => 'https://tlgg.ru/diman_ivanov',
                            'linkYoutube' => 'https://www.youtube.com/c/GloAcademyChannel'
                        );
                        $args = array(
                            'before_widget' => '<div class="footer-social">',
                            'after_widget' => '</div>'
                        );

                        the_widget( 'Social_Widget', $instance, $args ); 
                    ?>
                </div>
                <!-- /.footer-info -->
                <div class="footer-text-wrapper">
                    <?php dynamic_sidebar( 'sidebar-footer-text' ); ?>
                    <span class="footer-copyright"><? echo date('Y') . ' &copy; ' . get_bloginfo('name'); ?></span>
                    <!-- /.footer-copyright -->
                </div>
                <!-- /.footer-text-wrapper -->
            </div>
            <!-- /.container -->
        </footer>
        <!-- /.footer -->

    
        <? wp_footer(); ?>

    </body>
</html>