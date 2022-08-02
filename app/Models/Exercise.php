<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'url', 'image', 'video', 'description'];

    /**
     * Get Workout
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'workout_exercise')
            ->using(WorkoutExercise::class)
            ->withPivot('repetition','description');
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->latest()
            ->paginate();

        return $results;
    }
}
