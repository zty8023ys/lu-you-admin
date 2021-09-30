<?php
namespace Dengje\Cms\Http\Middleware;


use Closure;
use Dengje\Cms\Api\BaseController;
use Dengje\Cms\Lib\Token\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        dump($request);
        $token = $request->header('token','');
        if(!$token){
            return (new BaseController())->result('',403,'缺少token');
        }
        if(!Token::hasToken($token)){
            return (new BaseController())->result('',401,'token无效');
        }
        $uid = Token::getToken($token);
        $request->merge(['uid' => $uid]);
        return $next($request);
    }
}
