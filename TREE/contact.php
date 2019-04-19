<?php
/*
Template Name: CONTACT(コンタクト)
*/
?>
<?php get_header();?>
    <?php get_template_part('content', 'menu');?>

    <main class="l-main">
        <section class="l-reserved-title">
            <div class="p-section">
                <h1 class="p-section__title u-fuwa">CONTACT</h1>
            </div>
        </section>
        <section class="l-contact">
            <?php if(have_posts()):
                    while(have_posts()): the_post();?>
                    <?php the_content();?>
                    <?php endwhile;?>
            <?php endif;?>
        </section>
        
        <?php get_template_part('content', 'menu-bottom');?>    
    </main>

<?php get_footer();?>