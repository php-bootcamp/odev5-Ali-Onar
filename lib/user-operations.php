<?php

include 'dbConnect.php';
include 'functions.php';


//Ürün Düzenleme
if (isset($_POST['productedit'])) {

    $product_id = $_POST['product_id'];

    $save = $db->prepare("UPDATE product SET
    category_id=:category_id,
    product_uniqid=:product_uniqid,
    product_name=:product_name,
    product_price=:product_price,
    product_description=:product_description,
    product_content=:product_content
    WHERE product_id={$product_id}
    ");

    $update = $save->execute([
        'category_id' => $_POST['category_id'],
        'product_uniqid' => $_POST['product_uniqid'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_description' => $_POST['product_description'],
        'product_content' => $_POST['product_content']
    ]);

    if ($update) {
        Header("Location: ../product-edit.php?product_id=$product_id&status=ok");
        exit;
    } else {
        Header("Location: ../product-edit.php?product_id=$product_id&status=no");
        exit;
    }
}

// Ürün Ekleme
if (isset($_POST['productadd'])) {

    $save = $db->prepare("INSERT INTO product SET
    product_uniqid=:product_uniqid,
    product_name=:product_name,
    product_price=:product_price,
    product_description=:product_description,
    product_content=:product_content,
    category_id=:category_id
    ");
    $insert = $save->execute([
        'product_uniqid' => $_POST['product_uniqid'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_description' => $_POST['product_description'],
        'product_content' => $_POST['product_content'],
        'category_id' => $_POST['category_id']
    ]);

    if ($insert) {
        Header("Location: ../product.php?status=ok");
        exit;
    } else {
        Header("Location: ../product.php?status=no");
        exit;
    }
}

//Ürün Silme
if ($_GET['productdelete'] == 'ok') {

    loginMi();

    $delete = $db->prepare("DELETE FROM product WHERE product_id=:id");
    $control = $delete->execute([
        'id' => $_GET['product_id']
    ]);

    if ($control) {
        Header("Location: ../product.php?status=ok");
    } else {
        Header("Location: ../product.php?status=no");
    }
}



// Kategori Ekleme
if (isset($_POST['categoryadd'])) {

    $save = $db->prepare("INSERT INTO category SET
    category_uniqid=:category_uniqid,
    category_name=:category_name
    ");
    $insert = $save->execute([
        'category_uniqid' => $_POST['category_uniqid'],
        'category_name' => $_POST['category_name']
    ]);

    if ($insert) {
        Header("Location: ../category.php?status=ok");
        exit;
    } else {
        Header("Location: ../category.php?status=no");
        exit;
    }
}

// Json Dosyası Yükleme
if (isset($_POST['importJson'])) {

    copy($_FILES['jsonFile']['tmp_name'], '../jsonFiles/' . $_FILES['jsonFile']['name']);
    $data = file_get_contents('../jsonFiles/' . $_FILES['jsonFile']['name']);
    $products = json_decode($data);

    foreach ($products as $product) {

        $save = $db->prepare("INSERT INTO product SET 
        product_uniqid=:uniqid, 
        product_name=:name, 
        product_price=:price, 
        product_description=:description, 
        product_content=:content
        ");

        $c_save = $db->prepare("INSERT INTO category SET 
        category_uniqid=:c_uniqid,
        category_name=:c_name
        ");

        $insert = $save->execute([
            'uniqid' => $product->uniqid,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'content' => $product->content
        ]);

        $c_insert = $c_save->execute([
            'c_uniqid' => $product->category->uniqid,
            'c_name' => $product->category->name
        ]);
    }

    if ($insert && $c_insert) {
        Header("Location: ../product.php?json-import=ok");
        exit;
    } else {
        Header("Location: ../product.php?json-import=no");
        exit;
    }

}
