(function ($) {
    "use strict";

    var ht = {};

    ht.getLocation = () => {
        $(document).on('change', '.location', function () {
            let _this = $(this);
            let option = {
                'data' :{
                    'location_id': _this.val(),
                },
                'target' : _this.attr('data-target')
            }
            ht.sendDataTogetLocation(option);
           
        });
    };
    ht.sendDataTogetLocation = (option) => {
        $.ajax({
            url: domain + "ajax/location/getLocation", // Add a leading slash to make it an absolute URL
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function (res) {
                $('.'+option.target).html(res.html);

                if(district_id != '' && option.target == 'districts'){
                    $(".district").val(district_id).trigger('change');
                }

                if(ward_id != '' && option.target == 'wards'){
                    $(".wards").val(ward_id).trigger('change');
                }
                
            },
            error: function (jqxhr, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' ' + errorThrown); // Xử lý lỗi nếu có
            }
        });
    };

    ht.loadCity = () => {
        if(province_id != ''){
            $(".province").val(province_id).trigger('change');
        }
    }
    $(document).ready(function () {
        ht.getLocation();
        ht.loadCity();
    });
})(jQuery);