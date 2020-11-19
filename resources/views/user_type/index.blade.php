@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Tipovi korisnika</h1>
        <br /><br />
        <a href="/users_type/create" class="btn btn-primary" style="float:right;"> Dodaj tip korisnika</a>
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
            @foreach ($users_type as $user_type)
                <tr>
                    <td style="width:5% !important">{{$user_type->id}}</td>
                    <td style="width:10% !important">{{$user_type->name}}</td>
                    <td style="width:30% !important">
                        <a href="/users_type/{{$user_type->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/users_type/{{$user_type->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users_type->links() }}
    </div>

    
@endsection