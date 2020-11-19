<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelCreateTask;

class ModelCreateTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model_create_tasks = ModelCreateTask::orderBy('id')->paginate(10);
        return view('model_create_task.index')->with('model_create_tasks', $model_create_tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('model_create_task.create');
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
            ['name.required' => 'Niste unijeli naziv načina kreiranja zahtjeva!']
        );

        $model_create_task = new ModelCreateTask;
        $model_create_task->name = $request->input('name');
        $model_create_task->save();

        return redirect('/model_create_tasks')->with('success', 'Način kreiranja zahtjeva je uspješno dodat');
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
        $model_create_task = ModelCreateTask::find($id);
        return view('model_create_task.edit')->with('model_create_task', $model_create_task);
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
            ['name.required' => 'Niste unijeli naziv načina kreiranja zahtjeva!']
        );

        $model_create_task = ModelCreateTask::find($id);
        $model_create_task->name = $request->input('name');
        $model_create_task->save();

        return redirect('/model_create_tasks')->with('success', 'Način kreiranja zahtjeva zahtjeva je uspješno izmijenjen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model_create_task = ModelCreateTask::find($id);
        $model_create_task->delete();

        return redirect('/model_create_tasks')->with('success', 'Način kreiranja zahtjeva je uspješno obrisan');
    }
}
