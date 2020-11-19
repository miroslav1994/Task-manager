
    
@extends('layouts.app')

@section('content')
    <a href="/responsible_users" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Dodavanje odgovorne osobe</h1>
    <form action="{{ action('ResponsibleUsersController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="user_id">Korisnik</label>
                <select id="user_id" name="user_id" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_type_id">Tip korisnika</label>
                <select id="user_type_id" name="user_type_id" class="form-control">
                        @foreach($users_type as $user_type)
                            <option value="{{$user_type->id}}">{{$user_type->name}}</option>
                        @endforeach
                </select>
            </div>
            <div style="text-align:center;">
                <button type="submit" id="addResponsibleUser" class="btn btn-success">Sačuvaj</button>
                <button type="reset" class="btn btn-default">Odustani</button>
            </div>
        </div>
    </form>
   
@endsection
