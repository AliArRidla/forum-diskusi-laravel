<?php

use App\Http\Controllers\ForumsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\DiscussionsController;

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

//tambahkan kode berikut
Route::resource('students', StudentController::class);

// buat diskusi

Route::get('/discuss', function () {
    return view('discuss');
});

Route::get('/', [
    // 'uses' => 'ForumsController@index',
    ForumsController::class, 'index'
    // 'as' => 'forum'
])->name('forum');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::post('/discussions/reply/{id}', [
    DiscussionsController::class, 'reply',
    // 'as' => 'discussions.reply'
    // ])->as('discussions.reply');
])->name('discussions.reply');

Route::get('/discussion/{id}', [
    // 'uses' => 'DiscussionsController@show',
    DiscussionsController::class, 'show',
    // 'as' => 'discussion'
])->name('discussion');

Route::get('/channel/{id}', [
    // 'uses' => 'ForumsController@channel',
    ForumsController::class, 'channel',
    // 'as' => 'channel'
])->name('channel');



Route::group(['middleware' => 'auth'], function () {

    Route::resource('channels', ChannelsController::class);
    // Route::resource('photos', PhotoController::class);

    Route::get('/channels/destroy/{id}', [
        ChannelsController::class, 'destroy',
    ])->name('channels.destroy');

    Route::get('/channels/edit/{id}', [
        ChannelsController::class, 'edit',        
    ])->name('channels.edit');

    Route::post('/channels/update/{id}', [
        ChannelsController::class, 'update',                
    ])->name('channels.update');

    Route::get('/discussions/create', [
        ChannelsController::class, 'create',                        
    ])->name('discussions.create');


    Route::post('/discussions/store', [
        DiscussionsController::class,'store',        
    ])->name('discussion.store');

    Route::get('/reply/like/{id}', [
        RepliesController::class, 'like', 
    ])->name('reply.like');

    Route::get('/reply/unlike/{id}', [
        RepliesController::class, 'unlike',
    ])->name('reply.unlike');
});
// Auth::routes();
