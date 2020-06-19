<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    private $array = ['error'=>'', 'result'=>[]];

    public function all() {
        $products = Product::all();

        foreach($products as $product){
            $this->array['result'][] = [
                'id' => $product->id,
                'produto' => $product->produto
            ];
        }

        return $this->array;
    }

    // Filtro por Categoria
    public function filterCategory($id){
        $products = Product::where('id_categoria', $id)->get();

        foreach($products as $product){
            $this->array['result'][] = [
                'id' => $product->id,
                'produto' => $product->produto
            ];
        }
        return $this->array; 
    }

    public function one($id){
        $product = Product::find($id);

        if($product){
            $this->array['result'] = $product;
        } else {
            $this->array['error'] = 'ID não encontrado';
        }

        return $this->array; 
    }

    public function new(Request $request){
        $id_categoria = $request->input('id_categoria');
        $produto = $request->input('produto');
        $descricao = $request->input('descricao');
        $valor = $request->input('valor');
        $disponivel = $request->input('disponivel');

        if($request->file) {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,jpg,png'
            ]);
    
            $ext = $request->file->extension();
            $imageName = time().'.'.$ext;
    
            $request->file->move(public_path('media/images'), $imageName);

            $urlImage = asset('media/images/'.$imageName);
        } else {
            $urlImage = NULL;
        }

        if($id_categoria && $produto && $descricao && $valor && $disponivel ) {

            $product = new Product();
            $product->id_categoria = $id_categoria;
            $product->produto = $produto;
            $product->descricao = $descricao;
            $product->valor = $valor;
            $product->disponivel = $disponivel;
            $product->imagem = $urlImage;
            $product->save();

            $this->array['result'] = [
                'id' => $product->id,
                'id_categoria' => $id_categoria,
                'produto' => $produto,
                'descricao' => $descricao,
                'valor' => $valor,
                'disponivel' => $disponivel,
                'imagem' => $urlImage,
            ];


        } else {
            $this->array['error'] = 'Todos os campos devem ser preenchidos';
        }

        return $this->array; 
    }

    public function edit(Request $request, $id){
        $id_categoria = $request->input('id_categoria');
        $produto = $request->input('produto');
        $descricao = $request->input('descricao');
        $valor = $request->input('valor');
        $disponivel = $request->input('disponivel');

        if($id && $id_categoria && $produto && $descricao && $valor && $disponivel ) {

            $product = Product::find($id);
            if($product) {
                $product->id_categoria = $id_categoria;
                $product->produto = $produto;
                $product->descricao = $descricao;
                $product->valor = $valor;
                $product->disponivel = $disponivel;
                $product->save();

                $this->array['result'] = [
                    'id' => $id,
                    'id_categoria' => $id_categoria,
                    'produto' => $produto,
                    'descricao' => $descricao,
                    'valor' => $valor,
                    'disponivel' => $disponivel,
                ];

            } else {
                $this->array['error'] = 'ID não existe';
            }

        } else {
            $this->array['error'] = 'Todos os campos devem ser preenchidos';
        }

        return $this->array; 
    }

    public function delete($id){
        $product = Product::find($id);

        if($product) {
            $product->delete();
        } else {
            $this->array['error'] = 'ID não existe';
        }

        return $this->array;
    }

}
