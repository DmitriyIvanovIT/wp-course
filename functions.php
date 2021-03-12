<?
if ( ! function_exists( 'universal_theme_setup' ) ) :
    function universal_theme_setup() {
        // Динамический title
        add_theme_support( 'title-tag' );

        // Добавление миниатюр
        add_theme_support( 'post-thumbnails', array( 'post' ) );   

        // Добавление пользовательского логотипа
        add_theme_support( 'custom-logo', [
            'width'       => 163,
            'flex-height' => true,
            'header-text' => 'logo',
            'unlink-homepage-logo' => true, // WP 5.5
        ] );

        // Регистрация меню
        register_nav_menus( [
            'header_menu' => 'Меню в шапке',
            'footer_menu' => 'Меню в подвале'
        ] );
    }

    
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );

// Подключение сайдбара
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар на главной сверху', 'universal-theme' ),
			'id'            => 'main-sidebar-top',
			'description'   => esc_html__( 'Добавьте виджеты сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар на главной снизу', 'universal-theme' ),
			'id'            => 'main-sidebar-bottom',
			'description'   => esc_html__( 'Добавьте виджеты сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar(
		array(
			'name'          => esc_html__( 'Меню в подвале', 'universal-theme' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Добавьте меню сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-menu-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar(
		array(
			'name'          => esc_html__( 'Текст в подвале', 'universal-theme' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Добавьте меню сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>'
		)
	);
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );

// Создаем собственный виджет

class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: foo_widget
			'Полезные файлы',
			array( 'description' => 'Файлы для скачивания', 'classname' => 'widget-downloader', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
        $description = $instance['description'];
        $link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
        if ( ! empty( $description ) ) {
			echo '<p>' . $description . '</p>';
		}
        if ( ! empty( $link ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link . '" download>
			<img class="widget-link-icon" src="' . get_template_directory_uri() . '/assets/images/download.svg" > Скачать
            </a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
        $description = @ $instance['description'] ?: 'Описание файла';
        $link = @ $instance['link'] ?: 'http://yandex.ru';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
        $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_downloader_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		// wp_enqueue_script('downloader_widget_script', $theme_url .'/downloader_widget_script.js' );
	}

	// стили виджета
	function add_my_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_downloader_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downloader_Widget

// регистрация Downloader_Widget в WordPress
function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );

class Social_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'social_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: foo_widget
			'Социальные сети',
			array( 'description' => 'Наши соцсети', 'classname' => 'widget-social', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_social_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_social_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$linkVk = $instance['linkVk'];
		$linkFacebook = $instance['linkFacebook'];
		$linkInst = $instance['linkInst'];
		$linkTwitter = $instance['linkTwitter'];
		$linkTelegram = $instance['linkTelegram'];
		$linkYoutube = $instance['linkYoutube'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
        echo '<div class="widget-social-wrapper">';
        if ( ! empty( $linkVk ) ) {
			echo '<a target="_blank" class="widget-social-icon" href="' . $linkVk . '" target="_blank">
				<img src="' . get_template_directory_uri() . '/assets/images/vk.svg" alt="vk" width="30">
            </a>';
		}
		if ( ! empty( $linkFacebook ) ) {
			echo '<a target="_blank" class="widget-social-icon" href="' . $linkFacebook . '" target="_blank">
				<img src="' . get_template_directory_uri() . '/assets/images/facebook.svg" alt="facebook" width="30">
            </a>';
		}
		if ( ! empty( $linkInst  ) ) {
			echo '<a target="_blank" class="widget-social-icon" href="' . $linkInst  . '" target="_blank">
				<img src="' . get_template_directory_uri() . '/assets/images/instagram.svg" alt="instagram" width="30">
            </a>';
		}
		if ( ! empty( $linkTwitter ) ) {
			echo '<a target="_blank" class="widget-social-icon" href="' . $linkTwitter . '" target="_blank">
				<img src="' . get_template_directory_uri() . '/assets/images/twitter.svg" alt="twitter" width="30">
            </a>';
		}
		if ( ! empty( $linkTelegram ) ) {
			echo '<a target="_blank" class="widget-social-icon" href="' . $linkTelegram . '" target="_blank">
				<img src="' . get_template_directory_uri() . '/assets/images/telegram.svg" alt="telegram" width="30">
            </a>';
		}
		if ( ! empty( $linkYoutube ) ) {
			echo '<a target="_blank" class="widget-social-icon" href="' . $linkYoutube . '" target="_blank">
				<img src="' . get_template_directory_uri() . '/assets/images/youtube.svg" alt="youtube" width="30">
            </a>';
		}
		echo '</div>' . $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Наши соцсети';
        $linkVk = @ $instance['linkVk'] ?: '';
		$linkFacebook = @ $instance['linkFacebook'] ?: '';
		$linkInst = @ $instance['linkInst'] ?: '';
		$linkTwitter = @ $instance['linkTwitter'] ?: '';
		$linkTelegram = @ $instance['linkTelegram'] ?: '';
		$linkYoutube = @ $instance['linkYoutube'] ?: '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkVk' ); ?>"><?php _e( 'Vk:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkVk' ); ?>" name="<?php echo $this->get_field_name( 'linkVk' ); ?>" type="text" value="<?php echo esc_attr( $linkVk ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkFacebook' ); ?>"><?php _e( 'Facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkFacebook' ); ?>" name="<?php echo $this->get_field_name( 'linkFacebook' ); ?>" type="text" value="<?php echo esc_attr( $linkFacebook ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkInst' ); ?>"><?php _e( 'Instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkInst' ); ?>" name="<?php echo $this->get_field_name( 'linkInst' ); ?>" type="text" value="<?php echo esc_attr( $linkInst ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkTwitter' ); ?>"><?php _e( 'Twitter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkTwitter' ); ?>" name="<?php echo $this->get_field_name( 'linkTwitter' ); ?>" type="text" value="<?php echo esc_attr( $linkTwitter ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkTelegram' ); ?>"><?php _e( 'Telegram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkTelegram' ); ?>" name="<?php echo $this->get_field_name( 'linkTelegram' ); ?>" type="text" value="<?php echo esc_attr( $linkTelegram ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkYoutube' ); ?>"><?php _e( 'Youtube:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkYoutube' ); ?>" name="<?php echo $this->get_field_name( 'linkYoutube' ); ?>" type="text" value="<?php echo esc_attr( $linkYoutube ); ?>">
		</p>
        
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['linkVk'] = ( ! empty( $new_instance['linkVk'] ) ) ? strip_tags( $new_instance['linkVk'] ) : '';
		$instance['linkFacebook'] = ( ! empty( $new_instance['linkFacebook'] ) ) ? strip_tags( $new_instance['linkFacebook'] ) : '';
		$instance['linkInst'] = ( ! empty( $new_instance['linkInst'] ) ) ? strip_tags( $new_instance['linkInst'] ) : '';
		$instance['linkTwitter'] = ( ! empty( $new_instance['linkTwitter'] ) ) ? strip_tags( $new_instance['linkTwitter'] ) : '';
		$instance['linkTelegram'] = ( ! empty( $new_instance['linkTelegram'] ) ) ? strip_tags( $new_instance['linkTelegram'] ) : '';
		$instance['linkYoutube'] = ( ! empty( $new_instance['linkYoutube'] ) ) ? strip_tags( $new_instance['linkYoutube'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_social_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_social_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		// wp_enqueue_script('downloader_widget_script', $theme_url .'/downloader_widget_script.js' );
	}

	// стили виджета
	function add_my_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_social_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Social_Widget

// регистрация Social_Widget в WordPress
function register_social_widget() {
	register_widget( 'Social_Widget' );
}
add_action( 'widgets_init', 'register_social_widget' );

// Виджет последних постов 
class Recent_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: foo_widget
			'Недавно опубликованно',
			array( 'description' => 'Последнии записи', 'classname' => 'widget-recent-posts', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_posts_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
        $count = $instance['count'];


		echo $args['before_widget'];
        if ( ! empty( $count ) ) {
            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'] . '<div class="widget-recent-posts-wrapper">';
            }

            global $post;

            $myposts = get_posts([ 
                'numberposts' => $count,
            ]);

            if( $myposts ){
                foreach( $myposts as $post ){
                    setup_postdata( $post );
                    ?>
                        <a href="<? the_permalink() ?>" class="recent-post-link">
                            <?
                                if( has_post_thumbnail() ) {
                                                
                                    ?><img class="recent-post-thumb" src="<?the_post_thumbnail_url()?>" alt="<? echo mb_strimwidth(get_the_title(), 0, 35, '...') ?>"><?
                                }
                                else {
                                    ?><img src="<?echo get_template_directory_uri() . '/assets/images/not-photo.jpg'?>" alt="<? echo mb_strimwidth(get_the_title(), 0, 35, '...') ?>" class="recent-post-thumb"><?
                                }
                            ?>
                            
                            <div class="recent-post-info">
                            <h4 class="recent-post-title"><? echo mb_strimwidth(get_the_title(), 0, 35, '...') ?></h4>
                            <span class="recent-post-time">
                                <?
                                    $time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
                                    echo "$time_diff назад";
                                ?>
                            </span>
                            </div>
                        </a>
                    <?php 
                }
            } else {
                ?><p>Постов нет</p><?
            }

            wp_reset_postdata(); // Сбрасываем $post
        }
        echo '</div>' . $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Последнии записи';
        $count = @ $instance['count'] ?: '7';
		?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Количество:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" min="1" max="10" value="<?php echo esc_attr( $count ); ?>">
            </p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_recent_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_recent_posts_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		// wp_enqueue_script('downloader_widget_script', $theme_url .'/downloader_widget_script.js' );
	}

	// стили виджета
	function add_my_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_recent_posts_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Recent_Posts_Widget

// регистрация Recent_Posts_Widget в WordPress
function register_recent_posts_widget() {
	register_widget( 'Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );

// правильный способ подключить стили и скрипты
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );
function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css' );
    wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style', time() );
    wp_enqueue_style( 'Roboto Slab', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap' );

    wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', null, time(), true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/index.js', null, time(), true );
}

// Изменяем настройки облака тегов
add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_args');
function edit_widget_tag_cloud_args( $args){
	$args['unit'] = 'px';
	$args['smallest'] = '12';
	$args['largest'] = '12';
	$args['number'] = '15';
	return $args;
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}