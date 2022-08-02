<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Athlete extends Model
{
    use TenantTrait;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'expires_at', 'active', 'tenant_id'
    ];

    /**
     * Set the athlete's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get Workout
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class);
    }

    public function workoutsAvailable($filter = null)
    {
        $workouts = Workout::whereNotIn('workouts.id', function ($query){
            $query->select('athlete_workout.athlete_id');
            $query->from('athlete_workout');
            $query->whereRaw("athlete_workout.workout_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter){
                if($filter)
                    $queryFilter->where('workouts.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $workouts;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('email', 'LIKE', "%{$filter}%")
            ->latest()
            ->paginate();

        return $results;
    }
}
