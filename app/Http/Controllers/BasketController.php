<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasketProduct;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $product_id = BasketProduct::where('user_id', $id)->value('product_id');
        $shipments = Shipment::where('product_id', $product_id)->get();
        $basketProducts = BasketProduct::where('user_id', $id)->get();
        return view('basket', compact('shipments', 'basketProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Shipment::where('id', $request->input('shipment_id'))->value('count');
        $product_price = Shipment::where('id', $request->input('shipment_id'))->value('selling_price');
        $present = BasketProduct::where('user_id', Auth::id())->where('product_id', $request->input('productId'))->value('id');
        if ($count > $request->input('quantity')) {
            if ($present == null) {
                $newPositions = BasketProduct::create([
                    'user_id' => $request->input('userId'),
                    'product_id' => $request->input('productId'),
                    'quantity' => $request->input('quantity'),
                    'price' => $request->input('quantity') * $product_price,
                ]);
                $updatedcount = Shipment::find($request->input('shipment_id'))->update([
                    'count' => $request->input('count') - $request->input('quantity'),
                ]);
                if ($newPositions) {
                    return redirect()->route('products.show', $request->input('shipment_id'))->with('success', 'Данные успешно добавлены');
                } else {
                    return redirect()->route('products.show', $request->input('shipment_id'))->with('fail', 'Что-то пошло не так');
                }
            } else if ($present != null) {
                $quantitynow = BasketProduct::where('id', $present)->value('quantity');
                $pricenow = BasketProduct::where('id', $present)->value('price');
                $updatedquantity = BasketProduct::find($present)->update([
                    'quantity' => $quantitynow + $request->input('quantity'),
                    'price' => $pricenow + $request->input('quantity') * $product_price,

                ]);
                $updatedcount = Shipment::find($request->input('shipment_id'))->update([
                    'count' => $request->input('count') - $request->input('quantity'),
                ]);
                if ($updatedquantity) {
                    return redirect()->route('products.show', $request->input('shipment_id'))->with('success', 'Данные успешно добавлены');
                } else {
                    return redirect()->route('products.show', $request->input('shipment_id'))->with('fail', 'Что-то пошло не так');
                }
            }
        } else {
            echo 'Столько пока нет в наличии';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->input());
        // echo $id;
        if ($request->input('count') == '-') {
            $quantitynow = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('quantity');
            if ($quantitynow == 1) {
                $shipment_id = Shipment::where('product_id', $id)->value('id');
                $count = Shipment::where('id', $shipment_id)->value('count');
                $quantity = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('quantity');
                $updatedcount = Shipment::find($shipment_id)->update([
                    'count' => $count + $quantity,
                ]);
                $delete = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->delete();
                return redirect()->route('basketProducts.index')->with('success', 'Данные успешно удалены');
            } elseif ($quantitynow > 1) {
                $shipment_id = Shipment::where('product_id', $id)->value('id');
                $count = Shipment::where('id', $shipment_id)->value('count');
                $price = Shipment::where('id', $shipment_id)->value('price');
                $quantity = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('quantity');
                $pricenow = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('price');
                $updatedquantity = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->update([
                    'quantity' => $quantity - 1,
                    'price' => $pricenow - $price,

                ]);
                $updatedcount = Shipment::find($shipment_id)->update([
                    'count' => $count + 1,
                ]);
                return redirect()->route('basketProducts.index')->with('success', 'Данные успешно удалены');
            }
        } elseif ($request->input('count') == '+') {
            $shipment_id = Shipment::where('product_id', $id)->value('id');
            $count = Shipment::where('id', $shipment_id)->value('count');
            if ($count == 0) {
                echo 'Столько пока нет в наличии';
            } elseif ($count > 0) {
                $price = Shipment::where('id', $shipment_id)->value('price');
                $quantity = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('quantity');
                $pricenow = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('price');
                $updatedquantity = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->update([
                    'quantity' => $quantity + 1,
                    'price' => $pricenow + $price,

                ]);
                $updatedcount = Shipment::find($shipment_id)->update([
                    'count' => $count - 1,
                ]);
                return redirect()->route('basketProducts.index')->with('success', 'Данные успешно удалены');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment_id = Shipment::where('product_id', $id)->value('id');
        $count = Shipment::where('id', $shipment_id)->value('count');
        $quantity = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->value('quantity');
        $updatedcount = Shipment::find($shipment_id)->update([
            'count' => $count + $quantity,
        ]);
        $delete = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return redirect()->route('basketProducts.index')->with('success', 'Данные успешно удалены');
    }
}
