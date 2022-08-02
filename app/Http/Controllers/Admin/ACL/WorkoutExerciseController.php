<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutExerciseController extends Controller
{
    protected $workout, $exercise;

    public function __construct(Workout $workout, Exercise $exercise)
    {
        $this->workout = $workout;
        $this->exercise = $exercise;

        $this->middleware(['can:workouts']);
    }

    /**
     * workout to exercises
     *
     * @param  int  $idWorkout
     * @return \Illuminate\Http\Response
     */
    public function exercises($idWorkout)
    {
        if(!$workout = $this->workout->find($idWorkout)){
            return redirect()->back();
        }

        $exercises = $workout->exercises()->paginate();

        return view('admin.pages.workouts.exercises.index', [
            'workout' => $workout,
            'exercises' => $exercises
        ]);
    }

    /**
     * workout to exercises
     *
     * @param  int  $idExercise
     * @return \Illuminate\Http\Response
     */
    public function workouts($idExercise)
    {
        if(!$exercise = $this->exercise->find($idExercise)){
            return redirect()->back();
        }

        $workouts = $exercise->workouts()->paginate();

        return view('admin.pages.exercises.workouts.workouts', [
            'exercise' => $exercise,
            'workouts' => $workouts
        ]);
    }

    /**
     * exercises available to workout
     *
     * @param  int  $idWorkout
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function exercisesAvailable(Request $request, $idWorkout)
    {
        if(!$workout= $this->workout->find($idWorkout)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $exercises = $workout->exercisesAvailable($request->filter);

        return view('admin.pages.workouts.exercises.available', [
            'workout' => $workout,
            'exercises' => $exercises,
            'filters' => $filters
        ]);
    }

    /**
     * attach exercises to workout
     *
     * @param  int  $idWorkout
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachExercisesWorkout(Request $request, $idWorkout)
    {
        if(!$workout = $this->workout->find($idWorkout)){
            return redirect()->back();
        }

        if(!$request->exercises || count($request->exercises) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos um exercíocio');
        }
        $exercises = [];
        foreach ($request->exercises as $exercise){
            if (array_key_exists("exercise_id", $exercise)) {
                $exercises[] = $exercise;
            }
        }

        $workout->exercises()->attach($exercises);

        return redirect()
            ->route('workouts.exercises', $workout->id)
            ->with('message', 'Atribuido o exercício ao treino');
    }

    /**
     * detach exercises to workout
     *
     * @param  int  $idWorkout
     * @param  int  $idExercise
     * @return \Illuminate\Http\Response
     */
    public function detachExercisesWorkout($idWorkout, $idExercise)
    {
        $workout = $this->workout->find($idWorkout);
        $exercise = $this->exercise->find($idExercise);
        if(!$workout || !$exercise){
            return redirect()->back();
        }

        $workout->exercises()->detach($exercise);

        return redirect()
            ->route('workouts.exercises', $workout->id)
            ->with('message', "Desvinculado o exercício {$exercise->name} do treino");
    }
}
