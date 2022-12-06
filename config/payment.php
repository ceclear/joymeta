<?php
/**
 * 支付相关配置
 */
return [
    'alipay_config' => [
        'APP_ID' => env('ALIPAY_APP_ID'), //	APPID即创建应用后生成
        //开发者应用私钥(私钥去头去尾去回车，一行字符串)，由开发者自己生成
        'APP_PRIVATE_KEY' => env('ALIPAY_APP_PRIVATE_KEY'),
        //支付宝公钥，由支付宝生成（特别注意 非应用的公钥） 不需要了 直接从公钥证书读
//        'ALIPAY_PUBLIC_KEY' => env('ALIPAY_PUBLIC_KEY'),
        //应用证书路径
        'APP_CERT_PUBLIC_KEY' => dirname(base_path()) . '/car_core/Util/AlipaySdk/cert/appCertPublicKey_2021002170671605.crt',
        //支付宝公钥证书路径
        'ALIPAY_CERT_PUBLIC_KEY' => dirname(base_path()) . '/car_core/Util/AlipaySdk/cert/alipayCertPublicKey_RSA2.crt',
        //支付宝根证书路径
        'ALIPAY_ROOT_KEY' => dirname(base_path()) . '/car_core/Util/AlipaySdk/cert/alipayRootCert.crt',
        //回调地址
        'NOTIFY_URL' => env('APP_URL_ONLINE') . '/recharge/notify/alipay',
    ],
    'alipay_info' => [
        //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
        'seller_email' => env('ALIPAY_SELLER_EMAIL'),
        'seller_id' => env('ALIPAY_SELLER_ID'),
    ],

    'weixinpay_config' => [
        'MCHID' => env('WEIXIN_PAY_MCHID'), // 微信支付MCHID 商户收款账号
        'KEY' => env('WEIXIN_PAY_KEY'), // 微信支付KEY

        // APP
        'APPID_APP' => env('WX_AUTH_APPID'), // 微信支付 app的APPID
        'APPSECRET_APP' => env('WX_AUTH_APPSECRET'), //微信支付 app的appsecert

        //暂时未使用
//        'APPID' => '', // 微信支付 公众号APPID
//        'APPSECRET' => '', //公众帐号secert
//
//        'APPID_LET' => '',//微信小程序 APPID
//        'APPSECRET_LET' => '', //微信小程序secert
//        //微信小程序登录url配置
//        'LOGIN_URL' => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
        //回调地址
        'NOTIFY_URL' => env('APP_URL_ONLINE') . '/recharge/notify/weixin',
    ],
];
