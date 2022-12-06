<?php

//默认的
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//版本无关-不用登陆的路由
Route::group(['namespace' => 'Api'], function () {
    #账号体系
    //获取验证码
//    Route::post('/message/verification', 'MessageController@verification');
    //手机+密码 登录
    Route::post('/user/login_pass', 'UserController@loginPass');
    //手机+验证码 登录
//    Route::post('/user/login_code', 'UserController@loginCode');
    //账号+密码 注册
    Route::post('/user/register', 'UserController@register');
    //u3d注册验证
    Route::get('/user/u3d-reg-check', 'UserController@u3dRegisterCheck');
    //第三方帐号登录
//    Route::post('/user/third_login', 'UserController@thirdLogin');
    //绑定手机号
//    Route::post('/user/bind_mobile', 'UserController@bindMobile');
    //手机号一键登录
//    Route::post('/user/mobile_verify_login', 'UserController@mobileVerifyLogin');
    //重置密码
//    Route::post('/user/find_pass', 'UserController@findPass');

//    Route::get('/platform/all_region', 'PlatformController@allRegion');
    //ios
//    Route::get('/platform/all_ios_region', 'PlatformController@allIosRegion');
    //版本更新
//    Route::get('/home/check_update', 'HomeController@checkUpdate');
    //ios配置审核版本
//    Route::get('/home/ios_close', 'HomeController@iosClose');
    //商家端版本推荐
//    Route::get('/article/app_version', 'ArticleController@appVersion');
    //搜索
    Route::get('/captcha/index', 'PlatformController@captchaCreate');//生成图形验证码
    Route::get('/captcha/validate', 'PlatformController@validateCaptcha');//验证图形验证码
//    Route::post('/message/validate', 'MessageController@validateCode');//验证验证码

    Route::group(['prefix' => 'platform'], function ($router) {

    });
});

//登录前后有数据则不同，不强制要求登录
Route::group(['namespace' => 'Api', 'middleware' => ['user']], function () {
    //一些基础配置下发
//    Route::get('/home/init_info', 'HomeController@initInfo');
    //首页
//    Route::get('/home/main', 'HomeController@main');

    Route::get('village/marker', 'VillageController@markerList');//用户村庄列表
    Route::get('village/get-discover', 'VillageController@getDiscover');//村庄图片资料

});

//登录后的路由
Route::group(['namespace' => 'Api', 'middleware' => ['user.auth']], function () {
    //上传
    Route::group(['prefix' => 'upload'], function ($router) {
        //上传到私有
//        $router->post('signUrlPutPri', 'UploadController@signUrlPutPri');
        //上传到公有
//        $router->post('signUrlPut', 'UploadController@signUrlPut');
        //服务器上传
        $router->post('servicePutFile', 'UploadController@servicePutFile');
    });
    Route::group(['prefix' => 'user'], function ($router) {
        //user
        $router->get('main', 'UserCenterController@main')->name('user-main');//个人中心
        $router->post('logout', 'UserController@logout')->name('user-logout');

    });

    //village
    Route::group(['prefix' => 'village'], function ($router) {

        $router->get('index', 'VillageController@baseInfo');//村庄基础信息

    });

    //land
    Route::group(['prefix' => 'land'], function ($router) {
        $router->get('lists', 'LandController@lists');//土地列表
        $router->get('detail', 'LandController@detail');//土地详情
        $router->get('house-resident', 'LandController@houseResident');//人房列表
        $router->get('house-resident-detail', 'LandController@houseResidentDetail');//人房详情
        $router->get('invest', 'LandController@Invest');//投资详情
        $router->get('leave-list', 'LandController@leaveList');//闲置土地列表
    });

    //house
    Route::group(['prefix' => 'house'], function ($router) {
        $router->get('lists', 'HouseController@lists');//房屋列表
        $router->get('detail', 'HouseController@detail');//房屋详情
    });

    //resident
    Route::group(['prefix' => 'resident'], function ($router) {
        $router->get('lists', 'ResidentController@lists');//住户信息
    });

    //breed
    Route::group(['prefix' => 'breed'], function ($router) {
        $router->get('lists', 'BreedController@lists');//养殖列表
        $router->get('detail', 'BreedController@detail');//牲畜列表
        $router->get('b_detail', 'BreedController@littleDetail');//牲畜详情
    });

    //grow
    Route::group(['prefix' => 'grow'], function ($router) {
        $router->get('lists', 'GrowController@lists');//种植地列表
        $router->get('detail', 'GrowController@detail');//种植列表
        $router->get('g_detail', 'GrowController@littleDetail');//种植详情
    });

    //设施
    Route::group(['prefix' => 'facility'], function ($router) {
        $router->get('lists', 'FacilityController@categoryList');//设施分类
        $router->get('fac-lists', 'FacilityController@facilityList');//设施列表
        $router->get('fac-detail', 'FacilityController@facilityDetail');//设施详情
    });

    //经济投资
    Route::group(['prefix' => 'econ'], function ($router) {
        $router->get('lists', 'FacilityController@econList');//经济投资
    });

    //farm
    Route::group(['prefix' => 'farm'], function ($router) {
        $router->post('ant', 'FarmController@approveChain');//上链
        $router->get('query', 'FarmController@queryChain');//查询上链状态
    });

    Route::get('user/user-front', 'UserCenterController@userPermission');//用户权限列表

    Route::post('land/save', 'LandController@save')->middleware('check.permission');//编辑土地
    Route::post('house/save', 'HouseController@save')->middleware('check.permission');//编辑房屋
    Route::post('breed/save', 'BreedController@save')->middleware('check.permission');//编辑养殖
    Route::post('grow/save', 'GrowController@save')->middleware('check.permission');//编辑种植

});

Route::namespace('Api')->prefix('server')->group(function ($router) {
    $router->get('index', 'HuaYangController@index');
//    $router->post('sendGameServer', 'HuaYangController@sendGameServer');
//    $router->post('test', 'HuaYangController@testSign');
});
