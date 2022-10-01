<?php

namespace App\Http\Controllers;

use App\Http\Traits\CacherTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Repository\ProductRepository;

class ProductController extends Controller
{
    use CacherTrait;
    private $product;

    /**
     * Create a new ProductController instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $product)
    {
        $this->middleware('auth:api');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->get_all_products();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->get_product($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $validatedData = $request->validated();
        return  $this->product->create($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);

        return $this->product->update($id, $collection);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->product->delete($id);
    }

    public function category_add(Request $request,$id)
    {
        $collection = $request->except(['_token','_method']);

        return $this->product->add_category($id, $collection);
    }

    public function category_delete(Request $request,$id)
    {
        $collection = $request->except(['_token','_method']);

        return $this->product->delete_category($id, $collection);
    }
}
