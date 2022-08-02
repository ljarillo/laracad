<?php

namespace App\Observers;

use App\Models\Workout;
use Illuminate\Support\Str;

class WorkoutObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\Workout  $workout
     * @return void
     */
    public function creating(Workout $workout)
    {
        $workout->url = Str::kebab($workout->name);
        $workout->uuid = Str::uuid();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Workout  $workout
     * @return void
     */
    public function updating(Workout $workout)
    {
        $workout->url = Str::kebab($workout->name);
    }
}
