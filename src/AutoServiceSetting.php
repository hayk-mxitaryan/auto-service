<?php

namespace HaykMxitaryan\AutoService;

use Symfony\Component\Console\Input\InputInterface;

class AutoServiceSetting
{

    /**
     * @param AutoServiceStorage $autoServiceStorage
     * @param InputInterface $input
     * @return void
     *
     *      Handling and setting all data (getting service name and setting,service namespace and more)
     */

    public function handleAndSet(AutoServiceStorage $autoServiceStorage,InputInterface $input)
    {
        if(!str_contains($input->getArgument('name'),'\\')) {
            $autoServiceStorage->setServiceName($this->getServiceName($input->getArgument('name')));
            $autoServiceStorage->setServiceNamespace("");

            return;
        }

        // getting command prompt controller namespace like "ExampleDirectory\ExampleController"

        $autoServiceStorage->setControllerName($input->getArgument('name'));

        // coverting string controller namespace to array for work with him

        $array_controller_namespace = explode('\\',$autoServiceStorage->getControllerName());

        // getting and setting service namespace

        $autoServiceStorage->setServiceNamespace($this->getServiceNamespace($array_controller_namespace));

        // getting and setting service name
        // end($array_controller_namespace) is controller name like ExampleController

        $autoServiceStorage->setServiceName($this->getServiceName(end($array_controller_namespace)));
    }

    /**
     * @param $array_controller_namespace
     * @param AutoServiceStorage $autoServiceStorage
     * @return string
     *
     *      Getting service namespace from controller namespace
     */

    public function getServiceNamespace($array_controller_namespace)
    {

        // last element of array controller namespace is controller name and we deleting him becaause we
        // need namespace without controller name

        array_pop($array_controller_namespace);

        // creating string service namespace without controller name

        $service_namespace = "";

        foreach($array_controller_namespace as $part) {
            $service_namespace .= $part . "\\";
        }

        // if last symbol of controller namespace is \ then we deleting it

        if($service_namespace[-1] == "\\") {
            $service_namespace = substr($service_namespace,0,-1);
        }

        // returning service namespace

        return $service_namespace;
    }

    /**
     * @param $controller_name
     * @return mixed|string
     *
     *  if we have in controller name "controller" we need to delete this part and get controller name without
     *  part "controller" like "Example" we need to this to get service name. And service name will be
     *" ExampleService". We getting controller name without "controller"
     *  part and just adding in the end word "Service" to create service class.
     *
     * else just return controller name to set service name
     */

    public function getServiceName($controller_name)
    {
        if(stripos($controller_name,'controller') !== false && mb_strtolower($controller_name) !== "controller") {
            // getting and setting service name

            if(strlen($controller_name) == 20 && mb_strtolower(substr($controller_name,10,10)) == "controller" && mb_strtolower(substr($controller_name,0,10)) == "controller") {
                return substr($controller_name,10,10);
            }else {
                $service_name = stripos($controller_name,'Controller');

                return substr($controller_name,0,$service_name) . "Service";
            }

        }else {
            // if controller name dont have part "controller" just

            return $controller_name . "Service";
        }
    }

}
