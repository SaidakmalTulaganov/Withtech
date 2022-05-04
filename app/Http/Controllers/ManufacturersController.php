<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::get();
        return view('manufacturer', compact('manufacturers'));
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
        $request->validate([
            'manufacturer_name' => ['required', 'string', 'max:50', 'unique:manufacturers'],
        ]);

        $newManufacturers = Manufacturer::create([
            'manufacturer_name' => $request->input('manufacturer_name'),
        ]);

        if ($newManufacturers) {
            return redirect()->route('manufacturers.index')->with('success', 'Заказ успешно оформлен');
        } else {
            return redirect()->route('manufacturers.index')->with('fail', 'Что-то пошло не так');
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
        $products = Product::where('manufacturer_id', $id)->get();
        return view('productadmin', compact('products'));
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
        $delete = Manufacturer::where('id', $id)->delete();
        return redirect()->route('manufacturers.index')->with('success', 'Данные успешно удалены');
    }
}
