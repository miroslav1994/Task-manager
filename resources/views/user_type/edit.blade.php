
    
@extends('layouts.app')

@section('content')
    <a href="/users_type" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Izmjena tipa korisnika</h1>
    <form action="/users_type/{{$user_type->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}

                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label for="name">Naziv</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Naziv" value="{{$user_type->name}}">
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="editUsersType" class="btn btn-success">Sačuvaj</button>
                    <button type="reset" class="btn btn-default">Odustani</button>
                </div>
            </div>
    </form>
   
@endsection
