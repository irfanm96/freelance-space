<?php

namespace App\Providers;

use App\Nova\Metrics\InvoicesByStatus;
use App\Nova\Metrics\NewProjects;
use App\Nova\Metrics\NewTeams;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\ProjectsByType;
use App\Nova\Metrics\TasksByType;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\WebhooksByType;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new NewUsers())->canSee(function () {
                return auth()->user()->hasRole('super-admin');
            }),
            (new WebhooksByType())->canSee(function () {
                return auth()->user()->hasRole('super-admin');
            }),
            (new UsersPerDay())->canSee(function () {
                return auth()->user()->hasRole('super-admin');
            }),
            new ProjectsByType(),
            new NewTeams(),
            new NewProjects(),
            new TasksByType(),
            new InvoicesByStatus(),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            \Vyuldashev\NovaPermission\NovaPermissionTool::make()->canSee(function () {
                return auth()->user()->hasRole('super-admin');
            }),
            (new \KABBOUCHI\LogsTool\LogsTool())->canSee(function () {
                return auth()->user()->hasRole('super-admin');
            }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
