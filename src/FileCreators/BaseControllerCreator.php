<?php

namespace HaykMxitaryan\AutoService\FileCreators;

use HaykMxitaryan\AutoService\AutoServiceStorage;

class BaseControllerCreator
{
    use HasNamespaceAdapter;

    /**
     * @param AutoServiceStorage $autoServiceStorage
     * @return true|false
     *
     *      Making base controller in user writed namespace
     */

    public function makeBaseController(AutoServiceStorage $autoServiceStorage)
    {
        // getting namespace for checking file exists and open file
        // namespace can be "" in get namespace for checking method we checking if lenght of
        // namespace isnt 0 then we adding to namespace '/' if lenght is 0 we returning ''

        $file_check_namespace = $this->getNamespaceForChecking($autoServiceStorage->getServiceNamespace());

        if(file_exists('app/Http/Controllers/' . $file_check_namespace . "BaseController.php")) {
            return false;
        }

        // creating base controller class in user controller directory

        $base_controller = fopen('app/Http/Controllers/' . $file_check_namespace . "BaseController.php","w+");

        // getNamespaceForCreating method is like getNamespaceForChecking but he adding to namespace '\' not '/'

        $craeting_namespace = $this->getNamespaceForCreating($autoServiceStorage->getServiceNamespace());

        fwrite($base_controller,'<?php

namespace App\Http\Controllers' . substr($craeting_namespace,0,-1) . ';

use App\Services' . $craeting_namespace . $autoServiceStorage->getServiceName() . ';

class BaseController
{
    public $service;

    public function __construct(' . $autoServiceStorage->getServiceName() . ' $service)
    {
        $this->service = $service;
    }
}


             ');

        fclose($base_controller);

        return true;
    }

    public function createFile(string $namespace,array $data)
    {
        $file_check_namespace = $this->getNamespaceForChecking($namespace);

        if(file_exists('app/Http/Controllers/' . $file_check_namespace . "BaseController.php")) {
            return false;
        }

        // creating base controller class in user controller directory

        $base_controller = fopen('app/Http/Controllers/' . $file_check_namespace . "BaseController.php","w+");

        // getNamespaceForCreating method is like getNamespaceForChecking but he adding to namespace '\' not '/'

        $craeting_namespace = $this->getNamespaceForCreating($namespace);

        fwrite($base_controller,'<?php

namespace App\Http\Controllers' . substr($craeting_namespace,0,-1) . ';

'. $data["includes"] . '
class BaseController
{
'. $data["vars"] .'
    public function __construct('. $data["param_uses"] .')
    {
'. $data["construct_setting"]  .'
    }
}

             ');

        fclose($base_controller);

        return true;
    }
}
