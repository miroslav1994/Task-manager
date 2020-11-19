@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Tipovi zahtjeva</h1>
        <br /><br />
        <a href="/tasks_type/create" class="btn btn-primary" style="float:right;"> Dodaj tip zahtjeva</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Naziv</th>
                <th style="width:20% !important; text-align:center;">Izmjena</th>
                <th style="width:20% !important; text-align:center;">Brisanje</th>
            </tr>
            @foreach ($tasks_type as $task_type)
                <tr>
                    <td style="width:5% !important">{{$task_type->id}}</td>
                    <td style="width:10% !important">{{$task_type->name}}</td>
                    <td style="width:30% !important">
                        <a href="/tasks_type/{{$task_type->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/tasks_type/{{$task_type->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $tasks_type->links() }}
    </div>

    
@endsection