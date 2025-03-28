-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 11:46 PM
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
-- Database: `kriptonesia_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Dasar-Dasar Crypto🟢', 'dasar-dasar-crypto', '2025-03-27 11:25:38', '2025-03-27 12:22:56'),
(2, 'Panduan Pemula 📖', 'panduan-pemula', '2025-03-27 11:25:50', '2025-03-27 11:25:50'),
(3, 'Keamanan Crypto 🔒', 'keamanan-crypto', '2025-03-27 11:25:56', '2025-03-27 11:25:56'),
(4, 'Strategi Dasar Trading 📈', 'strategi-dasar-trading', '2025-03-27 11:26:02', '2025-03-27 11:26:02'),
(5, 'Berita & Update 📰', 'berita-update', '2025-03-27 11:26:08', '2025-03-27 11:26:08'),
(6, 'Analisis Pasar📈', 'analisis-pasar', '2025-03-27 12:19:10', '2025-03-27 12:20:50'),
(7, 'Altcoin & NFT 🎨', 'altcoin-nft', '2025-03-27 12:19:49', '2025-03-27 12:19:49'),
(8, 'Review & Rekomendasi🟢', 'review-rekomendasi', '2025-03-27 12:20:18', '2025-03-27 12:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_news`
--

CREATE TABLE `crypto_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `source` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crypto_news`
--

INSERT INTO `crypto_news` (`id`, `title`, `description`, `source`, `url`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Circle Mints 250 Million USDC on Solana Network', 'No Description', 'coincu', 'https://cryptopanic.com/news/20888969/Circle-Mints-250-Million-USDC-on-Solana-Network?mtm_campaign=API-OFA', '2025-03-28 07:00:38', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(2, 'Ripple (XRP) News Today: March 28th', 'No Description', 'Feed - Cryptopotato.Com', 'https://cryptopanic.com/news/20888960/Ripple-XRP-News-Today-March-28th?mtm_campaign=API-OFA', '2025-03-28 06:56:38', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(3, 'XRP Head and Shoulders Pattern at Risk If XRP Breaks Above $3: What\'s Next?', 'No Description', 'U.Today', 'https://cryptopanic.com/news/20888950/XRP-Head-and-Shoulders-Pattern-at-Risk-If-XRP-Breaks-Above-3-Whats-Next?mtm_campaign=API-OFA', '2025-03-28 06:55:00', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(4, 'Logan Paul Scores Major Court Victory in Defamation Case Against Coffeezilla', 'No Description', 'ecoinimist.com', 'https://cryptopanic.com/news/20888953/Logan-Paul-Scores-Major-Court-Victory-in-Defamation-Case-Against-Coffeezilla?mtm_campaign=API-OFA', '2025-03-28 06:53:04', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(5, 'Toncoin defies crypto crash as 1.1M TON exit exchanges', 'No Description', 'Feed - Cryptopolitan.Com', 'https://cryptopanic.com/news/20888939/Toncoin-defies-crypto-crash-as-11M-TON-exit-exchanges?mtm_campaign=API-OFA', '2025-03-28 06:52:13', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(6, 'Bitcoin hashprice stabilizes after hitting quarterly low, but miner risk remains', 'No Description', 'CryptoSlate', 'https://cryptopanic.com/news/20888938/Bitcoin-hashprice-stabilizes-after-hitting-quarterly-low-but-miner-risk-remains?mtm_campaign=API-OFA', '2025-03-28 06:50:39', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(7, 'Why is the Crypto Market Falling Today? Expert Analysis', 'No Description', 'Crypto Economy', 'https://cryptopanic.com/news/20888937/Why-is-the-Crypto-Market-Falling-Today-Expert-Analysis?mtm_campaign=API-OFA', '2025-03-28 06:49:48', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(8, 'What’s Next for Crypto After Ripple, Coinbase Dismissals? Incoming SEC Chair Paul Atkins Speaks', 'No Description', 'coinpedia', 'https://cryptopanic.com/news/20888920/Whats-Next-for-Crypto-After-Ripple-Coinbase-Dismissals-Incoming-SEC-Chair-Paul-Atkins-Speaks?mtm_campaign=API-OFA', '2025-03-28 06:48:09', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(9, 'Dog-eat-dog drama erupts in BNB Chain’s Broccoli token showdown', 'No Description', 'CoinTelegraph', 'https://cryptopanic.com/news/20888932/Dog-eat-dog-drama-erupts-in-BNB-Chains-Broccoli-token-showdown?mtm_campaign=API-OFA', '2025-03-28 06:46:18', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(10, 'Forget Bitcoin Price Tag—Arthur Hayes Says Liquidity Is the Real Trigger', 'No Description', 'The Coin Republic', 'https://cryptopanic.com/news/20888914/Forget-Bitcoin-Price-TagArthur-Hayes-Says-Liquidity-Is-the-Real-Trigger?mtm_campaign=API-OFA', '2025-03-28 06:45:00', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(11, 'CHART: Solana’s performance has cratered since Trump’s inauguration', 'No Description', 'Protos.com', 'https://cryptopanic.com/news/20888890/CHART-Solanas-performance-has-cratered-since-Trumps-inauguration?mtm_campaign=API-OFA', '2025-03-28 06:42:52', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(12, 'Tokenized Treasuries Surge, Yet Remain a Small Fraction of Stablecoin Market', 'No Description', 'DeFi News', 'https://cryptopanic.com/news/20888889/Tokenized-Treasuries-Surge-Yet-Remain-a-Small-Fraction-of-Stablecoin-Market?mtm_campaign=API-OFA', '2025-03-28 06:38:54', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(13, 'Nasdaq files 19b-4 with SEC to list and trade shares of Grayscale’s proposed Avalanche ETF', 'No Description', 'The Block', 'https://cryptopanic.com/news/20888861/Nasdaq-files-19b-4-with-SEC-to-list-and-trade-shares-of-Grayscales-proposed-Avalanche-ETF?mtm_campaign=API-OFA', '2025-03-28 06:36:18', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(14, 'Terraform Labs to open crypto creditor claims portal on March 31 in bankruptcy unwind', 'No Description', 'The Block', 'https://cryptopanic.com/news/20888860/Terraform-Labs-to-open-crypto-creditor-claims-portal-on-March-31-in-bankruptcy-unwind?mtm_campaign=API-OFA', '2025-03-28 06:35:58', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(15, 'Coinbase Scores Legal Win as South Carolina Dismisses Staking Case', 'No Description', 'Coinpaper', 'https://cryptopanic.com/news/20888840/Coinbase-Scores-Legal-Win-as-South-Carolina-Dismisses-Staking-Case?mtm_campaign=API-OFA', '2025-03-28 06:31:32', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(16, 'Terra Opens LUNC, USTC &amp; LUNA Claim Portal: What To Know', 'No Description', 'Dailycoin', 'https://cryptopanic.com/news/20888911/Terra-Opens-LUNC-USTC-amp-LUNA-Claim-Portal-What-To-Know?mtm_campaign=API-OFA', '2025-03-28 06:30:00', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(17, 'French state bank Bpifrance plans €25 million crypto fund to invest directly in digital assets, support French companies', 'No Description', 'The Block', 'https://cryptopanic.com/news/20888816/French-state-bank-Bpifrance-plans-25-million-crypto-fund-to-invest-directly-in-digital-assets-support-French-companies?mtm_campaign=API-OFA', '2025-03-28 06:25:23', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(18, '34 charged in $64M crypto scam built on fake trading platform', 'No Description', 'Feed - Cryptopolitan.Com', 'https://cryptopanic.com/news/20888806/34-charged-in-64M-crypto-scam-built-on-fake-trading-platform?mtm_campaign=API-OFA', '2025-03-28 06:20:17', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(19, 'Sei Foundation Eyes 23andMe Assets to Build Blockchain-Based Genetic Data System', 'No Description', 'Crypto Economy', 'https://cryptopanic.com/news/20888738/Sei-Foundation-Eyes-23andMe-Assets-to-Build-Blockchain-Based-Genetic-Data-System?mtm_campaign=API-OFA', '2025-03-28 06:12:02', '2025-03-28 07:02:53', '2025-03-28 07:02:53'),
(20, 'PIVX Weekly Pulse (Mar 21st, 2025 — Mar. 27th, 2025)', 'No Description', 'PIVX medium', 'https://cryptopanic.com/news/20888731/PIVX-Weekly-Pulse-Mar-21st-2025-Mar-27th-2025?mtm_campaign=API-OFA', '2025-03-28 06:07:32', '2025-03-28 07:02:53', '2025-03-28 07:02:53');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_05_131458_create_categories_table', 1),
(5, '2025_03_06_153628_create_tags_table', 1),
(6, '2025_03_07_055249_create_posts_table', 1),
(7, '2025_03_07_064736_create_post_tag_table', 1),
(8, '2025_03_07_130322_create_soft_deleted_posts', 1),
(9, '2025_03_08_182206_create_field_users_post', 1),
(10, '2025_03_08_184449_create_field_users_role', 1),
(11, '2025_03_15_142053_create_trade_signals_table', 1),
(12, '2025_03_20_172607_add_membership_to_users_table', 1),
(13, '2025_03_21_180844_create_payment_confirmations_table', 1),
(14, '2025_03_22_193222_add_expired_at_to_payment_confirmations_table', 1),
(15, '2025_03_25_180609_add_expired_at_to_users', 1),
(20, '2025_03_27_181128_create_activity_log_table', 2),
(21, '2025_03_28_122635_add_views_to_posts_table', 3),
(22, '2025_03_28_134927_create_crypto_news_table', 4);

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
-- Table structure for table `payment_confirmations`
--

CREATE TABLE `payment_confirmations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) NOT NULL COMMENT 'membership atau news',
  `amount` decimal(10,2) NOT NULL,
  `proof` varchar(255) DEFAULT NULL COMMENT 'Path file bukti transfer',
  `status` enum('pending','verifying','paid','failed','expired') NOT NULL DEFAULT 'pending',
  `expired_at` timestamp NULL DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_confirmations`
--

INSERT INTO `payment_confirmations` (`id`, `user_id`, `payment_type`, `amount`, `proof`, `status`, `expired_at`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 'membership_3bulan', 554000.00, 'uploads/bukti/1743084838_67dc533c0a9dd-qris.png', 'paid', '2025-06-27 10:16:24', NULL, '2025-03-27 07:13:44', '2025-03-27 10:16:24'),
(2, 3, 'membership_1bulan', 279000.00, 'uploads/bukti/1743095164_67dc533c0a9dd-qris.png', 'paid', '2025-04-27 10:08:24', NULL, '2025-03-27 10:05:41', '2025-03-27 10:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `judul`, `slug`, `category_id`, `content`, `views`, `image`, `created_at`, `updated_at`, `deleted_at`, `users_id`) VALUES
(1, 'Apa Itu Bitcoin? Panduan Lengkap untuk Pemula', 'apa-itu-bitcoin-panduan-lengkap-untuk-pemula', 2, '<p>Bitcoin adalah mata uang digital terdesentralisasi pertama yang diciptakan oleh Satoshi Nakamoto. Artikel ini menjelaskan cara kerja, sejarah, dan cara membeli Bitcoin.</p>', 1500, 'public/uploads/posts/1743189553Cryptocurrency_logos.jpg', '2025-03-28 11:51:47', '2025-03-28 12:19:13', NULL, 1),
(2, 'Apa Itu Bitcoin? Panduan Lengkap untuk Pemula', 'apa-itu-bitcoin-panduan-lengkap-untuk-pemula', 2, '<p>Bitcoin adalah mata uang digital terdesentralisasi pertama yang diciptakan oleh Satoshi Nakamoto. Artikel ini menjelaskan cara kerja, sejarah, dan cara membeli Bitcoin.</p>', 1500, 'public/uploads/posts/1743189544Blockchain1.jpg', '2025-03-28 11:52:19', '2025-03-28 12:19:04', NULL, 1),
(3, 'Apa Itu Bitcoin? Panduan Lengkap untuk Pemula', 'apa-itu-bitcoin-panduan-lengkap-untuk-pemula', 2, '<p>Bitcoin adalah mata uang digital terdesentralisasi pertama yang diciptakan oleh Satoshi Nakamoto. Artikel ini menjelaskan cara kerja, sejarah, dan cara membeli Bitcoin.</p>', 1500, 'public/uploads/posts/1743189535Cryptocurrency_logos.jpg', '2025-03-28 11:53:00', '2025-03-28 12:18:55', NULL, 1),
(4, 'Apa Itu 3? Panduan Lengkap untuk Pemula', 'apa-itu-3-panduan-lengkap-untuk-pemula', 2, '<p>3 adalah mata uang digital terdesentralisasi pertama yang diciptakan oleh Satoshi Nakamoto. Artikel ini menjelaskan cara kerja, sejarah, dan cara membeli 3.</p>', 1528, 'public/uploads/posts/1743188842Cryptocurrency_logos.jpg', '2025-03-28 11:58:40', '2025-03-28 15:23:34', NULL, 1),
(5, 'Cara Aman Menyimpan Crypto di Wallet', 'cara-aman-menyimpan-crypto-di-wallet', 3, '<p>Simak panduan memilih wallet crypto (hot vs cold wallet) dan tips keamanan untuk menghindari peretasan.</p>', 3200, 'public/uploads/posts/1743188851Blockchain1.jpg', '2025-03-28 11:58:40', '2025-03-28 12:07:31', NULL, 2),
(6, 'Analisis Pasar: Prediksi Harga 4 Tahun 2024', 'analisis-pasar-prediksi-harga-4-tahun-2024', 6, '<p>Bagaimana prospek 4 pasca-upgrade Shanghai? Berikut analisis faktor teknis dan fundamental yang memengaruhi harganya.</p>', 6001, 'public/uploads/posts/1743201556Blockchain1.jpg', '2025-03-28 11:58:40', '2025-03-28 15:39:16', NULL, 1),
(7, '5 Strategi DCA (Dollar-Cost Averaging) untuk Crypto', '5-strategi-dca-dollar-cost-averaging-untuk-crypto', 4, '<p>DCA adalah metode investasi crypto yang mengurangi risiko volatilitas. Pelajari cara menerapkannya dengan optimal.</p>', 2800, 'public/uploads/posts/1743188867Cryptocurrency_logos.jpg', '2025-03-28 11:58:40', '2025-03-28 12:07:47', NULL, 3),
(8, 'NFT 101: Memahami Konsep dan Potensinya', 'nft-101-memahami-konsep-dan-potensinya', 7, '<p>Apa itu NFT? Bagaimana cara membeli dan menjualnya? Temukan jawabannya di panduan komprehensif ini.</p>', 6000, 'public/uploads/posts/1743188875Cryptocurrency_logos.jpg', '2025-03-28 11:58:40', '2025-03-28 12:07:55', NULL, 2),
(9, 'Update: Regulasi Crypto di Indonesia Terbaru 2024', 'update-regulasi-crypto-di-indonesia-terbaru-2024', 5, '<p>Peraturan Bappebti tentang pajak crypto dan batasan transaksi. Bagaimana dampaknya bagi investor?</p>', 6000, 'public/uploads/posts/1743189495Blockchain1.jpg', '2025-03-28 11:58:40', '2025-03-28 12:18:15', NULL, 1),
(10, 'Review 5 Aplikasi Crypto Terbaik untuk Pemula', 'review-5-aplikasi-crypto-terbaik-untuk-pemula', 8, '<p>Bandingkan fitur Binance, Pintu, Tokocrypto, dan lainnya. Mana yang paling user-friendly?</p>', 2200, 'public/uploads/posts/1743189503Cryptocurrency_logos.jpg', '2025-03-28 11:58:40', '2025-03-28 12:18:23', NULL, 3),
(11, '2 Explained: Teknologi di Balik Crypto', '2-explained-teknologi-di-balik-crypto', 1, '<p>Bagaimana 2 bekerja? Apa bedanya dengan database tradisional? Simak penjelasan sederhananya.</p>', 1800, 'public/uploads/posts/1743189511Blockchain1.jpg', '2025-03-28 11:58:40', '2025-03-28 12:18:31', NULL, 2),
(12, 'Cara Mendeteksi Scam Crypto dan Penipuan', 'cara-mendeteksi-scam-crypto-dan-penipuan', 3, '<p>Kenali tanda-tanda proyek crypto palsu, phishing, dan skema Ponzi untuk melindungi aset Anda.</p>', 6000, 'public/uploads/posts/1743189519Cryptocurrency_logos.jpg', '2025-03-28 11:58:40', '2025-03-28 12:18:39', NULL, 1),
(13, 'Memahami Gas Fee 4 dan Cara Menghematnya', 'memahami-gas-fee-4-dan-cara-menghematnya', 1, '<p>Apa itu Gas Fee? Kapan waktu terbaik untuk bertransaksi di 4? Berikut tipsnya.</p>', 2900, 'public/uploads/posts/1743189526Blockchain1.jpg', '2025-03-28 11:58:40', '2025-03-28 12:18:46', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 4, 3, NULL, NULL),
(2, 4, 9, NULL, NULL),
(3, 4, 1, NULL, NULL),
(4, 5, 6, NULL, NULL),
(5, 5, 8, NULL, NULL),
(6, 5, 10, NULL, NULL),
(7, 6, 4, NULL, NULL),
(8, 6, 5, NULL, NULL),
(9, 6, 7, NULL, NULL),
(10, 7, 5, NULL, NULL),
(11, 7, 10, NULL, NULL),
(12, 7, 7, NULL, NULL),
(13, 8, 2, NULL, NULL),
(14, 8, 4, NULL, NULL),
(15, 8, 9, NULL, NULL),
(16, 9, 1, NULL, NULL),
(17, 9, 10, NULL, NULL),
(18, 9, 1, NULL, NULL),
(19, 10, 1, NULL, NULL),
(20, 10, 9, NULL, NULL),
(21, 10, 10, NULL, NULL),
(22, 11, 2, NULL, NULL),
(23, 11, 1, NULL, NULL),
(24, 11, 9, NULL, NULL),
(25, 12, 8, NULL, NULL),
(26, 12, 10, NULL, NULL),
(27, 12, 7, NULL, NULL),
(28, 13, 4, NULL, NULL),
(29, 13, 2, NULL, NULL),
(30, 13, 10, NULL, NULL);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vyAYwZBIlhbeVksjkfcc95G3TSODRHfPOUhtsU8m', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXkxaVJBZXl4VEoxWGtObEFJajVrTzdpRnM4ZjNQSlpxZ1Rvd3BkRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1743201947);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Cryptocurrency', 'cryptocurrency', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(2, 'Blockchain', 'blockchain', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(3, 'Bitcoin', 'bitcoin', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(4, 'Ethereum', 'ethereum', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(5, 'CryptoTrading', 'cryptotrading', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(6, 'CryptoWallet', 'cryptowallet', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(7, 'CryptoInvestment', 'cryptoinvestment', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(8, 'KeamananCrypto', 'keamanancrypto', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(9, 'BelajarCrypto', 'belajarcrypto', '2025-03-28 11:50:54', '2025-03-28 11:50:54'),
(10, 'TipsCrypto', 'tipscrypto', '2025-03-28 11:50:54', '2025-03-28 11:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `trade_signals`
--

CREATE TABLE `trade_signals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `membership_type` varchar(255) NOT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `membership_type`, `expired_at`, `payment_status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Dandi Hermawan', 'dandihermawan87@gmail.com', 'free', NULL, 'free', NULL, '$2y$12$RP1SBpi5sZBiWl.IvskAvOvmuxZkly6XTTPjGKD8zFvf8ZingtWvK', NULL, '2025-03-27 07:12:29', '2025-03-27 07:12:29', 1),
(2, 'Hikmatul Hasanah', 'hikmah@gmail.com', 'membership_3bulan', '2025-06-27 10:16:24', 'paid', NULL, '$2y$12$4cxr2irpEseXGcDxdWCqTeo0yLcvodBMZOxeq14Ywz1Vx1o9e/Ifa', NULL, '2025-03-27 07:13:44', '2025-03-27 10:16:24', 0),
(3, 'coba verif', 'verif@gmail.com', 'membership_1bulan', '2025-04-27 10:08:24', 'paid', NULL, '$2y$12$xwMGiCmFw5430bnlLEzt6edNUJ3t48476xeqz3RZKrOo1b0ueUfgW', NULL, '2025-03-27 10:05:30', '2025-03-27 10:08:24', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `crypto_news`
--
ALTER TABLE `crypto_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_confirmations`
--
ALTER TABLE `payment_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_confirmations_user_id_foreign` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `trade_signals`
--
ALTER TABLE `trade_signals`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `crypto_news`
--
ALTER TABLE `crypto_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_confirmations`
--
ALTER TABLE `payment_confirmations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trade_signals`
--
ALTER TABLE `trade_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_confirmations`
--
ALTER TABLE `payment_confirmations`
  ADD CONSTRAINT `payment_confirmations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
