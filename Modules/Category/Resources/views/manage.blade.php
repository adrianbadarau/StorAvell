@extends('templating::admin.index')

@section('title')
    <h1>{{$pageTitle}}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Product Information</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! form($form) !!}
                {{--{!! form_until($form,'price') !!}--}}
            </div><!-- /.box-body -->
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="box box-primary">--}}
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title">Product Additional Information</h3>--}}
            {{--</div><!-- /.box-header -->--}}
            {{--<div class="box-body">--}}
                {{--{!! form_until($form,'attributes') !!}--}}
            {{--</div><!-- /.box-body -->--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="box box-primary">--}}
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title">Form Options</h3>--}}
            {{--</div><!-- /.box-header -->--}}
            {{--<div class="box-body">--}}
                {{--{!! form_end($form) !!}--}}
            {{--</div><!-- /.box-body -->--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('scripts')
@endsection