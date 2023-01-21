<?php

namespace HaykMxitaryan\AutoService\CommandImplement;

trait MakeBaseControllerImplementation
{

    /**
     * @param string $directory
     * @param $services
     * @return array
     *
     *  Creating base controller
     *
     */

    public function createBaseControllerOnly(string $directory,$services)
    {
        // parsing data

        $data = $this->parseBaseControllerServices($services,$directory);

        if(isset($data["error"])) {
            return $data;
        }

        // making base controller service if not exists

        $this->makeControllerDir($directory);

        // creating base controller class and returning finish data to command

        return [
            "status" => $this->baseControllerCreator->createFile($directory,$data),
        ];
    }

    /**
     * @param string $services
     * @param string $directory
     * @return array
     *
     *  Parsing ang getting setted data
     */

    public function parseBaseControllerServices(string $services,string $directory): array
    {

        if($services == "{service_name" || $services == null && $services == "") {
            return $data = [
                "includes" => "",
                "param_uses" => "",
                "vars" => "",
                "construct_setting" =>  '',
            ];
        }

        // exploding $services to get all user selected services

        $exploded_services = explode('-',$services);

        // data of base controller class to set all dependencies in class creator

        $data = [
            "includes" => "",
            "param_uses" => "",
            "vars" => "",
            "construct_setting" =>  '',
        ];

        foreach ($exploded_services as $service) {
            if(file_exists("app/Services/" . str_replace('\\','/',$service) . ".php")) {

                // creating includes of service like use Dir\ServiceName to put in base controller

                $data['includes'] .= "use " . "App\\Services\\" . $service . ';'."\n";

                $service_namespace = explode('\\',$service);

                $service_name = end($service_namespace);

                // getting variables of services to put in base controller

                $data['vars'] .= '    public ' . $service_name . ' $' . $service_name . ';'."\n";

                // getting parameTer uses like __construct(Service $service) to put in base controller

                if(end($exploded_services) == $service) {
                    $data['param_uses'] .= $service_name . ' $' ."$service_name";
                }else {
                    $data['param_uses'] .= $service_name . ' $' ."$service_name" . ',';
                }

                // getting construct setting like (this->service = service)  to put in base controller

                $data['construct_setting'] .= '       $this->' . $service_name . " = " . '$' . $service_name . ';'."\n";

            }else {
                return [
                    "error" => "Service " . $service . " doesnt exists",
                ];
            }
        }

        return $data;
    }
}
