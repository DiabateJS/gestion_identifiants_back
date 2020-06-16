<?php
include_once('bd.php');
include_once('compte_messagerie.php');

class CompteMessagerieManager
{
    public $_msgError;

    public function __construct()
    {

    }

    public function getAllComptesMessageries()
    {
        try
        {
            $sql = "select * from compte_messagerie";

            $bdMan = new BdManager();

            $entetes = array("id_compte","nom_messagerie","lien_conn","login","mdp","commentaire","id_type");

            $res = $bdMan->executeSelect($sql,$entetes);

            $comptes_messageries = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {
                    $id_compte = $res[$i]["id_compte"];
                    $nom_messagerie = $res[$i]["nom_messagerie"];
                    $lien_conn = $res[$i]["lien_conn"];
                    $login = $res[$i]["login"];
                    $mdp = $res[$i]["mdp"];
                    $commentaire = $res[$i]["commentaire"];
                    $id_type = $res[$i]["id_type"];

                    $currentCm = new CompteMessagerie($id_compte,$nom_messagerie,$lien_conn,$login,$mdp,$commentaire,$id_type);

                    $comptes_messageries[] = $currentCm;

                }

            }
            else
            {
                $this->_msgError = "[CLS::CompteMessagerieManager][FCT::getAllComptesMessageries] Aucune données dans la table ! ";
            }

            return $comptes_messageries;

        }
        catch(Exception $e)
        {
          	$this->_msgError = "[CLS::CompteMessagerieManager][FCT::getAllComptesMessageries] Erreur : ".$e->getMessage();

          	return $comptes_messageries;
        }

    }
}

?>
