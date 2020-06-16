<?php
include_once("bd.php");

class SiteWeb
{
    public $id;
    public $type;
    public $icon;
    public $lien;
    public $login;
    public $mdp;
    public $commentaire;
    public $id_type_identifiant;

    public $_msgError;

    public function __construct($id,$type,$icon,$lien,$login,$mdp,$commentaire,$idtypeidentifiant)
    {

        $this->id = $id;
        $this->type = $type;
        $this->icon = $icon;
        $this->lien = $lien;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->commentaire = $commentaire;
        $this->id_type_identifiant = $idtypeidentifiant;

    }

    public function getSiteWebById($idsiteweb)
    {
        try
        {
            $sql = "select SW.id, TSW.libelle_type as type, TSW.icon_type_site_web as icon, SW.lien_conn as lien, SW.login, SW.mdp, SW.commentaire, SW.id_type_identifiant from site_web SW, type_site_web TSW where SW.id_type_site_web = TSW.id_type and SW.id =  ".$idsiteweb;

            $bdMan = new BdManager();

            $entetes = array("id","type","icon","lien","login","mdp","commentaire","id_type_identifiant");

            $res = $bdMan->executeSelect($sql,$entetes);

            $siteweb = null;

            if (count($res) > 0)
            {

                $id = $res[0]["id"];
                $type = $res[0]["type"];
                $icon = $res[0]["icon"];
                $lien = $res[0]["lien"];
                $login = $res[0]["login"];
                $mdp = $res[0]["mdp"];
                $commentaire = $res[0]["commentaire"];
                $id_type_identifiant = $res[0]["id_type_identifiant"];

                $siteweb = new SiteWeb($id,$type,$icon,$lien,$login,$mdp,$commentaire,$id_type_identifiant);

            }
            else
            {
                $this->_msgError = "[CLS::SiteWeb][FCT::getSiteWebById] Aucune données dans la table ! ";
            }

            return $siteweb;

      }
      catch(Exception $e)
      {
          $this->_msgError = "[CLS::SiteWeb][FCT::getSiteWebById] Erreur : ".$e->getMessage();

          return null;
      }

    }

}
?>
