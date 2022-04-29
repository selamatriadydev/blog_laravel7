<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProjectCategoryController;
use App\Http\Controllers\API\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');

Route::group(['prefix'=>'v1'], function(){
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);

    Route::get('/banner', [BannerController::class, 'index']);

    Route::get('/skill', [SkillController::class, 'index']);
    Route::get('/project', [ProjectController::class, 'index']);
    Route::get('/project_category', [ProjectCategoryController::class, 'index']);
    //BLOG
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/{slug}', [BlogController::class, 'view_by_slug']); 
    Route::get('/blog/tag/{tag}', [BlogController::class, 'view_by_tag']); 
    Route::get('/blog/year/{years}', [BlogController::class, 'view_by_tahun']); 
    Route::get('/blog/category/{category}', [BlogController::class, 'view_by_category']); 
    Route::get('/blog/comments/{post}', [BlogController::class, 'list_comment']);
    Route::post('/blog/{post}/comments', [BlogController::class, 'comment_user_biasa']); 

    Route::post('/blog', [BlogController::class, 'comment']);
    Route::get('/portofolio', [BlogController::class, 'portofolio']);

});
//API route for register new user
Route::post('/register', [App\Http\Controllers\API\LoginController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\LoginController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\LoginController::class, 'logout']);
    Route::post('/token', [App\Http\Controllers\API\LoginController::class, 'token']);
});
// Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
//     Route::get('/tags', 'ListingController@tags');
//     Route::get('/categories', 'ListingController@categories');
//     Route::get('/users', 'ListingController@users')->middleware('admin');

//     Route::resource('/posts', 'PostController', ['only' => ['index', 'show']]);
// });