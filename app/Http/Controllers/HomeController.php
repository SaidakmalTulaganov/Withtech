<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::get();
        $shipments = Shipment::get();
        $categories = Category::get();
        $manufacturers = Manufacturer::get();
        return view('home', compact('products', 'shipments', 'categories', 'manufacturers'));
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

    public function search()
    {
        $res = htmlspecialchars($_GET['search']);
        $products = Product::where('description', 'like', '%' . $res . '%')->get();
        return view('home', compact('products'));
    }
}
