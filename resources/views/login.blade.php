@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading">login</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'login', 'class' => 'form-horizontal']) !!}
                    <fieldset>
                        <div class="form-group">
                            {!! Form::label('inputUsername', 'Username', array('class' => 'col-lg-2 control-label')); !!}
                            <div class="col-lg-10">
                                {!! Form::text('username', null, array('class' => 'form-control', 'id' => 'inputUsername', 'placeholder' => 'Username')); !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('inputPassword', 'Password', array('class' => 'col-lg-2 control-label')); !!}
                            <div class="col-lg-10">
                                {!! Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control', 'id' => 'inputPassword')); !!}
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember', true); !!} Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading">register</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'profile', 'class' => 'form-horizontal']) !!}
                    <fieldset>
                        <div class="form-group">
                            {!! Form::label('inputRegUsername', 'Username', array('class' => 'col-lg-2 control-label')); !!}
                            <div class="col-lg-10">
                                {!! Form::text('username', null, array('class' => 'form-control', 'id' => 'inputRegUsername', 'placeholder' => 'Username')); !!}

                                @if($errors -> first('username') != '')
                                    <div class="alert alert2 alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {!! $errors -> first('username') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('inputRegPassword', 'Password', array('class' => 'col-lg-2 control-label')); !!}
                            <div class="col-lg-10">
                                {!! Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control', 'id' => 'inputRegPassword')); !!}

                                @if($errors -> first('password') != '')
                                    <div class="alert alert2 alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {!! $errors -> first('password') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('inputConfirmPassword', 'Confirm Password', array('class' => 'col-lg-2 control-label')); !!}
                            <div class="col-lg-10">
                                {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password', 'class' => 'form-control', 'id' => 'inputConfirmPassword')); !!}

                                @if($errors -> first('confirm_password') != '')
                                    <div class="alert alert2 alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {!! $errors -> first('confirm_password') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop