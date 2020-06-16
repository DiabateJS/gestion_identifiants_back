<?php
include_once("bd.php");

class CarteBancaire
{

    public $id_carte;
    public $banque;
    public $numero;
    public $date_exp;
    public $commentaire;
    public $id_type;

    public $_msgError;


    public function __construct($idcarte,$banque,$numero,$dateexp,$commentaire,$id_type)
    {

        $this->id_carte = $idcarte;
        $this->banque = $banque;
        $this->numero = $numero;
        $this->date_exp = $dateexp;
        $this->commentaire = $commentaire;
        $this->id_type = $id_type;

    }

    public function getCarteBancaireById($idcarte)
    {
          try
          {
              $sql = "select * from carte_bancaire where id_carte = ".$idcarte;

              $bdMan = new BdManager();

              $entetes = array("id_carte","banque","numero","date_exp","commentaire","id_type");

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

                  $cb = new CarteBancaire($id_carte,$banque,$numero,$date_exp,$commentaire,$id_type);

              }
              else
              {
                $this->_msgError = "[CLS::CarteBancaire][FCT::getCarteBancaireById] Aucune données dans la table ! ";
              }

              return $cb;
        }
        catch(Exception $e)
        {
            $this->_msgError = "[CLS::CarteBancaire][FCT::getCarteBancaireById] Erreur : ".$e->getMessage();

            return null;
        }

    }

}

?>
