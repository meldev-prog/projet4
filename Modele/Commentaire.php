<?php
require_once 'Framework/Modele.php';
/**
 * Fournit les services d'accès aux genres musicaux 
 *
 */
class Commentaire extends Modele {
// Renvoie la liste des commentaires associés à un billet
    public function getCommentaires($idBillet) {
        $sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu, COM_FLAG as flag from T_COMMENTAIRE'
                . ' where BIL_ID=?';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }
	
    /** 
	 * Renvoie la liste des commentaires du blog
     * 
     * @return PDOStatement La liste des commentaires
     */
	public function getListCommentaires(){
		$sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu , COM_FLAG as flag from T_COMMENTAIRE'
                . ' where COM_FLAG = 0 order by COM_ID desc';
		$commentairesNoFlag = $this->executerRequete($sql);
		
		$sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu , COM_FLAG as flag from T_COMMENTAIRE'
                . ' where COM_FLAG = 1 order by COM_ID desc';
				
		$commentairesFlag = $this->executerRequete($sql);
		
		$commentaires = array ($commentairesNoFlag, $commentairesFlag);
		
        return $commentaires;
		
	}
	
	/*Ajoute un commentaire */
    public function ajouterCommentaire($auteur, $contenu, $idBillet) {
        $sql = 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID, COM_FLAG)'
            . ' values(?, ?, ?, ?, 0)';
        $date = date('Y-m-d H:i:s');
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }
	/*Signale un commentaire*/
	public function signalerCommentaire($idCommentaire){
		$sql = 'update T_COMMENTAIRE set COM_FLAG = 1 where COM_ID = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	/*Sauvegarde un commentaire signalé */
	public function saveCommentaire($id){
		$sql = 'update T_COMMENTAIRE set COM_FLAG = 0 where COM_ID = ?';
		$this->executerRequete($sql, array($id));
	}
	
	/*Supprimer un commentaire*/
	public function supprimerCommentaire($idCommentaire){
		$sql = 'delete from T_COMMENTAIRE where COM_ID= ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	/*Supprime les commentaires rattachés au billet supprimé*/
	public function supprimerCommentairesBillet($idBillet){
		$sql = 'delete from T_COMMENTAIRE where BIL_ID=?';
		$this->executerRequete($sql, array($idBillet));
	}
    
    /**
     * Renvoie le nombre total de commentaires
     * 
     * @return int Le nombre de commentaires
     */
    public function getNombreCommentaires()
    {
        $sql = 'select count(*) as nbCommentaires from T_COMMENTAIRE';
        $resultat = $this->executerRequete($sql);
        $ligne = $resultat->fetch();  // Le résultat comporte toujours 1 ligne
        return $ligne['nbCommentaires'];
    }
}