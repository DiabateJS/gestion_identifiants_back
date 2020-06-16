<?php
include_once("config.php");
include_once("bd.php");

class Application
{
    public $id_app;
    public $id_type;
    public $id_type_app;
    public $login;
    public $mdp;
    public $nom_app;
    public $version_app;
    public $commentaire;
    public $cle_authen;

    public $_msgError;


    public function __construct($idapp,$idtype,$idtypeapp,$login,$mdp,$nomapp,$version,$com,$cle)
    {

        $this->id_app = $idapp;
        $this->id_type = $idtype;
        $this->id_type_app = $idtypeapp;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->nom_app = $nomapp;
        $this->version_app = $version;
        $this->commentaire = $com;
        $this->cle_authen = $cle;
    }

    public function getApplicationById($idapp)
    {
        try
        {
            $sql = "select * from application where id_app = ".$idapp;

            $bdMan = new BdManager();

            $entetes = array("id_app","id_type","id_type_app","login","mdp","nom_app","version_app","commentaire","cle_authen");

            $res = $bdMan->executeSelect($sql,$entetes);

            $app = null;

            if (count($res) > 0)
            {

                $id_app = $res[0]["id_app"];
                $id_type = $res[0]["id_type"];
                $id_type_app = $res[0]["id_type_app"];
                $login = $res[0]["login"];
                $mdp = $res[0]["mdp"];
                $nom_app = $res[0]["nom_app"];
                $version_app = $res[0]["version_app"];
                $commentaire = $res[0]["commentaire"];
                $cle_authen = $res[0]["cle_authen"];

                $app = new Application($id_app,$id_type,$id_type_app,$login,$mdp,$nom_app,$version_app,$commentaire,$cle_authen);

            }
            else
            {
                $this->_msgError = "[CLS::Application][FCT::getApplicationById] Aucune données dans la table ! ";
            }

            return $app;

      }
      catch(Exception $e)
      {
          $this->_msgError = "[CLS::Application][FCT::getApplicationById] Erreur : ".$e->getMessage();

          return null;
      }

    }

}
?>
