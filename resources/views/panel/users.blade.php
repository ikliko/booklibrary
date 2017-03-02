@extends('panelViews::mainTemplate')
@section('page-wrapper')
    <h1 class="text-center">Books</h1>
    <hr/>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>options</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($users) && count($users))
            @foreach($users as $user)
                <tr>
                    <td>{{{ $user -> id }}}</td>
                    <td>{{{ $user -> username }}}</td>
                    <td>
                        <div>
                            <a title="Show" href="{{{ url('panel/user/' . $user -> id ) }}}"><span
                                        class="glyphicon glyphicon-list-alt"> </span></a>
                            <a class="text-warning" title="Modify"
                               href="{{{ url('panel/user/' . $user -> id . '/edit') }}}"><span
                                        class="fa fa-edit"> </span></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            no users added
        @endif
        </tbody>
    </table>
@stop