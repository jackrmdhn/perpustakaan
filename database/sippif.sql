-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jun 2019 pada 15.01
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sippif`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `ID_ABSENSI` int(5) NOT NULL AUTO_INCREMENT,
  `ID_ADMIN` varchar(5) DEFAULT NULL,
  `ID_ANGGOTA` varchar(15) DEFAULT NULL,
  `TANGGAL_ABSENSI` varchar(20) DEFAULT NULL,
  `JAM_ABSENSI` varchar(20) NOT NULL,
  `STATUS` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_ABSENSI`),
  KEY `FK_RELATIONSHIP_3` (`ID_ADMIN`),
  KEY `FK_RELATIONSHIP_2` (`ID_ANGGOTA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`ID_ABSENSI`, `ID_ADMIN`, `ID_ANGGOTA`, `TANGGAL_ABSENSI`, `JAM_ABSENSI`, `STATUS`) VALUES
(32, 'A0001', NULL, '24/06/2019', '10:07:12', 'Admin'),
(33, NULL, '198410222014042', '24/06/2019', '10:08:56', 'Dosen'),
(34, 'A0001', NULL, '24/06/2019', '17:07:10', 'Admin'),
(35, NULL, '140631100117', '24/06/2019', '17:07:30', 'Mahasiswa'),
(36, NULL, '140631100120', '24/06/2019', '17:08:33', 'Mahasiswa'),
(37, 'A0001', NULL, '24/06/2019', '17:09:13', 'Admin'),
(38, 'A0002', NULL, '24/06/2019', '17:09:24', 'Petugas'),
(39, 'A0001', NULL, '24/06/2019', '19:48:14', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID_ADMIN` varchar(5) NOT NULL,
  `NAMA_ADMIN` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(10) DEFAULT NULL,
  `PASSWORD` varchar(5) DEFAULT NULL,
  `LEVEL` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `NAMA_ADMIN`, `USERNAME`, `PASSWORD`, `LEVEL`) VALUES
('A0001', 'Admin', 'Admin', '12345', 'Admin'),
('A0002', 'Petugas 1', 'Petugas1', '123', 'Petugas'),
('A0003', 'Petugas 2', 'Petugas2', '12345', 'Petugas'),
('A0004', 'Petugas 3', 'Petugas3', '12345', 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `ID_ANGGOTA` varchar(15) NOT NULL,
  `NAMA_ANGGOTA` varchar(20) DEFAULT NULL,
  `USERNAME1` varchar(10) DEFAULT NULL,
  `PASSWORD1` varchar(10) DEFAULT NULL,
  `TAHUN_ANGKATAN` varchar(11) NOT NULL,
  `ALAMAT` varchar(50) DEFAULT NULL,
  `JENIS_KELAMIN` varchar(10) DEFAULT NULL,
  `TANGGAL_LAHIR` varchar(20) DEFAULT NULL,
  `NOMOR_TELEPON` varchar(15) NOT NULL,
  `AGAMA` varchar(10) NOT NULL,
  `KETERANGAN` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_ANGGOTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`ID_ANGGOTA`, `NAMA_ANGGOTA`, `USERNAME1`, `PASSWORD1`, `TAHUN_ANGKATAN`, `ALAMAT`, `JENIS_KELAMIN`, `TANGGAL_LAHIR`, `NOMOR_TELEPON`, `AGAMA`, `KETERANGAN`) VALUES
('140631100117', 'Zakaria Ramadhan', 'Jack', '123', '2014', 'Bangkalan', 'Laki-laki', '10 Februari', '083850088154', 'Islam', 'Mahasiswa'),
('140631100120', 'Septiana Wulandari', 'Wulan', '12345', '2010', 'Bangkalan Madura', 'Perempuan', '10 Desember', '087806879123', 'Hindu', 'Mahasiswa'),
('198410222014042', 'Dinda Pratiwi', 'Dosen', '12345', '2013', 'Perumnas Kamal', 'Perempuan', '16 september', '087806879624', 'Kristen', 'Dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `ID_BUKU` varchar(12) NOT NULL,
  `KATEGORI_BUKU` varchar(50) NOT NULL,
  `JUDUL` varchar(100) DEFAULT NULL,
  `PENGARANG` varchar(50) DEFAULT NULL,
  `PENERBIT` varchar(50) DEFAULT NULL,
  `TAHUN_TERBIT` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_BUKU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`ID_BUKU`, `KATEGORI_BUKU`, `JUDUL`, `PENGARANG`, `PENERBIT`, `TAHUN_TERBIT`) VALUES
('0001879187', 'Pendidikan', 'Pendidikan Bahasa Indonesia', 'Pengarang 7', 'Penerbit 7', '2017'),
('0001879193', 'Informatika', 'Basis Data', 'Pengarang 6', 'Penerbit 6', '2013'),
('0001879198', 'Pendidikan', 'Penelitian pendidikan', 'Pengarang 4', 'Penerbit 4', '2011'),
('0001879330', 'Informatika', 'Pemrograman Dasar', 'Pengarang 8', 'Penerbit 8', '2019'),
('0001879374', 'Pendidikan', 'Metode Pembelajaran', 'Pengarang 5', 'Penerbit 5', '2015'),
('0006038427', 'Informatika', 'Pemrograman WEB berbasis desktop', 'Pengarang 1', 'Penerbit 1', '2018'),
('0006183803', 'Pendidikan', 'Psikologi Pendidikan', 'pengarang 2', 'Penerbit 2', '2011'),
('0006226827', 'Pendidikan', 'Metode Penelitian Pembelajaran', 'Pengarang 3', 'Penerbit 3', '2019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `ID_PEMINJAMAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ADMIN` varchar(5) DEFAULT NULL,
  `ID_BUKU` varchar(11) DEFAULT NULL,
  `ID_ANGGOTA` varchar(15) DEFAULT NULL,
  `TANGGAL_PINJAM` varchar(100) DEFAULT NULL,
  `TANGGAL_KEMBALI` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_PEMINJAMAN`),
  KEY `FK_RELATIONSHIP_8` (`ID_ADMIN`),
  KEY `FK_RELATIONSHIP_7` (`ID_BUKU`),
  KEY `FK_RELATIONSHIP_11` (`ID_ANGGOTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
