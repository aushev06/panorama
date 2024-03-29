//Add preload to DOM
$('body').prepend('<div id="preload" class="d-none"><div class="preload-box"><div class="line"></div><div class="line"></div><div class="line"></div></div></div>')

//Wait for document loaded
window.onload = function () {


    //Main js file
    $(document).ready(function () {
        "use strict";

        $(document).on('click', '.gloves-add', function () {
            const elem = document.createElement("div");
            elem.classList.add('form-row');
            elem.classList.add('align-items-center');
            elem.innerHTML = $($(".gloves > .form-row.align-items-center")[0]).html();
            $('.gloves').append(elem);
        });

        $('input[name="delivery_type"]').on('change', function () {
            const elem = $(this);

            if (elem.attr('id') === 'pickup') {
                $('.hide-pickup').toggleClass('d-none');
            }

            if (elem.attr('id') !== 'pickup' && $('.hide-pickup').hasClass('d-none')) {
                $('.hide-pickup').toggleClass('d-none');
            }
        })


        /****************************************************
         Scroll up button
         ****************************************************/

        $("#phone").mask("+7(999) 999-99-99");
        $.scrollUp({
            scrollName: 'scrollUp',
            scrollDistance: 700,
            scrollFrom: 'top',
            scrollText: '<i class="arrow_carrot-up"></i>',
            easingType: 'easeInOutCirc',
            zIndex: 105,
        });
        /****************************************************
         Navigation
         ****************************************************/
        $('header .department-dropdown-menu').slideUp();

        $('header .department-menu').on('click', function (event) {
            $(this).next().slideToggle('100');
            $(this).children('span').children().toggleClass('arrow_carrot-down arrow_carrot-up');
        });

        $('#mobile-menu #ogami-mobile-menu .sub-menu').slideUp();
        $('#mobile-menu #ogami-mobile-menu .sub-menu--expander').on('click', function (event) {
            $(this).next('.sub-menu').slideToggle('100');
            $(this).children().toggleClass('icon_minus-06 icon_plus');
        });

        $('.mobile-menu--control').on('click', function (event) {
            event.preventDefault()
            $('#ogami-mobile-menu').css({
                left: '0',
            });
            $('.ogamin-mobile-menu_bg').css({
                display: 'block',
            });
        });
        $('#mobile-menu--closebtn').on('click', closeMenu);
        $('.ogamin-mobile-menu_bg').on('click', closeMenu);

        function closeMenu(event) {
            $('#ogami-mobile-menu').css({
                left: '-100%',
            });
            $('.ogamin-mobile-menu_bg').css({
                display: 'none',
            });
        }

        (function ($) {
            function mediaSize() {
                if (window.matchMedia('(min-width: 1200px)').matches) {
                    $('header .department-dropdown-menu.down').slideDown();
                    $('header .department-menu_block.down .department-menu span i').removeClass('arrow_carrot-down').addClass('arrow_carrot-up')
                } else {
                    $('header .department-dropdown-menu.down').slideUp();
                    $('header .department-menu_block.down .department-menu span i').removeClass('arrow_carrot-up').addClass('arrow_carrot-down')
                }
            };
            mediaSize();
            window.addEventListener('resize', mediaSize, false);
        })(jQuery);

        /****************************************************
         Slider
         ****************************************************/
        function mainSlider() {
            var BasicSlider = $('.slider_wrapper');
            BasicSlider.on('init', function (e, slick) {
                var $firstAnimatingElements = $('.slider-block:first-child').find('[data-animation]');
                doAnimations($firstAnimatingElements);
            });
            BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
                var $animatingElements = $('.slider-block[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
                doAnimations($animatingElements);
            });
            BasicSlider.slick({
                // appendArrows: $('.slider_wrapper .slider-control'),
                prevArrow: '<button type="button" class="slick-prev"><i class="arrow_carrot-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="arrow_carrot-right"></i></button>',
                infinite: true,
                fade: true,
                // autoplay: true,
                speed: 800,
                cssEase: 'ease-out',
            })

            function doAnimations(elements) {
                var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                elements.each(function () {
                    var $this = $(this);
                    var $animationDelay = $this.data('delay');
                    var $animationType = 'animated ' + $this.data('animation');
                    $this.css({
                        'animation-delay': $animationDelay,
                        '-webkit-animation-delay': $animationDelay
                    });
                    $this.addClass($animationType).one(animationEndEvents, function () {
                        $this.removeClass($animationType);
                    });
                });
            }
        }

        mainSlider();
        /****************************************************
         Tab
         ****************************************************/
        tabBundle('#tab');
        tabBundle("#tab-so1");
        tabBundle("#tab-so2");

        // Call tab & tab animation for product
        function tabBundle(tab) {
            let tabControl = tab + " " + ".tab-control a";
            let tabProduct = tab + " " + ".product";
            $(tab).tabs();
            $(tabControl).on('click', function (event) {
                $(this).parent().siblings().children().removeClass('active')
                $(this).addClass('active')
                $(tabProduct).addClass('animated zoomIn').one('animationend webkitAnimationEnd oAnimationEnd', function (event) {
                    $(this).removeClass('animated zoomIn')
                });
            });
        }

        $('#tab-so3').tabs();
        $('#tab-so3 ul li a').on('click', function (event) {
            $(this).parent().siblings().removeClass('active')
            $(this).parent().addClass('active')
        });

        /****************************************************
         Countdown
         ****************************************************/
        createCountDown('#event-countdown', '2020/10/10');
        createCountDown('#event-countdown-2', '2020/8/10');
        createCountDown('#event-countdown-3', '2020/7/10');
        createCountDown('#event-countdown-4', '2019/7/27');

        // Create new countdown day
        function createCountDown(elem, end) {
            $(elem).countdown(end, function (event) {
                var $this = $(this).html(event.strftime(''
                    + '<div class="countdown-number"><span>%d</span><br>days</div> '
                    + '<div class="countdown-number"><span>%H</span><br>hr</div> '
                    + '<div class="countdown-number"><span>%M</span><br>min</div> '
                    + '<div class="countdown-number"><span>%S</span><br>sec</div>'));
            });
        }

        /****************************************************
         Home 1 Slick
         ****************************************************/
        $('.partner_block').slick({
            infinite: true,
            arrows: false,
            autoplay: false,
            swipe: false,
            responsive: [
                {
                    breakpoint: 1770,
                    settings: {
                        autoplay: true,
                        slidesToShow: 6,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 996,
                    settings: {
                        autoplay: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        autoplay: true,
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        autoplay: true,
                    }
                }
            ]
        })
        /****************************************************
         Home 3 Slick
         ****************************************************/
        $('.deal-of-week_slide .week-deal_bottom').slick({
            arrows: true,
            slidesToScroll: 1,
            appendArrows: $('.week-deal_top .week-deal_control'),
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            autoplay: true,
            swipe: false,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 996,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        })

        $('.home3-product-block .customer-satisfied .customer-satisfied_wrapper').slick({
            arrows: false,
            slidesToScroll: 1,
            dots: true,
            appendDots: $('.customer-satisfied .customer-satisfied_control'),
            dotsClass: 'dots-wrap',
            autoplay: true,
            swipe: false,
            adaptiveHeight: true,
            customPaging: function (slider, i) {
                return '<div class="dot-control"></div>';
            },
        })
        /****************************************************
         Home 4 Slick
         ****************************************************/
        $('.from-blog .news_wrapper').slick({
            arrows: true,
            slidesToScroll: 1,
            slidesToShow: 3,
            arrows: false,
            autoplay: false,
            swipe: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 996,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 660,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        })
        /****************************************************
         Home 5 Mini product Slick
         ****************************************************/
        miniProduct('.mini-latest-products')
        miniProduct('.top-rate-products')
        miniProduct('.review-products')

        function miniProduct(target) {
            var $callSlick = target + " " + '.mini-product_bottom';
            var $appendArrows = target + " " + '.mini-product_control';
            $($callSlick).slick({
                appendArrows: $($appendArrows),
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 996,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            })
        }

        /****************************************************
         Shop Price filter
         ****************************************************/
        const min = $("#slider-range").data('min');
        const max = $("#slider-range").data('max');
        $("#slider-range").slider({
            range: true,
            min: min,
            max: max,
            classes: {
                "ui-slider": "slider-bar",
                "ui-slider-range": "range-bar",
                "ui-slider-handle": "handle"
            },
            values: [min, max],
            slide: function (event, ui) {
                $("#amount").val("₽" + ui.values[0] + " - ₽" + ui.values[1]);
            },
            change: function (event, ui) {
                const values = $('#slider-range').slider('values');
                $('#preload').fadeIn('400');
                $.ajax({
                    url: location.href,
                    data: {prices: values},
                    success: function (html) {
                        let products = $(html).find(".row.no-gutters-sm .col-12.col-md-4");
                        //products.addClass('grid-view')
                        $(".row.no-gutters-sm").html(products);
                        $('#preload').fadeOut('400');
                    }

                })
            }
        });
        $("#amount").val("₽" + $("#slider-range").slider("values", 0) +
            " - ₽" + $("#slider-range").slider("values", 1));

        $(".filter").on('click', function () {
            const values = $('#slider-range').slider('values');
            $('#preload').fadeIn('400');
            $.ajax({
                url: location.href,
                data: {prices: values},
                success: function (html) {
                    let products = $(html).find(".row.no-gutters-sm .col-12.col-md-4");
                    //products.addClass('grid-view')
                    $(".row.no-gutters-sm").html(products);
                    $('#preload').fadeOut('400');
                }

            })

        });
        /****************************************************
         Shop change view
         ****************************************************/
        var $grid = $('.shop-layout #grid-view')
        var $list = $('.shop-layout #list-view')

        $list.on('click', function (event) {
            event.preventDefault
            $grid.removeClass('active')
            $(this).addClass('active')
            $('.grid-buttons').toggleClass('d-none');
            $('.shop-products_bottom .product').removeClass('grid-view zoomIn').addClass('list-view animated fadeInUp')
            $('.shop-products_bottom--fullwidth .product').removeClass('grid-view zoomIn').addClass('full-list-view animated fadeInUp')
            $('.shop-products_bottom .col-12.col-md-4').removeClass('col-12 col-md-4').addClass('col-12')
            $('.shop-products_bottom--fullwidth .col-12.col-md-4.col-xxl-3.col-xxxl').removeClass('col-12 col-md-4 col-xxl-3 col-xxxl').addClass('col-12')
        });

        $grid.on('click', function (event) {
            event.preventDefault
            $list.removeClass('active')
            $(this).addClass('active')
            $('.grid-buttons').toggleClass('d-none');
            $('.shop-products_bottom .product').removeClass('list-view fadeInUp').addClass('grid-view animated zoomIn')
            $('.shop-products_bottom--fullwidth .product').removeClass('full-list-view fadeInUp').addClass('grid-view animated zoomIn')
            $('.shop-products_bottom .col-12').removeClass('col-12').addClass('col-12 col-md-4')
            $('.shop-products_bottom--fullwidth .col-12').removeClass('col-12').addClass('col-12 col-md-4 col-xxl-3 col-xxxl')
        });

        if ($grid.hasClass('active')) {
            $('.shop-products_bottom .product').addClass('grid-view')
            $('.shop-products_bottom--fullwidth .product').addClass('grid-view')
        }
        /****************************************************
         Shop sidebar fixed position
         ****************************************************/
        (function ($) {
            function mediaSize() {
                if (window.matchMedia('(min-width: 1200px)').matches) {
                    $('.shop-layout .shop-sidebar').removeClass('fixed')
                    $('.blog-layout .blog-sidebar').removeClass('fixed')
                    $('#filter-sidebar--closebtn').hide()
                    $('.shop-layout .shop-sidebar').removeAttr("style");
                    $('.blog-layout .blog-sidebar').removeAttr("style");
                    $('.shop-products_top .col-6.text-right').hide()
                    $('#show-filter-sidebar').hide()
                    $('.filter-sidebar--background').hide()
                } else {
                    $('.shop-layout .shop-sidebar').addClass('fixed')
                    $('.blog-layout .blog-sidebar').addClass('fixed')
                    $('#filter-sidebar--closebtn').show()
                    $('.shop-products_top .col-6.text-right').show()
                    $('#show-filter-sidebar').show()
                }
            };
            mediaSize();
            window.addEventListener('resize', mediaSize, false);
        })(jQuery);

        function sidebarControl() {
            $('#show-filter-sidebar').on('click', function (event) {
                event.preventDefault();
                $('.shop-layout .shop-sidebar').css({
                    left: '0',
                    visibility: 'visible',
                });
                $('.blog-layout .blog-sidebar').css({
                    left: '0',
                    visibility: 'visible',
                });
                $('.filter-sidebar--background').css({
                    display: 'block',
                });
            });

            $('#filter-sidebar--closebtn').on('click', function (event) {
                event.preventDefault();
                $('.shop-layout .shop-sidebar').css({
                    left: '-100%',
                    visibility: 'hidden',
                });
                $('.blog-layout .blog-sidebar').css({
                    left: '-100%',
                    visibility: 'hidden',
                });
                $('.filter-sidebar--background').css({
                    display: 'none',
                });
            });
        }

        sidebarControl()
        /****************************************************
         Shop detail slider slide
         ****************************************************/
        $('.shop-detail .big-img').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slide-img',
            swipe: false,
            infinite: false,
        });
        $('.shop-detail .slide-img').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.big-img',
            focusOnSelect: true,
            appendArrows: $('.slide-img'),
            adaptiveHeight: false,
            infinite: false,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        });
        /****************************************************
         Shop detail zoom
         ****************************************************/
        $('.shop-detail .big-img_block').zoom({})
        /****************************************************
         About us farmer
         ****************************************************/
        tilt(".our-farmer-block")
        tilt(".our-farmer-block--2")
        tilt(".our-farmer-block--3")
        tilt(".our-farmer-block--4")

        function tilt(selector) {
            VanillaTilt.init(document.querySelector(selector), {
                max: 20,
                glare: true,
                "max-glare": 0.4,
                scale: 1.05,
                perspective: 800,
            });
        }

        /****************************************************
         FAQ question
         ****************************************************/
        $("#accordion").accordion({
            icons: false,
            heightStyle: "content",
            classes: {
                'ui-accordion-header-active': 'question-active'
            }
        });


        /****************************************************
         Quick view
         ****************************************************/

        $(document).on('click', '.view', function (event) {
            event.preventDefault();
            const id = $(this).attr('data-id');

            $.ajax({
                url: `/api/food/${id}?show=true`,
                success: function (html) {
                    //Wirte Quick view block to DOM
                    $('body').prepend(html)
                    $('#quickview .big-img_qv').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        asNavFor: '.slide-img_qv',
                        swipe: false,
                        infinite: false,
                    });
                    $('#quickview .slide-img_qv').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: '.big-img',
                        focusOnSelect: true,
                        appendArrows: $('.slide-img_qv'),
                        adaptiveHeight: false,
                        infinite: false,
                        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                    });
                    $('#quickview-close-btn').on('click', function (event) {
                        $('#quickview').remove()
                    });
                }
            })

        });

    });
}
