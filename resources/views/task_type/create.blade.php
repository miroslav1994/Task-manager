
    
@extends('layouts.app')

@section('content')
    <a href="/tasks_type" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Dodavanje tipa zahtjeva</h1>
    <form action="{{ action('TasksTypeController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Naziv">
            </div>
            <div style="text-align:center;">
                <button type="submit" id="addTaskssType" class="btn btn-success">Sačuvaj</button>
                <button type="reset" class="btn btn-default">Odustani</button>
            </div>
        </div>
    </form>
   
@endsection
