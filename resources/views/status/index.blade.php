@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Statusi</h1>
        <br /><br />
        <a href="/statuses/create" class="btn btn-primary" style="float:right;"> Dodaj status</a>
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
            @foreach ($statuses as $status)
                <tr>
                    <td style="width:5% !important">{{$status->id}}</td>
                    <td style="width:10% !important">{{$status->name}}</td>
                    <td style="width:30% !important">
                        <a href="/statuses/{{$status->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                    </td>
                    <td style="width:30% !important">
                        <form action="/statuses/{{$status->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $statuses->links() }}
    </div>

    
@endsection