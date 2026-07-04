<?php
session_start();
include "class/data.php";

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = (new Data())->order;
}

$order = $_SESSION['order'];

/* ================= EDIT DATA ================= */
$editData = null;

if (isset($_GET['edit'])) {
    foreach ($order as $o) {
        if ($o['kode'] == $_GET['edit']) {
            $editData = $o;
        }
    }
}

/* ================= UPDATE ================= */
if (isset($_POST['update'])) {

    foreach ($order as $i => $o) {

        if ($o['kode'] == $_POST['kode_lama']) {

            $order[$i]['kode'] = $_POST['kode'];
            $order[$i]['customer'] = $_POST['customer'];
            $order[$i]['restoran'] = $_POST['restoran'];
            $order[$i]['total'] = $_POST['total'];
        }
    }

    $_SESSION['order'] = $order;

    header("Location: order.php");
    exit;
}

/* ================= HAPUS ================= */
if (isset($_GET['hapus'])) {

    foreach ($order as $i => $o) {

        if ($o['kode'] == $_GET['hapus']) {
            unset($order[$i]);
        }
    }

    $order = array_values($order);

    $_SESSION['order'] = $order;

    header("Location: order.php");
    exit;
}

if (isset($_POST['tambah'])) {

    $order[] = [
        "kode" => $_POST['kode'],
        "customer" => $_POST['customer'],
        "restoran" => $_POST['restoran'],
        "total" => $_POST['total']
    ];

    $_SESSION['order'] = $order;

    header("Location: order.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Order</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/datatables/css/datatables.min.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg" style="background:#ff6d00;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="index.php">
            ShopeeFood Driver
        </a>
    </div>
</nav>

<div class="container mt-5">

    <a href="driver.php" class="btn btn-light">
        CRUD Driver
    </a>

    <a href="order.php" class="btn btn-warning text-white">
        Daftar Order
    </a>

    <a href="riwayat.php" class="btn btn-light">
        Riwayat Pengantaran
    </a>

    <hr>

    <h3>Daftar Order ShopeeFood</h3>
    <button class="btn btn-success mb-3"
        data-bs-toggle="collapse"
        data-bs-target="#formTambah">
    + Tambah Order
</button>

<div class="collapse mb-3" id="formTambah">
    <div class="card card-body">

        <form method="post">

            <input type="text" name="kode" class="form-control mb-2" placeholder="No Order">

            <input type="text" name="customer" class="form-control mb-2" placeholder="Customer">

            <input type="text" name="restoran" class="form-control mb-2" placeholder="Restoran">

            <input type="text" name="total" class="form-control mb-2" placeholder="Total">

            <button type="submit" name="tambah" class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
</div>

<?php if($editData): ?>

<div class="card card-body mb-3">

<form method="post">

    <input type="hidden" name="kode_lama" value="<?= $editData['kode']; ?>">

    <label>No Order</label>
    <input type="text" name="kode"
           value="<?= $editData['kode']; ?>"
           class="form-control mb-2">

    <label>Customer</label>
    <input type="text" name="customer"
           value="<?= $editData['customer']; ?>"
           class="form-control mb-2">

    <label>Restoran</label>
    <input type="text" name="restoran"
           value="<?= $editData['restoran']; ?>"
           class="form-control mb-2">

    <label>Total</label>
    <input type="text" name="total"
           value="<?= $editData['total']; ?>"
           class="form-control mb-2">

    <button type="submit"
            name="update"
            class="btn btn-warning text-white">
        Update
    </button>

</form>

</div>

<?php endif; ?>

    <table id="tabelOrder" class="table table-bordered table-hover">

        <thead class="table-warning">

        <tr>

            <th>No Order</th>
            <th>Customer</th>
            <th>Restoran</th>
            <th>Total</th>
            <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

        <?php foreach($order as $o){ ?>
        <tr>

            <td><?= $o['kode']; ?></td>

            <td><?= $o['customer']; ?></td>

            <td><?= $o['restoran']; ?></td>

            <td><?= $o['total']; ?></td>

    <td>
    <button class="btn btn-info btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#detail<?= $o['kode']; ?>">
        Detail
    </button>

    <a href="?edit=<?= $o['kode']; ?>" class="btn btn-warning btn-sm text-white">
        Edit
    </a>

    <a href="?hapus=<?= $o['kode']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin mau hapus order ini?')">
        Hapus
    </a>
            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>
<?php foreach($order as $o){ ?>

<div class="modal fade" id="detail<?= $o['kode']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">Detail Order</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>No Order</th>
                        <td><?= $o['kode']; ?></td>
                    </tr>

                    <tr>
                        <th>Customer</th>
                        <td><?= $o['customer']; ?></td>
                    </tr>

                    <tr>
                        <th>Restoran</th>
                        <td><?= $o['restoran']; ?></td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td><?= $o['total']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

<?php } ?>
</div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/datatables/js/datatables.min.js"></script>

<script>
new DataTable('#tabelOrder');
</script>

</body>
</html>