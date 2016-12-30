<?php

namespace Modules\MediaItem\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\MediaItem\Entities\MediaItem;
use Modules\MediaItem\Forms\MediaItemForm;
use Yajra\Datatables\Html\Builder;

class MediaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param MediaItem $mediaitemRepository
     * @return View | string
     */
    public function index(Request $request, Builder $gridBuilder, MediaItem $mediaitemRepository)
    {
        if ($request->ajax()) {
            $mediaitems = $mediaitemRepository->select(['id'])->get();
            return \Datatables::of($mediaitems)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('mediaitem.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('mediaitem.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
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
        return view('mediaitem::index', [
            'grid' => $grid,
            'pageTitle' => 'View all mediaitems'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MediaItemForm::class,[
            'url' => route('mediaitem.store'),
            'method' => 'POST'
        ]);
        return view('mediaitem::manage', [
            'form' => $form,
            'title' => 'Create New MediaItem'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, MediaItem $mediaitemRepository)
    {
        $mediaitemRepository->create(array_filter($request->all(),'strlen'));
        return redirect()->route('mediaitem.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param MediaItem $mediaitem
     * @return Response
     */
    public function edit(Request $request, FormBuilder $formBuilder,MediaItem $mediaitem) : Response
    {
        $form = $formBuilder->create(MediaItemForm::class,[
            'model' => $mediaitem,
            'url' => route('mediaitem.update', $mediaitem->id),
            'method' => 'PUT'
        ]);
        return view('mediaitem::manage',[
            'form' => $form,
            'pageTitle' => 'Edit MediaItem'.$mediaitem->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param MediaItem $mediaitem
     * @return RedirectResponse|Response
     */
    public function update(Request $request, MediaItem $mediaitem) : RedirectResponse
    {
        $mediaitem->update($request->all());
        return redirect()->route('mediaitem.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param MediaItem $mediaitem
     * @return RedirectResponse|Response
     */
    public function destroy(MediaItem $mediaitem) : RedirectResponse
    {
        $mediaitem->delete();
        return redirect()->back();
    }
}
