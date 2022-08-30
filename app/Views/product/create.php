<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />


</head>

<body>

    <div class="container">

        <h1>Tambah Produk</h1>
        <div class="row">
            <div class="col-md-12">
            <?= form_open_multipart('product/create') ?>
            <div class="form-group">
                <label for="photo" class="form-label">Gambar</label>
                <input type="file" class="form-control" name="photo">
            </div>
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" name="name" placeholder="Isikan Nama Produk" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nip">Stok</label>
                <input type="number" class="form-control" name="stock" placeholder="Isikan Stok" autocomplete="off">
            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
                <label for="alamat">Harga</label>
                <input type="text" class="form-control" name="price" placeholder="Isikan Harga" autocomplete="off">
            </div>
            <div class="form-group">
                <a class="btn btn-secondary" href="<?= site_url('product/index') ?>">Cancel</a>
                <input class="btn btn-success" type="submit" value="Submit">
            </div>
            <?= form_close() ?>
            </div>
        </div>







    </div>

</body>

</html>