<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\PembayaranUpdated;
use App\Listeners\UpdateStatusSantri;
use App\Listeners\HandlePembayaranDeleted;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ], PembayaranUpdated::class => [
            UpdateStatusSantri::class,
        ],PembayaranDeleted::class => [
            HandlePembayaranDeleted::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
