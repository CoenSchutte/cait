<?php

namespace App\Nova;

use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\UsersPerDay;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $model = \App\Models\User::class;

    public static $title = 'name';

    public static $group = 'User';

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Text::make('Student nummer', 'student_number')
                ->sortable()
                ->rules('required', 'max:7'),

            Date::make('Geboortedatum', 'birthdate')
                ->sortable(),

            Boolean::make('Is Admin', 'is_admin')
                ->default(false),

            Boolean::make('Heeft lopend abonnement', function (\App\Models\User $user) {
                return $user->hasSubscription();
            }),

            Date::make('Lid tot', 'member_until')
                ->hideFromIndex(),

            DateTime::make('Aangemaakt op', 'created_at')
            ->sortable()
            ->hideWhenCreating(),

            DateTime::make('Laatst gewijzigd op', 'updated_at')
                ->hideFromIndex()
                ->hideWhenCreating(),

            HasMany::make('Event Registrations', 'eventRegistrations', UserEventRegistration::class),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [
            new NewUsers(),
            new UsersPerDay()
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [
            new \Coderello\LoginAs\Actions\LoginAs,
        ];
    }
}
