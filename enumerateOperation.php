<?php
include_once("IOperation.php");
include_once("models/config.php");
include_once("models/identifiantManager.php");

class EnumOperation implements IOperation
{

    public $_msgError;

    public function __construct()
    {

    }

    public function doOperation()
    {

          $identMan = new IdentifiantManager();

          $arIdentifiants = $identMan->getAllIdentifiants();

          return $arIdentifiants;

    }

}
?>
