<?php

namespace App\Http\Middleware;

use Core\Http\Repositories\Services\User\UserService;
use Closure;

class User
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
        $request->userId = 0;
        $token = $request->header('X-Header-Token');
        $token = $token ? $token : $request->get('token');//网页的时候带这个参数

        if ($token && $token != 'null') {
            if (substr_count($token, '.') == 2) {
                list($header, $payload, $sign) = explode('.', $token);
                $headerJson = json_decode(base64_decode($header));
                if (is_object($headerJson)) {
                    if (property_exists($headerJson, 'alg')) {
                        $jwtSign = hash($headerJson->alg, $header . '.' . $payload . '.' . config('app.key'));
                        if ($jwtSign == $sign) {
                            $payloadJson = json_decode(base64_decode($payload));
                            if ($payloadJson->uid) {
                                //检查授权时间是否过期
                                if ($payloadJson->exp > time()) {
                                    //注入用户
                                    $request->userId = $payloadJson->uid;
                                }
                            }
                        }
                    }
                }
            }
        }
        //注入token等信息
        $mid_params['header_token'] = $token;

        $request->attributes->add($mid_params);//添加参数

        return $next($request);

    }


}
