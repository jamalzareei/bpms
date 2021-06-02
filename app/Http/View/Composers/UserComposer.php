<?php

namespace App\Http\View\Composers;

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
        $view->with('userComposer', auth()->user());
    }
    
    public function user(View $view)
    {
        // $view->with('user', 'jamal');
    }
}
