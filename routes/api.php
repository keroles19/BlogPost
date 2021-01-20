<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function () {
    Route::apiResources([
            'post' => 'PostController',
            'category' => 'CategoryController'
        ]
    );

    Route::get('category/{slug}/posts', 'CategoryController@postsCategory');
    Route::get('search/{query}', 'PostController@search');

    Route::get('add_comment','CommentController@store')->name('addComment');

});

Route::group(['namespace' => 'Api\Auth'], function () {

    require_once __DIR__ . '/Api/auth.php';


});

