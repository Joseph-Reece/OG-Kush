var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var usable_name="";
var GL = GL || {};
var GL_FILTER = GL_FILTER || {};
var GL_BOOKING = GL_BOOKING || {};
var GL_BUSINESS_SEARCH = GL_BUSINESS_SEARCH || {};
const PRICE_RANGE = {
    null: "None",
    0: "Free",
    1: "$",
    2: "$$",
    3: "$$$",
    4: "$$$$",
};

(function ($) {
    // "use strict";
    var storedage = localStorage.getItem("age");
    if (storedage == null || storedage < 18) {

        $('#age_gate').modal({backdrop: 'static', keyboard: false});
        // $("#e").modal('show');
        $('#age_gate').modal('show');

        $('#overage').on('click', function () {
            console.log('overage');
            submitAge(19);
        });
        $('#underage').on('click', function () {
            console.log('underage');
            submitAge(16);
        });

        function submitAge(age) {
            var year = new Date().getFullYear()
                - age;
            var day = 19;
            var month = 6;
            if (age > 18) {
                $('#age_gate').modal('hide');
                window.location.href="http://budandcarriage.techplus.com.pk/";
;            }
            localStorage.setItem("age", age);
            $.ajax({
                type: "POST",
                url: "submit/age",
                data: {
                    "day": day,
                    "month": month,
                    "year": year,
                    "_token": CSRF_TOKEN
                },
                dataType: "json",
                success: function (data) {

                }
            });
            console.log(year);
        }
    } else {

    }

    var menu_filter_wrap = $('.golo-menu-filter');

    GL = {
        init: function () {
            GL.keypressInputSearch();

            GL.addWishList();
            GL.removeWishList();
            GL.submitLogin();
            GL.submitRegister();
            GL.submitForgotPassword();
        },

        keypressInputSearch: function () {
            $('.golo-ajax-search').on('input', 'input[name="keyword"]', function () {
                var $this = $(this);
                if ($this.val()) {
                    GL.ajaxSearch($this);
                } else {
                    $this.parents('.golo-ajax-search').find('.search-result').hide();
                }
            });
        },

        ajaxSearch: function ($this) {
            let keyword = $this.parents('.golo-ajax-search').find('input[name="keyword"]').val();

            // call api
            $.ajax({
                // dataType: 'json',
                url: `${app_url}/ajax-search`,
                data: {
                    'keyword': keyword
                },
                beforeSend: function () {
                    $this.parents('.golo-ajax-search').addClass('active');
                    // $this.parents('.golo-ajax-search').find('.golo-loading-effect').fadeIn();
                },
                success: function (data) {
                    $this.parents('.golo-ajax-search').find('.search-result').fadeIn(300);
                    $this.parents('.golo-ajax-search').removeClass('active');

                    if (data) {
                        $this.parents('.golo-ajax-search').find('.search-result').html(data);
                    } else {
                        $this.parents('.golo-ajax-search').find('.search-result').html('<div class="golo-ajax-result">No place found</div>');
                    }

                    GL.clickOutside('.search-result');
                },
                error: function (e) {
                    console.log(e);
                }
            });
        },

        addWishList: function () {
            $(document).on("click", ".add_wishlist", function (event) {
                event.preventDefault();
                var $this = $(this);
                let place_id = $(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: `${app_url}/following`,
                    data: {
                        '_token': CSRF_TOKEN,
                        'place_id': place_id
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $this.html('<i class="golo-loading"></i>');
                    },
                    success: function (response) {
                        if (response.code === 200) {
                            $this.addClass('active');
                            $this.addClass('remove_wishlist');
                            $this.removeClass('add_wishlist');
                            $this.html('<i class="la la-heart la-24"></i>');
                        }
                    },
                    error: function (jqXHR) {
                        var response = $.parseJSON(jqXHR.responseText);
                        if (response.message) {
                            alert(response.message);
                        }
                    }
                });
            });
        },
        removeWishList: function () {
            $(document).on("click", ".remove_wishlist", function (event) {
                event.preventDefault();
                var $this = $(this);
                let place_id = $(this).attr('data-id');
                $.ajax({
                    type: "delete",
                    url: `${app_url}/following`,
                    data: {
                        '_token': CSRF_TOKEN,
                        'place_id': place_id
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $this.html('<i class="golo-loading"></i>');
                    },
                    success: function (response) {
                        if (response.code === 200) {
                            $this.removeClass('active');
                            $this.removeClass('remove_wishlist');
                            $this.addClass('add_wishlist');
                            $this.html('<i class="la la-heart la-24"></i>');
                        }
                    },
                    error: function (jqXHR) {
                        var response = $.parseJSON(jqXHR.responseText);
                        if (response.message) {
                            alert(response.message);
                        }
                    }
                });
            });
        },

        submitLogin: function () {
            $('#login').submit(function (event) {
                event.preventDefault();
                let $form = $(this);
                let formData = getFormData($form);
                $('#submit_login').text('Loading...').prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: `${app_url}/login`,
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        $('#submit_login').text('Login').prop('disabled', false);
                        if (response.code === 200) {
                            location.reload();
                        } else {
                            $('#login_error').show().text(response.message);
                        }
                    },
                    error: function (jqXHR) {
                        $('#submit_login').text('Login').prop('disabled', false);
                        var response = $.parseJSON(jqXHR.responseText);
                        if (response.message) {
                            alert(response.message);
                        }
                    }
                });

            });
        },
        submitRegister: function () {
            $('#register').submit(function (event) {
                event.preventDefault();
                let $form = $(this);
                let formData = getFormData($form);
                $('#submit_register').text('Loading...').prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: `${app_url}/register`,
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        $('#submit_register').text('Register').prop('disabled', false);
                        if (response.code === 200) {
                            location.reload();
                        } else {
                            $('#register_error').show().text(response.message);
                        }
                    },
                    error: function (jqXHR) {
                        $('#submit_register').text('Register').prop('disabled', false);
                        var response = $.parseJSON(jqXHR.responseText);
                        if (response.message) {
                            alert(response.message);
                        }
                    }
                });
            });
        },
        submitForgotPassword: function () {
            $('#forgot_password').submit(function (event) {
                event.preventDefault();
                let $form = $(this);
                let formData = getFormData($form);
                $('#submit_forgot_password').text(`Loading...`).prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: `${app_url}/api/user/reset-password`,
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        $('#submit_forgot_password').text('Forgot password').prop('disabled', false);
                        if (response.code === 200) {
                            $('#fp_success').show().text(response.message);
                        } else {
                            $('#fp_error').show().text(response.message);
                        }
                    },
                    error: function (jqXHR) {
                        $('#submit_forgot_password').text('Forgot password').prop('disabled', false);
                        var response = $.parseJSON(jqXHR.responseText);
                        if (response.message) {
                            alert(response.message);
                        }
                    }
                });

            });
        },

        clickOutside: function (element) {
            $(document).on('click', function (event) {
                var $this = $(element);
                if ($this !== event.target && !$this.has(event.target).length) {
                    $this.fadeOut(300);
                }
            });
        },

    };

    GL_FILTER = {
        init: function () {
            GL_FILTER.filterToggle();
            GL_FILTER.filterPlace();
            GL_FILTER.filterClear();

        },

        // Show/Hide filter panel
        filterToggle: function () {
            $('.golo-filter-toggle').on('click', function (e) {
                e.preventDefault();
                $(this).toggleClass('active');
                $(this).parents('.city-content__panel').find('.golo-menu-filter').slideToggle(300);
                $(this).parents('.search-wrap').find('.golo-menu-filter').slideToggle(300);
            });
        },

        filterPlace: function () {
            // click filter: Sort By, Price Filter
            $('.golo-menu-filter ul.filter-control a').on('click', function (e) {
                e.preventDefault();
                $('.golo-pagination').find('input[name="paged"]').val(1);

                if ($(this).parent().hasClass('active')) {
                    $(this).parents('.golo-menu-filter ul.filter-control').find('li').removeClass('active');
                } else {
                    $(this).parents('.golo-menu-filter ul.filter-control').find('li').removeClass('active');
                    $(this).parent().addClass('active');
                }
                var ajax_call = true;
                GL_FILTER.ajaxFilter();
                GL_FILTER.ajaxFilterr();
                GL_FILTER.ajaxFilterMap();
            });


            // click filter: Types, Amenities
            $('.golo-menu-filter input.input-control').on('input', function () {
                $('.golo-pagination').find('input[name="paged"]').val(1);
                var ajax_call = true;
                GL_FILTER.ajaxFilter();
                GL_FILTER.ajaxFilterr();
                GL_FILTER.ajaxFilterMap();
            });
        },

        // Show/Hide button Clear All
        filterDisplayClear: function () {
            if ($('.golo-menu-filter ul.filter-control li.active').length > 0) {
                $('.golo-nav-filter').addClass('active');
                $('.golo-clear-filter').show();
            } else {
                $('.golo-nav-filter').removeClass('active');
                $('.golo-clear-filter').hide();
            }

            $('.golo-menu-filter input[type="checkbox"]:checked').each(function () {
                if ($(this).length > 0) {
                    $('.golo-nav-filter').addClass('active');
                    $('.golo-clear-filter').show();
                } else {
                    $('.golo-nav-filter').removeClass('active');
                    $('.golo-clear-filter').hide();
                }
            });
        },

        // Click button Clear All
        filterClear: function () {
            $('.golo-clear-filter').on('click', function () {
                $('.golo-menu-filter ul.filter-control li').removeClass('active');
                $('.golo-menu-filter input[type="checkbox"]').prop('checked', false);
                var ajax_call = true;
                GL_FILTER.ajaxFilter();
                GL_FILTER.ajaxFilterr();
                GL_FILTER.ajaxFilterMap();
            });
        },

        ajaxFilter: function () {
            let city_id = $('input[name="city_id"]').val(),
                category_id = $('input[name="category_id"]').val(),
                sort_by = menu_filter_wrap.find('.sort-by.filter-control li.active a').data('sort'),
                price = menu_filter_wrap.find('.price.filter-control li.active a').data('price'),
                place_types = [],
                amenities = [];
            console.log(city_id);

            menu_filter_wrap.find("input[name='types']:checked").each(function () {
                place_types.push(parseInt($(this).val()));
            });
            menu_filter_wrap.find("input[name='amenities']:checked").each(function () {
                amenities.push(parseInt($(this).val()));
            });

            // call api
            $.ajax({
                url: `${app_url}/places/filter`,
                data: {
                    'city_id': city_id,
                    'category_id': category_id,
                    'sort_by': sort_by,
                    'price': price,
                    'place_types': place_types,
                    'amenities': amenities
                },
                beforeSend: function () {
                    $('#list_places').html('<div class="col-md-12 text-center">Loading...</div>');
                },
                success: function (data) {
                    $('#list_places').html(data);
                    GL_FILTER.filterDisplayClear();
                },
                error: function (e) {
                    console.log(e);
                }
            });

        },
        ajaxFilterr: function () {
            var amenities = [];
            var paymentTypes = [];
            console.log(usable_name);
            let city_name = usable_name,
                keyword = $('#keyword').val(),
                action = $('#action').val(),
                category_id = $("select.cat_id").children("option:selected").val(),
                sort_by = menu_filter_wrap.find('.sort-by.filter-control li.active a').data('sort'),
                price = menu_filter_wrap.find('.price.filter-control li.active a').data('price');

            menu_filter_wrap.find("input[name='amenities']:checked").each(function () {
                amenities.push(parseInt($(this).val()));
            });
            menu_filter_wrap.find("input[name='types']:checked").each(function () {
                paymentTypes.push(parseInt($(this).val()));
            });
            console.log('Sort' + sort_by);
            console.log('action' + action);
            console.log('category_id' + category_id);
            console.log('price' + price);
            console.log('amenities' + amenities);
            console.log('paymentTypes' + paymentTypes);
            console.log('keyword' + keyword);
            console.log('city_name'+city_name);
            // console.log('Sort'+sort_by);

            // menu_filter_wrap.find("input[name='types']:checked").each(function () {
            //     place_types.push(parseInt($(this).val()));
            // });


            // call api
            $.ajax({
                url: `${app_url}/search`,
                data: {
                    'city_name': city_name,
                    'category_id': category_id,
                    'keyword': keyword,
                    'action': action,
                    'sort_by': sort_by,
                    'price': price,
                    'paymentTypes': paymentTypes,
                    'amenities': amenities,
                    "_token": $('#token').val(),
                },
                beforeSend: function () {
                    $('.golo-grid').fadeOut(500);
                    $('.loads').fadeIn(1000);
                },
                success: function (data) {
                    console.log('successfull search');
                    // console.log('successfull search');
                    // $('.main-search').hide();
                    $('.golo-grid').empty();
                    $('.golo-grid').append(data);
                    $('.golo-grid').fadeIn(1000);
                    $(".loads").fadeOut(500);

                    GL_FILTER.filterDisplayClear();
                },
                error: function (e) {
                    console.log(e);
                }
            });


        },
        ajaxFilterMap: function () {
            console.log('ajaxFilterMap');
            //Create markers
            var golo_create_markers = function (data, map) {
                var infowindow = new google.maps.InfoWindow();

                $.each(data, function (i, value) {

                    let html_review = '';
                    let html_category = '';

                    if (value.avg_review.length) {
                        html_review = `
                            ${value.avg_review[0]['aggregate']} <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path fill="#DDD" fill-rule="evenodd" d="M6.12.455l1.487 3.519 3.807.327a.3.3 0 0 1 .17.525L8.699 7.328l.865 3.721a.3.3 0 0 1-.447.325L5.845 9.4l-3.272 1.973a.3.3 0 0 1-.447-.325l.866-3.721L.104 4.826a.3.3 0 0 1 .17-.526l3.807-.327L5.568.455a.3.3 0 0 1 .553 0z"/></svg>
                            `;
                    }

                    if (value.categories) {
                        for (var j = 0; j < value.categories.length; j++) {
                            html_category += `<a style="color: #666;"> ${value.categories[j]['name']}</a>`;
                        }
                    }

                    var html_infowindow = `
                        <div id='infowindow'>
                            <div class="places-item" data-title="${value.name}" data-lat="-33.796864" data-lng="150.620614" data-index="${i}">
                                <a href="/place/${value.slug}"><img src="/uploads/${value.thumb}" alt=""></a>
                                <div class="places-item__info">
                                    <span class="places-item__category">${html_category}</span>
                                    <a href="/place/${value.slug}"><h3>${value.name}</h3></a>
                                    <div class="places-item__meta">
                                        <div class="places-item__reviews">
                                            <span class="places-item__number">
                                                ${html_review}
                                                <span class="places-item__count">(${value.reviews_count} reviews)</span>
                                            </span>
                                        </div>
                                        <div class="places-item__currency">${PRICE_RANGE[value.price_range]}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                    let marker_options = {
                        position: {lat: parseFloat(value.lat), lng: parseFloat(value.lng)},
                        map: map,
                        draggable: false,
                        animation: google.maps.Animation.DROP
                    };
                    if (value.categories[0].icon_map_marker) {
                        marker_options.icon = {
                            url: `/assets/images/icon-mapker.svg`
                        }
                    }
                    let marker = new google.maps.Marker(marker_options);
                    marker.addListener('click', function () {
                        infowindow.setContent(html_infowindow);
                        infowindow.open(map, this);
                    });
                }); // End each data
            };
            //Create markers

            // Call api
            var amenities = [];
            var paymentTypes = [];
            console.log(usable_name);
            let city_name = usable_name,
                keyword = $('#keyword').val(),
                action = $('#action').val(),
                category_id = $("select.cat_id").children("option:selected").val(),
                sort_by = menu_filter_wrap.find('.sort-by.filter-control li.active a').data('sort'),
                price = menu_filter_wrap.find('.price.filter-control li.active a').data('price'),
                ajax = '1';

            menu_filter_wrap.find("input[name='amenities']:checked").each(function () {
                amenities.push(parseInt($(this).val()));
            });
            menu_filter_wrap.find("input[name='types']:checked").each(function () {
                paymentTypes.push(parseInt($(this).val()));
            });
            console.log('Sort' + sort_by);
            console.log('action' + action);
            console.log('category_id' + category_id);
            console.log('price' + price);
            console.log('amenities' + amenities);
            console.log('paymentTypes' + paymentTypes);
            console.log('keyword' + keyword);
            console.log('city_name'+city_name);
            // console.log('Sort'+sort_by);

            // menu_filter_wrap.find("input[name='types']:checked").each(function () {
            //     place_types.push(parseInt($(this).val()));
            // });

            // call api
            $.ajax({
                url: `${app_url}/map-search`,
                data: {
                    'city_name': city_name,
                    'category_id': category_id,
                    'keyword': keyword,
                    'action': action,
                    'sort_by': sort_by,
                    'ajax': ajax,
                    'price': price,
                    'paymentTypes': paymentTypes,
                    'amenities': amenities,
                    "_token": $('#token').val(),
                },
                beforeSend: function () {
                    $('.golo-grid').fadeOut(500);
                    $('.loads').fadeIn(1000);
                },
                success: function (data) {
                    console.log('successfull search');
                    // console.log('successfull search');
                    // $('.main-search').hide();
                    /* $('.golo-grid').empty();
                    $('.golo-grid').append(data);
                    $('.golo-grid').fadeIn(1000);
                    $(".loads").fadeOut(500); */


                    // Append results on map
                    var golo_map_style_silver = [
                        {
                            "featureType": "landscape",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "stylers": [
                                {
                                    "hue": "#00aaff"
                                },
                                {
                                    "saturation": -100
                                },
                                {
                                    "gamma": 2.15
                                },
                                {
                                    "lightness": 12
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": 24
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "lightness": 57
                                }
                            ]
                        }
                    ];
                    var golo_map_option = {
                        scrollwheel: false,
                        scroll: {x: $(window).scrollLeft(), y: $(window).scrollTop()},
                        zoom: 12,
                        center: {lat: parseFloat(data.city.lat), lng: parseFloat(data.city.lng)},
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: false,
                        fullscreenControl: true,
                        streetViewControl: true,
                        disableDefaultUI: false,
                        styles: golo_map_style_silver,
                        zoomControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                        streetViewControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                        fullscreenControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        }
                    };

                    var map = new google.maps.Map(document.getElementById('maps'), golo_map_option);
                    golo_create_markers(data.places, map);



                    GL_FILTER.filterDisplayClear();
                },
                error: function (e) {
                    console.log(e);
                }
            });


        }


    };

    GL_BOOKING = {
        init: function () {
            GL_BOOKING.submitForm();
            GL_BOOKING.bookingForm();
        },

        bookingForm: function () {
            $('#booking_form').submit(function (event) {
                event.preventDefault();
                let $form = $(this);
                let formData = getFormData($form);

                if (formData.numbber_of_adult == "0") {
                    alert("Please enter numbber of adult");
                    return;
                }
                if (!formData.date) {
                    alert("Please select date");
                    return;
                }
                if (!formData.time) {
                    alert("Please select time");
                    return;
                }

                GL_BOOKING.ajaxBooking(formData)
            });
        },

        submitForm: function () {
            $('#booking_submit_form').submit(function (event) {
                event.preventDefault();
                let $form = $(this);
                let formData = getFormData($form);
                GL_BOOKING.ajaxBooking(formData)
            });
        },

        ajaxBooking: function (formData) {

            // call api
            $.ajax({
                dataType: 'json',
                url: `${app_url}/bookings`,
                method: "post",
                data: formData,
                beforeSend: function () {
                    $('.booking_submit_btn').html('Sending...').prop('disabled', true);
                },
                success: function (data) {
                    $('.booking_submit_btn').html('Send').prop('disabled', false);
                    if (data.code === 200) {
                        $('.booking_success').show();
                        $('.booking_error').hide();
                        // $('form :input').val('');
                    } else {
                        $('.booking_success').hide();
                        $('.booking_error').show();
                    }
                },
                error: function (e) {
                    $('.booking_submit_btn').html('Send').prop('disabled', false);
                    $('.booking_success').hide();
                    $('.booking_error').show();
                    console.log(e);
                }
            });

        }
    };

    GL_BUSINESS_SEARCH = {
        init: function () {
            GL_BUSINESS_SEARCH.clickAllInputSearch();
            GL_BUSINESS_SEARCH.keyupInputSearch();
            GL_BUSINESS_SEARCH.focusInputSearch();
            GL_BUSINESS_SEARCH.keyupLocationSearch();
            GL_BUSINESS_SEARCH.clickItemCategory();
            GL_BUSINESS_SEARCH.clickItemLocation();
            GL_BUSINESS_SEARCH.clickListingItem();
            GL_BUSINESS_SEARCH.globalJS();
        },

        globalJS: function () {
            $('.open-suggestion').on('focus', function (e) {
                e.preventDefault();
                $(this).parent().find('.search-suggestions').fadeIn();
            });
            $('.open-suggestion').on('blur', function (e) {
                e.preventDefault();
                $(this).parent().find('.search-suggestions').fadeOut();
            });
        },

        clickAllInputSearch: function () {
            $(document).on('click', '.search-suggestions a', function (e) {
                // e.preventDefault();
                var text = $(this).find('span').text();
                $(this).parents('.field-input').find('input').attr("placeholder", text).val('');
                $(this).parents('.search-suggestions').fadeOut();
            });
        },

        clickListingItem: function () {
            $(document).on('click', '.listing_items a', function (e) {
                console.log("listing_items click input_search");
                // e.preventDefault();
                // let city_id = e.currentTarget.getAttribute('data-id');
                // $('#input_search').val(city_id).attr('name', 'city[]');
            });
        },

        keyupInputSearch: function () {
            $(document).on('keyup', '#input_search', function (e) {
                $('#category_id').val('');
                let keyword = $(this).val();
                GL_BUSINESS_SEARCH.searchListing(keyword);
            });
        },

        focusInputSearch: function () {
            $(document).on('focus', '#input_search, #location_search', function () {
                console.log("focus input_search");
                GL_BUSINESS_SEARCH.searchCategoryPlace('');
                GL_BUSINESS_SEARCH.searchLocationSearch('');
            });
        },

        searchListing: function (keyword) {
            $.ajax({
                url: `${app_url}/ajax-search-listing`,
                data: {
                    'keyword': keyword
                },
                beforeSend: function () {
                },
                success: function (data) {
                    $('.category-suggestion').html(data);
                },
                error: function (e) {
                    console.log(e);
                }
            });
        },

        searchCategoryPlace: function (keyword) {
            $.ajax({
                url: `${app_url}/categories`,
                data: {
                    'keyword': keyword
                },
                beforeSend: function () {
                },
                success: function (data) {
                    let html = '<ul class="category_items">';
                    data.forEach(function (value, index) {
                        html += `<li><a href="#" data-id="${value.id}"><span>${value.name}</span></a></li>`;
                    });
                    html += '</ul>';
                    $('.category-suggestion').html(html);
                },
                error: function (e) {``
                    console.log(e);
                }
            });
        },

        keyupLocationSearch: function () {
            $(document).on('keyup', '#location_search', function () {
                let keyword = $(this).val();
                GL_BUSINESS_SEARCH.searchLocationSearch(keyword);
            });
        },

        searchLocationSearch: function (keyword) {
            $.ajax({
                url: `${app_url}/cities`,
                data: {
                    'keyword': keyword
                },
                beforeSend: function () {
                },
                success: function (data) {
                    let html = '<ul>';
                    data.forEach(function (value, index) {
                        html += `<li><a href="#" data-id="${value.id}"><span>${value.name}</span></a></li>`;
                    });
                    html += '</ul>';
                    $('.location-suggestion').html(html);
                },
                error: function (e) {
                    console.log(e);
                }
            });
        },

        clickItemCategory: function () {
            $(document).on('click', '.category_items a', function (e) {
                e.preventDefault();
                let category_id = e.currentTarget.getAttribute('data-id');
                $('#category_id').val(category_id);
            });
        },

        clickItemLocation: function () {
            $(document).on('click', '.location-suggestion a', function (e) {
                e.preventDefault();
                let city_id = e.currentTarget.getAttribute('data-id');
                $('#city_id').val(city_id).attr('name', 'city[]');
            });
        }

    }

    GL.init();
    GL_FILTER.init();
    GL_BOOKING.init();
    GL_BUSINESS_SEARCH.init();

})(jQuery);
$(window).on('load', function() {
    getLatLng();
})
function getLatLng(){
console.log("getlatlong");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(initMap);
    } else {
        console.log( "Geolocation is not supported by this browser.");
    }


}
function initMap(position) {
    // console.log( "Latitude: " + position.coords.latitude );
    // console.log( "longitude: " + position.coords.longitude );


    console.log( "Latitude: " + position.coords.latitude );
    console.log( "longitude: " + position.coords.longitude );
        var user_lat = position.coords.latitude;
        var user_long = position.coords.longitude;
    // const map = new google.maps.Map(document.getElementById("map"), {
    //   zoom: 8,
    //   center: { lat: 40.731, lng: -73.997 },
    // });
    const geocoder = new google.maps.Geocoder();
    const infowindow = new google.maps.InfoWindow();
      geocodeLatLng(geocoder, infowindow,user_lat,user_long);

  }

  function geocodeLatLng(geocoder, infowindow,user_lat,user_long) {
    // const input = document.getElementById("latlng").value;
    // const latlngStr = input.split(",", 2);
    const latlng = {

      lat: parseFloat(user_lat),
      lng: parseFloat(user_long),
    };
    geocoder.geocode({ location: latlng }, (results, status) => {
      if (status === "OK") {
        if (results[0]) {


          console.log(results[0]);
          var city="";
          var state="";
          usable_name="";
          results.forEach(function(element){
            element.address_components.forEach(function(element2){
                element2.types.forEach(function(element3){
                switch(element3){
                    case 'postal_code':
                    postal_code = element2.long_name;
                    break;
                    case 'administrative_area_level_1':
                    state = element2.long_name;
                    break;
                    case 'locality':
                    city = element2.long_name;
                    break;
                }
                })
            });
            });

          console.log(city);
          console.log(state);
            if(city!=""){
                // infowindow.setContent(results[0].formatted_address);
                usable_name=city;
            }else{
                usable_name=state;
            }

            console.log(usable_name);

            GL_FILTER.ajaxFilterr();
        } else {
          window.alert("No results found");
        }
      } else {
        window.alert("Geocoder failed due to: " + status);
      }
    });
  }
/**
 * @param slug
 * @param type
 * @returns {*}
 */
function getUrlAPI(slug, type = "api") {
    const base_url = window.location.origin;
    if (type === "full")
        return slug;
    else
        return base_url + "/" + type + slug;
}

/**
 * @param data
 * @returns {Promise<any | never>}
 */
function callAPI(data) {
    try {
        let method = data.method || "GET";
        let header = data.header || {'Accept': 'application/json', 'Content-Type': 'application/json'};
        let body = JSON.stringify(data.body);

        return fetch(data.url, {
            'method': method,
            'headers': header,
            'body': body
        }).then(res => {
            return res.json();
        }).then(response => {
            return response;
        })

    } catch (e) {
        alert(e);
        console.log(e);
    }
}

/**
 * @param $form
 * return object
 */
function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}

/**
 *
 * @param input
 * @param element_id
 */
function previewUploadImage(input, element_id) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $(`#${element_id}`).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

var delayTimer;

function doSearch(text) {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function () {
        GL_FILTER.ajaxFilterr()
    }, 1000); // Will do the ajax stuff after 1000 ms, or 1 s
}
function doMapSearch(text) {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function () {
        GL_FILTER.ajaxFilterMap()
    }, 1000); // Will do the ajax stuff after 1000 ms, or 1 s
}

 /* =====================================tinymce editor========================== */
 var editor_config = {
    path_absolute: "/",
    selector: ".tinymce_editor",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback: function (field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no"
        });
    }
};

tinymce.init(editor_config);



