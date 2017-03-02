@extends('panelViews::mainTemplate')
@section('page-wrapper')
    <style>
        .clear {
            clear: both;
        }
    </style>
    <h1 class="text-center">{{{ $book -> title }}}</h1>
    <hr/>
    <div class="row">
        <div class="col-lg-2 text-right">
            <strong>
                Author:
            </strong>
        </div>
        <div class="col-lg-10">
            {!! HTML::image($book -> cover_large) !!}
        </div>
        <div class="clear">&nbsp;</div>

        <div class="col-lg-2 text-right">
            <strong>
                Author:
            </strong>
        </div>
        <div class="col-lg-10">
            {{{ $book -> author }}}
        </div>
        <div class="clear">&nbsp;</div>

        <div class="col-lg-2 text-right">
            <strong>
                Resume:
            </strong>
        </div>
        <div class="col-lg-10">
            {{{ $book -> resume }}}
        </div>
        <div class="clear">&nbsp;</div>

        <div class="col-lg-2 text-right">
            <strong>
                Publish date:
            </strong>
        </div>
        <div class="col-lg-10">
            {{{ $book -> publish }}}
        </div>
        <div class="clear">&nbsp;</div>

        <div class="col-lg-2 text-right">
            <strong>
                Format:
            </strong>
        </div>
        <div class="col-lg-10">
            A{{{ $book -> format }}}
        </div>
        <div class="clear">&nbsp;</div>

        <div class="col-lg-2 text-right">
            <strong>
                Pages:
            </strong>
        </div>
        <div class="col-lg-10">
            {{{ $book -> pages }}}
        </div>
        <div class="clear">&nbsp;</div>

        <div class="col-lg-2 text-right">
            <strong>
                ISBN:
            </strong>
        </div>
        <div class="col-lg-10">
            {{{ $book -> isbn }}}
        </div>
    </div>
    <div class="clear">&nbsp;</div>
    <div class="form-group">
        <div class="col-lg-12">
            <div class="btn-group btn-group-justified">
                <a href="{{{ url('/panel/book/' . $book -> id . '/edit') }}}" class="btn btn-primary">Edit</a>
                <a class="btn btn-danger delete">Delete</a>
                <a href="{{ url('/panel/book') }}" class="btn btn-default">Table</a>
            </div>
            <div class="hidden">
                {!! Form::open(array('url' => 'panel/book/' . $book -> id, 'method' => 'delete', 'style' => 'min-width: 100px;')) !!}
                <p style="text-align: center;">Сигурни ли сте, че искате да изтриете продукта?</p>
                <div class="col-lg-offset-5 col-lg-2">
                    {!! Form::button('Не', array('class' => 'btn btn-default btn-sm cancel')) !!}
                    {!! Form::submit('Да', array('class' => 'btn btn-primary btn-sm')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="clear">&nbsp;</div>

    <script>
        $('.delete').on('click', function (evt) {
            var parent = evt.currentTarget.parentElement,
                    nextElement = parent.nextElementSibling;
            $(parent).addClass('hidden');
            $(nextElement).removeClass('hidden');
        });

        $('.cancel').on('click', function (evt) {
            var parent = evt.currentTarget.parentElement.parentElement.parentElement,
                    nextElement = parent.previousElementSibling;
            $(parent).addClass('hidden');
            $(nextElement).removeClass('hidden');
        });
    </script>
@stop