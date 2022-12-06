<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\House\HouseService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class HouseController extends BaseController
{
    private $houseService;

    public function __construct(HouseService $houseService)
    {

        $this->houseService = $houseService;
    }

    /**
     * 房屋列表
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(UserContext $userContext)
    {
        $data = $this->houseService->lists($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 房屋详情
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail()
    {
        $data = $this->houseService->detail();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 保存房屋信息
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(UserContext $userContext)
    {
        $data = $this->houseService->save($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

}
