<nav class="l-top__menu">
    <?php
    $defaults_sp_slide = array(
        'theme_location' => 'mainmenu',
        'container' => false,
        'items_wrap' => '<ul class="p-top-menu u-b-center-position">%3$s</ul>'
    );
        wp_nav_menu($defaults_sp_slide);
    ?>
</nav>