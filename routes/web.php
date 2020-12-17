<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StripePaymentController;
use Kubis\AgeGate\Controllers\MainController;


Auth::routes();
Route::post('submit/age',[MainController::class, 'post']);

$router->group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


/**
 * Frontend Router
 */
$router->group([
    'namespace' => 'Frontend',
    // 'middleware' => []], function () use ($router) {
     'middleware' => ['age-gate']], function () use ($router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/language/{locale}', 'HomeController@changeLanguage')->name('change_language');
    $router->get('/search', 'HomeController@search')->name('search');

    $router->get('/blog/all', 'PostController@list')->name('post_list_all');
    $router->get('/blog/{cat_slug}', 'PostController@list')->where('cat_slug', '[a-zA-Z0-9-_]+')->name('post_list');
    $router->get('/post/{slug}-{id}', 'PostController@detail')
        ->where('slug', '[a-zA-Z0-9-_]+')
        ->where('id', '[0-9]+')->name('post_detail');

    $router->get('/page/contact', 'HomeController@pageContact')->name('page_contact');
    $router->post('/page/contact', 'HomeController@sendContact')->name('page_contact_send');

    $router->get('/page/landing/{page_number}', 'HomeController@pageLanding')->name('page_landing');

    $router->get('/city/{slug}', 'CityController@detail')->name('city_detail');
    $router->get('/city/{slug}/{cat_slug}', 'CityController@detail')->name('city_category_detail');

    $router->get('/place/{slug}', 'PlaceController@detail')->name('place_detail');
    $router->get('/place/{id}', 'PlaceController@businessInfo')->name('business_info');
    $router->get('/new-place', 'PlaceController@pageNew')->name('place_addnew');
    $router->get('/edit-place/{id}', 'PlaceController@pageAddNew')->name('place_edit')->middleware('auth');
    $router->post('/place', 'PlaceController@create')->name('place_create')->middleware('auth');
    $router->put('/place', 'PlaceController@update')->name('place_update')->middleware('auth');
    $router->get('/places/filter', 'PlaceController@getListFilter')->name('place_get_list_filter');
    $router->get('/business/filter', 'HomeController@BusinesSearch')->name('business_get_list_filter');

    $router->post('/review', 'ReviewController@create')->name('review_create')->middleware('auth');
    $router->post('/following', 'UserController@addWishlist')->name('add_wishlist')->middleware('auth');
    $router->delete('/following', 'UserController@removeWishlist')->name('remove_wishlist')->middleware('auth');

    $router->get('/user/profile', 'UserController@pageProfile')->name('user_profile')->middleware('auth');
    $router->put('/user/profile', 'UserController@updateProfile')->name('user_profile_update')->middleware('auth');
    $router->put('/user/profile/password', 'UserController@updatePassword')->name('user_password_update')->middleware('auth');
    $router->get('/user/reset-password', 'UserController@pageResetPassword')->name('user_reset_password');
    $router->put('/user/reset-password', 'ResetPasswordController@reset')->name('user_update_password');

    $router->get('/user/my-place', 'UserController@pageMyPlace')->name('user_my_place')->middleware('auth');
    // $router->get('/user/my-place', 'UserController@pageBusiness')->name('user_my_place')->middleware('auth');
    $router->get('/user/store-info', 'PlaceController@businessInfo')->name('business_info')->middleware('auth');
    $router->get('/user/store-reviews', 'PlaceController@pageReviews')->name('business_reviews')->middleware('auth');
    $router->get('/user/store-menu', 'PlaceController@showMenu')->name('business_menu')->middleware('auth');
    $router->delete('/user/my-place', 'UserController@deleteMyPlace')->name('user_my_place_delete')->middleware('auth');


    $router->get('/user/following', 'UserController@pageWishList')->name('user_wishlist')->middleware('auth');

    $router->post('/bookings', 'BookingController@booking')->name('booking_submit');

    $router->get('/auth/{social}', 'SocialAuthController@redirect')->name('login_social');
    $router->get('/auth/{social}/callback', 'SocialAuthController@callback')->name('login_social_callback');

    $router->get('/ajax-search', 'HomeController@ajaxSearch');
    $router->get('/ajax-search-listing', 'HomeController@searchListing');
    $router->get('/search', 'HomeController@search')->name('search');
    $router->get('/map-search', 'HomeController@Mapsearch')->name('mapsearch');
    $router->get('/places/map', 'PlaceController@getListMap')->name('place_get_list_map');
    $router->get('/places/mapsearch', 'PlaceController@getListMapSearch')->name('place_get_list_map');

    $router->get('/cities/{country_id}', 'CityController@getListByCountry')->name('city_get_list');
    $router->get('/cities', 'CityController@search')->name('city_search');

    $router->get('/search-listing-input', 'HomeController@searchListing')->name('search_listing');
    $router->get('/search-listing', 'HomeController@pageSearchListing')->name('page_search_listing');
    $router->get('/category/{slug}', 'CategoryController@listPlace')->name('category_list');
    $router->get('/categories', 'CategoryController@search')->name('category_search');

    // My Routes
        $router->get('/busi', 'newcontroller@Business_signup')->name('business_signup');
//     Route::view('URI', 'viewName');


});
$router->group([
    'namespace' => 'commons',
    'middleware' => []], function () use ($router) {
    // 'middleware' => ['age-gate']], function () use ($router) {

        // My Routes
            $router->get('/busiP', 'newcontroller@Business_package')->name('business_package');
            $router->post('/busiAdd', 'newcontroller@Business_signup')->name('save_business');

            // Product management routes
    // Route::resource('products', 'ProductsController')->middleware('auth');

    $router->post('/products-store', 'ProductsController@store')->name('product.store');
    $router->delete('/products/{id}', 'ProductsController@destroy')->name('product.destroy');
    $router->put('/products-store', 'ProductsController@update')->name('product.edit');
    $router->get('/products/{slug}', 'ProductsController@show')->name('product.show');
    // Search reviews
    $router->get('/review-search', 'newcontroller@searchReview')->name('search.review');


    //search products
    $router->get('/product-search', 'newcontroller@searchProduct')->name('search.product');


    $router->post('/Deals', 'DealsController@store')->name('deal.store');
    $router->delete('/Deals/{id}', 'DealsController@destroy')->name('deal.destroy');
    $router->put('/Deals', 'DealsController@update')->name('deal.edit');


    //discovery pages
    $router->get('/discover/products', 'newcontroller@ProductDiscoveryPage')->name('discover.product');




});

/*
 * AdminCP Router
 */
$router->group([
    'prefix' => 'admincp',
    'namespace' => 'Admin',
    'as' => 'admin_',
    'middleware' => ['auth', 'auth.admin']], function () use ($router) {

    $router->get('/', 'DashboardController@index')->name('dashboard');

    $router->get('/country', 'CountryController@list')->name('country_list');
    $router->post('/country', 'CountryController@create')->name('country_create');
    $router->put('/country', 'CountryController@update')->name('country_update');
    $router->delete('/country/{id}', 'CountryController@destroy')->name('country_delete');

    $router->get('/city', 'CityController@list')->name('city_list');
    $router->post('/city', 'CityController@create')->name('city_create');
    $router->put('/city', 'CityController@update')->name('city_update');
    $router->put('/city/status', 'CityController@updateStatus')->name('city_update_status');
    $router->delete('/city/{id}', 'CityController@destroy')->name('city_delete');

    $router->get('/category/{type}', 'CategoryController@list')->name('category_list');
    $router->post('/category', 'CategoryController@create')->name('category_create');
    $router->put('/category', 'CategoryController@update')->name('category_update');
    $router->delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');


    $router->get('/amenities', 'AmenitiesController@list')->name('amenities_list');
    $router->post('/amenities', 'AmenitiesController@create')->name('amenities_create');
    $router->put('/amenities', 'AmenitiesController@update')->name('amenities_update');
    $router->delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

    //    Payment Types Routes
    $router->get('/payment', 'paymentTypesController@index')->name('payment_list');
    $router->post('/payment', 'paymentTypesController@store')->name('payment_create');
    $router->put('/payment', 'paymentTypesController@update')->name('payment_update');
    $router->delete('/payment/{id}', 'paymentTypesController@destroy')->name('payment_delete');

   $router->get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
   $router->post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
   $router->put('/place-type', 'PlaceTypeController@update')->name('place_type_update');
   $router->delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');

    $router->get('/place', 'PlaceController@list')->name('place_list');
    $router->get('/place/add', 'PlaceController@createView')->name('place_create_view');
    $router->get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
    $router->post('/place', 'PlaceController@create')->name('place_create');
    $router->put('/place', 'PlaceController@update')->name('place_update');
    $router->delete('/place/{id}', 'PlaceController@destroy')->name('place_delete');

    $router->get('/review', 'ReviewController@list')->name('review_list');
    $router->delete('/review', 'ReviewController@destroy')->name('review_delete');

    $router->get('/users', 'UserController@list')->name('user_list');
    $router->get('/users/businesses', 'UserController@business_list')->name('business_user_list');

    $router->get('/blog', 'PostController@list')->name('post_list_blog');
    $router->get('/pages', 'PostController@list')->name('post_list_page');

    $router->get('/posts/add/{type}', 'PostController@pageCreate')->name('post_add');
    $router->get('/posts/{id}', 'PostController@pageCreate')->name('post_edit');
    $router->post('/posts', 'PostController@create')->name('post_create');
    $router->put('/posts', 'PostController@update')->name('post_update');
    $router->delete('/posts/{id}', 'PostController@destroy')->name('post_delete');

    $router->get('/post-test', 'PostController@createPostTest');
    $router->get('/language/copy-folder', 'LanguageController@testCopyFolder');

//    $router->get('/bookings', 'BookingController@list')->name('booking_list');
//    $router->put('/bookings', 'BookingController@updateStatus')->name('booking_update_status');

    $router->get('/settings', 'SettingController@index')->name('settings');
    $router->post('/settings', 'SettingController@store')->name('setting_create');

    $router->get('/settings/language', 'SettingController@pageLanguage')->name('settings_language');
    $router->get('/settings/translation', 'SettingController@pageTranslation')->name('settings_translation');

    $router->put('/settings/language/status/{code}', 'LanguageController@updateStatus')->name('settings_language_status');
    $router->put('/settings/language/default', 'LanguageController@updateStatus')->name('settings_language_default');


    $router->get('/upgrade-to-v110', 'UpgradeController@upgradeToVersion110')->name('upgrade_v110');
    $router->get('/upgrade-to-v112', 'UpgradeController@upgradeToVersion112')->name('upgrade_v112');
    $router->get('/upgrade-to-v114', 'UpgradeController@upgradeToVersion114')->name('upgrade_v114');


    $router->get('/testimonials', 'TestimonialController@list')->name('testimonial_list');
    $router->get('/testimonials/add', 'TestimonialController@pageCreate')->name('testimonial_page_add');
    $router->get('/testimonials/edit/{id}', 'TestimonialController@pageCreate')->name('testimonial_page_edit');
    $router->post('/testimonials', 'TestimonialController@create')->name('testimonial_action');
    $router->put('/testimonials', 'TestimonialController@update')->name('testimonial_action');

    /* $router->get('/roles', 'RoleController@index')->name('roles.index');
    $router->get('/roles-Add', 'RoleController@create')->name('roles.create');
    $router->post('/roles-Add', 'RoleController@store')->name('roles.store'); */

        Route::resource('roles', 'RoleController');

        Route::resource('product-category', 'ProductCategoryController');

        $router->get('/product-category', 'ProductCategoryController@index')->name('product-category.index');
        $router->post('/product-category', 'ProductCategoryController@store')->name('product-category.store');
        $router->put('/product-category', 'ProductCategoryController@update')->name('product-category.update');
        $router->delete('/product-category/{id}', 'ProductCategoryController@destroy')->name('product-category.delete');

        // Route::resource('product-subcategory', 'ProductSubCategoryController');

        $router->get('/product-subcategory', 'ProductSubCategoryController@index')->name('subcategory.index');
        $router->post('/product-subcategory', 'ProductSubCategoryController@store')->name('subcategory.store');
        $router->put('/product-subcategory', 'ProductSubCategoryController@update')->name('subcategory.update');
        $router->delete('/product-subcategory/{id}', 'ProductSubCategoryController@destroy')->name('subcategory.delete');


});
$router->get('/admincp/login', 'Admin\UserController@loginPage')->name('admin_login');

/*
* New Routes
 */
Route::view('/map', 'frontend.New.tryMap')->middleware('auth');

/* ======================fiiter subcategories by category */
$router->get('/sub-categories/{category_id}', 'commons\ProductsController@getListByCategory')->name('get.Subcategories');



//...............................Paypal Intergration ..................................//

Route::get('/execute-payment', [PaymentController::class ,'execute']);
Route::post('/create-payment', [PaymentController::class,'create'])->name('create-payment');

Route::get('plan/create',[SubscriptionController::class,'createPlan']);

Route::get('plan/list',[SubscriptionController::class,'listPlan']);
Route::get('plan/{id}',[SubscriptionController::class,'showPlan']);
Route::get('plan/{id}/activate',[SubscriptionController::class,'activatePlan']);

Route::post('plan/{id}/agreement/create',[SubscriptionController::class,'createAgreement'])->name('create-agreement');
Route::get('execute-agreement/{success}',[SubscriptionController::class,'executeAgreement']);


//.................Stripe Payment intergration ...............//

Route::get('/stripe-payment', [StripePaymentController::class, 'handleGet']);
Route::post('/stripe-payment', [StripePaymentController::class, 'handlePost'])->name('stripe.payment');
