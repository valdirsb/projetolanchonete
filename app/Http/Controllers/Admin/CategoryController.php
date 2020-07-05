<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Category;

class CategoryController extends Controller
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

        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'categoria',
        ]);

        if($request->file) {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,jpg,png'
            ]);
    
            $ext = $request->file->extension();
            $imageName = time().'.'.$ext;
            $imageFolder = '/media/images/categories';
    
            $request->file->move(public_path($imageFolder), $imageName);

            $urlImage = $imageFolder.'/'.$imageName;
        } else {
            $urlImage = NULL;
        }

        $validator = Validator::make($data, [
            'categoria' => ['required', 'string', 'max:100'],
        ]);

        if($validator->fails()) {
            return redirect()->route('categories.create')
            ->withErrors($validator)
            ->withInput();
        }

        $category = new Category;
        $category->categoria = $data['categoria'];
        $category->url = $urlImage;
        $category->save();

        return redirect()->route('categories.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $category = Category::find($id);

        $abspath=$_SERVER['DOCUMENT_ROOT'];

        $finalpath = $abspath.'/'.$category->url;

        if (File::exists($finalpath)) {
            File::delete($finalpath);
            //unlink($caminho);
        }

        $category->delete();

        return redirect()->route('categories.index');
    }
}
