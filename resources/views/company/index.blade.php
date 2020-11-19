@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 style="text-align:center;">Preduzeća</h1>
        <br /><br />
        <a href="/companies/create" class="btn btn-primary" style="float:right;"> Dodaj preduzeće</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Naziv</th>
                <th style="width:10% !important; text-align:center;">PIB</th>
                <th style="width:12% !important; text-align:center;">PDV</th>
                <th style="width:10% !important; text-align:center;">Žiro-račun</th>
                <th style="width:10% !important; text-align:center;">Logo</th>
                <th style="width:20% !important; text-align:center;">Izmjena</th>
                <th style="width:20% !important; text-align:center;">Brisanje</th>
            </tr>
            @foreach ($companies as $company)
                <tr>
                    <td style="width:5% !important">{{$company->id}}</td>
                    <td style="width:10% !important">{{$company->name}}</td>
                    <td style="width:10% !important">{{$company->pib}}</td>
                    <td style="width:12% !important">{{$company->pdv}}</td>
                    <td style="width:10% !important">{{$company->bank_account}}</td>
                    <td style="width:30% !important">
                        @if($company->photo != '')
                            <img src="/storage/company_photos/{{$company->photo}}" alt="Slika nije unijeta" style="width:20% !important">
                        @else
                            <img src="/storage/company_photos/noimage.png" alt="Slika nije unijeta" style="width:20% !important">
                        @endif
                    </td>
                    <td style="width:30% !important">
                        <a href="/companies/{{$company->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                        
                    </td>
                    <td style="width:30% !important">
                        <form action="/companies/{{$company->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $companies->links() }}

    </div>
    
    
@endsection