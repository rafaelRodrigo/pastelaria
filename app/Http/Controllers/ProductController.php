<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function getAll()
    {
        $productData = Product::where('deleted_at',null)->paginate();
        return ProductResource::collection($productData);
    }

    public function get(int $id)
    {
        try{
            $product = Product::findOrFail($id);
            return new ProductResource($product);
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function post(Request $request)
    {
        try{
            $validation = $this->validation($request->all());
            if(!empty($validation)){
                throw new Exception('Error to create Produc. '.$validation->content(),403);
            }
            try{
                $product = Product::create($request->all());
                return new ProductResource($product);
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to create product. '.$e, 'error' => 403]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],403);
        }
    }

    public function put(Request $request, int $id)
    {
        try{
            $validation = $this->validation($request->all());
            if(!empty($validation)){
                throw new Exception('Error to update Client. '.$validation->content(),403);
            }
            try{
                $product = Product::findOrFail($id);
                $product->name = $request->input('name');
                $product->price = $request->input('price');
                $product->photo = $request->input('photo');

                if($product->save()){
                    return new ProductResource($product);
                }else{
                    throw new Exception('Error to update product',403);
                }
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to update product. '.$e, 'error' => 403]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],403);
        }
    }

    public function delete($id){
        try {
            $product = Product::findOrFail($id);
            if($product->delete()){
                return response(null,200);
            }else{
                throw new Exception('Error to delete product',403);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function validation($data){
        try{
            $validator = Validator::make($data,[
                'name' => 'required',
                'price' => 'required',
                'photo' => 'required'
            ]);
            if($validator->fails()){
                throw new Exception($validator->errors(),403);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],$e->getCode());
        }
    }
}
