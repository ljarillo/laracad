<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get Plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function ($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter){
                if($filter)
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $permissions;
    }

    public function search($filter = null)
    {
        $results = $this->where('name', $filter)
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }
}
