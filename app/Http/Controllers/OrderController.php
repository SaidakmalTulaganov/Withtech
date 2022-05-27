<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\BasketProduct;
use App\Models\Bonus;
use App\Models\OrderSet;
use App\Models\OrderValue;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->value('bonus');
        return view('order', compact('user'));
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
        $baskets = BasketProduct::where('user_id', Auth::id())->get();
        $price = 0;
        foreach ($baskets as $basket) {
            $price += $basket->price;
        }
        if ($request->input('yes_or_no') == 'Да') {
            $present_bonus = User::where('id', Auth::id())->value('bonus');
            $percent_of_price = $price * 0.2;
            if ($percent_of_price >= $present_bonus) {
                $price = $price - $present_bonus;
                $newOrder_set = OrderSet::create([
                    'user_id' => Auth::id(),
                    'order_datetime' => now(),
                    'state_id' => '1',
                    'payment_type' => $request->input('paymentType'),
                    'delivery_address' => $request->input('delivery_address'),
                    'order_price' => $price,
                ]);
                $set_id = OrderSet::where('user_id', Auth::id())->where('order_datetime', now())
                    ->where('state_id', '1')
                    ->where('payment_type', $request->input('paymentType'))
                    ->where('delivery_address', $request->input('delivery_address'))
                    ->where('order_price', $price)
                    ->value('id');
                foreach ($baskets as $basket) {
                    $newOrder_value = OrderValue::create([
                        'set_id' => $set_id,
                        'product_id' => $basket->product_id,
                        'quantity' => $basket->quantity,
                        'price' => $basket->price,
                    ]);
                }
                $newBonus_value = Bonus::create([
                    'user_id' => Auth::id(),
                    'set_id' => $set_id,
                    'values' => -$present_bonus,
                ]);
                $updatedbonus = User::find(Auth::id())->update([
                    'bonus' => 0,
                ]);
                $delete = BasketProduct::where('user_id', Auth::id())->delete();
                if ($newBonus_value) {
                    return redirect()->route('home')->with('success', 'Заказ успешно оформлен');
                } else {
                    return redirect()->route('home')->with('fail', 'Что-то пошло не так');
                }
            } elseif ($percent_of_price < $present_bonus) {
                $price = $price - $percent_of_price;
                $newOrder_set = OrderSet::create([
                    'user_id' => Auth::id(),
                    'order_datetime' => now(),
                    'state_id' => '1',
                    'payment_type' => $request->input('paymentType'),
                    'delivery_address' => $request->input('delivery_address'),
                    'order_price' => $price,
                ]);
                $set_id = OrderSet::where('user_id', Auth::id())->where('order_datetime', now())
                    ->where('state_id', '1')
                    ->where('payment_type', $request->input('paymentType'))
                    ->where('delivery_address', $request->input('delivery_address'))
                    ->where('order_price', $price)
                    ->value('id');
                foreach ($baskets as $basket) {
                    $newOrder_value = OrderValue::create([
                        'set_id' => $set_id,
                        'product_id' => $basket->product_id,
                        'quantity' => $basket->quantity,
                        'price' => $basket->price,
                    ]);
                }
                $newBonus_value = Bonus::create([
                    'user_id' => Auth::id(),
                    'set_id' => $set_id,
                    'values' => -$percent_of_price,
                ]);
                $updatedbonus = User::find(Auth::id())->update([
                    'bonus' => $present_bonus - $percent_of_price,
                ]);
                $delete = BasketProduct::where('user_id', Auth::id())->delete();
                if ($newBonus_value) {
                    return redirect()->route('home')->with('success', 'Заказ успешно оформлен');
                } else {
                    return redirect()->route('home')->with('fail', 'Что-то пошло не так');
                }
            }
        } elseif ($request->input('yes_or_no') == 'Нет') {
            $newOrder_set = OrderSet::create([
                'user_id' => Auth::id(),
                'order_datetime' => now(),
                'state_id' => '1',
                'payment_type' => $request->input('paymentType'),
                'delivery_address' => $request->input('delivery_address'),
                'order_price' => $price,
            ]);
            $bonus = $price * 0.02;
            $set_id = OrderSet::where('user_id', Auth::id())->where('order_datetime', now())
                ->where('state_id', '1')
                ->where('payment_type', $request->input('paymentType'))
                ->where('delivery_address', $request->input('delivery_address'))
                ->where('order_price', $price)
                ->value('id');
            foreach ($baskets as $basket) {
                $newOrder_value = OrderValue::create([
                    'set_id' => $set_id,
                    'product_id' => $basket->product_id,
                    'quantity' => $basket->quantity,
                    'price' => $basket->price,
                ]);
            }
            $newBonus_value = Bonus::create([
                'user_id' => Auth::id(),
                'set_id' => $set_id,
                'values' => +$bonus,
            ]);
            $delete = BasketProduct::where('user_id', Auth::id())->delete();
            $present_bonus = User::where('id', Auth::id())->value('bonus');
            if ($present_bonus == null) {
                $updatedbonus = User::find(Auth::id())->update([
                    'bonus' => $bonus,
                ]);
            } elseif ($present_bonus != null) {
                $updatedbonus = User::find(Auth::id())->update([
                    'bonus' => $bonus + $present_bonus,
                ]);
            }
            if ($newBonus_value) {
                return redirect()->route('home')->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('home')->with('fail', 'Что-то пошло не так');
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'delivery_address' => ['required', 'string'],
        ]);
    }
}
