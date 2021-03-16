<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('administrador', function ($user) {
 
            if ($user->fk_nivelAcesso == 1){
                return true;
            }
 
            return false;
 
        });
        

        Gate::define('rh', function ($user) {
 
            if ($user->fk_nivelAcesso == 2){
                return true;
            }
 
            return false;
 
        });
        Gate::define('rh-adminstracao', function ($user) {
 
            if ($user->fk_nivelAcesso <= 2){
                return true;
            }
 
            return false;
 
        });
        

        Gate::define('gestor', function ($user) {
 
            if ($user->fk_nivelAcesso == 3){
                return true;
            }
 
            return false;
 
        });
        

        Gate::define('tecnico', function ($user) {
 
            if ($user->fk_nivelAcesso == 4){
                return true;
            }
 
            return false;
 
        });
        
    }}
