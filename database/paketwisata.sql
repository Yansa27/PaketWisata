-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 09:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paketwisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_wisata`
--

INSERT INTO `paket_wisata` (`id`, `nama_paket`, `deskripsi`, `harga`, `durasi`, `foto`, `created_at`) VALUES
(1, 'Paket Healing', 'Jelajahi keindahan Raja Ampat dengan paket wisata yang luar biasa ini. Nikmati pemandangan pantai, hutan tropis, dan aktivitas air yang menakjubkan.', 20000.00, 5, '1724808336_27a35da8fa82982a4f4e.jpg', '2024-08-27 10:58:07'),
(2, 'Paket Seru', 'Temukan keajaiban bawah laut Raja Ampat dengan paket wisata ini. Ideal untuk penyelam dan pecinta laut yang ingin menjelajahi terumbu karang yang menakjubkan.', 5500000.00, 7, '1724808448_33d714ce01d531b15b00.jpg', '2024-08-27 18:27:28'),
(3, 'Paket Puas', 'Rasakan pengalaman luar biasa dengan paket wisata kami yang menawarkan kombinasi petualangan dan relaksasi di surga tropis Raja Ampat.', 5600000.00, 7, '1724808505_92a41f5994fc94e6b3aa.jpg', '2024-08-27 18:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `reservasi_id` int(11) DEFAULT NULL,
  `jumlah_bayar` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','paid','failed') DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `paket_wisata_id` int(11) DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `harga_paket` decimal(10,2) DEFAULT NULL,
  `jumlah_tagihan` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelayanan_penginapan` int(11) DEFAULT 0,
  `pelayanan_transportasi` int(11) DEFAULT 0,
  `pelayanan_servis` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id`, `user_id`, `nama_pemesan`, `nomor_hp`, `tanggal`, `paket_wisata_id`, `jumlah_orang`, `harga_paket`, `jumlah_tagihan`, `status`, `created_at`, `pelayanan_penginapan`, `pelayanan_transportasi`, `pelayanan_servis`) VALUES
(28, 2, 'acaslkl', '085156390652', '2024-08-28', 1, 12, 20000.00, 3840000.00, 'pending', '2024-08-28 13:13:28', 100000, 200000, 0),
(29, 2, 'acas', '085156390652', '2024-08-28', 1, 12, 20000.00, 9840000.00, 'pending', '2024-08-28 13:15:45', 100000, 200000, 500000),
(31, 2, 'Yansa', '085156390652', '2024-08-28', 2, 1, 5500000.00, 6200000.00, 'pending', '2024-08-28 15:27:23', 0, 200000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@example.com', 'admin321', 'admin', '2024-08-27 16:42:34'),
(2, NULL, 'tesnative@example.com', '$2y$10$JD13Lz8YUnFnnuatCB4Aeu6EKaKJL8q8UTuARVZ16i00X2WJ5WFbe', NULL, '2024-08-28 03:12:50'),
(3, NULL, 'penguruss@example.com', '$2y$10$uICBF4yD22ZqppEPREzOzOYllXE.ej9czGFVwz.KP5vy4LlEzsKAq', NULL, '2024-08-28 18:03:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservasi_id` (`reservasi_id`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `paket_wisata_id` (`paket_wisata_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasi` (`id`);

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservasi_ibfk_2` FOREIGN KEY (`paket_wisata_id`) REFERENCES `paket_wisata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
