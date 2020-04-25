-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2020 at 09:24 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbklinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `alamat`, `no_telp`, `username`, `password`) VALUES
(1, 'SUPER', 'superadmin@example.com', NULL, '081233449281', 'superadmin', '96bb453989e9e1d1db59c4a9a2bca193'),
(2, 'Kayson Mccray', 'admin.Mccray@example.com', 'Jl. Sesama No. 89', '896555162', 'kmccray', '7ce3c3e32cccea7e870e8d0e2066a712'),
(3, 'Rory Dodson', 'admin.dodson@example.com', 'Jl. Sendirian Aja No. 7', '853555488', 'rdodson', 'b536d41152fb643f143c46351f32298a'),
(4, 'Moshe Haas', 'admin.haas@example.com', 'Jl. Sepi No. 20', '896555368', 'moshehs', '4d2a47f9baf7af410c7c42576601b591'),
(5, 'Kathleen Cassidy', 'admin.cassidy@example.com', 'Jl. Ramai No. 6', '857555320', 'kathleencass', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `antrean`
--

CREATE TABLE `antrean` (
  `no_antrean` int(20) NOT NULL,
  `id_pasien` int(20) NOT NULL,
  `id_dokter` int(20) NOT NULL,
  `tgl_periksa` date NOT NULL,
	`waktu_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrean`
--

INSERT INTO `antrean` (`no_antrean`, `id_pasien`, `id_dokter`, `tgl_periksa`, `waktu_daftar`) VALUES
(1, 2000001, 1000002, '2020-04-02', '2020-04-23 14:23:51'),
(2, 2000002, 1000001, '2020-03-12', '2020-04-23 14:23:31'),
(3, 2000004, 1000000, '2020-04-03', '2020-04-23 14:23:46'),
(4, 2000003, 1000003, '2020-03-28', '2020-04-23 14:23:46'),
(5, 2000001, 1000000, '2020-06-09', '2020-04-23 14:23:46');

-- --------------------------------------------------------

CREATE TABLE `spesialisasi` (
  `id_spesialisasi` int(20) NOT NULL,
  `nama_spesialisasi` varchar(50) NOT NULL
);

INSERT INTO `spesialisasi`(`id_spesialisasi`, `nama_spesialisasi`) VALUES
(1, 'Penyakit Dalam'),
(2, 'Orthodonti'),
(3, 'Periodonsia');

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(20) NOT NULL,
  `id_spesialisasi` int(20) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `jadwal` text,
  `alamat` text,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_spesialisasi`, `nama_dokter`, `jadwal`, `alamat`, `no_telp`) VALUES
(1000000, 1, 'Alda Putri Utami', 'Senin-Jumat 08:00-12:00', 'Jl. Nan Indah No.12', '081299229939'),
(1000001, 1, 'Raymond Agung Nugroho', 'Senin-Jumat 13:00-17:00', 'Jl. Nanana No. 70', '081344773851'),
(1000002, 2, 'Dhanira Dessy Amalia', 'Senin-Jumat 08:00-12:00', 'Jl. Tol Banyak Hambatan No. 14', '0856227382910'),
(1000003, 3, 'Yulinda Lubis', 'Senin-Jumat 13:00-17:00', 'Jl. Ku Bukan Jalanmu No. 11', '0855388219481');

-- --------------------------------------------------------

--
-- Table structure for table `farmasi`
--

CREATE TABLE `farmasi` (
  `id_apoteker` int(20) NOT NULL,
  `nama_apoteker` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmasi`
--

INSERT INTO `farmasi` (`id_apoteker`, `nama_apoteker`, `alamat`, `no_telp`) VALUES
(3000000, 'Eleni Sheehan', 'Jl. In Aja Dulu No. 90', '897555508'),
(3000001, 'Dominykas Coates', 'Jl. Bimbambim No. 5', '813555318'),
(3000002, 'Elvis Norton', 'Jl. Lurus No. 2', '858555571'),
(3000003, 'Kady Werner', 'Jl. Ke Kanan No. 1', '878555470');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id_examiner` int(20) NOT NULL,
  `nama_examiner` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id_examiner`, `nama_examiner`, `alamat`, `no_telp`) VALUES
(4000000, 'Clare Leach', 'Jl. Ke Belakang No. 19', '814555631'),
(4000001, 'Koby Goodwin', 'Jl. Tol Bebas Hambatan No. 2', '854555869'),
(4000002, 'Wilfred Rosario', 'Jl. Nya Dipercepat No. 1', '818555456'),
(4000003, 'Bertie Peck', 'Jl. Kaki Saja No. 5', '878555282');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pemeriksaan`
--

CREATE TABLE `laporan_pemeriksaan` (
  `id_laporan` int(20) NOT NULL,
  `no_antrean` int(20) NOT NULL,
  `diagnosa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_pemeriksaan`
--

INSERT INTO `laporan_pemeriksaan` (`id_laporan`, `no_antrean`, `diagnosa`) VALUES
(1, 1, 'Campak Jerman'),
(2, 2, 'Disentri');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(20) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `produsen` varchar(50) NOT NULL,
  `manufacture_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `produsen`, `manufacture_date`, `expired_date`, `jumlah`, `harga`) VALUES
(101, 'Promag', 'Kalbe Farma', '2019-10-09', '2022-10-09', 152, 8000),
(102, 'Amoxicillin', 'Dexa Medica', '2019-03-07', '2022-03-07', 138, 516),
(103, 'Oralit', 'Phapros', '2019-12-14', '2022-12-14', 190, 1000),
(104, 'Ibuprofen', 'Kimia Farma', '2019-11-11', '2022-11-11', 150, 20000),
(105, 'Paracetamol', 'GSK', '2019-08-30', '2022-08-03', 117, 2400),
(106, 'Betadine: Gargle', 'Mahakam Beta Farma', '2019-08-07', '2022-08-07', 180, 20000),
(107, 'Chlorampenicol', 'Kalbe Farma', '2019-07-07', '0000-00-00', 113, 6200),
(108, 'Panadol Menstrual', 'GSK', '2020-02-05', '2023-02-05', 90, 97000),
(109, 'Tempra', 'Taisho Pharmaceutical Indonesia', '2020-01-18', '2023-01-18', 138, 54000),
(110, 'Holisticare Ester C', 'Holisticare', '2020-01-09', '2023-01-09', 78, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `tanggal_lahir`, `username`, `alamat`, `no_telp`, `email`, `password`) VALUES
(2000000, 'Stephanie Lee', '1997-12-14', 'steph_lee', 'Jl. Terusan Siguragura No. 1', '878555878', 'stephlee@example.com', '120b506e73fa9b09021f83919c1dc6ec'),
(2000001, 'Ryan Weiss', '1997-01-27', 'weissryan', 'Jl. Suhadi No. 1', '838555519', 'ryan.weiss@example.com', '2a2535ce33b3c7913a8650d47202925a'),
(2000002, 'Abel Laing', '1998-10-16', 'abelchyank', 'Jl. Rajawali No. 5', '8975555393', 'laing_abel@example.com', 'e3f5ac09a0053a569029c6b0eddbe3e5'),
(2000003, 'Ricardo Milos', '1977-11-11', 'abang.ricardo', 'Jl. Keterusan No. 6', '812555358', 'ricardoganteng@example.com', '26e15f51ca014db995acd8b1b4111603'),
(2000004, 'Alexis Britt', '1964-09-10', 'alxsbritt', 'Jl. Bombimbum No. 13', '853555712', 'alxbrtt@example.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id_resep` int(20) NOT NULL,
  `id_laporan` int(20) NOT NULL,
  `id_obat` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id_resep`, `id_laporan`, `id_obat`) VALUES
(1, 1, 105),
(2, 2, 102),
(3, 1, 104);

/*CREATE TABLE IF NOT EXISTS `tokens` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `created` date NOT NULL
);*/

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `antrean`
--
ALTER TABLE `antrean`
  ADD PRIMARY KEY (`no_antrean`),
  ADD KEY `id_dokter_daftar` (`id_dokter`),
  ADD KEY `id_pasien_daftar` (`id_pasien`);

--
-- Indexes for table `spesialisasi`
--
ALTER TABLE `spesialisasi`
  ADD PRIMARY KEY (`id_spesialisasi`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `farmasi`
--
ALTER TABLE `farmasi`
  ADD PRIMARY KEY (`id_apoteker`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id_examiner`);

--
-- Indexes for table `laporan_pemeriksaan`
--
ALTER TABLE `laporan_pemeriksaan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_pasien_lap` (`id_pasien`),
  ADD KEY `id_dokter_lap` (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_laporan_resep` (`id_laporan`),
  ADD KEY `id_obat_resep` (`id_obat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `antrean`
--
ALTER TABLE `antrean`
  MODIFY `no_antrean` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `spesialisasi`
  MODIFY `id_spesialisasi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000004;

--
-- AUTO_INCREMENT for table `farmasi`
--
ALTER TABLE `farmasi`
  MODIFY `id_apoteker` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3000004;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id_examiner` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4000004;

--
-- AUTO_INCREMENT for table `laporan_pemeriksaan`
--
ALTER TABLE `laporan_pemeriksaan`
  MODIFY `id_laporan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000005;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id_resep` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrean`
--
ALTER TABLE `antrean`
  ADD CONSTRAINT `id_dokter_daftar` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pasien_daftar` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_pemeriksaan`
--
ALTER TABLE `laporan_pemeriksaan`
  ADD CONSTRAINT `id_dokter_lap` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pasien_lap` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `id_laporan_resep` FOREIGN KEY (`id_laporan`) REFERENCES `laporan_pemeriksaan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_obat_resep` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
