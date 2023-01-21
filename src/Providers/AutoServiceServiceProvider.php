<?php

namespace HaykMxitaryan\AutoService\Providers;

use App\Console\Commands\CreateController;
use HaykMxitaryan\AutoService\commands\CommandFilesModified;
use HaykMxitaryan\AutoService\commands\CreateBaseControllerCommand;
use HaykMxitaryan\AutoService\commands\CreateControllerCommand;
use HaykMxitaryan\AutoService\commands\CreateServiceCommand;
use Illuminate\Support\ServiceProvider;

class AutoServiceServiceProvider extends ServiceProvider
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
        $this->commands([
            CommandFilesModified::class,
            CreateControllerCommand::class,
            CreateServiceCommand::class,
            CreateBaseControllerCommand::class
        ]);
    }
}
