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
    public function index(Request $request)
    {
        // dd($request->input());
        $supplier = $request->input('supplier');
        if ($supplier != null) {
            $supplier_id = Supplier::where('supplier_title', $supplier)->value('id');
            // echo $supplier_id;
            $shipments = Shipment::where('supplier_id', $supplier_id)->get();
            $suppliers = Supplier::get();
            $products = Product::get();
            return view('shipment', compact('shipments', 'suppliers', 'products'));
        } else {
            $shipments = Shipment::get();
            $suppliers = Supplier::get();
            $products = Product::get();
            return view('shipment', compact('shipments', 'suppliers', 'products'));
        }
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
        // dd($request->input());
        $insert = $request->input('insert');
        if ($insert == 'Поставщик') {
            $request->validate([
                'supplier_title' => ['required', 'string', 'max:50', 'unique:suppliers'],
            ]);
            $newSuppliers = Supplier::create([
                'supplier_title' => $request->input('supplier_title'),
            ]);

            if ($newSuppliers) {
                return redirect()->route('shipments.index')->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('shipments.index');
            }
        } elseif ($insert == 'Партия') {
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
    public function destroy(Request $request, $id)
    {
        $delete = $request->input('delete');
        if ($delete == 'Удалить поставщика') {
            $delete_shipment = Shipment::where('supplier_id', $id)->delete();
            $delete_supplier = Supplier::where('id', $id)->delete();
            return redirect()->route('shipments.index')->with('success', 'Данные успешно удалены');
        } elseif ($delete == 'Удалить партию') {
            $delete_shipment = Shipment::where('id', $id)->delete();
            return redirect()->route('shipments.index')->with('success', 'Данные успешно удалены');
        }
    }

    public function export(Request $request)
    {
        // dd($request->input());
        $file_name = 'Отчет по партиям за ' . now()->toDateString() . '.xlsx';
        // echo $file_name;
        return Excel::download(new ShipmentsExport, $file_name);
    }
}
