(function ($) {
    "use strict";
    $(document).on('ready', function () {


        $("button[id='delivery']").on('click',function (e) {
           console.log(e.currentTarget.id);
           $(this).prop('class', 'btn bnt');
        //    $('#content').toggle('1s_0_hidden');
           $('#content').toggle('hidden', true);


       });

        $("a[id='contact-tab']").on('click',function (e) {
           console.log(e.currentTarget.id);

           $('#dispensary').prop('hidden', true);
           $('#doctor').prop('hidden', false);

       });

        $("a[id='home-tab']").on('click',function (e) {
           console.log(e.currentTarget.id);

           $('#doctor').prop('hidden', true);
           $('#dispensary').prop('hidden', false);

       });

    //    $("button[id='show_map']").on('click', function(e){
    //     console.log(e.currentTarget.id);
    //     e.preventDefault();
    //     $("#map").toggle(500);
    //    });

       $( '.icon-toggle' ).on( 'click', function() {
        $( this ).toggleClass( 'active' );
        if ($( this ).hasClass( 'active' )) {
            $( this ).parents( 'body' ).find( '#map' ).fadeIn(500);

        } else {
            $( this ).parents( 'body' ).find( '#map' ).fadeOut(500);

        }
        });
    //    hours toggling
        $('#btn_add_hour').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#open").removeProp('hidden');
        });

        $('#hideHours').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#open").prop('hidden', true);
        });
    //    hours amenities
        $('#btn_add_amenities').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#amenities").removeProp('hidden');
        });

        $('#hideAmenities').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#amenities").prop('hidden', true);
        });

        // Payments
        $('#btn_add_payments').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#payments").removeProp('hidden');
        });

        $('#hidePayments').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#payments").prop('hidden', true);
        });
    //    hours deals
        $('#btn_add_deals').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#open").removeProp('hidden');
        });

        $('#hideHours').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#open").prop('hidden', true);
        });
    //    hours media
        $('#btn_add_media').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#media").removeProp('hidden');
        });

        $('#hideMedia').on('click', function (e) {
            console.log(e.currentTarget.id);
            e.preventDefault();

            $("#media").prop('hidden', true);
        });

        // Home Page maps





    });
})(jQuery);

