<?php
/*
Template Name: Страница контакты
Template Post Type: page
*/
    get_header();?>
<section class="section-dark">
    <div class="container">
        <?
            the_title('<h1 class="page-title">','</h1>', true);
        ?>
        <div class="contacts-wrapper">
            <div class="left">
                <h2 class="contacts-title">Через форму обратной связи</h2>
                <form action="#" class="contacts-form" method="POST">
                    <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя" required>
                    <input name="contact_email" type="email" class="input contacts-input" placeholder="Ваш Email" required>
                    <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос" required></textarea>
                    <button type="submit" class="button more">Отправить</button>
                </form>
                <? echo do_shortcode( '[contact-form-7 id="167" title="Контактная форма"]' ) ?>
            </div>
            <div class="right"></div>
        </div>
    </div>
</section>    


<?
    get_footer();