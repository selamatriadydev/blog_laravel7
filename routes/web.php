<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerPost;
use App\Http\Controllers\ControllerBlog;
use App\Http\Controllers\ControllerBanner;
use App\Http\Controllers\ControllerGroup;
use App\Http\Controllers\ControllerMenus;
use App\Http\Controllers\ControllerSkill;
use App\Http\Controllers\ControllerSkillDetail;
use App\Http\Controllers\ControllerProject;
use App\Http\Controllers\ControllerProjectCategory;

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
// Route::get('/register', function () {
//     return view('admin.auth.register');
// });

Route::get('/', [ControllerBlog::class, 'index']);
Route::get('/blog', [ControllerBlog::class, 'blog']);
Route::get('/about', [ControllerBlog::class, 'about']);
Route::get('/blog/{slug}', [ControllerBlog::class, 'view_by_slug']);
Route::get('/blog/category/{category}', [ControllerBlog::class, 'view_by_category']);
Route::get('/blog/tag/{tag}', [ControllerBlog::class, 'view_by_tag']);
Route::get('/blog/year/{year}', [ControllerBlog::class, 'view_by_tahun']);
Route::post('/blog/{post}/comment', [ControllerBlog::class, 'comment'])->middleware('auth');
Route::post('/blog/{post}/comments', [ControllerBlog::class, 'comment_user_biasa']);

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/posts', 'ControllerPost');
    Route::put('/posts/{post}/publish', [ControllerPost::class, 'publish']);
    Route::resource('/categories', 'ControllerCategory', ['except' => ['show']]);
    Route::resource('/tags', 'ControllerTag', ['except' => ['show']]);
    Route::resource('/comments', 'ControllerComment', ['only' => ['index', 'destroy']]);
    Route::resource('/users', 'UserController', ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
    
    Route::resource('/menus', 'ControllerMenus')->except(['show']);
    Route::get('/menus/parent', [ControllerMenus::class, 'parrent']);

    Route::resource('/banner', 'ControllerBanner')->except(['show']);
    Route::put('/banner/{banner}/publish', [ControllerBanner::class, 'publish']);

    Route::resource('/skill', 'ControllerSkill');
    Route::put('/skill/{skill}/publish', [ControllerSkill::class, 'publish']);

    Route::resource('/sub_skill', 'ControllerSkillDetail')->except(['show']);
    Route::put('/sub_skill/{skilldetail}/publish', [ControllerSkillDetail::class, 'publish']);

    Route::resource('/project', 'ControllerProject')->except(['show']);
    Route::put('/project/{project}/publish', [ControllerProject::class, 'publish']);

    Route::resource('/category_project', 'ControllerProjectCategory')->except(['show']);
    Route::put('/category_project/{projectcategory}/publish', [ControllerProjectCategory::class, 'publish']);

    Route::resource('/group', 'ControllerGroup')->except(['show']);
    Route::put('/group/{group}/publish', [ControllerGroup::class, 'publish']);

    Route::resource('/uzer', 'ControllerUzer')->except(['show']);
});
