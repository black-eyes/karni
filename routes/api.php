<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OperationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//must be used from the super user
//allow to the super user to display all shops account
//this root is just for the super user
Route::get("shops",[ShopController::class,'index']);



//must be used from the super user  op a normal user to show his profile
//allow to the super user to display single shop info or a single user to display his profile or a user with
// multiple shops to see his shops
Route::get("shop/{id}",[ShopController::class,'show']);


//Display all client for a specific shop
Route::get("shop/{id}",[ShopController::class,'showClients']);


//#Client

//create a new client
Route::post("client/add",[ClientController::class,'addClient']);

//get all clients
Route::get("clients/",[ClientController::class,'displayAll']);

//find a client using his name
Route::get("client/",[ClientController::class,'findClient']);

//delete a client
Route::delete("client/{id}",[ClientController::class,'deleteClient']);

//display client info
Route::get("client/{id}",[ClientController::class,'clientInfos']);

//Display all operation for a specific client
Route::get("client/{id}/all",[ClientController::class,'allOperations']);


//#operations
// create operation for a client
Route::post("operation/add",[OperationController::class,'addOperation']);

//update  operation
Route::put("operation/{id}/update",[OperationController::class,'updateOperation']);

//delete  operation
Route::delete("operation/{id}/delete",[OperationController::class,'deleteOperation']);






Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
