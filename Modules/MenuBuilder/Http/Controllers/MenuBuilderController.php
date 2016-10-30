<?php

namespace Modules\MenuBuilder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\MenuBuilder\Entities\MenuItem;
use Yajra\Datatables\Html\Builder;

class MenuBuilderController extends Controller
{
    /**
     * MenuBuilderController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, Builder $gridBuilder)
    {
        if ($request->ajax()) {
            $menuItems = MenuItem::select(['id', 'label', 'link'])->get();
            return \Datatables::of($menuItems)
                ->addColumn('action', function ($user) {
                    return '<a href="#edit-' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
        $grid = $gridBuilder
            ->addColumn([
                'data' => 'id', 'name' => 'id', 'title' => '#'
            ])
            ->addColumn([
                'data' => 'label', 'name' => 'label', 'title' => 'label'
            ])
            ->addColumn([
                'data' => 'link', 'name' => 'link', 'title' => 'link'
            ])
            ->addAction([
                'data' => 'action', 'name' => 'action', 'title' => 'action'
            ])
        ;
        return view('menubuilder::index', ['grid' => $grid, 'pageTitle' => 'View All Menu Items']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('menubuilder::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('menubuilder::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
