<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Workout;
use Illuminate\Http\Request;

class AthleteWorkoutController extends Controller
{
    protected $athlete, $workout;
    public function __construct(Athlete $athlete, Workout $workout)
    {
        $this->athlete = $athlete;
        $this->workout = $workout;

        $this->middleware(['can:athletes']);
    }

    /**
     * athlete to workouts
     *
     * @param  int  $idAthlete
     * @return \Illuminate\Http\Response
     */
    public function workouts($idAthlete)
    {
        if(!$athlete = $this->athlete->find($idAthlete)){
            return redirect()->back();
        }

        $workouts = $athlete->workouts()->paginate();

        return view('admin.pages.athletes.workouts.workouts', [
            'athlete' => $athlete,
            'workouts' => $workouts
        ]);
    }

    /**
     * athlete to workouts
     *
     * @param  int  $idWorkout
     * @return \Illuminate\Http\Response
     */
    public function athletes($idWorkout)
    {
        if(!$workout = $this->workout->find($idWorkout)){
            return redirect()->back();
        }

        $athletes = $workout->athletes()->paginate();

        return view('admin.pages.workouts.athletes.athletes', [
            'workout' => $workout,
            'athletes' => $athletes
        ]);
    }

    /**
     * workouts available to athlete
     *
     * @param  int  $idAthlete
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function workoutsAvailable(Request $request, $idAthlete)
    {
        if(!$athlete= $this->athlete->find($idAthlete)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $workouts = $athlete->workoutsAvailable($request->filter);

        return view('admin.pages.athletes.workouts.available', [
            'athlete' => $athlete,
            'workouts' => $workouts,
            'filters' => $filters
        ]);
    }

    /**
     * attach workouts to athlete
     *
     * @param  int  $idAthlete
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachWorkoutsAthlete(Request $request, $idAthlete)
    {
        if(!$athlete = $this->athlete->find($idAthlete)){
            return redirect()->back();
        }

        if(!$request->workouts || count($request->workouts) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos um treino');
        }

        $athlete->workouts()->attach($request->workouts);

        return redirect()
            ->route('athletes.workouts', $athlete->id)
            ->with('message', 'Atribuida o Treino ao Atleta');
    }

    /**
     * detach workouts to athlete
     *
     * @param  int  $idAthlete
     * @param  int  $idWorkout
     * @return \Illuminate\Http\Response
     */
    public function detachWorkoutsAthlete($idAthlete, $idWorkout)
    {
        $athlete = $this->athlete->find($idAthlete);
        $workout = $this->workout->find($idWorkout);
        if(!$athlete || !$workout){
            return redirect()->back();
        }

        $athlete->workouts()->detach($workout);

        return redirect()
            ->route('athletes.workouts', $athlete->id)
            ->with('message', "Desvinculada o Treino {$workout->name} do Atleta");
    }
}
