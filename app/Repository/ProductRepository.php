<?php
namespace App\Repository;

use Auth;

use App\Models\Product;
use App\Events\ProductEvent;
use App\Models\ProductCategory;
use App\Http\Resources\ProductResource;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class ProductRepository
{
    /**
     * We are getting all the Products.
     */
    public function getAll()
    {
        return Product::with('categories')->get();
    }

    /**
     * We are getting only the products that are active.
     */
    public function getActive()
    {
        return Product::with('categories')->where('is_active',1)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * We are getting a single product by the product ID
     */
    public function getById($id)
    {
        return Product::with('categories')->where('id',$id)->get()->first();
    }

    /**
     * Creating a new Product
     */
    public function create($collection = [] )
    {
        try {
            $user = Auth::guard('api')->user()->id;
            DB::transaction(function () use ($collection,$user) {
                $product=DB::table('products')->insertGetId(
                    array(
                        'title' => $collection['title'],
                        'price' => $collection['price'],
                        'is_active' => $collection['is_active'],
                        'users_id' => $user
                        )
                );
                DB::table('product_categories')->insert(
                    array(
                        'products_id' => $product,
                        'categories_id' => $collection['category']
                        )
                );
            });

            return response()->json(['Product Created'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage(),''], 400);
        }
    }

    /**
     * Updating the product with it's ID
     */
    public function update( $id, $collection = [] )
    {
        try {
            $product = Product::find($id);
            $product->title = $collection['title'];
            $product->price =  $collection['price'];
            $product->is_active =  $collection['is_active'];
            $product->save();
            return response()->json(['Product Updated'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage(),''], 400);
        }
    }

    /**
     * Delete Product
     */
    public function delete($id)
    {
        try {
            $product = Product::find($id)->delete();
            return response()->json(['Product Deleted'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage()], 400);
        }
    }

    /**
     * Add Category to Product
     */
    public function add_category($id, $collection = [])
    {
        try {
            $product = new ProductCategory;
            $product->products_id = $id;
            $product->categories_id = $collection['category'];
            $product->save();

            return response()->json(['Category Added'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage()], 400);
        }
    }

    /**
     * Delete category from Product
     */
    public function delete_category($id, $collection = [])
    {
        try {
            $product = ProductCategory::where([['products_id',$id],['categories_id',$collection['category']]])->delete();
            return response()->json(['Category Deleted'], 200);
        } catch(\Exception $e){
            return response([$e->getMessage()], 400);
        }
    }
}
