<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_id = Category::where('category_name', 'Телевизоры')->value('id');
        $shipments = DB::table('shipments')
            ->leftJoin('products', 'shipments.product_id', '=', 'products.id')->where('products.category_id', $category_id)
            ->get();
        return view('tv', compact('shipments'));
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
        // echo $id;
        $category_id = Category::where('category_name', 'Телевизоры')->value('id');
        if ($id == 1) {
            $shipments = DB::table('shipments')
                ->leftJoin('products', 'shipments.product_id', '=', 'products.id')->where('products.category_id', $category_id)
                ->orderBy('selling_price', 'asc')
                ->get();
            // echo $shipments;
            return view('tv', compact('shipments'));
        } elseif ($id == 0) {
            $shipments = DB::table('shipments')
                ->leftJoin('products', 'shipments.product_id', '=', 'products.id')->where('products.category_id', $category_id)
                ->orderBy('selling_price', 'desc')
                ->get();
            // echo $shipments;
            return view('tv', compact('shipments'));
        } elseif ($id == 2) {
            $shipments = DB::table('shipments')
                ->leftJoin('products', 'shipments.product_id', '=', 'products.id')->where('products.category_id', $category_id)
                ->orderBy('product_title', 'desc')
                ->get();
            // echo $shipments;
            return view('tv', compact('shipments'));
        } elseif ($id == 3) {
            $shipments = DB::table('shipments')
                ->leftJoin('products', 'shipments.product_id', '=', 'products.id')->where('products.category_id', $category_id)
                ->orderBy('product_title', 'asc')
                ->get();
            // echo $shipments;
            return view('tv', compact('shipments'));
        }
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
