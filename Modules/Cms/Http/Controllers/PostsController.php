<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Cms\Entities\Post;
use Yajra\Datatables\Html\Builder;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param Cms $cmsRepository
     * @return View | string
     */
    public function index(Request $request, Builder $gridBuilder, Post $postRepository)
    {
        if ($request->ajax()) {
            $posts = $postRepository->select(['id'])->get();
            return \Datatables::of($posts)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('post.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('cms.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
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
        return view('cms::posts.index', [
            'grid' => $grid,
            'pageTitle' => 'View all Posts'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PostForm::class,[
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
