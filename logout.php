<?php

session_start();
unset($_SESSION["isLogin"]);
unset($_SESSION["username"]);

header('Location:login.php');