<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateAthlete;
use App\Models\Athlete;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    protected $repository;

    public function __construct(Athlete $athlete)
    {
        $this->repository = $athlete;

        $this->middleware(['can:athletes']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athletes = $this->repository->latest()->paginate();

        return view('admin.pages.athletes.index', compact('athletes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.athletes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateAthlete  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAthlete $request)
    {
        $this->repository->create($request->all());

        return redirect()
            ->route('athletes.index')
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
        if(!$athlete = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.athletes.show', compact('athlete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$athlete = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.athletes.edit', compact('athlete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$athlete = $this->repository->find($id)){
            return redirect()->back();
        }

        $athlete->update($request->all());

        return redirect()->route('athletes.index')
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

        return redirect()->route('athletes.index');
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
        $athletes = $this->repository->search($request->filter);

        return view('admin.pages.athletes.index', [
            'athletes' => $athletes,
            'filters' => $filters
        ]);
    }
}
