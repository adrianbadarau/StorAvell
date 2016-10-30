@extends('templating::admin.index')

@section('title')
    <h1>{{$pageTitle}}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">All Menu Items.</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                {{--<table class="table">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>#</th>--}}
                        {{--<th>Label</th>--}}
                        {{--<th>Link</th>--}}
                        {{--<th>Icon</th>--}}
                        {{--<th>Active</th>--}}
                        {{--<th>Options</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@forelse($menuItems as $menuItem)--}}
                        {{--<tr>--}}
                            {{--<th scope="row">{{$menuItem->id}}</th>--}}
                            {{--<td>{{$menuItem->label}}</td>--}}
                            {{--<td>{{$menuItem->link}}</td>--}}
                            {{--<td><i class="fa fa-{{$menuItem->icon_class}}" aria-hidden="true"></i></td>--}}
                            {{--<td>--}}
                                {{--@if($menuItem->is_active)--}}
                                    {{--<span>Yes</span>--}}
                                {{--@else--}}
                                    {{--<span>No</span>--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>Options</td>--}}
                        {{--</tr>--}}
                    {{--@empty--}}
                        {{--<tr colspan="5">--}}
                            {{--<td scope="row">There are no menu items</td>--}}
                        {{--</tr>--}}
                    {{--@endforelse--}}
                    {{--</tbody>--}}
                {{--</table>--}}

                {!! $grid->table() !!}
            </div><!-- /.box-body -->
        </div>
    </div>

@endsection

@section('scripts')
    {!! $grid->scripts() !!}
@endsection
