<?php

namespace App\Http\Controllers\Auth;

use 
App\Http\Controllers\Controller, 
App\Providers\RouteServiceProvider, 
Illuminate\Foundation\Auth\AuthenticatesUsers, 
Illuminate\Http\Request,
Illuminate\Validation\ValidationException,
Auth;


class LoginController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('guest:arogyasakhi')->except('logout');
    }
    
    // public function showLoginForm()
    // {
    //     return \Hash::make('1234'); 
    //     return view();
    // }


    // $2y$10$JjoB3KiOS/CCEg0iZ.DWmeW00xlk.6zcIyCrysBTKDiNUFdanTI9S

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string', 
            'password' => 'required|min:4',
        ]);
        
        if(Auth::guard('arogyasakhi')->attempt(['email_id' => $request->login, 'password' => $request->password], $request->filled('remember')) || 
        Auth::guard('arogyasakhi')->attempt(['login_id' => $request->login, 'password' => $request->password], $request->filled('remember'))){
            return redirect()->intended(route('admin.dashboard'));
        }
        else{
            throw ValidationException::withMessages([
                'login' => [trans('auth.failed')],
            ]);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';
    
     /**
      * Get the guard to be used during authentication.
      *
      * @return \Illuminate\Contracts\Auth\StatefulGuard
      */
     protected function guard()
     {
         return Auth::guard('arogyasakhi');
     }
 
     public function username()
     {
         return 'login_id';
     }
     
     /**
      * Get the password for the user.
      *
      * @return string
      */
     public function getAuthPassword()
     {
         return $this->user_key;
     }
 
     
     
     use AuthenticatesUsers;
    
}
