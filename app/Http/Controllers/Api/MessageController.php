<?php

namespace App\Http\Controllers\Api;

use Core\Http\Repositories\Services\Platform\MessageService;
use Core\Http\Requests\MobileInputDTO;
use Core\Util\ResultsVo;

class MessageController extends BaseController
{

    public $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * 获取验证码
     * @param MobileInputDTO $mobileInputDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function verification(MobileInputDTO $mobileInputDTO)
    {
        $this->messageService->verification($mobileInputDTO);
        return response()->json(new ResultsVo(['data' => true]));
    }

    public function validateCode()
    {
        $data = $this->messageService->validateCode();
        return response()->json(new ResultsVo(["message" => '验证手机验证码', "data" => $data]));
    }
}
