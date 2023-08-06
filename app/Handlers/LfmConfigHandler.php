<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Session;
use UniSharp\LaravelFilemanager\Handlers\ConfigHandler;

class LfmConfigHandler extends ConfigHandler
{
    public function userField()
    {
        return Session::get('fileManagerConfig');
    }
}
