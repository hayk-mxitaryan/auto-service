<?php

namespace HaykMxitaryan\AutoService\CommandImplement;

trait MakeServiceImplementation
{

    /**
     * @param string $arguments
     * @return array
     *
     *  Creating service class
     */

    public function createServiceOnly(string $arguments)
    {
        // parsing arguments

        $arguments = $this->parseArguments($arguments);

        // making service directory if not exists

        $this->makeServiceDir($arguments['service_namespace']);

        // creating file and returning data to command

        return [
            "status" => $this->serviceCreator->createFile($arguments['service_namespace'],$arguments['service_name']),
            "arguments" => $arguments
        ];
    }

    /**
     * @param string $argument
     * @return array
     *
     *  Getting setted arguments array
     */

    public function parseArguments(string $argument)
    {
        $argument = trim($argument,"\\");


        $exploded_arguments = explode('\\',$argument);

        $argument_name = end($exploded_arguments);

        array_pop($exploded_arguments);

        $argument_namespace = "";

        foreach($exploded_arguments as $argument) {
            $argument_namespace .= $argument . "\\";
        }

        $argument_namespace = substr($argument_namespace,0,-1);

        return [
            "service_name" => $argument_name,
            "service_namespace" => $argument_namespace,
        ];
    }
}
