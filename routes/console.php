<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//deleta usuários com mais de 6 meses expirado
Schedule::command('users:delete-expired')->dailyAt('21:30');