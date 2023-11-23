window.onload =function () {
    $('#loadhb').fadeOut();
    $('body').removeClass('hidden');
    $('#whatsapp-floot').removeClass('d-none');
    $('[data-visible="visible"]').removeClass('d-none');
}
$(document).ready(function(){

    var obj_act_top = $(this).scrollTop();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
            $("nav.navbar").removeClass('navbar-fondo');
        }
        else {
            $('#back-to-top').fadeOut();
            $("nav.navbar").addClass('navbar-fondo');
        }
    });

    $('a#back-to-top').click(function () {

        $('body,html').animate({
            scrollTop: 0
        }, 500);

        return false;

    });

    if ($(this).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
        $("nav.navbar").removeClass('navbar-fondo');
    }
    else {
        $('#back-to-top').fadeOut();
        $("nav.navbar").addClass('navbar-fondo');
    }
    fancybox();
    owlCarousel();
    // imgBot();

    setTimeout(function() {
        $("a.img-bot div").removeClass("display-none-item");
        $("a.img-bot div").removeClass("animated fadeOut");
        $("a.img-bot div").addClass("animated slideInRight");
    }, 1000);
});
function owlCarousel() {
    var owl = $('.slider_card');

    owl.owlCarousel({
        loop:true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        responsive: {
            0:{
                items:1,
                nav:false,
                dots: false,
            },
            600:{
                items:2,
                nav:false,
                dots: false,
            },
            1000:{
                items:2,
                dots: false,
                nav:false
            },
        }
    });

    $('a.owl-carousel-img-left').click(function(event){
        event.preventDefault();
        owl.trigger('prev.owl.carousel', [00]);
    })

    $("a.owl-carousel-img-right").click(function(event){
        event.preventDefault();
        owl.trigger('next.owl.carousel', [300]);
    });



    var owl_secund = $('.owl-carousel-second');

    owl_secund.owlCarousel({
        items: 5,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsiveClass:true,
        nav: false,
        dots: false,
        responsive: {
          0: {
            items: 2,
            nav: false,
            dots: false,
          },
          600: {
            items: 3,
            nav: false,
            dots: false,
          },
          1000: {
            items: 5,
            nav: false,
            loop: true,
            margin: 10,
            dots: false,
          }
        }
    });

    $('a.owl-carousel-product-left').click(function(event){
        event.preventDefault();
        owl_secund.trigger('prev.owl.carousel', [300]);
    })

    $("a.owl-carousel-product-right").click(function(event){
        event.preventDefault();
        owl_secund.trigger('next.owl.carousel', [300]);
    });

}
function fancybox() {
    $('.fancybox').fancybox({
        autoSize: true,
        fitToView: true,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        padding: 4,
        helpers: {
            overlay: {
              locked: false
            }
        }
    });


    $('.fancybox-gallery').fancybox({
        showCloseButton: false,
        padding: 5,
        width: '450',
        autoSize: false,
    });
}
// $("a.img-bot").hover(function() {
//         $("a.img-bot div").removeClass("display-none-item");
//         $("a.img-bot div").removeClass("animated fadeOut");
//         $("a.img-bot div").addClass("animated slideInRight");
//     }, function() {
//         $("a.img-bot div").removeClass("animated slideInRight");
//         $("a.img-bot div").addClass("animated fadeOut");

//         setTimeout(function() {
//             $("a.img-bot div").addClass("display-none-item");
//         }, 500);
//     }
// )

// function imgBot() {
//     $("a.img-bot").mouseover(function(){
//         $("a.img-bot div").removeClass("display-none-item");
//         $("a.img-bot div").removeClass("animated fadeOut");
//         $("a.img-bot div").addClass("animated slideInRight");
//     });

//     $("a.img-bot").mouseout(function(){
//         $("a.img-bot div").removeClass("animated slideInRight");
//         $("a.img-bot div").addClass("animated fadeOut");
//     });
// }

$(document).on('submit','[data-action="chat-box"]',function (e) {
    e.preventDefault();
    var msg = $('[data-action="chat-box"] input[name="chat"]').val(),
        data = $(this).serialize(),
        route   = $(this).attr('action'),
        html = '';

    console.log($('[data-action="chat-box"] input[name="chat"]').val());
    html = ''+
        '<div class="me-msg">'+
            ''+msg+''+
        '</div>'+
    '';
    $('.scroller').append(html);
    $('[data-action="chat-box"] [name="chat"]').val('');

    $.ajax({
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
        url: route,
        dataType: 'json',
        data: data,
        beforeSend: function()
        {

        },

    }).done(function (response) {
        htm = ''+
            '<div class="ms-alexa">'+
                '<img src="'+response.img_chat+'" class="img-alexa-chat"/>'+
                '<div class="alexa">'+
                    ''+response.response_msg.description+''+
                '</div>'+
            '</div>'
        '';
        $('.scroller').append(htm);
        console.log(response);

        // setTimeout(function(){
        //     $('[data-notify="dismiss"]').click();
        // }, 3000);

    }).fail(function () {
        // alert("Error");
    });
});


$(document).on('submit','[data-action="chat-box-movil"]',function (e) {
    e.preventDefault();
    var msg = $('[data-action="chat-box-movil"] input[name="chat"]').val(),
        data = $(this).serialize(),
        route   = $(this).attr('action'),
        html = '';

    console.log(msg);
    html = ''+
        '<div class="me-msg">'+
            ''+msg+''+
        '</div>'+
    '';
    $('.scroller-movil').append(html);
    $('[data-action="chat-box-movil"] [name="chat"]').val('');

    $.ajax({
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
        url: route,
        dataType: 'json',
        data: data,
        beforeSend: function()
        {

        },

    }).done(function (response) {
        htm = ''+
            '<div class="ms-alexa">'+
                '<img src="'+response.img_chat+'" class="img-alexa-chat"/>'+
                '<div class="alexa">'+
                    ''+response.response_msg.description+''+
                '</div>'+
            '</div>'
        '';
        $('.scroller-movil').append(htm);
        console.log(response);

        // setTimeout(function(){
        //     $('[data-notify="dismiss"]').click();
        // }, 3000);

    }).fail(function () {
        // alert("Error");
    });
});
$(document).on('click','[data-action="close-chat-bot"]',function () {
    $('[data-close="chat-bot"] .row').addClass('display-none-item');

    $('[data-close="chat-bot-movil"] .chat-header').addClass('display-none-item');
    $('[data-close="chat-bot-movil"] .chat-body-movil').addClass('display-none-item');
    $('[data-close="chat-bot-movil"] .chat-footer').addClass('display-none-item');

    setTimeout(function() {
        $("a.img-bot div").removeClass("display-none-item");
        $("a.img-bot div").removeClass("animated fadeOut");
        $("a.img-bot div").addClass("animated slideInRight");
    }, 1000);
});
$(document).on('click','[data-action="open-chat"]',function (e) {
    e.preventDefault();
    $('[data-close="chat-bot"] .row').removeClass('display-none-item');

    $('[data-close="chat-bot-movil"] .chat-header').removeClass('display-none-item');
    $('[data-close="chat-bot-movil"] .chat-body-movil').removeClass('display-none-item');
    $('[data-close="chat-bot-movil"] .chat-footer').removeClass('display-none-item');

    $("a.img-bot div").removeClass("animated slideInRight");
    $("a.img-bot div").addClass("animated fadeOut");

    setTimeout(function() {
        $("a.img-bot div").addClass("display-none-item");
    }, 500);

});
