<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <style>
        .navbar {
            display: flex;
            flex-direction: row;
            font-size: 1em;
            text-transform: uppercase;
            font-family: "Allerta Stencil", sans-serif;
            font-weight: 600;
            text-align: center;
            margin-bottom: 3vh;
            position: fixed;
            top: 0;
            left:0;
            width: 100%;
            justify-content: center ;
            align-items: center;
            height: 100px;
            background-color: #0000002c;
            padding: 10px 20px;
            z-index: 1000;
        }
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .navbar-logo{
            display:inline;
            flex-direction: row;
            align-items: center;
            justify-content: left;

        }
        .navbar-logo img {
            height: 60px;

        }
        .navbar-right a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .navbar-right a:hover{
            background-color: #555;
            border-radius: 5px;
        }


    </style>
</head>

<p?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<body>
    <div class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><img src="ijwh1ece.png" alt="Logo"></a>
            <h3 style="color:white;" href="index.php">Kuru's Shop</h3>

        </div>
        <div class="navbar-right">
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="index.php">Catalogue</a>
                <a href="compte.php">Profil</a>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">S'inscrire</a>
                <a href="admin.php">Admin</a>
                <?php else: ?>
                <a href="index.php">Catalogue</a>
                <a href="compte.php">Profil</a>
                <a href="cart.php">Panier</a>
                <a href="logout.php">Déconnexion</a>
                
                <p style="position: absolute; top:40%; right: 5%; color:white;"> <?php echo htmlspecialchars($_SESSION['username']); ?> </p>
                
                <?php endif;?>
        </div>
    </div>
</body>
</html>