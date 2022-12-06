<?php

namespace App\Http\Controllers\Api;

use Core\Http\Repositories\Services\Platform\UploadService;
use Core\Http\Requests\UploadDTO;
use Core\Http\Requests\UploadSignUrlDTO;
use Core\Http\Requests\UserContext;
use Core\Util\AliOss;
use Core\Util\ResultsVo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class UploadController extends BaseController
{

    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * 上传token
     * @param UploadDTO $uploadDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function signature(UploadDTO $uploadDTO)
    {

        $res = AliOss::signature($uploadDTO->get("prefix"));

        return response()->json(new ResultsVo(['data' => ['result' => $res]]));
    }

    /**
     * 上传后回调
     * https://help.aliyun.com/document_detail/91771.html?spm=a2c4g.11186623.2.14.7ee07eaedmRJbZ#concept-nhs-ldt-2fb
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback()
    {
        return response()->json(["Status" => "Ok"]);
    }

//    /**
//     * 客户端上传token
//     * @param UploadDTO $uploadDTO
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function sts(UploadDTO $uploadDTO)
//    {
//
//        $res = AliOss::sts($uploadDTO->get("prefix"));
//
//        return response()->json(new ResultsVo(['data' => ['result' => $res]]));
//    }

    /**
     * 生成上传的签名URL 直传共有
     * @param UploadSignUrlDTO $uploadSignUrlDTO
     * @return \Illuminate\Http\JsonResponse
     * @throws \OSS\Core\OssException
     */
    public function signUrlPut(UploadSignUrlDTO $uploadSignUrlDTO, UserContext $userContext)
    {
        $userId = $userContext->getId();
        $data   = $this->uploadService->signUrlPut($uploadSignUrlDTO, 1, $userId);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), 'data' => $data]));
    }

    /**
     * 生成上传的签名URL（私有bucket，发布后需转到共有bucket）
     * @param Request $request
     * @param UserContext $userContext
     * @return \Illuminate\Http\JsonResponse
     * @throws \OSS\Core\OssException
     */
    public function signUrlPutPri(Request $request, UserContext $userContext)
    {
        $userId = $userContext->getId();
        $data   = $this->uploadService->signUrlPutPri($request, 1, $userId);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), 'data' => $data]));
    }

    /**
     * OSS PutObject 上传回调
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ossPutObjCallback(Request $request)
    {
        $data = $this->uploadService->ossPutObjCallback($request);
        return response()->json(["Status" => "Ok"]);
    }

    /**
     * 测试
     */
    public function test()
    {
        return AliOss::signUrlPut('avatar', ["jpg"]);
    }

    /**
     * Notes: 服务器上传文件
     * User: 黄钢
     * Date: 2021/5/8
     * Time: 11:48
     */
    public function servicePutFile(Request $request)
    {
        $data = $this->uploadService->servicePutFile($request);
        return response()->json(new ResultsVo(["message" => Lang::get("response.success"), "data" => $data]));
    }
}
