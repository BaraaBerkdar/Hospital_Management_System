<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

       // return $request;

        // foreach($guards as $guard){
        //     if($guard=='web'){
        // return redirect()->intended(RouteServiceProvider::HOME);
        //     }elseif($guard=='admin'){
        // return redirect()->intended(RouteServiceProvider::HOMEADMIN);

        //     }else{
        // return redirect()->intended(RouteServiceProvider::HOMEDOCTOR);

        //     }
        // }

       if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password])){

        return redirect()->intended(RouteServiceProvider::HOME);
    }          
    else if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){

        return redirect()->intended(RouteServiceProvider::HOMEADMIN);


    }
    else if(Auth::guard('doctor')->attempt(['email'=>$request->email,'password'=>$request->password])){

        return redirect()->intended(RouteServiceProvider::HOMEDOCTOR);


    }else if( Auth::guard('ray_employee')->attempt(['email'=>$request->email,'password'=>$request->password])){

        return redirect()->intended(RouteServiceProvider::HOMERAY);

        }
    

        return $next($request);
    }
}
