<?php
include_once('bd.php');
include_once('carte_bancaire.php');

class CarteBancaireManager
{
    public $_msgError;

    public function __construct()
    {

    }

    public function getAllCartesBancaires()
    {
        try
        {
            $sql = "select * from carte_bancaire";

            $bdMan = new BdManager();

            $entetes = array("id_carte","banque","numero","date_exp","commentaire","id_type");

            $res = $bdMan->executeSelect($sql,$entetes);

            $cartes_bancaires = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {

                    $id_carte = $res[$i]["id_carte"];
                    $banque = $res[$i]["banque"];
                    $numero = $res[$i]["numero"];
                    $date_exp = $res[$i]["date_exp"];
                    $commentaire = $res[$i]["commentaire"];
                    $id_type = $res[$i]["id_type"];

                    $currentCb = new CarteBancaire($id_carte,$banque,$numero,$date_exp,$commentaire,$id_type);

                    $cartes_bancaires[] = $currentCb;

                }

            }
            else
            {
                $this->_msgError = "[CLS::CarteBancaireManager][FCT::getAllCartesBancaires] Aucune données dans la table ! ";
            }

            return $cartes_bancaires;

        }
        catch(Exception $e)
        {
          	$this->_msgError = "[CLS::CarteBancaireManager][FCT::getAllCartesBancaires] Erreur : ".$e->getMessage();

          	return $cartes_bancaires;
        }

    }
}

?>
