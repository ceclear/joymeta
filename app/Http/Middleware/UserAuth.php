<?php

namespace App\Http\Middleware;

use Core\Http\Exceptions\ServiceException;
use Core\Http\Exceptions\Constants\CommonExceptionConstants;
use Core\Http\Repositories\Redis\UserLoginRedis;
use Core\Http\Repositories\Services\User\UserService;
use Closure;
use Illuminate\Support\Facades\Log;

class UserAuth
{
    protected $except = [
        '/api/wechat/oauth',
    ];

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('X-Header-Token');
        $token = $token ? $token : $request->get('token');//网页的时候带这个参数
        if ($token && $token != 'null') {
            if (substr_count($token, '.') == 2) {
                list($header, $payload, $sign) = explode('.', $token);
                $headerJson = json_decode(base64_decode($header));
                if (is_object($headerJson)) {
                    if (property_exists($headerJson, 'alg')) {
                        $hashStr = $header . '.' . $payload . '.' . config('app.key');
                        $jwtSign = hash($headerJson->alg, $hashStr);
                        if ($jwtSign == $sign) {
                            $payloadJson = json_decode(base64_decode($payload));
                            if ($payloadJson->uid) {
                                //检查授权时间是否过期
                                if ($payloadJson->exp > time()) {
                                    $userId = $payloadJson->uid;
                                    //20190909加 验证token唯一性 验证此token是否最近登录token（保证同账号一个设备在线）
                                    $checkRes = UserLoginRedis::getRedisInstance()->checkLoginToken($userId, $token,2);
                                    if($checkRes == false) {
                                        throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
                                    }
                                    //注入用户
                                    $request->userId = $userId;
                                } else {
                                    //过期
                                    Log::info('need_login：原因：授权过期，payload-' . json_encode($payload) . '，token-'.$token.'，url-' . $request->url());
                                    throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
                                }
                            } else {
                                //uid 参数无效
                                Log::info('need_login：原因：uid无效，payload-' . json_encode($payload) . '，token-'.$token .'，url-' . $request->url());
                                throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
                            }
                        } else {
                            Log::info('need_login：登录token签名验证失败，hash_str：' . $hashStr . '，sign：' . $sign . '，jwt_sign：' . $jwtSign . '，url-' . $request->url());
                            throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
                        }
                    } else {
                        Log::info('need_login：原因：header_json不含alg，header_json-' . json_encode($headerJson) . '，token-'.$token . '，url-' . $request->url());
                        throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
                    }
                } else {
                    Log::info('need_login：原因：header_json解析失败，header-' . $header . '，token-'.$token . '，url-' . $request->url());
                    throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
                }
            } else {
                Log::info('need_login：原因：token不含. ，token-' . $token . '，url-' . $request->url());
                throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
            }
        } else {
//            $ip = ['127.0.0.1'];
//            if (in_array($request->getClientIp(), $ip)) {
//                $request->userId = 100001;
//            } else {
//                Log::info('need_login：原因：无token，url-' . $request->url());
//                throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
//            }
            Log::info('need_login：原因：无token，url-' . $request->url());
            throw new ServiceException(CommonExceptionConstants::getKey('no_login'));
        }

        //注入token等信息
        $mid_params['header_token'] = $token;

        $request->attributes->add($mid_params);//添加参数

        return $next($request);

        /**
         * // 从session中获取数据...
         * $openId = session('User.openId');
         * if (empty($openId) && $request->get('code')) {
         * $goUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.getenv('AppID').'&secret='.getenv('AppSecret').'&code='.$request->get('code').'&grant_type=authorization_code';
         * $result = file_get_contents($goUrl);
         * $data = json_decode($result);
         * $openId = $data->openid;
         * if ($openId) {
         * //以下注释,请勿删除
         * //观察者模式,事件监听
         * //event((new GetWeChatOpenId($openId)));
         * //暂停使用队列,此处完成登录注册功能
         * //dispatch(new CheckWeChatOpenId($openId));
         * //Make 方式注入对象
         * //$user = App::make('Core\Http\Repositories\Services\User\UserService')->saveUserByOpenId($openId);
         * $ormUser = $this->userService->saveUserByOpenId($openId);
         * $user = [];
         * $user['id'] = $ormUser->id;
         * $user['openId'] = $ormUser->open_id;
         * $user['name'] = $ormUser->name;
         * $user['avatar'] = $ormUser->avatar;
         * $request->session()->put('User', $user);
         * }
         * //此处还是需要做跳转,不然会带着微信返回过来的code参数 AppScope
         * Header('Location:'.urldecode($request->get('state')));
         * }
         *
         * if (!$openId && !$request->get('code')) {
         * $returnUrl = getenv('APP_URL').$request->getRequestUri();
         * $jumpUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.getenv('AppID').'&redirect_uri='.urlencode($returnUrl).'&response_type=code&scope='.getenv('AppScope').'&state='.urlencode($returnUrl).'#wechat_redirect';
         * Header('Location:'.$jumpUrl);
         * Exit;
         * }
         */
    }


}
