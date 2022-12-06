<?php

namespace App\Http\Middleware;

use Core\Http\Exceptions\ServiceException;
use Core\Http\Exceptions\Constants\CommonExceptionConstants;
use Closure;
use Illuminate\Support\Facades\Log;

class Sign
{

    /**
     * api 签名验证
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $api_sign = config("app.api_sign");//是否开启接口全局签名验证
        if($api_sign === true) {
            $private = 'kfh9pMKbNSkWs6Rcsbb51gKSP7wARyzvhmr';

            $sign = $request->header('X-Header-Sign');//签名
            $signParams = [];
            $signParams['X-Header-Timestamp'] = $request->header('X-Header-Timestamp');//请求时间戳
            $signParams['X-Header-Type'] = $type = $request->header('X-Header-Type', 'h5');//设备类型 h5
            $signParams['X-Header-Channel'] = $request->header('X-Header-Channel', 'default');//包渠道
            $signParams['X-Header-Version'] = $version = $request->header('X-Header-Version', '');//版本
            $signParams['X-Header-Model'] = $request->header('X-Header-Model', '');//设备型号
            $signParams['X-Header-Did'] = $request->header('X-Header-Did', '');//设备id
            //20201217加path签名
//            $signParams['request_url_path']   = $request->getPathInfo();
//            Log::info('签名参数',$signParams);
            if(in_array($type, ['android', 'ios'])){
                throw new ServiceException(CommonExceptionConstants::getKey('sign_params_error'));
            }
            //存在版本号且满足最低版本号要求
//                if ((time() - mb_substr($signParams['X-Header-Timestamp'], 0, 10)) > 3600) {
//                    throw new ServiceException(CommonExceptionConstants::getKey('sign_timeout'));
//                }
            if ($request->isMethod('post')) {
                $post = $request->post();
                if (!empty($post)) {
                    $signParams = array_merge($signParams, $post);
                }
            }
            ksort($signParams);
            $str = '';
            foreach ($signParams as $key => $val) {
                $str .= $key . '=' . $val . '&';
            }

            #删除最后一个&符号
            $str = substr($str, 0, -1);
            $str = $str . '&key=' . $private;
            //加密并转为小写
            $md5Res = strtolower(md5($str));

//            Log::info("签名str：" . $str . "||my_sign：" . $md5Res . "|||sign：" . $sign);
            if (strtolower($sign) != $md5Res) {
//                Log::info("签名失败str：" . $str . "|||sign：" . $sign);
                //单独记录
                file_put_contents(storage_path('sign_error.log'), date('Y-m-d H:i:s') . "\t" . "签名失败str：" . $str . "||my_sign：" . $md5Res  . "||sign：" . $sign . "||url:" . request()->getPathInfo() . "\r\n", FILE_APPEND);
                throw new ServiceException(CommonExceptionConstants::getKey('sign_invalid'));
            }
        }

        //从公共header里提取信息并注入到request
        $type = $request->header('X-Header-Type');

        $mid_params['header_type'] = $type ? $type : $request->get('type', 'h5');//网页的时候带这个参数
        $channel = $request->header('X-Header-Channel');
        $mid_params['header_channel'] = $channel ? $channel : $request->get('channel', 'default');//网页的时候带这个参数
        $version = $request->header('X-Header-Version');
        $mid_params['header_version'] = $version ? $version : $request->get('version', '');//网页的时候带这个参数
        $request->page = $request->get('page', 1);
        $request->size = $request->get('size', 20);
        $request->offset = ($request->page - 1) * $request->size;

        $request->attributes->add($mid_params);//添加参数
        return $next($request);
    }


}
