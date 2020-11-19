@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align:center;">Korisnici</h1>
        <br /><br />
        <a href="/users/create" class="btn btn-primary" style="float:right;"> Dodaj korisnika</a>
        <br />
        <br />
        <br />
        <table class="table table-striped table-hover" style="text-align:center;width:100%; ">
            <tr>
                <th style="width:5% !important; text-align:center;">ID</th>
                <th style="width:10% !important; text-align:center;">Naziv</th>
                <th style="width:12% !important; text-align:center;">Email</th>
                <th style="width:10% !important; text-align:center;">Tip korisnika</th>
                <th style="width:10% !important; text-align:center;">Preduzeće</th>
                <th style="width:10% !important; text-align:center;">Slika</th>
                <th style="width:20% !important; text-align:center;">Izmjena</th>
                <th style="width:20% !important; text-align:center;">Brisanje</th>
            </tr>
            @foreach ($users as $user)

                @if($user->role == '1')
                    <?php $role = 'Administrator'; ?>
                @elseif($user->role == '2')
                    <?php $role = 'Administrator preduzeća'; ?>
                @else
                    <?php $role = 'Običan korisnik'; ?>
                @endif

                <tr>
                    <td style="width:5% !important">{{$user->id}}</td>
                    <td style="width:10% !important">{{$user->name}}</td>
                    <td style="width:12% !important">{{$user->email}}</td>
                    <td style="width:10% !important"><?php echo $role; ?></td>
                    <td style="width:10% !important">{{$user->companies->name}}</td>
                    <td style="width:30% !important">
                        @if($user->photo != '')
                            <img src="/storage/user_photos/{{$user->photo}}" alt="Slika nije unijeta" style="width:20% !important">
                        @else
                            <img src="/storage/user_photos/noimage.png" alt="Slika nije unijeta" style="width:20% !important">
                        @endif
                    </td>
                    <td style="width:30% !important">
                        <a href="/users/{{$user->id}}/edit" class="btn btn-default">Izmijeni</a><br />
                        
                    </td>
                    <td style="width:30% !important">
                        <form action="/users/{{$user->id}}" method="POST">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!} 
                            <button type="submit" class="btn btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    </div>

    
@endsection