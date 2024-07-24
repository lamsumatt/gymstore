(function ($) {
    "use strict";
    var ht = {}

    ht.uploadImageToInput = ()=>{
        $('.upload-image').click(function () {
            let input = $(this)
            ht.setuCkFinder2(input);
        }); 
    }

    ht.setuCkFinder2 = (type) =>{
        if(typeof(CKFinder) == 'undefined'){
            type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function (fileUrl, data) {
        console.log(fileUrl);
    }
    finder.popup();
}
 
    $(document).ready(function () {
        ht.uploadImageToInput();
    });


})(jQuery)