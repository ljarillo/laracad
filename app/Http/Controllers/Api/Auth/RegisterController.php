<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAthlete;
use App\Http\Resources\AthleteResource;
use App\Services\AthleteService;

class RegisterController extends Controller
{
    protected $athleteService;

    public function __construct(AthleteService $athleteService)
    {
        $this->athleteService = $athleteService;
    }

    public function store(StoreAthlete $request)
    {
        $athlete = $this->athleteService->createNewAthlete($request->all());

        return new AthleteResource($athlete);
    }
}
