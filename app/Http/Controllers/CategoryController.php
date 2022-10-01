<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\CacherTrait;
use App\Http\Requests\CategoryRequest;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    use CacherTrait;
    private $categoryRepo;

    /**
     * Create a new CategoryController instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepo) {
        $this->middleware('auth:api');
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->get_all_categories();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $validatedData = $request->validated();
        return  $this->categoryRepo->create($collection);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->get_category($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);

        return $this->categoryRepo->update($id, $collection);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->categoryRepo->delete($id);
    }
}
