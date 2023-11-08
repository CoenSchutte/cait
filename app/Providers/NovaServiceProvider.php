<?php

namespace App\Providers;

use App\Nova\Metrics\InvoicesPerDay;
use App\Nova\Metrics\InvoicesPerProduct;
use App\Nova\Metrics\NewInvoices;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\RegistrationsPerDay;
use App\Nova\Metrics\UsersPerDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\LogViewer\LogViewer;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Taronyuu\NovaMollieTool\NovaMollieTool;

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

        Nova::withBreadcrumbs();

        Nova::userTimezone(function (Request $request) {
            return $request->user()?->timezone;
        });

        Nova::footer(function ($request) {
            return Blade::render('
                <p class="text-center">Powered by <a class="link-default" href="https://nova.laravel.com">Nova</a> · v4.27.13 (Silver Surfer)</p>
                <p class="text-center">© 2023 · by Coen Schutte.</p>'
        );
        });

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
            return $user->is_admin;
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
            new NewUsers(),
            new UsersPerDay(),
            new RegistrationsPerDay(),
            new NewInvoices(),
            new InvoicesPerDay(),
            new InvoicesPerProduct()
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            LogViewer::make(),

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
