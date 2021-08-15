<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Manage Post
        Gate::define('manage_posts', function ($user) {
            return $user->hasAnyPermission([
                'post_create',
                'post_update',
                'post_show',
                'post_delete',
                'post_detail'
            ]);
        });

        // Manage Category
        Gate::define('manage_categories', function ($user) {
            return $user->hasAnyPermission([
                'category_create',
                'category_update',
                'category_show',
                'category_delete',
                'category_detail'
            ]);
        });

        // Manage Tag
        Gate::define('manage_tags', function ($user) {
            return $user->hasAnyPermission([
                'tag_create',
                'tag_update',
                'tag_show',
                'tag_delete'
            ]);
        });

        // Manage User
        Gate::define('manage_users', function ($user) {
            return $user->hasAnyPermission([
                'user_create',
                'user_update',
                'user_show',
                'user_delete',
                'user_detail'
            ]);
        });

        // Manage Role
        Gate::define('manage_roles', function ($user) {
            return $user->hasAnyPermission([
                'role_create',
                'role_update',
                'role_show',
                'role_delete',
                'role_detail'
            ]);
        });
    }
}
