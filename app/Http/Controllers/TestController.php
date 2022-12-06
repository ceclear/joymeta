<?php

namespace App\Http\Controllers;

use Core\Http\Exceptions\ServiceException;
use Core\Http\Exceptions\Constants\UserExceptionConstants;
use Core\Http\Repositories\Daos\Store\StoreDao;
use Core\Http\Repositories\Daos\User\UserDao;
use Core\Http\Repositories\Redis\UserLoginRedis;
use Core\Http\Repositories\Redis\UserRedis;
use Core\Http\Repositories\Services\User\UserService;
use Core\Util\AlibabaCloudApi;
use Core\Util\AppleLogin;
use Core\Util\ApplePay;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Core\Http\Repositories\Eloquent\User\User;
use Cron\CronExpression;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        echo 'Welcome to lottery11';
    }

    public function cron(){

       // Works with complex expressions
        $cron = CronExpression::factory('00 11 27,28,29 8,9 *');
        dump($cron);
        dump($cron->getNextRunDate()->format('Y-m-d H:i:s'));
        dump($cron->getNextRunDate());
        dump($cron->getNextRunDate()->getTimestamp());
        dump($cron->getNextRunDate('now', 1));
        dump($cron->getNextRunDate($cron->getNextRunDate()));
        dump($cron->getNextRunDate($cron->getNextRunDate()));
        dump($cron->getNextRunDate($cron->getNextRunDate())->getTimestamp());

    }

    public function login() {

        $qq = '2815509305';

        #$data = Login::qq($qq);

        #return response()->json(new ResultsVo(["message"=>Lang::get("response.success"),"data"=>$data]));
    }

    /**
     * 查看ip限流key
     * @param Request $request
     * @return string
     */
    public function getIpCheck(Request $request){
        $s = null;
        $ip = $request->get('ip', $request->ip());
        if (empty($ip)){
            return "输入 ip";
        }
        return "使用ip:". $request->ip(). '，val值：'.sha1($s.'|' . $ip);
    }

    public function test(Request $request)
    {
        return $request->getClientIp();
    }

    public function abtest(Request $request)
    {
	    return 'hello im abtest';
    }


}
