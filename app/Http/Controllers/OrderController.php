<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Mail\SendEmail;
use App\Models\Client;
use App\Models\Order;
use App\Models\ProductOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function post(Request $request)
    {
        try{
            try{
                $validation = $this->validation($request->all());
                if(!empty($validation)){
                    throw new Exception('Error to create order. '.$validation->content(),403);
                }
            }catch (Exception $e) {
                throw new Exception('Error to create order. '.$e,403);
            }
            try{
                //inicia pedido
                $dataOrder = [
                    'client_id' => $request->client_id,
                    'number_order' => Carbon::now()->format('YmdHis'),
                    'order_status' => "start"
                ];
                $order = Order::create($dataOrder);
                if(empty($order)){
                    throw new Exception('Error to create order. ',403);
                }
            }catch (Exception $e) {
                throw new Exception('Error to create order. '.$e,403);
            }
            try{
                //adiciona os produtos ao pedido
                foreach ($request->products as $product){
                    $dataProducts = [
                        'order_id'=>$order->id,
                        'product_id'=>$product['id'],
                        'quantity'=>$product['quantity']
                    ];
                    ProductOrder::create($dataProducts);
                }
            }catch (Exception $e) {
                throw new Exception('Error to add products to order. '.$e,403);
            }
            try{
                //Finaliza o pedido
                $order = Order::findOrFail($order->id);
                $order->order_status = 'Finalizado';
                if(!$order->save()) {
                    throw new Exception('Error to Finish order', 403);
                }
                $this->sendEmailOrder($order->id, $order->client_id);
            }catch (Exception $e) {
                throw new Exception('Error to Finish order'.$e,403);
            }
            try{
                $this->sendEmailOrder($order->id, $order->client_id);
            }catch (Exception $e) {
                throw new Exception('Error to send e-mail order'.$e,403);
            }
            return new OrderResource($order);
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
            try{
                $validation = $this->validation($request->all());
                if(!empty($validation)){
                    throw new Exception('Error to update order. '.$validation->content(),403);
                }
            }catch (Exception $e) {
                throw new Exception('Error to update order. '.$e,403);
            }
            try{
                $order = Order::findOrFail($id);
                $order->client_id = $request->input('client_id');
                if(!$order->save()){
                    throw new Exception('Error to update order',403);
                }
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to update order. '.$e, 'error' => 403]);
            }
            try{
                //adiciona os produtos ao pedido
                /*foreach ($request->products as $product){
                    $dataProducts = [
                        'order_id'=>$order->id,
                        'product_id'=>$product['id'],
                        'quantity'=>$product['quantity']
                    ];
                    //ProductOrder::create($dataProducts);
                }*/
                $arrayProducts = ProductOrder::where('order_id',$id)->get();
                foreach ($arrayProducts as $product){
                    foreach ($request->products as $productNew){
                        if($productNew['id'] == $product->product_id){
                            $product->quantity = $productNew['quantity'];
                            if(!$product->save()){
                                throw new Exception('Error to update order',403);
                            }
                        }
                    }
                }
            }catch (Exception $e) {
                throw new Exception('Error to add products to order. '.$e,403);
            }
            return response()->json('',200);
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
                'client_id' => 'required|integer',
                'products.*.id' => 'required|integer',
                'products.*.quantity' => 'required|integer',
            ]);
            if($validator->fails()){
                throw new Exception($validator->errors(),403);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],$e->getCode());
        }
    }

    public function sendEmailOrder($idPedido,$idCliente)
    {
       try{
           $dataClient = Client::findOrFail($idCliente);
            $data = [
                'order' => $idPedido,
                'name' => $dataClient->name
            ];
            //adicionar o e-mail do cliente
            Mail::to($dataClient->email)->send(new SendEmail("email.order","Um novo pedido foi efetuado",$data));
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],$e->getCode());
        }

    }
}
