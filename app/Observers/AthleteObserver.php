<?php

namespace App\Observers;

use App\Models\Athlete;
use Illuminate\Support\Str;

class AthleteObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\Athlete $athlete
     * @return void
     */
    public function creating(Athlete $athlete)
    {
        $athlete->uuid = Str::uuid();
    }
}
