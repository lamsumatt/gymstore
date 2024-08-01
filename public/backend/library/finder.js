(function ($) {
    "use strict";
    var ht = {}

    ht.setupCkeditor = () => {
        if ($('.ck-editor').length) {
            $('.ck-editor').each(function () {
                let editor = $(this);
                let elementId = editor.attr('id');
                let elementHeight = editor.attr('data-height');
                ht.ckeditor4(elementId, elementHeight);
            });
        }
    }

    ht.uploadImageAvatar = () => {
        $('.image-target').click(function () {
            let input = $(this)
            let type = 'Images';
            ht.browserServerAvatar(input, type);
        });
    }

    ht.ckeditor4 = (elementId, elementHeight) => {
        if (typeof (elementHeight) == 'undefined') {
            elementHeight = 500;
        }
        CKEDITOR.replace(elementId, {
            height: 250,
            removeButtons: '',
            entities: true,
            allowedContent: true,
            toolbarGroups: [
                { name: 'clipboard', groups: ['clipboard', 'undo'] },
                { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'forms' },
                { name: 'tools' },
                { name: 'document', groups: ['mode', 'document', 'doctools'] },
                { name: 'others' },
                '/',
                { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
                { name: 'styles' },
                { name: 'colors' },
                { name: 'about' }
            ]
        })
    }

    ht.uploadImageToInput = () => {
        $('.upload-image').click(function () {
            let input = $(this)
            let type = input.attr('data-type');
            ht.setuCkFinder2(input, type);
        });
    }

    ht.setuCkFinder2 = (object, type) => {
        if (typeof (CKFinder) == 'undefined') {
            type = 'Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data) {
            object.val(fileUrl);
        }
        finder.popup();
    }

    ht.browserServerAvatar = (object, type) => {
        if (typeof (CKFinder) == 'undefined') {
            type = 'Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data) {
            object.find('img').attr('src', fileUrl);
            object.siblings('input').val(fileUrl);
        }
        finder.popup();
    }

    $(document).ready(function () {
        ht.uploadImageToInput();
        ht.setupCkeditor();
        ht.uploadImageAvatar();
    });


})(jQuery)