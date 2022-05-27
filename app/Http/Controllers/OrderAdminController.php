<?php

namespace App\Http\Controllers;

use App\Models\OrderSet;
use App\Models\OrderValue;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersAdminExport;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_sets = OrderSet::get();
        $order_values = OrderValue::get();
        $states = State::get();
        return view('orderadmin', compact('order_sets', 'order_values', 'states'));
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
            ->where('set_id', $id)
            ->get();
        return view('adminordervalues', compact('order_values'));
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
        echo $request->input('state_id');
        $updatedstate = OrderSet::where('id', $id)->update([
            'state_id' => $request->input('state_id'),
        ]);
        return redirect()->route('ordersadmin.index')->with('success', 'Данные успешно удалены');
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

    public function export(Request $request)
    {
        // dd($request->input());
        $file_name = 'Отчет по заказам за '.now()->toDateString().'.xlsx';
        // echo $file_name;
        return Excel::download(new OrdersAdminExport, $file_name);
    }
}
