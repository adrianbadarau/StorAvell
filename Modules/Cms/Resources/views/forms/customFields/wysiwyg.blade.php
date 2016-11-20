{{--@php(dd($options))--}}

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::label($name, $options['label'], $options['label_attr']) !!}
@endif
@if ($showField)
    {!! Form::textarea($name, $options['value'], $options['attr']) !!}
    @if ($options['help_block']['text'] && !$options['is_child'])
        <{!! $options['help_block']['tag'] !!} {!! $options['help_block']['helpBlockAttrs'] !!}>
            {!! $options['help_block']['text'] !!}
        </{!! $options['help_block']['tag'] !!}>
    @endif
@endif

@if ($showError && isset($errors))
    @foreach ($errors->get($nameKey) as $err)
        <div {!! $options['errorAttrs'] !!}> {!! $err !!}</div>
    @endforeach
@endif

@section('scripts')
    <script src="{{url('vendor/ckeditor/ckeditor.js')}}"></script>
@endsection
@push('scripts')
<script>
    CKEDITOR.replace('{{$name}}');
</script>
@endpush