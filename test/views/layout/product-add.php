<form action="<?= base_url('test/product_insert') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <input type="hidden" name="id" value="<?= isset($product) ? $product->id : '0' ?>">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label fw-bold">Product Name</label>
        <input type="test" name="product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Product Name" value="<?= isset($product) ? $product->product_name : '' ?>">
    </div>
    <div class="mb-3">
        <label for="details" class="form-label fw-bold">Details</label>
        <textarea name="details" id="details" cols="30" rows="2" class="form-control" placeholder="Product Details"><?= isset($product) ? $product->details : '' ?></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label fw-bold">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <input type="hidden" name="old_image" value="<?= isset($product) ? $product->image : '' ?>">
        <?php
        if (isset($product) && $product->image != '') { ?>
            <img src="<?= module_dir_url(TEST_MODULE, '/upload/' . $product->image)  ?>" class="img-fluid mt-3" alt="" style="height: 100px; width: 100px;">
        <?php }
        ?>
    </div>

    <button type="submit" class="btn btn-primary float-end">Submit</button>
</form>