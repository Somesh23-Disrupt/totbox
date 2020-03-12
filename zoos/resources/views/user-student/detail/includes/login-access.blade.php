{{--student user--}}
<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter black"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;Edit Login Access</h4>
        {!! Form::model($data['student_login'], ['route' => ['user-student.password', $data['student_login']->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}

        {!! Form::hidden('id', $data['student_login']->id) !!}
        {!! Form::hidden('role_id', 6) !!}
        {!! Form::hidden('hook_id', $data['student']->id) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form", "disabled"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'name'])
            </div>

            {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::email('email', null, ["placeholder" => "", "class" => "form-control border-form", "disabled"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'email'])
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form", "id"=>"pass", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'password'])
            </div>

            {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
            </div>
        </div>
        <div class="col-sm-4">
            <label data-toggle="dropdown" class="label {{ $data['student_login']->status == 'active'?"label-success":"label-danger" }}" >
                {{ $data['student_login']->status == 'active'?"Active User":"User Locked" }}
            </label>
        </div>
        <div class="clearfix hr-8"></div>

        <div class="clearfix form-actions">
            <div class="col-md-12 align-right">
                <button class="btn btn-info" type="submit">
                    <i class="fa fa-save bigger-110"></i>
                    Change Password
                </button>
            </div>
        </div>


        <div class="hr hr-24"></div>
        {!! Form::close() !!}
    </div>

</div>
