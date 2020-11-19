<span style="font-weight:bold;">Tip zahtjeva<button type="button" class="fa fa-pencil izmjena" onclick="choose_task_type(<?php echo $task->id; ?>)" style="float:right;font-size:20px;border:none;"></button></span>
<div id="add_task_type" style="display:none;">
    <select id="select_add_task_type" name="select_add_task_type" class="form-control select2" style="width:90%;">
            @foreach($task_types as $task_type)
                <?php $selected_task_type = ""; ?>
                @if($task_type->id == $task->task_type_id) <?php $selected_task_type = "selected"; ?>
                @endif
                <option value="{{$task_type->id}}" {{$selected_task_type}}>{{$task_type->name}}</option>
            @endforeach
    </select>
</div>

<div id="show_task_type">
    <br />
    @if(!empty($task->task_type_id)) <span style="font-size:14px;">{{$task->task_types->name}}</span> 
        @else <span style="font-size:14px;"></span> 
    @endif
</div>


<script>
    function choose_task_type() {
        if($("#add_task_type").is(":visible") ) {
            $("#add_task_type").hide();
            $("#show_task_type").show();            
        } else {
            $("#add_task_type").show();
            $("#show_task_type").hide();
        }
    } 
</script>

