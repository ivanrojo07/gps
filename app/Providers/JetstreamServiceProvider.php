<?php

namespace App\Providers;

<<<<<<< HEAD
=======

>>>>>>> 5ab9bf4daeb1cdcc4e87331dd9dd2dbdb90b1133
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

<<<<<<< HEAD
=======

>>>>>>> 5ab9bf4daeb1cdcc4e87331dd9dd2dbdb90b1133
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

<<<<<<< HEAD
=======

>>>>>>> 5ab9bf4daeb1cdcc4e87331dd9dd2dbdb90b1133
        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
