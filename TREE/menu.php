<?php
/*
Template Name: MENU(メニュー)
*/
?>
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <section class="l-course">
            <div class="p-section">
                <h1 class="p-section__title u-fuwa">MENU</h1>
                <img class="p-section__img" src="<?php show_img('menu_img', MENU_IMG);?>" alt="MENU画像">
            </div>
        </section>
        <section class="l-course-grid">
            <?php dynamic_sidebar('-MENU-エリア');?>
        </section>
        <div class="l-course__reserved">
            <?php dynamic_sidebar('-予約ボタン-エリア');?>
        </div>

        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>