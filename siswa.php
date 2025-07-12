<?php
include 'koneksi.php';
// Ambil data siswa
$data_siswa = mysqli_query($conn, "SELECT * FROM siswa");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
        <h4>Data Siswa</h4>
        <a href="tambah_siswa.php" class="btn btn-primary">Tambah Siswa</a>
    </div>
    <?php if(isset($_GET['msg'])): ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($data_siswa)): ?>
            <tr>
                <td><?php echo $row['nis']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['kelas']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['tgl_masuk']; ?></td>
                <td>
                    <a href="edit_siswa.php?nis=<?php echo $row['nis']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="siswa.php?hapus=<?php echo $row['nis']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
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
// Hapus data siswa
if(isset($_GET['hapus'])) {
    $nis = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM siswa WHERE nis='$nis'");
    header('Location: siswa.php?msg=Data berhasil dihapus');
    exit;
}
?> 