<?php
/*
Template Name: RESERVED(予約)
*/
?>
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <section class="l-reserved-title">
            <div class="p-section">
                <h1 class="p-section__title u-fuwa">RESERVED</h1>
            </div>
        </section>
        <section class="l-reserved">
            <section class="l-reserved__item u-fuwa">
                <h2 class="p-reserved__title">電話でのご予約</h2>
                <a href="tel:<?php echo get_post_meta($post->ID, 'reserved_tel', true);?>" class="c-btn p-reserved__btn"><?php echo get_post_meta($post->ID, 'reserved_tel', true);?></a>
                <p class="p-reserved__date">平日：<?php echo get_post_meta($post->ID, 'reserved_weekday', true);?></p>
                <p class="p-reserved__date">休日：<?php echo get_post_meta($post->ID, 'reserved_holiday', true);?></p>
                <p class="p-reserved__date">定休日：<?php echo get_post_meta($post->ID, 'reserved_regular_holiday', true);?></p>
            </section>
            <section class="l-reserved__item u-fuwa">
                <h2 class="p-reserved__title">WEBでのご予約</h2>
                <a href="<?php echo get_post_meta($post->ID, 'reserved_web_link', true);?>" class="c-btn p-reserved__btn">CLICK</a>
                <p class="p-reserved__date"><?php echo get_post_meta($post->ID, 'reserved_web', true);?></p>
            </section>
            <section class="l-reserved__item u-fuwa">
                <h2 class="p-reserved__title">アプリでのご予約</h2>
                <a href="<?php echo get_post_meta($post->ID, 'reserved_app_link', true);?>" class="c-btn p-reserved__btn">CLICK</a>
                <p class="p-reserved__date"><?php echo get_post_meta($post->ID, 'reserved_app', true);?></p>
            </section>
        </section>
        
        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>