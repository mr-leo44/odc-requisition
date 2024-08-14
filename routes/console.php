<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('req:send-pending-email')->everyFifteenMinutes();
Schedule::command('req:ensure-users-created')->everyThirtyMinutes();
Schedule::command('req:count-level')->everyThreeMinutes();
Schedule::command('req:drop-deleted-requisitions')->everySixHours();
