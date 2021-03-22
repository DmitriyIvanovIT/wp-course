<?php
/*
Template Name: Страница благодарности
Template Post Type: page
*/
    get_header() 
?>

    <div class="container">
        <h1><? the_title() ?></h1>
        <? the_content() ?>
    </div>
<?
    get_footer();
