		<!-- Exemple d'affichage des commentaires pour une publication -->
		<link rel="stylesheet" type="text/css" href="../public/assets/css/style.css" />
		<h2>Commentaires</h2>
		<?php
		if (isset($_GET['postId'])) {
			$postId = $_GET['postId'];
			$commentController->showCommentsAction($postId);
		}
		?>
		<!-- Formulaire HTML pour ajouter un commentaire -->
		<form id="CommentForm" method="POST">
			<input type="hidden" name="postId" value="1"> <!-- Exemple: ID de la publication -->
			<div class="content">
				<textarea name="content" required></textarea>
			</div>
			<p><button type="submit">Ajouter un commentaire</button></p>

		</form>