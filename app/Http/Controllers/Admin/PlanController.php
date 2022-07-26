<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        $this->middleware(['can:plans']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePlan  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());
        return redirect()
            ->route('plans.index')
            ->with('message', 'Plano inserido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $plan = $this->repository->where('url' , $url)->first();

        if(!$plan){
            return redirect()->back();
        }

        return view('admin.pages.plans.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $plan = $this->repository->where('url' , $url)->first();

        if(!$plan){
            return redirect()->back();
        }

        return view('admin.pages.plans.edit', ['plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePlan  $request
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->repository->where('url' , $url)->first();

        if(!$plan){
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()
            ->route('plans.index')
            ->with('message', 'Plano editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $plan = $this->repository
            ->with('details')
            ->where('url' , $url)
            ->first();

        if(!$plan){
            return redirect()->back();
        }

        if($plan->details->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Existem detalhes vinculados a esse plano, portanto não pode deletar');
        }

        $plan->delete();

        return redirect()
            ->route('plans.index')
            ->with('message', 'Plano deletado com sucesso');
    }

    /**
     * Busca de Planos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
}
