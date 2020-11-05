<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');

    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function() {
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::get('/sold', 'CheckoutController@sold')->name('sold');
    Route::post('/process', 'CheckoutController@process')->name('process');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');

    Route::post('/notification', 'CheckoutController@notification')->name('notification');
});

Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController')->middleware('user.has.no.store');
        Route::resource('categories', 'CategoryController');

        Route::post('photo/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index')->name('orders.my');
    });
});

Auth::routes();



// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/model', function() {
    //$products = \App\Product::all();

    // $user = new \App\User();
    // $user = \App\User::find(2);
    // $user->name = 'Glenda';
    // $user->email = 'glendaoliveira2009@hotmail.com';
    // $user->password = bcrypt('123456789');
    // $user->save();

    // return \App\User::all();
    // return \App\User::find(6);
    // return \App\User::where('name', 'Jamal Nolan')->first();
    // return \App\User::paginate(10);

        // $user = \App\User::create([
        //     'name' => 'Sandro Gabriel',
        //     'email' => 'sandrogtn2@gmail.com',
        //     'password' => bcrypt('123456789')
        // ]);

        // $user = \App\User::find(41);
        // $user = $user->update([
        //     'name' => 'Sandro Nascimento'
        // ]);

    // $user = \App\User::find(4);

    // $loja = \App\Store::find(1);
    // return $loja->products()->where('id', 1)->get();

    // $categoria = \App\Category::find(1);
    // $categoria->products;

    // $user = \App\User::find(4);
    // $store = $user->store()->create([
    //     'name' => 'Loja Teste',
    //     'description' => 'Loja teste de produtos de informática',
    //     'phone' => '84-99999-9999',
    //     'mobile_phone' => '84-99999-9999',
    //     'slug' => 'loja-teste',
    // ]);

    // return $store;

    // $store = \App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Bike Rocker Elleven',
    //     'description' => 'MTB Quadro 19 Vermelho/Preto',
    //     'body' => 'Kit Shimano Tourney TZ',
    //     'price' => 2729.99,
    //     'slug' => 'bike-rocker-elleven'
    // ]);

    // return $product;

    // \App\Category::create([
    //     'name' => 'Bike Rocker Elleven',
    //     'description' => 'Elleven produtos esportivos',
    //     'slug' => 'bike-rocker-elleven'
    // ]);

    // \App\Category::create([
    //     'name' => 'Bike Oggi',
    //     'description' => 'Oggi produtos esportivos',
    //     'slug' => 'bike-oggi'
    // ]);

    // return \App\Category::all();

    // $product = \App\Product::find(1);

    // return $product->categories;

    // Route::prefix('stores')->name('stores.')->group(function(){
    //     Route::get('/', 'StoreController@index')->name('index');
    //     Route::get('/create', 'StoreController@create')->name('create');
    //     Route::post('/store', 'StoreController@store')->name('store');
    //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
    //     Route::post('/update/{store}', 'StoreController@update')->name('update');
    //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
    // });
});

Route::get('not', function () {
    $user = App\User::find(1);
    // $user->notify(new App\Notifications\StoreReceiveNewOrder());
    // $notification = $user->notifications->first();
    // $notification->markAsRead();

    // return $user->unreadNotifications->count();
});
