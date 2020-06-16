<?php
include_once('config.php');
include_once('bd.php');
include_once('application.php');

class ApplicationManager
{
    public $_msgError;

    public function __construct()
    {

    }

    public function getAllApplications()
    {
        try
        {
            $sql = "select * from application";

            $bdMan = new BdManager();

            $entetes = array("id_app","id_type","id_type_app","login","mdp","nom_app","version_app","commentaire","cle_authen");

            $res = $bdMan->executeSelect($sql,$entetes);

            $applications = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {
                    $id_app = $res[$i]["id_app"];
                    $id_type = $res[$i]["id_type"];
                    $id_type_app = $res[$i]["id_type_app"];
                    $login = $res[$i]["login"];
                    $mdp = $res[$i]["mdp"];
                    $nom_app = $res[$i]["nom_app"];
                    $version_app = $res[$i]["version_app"];
                    $commentaire = $res[$i]["commentaire"];
                    $cle_authen = $res[$i]["cle_authen"];

                    $currentApp = new Application($id_app,$id_type,$id_type_app,$login,$mdp,$nom_app,$version_app,$commentaire,$cle_authen);

                    $applications[] = $currentApp;

                }

            }
            else
            {
                $this->_msgError = "[CLS::ApplicationManager][FCT::getAllApplications] Aucune données dans la table ! ";
            }

            return $applications;

        }
        catch(Exception $e)
        {
        	$this->_msgError = "[CLS::ApplicationManager][FCT::getAllApplications] Erreur : ".$e->getMessage();

        	return $applications;
        }

    }
}

 ?>
