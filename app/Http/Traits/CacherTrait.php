<?php

namespace App\Http\Traits;

use App\Models\Product;
use App\Models\Category;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

trait CacherTrait
{
    private $products = 'products';
    private $singleProduct = 'product_';
    private $category = 'category';
    private $singleCategory = 'category_';

    /**
     * All cached Products
     */
    public function get_all_products()
    {
        /**
         *  Here we get the products, if there are not there
         *  we query the Database and store it in the cache
         *  then return the results
        */
         $products = Cache::rememberForever($this->products, function () {
            return (new ProductRepository())->getAll();
        });

        return $products;
    }

    /**
     * All cached Active Products
     */
    public function get_active_products()
    {
        /**
         *  Here we get the products, if there are not there
         *  we query the Database and store it in the cache
         *  then return the results
        */
         $products = Cache::rememberForever($this->products, function () {
            return (new ProductRepository())->getActive();
        });

        return $products;
    }

    /**
     * Set cached Products
     */
    public function set_all_products()
    {
        /**
         * Here we are deleting the products cached then we are updating the
         * Products cache with new updated info.
         */
        $queryProducts = (new ProductRepository())->getAll();
        Cache::forget($this->products);
        return Cache::put($this->products,$queryProducts);
    }

    /**
     * Get Product Cache
     */
    public function get_product(int $id)
    {
        $product = Cache::rememberForever($this->singleProduct.$id, function () use ($id) {
            return (new ProductRepository())->getById($id);
        });
        return $product;
    }

    /**
     * Set cached Product
     */
    public function set_product($id)
    {
        /**
         * Here we are deleting the products cached then we are updating the
         * Products cache with new updated info.
         */
        $queryProducts = (new ProductRepository())->getById($id);
        Cache::forget($this->singleProduct.$id);
        return Cache::put($this->singleProduct.$id,$queryProducts);
    }

    /**
     * All cached Category
     */
    public function get_all_categories()
    {
        /**
         *  Here we get the categories, if there are not there
         *  we query the Database and store it in the cache
         *  then return the results
        */
        $category = Cache::rememberForever($this->category, function () {
            return (new CategoryRepository())->getAll();
        });
        return $category;
    }

    /**
     * Get Category Cache
     */
    public function get_category(int $id)
    {
        $category = Cache::rememberForever($this->singleCategory.$id, function () use ($id) {
            return (new CategoryRepository())->getById($id);
        });
        return $category;
    }

    /**
     * Set cached Categories
     */
    public function set_all_categories()
    {
        /**
         * Here we are deleting the products cached then we are updating the
         * Products cache with new updated info.
         */
        $queryCategory = (new CategoryRepository())->getAll();
        Cache::forget($this->category);
        return Cache::put($this->category,$queryCategory);
    }

    /**
     * Set cached Category
     */
    public function set_category($id)
    {
        /**
         * Here we are deleting the Category cached then we are updating the
         * Category cache with new updated info.
         */
        $queryCategory = (new CategoryRepository())->getById($id);
        Cache::forget($this->singleCategory.$id);
        return Cache::put($this->singleCategory.$id,$queryCategory);
    }
}
