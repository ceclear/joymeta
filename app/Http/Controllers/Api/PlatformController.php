<?php
/**
 * 平台相关基础
 * Created by PhpStorm.
 * User: eric
 * Date: 2020/7/29
 * Time: 10:24
 */


namespace App\Http\Controllers\Api;


use Core\Http\Repositories\Services\Platform\OtherService;
use Core\Http\Requests\CaptchaDTO;
use Core\Http\Requests\UserContext;
use Core\Util\ResultsVo;
use Illuminate\Support\Facades\Lang;

class PlatformController extends BaseController
{

    protected $otherService;

    public function __construct(OtherService $otherService)
    {
        $this->otherService = $otherService;
    }

    /**
     * 所有区域组成的树状结构
     * @return \Illuminate\Http\JsonResponse
     */
    public function allRegion()
    {
        $data = $this->otherService->allRegion();

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    public function allIosRegion()
    {
        $data = $this->otherService->allIosRegion();

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }


    /**
     *图形验证码生成
     * @return \Illuminate\Http\JsonResponse
     * @author ceclear
     * @date 2021-07-23 14:54
     */
    public function captchaCreate()
    {
        $data = $this->otherService->captchaCreate();

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     *验证图形验证码
     * @param CaptchaDTO $captchaDTO
     * @return \Illuminate\Http\JsonResponse
     * @author ceclear
     * @date 2021-07-23 14:54
     */
    public function validateCaptcha(CaptchaDTO $captchaDTO)
    {
        $data = $this->otherService->validateCaptcha($captchaDTO);

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

}
