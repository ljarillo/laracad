<?php

namespace App\Observers;

use App\Models\Exercise;
use Illuminate\Support\Str;

class ExerciseObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return void
     */
    public function creating(Exercise $exercise)
    {
        $exercise->url = Str::kebab($exercise->name);
        $exercise->uuid = Str::uuid();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return void
     */
    public function updating(Exercise $exercise)
    {
        $exercise->url = Str::kebab($exercise->name);
    }
}
