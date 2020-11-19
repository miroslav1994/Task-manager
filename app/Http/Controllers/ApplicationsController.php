<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\ResponsibleUser;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::orderBy('id')->paginate(10);
        return view('application.index')->with('applications', $applications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsible_users = ResponsibleUser::where("user_type_id", "=", "3")->orderBy('id')->get();
        $implementers = ResponsibleUser::where("user_type_id", "=", "4")->orderBy('id')->get();
        $data = [
            'responsible_users' => $responsible_users,
            'implementers' => $implementers
        ];
        return view('application.create')->with($data);
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
                'responsible_user_id' => 'required',
                'implementer_id' => 'required'
            ],
            [
                'name.required' => 'Niste unijeli naziv aplikacije!',
                'responsible_user_id.required' => 'Niste unijeli odgovornu osobu!',
                'implementer_id.required' => 'Niste unijeli implementatora!',
            ]
        );

        $application = new Application;
        $application->name = $request->input('name');
        $application->responsible_user_id = $request->input('responsible_user_id');
        $application->implementer_id = $request->input('implementer_id');
        $application->save();

        return redirect('/applications')->with('success', 'Aplikacija je uspješno dodata!');
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
        $responsible_users = ResponsibleUser::where("user_type_id", "=", "3")->orderBy('id')->get();
        $implementers = ResponsibleUser::where("user_type_id", "=", "4")->orderBy('id')->get();
        $application = Application::find($id);
        $data = [
            'responsible_users' => $responsible_users,
            'application' => $application,
            'implementers' => $implementers
        ];
        return view('application.edit')->with($data);
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
                'responsible_user_id' => 'required',
                'implementer_id' => 'required'
            ],
            [
                'name.required' => 'Niste unijeli naziv aplikacije!',
                'responsible_user_id.required' => 'Niste unijeli odgovornu osobu!',
                'implementer_id.required' => 'Niste unijeli implementatora!',
            ]
        );

        $application = Application::find($id);
        $application->name = $request->input('name');
        $application->responsible_user_id = $request->input('responsible_user_id');
        $application->implementer_id = $request->input('implementer_id');
        $application->save();

        return redirect('/applications')->with('success', 'Aplikacija je uspješno izmijenjena!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);
        $application->delete();

        return redirect('/applications')->with('success', 'Aplikacija je uspješno obrisana!');
    }
}
