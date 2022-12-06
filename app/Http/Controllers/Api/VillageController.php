<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Village\VillageService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class VillageController extends BaseController
{
    private $villageService;

    public function __construct(VillageService $villageService)
    {

        $this->villageService = $villageService;
    }

    /**村庄基础信息
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function baseInfo(UserContext $userContext)
    {
        $data = $this->villageService->baseInfo($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 村节点
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function markerList(UserContext $userContext)
    {
        $data = $this->villageService->markerList($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    public function getDiscover()
    {
        $data = $this->villageService->getDiscover();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

}
