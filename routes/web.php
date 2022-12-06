<?php

// 默认的
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'MapController@home');
Route::get('map', 'MapController@index')->name('u3d-map');
Route::get('/show', 'U3dController@showHtml');
//Route::post('save-u3d', 'U3dController@saveData');
Route::get('register', 'MapController@register')->name('u3d-register');
Route::get('login', 'MapController@login')->name('u3d-login');
Route::get('ability', 'U3dController@abilityIndex')->name('u3d-ability');
Route::get('tc', 'MapController@pointShow')->name('u3d-tc');
//文章详情
Route::get('/article/show', 'Api\ArticleController@show');
Route::get('/article/detail', 'Api\ArticleController@detail');

Route::get('/test', 'TestController@test');
Route::get('/getIpCheck', 'TestController@getIpCheck');

//签名
//Route::any('/api/sign','Api\SignController@post');

Route::get('/abtest', 'TestController@abtest');

Route::get('/testSign', 'TestController@testSign');

//支付回调类
Route::post('/recharge/notify/weixin', 'Api\TradeNotifyController@weixinNotify');
Route::post('/recharge/notify/alipay', 'Api\TradeNotifyController@alipayNotify');
Route::post('/recharge/notify/allinpay', 'Api\TradeNotifyController@allinpayNotify');

//苹果登录回调地址
Route::any('/user/callback/apple_login', 'Api\UserController@appleLoginCallback');

//上传回调
Route::post('/oss/callback/put', 'Api\UploadController@ossPutObjCallback');

Route::any('/api/uploadTest', 'Api\UploadController@test');

//Route::get('/aliasPush', 'Api\JpushController@aliasPush');


