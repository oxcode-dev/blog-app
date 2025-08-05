<?php

use App\Console\Commands\FetchNewsFromApi;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('app:fetch-news-from-api')->everySecond();
// Schedule::command('app:fetch-article-from-nyt')->everySecond();

// Schedule::call(new FetchNewsFromApi())->daily();