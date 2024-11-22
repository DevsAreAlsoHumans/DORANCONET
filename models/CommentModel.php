<?php
include '../config/database.php';

// Classe pour gérer les commentaires
class Comment
{
    private $db;

    // Injection de la connexion à la base de données
    public function __construct($db)
    {
        $this->db = $db;  // Utiliser l'instance passée lors de l'injection
    }

    // Ajouter un commentaire
    public function addComment($postId, $content)
    {
        try {
            $query = "INSERT INTO comments (post_id, content) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$postId, $content]);
            return true;  // Retourne true si l'ajout réussit
        } catch (Exception $e) {
            return false;  // Retourne false en cas d'erreur
        }
    }

    // Supprimer un commentaire
    public function deleteComment($commentId)
    {
        try {
            $query = "DELETE FROM comments WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$commentId]);
            return true;  // Retourne true si la suppression réussit
        } catch (Exception $e) {
            return false;  // Retourne false en cas d'erreur
        }
    }

    // Récupérer les commentaires d'une publication
    public function getCommentsByPost($postId)
    {
        $query = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupère tous les commentaires
    }
}

// Contrôleur pour gérer les actions des commentaires
class CommentController
{
    private $commentModel;

    // Initialisation du modèle Comment
    public function __construct($db)
    {
        $this->commentModel = new Comment($db);  // Création du modèle Comment avec la connexion DB
    }

    // Ajouter un commentaire
    public function addCommentAction($postId, $content)
    {
        return $this->commentModel->addComment($postId, $content);
    }

    // Supprimer un commentaire
    public function deleteCommentAction($commentId)
    {
        return $this->commentModel->deleteComment($commentId);
    }

    // Afficher les commentaires d'une publication
    public function showCommentsAction($postId)
    {
        $comments = $this->commentModel->getCommentsByPost($postId);
        if ($comments) {
            foreach ($comments as $comment) {
                echo "<p>" . htmlspecialchars($comment['content']) . " <i>Posté le: " . $comment['created_at'] . "</i></p>";
            }
        } else {
            echo "<p>Aucun commentaire pour cette publication.</p>";
        }
    }
}

// Utilisation du contrôleur dans le script principal
$database = getDatabaseConnection();  // Récupérer la connexion à la base de données
$commentController = new CommentController($database);  // Passer la connexion au contrôleur

// Ajouter un commentaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postId']) && isset($_POST['content'])) {
    $postId = $_POST['postId'];
    $content = $_POST['content'];
    if ($commentController->addCommentAction($postId, $content)) {
        echo "Commentaire ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du commentaire.";
    }
}

// Supprimer un commentaire
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteCommentId'])) {
    $commentId = $_GET['deleteCommentId'];
    if ($commentController->deleteCommentAction($commentId)) {
        echo "Commentaire supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du commentaire.";
    }
}

// Afficher les commentaires d'une publication
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
    $commentController->showCommentsAction($postId);
}
