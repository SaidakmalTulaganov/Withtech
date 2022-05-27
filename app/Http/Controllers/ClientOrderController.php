<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderSet;
use App\Models\OrderValue;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_sets = OrderSet::where('user_id', Auth::id())->get();
        return view('clientorder', compact('order_sets'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_values = DB::table('order_values')
            ->leftJoin('order_sets', 'order_values.set_id', '=', 'order_sets.id')
            ->leftJoin('products', 'order_values.product_id', '=', 'products.id')
            // ->leftJoin('states', 'order_values.state_id', '=', 'states.id')
            ->where('user_id', Auth::id())
            ->where('set_id', $id)
            ->get();
        $state_id = OrderSet::where('id', $id)->value('state_id');
        $state_title = State::where('id', $state_id)->value('title');
        return view('clientordervalues', compact('order_values', 'state_title'));
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
        //
    }

    public function Search()
    {
        $res = htmlspecialchars($_GET['search']);
        $orders = DB::table('orders')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')->where('description', 'like', '%' . $res . '%')
            ->get();
        return view('clientorder', compact('orders'));
    }
}
