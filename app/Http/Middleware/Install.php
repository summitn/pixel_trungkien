<?php

namespace App\Http\Middleware;

use Closure;
use TCG\Voyager\Models\Setting;
use Illuminate\Support\Facades\Schema;

class Install
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
        // If the database has the settings table we know that it has been installed
        if(Schema::hasTable('settings')){

            if($request->is('install/final')){
                return redirect('install/complete');
            }        

            if(!file_exists(storage_path('installed'))){
                file_put_contents(storage_path('installed'), '');
            }

            return $next($request);
            
        } else if($request->is('install/*') || $request->is('install')){

            @app('files')->link(storage_path('app/public'), public_path('storage'));

            return $next($request);
        } else {
            return redirect('install');
        }
    }
}
