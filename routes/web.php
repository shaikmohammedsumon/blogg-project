<?php

use App\Http\Controllers\AboutsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\ConnectedModelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\RequsetModelController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\GestAuthenticationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;




Auth::routes(['register' =>false]);




//Frontend
Route::get('/',[HomeController::class,'index'])->name('Frontend');
Route::get('/catogory/{slug}',[HomeController::class,'show'])->name('Frontend.cat.blog');
Route::get('/blog/index',[\App\Http\Controllers\Frontend\BlogController::class,'index'])->name('frontend.blog.index');
Route::get('/blog/singel/index/{id}',[\App\Http\Controllers\Frontend\BlogController::class,'singel_index'])->name('frontend.blog.singel.index');
Route::post('/blog/comment/{id}',[\App\Http\Controllers\Frontend\BlogController::class,'comment'])->name('frontend.blog.comment');

Route::post('/search/post',[HomeController::class,'search'])->name('search.post');

Route::get('/authors',[HomeController::class,'authors'])->name('authors.index');
Route::get('/abouts',[HomeController::class,'abouts'])->name('abouts.index');

Route::get('/contract',[HomeController::class,'contract'])->name('contract.index');
Route::post('/contract/created',[ContactController::class,'contract_created'])->name('contract.created');










//gestAuthencation
Route::get('/gest/register',[GestAuthenticationController::class,'register'])->name('gest.register');
Route::post('/gest/register/post',[GestAuthenticationController::class,'register_post'])->name('gest.register.post');
Route::get('/gest/login',[GestAuthenticationController::class,'login'])->name('gest.login');
Route::post('/gest/login/post',[GestAuthenticationController::class,'login_post'])->name('gest.login.post');


//role Request
Route::get('/role/request/',[RequsetModelController::class,'request_show'])->name('request.show');
Route::get('/role/request/accept/{id}',[RequsetModelController::class,'accept'])->name('request.accept');
Route::get('/role/request/cancel/{id}',[RequsetModelController::class,'cancel'])->name('request.cancel');
Route::post('/role/request/{id}',[RequsetModelController::class,'request_send'])->name('request.sent');





//dashboard route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','verified']);




//manegment
Route::prefix('sm/sumon')->middleware(['rolechack'])->group(function() {

    Route::get('/management',[ManagementController::class,'index'])->name('management.index');
    Route::post('/management/user/register',[ManagementController::class,'store_register'])->name('management.store');
    Route::post('/management/user/stasus',[ManagementController::class,'stasus'])->name('management.stasus');

    Route::get('/management/user/edit/{edit}',[ManagementController::class,'edit'])->name('management.edit');
    Route::post('/management/manager/update/{update}',[ManagementController::class,'update'])->name('management.update');
    Route::get('/management/manager/delete/{delete}',[ManagementController::class,'delete'])->name('management.delete');
    Route::post('/management/manager/role/down/{id}',[ManagementController::class,'role_down'])->name('management.role.down');
    Route::post('/management/manager/blogger/change/role/{id}',[ManagementController::class,'blogger_change'])->name('management.blogger.change.role');
    Route::post('/management/manager/user/change/role/{id}',[ManagementController::class,'user_change'])->name('management.user.change.role');


    //connected
    Route::get('/connected',[ConnectedModelController::class,'index'])->name('connected.index');
    Route::post('/connected/createdd',[ConnectedModelController::class,'createdd'])->name('connected.createdd');
    Route::get('/connected/action/{id}',[ConnectedModelController::class,'action'])->name('connected.action');
    Route::get('/connected/edit/{id}',[ConnectedModelController::class,'edit'])->name('connected.edit');
    Route::post('/connected/update/{id}',[ConnectedModelController::class,'update'])->name('connected.update');
    Route::get('/connected/delete/{id}',[ConnectedModelController::class,'delete'])->name('connected.delete');



    //Abouts
    Route::get('/abouts',[AboutsController::class,'index'])->name('dashboard.abouts.index');
    Route::get('/abouts/show',[AboutsController::class,'show'])->name('dashboard.abouts.show');
    Route::post('/abouts/created',[AboutsController::class,'created'])->name('dashboard.abouts.created');
    Route::get('/abouts/action/{id}',[AboutsController::class,'action'])->name('abouts.action');
    Route::get('/abouts/delete/{id}',[AboutsController::class,'delete'])->name('abouts.delete');

    Route::get('/contract',[ContactController::class,'contract'])->name('contract');

});






//profile
Route::get('home/profile',[FrontendController::class,'profile'])->name('home.profile');
Route::post('/home/profile/name/update',[FrontendController::class,'name_update'])->name('home.profile.name.update');
Route::post('/home/profile/email/update',[FrontendController::class,'email_update'])->name('home.profile.email.update');
Route::post('/home/profile/password/update',[FrontendController::class,'passeord_update'])->name('home.profile.password.update');
Route::post('/home/profile/image/update',[FrontendController::class,'image_update'])->name('home.profile.image.update');


//category
Route::prefix('sm/sumon')->middleware(['excess'])->group(function() {

Route::get('category',[CategoryController::class,'index'])->name('category.index');
Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::get('category/delete/{delete}',[CategoryController::class,'delete'])->name('category.delete');
Route::get('category/action/{action}',[CategoryController::class,'action'])->name('category.action');


//Blog
Route::resource('/blog',BlogController::class);
Route::get('blog/avtion/{id}',[BlogController::class,'action'])->name('blog.action');
Route::get('blog/feature/{id}',[BlogController::class,'feature'])->name('blog.feature');

});

//email veryFivation
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
