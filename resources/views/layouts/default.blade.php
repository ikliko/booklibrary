<html lang="en-US">
<head>
    <title>eLab Book Store @if($title)| {{{ $title }}} @endif</title>
    <link rel="icon" type="image/png" href="{{{ config('panel.favicon') }}}">
    {!! HTML::style('css/bootstrap.min.css'); !!}
    {!! HTML::style('css/bootstrap-theme.min.css'); !!}
    {!! HTML::style('css/style.css'); !!}
    {!! HTML::style('css/responsive.css'); !!}
    {!! HTML::style('css/font-awesome.min.css'); !!}
</head>
<body ng-app="booklibrary">

@yield('body')

{!! HTML::script('scripts/libs/jquery.min.js') !!}
{!! HTML::script('scripts/libs/bootstrap.min.js') !!}
{!! HTML::script('scripts/libs/angular.min.js') !!}
{!! HTML::script('scripts/libs/angular-resource.min.js') !!}
{!! HTML::script('scripts/app.js') !!}
{!! HTML::script('scripts/controllers/searchController.js') !!}
{!! HTML::script('scripts/services/searchService.js') !!}
</body>
</html>