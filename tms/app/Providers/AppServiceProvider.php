<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCourseRepo();
    }

    public function registerCourseRepo()
    {
        return $this->app->bind(
            'App\Repositories\Course\CourseRepositoryInterface',
            'App\Repositories\Course\CourseRepository'
        );
    }

}
