<span style="font-weight:bold;">Aplikacija</span><button type="button" class="fa fa-pencil izmjena" onclick="choose_app(<?php echo $task->id; ?>)" style="float:right;font-size:20px;border:none;"></button>
<div id="add_app" style="display:none;">
    <select id="select_add_app" name="select_add_app" class="form-control select2" style="width:90%;">
            @foreach($applications as $application)
                <?php $selected_application = ""; ?>
                @if($application->id == $task->application_id) <?php $selected_application = "selected"; ?>
                @endif
                <option value="{{$application->id}}" {{$selected_application}}>{{$application->name}}</option>
            @endforeach
    </select>
</div>

<div id="show_app">
    <br />
    <span style="font-size:14px;">{{$task->applications->name}}</span> 
</div>


<script>
    function choose_app() {
        if($("#add_app").is(":visible") ) {
            $("#add_app").hide();
            $("#show_app").show();            
        } else {
            $("#add_app").show();
            $("#show_app").hide();
        }
    } 
</script>

