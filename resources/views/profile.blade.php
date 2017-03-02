@extends('master')
@section('content')
    <div class="row">
        @foreach($books as $book)
            @include('sections.book', ['book' => $book])
        @endforeach
    </div>

    <div class="pages">
        {!! $pages !!}
    </div>
@stop