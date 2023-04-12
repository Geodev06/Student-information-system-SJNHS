-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 11:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentinfo`
--

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
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2019_08_19_000000_create_failed_jobs_table', 1),
(25, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(26, '2023_02_23_052428_create_subjects_table', 1),
(27, '2023_02_26_093635_create_studentinfos_table', 1),
(28, '2023_03_02_135735_create_other_studentinfos_table', 1),
(29, '2023_03_04_105401_create_records_table', 1),
(30, '2023_03_12_125114_create_releases_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_studentinfos`
--

CREATE TABLE `other_studentinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `pept_rating` varchar(255) DEFAULT '',
  `pept_date_assestment` varchar(255) DEFAULT '',
  `als_rating` varchar(255) DEFAULT '',
  `als_name_address` varchar(255) DEFAULT '',
  `others` varchar(255) DEFAULT '',
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
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `classified_grade` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `adviser` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `remedial_date_from` varchar(255) DEFAULT NULL,
  `remedial_date_to` varchar(255) DEFAULT NULL,
  `remedials` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`remedials`)),
  `gen_ave` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `lrn`, `school`, `school_id`, `district`, `division`, `region`, `classified_grade`, `section`, `school_year`, `adviser`, `data`, `remedial_date_from`, `remedial_date_to`, `remedials`, `gen_ave`, `created_at`, `updated_at`) VALUES
(1, '263661692739', 'sample school', 'sample id', '4', '4', '4-a', '7', 'sample section', '2012-2013', 'mr. sample teacher', '[{\"FILIPINO\":{\"quarter_1\":\"78\",\"quarter_2\":\"88\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":80.5,\"remark\":\"PASSED\"}},{\"ENGLISH\":{\"quarter_1\":\"78\",\"quarter_2\":\"87\",\"quarter_3\":\"87\",\"quarter_4\":\"87\",\"final\":84.75,\"remark\":\"PASSED\"}},{\"MATHEMATICS\":{\"quarter_1\":\"78\",\"quarter_2\":\"77\",\"quarter_3\":\"85\",\"quarter_4\":\"85\",\"final\":81.25,\"remark\":\"PASSED\"}},{\"SCIENCE\":{\"quarter_1\":\"78\",\"quarter_2\":\"74\",\"quarter_3\":\"85\",\"quarter_4\":\"85\",\"final\":80.5,\"remark\":\"PASSED\"}},{\"ARALING PANLIPUNAN (AP)\":{\"quarter_1\":\"78\",\"quarter_2\":\"89\",\"quarter_3\":\"98\",\"quarter_4\":\"89\",\"final\":88.5,\"remark\":\"PASSED\"}},{\"EDUKASYON SA PAGPAPAKATAO (ESP)\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"88\",\"quarter_4\":\"78\",\"final\":82.25,\"remark\":\"PASSED\"}},{\"TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"85\",\"quarter_4\":\"85\",\"final\":83.25,\"remark\":\"PASSED\"}},{\"MUSIC\":{\"quarter_1\":\"78\",\"quarter_2\":\"78\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":78,\"remark\":\"PASSED\"}},{\"ARTS\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"85\",\"quarter_4\":\"78\",\"final\":81.5,\"remark\":\"PASSED\"}},{\"PHYSICAL EDUCATION\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"85\",\"final\":81.5,\"remark\":\"PASSED\"}},{\"HEALTH\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"85\",\"final\":81.5,\"remark\":\"PASSED\"}}]', NULL, NULL, '[]', '82.14', '2023-04-12 00:36:25', '2023-04-12 00:36:25'),
(2, '012365230120', 'SAMPLE SCHOOL', 'SAMP-01923', '4', '4', '4-A', '7', 'SAMPLE', '2008-2009', 'MR. AGNOTE AGEO', '[{\"FILIPINO\":{\"quarter_1\":\"78\",\"quarter_2\":\"77\",\"quarter_3\":\"78\",\"quarter_4\":\"89\",\"final\":80.5,\"remark\":\"PASSED\"}},{\"ENGLISH\":{\"quarter_1\":\"89\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":82.5,\"remark\":\"PASSED\"}},{\"MATHEMATICS\":{\"quarter_1\":\"78\",\"quarter_2\":\"78\",\"quarter_3\":\"85\",\"quarter_4\":\"87\",\"final\":82,\"remark\":\"PASSED\"}},{\"SCIENCE\":{\"quarter_1\":\"78\",\"quarter_2\":\"88\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":80.5,\"remark\":\"PASSED\"}},{\"ARALING PANLIPUNAN (AP)\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"85\",\"quarter_4\":\"88\",\"final\":84,\"remark\":\"PASSED\"}},{\"EDUKASYON SA PAGPAPAKATAO (ESP)\":{\"quarter_1\":\"78\",\"quarter_2\":\"77\",\"quarter_3\":\"77\",\"quarter_4\":\"78\",\"final\":77.5,\"remark\":\"PASSED\"}},{\"TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)\":{\"quarter_1\":\"78\",\"quarter_2\":\"87\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":80.25,\"remark\":\"PASSED\"}},{\"MUSIC\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"85\",\"quarter_4\":\"85\",\"final\":83.25,\"remark\":\"PASSED\"}},{\"ARTS\":{\"quarter_1\":\"80\",\"quarter_2\":\"80\",\"quarter_3\":\"80\",\"quarter_4\":\"80\",\"final\":80,\"remark\":\"PASSED\"}},{\"PHYSICAL EDUCATION\":{\"quarter_1\":\"80\",\"quarter_2\":\"80\",\"quarter_3\":\"80\",\"quarter_4\":\"80\",\"final\":80,\"remark\":\"PASSED\"}},{\"HEALTH\":{\"quarter_1\":\"80\",\"quarter_2\":\"80\",\"quarter_3\":\"80\",\"quarter_4\":\"80\",\"final\":80,\"remark\":\"PASSED\"}}]', '2023-04-13', '2023-04-29', '[{\"remedials\":\"english a\",\"remedials_rating\":\"75\",\"remedial_class_mark\":\"a\",\"remedials_final_grade\":\"78\",\"remedials_remarks\":\"passed\"},{\"remedials\":\"english b\",\"remedials_rating\":\"76\",\"remedial_class_mark\":\"a\",\"remedials_final_grade\":\"79\",\"remedials_remarks\":\"passed\"}]', '80.95', '2023-04-12 00:56:36', '2023-04-12 01:04:42'),
(3, '012365230120', 'SAMPLE SCHOOL', 'SAMP-900', '4', '4', '4-A', '8', 'SAMPLE 8', '2009-2010', 'MR. AGNOTE AGEO', '[{\"FILIPINO\":{\"quarter_1\":\"78\",\"quarter_2\":\"78\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":78,\"remark\":\"PASSED\"}},{\"ENGLISH\":{\"quarter_1\":\"77\",\"quarter_2\":\"77\",\"quarter_3\":\"77\",\"quarter_4\":\"77\",\"final\":77,\"remark\":\"PASSED\"}},{\"MATHEMATICS\":{\"quarter_1\":\"88\",\"quarter_2\":\"88\",\"quarter_3\":\"88\",\"quarter_4\":\"88\",\"final\":88,\"remark\":\"PASSED\"}},{\"SCIENCE\":{\"quarter_1\":\"87\",\"quarter_2\":\"87\",\"quarter_3\":\"87\",\"quarter_4\":\"87\",\"final\":87,\"remark\":\"PASSED\"}},{\"ARALING PANLIPUNAN (AP)\":{\"quarter_1\":\"89\",\"quarter_2\":\"89\",\"quarter_3\":\"89\",\"quarter_4\":\"89\",\"final\":89,\"remark\":\"PASSED\"}},{\"EDUKASYON SA PAGPAPAKATAO (ESP)\":{\"quarter_1\":\"75\",\"quarter_2\":\"85\",\"quarter_3\":\"96\",\"quarter_4\":\"98\",\"final\":88.5,\"remark\":\"PASSED\"}},{\"TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)\":{\"quarter_1\":\"78\",\"quarter_2\":\"77\",\"quarter_3\":\"74\",\"quarter_4\":\"85\",\"final\":78.5,\"remark\":\"PASSED\"}},{\"MUSIC\":{\"quarter_1\":\"75\",\"quarter_2\":\"75\",\"quarter_3\":\"75\",\"quarter_4\":\"75\",\"final\":75,\"remark\":\"PASSED\"}},{\"ARTS\":{\"quarter_1\":\"75\",\"quarter_2\":\"75\",\"quarter_3\":\"75\",\"quarter_4\":\"75\",\"final\":75,\"remark\":\"PASSED\"}},{\"PHYSICAL EDUCATION\":{\"quarter_1\":\"78\",\"quarter_2\":\"77\",\"quarter_3\":\"75\",\"quarter_4\":\"76\",\"final\":76.5,\"remark\":\"PASSED\"}},{\"HEALTH\":{\"quarter_1\":\"78\",\"quarter_2\":\"86\",\"quarter_3\":\"89\",\"quarter_4\":\"89\",\"final\":85.5,\"remark\":\"PASSED\"}}]', NULL, NULL, '[]', '81.64', '2023-04-12 00:57:55', '2023-04-12 00:57:55'),
(4, '012365230120', 'SAMPLE SCHOOL', 'SAMP-980', '4', '4', '4-A', '9', 'SECTION - 9', '2010-2011', 'MR. AGNOTE AGEO', '[{\"FILIPINO\":{\"quarter_1\":\"78\",\"quarter_2\":\"78\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":78,\"remark\":\"PASSED\"}},{\"ENGLISH\":{\"quarter_1\":\"79\",\"quarter_2\":\"79\",\"quarter_3\":\"79\",\"quarter_4\":\"79\",\"final\":79,\"remark\":\"PASSED\"}},{\"MATHEMATICS\":{\"quarter_1\":\"80\",\"quarter_2\":\"80\",\"quarter_3\":\"80\",\"quarter_4\":\"80\",\"final\":80,\"remark\":\"PASSED\"}},{\"SCIENCE\":{\"quarter_1\":\"71\",\"quarter_2\":\"75\",\"quarter_3\":\"82\",\"quarter_4\":\"82\",\"final\":77.5,\"remark\":\"PASSED\"}},{\"ARALING PANLIPUNAN (AP)\":{\"quarter_1\":\"73\",\"quarter_2\":\"85\",\"quarter_3\":\"89\",\"quarter_4\":\"89\",\"final\":84,\"remark\":\"PASSED\"}},{\"EDUKASYON SA PAGPAPAKATAO (ESP)\":{\"quarter_1\":\"89\",\"quarter_2\":\"98\",\"quarter_3\":\"98\",\"quarter_4\":\"98\",\"final\":95.75,\"remark\":\"PASSED\"}},{\"TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)\":{\"quarter_1\":\"75\",\"quarter_2\":\"78\",\"quarter_3\":\"85\",\"quarter_4\":\"78\",\"final\":79,\"remark\":\"PASSED\"}},{\"MUSIC\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"87\",\"final\":82,\"remark\":\"PASSED\"}},{\"ARTS\":{\"quarter_1\":\"81\",\"quarter_2\":\"78\",\"quarter_3\":\"78\",\"quarter_4\":\"87\",\"final\":81,\"remark\":\"PASSED\"}},{\"PHYSICAL EDUCATION\":{\"quarter_1\":\"89\",\"quarter_2\":\"89\",\"quarter_3\":\"96\",\"quarter_4\":\"89\",\"final\":90.75,\"remark\":\"PASSED\"}},{\"HEALTH\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":79.75,\"remark\":\"PASSED\"}}]', NULL, NULL, '[]', '82.43', '2023-04-12 00:59:10', '2023-04-12 00:59:10'),
(5, '012365230120', 'SAMPLESCHOOOL', 'SAMP-10', '4', '4', '4-A', '10', 'SAMPLE SECTION', '2011-2012', 'MR. AGNOTE VALLAR AGEO', '[{\"FILIPINO\":{\"quarter_1\":\"78\",\"quarter_2\":\"78\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":78,\"remark\":\"PASSED\"}},{\"ENGLISH\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"89\",\"quarter_4\":\"89\",\"final\":85.25,\"remark\":\"PASSED\"}},{\"MATHEMATICS\":{\"quarter_1\":\"89\",\"quarter_2\":\"96\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":85.25,\"remark\":\"PASSED\"}},{\"SCIENCE\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":79.75,\"remark\":\"PASSED\"}},{\"ARALING PANLIPUNAN (AP)\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"85\",\"final\":81.5,\"remark\":\"PASSED\"}},{\"EDUKASYON SA PAGPAPAKATAO (ESP)\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":79.75,\"remark\":\"PASSED\"}},{\"TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"85\",\"quarter_4\":\"85\",\"final\":83.25,\"remark\":\"PASSED\"}},{\"MUSIC\":{\"quarter_1\":\"78\",\"quarter_2\":\"78\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":78,\"remark\":\"PASSED\"}},{\"ARTS\":{\"quarter_1\":\"89\",\"quarter_2\":\"89\",\"quarter_3\":\"89\",\"quarter_4\":\"89\",\"final\":89,\"remark\":\"PASSED\"}},{\"PHYSICAL EDUCATION\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"78\",\"final\":79.75,\"remark\":\"PASSED\"}},{\"HEALTH\":{\"quarter_1\":\"78\",\"quarter_2\":\"85\",\"quarter_3\":\"78\",\"quarter_4\":\"85\",\"final\":81.5,\"remark\":\"PASSED\"}}]', NULL, NULL, '[]', '81.91', '2023-04-12 01:00:21', '2023-04-12 01:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `releases`
--

CREATE TABLE `releases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `name_of_school` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `releases`
--

INSERT INTO `releases` (`id`, `lrn`, `school_id`, `name_of_school`, `created_at`, `updated_at`) VALUES
(8, '263661692739', 'KOID-121289', 'LSPU SPCC', '2023-04-12 00:37:23', '2023-04-12 00:37:23'),
(9, '012365230120', 'SID-123910', 'STI COLLEGE SAN PABLO', '2023-04-12 00:46:24', '2023-04-12 00:46:24'),
(10, '135819054238', 'SID-1238192', 'LSPU STA CRUZ', '2023-04-12 00:54:50', '2023-04-12 00:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `studentinfos`
--

CREATE TABLE `studentinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT '',
  `lastname` varchar(255) NOT NULL,
  `name_ext` varchar(255) DEFAULT '',
  `birthdate` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `elem_school` varchar(255) NOT NULL,
  `elem_school_id` varchar(255) NOT NULL,
  `elem_school_citation` varchar(255) DEFAULT '',
  `elem_school_address` varchar(255) NOT NULL,
  `gen_ave` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentinfos`
--

INSERT INTO `studentinfos` (`id`, `lrn`, `firstname`, `middlename`, `lastname`, `name_ext`, `birthdate`, `sex`, `elem_school`, `elem_school_id`, `elem_school_citation`, `elem_school_address`, `gen_ave`, `created_at`, `updated_at`) VALUES
(1, '717080995785', 'Jayda', 'Yundt', 'Torp', '', '2006-11-26', 0, 'Velit et et sed hic debitis.', '113807', 'N/A', 'N/A', '84.00', '2023-04-12 00:18:55', '2023-04-12 00:18:55'),
(2, '365211140328', 'Forest', 'Pfannerstill', 'Rowe', '', '1976-04-06', 1, 'Fugit amet aliquam accusamus.', '442792', 'N/A', 'N/A', '83.00', '2023-04-12 00:18:55', '2023-04-12 00:18:55'),
(3, '695578418823', 'Mortimer', 'Dare', 'Schaefer', '', '2016-04-21', 1, 'Dolorem id tempora dicta.', '918313', 'N/A', 'N/A', '98.00', '2023-04-12 00:18:55', '2023-04-12 00:18:55'),
(4, '722065718573', 'Bart', 'Dach', 'Zemlak', '', '1971-08-15', 0, 'Sit modi velit qui ipsum.', '630855', 'N/A', 'N/A', '95.00', '2023-04-12 00:18:55', '2023-04-12 00:18:55'),
(5, '577813492552', 'Allan', 'Wisozk', 'Mann', '', '2002-09-09', 1, 'Facilis tenetur non officiis.', '344822', 'N/A', 'N/A', '95.00', '2023-04-12 00:18:55', '2023-04-12 00:18:55'),
(6, '546330950109', 'Cedrick', 'McDermott', 'Hauck', '', '2008-03-07', 0, 'Impedit quae odio enim id.', '448643', 'N/A', 'N/A', '82.00', '2023-04-12 00:18:55', '2023-04-12 00:18:55'),
(7, '647658076554', 'Sheldon', 'Von', 'Hartmann', '', '2005-06-15', 0, 'Est ab omnis magnam non.', '882695', 'N/A', 'N/A', '75.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(8, '326515388132', 'Pinkie', 'Witting', 'Welch', '', '2015-08-23', 0, 'Et et odit sint.', '855546', 'N/A', 'N/A', '97.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(9, '146521998244', 'Jon', 'Mosciski', 'Turcotte', '', '1988-07-06', 1, 'Iusto nesciunt est sequi.', '698725', 'N/A', 'N/A', '79.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(10, '958375361471', 'Sabryna', 'Keebler', 'Luettgen', '', '2005-06-05', 0, 'Nam corporis aut dolorem.', '378163', 'N/A', 'N/A', '77.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(11, '849311530945', 'Sid', 'Howell', 'O\'Connell', '', '2004-07-14', 1, 'Voluptas et dolor ut et.', '821490', 'N/A', 'N/A', '77.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(12, '897364712074', 'Mervin', 'Quitzon', 'Kozey', '', '2022-07-28', 0, 'Rerum ut repellat sed aut.', '405066', 'N/A', 'N/A', '83.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(13, '280367097491', 'Mercedes', 'Berge', 'Schaefer', '', '2010-01-08', 0, 'Impedit et et amet ut.', '964495', 'N/A', 'N/A', '78.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(14, '910800148269', 'Eliezer', 'Mosciski', 'McDermott', '', '1987-01-21', 0, 'Veniam dolorem earum quia ut.', '689295', 'N/A', 'N/A', '88.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(15, '113228932960', 'Trycia', 'Bednar', 'Padberg', '', '1986-03-29', 1, 'Quis sunt dolor quos.', '384114', 'N/A', 'N/A', '80.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(16, '228672005305', 'Emelia', 'Rippin', 'Johnston', '', '1986-01-28', 1, 'Rem aut sed suscipit labore.', '554518', 'N/A', 'N/A', '94.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(17, '237398172513', 'Enoch', 'Brakus', 'Mayert', '', '2014-11-15', 1, 'Mollitia ipsam ea aliquam.', '525490', 'N/A', 'N/A', '78.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(18, '707275654912', 'Ellsworth', 'Jaskolski', 'Russel', '', '2011-02-20', 1, 'Quod veniam sit dolore et.', '549332', 'N/A', 'N/A', '96.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(19, '769126957469', 'Wanda', 'Hayes', 'Corwin', '', '1990-11-19', 0, 'Maiores aut debitis quaerat.', '110970', 'N/A', 'N/A', '96.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(20, '761449361392', 'Warren', 'Vandervort', 'Prosacco', '', '1998-08-03', 0, 'Voluptatem animi qui in.', '267189', 'N/A', 'N/A', '78.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(21, '994701748200', 'Amelia', 'Rice', 'Bartoletti', '', '2020-02-04', 1, 'Vel voluptate nobis iusto.', '794859', 'N/A', 'N/A', '81.00', '2023-04-12 00:18:56', '2023-04-12 00:18:56'),
(22, '934456156859', 'Dakota', 'Graham', 'Huel', '', '2006-12-15', 1, 'Aut minima ipsam quia aut.', '793467', 'N/A', 'N/A', '75.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(23, '820645605956', 'Judd', 'Runte', 'Mueller', '', '1974-03-28', 0, 'Qui ab quod nesciunt facilis.', '876073', 'N/A', 'N/A', '95.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(24, '825118076388', 'Kobe', 'Torp', 'Johnson', '', '1991-10-28', 0, 'Nihil rerum rerum illo sed.', '533713', 'N/A', 'N/A', '90.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(25, '956919989797', 'Cleta', 'Nitzsche', 'Bechtelar', '', '2004-08-08', 0, 'Magni est dolorem et ut.', '547850', 'N/A', 'N/A', '88.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(26, '471781331595', 'Easton', 'Rodriguez', 'Wehner', '', '1999-04-08', 1, 'Et quo ut id saepe ratione.', '421848', 'N/A', 'N/A', '75.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(27, '735924858187', 'Bartholome', 'Armstrong', 'Carter', '', '1980-05-30', 0, 'Ut et odio et et et.', '966826', 'N/A', 'N/A', '80.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(28, '953063046254', 'Devon', 'Maggio', 'Quigley', '', '2003-01-01', 1, 'Sapiente non autem magni.', '677062', 'N/A', 'N/A', '75.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(29, '645889450972', 'Alyson', 'Zulauf', 'Cormier', '', '1973-11-07', 0, 'Nobis consequatur tempore in.', '585385', 'N/A', 'N/A', '90.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(30, '415777499756', 'Etha', 'Krajcik', 'Bernhard', '', '1992-03-05', 1, 'Dolor ipsum in et id.', '495774', 'N/A', 'N/A', '96.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(31, '626438888022', 'Tess', 'Bruen', 'Klocko', '', '1999-02-19', 1, 'Soluta tempore eum ut sunt.', '418674', 'N/A', 'N/A', '98.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(32, '375569594674', 'Princess', 'Mueller', 'Quigley', '', '2022-10-05', 0, 'Nihil est sed vel sed.', '917234', 'N/A', 'N/A', '89.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(33, '184280489696', 'Vivianne', 'Mayert', 'Stark', '', '1972-09-20', 1, 'Ut nemo quo ipsum vero.', '177335', 'N/A', 'N/A', '84.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(34, '132667737270', 'Nelda', 'Marquardt', 'Mayert', '', '2011-05-15', 1, 'Quia velit doloremque illum.', '844293', 'N/A', 'N/A', '86.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(35, '524200388333', 'Bartholome', 'Thompson', 'Monahan', '', '1995-05-20', 1, 'Autem fugit impedit iure nam.', '585974', 'N/A', 'N/A', '86.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(36, '819941149976', 'Davion', 'Harber', 'Zemlak', '', '2008-08-20', 1, 'Omnis nobis illo possimus ea.', '253626', 'N/A', 'N/A', '75.00', '2023-04-12 00:18:57', '2023-04-12 00:18:57'),
(37, '250672995686', 'Estefania', 'Ziemann', 'Thiel', '', '2001-08-30', 1, 'Aut voluptas nisi quia esse.', '898973', 'N/A', 'N/A', '87.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(38, '344190968642', 'Dario', 'Buckridge', 'Dietrich', '', '2006-07-23', 0, 'Et ut velit occaecati magni.', '724780', 'N/A', 'N/A', '85.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(39, '882319723948', 'Yasmin', 'Watsica', 'Wehner', '', '2013-01-03', 1, 'Similique omnis facere ullam.', '776895', 'N/A', 'N/A', '85.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(40, '874121023089', 'Reta', 'Nikolaus', 'Moore', '', '1981-05-20', 0, 'Qui nam quis quis sunt.', '883221', 'N/A', 'N/A', '97.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(41, '474144588233', 'Esperanza', 'Metz', 'Lynch', '', '2002-09-08', 0, 'Libero ut sed beatae.', '685172', 'N/A', 'N/A', '82.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(42, '728463234797', 'Marian', 'Langosh', 'Lindgren', '', '1986-10-13', 0, 'Qui provident magni qui ab.', '914057', 'N/A', 'N/A', '83.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(43, '448064083582', 'Kylee', 'Bartoletti', 'Gottlieb', '', '1979-12-17', 0, 'Ullam incidunt eos harum.', '106158', 'N/A', 'N/A', '91.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(44, '774211504560', 'Maxie', 'Thiel', 'Hettinger', '', '2007-02-14', 0, 'Aut est vero non id.', '329454', 'N/A', 'N/A', '96.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(45, '670709122924', 'Dexter', 'Hettinger', 'Douglas', '', '2019-09-20', 0, 'Est magni maxime quis odit.', '115477', 'N/A', 'N/A', '85.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(46, '184916496182', 'Glenna', 'Kutch', 'Gleason', '', '2013-04-19', 0, 'Sit a animi placeat odit.', '148628', 'N/A', 'N/A', '91.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(47, '346476190738', 'Alberta', 'Ruecker', 'Mraz', '', '1989-06-12', 0, 'Totam laudantium est laborum.', '810998', 'N/A', 'N/A', '87.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(48, '854735808458', 'Price', 'Hartmann', 'Crooks', '', '1973-10-21', 0, 'Eos et labore omnis aut.', '151499', 'N/A', 'N/A', '98.00', '2023-04-12 00:18:58', '2023-04-12 00:18:58'),
(49, '313596769213', 'Shannon', 'Frami', 'Boyer', '', '1983-06-21', 1, 'Minima a et neque.', '658300', 'N/A', 'N/A', '98.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(50, '900005635472', 'Joanne', 'Labadie', 'Cummerata', '', '2005-02-12', 0, 'Autem doloribus et aut.', '704360', 'N/A', 'N/A', '99.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(51, '361602310357', 'Pinkie', 'Vandervort', 'Predovic', '', '2003-01-26', 1, 'Maxime et repellat velit.', '750296', 'N/A', 'N/A', '83.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(52, '646658854526', 'Stanford', 'Little', 'Jenkins', '', '2012-02-12', 1, 'Id aspernatur sunt id enim.', '591011', 'N/A', 'N/A', '92.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(53, '916451171590', 'Donna', 'Grady', 'Cole', '', '2008-09-28', 0, 'Ea sunt ipsa error.', '713484', 'N/A', 'N/A', '84.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(54, '191497517220', 'Makenzie', 'Smith', 'Reichert', '', '2021-09-05', 0, 'Non voluptatum quia ut est.', '575133', 'N/A', 'N/A', '97.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(55, '360443719400', 'Einar', 'Watsica', 'Pouros', '', '2005-01-01', 0, 'Labore possimus aut esse.', '115277', 'N/A', 'N/A', '80.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(56, '971341135176', 'Mercedes', 'Waelchi', 'Heidenreich', '', '1991-10-31', 1, 'Nisi sunt repellat a.', '392885', 'N/A', 'N/A', '92.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(57, '230772821129', 'Edd', 'Conn', 'Braun', '', '2017-01-03', 0, 'Id quidem minima sint.', '104590', 'N/A', 'N/A', '89.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(58, '327842215462', 'Guiseppe', 'Hirthe', 'Hudson', '', '2007-05-01', 0, 'Sint esse nisi sed inventore.', '713205', 'N/A', 'N/A', '97.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(59, '589753671624', 'Jodie', 'Terry', 'Gleichner', '', '2011-03-18', 0, 'In autem dolores cumque.', '709454', 'N/A', 'N/A', '98.00', '2023-04-12 00:18:59', '2023-04-12 00:18:59'),
(60, '382792606765', 'Murl', 'Schultz', 'Turcotte', '', '2012-08-07', 1, 'Sequi modi sunt facilis.', '810893', 'N/A', 'N/A', '76.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(61, '634769504825', 'Marcelo', 'Rosenbaum', 'Stroman', '', '2000-04-06', 1, 'Et facilis unde corporis.', '388846', 'N/A', 'N/A', '99.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(62, '814251203056', 'Emmanuel', 'Herman', 'Jacobs', '', '2014-03-30', 1, 'Quia sint odit qui delectus.', '917635', 'N/A', 'N/A', '94.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(63, '558807106705', 'Henderson', 'Rippin', 'Beahan', '', '2004-12-31', 0, 'Eos qui nemo nihil.', '722192', 'N/A', 'N/A', '94.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(64, '159207093279', 'River', 'Denesik', 'Yost', '', '2018-05-14', 1, 'Id qui quidem quo iure aut.', '609964', 'N/A', 'N/A', '77.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(65, '969414013807', 'Vicenta', 'Kuhlman', 'Kiehn', '', '1991-01-25', 1, 'Ab sed sequi optio suscipit.', '437580', 'N/A', 'N/A', '90.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(66, '355945022759', 'Princess', 'White', 'Greenfelder', '', '1987-09-02', 0, 'Libero molestiae et sunt.', '169530', 'N/A', 'N/A', '82.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(67, '808684060777', 'Kira', 'Huel', 'Jerde', '', '2003-11-03', 0, 'Et animi ut deserunt.', '838912', 'N/A', 'N/A', '88.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(68, '280116176313', 'Evan', 'Nitzsche', 'Roberts', '', '2019-02-04', 0, 'Tempore dolore quia rerum.', '478958', 'N/A', 'N/A', '97.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(69, '942163943111', 'Gunnar', 'Conroy', 'Schoen', '', '2012-05-17', 0, 'Aut aut sit quibusdam ab rem.', '970232', 'N/A', 'N/A', '90.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(70, '215245405605', 'Heidi', 'Bahringer', 'Stoltenberg', '', '1987-10-11', 0, 'Esse iure placeat tempore.', '164549', 'N/A', 'N/A', '79.00', '2023-04-12 00:19:00', '2023-04-12 00:19:00'),
(71, '220452111458', 'Alexander', 'Hudson', 'Dicki', '', '2010-10-13', 1, 'Eum sed dolorum architecto.', '347022', 'N/A', 'N/A', '90.00', '2023-04-12 00:19:01', '2023-04-12 00:19:01'),
(72, '341051159658', 'Ezra', 'Ebert', 'Moen', '', '2014-07-02', 0, 'Omnis aut odio est atque.', '981987', 'N/A', 'N/A', '83.00', '2023-04-12 00:19:01', '2023-04-12 00:19:01'),
(73, '260869274405', 'Foster', 'Bode', 'McCullough', '', '2019-06-15', 0, 'Culpa atque rerum et et cum.', '629419', 'N/A', 'N/A', '93.00', '2023-04-12 00:19:01', '2023-04-12 00:19:01'),
(74, '928271876200', 'Merritt', 'Stehr', 'Keebler', '', '1977-10-26', 1, 'Tempora ut et cum provident.', '119375', 'N/A', 'N/A', '79.00', '2023-04-12 00:19:01', '2023-04-12 00:19:01'),
(75, '803062345553', 'Jordane', 'Lowe', 'Collins', '', '2000-05-24', 1, 'Aliquam voluptas quis et.', '373802', 'N/A', 'N/A', '99.00', '2023-04-12 00:19:01', '2023-04-12 00:19:01'),
(76, '663905326902', 'Bridget', 'Gottlieb', 'Rath', '', '2003-04-20', 0, 'Eaque architecto non cum et.', '601518', 'N/A', 'N/A', '98.00', '2023-04-12 00:19:01', '2023-04-12 00:19:01'),
(77, '109917937101', 'Angela', 'Hudson', 'Roob', '', '1993-08-29', 0, 'Eos sed expedita quo quia.', '959049', 'N/A', 'N/A', '82.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(78, '118878813593', 'Eddie', 'Fritsch', 'Bauch', '', '1987-09-04', 0, 'Amet nihil aut maiores fugit.', '864567', 'N/A', 'N/A', '88.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(79, '191071947428', 'Davonte', 'Hilpert', 'Powlowski', '', '2000-11-09', 0, 'Eos sapiente omnis et enim.', '704683', 'N/A', 'N/A', '85.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(80, '865504431251', 'Fae', 'Carter', 'Stiedemann', '', '1976-11-07', 1, 'Et vel aperiam sit ea.', '954260', 'N/A', 'N/A', '78.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(81, '775583645348', 'Velva', 'Parker', 'Crona', '', '2013-08-22', 0, 'Qui fuga labore qui.', '728916', 'N/A', 'N/A', '82.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(82, '851902295723', 'Piper', 'Treutel', 'Pagac', '', '2011-10-21', 1, 'Cum aliquam a corrupti.', '701487', 'N/A', 'N/A', '91.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(83, '485755808429', 'Coby', 'Mosciski', 'Braun', '', '2011-10-03', 1, 'Incidunt ut qui eligendi.', '248852', 'N/A', 'N/A', '83.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(84, '384483388251', 'Glen', 'Rau', 'Johnson', '', '2022-08-21', 0, 'Et facere sint debitis velit.', '815627', 'N/A', 'N/A', '90.00', '2023-04-12 00:19:02', '2023-04-12 00:19:02'),
(85, '511908911367', 'Mariela', 'Rath', 'Wyman', '', '1976-01-11', 1, 'Ut laborum qui accusantium.', '971138', 'N/A', 'N/A', '79.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(86, '608770645550', 'Giovanni', 'Schamberger', 'Sipes', '', '1974-05-23', 0, 'Omnis non dicta sint.', '120459', 'N/A', 'N/A', '75.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(87, '659092386277', 'Valentin', 'Pacocha', 'Hills', '', '2022-11-28', 0, 'Rerum velit autem sequi.', '903012', 'N/A', 'N/A', '77.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(88, '544794496470', 'Edwin', 'Rowe', 'Heller', '', '1997-07-31', 1, 'Sit adipisci in qui enim aut.', '175833', 'N/A', 'N/A', '78.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(89, '135819054238', 'Delta', 'Hills', 'Barton', '', '1988-07-28', 1, 'Voluptas commodi vitae ut.', '381756', 'N/A', 'N/A', '81.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(90, '620830107240', 'Trisha', 'Bednar', 'Kulas', '', '2004-10-24', 1, 'Aut dolorem fugiat non.', '543588', 'N/A', 'N/A', '97.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(91, '487918661981', 'Anya', 'Wehner', 'Harber', '', '1984-11-17', 0, 'Vel alias aut illum quod.', '381696', 'N/A', 'N/A', '93.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(92, '313924228153', 'Dominique', 'Green', 'Leannon', '', '1985-09-26', 0, 'Omnis autem qui quia.', '402031', 'N/A', 'N/A', '84.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(93, '833372694431', 'Gerard', 'Sipes', 'McKenzie', '', '1977-12-03', 0, 'Non et ut ea eveniet labore.', '663574', 'N/A', 'N/A', '77.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(94, '815094814024', 'Aurelie', 'Hane', 'King', '', '1976-09-09', 0, 'Quod omnis sit pariatur.', '408366', 'N/A', 'N/A', '83.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(95, '947253515844', 'Beatrice', 'Oberbrunner', 'Legros', '', '2009-12-01', 0, 'Non esse nihil a et alias.', '259206', 'N/A', 'N/A', '93.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(96, '512852894075', 'Alene', 'Willms', 'Stiedemann', '', '1973-07-05', 0, 'Unde quod doloribus et.', '409692', 'N/A', 'N/A', '93.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(97, '477383344323', 'Giuseppe', 'Legros', 'Dach', '', '1984-05-11', 1, 'Ut qui qui maxime.', '877140', 'N/A', 'N/A', '90.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(98, '478696809004', 'Kacey', 'Paucek', 'McKenzie', '', '1998-12-06', 1, 'Eos id non at magnam facere.', '525033', 'N/A', 'N/A', '77.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(99, '787126503487', 'Noelia', 'Hagenes', 'Carter', '', '1986-08-11', 0, 'Optio animi et natus laborum.', '770898', 'N/A', 'N/A', '91.00', '2023-04-12 00:19:03', '2023-04-12 00:19:03'),
(100, '263661692739', 'Bernadette', 'Luettgen', 'Carroll', '', '1983-01-23', 0, 'Quas deleniti id ea et.', '799262', 'N/A', 'N/A', '92.00', '2023-04-12 00:19:04', '2023-04-12 00:19:04'),
(101, '012365230120', 'Ageo', 'Vallar', 'Agnote', NULL, '1998-08-06', 0, 'Sample elementary school', 'SID-093478', '', 'Brgy. Del remedio, San Pablo city, 4000, Laguna', '88.00', '2023-04-12 00:40:53', '2023-04-12 00:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `security_question` text NOT NULL,
  `security_answer` text NOT NULL,
  `admin_name` varchar(255) DEFAULT '',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `security_question`, `security_answer`, `admin_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ageo', 'Agnote', 'test@gmail.com', '$2y$10$xOjc/zTSFFndz.FNohOhse1rxJkJojBESbDlGWEFB4Ci/4MSdUsJq', 'What primary school did you attend?', 'test', 'Ageo v. Agnote', NULL, '2023-04-12 00:18:11', '2023-04-12 00:32:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_studentinfos`
--
ALTER TABLE `other_studentinfos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `other_studentinfos_lrn_unique` (`lrn`);

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
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `releases`
--
ALTER TABLE `releases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentinfos`
--
ALTER TABLE `studentinfos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentinfos_lrn_unique` (`lrn`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `other_studentinfos`
--
ALTER TABLE `other_studentinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `releases`
--
ALTER TABLE `releases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studentinfos`
--
ALTER TABLE `studentinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
