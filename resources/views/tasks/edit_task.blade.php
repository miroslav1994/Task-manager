<div class="container" style="width:40%; display:none;" id="edit_task_div" >
   
    <div class="form-group">
        <label for="name">Naziv</label> 
        <input type="text" name="name" id="name" placeholder='Naziv' class="form-control" value="{{$task->name}}">
    </div>

    <div class="form-group">
        <label for="company_id">Preduzeće</label>
        <select name="company_id" id="company_id" class="form-control">
            @foreach($companies as $company)
                <?php $selected_company = ""; ?>
                @if($company->id == $task->company_id) <?php $selected_company = "selected"; ?>
                @endif
                <option value = '{{$company->id}}' {{$selected_company}}> {{$company->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="comment">Komentar</label>
        <textarea name="comment" id="comment" placeholder='Komentar' class="form-control" value="{{$task->comment}}">{!!$task->comment!!}</textarea>
        <script>
            CKEDITOR.replace( 'comment' );
        </script>
    </div>
    <div class="form-group">
        <label for="application_id">Aplikacija</label>
        <select id="application_id" name="application_id" class="form-control">
            @foreach($applications as $application)
                <?php $selected_application = ""; ?>
                @if($application->id == $task->application_id) <?php $selected_application = "selected"; ?>
                @endif
                <option value = '{{$application->id}}' {{$selected_application}}> {{$application->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="wanted_end_date">Željeni datum završetka</label>
        <input type="date" id="wanted_end_date" name="wanted_end_date" class="form-control" value="{{$task->wanted_end_date}}">
        </div>
        <div class="form-group col-md-6">
            <label for="provided_end_date">Predviđen datum završetka</label>
            <input type="date" id="provided_end_date" name="provided_end_date" class="form-control" value="{{$task->provided_end_date}}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="urgently">Da li je hitno</label>
            <select id="urgently" name="urgently" class="form-control">
                <?php $selected_da = ""; $selected_ne = ""; ?>
                @if($task->urgently == 'da') <?php $selected_da = 'selected'; ?>
                @elseif($task->urgently == 'ne') <?php $selected_ne = 'selected'; ?>
                @endif

                <option value=""></option>
                <option value="da" {{$selected_da}}>Da</option>
                <option value="ne" {{$selected_ne}}>Ne</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="model_create_tasks_id">Način kreiranja zahtjeva</label>
            <select id="model_create_tasks_id" name="model_create_tasks_id" class="form-control">
                @foreach($model_create_tasks as $model_create_task)
                    <?php $selected_model_create_task = ""; ?>
                    @if($model_create_task->id == $task->model_create_task_id) <?php $selected_model_create_task = "selected"; ?>
                    @endif
                    <option value = '{{$model_create_task->id}}' {{$selected_model_create_task}}> {{$model_create_task->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div style="text-align:center;">
        <button type="submit" id="addApplication" class="btn btn-success">Sačuvaj</button>
        <button type="reset" class="btn btn-default">Odustani</button>
         <a id="close_div" value="Zatvori" class="form-control btn btn-danger" style="width:15%;" onclick="close_div();">Zatvori</a>
    </div>
</div>