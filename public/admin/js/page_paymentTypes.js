(function ($) {
    'use strict';

    /**
     * Amenities list
     */
    $(document).on("click", ".payment_edit", function () {
        let payment_id = $(this).attr('data-id');
        let payment_name = $(this).attr('data-name');
        let payment_icon = $(this).attr('data-icon');


        $('#submit_add_payment').hide();
        $('#submit_edit_payment').show();
        $('#add_payment_method').val('PUT');
        $('#payment_id').val(payment_id);
        $('#payment_name').val(payment_name);

        if (payment_icon) {
            $('#preview_icon').attr('src', `/uploads/${payment_icon}`);
        } else {
            $('#preview_icon').attr('src', `https://via.placeholder.com/100x100?text=icon`);
        }

        $('#modal_add_payment').modal('show');
    });

    $(document).on("click", ".payment_delete", function () {
        if (confirm('Are you sure? The Payment Types that are deleted can not be restored!')) {
            $(this).parent().submit();
        }
    });

    $('#btn_add_payment').click(function () {
        $('#submit_add_payment').show();
        $('#submit_edit_payment').hide();
        $('#add_amenities_payment').val('POST');
        $('#modal_add_payment').modal('show');
    });

    /**
     * Model add new
     */
    $('#payment_icon').change(function () {
        previewUploadImage(this, 'preview_icon')
    });

})(jQuery);
