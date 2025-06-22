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

    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);

} catch (PDOException $e) {
    echo "Error : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <title>Tableau de bord Admin</title>
    <style>
        body {
            display:block;
        }
        .table-container {
            margin: 40px auto; /* Espace entre les tables */
            padding: 20px;
            width: 90%;
            max-width: 1200px;
            background-color: #2b2b2b;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #222;
            color: white;
            text-align: center;
        }

        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #00AEEF;
            color: white;
        }

        td {
            background-color: #333;
        }

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1><br><br><br>Bienvenue, Admin</h1>

    <h2>Liste des tables dans la base de données "<?php echo $dbname; ?>"</h2>


<?php 
    if ($tables) {
        foreach ($tables as $table) {
            $tableName = $table[0];
            echo "<h3>Table : $tableName</h3>";
            
            $stmt = $conn->query("SELECT * FROM $tableName");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                echo "<table>";
                echo "<tr>";
                foreach (array_keys($rows[0]) as $column) {
                    echo "<th>$column</th>";
                }
                echo "<th>Actions</th>";
                echo "</tr>";

                foreach ($rows as $row) {
                    $idColumn = array_keys($rows[0])[0];

                    if ($row[$idColumn] == 0) {
                        continue;
                    }

                    echo "<tr>";
                    foreach ($row as $data) {
                        echo "<td>$data</td>";
                    }
                    echo "<td>";
                    echo "<a href='edit.php?table=$tableName&id={$row[$idColumn]}'>Modifier</a>";
                    echo "<br>";
                    echo "<a href='delete.php?table=$tableName&id={$row[$idColumn]}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet enregistrement ?\"):'>Supprimer</a>";
                    echo "</td>";

                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Aucune donnée disponible dans la table $tableName. </p>";
            }
            echo "<td><a href='create.php?table=$tableName'>Ajouter un nouvel enregistrement</a></td>";
        }
    } else {
        echo "<p>Aucune table trouvée dans la base de données.</p>";
    }
?>
</body>
</html>