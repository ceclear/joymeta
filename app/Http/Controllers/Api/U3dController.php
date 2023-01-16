<?php
/**
 * Created by PhpStorm.
 * User: lishengbin
 * Date: 19/10/29
 * Time: 下午8:03
 */

namespace App\Http\Controllers\Api;


use Core\Http\Components\GlobalConstant;
use Core\Http\Repositories\Services\U3d\U3dService;
use Core\Http\Requests\UserContext;
use Core\Util\ApiRequestServer;
use Illuminate\Support\Facades\Lang;

class U3dController extends BaseController
{

    protected $u3dService;

    public function __construct(U3dService $u3dService)
    {
        $this->u3dService = $u3dService;
    }

    public function index()
    {
//        dd($_SERVER);
        $remoteIp = $_SERVER['SERVER_ADDR'];
//        $remoteIp   = $_SERVER['DOCUMENT_ROOT'];
        $remotePort = $_SERVER['SERVER_PORT'];
        $data       = [
            'remote_ip'   => $remoteIp,
            'remote_port' => $remotePort
        ];
        return $this->responseJson(0, '', $data);
    }

    public function sendGameServer()
    {
        //php后台请求WebServer，WebServer转发给其他服务器处理
        //参数说明：
        //_action  --操作
        //_time  --时间
        //_sign --key+时间的MD5码
        //_servertype --转发的server类型 与_serverid互斥
        //_serverid --转发的serverid 与_servertype互斥
        //[如果_servertype和_serverid两个参数都没有，则转发给所有服务器]
        //_data   --需要处理的data数据，json格式
        //WebOpenKey  php请求游戏服            WCHY2022
        //==================================================================
        //_action：sysGMCmd
        //_data={}
        //"cmd":
        //"reloadScripts" --重载脚本
        //"stopGame "--停止服务
        //"maintainGame" --服务器维护
        //"forbidEnter" --服务器禁止进入游戏
        //"kickAll" --踢出所有人
        //"kickUser" --踢出玩家 “sid”--玩家uid
        //"rollMsg" --滚动消息
        // 	   --消息类型互斥“all”--群发广播 “sid”--玩家uid，单独玩家广播 “arrSid”--玩家uid数组，json格式，批量玩家广播
        $time       = time();
        $sendParam  = [
            '_action' => 'sysGMCmd',
            '_time'   => $time,
            '_sign'   => md5(GlobalConstant::SERVER_KEY . $time),
            '_data'   => json_encode(['key1' => 111]),
        ];
        $apiRequest = new ApiRequestServer();
        $rel        = $apiRequest->sendRequest($sendParam);
        return $this->responseJson(0, '', $rel);
    }

    //查询可登录服并返回
    public function queryLoginServer(UserContext $userContext)
    {
        $data = $this->u3dService->queryLoginServer($userContext);
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

    public function queryLoginToken()
    {
        $data = $this->u3dService->createLoginToken();
        return $this->responseJson(0, Lang::get("response.success"), $data);
    }

}
