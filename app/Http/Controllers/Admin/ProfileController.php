<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $loggedId = intval(Auth::guard('admin')->id());

        $user = Admin::find($loggedId);

        if($user) {
            return view('admin.profile.index', [
                'user' => $user
            ]);
        }

        return redirect()->route('painel'); 
    }

    public function save(Request $request)
    {
        $loggedId = intval(Auth::guard('admin')->id());
        $user = Admin::find($loggedId);

        if($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);
            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email',  'max:100']
            ]);

            $user->name = $data['name'];

            if($user->email != $data['email']) {
                $hasEmail = Admin::where('email', $data['email'])->get();
                if(count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            if(!empty($data['password'])) {

                if(strlen($data['password']) >= 4) {
                    if($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            if(count( $validator->errors() ) > 0) {
                return redirect()->route('painel-profile', [
                    'admin' => $loggedId
                ])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('painel-profile')
                ->with('warning', 'Informações alteradas com sucesso!');

        }

        return redirect()->route('painel-profile');
    }

}
