<?php
/*
Template Name: STAFF(スタッフ詳細)
*/
?>
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <section class="l-staff">
            <div class="p-section">
                <h1 class="p-section__title u-fuwa">STAFF 詳細</h1>
            </div>
        </section>
        <div class="p-staff">
            <h3 class="p-staff__name">
                <p class="p-staff__name__romaji"><?php echo get_post_meta($post->ID, 'staff_romaji', true);?></p>
                <p class="p-staff__name__kanji"><?php echo get_post_meta($post->ID, 'staff_kanji', true);?></p>
            </h3>
            <p class="p-staff__comment">
                <?php echo get_post_meta($post->ID, 'staff_msg', true);?>
            </p>
        </div>
        <div class="l-staff-container u-fuwa">
            <div class="l-staff-container__img">
                <img class="p-staff__img" src="<?php show_img_costom('staff_img', STAFF_IMG);?>" alt="スタッフの画像">
            </div>
            <div class="l-staff-container__info">
                <table class="p-schedule-table">
                    <caption>出勤スケジュール</caption>
                    <tbody>
                        <?php for($i=1; $i<=7; $i++):?>
                            <?php $d = $i - 1;?>
                            <tr><th><?php echo date('m/d', strtotime('+'. $d. ' day'));?></th><td><?php echo get_post_meta($post->ID, 'staff_schedule'. $i, 'true');?></td></tr>
                        <?php endfor;?>
                        
                    </tbody>
                </table>
                <div class="p-staff__btn">
                    <?php dynamic_sidebar('-ALLSTAFFボタン-エリア');?>
                    <?php dynamic_sidebar('-予約ボタン-エリア');?>
                </div>
            </div>
        </div>

        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>