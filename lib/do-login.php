<?php
include "dbConnect.php";
include "functions.php";
loginMi();


if (isset($_POST['userlogin'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $kullanicisor = $db->prepare("SELECT * from users where user_name=:username and user_password=:password");
    $kullanicisor->execute(array(
        'username' => $username,
        'password' => $password
    ));

    $say = $kullanicisor->rowCount();

    if ($say == 1) {

        $_SESSION['username'] = $username;

        header("Location:../index.php?durum=girisbasarili");
        exit;
    } else {

        header("Location:../login.php?durum=hata");
    }
}
