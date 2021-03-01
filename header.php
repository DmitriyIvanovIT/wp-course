<!DOCTYPE html>
<html <? language_attributes(); ?>>

<head>
    <meta charset="<? bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>

<body <? body_class(); ?>>

    <? wp_body_open(); ?>
    <header class="header">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                        <?if( has_custom_logo() ){
                            // логотип есть выводим его
                            echo get_custom_logo();
                        } else {?>
                            <a href="/" class="custom-logo-link" rel="home" aria-current="page">
                            <span class="logo-name">Universal</span>
                            </a>
                        <?}?>
                </div>
                <? wp_nav_menu( [
                    'theme_location'  => 'header_menu',
                    'container'       => 'nav', 
                    'container_class' => 'header-nav', 
                    'menu_class'      => 'header-nav', 
                    'echo'            => true,
                    'items_wrap'      => '<ul id="menu-header-menu" class="header-menu">%3$s</ul>',
                ] ); ?>
                <? echo get_search_form(); ?>
            </div>
            <!-- /.header-wrapper -->
        </div>
    </header>