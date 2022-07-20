<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $profile, $plan;
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->profile = $profile;
        $this->plan = $plan;

        $this->middleware(['can:plans']);
    }

    /**
     * Get plans
     *
     * @param  int  $idProfile
     * @return \Illuminate\Http\Response
     */
    public function plans($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', [
            'profile' => $profile,
            'plans' => $plans
        ]);
    }

    /**
     * Get profiles
     *
     * @param  int  $idPlan
     * @return \Illuminate\Http\Response
     */
    public function profiles($idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', [
            'plan' => $plan,
            'profiles' => $profiles
        ]);
    }

    /**
     * profiles available to plan
     *
     * @param  int  $idPlan
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function profilesAvailable(Request $request, $idPlan)
    {
        if(!$plan= $this->plan->find($idPlan)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles,
            'filters' => $filters
        ]);
    }

    /**
     * attach profiles to plan
     *
     * @param  int  $idPlan
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachProfilesPlan(Request $request, $idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

        if(!$request->profiles || count($request->profiles) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos um perfil');
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()
            ->route('plans.profiles', $plan->id)
            ->with('message', 'Atribuida os perfis');
    }

    /**
     * detach profile to plan
     *
     * @param  int  $idPlan
     * @param  int  $idProfile
     * @return \Illuminate\Http\Response
     */
    public function detachProfilesPlan($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);
        if(!$plan || !$profile){
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()
            ->route('plans.profiles', $plan->id)
            ->with('message', "Desvinculada a permissão {$profile->name} do perfil");
    }
}
