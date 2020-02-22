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


Route::get('dashboard', 'DashboardController@index');
Route::get('create-category', 'CategoryController@create');
Route::post('post-category-form', 'CategoryController@store');
Route::get('all-categories', 'CategoryController@index');
Route::get('edit-category/{id}', 'CategoryController@edit'); //to show value in form when form is clicked it is redirect to update-category
Route::post('update-category/{id}', 'CategoryController@update');
Route::get('delete-category/{id}', 'CategoryController@destroy');

//blog routes
Route::get('get-blog-post-form', 'BlogPostController@create'); //create a blog post
Route::post('store-blog-post', 'BlogPostController@store');    //store a blog post
Route::get('all-blog-posts', 'BlogPostController@index');      //show all blog posts
Route::get('edit-blog-post/{id}', 'BlogPostController@edit');  //edit blog post by id show in form
Route::post('update-blog-post/{id}', 'BlogPostController@update'); //update with post method
Route::get('delete-blog-post/{id}', 'BlogPostController@destroy'); //delete a blog post 


