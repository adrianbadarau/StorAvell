<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Modules\Cms\Entities\Page;
use Modules\Cms\Forms\PageForm;
use Modules\Cms\Grids\PageIndexGrid;


class PagesController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     * @param PageIndexGrid $grid
     * @return View|JsonResponse
     * @internal param Cms $cmsRepository
     */
    public function index(PageIndexGrid $grid)
    {
        return $grid->render('cms::pages.index', [
            'pageTitle' => 'View all Pages',
            'grid' => $grid->html()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return View
     */
    public function create(FormBuilder $formBuilder) :View
    {
        $form = $formBuilder->create(PageForm::class, [
            'url' => route('page.store'),
            'method' => 'POST'
        ]);

        return view('cms::pages.manage', [
            'form' => $form,
            'pageTitle' => 'Create New Page'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @param Page $pageRepository
     * @return RedirectResponse
     */
    public function store(Request $request, Page $pageRepository) : RedirectResponse
    {

        $form = $this->form(PageForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $pageRepository->create(array_filter($form->getFieldValues(), 'strlen'));
        return redirect()->route('page.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Page $page
     * @return Response|View
     */
    public function edit(Request $request, FormBuilder $formBuilder, Page $page) : View
    {
        $form = $formBuilder->create(PageForm::class, [
            'model' => $page,
            'url' => route('page.update', $page->id),
            'method' => 'PUT'
        ]);
        return view('cms::pages.manage', [
            'form' => $form,
            'pageTitle' => 'Edit Page ' . $page->id
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
