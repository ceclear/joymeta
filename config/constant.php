<?php
/**
 *
 * Created by PhpStorm.
 * User: eric
 * Date: 2016/10/11
 * Time: 10:39
 */

return [
    'ad_state'      => [
        0 => '未启用',
        1 => '正在使用',
        2 => '已下线',
    ],
    'status'        => [
        0 => '可用',
        1 => '不可用',
    ],
    'status_switch' => [
        'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
    ],
    'user_state'    => [
        0 => '无效',
        1 => '有效',
    ],
    'paid_state'    => [
        0 => '待付款',
        1 => '已付款',
    ],
    'sex'           => [
        0 => '保密',
        1 => '男',
        2 => '女'
    ],
    'marry_status'  => [
        0 => '保密',
        1 => '未婚',
        2 => '已婚'
    ],
    'reg_type'      => [
        1 => '手机号',
        2 => '第三方账号',
        3 => '设备id',
    ],
    'trade_type'    => '在线充值',
    'payment'       => [
        ['name' => '支付宝', 'code' => 'alipay'],
        ['name' => '微信支付', 'code' => 'wx'],
    ],
    'trade'         => [
        'pay_type'   => ['wechat' => '微信支付', 'alipay' => '支付宝', 'apple' => '苹果内购'],
        'trade_type' => ['recharge' => '充值'],
    ],
    'platform_name' => [0 => '全部', 1 => 'ios', 2 => '安卓'],
    'platform_val'  => [0 => ['ios', 'android'], 1 => ['ios'], 2 => ['android']],
    'platform_kv'   => ['ios' => 'IOS', 'android' => '安卓'],
    'ad_plate_type' => [
        0 => '外链',
        1 => 'sdk广告'
    ],

    //add by eric 20190423
    'AppScope'      => env('AppScope'),

    'app_url_online' => env('APP_URL_ONLINE'),

    'system_set_type'   => [
        'basic'          => '基本设置',
        'android_client' => '安卓客户端',
        'ios_client'     => 'IOS客户端',
        'words_str'      => '词组配置'
    ],

    //安卓包渠道
    'channel_types'     => [
        'default'     => '官方',
        'yingyongbao' => '应用宝',
        'huawei'      => '华为',
        'xiaomi'      => '小米',
        'oppo'        => 'oppo',
        'vivo'        => 'vivo',
        '360'         => '360',
        'meizu'       => '魅族',
        'sanxing'     => '三星'
    ],

    //安卓包地址
    'channel_type_urls' => [
        'default'     => 'http://www.baidu.com',
        'yingyongbao' => 'http://www.baidu.com',
        'huawei'      => 'http://www.baidu.com',
        'xiaomi'      => 'http://www.baidu.com',
        'oppo'        => 'http://www.baidu.com',
        'vivo'        => 'http://www.baidu.com',
        '360'         => 'http://www.baidu.com',
        'meizu'       => 'http://www.baidu.com',
    ],

    //苹果应用市场包地址
    'apple_app_url'     => 'http://www.baidu.com',

    //更新类型
    'app_upgrade_type'  => [
        1 => '小红点提醒',
        2 => '弹窗提醒非强制',
        3 => '弹窗且强制',
    ],

    'region_level' => [
        1 => '省级',
        2 => '市级',
        3 => '区县',
        4 => '镇级',
    ],

    'trade_type_val'           => [
        'support'            => '赞助订单',
        'supply'             => '供需订单',
        'goods_order'        => '电商商品订单',
        'gas_order'          => '油票商品订单',
        'member_order'       => '开通会员订单',
        'car_club'           => '车友会订单',
        'car_activity_order' => '活动订单',
        'food_order'         => '餐饮类虚拟订单',
        'room_order'         => '酒店名宿类虚拟订单',
        'other_order'        => '其他类订单'
    ],
    'trade_pay_type'           => [
        'weixin_app'      => '微信支付',
        'alipay_app'      => '支付宝',
        'newalipayMobile' => '支付宝',
        'weixin_h5'       => '微信支付h5',
        'weixin_jsapi'    => '微信支付jsapi',
        'alipay_h5'       => '支付宝h5',
    ],

    /*快递参数配置*/
    'exception_config'         => [
        'kd100_customer' => env('KD100_CUSTOMER', false),
        'kd100_key'      => env('KD100_KEY', false),
    ],

    #默认 授权登录
    'allowed_third_source'     => ['wx', 'alipay', 'apple', 'qq'],
    'third_source_to_name'     => [
        'wx'     => '微信',
        'alipay' => '支付宝',
        'apple'  => '苹果',
        'qq'     => 'QQ',
    ],
    'wx_auth_id_secret'        => [
        'app_id'     => env('WX_AUTH_APPID'),
        'app_secret' => env('WX_AUTH_APPSECRET'),
    ],
    'alipay_auth_id_secret'    => [
        'app_id'     => env('ALIPAY_AUTH_APPID'),
        'app_secret' => env('ALIPAY_AUTH_APPSECRET'),
    ],
    'apple_auth_client_id'     => env('APPLE_AUTH_CLIENTID'),
    'apple_auth_client_secret' => env('APPLE_AUTH_CLIENTSECRET'),

    //是否支付测试
    'is_pay_test'              => env('PAY_TEST', false),

    //极光推送
    'jp_app_key'               => env('JP_AppKey'),
    'jp_master_secret'         => env('JP_MasterSecret'),
    'jp_log'                   => storage_path('logs/jgPush.log'),
    'jp_extra_type'            => [
        'goods_order' => 1,//商品订单
    ],

    //阿里号码认证
    'ali_mobile_verify_token'  => env('ALI_MOBILE_VERIFY_KEY'),
    'ali_mobile_verify_secret' => env('ALI_MOBILE_VERIFY_SECRET_KEY'),

    //蚂蚁联盟链
    'ant_access_id'            => env('ANT_ACCESS_ID', ''),
    'ant_access_key'           => env('ANT_ACCESS_KEY', ''),
    'ant_dev_access_id'        => env('ANT_DEV_ACCESS_ID', ''),
    'ant_dev_access_key'       => env('ANT_DEV_ACCESS_KEY', '')
];
