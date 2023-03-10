<?php

return [
    /*
     * The scheme information
     * -------------------------------------------------------------------
     *
     * The key-value paris: {name} => {value}
     *
     * Examples:
     * 'Log' => '10 backup'
     * 'SmsBao' => '100'
     * 'CustomAgent' => [
     *     '5 backup',
     *     'agentClass' => '/Namespace/ClassName'
     * ]
     *
     * Supported agents:
     * 'Log', 'YunPian', 'YunTongXun', 'SubMail', 'Luosimao',
     * 'Ucpaas', 'JuHe', 'Alidayu', 'SendCloud', 'SmsBao',
     * 'Qcloud', 'Aliyun'
     *
     */
    'scheme' => [
//        'Log',
        'Aliyun' => '100'
    ],

    /*
     * The configuration
     * -------------------------------------------------------------------
     *
     * Expected the name of agent to be a string.
     *
     */
    'agents' => [
        /*
         * -----------------------------------
         * YunPian
         * 云片代理器
         * -----------------------------------
         * website:http://www.yunpian.com
         * support content sms.
         */
        'YunPian' => [
            //用户唯一标识，必须
            'apikey' => 'your_api_key',
        ],

        /*
         * -----------------------------------
         * YunTongXun
         * 云通讯代理器
         * -----------------------------------
         * website：http://www.yuntongxun.com/
         * support template sms.
         */
        'YunTongXun' => [
            //主帐号
            'accountSid'    => 'your_account_sid',
            //主帐号令牌
            'accountToken'  => 'your_account_token',
            //应用Id
            'appId'         => 'your_app_id',
            //请求地址(不加协议前缀)
            'serverIP'      => 'app.cloopen.com',
            //请求端口
            'serverPort'    => '8883',
            //被叫号显
            'displayNum'    => null,
            //语音验证码播放次数
            'playTimes'     => 3,
        ],

        /*
         * -----------------------------------
         * SubMail
         * -----------------------------------
         * website:http://submail.cn/
         * support template sms.
         */
        'SubMail' => [
            'appid'     => 'your_app_id',
            'signature' => 'your app key',
        ],

        /*
         * -----------------------------------
         * luosimao
         * -----------------------------------
         * website:http://luosimao.com
         * support content sms.
         */
        'Luosimao' => [
            'apikey'        => 'your_api_key',
            'voiceApikey'   => 'your_voice_api_key',
        ],

        /*
         * -----------------------------------
         * ucpaas
         * -----------------------------------
         * website:http://ucpaas.com
         * support template sms.
         */
        'Ucpaas' => [
            //主帐号,对应开官网发者主账号下的 ACCOUNT SID
            'accountSid'    => 'your_account_sid',
            //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
            'accountToken'  => 'your_account_token',
            //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
            //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
            'appId'         => 'your_app_id',
        ],

        /*
         * -----------------------------------
         * JuHe
         * 聚合数据
         * -----------------------------------
         * website:https://www.juhe.cn
         * support template sms.
         */
        'JuHe' => [
            //应用App Key
            'key'   => 'your_key',
            //语音验证码播放次数
            'times' => 3,
        ],

        /*
         * -----------------------------------
         * Alidayu
         * 阿里大鱼代理器
         * -----------------------------------
         * website:http://www.alidayu.com
         * support template sms.
         */
        'Alidayu' => [
            //请求地址
            'sendUrl'           => 'http://gw.api.taobao.com/router/rest',
            //淘宝开放平台中，对应阿里大鱼短信应用的App Key
            'appKey'            => 'your_app_key',
            //淘宝开放平台中，对应阿里大鱼短信应用的App Secret
            'secretKey'         => 'your_secret_key',
            //短信签名，传入的短信签名必须是在阿里大鱼“管理中心-短信签名管理”中的可用签名
            'smsFreeSignName'   => 'your_sms_free_sign_name',
            //被叫号显(用于语音通知)，传入的显示号码必须是阿里大鱼“管理中心-号码管理”中申请或购买的号码
            'calledShowNum'     => null,
        ],

        /*
         * -----------------------------------
         * SendCloud
         * -----------------------------------
         * website: http://sendcloud.sohu.com/sms/
         * support template sms.
         */
        'SendCloud' => [
            'smsUser'   => 'your_SMS_USER',
            'smsKey'    => 'your_SMS_KEY',
        ],

        /*
         * -----------------------------------
         * SmsBao
         * -----------------------------------
         * website: http://www.smsbao.com
         * support content sms.
         */
        'SmsBao' => [
            //注册账号
            'username'  => 'your_username',
            //账号密码（明文）
            'password'  => 'your_password',
        ],

        /*
         * -----------------------------------
         * Qcloud
         * 腾讯云
         * -----------------------------------
         * website:http://www.qcloud.com
         * support template sms.
         */
        'Qcloud' => [
            'appId'     => 'your_app_id',
            'appKey'    => 'your_app_key',
        ],

        /*
         * -----------------------------------
         * Aliyun
         * 阿里云
         * -----------------------------------
         * website:https://www.aliyun.com/product/sms
         * support template sms.
         */
        'Aliyun' => [
            'accessKeyId'       => env('ALI_SMS_KEY'),
            'accessKeySecret'   => env('ALI_SMS_SECRET_KEY'),
            'signName' => [
                1 =>  env('ALI_SMS_SIGN_NAME_CLIENT1', '名车联'),
                2 =>  env('ALI_SMS_SIGN_NAME_CLIENT2', '名车联商家'),
            ],
            'regionId'          => 'cn-shenzhen',
            'sms_id'            => [
                1 => env('ALI_SMS_SMS_ID_REG'),//注册
                2 => env('ALI_SMS_SMS_ID_LOGIN'),//登录
                3 => env('ALI_SMS_SMS_ID_PASS'),//找回密码
                4 => env('ALI_SMS_SMS_ID_VERIFY'),//身份验证
                5 => env('ALI_SMS_SMS_ID_INFO'),//信息变更
            ],
        ],
    ],
];
