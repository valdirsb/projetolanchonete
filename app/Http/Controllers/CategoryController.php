<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    private $array = ['error'=>'', 'result'=>[]];

    public function all() {
        $categories = Category::all();

        foreach($categories as $category){
            $this->array['result'][] = [
                'id' => $category->id,
                'categoria' => $category->categoria
            ];
        }

        return $this->array;
    }

    public function one($id){
        $category = Category::find($id);

        if($category){
            $this->array['result'] = $category;
        } else {
            $this->array['error'] = 'ID não encontrado';
        }

        return $this->array; 
    }

    public function new(Request $request){
        $categoria = $request->input('categoria');

        if($categoria ) {

            $category = new Category();
            $category->categoria = $categoria;
            $category->save();

            $this->array['result'] = [
                'id' => $category->id,
                'categoria' => $categoria
            ];

        } else {
            $this->array['error'] = 'Todos os campos devem ser preenchidos';
        }

        return $this->array; 
    }

    public function edit(Request $request, $id){
        $categoria = $request->input('categoria');

        if($id && $categoria) {

            $category = Category::find($id);
            if($category) {
                $category->categoria = $categoria;
                $category->save();

                $this->array['result'] = [
                    'id' => $id,
                    'categoria' => $categoria
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
        $category = Category::find($id);

        if($category) {
            $category->delete();
        } else {
            $this->array['error'] = 'ID não existe';
        }

        return $this->array;
    }



}
