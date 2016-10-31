<?php

namespace Modules\MenuBuilder\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\MenuBuilder\Entities\MenuItem;
use Modules\MenuBuilder\Forms\MenuItemForm;
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
     * @param Request $request
     * @param Builder $gridBuilder
     * @return Response
     */
    public function index(Request $request, Builder $gridBuilder)
    {
        if ($request->ajax()) {
            $menuItems = MenuItem::select(['id', 'label', 'link'])->get();
            return \Datatables::of($menuItems)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('menubuilder.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('menubuilder.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
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
            ->addAction([])
        ;
        return view('menubuilder::index', ['grid' => $grid, 'pageTitle' => 'View All Menu Items']);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MenuItemForm::class);
        return view('menubuilder::manage', [
            'form' => $form,
            'pageTitle' => 'Create New Menu Item'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        MenuItem::create(array_filter($request->all(),'strlen'));
        return redirect()->route('menubuilder.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param MenuItem $menuItem
     * @return Response
     * @internal param MenuItem $menuItemRepository
     * @internal param int $id
     */
    public function edit(Request $request, FormBuilder $formBuilder, MenuItem $menuItem)
    {
        $form = $formBuilder->create(MenuItemForm::class,[
            'model' => $menuItem,
            'url' => route('menubuilder.update', $menuItem->id),
            'method' => 'PUT'
        ]);
        return view('menubuilder::manage',[
            'form' => $form,
            'pageTitle' => 'Edit '.$menuItem->label
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param MenuItem $menuItem
     * @return RedirectResponse|Response
     * @internal param $id
     */
    public function update(Request $request, MenuItem $menuItem) : RedirectResponse
    {
        $menuItem->update($request->all());
        return redirect()->route('menubuilder.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param MenuItem $menuItem
     * @return RedirectResponse|Response
     * @internal param $id
     */
    public function destroy(MenuItem $menuItem) : RedirectResponse
    {
        $menuItem->delete();
        return redirect()->back();
    }
}
