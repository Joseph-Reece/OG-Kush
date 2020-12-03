var GL_BC = GL_BC || {};

(function ($) {
    "use strict";
    var menu_filter_wrap = $('.archive-filter');
    GL_BC = {
        init: function () {
            GL_BC.filterPlace();
            GL_BC.clickFilter();
            GL_BC.categoryMap();
            console.log("category.....");
        },

        // Show/Hide button Clear All
        filterDisplayClear: function () {
            if ($('ul.filter-control li.active').length > 0) {

                console.log('right place');
                $('.filter-head').add('class', 'active');
                $('.clear-filter').show();
            } else {
                $('.golo-nav-filter').removeClass('active');
                $('.golo-clear-filter').hide();
            }

            $('.filter-group input[type="checkbox"]:checked').each(function () {
                if ($(this).length > 0) {
                    $('.golo-nav-filter').add('class', 'active');
                    $('.golo-clear-filter').show();
                } else {
                    $('.golo-nav-filter').removeClass('active');
                    $('.golo-clear-filter').hide();
                }
            });
        },

        filterPlace: function () {
            // click filter: Sort By, Price Filter
            $('.filter-group ul.filter-control a').on('click', function (e) {
                e.preventDefault();
                if ($(this).parent().hasClass('active')) {
                    console.log('was active');
                    $(this).parents('.filter-group  ul.filter-control').find('li').removeClass('active');
                } else {
                    console.log('was not active');

                    $(this).parents('.filter-group ul.filter-control').find('li').removeClass('active');
                    $(this).parent().add('class', 'active');
                }
                var ajax_call = true;
                GL_FILTER.ajaxFilter();
            });
        },

        clickFilter: function () {
            $(document).on('click', '.bc_filter', function (e) {
               GL_BC.ajaxFilter();
               //console.log('now you doing smthng');
            });
        },

        ajaxFilter: function(){
            let keyword = $('input[name="keyword"]').val(),
                action = $('input[name="action"]').val(),
                sort_by = menu_filter_wrap.find('.sort-by.filter-control li.active a').data('sort'),
                price = menu_filter_wrap.find('.price.filter-control li.active a').data('price'),
                category = [],
                amenities = [],
                place_type = [],
                city =[];
                //handle the ones with arrays
                menu_filter_wrap.find("input[name='categories']:checked").each(function () {
                    category.push(parseInt($(this).val()));
                });
                menu_filter_wrap.find("input[name='amenities']:checked").each(function () {
                    amenities.push(parseInt($(this).val()));
                });
                menu_filter_wrap.find("input[name='types']:checked").each(function () {
                    place_type.push(parseInt($(this).val()));
                });
                menu_filter_wrap.find("input[name='cities']:checked").each(function () {
                    city.push(parseInt($(this).val()));
                });

                //call api
                $.ajax({
                    url: `${app_url}/search-listing`,
                    method:"GET",
                    data:{
                        'keyword': keyword,
                        'action': action,
                        'category': category,
                        'amenities': amenities,
                        'place_type': place_type,
                        'city': city,
				        "_token": $('#token').val(),

                    },
                    beforeSend: function() {
				        $('.main-search').fadeOut(500);
                        $(".searchoverlay").fadeIn(500);
                    },
                    success: function(data) {
                        //console.log(data);
                        $('.main-search').hide();
                        $('.results').empty();
                        $('.results').append(data);
                        $(".searchoverlay").fadeOut();

                        GL_BC.filterDisplayClear();
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
        },


        categoryMap: function () {
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

            // call api get places
            let ajax_url = window.location.href;
            (ajax_url.indexOf('?') > -1) ? ajax_url += '&ajax=1' : ajax_url += '?ajax=1';

            $.ajax({
                dataType: 'json',
                url: ajax_url,
                beforeSend: function () {
                    console.log("before call api get places map");
                },
                success: function (response) {
                    let data = response.data;

                    console.log("data: ", data);

                    var golo_map_style_silver = [
                        {
                            "featureType": "landscape",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
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

                    if (data.city) {
                        golo_map_option.center = {lat: parseFloat(data.city.lat), lng: parseFloat(data.city.lng)};
                    } else {
                        console.log("khong co city: ", data.city);
                        golo_map_option.center = new google.maps.LatLng(0, 0);
                        golo_map_option.zoom = 2;
                        golo_map_option.minZoom = 0;
                    }

                    var map = new google.maps.Map(document.getElementById('place-map-filter'), golo_map_option);
                    golo_create_markers(data.places, map);

                },
            });


        }


    }

    GL_BC.init();
})(jQuery);
