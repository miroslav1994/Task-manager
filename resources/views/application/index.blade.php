@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Aplikacije</h1>
        <br /><br />
        <a href="/applications/create" class="btn btn-primary" style="float:right;"> Dodaj aplikaciju</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Naziv</th>
                <th style="width:12% !important; text-align:center;">Odgovorna osoba</th>
                <th style="width:12% !important; text-align:center;">Implementator</th>
                <th style="width:20% !important; text-align:center;">Izmjena</th>
                <th style="width:20% !important; text-align:center;">Brisanje</th>
            </tr>
            @foreach ($applications as $application)
                <tr>
                    <td style="width:5% !important">{{$application->id}}</td>
                    <td style="width:10% !important">{{$application->name}}</td>
                    <td style="width:12% !important">{{$application->responsible_users->user->name}}</td>
                    <td style="width:12% !important">{{$application->implementers->user->name}}</td>
                    <td style="width:30% !important">
                        <a href="/applications/{{$application->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/applications/{{$application->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $applications->links() }}
    </div>

    
@endsection