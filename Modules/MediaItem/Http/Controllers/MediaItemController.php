<?php

namespace Modules\MediaItem\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Html\Builder;

class MediaItemController extends Controller
{
    /**
     * @var $app \Illuminate\Foundation\Application
     */
    protected $app;
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param MediaItem $mediaitemRepository
     * @return View | string
     */
    public function index(Request $request, Builder $gridBuilder)
    {
//        return view('mediaitem::index', [
//            'pageTitle' => 'View all mediaitems'
//        ]);
        $dir = 'packages/barryvdh/elfinder/';
        $locale = str_replace("-",  "_", $this->app->config->get('app.locale'));
        if (!file_exists($this->app['path.public'] . "/$dir/js/i18n/elfinder.$locale.js")) {
            $locale = false;
        }
        $csrf = true;

        return view('vendor.elfinder.elfinder', compact('dir', 'locale', 'csrf'));
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
