<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 11:45
 */

namespace App\Http\Controllers\Api;

use Core\Http\Repositories\Services\User\UserCenterService;
use Core\Http\Requests\ChangePasswordDTO;
use Core\Http\Requests\UserContext;
use Core\Util\ResultsVo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class UserCenterController extends BaseController
{
    protected $userCenterService;

    public function __construct(
        UserCenterService $userCenterService
    )
    {
        $this->userCenterService = $userCenterService;
    }

    /**
     * 我的个人中心
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function main(UserContext $userContext)
    {
        $data = $this->userCenterService->main($userContext);

        return $this->responseJson(0,Lang::get("response.success"),$data);
    }

    /**
     *别人查看用户主页
     * @return \Illuminate\Http\JsonResponse
     * @author ceclear
     * @date 2021-08-18 16:19
     */
    public function otherUserInfo()
    {
        $data = $this->userCenterService->otherUserInfo();

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     * 个人信息修改页面
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindInfo(UserContext $userContext)
    {
        $data = $this->userCenterService->bindInfo($userContext);

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }


    /**
     * 保存个人信息
     * @param Request $request
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserInfo(Request $request, UserContext $userContext)
    {
        $data = $this->userCenterService->updateUserInfo($request, $userContext);

        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     * 验证中心身份认证保存状态
     * @param UserContext $userContext
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function identityVerify(UserContext $userContext, Request $request)
    {
        $data = $this->userCenterService->identityVerify($userContext, $request);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     * 注销账号
     * @param UserContext $userContext
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAccount(UserContext $userContext, Request $request)
    {
        $data = $this->userCenterService->destroyAccount($userContext, $request);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     * 修改手机号
     * @param UserContext $userContext
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeMobile(UserContext $userContext, Request $request)
    {
        $data = $this->userCenterService->changeMobile($userContext, $request);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }

    /**
     * 修改登录密码
     * @param ChangePasswordDTO $changePasswordDTO
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordDTO $changePasswordDTO, UserContext $userContext)
    {
        $data = $this->userCenterService->changePassword($changePasswordDTO, $userContext);
        return response()->json(new ResultsVo(["message" => Lang::get("response.reset_password"), "data" => $data]));
    }

    public function userPermission(UserContext $userContext)
    {
        $data = $this->userCenterService->userPermission($userContext);
        return $this->responseJson(0, '成功', $data);
    }


}
