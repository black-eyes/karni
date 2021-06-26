<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Operation;
use Illuminate\Validation\ValidationException;

class OperationController extends Controller
{

    //$client_id,$type_operation,$note_operation,$amount,$date_operation=null,$image_operation=null
    /**
     * add operation for a client
     * @param Request $request
     * @return Operation
     * @throws ValidationException
     */
    public function addOperation(Request $request)
    {
        $rules = [
            'client_id' => 'required|numeric|exists:clients,id',
            'type_operation' => 'in:entree,sortie',
            'note_operation' => 'nullable',
            'amount' => 'required|numeric',
            'date_operation' => 'date|nullable',
            'image_operation' => 'nullable',
        ];

        $customMessages = [
            'in' => 'The :attribute must be one of the following types: :values'
        ];

        $this->validate($request, $rules, $customMessages);
         return Operation::create($request->all());

        /*
        $validated = $request->validate([
            'client_id' => 'required|numeric|exists:clients,id',
            'type_operation' => 'in:entree,sortie',
            'note_operation' => 'nullable',
            'amount' => 'required|numeric',
            'date_operation' => 'date|nullable',
            'image_operation' => 'nullable',
        ]);
*/
    }



    //update a specific operation
    public function updateOperation(Request $request,$id)
    {

        //'client_id' => 'required|numeric|exists:clients,id',
        $operation = Operation::find($id);
        $rules = [
            'type_operation' => 'in:entree,sortie',
            'note_operation' => 'nullable',
            'amount' => 'required|numeric',
            'date_operation' => 'date|nullable',
            'image_operation' => 'nullable',
        ];

        $customMessages = [
            'in' => 'The :attribute must be one of the following types: :values'
        ];


        $this->validate($request, $rules, $customMessages);
        $operation->update($request->all());

        return $operation;
    }


    public function deleteOperation($id)
    {
        $operation = Operation::find($id);
        if($operation!=null)
        {
            return  $operation->delete();
        }else
            {
                return response()->json(
                    [
                        "message"=>"operation not found",
                    ],404);
            }






    }


}
