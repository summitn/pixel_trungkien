<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use Auth;
use App\User;

class checkLoginUserNomalDownload
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
        if(!\Auth::check()){
            if($request->ajax()){
                return response()->json([
                    'statusDownloadAuth' => 'fail',
                    'message' => 'not login'
                ]);
            }else{
                //return redirect('/admin/login');
                return response()->json([
                    'statusDownloadAuth' => 'fail',
                    'message' => 'not login'
                ]);
            }
        }else{
            $user = Auth::user();
            if($user->role_id < 3){
                ///được phép dơnload
                return $next($request);
            }else{
                ///không đc download
                if($request->ajax()){
                    return response()->json([
                        'statusDownloadAuth' => 'fail',
                        'message' => 'not role (you must login with nomal user)'
                    ]);
                }else{
                    Auth::logout();
                    //return redirect('/admin/login');
                    return response()->json([
                        'statusDownloadAuth' => 'fail',
                        'message' => 'not role (you must login with nomal user)'
                    ]);
                }
            }
        }
    }
}
