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

Route::get('/rooms', 'RoomController@index')->name('room');
Route::delete('roomdel/{id}', 'RoomController@delete')->name('roomdel');
Route::post('roomstore', 'RoomController@store')->name('room.store');
Route::put('{id}/roomupdate', 'RoomController@update')->name('roomupdate');

Route::delete('userdel/{id}', 'UserController@delete')->name('userdel');
Route::post('userstore', 'UserController@store')->name('user.store');
Route::post('{id}/userupdate', 'UserController@update')->name('userupdate');
Route::get('/users', 'UserController@index')->name('user');
Route::post('/chunk', 'UserController@chunk')->name('chunk');

Route::get('/bookings', 'BookingController@index')->name('booking');
Route::post('bookingstore', 'BookingController@store')->name('booking.store');
Route::put('{id}/bookingupdate', 'BookingController@update')->name('bookingupdate');
Route::delete('bookingdelete/{id}', 'BookingController@delete')->name('bookingdelete');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::get('/arraysinstance', 'ArrayController@arraytest');
Route::get('/arraycollection', 'ArrayController@arraycollection');
Route::get('/contructtest', 'ArrayController@testeconstru');
Route::get('/collectiontest', 'ArrayController@collectiontest');

Route::get('/arraysdelete', 'ArrayController@arraydelete');
Route::get('/arraysmulti', 'ArrayController@arraymultidimensional');
Route::get('/arrayscombo', 'ArrayController@arraycombo');
Route::get('/arraysget', 'ArrayController@getarray');
Route::get('/arraytest', 'RoomController@test');
