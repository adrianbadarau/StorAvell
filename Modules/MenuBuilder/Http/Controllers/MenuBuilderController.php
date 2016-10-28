<?php

namespace Modules\MenuBuilder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\MenuBuilder\Entities\MenuItem;

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
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('menubuilder::index',['menuItems'=>$menuItems, 'pageTitle' => 'View All Menu Items']);
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
