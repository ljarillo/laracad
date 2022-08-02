<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function (){

        /**
         * Role x User
         */
        Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRolesUser')
            ->name('users.roles.detach');
        Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')
            ->name('users.roles.attach');
        Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')
            ->name('users.roles.available');
        Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')
            ->name('users.roles');
        Route::get('roles/{id}/users', 'ACL\RoleUserController@users')
            ->name('roles.users');

        /**
         * Permission x Role
         */
        Route::get('roles/{id}/permission/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionsRole')
            ->name('roles.permissions.detach');
        Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')
            ->name('roles.permissions.attach');
        Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')
            ->name('roles.permissions.available');
        Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')
            ->name('roles.permissions');
        Route::get('permissions/{id}/role', 'ACL\PermissionRoleController@roles')
            ->name('permissions.roles');

        /**
         * Routes Roles
         */
        Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
        Route::resource('roles', 'ACL\RoleController');

        /**
         * Routes Tables
         */
        Route::get('tables/qrcode/{identify}', 'TableController@qrcode')->name('tables.qrcode');
        Route::any('tables/search', 'TableController@search')->name('tables.search');
        Route::resource('tables', 'TableController');

        /**
         * Product x Category
         */
        Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoriesProduct')
            ->name('products.categories.detach');
        Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')
            ->name('products.categories.attach');
        Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')
            ->name('products.categories.available');
        Route::get('products/{id}/categories', 'CategoryProductController@categories')
            ->name('products.categories');
        Route::get('categories/{id}/products', 'CategoryProductController@products')
            ->name('categories.products');

        /**
         * Routes Tenants
         */
        Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
        Route::resource('tenants', 'TenantController');

        /**
         * Routes Products
         */
        Route::any('products/search', 'ProductController@search')->name('products.search');
        Route::resource('products', 'ProductController');

        /**
         * Routes Categories
         */
        Route::any('categories/search', 'CategoryController@search')->name('categories.search');
        Route::resource('categories', 'CategoryController');

        /**
         * Routes Workout X Exercise
         */
        Route::get('athletes/{id}/workouts/{idExercise}/detach', 'ACL\AthleteWorkoutController@detachWorkoutsAthlete')
            ->name('athletes.workouts.detach');
        Route::post('athletes/{id}/workouts', 'ACL\AthleteWorkoutController@attachWorkoutsAthlete')
            ->name('athletes.workouts.attach');
        Route::any('athletes/{id}/workouts/create', 'ACL\AthleteWorkoutController@workoutsAvailable')
            ->name('athletes.workouts.available');
        Route::get('athletes/{id}/workouts', 'ACL\AthleteWorkoutController@workouts')
            ->name('athletes.workouts');

        /**
         * Routes Athletes
         */
        Route::any('athletes/search', 'AthleteController@search')->name('athletes.search');
        Route::resource('athletes', 'AthleteController');

        /**
         * Routes Workout X Exercise
         */
        Route::get('workouts/{id}/exercises/{idExercise}/detach', 'ACL\WorkoutExerciseController@detachExercisesWorkout')
            ->name('workouts.exercises.detach');
        Route::post('workouts/{id}/exercises', 'ACL\WorkoutExerciseController@attachExercisesWorkout')
            ->name('workouts.exercises.attach');
        Route::any('workouts/{id}/exercises/create', 'ACL\WorkoutExerciseController@exercisesAvailable')
            ->name('workouts.exercises.available');
        Route::get('workouts/{id}/exercises', 'ACL\WorkoutExerciseController@exercises')
            ->name('workouts.exercises');

        /**
         * Routes Workout
         */
        Route::any('workouts/search', 'WorkoutController@search')->name('workouts.search');
        Route::resource('workouts', 'WorkoutController');

        /**
         * Routes Exercise
         */
        Route::any('exercises/search', 'ExerciseController@search')->name('exercises.search');
        Route::resource('exercises', 'ExerciseController');

        /**
         * Routes Users
         */
        Route::any('users/search', 'UserController@search')->name('users.search');
        Route::resource('users', 'UserController');

        /**
         * Plans x Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilesPlan')
            ->name('plans.profiles.detach');
        Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')
            ->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')
            ->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')
            ->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')
            ->name('profiles.plans');


        /**
         * Profiles x Permissions
         */
        Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')
            ->name('profiles.permissions.detach');
        Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')
            ->name('profiles.permissions.attach');
        Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')
            ->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')
            ->name('profiles.permissions');
        Route::get('permissions/{id}/profiles', 'ACL\PermissionProfileController@profiles')
            ->name('permissions.profiles');

        /**
         * Routes Permissions
         */
        Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
        Route::resource('permissions', 'ACL\PermissionController');

        /**
         * Routes Profiles
         */
        Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
        Route::resource('profiles', 'ACL\ProfileController');

        /**
         * Routes Details Plans
         */
        Route::resource('plans/{url}/details', 'DetailPlanController');

        /**
         * Routes Plans
         */
        Route::any('plans/search', 'PlanController@search')->name('plans.search');
        Route::resource('plans', 'PlanController');

        /**
         * Home Dashborad
         */
        Route::get('/', 'DashboardController@home')->name('admin.index');
});


/**
 * Site
 */
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
 * Auth Routes
 */
Auth::routes();
