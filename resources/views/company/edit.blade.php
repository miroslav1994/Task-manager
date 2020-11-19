
    
@extends('layouts.app')

@section('content')
    <a href="/companies" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Izmjena preduzeća</h1>
    <form action="/companies/{{$company->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Naziv" value="{{$company->name}}">
            </div>
            <div class="form-group">
                <label for="pib">PIB</label>
                <input type="text" id="pib" name="pib" class="form-control" placeholder="PIB" value="{{$company->pib}}">
            </div>
            <div class="form-group">
                <label for="pdv">PDV</label>
                <input type="text" id="pdv" name="pdv" class="form-control" placeholder="PDV" value="{{$company->pdv}}">
            </div>
            <div class="form-group">
                <label for="bank_account">Žiro-račun</label>
                <input type="text" id="bank_account" name="bank_account" class="form-control" placeholder="Žiro-račun" value="{{$company->bank_account}}">
            </div>
            <div class="form-group">
                <label for="photo">Logo</label>
                <input type="file" id="photo" name="photo" class="form-control" value="{{$company->photo}}">
            </div>
            <div style="text-align:center;">
                <button type="submit" id="editCompany" class="btn btn-success">Sačuvaj</button>
                <button type="reset" class="btn btn-default">Odustani</button>
            </div>
        </div>
    </form>
   
@endsection
