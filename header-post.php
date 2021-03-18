<!DOCTYPE html>
<html <? language_attributes(); ?>>

<head>
    <meta charset="<? bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <? body_class(); ?>>

    <? wp_body_open(); ?>
    <header class="header header-light">
        <div class="container">
            <div class="header-wrapper">
                <a href="<? echo home_url('/') ?>" class="logo">
                    <?
                    if( has_custom_logo() ){
                        $logo_img = '';
                        if( $custom_logo_id = get_theme_mod('custom_logo') ){
                            $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                                'class'    => 'custom-logo',
                                'itemprop' => 'logo',
                            ) );
                        }
                            
                        echo $logo_img; 
                    ?>  
                        <span class="logo-name">
                            <?echo get_bloginfo('name');?>
                        </span>
                    <?
                        } else {?>
                            <span class="logo-name">
                                <?echo get_bloginfo('name');?>
                            </span>
                    <?}?>
                </a>
                <? wp_nav_menu( [
                    'theme_location'  => 'header_menu',
                    'container'       => 'nav', 
                    'container_class' => 'header-nav', 
                    'menu_class'      => 'header-nav', 
                    'echo'            => true,
                    'items_wrap'      => '<ul id="menu-header-menu" class="header-menu">%3$s</ul>',
                ] ); ?>
                <? echo get_search_form(); ?>
                <div class="header-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <!-- /.header-wrapper -->
        </div>
    </header>