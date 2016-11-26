<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Modules\Cms\Entities\Category;
use Modules\Cms\Forms\CategoryForm;
use Modules\Cms\Grids\CategoryIndexGrid;

class CategoriesController extends Controller
{
    use FormBuilderTrait;
    /**
     * Display a listing of the resource.
     * @param CategoryIndexGrid $grid
     * @return View|string
     * @internal param Request $request
     * @internal param Builder $gridBuilder
     * @internal param Category $categoryRepository
     */
    public function index(CategoryIndexGrid $grid)
    {
        return $grid->render("cms::categories.index",[
            'pageTitle' => 'All categories',
            'grid' => $grid->html()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response|View
     */
    public function create(FormBuilder $formBuilder) : View
    {
        $form = $formBuilder->create(CategoryForm::class,[
            'url' => route('cms.category.store'),
            'method' => 'POST'
        ]);
        return view('cms::categories.manage', [
            'form' => $form,
            'pageTitle' => 'Create New Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Category $categoryRepository
     * @return RedirectResponse|Response
     */
    public function store(Category $categoryRepository) : RedirectResponse
    {
        $form = $this->form(CategoryForm::class);
        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $categoryRepository->create($form->getFieldValues());
        return redirect()->route('cms.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param FormBuilder $formBuilder
     * @param Category $category
     * @return Response|View
     */
    public function edit( FormBuilder $formBuilder,Category $category) : View
    {
        $form = $formBuilder->create(CategoryForm::class,[
            'model' => $category,
            'url' => route('cms.category.update', $category->id),
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
        $form = $this->form(CategoryForm::class);
        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $category->update($form->getFieldValues());
        return redirect()->route('cms.category.index');
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
