<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>

<body>

    <div class="container">

        <h1>Daftar Produk</h1>

        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>

        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>

        <div class="row">
            <div class="col-md-6">
                <a href="<?= site_url('product/create') ?>" type="button" class="btn btn-success">Tambah Produk</a>
            </div>

            <div class="col-md-6 text-right">
                <a type="button" class="btn btn-primary" href="<?= site_url('cart/index') ?>">Shopping Cart</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-2">
                <table id="product" class="table table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($product as $r) : ?>
                        <tr>
                            <td><?= $r->code; ?></td>
                            <td><?= $r->name; ?></td>
                            <td><?= "Rp ".number_format($r->price, 2, ",", "."); ?></td>
                            <td><?= $r->stock; ?></td>
                            <td><?= $r->photo; ?></td>
                            <td>
                                <a type="button" class="btn btn-success" href="<?= site_url('cart/create/' . $r->id) ?>">Beli</a> 
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $pagination->links() ?>
            </div>              
        </div>                



    </div>

</body>

</html>