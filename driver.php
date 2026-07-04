<?php
session_start();
include "class/data.php";

if (!isset($_SESSION['driver'])) {
    $_SESSION['driver'] = (new Data())->driver;
}

$data = $_SESSION['driver'];

/* ================= EDIT DATA ================= */
$editData = null;

if (isset($_GET['edit'])) {
    foreach ($data as $d) {
        if ($d['id'] == $_GET['edit']) {
            $editData = $d;
        }
    }
}

/* ================= TAMBAH ================= */
if (isset($_POST['tambah'])) {
    $data[] = [
        "id" => $_POST['id'],
        "nama" => $_POST['nama'],
        "kendaraan" => $_POST['kendaraan'],
        "status" => $_POST['status']
    ];

    $_SESSION['driver'] = $data;

    header("Location: driver.php");
    exit;
}

/* ================= UPDATE ================= */
if (isset($_POST['update'])) {
    foreach ($data as $i => $d) {
        if ($d['id'] == $_POST['id_lama']) {

            $data[$i]['id'] = $_POST['id']; // ID bisa diubah
            $data[$i]['nama'] = $_POST['nama'];
            $data[$i]['kendaraan'] = $_POST['kendaraan'];
            $data[$i]['status'] = $_POST['status'];
        }
    }

    $_SESSION['driver'] = $data;

    header("Location: driver.php");
    exit;   
}
if (isset($_GET['hapus'])) {

    foreach ($data as $i => $d) {
        if ($d['id'] == $_GET['hapus']) {
            unset($data[$i]);
        }
    }

    // rapikan index array
    $data = array_values($data);

    $_SESSION['driver'] = $data;

    header("Location: driver.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRUD Driver</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/datatables/css/datatables.min.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background:#ff6d00;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="index.php">
            ShopeeFood Driver
        </a>
    </div>
</nav>

<div class="container mt-5">

    <!-- Menu -->
    <a href="driver.php" class="btn btn-warning text-white">
        CRUD Driver
    </a>

    <a href="order.php" class="btn btn-light">
        Daftar Order
    </a>

    <a href="riwayat.php" class="btn btn-light">
        Riwayat Pengantaran
    </a>

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Manajemen Driver</h3>

        <button class="btn btn-success mb-3"
        data-bs-toggle="collapse"
        data-bs-target="#formTambah">
    + Tambah Driver
</button>

    </div>

    <!-- FORM TAMBAH DRIVER -->
<div class="collapse mb-3" id="formTambah">

    <div class="card card-body">

        <form method="post">

            <input type="text" name="id" class="form-control mb-2" placeholder="ID Driver">
            <input type="text" name="nama" class="form-control mb-2" placeholder="Nama">
            <input type="text" name="kendaraan" class="form-control mb-2" placeholder="Kendaraan">

            <select name="status" class="form-control mb-2">
                <option value="Online">Online</option>
                <option value="Offline">Offline</option>
            </select>

            <button type="submit" name="tambah" class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>

</div>
<?php if ($editData): ?>
<div class="card card-body mb-3">

    <form method="post">

    <input type="hidden" name="id_lama" value="<?= $editData['id']; ?>">

    <label>ID Driver</label>
    <input type="text" name="id" value="<?= $editData['id']; ?>" class="form-control mb-2">

    <input type="text" name="nama" value="<?= $editData['nama']; ?>" class="form-control mb-2">

    <input type="text" name="kendaraan" value="<?= $editData['kendaraan']; ?>" class="form-control mb-2">

    <select name="status" class="form-control mb-2">
        <option value="Online" <?= $editData['status']=="Online"?'selected':''; ?>>Online</option>
        <option value="Offline" <?= $editData['status']=="Offline"?'selected':''; ?>>Offline</option>
    </select>

    <button type="submit" name="update" class="btn btn-warning text-white">
        Update
    </button>

    </form>

</div>
<?php endif; ?>
    <table id="tabelDriver" class="table table-bordered table-hover">

        <thead class="table-warning">

            <tr>

                <th>ID Driver</th>
                <th>Nama</th>
                <th>Kendaraan</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

<?php foreach($data as $d){ ?>

<tr>
    <td><?= $d['id']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['kendaraan']; ?></td>
    <td><?= $d['status']; ?></td>

    <td>
        <button class="btn btn-info btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#detail<?= $d['id']; ?>">
            Detail
        </button>

        <a href="?edit=<?= $d['id']; ?>" class="btn btn-warning btn-sm text-white">
            Edit
        </a>

        <a href="?hapus=<?= $d['id']; ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin mau hapus driver ini?')">
            Hapus
        </a>
    </td>
</tr>

<?php } ?>

</tbody>
    </table>
<<?php foreach($data as $d){ ?>

<div class="modal fade" id="detail<?= $d['id']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">Detail Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>ID Driver</th>
                        <td><?= $d['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?= $d['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Kendaraan</th>
                        <td><?= $d['kendaraan']; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?= $d['status']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

<?php } ?>

        </tbody>

    </table>

</div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/datatables/js/datatables.min.js"></script>

<script>
new DataTable('#tabelDriver');
</script>

</body>
</html>