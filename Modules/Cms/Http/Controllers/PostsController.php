<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Cms\Entities\Post;
use Modules\Cms\Grids\PostIndexGrid;

class PostsController extends Controller
{
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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(Posts::class,[
            'url' => route('post.store'),
            'method' => 'POST'
        ]);
        return view('cms::posts.manage', [
            'form' => $form,
            'title' => 'Create New Post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @param Post $postRepository
     * @return Response
     */
    public function store(Request $request, Post $postRepository)
    {
        $postRepository->create(array_filter($request->all(),'strlen'));
        return redirect()->route('post.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Post $post
     * @return Response
     */
    public function edit(Request $request, FormBuilder $formBuilder,Post $post) : Response
    {
        $form = $formBuilder->create(PostForm::class,[
            'model' => $post,
            'url' => route('cms.update', $post->id),
            'method' => 'PUT'
        ]);
        return view('cms::manage',[
            'form' => $form,
            'pageTitle' => 'Edit Post '.$post->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Post $post
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Post $post) : RedirectResponse
    {
        $post->update($request->all());
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Post $post
     * @return RedirectResponse|Response
     */
    public function destroy(Post $post) : RedirectResponse
    {
        $post->delete();
        return redirect()->back();
    }
}
