<?php

namespace App\Repositories;

use App\Models\Athlete;
use App\Repositories\Contracts\AthleteRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AthleteRepository implements AthleteRepositoryInterface
{
    protected $entity;

    public function __construct(Athlete $athlete)
    {
        $this->entity = $athlete;
    }

    public function createNewAthlete(array $data)
    {
        $tenant = DB::table('tenants')
            ->where('uuid', $data['uuid'])
            ->first();
        $data['tenant_id'] = $tenant->id;
        $data['password'] = bcrypt($data['password']);
        return $this->entity->create($data);
    }

    public function getWorkoutByAthleteUuid(string $uuid)
    {
        // TODO: Implement getWorkoutByAthleteUuid() method.
    }

    public function getWorkoutsByAthlete()
    {
        // TODO: Implement getWorkoutsByAthlete() method.
    }
}
