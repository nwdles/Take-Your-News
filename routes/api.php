<?php

use Illuminate\Http\Request;

Route::get('categories/{id}', 'PublicationController@categoryById');
Route::get('categories/{cat_id}/{publ_id}', 'PublicationController@fullPublication');
Route::get('categories', 'CategoryController@categories');

Route::get('favorites', 'PublicationController@favoritesByUser');
Route::post('login', 'ProfileController@getUserInfo');

//Route::get('image', 'CategoryController@getImage');
