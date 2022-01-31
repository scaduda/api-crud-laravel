<?php

namespace App\Observers;

use App\Models\People;

class PeopleObserver
{
    /**
     * Handle the People "created" event.
     *
     * @param  \App\Models\People  $people
     * @return void
     */
    public function created(People $people)
    {
        //
    }

    /**
     * Handle the People "updated" event.
     *
     * @param  \App\Models\People  $people
     * @return void
     */
    public function updated(People $people)
    {
        //
    }

    /**
     * Handle the People "deleted" event.
     *
     * @param  \App\Models\People  $people
     * @return void
     */
    public function deleted(People $people)
    {
        //
    }

    /**
     * Handle the People "restored" event.
     *
     * @param  \App\Models\People  $people
     * @return void
     */
    public function restored(People $people)
    {
        //
    }

    /**
     * Handle the People "force deleted" event.
     *
     * @param  \App\Models\People  $people
     * @return void
     */
    public function forceDeleted(People $people)
    {
        //
    }
}
