<span style="font-weight:bold;">Implementator<button type="button" class="fa fa-pencil izmjena" onclick="choose_responsible_person_implementer(<?php echo $task->id; ?>)" style="float:right;font-size:20px;border:none;"></button></span>
<div id="add_responsible_user_implementer" style="display:none;">
    <select id="select_add_responsible_user_implementer" name="select_add_responsible_user_implementer" class="form-control select2" style="width:90%;">
            @foreach($responsible_user_implementers as $responsible_user_implementer)
                <?php $selected_responsible_user_implementer = ""; ?>
                @if($responsible_user_implementer->id == $task->responsible_user_implementer_id) <?php $selected_responsible_user_implementer = "selected"; ?>
                @endif
                <option value="{{$responsible_user_implementer->id}}" {{$selected_responsible_user_implementer}}>{{$responsible_user_implementer->user->name}}</option>
            @endforeach
    </select>
</div>

<div id="show_responsible_user_implementer">
    <br />
    <span style="font-size:14px;">{{$task->responsible_implementer_users->user->name}}</span> 
</div>


<script>
    function choose_responsible_person_implementer() {
        if($("#add_responsible_user_implementer").is(":visible") ) {
            $("#add_responsible_user_implementer").hide();
            $("#show_responsible_user_implementer").show();            
        } else {
            $("#add_responsible_user_implementer").show();
            $("#show_responsible_user_implementer").hide();
        }
    } 
</script>