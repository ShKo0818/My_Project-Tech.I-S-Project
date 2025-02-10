<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Item;
use App\Policies\ItemPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Item::class => app\Policies\ItemPolicy.php::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // 一般ユーザーにアクセス権を付与する
        Gate::define('is_general', function ($user) {
            return $user->user_type === 'general';
        });

        // 法人またはマスターユーザーにアクセス権を付与する
        Gate::define('is_corporate_or_master', function ($user) {
            return in_array($user->user_type, ['corporate', 'master']);
        });
    }
}
