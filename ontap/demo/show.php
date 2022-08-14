<?php
    require_once "connection.php";

    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>LIST</h1>
        <table border="1">
            <tr>
                <td>id</td>
                <td>product_name</td>
                <td>price</td>
                <td>description</td>
                <td>image</td>
                <td>cate_id</td>
                <td> <a href="add.php">add products</a> </td>
            </tr>

            <?php foreach($products as $product) : ?>
                <tr>
                    <td> <?= $product['id']?> </td>
                    <td> <?= $product['product_name']?> </td>
                    <td> <?= $product['price']?> </td>
                    <td> <?= $product['description']?> </td>
                    <td> <img src="image/<?= $product['image']?>" width="120" alt=""> </td>
                    <td> <?= $product['cate_id']?> </td>
                    <td>
                        <a href="edit.php?id=<?= $product['id']?>">edit</a>
                        <a onclick="return confirm('Are you sure you want to delete this product?')" href="delete.php?id=<?= $product['id']?>">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>