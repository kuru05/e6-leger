<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

include 'bdd.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['table']) && isset($_GET['id'])) {
        $table = $_GET['table'];
        $id = $_GET['id'];

        // Vérifier le rôle de l'utilisateur
        $stmt = $conn->prepare("SELECT role FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['role'] === 'Super-Administrateur') {
            echo "Erreur : Impossible de supprimer un Super-Administrateur.";
        } else {
            $stmt = $conn->prepare("DELETE FROM $table WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: admin_dashboard.php?table=$table&success=1");
            exit();
        }
    } else {
        echo "Table ou ID manquant.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
