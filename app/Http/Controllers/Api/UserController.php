<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 11:45
 */

namespace App\Http\Controllers\Api;

use Core\Http\Repositories\Services\User\UserService;
use Core\Http\Requests\UserBindingDTO;
use Core\Http\Requests\UserContext;
use Core\Http\Requests\UserFindPassDTO;
use Core\Http\Requests\UserLoginDTO;
use Core\Http\Requests\UserLoginPassDTO;
use Core\Http\Requests\UserRegisterDTO;
use Core\Util\ResultsVo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;


class UserController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {

        $this->userService = $userService;
    }

    /**
     * 手机+密码登录
     * @param UserLoginPassDTO $userLoginPassDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginPass(UserLoginPassDTO $userLoginPassDTO)
    {
        $data = $this->userService->loginPass($userLoginPassDTO);
        return $this->responseJson(0, Lang::get("response.login"), $data);
    }

    /**
     * 手机+验证码登录
     * @param UserLoginDTO $userLoginDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginCode(UserLoginDTO $userLoginDTO)
    {
        $data = $this->userService->loginCode($userLoginDTO);
        return response()->json(new ResultsVo(["message" => Lang::get("response.login"), "data" => $data]));
    }

    /**
     * 退出登录
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(UserContext $userContext)
    {
        $data = $this->userService->logout($userContext);
        return $this->responseJson(0, Lang::get("response.logout"), $data);
    }

    /**
     * 手机号+密码注册
     * @param UserRegisterDTO $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterDTO $request)
    {
        $data = $this->userService->register($request);
        return $this->responseJson(0, Lang::get('response.register'), $data);
    }

    /**
     * 找回密码 验证+修改 一步到位
     * @param UserFindPassDTO $userFindPassDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function findPass(UserFindPassDTO $userFindPassDTO)
    {
        $data = $this->userService->findPass($userFindPassDTO);
        return response()->json(new ResultsVo(["message" => Lang::get("response.reset_password"), "data" => $data]));
    }

    /**
     *第三方账号登录
     * @return \Illuminate\Http\JsonResponse
     * @author ceclear
     * @date 2021-08-06 14:18
     */
    public function thirdLogin()
    {
        $data = $this->userService->thirdLogin();
        return response()->json(new ResultsVo(["message" => Lang::get("response.login"), "data" => $data]));
    }

    /**
     * 第三方账号注册并绑定手机号
     * @param UserBindingDTO $userBindingDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindMobile(UserBindingDTO $userBindingDTO)
    {
        $data = $this->userService->bindMobile($userBindingDTO);
        return response()->json(new ResultsVo(["message" => Lang::get("response.login"), "data" => $data]));
    }

    /**
     * 手机号一键登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    public function mobileVerifyLogin(Request $request)
    {
        $data = $this->userService->mobileVerifyLogin($request);
        return response()->json(new ResultsVo(["message" => Lang::get("response.login"), "data" => $data]));
    }

    /**
     * 登录后绑定第三方账号
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function thirdBind(UserContext $userContext)
    {
        $data = $this->userService->thirdBind($userContext);
        return response()->json(new ResultsVo(["message" => Lang::get("response.login"), "data" => $data]));
    }

    public function thirdAppleBind(UserContext $userContext)
    {
        $data = $this->userService->thirdAppleBind($userContext);
        return response()->json(new ResultsVo(["message" => Lang::get("response.login"), "data" => $data]));
    }

    /**
     * 苹果登录回调
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function appleLoginCallback(Request $request)
    {
        $data = $this->userService->appleLoginCallback($request);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    public function u3dRegisterCheck( )
    {
        $data = $this->userService->u3dRegisterCheck();
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }


}
