<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasketProduct;
use App\Models\Product;
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
        $basketProducts = BasketProduct::where('user_id', $id)->get();
        // dd($basketProducts);
        return view('basket', compact('basketProducts'));
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
    public function store(Request $request, $id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Product::where('id', $id)->value('count');
        $quantity = BasketProduct::where('product_id', $id)->value('quantity');
        $updatedcount = Product::find($id)->update([
            'count' => $count + $quantity,
        ]);
        $delete = BasketProduct::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return redirect()->route('basketProducts.index')->with('success', 'Данные успешно удалены');
    }
}
