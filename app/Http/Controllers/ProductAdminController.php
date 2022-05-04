<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Refrigerator;
use App\Models\Shipment;
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
        $request->validate([
            'product_title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'product_image' => ['required', 'string', 'max:100'],
        ]);
        $newProducts = Product::create([
            'category_id' => $request->input('category_id'),
            'manufacturer_id' => $request->input('manufacturer_id'),
            'shipment_id' => $request->input('shipment_id'),
            'product_title' => $request->input('product_title'),
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
        $products = Product::find($id);
        $category_id = Product::where('id', $id)->value('category_id');
        $category_name = Category::where('id', $category_id)->value('category_name');
        if ($category_name == 'Холодильники') {
            $characteristics = Refrigerator::where('product_id', $id)->get();
            return view('refrigerator', compact('products', 'characteristics'));
        } elseif ($category_name == 'Стиральные машины') {
        } elseif ($category_name == 'Электрические плиты') {
        } elseif ($category_name == 'Посудомоечные машины') {
        } elseif ($category_name == 'Кондиционеры') {
        } elseif ($category_name == 'Телевизоры') {
        } elseif ($category_name == 'Утюги') {
        } elseif ($category_name == 'Пылесосы') {
        } elseif ($category_name == 'Микроволновые печи') {
        }
        return view('productinformation', compact('products'));
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
