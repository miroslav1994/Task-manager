<span style="font-weight:bold;">Status<button type="button" class="fa fa-pencil izmjena" onclick="odaberi_status_zahtjeva(<?php echo $task->id; ?>)" style="float:right;font-size:20px;border:none;"></button></span>
<div id="add_status" style="display:none;">
    <select id="select_add_status" name="select_add_status" class="form-control" style="width:90%;">
            @foreach($statuses as $status)
                <?php $selected_status = ""; ?>
                @if($status->id == $task->status_id) <?php $selected_status = "selected"; ?>
                @endif
                <option value="{{$status->id}}" {{$selected_status}}>{{$status->name}}</option>
            @endforeach
    </select>
</div>

<div id="show_status">
    <br />
    <span style="font-size:14px;">{{$task->statuses->name}}</span> 
</div>


<script>
    function odaberi_status_zahtjeva() {
            if($("#add_status").is(":visible") ) {
                $("#add_status").hide();
                $("#show_status").show();            
            } else {
                $("#add_status").show();
                $("#show_status").hide();
            }
        }
        
</script>