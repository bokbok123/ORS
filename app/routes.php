<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** Guest */

Route::match(array('GET', 'POST'), 'logout', 'LoginController@logout');

Route::group(array('after' => 'auth.logout'), function()
{

    Route::match(array('GET', 'POST'), 'admin', 'LoginController@adminLogin');

});

Route::group(array('before' => 'auth.login'), function()
{
    Route::group(array('before' => 'auth.admin'), function(){

        Route::get('admin/users', 'AdminMainController@dashboard');

        Route::match(array('GET', 'POST'), 'admin/users/ajax', 'UserAdminController@ajax');

    });

    Route::group(array('before' => 'auth.user'), function(){
        Route::get('user/dashboard', 'UserMainController@dashboard');
    });
});