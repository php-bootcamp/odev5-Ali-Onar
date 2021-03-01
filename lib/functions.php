<?php

session_start();

function loginMi(){
    if(!$_SESSION['username']){
        header('Location: login.php');
    }
}

