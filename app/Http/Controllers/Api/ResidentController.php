<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Resident\ResidentService;
use Core\Http\Requests\UserContext;
use Illuminate\Support\Facades\Lang;

class ResidentController extends BaseController
{
    private $residentService;

    public function __construct(ResidentService $residentService)
    {

        $this->residentService = $residentService;
    }

    public function lists(UserContext $userContext)
    {
        $data = $this->residentService->lists($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }



}
