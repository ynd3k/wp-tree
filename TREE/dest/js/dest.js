$(".u-fuwa").each(function(){$this=$(this),$this.addClass("u-fuwa--active")}),$('a[href^="#"]').click(function(){var s=$(this).attr("href"),o=$("#"==s||""==s?"html":s).offset().top;return $("html, body").animate({scrollTop:o},500,"swing"),!1}),$(window).on("scroll",function(){$(this).scrollTop,100<$(this).scrollTop()?$(".js-show-menu").addClass("u-opacity-1"):$(".js-show-menu").removeClass("u-opacity-1"),$(".u-fuwa").each(function(){$this=$(this);var s=$this.offset().top,o=$(window).scrollTop();s-$(window).height()+200<o?$this.addClass("u-fuwa--active"):$this.removeClass("u-fuwa--active")})}),$(".js-click-sp-menu").on("click",function(){$(".js-show-sp-menu").toggleClass("u-d-none")}),$(".js-show-sp-menu a").on("click",function(){$(this).parent().toggleClass("u-d-none")});