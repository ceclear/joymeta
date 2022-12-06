<?php
/**
 * 首页相关
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;

use Core\Http\Repositories\Services\Platform\HomeService;
use Core\Http\Repositories\Services\User\UserService;
use Core\Http\Requests\UserContext;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends BaseController
{

    protected $userService;
    protected $homeService;

    public function __construct(UserService $userService,  HomeService $homeService)
    {
        $this->userService = $userService;
        $this->homeService = $homeService;
    }

    /**
     * 打开app, 一些基础配置或数据的下发 检测版本更新
     * @param Request $request
     * @param UserContext $userContext
     * @return JsonResponse
     */
    public function initInfo(Request $request, UserContext $userContext)
    {
        $data = $this->homeService->initInfo($request, $userContext);

        return $this->responseJson(0, '', $data);
    }

    /**
     * 首页
     * @param Request $request
     * @param UserContext $userContext
     * @return JsonResponse
     */
    public function main(Request $request, UserContext $userContext)
    {
        $data = $this->homeService->main($request, $userContext);
        return $this->responseJson(0, '', $data);
    }

    /**
     * 检查更新
     * @param Request $request
     * @return JsonResponse
     */
    public function checkUpdate(Request $request)
    {
        $data = $this->homeService->checkUpdate($request, 1);

        return $this->responseJson(0, '', $data);
    }


}
