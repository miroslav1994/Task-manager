
    
@extends('layouts.app')

@section('content')
    <a href="/responsible_users" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Izmjena odgovorne osobe</h1>
    <form action="/responsible_users/{{$responsible_user->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}

                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label for="user_id">Korisnik</label>
                    <select id="user_id" name="user_id" class="form-control">
                            
                            @foreach($users as $user)
                                <?php $selected = '' ?>;
                                @if($user->id == $responsible_user->user_id) <?php $selected = 'selected' ?>;
                                @endif
                                <option value="{{$user->id}}" <?php echo $selected; ?>>{{$user->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_type_id">Tip korisnika</label>
                    <select id="user_type_id" name="user_type_id" class="form-control">
                            
                            @foreach($users_type as $user_type)
                                <?php $selected = '' ?>;
                                @if($user_type->id == $responsible_user->user_type_id) <?php $selected = 'selected' ?>;
                                @endif
                                <option value="{{$user_type->id}}" <?php echo $selected; ?>>{{$user_type->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="editResponsibleUser" class="btn btn-success">Sačuvaj</button>
                    <button type="reset" class="btn btn-default">Odustani</button>
                </div>
            </div>
    </form>
   
@endsection
