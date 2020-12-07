
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



        $('.right_col').css('min-height', 'auto');

        //show , hide form
        $( '.product' ).on( 'click', function(e) {
            e.preventDefault();
            let btn_text = e.currentTarget.outerText;
            console.log(btn_text);
            $( this ).toggleClass( 'active' );

            //Toggle button text onClick
            $(this).text(function(i, text){

                return text === "Add Product" ? "Hide Form" : "Add Product";

            })


            if ($( this ).hasClass( 'active' )) {

                $( this ).parents( 'body' ).find( '#createForm' ).slideDown(500);

            } else {
                $( this ).parents( 'body' ).find( '#createForm' ).slideUp(500);
            }

         });
        //show , hide Deals form
        $( '.deal' ).on( 'click', function(e) {
            e.preventDefault();

            $( this ).toggleClass( 'active' );

            //Toggle button text onClick
            $(this).text(function(i, text){

                return text === "Add Deal" ? "Hide Form" : "Add Deal";

            })


            if ($( this ).hasClass( 'active' )) {

                $( this ).parents( 'body' ).find( '#dealsForm' ).slideDown(500);

            } else {
                $( this ).parents( 'body' ).find( '#dealsForm' ).slideUp(500);
            }

         });

        /* ===================== Edit product Toggle ============================ */
        $(document).on("click", "#editProduct", function (e) {
            e.preventDefault();
           let product_id = e.currentTarget.getAttribute('data-id'),
                product_name = e.currentTarget.getAttribute('data-name'),
                product_price = e.currentTarget.getAttribute('data-price'),
                product_category = e.currentTarget.getAttribute('data-category');
                console.log(product_category);
           /*  let product_id = $(this).attr('data-id');
            let  product_name = $(this).attr('data-name');
            let  product_price = $(this).attr('data-price');
            let  product_category = $(this).attr('data-category'); */

           $('#product-id').val(product_id);
           $('#product-name').val(product_name);
           $('#product-price').val(product_price);
           $('#product-category').val(product_category);

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
            $('#submit_add_deal').hide();
            $('#submit_edit_deal').show();

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


                $('#description').val(deal_description)
                $('#details').val(deal_detail)
                $('#title').val(deal_name)
                $('#deal_id').val(deal_id)
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
