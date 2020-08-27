<?php
Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');
});


// Screenshot Config 
Route::get('/screenshots/config', 'ScreenshotConfig@index')->name('screenshots.config.index');
Route::post('/screenshots/config', 'ScreenshotConfig@store')->name('screenshots.config.store');
Route::get('/screenshots/create', 'ScreenshotConfig@create')->name('screenshots.config.create');

Route::get('/screenshots/{id}/pause', 'ScreenshotConfig@pause');
Route::get('/screenshots/{id}/play', 'ScreenshotConfig@play');
Route::get('/screenshots/{id}/delete', 'ScreenshotConfig@delete');

// List of all screenshots
Route::get('/screenshots/errors', 'ScreenshotErrors@index')->name('screenshots.errors.index');

// Screenshot data
Route::get('/screenshots/{id}', 'Screenshots@index');





