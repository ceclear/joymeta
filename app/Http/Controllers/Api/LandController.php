<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Land\LandService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class LandController extends BaseController
{
    private $landService;

    public function __construct(LandService $landService)
    {

        $this->landService = $landService;
    }

    /**
     * 土地列表
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(UserContext $userContext)
    {
        $data = $this->landService->lists($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 土地详情
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail()
    {
        $data = $this->landService->detail();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 土地人房列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function houseResident()
    {
        $data = $this->landService->houseResidentList();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 人房详情
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function houseResidentDetail(UserContext $userContext)
    {
        $data = $this->landService->houseResidentDetail($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 投资详情
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function Invest(UserContext $userContext)
    {
        $data = $this->landService->Invest($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 保存土地信息
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(UserContext $userContext)
    {
        $data = $this->landService->save($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    public function leaveList()
    {
        $data = $this->landService->leaveList();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }
}
