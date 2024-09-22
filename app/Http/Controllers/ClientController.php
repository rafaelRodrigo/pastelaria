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
        $clientData = Client::where('status',1)->paginate();
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
            $this->validation($request->all());
            try{
                $client = Client::create($request->all());
                return new ClientResource($client);
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to create client. '.$e, 'error' => 401]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],401);
        }
    }

    public function put(Request $request, int $id)
    {
        try{
            $this->validation($request->all());
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
                    throw new Exception('Error to update client',401);
                }
            }catch (Exception $e) {
                return response()->json(['message' => 'Error to create client. '.$e, 'error' => 401]);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],401);
        }
    }

    public function delete($id){
        try {
            $client = Client::findOrFail($id);
            $client->status = 0;
            if($client->save()){
                return response(null,200);
            }else{
                throw new Exception('Error to delete client',401);
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
                throw new Exception($validator->errors(),401);
            }
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],$e->getCode());
        }
    }


}
