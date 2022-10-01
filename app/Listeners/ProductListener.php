<?php

namespace App\Listeners;

use App\Http\Traits\CacherTrait;
use App\Events\ProductEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductListener
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
     * @param  \App\Events\ProductEvent  $event
     * @return void
     */
    public function handle(ProductEvent $event)
    {
        /**
         * Here we are updating the Products cache
         */
        $this->set_all_products();
        // We are updating a single product Cache
        $this->set_product($event->product->id);
    }
}
