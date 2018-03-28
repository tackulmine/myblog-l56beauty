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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// // Authentication Routes...
// $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
// $this->post('login', 'Auth\LoginController@login');
// $this->post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('/home', 'HomeController@index')->name('home');

// Blog pages
Route::get('/', function () {
    return redirect('/blog');
});

Route::get('blog', 'BlogController@index')->name('blogs');
Route::get('blog/{slug}', 'BlogController@showPost')->name('blog.detail');


// Admin area
Route::get('admin', function () {
  return redirect('/admin/post');
});
Route::group([
    'namespace' => 'Admin',
    'middleware' => 'auth',
    'as' => 'admin.',
    'prefix' => 'admin',
], function () {
    Route::resource('post', 'PostController', ['except' => 'show']);
    Route::resource('tag', 'TagController', ['except' => 'show']);
    Route::get('upload', 'UploadController@index');

    Route::group([
        'prefix' => 'upload',
    ], function () {
        Route::post('file', 'UploadController@uploadFile');
        Route::delete('file', 'UploadController@deleteFile');
        Route::post('folder', 'UploadController@createFolder');
        Route::delete('folder', 'UploadController@deleteFolder');
    });
});

// Logging in and out
Route::group([
    'namespace' => 'Auth',
    'prefix' => 'auth',
], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');

Route::get('rss', 'BlogController@rss');
Route::get('sitemap.xml', 'BlogController@siteMap');