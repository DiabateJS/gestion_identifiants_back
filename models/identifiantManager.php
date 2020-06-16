<?php
include_once('bd.php');
include_once('identifiant.php');

class IdentifiantManager
{
    public $_msgError;

    public function __construct()
    {

    }

    public function getAllIdentifiants()
    {
        try
        {

            $identifiants = array(
              "site_web" => array(),
              "compte_messagerie" => array(),
              "application" => array(),
              "carte_bancaire" => array(),
              "serveur" => array()
            );

            $identifiants["site_web"] = $this->getAllSiteWebIdentifiants();
            $identifiants["compte_messagerie"] = $this->getAllCptMessagerieIdentifiants();
            $identifiants["application"] = $this->getAllApplicationsIdentifiants();
            $identifiants["carte_bancaire"] = $this->getAllCarteBancaireIdentifiants();
            $identifiants["serveur"] = $this->getAllServeursIdentifiants();


            return $identifiants;

        }
        catch(Exception $e)
        {
        	$this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Erreur : ".$e->getMessage();

        	return $identifiants;
        }

    }

    private function getAllApplicationsIdentifiants()
    {
      try
      {
          $sql = "select T.id_ident, T.libelle_ident as libelle, TA.libelle_type_app as type, A.id_app,A.nom_app, A.login, A.mdp, A.cle_authen, A.commentaire, A.version_app from application A, type_identifiant T, type_application TA where A.id_type = T.id_ident and TA.id_type_app = A.id_type_app";

          $bdMan = new BdManager();

          $entetes = array("id_ident","libelle","type","id_app","nom_app","login","mdp","cle_authen","commentaire","version_app");

          $res = $bdMan->executeSelect($sql,$entetes);

          $identifiants = array();

          if (count($res) > 0)
          {

              for ($i = 0 ; $i < count($res) ; $i++)
              {

                  $currentIdent = array(
                      "id_ident" => $res[$i]["id_ident"],
                      "libelle" => $res[$i]["libelle"],
                      "type" => $res[$i]["type"],
                      "id_app" => $res[$i]["id_app"],
                      "nom_app" => $res[$i]["nom_app"],
                      "login" => $res[$i]["login"],
                      "mdp" => $res[$i]["mdp"],
                      "cle_authen" => $res[$i]["cle_authen"],
                      "commentaire" => $res[$i]["commentaire"],
                      "version_app" => $res[$i]["version_app"]
                  );


                  $identifiants[] = $currentIdent;

              }

          }
          else
          {
              $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Aucune données dans la table ! ";
          }

          return $identifiants;

      }
      catch(Exception $e)
      {
        $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Erreur : ".$e->getMessage();

        return $identifiants;
      }

    }

    private function getAllCptMessagerieIdentifiants()
    {
        try
        {
            $sql = "select T.id_ident, T.libelle_ident as libelle, C.nom_messagerie as messagerie, C.lien_conn as lien, C.login as login, C.mdp, C.commentaire from compte_messagerie C , type_identifiant T where C.id_type = T.id_ident";

            $bdMan = new BdManager();

            $entetes = array("id_ident","libelle", "messagerie", "lien", "login", "mdp", "commentaire");

            $res = $bdMan->executeSelect($sql,$entetes);

            $identifiants = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {
                    $currentIdent = array(
                        "id_ident" => $res[$i]["id_ident"],
                        "libelle" => $res[$i]["libelle"],
                        "messagerie" => $res[$i]["messagerie"],
                        "lien" => $res[$i]["lien"],
                        "login" => $res[$i]["login"],
                        "mdp" => $res[$i]["mdp"],
                        "commentaire" => $res[$i]["commentaire"]
                    );

                    $identifiants[] = $currentIdent;

                }

            }
            else
            {
                $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Aucune données dans la table ! ";
            }

            return $identifiants;

        }
        catch(Exception $e)
        {
          $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Erreur : ".$e->getMessage();

          return $identifiants;
        }
    }

    private function getAllCarteBancaireIdentifiants()
    {
        try
        {
            $sql = "select T.id_ident, T.libelle_ident as libelle,C.id_carte, C.banque, C.numero, C.date_exp, C.commentaire, T.icon_type_ident from carte_bancaire C, type_identifiant T where C.id_type = T.id_ident";

            $bdMan = new BdManager();

            $entetes = array("id_ident", "libelle","id_carte","banque","numero","date_exp","commentaire","icon_type_ident");

            $res = $bdMan->executeSelect($sql,$entetes);

            $identifiants = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {

                    $currentIdent = array(
                        "id_ident" => $res[$i]["id_ident"],
                        "libelle" => $res[$i]["libelle"],
                        "id_carte" => $res[$i]["id_carte"],
                        "banque" => $res[$i]["banque"],
                        "numero" => $res[$i]["numero"],
                        "date_exp" => $res[$i]["date_exp"],
                        "commentaire" => $res[$i]["commentaire"],
                        "icon_type_ident" => $res[$i]["icon_type_ident"]
                    );

                    $identifiants[] = $currentIdent;

                }

            }
            else
            {
                $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Aucune données dans la table ! ";
            }

            return $identifiants;

        }
        catch(Exception $e)
        {
          $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Erreur : ".$e->getMessage();

          return $identifiants;
        }
    }

    private function getAllServeursIdentifiants()
    {
        try
        {
            $sql = "select T.id_ident, T.libelle_ident as libelle,S.id_serveur, TS.libelle_type_serveur,TS.icon_type_serveur, S.lien_serveur, S.adresse_ip, S.login, S.mdp, S.commentaire, S.nom_os, S.version_os from serveur S, type_serveur TS, type_identifiant T where S.id_type = T.id_ident and S.id_type_serveur = TS.id_type_serveur";

            $bdMan = new BdManager();

            $entetes = array("id_ident","libelle","id_serveur","libelle_type_serveur","icon_type_serveur","lien_serveur","adresse_ip","login","mdp","commentaire","nom_os","version_os");

            $res = $bdMan->executeSelect($sql,$entetes);

            $identifiants = array();

            if (count($res) > 0)
            {

                for ($i = 0 ; $i < count($res) ; $i++)
                {

                    $currentIdent = array(
                        "id_ident" => $res[$i]["id_ident"],
                        "libelle" => $res[$i]["libelle"],
                        "id_serveur" => $res[$i]["id_serveur"],
                        "libelle_type_serveur" => $res[$i]["libelle_type_serveur"],
                        "icon_type_serveur" => $res[$i]["icon_type_serveur"],
                        "lien_serveur" => $res[$i]["lien_serveur"],
                        "adresse_ip" => $res[$i]["adresse_ip"],
                        "login" => $res[$i]["login"],
                        "mdp" => $res[$i]["mdp"],
                        "commentaire" => $res[$i]["commentaire"],
                        "nom_os" => $res[$i]["nom_os"],
                        "version_os" => $res[$i]["version_os"]
                    );

                    $identifiants[] = $currentIdent;

                }

            }
            else
            {
                $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Aucune données dans la table ! ";
            }

            return $identifiants;

        }
        catch(Exception $e)
        {
          $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Erreur : ".$e->getMessage();

          return $identifiants;
        }
    }

    private function getAllSiteWebIdentifiants()
    {
      try
      {
          $sql = "select T.id_ident,T.libelle_ident as libelle , TS.libelle_type as type, S.lien_conn as lien, S.login as login, S.mdp , S.commentaire from site_web S, type_identifiant T, type_site_web TS where S.id_type_identifiant = T.id_ident and S.id_type_site_web = TS.id_type";

          $bdMan = new BdManager();

          $entetes = array("id_ident","libelle","type","lien","login","mdp","commentaire");

          $res = $bdMan->executeSelect($sql,$entetes);

          $identifiants = array();

          if (count($res) > 0)
          {

              for ($i = 0 ; $i < count($res) ; $i++)
              {

                  $currentIdent = array(
                    "id_ident" => $res[$i]["id_ident"],
                    "libelle" => $res[$i]["libelle"],
                    "type" => $res[$i]["type"],
                    "lien" => $res[$i]["lien"],
                    "login" => $res[$i]["login"],
                    "mdp" => $res[$i]["mdp"],
                    "commentaire" => $res[$i]["commentaire"]
                  );

                  $identifiants[] = $currentIdent;

              }

          }
          else
          {
              echo "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Aucune données dans la table ! ";
          }

          return $identifiants;

      }
      catch(Exception $e)
      {
        $this->_msgError = "[CLS::IdentifiantManager][FCT::getAllIdentifiants] Erreur : ".$e->getMessage();

        return $identifiants;
      }

    }
}

 ?>
