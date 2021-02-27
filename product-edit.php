<?php

include "header.php";

$productsor = $db->prepare("SELECT * FROM product where product_id=:id");
$productsor->execute([
    'id' => $_GET['product_id']
]);

$productcek = $productsor->fetch(PDO::FETCH_ASSOC);

?>


<h3>Ürün Düzenleme</h3>
<hr>

<form action="user-operations.php" method="POST">

    <div class="form-group">
        <div class="col-md-3">
            <label for="exampleInputEmail1">Kategori</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="kategori_id" value="<?php echo $productcek['category_id'] ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <label for="exampleInputEmail1">UniqId</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="product_uniqid" value="<?php echo $productcek['product_uniqid'] ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <label for="exampleInputEmail1">Name</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="product_name" value="<?php echo $productcek['product_name'] ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <label for="exampleInputEmail1">Price</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="product_price" value="<?php echo $productcek['product_price'] ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <label for="exampleInputEmail1">Description</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="product_description" value="<?php echo $productcek['product_description'] ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-3">
            <label for="exampleInputEmail1">Content</label>
        </div>
        <div class="col-md-6">

            <textarea class="ckeditor" id="editor1" name="product_content"><?php echo $productcek['product_content'] ?></textarea>
        </div>
    </div>

    <script type="text/javascript">
        CKEDITOR.replace('editor1',

            {

                filebrowserBrowseUrl: 'ckfinder/ckfinder.html',

                filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',

                filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',

                filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                forcePasteAsPlainText: true

            }

        );
    </script>

    </div>
    </div>
    <div align="right" class="col-md-6">
        <button type="submit" class="btn btn-primary" name="productedit">Ürün Ekle</button>
    </div>
</form>



<?php

include "footer.php";

?>