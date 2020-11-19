
    
@extends('layouts.app')
@if(auth()->user()->role == 1) 
    <?php $display_sidebar = ''; ?>
    <?php $display_odobri = 'display:none;'; ?>
@else 
    <?php $display_sidebar = 'display:none'; ?>
    @if(auth()->user()->role == 2 && $task->status_id == 10)
    <?php $display_odobri = ''; ?>
    @else <?php $display_odobri = "display:none;" ?>
    @endif
@endif

@section('content')
    <a href="/tasks" class="btn btn-default" style="margin-left:31% !important">Nazad</a>
    <h1 style="text-align:center">Izmjena zahtjeva</h1>
    <form action="/tasks/{{$task->id}}" method="POST" enctype="multipart/form-data">
        <div class="container" style="width:50%;" id="view_task_id">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            {{ method_field('PATCH') }}
            <div>
                <h3>{{$task->name}}&nbsp&nbsp&nbsp
                    <button type="button" id="edit_button_id" value="Izmijeni" style="width:10%;display:inline;" class="form-control" onclick="change_div();">Izmijeni</button>
                    &nbsp&nbsp&nbsp
                    <button type="button" id="odobri_button_id" value="Odobri" style="width:10%;display:inline;{{$display_odobri}}" class="form-control" onclick="call_form();">Odobri</button>
                </h3>
                <p>{!!$task->comment!!}</p>
            </div>
        </div>
        @include('tasks.edit_task');
    </form>
    <div class="container" style="width:40%">
        <h3>Komentari</h3>

        </h3>

        <div>
            @foreach($task_items as $task_item)
                @if($task_item->see_user == 'DA' && auth()->user()->role == 1) <?php $display_eye = 'float:right;'; ?>
                @else <?php $display_eye = 'display:none;'; ?>
                @endif
                <?php
                    $number_of_hours = $task_item->number_of_hours;
                    $number_of_minutes = $task_item->number_of_minutes;
                    $hours_and_minutes = "";

                    if(is_numeric($number_of_hours)) $hours_and_minutes = $number_of_hours . "h";
                    if(is_numeric($number_of_minutes)) {
                        if($hours_and_minutes != "") $hours_and_minutes .= " i " . $number_of_minutes . "min";
                        else $hours_and_minutes = $number_of_minutes . "min";
                    }
                ?>         
                @if(auth()->user()->role == 1)
                    <h5><b>{{$task_item->users->name}}</b> {{$task_item->created_at->format('d.m.Y H:i:s')}}<span style="{{$display_eye}}" title="Vidi korisnik"><i class="fa fa-eye"></i></span></h5>
                @elseif (auth()->user()->role == 2) 
                <h5><b>Marko Marković</b></h5>
                @else
                <h5><b>Zoran Danilović</b></h5>
                @endif
                <b>Vrijeme izvršavanje stavke: {{$hours_and_minutes}}</b>
                <p>{!!$task_item->comment!!}</p>
                <hr />
            @endforeach
            <form action="{{ action('TasksController@storeTaskItem') }}"  enctype="multipart/form-data">
                <textarea id="comment_item_id" name="comment_item" class="form-control"></textarea>
                <input type="hidden" id="task_id" name="task_id" value="{{$task->id}}">
                <input type="hidden" id="task_company_id" name="task_company_id" value="{{$task->company_id}}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <script>
                    CKEDITOR.replace( 'comment_item_id' );
                </script>
                <br />    
                <div class="row" style="margin-bottom:10% !important;{{$display_sidebar}}">
                    <div class="col-md-7">
                        <div class="col-md-3">
                            <label>Sati i minuti</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="number_of_hours" id="number_of_hours_id" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="number_of_minutes" id="number_of_minutes_id" class="form-control">
                        </div>
                    </div>
                   
                    <div class="col-md-5">
                        <div class="col-md-6">
                            <label style="margin-top:10% !important;">Vidi korisnik</label>
                        </div>
                        <div class="col-md-4" >
                            <input type="checkbox" name="see_user" id="id_see_user" class="form-control">
                        </div>
                    </div>
                    
                </div>
                <div style="text-align:center;">
                    <button type="submit" id="addCommentItem" class="btn btn-success">Sačuvaj</button>
                    <button type="reset" class="btn btn-default">Odustani</button>
                </div>
            </form>
        </div>
    </div>
    <form action="{{ action('TasksController@odobri') }}" method = "GET">      
        <input type="hidden" id="task_id_odobri" name="task_id_odobri" value="{{$task->id}}">
        <button style="display:none;" type="submit" id="odobri_submit"></button>
    </form>
    <div class="sidenav" style="{{$display_sidebar}}">
        <form action="{{ action('TasksController@storeSideBarContent') }}"  enctype="multipart/form-data">
            <table cellpadding="4" cellspacing="3" style="margin-left:5% !important;width:90%" >
                <tr style="">
                    <td>
                        <button type="submit" style="margin-left:-2%;width:25%;margin-bottom:10%; " id="dodaj_sve_stavke" name="dodaj_sve_stavke" class="form-control">
                        Sačuvaj 
                        </button>
                        <input type="hidden" id="task_id_sidebar" name="task_id_sidebar" value="{{$task->id}}">
                    </td> 
                </tr>
                <tr>
                    <td>
                        @include("tasks.status")
                        <br />
                    </td>
                </tr>
                <tr>
                <td>
                    <span style="font-weight:bold;">Preduzeće</span>
                    <div id="show_company">
                        <br />
                        <span style="font-size:14px;">{{$task->companies->name}}</span>
                    </div>
                    <br />
                </td>
                </tr>
                <tr>
                    <td>
                        @include("tasks.application")
                        <br />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        @include("tasks.responsible_user")
                        <br />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        @include("tasks.responsible_user_implementer")
                        <br />
                    </td>
                </tr>
            
                
            
                <tr>
                    <td>
                            <?php
                                $sum_number_of_minutes = 0;
                                $sum_number_of_hours = 0;
                            ?>
                            @foreach($task_items as $task_item)
                                <?php
                                    $sum_number_of_minutes = $sum_number_of_minutes + $task_item->number_of_minutes;
                                    $sum_number_of_hours = $sum_number_of_hours + $task_item->number_of_hours;

                                    if($sum_number_of_minutes > 59) {
                                        $sum_number_of_hours++;
                                        $sum_number_of_minutes -= $sum_number_of_minutes - 60;
                                    }
                                ?>
                            @endforeach
                
                        <div class="" style="margin-top:5px;">
                            <label>Ukupno vrijeme provedeno na izvršavanju zadatka:</label><br />
                            <span>Broj sati: {{$sum_number_of_hours}}</span>
                            <span style="padding-left:20%;">Broj minuta:  {{$sum_number_of_minutes}}</span>
                        </div>
                        <br />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        @include('tasks.notifications');
                    </td>
                </tr>
                
                <tr>
                    <td>
                    
                        <h4><span></span></h4><h6 style="color:#707070"></h6>
                        <h4><span></span></h4><h6 style="color:#707070"></h6>
                        <h4><span></span></h4><h6 style="color:#707070"></h6>
                        <h4><span></span></h4><h6 style="color:#707070"></h6>
                    </td>
                </tr>
            </table>
        </form>
    </div>
      
      <div class="main">
        
      </div>

@endsection
<script>
    function change_div()
    {
        $("#edit_task_div").show();
        $("#view_task_id").hide();
    }

    function close_div()
    {
        $("#edit_task_div").hide();
        $("#view_task_id").show();
    }

    function call_form()
    {
        $("#odobri_submit").click();
    }
</script>
