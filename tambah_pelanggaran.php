<?php
include 'koneksi.php';
// Pilihan jenis pelanggaran dan poin
$jenis_list = [
    'Terlambat Masuk' => 5,
    'Tidak Pakai Seragam' => 7,
    'Membolos' => 10,
    'Merokok' => 15
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis_pelanggaran'];
    $poin = $jenis_list[$jenis];
    // Hitung total poin siswa
    $q = mysqli_query($conn, "SELECT SUM(poin) as total FROM pelanggaran WHERE nis='$nis'");
    $d = mysqli_fetch_assoc($q);
    $total = $d['total'] + $poin;
    $alert = '';
    if ($total > 15) {
        $alert = '<div class="alert alert-warning">Poin siswa melebihi 15! (Total: ' . $total . ')</div>';
    }
    $insert = mysqli_query($conn, "INSERT INTO pelanggaran (nis, tanggal, jenis_pelanggaran, poin) VALUES ('$nis', '$tanggal', '$jenis', '$poin')");
    if ($insert) {
        header('Location: pelanggaran.php?msg=Data pelanggaran berhasil ditambah');
        exit;
    } else {
        $error = 'Gagal menambah data pelanggaran!';
    }
}
// Ambil data siswa untuk dropdown
$siswa = mysqli_query($conn, "SELECT nis, nama FROM siswa");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggaran</title>
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
            <h4 class="mb-3">Tambah Pelanggaran</h4>
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if(isset($alert)) echo $alert; ?>
            <form method="post" class="border p-4 bg-white rounded shadow-sm" id="formPelanggaran">
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <select class="form-select" id="nis" name="nis" required>
                        <option value="">Pilih Siswa</option>
                        <?php while($row = mysqli_fetch_assoc($siswa)): ?>
                        <option value="<?php echo $row['nis']; ?>"><?php echo $row['nis'] . ' - ' . $row['nama']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_pelanggaran" class="form-label">Jenis Pelanggaran</label>
                    <select class="form-select" id="jenis_pelanggaran" name="jenis_pelanggaran" required>
                        <option value="">Pilih Jenis</option>
                        <?php foreach($jenis_list as $jenis => $poin): ?>
                        <option value="<?php echo $jenis; ?>"><?php echo $jenis . ' (' . $poin . ' poin)'; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="pelanggaran.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html> 