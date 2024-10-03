jQuery(document).ready(function($) {
    function openMediaUploader(event) {
        event.preventDefault();
        var button = $(this);
        var imageField = button.siblings('.edit-menu-item-image');
        var imagePreview = button.siblings('img');
        var removeButton = button.siblings('.remove-image-button');

        var mediaUploader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            imageField.val(attachment.url);
            imagePreview.attr('src', attachment.url).show();
            removeButton.show();
        });

        mediaUploader.open();
    }

    function removeImage(event) {
        event.preventDefault();
        var button = $(this);
        var imageField = button.siblings('.edit-menu-item-image');
        var imagePreview = button.siblings('img');
        var uploadButton = button.siblings('.upload-image-button');

        imageField.val('');
        imagePreview.hide();
        button.hide();
    }

    $(document).on('click', '.upload-image-button', openMediaUploader);
    $(document).on('click', '.remove-image-button', removeImage);
});