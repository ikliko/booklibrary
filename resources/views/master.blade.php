@extends('layouts.default')
@section('body')

    <div class="jumbotron">
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#menu">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{{ url() }}}">
                            <h1>
                                <strong>
                                    {!! HTML::image(config('panel.logo')) !!}
                                </strong>
                            </h1>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="nav navbar-nav">
                            <li @if(strtolower($current) === 'index') class="active" @endif>
                                <a href="{{{ url() }}}">Add Book</a>
                            </li>
                            <li @if(strtolower($current) === 'store') class="active" @endif>
                                <a href="{{{ url('books') }}}">All Books</a>
                            </li>
                        </ul>
                        <div class="col-sm-4 col-xs-12 no-padding" ng-controller="searchController">
                            <form>
                                <div class="input-group stylish-input-group">
                                    <input type="text" class="form-control" placeholder="Find books...(eg Harry Potter)"
                                           ng-model="searchInput" ng-change="searchQuery(searchInput)">
                                    <span class="input-group-addon" style="padding: 0;">
                                        <button type="submit" type="button" class="btn btn-search">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <div class="searchCustomResults" ng-show="hasResults && searchInput">
                                <ul>
                                    <li ng-repeat="result in searchResults">
                                        <a href="<% result.url %>">
                                            <img src="<% result.picture %>" alt=""
                                                 class="col-lg-2 col-md-2 col-sm-1 col-xs-2"/><% result.title %>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            @if(\Auth::check())
                                <li @if(strtolower($current) === 'profile') class="active" @endif>
                                    <a href="{{{ url('profile') }}}"><i
                                                class="fa fa-user"></i> {{{ \Auth::user() -> username }}}</a>
                                </li>
                                <li @if(strtolower($current) === 'bookmarks') class="active" @endif>
                                    <a href="{{{ url('bookmarks') }}}"><i class="fa fa-bookmark"></i></a>
                                </li>
                                <li @if(strtolower($current) === 'edit') class="active" @endif>
                                    <a href="{{{ url('profile/' . Auth::user() -> id . '/edit') }}}"><i
                                                class="fa fa-cog"></i></a>
                                </li>
                                <li @if(strtolower($current) === 'logout') class="active" @endif>
                                    <a href="{{{ url('logout') }}}"><i class="fa fa-sign-out"></i></a>
                                </li>
                            @else
                                <li @if(strtolower($current) === 'login') class="active" @endif>
                                    <a href="{{{ url('login') }}}">Login</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div id="content">
            @include('flash::message')

            @yield('content')
        </div>

        <footer class="text-center">
            Copyright Reserved &copy; Kliko {{{ date('Y') }}}
        </footer>
    </div>
@stop