<?php
/*
Template Name: STAFF一覧(スタッフ一覧)
*/
?>
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <section class="l-staff">
            <div class="p-section">
                <h1 class="p-section__title u-fuwa">STAFF</h1>
                <img class="p-section__img" src="<?php show_img('staff_list_top_img', STAFF_LIST_IMG);?>" alt="STAFF一覧トップ画像">
            </div>
        </section>
        <section class="l-team">
            <div class="c-text p-section-h2">
                <h2 class="c-text__title">OUR TEAM</h2>
                <p class="c-text__body p-section-h2__body">
                    <?php echo get_post_meta($post->ID, 'staff_list_msg', true);?>
                </p>
            </div>
            <div class="p-top-staff__list">
                <ul class="l-card-grid">
                    <?php dynamic_sidebar('-STAFF一覧-エリア');?>
                </ul>
            </div> 
        </section>

        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>