<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Cms\Entities\Cms;
use Modules\Cms\Forms\CmsForm;
use Yajra\Datatables\Html\Builder;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param Cms $cmsRepository
     * @return View | string
     */
    public function index(Request $request, Builder $gridBuilder, Cms $cmsRepository)
    {
        if ($request->ajax()) {
            $cmss = $cmsRepository->select(['id'])->get();
            return \Datatables::of($cmss)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('cms.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('cms.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
        $grid = $gridBuilder
            ->addColumn([
                'data' => 'id', 'name' => 'id', 'title' => '#'
            ])
            ->addAction([])
        ;
        return view('cms::index', [
            'grid' => $grid,
            'pageTitle' => 'View all cmss'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CmsForm::class,[
            'url' => route('cms.store'),
            'method' => 'POST'
        ]);
        return view('cms::manage', [
            'form' => $form,
            'title' => 'Create New Cms'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, Cms $cmsRepository)
    {
        $cmsRepository->create(array_filter($request->all(),'strlen'));
        return redirect()->route('cms.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Cms $cms
     * @return Response
     */
    public function edit(Request $request, FormBuilder $formBuilder,Cms $cms) : Response
    {
        $form = $formBuilder->create(CmsForm::class,[
            'model' => $cms,
            'url' => route('cms.update', $cms->id),
            'method' => 'PUT'
        ]);
        return view('cms::manage',[
            'form' => $form,
            'pageTitle' => 'Edit Cms'.$cms->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Cms $cms
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Cms $cms) : RedirectResponse
    {
        $cms->update($request->all());
        return redirect()->route('cms.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Cms $cms
     * @return RedirectResponse|Response
     */
    public function destroy(Cms $cms) : RedirectResponse
    {
        $cms->delete();
        return redirect()->back();
    }
}
