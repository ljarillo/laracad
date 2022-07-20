<?php

namespace App\Observers;

use App\Models\Table;
use Illuminate\Support\Str;

class TableObserver
{
    /**
     * Handle the table "created" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function creating(Table $table)
    {
        $table->uuid = Str::uuid();
    }
}
