<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);

        /*Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (is_null($user->email_verified_at)){
                return view('verify-email');
            }

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });*/

        
        Fortify::verifyEmailView(function(){
            return view('autu.verify-email');
        });

        Fortify::registerView(function () {
            return view('register');
        });

        Fortify::loginView(function () {
            return view('login');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });

    }
}
