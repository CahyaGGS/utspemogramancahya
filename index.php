<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Peminjaman Alat Medis</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">

<div class="container">
  <h2 class="mb-4 text-center">📋 Data Peminjaman Alat Medis</h2>
  <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Data</a>
  
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Prodi</th>
        <th>Jam</th>
        <th>Tanggal</th>
        <th>Foto Alat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM peminjaman ORDER BY id DESC");
      $no = 1;
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['prodi'] ?></td>
        <td><?= $row['jam_peminjaman'] ?></td>
        <td><?= $row['tanggal_peminjaman'] ?></td>
        <td><img src="upload/<?= $row['foto_alat'] ?>" width="80"></td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
