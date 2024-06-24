-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2023 at 08:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music-final`
--

-- --------------------------------------------------------

--
-- Table structure for table `Albums`
--

CREATE TABLE `Albums` (
  `AlbumID` int(11) NOT NULL,
  `AlbumTitle` varchar(255) NOT NULL,
  `ReleaseYear` int(11) DEFAULT NULL,
  `ArtistID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Albums`
--

INSERT INTO `Albums` (`AlbumID`, `AlbumTitle`, `ReleaseYear`, `ArtistID`) VALUES
(1, 'Cherry Bomb', 2015, 1),
(2, 'Flower Boy', 2017, 1),
(3, 'Remember that You Will Die', 2022, 2),
(4, 'New Levels New Devils', 2018, 2),
(5, 'Midnight', 2022, 3),
(6, 'Reputation', 2017, 3),
(7, 'Stick Season', 2022, 4),
(8, 'Busyhead', 2019, 4),
(9, 'Coming Home', 2015, 5),
(10, 'Good Thing', 2018, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Artists`
--

CREATE TABLE `Artists` (
  `ArtistID` int(11) NOT NULL,
  `ArtistName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Artists`
--

INSERT INTO `Artists` (`ArtistID`, `ArtistName`) VALUES
(1, 'Tyler, the Creator'),
(2, 'Polyphia'),
(3, 'Taylor Swift'),
(4, 'Noah Kahan'),
(5, 'Leon Bridges');

-- --------------------------------------------------------

--
-- Table structure for table `Genres`
--

CREATE TABLE `Genres` (
  `GenreID` int(11) NOT NULL,
  `GenreName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Genres`
--

INSERT INTO `Genres` (`GenreID`, `GenreName`) VALUES
(1, 'Rap'),
(2, 'Progressive Rock'),
(3, 'Pop'),
(4, 'Folk-Pop'),
(5, 'Soul');

-- --------------------------------------------------------

--
-- Table structure for table `SongGenres`
--

CREATE TABLE `SongGenres` (
  `SongID` int(11) NOT NULL,
  `GenreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SongGenres`
--

INSERT INTO `SongGenres` (`SongID`, `GenreID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE `Songs` (
  `SongID` int(11) NOT NULL,
  `SongTitle` varchar(255) NOT NULL,
  `Duration` int(11) DEFAULT NULL,
  `AlbumID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Songs`
--

INSERT INTO `Songs` (`SongID`, `SongTitle`, `Duration`, `AlbumID`) VALUES
(1, 'Foreword', 194, 2),
(2, 'Pothole', 237, 2),
(3, 'Glitter', 224, 2),
(4, 'BUFFALO', 159, 1),
(5, '2SEATER', 409, 1),
(6, 'SMUCKERS', 334, 1),
(7, 'Playing God', 205, 3),
(8, 'Ego Death', 350, 3),
(9, 'ABC', 152, 3),
(10, 'G.O.A.T.', 215, 4),
(11, 'O.D.', 202, 4),
(12, 'Saucy', 184, 4),
(13, 'Lavender Haze', 202, 5),
(14, 'Maroon', 218, 5),
(15, 'Midnight Rain', 176, 5),
(16, 'Gorgeous', 209, 6),
(17, 'King of My Heart', 214, 6),
(18, 'Dress', 230, 6),
(19, 'She Calls Me Back', 243, 7),
(20, 'New Perspective', 256, 7),
(21, 'Orange Juice', 297, 7),
(22, 'Mess', 213, 8),
(23, 'Hurt Somebody', 167, 8),
(24, 'Tidal', 214, 8),
(25, 'Better Man', 140, 9),
(26, 'Brown Skin Girl', 206, 9),
(27, 'River', 240, 9),
(28, 'Bad Bad News', 207, 10),
(29, 'Shy', 194, 10),
(30, 'Beyond', 240, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Albums`
--
ALTER TABLE `Albums`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `Artists`
--
ALTER TABLE `Artists`
  ADD PRIMARY KEY (`ArtistID`);

--
-- Indexes for table `Genres`
--
ALTER TABLE `Genres`
  ADD PRIMARY KEY (`GenreID`);

--
-- Indexes for table `SongGenres`
--
ALTER TABLE `SongGenres`
  ADD PRIMARY KEY (`SongID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indexes for table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`SongID`),
  ADD KEY `AlbumID` (`AlbumID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Albums`
--
ALTER TABLE `Albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `Artists` (`ArtistID`);

--
-- Constraints for table `SongGenres`
--
ALTER TABLE `SongGenres`
  ADD CONSTRAINT `songgenres_ibfk_1` FOREIGN KEY (`SongID`) REFERENCES `Songs` (`SongID`),
  ADD CONSTRAINT `songgenres_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `Genres` (`GenreID`);

--
-- Constraints for table `Songs`
--
ALTER TABLE `Songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `Albums` (`AlbumID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
