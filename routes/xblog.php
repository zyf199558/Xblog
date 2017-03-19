<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/19
 * Time: 13:38
 */

Route::get('/', 'XblogController@index')->name('index');
Route::get('/blog/{slug}', 'XblogController@post')->name('post.show');
Route::get('/tags', 'XblogController@tags')->name('tags');
Route::get('/achieves', 'XblogController@achieves')->name('achieves');
Route::get('/tag/{name}', 'XblogController@postByTag')->name('tag.posts');
Route::get('/{name}', 'XblogController@page')->name('page.show');