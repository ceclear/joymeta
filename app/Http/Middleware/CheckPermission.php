<?php

namespace App\Http\Middleware;

use Core\Http\Exceptions\Constants\ServiceExceptionConstants;
use Core\Http\Exceptions\ServiceException;
use Closure;
use Core\Http\Repositories\Eloquent\User\FrontPermission;
use Core\Http\Repositories\Eloquent\User\UserPermission;

class CheckPermission
{

    /**
     * api 签名验证
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiPermission = config("app.api_permission");//是否开启接口全局权限验证
        if ($apiPermission === true) {
            $url               = $request->path();
            $url               = str_replace('api/', '', $url);
            $userId            = $request->userId;
            $frontPermissionId = FrontPermission::where('http_path', $url)->value('id');
            $info              = UserPermission::where('user_id', $userId)->where('permission_id', $frontPermissionId)->where('status', 1)->first();
            if (!$info) {
                throw new ServiceException(ServiceExceptionConstants::getMsg('抱歉,当前操作无权限,请联系相关人员开通-1'));
            }
        }

        return $next($request);
    }


}
