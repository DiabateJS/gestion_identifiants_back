<?php
include_once('config.php');

class BdManager
{
  private $_db_host;

  private $_db_user;

  private $_db_pass;

  private $_db_name;

  private $_pdo;

  public $_msgError;

  public function __construct()
  {
		try
		{
      $dico = GlobalParams::getBdDico();

			$this->_db_host = $dico["host"];

			$this->_db_user = $dico["user"];

			$this->_db_pass = $dico["password"];

			$this->_db_name = $dico["bdname"];

			$this->_pdo = new PDO('mysql:dbname=' . $this->_db_name . ';host=' . $this->_db_host, $this->_db_user, $this->_db_pass);

		}
		catch(Exception $e)
		{

			$this->_msgError = "[CLS::BdManager][FCT::__construct] Erreur : ".$e->getMessage();

		}

  }


  public function executeSelect($query,$entete)
  //$entete est un tableau contenant les champs de retour de la requete
  {
	  $resultats = array();

	  try
	  {

			  $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');

			  if ($result)
			  {

					while ($data = $result->fetch())
					{

						if ($data != null)
						{
							$dc = array();

							for ($i = 0 ; $i < count($entete) ; $i++)
							{
								$dc[$entete[$i]] = $data->{$entete[$i]};
							}

							$resultats[]=$dc;
						}

					}

			  }

	  }
	  catch(Exception $e)
	  {
		  $this->_msgError = "[CLS::BdManager][FCT::executeSelect] Erreur : ".$e->getMessage();

		  return $resultats;
	  }

      return $resultats;
  }

  function executeInsert($query)
  {

        try
    	  {
            $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
        }
        catch(Exception $e)
        {
        	  $this->_msgError = "[CLS::BdManager][FCT::executeInsert] Erreur : ".$e->getMessage();

        	  return $result;
        }

  }

  function executeUpdate($query)
  {

        try
    	  {
            $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
        }
        catch(Exception $e)
        {
        	  $this->_msgError = "[CLS::BdManager][FCT::executeUpdate] Erreur : ".$e->getMessage();

        	  return $result;
        }

  }

  function executeDelete($query)
  {

        try
    	  {
            $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
        }
        catch(Exception $e)
        {
        	  $this->_msgError = "[CLS::BdManager][FCT::executeDelete] Erreur : ".$e->getMessage();

        	  return $result;
        }

  }

}

?>
