<footer class="footer">
            <div class="container">
                <div class="footer-form-wrapper">
                    <h3 class="footer-form-title">Подпишитесь на нашу рассылку</h3>
                    <form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8" method="post" class="footer-form">
                        <!-- Поле Email (обязательно) -->
                        <input required type="text" name="email" placeholder="Введите email" class="input footer-form-input" />
                        <input type="hidden" name="campaign_token" value="BhdcW" />
                        <!-- Страница благодарности -->
                        <input type="hidden" name="thankyou_url" value="<?echo home_url( '/thankyou/' )?>" />
                        <!-- Добавить подписчика в цикл на определенный день (по желанию) -->
                        <input type="hidden" name="start_day" value="0" />
                        <!-- Кнопка подписаться -->
                        <button type="submit">Подписаться</button>
                    </form>
                </div>
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