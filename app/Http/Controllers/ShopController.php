<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Shop::all();
    }


    /**
     * logic the mobile phone will not be updated
     *
     */
    public function updateShop(Request $request,$id)
    {
        $rules = [
            'shop_name' => 'required',
            'app_lang' => 'required',
            'password' => 'required',
        ];
        $this->validate($request,$rules);
        $shop = Shop::find($id);

        $shop->update($request->all(['shop_name','app_lang','password']));
        return $shop;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function createShop(Request $request)
    {

        //exit("we are on the controller");
        $rules = [
            'shop_name' => 'required',
            'app_lang' => 'required',
            'password' => 'required',
            'phone_no'=>'required'
        ];
        $this->validate($request,$rules);
        //here we must verify the phone number
        return Shop::create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return Response
     */
    public function show($id)
    {

        return Shop::find($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return Response
     */
    public function destroy(Shop $shop)
    {
        //
    }


    /**
     * Display all client for a specific shop
     * @param $shopId
     * @return Response
     */
    public function showClients($shopId)
    {
        $search = $shopId;

        return Client::query()
            ->where('shop_id', 'LIKE', "{$search}")
            ->get();
    }


    /**
     * find a shop using his phone number
     * @param null $phone_no
     * @return Builder[]|Collection
     */
    public function findShopByPhone($phone_no=null)
    {

        $search = $phone_no;
        $shops = Shop::query()
            ->where('phone_no', 'LIKE', "%{$search}%")
            ->get();
        return $shops;
    }


    /**
     * display the status of a given shop
     * @param $idShop
     * @return
     */
    public  function status($idShop)
    {
        $statues = DB::select("
            select sum(amount) as amount,operations.type_operation from operations inner join clients on operations.client_id = clients.id
            and clients.shop_id = $idShop group by type_operation;");
        return $statues;

    }
}
