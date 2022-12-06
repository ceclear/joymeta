<?php
/**
 * 比较app版本
 */
namespace App\Http\Middleware;

use Core\Http\Exceptions\ServiceException;
use Core\Http\Exceptions\Constants\CommonExceptionConstants;
use Core\Http\Repositories\Services\Platform\HomeService;
use Closure;

class CheckAppUpdate
{

    public $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $checkUpdate = $this->homeService->checkUpdate($request, 1);
        $forceUpdate = isset($checkUpdate['force_update']) && $checkUpdate['force_update'] ? 1 : 0;
        if ($forceUpdate == 1) {
            throw new ServiceException(CommonExceptionConstants::getKey('you_need_upgrade_app'));
        }

        return $next($request);
    }


}
