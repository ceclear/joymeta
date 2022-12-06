<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 2016/10/11
 * Time: 10:39
 */

return [
    #公有bucket
    'public' => [
        'access_key' => env('OSS_ACCESS_KEY'),
        'secret_key' => env('OSS_SECRET_KEY'),
        'endpoint'   => env('OSS_ENDPOINT'),
        'endpoint_internal'   => env('OSS_ENDPOINT_INTERNAL'),
        'bucket'     => env('OSS_BUCKET'),
        'isCName'    => env('OSS_IS_CNAME', false), // 如果 isCname 为 false，endpoint 应配置 oss 提供的域名如：`oss-cn-beijing.aliyuncs.com`，否则为自定义域名，，cname 或 cdn 请自行到阿里 oss 后台配置并绑定 bucket
        //orm补全路径用
        'url'        => env('OSS_DOMAIN_URL'),
    ],
    #私有bucket
    'private' => [
        'access_key' => env('OSS_ACCESS_KEY'),
        'secret_key' => env('OSS_SECRET_KEY'),
        'endpoint'   => env('OSS_ENDPOINT'),
        'endpoint_internal'   => env('OSS_ENDPOINT_INTERNAL'),
        'bucket'     => env('OSS_BUCKET_PRI'),
        'isCName'    => env('OSS_IS_CNAME_PRI', false), // 如果 isCname 为 false，endpoint 应配置 oss 提供的域名如：`oss-cn-beijing.aliyuncs.com`，否则为自定义域名，，cname 或 cdn 请自行到阿里 oss 后台配置并绑定 bucket
        //orm补全路径用
        'url'        => env('OSS_DOMAIN_URL_PRI'),
    ],
    //bucket名称反向关联配置类型
    'bucket_to_type' => [
        env('OSS_BUCKET') => 'public',
        env('OSS_BUCKET_PRI') => 'private',
    ],
];