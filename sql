CREATE DATABASE db_peminjaman;

USE db_peminjaman;

CREATE TABLE peminjaman (
    ADD COLUMN nama_alat VARCHAR(100) AFTER prodi;
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    nim VARCHAR(20),
    prodi VARCHAR(100),
    jam_peminjaman TIME,
    tanggal_peminjaman DATE,
    foto_alat VARCHAR(255)
);
