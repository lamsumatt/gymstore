(function ($) {
    "use strict";
    var ht = {}
    var $doc = $(document);

    ht.switchery = () => {
        $('.js-switch').each(function () {
            // let _this = $(this);
            var switchery = new Switchery(this, { color: '#1AB394' });
        });
    }

    ht.select2 = () => {
        $('.setupSelect2').select2();
    }


    $doc.ready(function () {
        ht.switchery();
        ht.select2();
    });
})(jQuery)