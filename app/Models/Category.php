<?php

namespace App\Models;

use App\Events\CategoryEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','product_categories','categories_id','products_id');
    }

    protected $fillable = [
        'title',
        'is_active'
    ];

    protected $dispatchesEvents = [
        'created' => CategoryEvent::class,
        'updated' => CategoryEvent::class,
        'deleted' => CategoryEvent::class,
    ];
}
