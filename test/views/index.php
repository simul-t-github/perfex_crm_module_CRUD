<a href="<?= base_url('test/product_add') ?>" class="btn btn-primary float-end">Add Product</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Detail</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sr = 0;
        foreach ($products as $product) { ?>
            <tr>
                <th scope="row"><?= $sr += 1 ?></th>
                <td><?= $product->product_name ?></td>
                <td><img src="<?= module_dir_url(TEST_MODULE, '/upload/' . $product->image)  ?>" class="img-fluid" alt="" style="height: 100px; width: 100px;"></td>
                <td><?= $product->details ?></td>
                <td><a href="<?= base_url('test/product_add/' . $product->id) ?>" class="btn btn-info">Edit</a> | <a onclick="confirm_delete(<?= $product->id ?>)" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php }
        ?>

    </tbody>
</table>


<script>
    function confirm_delete(id) {
        if (confirm('Are You Sure?') == true) {
            window.location.href = '<?= base_url("test/delete_product/") ?>' + id;
        }
    }
</script>