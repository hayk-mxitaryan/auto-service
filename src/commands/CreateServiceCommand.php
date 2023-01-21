<?php

namespace HaykMxitaryan\AutoService\commands;


use HaykMxitaryan\AutoService\AutoServiceSetting;
use HaykMxitaryan\AutoService\DirectoryService;
use HaykMxitaryan\AutoService\FileCreators\ServiceCreator;
use Illuminate\Console\Command;

class CreateServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service-class {name}';

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

        // using directory class to create service class

        $directory_service = new DirectoryService(new ServiceCreator);

        $result = $directory_service->createServiceOnly($this->argument('name'));

        // making namespace like "App\Services\Namespace\Service" to write in command prompt

        if(strlen($result["arguments"]["service_namespace"]) !== 0) {
            $result["arguments"]["service_namespace"] = "App\Services" . "\\" . $result["arguments"]["service_namespace"] . "\\";
        }else {
            $result["arguments"]["service_namespace"] = "App\Services\\";
        }

        // if service created we returning success if not that means that we alredy have service

        if($result['status'] === false) {
            $this->line("<fg=red>Service " . $result['arguments']["service_namespace"] .  $result['arguments']["service_name"] . " was already created.<fg=red>");
        }else {
            $this->line("<fg=green>Service "  . $result['arguments']["service_namespace"] .  $result['arguments']["service_name"] . " created successfully.<fg=green>");
        }

        return Command::SUCCESS;
    }
}
