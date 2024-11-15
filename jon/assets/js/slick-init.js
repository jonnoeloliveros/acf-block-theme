jQuery(document).ready(function ($) {
    const heroSlider = () => {
        $('.slider_section-inner').slick({
            arrows: false,
            dots: false,
            fade: true,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnFocus: true,
            pauseOnHover: true
        }).on('setPosition', function () {
            $('.hero-slider-item').css({ 'display': '-webkit-box', 'display': '-ms-flexbox', 'display': 'flex' });
        }).on('afterChange', function (event, slick, currentSlide) {
            let backgroundColor = $(slick.$slides[currentSlide]).find('.hero-slider-item').data('background-color');
            $(this).closest('.slider_section').css('background-color', backgroundColor);
        });
    }

    const clientSlider = () => {
        $('.slick-carousel').slick({
            slidesPerRow: 2,
            appendArrows: $('.client-slick-nav'),
            prevArrow: '<button type="button" role="presentation" class="client-slick-prev"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></button>',
            nextArrow: '<button type="button" role="presentation" class="client-slick-next"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>',
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        slidesPerRow: 1
                    }
                }
            ]
        });
    }

    heroSlider();
    clientSlider();

    if (typeof wp !== 'undefined' && wp.domReady) {
        wp.domReady(() => {
            wp.data.subscribe(() => {
                const isEditorReady = wp.data.select('core/block-editor').getBlocks().length > 0;
                if (isEditorReady && !$('.slider_section-inner').hasClass('slick-initialized')) {
                    heroSlider();
                }

                if (isEditorReady && !$('.slick-carousel').hasClass('slick-initialized')) {
                    clientSlider();
                }
            });
        });
    }
});

