<?php
include_once("enumerateOperation.php");
include_once("createOperation.php");
include_once("updateOperation.php");
include_once("deleteOperation.php");
include_once("searchOperation.php");
header('Access-Control-Allow-Origin: *');

class OperationManager
{

    public static function createOperationObject($phpGetArray)
    {
        $opLabel = isset($phpGetArray["operation"]) ? $phpGetArray["operation"] : "";

        switch ($opLabel)
        {
            case "create":
                $opObject = new CreateOperation($phpGetArray);
                return $opObject;
                break;
            case "enum":
                $opObject = new EnumOperation();
                return $opObject;
                break;
            case "update":
                $opObject = new UpdateOperation($phpGetArray);
                return $opObject;
                break;
            case "delete":
                $opObject = new DeleteOperation($phpGetArray);
                return $opObject;
                break;
            case "search":
                $opObject = new SearchOperation($phpGetArray);
                return $opObject;
                break;
            default:
                $this->_msgError = "[CLASS::OperationManager][FCT::createOperationObject] Opération non définie !";
        }

    }
}
?>
