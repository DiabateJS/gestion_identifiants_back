<?php
include_once("bd.php");

class Serveur
{
    public $_msgError;

    public $id_serveur;
    public $type_serveur;
    public $icon_type_serveur;
    public $lien_serveur;
    public $adresse_ip;
    public $login;
    public $mdp;
    public $commentaire;
    public $nom_os;
    public $version_os;
    public $id_type;

    public function __construct($idserveur,$typeserveur,$icontypeserveur,$lienserveur,$adresseip,$login,$mdp,$commentaire,$nomos,$versionos,$idtype)
    {

        $this->id_serveur = $idserveur;
        $this->type_serveur = $typeserveur;
        $this->icon_type_serveur = $icontypeserveur;
        $this->lien_serveur = $lienserveur;
        $this->adresse_ip = $adresseip;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->commentaire = $commentaire;
        $this->nom_os = $nomos;
        $this->version_os = $versionos;
        $this->id_type = $idtype;
    }

    public function getServeurById($idsrv)
    {
        try
        {
            $sql = "select S.id_serveur, TS.libelle_serveur as type_serveur, TS.icon_type_serveur, S.lien_serveur, S.adresse_ip, S.login, S.mdp, S.commentaire, S.nom_os, S.version_os, S.id_type from serveur S, type_serveur TS where S.id_type_serveur = TS.id_type_serveur and S.id_serveur = ".$idsrv;

            $bdMan = new BdManager();

            $entetes = array("id_serveur", "type_serveur", "icon_type_serveur", "lien_serveur", "adresse_ip", "login", "mdp", "commentaire", "nom_os", "version_os", "id_type");

            $res = $bdMan->executeSelect($sql,$entetes);

            $serveur = null;

            if (count($res) > 0)
            {

                $id_serveur = $res[0]["id_serveur"];
                $type_serveur = $res[0]["type_serveur"];
                $icon_type_serveur = $res[0]["icon_type_serveur"];
                $lien_serveur = $res[0]["lien_serveur"];
                $adresse_ip = $res[0]["adresse_ip"];
                $login = $res[0]["login"];
                $mdp = $res[0]["mdp"];
                $commentaire = $res[0]["commentaire"];
                $nom_os = $res[0]["nom_os"];
                $version_os = $res[0]["version_os"];
                $id_type = $res[0]["id_type"];

                $serveur = new Serveur($id_serveur,$type_serveur,$icon_type_serveur,$lien_serveur,$adresse_ip,$login,$mdp,$commentaire,$nom_os,$version_os,$id_type);

            }
            else
            {
                $this->_msgError = "[CLS::Serveur][FCT::getServeurById] Aucune données dans la table ! ";
            }

            return $app;

      }
      catch(Exception $e)
      {
          $this->_msgError = "[CLS::Serveur][FCT::getServeurById] Erreur : ".$e->getMessage();

          return null;
      }

    }

}
?>
