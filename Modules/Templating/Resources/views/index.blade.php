@extends('templating::layouts.master')

@section('content')
    <app-shell>
        <div id="app-shell-header">
            <img src="img/icons/logo.svg" width="171" height="41">
        </div>
        <div id="app-shell-content"></div>
    </app-shell>


    <app-root></app-root>
@stop
