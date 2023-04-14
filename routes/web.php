<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\personalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingProduct;


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

// Route::get('/', [ProductController::class,'index']);
Route::get('/', [HomeController::class,'index']);
Route::get('/products', [ProductController::class,'products']);
Route::get('/detail/{i}', [ProductController::class,'detail']);
Route::get('/cart', [ProductController::class,'cart']);

// =================================
Route::prefix('blog')->group(function(){
    Route::get('/',[BlogController::class,'all']);
    Route::get('/detail/{cate?}/{title?}.html',[BlogController::class,'detail']);
    Route::get('/viewmoreBlogs/{min?}',[BlogController::class,'viewMoreBlog']);
    Route::get('/viewmoreBlogsNormal/{min?}',[BlogController::class,'viewMoreBlogNormal']);
    Route::get('/viewmoreBlogByCate/{cate?}/{id?}',[BlogController::class,'viewMoreBlogByCate']);
    Route::get('/viewmoreBlogByCateNormal/{cate?}/{id?}',[BlogController::class,'viewMoreBlogByCateNormal']);
    Route::get('/categories/{slug?}.html',[BlogController::class,'getBlogByCate']);
    Route::get('/tag/{slug?}_{id?}.html',[BlogController::class,'blogByTag']);
    Route::get('/viewMoreBlogByTag/{tag?}/{id?}',[BlogController::class,'viewMoreBlogByTag']);
    Route::get('/viewMoreBlogByTagNormal/{tag?}/{id?}',[BlogController::class,'viewMoreBlogByTagNormal']);
});
// ============================================================================
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleController::class, 'callbackGoogle']);
// ==========================================================================
Route::get('auth/facebook', [FacebookController::class, 'redirect']);
Route::get('auth/facebook/call-back', [FacebookController::class, 'callbackFacebook']);
// ============================================================================
Route::middleware('prevent-back-history')->group(function () {
    Route::get('/login', [Customer::class, 'login'])->middleware('logined');
    Route::post('/login', [Customer::class, '_login'])->middleware('logined');
    Route::post('/register',[Customer::class,'_register'])->middleware('logined');
    Route::get('/my-account',[Customer::class,'my_account'])->middleware('check-login');
    Route::get('/register',[Customer::class,'register'])->middleware('logined');
    Route::get('/logout',[Customer::class,'logout']);
    Route::get('/active/account/email-verify/{email}.html',[Customer::class,'activated']);
});
Route::get('/lien-he', [ContactInfoController::class,'index']);
Route::get('/gioi-thieu', [AboutController::class,'index']);
Route::get('/shop/thoi-trang-nam', [ShopController::class,'menShop']);
Route::get('/shop/thoi-trang-nu', [ShopController::class,'womenShop']);
Route::get('/shop/{slug}', [ShopController::class,'shopDetail']);
Route::get('/shop', [ShopController::class,'index']);
// Route::get('/personal', [personalController::class,'index']);
Route::post('/addRating',[RatingProduct::class,'addRating']);

// 
Route::post('/customerChangePassword',[Customer::class,'change_password']);
Route::post('/forgotPassword',[Customer::class,'forgot']);
Route::get('/customer/reset-password/{code?}.html',[Customer::class,'reset_pass']);
Route::post('/resetNewPassword',[Customer::class,'_reset_pass']);