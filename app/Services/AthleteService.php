<?php

namespace App\Services;

use App\Repositories\Contracts\AthleteRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class AthleteService
{
    protected $athleteRepository;

    public function __construct(AthleteRepositoryInterface $athleteRepository)
    {
        $this->athleteRepository = $athleteRepository;
    }

    public function createNewAthlete(array $data)
    {
        return $this->athleteRepository->createNewAthlete($data);
    }
}
