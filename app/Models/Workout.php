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
