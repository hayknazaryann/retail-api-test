<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Log;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProductPriceItem;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;
use RetailCrm\Api\Model\Filter\Store\ProductFilterType;
use RetailCrm\Api\Model\Request\Store\ProductPropertiesRequest;
use RetailCrm\Api\Model\Request\Store\ProductsRequest;
use RetailCrm\Api\Model\Request\Users\UsersRequest;

class OrderController extends Controller
{

    private  $client;

    public function __construct()
    {
        $this->client = SimpleClientFactory::createClient(config('app.retail.domain'), config('app.retail.api_key'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $client = $this->client;
        try {

            $order_data = [
                'status' => 'trouble',
                'orderType' => 'fizik',
                'orderMethod' => 'test',
                'marketplace' => 'test',
                'number' => 15061996,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'patronymic' => $request->patronymic,
                'customerComment' => $request->comment
            ];
            $product_request = new ProductsRequest();
            $product_request->filter = new ProductFilterType();
            $product_request->filter->name = $request->article;
            $product_request->filter->manufacturer = $request->brand;
            $products_data = $client->store->products($product_request);
            $product = !empty($products_data->products) ? $products_data->products[0] : null;
            $offer = $product ? $product->offers[0] : null;
            if($offer){
                $order_data['items']['offer']['id'] = $offer->id;
            }
            $order_request = new OrdersCreateRequest();
            $order_request->site = 'superposuda';
            $order_request->order = $order_data;
            $response = $client->orders->create($order_request);
            if ($response->success){
                return redirect()->back()->with('success','Ваш заказ успешно создан!');
            }
            return redirect()->back()->with('error','Ваш заказ не создан!');
        } catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
            dd($exception->getMessage());
            Log::error($exception->getMessage());
            return redirect()->back()->with('error','Что-то пощло не так!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
