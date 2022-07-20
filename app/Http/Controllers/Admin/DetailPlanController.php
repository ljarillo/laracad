<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;

        $this->middleware(['can:plans']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            redirect()->back();
        }

        $details = $plan->details()->paginate();
//        $details = $plan->details();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            redirect()->back();
        }
        return view('admin.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateDetailPlan  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()
            ->route('details.index', $plan->url)
            ->with('message', 'Detalhe do plano inserido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $urlPlan
     * @param  int  $idDetail
     * @return \Illuminate\Http\Response
     */
    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url' , $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail){
            redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $urlPlan
     * @param  int  $idDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail){
            redirect()->back();
        }
        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateDetailPlan  $request
     * @param  string  $urlPlan
     * @param  id  $idDetail
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail){
            redirect()->back();
        }

        $detail->update($request->all());

        return redirect()
            ->route('details.index', $plan->url)
            ->with('message', 'Detalhe do plano alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $urlPlan
     * @param  id  $idDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail){
            redirect()->back();
        }

        $detail->delete();

        return redirect()
            ->route('details.index', $plan->url)
            ->with('message', 'Detalhe do plano deletado com sucesso');
    }
}
