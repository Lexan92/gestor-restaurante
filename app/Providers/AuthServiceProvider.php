<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
            Passport::loadKeysFrom(storage_path('oauth'));
        
    // Opcional si usas claves en otra carpeta
    // Passport::loadKeysFrom(base_path('secrets/oauth'));

    // Opcional: configurar expiración
    // Passport::tokensExpireIn(now()->addDays(7));
    }
}
