<?php
include "header.php";

$productsor = $db->prepare("SELECT product.*, category.* 
FROM product INNER JOIN category 
ON product.category_id=category.category_id
");
$productsor->execute();

?>

<!-- Ürün Listesini Göster -->


<table class="table table-bordered">
  <thead>

    <tr>
      <th colspan="7"><h3>Ürün Listesi</h3></th>
      <th scope="col"><a href="export.php"><button class="btn btn-secondary btn-sm">Dışa Aktar</button></a></th>
      <th scope="col"><a href="import.php"><button class="btn btn-secondary btn-sm">İçe Aktar</button></a></th>
      <th scope="col"><a href="product-add.php"><button class="btn btn-success btn-sm"> Yeni Ekle</button></a></th>
    </tr>
  </thead>
  <thead class="thead-light">

    <tr>
      <th scope="col">Sıra</th>
      <th scope="col">UniqId</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th colspan="2" scope="col">Content</th>
      <th scope="col">Kategori</th>
      <th colspan="3" scope="col">İşlem Seç</th>


    </tr>
  </thead>

  <tbody>

    <?php
    $say = 1;
    while ($productcek = $productsor->fetch(PDO::FETCH_ASSOC)) {
    ?>

      <tr>
        <th scope="row"><?= $say++; ?></th>
        <td><?php echo $productcek['product_uniqid'] ?></td>
        <td><?php echo $productcek['product_name'] ?></td>
        <td><?php echo $productcek['product_price'] ?></td>
        <td><?php echo $productcek['product_description'] ?></td>
        <td colspan="2"><?php

            // metin kısaltması yapıldı
            $content = $productcek['product_content'];
            $uzunluk = strlen($content);
            $limit = 250;
            if ($uzunluk > $limit) {
              $content = substr($content, 0, $limit) . " <b>devamı var...</b>";
              echo $content;
            }else {
              echo $content;
            }

            ?></td>
        <td><?php echo $productcek['category_name'] ?></td>
        <td><a href="product-edit.php?product_id=<?php echo $productcek['product_id']; ?>"><button class="btn btn-primary btn-sm">Düzenle</button></a></td>
        <td><a href="lib/user-operations.php?product_id=<?php echo $productcek['product_id']; ?>&productdelete=ok"><button class="btn btn-danger btn-sm">Sil</button></a>
        </td>

      </tr>

    <?php } ?>

  </tbody>
</table>


<?php

include "footer.php";

?>