<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Application;
use App\Company;
use App\ModelCreateTask;
use App\ResponsibleUser;
use App\Status;
use App\TaskType;
use App\TaskItems;
use DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 1) $tasks = Tasks::where('status_id', '!=', 10)->orderBy('id', 'desc')->paginate(10);
        else if(auth()->user()->role == 2) $tasks = Tasks::where('company_id', '=', auth()->user()->company_id)->orderBy('id', 'desc')->get();
        else if(auth()->user()->role == 3) $tasks = Tasks::where('created_by', '=', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applications = Application::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('name', 'asc')->get();
        $model_create_tasks = ModelCreateTask::orderBy('name', 'asc')->get();
        $data = [
            'applications' => $applications,
            'companies' => $companies,
            'model_create_tasks' => $model_create_tasks
        ];
        
        return view('tasks.create')->with($data);
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
                'company_id' => 'required',
                'comment' => 'required',
                'application_id' => 'required',
            ],
            [
                'name.required' => 'Niste unijeli naziv zahtjeva!',
                'company_id.required' => 'Niste unijeli preduzeće!',
                'comment.required' => 'Niste unijeli komentar!',
                'application_id.required' => 'Niste unijeli aplikaciju!'
            ]
        );

        $task = new Tasks();
        $task->name = $request->input('name');
        $task->company_id = $request->input('company_id');
        $task->comment = $request->input('comment');
        $task->application_id = $request->input('application_id');
        if(auth()->user()->role == 1 || auth()->user()->role == 2)
            $task->status_id = 7;
        else $task->status_id = 10;
        

        $applications = Application::where('id', $task->application_id)->get();
        foreach($applications as $application) {
            $responsible_user_id = $application->responsible_user_id;
            $implementer_id = $application->implementer_id;
        }
        
        $task->responsible_user_id = $responsible_user_id;
        $task->responsible_user_implementer_id = $implementer_id;
        $task->application_id = $request->input('application_id');
        $task->urgently = $request->input('urgently');
        $task->model_create_tasks_id = $request->input('model_create_tasks_id');
        $task->created_by = auth()->user()->id;
        $task->task_type_id = 3;
        $task->save();

        return redirect('/tasks')->with('success', 'Zathjev je uspješno dodat!');
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
        $task = Tasks::find($id);
        $applications = Application::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('name', 'asc')->get();
        $model_create_tasks = ModelCreateTask::orderBy('name', 'asc')->get();
        $statuses = Status::orderBy('name', 'asc')->get();
        $responsible_users = ResponsibleUser::where('user_type_id', '=', 3)->orderBy('id', 'asc')->get();
        $responsible_user_implementers = ResponsibleUser::where('user_type_id', '=', 4)->orderBy('id', 'asc')->get();
        $task_types = TaskType::orderBy('name', 'asc')->get();
        if(auth()->user()->role == 1) $task_items = TaskItems::where('task_id', '=', $id)->orderBy('id', 'asc')->get();
        else if (auth()->user()->role == 2 || auth()->user()->role == 3)  {
            $task_items  = DB::select
            ("SELECT * FROM podrska.task_items 
            WHERE see_user = 'DA'
            AND task_id = $id
            ORDER BY id asc
            ");
        }

        $task_items_count = TaskItems::where('task_id', '=', $id)->where('automatic_comment', '=' ,'ne')->count();

        $data = [
            'applications' => $applications,
            'companies' => $companies,
            'model_create_tasks' => $model_create_tasks,
            'task' => $task,
            'statuses' => $statuses,
            'responsible_users' => $responsible_users,
            'responsible_user_implementers' => $responsible_user_implementers,
            'task_types' => $task_types,
            'task_items' => $task_items,
            'task_items_count' => $task_items_count
        ];
        return view('tasks.edit')->with($data);
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
                'company_id' => 'required',
                'comment' => 'required',
                'application_id' => 'required',
            ],
            [
                'name.required' => 'Niste unijeli naziv zahtjeva!',
                'company_id.required' => 'Niste unijeli preduzeće!',
                'comment.required' => 'Niste unijeli komentar!',
                'application_id.required' => 'Niste unijeli aplikaciju!'
            ]
        );

        $task = Tasks::find($id);
        $task->name = $request->input('name');
        $task->company_id = $request->input('company_id');
        $task->comment = $request->input('comment');
        $task->application_id = $request->input('application_id');
        $task->status_id = 7;

        $applications = Application::where('id', $task->application_id)->get();
        foreach($applications as $application) {
            $responsible_user_id = $application->responsible_user_id;
            $implementer_id = $application->implementer_id;
        }
        
        $task->responsible_user_id = $responsible_user_id;
        $task->responsible_user_implementer_id = $implementer_id;
        $task->application_id = $request->input('application_id');
        $task->wanted_end_date = $request->input('wanted_end_date');
        $task->provided_end_date = $request->input('provided_end_date');
        $task->urgently = $request->input('urgently');
        $task->model_create_tasks_id = $request->input('model_create_tasks_id');
        $task->save();

        return redirect('/tasks/' . $id . '/edit')->with('success', 'Zahtjev je uspješno izmijenjen!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::find($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Zahtjev je uspješno obrisan!');
    }

    public function storeTaskItem(Request $request)
    {
        $task_item = new TaskItems();
        $task_item->task_id = $request->input('task_id');
        $task_item->company_id = $request->input('task_company_id');
        $task_item->comment = $request->input('comment_item');
        $task_item->number_of_hours = $request->input('number_of_hours');
        $task_item->number_of_minutes = $request->input('number_of_minutes');
        $task_item->see_user = $request->get('see_user');
        if($request->get('see_user') == 'on') $task_item->see_user = 'DA';
        else $task_item->see_user = 'NE';

        if(auth()->user()->role != 1) $task_item->see_user = 'DA';

        $task_item->automatic_comment = 'NE';
        $task_item->createdBy = auth()->user()->id;
        $task_item->save();

        return redirect('/tasks/' . $task_item->task_id . '/edit')->with('success', 'Komentar je uspješno dodat!');
    }

    public function storeSideBarContent(Request $request)
    {
        $task = Tasks::find($request->input('task_id_sidebar'));

        $task->status_id = $request->input('select_add_status');
        $task->application_id = $request->input('select_add_app');
        $task->responsible_user_id = $request->input('select_add_responsible_person');
        $task->responsible_user_implementer_id = $request->input('select_add_responsible_user_implementer');
        $task->task_type_id = $request->input('select_add_task_type');
        $task->save();

        return redirect('/tasks/' . $request->input('task_id_sidebar') . '/edit')->with('success', 'Izmjene su uspješno izvršene!');
    }

    public function odobri(Request $request)
    {
        $task = Tasks::find($request->input('task_id_odobri'));
        $task->status_id = 7;
        $task->save();

        return redirect('/tasks/' . $request->input('task_id_odobri') . '/edit')->with('success', 'Uspješno odobren zahtjev!');
    }
}
