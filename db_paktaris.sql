-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2025 pada 08.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paktaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` int(10) NOT NULL,
  `isi` text NOT NULL,
  `tgl_waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`id_catatan`, `isi`, `tgl_waktu`) VALUES
(12, 'Tgl 11-08-2023 /Semua anggota sudah melakukan topup kas dan tabungan.', '2023-08-08 00:43:41'),
(13, 'Aplikasi ini dibuat untuk Kelas X PPLG/RPL 2, Bertujuan untuk pengelolaan dana tabungan dan dana kas kelas.', '2023-08-08 01:45:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chatgroup`
--

CREATE TABLE `chatgroup` (
  `id_chat` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `tgl_chat` datetime NOT NULL,
  `isi_chat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dompet_user`
--

CREATE TABLE `dompet_user` (
  `id_dompet` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `isi_dompet` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dompet_user`
--

INSERT INTO `dompet_user` (`id_dompet`, `id_user`, `isi_dompet`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0),
(11, 11, 0),
(12, 12, 0),
(13, 13, 0),
(14, 14, 0),
(15, 15, 0),
(16, 16, 0),
(17, 17, 0),
(18, 18, 0),
(19, 19, 0),
(20, 20, 0),
(21, 21, 0),
(22, 22, 0),
(23, 23, 0),
(24, 24, 0),
(25, 25, 0),
(26, 26, 0),
(27, 27, 0),
(28, 28, 0),
(29, 29, 0),
(30, 30, 0),
(31, 31, 0),
(32, 32, 0),
(33, 33, 0),
(34, 34, 0),
(35, 35, 0),
(36, 36, 0),
(37, 37, 0),
(38, 38, 0),
(39, 39, 0),
(40, 40, 0),
(41, 41, 0),
(42, 42, 0),
(43, 43, 0),
(44, 45, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_keluar`
--

CREATE TABLE `kas_keluar` (
  `id_kas_keluar` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nominal_kas_keluar` int(10) NOT NULL,
  `tgl_tarik` datetime NOT NULL,
  `deskripsi` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `kas_keluar`
--
DELIMITER $$
CREATE TRIGGER `kurangi_kas` AFTER INSERT ON `kas_keluar` FOR EACH ROW BEGIN
	UPDATE uang_kas SET total_kas = total_kas - new.nominal_kas_keluar WHERE new.tgl_tarik = new.tgl_tarik;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_user`
--

CREATE TABLE `kas_user` (
  `id_kas_user` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nominal_setor` int(10) NOT NULL,
  `tgl_setor` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `leveluser`
--

CREATE TABLE `leveluser` (
  `id_level` int(10) NOT NULL,
  `name_level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `leveluser`
--

INSERT INTO `leveluser` (`id_level`, `name_level`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_catatan`
--

CREATE TABLE `notifikasi_catatan` (
  `id_notifcat` int(10) NOT NULL,
  `isi_chat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi_catatan`
--

INSERT INTO `notifikasi_catatan` (`id_notifcat`, `isi_chat`) VALUES
(1, 'Aplikasi ini dibuat untuk Kelas X PPLG/RPL 2, Bertujuan untuk pengelolaan dana tabungan dan dana kas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_tariktunai`
--

CREATE TABLE `riwayat_tariktunai` (
  `id_riwayattarik` int(10) NOT NULL,
  `id_dompet` int(10) NOT NULL,
  `tgl_trxtarik` datetime NOT NULL,
  `saldo_keluar` int(10) NOT NULL,
  `saldo_awal` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `riwayat_tariktunai`
--
DELIMITER $$
CREATE TRIGGER `kirim_dana_keluar` AFTER INSERT ON `riwayat_tariktunai` FOR EACH ROW BEGIN
	UPDATE dompet_user SET isi_dompet = isi_dompet - new.saldo_keluar WHERE id_dompet = new.id_dompet AND new.status = 'SENDSALDO';
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `riwayat_saldo_keluar` AFTER INSERT ON `riwayat_tariktunai` FOR EACH ROW BEGIN
	UPDATE dompet_user SET isi_dompet = isi_dompet - new.saldo_keluar WHERE id_dompet = new.id_dompet AND new.status = 'DISETUJUI';
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_topup`
--

CREATE TABLE `riwayat_topup` (
  `id_riwayat` int(10) NOT NULL,
  `id_dompet` int(10) NOT NULL,
  `tgl_trx` datetime NOT NULL,
  `saldo_masuk` int(10) NOT NULL,
  `saldo_awal` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `riwayat_topup`
--
DELIMITER $$
CREATE TRIGGER `kirim_dana_masuk` AFTER INSERT ON `riwayat_topup` FOR EACH ROW BEGIN
	UPDATE dompet_user SET isi_dompet = isi_dompet + new.saldo_masuk WHERE id_dompet = new.id_dompet AND new.status = 'SENDSALDO';
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `riwayat_saldo_masuk` AFTER INSERT ON `riwayat_topup` FOR EACH ROW BEGIN
	UPDATE dompet_user SET isi_dompet = isi_dompet + new.saldo_masuk WHERE id_dompet = new.id_dompet and new.status = 'DISETUJUI';
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sendsaldo`
--

CREATE TABLE `sendsaldo` (
  `id_sendsaldo` int(10) NOT NULL,
  `id_dompet_1` int(10) NOT NULL,
  `id_dompet_2` int(10) NOT NULL,
  `tgl_trxsensaldo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sendsaldo`
--

INSERT INTO `sendsaldo` (`id_sendsaldo`, `id_dompet_1`, `id_dompet_2`, `tgl_trxsensaldo`) VALUES
(1, 1, 400489, '2023-08-07 17:37:52'),
(2, 1, 2, '2023-08-07 17:40:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ambil`
--

CREATE TABLE `tbl_ambil` (
  `id_ambil` int(10) NOT NULL,
  `id_brg` varchar(10) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `tgl_brg_keluar` date NOT NULL,
  `jumlah_brg` int(10) NOT NULL,
  `alamat_ruang` varchar(225) NOT NULL,
  `tujuan_gunabarang` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_ambil`
--

INSERT INTO `tbl_ambil` (`id_ambil`, `id_brg`, `nama_guru`, `tgl_brg_keluar`, `jumlah_brg`, `alamat_ruang`, `tujuan_gunabarang`) VALUES
(16, '7', 'andi', '2025-01-30', 2, 'C1', 'Praktik'),
(17, '7', 'dimas', '2025-01-30', 1, 'C1', 'praktik'),
(18, '20', 'andi', '2025-01-30', 2, 'C1', 'praktik di lab'),
(19, '7', 'Dudi', '2025-01-31', 1, 'C1', 'Latihan lsp');

--
-- Trigger `tbl_ambil`
--
DELIMITER $$
CREATE TRIGGER `alfter insert ambil barang` AFTER INSERT ON `tbl_ambil` FOR EACH ROW BEGIN
	update tbl_barang set jumlah_brg = jumlah_brg - new.jumlah_brg where id_brg = new.id_brg;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_brg` int(20) NOT NULL,
  `barcode_brg` varchar(50) NOT NULL,
  `nama_brg` varchar(225) NOT NULL,
  `gambar_brg` varchar(225) NOT NULL,
  `norak_brg` int(50) NOT NULL,
  `tgl_masuk_brg` date NOT NULL,
  `spesifikasi_brg` varchar(225) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `jumlah_brg` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_brg`, `barcode_brg`, `nama_brg`, `gambar_brg`, `norak_brg`, `tgl_masuk_brg`, `spesifikasi_brg`, `id_kategori`, `jumlah_brg`) VALUES
(7, '6971548131706', 'ROBOT Flash Drive RF-103', '678e2ccbe6db3.png', 1, '2025-01-17', '8 GB', 6, 19),
(8, '8997241890038', 'Ajibpol Air minum', '678a09db7b6fe.png', 13, '2025-01-24', '600 ML', 7, 17),
(9, '8992752011408', 'Vit Air Minum', '678a0b1605513.png', 13, '2025-01-17', '550 ML', 7, 24),
(10, '8999988812000', 'Tulisan Inspirasi', '678a7a1313ec4.png', 13, '2025-01-17', '21 x 30 cm', 6, 2),
(11, '805112093557', 'Mouse Voxy W800', '678da2b572b89.png', 13, '2025-01-20', 'Wireless Connection, Ergonomic Design, Nano USB Receiver', 1, 7),
(16, 'SC240803474', 'SSD Ovation 1 TB', '678da463b17a4.png', 13, '2025-01-20', 'SATAIII 2.5\"', 6, 2),
(22, '8997017730575', 'Grow reg 12 btg filter', '679c82f8ec75a.png', 18, '2025-01-31', '12 batang', 7, 13);

--
-- Trigger `tbl_barang`
--
DELIMITER $$
CREATE TRIGGER `input_kehistory_stlh_delbrg` AFTER DELETE ON `tbl_barang` FOR EACH ROW BEGIN
	INSERT INTO tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) VALUES('','Delete Barang',old.id_brg, old.nama_brg, old.jumlah_brg, DATE(NOW()), TIME(NOW()));
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `input_kehistory_stlh_inbrg` AFTER INSERT ON `tbl_barang` FOR EACH ROW BEGIN
	insert into tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) values('','Input Barang', new.id_brg, new.nama_brg, new.jumlah_brg, DATE(NOW()), TIME(NOW()));
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `input_kehistory_stlh_upbrg` AFTER UPDATE ON `tbl_barang` FOR EACH ROW BEGIN
	INSERT INTO tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) VALUES('','Update Barang',new.id_brg, new.nama_brg, new.jumlah_brg, DATE(NOW()), TIME(NOW()));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id_history` int(10) NOT NULL,
  `jenis_aktivitas` varchar(50) NOT NULL,
  `id_brg` int(10) NOT NULL,
  `nama_brg` varchar(225) NOT NULL,
  `jumlah_brg` int(10) NOT NULL,
  `tgl_history` date NOT NULL,
  `waktu_history` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_history`
--

INSERT INTO `tbl_history` (`id_history`, `jenis_aktivitas`, `id_brg`, `nama_brg`, `jumlah_brg`, `tgl_history`, `waktu_history`) VALUES
(3, 'Ambil', 7, '', 1, '2025-01-30', '04:13:21'),
(4, 'Ambil', 20, '', 2, '2025-01-30', '10:16:16'),
(5, 'Pinjam', 7, '', 1, '0000-00-00', '10:55:15'),
(6, 'Pinjam', 7, '', 3, '2025-01-31', '02:04:09'),
(7, 'Barang Masuk', 21, '', 12, '2025-01-31', '14:18:17'),
(8, 'Barang Update', 21, '', 0, '2025-01-31', '14:22:21'),
(9, 'Barang Update', 21, '', 13, '2025-01-31', '14:23:13'),
(10, 'Barang Update', 21, '', 15, '2025-01-31', '14:23:30'),
(11, 'Delete Barang', 21, '', 15, '2025-01-31', '14:27:17'),
(12, 'Update Barang', 7, '', 14, '2025-01-31', '14:30:12'),
(13, 'Update Barang', 7, '', 14, '2025-01-31', '14:30:18'),
(14, 'Update Barang', 7, '', 13, '2025-01-31', '14:54:05'),
(15, 'Ambil', 7, 'ROBOT Flash Drive RF-103', 1, '2025-01-31', '02:54:05'),
(16, 'Pinjam', 8, 'Ajibpol Air minum', 2, '2025-01-31', '02:55:28'),
(17, 'Input Barang', 22, 'Grow reg 12 btg filter', 12, '2025-01-31', '14:59:52'),
(18, 'Update Barang', 22, 'Grow reg 12 btg filter', 13, '2025-01-31', '15:00:36'),
(19, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 14, '2025-01-31', '15:12:20'),
(20, 'Pinjam', 16, 'SSD Ovation 1 TB', 1, '2025-01-31', '03:39:05'),
(21, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 15, '2025-02-02', '07:08:23'),
(22, 'diKembalikan', 8, 'Ajibpol Air minum', 1, '2025-02-02', '07:21:47'),
(23, 'diKembalikan', 8, 'Ajibpol Air minum', 1, '2025-02-02', '08:32:07'),
(24, 'Delete Barang', 20, 'Hardis Eksternal 1TB', 2, '2025-02-02', '08:34:48'),
(25, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 16, '2025-02-03', '09:48:15'),
(26, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 18, '2025-02-03', '10:36:09'),
(27, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 19, '2025-02-03', '13:19:37'),
(28, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 20, '2025-02-10', '14:25:59'),
(29, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 20, '2025-02-10', '14:26:45'),
(30, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 20, '2025-02-10', '14:27:11'),
(31, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 20, '2025-02-10', '14:27:42'),
(32, 'Update Barang', 7, 'ROBOT Flash Drive RF-103', 20, '2025-02-10', '14:28:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Input'),
(2, 'Output'),
(3, 'Jaringan'),
(4, 'Kelistrikan'),
(5, 'Mainboard'),
(6, 'Media Penyimpanan'),
(7, 'Penghantar Tegangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_organisasi`
--

CREATE TABLE `tbl_organisasi` (
  `id_organisasi` int(10) NOT NULL,
  `nama_organisasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`id_organisasi`, `nama_organisasi`) VALUES
(1, 'Guru'),
(2, 'Siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjaman`
--

CREATE TABLE `tbl_pinjaman` (
  `id_pinjaman` int(10) NOT NULL,
  `id_brg` varchar(10) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `jumlah_pinjam` int(10) NOT NULL,
  `organisasi` varchar(50) NOT NULL,
  `tujuan_gunabarang` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pinjaman`
--

INSERT INTO `tbl_pinjaman` (`id_pinjaman`, `id_brg`, `nama_peminjam`, `tgl_pinjam`, `jumlah_pinjam`, `organisasi`, `tujuan_gunabarang`) VALUES
(17, '7', 'Hudamas', '2025-01-31', 3, 'guru', 'Praktik'),
(20, '7', 'M. Irfa NKH', '2025-02-20', 3, '', 'Praktik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tiketuser`
--

CREATE TABLE `tbl_tiketuser` (
  `id_tiketuser` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_brg` int(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tujuan_gunabarang` varchar(225) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_perkiraan_balik` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_tiketuser`
--

INSERT INTO `tbl_tiketuser` (`id_tiketuser`, `id_user`, `id_brg`, `tgl_pinjam`, `tujuan_gunabarang`, `jumlah`, `status`, `tgl_perkiraan_balik`) VALUES
(1, 45, 7, '2025-02-20', 'Praktik', 3, 'disetujui', '2025-02-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `nama_lengkap` varchar(35) NOT NULL,
  `position` varchar(35) NOT NULL,
  `user` char(15) NOT NULL,
  `pass` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_whatsapp` varchar(13) NOT NULL,
  `temp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_sekarang` varchar(225) NOT NULL,
  `img_profile` varchar(100) NOT NULL,
  `id_level` int(10) NOT NULL,
  `id_organisasi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `position`, `user`, `pass`, `email`, `no_whatsapp`, `temp_lahir`, `tgl_lahir`, `alamat_sekarang`, `img_profile`, `id_level`, `id_organisasi`) VALUES
(1, 'ABDILLAH YAHYA', 'SISWA', '400488', '400488', '400488@gmail.com', '2147483647', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(2, 'ADITYA WIJAYA', 'SISWA', '400489', '400489', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(3, 'AIRIN NUR HAFIA', 'SISWA', '400490', '400490', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(4, 'ANGGUN KARISMA', 'SISWA', '400491', '400491', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(5, 'ANISA IRNAWATI AGUSTIN', 'SISWA', '400492', '400492', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(6, 'BAGAS RIZKY FEBIANO', 'SISWA', '400493', '400493', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(7, 'BAMBANG PRAYOGO', 'KETUA KELAS', '400494', '400494', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(8, 'BUNGA ZESILIA', 'SISWA', '400495', '400495', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(9, 'CAHYA NIASIH', 'SISWA', '400496', '400496', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(10, 'CALISTA ARGENTINA', 'SEKRETRIS 1', '400497', '400497', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(11, 'CHIKA MAYSA PUTRI', 'SISWA', '400498', '400498', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(12, 'DIAH AYUNINGRUM', 'SISWA', '400499', '400499', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(13, 'DINDA LESTARI', 'SISWA', '400500', '400500', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(14, 'DIVA JUNI ARIYANTI', 'SISWA', '400501', '400501', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(15, 'DIVA SEKAR KEDATHON', 'SISWA', '400502', '400502', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(16, 'DWI NUR AISAH', 'SISWA', '400503', '400503', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(17, 'FADHIL ROSI ALFASICH', 'SISWA', '400504', '400504', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(18, 'FARISCA NELY AGUSTIN', 'SISWA', '400505', '400505', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(19, 'FIKKA EMAY SHERISTI', 'SISWA', '400506', '400506', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(20, 'JESIKA YENI ERIYANTI', 'SISWA', '400507', '400507', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(21, 'KAYLA DWI HASTITI', 'SISWA', '400508', '400508', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(22, 'KHOZINATUL AIS SI', 'SISWA', '400509', '400509', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(23, 'LINTANG DWI CAHYANI', 'SISWA', '400510', '400510', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(24, 'LISA YULIANAH', 'SISWA', '400511', '400511', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(25, 'MAULANA ISHAQ', 'SISWA', '400512', '400512', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(26, 'MUHAMMAD NAZRIL MAULANA', 'SISWA', '400513', '400513', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(27, 'NABILA FILZA', 'SISWA', '400514', '400514', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(28, 'NADIA APRILIANI', 'SISWA', '400515', '400515', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(29, 'NASETIA LAURISTA', 'SISWA', '400516', '400516', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(30, 'PUTRI SAGITA SEPTIANA', 'SISWA', '400517', '400517', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(31, 'RAHMA AVIFDA', 'SISWA', '400518', '400518', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(32, 'RIZKI RAHMAT DANI', 'SISWA', '400519', '400519', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(33, 'SAFA NURSIAMI', 'BENDAHARA', '400520', '400520', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(34, 'SALWA AISSYABILA', 'SISWA', '400521', '400521', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(35, 'SELVI SEVILATUL AZIZAH', 'SISWA', '400522', '400522', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(36, 'SHERA RAMADHANI', 'SISWA', '400523', '400523', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(37, 'SHILFI BUNGA VANIA', 'SISWA', '400524', '400524', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(38, 'WIDIYANA APRILLIYANI', 'SISWA', '400525', '400525', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(39, 'WIHANI LUTFI HIDAYAH', 'WAKIL KETUA', '400526', '400526', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(40, 'WILDAN AUFA RIZQI', 'SISWA', '400527', '400527', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(41, 'WINARA FALIA PATI MUHID', 'SISWA', '400528', '400528', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(42, 'YENI KUSUMA WARDANI', 'SISWA', '400529', '400529', '400488@gmail.com', '0', 'Pemalang', '2011-09-30', 'Ds. Iser, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                                                                                            ', '', 2, 2),
(43, 'administrator', 'ADMIN', 'admin', 'adminrpl', 'administrator@gmail.com', '089643232261', 'Pemalang', '0000-00-00', 'Ds. Tegalmlati, Kec. Petarukan, Kab. Pemalang, Jawa Tengah', '', 1, 1),
(45, 'M. Irfa NKH', 'Walikelas', '031192', '031192', 'codemetik@gmail.com', '089643232261', 'Pemalang', '1992-11-03', 'Ds. Tegalmlati, Kec. Petarukan, Kab. Pemalang, Jawa Tengah                                    ', '', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_tariktunai`
--

CREATE TABLE `tiket_tariktunai` (
  `id_tikettarik` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nominal_tarik` int(10) NOT NULL,
  `tgl_tariktunai` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_topup`
--

CREATE TABLE `tiket_topup` (
  `id_tiket` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nominal_topup` int(10) NOT NULL,
  `tgl_tiket` datetime DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_kas`
--

CREATE TABLE `uang_kas` (
  `id_kas` int(10) NOT NULL,
  `total_kas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `uang_kas`
--

INSERT INTO `uang_kas` (`id_kas`, `total_kas`) VALUES
(2, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_agent`
--

CREATE TABLE `user_agent` (
  `id_agent` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `tgl_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name_user_agent` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_agent`
--

INSERT INTO `user_agent` (`id_agent`, `id_user`, `tgl_login`, `name_user_agent`) VALUES
(146, 43, '2025-02-20 07:20:52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36');

--
-- Trigger `user_agent`
--
DELIMITER $$
CREATE TRIGGER `delete_chatgroup` AFTER DELETE ON `user_agent` FOR EACH ROW BEGIN
	delete from chatgroup where id_user = old.id_user;
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indeks untuk tabel `chatgroup`
--
ALTER TABLE `chatgroup`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `dompet_user`
--
ALTER TABLE `dompet_user`
  ADD PRIMARY KEY (`id_dompet`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kas_keluar`
--
ALTER TABLE `kas_keluar`
  ADD PRIMARY KEY (`id_kas_keluar`);

--
-- Indeks untuk tabel `kas_user`
--
ALTER TABLE `kas_user`
  ADD PRIMARY KEY (`id_kas_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `leveluser`
--
ALTER TABLE `leveluser`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `notifikasi_catatan`
--
ALTER TABLE `notifikasi_catatan`
  ADD PRIMARY KEY (`id_notifcat`);

--
-- Indeks untuk tabel `riwayat_tariktunai`
--
ALTER TABLE `riwayat_tariktunai`
  ADD PRIMARY KEY (`id_riwayattarik`);

--
-- Indeks untuk tabel `riwayat_topup`
--
ALTER TABLE `riwayat_topup`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_dompet` (`id_dompet`);

--
-- Indeks untuk tabel `sendsaldo`
--
ALTER TABLE `sendsaldo`
  ADD PRIMARY KEY (`id_sendsaldo`);

--
-- Indeks untuk tabel `tbl_ambil`
--
ALTER TABLE `tbl_ambil`
  ADD PRIMARY KEY (`id_ambil`),
  ADD KEY `id_brg` (`id_brg`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_brg`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  ADD PRIMARY KEY (`id_organisasi`);

--
-- Indeks untuk tabel `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indeks untuk tabel `tbl_tiketuser`
--
ALTER TABLE `tbl_tiketuser`
  ADD PRIMARY KEY (`id_tiketuser`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `tiket_tariktunai`
--
ALTER TABLE `tiket_tariktunai`
  ADD PRIMARY KEY (`id_tikettarik`);

--
-- Indeks untuk tabel `tiket_topup`
--
ALTER TABLE `tiket_topup`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `uang_kas`
--
ALTER TABLE `uang_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indeks untuk tabel `user_agent`
--
ALTER TABLE `user_agent`
  ADD PRIMARY KEY (`id_agent`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `chatgroup`
--
ALTER TABLE `chatgroup`
  MODIFY `id_chat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `dompet_user`
--
ALTER TABLE `dompet_user`
  MODIFY `id_dompet` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `kas_keluar`
--
ALTER TABLE `kas_keluar`
  MODIFY `id_kas_keluar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kas_user`
--
ALTER TABLE `kas_user`
  MODIFY `id_kas_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT untuk tabel `leveluser`
--
ALTER TABLE `leveluser`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_catatan`
--
ALTER TABLE `notifikasi_catatan`
  MODIFY `id_notifcat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `riwayat_tariktunai`
--
ALTER TABLE `riwayat_tariktunai`
  MODIFY `id_riwayattarik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `riwayat_topup`
--
ALTER TABLE `riwayat_topup`
  MODIFY `id_riwayat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `sendsaldo`
--
ALTER TABLE `sendsaldo`
  MODIFY `id_sendsaldo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_ambil`
--
ALTER TABLE `tbl_ambil`
  MODIFY `id_ambil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_brg` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id_history` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  MODIFY `id_organisasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  MODIFY `id_pinjaman` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_tiketuser`
--
ALTER TABLE `tbl_tiketuser`
  MODIFY `id_tiketuser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tiket_tariktunai`
--
ALTER TABLE `tiket_tariktunai`
  MODIFY `id_tikettarik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tiket_topup`
--
ALTER TABLE `tiket_topup`
  MODIFY `id_tiket` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `uang_kas`
--
ALTER TABLE `uang_kas`
  MODIFY `id_kas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_agent`
--
ALTER TABLE `user_agent`
  MODIFY `id_agent` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dompet_user`
--
ALTER TABLE `dompet_user`
  ADD CONSTRAINT `dompet_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `kas_user`
--
ALTER TABLE `kas_user`
  ADD CONSTRAINT `kas_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `riwayat_topup`
--
ALTER TABLE `riwayat_topup`
  ADD CONSTRAINT `riwayat_topup_ibfk_1` FOREIGN KEY (`id_dompet`) REFERENCES `dompet_user` (`id_dompet`);

--
-- Ketidakleluasaan untuk tabel `tiket_topup`
--
ALTER TABLE `tiket_topup`
  ADD CONSTRAINT `tiket_topup_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
