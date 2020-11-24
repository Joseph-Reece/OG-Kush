(function ($) {
    "use strict";
    $(document).on('ready', function () {
        /* $("input[id='option1']").on('click', function (e) {
            console.log(e.currentTarget.name);
            //return option btn t0 default
            $("label[id='option']").removeProp('class', 'active');
            $("label[id='option']").prop('class', 'btn btn-outline-secondary');

            //change btn to success
            $("label[id='Home']").removeProp('class', 'btn btn-outline-secondary');
            $("label[id='Home']").prop('class', 'btn btn-success');
            $("input[id='option3']").prop('checked', false);
        });

        $("input[id='option3']").on('click',function (e) {
            console.log(e.currentTarget.name);
            // return homeDelivery to default
            $("label[id='Home']").removeProp('class', 'btn btn-success');
            $("label[id='Home']").prop('class', 'btn btn-outline-secondary');

            //Change btn to success
            $("label[id='option']").removeProp('class', 'btn btn-outline-secondary');
            $("label[id='option']").prop('class', 'btn btn-success');

            $("input[id='HomeDelivery']").prop('checked', false);
        }); */

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


    });
})(jQuery);

