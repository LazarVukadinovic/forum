-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2022 at 07:44 PM
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
-- Database: `forumlv`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id_kom` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `ime_kreatora` varchar(100) NOT NULL,
  `opis` text NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id_kom`, `id_tema`, `ime_kreatora`, `opis`, `datum`) VALUES
(2, 15, 'admin@gmail.com', 'asdasdasdasdasd', '2022-11-11 14:33:00'),
(4, 15, 'admin@gmail.com', 'jkhmbfgvdcs', '2022-11-11 14:34:00'),
(11, 14, 'admin@gmail.com', 'dfhdgdfgdfgdfg', '2022-11-16 07:36:00'),
(12, 19, 'pedja@gmail.com', 'Nemoj neko da je obrisao', '2022-11-16 08:05:00'),
(13, 19, 'admin@gmail.com', 'nema bolje', '2022-11-16 08:06:00'),
(14, 20, 'nov@gmail.com', 'Zdravo', '2022-11-19 19:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnicko_ime` varchar(100) NOT NULL,
  `lozinka` varchar(100) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `slika` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnicko_ime`, `lozinka`, `ime`, `prezime`, `slika`) VALUES
('admin@gmail.com', '$2y$10$7o59fdxN9CP9ht3yQj27yuErkEUO66n.b3d/f4W10AWErl9/1lSvm', 'Admin', 'adminovic', 'admin@gmail.com.jpg'),
('nov@gmail.com', '$2y$10$0w4EGbZlPIaH0kEYPm6ZlO1qTOByz7TpWGsee6xFV4AgNfJlOD5Ta', 'Nov User', 'Newbie', 'avatar.png'),
('pedja@gmail.com', '$2y$10$GSQnboa7924dOMn.RLXkQe7y7ujq0UH7jM6IY2LX0pTIkvpMj.lKO', 'Siu', 'Siuuuuuuuuuuuuu', 'avatar.png'),
('test@gmail.com', '$2y$10$4I3YqviAjhXia5qey8dhPu7LMOze94P8.jk8HeTEVBVzs8ai1hfR.', 'Test', 'Testovic', 'avatar.png'),
('verka@gmail.com', '$2y$10$qs4ZYDRz3gQquLWqQfdq0uZz95fDq8XCtZv2WIOmVQD2MHNAvRlJS', 'Verka', 'Zverka', 'avatar2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id` int(11) NOT NULL,
  `naziv_teme` varchar(50) NOT NULL,
  `opis_teme` text NOT NULL,
  `datum_kreiranja` datetime NOT NULL,
  `kreator` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id`, `naziv_teme`, `opis_teme`, `datum_kreiranja`, `kreator`) VALUES
(14, 'nova tema', 'Proba', '2022-11-11 00:00:00', 'admin@gmail.com'),
(15, 'Proba2', 'Proba', '2022-11-11 00:08:00', 'admin@gmail.com'),
(19, 'IDe gass', 'siuuuuuuuuuuuuuuuu', '2022-11-16 08:05:00', 'pedja@gmail.com'),
(20, 'OET', 'Osnove elektrotehnike', '2022-11-16 09:09:00', 'verka@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id_kom`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnicko_ime`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id_kom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
