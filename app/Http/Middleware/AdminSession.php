<?php

namespace appLibros\Http\Middleware;

use Closure;
use Session;


class AdminSession
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
       /**
         * Validamos si existe la variable de Session *userId* y  **userType
         *  uego comprabamos su valor 
         *
        */
        if(!Session::has("userId") || !Session::has("userType")){
            return redirect('/admins/login'); 
        } 
        
        
        if(Session::get("userType") !== "admin"  ){  
            return redirect('/admins/login'); 
        } 
           
          
        return $next($request);  
        
    }
}
