-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 07:47 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webprog`
--

-- --------------------------------------------------------

--
-- Table structure for table `adds`
--

CREATE TABLE `adds` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `archive` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adds`
--

INSERT INTO `adds` (`id`, `title`, `description`, `picture`, `archive`, `date`) VALUES
(1, 'Huawei P7, napuknut ekran', 'Tražim nekoga za popravak napuknutog ekrana na  Huawei P7. Ponude može na tel. 099-347-4325', '1-52.jpg', 'N', '2018-01-09 00:00:00'),
(2, 'Parking kamera, ugradnja', 'Tražim nekoga za ugradnju stražnje parking kamere u Reno Clio 2006. god. Ponude na tel. 091-345-3456, može i whatsapp', '2-48.jpg', 'N', '2020-05-28 02:05:49'),
(3, 'Lenovo T560, zamjena paste na CPU', 'Tražim nekoga tko se razumije i ima iskustva u održavanje računala, za zamjenu paste na CPU i čiščenje od prašine. Kontak: 092-432-4322', '3-79.jpg', 'N', '2020-05-28 02:06:32'),
(5, 'PS4, ne pali', 'Nemože se upaliti, ako netko zna obaviti dijagnostiku. Može ponude na tel: 091-678-6786', '5-90.jpg', 'N', '2020-05-09 05:06:40'),
(6, 'Galaxy S8, mikrofon', 'Pomoć popravak mikrofona, tel: 099-234-2344', '6-78.jpg', 'N', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adds`
--
ALTER TABLE `adds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adds`
--
ALTER TABLE `adds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
