@extends('master')
@section('content')
    <h2 class="text-center">Add new book to library</h2>
    {!! Form::open(['url' => 'books', 'class' => 'form-horizontal', 'files' => true]) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('inputBookName', 'Book name:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::text('title', null, array('class' => 'form-control', 'id' => 'inputBookName', 'placeholder' => 'Book name(eg. Harry Potter)')); !!}

                @if($errors -> first('title') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('title') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('author', 'Author:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::text('author', null, array('class' => 'form-control', 'id' => 'author', 'placeholder' => 'Author')); !!}

                @if($errors -> first('author') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('author') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('resume', 'Resume:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::textarea('resume', null, array('class' => 'form-control', 'id' => 'resume', 'rows' => 8)); !!}

                @if($errors -> first('resume') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('resume') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputPublishDate" class="col-lg-2 control-label">Publish date:</label>
            <div class="col-lg-10">
                <input name="publish" type="date" class="form-control" id="inputPublishDate" placeholder="Publish date">

                @if($errors -> first('publish') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('publish') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="format" class="col-lg-2 control-label">Select format</label>
            <div class="col-lg-10">
                <select name="format" class="form-control" id="format">
                    <option selected disabled>Select format</option>
                    @for($format_i = 1; $format_i < 9; $format_i++)
                        <option value="{{{ $format_i }}}">A{{{ $format_i }}}</option>
                    @endfor
                </select>

                @if($errors -> first('format') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('format') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputPageCount" class="col-lg-2 control-label">Page count:</label>
            <div class="col-lg-10">
                <input name="pages" type="number" min="1" class="form-control" id="inputPageCount"
                       placeholder="Page count">

                @if($errors -> first('pages') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('pages') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputCover" class="col-lg-2 control-label">Cover:</label>
            <div class="col-lg-10">
                <div class="upload-img"></div>
                <input name="cover" type="file" class="form-control" id="inputCover" placeholder="Cover">

                @if($errors -> first('cover') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('cover') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('isbn', 'ISBN:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::text('isbn', null, array('class' => 'form-control', 'id' => 'isbn')); !!}

                @if($errors -> first('isbn') != '')
                    <div class="alert alert2 alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! $errors -> first('isbn') !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-5">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
@stop