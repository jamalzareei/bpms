<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        View::share('userComposer', auth()->user());
        
        View::composer('*', function($view) {
            $view->with('userComposer', auth()->user());
            // dd($userComposer);
            // $camper = \App\Camper::where('email', Auth::user()->email)->first();
        });

        // View::composer('userComposer', auth()->user());
        // view()->composers([
        //     'App\Http\View\Composers\UserComposer' => '*',
        //     'App\Http\View\Composers\UserComposer@user' => '*'
        // ]);
    }
}
