<?php
session_start();
include 'bdd.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les valeurs des filtres
    $carburant = isset($_GET['Carburant']) ? $_GET['Carburant'] : '';
    $marque = isset($_GET['Marque']) ? $_GET['Marque'] : '';
    $price_order = isset($_GET['price_order']) ? $_GET['price_order'] : 'asc';

    // Construire la requête SQL avec les filtres
    $query = "SELECT id, Marque,name, image, price, Carburant FROM products WHERE 1=1";

    if ($carburant) {
        $query .= " AND Carburant = :Carburant";
    }

    if ($marque) {
        $query .= " AND Marque = :Marque";
    }

    $query .= " ORDER BY price " . ($price_order === 'desc' ? 'DESC' : 'ASC');

    $stmt = $pdo->prepare($query);

    if ($carburant) {
        $stmt->bindParam(':Carburant', $carburant);
    }

    if ($marque) {
        $stmt->bindParam(':Marque', $marque);
    }
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catalogue</title>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            main {
                padding-top: 100px;
                padding-bottom: 100px;
                display: flex;
                justify-content: center;
            }

            .product-list {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
                padding: 25px;
                justify-content: center;
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
                box-sizing: border-box;
            }

            .product-item {
                border: 2px solid #000;
                border-radius: 5px;
                background-color: #f9f9f9;
                padding: 15px;
                text-align: center;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .product-img {
                 width: 100%;
                height: 200px; /* ajuste selon ton design */
                object-fit: contain; /* ou 'contain' si tu veux éviter tout rognage */
                display: block;
                margin: 0 auto;
            }   

            @media (max-width: 900px) {
                .product-list {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 600px) {
                .product-list {
                    grid-template-columns: repeat(1, 1fr);
                }
            }        </style>
    </head>

    <body>

        <?php include 'navbar.php'; ?>

        <form method="GET" action="" class="filter-form">

        <label for="Marque">Marque : &nbsp;</label>
        <select name="Marque" id="Marque">
            <option value="">Toutes</option>
            <option value="Toyota">Toyota</option>
            <option value="BMW">BMW</option>
            <option value="Audi">Audi</option>
            <option value="Mercedes">Mercedes</option>
            <option value="Pagani">Pagani</option>
            <option value="Lamborghini">Lamborghini</option>
            <option value="Porsche">Porsche</option>
            <option value="Maserati">Maserati</option>
            <option value="Alfa Romeo">Alfa Romeo</option>
        </select>
        &nbsp;
        &nbsp;
        <label for="Carburant">Type de carburant : &nbsp;</label>
        <select name="Carburant" id="Carburant">
            <option value="">Tous</option>
            <option value="Essence">Essence</option>
            <option value="Hybride">Hybride</option>
            <option value="Electrique">Électrique</option>
        </select>
            &nbsp;
            &nbsp;
        <label for="price_order">Trier par prix : &nbsp;</label>
        <select name="price_order" id="price_order">
            <option value="asc">Ascendant</option>
            <option value="desc">Descendant</option>
        </select>

        <button type="submit">Filtrer</button>
        </form>
        <main>

        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-img">
                    <h2><?php echo htmlspecialchars( string: $product['Marque']); ?></h2>
                    <h2><?php echo htmlspecialchars(string: $product['name']); ?></h2>
                    <p>Prix : <?= number_format($product['price'], 0, ',', ' ') ?> €</p>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                        <button type="submit" name="add_to_cart" class="custom-btn btn-8">Ajouter au panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        </main>
        <?php include 'footer.php'; ?>

    </body>
</html>