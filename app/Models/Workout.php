<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workout extends Model
{
    use TenantTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'url', 'description', 'period_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get Exercise
     */
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class,'workout_exercise')
            ->using(WorkoutExercise::class)
            ->withPivot('repetition','description');
    }

    public function exercisesAvailable($filter = null)
    {
        $exercises = Exercise::whereNotIn('exercises.id', function ($query){
            $query->select('workout_exercise.exercise_id');
            $query->from('workout_exercise');
            $query->whereRaw("workout_exercise.workout_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter){
                if($filter)
                    $queryFilter->where('exercises.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $exercises;
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
