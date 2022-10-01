<?php

namespace App\Models;

use App\Events\ProductCategoryEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';

    public function products()
    {
        return $this->belongsTo('App\Models\Product','products_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category','categories_id');
    }

    protected $dispatchesEvents = [
        'created' => ProductCategoryEvent::class,
        'updated' => ProductCategoryEvent::class,
        'deleted' => ProductCategoryEvent::class,
    ];

}
