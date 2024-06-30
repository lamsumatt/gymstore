(function ($) {
    "use strict";

    var ht = {};
    ht.province =  () => {
            $(document).on('change', '.province', function () {
                
                let _this = $(this);
                let province_id = _this.val();
                $.ajax({
                    url: '/ajax/location/getLocation',
                    type: 'GET',
                    data: {'province_id': province_id},
                    dataType: 'json',
                    success: function (res) {                   
                       console.log(res);
                    },
                    error: function (jqxhr, textStatus, errorThrown) {
                        console.log('error' + textStatus + ' ' + errorThrown);
                    }
                });
            });
    };

    $(document).ready(function () {
        ht.province();
    });
})(jQuery);
