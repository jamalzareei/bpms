<?php

namespace App\Providers;

use App\Models\Notification;
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
        // dd(Notification::where('user_id', auth()->id())->paginate(5));
        // dd(auth()->user());
        View::share('userComposer', auth()->user());
        
        View::composer('*', function($view) {
            $view->with('userComposer', auth()->user());
            $view->with('notifications', Notification::where('user_id', auth()->id())->whereNull('readed_at')->with('user')->latest()->paginate(5));
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
