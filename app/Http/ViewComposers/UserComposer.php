<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class UserComposer
{
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user', auth()->user());
    }
    
    public function user(View $view)
    {
        // $view->with('user', 'jamal');
    }
}
