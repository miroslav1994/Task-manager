@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Zahtjevi</h1>
        <br /><br />
        <a href="/tasks/create" class="btn btn-primary" style="float:right;"> Dodaj zahtjev</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Naziv</th>
                <th style="width:12% !important; text-align:center;">Preduzeće</th>
                <th style="width:12% !important; text-align:center;">Komentar</th>
                <th style="width:12% !important; text-align:center;">Status</th>
                <th style="width:12% !important; text-align:center;">Aplikacija</th>
                <th style="width:12% !important; text-align:center;">Da li je hitno</th>
                <th style="width:12% !important; text-align:center;">Odgovorna osoba</th>
                <th style="width:12% !important; text-align:center;">Implementator</th>
                <th style="width:10% !important; text-align:center;">Unio</th>
                <th style="width:10% !important; text-align:center;">Datum unosa</th>
                <th style="width:20% !important; text-align:center;">Pregled</th>
                <th style="width:20% !important; text-align:center;">Brisanje</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    
                    <td style="width:5% !important">{{$task->id}}</td>
                    <td style="width:10% !important">{{$task->name}}</td>
                    <td style="width:12% !important">{{$task->companies->name}}</td>
                    <td style="width:12% !important">{!! $task->comment !!}</td>
                    <td style="width:12% !important">{{$task->statuses->name}}</td>
                    <td style="width:12% !important">{{$task->applications->name}}</td>
                    <td style="width:12% !important">{{$task->urgently}}</td>
                    <td style="width:12% !important">{{$task->responsible_users->user->name}}</td>
                    <td style="width:12% !important">{{$task->responsible_implementer_users->user->name}}</td>
                    <td style="width:12% !important">{{$task->users->name}}</td>
                    <td style="width:12% !important">{{$task->created_at->format('d.m.Y H:i:s')}}</td>
                    <td style="width:30% !important">
                        <a href="/tasks/{{$task->id}}/edit" class="btn btn-default">Pregled</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/tasks/{{$task->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
      
    </div>

    
@endsection
