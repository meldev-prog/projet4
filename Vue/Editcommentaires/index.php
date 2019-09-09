<?php $this->titre = "Gestions Commentaires"; ?>

<h2>Administration</h2>


<div id="menuAdmin">
	<a href="admin" > <button type="button" class="buttonMenu">Article(s)</button></a>
	<a href="editcommentaires" > <button type="button" class="buttonMenu">Commentaire(s)</button></a>
</div>


<h3>Listes des commentaires signalés:</h3>

<p>Aucun commentaire n'a été signalé</p>

<h3>Listes des commentaires :</h3>

<div class="liste">
	<h4>Nom</h4>
	<h4>Commentaire</h4>
	<h4></h4>
</div>

<?php foreach ($commentaires as $commentaire):
    ?>
    <article>
        <header>
			<div class="liste">
				<a href="<?= "editcommentaires/index/" . $this->nettoyer($commentaire['id']) ?>">
					<p><?= $this->nettoyer($commentaire['auteur']) ?></p>
				</a>
				<p><?= $this->nettoyer($commentaire['contenu']) ?></p>
				<form method="post" action="admin/supprimer">
					<button type="button" class="buttonEdit" ><i class="fas fa-times"></i></button>
				</form>	
			</div>
        </header>
    </article>
    <hr />
<?php endforeach; ?>