<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserType;

class UsersTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_type = UserType::orderBy('id')->paginate(10);
        return view('user_type.index')->with('users_type', $users_type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
                ['name' => 'required'],
            ['name.required' => 'Niste unijeli naziv tipa korisnika!']
        );

        $user_type = new UserType;
        $user_type->name = $request->input('name');
        $user_type->save();

        return redirect('/users_type')->with('success', 'Tip korisnika je uspješno dodat');
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
        $user_type = UserType::find($id);
        return view('user_type.edit')->with('user_type', $user_type);
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
        $this->validate($request, 
                ['name' => 'required'],
            ['name.required' => 'Niste unijeli naziv tipa korisnika!']
        );

        $user_type = UserType::find($id);
        $user_type->name = $request->input('name');
        $user_type->save();

        return redirect('/users_type')->with('success', 'Tip korisnika je uspješno izmijenjen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_type = UserType::find($id);
        $user_type->delete();

        return redirect('/users_type')->with('success', 'Tip korisnika je uspješno obrisan');
    }
}
