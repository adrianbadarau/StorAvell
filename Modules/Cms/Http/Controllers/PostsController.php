<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Modules\Cms\Entities\Post;
use Modules\Cms\Forms\PostForm;
use Modules\Cms\Grids\PostIndexGrid;

class PostsController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     * @param PostIndexGrid $grid
     * @return View|string
     * @internal param Request $request
     * @internal param Builder $gridBuilder
     * @internal param Cms $cmsRepository
     */
    public function index(PostIndexGrid $grid)
    {
        return $grid->render('cms::posts.index', [
            'pageTitle' => 'View all Posts',
            'grid' => $grid->html()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder) : View
    {
        $form = $formBuilder->create(PostForm::class, [
            'url' => route('post.store'),
            'method' => 'POST'
        ]);
        return view('cms::posts.manage', [
            'form' => $form,
            'pageTitle' => 'Create New Post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Post $postRepository
     * @return RedirectResponse|Response
     */
    public function store(Post $postRepository): RedirectResponse
    {
        $form = $this->form(PostForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $postRepository->create($form->getFieldValues());
        return redirect()->route('post.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Post $post
     * @return Response
     */
    public function edit(FormBuilder $formBuilder, Post $post): View
    {
        $form = $formBuilder->create(PostForm::class, [
            'model' => $post,
            'url' => route('post.update', $post->id),
            'method' => 'PUT'
        ]);
        return view('cms::posts.manage', [
            'form' => $form,
            'pageTitle' => 'Edit Post ' . $post->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Post $post
     * @return RedirectResponse|Response
     */
    public function update(Post $post): RedirectResponse
    {
        $form = $this->form(PostForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $post->update($form->getFieldValues());
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Post $post
     * @return RedirectResponse|Response
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->back();
    }
}
