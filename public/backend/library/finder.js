(function ($) {
    "use strict";
    var ht = {}

    ht.setupCkeditor = () => {
        if ($('.ckeditor').length) {
            $('.ckeditor').each(function () {
                let editor = $(this);
                let elementId = editor.attr('id');
                ht.ckeditor5(editor);
            });
        }
    }

    ht.ckeditor4 = (elementId) => {
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
            object.val('/' + fileUrl);
        }
        finder.popup();
    }

    $(document).ready(function () {
        ht.uploadImageToInput();
        ht.setupCkeditor();
    });


})(jQuery)