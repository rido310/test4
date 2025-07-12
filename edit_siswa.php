<?php
include 'koneksi.php';
if (!isset($_GET['nis'])) {
    header('Location: siswa.php');
    exit;
}
$nis = $_GET['nis'];
$q = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
$siswa = mysqli_fetch_assoc($q);
if (!$siswa) {
    header('Location: siswa.php?msg=Data tidak ditemukan');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $update = mysqli_query($conn, "UPDATE siswa SET nama='$nama', kelas='$kelas', alamat='$alamat', tanggal_masuk='$tanggal_masuk' WHERE nis='$nis'");
    if ($update) {
        header('Location: siswa.php?msg=Data siswa berhasil diupdate');
        exit;
    } else {
        $error = 'Gagal update data siswa!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
  <div class="container">
    <a class="navbar-brand text-primary fw-bold" href="#">Pendataan Siswa & Pelanggaran</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="siswa.php">Data Siswa</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_siswa.php">Tambah Siswa</a></li>
        <li class="nav-item"><a class="nav-link" href="pelanggaran.php">Data Pelanggaran</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah_pelanggaran.php">Tambah Pelanggaran</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h4 class="mb-3">Edit Siswa</h4>
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" class="border p-4 bg-white rounded shadow-sm" id="formSiswa">
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $siswa['nis']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $siswa['kelas']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required><?php echo $siswa['alamat']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $siswa['tanggal_masuk']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="siswa.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html> 