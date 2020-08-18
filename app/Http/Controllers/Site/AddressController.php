<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;
use App\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index() {
        $districts = District::All();
        return view('site.register_address',[
            'districts' => $districts
        ]);
    }

    public function register(Request $request) {
        $data = $request->only(['district', 'logradouro', 'numero', 'cep']);
        $validator = $this->validator($data);

        if($validator->fails()) {
            return redirect()->route('registerAddress')
            ->withErrors($validator)
            ->withInput();
        }
        $user = Auth::user();

        $user_id = $user->id;

        $newaddress = new Address();
            $newaddress->user_id = $user_id;
            $newaddress->district_id = $data['district'];
            $newaddress->logradouro = $data['logradouro'];
            $newaddress->numero = $data['numero'];
            $newaddress->cep = $data['cep'];
            $newaddress->save();


        return redirect()->route('perfil');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'district' => ['required', 'max:20'],
            'logradouro' => ['required','string', 'max:200'],
            'numero' => ['required', 'string'],
            'cep' => ['nullable', 'string'],
        ]);
    }

    protected function create(array $data)
    {
        $user = Auth::user();

        return Address::create([
            'user_id' => $user->id,
            'district_id' => $data['district'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'cep' => $data['cep'],
        ]);
    }


}
