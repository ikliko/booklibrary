@extends('master')
@section('content')
    @if(count($books))
        <div class="row">
            @foreach($books as $book)
                @include('sections.book', ['book' => $book])
            @endforeach
        </div>

        <div>
            {!! $pages !!}
        </div>
    @else
        Not added yet
    @endif
@stop