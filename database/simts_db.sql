-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 06:21 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `GMAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `USERNAME`, `PASSWORD`, `NAMA`, `GMAIL`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Moch Zaenal Mahfud Md', 'umam@gmail');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(3) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_penulis` int(3) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `jumlah_hlm` int(4) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `sinopsis` text NOT NULL,
  `nama_file` text NOT NULL,
  `cover` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `id_penulis`, `id_kategori`, `jumlah_hlm`, `tahun_terbit`, `tgl_masuk`, `sinopsis`, `nama_file`, `cover`) VALUES
(1, 'Mengejar Design Sprint', 1, 1, 32, '2023', '2021-06-26 18:44:43', 'Design Sprint itu metodologi yang udah terbukti buat nyelesain masalah lewat desain, bikin prototipe, & nge-test ide ke pengguna kita. Desain Sprint itu juga bisa nyelarasin visi tim kita supaya tujuan & hasilnya jelas & cepat.p', 'file_1.pdf', 'cover_1.png'),
(2, 'The Wonderful Wizard of Oz', 2, 2, 130, '2008', '2021-06-26 18:52:02', 'Folklore, legends, myths and fairy tales have followed childhood through the ages, for every healthy youngster has a wholesome and instinctive love for stories fantastic, marvelous and manifestly unreal. The winged fairies of Grimm and Andersen have brought more happiness to childish hearts than all other human creations.', 'file_2.pdf', 'cover_2.png'),
(3, 'Reinkarnasi', 3, 2, 167, '2013', '2021-06-26 18:54:08', 'Zaila, gadis 12 tahun yang sedang bermain ditepi sungai mencari ikan bersama teman-temannya tiba-tiba terpelaset dan terjatuh hingga tak sadarkan diri. Dari sinilah semuanya bermula. Ketika ia tersadar, ia tidak dalam raga dirinya melainkan berada di raga yang lain dan di zaman yang lain. Namanya Sekar. Seorang puteri keraton pada masa penjajahan belanda. Ternyata ia telah mundur ke 180 tahun silam, tepatnya pada tahun 1831.', 'file_3.pdf', 'cover_3.png'),
(9, 'aku suka buah', 1, 1, 12, '2023', '2024-06-25 15:58:23', 'Apache/2.4.54 (Win64) OpenSSL/1.1.1p PHP/8.1.10 Server at localhost Port 80', 'file_9.pdf', 'cover_9.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kegiatan`
--

CREATE TABLE `detail_kegiatan` (
  `ID_DETAIL` int(11) NOT NULL,
  `ID_KEGIATAN` int(11) DEFAULT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `KETERANGAN_KEGIATAN` varchar(250) DEFAULT NULL,
  `GAMBAR` varchar(50) DEFAULT NULL,
  `KONFIRMASI_KEGIATAN` int(11) DEFAULT NULL,
  `TANGGAL_ABSEN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_kegiatan`
--

INSERT INTO `detail_kegiatan` (`ID_DETAIL`, `ID_KEGIATAN`, `ID_SISWA`, `KETERANGAN_KEGIATAN`, `GAMBAR`, `KONFIRMASI_KEGIATAN`, `TANGGAL_ABSEN`) VALUES
(64, 10, 3, 'ok', 'LOGO-UNISLA-removebg-preview.png', NULL, '2024-06-24 00:00:00'),
(68, 4, 2, 'Hadir', 'Group 58.png', NULL, '2024-06-25 00:00:00'),
(69, 4, 11, 'Hadir', 'Group 63.png', NULL, '2024-06-25 00:00:00'),
(70, 8, 11, 'hadir', 'WIN_20230115_21_53_07_Pro.jpg', NULL, '2024-06-25 00:00:00'),
(71, 8, 2, 'hadir', 'Screenshot (209).png', NULL, '2024-06-25 00:00:00'),
(72, 7, 2, 'hadir', 'Cuplikan layar 2024-06-05 230644.png', NULL, '2024-06-25 00:00:00'),
(73, 9, 2, 'hadir', 'Cuplikan layar 2024-06-06 130342.png', NULL, '2024-06-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `detail_tugas`
--

CREATE TABLE `detail_tugas` (
  `ID_DETAIL_TUGAS` int(11) NOT NULL,
  `ID_TUGAS` int(11) NOT NULL,
  `ID_SISWA` int(11) DEFAULT NULL,
  `NILAI` varchar(50) DEFAULT NULL,
  `KETERANGAN` varchar(250) DEFAULT NULL,
  `JAWAB_TUGAS` text DEFAULT NULL,
  `FILE_TUGAS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_tugas`
--

INSERT INTO `detail_tugas` (`ID_DETAIL_TUGAS`, `ID_TUGAS`, `ID_SISWA`, `NILAI`, `KETERANGAN`, `JAWAB_TUGAS`, `FILE_TUGAS`) VALUES
(102, 36, 2, '99', NULL, 'ok', ''),
(103, 36, 11, '68', NULL, 'mantap', ''),
(104, 37, 11, '99', NULL, 'Untuk memperbaiki agar halaman cetak responsif dan memastikan teks panjang juga tercetak dengan baik, perlu dilakukan beberapa penyesuaian pada kode HTML dan CSS. Berikut adalah langkah-langkah yang dapat Anda ikuti:', ''),
(105, 38, 11, '68', NULL, 'sudah di kumpulkan', '');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `ID_GURU` int(11) NOT NULL,
  `NIP` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `GMAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`ID_GURU`, `NIP`, `USERNAME`, `PASSWORD`, `NAMA`, `GMAIL`) VALUES
(0, '12', 'umam', '827ccb0eea8a706c4c34a16891f84e7b', 'umam', 'umam@gmail'),
(1, '12345', 'ahmadsyaqid', '827ccb0eea8a706c4c34a16891f84e7b', 'AHMAD SYAQID, S.pd', '@gmail.com'),
(2, '12346', 'sumirto', '827ccb0eea8a706c4c34a16891f84e7b', 'SUMIRTO, S.Ag', 'sumirto@gmail.com'),
(3, '12347', 'ahmadprisendi', '827ccb0eea8a706c4c34a16891f84e7b', 'AHMAD PRISENDI, S.Pd', 'ahmad.prisendi@gmail.com'),
(4, '12348', 'nyotonugroho', '827ccb0eea8a706c4c34a16891f84e7b', 'NYOTO NUGROHO, S.I.P', 'nyoto.nugroho@gmail.com'),
(5, '12349', 'erlindanurkhoiriyah', '827ccb0eea8a706c4c34a16891f84e7b', 'ERLINDA NUR KHOIRIYAH', 'erlinda.khoiriyah@gmail.com'),
(6, '12350', 'lutfatusshoidah', '827ccb0eea8a706c4c34a16891f84e7b', 'LUTFATUS SHOIDAH, S.Pd', 'lutfatus.shoidah@gmail.com'),
(7, '12351', 'nafikali', '827ccb0eea8a706c4c34a16891f84e7b', 'NAFIK ALI, S.Pd.', 'nafik.ali@gmail.com'),
(8, '12352', 'sibaweh', '827ccb0eea8a706c4c34a16891f84e7b', 'SIBAWEH, S.Pd MOH, SHOLEH', 'sibaweh.shoeh@gmail.com'),
(9, '12353', 'moh.warji', '827ccb0eea8a706c4c34a16891f84e7b', 'MOH. WARJI', 'moh.warji@gmail.com'),
(10, '12354', 'ahmadpuji', '827ccb0eea8a706c4c34a16891f84e7b', 'AHMAD PUJI. S.Pd', 'ahmad.puji@gmail.com'),
(11, '12355', 'syamsuddin', '827ccb0eea8a706c4c34a16891f84e7b', 'SYAMSUDDIN, S.Pd', 'syamsuddin@gmail.com'),
(12, '12356', 'm.ainurrohim', '827ccb0eea8a706c4c34a16891f84e7b', 'M. AINURROHIM, S.Pdl', 'ainurrohim@gmail.com'),
(13, '12357', 'niswatussyafa\'ah', '827ccb0eea8a706c4c34a16891f84e7b', 'NISWATUS SYAFA\'AH, S.Pd.', 'niswatus.syafaah@gmail.com'),
(14, '12358', 'sampirilt.tamaji', '827ccb0eea8a706c4c34a16891f84e7b', 'SAMPIRIL T. TAMAJI, M.Pd.I', 'sampiril.tamaji@gmail.com'),
(15, '12359', 'khoirunnisa', '827ccb0eea8a706c4c34a16891f84e7b', 'KHOIRUN NISA, M.Pd.I', 'khoirun.nisa@gmail.com'),
(16, '12360', 'hidayatulmukarromah', '827ccb0eea8a706c4c34a16891f84e7b', 'HIDAYATUL MUKARROMAH, S.SI', 'hidayatul.mukarromah@gmail.com'),
(17, '12361', 'mochzuhrulumam', '827ccb0eea8a706c4c34a16891f84e7b', 'MOCH ZUHRUL UMAM', 'zuhrul.umam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Desain'),
(2, 'Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `ID_KEGIATAN` int(11) NOT NULL,
  `NAMA_KEGIATAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`ID_KEGIATAN`, `NAMA_KEGIATAN`) VALUES
(4, 'Pramuka'),
(7, 'Al - banjari'),
(8, 'Qiro\'a'),
(9, 'Jurnalistik');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `ID_MATERI` int(11) NOT NULL,
  `ID_GURU` int(11) DEFAULT NULL,
  `NAMA_MATERI` varchar(250) DEFAULT NULL,
  `KETERANGAN_MATERI` varchar(250) DEFAULT NULL,
  `LINK_MATERI` varchar(250) DEFAULT NULL,
  `LINK_FILE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`ID_MATERI`, `ID_GURU`, `NAMA_MATERI`, `KETERANGAN_MATERI`, `LINK_MATERI`, `LINK_FILE`) VALUES
(1, 1, 'Mengambar', 'pelajari', 'view-source:file:///C:/xampp/htdocs/simts-new/public/front-end/pages/billing.html', 'view-source:file:///C:/xampp/htdocs/simts-new/public/front-end/pages/billing.html');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `ID_PELAJARAN` int(11) NOT NULL,
  `KELAS` varchar(50) NOT NULL,
  `NAMA_PELAJARAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`ID_PELAJARAN`, `KELAS`, `NAMA_PELAJARAN`) VALUES
(1, '9', 'TIK KELAS 9'),
(2, '9', 'B. INGGRIS KELAS 9'),
(3, '9', 'AKHIDA AKHLAK KELAS 9'),
(4, '9', 'MATIMATIKA KELAS 9'),
(5, '9', 'IPS KELAS 9'),
(6, '9', 'PRAKARYA KELAS 9'),
(7, '9', 'PKN KELAS 9'),
(8, '9', 'MATIMATIKA KELAS 9'),
(9, '9', 'ASWAJA KELAS 9'),
(10, '9', 'IPS KELAS 9'),
(11, '9', 'GHOYAH WATTAQRIB KELAS 9'),
(12, '9', 'B. INGGRIS KELAS 9'),
(13, '9', 'BAHASA INDONESIA KELAS 9'),
(14, '9', 'PENJASKES KELAS 9'),
(15, '9', 'SBK KELAS 9'),
(16, '9', 'BAHASA ARAB KELAS 9'),
(17, '9', 'PKN KELAS 9'),
(18, '9', 'IPA KELAS 9');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` int(11) NOT NULL,
  `ID_SISWA` int(11) DEFAULT NULL,
  `NAMA_PEMBAYARAN` varchar(50) DEFAULT NULL,
  `TOTAL_PEMBAYARAN` varchar(50) DEFAULT NULL,
  `KONFIRMASI_BAYAR` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `ID_SISWA`, `NAMA_PEMBAYARAN`, `TOTAL_PEMBAYARAN`, `KONFIRMASI_BAYAR`) VALUES
(33, 11, 'Ujian akhir semester', '200.000', 'Lunas'),
(34, 11, 'Ujian tengah semester', '100.000', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `ID_PENGAJAR` int(11) NOT NULL,
  `ID_PELAJARAN` int(11) DEFAULT NULL,
  `ID_GURU` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`ID_PENGAJAR`, `ID_PELAJARAN`, `ID_GURU`) VALUES
(4, 1, 17),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(3) NOT NULL,
  `penulis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `penulis`) VALUES
(1, 'Rizki Mardita'),
(2, 'L. Frank Baum'),
(3, 'Ditta Hakha');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `ID_SISWA` int(11) NOT NULL,
  `NISN` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `NAMA` varchar(100) DEFAULT NULL,
  `KELAS` varchar(10) DEFAULT NULL,
  `GMAIL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`ID_SISWA`, `NISN`, `USERNAME`, `PASSWORD`, `NAMA`, `KELAS`, `GMAIL`) VALUES
(2, '0094622829', '0094622829', '9f7ce276de2f973e5f0af2d36a02c330', 'ALFIAN NUR RAMADHAN', '9', 'ALFIANNURRAMADHAN@gmail.com'),
(3, '3105838031', '3105838031', 'd7ac4545e3021174017695699af199f5', 'ALIZA AINUN ZUMRO', '9', 'ALIZAAINUNZUMRO@gmail.com'),
(4, '3104062809', '3104062809', '6a1200e3ce0bb1aebce22a0e21d24032', 'ALVIN ARDIANSYAH PUTRA', '9', 'ALVINARDIANSYAHPUTRA@gmail.com'),
(5, '0107582437', '0107582437', '3fc714b053cbc20a45661f8c7c0e00b8', 'DIAZ AKMAL ADITYA', '9', 'DIAZAKMALADITYA@gmail.com'),
(6, '0099733774', '0099733774', 'a10132b304c94c53e4cde316ebdd6243', 'FITRIA AYU SHOLIHAH', '9', 'FITRIAAYUSHOLIHAH@gmail.com'),
(7, '3105042664', '3105042664', '957c80cea22194d1d5c1b9133f9ee4b4', 'GEBBY AULIDIYAH AZKIYA', '9', 'GEBBYAULIDIYAHAZKIYA@gmail.com'),
(8, '0096404144', '0096404144', '20374a83b6bba1672df0aed659b402f4', 'LUTFI FAITH RAFI\' SETIAWAN', '9', 'LUTFIFAITHRAFISETIAWAN@gmail.com'),
(9, '3091625959', '3091625959', '55086c27dab7db3e709601e6e16a24d3', 'RENDY SAPUTRA', '9', 'RENDYSAPUTRA@gmail.com'),
(10, '3108858882', '3108858882', 'f5e57050397f2a49f080f77abeb343f4', 'SILAH KAMILAH', '9', 'SILAHKAMILAH@gmail.com'),
(11, '0095299891', '0095299891', '18501f5e9e3c6af5552a36783c9cb4c5', 'AHMAD SYAUQI RIZAL', '9', 'AHMADSYAUQIRIZAL@GMAIL.COM');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `ID_TUGAS` int(11) NOT NULL,
  `ID_PENGAJAR` int(11) DEFAULT NULL,
  `NAMA_TUGAS` varchar(500) DEFAULT NULL,
  `KETERANGAN_TUGAS` text DEFAULT NULL,
  `TANGGAL_PENGUMPULAN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`ID_TUGAS`, `ID_PENGAJAR`, `NAMA_TUGAS`, `KETERANGAN_TUGAS`, `TANGGAL_PENGUMPULAN`) VALUES
(38, 4, 'Cari contoh perangkat lunak dan keras', 'oke', '2024-06-25 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_penulis` (`id_penulis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detail_kegiatan`
--
ALTER TABLE `detail_kegiatan`
  ADD PRIMARY KEY (`ID_DETAIL`);

--
-- Indexes for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  ADD PRIMARY KEY (`ID_DETAIL_TUGAS`),
  ADD KEY `fk_detail_tugas_siswa` (`ID_SISWA`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`ID_GURU`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`ID_KEGIATAN`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`ID_MATERI`),
  ADD KEY `FK_RELATIONSHIP_4` (`ID_GURU`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`ID_PELAJARAN`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`ID_PENGAJAR`),
  ADD KEY `FK_RELATIONSHIP_14` (`ID_PELAJARAN`),
  ADD KEY `FK_RELATIONSHIP_7` (`ID_GURU`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`ID_SISWA`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`ID_TUGAS`),
  ADD KEY `FK_REFERENCE_10` (`ID_PENGAJAR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_kegiatan`
--
ALTER TABLE `detail_kegiatan`
  MODIFY `ID_DETAIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  MODIFY `ID_DETAIL_TUGAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `ID_KEGIATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `ID_PELAJARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID_PEMBAYARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `ID_PENGAJAR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `ID_SISWA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `ID_TUGAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_GURU`) REFERENCES `guru` (`ID_GURU`);

--
-- Constraints for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`ID_GURU`) REFERENCES `guru` (`ID_GURU`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`ID_PENGAJAR`) REFERENCES `pengajar` (`ID_PENGAJAR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
