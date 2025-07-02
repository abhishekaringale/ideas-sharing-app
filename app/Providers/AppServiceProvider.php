<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();

        // Share the top users with all views
        // Cache the top users for 60 minutes to improve performance
        // This will retrieve the top 5 users based on the number of ideas they have created
        // and cache the result to avoid hitting the database on every request.
        // The cache key is 'topUsers' and it will be refreshed every 60 minutes.
        // If the cache is not available, it will query the database to get the top users.
        // This is useful for displaying the top users on the dashboard or any other page.
        $topUsers = Cache::remember('topUsers', 60, function () {
            return User::withCount('ideas')
                ->orderBy('ideas_count', 'desc')
                ->limit(5)
                ->get();
        });

        View::share('topUsers', $topUsers);
    }
}
