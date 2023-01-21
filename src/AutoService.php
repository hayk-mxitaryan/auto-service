<?php

namespace HaykMxitaryan\AutoService;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AutoService
{
    /**
     * @var AutoServiceStorage
     */

    private AutoServiceStorage $autoServiceStorage;

    /**
     * @var AutoServiceSetting
     */

    private AutoServiceSetting $setting;

    /**
     * @var DirectoryService
     */

    private DirectoryService $directoryService;

    /**
     * @param AutoServiceStorage $autoServiceStorage    // Service class creator
     * @param AutoServiceSetting $setting  // All data setting
     * @param DirectoryService $directoryService    // Directory manager
     *
     *  Constructor
     *
     */

    public function __construct(AutoServiceStorage $autoServiceStorage, AutoServiceSetting $setting, DirectoryService $directoryService)
    {
        $this->autoServiceStorage = $autoServiceStorage;
        $this->setting = $setting;
        $this->directoryService = $directoryService;
    }

    /**
     * @param $command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     *
     *  Handle command and create all files
     */

    public function handle(InputInterface $input, OutputInterface $output)
    {
        // We handling command finish and if command is equal 'make:controller' then when controller creating is
        //  finished we will create service class for controller and base controller in user controller dir

       // setting all data (getting service name,service namespace and more)

        $this->setting->handleAndSet($this->autoServiceStorage, $input);

        // Directory service creating service class by ServiceCreator and craeting base controller by
        //  BaseControllerCreator class

        $this->directoryService->handle($this->autoServiceStorage);

        // making answer in command prompt

        $this->outputMakeAnswer($output);
    }

    /**
     * @param OutputInterface $output
     * @return void
     *
     *      Writing result in command prompt (service creaeted or not,base controller created or not)
     */

    public function outputMakeAnswer(OutputInterface $output)
    {
        // getting all namespaces

        if(strlen($this->autoServiceStorage->getServiceNamespace()) !== 0) {
            $service_namespace = "App\Services\\" . $this->autoServiceStorage->getServiceNamespace() . "\\";
            $base_controller_namespace = "App\Http\Controllers\\" . $this->autoServiceStorage->getServiceNamespace() . "\\";
        }else {
            $service_namespace = "App\Services\\";
            $base_controller_namespace = "App\Http\\Controllers\\";
        }

        // writing success or fail

        if($this->directoryService->getServiceCreatorResult() === false) {
            $output->writeln("<fg=red>" . $service_namespace . $this->autoServiceStorage->getServiceName() . "was already created.<fg=red>");
        }else {
            $output->writeln("<fg=green>" . $service_namespace  . $this->autoServiceStorage->getServiceName() ." created successfully.<fg=green>");
        }

        if($this->directoryService->getBaseControllerCreatorResult() === false) {
            $output->writeln("<fg=red>" . $base_controller_namespace ."BaseController was already created in this directory.<fg=red>");
        }else {
            $output->writeln("<fg=green>". $base_controller_namespace ."BaseController created successfully.<fg=green>");
        }
    }

}
