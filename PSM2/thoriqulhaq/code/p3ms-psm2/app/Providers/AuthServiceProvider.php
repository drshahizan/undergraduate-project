<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public static $permissions = [
        'staff-access' => ['Staff PIC', 'Staff Operator'],
        'staff-pic-access' => ['Staff PIC'],
        'staff-operator-access' => ['Staff Operator'],
        'admin-access' => ['Admin'],
    ];
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
        foreach (self::$permissions as $action => $roles) {
            Gate::define($action, function (User $user) use ($roles) {
                return in_array($user->user_type, $roles);
            });
        }
    }
}
