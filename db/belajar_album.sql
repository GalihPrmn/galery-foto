-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Bulan Mei 2024 pada 15.47
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajar_album`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `id` int(11) NOT NULL,
  `Komentar` text NOT NULL,
  `TanggalUnggah` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `postingan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_postingan`
--

CREATE TABLE `tbl_postingan` (
  `id` int(11) NOT NULL,
  `JudulFoto` varchar(255) NOT NULL,
  `DeskripsiFoto` text NOT NULL,
  `TanggalUnggah` date NOT NULL,
  `LokasiFile` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(1, 'Admin', '$2y$10$NG9oXhYCRIvFUH/tXgp21.yosFf5y9Ypx6FobK27jeWSQ5mPJMJqi', 'admin@gmail.com', 'Galih Pramana', 'Bandung');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nama_komentar` (`user_id`),
  ADD KEY `fk_sambung_postingan` (`postingan_id`);

--
-- Indeks untuk tabel `tbl_postingan`
--
ALTER TABLE `tbl_postingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nama_postingan` (`user_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tbl_postingan`
--
ALTER TABLE `tbl_postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD CONSTRAINT `fk_nama_komentar` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `fk_sambung_postingan` FOREIGN KEY (`postingan_id`) REFERENCES `tbl_postingan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_postingan`
--
ALTER TABLE `tbl_postingan`
  ADD CONSTRAINT `fk_nama_postingan` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
