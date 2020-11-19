
    
@extends('layouts.app')

@section('content')
    <a href="/tasks" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Dodavanje zahtjeva</h1>
    <form action="{{ action('TasksController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" name="name" id="name" placeholder='Naziv' class="form-control">
            </div>
            <div class="form-group">
                <label for="company_id">Preduzeće</label>
                <select id="company_id" name="company_id" class="form-control">
                    @foreach($companies as $company)
                        <option value = '{{$company->id}}'> {{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Komentar</label>
                <textarea name="comment" id="comment" placeholder='Komentar' class="form-control ckeditor"></textarea>
            </div>
            <div class="form-group">
                <label for="application_id">Aplikacija</label>
                <select id="application_id" name="application_id" class="form-control">
                    @foreach($applications as $application)
                        <option value = '{{$application->id}}'> {{$application->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="urgently">Da li je hitno</label>
                    <select id="urgently" name="urgently" class="form-control">
                        <option value=""></option>
                        <option value="da">Da</option>
                        <option value="ne">Ne</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="model_create_tasks_id">Način kreiranja zahtjeva</label>
                    <select id="model_create_tasks_id" name="model_create_tasks_id" class="form-control">
                        @foreach($model_create_tasks as $model_create_task)
                            <option value = '{{$model_create_task->id}}'> {{$model_create_task->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div style="text-align:center;">
                <button type="submit" id="addApplication" class="btn btn-success">Sačuvaj</button>
                <button type="reset" class="btn btn-default">Odustani</button>
            </div>
        </div>
    </form>
@endsection
