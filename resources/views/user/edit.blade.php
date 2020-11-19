
    
@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Izmjena preduzeća</h1>
    <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="name">Naziv</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Naziv" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="password">Lozinka</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Lozinka" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Potvrda lozinke</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Potvrda lozinke" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="company_id">Preduzeće</label>
                    <select id="company_id" name="company_id" class="form-control">
                            @foreach($companies as $company)
                                <?php $selected = '' ?>; 
                                @if($company->id == $user->company_id) <?php $selected = 'selected' ?>;
                                @endif
                                <option value="{{$company->id}}" <?php echo $selected; ?> >{{$company->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Slika</label>
                    <input type="file" id="photo" name="photo" class="form-control" value="{{$user->photo}}">
                    <input type="hidden" id="current_photo" name="current_photo" class="form-control" value="{{$user->photo}}">
                </div>
                <div class="form-group">
                    <label for="role">Tip korisnika</label>
                    <select id="role" name="role" class="form-control">
                        <?php $selected_administrator = ''; ?>;
                        <?php $selected_admin_preduzeca = '';?>;
                        <?php $selected_obican_korisnik = ''; ?>;
                        @if($user->role == '1') <?php $selected_administrator = 'selected'; ?> ;
                        @elseif($user->role == '2') <?php $selected_admin_preduzeca = 'selected';?>;
                        @elseif($user->role == '3') <?php $selected_obican_korisnik = 'selected';?>;
                        @endif
                        <option value="1" <?php echo $selected_administrator; ?>>Administrator</option>
                        <option value="2" <?php echo $selected_admin_preduzeca; ?>>Administrator preduzeća</option>
                        <option value="3" <?php echo $selected_obican_korisnik; ?>>Običan korisnik</option>
                    </select>
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="addCompany" class="btn btn-success">Sačuvaj</button>
                    <button type="reset" class="btn btn-default">Odustani</button>
                </div>
            </div>
    </form>
   
@endsection
