<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Cms\Entities\Page;
use Yajra\Datatables\Html\Builder;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param Page $pageRepository
     * @return View|string
     * @internal param Cms $cmsRepository
     */
    public function index(Request $request, Builder $gridBuilder, Page $pageRepository)
    {
        if ($request->ajax()) {
            $pages = $pageRepository->select(['id'])->get();
            return \Datatables::of($pages)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('page.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('cms.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
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
        return view('cms::pages.index', [
            'grid' => $grid,
            'pageTitle' => 'View all Pages'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PageForm::class,[
            'url' => route('page.store'),
            'method' => 'POST'
        ]);
        return view('cms::pages.manage', [
            'form' => $form,
            'title' => 'Create New Cms'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @param Page $pageRepository
     * @return Response
     */
    public function store(Request $request, Page $pageRepository)
    {
        $pageRepository->create(array_filter($request->all(),'strlen'));
        return redirect()->route('page.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Page $page
     * @return Response
     */
    public function edit(Request $request, FormBuilder $formBuilder,Page $page) : Response
    {
        $form = $formBuilder->create(PageForm::class,[
            'model' => $page,
            'url' => route('page.update', $page->id),
            'method' => 'PUT'
        ]);
        return view('cms::pages.manage',[
            'form' => $form,
            'pageTitle' => 'Edit Page '.$page->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Page $page
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Page $page) : RedirectResponse
    {
        $page->update($request->all());
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Page $page
     * @return RedirectResponse|Response
     */
    public function destroy(Page $page) : RedirectResponse
    {
        $page->delete();
        return redirect()->back();
    }
}
