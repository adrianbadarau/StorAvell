@extends('templating::admin.index')

@section('title')
    <h1>{{$pageTitle}}</h1>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Menu Item Information</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! form($form) !!}
        </div><!-- /.box-body -->
    </div>
@endsection

@section('scripts')
@endsection