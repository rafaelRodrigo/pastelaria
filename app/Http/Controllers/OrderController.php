<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function post(Request $request)
    {
        try{
            $validation = $this->validation($request->all());
            if(!empty($validation)){
                throw new Exception('Error to create Order. '.$validation->content(),403);
            }
            try{
                $order = Order::create($request->all());

                ////***** FUNÇÃO PARA DISPARAR E-MAIL ****/////////

                return new OrderResource($order);
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to create Order. '.$e, 'error' => 403]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],403);
        }
    }
    public function getAll()
    {
        $orderData = Order::where('deleted_at',null)->paginate();
        return OrderResource::collection($orderData);
    }

    public function get(int $id)
    {
        try{
            $order = Order::findOrFail($id);
            return new OrderResource($order);
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function put(Request $request, int $id)
    {
        try{
            $validation = $this->validation($request->all());
            if(!empty($validation)){
                throw new Exception('Error to update Order. '.$validation->content(),403);
            }
            try{
                $order = Order::findOrFail($id);
                $order->client_id = $request->input('client_id');
                $order->product_id = $request->input('product_id');

                if($order->save()){
                    return new OrderResource($order);
                }else{
                    throw new Exception('Error to update order',403);
                }
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to update order. '.$e, 'error' => 403]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],403);
        }
    }

    public function delete($id){
        try {
            $order = Order::findOrFail($id);
            if($order->delete()){
                return response(null,200);
            }else{
                throw new Exception('Error to delete order',403);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function validation($data){
        try{
            $validator = Validator::make($data,[
                'client_id' => 'required',
                'product_id' => 'required'
            ]);
            if($validator->fails()){
                throw new Exception($validator->errors(),403);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],$e->getCode());
        }
    }
}
