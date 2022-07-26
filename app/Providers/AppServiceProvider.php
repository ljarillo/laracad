<?php

namespace App\Providers;

use App\Models\Athlete;
use App\Models\Category;
use App\Models\Client;
use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use App\Models\Workout;
use App\Observers\AthleteObserver;
use App\Observers\CategoryObserver;
use App\Observers\ClientObserver;
use App\Observers\ExerciseObserver;
use App\Observers\PlanObserver;
use App\Observers\ProductObserver;
use App\Observers\TableObserver;
use App\Observers\TenantObserver;
use App\Observers\WorkoutObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);
        Athlete::observe(AthleteObserver::class);
        Exercise::observe(ExerciseObserver::class);
        Workout::observe(WorkoutObserver::class);

        /**
         * Custom If Statements
         */
        Blade::if('admin', function (){
            $user = auth()->user();

            return $user->isAdmin();
        });
    }
}
