<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\Payment\PaypalController;
use App\Http\Controllers\Frontend\Payment\TapController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\ShopTagController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\ModelsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/index',function(){
        return view('index');
})->name('index');

Route::get('/', [ModelsController::class, 'index'])->name('home');

Route::get('/get-base-models',[ModelsController::class, 'getBaseModels'])->name('getbasemodels');
Route::get('/get-schedulers',[ModelsController::class, 'getSchedulers'])->name('getschedulers');
Route::post('/generate-images',[ModelsController::class, 'generateImages'])->name('generateImages');
Route::post('/get-superResolution',[ModelsController::class, 'getSuperResolutionImage'])->name('getSuperResolutionImage');
Route::post('/save-superResolution',[ModelsController::class, 'saveSuperResolutionImage'])->name('saveSuperResolutionImage');
Route::post('/restart',[ModelsController::class, 'restartServer'])->name('restart');

// Login by social media [ Facebook - Twitter - Google ]
// Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social_login');
// Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social_login_callback');





// Route::get('/search', [HomeController::class, 'search'])->name('search');
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::get('/shop/{slug?}', [ShopController::class, 'index'])->name('shop.index');
// Route::get('/shop/tag/{slug}', [ShopTagController::class, 'index'])->name('shop.tag');
// Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
// Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
// Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
// Route::get('order/upload-orders', [OrderController::class, 'showOrderForm'])->name('upload.order');
// Route::post('order/upload-orders', [OrderController::class, 'saveOrder'])->name('save.order');




// Route::middleware(['middleware' => 'auth', 'verified'])->group(function() {
//     Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
//     Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
//     Route::patch('/user/profile', [UserController::class, 'updateProfile'])->name('user.update_profile');
//     Route::get('/user/profile/remove-image', [UserController::class, 'removeImage'])->name('user.remove_image');
//     Route::get('/user/addresses', [UserController::class, 'addresses'])->name('user.addresses');
//     Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
// });

// Route::middleware(['middleware' => 'auth', 'checkCart'])->group(function() {
//     Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
//     // PayPal gateway
//     Route::post('/payment', [PaypalController::class, 'store'])->name('payment.store');
//     Route::get('/payment/{orderId}/cancelled', [PaypalController::class, 'cancelled'])->name('payment.cancelled');
//     Route::get('/payment/{orderId}/completed', [PaypalController::class, 'completed'])->name('payment.completed');
//     Route::get('/payment/webhook/{order?}/{env?}', [PaypalController::class, 'webhook'])->name('payment.webhook.ipn');
//     // Tap gateway
//     Route::get('/payment/charge-request', [TapController::class, 'chargeRequest'])->name('checkout.charge_request');
//     Route::get('/payment/charge-update', [TapController::class, 'chargeUpdate'])->name('checkout.charge_update');
// });
