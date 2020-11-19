<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResponsibleUser;
use App\User;
use App\UserType;
use DB;

class ResponsibleUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsible_users = ResponsibleUser::orderBy('id')->paginate(10);
        return view('responsible_user.index')->with('responsible_users', $responsible_users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::select
                ("SELECT * FROM podrska.users 
                WHERE role = '1' 
                AND id not in (
                    SELECT user_id 
                    FROM podrska.responsible_users
                )");

        $users_type = UserType::orderBy('name')->get();

        $data = [
            'users' => $users,
            'users_type' => $users_type
        ];

        return view('responsible_user.create')->with($data);
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
            [
                'user_id' => 'required',
                'user_type_id' => 'required'
            ],
            [
                'user_id.required' => 'Niste unijeli korisnika!',
                'user_type_id.required' => 'Niste unijeli tip korisnika!',
            ]
        );

        $responsible_user = new ResponsibleUser;
        $responsible_user->user_id = $request->input('user_id');
        $responsible_user->user_type_id = $request->input('user_type_id');
        $responsible_user->save();

        return redirect('/responsible_users')->with('success', 'Odgovorna osoba je uspješno dodata!');
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
        $responsible_user = ResponsibleUser::find($id);
        $users = DB::select
                ("SELECT * FROM podrska.users 
                  WHERE role = '1' ");
        $users_type = UserType::orderBy('name')->get();

        $data = [
            'responsible_user' => $responsible_user,
            'users' => $users,
            'users_type' => $users_type
        ];

        return view('responsible_user.edit')->with($data);
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
            [
                'user_id' => 'required',
                'user_type_id' => 'required'
            ],
            [
                'user_id.required' => 'Niste unijeli korisnika!',
                'user_type_id.required' => 'Niste unijeli tip korisnika!',
            ]
        );

        $responsible_user = ResponsibleUser::find($id);
        $responsible_user->user_id = $request->input('user_id');
        $responsible_user->user_type_id = $request->input('user_type_id');
        $responsible_user->save();

        return redirect('/responsible_users')->with('success', 'Odgovorna osoba je uspješno izmijenjena!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responsible_user = ResponsibleUser::find($id);
        $responsible_user->delete();

        return redirect('/responsible_users')->with('success', 'Odgovorna osoba je uspješno obrisana!');
    }
}
