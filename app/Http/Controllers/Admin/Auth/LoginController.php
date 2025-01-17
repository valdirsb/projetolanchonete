<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $creds = $request->only(['email','password']);

        $validator = $this->validator($creds);

        $remember = $request->input('remember', false);

        if($validator->fails()) {
            return redirect()->route('painel-login')
            ->withErrors($validator)
            ->withInput();
        }

        if(Auth::guard('admin')->attempt($creds, $remember)) {
            return redirect()->route('painel');
        }else {
            $validator->errors()->add('password', 'E-mail e/ou senha errados.');

            return redirect()->route('painel-login')
            ->withErrors($validator)
            ->withInput();
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('painel-login');
    }

    protected function guard()
    {
    return Auth::guard('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:200'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }

}
