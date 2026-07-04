<?php
session_start();
include "class/data.php";

if (!isset($_SESSION['riwayat'])) {
    $_SESSION['riwayat'] = (new Data())->riwayat;
}

$riwayat = $_SESSION['riwayat'];

/* ================= EDIT DATA ================= */
$editData = null;

if (isset($_GET['edit'])) {
    foreach ($riwayat as $r) {
        if ($r['driver'] == $_GET['edit']) {
            $editData = $r;
        }
    }
}

/* ================= TAMBAH ================= */
if (isset($_POST['tambah'])) {

    $riwayat[] = [
        "driver" => $_POST['driver'],
        "customer" => $_POST['customer'],
        "restoran" => $_POST['restoran'],
        "jam" => $_POST['jam']
    ];

    $_SESSION['riwayat'] = $riwayat;

    header("Location: riwayat.php");
    exit;
}

/* ================= UPDATE ================= */
if (isset($_POST['update'])) {

    foreach ($riwayat as $i => $r) {

        if ($r['driver'] == $_POST['driver_lama']) {

            $riwayat[$i]['driver'] = $_POST['driver'];
            $riwayat[$i]['customer'] = $_POST['customer'];
            $riwayat[$i]['restoran'] = $_POST['restoran'];
            $riwayat[$i]['jam'] = $_POST['jam'];
        }
    }

    $_SESSION['riwayat'] = $riwayat;

    header("Location: riwayat.php");
    exit;
}

/* ================= HAPUS ================= */
if (isset($_GET['hapus'])) {

    foreach ($riwayat as $i => $r) {

        if ($r['driver'] == $_GET['hapus']) {
            unset($riwayat[$i]);
        }
    }

    $riwayat = array_values($riwayat);

    $_SESSION['riwayat'] = $riwayat;

    header("Location: riwayat.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Riwayat Pengantaran</title>

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

<a href="order.php" class="btn btn-light">
Daftar Order
</a>

<a href="riwayat.php" class="btn btn-warning text-white">
Riwayat Pengantaran
</a>

<hr>

<h3>Riwayat Pengantaran</h3>
<button class="btn btn-success mb-3"
        data-bs-toggle="collapse"
        data-bs-target="#formTambah">
    + Tambah Riwayat
</button>

<table id="tabelRiwayat" class="table table-bordered table-hover">

<<thead class="table-warning">
<tr>
    <th>Driver</th>
    <th>Customer</th>
    <th>Restoran</th>
    <th>Jam</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php foreach($riwayat as $r){ ?>

<tr>

    <td><?= $r['driver']; ?></td>
    <td><?= $r['customer']; ?></td>
    <td><?= $r['restoran']; ?></td>
    <td><?= $r['jam']; ?></td>

    <td>
        <span class="badge bg-success">
            Selesai
        </span>
    </td>

    <td>
    <button class="btn btn-info btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#detail<?= $r['driver']; ?>">
        Detail
    </button>

    <a href="?edit=<?= $r['driver']; ?>"
       class="btn btn-warning btn-sm text-white">
        Edit
    </a>

    <a href="?hapus=<?= $r['driver']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin ingin menghapus data ini?')">
        Hapus
    </a>
</td>

</tr>

<?php } ?>

</tbody>
<div class="collapse mb-3" id="formTambah">

    <div class="card card-body">

        <form method="post">

            <input type="text" name="driver" class="form-control mb-2" placeholder="Driver">

            <input type="text" name="customer" class="form-control mb-2" placeholder="Customer">

            <input type="text" name="restoran" class="form-control mb-2" placeholder="Restoran">

            <input type="text" name="jam" class="form-control mb-2" placeholder="Jam">

            <button type="submit" name="tambah" class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>

</div>
</table>
<?php foreach($riwayat as $r){ ?>

<div class="modal fade" id="detail<?= $r['driver']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">Detail Riwayat Pengantaran</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <table class="table">
                    <tr>
                        <th>Driver</th>
                        <td><?= $r['driver']; ?></td>
                    </tr>

                    <tr>
                        <th>Customer</th>
                        <td><?= $r['customer']; ?></td>
                    </tr>

                    <tr>
                        <th>Restoran</th>
                        <td><?= $r['restoran']; ?></td>
                    </tr>

                    <tr>
                        <th>Jam</th>
                        <td><?= $r['jam']; ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">
                                Selesai
                            </span>
                        </td>
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
new DataTable('#tabelRiwayat');
</script>

</body>
</html>