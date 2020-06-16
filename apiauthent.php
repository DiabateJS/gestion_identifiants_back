<?php
include_once('models/bd.php');


class ApiAuth
{

    public $_msgError;

    public function __construct()
    {

    }

    public function isKeyAuth($key)
    {

        try
        {
              $bdMan = new BdManager();

              $query = "select * from api_key where id = 1";

              $entetes = array("id","auth_key");

              $tab = $bdMan->executeSelect($query,$entetes);

              if (count($tab) > 0)
              {
                  $key_in_base = $tab[0]["auth_key"];

                  if (strcmp ( $key_in_base , $key ) == 0)
                  {
                      return true;
                  }
                  else
                  {
                      return false;
                  }

              }
              else
              {
                  $this->_msgError = "[CLASS::ApiAuth][FCT::isKeyAuth] Aucune données dans la base de données.";

                  return false;
              }

          }
          catch (Exception $e)
          {

              $this->_msgError = "[CLASS::ApiAuth][FCT::isKeyAuth] Erreur : ".$e->getMessage();

              return false;

          }

    }

}

?>
