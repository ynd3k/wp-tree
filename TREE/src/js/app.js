
$('.u-fuwa').each(function(){
    $this = $(this) ;
    $this.addClass('u-fuwa--active');
});

$('a[href^="#"]').click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
});

$(window).on('scroll', function(){
    if($(this).scrollTop == 1){
        //$('.u-fuwa').removeClass('u-fuwa--active');
    }
    if( $(this).scrollTop() > 100){
        $('.js-show-menu').addClass('u-opacity-1');
    }
    else{
    $('.js-show-menu').removeClass('u-opacity-1');
    }

    $('.u-fuwa').each(function(){
        $this = $(this);
        var elemPos = $this.offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        
        if (scroll > elemPos - windowHeight + 200){
            $this.addClass('u-fuwa--active');
        }else{
            $this.removeClass('u-fuwa--active');
        }
    });
});
$('.js-click-sp-menu').on('click', function(){
    $('.js-show-sp-menu').toggleClass('u-d-none');
});
$('.js-show-sp-menu a').on('click', function(){
    $(this).parent().toggleClass('u-d-none');
});