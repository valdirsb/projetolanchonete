<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\District;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        return view('admin.districts.index', [
            'districts' => $districts ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'bairro',
            'frete'
        ]);


        $data['frete'] = floatval(str_replace(['.',','],['','.'], $data['frete']));

        $validator = Validator::make($data, [
            'bairro' => ['required', 'string', 'max:200'],
            'frete' => ['required', 'numeric'],
        ]);

        if($validator->fails()) {
            return redirect()->route('districts.create')
            ->withErrors($validator)
            ->withInput();
        }

        $district = new District;
        $district->nome = $data['bairro'];
        $district->frete = $data['frete'];
        $district->save();

        return redirect()->route('districts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::find($id);

        if($district){
            return view('admin.districts.edit',[
                'district' => $district,
            ]);
        }

        return redirect()->route('districts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = District::find($id);

        if($district){

            $data = $request->only([
                'bairro',
                'frete'
            ]);

            $data['frete'] = floatval(str_replace(['.',','],['','.'], $data['frete']));

            $validator = Validator::make($data, [
                'bairro' => ['required', 'string', 'max:200'],
                'frete' => ['required', 'numeric'],
            ]);

            

            $district->nome = $data['bairro'];
            $district->frete = $data['frete'];


            if(count( $validator->errors() ) > 0) {
                return redirect()->route('districts.edit', [
                    'district' => $id
                ])->withErrors($validator);
            }

            $district->save();

        }

        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);

        
        $district->delete();

        return redirect()->route('districts.index');
    }
}
