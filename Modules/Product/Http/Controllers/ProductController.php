<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Product\Entities\Product;
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
     * @return Response
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    public function show(Request $request, Product $product) : Response
    {
        return response($product);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, Product $product) : View
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
