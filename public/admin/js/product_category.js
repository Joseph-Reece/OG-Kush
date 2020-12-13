$(function(){
    /* =====================Image Upload================== */
    $("#thumb_image").on('change', function () {
        console.log("this is an image");
        preview_image();
    });

    function preview_image() {


        var reader = new FileReader();
        reader.onload = function () {

            var output = document.getElementById('thumb_preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    /*========================Product Categories===================================================*/
    $('#btn_add_product_category').on('click', function () {
        $('#submit_add_category').show();
        $('#submit_edit_category').hide();
        $('#add_category_method').val('POST');

        $('#category_name').val('');
        $('#thumb_preview').attr('src', `assets/images/cs-thumb.jpg`);

        $('#modal_add_product_category').modal('show');
    });

    // Handle category edit
    $(document).on("click", ".category_edit", function () {
        let category_id = $(this).attr('data-id');
        let category_name = $(this).attr('data-name');
        let thumb = $(this).attr('data-thumb');


        $('#submit_add_category').hide();
        $('#submit_edit_category').show();
        $('#add_category_method').val('PUT');

        $('#category_id').val(category_id);
        $('#category_name').val(category_name);
        $('#thumb_preview').attr('src', `/uploads/${thumb}`);


        $('#modal_add_product_category').modal('show');
    });


    // Handle delete
    $(document).on("click", ".category_delete", function () {
        if (confirm('Are you sure? Once deleted the category cannot be restored!')) {
            $(this).parent().submit();
        }
    });

    /*========================Product Sub Categories===================================================*/
    $('#btn_add_subcategory').on('click', function () {
        $('#submit_add_subcategory').show();
        $('#submit_edit_subcategory').hide();
        $('#add_subcategory_method').val('POST');

        $('#category_id').val('');
        $('#subcategory_name').val('');
        $('#product_category_id').val('');
        $('#thumb_preview').attr('src', `assets/images/cs-thumb.jpg`);

        $('#modal_add_product_subcategory').modal('show');
    });

    // Handle sub category edit
    $(document).on("click", ".subcategory_edit", function () {
        let subcategory_id = $(this).attr('data-id');
        let subcategory_name = $(this).attr('data-name');
        let thumb = $(this).attr('data-thumb');
        let catid = $(this).attr('data-catid');
        let catname = $(this).attr('data-catname');




        $('#submit_add_subcategory').hide();
        $('#submit_edit_subcategory').show();
        $('#add_subcategory_method').val('PUT');

        $('#subcategory_id').val(subcategory_id);
        $('#subcategory_name').val(subcategory_name);
        $('#product_category_id').val(catid);
        $('#thumb_preview').attr('src', `/uploads/${thumb}`);



        $('#modal_add_product_subcategory').modal('show');
    });


    // Handle delete
    $(document).on("click", ".subcategory_delete", function () {
        if (confirm('Are you sure? Once deleted the category cannot be restored!')) {
            $(this).parent().submit();
        }
    });

});
