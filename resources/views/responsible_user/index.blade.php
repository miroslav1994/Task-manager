@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Odgovorne osobe</h1>
        <br /><br />
        <a href="/responsible_users/create" class="btn btn-primary" style="float:right;"> Dodaj odgovornu osobu</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Korisnik</th>
                <th style="width:12% !important; text-align:center;">Tip korisnika</th>
                <th style="width:20% !important; text-align:center;">Izmjena</th>
                <th style="width:20% !important; text-align:center;">Brisanje</th>
            </tr>
            @foreach ($responsible_users as $responsible_user)
                <tr>
                    <td style="width:5% !important">{{$responsible_user->id}}</td>
                    <td style="width:10% !important">{{$responsible_user->user->name}}</td>
                    <td style="width:12% !important">{{$responsible_user->user_type->name}}</td>
                    <td style="width:30% !important">
                        <a href="/responsible_users/{{$responsible_user->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/responsible_users/{{$responsible_user->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $responsible_users->links() }}
    </div>

    
@endsection