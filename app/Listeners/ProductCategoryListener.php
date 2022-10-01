<?php

namespace App\Listeners;

use App\Http\Traits\CacherTrait;
use App\Events\ProductCategoryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductCategoryListener
{
    use CacherTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductCategoryEvent  $event
     * @return void
     */
    public function handle(ProductCategoryEvent $event)
    {
        /**
         * Here we are updating the Products & Category cache
         */
        $this->set_all_products();
        $this->set_all_categories();
        $this->set_product($event->productCategory->products_id);
        $this->set_category($event->productCategory->categories_id);
    }
}
