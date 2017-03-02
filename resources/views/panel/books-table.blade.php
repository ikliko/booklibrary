@extends('panelViews::mainTemplate')
@section('page-wrapper')
    <h1 class="text-center">Books</h1>
    <a href="{{{ url('panel/book') }}}" class="btn btn-default">All</a>
    <a href="{{{ url('panel/book/pending') }}}" class="btn btn-primary">Pending</a>
    <a href="{{{ url('panel/book/accepted') }}}" class="btn btn-success">Accepted</a>
    <a href="{{{ url('panel/book/declined') }}}" class="btn btn-danger">Declined</a>
    <hr/>
    @if(isset($books) && count($books))
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published</th>
                <th>Format</th>
                <th>ISBN</th>
                <th>options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{{ $book -> id }}}</td>
                    <td>{{{ $book -> title }}}</td>
                    <td>{{{ $book -> author }}}</td>
                    <td>{{{ date('d/m/Y', strtotime($book -> publish)) }}}</td>
                    <td>A{{{ $book -> format }}}</td>
                    <td>{{{ $book -> isbn }}}</td>
                    <td>
                        <div>
                            <a title="Show" href="{{{ url('panel/book/' . $book -> id ) }}}"><span
                                        class="glyphicon glyphicon-list-alt"> </span></a>
                            <a class="text-warning" title="Modify"
                               href="{{{ url('panel/book/' . $book -> id . '/edit') }}}"><span
                                        class="fa fa-edit"> </span></a>
                            <a class="delete text-danger" title="Delete" data-id=""><span
                                        class="glyphicon glyphicon-trash"> </span></a>
                        </div>
                        <div class="hidden">
                            {!! Form::open(array('url' => 'panel/book/' . $book -> id, 'method' => 'delete')) !!}
                            <p>Are you sure you want to delete book "{{{ $book -> title }}}"?</p>
                            {!! Form::button('Не', array('class' => 'btn btn-default btn-sm cancel')) !!}
                            {!! Form::submit('Да', array('class' => 'btn btn-primary btn-sm')) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        no books added
    @endif

    <script>
        $('.delete').on('click', function (evt) {
            var parent = evt.currentTarget.parentElement,
                    nextElement = parent.nextElementSibling;
            $(parent).addClass('hidden');
            $(nextElement).removeClass('hidden');
        });

        $('.cancel').on('click', function (evt) {
            var parent = evt.currentTarget.parentElement.parentElement,
                    nextElement = parent.previousElementSibling;
            $(parent).addClass('hidden');
            $(nextElement).removeClass('hidden');
        });
    </script>
@stop