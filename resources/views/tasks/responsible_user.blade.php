<span style="font-weight:bold;">Odgovorna osoba<button type="button" class="fa fa-pencil izmjena" onclick="choose_responsible_person(<?php echo $task->id; ?>)" style="float:right;font-size:20px;border:none;"></button></span>
<div id="add_responsible_user" style="display:none;">
    <select id="select_add_responsible_person" name="select_add_responsible_person" class="form-control select2" style="width:90%;">
            @foreach($responsible_users as $responsible_user)
                <?php $selected_responsible_user = ""; ?>
                @if($responsible_user->id == $task->responsible_user_id)
                 <?php $selected_responsible_user = "selected"; ?>
                @endif
                <option value="{{$responsible_user->id}}" {{$selected_responsible_user}}>{{$responsible_user->user->name}}</option>
            @endforeach
    </select>
</div>

<div id="show_responsible_user">
    <br />
    <span style="font-size:14px;">{{$task->responsible_users->user->name}}</span> 
</div>


<script>
    function choose_responsible_person() {
        if($("#add_responsible_user").is(":visible") ) {
            $("#add_responsible_user").hide();
            $("#show_responsible_user").show();            
        } else {
            $("#add_responsible_user").show();
            $("#show_responsible_user").hide();
        }
    } 
</script>

