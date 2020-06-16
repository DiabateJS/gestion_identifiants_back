<?php
include_once("IOperation.php");
include_once("models/bd.php");

class CreateOperation implements IOperation
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
        $typeIdentifiant = $newIdentData["typeIdent"];
        $libelleIdentifiant = $newIdentData["libelle"];

        //Insertion dans la table type_identifiant
        $sql = "insert into type_identifiant(libelle_ident,icon_type_ident) values ('".$libelleIdentifiant."','')";

        $bdMan = new BdManager();
        $bdMan->executeInsert($sql);

        //Identifier le nouveau id
        $sql = "select id_ident from type_identifiant where libelle_ident ='".$libelleIdentifiant."'";
        $entete = array("id_ident");
        $res = $bdMan->executeSelect($sql,$entete);
        $idNewIdent = $res[0]["id_ident"];

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

            $sql = "INSERT into site_web(id_type_site_web, lien_conn, login, mdp, commentaire, id_type_identifiant) ";
            $sql .= " values('".$idTypeSiteWeb."','".$lien_conn."','".$login."','".$mdp."','".$commentaire."',".$idNewIdent.")";
            //Insertion dans la seconde table
            $bdMan->executeInsert($sql);

            $currentIdent["id_ident"] = $idNewIdent;

        }

        if ($typeIdentifiant == "compte_messagerie")
        {

            $nom_messagerie = $newIdentData["messagerie"];
            $lien_conn = $newIdentData["lien"];
            $login = $newIdentData["login"];
            $mdp = $newIdentData["mdp"];
            $commentaire = $newIdentData["commentaire"];

            $sql = "INSERT into compte_messagerie(nom_messagerie, lien_conn, login, mdp, commentaire, id_type) ";
            $sql .= " values('".$nom_messagerie."','".$lien_conn."','".$login."','".$mdp."','".$commentaire."',".$idNewIdent.")";
            //Insertion dans la seconde table
            $bdMan->executeInsert($sql);

            $currentIdent["id_ident"] = $idNewIdent;

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

            $sql = "INSERT into application(id_type_app, nom_app, login, mdp, cle_authen,commentaire,version_app,id_type) ";
            $sql .= " values('".$idTypeApp."','".$nom_app."','".$login."','".$mdp."','".$cle_authen."','".$commentaire."','".$version_app."',".$idNewIdent.")";
            //Insertion dans la seconde table
            $bdMan->executeInsert($sql);

            $currentIdent["id_ident"] = $idNewIdent;

        }

        if ($typeIdentifiant == "carte_bancaire")
        {

            $banque = $newIdentData["banque"];
            $numero = $newIdentData["numero"];
            $date_exp = $newIdentData["date_exp"];
            $commentaire = $newIdentData["commentaire"];

            $sql = "INSERT into carte_bancaire(banque, numero, date_exp, commentaire, id_type) ";
            $sql .= " values('".$banque."','".$numero."','".$date_exp."','".$commentaire."',".$idNewIdent.")";
            //Insertion dans la seconde table
            $bdMan->executeInsert($sql);

            $currentIdent["id_ident"] = $idNewIdent;

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

            $sql = "INSERT into serveur(id_type_serveur, lien_serveur, adresse_ip, login, mdp, commentaire, nom_os, version_os, id_type) ";
            $sql .= " values($idTypeServeur,'".$lien."','".$adresse_ip."','".$login."','".$mdp."','".$commentaire."','".$nom_os."','".$version_os."',".$idNewIdent.")";
            //Insertion dans la seconde table
            $bdMan->executeInsert($sql);

            $currentIdent["id_ident"] = $idNewIdent;

        }

        return json_encode($currentIdent);
    }
}

?>
