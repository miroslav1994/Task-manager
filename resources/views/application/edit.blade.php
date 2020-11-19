
    
@extends('layouts.app')

@section('content')
    <a href="/applications" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Izmjena aplikacije</h1>
    <form action="/applications/{{$application->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:40%;">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}

                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label for="name">Naziv</label>
                    <input type="text" name="name" id="name" placeholder='Naziv' class="form-control" value="{{$application->name}}">
                </div>
                <div class="form-group">
                    <label for="responsible_user_id">Odgovorna osoba</label>
                    <select id="responsible_user_id" name="responsible_user_id" class="form-control">
                            @foreach($responsible_users as $responsible_user)
                                <?php $selected = ''; ?> 
                                @if ($responsible_user->id == $application->responsible_user_id) <?php $selected = 'selected'; ?>
                                @endif
                                <option value="{{$responsible_user->id}}" <?php echo $selected; ?>>{{$responsible_user->user->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="implementer_id">Tip korisnika</label>
                    <select id="implementer_id" name="implementer_id" class="form-control">
                            @foreach($implementers as $implementer)
                                <?php $selected = ''; ?> 
                                @if ($implementer->id == $application->implementer_id) <?php $selected = 'selected'; ?>
                                @endif
                                <option value="{{$implementer->id}}" <?php echo $selected; ?>>{{$implementer->user->name}}</option>
                            @endforeach
                    </select>
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="editApplication" class="btn btn-success">Sačuvaj</button>
                    <button type="reset" class="btn btn-default">Odustani</button>
                </div>
            </div>
    </form>
   
@endsection
