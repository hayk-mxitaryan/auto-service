<?php

namespace HaykMxitaryan\AutoService;

class AutoServiceStorage
{
    /**
     * @var     // Controller name
     */

    private $controller_name;

    /**
     * @var     // Service name
     */

    private $service_name;

    /**
     * @var     // Service namespace
     */

    private $service_namespace;

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controller_name;
    }

    /**
     * @return mixed
     */
    public function getServiceName()
    {
        return $this->service_name;
    }

    /**
     * @return mixed
     */
    public function getServiceNamespace()
    {
        return $this->service_namespace;
    }

    /**
     * @param mixed $controller_name
     */
    public function setControllerName($controller_name): void
    {
        $this->controller_name = $controller_name;
    }

    /**
     * @param mixed $service_name
     */
    public function setServiceName($service_name): void
    {
        $this->service_name = $service_name;
    }

    /**
     * @param mixed $service_namespace
     */
    public function setServiceNamespace($service_namespace): void
    {
        $this->service_namespace = $service_namespace;
    }

}
