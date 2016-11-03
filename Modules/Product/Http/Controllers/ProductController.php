<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Product\Entities\Product;
use Modules\Product\Forms\ProductForm;
use Yajra\Datatables\Html\Builder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Builder $gridBuilder
     * @param Product $productRepository
     * @return View | string
     */
    public function index(Request $request, Builder $gridBuilder, Product $productRepository)
    {
        if ($request->ajax()) {
            $products = $productRepository->select(['id', 'name', 'price'])->get();
            return \Datatables::of($products)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('product.edit',$item->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'." | " .'<a href="' . route('product.destroy',$item->id) . '" class="btn btn-xs btn-danger" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="fa fa-trash"></i> Delete</a>';
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
        $grid = $gridBuilder
            ->addColumn([
                'data' => 'id', 'name' => 'id', 'title' => '#'
            ])
            ->addColumn([
                'data' => 'name', 'name' => 'name', 'title' => 'Product name'
            ])
            ->addColumn([
                'data' => 'price', 'name' => 'price', 'title' => 'Product Price'
            ])
            ->addAction([])
        ;
        return view('product::index', [
            'grid' => $grid,
            'pageTitle' => 'View all products'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param FormBuilder $formBuilder
     * @return Response|View
     */
    public function create(FormBuilder $formBuilder) : View
    {
        $form = $formBuilder->create(ProductForm::class,[
            'method' => 'POST',
            'url' => route('product.store')
        ]);
        return view('product::manage',[
            'pageTitle' => "Create new Product",
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @param Product $productRepository
     * @return Response
     */
    public function store(Request $request, Product $productRepository)
    {
        $productRepository->create($request->all());
        return redirect()->route('product.index');
    }

    public function show(Request $request, Product $product) : Response
    {
        return response($product);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param Product $product
     * @return Response|View
     */
    public function edit(Request $request, FormBuilder $formBuilder,Product $product) : View
    {
        $form = $formBuilder->create(ProductForm::class,[
            'method' => 'PUT',
            'url' => route('product.update', $product->id),
            'model' => $product
        ]);
        return view('product::manage',[
            'pageTitle' => 'Edit product' . $product->name,
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Product $product
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Product $product) : RedirectResponse
    {
        $product->update($request->all());
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return RedirectResponse|Response
     */
    public function destroy(Product $product) : RedirectResponse
    {
        $product->delete();
        return redirect()->back();
    }
}
