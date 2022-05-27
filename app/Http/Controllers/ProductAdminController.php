<?php

namespace App\Http\Controllers;

use App\Models\AirConditioner;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Dishwasher;
use App\Models\ElectricStove;
use App\Models\FeatureSet;
use App\Models\Flatiron;
use App\Models\Manufacturer;
use App\Models\Microwave;
use App\Models\Product;
use App\Models\Refrigerator;
use App\Models\Shipment;
use App\Models\TelevisionSet;
use App\Models\VacuumCleaner;
use App\Models\Washer;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $categories = Category::get();
        $manufacturers = Manufacturer::get();
        $shipments = Shipment::get();
        return view('productadmin', compact('products', 'categories', 'manufacturers', 'shipments'));
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
        $request->validate([
            'product_title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'product_image' => ['required', 'string', 'max:100'],
            'percent' => ['required', 'integer'],
        ]);
        $newProducts = Product::create([
            'category_id' => $request->input('category_id'),
            'manufacturer_id' => $request->input('manufacturer_id'),
            'product_title' => $request->input('product_title'),
            'bonus_pencent' => $request->input('percent'),
            'description' => $request->input('description'),
            'product_image' => $request->input('product_image'),
        ]);

        if ($newProducts) {
            return redirect()->route('productsadmin.index')->with('success', 'Заказ успешно оформлен');
        } else {
            return redirect()->route('productsadmin.index');
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
        $shipments = Shipment::find($id);
        $product_id = Shipment::where('id', $id)->value('product_id');
        $products = Product::find($product_id);
        $category_id = Product::where('id', $product_id)->value('category_id');
        $sets = FeatureSet::where('category_id', $category_id)->get();
        $characteristics = Characteristic::where('product_id', $product_id)->get();
        return view('productpage', compact('products', 'shipments', 'sets', 'characteristics'));
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
