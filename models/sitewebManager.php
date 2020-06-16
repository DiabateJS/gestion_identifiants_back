<?php
include_once('bd.php');
include_once('siteweb.php');

class SiteWebManager
{
    public $_msgError;

    public function __construct()
    {

    }

    public function getAllSiteWeb()
    {
        try
        {
            $sql = "select SW.id, TSW.libelle_type as type, TSW.icon_type_site_web as icon, SW.lien_conn as lien, SW.login, SW.mdp, SW.commentaire, SW.id_type_identifiant from site_web SW, type_site_web TSW where SW.id_type_site_web = TSW.id_type";

            $bdMan = new BdManager();

            $entetes = array("id","type","icon","lien","login","mdp","commentaire","id_type_identifiant");

            $res = $bdMan->executeSelect($sql,$entetes);

            $sitewebs = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {
                    $id = $res[$i]["id"];
                    $type = $res[$i]["type"];
                    $icon = $res[$i]["icon"];
                    $lien = $res[$i]["lien"];
                    $login = $res[$i]["login"];
                    $mdp = $res[$i]["mdp"];
                    $commentaire = $res[$i]["commentaire"];
                    $id_type_identifiant = $res[$i]["id_type_identifiant"];

                    $currentSiteWeb = new SiteWeb($id,$type,$icon,$lien,$login,$mdp,$commentaire,$id_type_identifiant);

                    $sitewebs[] = $currentSiteWeb;

                }

            }
            else
            {
                $this->_msgError = "[CLS::SiteWebManager][FCT::getAllSiteWeb] Aucune données dans la table ! ";
            }

            return $sitewebs;

        }
        catch(Exception $e)
        {
        	$this->_msgError = "[CLS::SiteWebManager][FCT::getAllSiteWeb] Erreur : ".$e->getMessage();

        	return $sitewebs;
        }

    }
}

 ?>
