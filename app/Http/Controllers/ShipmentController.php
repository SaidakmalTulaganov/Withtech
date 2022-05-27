<?php

namespace App\Http\Controllers;

use App\Exports\ShipmentsExport;
use App\Exports\UsersExport;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('shipment', compact('shipments', 'suppliers', 'products'));
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
        $request->validate([
            'purchase_price' => ['required', 'integer'],
            'selling_price' => ['required', 'integer'],
            'count' => ['required', 'integer'],
        ]);
        $newShipments = Shipment::create([
            'supplier_id' => $request->input('supplier_id'),
            'product_id' => $request->input('product_id'),
            'purchase_price' => $request->input('purchase_price'),
            'selling_price' => $request->input('selling_price'),
            'count' => $request->input('count'),
            'datetime' => now(),
        ]);

        if ($newShipments) {
            return redirect()->route('shipments.index')->with('success', 'Заказ успешно оформлен');
        } else {
            return redirect()->route('shipments.index');
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
        //
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
        $delete = Shipment::where('id', $id)->delete();
        return redirect()->route('shipments.index')->with('success', 'Данные успешно удалены');
    }

    public function export(Request $request)
    {
        // dd($request->input());
        $file_name = 'shipments'.now()->toDateTimeString().'.xlsx';
        // echo $file_name;
        return Excel::download(new ShipmentsExport, $file_name);
    }
}
