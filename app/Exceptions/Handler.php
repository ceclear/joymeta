<?php

namespace App\Exceptions;

use Core\Util\ResultsVo;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Core\Http\Exceptions\ServiceException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $data = ['status'=>1000000,'msg'=>'','data'=>[]];
        $isDebug = config('app.debug');

        switch ($exception) {
            case $exception instanceof ServiceException://throw 异常
                $data['status'] = $exception->getCode();
                $data['msg'] = $exception->getMessage();
                break;
            case $exception instanceof ValidationException://DTO 验证失败
                $message = '';
                $result = $exception->validator->getMessageBag()->toArray();
                foreach($result as $key => $val) {
                    $message .= implode(',',$val);
                }
                $data['msg'] = $message;
                break;
            case $exception instanceof \PDOException://sql错误
                $data['status'] = 500;
                if($isDebug){
                    $data['msg'] = $exception->getMessage();
                } else {
                    $data['msg'] = '服务器内部错误-S';
                }
                break;
            case $exception instanceof NotFoundHttpException://sql错误NotFoundHttpException
            case $exception instanceof MethodNotAllowedHttpException:
                $data['status'] = 500;
                $data['msg'] = '路由不存在';
                break;
            case $exception instanceof MaintenanceModeException://维护模式抛出的异常 php artisan down
                $data['status'] = 500;
                $data['msg'] = '维护中请稍后';
                break;
            default:
                $data['status'] = 500;
                if($isDebug){
                    $data['msg'] = '异常: 行:'.$exception->getLine().', File '.$exception->getFile().',Error '.substr($exception->getMessage(),0,200);
                } else {
                    $data['msg'] = '服务器内部错误';
                    Log::info('服务器内部错误，异常: 行:'.$exception->getLine().', File '.$exception->getFile().',Error '.$exception->getMessage().',IP ' . $request->ip());
                }
                break;
        }
        if ($request->is('api/*')) {
//            return response()->view('prompt', ['data'=>$data]);
            return response()->json($data);
        } else {
            return parent::render($request, $exception);
        }
    }
}
