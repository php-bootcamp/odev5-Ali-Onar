<?php

include 'dbConnect.php';
include 'functions.php';

if (isset($_POST['productadd'])) {

    $save=$db->prepare("INSERT INTO product SET
    product_uniqid=:product_uniqid,
    product_name=:product_name,
    product_price=:product_price,
    product_description=:product_description,
    product_content=:product_content,
    category_id=:category_id
    ");
    $insert=$save->execute([
        'product_uniqid' => $_POST['product_uniqid'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_description' => $_POST['product_description'],
        'product_content' => $_POST['product_content'],
        'category_id' => $_POST['kategori_id']
    ]);

    if ($insert){
        Header("Location: product.php?status=ok");
        exit;
    }else {
        Header("Location: product.php?status=no");
        exit;
    }
}