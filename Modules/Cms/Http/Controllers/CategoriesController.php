<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Cms\Entities\Category;
use Modules\Cms\Entities\Cms;
use Modules\Cms\Forms\CmsForm;
use Yajra\Datatables\Html\Builder;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param Category $categoryRepository
     * @return View|string
     */
    public function index(Request $request, Builder $gridBuilder, Category $categoryRepository)
    {
        if ($request->ajax()) {
            $categories = $categoryRepository->select(['id'])->get();
            return \Datatables::of($categories)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('cms_category.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('cms.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
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
        return view('cms::categories.index', [
            'grid' => $grid,
            'pageTitle' => 'View all Categories'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CategoryForm::class,[
            'url' => route('cms_category.store'),
            'method' => 'POST'
        ]);
        return view('cms::categories.manage', [
            'form' => $form,
            'title' => 'Create New Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @param Category $categoryRepository
     * @return Response
     */
    public function store(Request $request, Category $categoryRepository)
    {
        $categoryRepository->create(array_filter($request->all(),'strlen'));
        return redirect()->route('cms_category.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Category $category
     * @return Response
     */
    public function edit(Request $request, FormBuilder $formBuilder,Category $category) : Response
    {
        $form = $formBuilder->create(CategoryForm::class,[
            'model' => $category,
            'url' => route('cms_category.update', $category->id),
            'method' => 'PUT'
        ]);
        return view('cms::categories.manage',[
            'form' => $form,
            'pageTitle' => 'Edit Category '.$category->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Category $category
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Category $category) : RedirectResponse
    {
        $category->update($request->all());
        return redirect()->route('cms_category.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return RedirectResponse|Response
     */
    public function destroy(Category $category) : RedirectResponse
    {
        $category->delete();
        return redirect()->back();
    }
}
