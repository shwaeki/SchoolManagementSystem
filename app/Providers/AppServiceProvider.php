<?php

namespace App\Providers;

use App\Models\AcademicYear;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('activeYear', function () {
            $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();
            $activeAcademicYear = Session::get('activeAcademicYear');
            return $adminActiveAcademicYear->id === $activeAcademicYear->id;
        });

        view()->composer('*', function ($view) {
            $academicYears = AcademicYear::all();
            $adminActiveAcademicYear = $academicYears->where('status', true)->first();
            $activeAcademicYear = Session::get('activeAcademicYear');

            $view->with([
                'academicYears' => $academicYears,
                'adminActiveAcademicYear' => $adminActiveAcademicYear,
                'activeAcademicYear' => $activeAcademicYear,
            ]);
        });

    }
}
