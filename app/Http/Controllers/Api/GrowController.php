<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Grow\GrowService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class GrowController extends BaseController
{
    private $growService;

    public function __construct(GrowService $growService)
    {

        $this->growService = $growService;
    }

    /**种植场列表
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(UserContext $userContext)
    {
        $data = $this->growService->lists($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**植物列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail()
    {
        $data = $this->growService->detail();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**植物详情
     * @return \Illuminate\Http\JsonResponse
     */
    public function littleDetail()
    {
        $data = $this->growService->littleDetail();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 编辑种植
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(UserContext $userContext)
    {
        $data = $this->growService->save($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }
}
