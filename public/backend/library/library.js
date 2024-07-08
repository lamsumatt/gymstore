(function ($) {
    "use strict";
    var ht = {}
    var _token = $('meta[name="csrf-token"]').attr('content');


    ht.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#1AB394' });
        });
    }

    ht.select2 = () => {
        if ($('.setupSelect2').length) {
            $('.setupSelect2').select2();
        }
    }

    ht.changeStatus = () => {
        if ($('.status').length) {
            $(document).on('change', '.status', function (e) {
                let _this = $(this);
                let option = {
                    'value': _this.val(),
                    'modelId': _this.attr('data-modelId'),
                    'model': _this.attr('data-model'),
                    'field': _this.attr('data-field'),
                    '_token': _token
                }

                $.ajax({
                    url: domain + "ajax/location/getLocation", // Add a leading slash to make it an absolute URL
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function (res) {
                       console.log(res);
                    },
                    error: function (jqxhr, textStatus, errorThrown) {
                        console.log('Error: ' + textStatus + ' ' + errorThrown); // Xử lý lỗi nếu có
                    }
                });

                console.log(option);
                e.preventDefault();
            })
        }
    }

    $(document).ready(function () {
        ht.switchery();
        ht.select2();
        ht.changeStatus();
    });
})(jQuery);