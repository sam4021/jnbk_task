<?php

namespace App\Models;

use App\Events\ProductEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_categories','products_id','categories_id');
    }

    protected $fillable = [
        'title',
        'price',
        'is_active',
    ];

    protected $dispatchesEvents = [
        'created' => ProductEvent::class,
        'updated' => ProductEvent::class,
        'deleted' => ProductEvent::class,
    ];
}
