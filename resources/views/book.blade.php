@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div>
                <h2 class="text-center hidden-lg ">{{{ $book -> title }}}</h2>
                <h2 class="text-center hidden-md hidden-sm hidden-xs">
                    <strong class="pull-left">Author:</strong>
                    {{{ $book -> author }}}
                </h2>
            </div>
            <div class="img-container-lg">
                {!! HTML::image($book -> cover_large) !!}
            </div>
            <div>
                <h3>
                    <strong>Published:</strong>
                    {{{ date('d/m/Y', strtotime($book -> publish)) }}}
                </h3>
            </div>
            <div>
                <h3>
                    <strong>ISBN:</strong>
                    {{{ $book -> isbn }}}
                </h3>
            </div>
            <div>
                <h3>
                    <strong>Pages:</strong>
                    {{{ $book -> pages }}}
                </h3>
            </div>
            <div>
                <h3>
                    <strong>Format:</strong>
                    A{{{ $book -> format }}}
                </h3>
            </div>
        </div>
        <div class="col-lg-7">
            <h2 class="text-center hidden-md hidden-sm hidden-xs">{{{ $book -> title }}}</h2>
            <h2 class="text-center hidden-lg ">
                <strong class="pull-left">Author:</strong>
                {{{ $book -> author }}}
            </h2>


            <div class="col-lg-2">Resume:</div>
            <div class="col-lg-10">
                {{{ $book -> resume }}}
            </div>

        </div>
    </div>
    @if(Auth::check() && Auth::user() -> isFavourite($book -> id))

        {!! Form::open(array('url' => 'bookmarks/' . Auth::user() -> currentFavourite($book -> id) -> id, 'method' => 'DELETE', 'style' => 'display: inline')) !!}
        {!! Form::hidden('book_id', $book -> id) !!}
        <button class="btn btn-link btn-bookmark">
            <i class="fa fa-heart"></i>
        </button>
        {!! Form::close() !!}

    @else

        {!! Form::open(array('url' => 'bookmarks', 'style' => 'display: inline')) !!}
        {!! Form::hidden('book_id', $book -> id) !!}
        <button class="btn btn-link btn-bookmark">
            <i class="fa fa-heart-o"></i>
        </button>
        {!! Form::close() !!}

    @endif

    @if($book -> favouritesCount())
        <span class="bookmarks">bookmarked by</span>
        <div class="btn-group">
            <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                {{{ $book -> favouritesCount() }}}
            </a>
            <ul class="dropdown-menu">
                @foreach($book -> favourites() as $user)
                    <li><a href="#">{{{ $user -> user -> username }}}</a></li>
                @endforeach
            </ul>
        </div>
    @else
        your bookmark will be first
    @endif
    <div class="clear">&nbsp;</div>
@stop