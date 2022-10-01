<?php
namespace App\Repository;

use Auth;

use App\Models\Category;

use Illuminate\Support\Facades\Hash;

class CategoryRepository
{
    /**
     * All Categories
     */
    public function getAll()
    {
        return Category::with('products')->get();
    }

    public function getActive()
    {
        return Category::with('products')->where('is_active',1)->orderBy('created_at', 'DESC')->get();
    }

    public function getById($id)
    {
        return Category::with('products')->where('id',$id)->get()->first();
    }

    public function create( $collection = [] )
    {
        try {
            $category = new Category;
            $category->title = $collection['title'];
            $category->is_active =  $collection['is_active'];
            $category->users_id =  Auth::guard('api')->user()->id;
            $category->save();

            return response()->json(['Category Created'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage(),''], 400);
        }

    }

    public function update( $id, $collection = [] )
    {
        try {
            $category = Category::find($id);
            $category->title = $collection['title'];
            $category->is_active =  $collection['is_active'];
            $category->save();
            return response()->json(['Category Updated'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage(),''], 400);
        }

    }

    public function delete($id)
    {
        try {
            Category::find($id)->delete();
            return response()->json(['Category Deleted'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage(),''], 401);
        }

    }
}
