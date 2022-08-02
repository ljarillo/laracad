<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Category;
use App\Models\Exercise;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $tenant = auth()->user()->tenant;

        $totalAthletes = Athlete::where('tenant_id', $tenant->id)->count();
        $totalWorkout = Workout::where('tenant_id', $tenant->id)->count();
        $totalExercises = Exercise::count();
        $totalTenants = Tenant::count();
        $totalPlans = Plan::count();
        $totalRoles = Role::count();
        $totalProfiles = Profile::count();
        $totalPermissions = Permission::count();

        return view('admin.pages.home.home', compact(
            'totalAthletes',
            'totalWorkout',
            'totalExercises',
            'totalTenants',
            'totalPlans',
            'totalRoles',
            'totalProfiles',
            'totalPermissions'
        ));
    }
}
