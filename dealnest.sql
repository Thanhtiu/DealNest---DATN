-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 12, 2024 lúc 01:40 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dealnest`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `street` text NOT NULL,
  `string_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `address`
--

INSERT INTO `address` (`id`, `province_id`, `district_id`, `ward_id`, `street`, `string_address`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 89, 887, 30397, 'vĩnh tường 2', 'An Giang , Tân Châu , Châu Phong', '2024-09-08 19:05:01', '2024-09-08 19:05:01', 2),
(2, 89, 886, 30337, 'hem1', 'An Giang , An Phú , An Phú', '2024-09-10 17:44:18', '2024-09-10 17:44:18', 4),
(3, 77, 748, 26566, 'hem9', 'Bà Rịa - Vũng Tàu , Bà Rịa , Kim Dinh', '2024-09-11 00:58:13', '2024-09-11 00:58:13', 5),
(4, 89, 893, 30649, 'lê lợi', 'An Giang , Chợ Mới , Kiến Thành', '2024-09-11 14:16:37', '2024-09-11 14:16:37', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kích cỡ', NULL, NULL),
(2, 'Mau sac', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Việt Nam', 1, 'viet-nam', NULL, NULL),
(2, 'Trung Quốc', 1, 'trung-quoc', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `url`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Thời trang nam', 1, 'url', 'thoi-trang-nam', NULL, NULL),
(2, 'Thời trang nữ', 1, 'url', 'thoi-trang-nu', NULL, NULL),
(3, 'Công nghệ', 1, 'url', 'cong-nghe', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
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
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_23_153257_create_address_table', 1),
(5, '2024_08_24_162941_update_users_table', 1),
(6, '2024_08_24_163840_create_sellers_table', 1),
(7, '2024_08_24_164142_create_buyers_table', 1),
(8, '2024_08_24_164341_create_categories_table', 1),
(9, '2024_08_24_164646_create_subcategories_table', 1),
(10, '2024_08_24_165119_create_brand_table', 1),
(11, '2024_08_24_165536_create_products_table', 1),
(12, '2024_08_24_165926_create_product_images_table', 1),
(13, '2024_08_24_170328_create_reviews_table', 1),
(14, '2024_08_24_170734_create_review_images_table', 1),
(15, '2024_08_24_171321_create_orders_table', 1),
(16, '2024_08_24_171450_create_order_items_table', 1),
(17, '2024_08_24_172050_create_carts_table', 1),
(18, '2024_08_24_172140_create_wishlists_table', 1),
(19, '2024_08_24_172417_create_promotions_table', 1),
(20, '2024_08_24_172543_create_payments_table', 1),
(21, '2024_08_30_134242_add_otp_to_users_table', 1),
(22, '2024_09_04_153232_create_attributes_table', 1),
(23, '2024_09_05_160823_create_product_attributes_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `payment_method` enum('cod','momo','vnpay') NOT NULL DEFAULT 'cod',
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_item` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `method` enum('cod','vnpay','momo') NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `momo_transaction_id` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `favourite` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `seller_id`, `category_id`, `subcategory_id`, `brand_id`, `name`, `description`, `price`, `quantity`, `favourite`, `rating`, `sales`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, 1, 'Áo Tottenham', 'mô tả', 500000.00, 23, NULL, NULL, 25, 0, '2024-09-10 13:47:18', '2024-09-10 13:47:18'),
(6, 1, 2, 3, 1, 'Iphone 15 promax', 'mô tả', 200000.00, 500, NULL, NULL, 12, 0, '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(8, 3, 3, 5, 1, 'Iphone 15 promax', 'mô tả', 2600000.00, 321, NULL, NULL, 1, 0, '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(9, 2, 3, 5, 1, 'Iphone 15 promax', 'Iphone 15 promax bắn fifai mượt lắm', 2600000.00, 123, NULL, NULL, 1242, 0, '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(11, 4, 3, 5, 1, 'sản phẩm test', 'mô tả', 7887.00, 345, NULL, NULL, 234534, 0, '2024-09-11 14:52:46', '2024-09-11 14:52:46'),
(12, 4, 3, 5, 1, 'lkjsdf', 'lkjd', 123.00, 123, NULL, NULL, 7444, 0, '2024-09-11 16:26:11', '2024-09-11 16:26:11'),
(13, 4, 1, 1, 1, 'lkjsdf', 'motar', 123.00, 123, NULL, NULL, 45, 0, '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(14, 4, 2, 4, 1, 'sdf', 'mô tả', 1234.00, 1232, NULL, NULL, 99, 0, '2024-09-11 16:29:47', '2024-09-11 16:29:47'),
(15, 4, 2, 3, 1, 'kjhdsf', 'kjsdf', 909.00, 1000, NULL, NULL, 8888, 0, '2024-09-11 16:41:36', '2024-09-11 16:41:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(69, 3, 1, 's', '2024-09-10 17:47:52', '2024-09-10 17:47:52'),
(70, 3, 1, 'l', '2024-09-10 17:47:52', '2024-09-10 17:47:52'),
(71, 3, 1, 'm', '2024-09-10 17:47:52', '2024-09-10 17:47:52'),
(72, 3, 2, 'đỏ', '2024-09-10 17:47:52', '2024-09-10 17:47:52'),
(73, 6, 2, 'đen', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(74, 6, 2, 'xanh', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(75, 6, 2, 'hồng', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(76, 8, 2, 'đen', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(77, 8, 2, 'xanh', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(78, 8, 2, 'trắng', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(79, 9, 2, 'Đen', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(80, 9, 2, 'Trắng', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(81, 9, 2, 'Xanh', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(91, 11, 2, 'đỏ', '2024-09-11 15:09:50', '2024-09-11 15:09:50'),
(92, 13, 1, 'x', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(93, 13, 1, 'l', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(94, 13, 1, 's', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(110, 15, 2, '2', '2024-09-11 18:04:02', '2024-09-11 18:04:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `url`, `created_at`, `updated_at`) VALUES
(8, 3, '1725954438_images (3).jfif', '2024-09-10 13:47:18', '2024-09-10 13:47:18'),
(9, 3, '1725954438_images (2).jfif', '2024-09-10 13:47:18', '2024-09-10 13:47:18'),
(10, 3, '1725954438_tải xuống (8).jfif', '2024-09-10 13:47:18', '2024-09-10 13:47:18'),
(11, 3, '1725954438_tải xuống (7).jfif', '2024-09-10 13:47:18', '2024-09-10 13:47:18'),
(12, 3, '1725968872_tải xuống (3).jfif', '2024-09-10 13:47:18', '2024-09-10 17:47:52'),
(20, 6, '1725987143_vn-11134207-7r98o-llmz8x62m9bw43 (1).jfif', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(21, 6, '1725987143_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(22, 6, '1725987143_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(23, 6, '1725987143_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(24, 6, '1725987143_vn-11134258-7r98o-lzabyo9eybvl2a.png', '2024-09-10 22:52:23', '2024-09-10 22:52:23'),
(25, 8, '1725994796_vn-11134207-7r98o-llmz8x62m9bw43 (1).jfif', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(26, 8, '1725994796_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(27, 8, '1725994796_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(28, 8, '1725994796_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(29, 8, '1725994796_vn-11134258-7r98o-lzabyo9eybvl2a.png', '2024-09-11 00:59:56', '2024-09-11 00:59:56'),
(30, 9, '1726041698_vn-11134207-7r98o-llmz8x62m9bw43 (1).jfif', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(31, 9, '1726041698_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(32, 9, '1726041698_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(33, 9, '1726041698_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(34, 9, '1726041698_vn-11134258-7r98o-lzabyo9eybvl2a.png', '2024-09-11 14:01:38', '2024-09-11 14:01:38'),
(40, 11, '1726044766_images (3).jfif', '2024-09-11 14:52:46', '2024-09-11 14:52:46'),
(41, 11, '1726044766_images (2).jfif', '2024-09-11 14:52:46', '2024-09-11 14:52:46'),
(42, 12, '1726050371_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-11 16:26:11', '2024-09-11 16:26:11'),
(43, 12, '1726050371_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-11 16:26:11', '2024-09-11 16:26:11'),
(44, 12, '1726050371_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-11 16:26:11', '2024-09-11 16:26:11'),
(45, 13, '1726050547_vn-11134207-7r98o-llmz8x62m9bw43 (1).jfif', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(46, 13, '1726050547_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(47, 13, '1726050547_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(48, 13, '1726050547_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(49, 13, '1726050547_vn-11134258-7r98o-lzabyo9eybvl2a.png', '2024-09-11 16:29:07', '2024-09-11 16:29:07'),
(50, 14, '1726050587_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-11 16:29:47', '2024-09-11 16:29:47'),
(51, 14, '1726050587_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-11 16:29:47', '2024-09-11 16:29:47'),
(52, 14, '1726050587_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-11 16:29:47', '2024-09-11 16:29:47'),
(53, 14, '1726050587_vn-11134258-7r98o-lzabyo9eybvl2a.png', '2024-09-11 16:29:47', '2024-09-11 16:29:47'),
(54, 15, '1726051296_vn-11134207-7r98o-llmz8x62p2gs3b.jfif', '2024-09-11 16:41:36', '2024-09-11 16:41:36'),
(55, 15, '1726051296_vn-11134207-7r98o-llmz8x62m9bw43.jfif', '2024-09-11 16:41:36', '2024-09-11 16:41:36'),
(56, 15, '1726051296_vn-11134207-7r98o-llmyzv029xa45f.jfif', '2024-09-11 16:41:36', '2024-09-11 16:41:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review_images`
--

CREATE TABLE `review_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_description` text DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `follow` int(11) DEFAULT NULL,
  `join` date DEFAULT NULL,
  `store_email` varchar(255) NOT NULL,
  `store_phone` varchar(255) NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `store_name`, `store_description`, `rating`, `follow`, `join`, `store_email`, `store_phone`, `address_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'TuStore', NULL, 0.00, NULL, NULL, 'user@gmail.com', '0911411902', 1, '2024-09-08 19:05:01', '2024-09-08 19:05:01'),
(2, 4, 'TuStore', NULL, 0.00, NULL, NULL, 'thanhtu411902@gmail.com', '0393286497', 2, '2024-09-10 17:44:18', '2024-09-10 17:44:18'),
(3, 5, 'Thanh Tú mobile', NULL, 0.00, NULL, NULL, 'user3@gmail.com', '1234567890', 3, '2024-09-11 00:58:13', '2024-09-11 00:58:13'),
(4, 6, 'Vgaming', NULL, 0.00, NULL, NULL, 'tuhttpc06537@fpt.edu.vn', '0393286497', 4, '2024-09-11 14:16:37', '2024-09-11 14:16:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uI0iaUMiN4Ky6YtliNXD604I6EKtLQsGoxRJlu8a', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoidTBnT0YxT0NVR05GNEJIS296WUVCRXhMVWNSWE9ETXV5SVd5OHd3NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZW5oLW5ndW9pLWJhbi90aGVtLXNhbi1waGFtIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjtzOjk6InVzZXJFbWFpbCI7czoyMzoidHVodHRwYzA2NTM3QGZwdC5lZHUudm4iO3M6NjoidXNlcklkIjtpOjY7czo4OiJzZWxsZXJJZCI7aTo0O30=', 1726140591);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `status`, `slug`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'quần ngắn ', 1, 'quan-ngan', 'url', NULL, NULL),
(2, 1, 'quần dai ', 1, 'quan-dai', 'url', NULL, NULL),
(3, 2, 'Đầm/váy', 1, 'dam-vay', NULL, NULL, NULL),
(4, 2, 'Áo', 1, 'ao', NULL, NULL, NULL),
(5, 3, 'Điện thoại', 1, 'dien-thoai', 'url', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','seller','buyer') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `google_id` varchar(255) DEFAULT NULL,
  `google_email` varchar(255) DEFAULT NULL,
  `google_image` varchar(255) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `full_name`, `phone`, `image`, `role`, `is_active`, `google_id`, `google_email`, `google_image`, `otp`) VALUES
(2, 'user1', 'user@gmail.com', NULL, '', NULL, NULL, NULL, '', '', NULL, '', 1, NULL, NULL, NULL, NULL),
(4, 'tu', 'thanhtu411902@gmail.com', NULL, '$2y$12$UCYjhHnBWSChMa.8mtcoouvbuWphv332AV3FAgvf5Fkhgf41TFPXm', NULL, '2024-09-10 17:42:09', '2024-09-10 17:42:17', 'tttu', '0393286497', 'default_avt.png', 'buyer', 1, NULL, NULL, NULL, 405926),
(5, '3', 'user3@gmail.com', NULL, '$2y$12$3/SPyk/CepG8kjINzbI2feSMNCRurp.W6lNzikMp5DZjBA9HxN4ja', NULL, '2024-09-11 00:52:55', '2024-09-11 00:53:01', 'user3', '1234567890', 'default_avt.png', 'buyer', 1, NULL, NULL, NULL, 612476),
(6, 'aaaâ', 'tuhttpc06537@fpt.edu.vn', NULL, '$2y$12$htWnQN9zU.a85dsl3IT7u.9gsR28aNcsmrDb3Hq8AGI8KP8s2EZoO', NULL, '2024-09-11 14:10:45', '2024-09-11 14:10:54', 'ttaaaâ', '0393286497', 'default_avt.png', 'buyer', 1, NULL, NULL, NULL, 211159);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_user_id_foreign` (`user_id`),
  ADD KEY `buyers_address_id_foreign` (`address_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_seller_id_foreign` (`seller_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_buyer_id_foreign` (`buyer_id`);

--
-- Chỉ mục cho bảng `review_images`
--
ALTER TABLE `review_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_images_review_id_foreign` (`review_id`);

--
-- Chỉ mục cho bảng `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`),
  ADD KEY `sellers_address_id_foreign` (`address_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_buyer_id_foreign` (`buyer_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `review_images`
--
ALTER TABLE `review_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `buyers`
--
ALTER TABLE `buyers`
  ADD CONSTRAINT `buyers_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `buyers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `review_images`
--
ALTER TABLE `review_images`
  ADD CONSTRAINT `review_images_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
