<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Float_;



class ClientController  extends Controller
{

    /**
     * display all operation for a specific client
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function allOperations($id)
    {
        $operations = Client::find($id)->operations;

        //exit();

        $sortie  =  0.0;
        $entree =  0.0;

        foreach ($operations as $operation)
        {
            if($operation['type_operation']=='sortie')
            {
                $sortie = doubleval($sortie)+doubleval($operation['amount']);
                echo $sortie."!!!";
            }elseif ($operation['type_operation']=='entree')
            {
                $entree+= doubleval($operation['amount']);
            }
        }
        //echo "471.09"+"9777.89"+"1214.07"+"9607.1"+"573.96"+"6407.77"+"9138.42"+"6320.77"+"2418.78";
        //exit();
        return response()->json(
            [
                "message"=>"clients list",
                "data"=>
                    [
                        "operations"=>$operations,
                        "sortie"=>doubleval($sortie),
                        "entree"=> $entree
                    ]
            ],200);
    }

    /**
     * create a new client
     * logic we need to check(validate) the phone number
     * @param Request $request
     * @return
     * @throws ValidationException
     */
    public function addClient(Request $request)
    {

        $rules = [
            'shop_id' => 'required|numeric|exists:shopsa,id',
            'client_name' => 'required',
            'client_phone_no' => 'required',
        ];

        $this->validate($request, $rules);
        return Client::create($request->all());


    }

    /**
     * display all clients
     */
    public function displayAll()
    {

        return Client::all();
    }


    /**
     * find a client using his name
     * @param Request $request
     * @return Client[]|Collection
     * @throws ValidationException
     */
    public function findClient(Request $request)
    {
        // $client = DB::table('clients')->where('client_name')->value('Dino');
        //$client = Client::whereLike('client_name')->get();
        //return $client;
        //var_dump($client);

        $rules = [
            'client_name' => 'nullable',
        ];
        $this->validate($request, $rules);


        // Get the search value from the request
        $search = $request->get('client_name');

        // Search in the title and body columns from the posts table
        $clients = Client::query()
            ->where('client_name', 'LIKE', "%{$search}%")
            ->get();
        return $clients;
    }


    public function deleteClient($id)
    {
        $client = Client::find($id);
        if($client!=null)
        {
            return  $client->delete();
        }else
        {
            return response()->json(
                [
                    "message"=>"client not found",
                ],404);
        }
    }


    //display all client's info
    public function clientInfos($id)
    {

        $client = Client::find($id);

        if($client!=null)
        {
            return  $client;
        }else
        {
            return response()->json(
                [
                    "message"=>"client not found",
                ],404);
        }

    }

}
