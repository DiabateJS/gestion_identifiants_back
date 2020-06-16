<?php
include_once("IOperation.php");

class DeleteOperation implements IOperation
{
  public $_msgError;
  private $_GetArray;

  public function __construct($phpGetArray)
  {
      $this->_GetArray =  $phpGetArray;
  }

  public function doOperation()
  {
      $currentIdent = array(
          "id_ident" => "",
      );

      $newIdentData = $this->_GetArray["oIdent"];
      $IdTypeIdentifiant = $newIdentData["id_ident"];
      $typeIdentifiant = $newIdentData["typeIdent"];
      $libelleIdentifiant = $newIdentData["libelle"];

      //Mise à jour dans la table type_identifiant
      $sql = "delete from type_identifiant where id_ident =".$IdTypeIdentifiant;

      $bdMan = new BdManager();
      $bdMan->executeDelete($sql);


      if ($typeIdentifiant == "site_web")
      {
          //Déterminer l'identifiant du type de site web
          $typeSiteWeb = $newIdentData["type"];
          $sql = "select id_type from type_site_web where libelle_type = '".$typeSiteWeb."'";
          $entete = array("id_type");
          $arTabIdTypeIdent = $bdMan->executeSelect($sql,$entete);
          $idTypeSiteWeb = $arTabIdTypeIdent[0]["id_type"];

          $sql = "delete from site_web where id_type_identifiant =".$IdTypeIdentifiant;

          //Suppression de la ligne
          $bdMan->executeDelete($sql);

          $currentIdent["id_ident"] = "";

      }

      if ($typeIdentifiant == "compte_messagerie")
      {

          $sql = "delete from compte_messagerie where id_type =".$IdTypeIdentifiant;

          //Insertion dans la seconde table
          $bdMan->executeDelete($sql);

          $currentIdent["id_ident"] = "";

      }

      if ($typeIdentifiant == "application")
      {

          $sql = "delete from application where id_type = ".$IdTypeIdentifiant;
          //Mise à jour de la seconde table
          $bdMan->executeDelete($sql);

          $currentIdent["id_ident"] = "";

      }

      if ($typeIdentifiant == "carte_bancaire")
      {


          $sql = "delete from carte_bancaire where id_type =  ".$IdTypeIdentifiant;
          //Mise à jour de la seconde table
          $bdMan->executeDelete($sql);

          $currentIdent["id_ident"] = "";

      }

      if ($typeIdentifiant == "serveur")
      {

          $sql = "delete from serveur where id_type =  ".$IdTypeIdentifiant;

          //Mise à jour de la seconde table
          $bdMan->executeDelete($sql);

          $currentIdent["id_ident"] = "";

      }

      return json_encode($currentIdent);
  }

}

?>
