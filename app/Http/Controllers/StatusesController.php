<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::orderBy('id')->paginate(10);
        return view('status.index')->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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
            ['name.required' => 'Niste unijeli naziv statusa!']
        );

        $status = new Status;
        $status->name = $request->input('name');
        $status->save();

        return redirect('/statuses')->with('success', 'Status je uspješno dodat!');
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
        $status = Status::find($id);
        return view('status.edit')->with('status', $status);
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
            ['name.required' => 'Niste unijeli naziv statusa!']
        );

        $status = Status::find($id);
        $status->name = $request->input('name');
        $status->save();

        return redirect('/statuses')->with('success', 'Status je uspješno izmijenjen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();

        return redirect('/statuses')->with('success', 'Status je uspješno obrisan!');
    }
}
