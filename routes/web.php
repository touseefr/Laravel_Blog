<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Models\User;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BackendController;
use App\Models\Role;
use App\Http\Controllers\TestController;


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
//test releationshiip
Route::get('/userrole', function () {
    $user = User::find(1);
    dd($user->roles);
});
Route::get('/buser', function () {
    $blog = Blog::find(1);
    dd($blog->user);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//backend
Route::group(['middleware' => 'auth'], function () {

    //backedn user dashboard
    Route::get('/user/dash', [BackendController::class, 'userdash']);
    Route::get('/user/createblog', [BackendController::class, 'createblog']);
    Route::post('/user/create', [BlogController::class, 'create']);
    Route::get('/user/await',[BlogController::class,'userawait']);
    Route::get('/user/approved',[BlogController::class,'userapproved']);
    Route::post('/user/getuserawatingblog',[BlogController::class,'getuserawatingblog']);
    Route::post('/user/getuserapprovedblog',[BlogController::class,'getuserapprovedblog']);
    Route::get('/user/editblog/{id}', [BlogController::class, 'editblogviewuser']);
    Route::post('/user/blogupdate', [BlogController::class, 'blogupdate']);
    Route::get('/user/delblog/{id}', [BlogController::class, 'delblog']);

    Route::group(['middleware' => 'checkrole'], function () {

    Route::get('/dashb',[BackendController::class,'dashb']);
    //category crud
    Route::get('/cat', [CategoryController::class, 'index']);
    Route::post('/addcat', [CategoryController::class, 'create']);
    Route::get('/getallcat', [CategoryController::class, 'getallcat']);
    Route::get('/getcat/{id}', [CategoryController::class, 'getcat']);
    Route::post('/updatecat', [CategoryController::class, 'updatecat']);
    Route::get('/delcat/{id}', [CategoryController::class, 'delcat']);
    //tags crud
    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/addtag', [TagController::class, 'create']);
    Route::post('/getalltag', [TagController::class, 'getalltag']);
    Route::get('/gettag/{id}', [TagController::class, 'gettag']);
    Route::post('/updatetag', [TagController::class, 'updatetag']);
    Route::get('/deltag/{id}', [TagController::class, 'deltag']);
    //blogs crud
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/createblog', [BlogController::class, 'createblog']);
    Route::post('/blogcreate', [BlogController::class, 'create']);
    Route::post('/getallblog', [BlogController::class, 'getallblog']);
    Route::get('/editblog/{id}', [BlogController::class, 'editblog']);
    Route::post('/blogupdate', [BlogController::class, 'blogupdate']);
    Route::get('/delblog/{id}', [BlogController::class, 'delblog']);
    //awaiting approval admin
    Route::get('/await',[BlogController::class,'await']);
    Route::post('/getawait',[BlogController::class,'getawait']);
    Route::get('/approveblog/{id}',[BlogController::class,'approveblog']);
});
});

//frontend
Route::get('/', [FrontController::class, 'index']);
Route::get('/blogd/{url}', [FrontController::class, 'blogd']);

Route::get('/about', function () {
    return view('frontend.about');
});
Route::get('/contact', function () {
    return view('frontend.contact');
});

//query builder testing route 
Route::get('/test',[TestController::class,'test']);