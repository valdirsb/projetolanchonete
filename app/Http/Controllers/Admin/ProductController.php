<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Category;

class ProductController extends Controller
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
        $products = Product::all();

        foreach($products as $product){
            $cat = Category::find($product->id_categoria);
            $product->cat = $cat->categoria;
        }

        return view('admin.products.index', [
            'products' => $products,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', [
            'categories' => $categories
        ]);
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
            'produto',
            'descricao',
            'id_categoria',
            'valor',
            'disponivel'
        ]);

        if($request->file) {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,jpg,png'
            ]);
    
            $ext = $request->file->extension();
            $imageName = time().'.'.$ext;
            $imageFolder = '/media/images';
    
            $request->file->move(public_path($imageFolder), $imageName);

            $urlImage = $imageFolder.'/'.$imageName;
        } else {
            $urlImage = NULL;
        }

        $data['valor'] = floatval(str_replace(['.',','],['','.'], $data['valor']));

        $validator = Validator::make($data, [
            'produto' => ['required', 'string', 'max:50'],
            'descricao' => ['required', 'string', 'max:300'],
            'id_categoria' => ['required', 'numeric'],
            'valor' => ['required', 'numeric'],
        ]);

        if($validator->fails()) {
            return redirect()->route('products.create')
            ->withErrors($validator)
            ->withInput();
        }

        $product = new Product;
        $product->produto = $data['produto'];
        $product->descricao = $data['descricao'];
        $product->id_categoria = $data['id_categoria'];
        $product->valor = $data['valor'];

        if(isset($data['disponivel'])){
            $product->disponivel = 1;
        } else {
            $product->disponivel = 0;
        }

        $product->imagem = $urlImage;
        $product->save();

        return redirect()->route('products.index');
      
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
        $product = Product::find($id);
        $categories = Category::all();

        if($product){
            return view('admin.products.edit',[
                'product' => $product,
                'categories' => $categories,
            ]);
        }

        return redirect()->route('categories.index');
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
        $product = Product::find($id);

        if($product){

            $data = $request->only([
                'produto',
                'descricao',
                'id_categoria',
                'valor',
                'disponivel'
            ]);

            $data['valor'] = floatval(str_replace(['.',','],['','.'], $data['valor']));

            $validator = Validator::make($data, [
                'produto' => ['required', 'string', 'max:50'],
                'descricao' => ['required', 'string', 'max:300'],
                'id_categoria' => ['required', 'numeric'],
                'valor' => ['required', 'numeric'],
            ]);

            if($request->file) {
                $request->validate([
                    'file' => 'required|image|mimes:jpeg,jpg,png'
                ]);
        
                $ext = $request->file->extension();
                $imageName = time().'.'.$ext;
                $imageFolder = '/media/images';
                //copiando a nova imagem
                $request->file->move(public_path($imageFolder), $imageName);
                //deletando a imagem atual
                $urlImage = $imageFolder.'/'.$imageName;
                $abspath=$_SERVER['DOCUMENT_ROOT'];
                $finalpath = $abspath.'/'.$product->imagem;
                if (File::exists($finalpath)) {
                    File::delete($finalpath);
                    //unlink($caminho);
                }

                $product->imagem = $urlImage;

            }

            if(isset($data['disponivel'])){
                $product->disponivel = 1;
            } else {
                $product->disponivel = 0;
            }

            $product->produto = $data['produto'];
            $product->descricao = $data['descricao'];
            $product->id_categoria = $data['id_categoria'];
            $product->valor = $data['valor'];


            if(count( $validator->errors() ) > 0) {
                return redirect()->route('products.edit', [
                    'product' => $id
                ])->withErrors($validator);
            }

            $product->save();

        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $abspath=$_SERVER['DOCUMENT_ROOT'];

        $finalpath = $abspath.'/'.$product->imagem;

        if (File::exists($finalpath)) {
            File::delete($finalpath);
            //unlink($caminho);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
