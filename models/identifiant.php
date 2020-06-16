<?php
include_once("bd.php");

class Identifiant
{

    public $id_ident;
    public $libelle_ident;
    public $icon_type_ident;

    public $_msgError;

    public function __construct($idident,$libelleident,$icontypeident)
    {

        $this->id_ident = $idident;
        $this->libelle_ident = $libelleident;
        $this->icon_type_ident = $icontypeident;

    }

    public function getIdentifiantById($idident)
    {
        try
        {
            $sql = "select * from type_identifiant where id_ident = ".$idident;

            $bdMan = new BdManager();

            $entetes = array("id_ident","libelle_ident","icon_type_ident");

            $res = $bdMan->executeSelect($sql,$entetes);

            $identifiant = null;

            if (count($res) > 0)
            {

                $id_ident = $res[0]["id_ident"];
                $libelle_ident = $res[0]["libelle_ident"];
                $icon_type_ident = $res[0]["icon_type_ident"];


                $identifiant = new Application($id_ident,$libelle_ident,$icon_type_ident);

            }
            else
            {
                $this->_msgError = "[CLS::Identifiant][FCT::getIdentifiantById] Aucune données dans la table ! ";
            }

            return $identifiant;

      }
      catch(Exception $e)
      {
          $this->_msgError = "[CLS::Identifiant][FCT::getIdentifiantById] Erreur : ".$e->getMessage();

          return null;
      }

    }

}
?>
