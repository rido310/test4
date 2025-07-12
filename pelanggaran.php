<?php
include 'koneksi.php';
// Ambil data pelanggaran join siswa
$data_pelanggaran = mysqli_query($conn, "SELECT p.*, s.nama, s.kelas FROM pelanggaran p JOIN siswa s ON p.nis = s.nis");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggaran</title>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Pelanggaran</h4>
        <a href="tambah_pelanggaran.php" class="btn btn-primary">Tambah Pelanggaran</a>
    </div>
    <?php if(isset($_GET['msg'])): ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Jenis Pelanggaran</th>
                <th>Poin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($data_pelanggaran)): ?>
            <tr>
                <td><?php echo $row['id_pelanggaran']; ?></td>
                <td><?php echo $row['nis']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['kelas']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['jenis_pelanggaran']; ?></td>
                <td><?php echo $row['poin']; ?></td>
                <td>
                    <a href="pelanggaran.php?hapus=<?php echo $row['id_pelanggaran']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
<?php
// Hapus data pelanggaran
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pelanggaran WHERE id_pelanggaran='$id'");
    header('Location: pelanggaran.php?msg=Data berhasil dihapus');
    exit;
}
?> 