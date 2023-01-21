<?php

namespace HaykMxitaryan\AutoService\FileCreators;

use HaykMxitaryan\AutoService\AutoServiceStorage;

trait HasNamespaceAdapter
{

    /**
     * @param $namespace
     * @return void
     *
     *  We checking if lenght of
     *  namespace isnt 0 then we adding to namespace '/' if lenght is 0 we returning ''
     */

    public function getNamespaceForChecking($namespace)
    {
        // replacing \ to / and adding to the end of namespace / or returning ''

        $namespace = trim($namespace,'\\');

        if(strlen($namespace) !== 0) {
            return str_replace('\\','/',$namespace) . '/';
        }

        return '';
    }

    /**
     * @param $namespace
     * @return string
     *
     *  Method is like getNamespaceForChecking but he adding to namespace '\' not '/'
     */

    public function getNamespaceForCreating($namespace)
    {
        // adding to start and end \ symbol or returning ''

        $namespace = trim($namespace,"\\");

        if(strlen($namespace) !== 0) {
            return '\\' . $namespace . '\\';
        }

        return '';
    }
}
