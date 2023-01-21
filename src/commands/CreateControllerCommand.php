<?php

namespace HaykMxitaryan\AutoService\commands;

use HaykMxitaryan\AutoService\AutoService;
use HaykMxitaryan\AutoService\AutoServiceSetting;
use HaykMxitaryan\AutoService\AutoServiceStorage;
use HaykMxitaryan\AutoService\DirectoryService;
use HaykMxitaryan\AutoService\FileCreators\BaseControllerCreator;
use HaykMxitaryan\AutoService\FileCreators\ServiceCreator;
use Illuminate\Console\Command;
use Illuminate\Routing\Console\ControllerMakeCommand;

class CreateControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "make:controller {name} {--s}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // calling controller make command class for creating controller

        $this->call(ControllerMakeCommand::class,$this->arguments());

        // if user used option --s then he want to create service class and base controller then we creating them

        if($this->option('s') == true) {
            $autoService = new AutoService(
                new AutoServiceStorage(),
                new AutoServiceSetting(),
                new DirectoryService(new ServiceCreator,new BaseControllerCreator));

            $autoService->handle($this->input,$this->output);
        }

        return Command::SUCCESS;
    }
}
