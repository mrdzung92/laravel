<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class PermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->session()->has('userInfo')){
            $userInfo = $request->session()->get('userInfo');
            if($userInfo['level']==='admin') return $next($request);
               
           
                return redirect()->route('notify/noPermission');
           
        }
        return redirect()->route('auth/login');
    }
}