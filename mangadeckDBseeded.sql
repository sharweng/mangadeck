-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2025 at 03:02 AM
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
-- Table structure for table `bad_words`
--

CREATE TABLE `bad_words` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `word` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bad_words`
--

INSERT INTO `bad_words` (`id`, `word`, `created_at`, `updated_at`) VALUES
(1, 'badword1', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(2, 'badword2', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(3, 'badword3', '2025-03-14 16:37:57', '2025-03-14 16:37:57');

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
(16, 'Ms', 'Doe', 'John', '33267 Larry Plains Suite 756, Lake Tomasa, WY 64435', '+1 (415) 806-3772', 25, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(17, 'Mr', 'Smith', 'Jane', '6485 Mayer Shoals, Watsicabury, MN 47451', '443.323.6800', 26, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(18, 'Dr', 'Johnson', 'Bob', '4186 Allison Shoals Apt. 587, Bergnaummouth, LA 99328-7440', '253-948-5487', 27, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(19, 'Dr', 'Brown', 'Alice', '663 Eichmann Wall, New Deborah, ME 96856-8860', '(272) 238-0263', 28, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(20, 'Mrs', 'User', 'Inactive', '64277 Doyle Forges, West Mercedes, WA 78901', '1-814-645-6098', 29, '2025-03-14 17:23:59', '2025-03-14 17:23:59');

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
(1, 'Shonen', 'Manga aimed at teenage boys', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(2, 'Shojo', 'Manga aimed at teenage girls', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(3, 'Seinen', 'Manga aimed at adult men', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(4, 'Josei', 'Manga aimed at adult women', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(5, 'Isekai', 'Stories about characters transported to another world', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(6, 'Mecha', 'Stories featuring robots and mechanical technology', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(7, 'Fantasy', 'Stories with magical or supernatural elements', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(8, 'Horror', 'Stories designed to frighten or scare', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(9, 'Romance', 'Stories focused on romantic relationships', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(10, 'Sports', 'Stories centered around athletics and competition', '2025-03-14 16:37:57', '2025-03-14 16:37:57');

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
(1, 1, 1, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(2, 6, 1, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(3, 9, 1, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(4, 2, 2, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(5, 2, 3, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(6, 3, 4, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(7, 4, 4, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(8, 6, 4, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(9, 3, 5, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(10, 5, 6, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(11, 2, 7, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(12, 9, 8, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(13, 6, 9, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(14, 8, 9, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(15, 9, 9, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(16, 2, 10, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(17, 10, 10, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(18, 6, 11, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(19, 7, 12, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(20, 10, 12, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(21, 2, 13, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(22, 8, 13, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(23, 5, 14, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(24, 5, 15, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(25, 3, 16, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(26, 9, 17, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(27, 8, 18, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(28, 5, 19, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(29, 7, 19, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(30, 10, 19, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(31, 9, 20, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(32, 10, 20, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(33, 5, 21, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(34, 7, 21, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(35, 7, 22, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(36, 8, 22, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(37, 7, 23, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(38, 4, 24, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(39, 2, 25, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(40, 4, 25, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(41, 10, 25, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(42, 2, 26, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(43, 10, 26, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(44, 1, 27, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(45, 5, 27, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(46, 8, 28, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(47, 1, 29, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(48, 6, 30, '2025-03-14 17:23:17', '2025-03-14 17:23:17'),
(49, 1, 31, NULL, NULL),
(50, 3, 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`, `price`, `author`, `publisher`, `publication_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'One Piece Volume 1: Romance Dawn', 'Dolor officiis sapiente est et aut molestiae ratione consequatur. Vero tempora sed qui quas itaque labore. Optio voluptatem omnis iste quasi. Non quo sed ea quis beatae.\n\nCommodi voluptas quia accusantium tempore eligendi et. Doloribus ad accusamus qui ab. Esse veritatis illum nobis corrupti labore.\n\nVoluptatibus sint sunt maiores laboriosam molestiae accusamus quidem consectetur. Minus fugit aut deleniti ab dolore sit eum. Inventore eaque et molestiae autem.', 21.23, 'Eiichiro Oda', 'Viz Media', '2022-03-10', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(2, 'Naruto Volume 1: Uzumaki Naruto', 'Vel cum autem consequuntur fuga odit eveniet. Maxime et sequi maiores reiciendis aperiam cumque et. Aut cum pariatur fugit nihil laborum nisi.\n\nVoluptatibus sint pariatur ipsa. Ex et qui voluptas esse. Et officiis nostrum sint non ut dolor ea.\n\nVelit sed corrupti minima debitis occaecati tenetur. Ratione dolores at non est voluptate ex facilis. Sit odio numquam id possimus voluptas quae. Labore nam cum excepturi provident harum.', 22.38, 'Masashi Kishimoto', 'Kodansha Comics', '2015-11-02', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(3, 'Bleach Volume 1: The Death and the Strawberry', 'Iusto id deserunt et eius. Molestias quo et laborum consectetur rerum quia.\n\nRerum animi tempore impedit ut magnam. Repellendus minus nobis tempore et molestias numquam non assumenda. Quisquam pariatur hic vitae corporis quia sed omnis.\n\nDignissimos odit provident enim id id quia esse. Aut veritatis eos impedit iure assumenda modi iste.', 13.97, 'Tite Kubo', 'Yen Press', '2023-07-12', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(4, 'Dragon Ball Volume 1: The Monkey King', 'Libero hic voluptates accusantium quis. In reiciendis et atque dolores qui quo et. Deserunt qui omnis repellat doloribus.\n\nSapiente ea accusamus nostrum culpa vero. Labore quis nostrum eos facere rerum. Numquam expedita cupiditate illum cumque porro. Ut recusandae harum nobis necessitatibus qui dolorem.\n\nMaxime rerum eos molestiae doloribus. Maiores rerum ratione porro magni. Distinctio sint quaerat qui voluptatem quis et itaque.', 11.26, 'Akira Toriyama', 'Seven Seas Entertainment', '2023-02-18', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(5, 'Attack on Titan Volume 1', 'Quos eos corrupti quae. Assumenda qui aliquam eveniet qui iste consectetur velit saepe. Qui eius explicabo perferendis nesciunt. Cum dolores nam vero sit praesentium voluptates.\n\nEt minus ipsum eveniet sed illo fugiat. Libero incidunt et eligendi id. Illum nam maxime eos harum cum facilis iure similique. Enim voluptas numquam voluptas qui eaque.\n\nFugit voluptas maiores itaque et beatae voluptatem est. Pariatur tempora minus nihil rem dolores laboriosam dignissimos. Sed sed enim aut quidem dolorem. Sit aperiam voluptates quae.', 20.58, 'Hajime Isayama', 'Dark Horse Comics', '2024-11-10', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(6, 'My Hero Academia Volume 1: Izuku Midoriya: Origin', 'Magnam provident et repellat velit explicabo repellat quae. Quo et mollitia qui suscipit dolor eos commodi perferendis. Non eligendi non fuga ut iste. Enim asperiores dignissimos qui ut aliquam est mollitia. Sed quidem dolorem vero aut ad ducimus laudantium dolor.\n\nSuscipit ut voluptates sed est. At magnam nostrum laudantium laboriosam mollitia vel.\n\nFugit similique veritatis ab sint. Vel eum ut aliquid. Fuga totam autem ducimus. Rem assumenda et molestiae aliquid voluptatem minus sint.', 17.36, 'Kohei Horikoshi', 'Vertical Comics', '2016-04-28', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(7, 'Demon Slayer Volume 1: Cruelty', 'Quisquam qui ipsum facere voluptate ut suscipit amet qui. Sed sint fugit ex. Fuga odit recusandae et asperiores placeat. Est non omnis alias cupiditate.\n\nEos sit dolorem labore provident nesciunt. Tempore qui facere veritatis sit. Ipsam voluptatem perspiciatis qui in possimus sed et. Aut ut id ut qui omnis distinctio.\n\nExcepturi omnis expedita ipsa qui. Sed ab veniam blanditiis ea quae impedit ea. Illo aperiam error ipsum aut. Molestiae fugiat necessitatibus maxime provident asperiores facere.', 17.79, 'Koyoharu Gotouge', 'Square Enix Manga', '2015-03-23', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(8, 'Jujutsu Kaisen Volume 1', 'Aliquam quaerat occaecati consectetur enim inventore quibusdam omnis. Voluptatem eos eligendi saepe et culpa.\n\nAb voluptatem sapiente commodi autem. Et qui ipsum exercitationem sit expedita deserunt. Odio recusandae odit odit voluptas debitis dignissimos. Saepe illum consequatur corrupti reprehenderit enim quos dolor.\n\nQuia eius iusto et culpa voluptas ullam. Eum dolorem consequatur libero minima. Eum consequuntur dicta perspiciatis dignissimos voluptatem ut.', 17.58, 'Gege Akutami', 'Tokyopop', '2021-08-10', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(9, 'Tokyo Ghoul Volume 1', 'Soluta necessitatibus illum eligendi qui. Fugiat doloribus dolor est quidem ut ab. Consequatur quam error sed et ut. Placeat provident molestias sit culpa doloremque corrupti saepe.\n\nLaboriosam voluptatibus quia autem magnam. Minima sequi dolores voluptate qui. Non ex velit rerum corrupti. Ut corrupti deleniti error et magnam consequuntur voluptatem occaecati.\n\nDolore maiores omnis inventore. Est sed quaerat vitae earum enim aut. Consequatur et laudantium itaque animi consectetur quibusdam perspiciatis.', 17.67, 'Sui Ishida', 'Shueisha', '2021-01-15', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(10, 'Death Note Volume 1: Boredom', 'Unde eaque architecto illum facilis rerum. Nemo aut ut natus non ea est optio. Maiores qui blanditiis rerum veniam accusamus vitae inventore. Quidem temporibus magnam iure.\n\nMinima velit cum corporis commodi maxime quidem. Culpa laboriosam perferendis tempore omnis aut quis qui. Sint quo omnis ex minus et.\n\nOfficia placeat fugiat modi ullam ut consequatur ut. Nostrum eos maiores dolor. Autem rerum qui autem laudantium ut quo.', 16.00, 'Tsugumi Ohba', 'Kadokawa', '2025-02-15', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(11, 'Fullmetal Alchemist Volume 1', 'Ex vel eos tempora ut est sed. Sed est rerum sunt eum aut. Et ut aut quisquam omnis vero.\n\nQui quasi perferendis suscipit ut commodi exercitationem esse. Illum doloribus laborum dolorem. Error rem est sapiente laudantium. Dolores neque aliquam voluptas qui reiciendis neque.\n\nUt omnis voluptate dolorem aut debitis ea maiores. Et autem voluptates ullam et excepturi at modi. Dolor quos eveniet ea qui atque eos consequatur. Aut sint ut fugiat ducimus.', 25.89, 'Hiromu Arakawa', 'Viz Media', '2021-03-06', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(12, 'Hunter x Hunter Volume 1', 'Velit eos possimus corrupti voluptas dolorem optio. Et molestiae nam aliquam laborum magni natus. Velit qui non at similique illum recusandae. Perferendis et cupiditate aut aut dolor. Doloremque qui modi et suscipit.\n\nUt dicta omnis qui officiis doloremque accusamus id. Vero quis qui similique ducimus dolor alias. Fugiat ut dolorem quos excepturi fugiat omnis.\n\nIllo consequuntur ab fuga est eligendi minima consequatur. Dolore dignissimos deserunt sit tempore vero repudiandae deserunt.', 13.55, 'Yoshihiro Togashi', 'Kodansha Comics', '2024-04-03', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(13, 'Sailor Moon Volume 1', 'Explicabo sint illo velit optio magni aut at. Aspernatur et fugit velit suscipit quas commodi. Impedit sequi unde illum quasi dolor et dolores.\n\nSequi laudantium voluptatem beatae non excepturi. Aut voluptas qui tenetur architecto. Dolorum hic ea illo occaecati.\n\nUt voluptatem vel non at aliquid ea enim. Voluptatibus possimus debitis quidem alias provident similique commodi sunt. Voluptas illo perspiciatis corrupti aut deleniti dolor. Consequatur quidem non omnis molestias neque dolor officia. Sit atque officiis voluptatem facilis suscipit earum.', 21.28, 'Naoko Takeuchi', 'Yen Press', '2023-12-27', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(14, 'Fruits Basket Volume 1', 'Nihil sunt possimus architecto tenetur cupiditate officia. Perferendis reiciendis non non et libero aut itaque et. Rerum distinctio provident facere nulla officiis labore in.\n\nAutem voluptas consequuntur fugit debitis itaque odit id. Labore quia sed enim eos et repellat. Eligendi reprehenderit in aperiam rerum. Reprehenderit corrupti dolorum ad.\n\nA cupiditate neque atque id sint repellat. Corporis culpa totam et ut. Molestiae molestiae eaque quidem deleniti.', 10.71, 'Natsuki Takaya', 'Seven Seas Entertainment', '2021-11-02', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(15, 'Nana Volume 1', 'Hic ut dolores quod et harum. Vel enim ea dolores qui rerum.\n\nLaudantium illo deleniti architecto sunt iste asperiores. Consequatur nam ut dolor modi maxime. Esse et nam ut velit maxime. Aut blanditiis voluptatem vel reprehenderit commodi.\n\nQuasi quod numquam sunt expedita. Sunt quis aspernatur blanditiis consequuntur id.', 12.88, 'Ai Yazawa', 'Dark Horse Comics', '2022-12-18', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(16, 'Ouran High School Host Club Volume 1', 'Eos eius minima consequatur neque et sunt dolores. Et voluptatem et beatae rerum tenetur unde. Velit sint omnis optio exercitationem cupiditate voluptatum.\n\nFuga neque ea sequi perferendis. Velit vel maxime ea dolorem unde. Voluptatem dolore est id dolore et sint iste.\n\nTemporibus impedit repellendus maiores alias accusamus ullam nobis. Laborum doloribus nesciunt nobis qui. Voluptas voluptas omnis laudantium illum velit. Magni eveniet earum corrupti atque.', 15.67, 'Bisco Hatori', 'Vertical Comics', '2023-08-26', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(17, 'Berserk Volume 1: The Black Swordsman', 'Qui et ab earum maxime ratione nam velit. Optio aut pariatur beatae aut omnis necessitatibus. Quaerat impedit qui inventore ut quis id.\n\nHarum enim quas aut accusantium. Sit qui excepturi consequatur aliquid aut. Nihil fuga voluptatem odit sint et vitae aut. Sit assumenda id saepe facilis.\n\nEx repudiandae aut officia est ipsum. Voluptatibus inventore totam recusandae sed placeat beatae. Sed molestiae aut iure. Minus quae consequuntur eum commodi iure ut est.', 26.72, 'Kentaro Miura', 'Square Enix Manga', '2020-05-27', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(18, 'Vagabond Volume 1', 'Amet qui eos rem dignissimos esse. Voluptatum omnis id ut esse sint vel aut. Dicta voluptatem qui sit et.\n\nExpedita occaecati dolores optio rem. Pariatur nulla a esse rem non.\n\nVelit doloribus et nisi. Ipsa est fugiat et quas. Nostrum vero corporis ipsa eius.', 20.04, 'Takehiko Inoue', 'Tokyopop', '2022-08-04', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(19, 'Vinland Saga Volume 1', 'Enim voluptatem suscipit molestiae doloribus. Ut minus sit commodi qui voluptatem recusandae eum.\n\nOfficiis enim quis molestiae maiores ea. Laboriosam eos unde aliquam animi. Harum excepturi similique aliquam aperiam dolores.\n\nQui id qui quas quod est eum. Deserunt rerum omnis laboriosam et. Itaque non molestiae itaque illum.', 19.94, 'Makoto Yukimura', 'Shueisha', '2023-04-10', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(20, 'Monster Volume 1', 'Distinctio et quas consequatur facilis consequatur. Impedit ut autem aperiam possimus. Rerum porro autem consequatur atque similique explicabo. Quibusdam earum corporis aliquid.\n\nAmet quam ex reprehenderit. Omnis corrupti qui quisquam tenetur. Possimus distinctio quia alias et.\n\nAmet sit reiciendis doloremque voluptatum quis et. Eos quia est atque voluptatem. Itaque suscipit et magnam vel perferendis eum et.', 21.59, 'Naoki Urasawa', 'Kadokawa', '2018-10-11', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(21, 'Spy x Family Volume 1', 'Molestiae nobis ab magnam possimus. Maiores numquam aut nulla minima. Est qui est rem doloremque omnis itaque rem. Repellat commodi ut esse ut.\n\nRepellat sapiente ut amet ut voluptatibus eum. Omnis recusandae minima fugiat aut aspernatur iste nam. Enim minima beatae enim nihil. Cupiditate ut sunt dolorum consectetur.\n\nPraesentium vel molestiae atque beatae sit error adipisci. Non aut ut qui eum. Perspiciatis quisquam ut ex unde temporibus neque. Consectetur nostrum sit voluptas iste id.', 28.71, 'Tatsuya Endo', 'Viz Media', '2020-10-07', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(22, 'Chainsaw Man Volume 1', 'Reiciendis veniam ab amet est placeat labore. Sit quos ex sit dolores earum eum et. Libero nam ea totam necessitatibus molestias voluptatem qui. Nam voluptates atque odit dolore reiciendis et animi. Ea ex sunt ipsum reprehenderit aut.\n\nLibero ea cumque quos aspernatur velit sed. Quasi quia aspernatur dignissimos sint quas ipsa. Commodi nemo sint modi totam blanditiis. Asperiores dolor suscipit delectus totam.\n\nEos mollitia amet et. Corporis similique totam iusto consequuntur doloremque dolorum autem. Quas explicabo in sequi quis voluptatem. Possimus non aut odit quo quaerat in.', 12.28, 'Tatsuki Fujimoto', 'Kodansha Comics', '2023-04-27', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(23, 'Haikyu!! Volume 1', 'Illum error assumenda facilis velit quidem. Amet aut nihil voluptatum. Commodi quod enim quod ut quia perferendis.\n\nIpsam nihil et perspiciatis odio. Temporibus pariatur asperiores nobis omnis voluptatibus et. Magnam deleniti molestias voluptatem dicta.\n\nVoluptatum reprehenderit nesciunt nihil nihil deserunt. Occaecati corrupti nobis libero voluptatem. Beatae amet quasi voluptates iste.', 15.05, 'Haruichi Furudate', 'Yen Press', '2024-03-18', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(24, 'Slam Dunk Volume 1', 'Et aut facere accusantium mollitia maiores modi minima. Nemo voluptas aut labore id quis. Ut harum rem nihil repudiandae rem porro aut. Provident quo libero laboriosam ea illum.\n\nRerum assumenda fugiat autem velit vel aut. Exercitationem sed ut perspiciatis.\n\nLibero rerum libero commodi necessitatibus hic omnis possimus optio. Et earum quidem consequatur aut molestiae voluptatem. Laboriosam autem enim repellendus ex nam maxime non. Adipisci consequatur et omnis sed magni vel pariatur omnis.', 11.36, 'Takehiko Inoue', 'Seven Seas Entertainment', '2023-11-17', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(25, 'Your Lie in April Volume 1', 'Et repellat debitis quia enim necessitatibus natus tempora. Omnis eos illo aut sequi fugiat. Quaerat ad porro blanditiis et. Laboriosam ipsam sint nam exercitationem non similique.\n\nEligendi vitae dolor nisi id dolor. Excepturi nulla qui praesentium odit deleniti. Voluptatem commodi et qui in. Animi eius numquam dolores blanditiis.\n\nAut sit rem quia ea dignissimos. Qui impedit earum similique consequuntur occaecati iste laudantium. Odit a rem et amet. Cupiditate perspiciatis expedita non dolore.', 16.58, 'Naoshi Arakawa', 'Dark Horse Comics', '2018-06-29', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(26, 'A Silent Voice Volume 1', 'Nulla laborum aliquam ratione voluptatem aut quia ea. Culpa deserunt repellendus laborum vel. Et sed vel qui modi laborum magnam dolores. Quidem sit non explicabo atque.\n\nProvident voluptatem aperiam quaerat. Dignissimos autem expedita doloribus culpa porro dolore. Numquam aspernatur sit repellat non.\n\nEst laboriosam molestiae molestiae illum dolores. Iste molestias asperiores voluptatum unde sed. Quasi ab necessitatibus fuga blanditiis fuga inventore voluptate enim. In consequuntur porro incidunt ut.', 25.13, 'Yoshitoki Oima', 'Vertical Comics', '2023-04-05', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(27, 'The Promised Neverland Volume 1', 'Optio esse illo debitis repellendus placeat non et. Cum maxime omnis ut deserunt. Id quia reprehenderit vitae deleniti esse consequuntur excepturi iure. Corporis architecto sapiente ullam voluptates sint et.\n\nSuscipit ut nihil nemo sed vitae inventore. Animi occaecati enim nesciunt error distinctio ut. Rerum eius est illum consectetur recusandae earum vel. Doloribus est quia delectus ut quas aliquid enim non.\n\nAccusantium ea occaecati quis a. Architecto eveniet est est autem velit id eligendi. Vitae vitae et quo laborum consequatur. Est earum distinctio dolores maiores quisquam est quo quae.', 10.99, 'Kaiu Shirai', 'Square Enix Manga', '2017-07-07', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(28, 'Made in Abyss Volume 1', 'Vel magni voluptas deserunt voluptates at. Rerum ullam non doloremque est provident doloribus aliquam. Ex voluptate quidem aut maiores neque necessitatibus amet.\n\nNesciunt libero distinctio eos libero alias at earum quam. Voluptas ut qui deserunt nesciunt ipsam dolorum veritatis. Consectetur labore et eos voluptas. Vero est ut dignissimos occaecati.\n\nProvident eos veritatis occaecati fugiat. Quia nisi explicabo omnis adipisci quibusdam delectus ea. Saepe mollitia perspiciatis veritatis doloribus id recusandae excepturi quaerat. Aliquam harum iste aliquam ut quos consequatur doloribus est.', 26.89, 'Akihito Tsukushi', 'Tokyopop', '2017-08-24', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(29, 'Re:Zero Volume 1', 'Dicta odio earum ducimus sed sit impedit autem. Voluptas alias qui aut cum animi praesentium molestias. Debitis eveniet consectetur dolores ipsam officia inventore.\n\nEt harum deserunt magnam quo dolores. Quod quod dicta at sit aut quis.\n\nRatione labore et dolorem. Pariatur in error ut. Sed blanditiis ab ut modi. Libero est accusantium magnam debitis ea ut nostrum quo.', 10.23, 'Tappei Nagatsuki', 'Shueisha', '2018-04-18', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(30, 'Sword Art Online Volume 1', 'Quae voluptatibus quia ea dolores iste. Minima esse illo aspernatur iste id. Sit architecto ut ut. Quo vero doloribus qui recusandae officia.\n\nVel dolorem tenetur deleniti. Eos earum eum quibusdam.\n\nAut sed suscipit sequi harum odio qui. Blanditiis ut consequatur et quo. Sit suscipit reiciendis similique sequi quod et dignissimos. Et ipsum quam totam doloremque eos modi unde.', 28.05, 'Reki Kawahara', 'Kadokawa', '2024-05-05', '2025-03-14 17:23:17', '2025-03-14 17:23:17', NULL),
(31, 'Kagurabachi Best Manga', 'As a young boy, Chihiro trains every day under his father to become a swordsmith. Although different in temperament, the two spend peaceful days laughing and working together. But one day, tragedy strikes… Now Chihiro burns with hatred and sets out to exact revenge.Test', 12.00, 'Takeru Hokazono', 'Sqaure ENixz', '2025-03-04', '2025-03-14 17:53:03', '2025-03-14 17:54:03', '2025-03-14 17:54:03');

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
(17, '2025_03_15_005510_create_roles_table', 2),
(18, '2025_03_15_005534_create_item_images_table', 2),
(19, '2025_03_15_005649_add_soft_deletes_to_items_table', 2);

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
(1, 'Administrator', 'admin', 'Full access to all system features', '2025-03-14 17:09:42', '2025-03-14 17:09:42'),
(2, 'Staff', 'staff', 'Access to manage content and orders', '2025-03-14 17:09:42', '2025-03-14 17:09:42'),
(3, 'Customer', 'customer', 'Regular customer access', '2025-03-14 17:09:42', '2025-03-14 17:09:42');

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
(1, 'Pending', 'Order has been placed but not processed', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(2, 'Processing', 'Order is being processed', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(3, 'Shipped', 'Order has been shipped', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(4, 'Delivered', 'Order has been delivered', '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(5, 'Cancelled', 'Order has been cancelled', '2025-03-14 16:37:57', '2025-03-14 16:37:57');

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
(1, 45, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(2, 97, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(3, 59, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(4, 42, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(5, 74, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(6, 58, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(7, 4, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(8, 100, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(9, 89, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(10, 20, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(11, 64, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(12, 14, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(13, 23, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(14, 73, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(15, 63, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(16, 12, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(17, 76, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(18, 59, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(19, 82, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(20, 66, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(21, 9, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(22, 78, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(23, 69, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(24, 92, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(25, 85, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(26, 12, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(27, 58, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(28, 38, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(29, 56, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(30, 11, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(31, 40, '2025-03-14 17:53:03', '2025-03-14 17:53:52');

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
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$LRtHNrJpUDlqhELOuWcSTepilwrOO8elwX9asi8C7rFHDlhK0QZRu', 'admin', 1, 'activated', NULL, '2025-03-14 16:37:57', '2025-03-14 16:37:57'),
(23, 'Staff User', 'staff@example.com', NULL, '$2y$12$OIx7xOaphu8ObojSW42akefqRXn/qEkXAQJFWG8ce54p1Rc5c.kvy', 'staff', 2, 'activated', NULL, '2025-03-14 17:23:58', '2025-03-14 17:23:58'),
(24, 'Staff Manager', 'manager@example.com', NULL, '$2y$12$x/l93.i6kM28o8Csq/FIceRvJWNLuHF8W.j7k.LXlZ3hwfXZvxR.m', 'staff', 2, 'activated', NULL, '2025-03-14 17:23:58', '2025-03-14 17:23:58'),
(25, 'John Doe', 'john@example.com', NULL, '$2y$12$ZSALiR9WWuLuveYF4fMyOuRCBOxmPNl8oTy6babouudDgtnfK9VAi', 'customer', 3, 'activated', NULL, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(26, 'Jane Smith', 'jane@example.com', NULL, '$2y$12$z7RgzLJwbjEALsc6NC/bZ.exgpiOfDcwAII2hG1nGtjKnewpwcZ4.', 'customer', 3, 'activated', NULL, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(27, 'Bob Johnson', 'bob@example.com', NULL, '$2y$12$.iXT.EOEpH9XiL2pT64ZR.MHPqsH0.5jkb7mZIuz6TL2/OqyGvpSy', 'customer', 3, 'activated', NULL, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(28, 'Alice Brown', 'alice@example.com', NULL, '$2y$12$bR812l2qvjK/ua7Dz3uD9usSnx1g.kI8kCTp1PRRrrE/j1AZXzlKm', 'customer', 3, 'activated', NULL, '2025-03-14 17:23:59', '2025-03-14 17:23:59'),
(29, 'Inactive User', 'inactive@example.com', NULL, '$2y$12$cFrrM7jehZ9/bL46ZnmzX./tb8jk2DvxkrxN5cJgR8hoSf4hUZEW.', 'customer', 3, 'deactivated', NULL, '2025-03-14 17:23:59', '2025-03-14 17:23:59');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bad_words`
--
ALTER TABLE `bad_words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genre_item`
--
ALTER TABLE `genre_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

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
