<?
if ( ! function_exists( 'universal_theme_setup' ) ) :
    function universal_theme_setup() {
        // Динамический title
        add_theme_support( 'title-tag' );

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

// правильный способ подключить стили и скрипты
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );
function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css' );
}