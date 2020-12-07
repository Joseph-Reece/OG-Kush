$(function(){

    $('#btn_add_product_category').on('click', function () {
        $('#submit_add_category').show();
        $('#submit_edit_category').hide();
        $('#add_category_method').val('POST');
        $('#modal_add_product_category').modal('show');
    });

    // Handle category edit
    $(document).on("click", ".category_edit", function () {
        let category_id = $(this).attr('data-id');
        let category_name = $(this).attr('data-name');




        $('#add_category').hide();
        $('#edit_category').show();
        $('#add_category_method').val('PUT');
        
        $('#category_id').val(category_id);
        $('#cat_name').val(category_name);


        $('#modal_edit_category').modal('show');
    });


    // Handle delete
    $(document).on("click", ".category_delete", function () {
        if (confirm('Are you sure? Once deleted the category cannot be restored!')) {
            $(this).parent().submit();
        }
    });

});
