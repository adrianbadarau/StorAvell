<?php
/**
 * Created by PhpStorm.
 * User: adrianbadarau
 * Date: 28/10/2016
 * Time: 07:33
 */
?>
@php($items = Menu::get('AdminMenu')->roots())

<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    @foreach($items as $menuItem)
        <li class="treeview">
            <a href="{{$menuItem->url()}}">
                @if($menuItem->icon)
                    {!! $menuItem->prependIcon()->title !!}
                @else
                    <span>{!! $menuItem->title !!}</span>
                @endif
                @if($menuItem->hasChildren())
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                @endif
            </a>
            @if($menuItem->hasChildren())
            <ul class="treeview-menu">
                @foreach($menuItem->children() as $child)
                    <li class="">
                        <a href="{{$child->url()}}">
                            @if($child->icon)
                                {!! $child->prependIcon()->title !!}
                            @else
                                <span>{!! $child->prependIcon()->title !!}</span>
                            @endif
                            @if($child->hasChildren())
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            @endif
                        </a>
                        @if($child->hasChildren())
                        <ul class="treeview-menu">
                            @foreach($child->children() as $menuChild)
                                <li class="">
                                    <a href="{{$menuChild->url()}}">
                                    @if($menuChild->icon)
                                        {!! $menuChild->prependIcon()->title !!}
                                    @else
                                        <span>{!! $menuChild->prependIcon()->title !!}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            @endif
        </li>
    @endforeach
</ul>