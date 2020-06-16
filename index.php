<?php
include_once('models/config.php');
  include_once('apiauthent.php');
  include_once('operationManager.php');
  header('Access-Control-Allow-Origin: *');

  $oData = array(
		"return_code" => 500,
		"identifiant_id" => "",
		"identifiant_nom" => "",
		"identifiant_login" => "",
		"msg_error" => "",
    "data" => array()
  );

  try
  {
        
        $client_key = isset($_GET["api_key"]) ? $_GET["api_key"] : "";

        $oApiKey = new ApiAuth();

        if ($oApiKey->isKeyAuth($client_key))
        {

              $opObject = OperationManager::createOperationObject($_GET);

              $oData["return_code"] = 200;

              $oData["data"] = $opObject->doOperation();

        }
        else
        {
              $oData["return_code"] = 500;

              $oData["msg_error"] = "Authentification incorrecte.";
        }

    }
    catch (Exception $e)
    {
    		$oData["return_code"] = 500;

    		$oData["msg_error"] = $e->getMessage();
    }

    echo json_encode($oData);

?>
