<?php

use App\Models\User;
use App\Models\Order;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Controllers\CartController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Auth\admin\CustomLoginController;
use App\Http\Controllers\Admin\RequestResetPasswordController;
use App\Http\Livewire\Counter;

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

Route::get('/change-language/{locale}', [LocaleController::class, 'switch'])->name('change.language');

Auth::routes([
    'verify' => true
]);

Route::get('/home', [ReportsController::class, 'sale'])->name('home')->middleware('auth');


/*the categories route*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('products', ProductsController::class)->except('destroy');
    Route::get('products/{product}/delete', [ProductsController::class, 'destroy'])->name('products.destroy');
    Route::get('gallery/{gallery}/delete', [ProductsController::class, 'destroy_gallery'])->name('gallery.destroy');
    Route::get('/trash/products', [ProductsController::class, 'trash'])->name('products.trash');
    Route::get('/products/{id}/restore', [ProductsController::class, 'restore'])->name('products.restore');
    Route::get('/products/{id}/force-delete', [ProductsController::class, 'forceDelete'])->name('products.forceDelete');

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/index', [CategoriesController::class, 'index'])->name('index');
        Route::get('/{category}', [CategoriesController::class, 'show'])->name('show');
        Route::get('/', [CategoriesController::class, 'create'])->name('create');
        Route::post('/category', [CategoriesController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
        Route::put('/{category}/update', [CategoriesController::class, 'update'])->name('update');
        Route::get('/{category}/destroy', [CategoriesController::class, 'destroy'])->name('destroy');
        Route::post('/search', [CategoriesController::class, 'search'])->name('search');
        Route::get('/trash/categories', [CategoriesController::class, 'trash'])->name('trash');
        Route::get('force-delete/{id}', [CategoriesController::class, 'forceDelete'])->name('forceDelete');
        Route::get('restore/{id}', [CategoriesController::class, 'restore'])->name('restore');
    });

    Route::resource('subcategories', SubCategoryController::class)->except('index', 'show');
    Route::get('/trash/subcategories', [SubCategoryController::class, 'trash'])->name('subcategories.trash');
    Route::get('/subcategories/{id}/restore', [SubCategoryController::class, 'restore'])->name('subcategories.restore');
    Route::get('/subcategories/{id}/force-delete', [SubCategoryController::class, 'forceDelete'])->name('subcategories.forceDelete');


    Route::get('coupons',[CouponController::class,'index'])->name('coupons.index');
    Route::get('coupons/create',[CouponController::class,'create'])->name('coupons.create');
    Route::post('coupons/store',[CouponController::class,'store'])->name('coupons.store');
    Route::get('coupons/{id}',[CouponController::class,'destroy'])->name('coupons.destroy');
    Route::post('coupons/check',[Counter::class,'coupon_check'])->name('coupons.check');
});

Route::resource('profile-user', ProfileController::class)->only('show', 'edit', 'update');
Route::get('change-password', [ProfileController::class, 'change_password'])->name('change.password');
Route::post('change-password', [ProfileController::class, 'reset_password'])->name('reset.password');
/*home pages (store app) routes ---start---*/
Route::get('/', [StoreController::class, 'index'])->name('store.home');
Route::get('store/{store}', [StoreController::class, 'index'])->name('store.index');
Route::get('product/{product}', [StoreController::class, 'productShow'])->name('store.product.show');
/*home pages (store app) routes ---end---*/


/*cookies routes ---start---*/
/** this for test cookie*/
Route::get('/cookie-send', function () {
    Cookie::queue(Cookie::make('cart', 'product two', 10));
    toast('storage', 'success');
    return view('welcome');/*if i want to return view must use queue*/
});
/**if i want to delete cookie select time on the past*/
Route::get('/cookie-delete', function () {
    return response('hello there i delete cookie in here !')
        ->cookie(Cookie::make('cart', 'product two', -10));
        /*if i want to return response*/
});
/**cookies routes ---end---*/


/**cart routes ---start---*/
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
/**cart routes ---end---*/
/**checkout routes ---start---*/
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
/**checkout routes ---end---*/
/**orders routes ---start---*/
Route::get('orders', [OrderController::class, 'index'])->name('order.index');
/**orders routes ---end---*/

/**paypal routes ---start---*/
Route::get('paypal/return', [CheckoutController::class, 'paypalReturn'])->name('paypal.return');
Route::get('paypal/cancel', [CheckoutController::class, 'paypalCancel'])->name('paypal.cancel');
/**paypal routes ---end---*/

/**notifications routes ---start---*/
Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
Route::get('notification/{id}', [NotificationController::class, 'read'])->name('notification.read');
/*notifications routes ---end---*/

/*Route::get('{category}/restores', function (\App\Models\Admin\Category $category){
    dd($category);
})->name('categories.restore');*/
Route::get('{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::apiResource('chat/messages', MessagesController::class)->middleware('auth');



Route::get('/payment/checkout', [OrderController::class, 'checkout'])->name('payment.checkout');
Route::get('/payment/callback', [OrderController::class, 'callback'])->name('payment.callback');



Route::get('social/login', [SocialLoginController::class, 'login'])->name('social.login');
Route::get('social/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('social.redirect');
Route::get('social/{provider}/callback', [SocialLoginController::class, 'callback'])->name('social.callback');

/*
Route::get('/custom/reset-password/request', [RequestResetPasswordController::class, 'index'])->name('request.password');
Route::post('/custom/reset-password/request', [RequestResetPasswordController::class, 'store']);
Route::get('/custom/reset-password/code', [RequestResetPasswordController::class, 'code'])->name('request.password.code');
Route::post('/custom/reset-password/code', [RequestResetPasswordController::class, 'check']);
Route::match(['get', 'post'], '/custom/reset-password/reset/{user} ', [RequestResetPasswordController::class, 'reset'])->name('request.password.reset');
 */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password-token', [ForgotPasswordController::class, 'token_code'])->name('reset.password.token');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



Route::view('map', 'maps');



Route::get('/users/export', [ExcelController::class, 'export'])->name('export.users');
Route::get('/users/import', [ExcelController::class, 'import'])->name('export.users');



Route::view('test/vue','showvue');
