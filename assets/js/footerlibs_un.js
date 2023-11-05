/* Lazy Load */
$(document).ready(function(){
    $('img.lazy').lazyload({
        effect: "fadeIn",
    });
});

/*  <========SON=========>>> Lazy Load SON */

/* Ürün Detay Yorumlar More */
    $(document).ready(function(){
        $(document).on('click','.urundetay-showmorespan',function(){
            var ID = $(this).attr('id');
            var PRO_ID = $(this).attr('data-id');
            $('.urundetay-showmorespan').hide();
            $('.urundetay_loding').show();
            $.ajax({
                type:'POST',
                url:'product-comment-more',
                data:{id: ID, pro_id: PRO_ID},
                success:function(html){
                    $('#urundetay-show-more-button'+ID).remove();
                    $('.product-comment-head-content-main').append(html);
                }
            });
        });
    });
/*  <========SON=========>>> Ürün Detay Yorumlar More SON */



/* Bootstrap Dropdown in div not close */
$(function() {

    $('.dropdown-toggle').on('click', function(event) {
        $('.dropdown-menu').slideToggle();
        event.stopPropagation();
    });

    $('.dropdown-menu').on('click', function(event) {
        event.stopPropagation();
    });

    $(window).on('click', function() {
        $('.dropdown-menu').slideUp();
    });

});
/*  <========SON=========>>> Bootstrap Dropdown in div not close SON */

/* Header HTML Bar Close */
function Hide(HideID)
{
    HideID.style.display = "none";
}
function Hide2(HideID)
{
    HideID.style.display = "none";
}
/*  <========SON=========>>> Header HTML Bar Close SON */


/* Shop Button Overlay */
jQuery(function ($) {

    $('#shopButton').click(function () {
        $(document).ajaxSend(function () {
            $("#shopButtonOverlay").fadeIn(300);
        });
        $.ajax({
            type: 'GET',
            success: function (data) {
                console.log(data);
            } }).
        done(function () {
            setTimeout(function () {
                $("#shopButtonOverlay").fadeOut(300);
            }, 15000);
        });
    });
});
/*  <========SON=========>>> Shop Button Overlay SON */

/* Clipboard Copy */
function copyToClipboard(elementId) {
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(elementId).innerHTML);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}
function log(){
    console.log('---')
}
/*  <========SON=========>>> Clipboard Copy SON */

/* Ürün Detay Tab */
$('#urundetaytabs').tabs({
    create: function() {
        var widget = $(this).data('ui-tabs');
        $(window).on('hashchange', function() {
            widget.option('active', widget._getIndex(location.hash));
        });

    }
});
/* Smooth Scroll - Click link to tab */
$(document).ready(function(){
    $('a[rel^="#"]').on('click',function (e) {
        e.preventDefault();
        var target = this.hash;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop':  $target.offset().top //no need of parseInt here
        }, 700, 'swing', function () {
            window.location.hash = target;
        });
    });
});
/*  <========SON=========>>> Ürün Detay Tab SON */

/* Ürün Detay Sepete Ekle - ENTER- Engel */
$('#entercancel').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});
/*  <========SON=========>>> Ürün Detay Sepete Ekle - ENTER- Engel SON */

/* Adet Custom İnput */
jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa fa-angle-up"></i></div><div class="quantity-button quantity-down"><i class="fa fa-angle-down"></i></div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function () {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

});
/*  <========SON=========>>> Adet Custom İnput SON */

/* Scroll TOp */
$(window).scroll(function () {
    if ($(this).scrollTop() >= 1000) {// If page is scrolled more than 50px
        $('#return-to-top').fadeIn(100); // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(500); // Else fade out the arrow
    }
});
$('#return-to-top').click(function () {// When arrow is clicked
    $('body,html').animate({
        scrollTop: 0 // Scroll to top of body
    }, );
});
/*  <========SON=========>>> Scroll TOp SON */
/* Link Popup */
function popup(mylink, windowname)
{
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string')
        href=mylink;
    else
        href=mylink.href;
    window.open(href, windowname, 'width=500,height=450,scrollbars=yes');
    return false;
}
/*  <========SON=========>>> Link Popup SON */



/* Orta Slider */
var swiper = new Swiper('.swiper-middle-container', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev' },

    autoplay: {
        delay: 5000,
    },
    speed:700,
});
/*  <========SON=========>>> Orta Slider SON */

/* Comments Carousel Slider */
var swiper = new Swiper('.swiper-comments', {
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    autoHeight: true, //enable auto height
    autoplay: {
        delay: 8500,
    },
    speed:900,
});
/*  <========SON=========>>> Comments Carousel Slider SON */

/* Markalar Carousel Slider */
var swiper = new Swiper('.swiper-clients', {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    slidesPerView: 7,
    spaceBetween: 15,
    breakpoints: {
        0: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        400: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        415: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 6,
            spaceBetween: 30,
        },
        800: {
            slidesPerView:6,
            spaceBetween: 30,
        },
        1000: {
            slidesPerView: 6,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1152: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1280: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1300: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1366: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1400: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1440: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1920: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        2560: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
    },
    autoHeight: true, //enable auto height
});
/*  <========SON=========>>> Markalar Carousel Slider SON */

/* story Sliderler */
var swiper = new Swiper('.story-slider', {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev' },
    slidesPerView: 3,
    spaceBetween: 0,
    breakpoints: {
        0: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        280: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 3,
            spaceBetween: 0,
        },
        400: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        415: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        540: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 6,
            spaceBetween: 10,
        },
        800: {
            slidesPerView:5,
            spaceBetween: 30,
        },
        1000: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1100: {
            slidesPerView: 7,
            spaceBetween: 30,
        },
        1155: {
            slidesPerView: 8,
            spaceBetween: 30,
        },
        1280: {
            slidesPerView: 10,
            spaceBetween: 30,
        },
        1440: {
            slidesPerView: 10,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 10,
            spaceBetween: 30,
        },
        1920: {
            slidesPerView: 10,
            spaceBetween: 30,
        },
        2560: {
            slidesPerView: 11,
            spaceBetween: 0,
        },
    },
    autoHeight: true, //enable auto height
});
/*  <========SON=========>>> story Sliderler SON */



/* HomePage Product Tabs */
var tabLinks = document.querySelectorAll(".home-product-tablinks");
var tabContent = document.querySelectorAll(".home-product-tabcontent");
tabLinks.forEach(function (el) {
    el.addEventListener("click", openTabs);
});
function openTabs(el) {
    var btnTarget = el.currentTarget;
    var country = btnTarget.dataset.country;
    tabContent.forEach(function (el) {
        el.classList.remove("active");
    });
    tabLinks.forEach(function (el) {
        el.classList.remove("active");
    });
    document.querySelector("#" + country).classList.add("active");
    btnTarget.classList.add("active");
}
/*  <========SON=========>>> HomePage Product Tabs SON */


/* Fırsatlar Vitrini Slider */
var swiper = new Swiper('.swiper-countdown-list', {
        autoplay: {
            delay: 5000,
        },
        speed:300,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev' },
        slidesPerView: 5,
        spaceBetween: 20,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        400: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        415: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        800: {
            slidesPerView:3,
            spaceBetween: 10,
        },
        1000: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        1152: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
        1280: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
        1300: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
        1366: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        1400: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        1440: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        1600: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        1920: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        2560: {
            slidesPerView: 5,
            spaceBetween: 20,
        },
    },
});
/*  <========SON=========>>> Fırsatlar Vitrini Slider SON */

/* Mobile Top links */
var swiper = new Swiper('.swiper-top-header', {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    slidesPerView: 1,
    spaceBetween: 15,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        375: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        400: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        415: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 10,
        }
    },
    autoHeight: true, //enable auto height
});
/*  <========SON=========>>> Mobile Top links SON */