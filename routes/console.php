<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:about', function () {
    $this->comment('Personal Task Manager');
})->purpose('Display the application details');
