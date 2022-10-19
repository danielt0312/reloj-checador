$(document).ready(function($){
    
    $(".nav-menu").children("li.menu-item-has-children").addClass("padre").append('<i class="fa fa-angle-down menu-flecha"></i>');
    $("li.padre i.menu-flecha").click(function(event) {
        var $object = $(this);
        $(this).toggleClass("open");
        if(!$(this).hasClass("open")){
            $(this).parent('li.menu-item-has-children').children('a').removeClass('sub-open');
            $(this).parent('li.menu-item-has-children').children('ul.sub-menu').css('height', 0).addClass('sub-menu-a');
            $(this).parent().css('height', 50);
            $('a').removeClass('sub-open'); 
        }else{
            $object.parent('.menu-item-has-children').children('a').addClass('sub-open');
            var alto = $object.parent('li.menu-item-has-children').children('ul.sub-menu').children().length;
            if(alto>0){
                var hijosdeHermanosdelLi = 0;
                var padreUl = $object.parent('li.menu-item-has-children').children('ul.sub-menu').children();
                $(padreUl).each(function(k,v){
                    if($(v).children("i.open").length > 0){
                        hijosdeHermanosdelLi+= $(v).children('ul.sub-menu').children().length;
                    }
                });
            }
            alto = (hijosdeHermanosdelLi + alto) * 50;
            var alturapadre = alto + 50;
            $object.parent('li.menu-item-has-children').css('height', alturapadre);
            $object.parent('li.menu-item-has-children').children('ul.sub-menu').css('height', alto);
            $object.parent('li.menu-item-has-children').children('i.menu-flecha').addClass('open');
        }   
    });

    //poner spam a los hijos 
    if($("li.padre").children("ul.sub-menu").children("li.menu-item-has-children").children("ul.sub-menu").length > 0){
        $("li.padre").children("ul.sub-menu").children("li.menu-item-has-children").append('<i class="fa fa-angle-down menu-flecha"></i>');
        $("li.padre").children("ul.sub-menu").children("li.menu-item-has-children").addClass("hijo");
    }

    $("li.hijo i.menu-flecha").click(function(e){
        //ABRE EL MENÃš
        var hijos = $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').children().length;
        $(this).toggleClass("open");                    
        if($(this).hasClass("open")){
            $(this).parent('.menu-item-has-children').children('a').addClass('sub-open');
            var altoPadre = $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').children().length;
            var altoHijos = $(this).parent('li.menu-item-has-children').children('ul.sub-menu').children().length;
            var alto = $(this).parent('li.menu-item-has-children').children('ul.sub-menu').children().length;
            var hijosdeHermanosdelLi = 0;
            var padreUl = $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').children();
            var padreLiID = $(this).parent('li.menu-item-has-children').attr('id');
            $(padreUl).each(function(k,v){
                if(padreLiID != $(v).attr("id"))
                    if($(v).children("i.open").length > 0){
                        hijosdeHermanosdelLi+= $(v).children('ul.sub-menu').children().length;
                    } 
            });
            if($(this).hasClass("open")) 
            altoTotal = (altoPadre + altoHijos + (hijosdeHermanosdelLi + 1)) * 50;
            var contenedor  = (hijosdeHermanosdelLi + hijos + altoHijos + 1) * 50;
            alto = alto * 50;
            $(this).parent('li.menu-item-has-children').children('ul.sub-menu').css('height', alto);
            $(this).parent('li.menu-item-has-children').css('height', alto +50);
            $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').parent().css('height', contenedor);
            $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').css('height', altoTotal-50);
            $(this).parent('li.menu-item-has-children').children('i.menu-flecha-hijo').addClass('open');
        }else{
        // CIERRE EL MENÃš
            $(this).parent('li.menu-item-has-children').children('a').removeClass('sub-open');
            $(this).parent('li.menu-item-has-children').children('ul.sub-menu').css('height', 0);
            $(this).parent('li.menu-item-has-children').children('i.menu-flecha-hijo').removeClass('open');
            
            var hijosdeHermanosdelLi = 0;
            var padreUl = $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').children();
            var padreLiID = $(this).parent('li.menu-item-has-children').attr('id');
            $(padreUl).each(function(k,v){
                if(padreLiID != $(v).attr("id"))
                    if($(v).children("i.open").length > 0){
                        hijosdeHermanosdelLi+= $(v).children('ul.sub-menu').children().length;
                    } 
            });             
            var altoPadre = $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').children().length;
            altoPadre = (altoPadre + hijosdeHermanosdelLi) * 50;
            $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').css('height', altoPadre);
            $(this).parent('li.menu-item-has-children').parent('ul.sub-menu').parent().css('height', altoPadre+50);
            $(this).parent('li.menu-item-has-children').css('height', 50);
        }   
    }); 

     $(".imgLiquidFill").imgLiquid();

    //----------------------------//
    //      Hover on SVG          //
    //----------------------------//
    $('.cuadro-interior ul li').on('hover', 'a', function(){
        var data_municipio = $(this).data('municipio');

        var element = $('#Layer_1 path').filter(function() { 
            return $(this).data("municipio") == data_municipio
        });
        
        if(element.attr('class') != 'selected')
            element.attr('class', 'selected');
        else
            element.attr('class', '');
    });
    $('#Layer_1').on('hover', 'path', function(){
        var data_municipio = $(this).data('municipio');
    
        var el = $('.cuadro-interior ul li a').filter(function(){
           return $(this).data('municipio') == data_municipio 
        });
        
        if(el.attr('class') != 'selected')
            el.attr('class', 'selected');
        else
            el.attr('class', '');
            
            
        if($(this).attr('class') != 'selected')
            $(this).attr('class', 'selected');
        else
            $(this).attr('class', '');
    });
    
    $('#Layer_1').on('click', 'path', function(e){
        e.preventDefault();
        var data_municipio = $(this).data('municipio');
        console.log(data_municipio);
        
        var el = $('.cuadro-interior ul li a').filter(function(){
           return $(this).data('municipio') == data_municipio 
        });
            
        window.location.href = el.attr('href');
        return false;
    });
    
    //----------------------------//
    //      Sticky Sidebar        //
    //----------------------------//
    $('#map_wrapper').parent().theiaStickySidebar({
        additionalMarginTop: 50
    });
    
    $('#the_sidebar').parent().theiaStickySidebar({
        additionalMarginTop: 50
    });
    
    
    //----------------------------//
    //      Slider y Banners      //
    //----------------------------//
    
    // Slider
    $('#slider').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        items: 1,
    });
    
    $('#carrusel-banners').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        items: 1,
    });
    
    $('#catalogo').owlCarousel({ 
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        items: 1,
    });

    // Carrusel Destacadas
    $('#carrusel-destacadas').owlCarousel({
        // loop: true,
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true,
        dots: false,
        center: true,
        responsive: {
            0:{
                items: 1
            },
            630:{
                items: 2
            },
            992:{
                items: 3
            },
            1200:{
                items: 4
            },
            1800:{
                items: 5
            }
        },
        nav: true,
    navText: [
      "<i class='fa fa-chevron-left'></i>",
      "<i class='fa fa-chevron-right'></i>"
    ]
    });
    
    // Slider
    $('#carrusel-notas').owlCarousel({
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0:{
                loop: $('#carrusel-notas > *').length > 1,
                items: 1
            },
            630:{
                loop: $('#carrusel-notas > *').length > 2,
                items: 2
            },
            992:{
                loop: $('#carrusel-notas > *').length > 3,
                items: 3
            },
            1200:{
                loop: $('#carrusel-notas > *').length > 3,
                items: 3
            }
        }
    });
    
  // Slider
  $('#mas-buscados').owlCarousel({
    margin: 0,
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
      0:{
        loop: $('#mas-buscados > *').length > 1,
        items: 2
      },
      630:{
        loop: $('#mas-buscados > *').length > 2,
        items: 3
      },
      992:{
        loop: $('#mas-buscados > *').length > 3,
        items: 4
      },
      1200:{
        loop: $('#mas-buscados > *').length > 3,
        items: 5
      }
    }
  });

    $('#banners-horizontal .banners').owlCarousel({
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0:{
                loop: $('#banners-horizontal .banners > *').length > 1,
                items: 1
            },
            630:{
                loop: $('#banners-horizontal .banners > *').length > 2,
                items: 2
            },
            992:{
                loop: $('#banners-horizontal .banners > *').length > 3,
                items: 3
            },
            1200:{
                loop: $('#banners-horizontal .banners > *').length > 3,
                items: 3
            },
        },
    });
    
    $('#banners-logos .banners').owlCarousel({
        loop: true,
        margin: 50,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0:{
                items: 1
            },
            630:{
                items: 3
            },
            992:{
                items: 4
            },
            1200:{
                items: 5
            },
        },
    }); 

    $('#banner-sidebar .banners').owlCarousel({
        loop: $('#banner-sidebar .banners > *').length > 1,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        items: 1,
    });
    


    /*galeria de fotos catalogo*/
    $('#galeria-fotos-cat').owlCarousel({
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true, 
        responsive: {
            0:{
                loop: $('#galeria-fotos-cat > *').length > 1,
                items: 1
            },
            630:{
                loop: $('#galeria-fotos-cat > *').length > 2,
                items: 2
            },
            992:{
                loop: $('#galeria-fotos-cat > *').length > 3,
                items: 3
            },
            1200:{
                loop: $('#galeria-fotos-cat > *').length > 3,
                items: 3
            }
        }
    });

    //----------------------------//
    //         Fancybox           //
    //----------------------------//
    
    $(".gallery a").attr('rel', 'galeria').fancybox({ padding : 0, helpers: { title : null }, });
    $(".fancybox").attr('rel', 'galeria').fancybox({ padding : 0, helpers: { title : null }, });
    $(".fancybanner").fancybox({ padding : 0, helpers: { title : null }, });
    
    $(".galeria-item a").attr('rel', 'galeria-video').fancybox({ padding : 0, helpers: { title : null }, });

    //----------------------------//
    //       Menu movil           //
    //----------------------------//
    $('.btn-movil').click(function(e){
        $('#row-menu-movil').slideToggle(260);
    });
    $("#menu-menu-principal li > .sub-menu > li:has(ul)").find("a:first").append("<i class='fa fa-angle-right mas'></i>");

    //----------------------------//
    //         Buscador           //
    //----------------------------//    
    $('.buscador-btn').click(function(e){
        e.preventDefault();
        $('.form-buscador').toggleClass('showing-search');
        return false;
    });
    
    
    
    //----------------------------//
    //         Owl Gallery        //
    //----------------------------//
    
    $('#entry .owl-gallery')
  .filter(function(){ return !this.id.match(/custom-collapse-\-\d+/)})
  .owlCarousel({
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
        0:{
            loop: $('#entry .owl-gallery > *').length > 1,
            items: 1
        },
        630:{
            loop: $('#entry .owl-gallery > *').length > 2,
            items: 2
        },
        992:{
            loop: $('#entry .owl-gallery > *').length > 3,
            items: 3
        },
        1200:{
            loop: $('#entry .owl-gallery > *').length > 4,
            items: 4
        }
    }
    });
        $('#banners-index').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        lazyLoad: true,
        responsive: {
            0:{
                items: 1
            },
            630:{
                items: 2
            },
            992:{
                items: 3
            },
            1200:{
                items: 3
            },
        },
    });
    $("#entry .owl-gallery .item a").fancybox({ padding : 0, helpers: { title : null }, });

    
  //----------------------------//
  //    Buscador inteligente    //
  //----------------------------//
  var selected = 0;
  $('.form-buscador .form-control').on('keyup', function(e){
      var value = $(this).val(); 
      if(value)
          $(this).addClass("buscando");
      else
          $(this).removeClass("buscando");
          
      $('.buscador-filtro span').html(value);
      
      $('.buscador-filtro a').each(function(i,e){
          var buscar = $(e).data('buscar');
          $(e).attr('href', "?s=" + value + "&buscar=" + buscar);
      });
      
      // e.keyCode = 40 Abajo
      // e.keyCode = 38 Arriba
      
      if(e.keyCode == 40){
          selected++;
      } else if(e.keyCode == 38){
          selected--;
      }
      
      if(selected > 1)
          selected = 1;
      if(selected < 0)
          selected = 0;

      $('.buscador-filtro li').removeClass('selected').eq(selected).addClass("selected");
      
      if(e.keyCode == 40 || e.keyCode == 38){
          var buscar = $('.buscador-filtro li').eq(selected).find('a').data('buscar');
          $('.form-buscador input[name=buscar]').val(buscar);
          e.preventDefault();
          return false;
      }
  });
  
  $('.buscador-filtro').on('mouseleave', function(){
      $('.buscador-filtro li').removeClass('selected').eq(selected).addClass("selected");
  });
  
  $('.buscador-filtro li').on('hover', function(){
      $('.buscador-filtro li').removeClass('selected');
      $(this).addClass("selected");
  });

    
    //----------------------------//
    //  Abrir Collapse con URL    //
    //----------------------------//
  
    var anchor = window.location.hash;
    if ( anchor.match('#') ) {
        $(".panel-collapse.in").collapse('hide');
    }
    $(anchor).collapse('show');

  $('a[href*=#]').on('click', function(){
    var url = $(this).attr('href');
    if(window.location.href.split('#')[0] == url.split('#')[0]){
      if(url.indexOf('#custom-collapse') !== -1){
        // var offs = $(".panel-collapse.in").height();
        $(".panel-collapse.in").collapse('hide');

        var panel = $(url.substring(url.indexOf('#')));
        panel.collapse('show');

        $('html, body').animate({scrollTop: panel.offset().top - 50 }, 500);
        // $('html, body').scrollTop(panel.offset().top);
      }
    }
  });

});


    //----------------------------//
    //      Responsive Tabs       //
    //----------------------------//
    
(function($) {

  'use strict';

  $(document).on('show.bs.tab', '.nav-tabs.responsive [data-toggle="tab"]', function(e) {
    var $target = $(e.target);
    var $tabs = $target.closest('.nav-tabs.responsive');
    var $current = $target.closest('li');
    var $parent = $current.closest('li.dropdown');
        $current = $parent.length > 0 ? $parent : $current;
    var $next = $current.next();
    var $prev = $current.prev();
    var updateDropdownMenu = function($el, position){
      $el
        .find('.dropdown-menu')
        .removeClass('pull-xs-left pull-xs-center pull-xs-right')
        .addClass( 'pull-xs-' + position );
    };

    $tabs.find('>li').removeClass('next prev');
    $prev.addClass('prev');
    $next.addClass('next');
    
    updateDropdownMenu( $prev, 'left' );
    updateDropdownMenu( $current, 'center' );
    updateDropdownMenu( $next, 'right' );
  });

})(jQuery);


jQuery(function(){
  $('div[id^=custom-collapse-]').on('shown.bs.collapse', function () {
    var owl = $(this).find('.owl-gallery');
    initialize_owl(owl);
    console.log("show");
  }).on('hide.bs.collapse', function () {
    var owl = $(this).find('.owl-gallery');
    destroy_owl(owl);
    console.log("hide");
  });

  function initialize_owl(el) {
    el.owlCarousel({
      margin: 10,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0:{
          loop: $('#entry .owl-gallery > *').length > 1,
          items: 1
        },
        630:{
          loop: $('#entry .owl-gallery > *').length > 2,
          items: 2
        },
        992:{
          loop: $('#entry .owl-gallery > *').length > 3,
          items: 3
        },
        1200:{
          loop: $('#entry .owl-gallery > *').length > 4,
          items: 4
        }
      }
    });
  }

  function destroy_owl(el) {
      el.trigger("destroy.owl.carousel");
      el.find('.owl-stage-outer').children(':eq(0)').unwrap();
  }
});


//----------------------------//
//        Sticky Header        //
//----------------------------//
// var trigger_sticky_header = function() {
//     var header = $('.header');
//     var st = $(window).scrollTop();
//     var header_bot = header.position().top + header.height();
//     if (header.hasClass('logged-in')) header_bot -= 32;
//     if (st > header_bot) {
//         header.addClass('fixed-header');
//     } else {
//         header.removeClass('fixed-header');
//     }
// }
// $(window).scroll(trigger_sticky_header);

//----------------------------//
//        Scroll maps         //
//----------------------------//
jQuery(window).ready(function($) {
    $('#map_canvas').addClass('scrolloff');
    $('#mapa_google').on('click', function() {
        $('#map_canvas').removeClass('scrolloff');
    });
    $("#map_canvas").mouseleave(function() {
        $('#map_canvas').addClass('scrolloff');
    });
});

//----------------------------//
//        Same Height         //
//----------------------------//
var update_all_hights = function() {
    jQuery('.cols-same-height > div').css('height', 'auto');
    jQuery('.cols-same-height').each(function() {
        var mh = 0;
        jQuery(this).children('div').each(function(_, e) {
            var h = jQuery(e).innerHeight();
            mh = h > mh ? h : mh;
        }).css('height', mh);
    });
};
jQuery(window).ready(function($) {
    $(window).on('resize', update_all_hights).trigger('resize');
});