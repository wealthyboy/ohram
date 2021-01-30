<?php 


use Illuminate\Http\Request;






Route::group(['middleware' => 'admin','prefix' => 'admin'], function(){
    Route::get('/','Admin\HomeCtrl@index')->name('admin_home');

    Route::get('/maintainance/mode', 'Live\LiveController@index')->name('maintainance');
    Route::get('live', 'Live\LiveController@activate');

    Route::resource('permissions','Admin\Permission\PermissionsController',['names'=>'permissions']);

    Route::resource('orders','Admin\Orders\OrdersController',['names' => 'admin.orders']);
    Route::get('orders/invoice/{id}','Admin\Orders\OrdersController@invoice')->name('order.invoice');
    Route::post('update/ordered_product/status','Admin\Orders\OrdersController@updateStatus');

    /* ambassador */
    Route::post('ambassador/mail/{id}','Admin\Ambassador\AmbassadorsController@sendNotification')->name('ambassador.status');

    Route::resource('ambassadors','Admin\Ambassador\AmbassadorsController',['names'=>'ambassadors']);
    /* ambassador */

    Route::get('orders/dispatch/{id}','Admin\Orders\OrdersController@dispatchNote')->name('order.dispatch.note');
    Route::resource('banners', 'Admin\Design\BannersController',['names' =>'banners']);
    Route::get('requery/{id}',  'Admin\Transaction\TransactionController@requery');

    Route::resource('transactions', 'Admin\Transaction\TransactionController',['names' =>'transactions']);


    Route::get('customers',  'Admin\Users\UsersController@customers')->name('customers');
    Route::resource('reviews',  'Admin\Reviews\ReviewsController',['names' => 'reviews']);
    Route::resource('posts',  'Admin\Blog\BlogController',['names' => 'posts']);

    Route::get('post/{post_id}/comments',  'Admin\Comments\CommentsController@comments');
    Route::delete('comments/{comment}',  'Admin\Comments\CommentsController@destroy');

    Route::resource('settings','Admin\Settings\SettingsController',['names' => 'settings']);
    Route::get('account','Admin\Account\AccountsController@index')->name('admin_account');
    Route::get('account/filter','Admin\Account\AccountsController@index')->name('filter_sales');


    Route::resource('category','Admin\Category\CategoryController',['names'=>'category']);
    Route::post('category/delete/image','Admin\Category\CategoryController@undo');

    Route::resource('discounts','Admin\Discounts\DiscountsController',['names' => 'discounts']);
    Route::resource('shipping','Admin\Shipping\ShippingController',['names'=>'shipping']);
    Route::resource('location','Admin\Location\LocationController',['names'=>'location']);
    Route::resource('media','Admin\Media\MediaController',['names'=>'media']);

    Route::resource('attributes','Admin\Attributes\AttributesController',['names'=>'attributes']);
    Route::resource('payments','Admin\Payments\PaymentController',['name'=>'payments']);
    Route::resource('rates','Admin\CurrencyRates\CurrencyRatesController',['name'=>'rates']);
    Route::resource('vouchers','Admin\Vouchers\VouchersController',['names'=>'vouchers']);
   
    Route::resource('products','Admin\Product\ProductController',['names' => 'products']);
    Route::delete('products/destroy/multiple','Admin\Product\ProductController@destroy');

    Route::get('search-products','Admin\Product\ProductController@search')->name('search_products');
    Route::delete('variation/delete/{id}',  'Admin\Product\ProductController@destroyVariation');
    Route::get('related/products',     'Admin\Product\ProductController@getRelatedProducts');
    Route::delete('delete/{id}/related_products',     'Admin\Product\ProductController@destroyRelatedProduct');

    Route::post('upload/image','Admin\Image\ImagesController@store');
    Route::post('delete/image','Admin\Image\ImagesController@undo');

    Route::post('upload','Admin\Uploads\UploadsController@store');
    Route::get('delete/upload','Admin\Uploads\UploadsController@destroy');


    Route::get('/products/invoice/{id}','Admin\Product\ProductController@printInvoice')->name('print_sku');
    Route::get('/products/barcode/{product}','Admin\Product\ProductController@barcode')->name('barcode');
    Route::post('load-attributes','Admin\Product\ProductController@loadAttr');
    Route::get('products/{id}/variation', 'Admin\Variation\ProductVariationController@index')->name('variations');
    Route::get('get-related-attributes',  'Admin\Product\ProductController@index')->name('variations');

    /* INFORMATION */
    Route::resource('pages','Information\InformationController',['name' => 'pages']);
    /* INFORMATION */

    Route::post('page/banner','Admin\PageBanner\PageBannerController@store');
    Route::post('blog/delete/image','Admin\PageBanner\PageBannerController@undo');


    Route::post('products/delete','Admin\Product\ProductController@destroy')->name('delete_products');
    Route::post('variation/create','Admin\Product\ProductController@saveVariation');
    Route::post('logout',  'Auth\LoginController@logout')->name('admin_users_logout');
 
    Route::get('register','Admin\Users\UsersController@create')->name('create_admin_users');
    Route::post('register','Auth\RegisterController@register');

    Route::resource('users',  'Admin\Users\UsersController',['names'=>'admin.users']);
    Route::resource('customers', 'Admin\Customers\CustomersController',['name'=>'customers']);
    Route::resource('newsletter',              'Admin\NewsLetter\NewsLetterController',['name'=>'newsletter']);
    Route::resource('lists',              'Admin\EmailLists\EmailListsController',['name'=>'lists']);
    Route::get('lists/emails/create/{id}',      'Admin\NewsLetter\NewsLetterController@create');
    Route::post('lists/emails/create/{id}',      'Admin\NewsLetter\NewsLetterController@store');

    Route::resource('campaigns',              'Admin\Campaign\CampaignController',['name'=>'campaigns']);
    Route::get('campaigns/{campaign_id}/{email_list_id}/{template_id}',              'Admin\Campaign\CampaignController@resendMail');

    Route::resource('templates',              'Admin\Templates\TemplatesController',['name'=>'templates']);

    Route::resource('promos',             'Admin\Promo\PromoController',['names'=> 'promos']);
    Route::get('promo-text/create/{id}',      'Admin\PromoText\PromoTextController@create')->name('create_promo_text');
    Route::get('promo-text/edit/{id}',   'Admin\PromoText\PromoTextController@edit')->name('edit_promo_text');
    Route::post('promo-text/edit/{id}',  'Admin\PromoText\PromoTextController@update');
    Route::post('promo-text/create/{id}',     'Admin\PromoText\PromoTextController@store');
    Route::get('promo-text/delete/{id}',     'Admin\PromoText\PromoTextController@destroy')->name('delete_promo_text');
    Route::resource('brands', 'Admin\Brand\BrandsController',['names' =>'brands']);

});

Route::get('/mailable', function () {
    $order = App\Order::find(104);
    $settings =  App\SystemSetting::first();
    return new App\Mail\OrderReceipt($order,$settings,'₦');
}); 





Route::group(['middleware' => 'currencyByIp'], function(){

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::post('password/reset/link',           'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('reset/password',                'Auth\ForgotPasswordController@reset');
    Route::get('validate/token/{token}',         'Auth\ForgotPasswordController@validateToken');

    Auth::routes();
    Route::get('login/{service}',                 'Auth\SocialLoginController@redirect');
    Route::get('login/{service}/callback',        'Auth\SocialLoginController@callback');
    Route::get('account',                         'Account\AccountController@index')->name('account');
    Route::post('account',                        'Account\AccountController@update');
    Route::get('address',                         'Account\AddressController@index')->name('address');
    Route::get('partial/address',                 'Account\AddressController@getAddress');
    Route::get('change/password',                 'ChangePassword\ChangePasswordController@index');
    Route::put('change/password',                 'Api\ChangePassword\ChangePasswordController@update');
    Route::resource('blog',                       'Blog\BlogController',['name' => 'blog']);
    Route::get('blog/tag/{tag_id}',               'Blog\BlogController@tag');

    Route::get('reviews',                         'Reviews\ReviewsController@index');
    Route::post('ambassador/store',               'Ambassador\AmbassadorsController@store');

    Route::resource('/address',                   'Account\AddressController',['names' => 'addresses']);
    Route::get('returns',                         'Returns\ReturnsController@index')->name('returns');
    Route::get('checkout',                        'Checkout\CheckoutController@index')->name('checkout');
    Route::post('checkout/coupon',                'Checkout\CheckoutController@coupon');
    Route::get('checkout/confirm',               'Checkout\CheckoutController@confirm')->name('confirm_order');
    Route::get('orders',                          'Orders\OrdersController@index')->name('orders');
    Route::get('order/{id}',                      'Orders\OrdersController@show');
    Route::get('currency/{id}',                   'CurrencySwitcher\\CurrencySwitcherController@index');



    Route::post('vouchers-coupon',                'Checkout\CheckoutController@coupon');
    Route::get('errors',                          'Errors\errorsCtrl@index');
    Route::get('thankyou',                        'Thankyou\ThankYouCtrl@index');
    Route::get('register/confirm/{token}',        'Auth\RegisterController@verifyEmail');
    Route::get('shopping/cart/all',               'Cart\CartController@show')->name('shopping-cart');
    Route::get('cart',                            'Cart\CartController@index');
    Route::get('load-cart',                       'Cart\CartController@loadCart');

    Route::post('cart',                           'Cart\CartController@store');
    Route::post('update_cart',                    'Cart\CartController@update')->name('update_cart');
    Route::get('cart/all/in/cart',                'Cart\CartController@all_in_cart');
    Route::get('reviews/{product}',               'Api\Reviews\ReviewsController@index');
    Route::post('reviews/store',                  'Api\Reviews\ReviewsController@store');
    Route::post('/load-login-modal', function ( ) { 
        return view('modal.login.modal_body');
    });

    Route::post('/admin/permission-denied', function ( ) { 
        return view('errors.503');
    });
    
    Route::get('/search',                        'Products\ProductsController@search');
    Route::post('log/transaction',               'Transaction\TransactionController@log');

    Route::get('cart/delete/{cart_id}',          'Cart\CartController@delete');
    Route::post('cart-delete',                   'Cart\CartController@delete');
    Route::get('wishlist',                       'Favorites\FavoritesController@index')->name('wishlist');
    Route::post('newsletter/signup',              'Api\NewsLetter\NewsLetterController@store');
    Route::get('products/{category}',             'Products\ProductsController@index');
    Route::get('product/{category}/{product}',    'Products\ProductsController@show');
    Route::get('pages/{information}',             'Information\InformationController@show');
    Route::get('newsletter/unsubscribe',          'NewsLetter\NewsLetterController@index');
    Route::post('newsletter/unsubscribe',         'NewsLetter\NewsLetterController@unsubscribe');
});


Route::group(['prefix' => '/api','middleware' => 'currencyByIp'], function () {
    Route::get('products/{category}',             'Api\Products\ProductsController@index');
    Route::get('filters/products/{category}',     'Api\Products\ProductsController@filters');
    Route::get('product/{category}/{product}',    'Api\Products\ProductsController@show');
    Route::get('/search',                         'Api\Products\ProductsController@search');
    Route::get('cart',   'Api\Cart\CartController@loadCart');
    Route::post('cart',   'Api\Cart\CartController@store');
    Route::delete('cart/delete/{id}',   'Api\Cart\CartController@destroy');
    Route::resource('addresses',   'Api\Address\AddressController');
    Route::get('addresses/active/{id}',   'Api\Address\AddressController@makeDefault');
    Route::post('wishlist',   'Api\Favorites\FavoritesController@store');
    Route::get('wishlist',   'Api\Favorites\FavoritesController@index');
    Route::delete('wishlist/delete/{id}',   'Api\Favorites\FavoritesController@destroy');
    Route::get('blog/{blog}',   'Api\Blog\BlogController@show');
});

Route::post('webhook/payment',    'WebHook\WebHookController@payment');
Route::post('webhook/github',     'WebHook\WebHookController@gitHub');
Route::get('/requery',            'Requery\RequeryController@index');
Route::post('/transaction/status', 'Transaction\TransactionController@confirm');












