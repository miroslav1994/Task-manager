@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Način kreiranja zahtjeva</h1>
        <br /><br />
        <a href="/model_create_tasks/create" class="btn btn-primary" style="float:right;"> Dodaj način kreiranja zahtjeva</a>
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
            @foreach ($model_create_tasks as $model_create_task)
                <tr>
                    <td style="width:5% !important">{{$model_create_task->id}}</td>
                    <td style="width:10% !important">{{$model_create_task->name}}</td>
                    <td style="width:30% !important">
                        <a href="/model_create_tasks/{{$model_create_task->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/model_create_tasks/{{$model_create_task->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $model_create_tasks->links() }}
    </div>

    
@endsection