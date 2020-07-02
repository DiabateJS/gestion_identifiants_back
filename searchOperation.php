<?php
include_once("ioperation.php");
include_once("models/config.php");
include_once("models/identifiantManager.php");

class SearchOperation implements IOperation
{

    public $_msgError;
    public $_searchOptions;
    private $_GetArray;

    public function __construct($phpGetArray)
    {
        $this->_GetArray = $phpGetArray;
        $this->_searchOptions = array (
            "search_key" => $this->_GetArray["search_key"],
            "search_options" => explode(";",$this->_GetArray["search_options"])
        );
    }

    public function doOperation()
    {
          $identMan = new IdentifiantManager();
          $arIdentifiants = $identMan->searchIdentifiantsByOptions($this->_searchOptions);
          return $arIdentifiants;

    }

}
?>
