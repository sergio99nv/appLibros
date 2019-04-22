<?php

namespace appLibros\Http\Middleware;

use Closure;
use Session;


class StudentSession
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
         *  luego comprabamos su valor 
         *
        */
        if(!Session::has("userId") || !Session::has("userType")){
            return redirect('/login'); 
        } 
        
        
        if(Session::get("userType") !== "student"  ){  
            return redirect('/login'); 
        } 
           
          
        return $next($request);  
    }
}
