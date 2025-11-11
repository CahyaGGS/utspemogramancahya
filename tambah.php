<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Peminjaman</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">

<div class="container">
  <h3 class="mb-4">Tambah Data Peminjaman</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>NIM</label>
      <input type="text" name="nim" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Prodi</label>
      <input type="text" name="prodi" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Jam Peminjaman</label>
      <input type="time" name="jam_peminjaman" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Peminjaman</label>
      <input type="date" name="tanggal_peminjaman" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Foto Alat</label>
      <input type="file" name="foto_alat" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $jam = $_POST['jam_peminjaman'];
    $tanggal = $_POST['tanggal_peminjaman'];

    $foto = $_FILES['foto_alat']['name'];
    $tmp = $_FILES['foto_alat']['tmp_name'];
    move_uploaded_file($tmp, "upload/".$foto);

    $query = "INSERT INTO peminjaman (nama, nim, prodi, jam_peminjaman, tanggal_peminjaman, foto_alat)
              VALUES ('$nama', '$nim', '$prodi', '$jam', '$tanggal', '$foto')";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
</div>
</body>
</html>
