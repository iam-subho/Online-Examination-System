<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Services\RBAC;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            // Check if the ability corresponds to a valid submodule code operation
            if (strpos($ability, '.') !== false) {  // Check if it's in submodule_code.type format
                // If it is a valid submodule operation, check permission using RBAC
                $rbac = new RBAC();
                return $rbac->hasPermission($ability,false);
            }
        });
    }
}
