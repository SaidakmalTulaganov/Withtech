<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->input());
        $type = $request->input('type');
        if ($type == 'Администраторы') {
            $type_id = UserType::where('type_title', 'Администратор')->value('id');
            // echo $type_id;
            $users = User::where('type_id', $type_id)->get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
        } elseif ($type == 'Бухгалтеры') {
            $type_id = UserType::where('type_title', 'Бухгалтер')->value('id');
            // echo $type_id;
            $users = User::where('type_id', $type_id)->get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
        } elseif ($type == 'Кладовщики') {
            $type_id = UserType::where('type_title', 'Кладовщик')->value('id');
            // echo $type_id;
            $users = User::where('type_id', $type_id)->get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
        } elseif ($type == 'Курьеры') {
            $type_id = UserType::where('type_title', 'Курьер')->value('id');
            // echo $type_id;
            $users = User::where('type_id', $type_id)->get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
        } elseif ($type == 'Директор') {
            $type_id = UserType::where('type_title', 'Директор')->value('id');
            // echo $type_id;
            $users = User::where('type_id', $type_id)->get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
        } elseif ($type == 'Клиенты') {
            $type_id = UserType::where('type_title', 'Клиент')->value('id');
            // echo $type_id;
            $users = User::where('type_id', $type_id)->get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
        } else {
            $users = User::get();
            $users_types = UserType::get();
            return view('users', compact('users', 'users_types'));
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
        if ($insert == 'Тип') {
            $request->validate([
                'type_title' => ['required', 'string', 'max:50', 'unique:user_types'],
            ]);
            $newTypes = UserType::create([
                'type_title' => $request->input('type_title'),
            ]);

            if ($newTypes) {
                return redirect()->route('users.index')->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('users.index');
            }
        } elseif ($insert == 'Пользователь') {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'surname' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed', 'unique:users'],
                'phone' => ['required', 'string', 'max:12', 'unique:users'],
            ]);
            $newUsers = User::create([
                'name' => $request->input('name'),
                'type_id' => $request->input('type_id'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'surname' => $request->input('surname'),
                'phone' => $request->input('phone'),
                // 'bonus' => '',
            ]);

            if ($newUsers) {
                return redirect()->route('users.index')->with('success', 'Заказ успешно оформлен');
            } else {
                return redirect()->route('users.index');
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
        // dd($request->input());
        $delete = $request->input('delete');
        if ($delete == 'Удалить тип') {
            $delete_type = UserType::where('id', $id)->delete();
            return redirect()->route('users.index')->with('success', 'Данные успешно удалены');
        }
    }
}
