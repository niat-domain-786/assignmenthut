@extends('admins.layouts.master')



@section('content')

    <div class="row" style="margin-top: 50px;">
      <div class="col-md-6">
        <h1 class="heading-14 heading-7">Edit Password</h1>
        <div class="profile-edit">
          <div class="w-form">
            {!! Form::model($user,['route' => ['admin.setting.password.update'],'method'=>'put']) !!}

              <div>
                  {!! Form::label('old_pass','Old password') !!}
                  {!! Form::password('old_pass',['class' => 'form-control']) !!}
              </div>
              <div>
                  {!! Form::label('new_pass','New Password') !!}
                  {!! Form::password('new_pass',['class' => 'form-control']) !!}
              </div>
              <div>
                  {!! Form::label('new_pass_confirmation','Confirm New Password') !!}
                  {!! Form::password('new_pass_confirmation',['class' => 'form-control']) !!}
              </div>

              {!! Form::submit('Update Password',['class' => 'btn btn-success']); !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>


@stop
