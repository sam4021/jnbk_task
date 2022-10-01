<?php

namespace App\Listeners;

use App\Http\Traits\CacherTrait;
use App\Events\CategoryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class CategoryListener
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
     * @param  \App\Events\CategoryEvent  $event
     * @return void
     */
    public function handle(CategoryEvent $event)
    {
        /**
         * Here we are updating the Category cache
         */
        $this->set_all_categories();
        $this->set_category($event->category->id);
    }
}
