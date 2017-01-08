@extends('templating::admin.index')

@section('title')
    <h1>{{$pageTitle}}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">All Posts.</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <a href="{{route('post.create')}}"><button class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add New</button></a>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">

                {!! $grid->table() !!}
            </div><!-- /.box-body -->
        </div>
    </div>

@endsection

@push('scripts')
    {!! $grid->scripts() !!}
@endpush