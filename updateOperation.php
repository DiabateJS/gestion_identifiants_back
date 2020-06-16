<?php
include_once("IOperation.php");

class UpdateOperation implements IOperation
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
      $sql = "update type_identifiant set libelle_ident ='".$libelleIdentifiant."' where id_ident =".$IdTypeIdentifiant;

      $bdMan = new BdManager();
      $bdMan->executeUpdate($sql);


      if ($typeIdentifiant == "site_web")
      {
          //Déterminer l'identifiant du type de site web
          $typeSiteWeb = $newIdentData["type"];
          $sql = "select id_type from type_site_web where libelle_type = '".$typeSiteWeb."'";
          $entete = array("id_type");
          $arTabIdTypeIdent = $bdMan->executeSelect($sql,$entete);
          $idTypeSiteWeb = $arTabIdTypeIdent[0]["id_type"];

          $lien_conn = $newIdentData["lien"];
          $login = $newIdentData["login"];
          $mdp = $newIdentData["mdp"];
          $commentaire = $newIdentData["commentaire"];

          $sql = "update site_web set id_type_site_web = ".$idTypeSiteWeb." , lien_conn ='".$lien_conn."', login ='".$login."', mdp ='".$mdp."', commentaire = '".$commentaire."' where id_type_identifiant =".$IdTypeIdentifiant;
          //Mise à jour dans la seconde table
          $bdMan->executeUpdate($sql);

          $currentIdent["id_ident"] = $IdTypeIdentifiant;

      }

      if ($typeIdentifiant == "compte_messagerie")
      {

          $nom_messagerie = $newIdentData["messagerie"];
          $lien_conn = $newIdentData["lien"];
          $login = $newIdentData["login"];
          $mdp = $newIdentData["mdp"];
          $commentaire = $newIdentData["commentaire"];

          $sql = "update compte_messagerie set nom_messagerie = '".$nom_messagerie."' , lien_conn = '".$lien_conn."' , login = '".$login."' , mdp = '".$mdp."' , commentaire = '".$commentaire."'  where  id_type =".$IdTypeIdentifiant;

          //Insertion dans la seconde table
          $bdMan->executeUpdate($sql);

          $currentIdent["id_ident"] = $IdTypeIdentifiant;

      }

      if ($typeIdentifiant == "application")
      {
          //Déterminer l'identifiant du type d'application
          $typeApp = $newIdentData["app_type"];
          $sql = "select id_type_app from type_application where libelle_type_app = '".$typeApp."'";
          $entete = array("id_type_app");
          $arTabIdTypeApp = $bdMan->executeSelect($sql,$entete);
          $idTypeApp = $arTabIdTypeApp[0]["id_type_app"];

          $nom_app = $newIdentData["nom_app"];
          $version_app = $newIdentData["version_app"];
          $cle_authen = "";
          $login = $newIdentData["login"];
          $mdp = $newIdentData["mdp"];
          $commentaire = $newIdentData["commentaire"];

          $sql = "update application set id_type_app ='".$idTypeApp."' , nom_app ='".$nom_app."' , login ='".$login."' , mdp ='".$mdp."' , commentaire ='".$commentaire."' ,version_app ='".$version_app."'  where id_type = ".$IdTypeIdentifiant;
          //Mise à jour de la seconde table
          $bdMan->executeUpdate($sql);

          $currentIdent["id_ident"] = $IdTypeIdentifiant;

      }

      if ($typeIdentifiant == "carte_bancaire")
      {

          $banque = $newIdentData["banque"];
          $numero = $newIdentData["numero"];
          $date_exp = $newIdentData["date_exp"];
          $commentaire = $newIdentData["commentaire"];

          $sql = "update carte_bancaire set banque = '".$banque."' , numero = '".$numero."' , date_exp = '".$date_exp."' , commentaire = '".$commentaire."' where id_type =  ".$IdTypeIdentifiant;
          //Mise à jour de la seconde table
          $bdMan->executeUpdate($sql);

          $currentIdent["id_ident"] = $IdTypeIdentifiant;

      }

      if ($typeIdentifiant == "serveur")
      {
          //Déterminer l'identifiant du type de serveur
          $typeServeur = $newIdentData["type"];
          $sql = "select id_type_serveur from type_serveur where libelle_type_serveur = '".$typeServeur."'";
          $entete = array("id_type_serveur");
          $arTabIdTypeServeur = $bdMan->executeSelect($sql,$entete);
          $idTypeServeur = $arTabIdTypeServeur[0]["id_type_serveur"];

          $lien = $newIdentData["lien_serveur"];
          $login = $newIdentData["login"];
          $mdp = $newIdentData["mdp"];
          $commentaire = $newIdentData["commentaire"];
          $adresse_ip = $newIdentData["adresse_ip"];
          $nom_os = $newIdentData["nom_os"];
          $version_os = $newIdentData["version_os"];

          $sql = "update serveur set id_type_serveur =".$idTypeServeur." , lien_serveur ='".$lien."' , adresse_ip ='".$adresse_ip."' , login ='".$login."' , mdp ='".$mdp."' , commentaire ='".$commentaire."' , nom_os ='".$nom_os."' , version_os ='".$version_os."'  where id_type =  ".$IdTypeIdentifiant;

          //Mise à jour de la seconde table
          $bdMan->executeUpdate($sql);

          $currentIdent["id_ident"] = $IdTypeIdentifiant;

      }

      return json_encode($currentIdent);
  }

}

?>
