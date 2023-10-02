<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\InvoicesPerDay;
use App\Nova\Metrics\InvoicesPerProduct;
use App\Nova\Metrics\NewInvoices;
use App\Nova\Metrics\NewRegistrations;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\RegistrationsPerDay;
use App\Nova\Metrics\RegistrationsPerEvent;
use App\Nova\Metrics\UsersPerDay;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new NewUsers(),
            new UsersPerDay(),
            new NewInvoices(),
            new InvoicesPerDay(),
            new InvoicesPerProduct(),
            new NewRegistrations(),
            new RegistrationsPerDay(),
            new RegistrationsPerEvent(),
        ];
    }
}
