<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .footer {
            position:fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
            padding: 10px;
            font-family: Arial, Helvetica, sans-serif;
            z-index: 1000;
        }
        .footer a {
            color: white;
            text-decoration: none;
            padding: 0 10px;
        }
        .footer a:hover {
            text-decoration: underline;
            
        }

    </style>
</head>
<body>
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Merlin COUDOL | Tous droits reservés. </p>
        <p>
            <a href="terms.php">Conditions d'utilisation</a>
            <a href="privacy.php">Politique de confidentialité</a>
        </p>
    </div>
</body>
</html>