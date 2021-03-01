<?php 

try {

	$db=new PDO("mysql:host=localhost;dbname=odev5;charset=utf8",'root','');

	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOException $e) {

	echo $e->getMessage();
}
 ?>

