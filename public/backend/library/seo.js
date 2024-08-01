(function ($) {
    "use strict";
    var ht = {}

    ht.seoPreview = () => {
        $('input[name=meta_title]').on('keyup', function () {
            let input = $(this);
            let value = input.val();
            $('.meta-title').html(value)
        })  
        $('.input[name=canonical]').css({
            'padding-left':  parseInt($('.baseUrl').outerWidth()) +10 ,
        })

        $('input[name=canonical]').on('keyup', function () {
            let input = $(this);
            let value = input.val();
            $('.canonical').html(domain + value + SUFFIX) 
        })

        $('textarea[name=meta-description]').on('keyup', function () {
            let input = $(this);
            let value = input.val();
            $('.meta-description').html(value)
        })
    }

    $(document).ready(function () {
        ht.seoPreview();
    });

})(jQuery)