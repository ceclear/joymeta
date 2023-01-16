<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Platform\LoginServerService;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class LoginServerController extends BaseController
{
    private $loginServerService;

    public function __construct(LoginServerService $loginServerService)
    {
        $this->loginServerService = $loginServerService;
    }

    public function index()
    {
        $data = request()->input();
//        Log::info('收到login-server参数', $data);
        $rel = $this->loginServerService->dealOption($data);
        return $this->responseJson(0, Lang::get("response.success"), $rel);
    }


}
