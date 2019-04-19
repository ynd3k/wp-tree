<?php
/*
Template Name: ABOUT(アバウト)
*/
?>
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <section class="l-about">
            <div class="p-section">
                <h1 class="p-section__title u-fuwa">ABOUT</h1>
                <img class="p-section__img" src="<?php show_img('about_top_img', HOME_ABOUT_IMG);?>" alt="ABOUT画像">
            </div>
        </section>
        <section class="l-concept u-fuwa">
            <div class="c-text p-section-h2">
                <h2 class="c-text__title">CONCEPT</h2>
                <p class="c-text__body p-section-h2__body">
                    <?php echo get_post_meta($post->ID, 'about_concept_msg', true);?>
                </p>
            </div>
            <div class="l-concept__grid">
                <?php dynamic_sidebar('-ABOUT-コンセプトエリア');?>
            </div>
        </section>
        <section class="l-access u-fuwa">
            <h2 class="c-text__title">ACCESS</h2>
            <div class="l-access__info">
                <div class="p-access-info">
                    <ul class="p-info-list">
                        <li class="p-info-list__item">Hair & Life Design TREE</li>
                        <?php dynamic_sidebar('-ABOUT-アクセスエリア');?>
                        <!-- <li class="p-info-list__item">
                            <span class="p-info-list__item__title">住所</span>
                            <span class="p-info-list__item__body">東京都中央区銀座3-11-17 銀座パトリアタワー B1F</span>
                        </li> -->
                        
                    </ul>
                </div>
                <div class="p-access-map">
                    <?php echo get_post_meta($post->ID, 'map', true);?>
                </div>
            </div>
            <?php dynamic_sidebar('-予約ボタン-エリア');?>
        </section>

        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>