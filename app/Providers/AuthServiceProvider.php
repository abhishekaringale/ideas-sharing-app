<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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

        Gate::define('isAdmin', function (User $user) {
            return (bool) $user->is_admin;
        });


        //instead of defining gates for each action, we can use policies

        // Gate::define('idea.delete', function(User $user, Idea $idea){
        //     return (bool) $user->is_admin || $user->id === $idea->user_id;
        // });
        // Gate::define('idea.edit', function(User $user, Idea $idea){
        //     return (bool) $user->is_admin || $user->id === $idea->user_id;
        // });
    }
}
