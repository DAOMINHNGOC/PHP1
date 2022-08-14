<?php
    require_once "connection.php";
    
    $errors = [];
    if(isset($_POST['btn_save'])){
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $cate_id = $_POST['cate_id'];
        $file = $_FILES['image'];
        $image = $file['name'];

        $sql = "INSERT INTO products(product_name,price, description,image,cate_id) 
        VALUES('$product_name','$price','$description','$image','$cate_id')";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        move_uploaded_file($file['tmp_name'], 'image/' . $image);

        header("location:show.php");
        exit;
    }
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>ADD products</h1>
    <a href="show.php">LIST</a>
    <form action="" enctype="multipart/form-data" method="post">
        id <input type="text" name="id"> <br>
        product_name <input type="text" name="product_name"><br>
        price <input type="text" name="price"><br>
        description <input type="text" name="description"><br>
        image <input type="file" name="image"><br>
        cate_id  <select name="" id="">
            <?php foreach($category as $cate) :?>
                <option value="<?php echo $cate['id'];?>"> <?= $cate['cate_name'];?></option>
            <?php endforeach;?>
        </select><br>
        <button type="submit" name="btn_save" id="save">Save</button>
    </form>
</body>
</html>