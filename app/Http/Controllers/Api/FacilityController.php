<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Facility\FacilityService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class FacilityController extends BaseController
{
    private $facilityService;

    public function __construct(FacilityService $facilityService)
    {

        $this->facilityService = $facilityService;
    }

    /**
     * 设施分类
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryList(UserContext $userContext)
    {
        $data = $this->facilityService->categoryList($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 设施列表
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function facilityList(UserContext $userContext)
    {
        $data = $this->facilityService->facilityList($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 设施详情
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function facilityDetail(UserContext $userContext)
    {
        $data = $this->facilityService->facilityDetail($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 经济，投资列表
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function econList(UserContext $userContext)
    {
        $data = $this->facilityService->econList($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

}
