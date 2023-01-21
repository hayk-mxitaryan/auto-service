<?php

namespace HaykMxitaryan\AutoService\FileCreators;

use HaykMxitaryan\AutoService\AutoServiceStorage;

class ServiceCreator
{
    use HasNamespaceAdapter;

    /**
     * @param AutoServiceStorage $autoServiceStorage
     * @return false|true
     *
     *    Making service in user putted namespace
     */

    public function makeService(AutoServiceStorage $autoServiceStorage)
    {
        // checking if service class already exists in this directory.

        if(!$this->serviceAlreadyExists($autoServiceStorage->getServiceNamespace(),$autoServiceStorage->getServiceName())) {

            // creating service class

            $this->createFile($autoServiceStorage->getServiceNamespace(),$autoServiceStorage->getServiceName());

            return true;
        }

        return false;
    }

    public function createFile($service_namespace,$service_name)
    {
        if(!$this->serviceAlreadyExists($service_namespace,$service_name)) {
            $service = fopen('app/Services/' . $this->getNamespaceForChecking($service_namespace) . $service_name . ".php", "w+");

            fwrite($service, "<?php

namespace App\Services" . substr($this->getNamespaceForCreating($service_namespace),0,-1) . ";

class {$service_name}
{

}

             ");

            fclose($service);

            return true;
        }

        return false;
    }


    /**
     * @param AutoServiceStorage $autoServiceStorage
     * @return bool
     *
     *      Checking if directory app/services/ and user putted namespace are empty then we can
     *      add service class if not then we cant add
     */

    public function serviceAlreadyExists($namespace,$name)
    {

        // getting document root of directory

        if(file_exists('app/Services/' . $this->getNamespaceForChecking($namespace) . $name  . '.php')) {
            return true;
        }

        return false;
    }

}
