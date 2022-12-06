<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Platform\FarmService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class FarmController extends BaseController
{
    private $farmService;

    public function __construct(FarmService $farmService)
    {

        $this->farmService = $farmService;
    }


    /**
     * 上链
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveChain()
    {
        $data = $this->farmService->approveChain();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    public function queryChain()
    {
        $data = $this->farmService->queryChain();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

}
