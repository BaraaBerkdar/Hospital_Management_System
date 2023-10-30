<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('Dashboard.User.Auth.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // return $request;
      
        if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password])){

            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }          
        else if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
           
            return redirect()->intended(RouteServiceProvider::HOMEADMIN);
        }else if(Auth::guard('doctor')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->intended(RouteServiceProvider::HOMEDOCTOR);

              }else if(Auth::guard('ray_employee')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->intended(RouteServiceProvider::HOMERAY);

              } else if(Auth::guard('lab_employee')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->intended(RouteServiceProvider::HOMELAB);

              }else if(Auth::guard('pation')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->intended(RouteServiceProvider::HOMEPATION);


              }
        else{
            return redirect()->back()->withErrors(['name' => (trans('Dashboard/auth.failed'))]);

        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    // return "user";
    {  
        //  return $request;
      
      if(Auth::guard('web')){
     
        Auth::guard('web')->logout();

    }elseif(Auth::guard('admin')){
        Auth::guard('admin')->logout();

    }else{
        Auth::guard('doctor')->logout();

    }
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
    }

 
}
