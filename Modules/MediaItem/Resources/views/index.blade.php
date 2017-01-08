@extends('templating::admin.index')
@push('master-css')
    <link href="{{url('vendor/jquery-colorbox/colorbox.css')}}" rel="stylesheet"></link>
@endpush
@section('title')
    <h1>{{$pageTitle}}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">All mediaitem Items.</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <a href="{{route('mediaitems.create')}}"><button class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add New</button></a>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <label for="feature_image">Feature Image</label>
                <input type="text" id="feature_image" name="feature_image" value="">
                <a href="" class="popup_selector" data-inputid="feature_image">Select Image</a>
            </div><!-- /.box-body -->
        </div>
    </div>

@endsection

@push('master-scripts')
    <script type="text/javascript" src="{{url('vendor/jquery-colorbox/jquery.colorbox-min.js')}}"></script>
    <script type="text/javascript" src="{{url('vendor/jquery-colorbox/standalonepopup.min.js')}}"></script>
@endpush