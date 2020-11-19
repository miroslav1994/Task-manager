
    
@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Dodavanje korisnika</h1>
    <form action="{{ action('UsersController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Naziv">
            </div>
            <div class="form-group">
                <label for="password">Lozinka</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Lozinka">
            </div>
            <div class="form-group">
                <label for="confirm_password">Potvrda lozinke</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Potvrda lozinke">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="company_id">Preduzeće</label>
                <select id="company_id" name="company_id" class="form-control">
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="photo">Slika</label>
                <input type="file" id="photo" name="photo" class="form-control">
            </div>
            <div class="form-group">
                <label for="role">Tip korisnika</label>
                <select id="role" name="role" class="form-control">
                    <option value="1">Administrator</option>
                    <option value="2">Administrator preduzeća</option>
                    <option value="3">Običan korisnik</option>
                </select>
            </div>
            <div style="text-align:center;">
                <button type="submit" id="addCompany" class="btn btn-success">Sačuvaj</button>
                <button type="reset" class="btn btn-default">Odustani</button>
            </div>
        </div>
    </form>
   
@endsection
