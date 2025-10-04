<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
    HomeController,
    CartController,
    SuperAdminController,
    UserController,
};
use App\Http\Controllers\Admin\{
    AdminController,
    AttributeController,
    ConfigController,
    BannerController,
    ProductController,
    CategoryController,
    CustomerController,
    PermissionsController,
    PageController,
    InquiryController,
    RolesController,
    OrderController
};
use App\Models\{Inquiry, Vehicle};

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



Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('our-app', [HomeController::class, 'ourApp'])->name('ourApp');
Route::get('membership', [HomeController::class, 'membership'])->name('membership');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy');
Route::get('faqs', [HomeController::class, 'faq'])->name('faq');
Route::get('terms-and-conditions', [HomeController::class, 'terms'])->name('terms');


//Facebook Login
Route::get('/redirect', [UserController::class, 'redirectFacebook']);
Route::get('/callback', [UserController::class, 'facebookCallback']);
//Google Login
Route::get('auth/google', [UserController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);



Route::post('/inquiry-submit', [InquiryController::class, 'submit'])->name('inquiry.submit');




Route::group(['middleware' => ['auth', 'isSuper']], function () {
    //Category
    Route::resource('category', CategoryController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('roles', RolesController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    Route::get('/crud-generator', [Hamdan\CrudGenerator\Controllers\ProcessController::class, 'getGenerator'])->name('generator');
    Route::post('process', [Hamdan\CrudGenerator\Controllers\ProcessController::class, 'postGenerator'])->name('postGenerator');
    // Config
    Route::group(['prefix' => 'config'], function () {
        Route::get('favicon', [ConfigController::class, 'favicon'])->name('admin.config.favicon');
        Route::get('logo', [ConfigController::class, 'logo'])->name('admin.config.logo');
        Route::get('settings', [ConfigController::class, 'configSettings'])->name('admin.config.settings');
        Route::post('update', [ConfigController::class, 'configPost'])->name('admin.config.post');
        Route::get('option', [ConfigController::class, 'configOption'])->name('admin.config.option');
        Route::post('add-new-config', [ConfigController::class, 'addNewConfig'])->name('add.new.config');
        Route::post('option/update', [ConfigController::class, 'configOptionUpdate'])->name('admin.config.option.update');
    });

    // Section Create
    Route::post('section-create', [PageController::class, 'sectionCreate'])->name('section.create');

    //Inquiry
    Route::get('inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
    Route::get('inquiry-detail/{id}', [InquiryController::class, 'detail'])->name('inquiry.detail');

    // Banner
    Route::resource('banner', BannerController::class);

    //Category
    Route::resource('category', CategoryController::class);

    //Page
    Route::resource('page', PageController::class);

    //Product
    Route::resource('product', ProductController::class);

    //Order
    Route::resource('order', OrderController::class);
    Route::get('order-detail/{id}', [OrderController::class,'orderDetail'])->name('order_detail');

    //Delete Productimage
    Route::post('/product/delete-image', [ProductController::class, 'deleteImages'])->name('product.delete_img');

    //Attribute
    Route::resource('attribute', AttributeController::class);

    //Delete Attribute Value
    Route::post('/product/delete-attribute-value', [AttributeController::class, 'deleteAttrValue'])->name('attribute.deleteAttrValue');


    // Customer
    Route::resource('customer', CustomerController::class);

    require_once('crudweb.php');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' =>  ['auth', 'isUser']], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::get('/wishlist',[UserController::class,'wishlist'])->name('wishlist');
    Route::get('/order-hisory',[UserController::class,'orderHistory'])->name('orders');
    Route::get('generate-invoice/{id}', [UserController::class, 'generateInvoice'])->name('generateinvoice');
    Route::post('/account-update', [UserController::class, 'accountUpdate'])->name('update');
});

Route::group(['as' => 'product.'], function () {
    Route::get('shop', [CartController::class, 'shop'])->name('shop');
    Route::get('product-detail/{slug}',[CartController::class, 'detail'])->name('detail');
    Route::get('checkout',[CartController::class, 'checkout'])->name('checkout');
    Route::post('payment',[CartController::class, 'payment'])->name('payment');
    Route::get('add-wishlist',[CartController::class,'addWishlist'])->name('Addwishlist');
});
