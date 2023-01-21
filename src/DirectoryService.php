<?php

namespace HaykMxitaryan\AutoService;

use HaykMxitaryan\AutoService\CommandImplement\MakeBaseControllerImplementation;
use HaykMxitaryan\AutoService\CommandImplement\MakeServiceImplementation;
use HaykMxitaryan\AutoService\FileCreators\BaseControllerCreator;
use HaykMxitaryan\AutoService\FileCreators\ServiceCreator;


class DirectoryService
{
    use MakeBaseControllerImplementation,MakeServiceImplementation;

    /**
     * @var ServiceCreator
     */

    private ServiceCreator|null $serviceCreator;

    /**
     * @var BaseControllerCreator
     */

    private BaseControllerCreator|null $baseControllerCreator;

    private $service_creator_result = null;

    private $base_controller_creator_result = null;


    /**
     * @param ServiceCreator $serviceCreator    // Service class creator
     * @param BaseControllerCreator $baseControllerCreator    // Base controller class creator
     *
     *    Constructor
     */

    public function __construct(ServiceCreator $serviceCreator = null,BaseControllerCreator $baseControllerCreator = null)
    {
        $this->serviceCreator = $serviceCreator;
        $this->baseControllerCreator = $baseControllerCreator;
    }

    /**
     * @return void     // Handling
     */

    public function handle(AutoServiceStorage $autoServiceStorage)
    {
        /** Making directories if not exists */

        $this->makeServiceDir($autoServiceStorage->getServiceNamespace());
        $this->makeControllerDir($autoServiceStorage->getServiceNamespace());

        /** Making service class */

        $this->service_creator_result = $this->serviceCreator->makeService($autoServiceStorage);

        /** Making base controller in controller folder */

        $this->base_controller_creator_result = $this->baseControllerCreator->makeBaseController($autoServiceStorage);
    }


    public function makeControllerDir($namespace)
    {
        /** User writed namespace folder in controller */

        if(!is_dir('app/Http/Controllers/' . $namespace)) {
            mkdir('app/Http/Controllers/' . $namespace,0777,true);
        }
    }

    public function makeServiceDir($namespace)
    {
        /** App Services Folder */

        if(!is_dir('app/Services')) {
            mkdir('app/Services',0777,true);
        }

        /** User writed namespace folder in service */

        if(!is_dir('app/Services/'  . str_replace('\\','/',$namespace))) {
            mkdir('app/Services/' . str_replace('\\','/',$namespace),0777,true);
        }
    }


    /**
     * @return null|true|false
     */
    public function getBaseControllerCreatorResult()
    {
        return $this->base_controller_creator_result;
    }

    /**
     * @return null|true|false
     */
    public function getServiceCreatorResult()
    {
        return $this->service_creator_result;
    }

}
