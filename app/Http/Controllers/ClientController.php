<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function getAll()
    {
        $clientData = Client::where('deleted_at',null)->paginate();
        return ClientResource::collection($clientData);
    }

    public function get(int $id)
    {
        try{
            $client = Client::findOrFail($id);
            return new ClientResource($client);
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function post(Request $request)
    {
        try{
            $validation = $this->validation($request->all());
            if(!empty($validation)){
                throw new Exception('Error to create Client. '.$validation->content(),403);
            }
            try{
                $client = Client::create($request->all());
                return new ClientResource($client);
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to create client. '.$e, 'error' => 403]);
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
                $client = Client::findOrFail($id);
                $client->name = $request->input('name');
                $client->email = $request->input('email');
                $client->phone = $request->input('phone');
                $client->date_born = $request->input('date_born');
                $client->address = $request->input('address');
                $client->complement = $request->input('complement');
                $client->district = $request->input('district');
                $client->zip_code = $request->input('zip_code');

                if($client->save()){
                    return new ClientResource($client);
                }else{
                    throw new Exception('Error to update client',403);
                }
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to update client. '.$e, 'error' => 403]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],403);
        }
    }

    public function delete($id){
        try {
            $client = Client::findOrFail($id);
            if($client->delete()){
                return response(null,200);
            }else{
                throw new Exception('Error to delete client',403);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function validation($data){
        try{
            $validator = Validator::make($data,[
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'date_born' => 'required',
                'address' => 'required',
                'district' => 'required',
                'zip_code' => 'required'
            ]);
            if($validator->fails()){
                throw new Exception($validator->errors(),403);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],$e->getCode());
        }
    }


}
