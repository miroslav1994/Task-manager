<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Company;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy("name")->get();
        return view("user.create")->with('companies', $companies);
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
                'name' => 'required',
                'photo' => 'image|nullable|max:1999',
                'email' => 'required',
                'password' => 'required',
                'company_id' => 'required',
                'role' => 'required'
            ],
            [
            'name.required' => 'Niste unijeli naziv korisnika!',
            'email.required' => 'Niste unijeli email korisnika!',
            'password.required' => 'Niste unijeli lozinku korisnika!',
            'company_id.required' => 'Niste unijeli preduzeće kom korisnik pripada!',
            'role.required' => 'Niste unijeli tip korisnika!',
            'photo.image' => 'Fajl mora biti slika!'
            ]
        );

        if($request->hasFile('photo')) {

            //Get filename with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image 
            $path = $request->file('photo')->storeAs('public/user_photos', $filenameToStore);

        } else {
            $filenameToStore = 'noimage.png';
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $user->email = $request->input('email');
        $user->company_id = $request->input('company_id');
        $user->photo = $filenameToStore;;
        $user->role = $request->input('role');
        if($user->password == $confirm_password) {
            $user->password = bcrypt($user->password);
            $user->save();
            return redirect('/users')->with('success', 'Korisnik je uspješno dodat');
        } else {
            return redirect('/users/create')->with('error', 'Lozinka i potvrda lozinke moraju biti iste!');
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
        $user = User::find($id);
        $companies = Company::orderBy("name")->get();
        $data = [
            'user' => $user,
            'companies' => $companies
        ];
        return view("user.edit")->with($data);
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
                'name' => 'required',
                'photo' => 'image|nullable|max:1999',
                'email' => 'required',
                'password' => 'required',
                'company_id' => 'required',
                'role' => 'required'
            ],
            [
                'name.required' => 'Niste unijeli naziv korisnika!',
                'email.required' => 'Niste unijeli email korisnika!',
                'password.required' => 'Niste unijeli lozinku korisnika!',
                'company_id.required' => 'Niste unijeli preduzeće kom korisnik pripada!',
                'role.required' => 'Niste unijeli tip korisnika!',
                'photo.image' => 'Fajl mora biti slika!'
            ]
        );
        $filenameToStore = '';
        if($request->hasFile('photo')) {
            //Get filename with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image 
            $path = $request->file('photo')->storeAs('public/user_photos', $filenameToStore);
        } else if($request->input('current_photo') != '') {$filenameToStore = $request->input('current_photo');}
       
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $user->email = $request->input('email');
        $user->company_id = $request->input('company_id');
        $user->photo = $filenameToStore;
        $user->role = $request->input('role');
        if($user->password == $confirm_password) {
            $user->save();
            return redirect('/users')->with('success', 'Korisnik je uspješno izmijenjen');
        } else {
            return redirect('/users/' . $user->id . '/edit')->with('error', 'Lozinka i potvrda lozinke moraju biti iste!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->photo != 'noimage.png') {
            //Delete the image
            Storage::delete("/public/user_photos/' . $user->photo");
        }
        $user->delete();
        return redirect('/users')->with('success', 'Korisnik je uspješno obrisan');
    }
}
