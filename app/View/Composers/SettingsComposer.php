<?php

namespace App\View\Composers;

use App\Helpers\SettingsHelper;
use Illuminate\View\View;

class SettingsComposer
{
    public function compose(View $view)
    {
        $view->with('settings', SettingsHelper::getAll());
    }
}
