<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskType;

class TasksTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks_type = TaskType::orderBy('id')->paginate(10);
        return view('task_type.index')->with('tasks_type', $tasks_type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task_type.create');
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
            ['name.required' => 'Niste unijeli naziv tipa zahtjeva!']
        );

        $task_type = new TaskType;
        $task_type->name = $request->input('name');
        $task_type->save();

        return redirect('/tasks_type')->with('success', 'Tip zahtjeva je uspješno dodat');
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
        $task_type = TaskType::find($id);
        return view('task_type.edit')->with('task_type', $task_type);
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
            ['name.required' => 'Niste unijeli naziv tipa zahtjeva!']
        );

        $task_type = TaskType::find($id);
        $task_type->name = $request->input('name');
        $task_type->save();

        return redirect('/tasks_type')->with('success', 'Tip zahtjeva je uspješno izmijenjen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task_type = TaskType::find($id);
        $task_type->delete();

        return redirect('/tasks_type')->with('success', 'Tip zahtjeva je uspješno obrisan');
    }
}
