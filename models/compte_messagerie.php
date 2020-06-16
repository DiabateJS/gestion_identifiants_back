<?php
include_once("bd.php");

class CompteMessagerie
{

    public $id_compte;
    public $nom_messagerie;
    public $lien_conn;
    public $login;
    public $mdp;
    public $commentaire;
    public $id_type;

    public $_msgError;

    public function __construct($idcompte,$nommessagerie,$lienconn,$login,$mdp,$commentaire,$idtype)
    {

        $this->id_compte = $idcompte;
        $this->nom_messagerie = $nommessagerie;
        $this->lien_conn = $lienconn;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->commentaire = $commentaire;
        $this->id_type = $idtype;

    }

    public function CompteMessagerieById($idcptmessagerie)
    {
          try
          {
                $sql = "select * from compte_messagerie where id_carte = ".$idcptmessagerie;

                $bdMan = new BdManager();

                $entetes = array("id_compte","nom_messagerie","lien_conn","login","mdp","commentaire","id_type");

                $res = $bdMan->executeSelect($sql,$entetes);

                $cb = null;

                if (count($res) > 0)
                {

                    $id_carte = $res[0]["id_carte"];
                    $banque = $res[0]["banque"];
                    $numero = $res[0]["numero"];
                    $date_exp = $res[0]["date_exp"];
                    $commentaire = $res[0]["commentaire"];
                    $id_type = $res[0]["id_type"];

                    $cb = new CompteMessagerie($id_carte,$banque,$numero,$date_exp,$commentaire,$id_type);

                }
                else
                {
                    $this->_msgError = "[CLS::CompteMessagerie][FCT::CompteMessagerieById] Aucune données dans la table ! ";
                }

                return $cb;

          }
          catch(Exception $e)
          {
              	$this->_msgError = "[CLS::CompteMessagerie][FCT::CompteMessagerieById] Erreur : ".$e->getMessage();

              	return null;
          }

      }

}

?>
