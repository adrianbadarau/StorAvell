@extends('templating::admin.index')

@section('title')
    <h1>{{$pageTitle}}</h1>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Page Information</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! form($form) !!}
        </div><!-- /.box-body -->
    </div>
@endsection

@push('scripts')
<script>
    $(document).on('blur','#title', function () {
        var strTile = $(this).val();
        $('#slug').val(convertToSlug(strTile));
    });
    $(document).on('blur', '#slug', function () {
        $(this).val(convertToSlug($(this).val()));
    });
    function convertToSlug(value)
    {
        return value.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
    }
</script>
@endpush