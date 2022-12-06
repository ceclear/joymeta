<?php
/**
 * 极光推送
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;

use Core\Http\Repositories\Services\Platform\JPushService;
use Core\Http\Requests\JPushDTO;
use Core\Http\Requests\UserContext;
use Core\Util\ResultsVo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class JPushController extends BaseController
{

    protected $jPushService;

    public function __construct(JPushService $jPushService)
    {
        $this->jPushService = $jPushService;
    }

    /**
     * 用户登录后完成设备与用户的绑定
     * @param JPushDTO $jgDTO
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindUser(JPushDTO $jgDTO, UserContext $userContext)
    {
        $data = $this->jPushService->bindUser($jgDTO, $userContext);

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     * 测试推送接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function aliasPush(Request $request)
    {
        $data = $this->jPushService->aliasPush();

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }
}
