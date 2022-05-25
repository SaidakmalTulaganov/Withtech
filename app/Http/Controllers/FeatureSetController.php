<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeatureSet;
use Illuminate\Http\Request;

class FeatureSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = FeatureSet::get();
        $categories = Category::get();
        return view('featureset', compact('sets', 'categories'));
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
            'title' => ['required', 'string', 'max:50', 'unique:feature_sets'],
        ]);
        $newSets = FeatureSet::create([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'measure' => $request->input('measure'),
        ]);

        if ($newSets) {
            return redirect()->route('featuresets.index')->with('success', 'Заказ успешно оформлен');
        } else {
            return redirect()->route('featuresets.index');
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
        $delete = FeatureSet::where('id', $id)->delete();
        return redirect()->route('featuresets.index')->with('success', 'Данные успешно удалены');
    }
}
