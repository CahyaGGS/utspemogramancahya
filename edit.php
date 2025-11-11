<?php
include 'config.php';

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    die("<script>alert('ID tidak ditemukan!'); window.location='index.php';</script>");
}

$id = $_GET['id'];

// Ambil data lama berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Peminjaman</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body class="p-4 bg-light">

<div class="container">
  <h3 class="mb-4">✏️ Edit Data Peminjaman</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>NIM</label>
      <input type="text" name="nim" value="<?= $data['nim'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Prodi</label>
      <input type="text" name="prodi" value="<?= $data['prodi'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
  <label>Nama Alat</label>
  <input type="text" name="nama_alat" value="<?= htmlspecialchars($data['nama_alat']) ?>" class="form-control" required>
</div>

    <div class="mb-3">
      <label>Jam Peminjaman</label>
      <input type="time" name="jam_peminjaman" value="<?= $data['jam_peminjaman'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Peminjaman</label>
      <input type="date" name="tanggal_peminjaman" value="<?= $data['tanggal_peminjaman'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Foto Alat (kosongkan jika tidak diganti)</label><br>
      <img src="upload/<?= $data['foto_alat'] ?>" width="100" class="mb-2"><br>
      <input type="file" name="foto_alat" class="form-control" accept="image/*">
    </div>

    <button type="submit" name="update" class="btn btn-primary">💾 Simpan Perubahan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>

<?php
// ==========================
// BAGIAN UPDATE ADA DI SINI
// ==========================
if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $nim      = $_POST['nim'];
    $prodi    = $_POST['prodi'];
    $nama_alat = $_POST['nama_alat'];
    $jam      = $_POST['jam_peminjaman'];
    $tanggal  = $_POST['tanggal_peminjaman'];
    $fotoLama = $data['foto_alat'];

    // Cek apakah ada file foto baru diupload
    if (!empty($_FILES['foto_alat']['name'])) {
        $fotoBaru = $_FILES['foto_alat']['name'];
        $tmp      = $_FILES['foto_alat']['tmp_name'];
        $ext      = pathinfo($fotoBaru, PATHINFO_EXTENSION);
        $allowed  = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi jenis file
        if (!in_array(strtolower($ext), $allowed)) {
            echo "<script>alert('Tipe file tidak diizinkan! (Gunakan JPG/PNG)');</script>";
        } else {
            // Hapus foto lama jika ada
            if (file_exists("upload/$fotoLama") && $fotoLama != '') {
                unlink("upload/$fotoLama");
            }
            // Upload foto baru
            move_uploaded_file($tmp, "upload/" . $fotoBaru);

            // Query UPDATE dengan foto baru
            $query = "UPDATE peminjaman SET 
            nama='$nama',
            nim='$nim',
            prodi='$prodi',
            nama_alat='$nama_alat',
            jam_peminjaman='$jam',
            tanggal_peminjaman='$tanggal',
            foto_alat='$fotoBaru'
          WHERE id='$id'";

    } else {
        // Query UPDATE tanpa ganti foto
        $query = "UPDATE peminjaman SET 
            nama='$nama',
            nim='$nim',
            prodi='$prodi',
            nama_alat='$nama_alat',
            jam_peminjaman='$jam',
            tanggal_peminjaman='$tanggal'
          WHERE id='$id'";


    // Jalankan query update
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>
</div>

</body>
</html>
