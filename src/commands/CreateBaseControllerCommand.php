<?php

namespace HaykMxitaryan\AutoService\commands;

use HaykMxitaryan\AutoService\AutoServiceSetting;
use HaykMxitaryan\AutoService\DirectoryService;
use HaykMxitaryan\AutoService\FileCreators\BaseControllerCreator;
use HaykMxitaryan\AutoService\FileCreators\ServiceCreator;
use Illuminate\Console\Command;

class CreateBaseControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:base-controller {directory} {--s={service_name}';

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
        $directory_service = new DirectoryService(null,new BaseControllerCreator);

        $result = $directory_service->createBaseControllerOnly($this->argument('directory'),$this->option('s'));

        if(isset($result["error"])) {
            $this->line("<fg=red>" . $result["error"] . "<fg=red>");

            return Command::FAILURE;
        }

        // getting all namespace

        if(strlen($this->argument('directory')) !== 0) {
            $base_controller_namespace = "App\Http\Controllers\\" . $this->argument('directory') . "\\";
        }else {
            $base_controller_namespace = "App\Http\Controllers\\";
        }

        if($result['status'] === false) {
            $this->line("<fg=red>" . $base_controller_namespace . "BaseController was already created.<fg=red>");
        }else {
            $this->line("<fg=green>". $base_controller_namespace ."BaseController created successfully.<fg=green>");
        }

        return Command::SUCCESS;
    }
}
