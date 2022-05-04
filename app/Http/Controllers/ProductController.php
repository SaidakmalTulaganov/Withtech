<?php

namespace App\Http\Controllers;

use App\Models\BasketProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product');
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
        //dd($request->input());
        //$count = Product::where('id', $request->input('productId'))->value('count');
        $count = Shipment::where('id', $request->input('shipment_id'))->value('count');
        $present = BasketProduct::where('user_id', Auth::id())->where('product_id', $request->input('productId'))->value('id');
        if ($count > $request->input('quantity')) {
            if ($present == null) {
                $newPositions = BasketProduct::create([
                    'user_id' => $request->input('userId'),
                    'product_id' => $request->input('productId'),
                    'quantity' => $request->input('quantity'),
                ]);
                // $updatedcount = Product::find($request->input('productId'))->update([
                //     'count' => $request->input('count') - $request->input('quantity'),
                // ]);
                $updatedcount = Shipment::find($request->input('shipment_id'))->update([
                    'count' => $request->input('count') - $request->input('quantity'),
                ]);
                if ($newPositions) {
                    return redirect()->route('products.show', $request->input('productId'))->with('success', 'Данные успешно добавлены');
                } else {
                    return redirect()->route('products.show', $request->input('productId'))->with('fail', 'Что-то пошло не так');
                }
            } else if ($present != null) {
                $quantitynow = BasketProduct::where('id', $present)->value('quantity');
                $updatedquantity = BasketProduct::find($present)->update([
                    'quantity' => $quantitynow + $request->input('quantity'),

                ]);
                // $updatedcount = Product::find($request->input('productId'))->update([
                //     'count' => $request->input('count') - $request->input('quantity'),
                // ]);
                $updatedcount = Shipment::find($request->input('shipment_id'))->update([
                    'count' => $request->input('count') - $request->input('quantity'),
                ]);
                if ($updatedquantity) {
                    return redirect()->route('products.show', $request->input('productId'))->with('success', 'Данные успешно добавлены');
                } else {
                    return redirect()->route('products.show', $request->input('productId'))->with('fail', 'Что-то пошло не так');
                }
            }
        } else {
            echo 'Столько пока нет в наличии';
        }

        // if ($newPositions) {
        //     return redirect()->route('products.show', $request->input('productId'))->with('success', 'Данные успешно добавлены');
        // } else {
        //     return redirect()->route('products.show', $request->input('productId'))->with('fail', 'Что-то пошло не так');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $products = Product::find($id);
        // dd($products);
        return view('product', compact('products'));
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
        //dd($request->input());
        $request->validate([
            // 'name' => 'required',
            // 'surname' => 'required'
        ]);

        $updatedName = Product::find($id)->update([
            'count' => $request->input('count') - BasketProduct::where('product_id', $request->input('productId'))->value('quantity'),
        ]);

        if ($updatedName) {
            return redirect()->route('products.show', $request->input('productId'))->with('success', 'Данные успешно обновлены');
        } else {
            return redirect()->route('products.show', $request->input('productId'))->with('fail', 'Что-то пошло не так');
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
        //
    }
}
