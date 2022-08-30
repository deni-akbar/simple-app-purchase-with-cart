<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="container">

        <h1>Shopping Cart</h1>

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

        <?php if (!empty(session()->getFlashdata('warning'))) : ?>
            <div class="alert warning">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?= session()->getFlashdata('warning') ?>
            </div>
        <?php endif ?>

        <div class="row">
            <div class="col-md-6">
                <a type="button" class="btn btn-success" href="<?= site_url('product/create') ?>">Tambah Produk</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <table id="product" class="table table-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                <?php $total=0 ?>
                <?php foreach ($cart as $r) : ?>
                    <tr>
                        <td><?= $r->name; ?></td>
                        <td><?= "Rp ".number_format($r->price, 2, ",", "."); ?></td>
                        <td><?= $r->quantity; ?></td>
                        <td><?= "Rp ".number_format($r->subtotal, 2, ",", "."); ?></td>
                        <td>
                        <a href="<?= site_url('cart/plus/' . $r->id) ?>" class="btn btn-success"><i class="fa fa-plus"></i></a>
                        <a href="<?= site_url('cart/min/' . $r->id) ?>" class="btn btn-danger"><i class="fa fa-minus"></i></a>
                        </td>
                    </tr>
                    <?php $total+=$r->subtotal ?>
                <?php endforeach ?>
                <tr>
                    <td class="text-center" colspan="3">Total : </td>
                    <td><?= "Rp ".number_format($total, 2, ",", "."); ?></td>
                </tr>
            </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <a type="button" class="btn btn-secondary" href="<?= site_url('product/index') ?>">Kembali</a>
                <a type="button" class="btn btn-danger" href="<?= site_url('cart/checkout') ?>"><b>Checkout</b> </a>
            </div>
        </div>
    </div>

</body>

</html>