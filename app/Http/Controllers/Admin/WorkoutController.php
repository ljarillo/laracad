<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateWorkout;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutController extends Controller
{
    protected $repository;

    public function __construct(Workout $workout)
    {
        $this->repository = $workout;

        $this->middleware(['can:workouts']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workouts = $this->repository->latest()->paginate();

        return view('admin.pages.workouts.index', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateWorkout  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateWorkout $request)
    {
        $this->repository->create($request->all());

        return redirect()
            ->route('workouts.index')
            ->with('message', 'Atleta inserido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$workout = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.workouts.show', compact('workout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$workout = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.workouts.edit', compact('workout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateWorkout  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateWorkout $request, $id)
    {
        if(!$workout = $this->repository->find($id)){
            return redirect()->back();
        }

        $workout->update($request->all());

        return redirect()->route('workouts.index')
            ->with('message', 'Atleta editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('workouts.index');
    }

    /**
     * search results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $workouts = $this->repository->search($request->filter);

        return view('admin.pages.workouts.index', [
            'workouts' => $workouts,
            'filters' => $filters
        ]);
    }
}
