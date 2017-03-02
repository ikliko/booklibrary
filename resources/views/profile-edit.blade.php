@extends('master')
@section('content')
    {!! Form::open(['url' => 'profile/' . Auth::user() -> id, 'method' => 'PUT', 'class' => 'form-horizontal col-lg-8 col-lg-offset-2']) !!}
    <fieldset>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-3 control-label">Username</label>
            <div class="col-lg-9">
                <input type="text" name="username" value="{!! Auth::user() -> username !!}" class="form-control"
                       id="inputEmail" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}

    {!! Form::open(['url' => 'profile/edit/password', 'method' => 'PUT', 'class' => 'form-horizontal col-lg-8 col-lg-offset-2']) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('password', 'Old password', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-9">
                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Old password']) !!}

                @if($errors -> first('password') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('password') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('new_password', 'New password', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-9">
                {!! Form::password('new_password', ['id' => 'new_password', 'class' => 'form-control', 'placeholder' => 'New password']) !!}

                @if($errors -> first('new_password') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('new_password') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('confirm_password', 'Confirm password', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-9">
                {!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Confirm password']) !!}

                @if($errors -> first('confirm_password') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('confirm_password') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-3">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
@stop