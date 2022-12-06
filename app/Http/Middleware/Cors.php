<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        $response = $next($request);
//
//        $response->header('Access-Control-Allow-Origin', '*');//config('app.allow')
//        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
//        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
//        $response->header('Access-Control-Allow-Credentials', 'true');
//
//        return $response;

        $request->page = $request->input('page', 1);
        $request->size = $request->input('size', 20);
        $request->offset = ($request->page - 1) * $request->size;
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        if(config('app.is_open_cors')) {
            if (in_array($origin, config('app.cors_allow_origin'))) {
                $response->header('Access-Control-Allow-Origin', $origin);
                $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, Accept-Encoding, Accept-Language, Connection, Host, Referer, User-Agent, X-Header-Sign, X-Header-Timestamp, X-Header-Type, X-Header-Token');
                $response->header('Access-Control-Expose-Headers', 'Authorization, authenticated');
                $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
                $response->header('Access-Control-Allow-Credentials', 'true');
                // 缓存一周
                $response->header('Access-Control-Max-Age', '604800');
            }
        }else{
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, Accept-Encoding, Accept-Language, Connection, Host, Referer, User-Agent, X-Header-Sign, X-Header-Timestamp, X-Header-Type, X-Header-Token');
            $response->header('Access-Control-Expose-Headers', 'Authorization, authenticated');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
            $response->header('Access-Control-Allow-Credentials', 'true');
            // 缓存一周
            $response->header('Access-Control-Max-Age', '604800');
        }
        return $response;

    }
}
