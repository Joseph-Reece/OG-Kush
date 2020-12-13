
$(function () {
    // Preview Image
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

    /* =====================filter subcategories by category====================== */
    $('#select_category').change(function () {
        let category_id = $(this).val();
        let select_category = $('#select_subcategory');
        let data_resp = callAPI({
            url: getUrlAPI(`${app_url}/sub-categories/${category_id}`, 'full'),
            method: "GET"
        });
        data_resp.then(res => {
            let html = '';
            res.forEach(function (value, index) {
                html += `<option value="${value.id}">${value.name}</option>`;
            });
            select_category.find('option').remove();
            select_category.append(html);
        });
    });



        //show , hide form
       /*  $( '.product' ).on( 'click', function(e) {
            e.preventDefault();
            let btn_text = e.currentTarget.outerText;
            console.log(btn_text);
            $( this ).toggleClass( 'active' );

            //Toggle button text onClick
            $(this).text(function(i, text){

                return text === "Hide Form" ? "+ Add Product" : "Hide Form";

            })


            if ($( this ).hasClass( 'active' )) {

                $( this ).parents( 'body' ).find( '#createForm' ).slideDown(500);

            } else {
                $( this ).parents( 'body' ).find( '#createForm' ).slideUp(500);
            }

         }); */
        //show , hide Deals form
       /*  $( '.deal' ).on( 'click', function(e) {
            e.preventDefault();

            $( this ).toggleClass( 'active' );

            //Toggle button text onClick
            $(this).text(function(i, text){

                return text === "Hide Form" ? "Add Deal" : "Hide Form";

            })


            if ($( this ).hasClass( 'active' )) {

                $( this ).parents( 'body' ).find( '#dealsForm' ).slideDown(500);

            } else {
                $( this ).parents( 'body' ).find( '#dealsForm' ).slideUp(500);
            }

         }); */


        /* ===================== Add product Toggle ============================ */
        $(document).on("click", "#addProduct", function (e) {
            e.preventDefault();

            $('#edit_product').hide();
            $('#add_product').show();
            $('#add_product_method').val('POST');


            $('#product-id').val('');
            $('#product-name').val('');
            $('#product-price').val('');
            $('#product-category').val('');
            $('#product-subcategory').val('');
            $('#product-description').val('');
            $('#product-weight').val('');
            $('#thumb_preview').attr('src', `assets/images/cs-thumb.jpg`);



            $('#modal_edit_product').modal('show');
        });

        /* ===================== Edit product Toggle ============================ */
        $(document).on("click", "#editProduct", function (e) {
            e.preventDefault();

            $('#edit_product').show();
            $('#add_product').hide();

           let product_id = $(this).attr('data-id'),
                product_name = $(this).attr('data-name'),
                product_price = $(this).attr('data-price'),
                product_category = $(this).attr('data-category'),
                product_subcategory = $(this).attr('data-subcategory'),
                product_description = $(this).attr('data-description'),
                product_weight = $(this).attr('data-weight'),
                product_image = $(this).attr('data-image');
                console.log(product_description);


            $('#add_product_method').val('PUT');

            $('#product-id').val(product_id);
            $('#product-name').val(product_name);
            $('#product-price').val(product_price);
            $('#select_category').val(product_category);
            $('#select_subcategory').val(product_subcategory);
            // $('#product-strain').val('');
            $('#product-description').val(product_description);
            $('#product-weight').val(product_weight);
            $('#thumb_previeww').attr('src', `/uploads/${product_image}`);

            $('#modal_edit_product').modal('show');
        });





        /* ===================== Add Deal Toggle ============================ */
         //Preview deal image
        $("#deal_image").on('change', function () {
            console.log("this is an image");
            preview_deal_image();
        });

        function preview_deal_image() {


            var reader = new FileReader();
            reader.onload = function () {

                var output = document.getElementById('deal_preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        /**
         * Toggle Add Deal Modal
         */
        $(document).on("click", "#addDeal", function (e) {
            e.preventDefault();

            $('#submit_add_deal').show();
            $('#submit_edit_deal').hide();

            $('#description').val('')
            $('#details').val('')
            $('#title').val('')
            $('#deal_id').val('')
            $('#deal_preview').attr('src', `assets/images/cs-thumb.jpg`);
            $('#add_deal_method').val('Post')//To handle Update



            $('#modal_add_deal').modal('show');
        });
        /**
         * Toggle Edit Deal Modal
         */
        $(document).on("click", "#EditDeal", function (e) {
            e.preventDefault();
            let deal_id = $(this).data('id'),
                deal_name = $(this).data('name'),
                deal_description = $(this).data('description'),
                deal_detail = $(this).data('details');
                deal_image = $(this).data('image');


                $('#description').val(deal_description)
                $('#details').val(deal_detail)
                $('#title').val(deal_name)
                $('#deal_id').val(deal_id)
                $('#deal_preview').attr('src', `/uploads/${deal_image}`);
                $('#add_deal_method').val('PUT')//To handle Update




            $('#mdl-title').html("Edit Deal")
            $('#submit_add_deal').hide()
            $('#submit_edit_deal').show()

            $('#modal_add_deal').modal('show');
        });


    /*=====================Handle Save==========================================*/
//    $("#submit-MyForm").on('click', function(e) {
//         e.preventDefault();
//         console.log('continue');
//         upload();
//    });


//    function upload() {
//     let name = $('#name').val(),
//     category = $('#category').val(),
//     price = $('#price').val(),
//     thumb = $('#add-image').val(),
//     form = $('#myForm');
//         url = form.attr('action')
//         console.log(url);

//     console.log(name);
//     // $('.menu-items').fadeOut(500);

//     $.ajax({
//         url: "{{route('product.store')}}",
//         method: "POST",
//         data: {

//             'name': name,
//             'category_id': category_id,
//             'category': category,
//             'price': price,
//             'thumb': thumb,
//             "_token": $('#token').val(),
//         },
//         beforeSend: function () {
//             console.log('before send');
//         },
//         success: function (data) {
//             console.log('success');
//             $('.menu-items').append(data);
//         },
//         error: function (e) {
//             console.log(e);
//         }
//     });
//    }




});
