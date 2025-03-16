-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2025 at 07:00 AM
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
-- Database: `mangadeckDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `biography` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `biography`, `birth_date`, `country`, `created_at`, `updated_at`) VALUES
(1, 'Eiichiro Oda', 'Creator of One Piece, one of the best-selling manga series of all time.', '1975-01-01', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 'Masashi Kishimoto', 'Creator of Naruto, a globally popular ninja-themed manga series.', '1974-11-08', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 'Tite Kubo', 'Creator of Bleach, a supernatural action manga about Soul Reapers.', '1977-06-26', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 'Akira Toriyama', 'Creator of Dragon Ball, one of the most influential manga series worldwide.', '1955-04-05', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 'Hajime Isayama', 'Creator of Attack on Titan, a dark fantasy manga about humanity\'s struggle against titans.', '1986-08-29', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 'Kohei Horikoshi', 'Creator of My Hero Academia, a superhero manga set in a world where most people have superpowers.', '1986-11-20', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(7, 'Koyoharu Gotouge', 'Creator of Demon Slayer, a dark fantasy manga about a young boy who becomes a demon slayer.', '1989-05-05', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(8, 'Gege Akutami', 'Creator of Jujutsu Kaisen, a supernatural horror manga about a high school student who joins a secret organization of sorcerers.', '1992-02-28', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(9, 'Sui Ishida', 'Creator of Tokyo Ghoul, a dark fantasy manga about a college student who becomes half-ghoul after a transplant.', '1986-12-28', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(10, 'Tsugumi Ohba', 'Writer of Death Note, a psychological thriller manga about a high school student who discovers a supernatural notebook.', '1969-02-17', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(11, 'Takeshi Obata', 'Illustrator of Death Note and Bakuman, known for his detailed art style.', '1969-02-11', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(12, 'Hiromu Arakawa', 'Creator of Fullmetal Alchemist, a fantasy adventure manga about two brothers seeking the philosopher\'s stone.', '1973-05-08', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(13, 'Yoshihiro Togashi', 'Creator of Hunter x Hunter and Yu Yu Hakusho, known for complex storytelling.', '1966-04-27', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(14, 'Naoko Takeuchi', 'Creator of Sailor Moon, a magical girl manga that became a global phenomenon.', '1967-03-15', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(15, 'Natsuki Takaya', 'Creator of Fruits Basket, a romantic comedy manga with supernatural elements.', '1973-07-07', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(16, 'Ai Yazawa', 'Creator of Nana, a josei manga about two women with the same name pursuing their dreams.', '1967-03-07', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(17, 'Bisco Hatori', 'Creator of Ouran High School Host Club, a romantic comedy manga set in a high school host club.', '1975-08-30', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(18, 'Kentaro Miura', 'Creator of Berserk, a dark fantasy manga known for its intricate artwork and mature themes.', '1966-07-11', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(19, 'Takehiko Inoue', 'Creator of Slam Dunk and Vagabond, known for his realistic art style.', '1967-01-12', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(20, 'Makoto Yukimura', 'Creator of Vinland Saga, a historical manga set in the Viking Age.', '1976-05-08', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(21, 'Naoki Urasawa', 'Creator of Monster and 20th Century Boys, known for his psychological thrillers.', '1960-01-02', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(22, 'Tatsuya Endo', 'Creator of Spy x Family, a comedy-action manga about a spy who builds a fake family.', '1980-07-23', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(23, 'Tatsuki Fujimoto', 'Creator of Chainsaw Man, a dark fantasy manga about a young man who can transform into a chainsaw devil.', '1992-10-10', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(24, 'Haruichi Furudate', 'Creator of Haikyu!!, a sports manga about a high school volleyball team.', '1983-03-07', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(25, 'Naoshi Arakawa', 'Creator of Your Lie in April, a drama manga about a pianist who loses his ability to hear the piano.', '1984-12-05', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(26, 'Yoshitoki Oima', 'Creator of A Silent Voice, a drama manga about a boy who bullies a deaf girl.', '1989-03-15', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(27, 'Kaiu Shirai', 'Writer of The Promised Neverland, a thriller manga about orphans who discover the dark truth about their orphanage.', '1988-01-01', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(28, 'Posuka Demizu', 'Illustrator of The Promised Neverland, known for her detailed and atmospheric art.', '1988-12-28', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(29, 'Akihito Tsukushi', 'Creator of Made in Abyss, a fantasy adventure manga about a girl who descends into a mysterious abyss.', '1978-03-04', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(30, 'Tappei Nagatsuki', 'Writer of Re:Zero, an isekai light novel and manga series about a young man transported to another world.', '1987-03-11', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(31, 'Reki Kawahara', 'Creator of Sword Art Online, a science fiction light novel and manga series about virtual reality MMORPGs.', '1974-08-17', 'Japan', '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `author_item`
--

CREATE TABLE `author_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL COMMENT 'Writer, Illustrator, etc.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bad_words`
--

CREATE TABLE `bad_words` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `word` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` enum('Mr','Mrs','Ms','Dr','Prof') DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `addressline` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `title`, `lname`, `fname`, `addressline`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dr', 'Doe', 'John', '68391 McKenzie Drive Suite 877, New Jackieside, TN 21856-8442', '315.497.5884', 4, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 'Mr', 'Smith', 'Jane', '44566 Klein Creek, West Allen, NE 55711-6200', '463.392.7607', 5, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 'Mr', 'Johnson', 'Bob', '988 Celestino Square, West Evert, ID 66602', '909-739-6595', 6, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 'Dr', 'Brown', 'Alice', '32600 Stone Underpass, West Winifredberg, OH 81816', '458.994.0112', 7, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 'Prof', 'User', 'Inactive', '13202 Sarina Union, Cartermouth, CO 06515', '531-586-1962', 8, '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Shonen', 'Manga aimed at teenage boys, typically featuring action, adventure, and coming-of-age themes.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 'Shojo', 'Manga aimed at teenage girls, often focusing on romance, relationships, and personal growth.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 'Seinen', 'Manga aimed at adult men, featuring more mature themes, complex characters, and realistic scenarios.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 'Josei', 'Manga aimed at adult women, exploring mature relationships, career challenges, and daily life.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 'Isekai', 'Stories about characters transported to or reborn in another world, often with fantasy elements.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 'Mecha', 'Stories featuring robots, mechanical technology, and often exploring the relationship between humans and machines.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(7, 'Fantasy', 'Stories with magical or supernatural elements, often set in fictional worlds with unique rules and systems.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(8, 'Horror', 'Stories designed to frighten or scare readers, featuring supernatural threats, psychological terror, or gore.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(9, 'Romance', 'Stories focused on romantic relationships and emotional connections between characters.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(10, 'Sports', 'Stories centered around athletics and competition, often featuring character growth through sports.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(11, 'Slice of Life', 'Stories depicting everyday experiences and focusing on the mundane aspects of characters\' lives.', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(12, 'Mystery', 'Stories involving the solution of a mystery, often featuring detectives, crimes, or puzzles.', '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `genre_item`
--

CREATE TABLE `genre_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_item`
--

INSERT INTO `genre_item` (`id`, `genre_id`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 6, 1, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 6, 2, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 1, 3, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 1, 4, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 4, 4, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(7, 10, 4, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(8, 6, 5, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(9, 12, 5, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(10, 1, 6, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(11, 3, 6, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(12, 11, 6, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(13, 7, 7, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(14, 9, 7, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(15, 3, 8, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(16, 4, 8, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(17, 10, 8, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(18, 2, 9, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(19, 3, 9, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(20, 7, 9, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(21, 12, 10, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(22, 5, 11, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(23, 7, 11, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(24, 11, 11, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(25, 11, 12, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(26, 2, 13, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(27, 5, 14, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(28, 8, 14, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(29, 12, 14, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(30, 8, 15, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(31, 2, 16, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(32, 3, 16, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(33, 7, 16, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(34, 1, 17, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(35, 8, 17, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(36, 10, 17, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(37, 7, 18, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(38, 1, 19, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(39, 9, 19, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(40, 5, 20, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(41, 4, 21, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(42, 7, 21, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(43, 12, 21, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(44, 11, 22, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(45, 12, 22, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(46, 2, 23, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(47, 3, 24, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(48, 10, 25, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(49, 4, 26, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(50, 5, 26, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(51, 11, 26, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(52, 4, 27, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(53, 11, 27, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(54, 1, 28, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(55, 8, 29, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(56, 7, 30, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(57, 10, 30, '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `publication_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`, `publisher_id`, `price`, `publication_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'One Piece Volume 1: Romance Dawn', 'Et incidunt et similique. Atque illo similique assumenda illum harum deleniti minima amet. Nisi molestiae non esse cupiditate. Nobis quis deleniti velit quo consectetur beatae voluptatem ad.\n\nDolore cupiditate placeat maxime ut qui eum. Aut veritatis tempora dolor et non. Sed et debitis labore rerum ut voluptatibus consequatur. Quidem facilis corporis quos dolorem corporis dolores aut expedita.\n\nDoloremque laborum a dolores exercitationem exercitationem nobis. Alias saepe qui quo. Sit ad a quidem.', NULL, 22.95, '2017-07-03', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(2, 'Naruto Volume 1: Uzumaki Naruto', 'Qui non corrupti corrupti repellat cumque. Recusandae nostrum libero ex. Soluta quos voluptatem rerum odio nam hic.\n\nDeleniti dolor delectus quibusdam a similique numquam. Cum tempore dolores itaque. Perferendis doloribus commodi ut eaque accusamus quos velit.\n\nAliquid nisi porro dolorem magnam corporis sint id qui. Est rerum eum ratione autem eum odio ullam. Maxime qui magni ut voluptas.', NULL, 11.13, '2018-04-22', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(3, 'Bleach Volume 1: The Death and the Strawberry', 'Qui voluptatum quam autem autem eveniet nemo deserunt. Quae tenetur doloremque amet qui non molestias repellendus in. Consequatur rerum deleniti quia sed.\n\nNulla dolores voluptatibus voluptas excepturi ea dolorem dolor. Delectus id eum voluptas numquam distinctio maxime. Reprehenderit quo ipsum neque recusandae esse. Blanditiis necessitatibus doloribus illo doloribus.\n\nNon officia quis non eaque nulla dolorem inventore. Nostrum soluta id ducimus. Consequatur magni sint eius repudiandae. Quia est quae quasi eaque est.', NULL, 12.04, '2022-08-25', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(4, 'Dragon Ball Volume 1: The Monkey King', 'Alias ut accusantium quasi velit sint. Dolorum sunt voluptas sint quae. Recusandae saepe voluptates ipsam vel. Ut deserunt quae voluptas earum.\n\nPorro quis ex quia. Commodi odit aut consequatur voluptatem quibusdam hic. Mollitia numquam est inventore voluptates odio.\n\nRatione cum excepturi et optio perferendis fugit quia. Molestiae inventore necessitatibus et vel accusamus rerum non expedita. Et quia id vero aut. Id doloremque voluptatem eveniet accusantium beatae aliquam quod. Et perspiciatis dolorem sunt est autem repellendus quia.', NULL, 17.98, '2018-03-20', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(5, 'Attack on Titan Volume 1', 'Sit non est eos quae. Possimus quos vel aut omnis non. Sed doloribus quia modi voluptatum sed et consequatur. Quis aut voluptatibus amet nisi in dicta saepe.\n\nSint aspernatur rerum omnis fuga distinctio dolorem. Ex sunt dignissimos illo. Est dolore vitae hic. Et consequuntur possimus sint odio quas nihil dolorum ipsam.\n\nNihil ducimus ut similique dolores quasi ab corporis. Similique officiis quis animi quae. Quam ex quibusdam accusamus consequatur et et exercitationem.', NULL, 11.58, '2020-01-10', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(6, 'My Hero Academia Volume 1: Izuku Midoriya: Origin', 'Sint nesciunt tenetur et. Culpa explicabo iste nisi cumque officia aut similique placeat. Voluptates perspiciatis optio voluptatem qui dicta est ut. Perspiciatis veniam aliquam corrupti voluptas beatae sed unde odit.\n\nEt culpa neque rerum dolores necessitatibus placeat qui. Libero et rem incidunt nihil. Ipsum vel ex nesciunt et quia et sunt consequatur. Animi sed aut unde eius aut dolorem qui. Optio sint ducimus earum perspiciatis.\n\nSunt sit culpa qui ab et odit. Minima similique non ex rerum aut. Eum aut dolor enim laborum repellat. Et et excepturi excepturi aliquid repudiandae vero inventore minima.', NULL, 16.01, '2020-09-06', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(7, 'Demon Slayer Volume 1: Cruelty', 'Iste aut quidem nemo et sed quis accusamus. Ullam dolores non quas voluptatem fugit sunt. Reiciendis alias possimus dolor repellendus perspiciatis perspiciatis.\n\nTenetur est adipisci et. Quis et sit dolorum rerum velit. Eligendi ut ipsa dolorum.\n\nNon adipisci perspiciatis accusantium facilis. Ut eum dolorem quo error nemo. Laboriosam libero vero modi id voluptatem officiis.', NULL, 26.93, '2019-04-30', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(8, 'Jujutsu Kaisen Volume 1', 'Adipisci vel non eum quia cupiditate consequatur impedit. Nulla quia inventore culpa accusantium voluptatem odit sunt. Officiis in deserunt nostrum eos molestiae.\n\nSunt non dignissimos et et aut maxime ea. Ut minus est et neque.\n\nDolorem ut voluptas perferendis neque. Et est rerum et aut vel qui modi quam. Est consectetur molestiae aliquam quis.', NULL, 14.15, '2016-02-10', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(9, 'Tokyo Ghoul Volume 1', 'Maxime et et esse itaque aperiam pariatur repellendus. Voluptas dolore velit culpa sunt at ratione. Itaque fuga nostrum hic quia quam qui cupiditate.\n\nEst dolorem repellat quidem voluptas distinctio non voluptates molestiae. Hic fugiat qui quia rerum. Nobis magnam debitis sapiente voluptatem sit voluptatem. Et amet quidem amet impedit placeat et eius. Ducimus non perspiciatis nulla.\n\nQuos et sit reiciendis mollitia illum ut corrupti. Quasi dicta voluptas eum ut non iure. Quasi quasi aut et.', NULL, 11.57, '2024-08-24', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(10, 'Death Note Volume 1: Boredom', 'Voluptas dolorem omnis amet numquam ducimus. Et molestiae magni aut voluptatem. Deleniti dolorum magnam amet fuga. Facere dolor earum est. Dignissimos quibusdam voluptate harum corrupti.\n\nNeque aut odio similique suscipit ut. Occaecati omnis voluptatem quidem voluptatem est. Accusamus enim ducimus facilis voluptas incidunt sapiente deserunt.\n\nAt quidem voluptatem qui fuga doloremque quam dicta. Ea molestiae odio dolor voluptatibus magnam aut pariatur. Earum ut ut occaecati quia nihil modi. Delectus laborum qui quam quo.', NULL, 28.29, '2020-11-08', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(11, 'Fullmetal Alchemist Volume 1', 'Pariatur ducimus esse quo vitae officia. Beatae ab atque corrupti cumque praesentium. Vel sed similique vero possimus.\n\nDignissimos vitae vitae aut quaerat est. Et omnis dolorem error nesciunt hic quod mollitia. Dolor quo eius quidem et nam. Molestias non explicabo velit et quos quod.\n\nVoluptas voluptatem quibusdam cupiditate quis eius optio. Qui voluptatem molestiae sapiente non blanditiis qui similique autem. Vel et saepe minima reiciendis nesciunt.', NULL, 15.07, '2023-03-07', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(12, 'Hunter x Hunter Volume 1', 'Repudiandae itaque molestiae quae reiciendis sint laudantium tenetur fuga. Minus explicabo deserunt et molestias excepturi voluptate. Quia ducimus et consequuntur pariatur autem.\n\nDeserunt qui vel et dignissimos facilis qui in. Enim eos officia sed error reprehenderit velit quisquam. Molestias cupiditate consequatur earum voluptas ipsam et et sunt.\n\nAut iure illum voluptates asperiores et nostrum. Facere officiis voluptatibus aperiam quis. Aliquam in maiores maiores harum dignissimos.', NULL, 23.70, '2019-10-02', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(13, 'Sailor Moon Volume 1', 'Nobis ducimus dolor molestiae odit et. Ullam eum blanditiis voluptas quia quia. Et aut aut beatae nostrum. Sint atque porro delectus.\n\nNam voluptas ea sequi praesentium voluptatem. Ab ad asperiores qui eligendi quos asperiores corporis. Ea incidunt autem quia. Fuga consequuntur accusamus sunt ducimus facere.\n\nDolor suscipit culpa ipsa voluptatem et. Quaerat vitae illo ratione est ipsum animi rerum. Ut in error unde similique eveniet dolorem. Culpa laborum illum sed quidem autem quod nihil.', NULL, 19.03, '2018-08-17', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(14, 'Fruits Basket Volume 1', 'Ut natus in laborum. Non aut vel occaecati mollitia nulla voluptatibus consectetur. A aut aut quis sapiente ipsam et hic. Amet eaque necessitatibus quo sunt.\n\nEx et esse amet id. Facere repudiandae expedita voluptatem ut. Veniam iusto labore sint autem aut.\n\nEnim id deserunt alias non tempora non. Accusamus fuga unde velit corrupti ex iusto labore quam. Quis et ducimus enim fuga. Et cum vel a aut quo a maiores.', NULL, 28.35, '2018-06-19', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(15, 'Nana Volume 1', 'Aut et sit et pariatur ullam beatae. In veniam hic consequatur facere veritatis commodi saepe non. Nostrum ut quia saepe sit et optio.\n\nIure incidunt ut facere accusantium pariatur quia possimus dolorem. Quas harum dolorem suscipit qui. Rerum modi accusamus illo ipsa blanditiis omnis quae.\n\nQui minima modi neque voluptas cumque sunt possimus. Distinctio soluta velit cupiditate. Laboriosam nihil nesciunt perspiciatis impedit hic. Quia nihil aut est necessitatibus.', NULL, 16.53, '2021-11-04', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(16, 'Ouran High School Host Club Volume 1', 'Laborum repudiandae provident similique qui ullam facilis aut. Dolores at natus sed dolores perspiciatis odio praesentium inventore. Vitae necessitatibus nemo nam placeat corrupti minus qui. Est ex dolorem nulla praesentium libero nihil sit.\n\nEum magnam nemo nostrum. Ut tenetur corrupti perferendis est ut. Quaerat eius est est et dolorem ipsam. Facere non et ut sit omnis.\n\nVoluptatibus possimus libero facilis inventore reiciendis. Sit saepe tempore repellat architecto quo accusantium aut. Ipsum est natus voluptatum quia. Fugiat maiores ut expedita id fugit.', NULL, 25.01, '2017-04-08', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(17, 'Berserk Volume 1: The Black Swordsman', 'Dolore mollitia iste aut consequuntur non omnis illo. Non at veritatis ipsum quis dignissimos est. Explicabo iusto voluptatem earum excepturi.\n\nVoluptates libero architecto id consequatur in ad. Blanditiis nulla consequuntur inventore et. Sequi facilis suscipit perferendis sapiente ab quisquam odio.\n\nEt vel quo occaecati asperiores ut inventore suscipit. Accusamus iusto necessitatibus nam sunt molestias nesciunt. Quia voluptates ut nemo. Quidem in est aut inventore adipisci aliquam quis. Soluta eum totam explicabo atque iusto et non distinctio.', NULL, 29.01, '2016-10-29', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(18, 'Vagabond Volume 1', 'Ut dolor qui eos animi est animi libero fugiat. Enim ipsum tempore nihil fugiat. Quae sed aut nostrum eius qui et dolor. Et perferendis repellat accusantium nam dolores reiciendis.\n\nQuam ipsum est numquam. Animi sed nostrum distinctio quos enim. Modi et mollitia molestiae. Est quia dolorem iure corrupti voluptatibus similique qui. Id nemo aliquam excepturi.\n\nAccusantium et pariatur dolorum blanditiis iure tenetur. In dolorem quia dolorem enim vero veniam. Ipsam doloribus recusandae corporis nihil natus velit sapiente. Voluptatem sed ea nihil optio nemo.', NULL, 16.57, '2017-10-15', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(19, 'Vinland Saga Volume 1', 'Aut libero ipsa fuga est. Illo vel temporibus ut et sint debitis. Ad et maxime quas hic. A fuga facere reprehenderit. Voluptate aut animi architecto magnam incidunt qui.\n\nNemo expedita ipsum harum reprehenderit qui sed eos cum. Officia repudiandae in quo rerum sit.\n\nNesciunt labore quo enim et veniam ipsa est. Molestiae beatae voluptas et qui. Ut pariatur sint pariatur harum voluptatem consectetur quaerat dolorem.', NULL, 26.35, '2018-03-17', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(20, 'Monster Volume 1', 'Illum exercitationem voluptas aut ut harum blanditiis non. Debitis doloribus quae sapiente quod quia quia suscipit aliquid. Dolores excepturi rerum cupiditate officiis eveniet inventore iste magnam.\n\nVoluptas aliquid consequuntur omnis voluptatem possimus perferendis eveniet eaque. Est quis est iure possimus numquam voluptatibus voluptate. Officia nobis aut aspernatur culpa laboriosam illo. Consequuntur quibusdam deserunt minus animi.\n\nConsequatur totam ab perspiciatis atque mollitia enim. Quod expedita deserunt quae natus. Voluptatum earum culpa temporibus. Magni necessitatibus aperiam beatae id dolores atque.', NULL, 12.03, '2017-08-02', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(21, 'Spy x Family Volume 1', 'Voluptatem ea alias explicabo. Sit dolores eveniet consectetur maxime. Accusamus facilis fugiat totam amet dolores non officia. Itaque temporibus fuga ducimus quis recusandae qui fugiat quia.\n\nNihil inventore enim laudantium. Quam esse a optio voluptate distinctio aliquam nisi et. Vel eius ut voluptatem animi enim. Et repellat quidem maiores.\n\nVoluptas ratione recusandae nihil non laboriosam. Tenetur sit porro beatae quisquam ex sapiente corporis. Distinctio beatae et eos possimus nam. Iure consequatur neque sunt modi quia doloribus.', NULL, 22.01, '2024-08-31', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(22, 'Chainsaw Man Volume 1', 'Accusamus molestiae non amet repellat et fugiat reprehenderit. Perspiciatis ea placeat quos. Sed nisi eaque fuga voluptatem.\n\nEt molestias sit officia. Assumenda est architecto fugit ut repellat sit. Sint et rem tenetur qui.\n\nAt sed unde molestiae ad ipsum. Ratione cum a et fuga odio aperiam. Ullam deserunt earum velit quam expedita sint quibusdam. Reprehenderit doloremque et nam perspiciatis.', NULL, 21.78, '2024-02-18', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(23, 'Haikyu!! Volume 1', 'Autem asperiores ipsa ipsam voluptas. Voluptate est quia pariatur velit velit magnam non. Porro est dolor sunt aut.\n\nDeleniti hic assumenda alias sint ea sint. Qui consectetur accusantium numquam consequuntur eos molestiae illum. Vero qui et nisi est ratione.\n\nRem ab consequatur provident amet maxime omnis error. Cupiditate placeat maiores quam et et tempora. Sed excepturi officiis perferendis omnis.', NULL, 17.21, '2022-07-31', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(24, 'Slam Dunk Volume 1', 'Vel commodi incidunt recusandae dolorem esse. Ea et dicta natus. Dolorem alias et adipisci magnam autem.\n\nDelectus voluptas animi accusantium voluptas. Dicta et et blanditiis autem dignissimos. Nihil recusandae fugiat ipsa. Qui dignissimos reprehenderit eos libero et.\n\nAut repellat illum a nulla. Aut doloribus accusamus ab voluptatem ut error. Veniam omnis porro error ut qui tenetur eum. Eius consectetur odit et doloremque.', NULL, 25.12, '2023-11-04', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(25, 'Your Lie in April Volume 1', 'Omnis neque distinctio ea natus quo laboriosam eius. In veritatis ab modi omnis mollitia rerum suscipit. Quo eos laudantium cupiditate. Distinctio ratione aut eos possimus qui et suscipit.\n\nCumque quaerat nihil sit nihil ut. Tempora ipsam voluptatem tempora occaecati asperiores. Iusto est culpa expedita reiciendis.\n\nIpsa ratione fugiat itaque magni dolorem voluptas. Sed aut voluptatem libero quaerat tenetur sit aliquam corrupti. Quibusdam voluptatum beatae numquam sint ut quibusdam. Sunt repudiandae tenetur suscipit doloremque numquam et nesciunt voluptate.', NULL, 17.83, '2019-04-30', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(26, 'A Silent Voice Volume 1', 'Qui beatae aut quis ipsum non magni officia natus. Qui excepturi repellendus odit sequi et. Voluptas dolores ratione sunt sequi commodi tempora error veniam.\n\nConsectetur qui perspiciatis ipsum ipsum similique est ut. Aut in at qui facere amet. Et minima unde voluptatibus et libero et praesentium. Natus a nemo officia et consequuntur voluptatem quas.\n\nVeritatis totam et aliquid quibusdam. Ut quo eligendi nihil quo est. Accusantium et fuga placeat dicta enim in non et. Inventore quia et est.', NULL, 13.96, '2016-03-22', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(27, 'The Promised Neverland Volume 1', 'Sed ipsum debitis sit odio ut. Numquam aliquid eligendi qui sunt et. Non nisi est ut.\n\nId optio non est libero rerum dolorum. Necessitatibus laudantium maxime non voluptates illo eligendi dolorum incidunt. Eligendi beatae non qui quasi repudiandae officia recusandae.\n\nQuisquam illo molestiae dignissimos sunt amet atque. Necessitatibus atque enim voluptatibus et modi numquam earum. Officia hic error delectus odit quia. Cupiditate amet animi ut officia. Iusto in nemo impedit.', NULL, 27.15, '2022-02-22', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(28, 'Made in Abyss Volume 1', 'Non dolor distinctio voluptas similique ea. Aliquid tempore commodi temporibus aliquam tempore exercitationem. Dignissimos similique aliquid quidem facilis sint id ullam.\n\nEarum soluta voluptatum eos ut nostrum. Et non qui corporis quae dolorum ut. Voluptate iusto quo quam eaque id quia. Consectetur exercitationem magnam aut facilis hic.\n\nEt vel sint voluptatibus sed ex ipsam. Neque velit doloribus itaque. Reprehenderit et hic ut velit perspiciatis necessitatibus corporis. Sed fuga et quae laboriosam sed magni similique.', NULL, 18.18, '2015-05-01', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(29, 'Re:Zero Volume 1', 'Magnam ea necessitatibus at. Laboriosam provident omnis nostrum nulla voluptatum. Voluptatem recusandae nam accusamus delectus aut voluptatibus.\n\nQuo molestiae non culpa quis blanditiis illo neque. Similique ullam error recusandae esse. Quis voluptatibus explicabo sit tempora molestiae illo. Aut sapiente porro et dignissimos vel rem.\n\nEligendi voluptates odit culpa qui. Quos minus est necessitatibus dolore voluptatem libero. Laudantium repellendus qui sunt corrupti libero. Delectus enim enim laborum qui.', NULL, 22.10, '2021-08-07', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL),
(30, 'Sword Art Online Volume 1', 'Ratione veritatis qui est eos quos. Corrupti autem unde eum nostrum numquam. Autem deserunt omnis omnis occaecati accusantium et.\n\nCulpa omnis provident tempora voluptates quo distinctio. Est ut inventore corporis nostrum ut beatae. Aliquid exercitationem qui eos voluptatem. Molestias illum et doloribus enim praesentium voluptatem aspernatur.\n\nSed ut laboriosam in rerum non itaque exercitationem placeat. Sed debitis beatae at nobis corrupti ducimus ut dolores. Sit inventore voluptatum error. Eos error occaecati fugit in mollitia quos.', NULL, 17.84, '2023-08-23', '2025-03-14 21:55:46', '2025-03-14 21:55:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE `item_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_03_11_094828_create_genres_table', 1),
(7, '2025_03_11_094833_create_statuses_table', 1),
(8, '2025_03_11_094839_create_customers_table', 1),
(9, '2025_03_11_094852_create_items_table', 1),
(10, '2025_03_11_094903_create_stocks_table', 1),
(11, '2025_03_11_094911_create_orderinfos_table', 1),
(12, '2025_03_11_094933_create_orderlines_table', 1),
(13, '2025_03_11_094941_create_reviews_table', 1),
(14, '2025_03_11_094957_create_bad_words_table', 1),
(15, '2025_03_11_102341_create_sessions_table', 1),
(16, '2025_03_13_011937_create_genre_item_table', 1),
(17, '2025_03_15_005510_create_roles_table', 1),
(18, '2025_03_15_005534_create_item_images_table', 1),
(19, '2025_03_15_005649_add_soft_deletes_to_items_table', 1),
(20, '2025_03_15_054538_create_publishers_table', 1),
(21, '2025_03_15_054549_create_authors_table', 1),
(22, '2025_03_15_054559_create_author_item_table', 1),
(23, '2025_03_15_054729_add_publisher_id_to_items_table', 1),
(24, '2025_03_15_054755_remove_publisher_and_author_columns_from_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderinfos`
--

CREATE TABLE `orderinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `date_placed` date NOT NULL,
  `date_shipped` date DEFAULT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderlines`
--

CREATE TABLE `orderlines` (
  `orderinfo_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL COMMENT 'Price at time of purchase',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `description`, `country`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Viz Media', 'One of the largest publishers of manga in the United States.', 'United States', 'https://www.viz.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 'Kodansha Comics', 'The English-language publishing arm of Kodansha, one of Japan\'s largest publishers.', 'Japan', 'https://kodansha.us', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 'Yen Press', 'A publishing company specializing in manga and graphic novels.', 'United States', 'https://yenpress.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 'Seven Seas Entertainment', 'An American publishing company that specializes in manga and light novels.', 'United States', 'https://sevenseasentertainment.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 'Dark Horse Comics', 'An American comic book and manga publisher.', 'United States', 'https://www.darkhorse.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 'Vertical Comics', 'A publisher focused on quality manga and Japanese literature.', 'United States', 'https://vertical-inc.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(7, 'Square Enix Manga', 'The manga publishing division of Square Enix.', 'Japan', 'https://www.square-enix.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(8, 'Tokyopop', 'A distributor, licensor, and publisher of manga and anime.', 'United States', 'https://www.tokyopop.com', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(9, 'Shueisha', 'One of the largest publishing companies in Japan.', 'Japan', 'https://www.shueisha.co.jp', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(10, 'Kadokawa', 'A major Japanese publishing company that produces manga and light novels.', 'Japan', 'https://www.kadokawa.co.jp', '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL COMMENT '1-5 stars',
  `comment` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'Full access to all system features', '2025-03-14 21:55:43', '2025-03-14 21:55:43'),
(2, 'Staff', 'staff', 'Access to manage content and orders', '2025-03-14 21:55:43', '2025-03-14 21:55:43'),
(3, 'Customer', 'customer', 'Regular customer access', '2025-03-14 21:55:43', '2025-03-14 21:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 'Order has been placed but not processed yet', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 'Processing', 'Order is being processed', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 'Shipped', 'Order has been shipped to the customer', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 'Delivered', 'Order has been delivered to the customer', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 'Cancelled', 'Order has been cancelled', '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 'Returned', 'Order has been returned by the customer', '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 65, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(2, 56, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(3, 98, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(4, 10, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 22, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 96, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(7, 20, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(8, 1, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(9, 93, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(10, 82, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(11, 80, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(12, 28, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(13, 72, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(14, 66, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(15, 82, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(16, 49, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(17, 81, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(18, 19, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(19, 42, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(20, 78, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(21, 43, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(22, 7, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(23, 24, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(24, 12, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(25, 6, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(26, 38, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(27, 51, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(28, 23, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(29, 79, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(30, 81, '2025-03-14 21:55:46', '2025-03-14 21:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','customer') NOT NULL DEFAULT 'customer',
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('activated','deactivated') NOT NULL DEFAULT 'activated',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$uTHJV7pbDfzPyUDiL/GJoO0bAOp9lH2Gaej4gzti9B1.knlr.fg0K', 'admin', 1, 'activated', NULL, '2025-03-14 21:55:43', '2025-03-14 21:55:43'),
(2, 'Staff User', 'staff@example.com', NULL, '$2y$12$yKIsOE2kPlcHCN3nblpDA.vqUnT812GmCfJgSuyfLSZBav4VPDi.C', 'staff', 2, 'activated', NULL, '2025-03-14 21:55:44', '2025-03-14 21:55:44'),
(3, 'Staff Manager', 'manager@example.com', NULL, '$2y$12$1jMjQjBgernVz3edB7Er/eG8DYFkWW5Ce6TGb1cjwCgpNrvpbUV8i', 'staff', 2, 'activated', NULL, '2025-03-14 21:55:44', '2025-03-14 21:55:44'),
(4, 'John Doe', 'john@example.com', NULL, '$2y$12$votDNLSL8ix71TVw69bHn.biPpYjvPgY55xdtVF8Emi/OtYyFma/2', 'customer', 3, 'activated', NULL, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(5, 'Jane Smith', 'jane@example.com', NULL, '$2y$12$7jH6N7uYaMBOKm8Ke95uj.DsgkpPb45eMRsT6oewZ1U8fL36iqnIu', 'customer', 3, 'activated', NULL, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(6, 'Bob Johnson', 'bob@example.com', NULL, '$2y$12$.3p9.CMYs5prHDYlCM071ODGbDTNnF9aKWalt2iBCd1SK1vow6B2S', 'customer', 3, 'activated', NULL, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(7, 'Alice Brown', 'alice@example.com', NULL, '$2y$12$umgeeI2FUvWLq0YjR/8wV.zRGg3Qmxf9S.QTg3H53dH4Er0.uueXS', 'customer', 3, 'activated', NULL, '2025-03-14 21:55:46', '2025-03-14 21:55:46'),
(8, 'Inactive User', 'inactive@example.com', NULL, '$2y$12$dckWDtgpyKwlJszOSk.Y1u5ekU8FF9AZTli1wtZFBQeWbFR96VyTq', 'customer', 3, 'deactivated', NULL, '2025-03-14 21:55:46', '2025-03-14 21:55:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_item`
--
ALTER TABLE `author_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `author_item_author_id_item_id_role_unique` (`author_id`,`item_id`,`role`),
  ADD KEY `author_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `bad_words`
--
ALTER TABLE `bad_words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_item`
--
ALTER TABLE `genre_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genre_item_genre_id_item_id_unique` (`genre_id`,`item_id`),
  ADD KEY `genre_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `item_images`
--
ALTER TABLE `item_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_images_item_id_foreign` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderinfos`
--
ALTER TABLE `orderinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderinfos_customer_id_foreign` (`customer_id`),
  ADD KEY `orderinfos_status_id_foreign` (`status_id`);

--
-- Indexes for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD PRIMARY KEY (`orderinfo_id`,`item_id`),
  ADD KEY `orderlines_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_item_id_foreign` (`item_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `author_item`
--
ALTER TABLE `author_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bad_words`
--
ALTER TABLE `bad_words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genre_item`
--
ALTER TABLE `genre_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orderinfos`
--
ALTER TABLE `orderinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author_item`
--
ALTER TABLE `author_item`
  ADD CONSTRAINT `author_item_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `author_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `genre_item`
--
ALTER TABLE `genre_item`
  ADD CONSTRAINT `genre_item_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genre_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `item_images`
--
ALTER TABLE `item_images`
  ADD CONSTRAINT `item_images_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderinfos`
--
ALTER TABLE `orderinfos`
  ADD CONSTRAINT `orderinfos_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orderinfos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Constraints for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD CONSTRAINT `orderlines_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderlines_orderinfo_id_foreign` FOREIGN KEY (`orderinfo_id`) REFERENCES `orderinfos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
