@extends('panelViews::mainTemplate')
@section('page-wrapper')
    <style>
        textarea {
            resize: none;
        }
    </style>
    <h1 class="text-center">
        Edit: {{{ $book -> title }}}
    </h1>
    <hr/>
    {!! Form::open(['url' => 'panel/book/' . $book -> id, 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('inputBookName', 'Book name:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::text('title', isset($book -> title) ? $book -> title : null, array('class' => 'form-control', 'id' => 'inputBookName', 'placeholder' => 'Book name(eg. Harry Potter)')); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('author', 'Author:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::text('author', isset($book -> author) ? $book -> author : null, array('class' => 'form-control', 'id' => 'author', 'placeholder' => 'Author')); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('resume', 'Resume:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::textarea('resume', isset($book -> resume) ? $book -> resume : null, array('class' => 'form-control', 'id' => 'resume', 'rows' => 8)); !!}
            </div>
        </div>

        <div class="form-group">
            <label for="inputPublishDate" class="col-lg-2 control-label">Publish date:</label>
            <div class="col-lg-10">
                <input name="publish" type="date"
                       value="{{{ isset($book -> publish) ? date('Y-m-d', strtotime($book -> publish)) : null }}}"
                       class="form-control" id="inputPublishDate" placeholder="Publish date">
            </div>
        </div>

        <div class="form-group">
            <label for="format" class="col-lg-2 control-label">Select format: {{{ $book -> format }}}</label>
            <div class="col-lg-10">
                {!! Form::select('format', $formats, isset($book -> format) ? $book -> format : 0, array('id' => 'format', 'class' => 'form-control')); !!}
            </div>
        </div>

        <div class="form-group">
            <label for="inputPageCount" class="col-lg-2 control-label">Page count:</label>
            <div class="col-lg-10">
                <input name="pages" type="number" value="{{{ isset($book -> pages) ? $book -> pages : null }}}" min="1"
                       class="form-control" id="inputPageCount" placeholder="Page count">
            </div>
        </div>

        <div class="form-group">
            <label for="inputCover" class="col-lg-2 control-label">Cover:</label>
            <div class="col-lg-10">
                <div class="upload-img"></div>
                <input name="cover" type="file" class="form-control" id="inputCover" placeholder="Cover">
                @If(isset($book) && $book -> cover_large)
                {!! HTML::image($book -> cover_large) !!}
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('isbn', 'ISBN:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                {!! Form::text('isbn', isset($book) ? $book -> isbn : null, array('class' => 'form-control', 'id' => 'isbn')); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('is_accepted', 'Add to store:', array('class' => 'col-lg-2 control-label')); !!}
            <div class="col-lg-10">
                <div class="radio">
                    <label>
                        <input type="radio" name="is_accepted" id="optionsRadios1" value="1"
                               @if($book -> accepted()) checked="" @endif>
                        yes
                    </label>

                    <label>
                        <input type="radio" name="is_accepted" id="optionsRadios1" value="-1"
                               @if(!$book -> accepted()) checked="" @endif>
                        no
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-2 col-lg-offset-5">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
@stop