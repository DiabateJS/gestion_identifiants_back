-- Requete qui retoure tous les identifiants de site web qui contiennent 'F'
select sw.id,ti.libelle_ident,sw.login, sw.mdp, sw.commentaire,sw.*,ti.*,tsw.*
from site_web sw inner join type_identifiant ti on sw.id_type_identifiant = ti.id_ident
inner join type_site_web tsw on sw.id_type_site_web = tsw.id_type
where ti.libelle_ident like '%F%'