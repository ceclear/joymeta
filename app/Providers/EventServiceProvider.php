<?php

namespace App\Providers;

use App\Listeners\QueryListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        QueryExecuted::class => [
            QueryListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //laravels.received_request 将Swoole\Http\Request转成Illuminate\Http\Request后，在Laravel内核处理请求前。
        Event::listen('laravels.received_request', function (\Illuminate\Http\Request $req, $app) {
            //是否开启apm
            $needStartApm = $this->checkNeedStartApm($req);
            if($needStartApm){
                $this->startApm($req);
            }
        });

        //laravels.generated_response 在Laravel内核处理完请求后，将Illuminate\Http\Response转成Swoole\Http\Response之前(下一步将响应给客户端)。
        Event::listen('laravels.generated_response', function (\Illuminate\Http\Request $req, \Symfony\Component\HttpFoundation\Response $rsp, $app) {
            //是否需要关闭apm
            $endApm = $this->checkEndApm($req);
            if($endApm){
                $this->endApm($req);
            }
        });
    }

    /**
     * 是否打开apm
     * @param $req
     * @return bool
     */
    protected function checkNeedStartApm($req)
    {
        $url = $req->url();
        //忽略一些url  e.g: 后台、js
        if(preg_match('/\/admin|laravel-admin|\.js|laravel-admin-ext|abtest/', $url)) {
            return false;
        } else {
            //有debug参数 或 系统配置打开
            if($req->get('debug') || config('app.always_start_apm')) {
                return true;
            } else {
                // 采样频率，默认 1%
                return rand(1, config('app.apm_random_base')) === 36;
            }
        }
    }

    /**
     * 开启apm
     * @param $req
     * @return bool
     */
    protected function startApm($req)
    {
        if (extension_loaded('tideways_xhprof')){
            tideways_xhprof_enable(TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_MEMORY_MU | TIDEWAYS_XHPROF_FLAGS_MEMORY_PMU | TIDEWAYS_XHPROF_FLAGS_CPU);
            $req->query->set('is_request_start_apm', '1');
            return true;
        } else {
            return false;
        }
    }

    /**
     * 是否需要关闭apm
     * @param $req
     * @return bool
     */
    protected function checkEndApm($req)
    {
        if($req->get('is_request_start_apm') == 1){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 记录apm结果
     * @param $req
     * @return bool
     */
    protected function endApm($req)
    {
        if (extension_loaded('tideways_xhprof')){
            try {
                $url = $req->url();
                $paraUrl = parse_url($url);
                $host = explode('.', $paraUrl['host'])[0];
                //文件名称格式化方便查看
                $fileName = $host . str_replace('/', '_', $paraUrl['path']) . '_' . uniqid();
                //记录文件
                $dirName = "/tmp/xhprof";
                if(is_dir($dirName)) {
                    file_put_contents(
                        '/tmp/xhprof/' . $fileName . '.msg-api.xhprof',
                        serialize(tideways_xhprof_disable())
                    );
                }
            } catch (\Exception $ex) {
                //错误丢弃
            }
        }
        return true;
    }
}
