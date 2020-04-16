<?php

use \TCG\Voyager\Models\Page;

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


Route::get('/', "HomeController@index")->name('home');

Route::get('/blogs', "BlogController@list")->name('blogList');

Route::get('/blog/{slug}', "BlogController@index")->name('blog');

Route::get('/quote', "ResumeController@index")->name('quote');

Route::post('/quote', "ResumeController@store");


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/resumes/{id}/reviews', "RatingController@index");
    Route::post('/resumes/{id}/reviews', "RatingController@store");
});


Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";
 
});

Route::get('/storage', function() {
    
    Artisan::call('storage:link');

    return 'Storage linked done!';
});

Route::get('{slug}', function($slug) {
    $page = Page::where('slug','=',$slug)->first();
    if(isset($page)) {
        return view('blog')->with([
            'pageTitle' => $page->title,
            'post' => $page
        ]);
    }
    else {
        return view('errors.404');
    }
});