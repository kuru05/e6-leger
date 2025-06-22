
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"?>

        <div class="container">
            <h2>Bonjour, client <?php echo htmlspecialchars($_SESSION['username']); ?> ! &nbsp;&nbsp;</h2>
            <form action="logout.php">
                <button type="submit" name="logout" class="custom-btn btn-8">Se déconnecter</button>
            </form>
        </div>
    <?php include "footer.php" ?>
</body>
</html>

