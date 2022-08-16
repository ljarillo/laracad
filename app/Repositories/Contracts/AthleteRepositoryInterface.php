<?php

namespace App\Repositories\Contracts;

interface AthleteRepositoryInterface
{
    public function createNewAthlete(array $data);
    public function getWorkoutsByAthlete();
    public function getWorkoutByAthleteUuid(string $uuid);
}
