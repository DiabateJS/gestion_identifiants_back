<?php
include_once('bd.php');
include_once('serveur.php');

class ServeurManager
{

    public $_msgError;

    public function __construct()
    {

    }

    public function getAllServeurs()
    {
        try
        {
            $sql = "select S.id_serveur, TS.libelle_serveur as type_serveur, TS.icon_type_serveur, S.lien_serveur, S.adresse_ip, S.login, S.mdp, S.commentaire, S.nom_os, S.version_os, S.id_type from serveur S, type_serveur TS where S.id_type_serveur = TS.id_type_serveur";

            $bdMan = new BdManager();

            $entetes = array("id_serveur", "type_serveur", "icon_type_serveur", "lien_serveur", "adresse_ip", "login", "mdp", "commentaire", "nom_os", "version_os", "id_type");

            $res = $bdMan->executeSelect($sql,$entetes);

            $serveurs = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {
                    $id_serveur = $res[$i]["id_serveur"];
                    $type_serveur = $res[$i]["type_serveur"];
                    $icon_type_serveur = $res[$i]["icon_type_serveur"];
                    $lien_serveur = $res[$i]["lien_serveur"];
                    $adresse_ip = $res[$i]["adresse_ip"];
                    $login = $res[$i]["login"];
                    $mdp = $res[$i]["mdp"];
                    $commentaire = $res[$i]["commentaire"];
                    $nom_os = $res[$i]["nom_os"];
                    $version_os = $res[$i]["version_os"];
                    $id_type = $res[$i]["id_type"];

                    $currentSrv = new Serveur($id_serveur,$type_serveur,$icon_type_serveur,$lien_serveur,$adresse_ip,$login,$mdp,$commentaire,$nom_os,$version_os,$id_type);

                    $serveurs[] = $currentSrv;

                }

            }
            else
            {
                $this->_msgError = "[CLS::ServeurManager][FCT::getAllServeurs] Aucune données dans la table ! ";
            }

            return $serveurs;

        }
        catch(Exception $e)
        {
        	$this->_msgError = "[CLS::ServeurManager][FCT::getAllServeurs] Erreur : ".$e->getMessage();

        	return $serveurs;
        }

    }
}

?>
