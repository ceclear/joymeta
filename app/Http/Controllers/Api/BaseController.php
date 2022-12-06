<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 2020/7/28
 * Time: 19:23
 */


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Core\Http\Components\ResponseJson;
use Core\Http\Exceptions\Constants\CommonExceptionConstants;
use Core\Http\Exceptions\ServiceException;
use Core\Http\Repositories\Redis\CacheDataRedis;

class BaseController extends Controller
{
    use ResponseJson;

}
