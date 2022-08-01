<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateExercise;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    protected $repository;

    public function __construct(Exercise $exercise)
    {
        $this->repository = $exercise;

        $this->middleware(['can:exercises']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercises = $this->repository->latest()->paginate();

        return view('admin.pages.exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateExercise  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateExercise $request)
    {
        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("exercises");
        }

        $this->repository->create($data);

        return redirect()->route('exercises.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$exercise = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$exercise = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateExercise  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateExercise $request, $id)
    {
        if(!$exercise = $this->repository->find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid()){

            if(Storage::exists($exercise->image)){
                Storage::delete($exercise->image);
            }
            $data['image'] = $request->image->store("exercises");
        }

        $exercise->update($data);

        return redirect()->route('exercises.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$exercise = $this->repository->find($id)){
            return redirect()->back();
        }

        $exercise->delete();

        return redirect()->route('exercises.index');
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
        $exercises = $this->repository->search($request->filter);

        return view('admin.pages.exercises.index', [
            'exercises' => $exercises,
            'filters' => $filters
        ]);
    }
}
