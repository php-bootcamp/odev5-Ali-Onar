<?php
include "header.php";

$kategorisor = $db->prepare("SELECT * FROM category");
$kategorisor->execute();


?>

<!-- Kategori Listesini Göster -->


<table class="table table-bordered">
    <thead>

        <tr>
            <th colspan="3">
                <h3>Kategori Listesi</h3>
            </th>
            <th scope="col"><a href="category-add.php"><button class="btn btn-success btn-sm">Yeni Ekle</button></a></th>
        </tr>
    </thead>
    <thead class="thead-light">

        <tr>
            <th scope="col">Sıra</th>
            <th scope="col">UniqId</th>
            <th scope="col">Name</th>
            <th scope="col">Silme</th>
        </tr>
    </thead>

    <tbody>

        <?php
        $say = 1;
        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
        ?>

            <tr>
                <th scope="row"><?= $say++; ?></th>
                <td><?php echo $kategoricek['category_uniqid'] ?></td>
                <td><?php echo $kategoricek['category_name'] ?></td>
                <td><a href="lib/user-operations.php?category_id=<?php echo $kategoricek['category_id']; ?>&categorydelete=ok"><button class="btn btn-danger btn-sm">Sil</button></a></td>

            </tr>

        <?php } ?>

    </tbody>
</table>


<?php

include "footer.php";

?>