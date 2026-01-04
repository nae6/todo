<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Responses\LoginResponse as CustomLoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Responses\LogoutResponse as CustomLogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(LogoutResponse::class, CustomLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        // Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::registerView(function ()
        {
            return view('auth.register');
        });

        Fortify::loginView(function ()
        {
            return view('auth.login');
        });

        RateLimiter::for('login', function (Request $request)
        {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });

        // RateLimiter::for('two-factor', function (Request $request) {
            // return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });
    }
}
