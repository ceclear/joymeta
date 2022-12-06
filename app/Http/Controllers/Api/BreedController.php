<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Breed\BreedService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class BreedController extends BaseController
{
    private $breedService;

    public function __construct(BreedService $breedService)
    {

        $this->breedService = $breedService;
    }

    /**养殖场列表
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(UserContext $userContext)
    {
        $data = $this->breedService->lists($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**动物列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail()
    {
        $data = $this->breedService->detail();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**动物详情
     * @return \Illuminate\Http\JsonResponse
     */
    public function littleDetail()
    {
        $data = $this->breedService->littleDetail();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    /**
     * 编辑养殖
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(UserContext $userContext)
    {
        $data = $this->breedService->save($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }
}
