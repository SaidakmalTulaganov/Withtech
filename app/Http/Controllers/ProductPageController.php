<?php

namespace App\Http\Controllers;

use App\Models\Characteristic;
use App\Models\FeatureSet;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $type = FeatureSet::where('id', $request->input('set_id'))->value('type');
        if ($type == 'Строка') {
            $request->validate([
                'value' => ['required', 'string', 'max:255'],
            ]);
            $newCharacteristics = Characteristic::create([
                'set_id' => $request->input('set_id'),
                'product_id' => $request->input('product_id'),
                'valuestr' => $request->input('value'),
            ]);
            if ($newCharacteristics) {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'))->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'));
            }
        } elseif ($type == 'Целое число') {
            $request->validate([
                'value' => ['required', 'integer'],
            ]);
            $newCharacteristics = Characteristic::create([
                'set_id' => $request->input('set_id'),
                'product_id' => $request->input('product_id'),
                'valueint' => $request->input('value'),
            ]);
            if ($newCharacteristics) {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'))->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'));
            }
        } elseif ($type == 'Дробное число') {
            $request->validate([
                'value' => ['required'],
            ]);
            $newCharacteristics = Characteristic::create([
                'set_id' => $request->input('set_id'),
                'product_id' => $request->input('product_id'),
                'valuedec' => $request->input('value'),
            ]);
            if ($newCharacteristics) {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'))->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'));
            }
        } elseif ($type == 'Дата-время') {
            $request->validate([
                'value' => ['required', 'datetime'],
            ]);
            $newCharacteristics = Characteristic::create([
                'set_id' => $request->input('set_id'),
                'product_id' => $request->input('product_id'),
                'valuedate' => $request->input('value'),
            ]);
            if ($newCharacteristics) {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'))->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('productsadmin.show', $request->input('shipment_id'));
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
    public function destroy($id)
    {
        //
    }
}
