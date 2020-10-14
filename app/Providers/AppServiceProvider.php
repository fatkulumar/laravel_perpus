<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });
    
         Gate::define('isManager', function($user) {
             return $user->role == 'manager';
         });
    
         Gate::define('isUser', function($user) {
             return $user->role == 'user';
         });

         Config(['app.locale' => 'id']);
         Carbon::setLocale('id');
         date_default_timezone_set('Asia/Jakarta');
    }
}
