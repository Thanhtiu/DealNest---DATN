-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 18, 2024 lúc 10:14 PM
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
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `address`
--

INSERT INTO `address` (`id`, `province_id`, `district_id`, `ward_id`, `street`, `string_address`, `created_at`, `updated_at`, `user_id`, `active`) VALUES
(1, 77, 750, 26578, 'hem9 nguyen van linh', 'Bắc Kạn, Ba Bể, Đồng Phúc', '2024-09-14 17:25:13', '2024-09-17 14:21:02', 2, 0),
(2, 89, 886, 30361, 'hem9 nguyen van linh', 'An Giang, An Phú, Vĩnh Lộc', '2024-09-14 23:58:38', '2024-09-14 23:58:38', 3, 0),
(3, 24, 213, 7696, 'hem9 nguyen van linh', 'Bắc Giang, Bắc Giang, Đồng Sơn', '2024-09-15 00:00:37', '2024-09-15 00:00:37', 3, 0),
(4, 24, 213, 7696, 'hem9 nguyen van linh', 'Bắc Giang, Bắc Giang, Đồng Sơn', '2024-09-15 00:02:09', '2024-09-15 00:02:09', 3, 0),
(6, 89, 889, 30487, 'hẻm 69', 'An Giang, Châu Phú, Bình Mỹ', '2024-09-15 02:01:39', '2024-09-15 02:01:39', 3, 0),
(7, 74, 719, 25819, 'hẻn1', 'Bình Dương, Bàu Bàng, Cây Trường II', '2024-09-15 02:05:32', '2024-09-15 02:05:32', 3, 0),
(8, 95, 959, 31951, 'hem9 nguyen van linh', 'Bạc Liêu, Hồng Dân, Ngan Dừa', '2024-09-15 12:32:35', '2024-09-17 14:21:23', 2, 1),
(13, 95, 959, 31945, 'hem9 nguyen van linh', 'Bạc Liêu , Giá Rai , Hộ Phòng', '2024-09-15 15:53:51', '2024-09-15 19:37:27', 5, 1),
(14, 2, 33, 1117, '98', 'Hà Giang , Xín Mần , Trung Thịnh', '2024-09-16 21:13:34', '2024-09-16 21:13:34', 6, 0),
(15, 77, 750, 26574, 'le loi', 'Bà Rịa - Vũng Tàu , Châu Đức , Bàu Chinh', '2024-09-16 21:15:36', '2024-09-16 21:15:36', 6, 0),
(16, 27, 263, 9490, 'hem1', 'Bắc Ninh , Gia Bình , Đại Bái', '2024-09-17 00:02:56', '2024-09-17 00:02:56', 7, 0),
(18, 89, 886, 30355, 'hem1', 'An Giang, An Phú, Phú Hội', '2024-09-17 16:03:53', '2024-09-17 16:03:53', 9, 1),
(19, 24, 223, 7885, 'hen9', 'Bắc Giang , Hiệp Hòa , Mai Đình', '2024-09-17 16:08:12', '2024-09-17 16:08:12', 9, 0);

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
(1, 'Kích thước', '2024-09-14 17:18:27', '2024-09-14 17:18:49'),
(2, 'Màu sắc', '2024-09-14 17:19:05', '2024-09-14 17:19:05');

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
(1, 'Trung Quốc', 1, 'trung-quoc', NULL, NULL),
(2, 'Việt Nam', 1, 'viet-nam', NULL, NULL),
(3, 'Hàn Quốc', 1, 'han-quoc', NULL, NULL);

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

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1726312946),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1726312946;', 1726312946),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1726566938),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1726566938;', 1726566938),
('c1dfd96eea8cc2b62785275bca38ac261256e278', 'i:1;', 1726502328),
('c1dfd96eea8cc2b62785275bca38ac261256e278:timer', 'i:1726502328;', 1726502328);

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
  `total_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `total_price`, `quantity`, `created_at`, `updated_at`) VALUES
(9, 4, 2, 495000.00, 3, '2024-09-19 01:50:38', '2024-09-19 01:50:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(12, 9, 1, 'L', '2024-09-19 01:50:38', '2024-09-19 01:50:38'),
(13, 9, 2, 'Be', '2024-09-19 01:50:38', '2024-09-19 01:50:38');

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
(1, 'Thời trang nam', 1, 'categories/01J7XQT6ZEDJ83XPSMXBG4E06T.webp', 'thoi-trang-nam', '2024-09-14 17:21:31', '2024-09-16 21:39:30'),
(2, 'Trang trang nữ', 1, 'categories/01J7XQVF5DHJP66CZ2FMXB4YMJ.webp', 'thoi-trang-nu', NULL, '2024-09-16 21:40:07'),
(3, 'Phụ kiện & Điện Thoại', 1, 'categories/01J7XQYQCA731K8TD65A24AA22.webp', 'phu-kien-dien-thoai', '2024-09-16 21:41:53', '2024-09-16 21:41:53'),
(4, 'Mẹ & Bé', 1, 'categories/01J7XQZVKKD8NM69M7SM6CNSN7.webp', 'me-be', '2024-09-16 21:42:31', '2024-09-16 21:42:31'),
(5, 'Thiết Bị Điện Tử', 1, 'categories/01J7XR1SKY32FVHGHQ26CTDR2C.webp', 'thiet-bi-dien-tu', '2024-09-16 21:43:34', '2024-09-16 21:45:42'),
(6, 'Máy Tính & Laptop', 1, 'categories/01J7XR70R6TMQCJC00H1B0TP9B.webp', 'may-tinh-laptop', '2024-09-16 21:46:25', '2024-09-16 21:46:25'),
(7, 'Nhà Cửa & Đời Sống', 1, 'categories/01J7XR8AHCHABBDSSWASD8PH19.webp', 'nha-cua-doi-song', '2024-09-16 21:47:08', '2024-09-16 21:47:08'),
(8, 'Sắc Đẹp', 1, 'categories/01J7XR9DFNTJ20EJCJJC3H65FB.webp', 'sac-dep', '2024-09-16 21:47:44', '2024-09-16 21:47:44'),
(9, 'Máy Ảnh & Máy Quay Phim', 1, 'categories/01J7XRATRD9BKZN9JX47KWQCSA.webp', 'may-anh-may-quay-phim', '2024-09-16 21:48:30', '2024-09-16 21:48:30'),
(10, 'Sức Khỏe', 1, 'categories/01J7XRC20C2EM40SJ2AXJQ5GZ8.webp', 'suc-khoe', '2024-09-16 21:49:10', '2024-09-16 21:49:10'),
(11, 'Đồng Hồ', 1, 'categories/01J7XRCXKP1Y9M65R87YCKJFGG.webp', 'dong-ho', '2024-09-16 21:49:39', '2024-09-16 21:49:39'),
(12, 'Giày Dép Nữ', 1, 'categories/01J7XRDXDTSJ5V3SAVTQ20G262.webp', 'giay-dep-nu', '2024-09-16 21:50:11', '2024-09-16 21:50:11'),
(13, 'Giày Dép Nam', 1, 'categories/01J7XRES93KHHJH78GSWQWWZJM.webp', 'giay-dep-nam', '2024-09-16 21:50:40', '2024-09-16 21:50:40'),
(14, 'Túi Ví Nữ', 1, 'categories/01J7XRGH8Y3KD42N1YZ6RSBW31.webp', 'tui-vi-nu', '2024-09-16 21:51:37', '2024-09-16 21:51:37'),
(15, 'Thiết Bị Gia Dụng', 1, 'categories/01J7XRJ3DBXYMHKENF3V99DZTT.webp', 'thiet-bi-gia-dung', '2024-09-16 21:52:28', '2024-09-16 21:52:28'),
(16, 'Phụ Kiện & Trang Sức Nữ', 1, 'categories/01J7XRM14HMD9BP4ZWJ32XH7BM.webp', 'phu-kien-trang-suc-nu', '2024-09-16 21:53:32', '2024-09-16 21:53:32'),
(17, 'Thể Thao & Du Lịch', 1, 'categories/01J7XRMV16GF895C6Q10GD1YT5.webp', 'the-thao-du-lich', '2024-09-16 21:53:58', '2024-09-16 21:56:15'),
(18, 'Bách Hóa Online', 1, 'categories/01J7XRSN4X8HYMEPMK6TREJ94A.webp', 'bach-hoa-online', '2024-09-16 21:56:36', '2024-09-16 21:56:36'),
(19, 'Ô Tô & Xe Máy Xe Đạp', 1, 'categories/01J7XRTW3CR4YGY7TSXCKS8ZZT.webp', 'o-to-xe-may-xe-dap', '2024-09-16 21:57:16', '2024-09-16 21:57:16'),
(20, 'Nhà Sách Online', 1, 'categories/01J7XRVZBVNA4K9D5R9V5YDESF.webp', 'nha-sach-online', '2024-09-16 21:57:52', '2024-09-16 21:57:52');

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
(17, '2024_08_24_172140_create_wishlists_table', 1),
(18, '2024_08_24_172417_create_promotions_table', 1),
(19, '2024_08_24_172543_create_payments_table', 1),
(20, '2024_08_30_134242_add_otp_to_users_table', 1),
(21, '2024_09_04_153232_create_attributes_table', 1),
(22, '2024_09_05_160823_create_product_attributes_table', 1),
(23, '2024_09_12_123509_update_status_column_in_products_table', 1),
(24, '2024_09_13_184202_create_cart_table', 1),
(25, '2024_09_14_160141_update_status_column_in_adress', 2),
(26, '2024_09_16_081517_add_cccd_to_sellers_table', 3),
(27, '2024_09_16_081855_update_sellers_table_add_cccd', 4),
(28, '2024_09_16_100026_update_sellers_table_add_cccd', 5),
(29, '2024_09_18_171619_add_image_to_products_table', 6);

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
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `favourite` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `status` enum('Chờ phê duyệt','Đã phê duyệt','Từ chối') NOT NULL DEFAULT 'Chờ phê duyệt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `seller_id`, `category_id`, `subcategory_id`, `brand_id`, `name`, `description`, `price`, `image`, `quantity`, `favourite`, `rating`, `sales`, `status`, `created_at`, `updated_at`, `note`) VALUES
(4, 4, 1, 6, 1, 'Áo khoác nam nữ chất dạ Hàn', '<p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Bảng size bên shop các bạn tham khảo ạ:</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Size M &nbsp; : Dành cho người cao từ: 1m47 - 1m57 và nặng từ &nbsp;45kg - 55kg</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Size L &nbsp; &nbsp;: Dành cho người cao từ: 1m58 - 1m65 và nặng từ &nbsp;56kg - 62kg</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Size XL : Dành cho người cao từ: 1m66 - &nbsp;1m75 và nặng từ &nbsp;63kg &nbsp;- 80kg</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Bảng size mang tính chất tham khảo bạn có thể lấy size to hơn hoặc nhỏ theo yêu cầu của bạn!</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">I. SHOP CAM KẾT - Sản phẩm Áo Khoác dạ giống mô tả 100% - Hình ảnh sản phẩm là ảnh thật, các hình hoàn toàn do shop tự thiết kế. - Kiểm tra &nbsp;cẩn thận trước khi gói hàng giao cho Quý Khách - Hàng có sẵn, giao hàng ngay khi nhận được đơn - Hoàn tiền nếu sản phẩm không giống với mô tả - Chấp nhận đổi hàng khi size không vừa trong 3 ngày.</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">II. HỖ TRỢ ĐỔI TRẢ THEO QUY ĐỊNH CỦA SHOPEE - Điều kiện áp dụng (trong vòng 2 ngày kể từ khi nhận sản phẩm) - Hàng hoá bị rách, in lỗi, bung chỉ, và các lỗi do vận chuyển hoặc do nhà sản xuất. 1. Trường hợp được chấp nhận: - Hàng giao sai size khách đã đặt hàng - Giao thiếu hàng 2. Trường hợp không đủ điều kiện áp dụng chính sách: - Quá 2 ngày kể từ khi Quý khách nhận hàng - Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của 20SILK - Không thích, không hợp, đặt nhầm mã, nhầm màu,...&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">III. MÔ TẢ SẢN PHẨM Tên sản phẩm : Áo khoác nam nữ chất dạ Hàn cao cấp form rộng dài tay ,hợp mọi thời đại, phong cách Hàn Quốc Chất Liệu: Vải dạ cao cấp Màu Sắc: &nbsp;Đen và be Đặc Tính: &nbsp;Form áo tôn dáng đứng áo dễ phối hợp đồ, chất liệu dày dặn thích hợp vào mùa Thu, Đông, Xuân</span></p>', 165000.00, NULL, 1199741, NULL, NULL, 12123, 'Chờ phê duyệt', '2024-09-16 23:01:34', '2024-09-16 23:15:40', NULL),
(5, 4, 1, 6, 1, 'Áo Khoác Jeans Bò nam nữ Unisex', '<p>Áo Khoác Jeans Bò nam nữ Unisex, áo khoác bò form rộng màu Xanh Đen xám Wash bigsize Avocado</p><p>👉 Mô tả sản phẩm Áo Khoác jean nam nữ Form Rộng, áo khoác bò Unisex Màu Xanh Đen size SML</p><p>&nbsp;- Những mẫu ÁO KHOÁC BÒ NAM từ lâu đã trở nên khá quen thuộc đối với các tín đồ thời trang. Với chất liệu khỏe khoắn, dễ phối đồ, xu hướng ÁO KHOÁC JEAN NAM STREET STYLE bụi bặm đã, đang và sẽ trở thành xu hướng trong nhiều năm tới.</p><p>-Mẫu ÁO KHOÁC JEAN ĐEN BASIC (Black Basic Denim Jackets) có thể coi là mẫu ÁO KHOÁC JEAN phổ biến nhất trong những năm gần đây. Chúng là Items được mọi giới trẻ yêu thích, ưa chuộng diện phối trong mọi hoàn cảnh.&nbsp;</p><p>-Bởi, kiểu áo này khá đơn giản, nhẹ nhàng, dễ mặc, phù hợp với mọi dáng người và mọi tình huống. Dù bạn là mẫu người như thế nào, phong cách ra sao, sản phẩm vẫn mang lại cho bạn vẻ trẻ trung và năng động hiệu quả.</p><p>\r\n</p><p>Cam kết từ Sogeum.store</p><p>️🏅 Shop luôn đặt chất lượng sản phẩm và dịch vụ khách hàng là ưu tiên hàng đầu. Mọi điều chúng tớ làm là VÌ BẠN.</p><p>💯 Sản phẩm Bạn mặc không vừa, Shop hỗ trợ đổi size / đổi màu thoải mái trong 10 ngày</p><p>&nbsp; + Shop có chính sách ĐỔI TẬN NHÀ, bạn không cần đi gửi hàng ở bưu cục. Shop hỗ trợ phần lớn chi phí, bạn hỗ trợ shop một phần nhỏ thui ạ. (Bạn Inbox cho shop để shop hướng dẫn chi tiết hơn)</p><p>💯 Nếu Bạn không ưng vì bất kỳ lý do gì Bạn đều được Trả lại sản phẩm, Shop hoàn lại tiền cho Bạn.</p><p>&nbsp; &nbsp;+ Mọi chi phí trả lại shop sẽ chi trả ạ. (Bạn nhớ Inbox ngay cho shop ạ)</p><p>💯 Nếu sản phẩm Bạn nhận được bị lỗi hoặc bị nhầm hay thiếu thì Shop luôn sẵn sàng gửi sản phẩm mới đổi MIỄN PHÍ hoặc GỬI BÙ hay HOÀN TIỀN cho Bạn! (Bạn nhớ quay lại video hoặc chụp hình đơn hàng trước khi khui gói hàng ạ)</p><p>\r\n</p><p>🌈 Hướng Dẫn Chọn Size Áo Khoác Jean Nữ Form Rộng</p><p>Size M: từ 40 - 55kg, Cao 1m55 - 1m67</p><p>Size L: từ 56 - 62kg , Cao 1m63 - 1m72</p><p>Size XL: từ 63 - 72kg, Cao 1m65 - 1m78</p><p>Size XXL từ &nbsp;73- 83kg , Cao 1m 75-1m85</p><p>\r\n</p><p>VÌ ÁO FORM KHÁ RỘNG, BẠN LƯU Ý NÊN CHỌN ĐÚNG SIZE, TRƯỜNG HỢP MUỐN MẶC RỘNG HƠN CÓ THỂ CỘNG THÊM 1 SIZE Ạ (CHAT NGAY với Shop để Shop tư vấn size cho bạn nhé)</p><p>- Form Unisex nên cả nam và nữ đều mặc được ạ</p><p>- Đường kim mũi chỉ cẩn thận, chắc chắn</p><p>- Sản phẩm cắt chỉ rất tỉ mỉ, gần như không có chỉ thừa</p><p>🥑 Shop luôn bỏ sản phẩm ra kiểm tra lại trước khi đóng gói (gần như rất rất ít đơn vị khác làm công đoạn này)</p><p>Nên sản phẩm bạn nhận được gần như không có lỗi</p><p>🌼 Hình chi tiết sản phẩm Shop tự chụp</p><p>Áo Khoác jean nam nữ Form Rộng, áo khoác bò Unisex Màu Xanh Đen size SML - Sogeum</p><p>#gogeum.store #aokhoacjean #aokhaocunisex #jacketjeansunisex #aokhoacnuunisex #aokhoacjeans #aokhoacjeannu #aokhoacbo #aokhoacbonu #aokhoacnu #aokhoacjean #aokhoacnam #aobo #aojean #aoDenim # aoJackets #aohanquoc #thoitrangunisex</p><p>#aojeannam #aobonam #aojeansnu #aobonu&nbsp;</p><p>áo jean nam nữ áo bò nam nữ áo khoác jeans namnu</p><p>áo jean nam</p><p>áo bò nam</p><p>áo khoác jean nam</p><p>áo denim nam</p><p>áo khoác bò nam nữ</p><p>áo mùa đông</p>', 197200.00, NULL, 23432, NULL, NULL, 33223, 'Chờ phê duyệt', '2024-09-16 23:23:00', '2024-09-16 23:23:00', NULL),
(6, 4, 1, 6, 2, 'Magee Mới Áo Khoác Tay Dài Cổ Đứng', '<p>Chào mừng đến với cửa hàng của chúng tôi, Magee</p><p>🌸 Theo dõi cửa hàng để nhận phiếu giảm giá</p><p>------------------------------------------------------</p><p>💗 &nbsp;Gói sẽ được vận chuyển từ Trung Quốc.</p><p>💗 Nếu bạn thích sản phẩm của chúng tôi, vui lòng thêm nó vào giỏ hàng của bạn. Cảm ơn bạn.</p><p>💗 Cập nhật tin tức mới nhất từ cửa hàng của chúng tôi. Chúng tôi sẽ gửi cho bạn phiếu giảm giá và giảm giá.</p><p>-Kiểm Tra chi tiết, màu sắc và kích thước sản phẩm trước khi đặt hàng. Chúng tôi không chấp nhận đơn đặt hàng không chính xác.</p><p>* * * * Vui lòng kiểm tra màu sắc, số lượng đặt hàng và địa chỉ để đảm bảo giao hàng nhanh chóng * * *</p><p>* * * Nếu sản phẩm có lỗi, lỗi màu, lỗi kiểu máy... Vui lòng thông báo cho nhà cung cấp trước khi nhấp vào ngôi sao hoặc xem sản phẩm. Cửa hàng của chúng tôi chịu trách nhiệm cho mọi tình huống *</p><p>📌 Hủy đơn đặt hàng trước khi đặt. 📌</p><p>-----------------------------</p><p>🌟🌟🌟🌟🌟 Đánh giá và nhận phiếu giảm giá</p><p>📣 &nbsp;Cửa hàng cung cấp nhiều loại sản phẩm thời trang</p>', 251000.00, NULL, 3452, NULL, NULL, 112, 'Chờ phê duyệt', '2024-09-16 23:27:10', '2024-09-16 23:36:02', 'Sản phẩm đạt yêu cầu'),
(8, 4, 1, 9, 2, 'Aokang dành cho nam giới Retro', '<p>Phong cách: Hàn Quốc</p><p>Loại quần: thẳng</p><p>Chiều dài quần: quần chín điểm</p><p>Loại eo: giữa eo</p><p>Cho dù có thắt lưng: Với thắt lưng</p><p>Quần Placket: đóng dây buộc</p><p>Độ dày: Phần mỏng</p><p>Mô hình: trơn</p><p>Cho mùa: Mùa hè</p><p>Phù hợp với đám đông: thanh thiếu niên</p><p>Thành phần vải chính: Sợi polyester (polyester)</p><p>Hàm lượng các thành phần vải chính: 100 (%)</p><p>Cảnh áp dụng: giải trí</p><p>Kiểu cổ tay áo quần: thẳng</p><p>Quy trình: xử lý không sắt</p><p>Chi tiết phong cách: Nhiều túi</p><p>Độ đàn hồi: Không đàn hồi</p><p>Màu: Đen, Kaki, Xám</p><p>Kích thước: S, M, L, XL, 2XL, 3XL</p><p>Chào mừng đến với cửa hàng Aokang</p><p>\r\n</p><p>Chúng tôi chỉ muốn mang đến cho bạn những sản phẩm tốt nhất, hợp thời trang nhất, chất lượng tốt nhất và rẻ nhất.</p><p>Thời trang là một phần của không khí hàng ngày và nó luôn thay đổi theo mọi sự kiện.!</p><p>Hãy bắt đầu mua sắm vui vẻ!</p><p>\r\n</p><p>Cửa hàng Aokang tập trung vào hướng phát triển và xu hướng quần áo thời trang, có khả năng thiết kế và phong cách thiết kế riêng, thế mạnh xưởng sản xuất mạnh mẽ, được khách hàng vô cùng yêu thích ~ ~</p><p>\r\n</p><p>Cửa hàng Aokang mang đến cho bạn màu sắc của thế giới, dịch vụ trước và sau bán hàng hoàn hảo, để tất cả những ai biết đến chúng tôi đều cảm động và thu hoạch ~ ~</p><p>\r\n</p><p>#aokangdian Thời trang thực sự rất đơn giản</p><p>\r\n</p><p>Mẹo mua:</p><p>1. Nếu bạn muốn chọn một kích thước, vui lòng tham khảo biểu đồ kích thước. Nếu bạn không chắc mình đang mặc size gì, bạn có thể cung cấp chiều cao và cân nặng của mình và chúng tôi sẽ tư vấn chuyên nghiệp cho bạn.</p><p>2. Tất cả các sản phẩm sẽ được vận chuyển từ Trung Quốc trong vòng 48 giờ sau khi đặt hàng. Sau đó, nó sẽ được giao cho bạn trong vòng 5 đến 10 ngày 🚚🚚🚚. Sau khi chúng tôi chuyển hàng, hệ thống hậu cần sẽ không hiển thị rằng hàng hóa đã được vận chuyển ngay lập tức, vì hàng hóa này sẽ được gửi đến kho trung chuyển quốc tế trước. Sau khi nhân viên kho giao những mặt hàng này, hệ thống sẽ cập nhật thông tin hậu cần. Hãy kiên nhẫn ~ ~ Cảm ơn bạn</p><p>3. Nếu không thể mở được các lỗ thùa của quần jean hoặc quần áo denim, xin đừng lo lắng. Chúng không phải là sản phẩm bị lỗi chưa hoàn thành. Tất cả quần jean hoàn toàn mới từ Trung Quốc đại lục đảm bảo tính toàn vẹn của sản phẩm ở mức độ cao nhất, và sẽ không có lỗ mở ngẫu nhiên!</p><p>4. Chúng tôi sẽ kiểm tra cẩn thận trước khi giao hàng, nhưng đôi khi nó sẽ bị bỏ lỡ. Ví dụ: bạn phát hiện ra lỗi, thiếu sót và các vấn đề chất lượng sau khi nhận được hàng. Vui lòng liên hệ với chúng tôi càng sớm càng tốt. Chúng tôi chân thành và có trách nhiệm ~ ~</p><p>5. Nếu bạn hài lòng với sản phẩm và dịch vụ của chúng tôi, xin vui lòng cho chúng tôi 5 sao ⭐⭐⭐⭐⭐Cảm ơn bạn đã ủng hộ và chúc bạn một cuộc sống hạnh phúc ~ ~ ~</p><p>Mọi điểm đều quan trọng đối với cửa hàng của chúng tôi. Cảm ơn tất cả các khách hàng đã thích&nbsp;</p><p>Chúng tôi sẽ luôn có những sản phẩm mới. Hãy tiếp tục chú ý đến tin tức mới nhất của chúng tôi. Chúng tôi sẽ gửi cho bạn phiếu giảm giá và giảm giá sản phẩm.</p><p>6.🔥 Rất QUAN TRỌNG: Vui lòng kiểm tra xem số điện thoại và địa chỉ của bạn có chính xác không. Nếu có lỗi trước khi nhấp vào đơn đặt hàng, chúng tôi không thể thay đổi hoặc sửa đổi bất cứ điều gì 🔥</p><p>\r\n</p><p>Lời khuyên chú ý:</p><p>Bởi vì các phương pháp đo lường khác nhau, cho phép sai số 2-5 cm, và phạm vi lỗi không phải là vấn đề chất lượng!</p><p>Lưu ý: Chúng tôi vận chuyển từ Trung Quốc đại lục. Kích thước khác với Philippines. Bạn có thể kiểm tra kích thước khi đặt hàng để tránh những tổn thất không đáng có. Cảm ơn!!</p><p>Chúng tôi biết rằng sản phẩm của chúng tôi không thể làm hài lòng tất cả mọi người. Nếu bạn phát hiện thấy vấn đề, bạn có thể liên hệ với chúng tôi, tôi tin rằng chúng tôi có thể giải quyết vấn đề cho bạn. Chúng tôi ở đây để phục vụ bạn.</p><p>Chúc một ngày tốt lành!</p>', 99000.00, NULL, 21, NULL, NULL, 112125, 'Chờ phê duyệt', '2024-09-16 23:40:27', '2024-09-16 23:40:27', NULL),
(9, 4, 1, 9, 1, 'Quần âu nam ống rộng JONATO', '<p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Quần âu nam ống rộng JONATO, &nbsp;quần nam ống suông phong cách hàn quốc trẻ trung năng động.</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Thông Tin Sản Phẩm : Quần âu dáng suông rộng thiết kế phá cách phần ống rộng to hàn quốc , phần cạp được thiết kế cạp tạo cảm giác thoải mái khi ngồi. - 4 màu :&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Đen , Kem , Nâu, Trắng - 5 Size Size 28 : Cân nặng 45-53kg, cao 1m60 - 1m67 / Chiều dài quần 93cm, vòng bụng 75cm, ống suông 21cm Size 29 : Cân nặng 54-59kg, cao 1m63 - 1m70 / Chiều dài quần 94cm, vòng bụng 78cm, ống suông 22cm Size 30 : Cân nặng 60-65kg, cao 1m66 - 1m75 / Chiều dài quần 97cm, vòng bụng 81cm, ống suông 22cm Size 31 : Cân nặng 66-71kg, cao 1m69 - 1m77 / Chiều dài quần 99cm, vòng bụng 84cm, ống suông 23cm Size 32 : Cân nặng 72-75kg, cao 1m72 - 1m82 / Chiều dài quần 101cm, vòng bụng 87cm, ống suông 23cm ------------------------------</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">&nbsp;Loại : Quần Âu , Tây âu Nam dáng suông Chất Liệu : Vải vinteck Cao Cấp Thương Hiệu : JONATO Thích Hợp : 4 Mùa ------------------------------ THÔNG TIN SẢN PHẨM - Phom dáng đơn giản, không quá kén dáng người mặc là một trong những yếu tố giúp bộ trang phục này luôn hợp thời trang với phong cách hiện đại. - &nbsp;Bộ thời trang có màu sắc thanh lịch cùng chất liệu cao cấp là một gợi ý hoàn hảo cho các quý khách theo đuổi vẻ đẹp sang trọng, tinh tế. - Chất liệu vải co giãn nhẹ giúp thoải mái trong mọi hoạt động, vải mềm mịn, không nhăn, không bai màu, ít xù lông, ít bám bụi, giữ dáng không bai.</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">- Thiết kế thời trang, đơn giản nhưng luôn tạo được ấn tượng đặc biệt đối với người nhìn. - Chất liệu vải may đẹp, chắc chắn, đường may tỉ mỉ, hiện đại. - Xuất xứ Chính Hãng, được sản xuất tại nhà máy và phân phối trực tiếp đến tay người tiêu dùng</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">&nbsp;=&gt; Cam kết giá thành và chất lượng sản phẩm luôn tốt Top thị trường. - Quý Khách hãy \"THẢ TIM\" cho sản phẩm để nhận được Khuyến mãi ạ ~~ - Nhấn \"THEO DÕI\" Shop để thường xuyên cập nhật các sản phẩm mới nhất với giá ưu đãi Hỗ trợ tư vấn ~ Đổi trả sản phẩm khi gặp lỗi Bộ phận chăm sóc khách hàng 24/7</span></p>', 150000.00, NULL, 345, NULL, NULL, 1213, 'Chờ phê duyệt', '2024-09-16 23:44:09', '2024-09-16 23:44:53', NULL),
(10, 4, 3, 19, 1, 'Ốp điện thoại  Man Cặp đôi Vỏ điện thoại', '<p>&nbsp;Chào mừng đến với Bananas</p><p>&nbsp;🌞 Tất cả các sản phẩm của chúng tôi có hàng, chúng tôi sẽ giao hàng trong vòng 72 giờ kể từ khi nhận được đơn đặt hàng của bạn</p><p>&nbsp;🚚Chúng tôi gửi từ Trung Quốc, nó thường mất 7-15 ngày để đến nơi.</p><p>&nbsp;🚀 Nếu bạn có bất kỳ câu hỏi nào về hàng hóa bạn nhận được, vui lòng liên hệ với chúng tôi</p><p>&nbsp;🎁 Chấp nhận bán lẻ, bán buôn và bán hàng trực tiếp</p><p>&nbsp;💖Mua sắm vui vẻ!💖</p><p>&nbsp;</p><p>&nbsp;☆☆☆Mô TẢ Sản phẩm☆☆☆</p><p>&nbsp;💕Thương hiệu: Bananas</p><p>&nbsp;💕Loại: Vỏ điện thoại</p><p>&nbsp;💕Chức năng: Chống va đập</p><p>&nbsp;💕Chất liệu: Silicon</p><p>&nbsp;💕Màu: Y1 Y2 Y3 Y4 Y5</p><p>&nbsp;💕Mẫu điện thoại:</p><p>&nbsp;Mẹo: iPhone 7 = iPhone 8 = iPhone SE2020,</p><p>&nbsp;Iphone 7Plus = iPhone 8Plus,</p><p>&nbsp;Iphone X = iPhone XS,</p><p>&nbsp;Iphone 7,</p><p>&nbsp;Iphone 8,</p><p>&nbsp;Iphone SE2020,</p><p>&nbsp;Iphone 7Plus,</p><p>&nbsp;Iphone 8Plus,</p><p>&nbsp;Iphone X,</p><p>&nbsp;Iphone XS,</p><p>&nbsp;Iphone XR,</p><p>&nbsp;Iphone XS Max,</p><p>&nbsp;Iphone 11,</p><p>&nbsp;Iphone 11 Pro,</p><p>&nbsp;Iphone 11 Pro Max,</p><p>&nbsp;Iphone 12,</p><p>&nbsp;Iphone 12 Pro,</p><p>&nbsp;Iphone 12 Pro Max,</p><p>&nbsp;Iphone 13,</p><p>&nbsp;Iphone 13 Pro,</p><p>&nbsp;Iphone 13 Pro Max,</p><p>&nbsp;Iphone 14,</p><p>&nbsp;Iphone 14 Pro,</p><p>&nbsp;Iphone 14 Plus,</p><p>&nbsp;Iphone 14 Pro Max,</p><p>&nbsp;Iphone 15,</p><p>&nbsp;Iphone 15 Pro,</p><p>&nbsp;Iphone 15 Plus,</p><p>&nbsp;Iphone 15 Pro Max</p><p>&nbsp;💜Lưu Ý: Xin lưu ý rằng sự khác biệt màu sắc nhẹ nên được chấp nhận do ánh sáng và màn hình.</p><p>&nbsp;</p><p>&nbsp;☆☆☆Phản hồi☆☆☆</p><p>&nbsp;Chúng tôi phụ thuộc vào sự hài lòng của khách hàng để thành công. Do đó, phản hồi tích cực của bạn và DSR 5 Điểm là cực kỳ quan trọng đối với chúng tôi. Nếu bạn hài lòng với các mặt hàng của chúng tôi, xin vui lòng dành một phút để lại phản hồi tích cực của bạn. Cảm ơn bạn😘</p>', 3900.00, NULL, 2342, NULL, NULL, 23423, 'Chờ phê duyệt', '2024-09-16 23:49:29', '2024-09-16 23:50:28', NULL),
(11, 4, 3, 19, 2, 'Ốp Mềm Siêu Mỏng Trong Suốt Chống Sốc', '<p>Mô tả sản phẩm:</p><p>🍑🍑Thiết kế vỏ chống sốc \"Bảo vệ toàn thân\", Bảo vệ iPhone của bạn. Nhẹ hơn, mỏng hơn và đẹp hơn.</p><p>🍑“Thiết kế ngoại hình ” Vẻ ngoài thời trang, cá tính và sáng tạo. thoải mái và không làm xước tay của bạn.</p><p>🍑“Tính năng sản phẩm ” Chống bám vân tay, chống xước, chống bụi bẩn, chống rơi rớt.</p><p>🍎Thương hiệu tương thích: Apple iPhone</p><p>Mẫu iPhone tương thích:.</p><p>Iphone 7 8Plus / Xs / XR / 11 / 11 Pro Max / 12 / 12 Pro / 12 Pro Max / 13 / 13 Pro / 13 Pro Max / 14 / 14 Pro / 14 Pro Max / 15 / 15 Pro / 15 Pro Max</p><p>🍐Gói bao gồm 1 x Vỏ điện thoại</p><p>🌰 Nhận xét:</p><p>- Do sự khác biệt giữa các màn hình khác nhau, hình ảnh có thể không phản ánh màu sắc thực tế của mặt hàng.</p><p>- Do đo lường thủ công, xin vui lòng cho phép một số khác biệt nhỏ.</p><p>🌰Dịch vụ của chúng tôi</p><p>1. Giao hàng nhanh chóng trong vòng 1-2 ngày + trả lời nhanh chóng và nhiệt tình + thái độ tích cực;</p><p>2. Giải quyết nhanh chóng vấn đề cho từng khách hàng; Hỗ trợ bán buôn!</p><p>🌰 Phản hồi</p><p>Phản hồi tích cực của bạn và đánh giá 5 sao là rất quan trọng đối với chúng tôi. Nếu bạn hài lòng với sản phẩm của chúng tôi, xin vui lòng dành một chút thời gian để lại phản hồi tích cực của bạn. Cảm ơn.</p>', 10000.00, NULL, 1212, NULL, NULL, 9999, 'Chờ phê duyệt', '2024-09-16 23:58:20', '2024-09-16 23:58:20', NULL),
(12, 5, 3, 17, 1, 'Iphone 15 promax', '<p>Thông số kỹ thuật:</p><p>- 6.7″</p><p>- Màn hình Super Retina XDR</p><p>- Màn hình Luôn Bật</p><p>- Công nghệ ProMotion</p><p>- Titan với mặt sau bằng kính nhám</p><p>- Nút Tác Vụ</p><p>- Dynamic Island</p><p>- Chip A17 Pro với GPU 6 lõi</p><p>- SOS Khẩn Cấp&nbsp;</p><p>- Phát Hiện Va Chạm</p><p>- Pin: Thời gian xem video lên đến 29 giờ</p><p>- USB‑C: Hỗ trợ USB 3 cho tốc độ truyền tải nhanh hơn đến 20x</p><p>&nbsp;</p><p>Camera sau</p><p>- Chính 48MP | Ultra Wide | Telephoto</p><p>- Ảnh có độ phân giải siêu cao (24MP và 48MP)</p><p>- Ảnh chân dung thế hệ mới với Focus và Depth Control</p><p>- Phạm vi thu phóng quang học lên đến 10x</p><p>&nbsp;</p><p>Bộ sản phẩm bao gồm:&nbsp;</p><p>• &nbsp; &nbsp; &nbsp; &nbsp;Điện thoại&nbsp;</p><p>• &nbsp; &nbsp; &nbsp; &nbsp;Dây sạc</p><p>• &nbsp; &nbsp; &nbsp; &nbsp;HDSD Bảo hành điện tử 12 tháng.</p><p>&nbsp;</p><p>Thông tin bảo hành:</p><p>Bảo hành: 12 tháng kể từ ngày kích hoạt sản phẩm.</p><p>Kích hoạt bảo hành tại: https://checkcoverage.apple.com/vn/en/</p><p>&nbsp;</p><p>Hướng dẫn kiểm tra địa điểm bảo hành gần nhất:</p><p>Bước 1: Truy cập vào đường link https://getsupport.apple.com/?caller=grl&amp;locale=en_VN&nbsp;</p><p>Bước 2: Chọn sản phẩm.</p><p>Bước 3: Điền Apple ID, nhập mật khẩu.</p><p>Sau khi hoàn tất, hệ thống sẽ gợi ý những trung tâm bảo hành gần nhất.</p><p>&nbsp;</p><p>Tại Việt Nam, về chính sách bảo hành và đổi trả của Apple, \"sẽ được áp dụng chung\" theo các điều khoản được liệt kê dưới đây:</p><p>&nbsp;</p><p>1) Chính sách chung: https://www.apple.com/legal/warranty/products/warranty-rest-of-apac-vietnamese.html</p><p>&nbsp;</p><p>2) Chính sách cho phụ kiện: https://www.apple.com/legal/warranty/products/accessory-warranty-vietnam.html</p><p>&nbsp;</p><p>3) Các trung tâm bảo hành Apple ủy quyền tại Việt Nam: https://getsupport.apple.com/repair-locations?locale=vi_VN</p><p>&nbsp;</p><p>Qúy khách vui lòng đọc kỹ hướng dẫn và quy định trên các trang được Apple công bố công khai, Shop chỉ có thể hỗ trợ theo đúng chính sách được đăng công khai của thương hiệu Apple tại Việt Nam,</p><p>&nbsp;</p><p>Bài viết tham khảo chính sách hỗ trợ của nhà phân phối tiêu biểu:</p><p>&nbsp;</p><p>https://synnexfpt.com/bao-hanh/chinh-sach-bao-hanh/?agency-group=1&amp;agency-slug=san-pham-apple</p><p>&nbsp;</p><p>&nbsp;Để thuận tiện hơn trong việc xử lý khiếu nại, đơn hàng của Brand Apple thường có giá trị cao, Qúy khách mua hàng vui lòng quay lại Clip khui mở kiện hàng (khách quan nhất có thể, đủ 6 mặt) giúp Shopee có thêm căn cứ để làm việc với các bên và đẩy nhanh tiến độ xử lý giúp Qúy khách mua hàng.</p>', 30390000.00, NULL, 11, NULL, NULL, 456, 'Chờ phê duyệt', '2024-09-17 00:04:44', '2024-09-17 00:05:41', NULL),
(13, 1, 3, 18, 1, 'Sạc dự phòng 20000mAh 10000mAh', '<p>Sạc dự phòng 20000mAh 10000mAh sạc nhanh pin mini dung lượng lớn có sẵn dây sạc nhiều điện thoại – Natuso XY68</p><p>&nbsp;</p><p>THIẾT KẾ HIỆN ĐẠI VÀ CÁ TÍNH</p><p>Nguyên liệu nhập khẩu cao cấp, tăng độ bền và tính an toàn lên cao</p><p>&nbsp;</p><p>SẠC NHANH PD22,5W</p><p>PIN DUNG LƯỢNG LỚN 20000MAH</p><p>Sạc nhanh 22,5w cho các thiết bị hỗ trợ giao thức sạc nhanh PD, nạp 80% chỉ trong 30 phút</p><p>Sạc dự phòng dung lượng pin lên đến 20000mah có thể sạc cho điện thoại nhiều lần hoặc sạc nhiều thiết bị điện thoại cùng 1 lúc.</p><p>&nbsp;</p><p>ĐẦU RA DÒNG KHÉP KÍN</p><p>22,5W SẠC CỰC NHANH</p><p>Sạc dự phòng siêu nhanh 22,5w với dòng điện thoại hỗ trợ sạc nhanh PD</p><p>Đi kèm với dây sạc để sạc cùng lúc nhiều thiết bị với nhiều cổng kết nối</p><p>&nbsp;</p><p>ĐI KÈM CÁP SẠC TIỆN LỢI</p><p>THÊM CỔNG SẠC CẮM TRỰC TIẾP</p><p>Cáp sạc điện thoại tích hợp sạc nhanh 22,5W giúp sạc đầy 100% pin điện thoại chỉ trong 75 phút</p><p>Ngoài ra, sạc dự phòng được tích hợp cổng USB và Type-C để sử dụng cho nhiều thiết bị với dây cắm khác nhau</p><p>&nbsp;</p><p>MÀN HÌNH KỸ THUẬT SỐ THÔNG MINH</p><p>Sử dụng màn hình Led chất lượng cao, hiển thị thong số chính xác lượng pin còn lại của sạc dự phòng</p><p>&nbsp;</p><p>LƯU TRỮ NĂNG LƯỢNG NHANH HƠN</p><p>CỔNG SẠC ĐẦU VÀO 20W</p><p>Công suất tối đa 20w giúp nạp pin cho sạc dự phòng nhanh hơn</p><p>Sạc đầy nguồn điện di động với chỉ 100 phút</p><p>&nbsp;</p><p>CÓ THỂ CẦM TRỰC TIẾP LÊN MÁY BAY</p><p>Tuân thủ chính xác theo tiêu chuẩn vận chuyển hàng không, có thể mang trực tiếp lên máy bay và du lịch khắp mọi nơi.</p><p>&nbsp;</p><p>*) Thông số kỹ thuật</p><p>• Tên sản phẩm: Pin sạc dự phòng Natuso XY68</p><p>• Màu sắc: Hồng , Tím , Trắng</p><p>• Cổng đầu ra: Type-C (PD3.0), USB,light</p><p>• Cổng đầu vào: USB , Type-C</p><p>• Công suất: 10000mAh 20000mAh</p><p>• Tương thích với tất cả các thiết bị điện thoại và laptop</p><p>• Loại pin: Pin lithium ion polyme</p><p>• Màn hình kỹ thuật số hiện thỉ thông tin</p><p>• Công nghệ: Sạc chống cháy nổ</p><p>&nbsp;</p><p>*) Bộ sản phẩm bao gồm:</p><p>- 1 pin sạc dự phòng 20000mah 10000mah</p><p>- 1 cáp sạc</p><p>&nbsp;</p><p>*) CAM KẾT VỀ CHẤT LƯỢNG VÀ DỊCH VỤ BÁN HÀNG:</p><p>1. Hàng thật như hình.</p><p>2. Xem hàng trước khi thanh toán.</p><p>3. Cung cấp các sản phẩm chất lượng phù hợp với giá tiền</p><p>&nbsp;</p><p>*) QUY ĐỊNH ĐỔI TRẢ:</p><p>Sẵn sàng đổi trả hoặc hoàn lại tiền cho khách hàng trong 72h kể từ ngày nhận hàng cho những lý do sau :</p><p>1. Sản phẩm bị lỗi.</p><p>2. Hư hỏng trong quá trình vận chuyển.</p><p>3. Khách hàng đưa ra lý do hợp lý về sự không hài lòng đối với sản phẩm và được sự đồng ý từ Shop.</p><p>&nbsp;</p><p>*) SẢN PHẨM ĐƯỢC BẢO HÀNH 6 THÁNG</p><p>&nbsp;</p><p>#sacduphong #pinduphong #sacduphongsacnhanh #pinsacduphong #pinduphongsacnhanh #sacduphong20000mah #sacnhanh #20000mah #sacduphongdienthoai #pinduphong20000mah #sacduphongtrongsuot #pinduphongtrongsuot #sacduphongkemdaysac #sacduphongtichhopdaysac #sacpinduphong #10000mAh #cucsacduphong</p>', 123000.00, NULL, 231, NULL, NULL, 45664, 'Chờ phê duyệt', '2024-09-17 13:49:39', '2024-09-17 13:49:58', NULL),
(14, 1, 3, 19, 1, '[Dấu Chân Dây Ngọc] Bộ phụ kiện bảo vệ củ sạc', '<p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Thông tin sản phẩm: - Chất liệu: Viền nhựa dẻo, ôm tay, chống trơn trượt -&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">Màu sắc: Đa dạng, phong cách trẻ trung, hot trend bắt xu hướng</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">- Mực in chất lượng cao,sắc nét, không gây hại cho da - Công dụng: Là phụ kiện thời trang, thay đổi màu sắc cho điện thoại, giữ điện thoại chắc chắn trên tay, an toàn chống trầy xước, bảo vệ chiếc điện thoại khỏi va đập. Hướng dẫn sử dụng sản phẩm</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">- Không nên để ốp lưng dưới sàn nhà, bề mặt sần Mô tả:</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">- Thiết kế dày góc, chống rơi và chống xước. - Bảo vệ kép silicone mềm để cung cấp điện an toàn hơn. - Được thiết kế cho lỗ mở bên, tháo nhiệt hai mặt, thiết kế mở hai mặt, dễ dàng xả nhiệt do điện tạo ra. - Có thể làm sạch nhiều lần mà không bị biến dạng, không đổi màu, tự do giãn, va đập, không dễ biến dạng, có thể tự động bật trở lại, làm sạch nhiều lần mà không tẩy trắng. - Chỉ tương thích với cáp sạc nhanh Iphone và Ipad 18W / 20W và đầu sạc, không thích hợp cho đầu sạc và cáp sạc kiểu cũ! Không bao gồm bộ sạc!! !</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">- Bộ sản phầm bao gồm: 1 bảo vệ củ sạc, 1 bảo vệ đầu cắm sạc, dây cuốn sạc, 1 khoá cáp Xupucase đảm bảo: - Hình ảnh sản phẩm giống 100%. - Chất lượng sản phẩm tốt 100%. - Sản phẩm được kiểm tra kĩ càng, nghiêm ngặt trước khi giao hàng. - Sản phẩm luôn có sẵn trong kho hàng.&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">- Giao hàng ngay khi nhận được đơn hàng. - Hoàn tiền ngay nếu sản phẩm không giống với mô tả. - Giao hàng toàn quốc, nhận hàng thanh toán. - Hỗ trợ đổi trả theo quy định. - Gửi hàng siêu tốc. Với phương châm: \"Bán hàng là phục vụ, uy tín tạo thương hiệu\". Xupucase luôn mong muốn • Mang lại cho quý khách những sản phẩm tốt nhất, đẹp nhất. • Nếu hàng bị lỗi do sản xuất, hoặc lỗi vật lý khi nhận hàng (nếu có video) chúng tôi sẽ đổi lại hàng cho quý khách hàng hoặc hoàn tiền 100%.</span></p>', 13000.00, NULL, 1112, NULL, NULL, 34344, 'Chờ phê duyệt', '2024-09-17 13:55:45', '2024-09-17 21:01:05', 'Sản phẩm đạt yêu cầu'),
(15, 1, 9, 25, 1, 'Thẻ Nhớ microsd', '<p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\"><i><strong>1. T</strong>ính năng sản phẩm: * Chất lượng cao mới 100%</i></span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">&nbsp; * Thiết kế nhỏ gọn, dễ dàng mang theo và sử dụng.&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">* Tốc độ đọc ghi thẻ nhớ, tốc độ truyền tải nhanh, ổn định.&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">* Hoàn toàn tương thích với điện thoại di động, máy tính bảng, DVR gắn trên xe, máy ảnh, v.v.&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">* Thẻ nhớ TF có khả năng chống tia X, chống va đập, chống thấm nước, chống từ tính, chịu lạnh, chịu nhiệt và các đặc tính khác. 2. Đặc điểm kỹ thuật sản phẩm: * Tên sản phẩm: Thẻ nhớ TF * Mô hình: Thẻ TF (Micro-SD) * Điện áp hoạt động: 2.7 ~ 3.6V&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">* Tốc độ truyền: USB3.0 * Tốc độ đọc / ghi: 100 (MB / S) * Loại lưu trữ: Flash * Dung lượng bộ nhớ: 64GB, 128GB, 256GB, 512GB&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">* Thích hợp cho: MP3, điện thoại di động, MP4, camera, loa thẻ, camera hành trình, camera giám sát, UAV, camera chuyển động * Chứng nhận: FCC, CE, BSMI, VCCI&nbsp;</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgba(0,0,0,0.8);\">* Kích thước: 15mm x 11mm x 1.0mm * Trọng lượng: 8g (xấp xỉ) 3. Danh sách đóng gói: 1 * một hộp nhỏ màu trắng 1 * bộ thẻ 1 * THẺ nhớ Lưu ý: 1.Màu sắc thực của mặt hàng có thể hơi khác so với hình ảnh hiển thị trên trang web do nhiều yếu tố như độ sáng của màn hình và độ sáng của ánh sáng. 2.Vui lòng cho phép độ lệch đo lường thủ công nhỏ đối với dữ liệu. #MemoryCard &nbsp;#SDCard &nbsp;#TFCard &nbsp;#Xiaomi &nbsp;#100(Mb / S) &nbsp;#128GB &nbsp;#1TB &nbsp;#256GB &nbsp;#512GB &nbsp;#64GB &nbsp;#8g &nbsp;#FitForMP3/ Mp4 / Điện thoại di động / Camera hành trình / VideoGame &nbsp;#HighQuality &nbsp;#ReadyStock &nbsp;</span></p>', 500000.00, NULL, 5345, NULL, NULL, 5682, 'Chờ phê duyệt', '2024-09-17 14:04:50', '2024-09-17 20:38:21', 'Thông tin sản phẩm không chính xác hoặc không rõ ràng'),
(28, 1, 2, 26, 1, 'sản1', '<p>môtar</p>', 60000.00, NULL, 1, NULL, NULL, NULL, 'Chờ phê duyệt', '2024-09-18 23:54:51', '2024-09-18 23:54:51', NULL),
(29, 1, 2, 26, 1, 'sd', '<p>mo</p>', 12.00, NULL, 1, NULL, NULL, NULL, 'Chờ phê duyệt', '2024-09-19 00:18:07', '2024-09-19 00:18:07', NULL),
(30, 1, 2, 27, 2, 'sdfsd', '<p>mota</p>', 99.00, NULL, 77, NULL, NULL, NULL, 'Chờ phê duyệt', '2024-09-19 00:33:11', '2024-09-19 00:33:11', NULL),
(31, 1, 3, 17, 1, '1', '<p>mota</p>', 121212.00, '1726684706_cn-11134207-7r98o-lyc04uc890fn56@resize_w450_nl.webp', 2, NULL, NULL, NULL, 'Chờ phê duyệt', '2024-09-19 00:38:26', '2024-09-19 00:38:26', NULL),
(32, 1, 2, 27, 1, '23', '<p>sdaf</p>', 1.00, '1726686027_sg-11134201-7rd6a-lug13ws9q7w222@resize_w450_nl.webp', 1, NULL, NULL, NULL, 'Chờ phê duyệt', '2024-09-19 00:52:29', '2024-09-19 01:00:27', NULL),
(33, 1, 2, 27, 1, '2', '<p>mota</p>', 1.00, '1726686294_sg-11134201-7rd49-lug13xa0ytx307@resize_w450_nl.webp', 2, NULL, NULL, NULL, 'Chờ phê duyệt', '2024-09-19 01:04:54', '2024-09-19 01:04:54', NULL);

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
(50, 4, 1, 'M', '2024-09-16 23:16:11', '2024-09-16 23:16:11'),
(51, 4, 1, 'L', '2024-09-16 23:16:11', '2024-09-16 23:16:11'),
(52, 4, 1, 'XL', '2024-09-16 23:16:11', '2024-09-16 23:16:11'),
(53, 4, 1, 'XXL', '2024-09-16 23:16:11', '2024-09-16 23:16:11'),
(54, 4, 2, 'Đen', '2024-09-16 23:16:11', '2024-09-16 23:16:11'),
(55, 4, 2, 'Be', '2024-09-16 23:16:11', '2024-09-16 23:16:11'),
(57, 5, 1, 'M', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(58, 5, 1, 'L', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(59, 5, 1, 'X', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(60, 5, 1, 'XL', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(62, 5, 2, 'Xanh', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(63, 5, 2, 'Đen', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(64, 5, 2, 'Xanh wash', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(65, 6, 1, '1', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(66, 6, 1, 'S', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(67, 6, 1, 'L', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(68, 6, 1, 'M', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(70, 6, 2, 'Đen', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(71, 6, 2, 'Kaki', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(77, 8, 1, 'S', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(78, 8, 1, 'M', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(79, 8, 1, 'XL', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(80, 8, 1, 'XL2', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(81, 8, 2, '2', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(82, 8, 2, 'Đen', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(83, 8, 2, 'Kaki', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(84, 8, 2, 'Xám', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(95, 9, 1, '28', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(96, 9, 1, '29', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(97, 9, 1, '30', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(98, 9, 1, '32', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(99, 9, 2, 'Đen', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(100, 9, 2, 'Kem', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(101, 9, 2, 'Nâu', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(102, 9, 2, 'Trắng', '2024-09-16 23:44:53', '2024-09-16 23:44:53'),
(119, 10, 1, '1', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(120, 10, 1, 'Iphone 13', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(121, 10, 1, 'Iphone 13 promax', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(122, 10, 1, 'Iphone 14', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(123, 10, 1, 'Iphone 14 promax', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(124, 10, 1, 'Iphone 15', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(125, 10, 1, 'Iphone 15 plus', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(126, 10, 1, 'Iphone X', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(127, 10, 1, 'Iphone XSM', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(128, 10, 1, 'Iphone 11 pro', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(129, 10, 2, '2', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(130, 10, 2, 'Y1', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(131, 10, 2, 'Y2', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(132, 10, 2, 'Y3', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(133, 10, 2, 'Y4', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(134, 10, 2, 'Y5', '2024-09-16 23:50:28', '2024-09-16 23:50:28'),
(135, 11, 1, '1', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(136, 11, 1, 'Iphone X', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(137, 11, 1, 'Iphone XS', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(138, 11, 1, 'Iphone 11promax', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(139, 11, 1, 'Iphone 12 pro', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(140, 11, 1, 'Iphone 13 promax', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(141, 11, 2, '2', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(142, 11, 2, 'Black', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(143, 11, 2, 'Tranparent', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(144, 11, 2, 'Purle', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(149, 12, 2, '2', '2024-09-17 00:05:41', '2024-09-17 00:05:41'),
(150, 12, 2, 'Titan - Tự Nhiên', '2024-09-17 00:05:41', '2024-09-17 00:05:41'),
(151, 12, 2, 'Titan - Xanh', '2024-09-17 00:05:41', '2024-09-17 00:05:41'),
(152, 12, 2, 'Titan - Trắng', '2024-09-17 00:05:41', '2024-09-17 00:05:41'),
(156, 13, 2, 'Đen', '2024-09-17 13:49:58', '2024-09-17 13:49:58'),
(157, 13, 2, 'Hồng', '2024-09-17 13:49:58', '2024-09-17 13:49:58'),
(309, 15, 1, '128gb', '2024-09-17 22:20:09', '2024-09-17 22:20:09'),
(310, 15, 1, '2567gb', '2024-09-17 22:20:09', '2024-09-17 22:20:09'),
(311, 15, 1, '128gb', '2024-09-17 22:20:09', '2024-09-17 22:20:09'),
(312, 28, 1, '1', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(313, 28, 1, 's', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(314, 28, 2, '2', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(315, 28, 2, 'vàh', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(316, 29, 1, '1', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(317, 29, 1, 's', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(318, 29, 2, '2', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(319, 29, 2, 'vàng', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(320, 30, 1, '1', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(321, 30, 1, 's', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(322, 30, 2, '2', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(323, 30, 2, 'do', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(328, 31, 1, 'k', '2024-09-19 00:42:57', '2024-09-19 00:42:57'),
(329, 31, 2, 'vang', '2024-09-19 00:42:57', '2024-09-19 00:42:57'),
(332, 32, 1, '1', '2024-09-19 01:00:27', '2024-09-19 01:00:27'),
(333, 32, 1, 's', '2024-09-19 01:00:27', '2024-09-19 01:00:27'),
(334, 33, 1, 's', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(335, 33, 2, 'v', '2024-09-19 01:04:54', '2024-09-19 01:04:54');

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
(16, 4, '1726506094_vn-11134201-23020-h38j4bzk8mnv64@resize_w450_nl.webp', '2024-09-16 23:01:34', '2024-09-16 23:01:34'),
(17, 4, '1726506094_vn-11134201-23020-2tejnczk8mnv61@resize_w450_nl.webp', '2024-09-16 23:01:34', '2024-09-16 23:01:34'),
(18, 4, '1726506094_vn-11134201-23020-dnlhxczk8mnvc5@resize_w450_nl.webp', '2024-09-16 23:01:34', '2024-09-16 23:01:34'),
(19, 4, '1726506094_vn-11134201-23020-v8zhnczk8mnv6d@resize_w450_nl.webp', '2024-09-16 23:01:34', '2024-09-16 23:01:34'),
(20, 4, '1726506971_vn-11134201-23020-2hti4bzk8mnv18@resize_w450_nl.webp', '2024-09-16 23:01:34', '2024-09-16 23:16:11'),
(21, 5, '1726507380_vn-11134207-7r98o-ly7ebkwcs18t98@resize_w450_nl.webp', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(22, 5, '1726507380_vn-11134207-7r98o-ly7ebktuvp29b5@resize_w450_nl.webp', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(23, 5, '1726507380_vn-11134207-7r98o-ly7ebku4y3bh13@resize_w450_nl.webp', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(24, 5, '1726507380_vn-11134207-7r98o-lz4nukzag7rh9e@resize_w450_nl.webp', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(25, 5, '1726507380_vn-11134258-7r98o-lxh8v4nyp4nvfd (1).png', '2024-09-16 23:23:00', '2024-09-16 23:23:00'),
(26, 6, '1726507630_sg-11134201-7qvev-ljuqgqojgy6602@resize_w450_nl.webp', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(27, 6, '1726507630_sg-11134201-7qvep-ljuqgq2wcm6uc2@resize_w450_nl.webp', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(28, 6, '1726507630_sg-11134201-7qvdg-ljuxdthrpdl632@resize_w450_nl.webp', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(29, 6, '1726507630_sg-11134201-7qvfj-ljuqgri8cb57b3@resize_w450_nl.webp', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(30, 6, '1726507630_vn-11134258-7r98o-lxh8vf5lciqhda.png', '2024-09-16 23:27:10', '2024-09-16 23:27:10'),
(36, 8, '1726508427_61667aa8b6823c7400614fc8a8240476@resize_w450_nl.webp', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(37, 8, '1726508427_16eb4b1f9ddb85a054d4903ca9303499@resize_w450_nl.webp', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(38, 8, '1726508427_cn-11134207-7qukw-ljdjnhs3mzy2e1@resize_w450_nl.webp', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(39, 8, '1726508427_cn-11134207-7qukw-ljdjnhs3k6t6ec@resize_w450_nl.webp', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(40, 8, '1726508427_cn-11134207-7qukw-ljdjnhs3lldmd0@resize_w450_nl.webp', '2024-09-16 23:40:27', '2024-09-16 23:40:27'),
(41, 9, '1726508693_vn-11134207-7r98o-lturlhxk2ryl97@resize_w450_nl.webp', '2024-09-16 23:44:09', '2024-09-16 23:44:53'),
(42, 9, '1726508649_3ee5c2f492dcafd946f94935ad40f8f2@resize_w450_nl.webp', '2024-09-16 23:44:09', '2024-09-16 23:44:09'),
(43, 9, '1726508649_vn-11134207-7r98o-lturlhxk2ryl97@resize_w450_nl.webp', '2024-09-16 23:44:09', '2024-09-16 23:44:09'),
(44, 9, '1726508649_vn-11134207-7r98o-lva3l9q9yxzh63@resize_w450_nl.webp', '2024-09-16 23:44:09', '2024-09-16 23:44:09'),
(45, 9, '1726508649_vn-11134207-7r98o-lva3l9q9xjf136@resize_w450_nl.webp', '2024-09-16 23:44:09', '2024-09-16 23:44:09'),
(46, 10, '1726508969_sg-11134201-7rd69-lw1i7sbe6jqb75@resize_w450_nl.webp', '2024-09-16 23:49:29', '2024-09-16 23:49:29'),
(47, 10, '1726508969_sg-11134201-7rd4q-lw1i7rtww3z116@resize_w450_nl.webp', '2024-09-16 23:49:29', '2024-09-16 23:49:29'),
(48, 10, '1726508969_sg-11134201-7rd70-lw1i7r4nx25u13@resize_w450_nl.webp', '2024-09-16 23:49:29', '2024-09-16 23:49:29'),
(49, 10, '1726508969_sg-11134201-7rd4o-lw1i7qi6tyh40c@resize_w450_nl.webp', '2024-09-16 23:49:29', '2024-09-16 23:49:29'),
(50, 10, '1726509028_sg-11134201-7rd3v-lw1i7so5nv1y7d@resize_w450_nl.webp', '2024-09-16 23:49:29', '2024-09-16 23:50:28'),
(51, 11, '1726509500_sg-11134201-7rcbz-ltxljttn1z5o40@resize_w450_nl.webp', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(52, 11, '1726509500_sg-11134201-7rcey-ltxljsa5b6k1a8@resize_w450_nl.webp', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(53, 11, '1726509500_sg-11134201-7rcdx-ltxljqlnrp6bf7@resize_w450_nl.webp', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(54, 11, '1726509500_sg-11134201-7rcbt-ltxljnyrmk32d4@resize_w450_nl.webp', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(55, 11, '1726509500_sg-11134201-7rce9-ltxljnbgkntycf@resize_w450_nl.webp', '2024-09-16 23:58:20', '2024-09-16 23:58:20'),
(56, 12, '1726509941_vn-11134207-7r98o-lscndw3ovxqx90@resize_w450_nl (1).webp', '2024-09-17 00:04:44', '2024-09-17 00:05:41'),
(57, 12, '1726509884_vn-11134207-7r98o-llxe6fzh7o4f04@resize_w450_nl.webp', '2024-09-17 00:04:44', '2024-09-17 00:04:44'),
(58, 12, '1726509884_vn-11134207-7r98o-llxe6fzh69jzfc@resize_w450_nl.webp', '2024-09-17 00:04:44', '2024-09-17 00:04:44'),
(59, 12, '1726509884_vn-11134207-7r98o-llxe6fzh4uzj8b@resize_w450_nl.webp', '2024-09-17 00:04:44', '2024-09-17 00:04:44'),
(60, 12, '1726509941_vn-11134207-7r98o-llxe6fzh92ovfd@resize_w450_nl.webp', '2024-09-17 00:04:44', '2024-09-17 00:05:41'),
(61, 13, '1726559379_vn-11134207-7r98o-lmof4iubnisff0@resize_w450_nl.webp', '2024-09-17 13:49:39', '2024-09-17 13:49:39'),
(62, 13, '1726559379_vn-11134207-7r98o-lmof4iubqbxb83@resize_w450_nl.webp', '2024-09-17 13:49:39', '2024-09-17 13:49:39'),
(63, 13, '1726559379_vn-11134207-7r98o-lmof4iubrqhr2a@resize_w450_nl.webp', '2024-09-17 13:49:39', '2024-09-17 13:49:39'),
(64, 13, '1726559379_vn-11134207-7r98o-lmof4iubvy73db@resize_w450_nl.webp', '2024-09-17 13:49:39', '2024-09-17 13:49:39'),
(65, 13, '1726559379_vn-11134207-7r98o-lmof4iubxcrjeb@resize_w450_nl.webp', '2024-09-17 13:49:39', '2024-09-17 13:49:39'),
(66, 14, '1726559745_vn-11134201-7r98o-lxawb5wpf2e1a7@resize_w450_nl.webp', '2024-09-17 13:55:45', '2024-09-17 13:55:45'),
(67, 14, '1726559745_vn-11134201-7r98o-lwd2xcmp5w49c5@resize_w450_nl.webp', '2024-09-17 13:55:45', '2024-09-17 13:55:45'),
(68, 14, '1726559745_vn-11134201-7r98o-lwd2xd7ibfmj1c@resize_w450_nl.webp', '2024-09-17 13:55:45', '2024-09-17 13:55:45'),
(69, 14, '1726559745_vn-11134201-7r98o-lxawb4qt4dll58@resize_w450_nl.webp', '2024-09-17 13:55:45', '2024-09-17 13:55:45'),
(70, 14, '1726559745_vn-11134201-7r98o-lxawb4ebmn6j72@resize_w450_nl.webp', '2024-09-17 13:55:45', '2024-09-17 13:55:45'),
(71, 15, '1726560290_sg-11134201-22110-kcxbtso16zjvb1@resize_w450_nl.webp', '2024-09-17 14:04:50', '2024-09-17 14:04:50'),
(72, 15, '1726560290_sg-11134201-22110-5ba2fco16zjv78@resize_w450_nl.webp', '2024-09-17 14:04:50', '2024-09-17 14:04:50'),
(73, 15, '1726560290_sg-11134201-22110-ulsbpfn16zjv3c@resize_w450_nl.webp', '2024-09-17 14:04:50', '2024-09-17 14:04:50'),
(74, 15, '1726560290_sg-11134201-22110-nombj5l16zjv52@resize_w450_nl (1).webp', '2024-09-17 14:04:50', '2024-09-17 14:04:50'),
(75, 15, '1726560290_sg-11134201-22110-nombj5l16zjv52@resize_w450_nl.webp', '2024-09-17 14:04:50', '2024-09-17 14:04:50'),
(136, 28, '1726682091_sg-11134201-7rd49-lug13xa0ytx307@resize_w450_nl.webp', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(137, 28, '1726682091_sg-11134201-7rd6a-lug13ws9q7w222@resize_w450_nl.webp', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(138, 28, '1726682091_sg-11134201-7rd4w-lug13w80igfm4d@resize_w450_nl.webp', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(139, 28, '1726682091_sg-11134201-7rd55-lug13vsr4sd8b0@resize_w450_nl.webp', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(140, 28, '1726682091_cn-11134207-7r98o-lyc04uc890fn56@resize_w450_nl.webp', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(141, 28, '1726682091_sg-11134201-22110-kcxbtso16zjvb1@resize_w450_nl.webp', '2024-09-18 23:54:51', '2024-09-18 23:54:51'),
(142, 29, '1726683487_sg-11134201-7rd49-lug13xa0ytx307@resize_w450_nl.webp', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(143, 29, '1726683487_sg-11134201-7rd6a-lug13ws9q7w222@resize_w450_nl.webp', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(144, 29, '1726683487_sg-11134201-7rd4w-lug13w80igfm4d@resize_w450_nl.webp', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(145, 29, '1726683487_sg-11134201-7rd55-lug13vsr4sd8b0@resize_w450_nl.webp', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(146, 29, '1726683487_cn-11134207-7r98o-lyc04uc890fn56@resize_w450_nl.webp', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(147, 29, '1726683487_sg-11134201-22110-kcxbtso16zjvb1@resize_w450_nl.webp', '2024-09-19 00:18:07', '2024-09-19 00:18:07'),
(148, 30, '1726684391_sg-11134201-7rd49-lug13xa0ytx307@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(149, 30, '1726684391_sg-11134201-7rd6a-lug13ws9q7w222@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(150, 30, '1726684391_sg-11134201-7rd4w-lug13w80igfm4d@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(151, 30, '1726684391_sg-11134201-7rd55-lug13vsr4sd8b0@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(152, 30, '1726684391_cn-11134207-7r98o-lyc04uc890fn56@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(153, 30, '1726684391_sg-11134201-22110-kcxbtso16zjvb1@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(154, 30, '1726684391_sg-11134201-22110-5ba2fco16zjv78@resize_w450_nl.webp', '2024-09-19 00:33:11', '2024-09-19 00:33:11'),
(155, 31, '1726684706_sg-11134201-7rd49-lug13xa0ytx307@resize_w450_nl.webp', '2024-09-19 00:38:26', '2024-09-19 00:38:26'),
(156, 31, '1726684706_sg-11134201-7rd6a-lug13ws9q7w222@resize_w450_nl.webp', '2024-09-19 00:38:26', '2024-09-19 00:38:26'),
(157, 31, '1726684706_sg-11134201-7rd4w-lug13w80igfm4d@resize_w450_nl.webp', '2024-09-19 00:38:26', '2024-09-19 00:38:26'),
(158, 31, '1726684706_sg-11134201-7rd55-lug13vsr4sd8b0@resize_w450_nl.webp', '2024-09-19 00:38:26', '2024-09-19 00:38:26'),
(159, 31, '1726684977_vn-11134258-7r98o-lxh8v4nyp4nvfd (1).png', '2024-09-19 00:38:26', '2024-09-19 00:42:57'),
(160, 31, '1726684706_sg-11134201-22110-kcxbtso16zjvb1@resize_w450_nl.webp', '2024-09-19 00:38:26', '2024-09-19 00:38:26'),
(161, 31, '1726684706_sg-11134201-22110-5ba2fco16zjv78@resize_w450_nl.webp', '2024-09-19 00:38:26', '2024-09-19 00:38:26'),
(162, 32, '1726685549_vn-11134201-7r98o-lxawb5wpf2e1a7@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(163, 32, '1726685549_vn-11134201-7r98o-lwd2xcmp5w49c5@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(164, 32, '1726685549_vn-11134201-7r98o-lwd2xd7ibfmj1c@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(165, 32, '1726685549_vn-11134201-7r98o-lxawb4qt4dll58@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(166, 32, '1726685549_vn-11134201-7r98o-lxawb4ebmn6j72@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(167, 32, '1726685549_vn-11134207-7r98o-lmof4iubnisff0@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(168, 32, '1726685549_vn-11134207-7r98o-lmof4iubqbxb83@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(169, 32, '1726685549_vn-11134207-7r98o-lmof4iubrqhr2a@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(170, 32, '1726685549_vn-11134207-7r98o-lmof4iubvy73db@resize_w450_nl.webp', '2024-09-19 00:52:29', '2024-09-19 00:52:29'),
(171, 33, '1726686294_sg-11134201-7rd49-lug13xa0ytx307@resize_w450_nl.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(172, 33, '1726686294_sg-11134201-7rd4w-lug13w80igfm4d@resize_w450_nl - Copy.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(173, 33, '1726686294_sg-11134201-7rd4w-lug13w80igfm4d@resize_w450_nl.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(174, 33, '1726686294_sg-11134201-7rd55-lug13vsr4sd8b0@resize_w450_nl - Copy.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(175, 33, '1726686294_sg-11134201-7rd55-lug13vsr4sd8b0@resize_w450_nl.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(176, 33, '1726686294_cn-11134207-7r98o-lyc04uc890fn56@resize_w450_nl - Copy.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(177, 33, '1726686294_sg-11134201-22110-kcxbtso16zjvb1@resize_w450_nl - Copy.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54'),
(178, 33, '1726686294_sg-11134201-22110-5ba2fco16zjv78@resize_w450_nl - Copy.webp', '2024-09-19 01:04:54', '2024-09-19 01:04:54');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `cccd` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `store_name`, `store_description`, `rating`, `follow`, `join`, `store_email`, `store_phone`, `address_id`, `created_at`, `updated_at`, `cccd`) VALUES
(1, 2, 'Cửa hàng việt', NULL, 0.00, NULL, NULL, 'tuhttpc06537@fpt.edu.vn', '0393286497', 1, '2024-09-14 17:25:13', '2024-09-14 17:25:13', NULL),
(3, 5, 'Thanh Tú mobile', NULL, 0.00, 6, NULL, 'thanhtujs2004@gmail.com', '13455666666', 13, '2024-07-15 15:53:51', '2024-09-04 15:53:51', NULL),
(4, 6, 'TuStore', NULL, 0.00, 2000, NULL, 'test1@gmail.com', '1234567890', 15, '2024-09-16 21:15:36', '2024-09-16 21:15:36', NULL),
(5, 7, 'Cửa hàng di động', NULL, 0.00, NULL, NULL, 'test2@gmail.com', '0393286497', 16, '2024-09-17 00:02:56', '2024-09-17 00:02:56', NULL),
(6, 9, 'Vgaming', NULL, 0.00, NULL, NULL, 'thanhtu411902@gmail.com', '0393286497', 19, '2024-09-17 16:08:12', '2024-09-17 16:08:12', NULL);

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
('nzClqSUgW0UG2ZZf71rCcIJB0DTwiGL0GtGrWwEt', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoieWV6Y0tJOHEzSXd3bG43aEJPZUZjZ1JuWVF3d2JiQzNmcjdSbGZmMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zYW4tcGhhbS1jaGktdGlldC8zMyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo5OiJ1c2VyRW1haWwiO3M6MjM6InR1aHR0cGMwNjUzN0BmcHQuZWR1LnZuIjtzOjY6InVzZXJJZCI7aToyO3M6MTI6InVzZXJGdWxsTmFtZSI7czoxMDoiVGhhbmhUw7phYSI7czo4OiJzZWxsZXJJZCI7aToxO30=', 1726690293);

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
(5, 1, 'Áo Vest và Blazer', 1, 'ao-vest-va-blazer', NULL, '2024-09-16 22:00:17', '2024-09-16 22:01:13'),
(6, 1, 'Áo Khoác', 1, 'ao-khoac', NULL, '2024-09-16 22:01:58', '2024-09-16 22:01:58'),
(7, 1, 'Áo Hoodie, Áo Len & Áo Nỉ', 1, 'ao-hoodie-ao-len-ao-ni', NULL, '2024-09-16 22:02:45', '2024-09-16 22:02:45'),
(8, 1, 'Quần Jeans', 1, 'quan-jeans', NULL, '2024-09-16 22:37:26', '2024-09-16 22:37:26'),
(9, 1, 'Quần Dài/Quần Âu', 1, 'quan-daiquan-au', NULL, '2024-09-16 22:37:48', '2024-09-16 22:37:48'),
(10, 1, 'Đồ Ngủ', 1, 'do-ngu', NULL, '2024-09-16 22:38:56', '2024-09-16 22:38:56'),
(11, 1, 'Áo', 1, 'ao', NULL, '2024-09-16 22:39:14', '2024-09-16 22:39:14'),
(12, 1, 'Đồ Bộ', 1, 'do-bo', NULL, '2024-09-16 22:40:02', '2024-09-16 22:40:02'),
(13, 1, 'Kính Mắt Nam', 1, 'kinh-mat-nam', NULL, '2024-09-16 22:40:37', '2024-09-16 22:40:37'),
(14, 1, 'Thắt Lưng Nam', 1, 'that-lung-nam', NULL, '2024-09-16 22:41:07', '2024-09-16 22:41:07'),
(15, 1, 'Cà vạt & Nơ cổ', 1, 'ca-vat-no-co', NULL, '2024-09-16 22:41:31', '2024-09-16 22:41:31'),
(16, 1, 'Phụ Kiện Nam', 1, 'phu-kien-nam', NULL, '2024-09-16 22:42:02', '2024-09-16 22:42:02'),
(17, 3, 'Điện thoại', 1, 'dien-thoai', NULL, '2024-09-16 22:42:52', '2024-09-16 22:42:52'),
(18, 3, 'Pin Dự Phòng', 1, 'pin-du-phong', NULL, '2024-09-16 22:43:12', '2024-09-16 22:43:28'),
(19, 3, 'Ốp lưng, bao da, Miếng dán điện thoại', 1, 'op-lung-bao-da-mieng-dan-dien-thoai', NULL, '2024-09-16 22:44:03', '2024-09-16 22:44:03'),
(20, 6, 'Máy Tính Bàn', 1, 'may-tinh-ban', NULL, '2024-09-16 22:45:09', '2024-09-16 22:45:09'),
(21, 6, 'Màn Hình', 1, 'man-hinh', NULL, '2024-09-16 22:45:26', '2024-09-16 22:45:26'),
(22, 6, 'Linh Kiện Máy Tính', 1, 'linh-kien-may-tinh', NULL, '2024-09-16 22:45:42', '2024-09-16 22:45:42'),
(23, 9, 'Máy ảnh - Máy quay phim', 1, 'may-anh-may-quay-phim', NULL, '2024-09-16 22:46:29', '2024-09-16 22:46:29'),
(24, 9, 'Camera giám sát & Camera hệ thống', 1, 'camera-giam-sat-camera-he-thong', NULL, '2024-09-16 22:47:15', '2024-09-16 22:47:15'),
(25, 9, 'Thẻ nhớ', 1, 'the-nho', NULL, '2024-09-16 22:47:32', '2024-09-16 22:47:32'),
(26, 2, 'Quần', 1, 'quan', NULL, '2024-09-16 22:47:57', '2024-09-16 22:47:57'),
(27, 2, 'Quần đùi', 1, 'quan-dui', NULL, '2024-09-16 22:48:14', '2024-09-16 22:48:14'),
(28, 2, 'Đầm/Váy', 1, 'damvay', NULL, '2024-09-16 22:48:34', '2024-09-16 22:48:34'),
(29, 2, 'Đồ truyền thống', 1, 'do-truyen-thong', NULL, '2024-09-16 22:48:57', '2024-09-16 22:48:57'),
(30, 2, 'Vớ/ Tất', 1, 'vo-tat', NULL, '2024-09-16 22:49:21', '2024-09-16 22:49:21'),
(31, 17, 'Vali', 1, 'vali', NULL, '2024-09-16 22:51:19', '2024-09-16 22:51:19'),
(32, 17, 'Giày Thể Thao', 1, 'giay-the-thao', NULL, '2024-09-16 22:51:47', '2024-09-16 22:51:47');

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
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','seller','buyer') NOT NULL DEFAULT 'buyer',
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
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$Y.EFK6KCY45a0z1IHkguf./2.za3aK/ZX810bwq46BjpF/Y94CSvy', NULL, '2024-09-14 17:16:31', '2024-09-14 17:16:31', NULL, NULL, NULL, 'buyer', 1, NULL, NULL, NULL, NULL),
(2, 'Tú', 'tuhttpc06537@fpt.edu.vn', NULL, '$2y$12$0dhqANpwaq6BRN6AL2IoyOHScypA2KSMWCJFuvjQ6eca.u/.U5wmS', NULL, '2024-09-14 17:24:26', '2024-09-17 14:19:59', 'ThanhTúaa', '0393286497', '1726561199.jfif', 'buyer', 1, NULL, NULL, NULL, 365885),
(3, 'Túttt', 'thanhtu4311902@gmail.com', NULL, '$2y$12$dtbNfAkI/UR93m4djb.RZe/ZCfuxLg8VRJpUGXraCEFCVKK07eeOG', NULL, '2024-09-14 23:31:10', '2024-09-14 23:31:17', 'ThanhTúttt', '0393286497', 'default_avt.png', 'buyer', 1, NULL, NULL, NULL, 567617),
(5, 'tr', 'thanhtujs20044@gmail.com', NULL, '$2y$12$2CrNpYMsfGBO4jXXHZuOE.Y672qq.FzE6JsjvrlfUNQPZs05N52La', NULL, '2024-09-15 15:52:43', '2024-09-15 20:08:31', 'tutr1', '0393286497', '1726409311.jfif', 'seller', 1, NULL, NULL, NULL, 811592),
(6, 'test', 'test1@gmail.com', NULL, '$2y$12$eGSi.g3H.u9CIypc3upmsu5rinI.2EVgfr7uHsvmtqhQIKQgbC3oa', NULL, '2024-09-16 14:21:39', '2024-09-16 21:15:36', 'testtest', '1234567890', 'default_avt.png', 'seller', 1, NULL, NULL, NULL, 490812),
(7, 'test2', 'test2@gmail.com', NULL, '$2y$12$wfrPwXikXDnB4xMIvdUV..miVm3fdC0sDwk.5C3WXCOlQGy0nEsXm', NULL, '2024-09-17 00:01:43', '2024-09-17 00:02:56', 'Thanhtest2', '0393286497', 'default_avt.png', 'seller', 1, NULL, NULL, NULL, 732606),
(8, 'tu', 'thanhtu4111902@gmail.com', NULL, '$2y$12$IKyo9YNMLbkkofCCnSZaNuEyXrP8/la9rmVHCSekKaRFErWFXBJqm', NULL, '2024-09-17 15:57:02', '2024-09-17 15:57:10', 'tutu', '0393286497', 'default_avt.png', 'buyer', 1, NULL, NULL, NULL, 749671),
(9, 'tu', 'thanhtu411902@gmail.com', NULL, '$2y$12$/2Lf6ffJXEoj18t8ycnIjuvaFA6LOnY5H62kQv7nj8JRlOy9aNrWS', NULL, '2024-09-17 15:59:27', '2024-09-17 16:08:12', 'tutu11', '0393286497', '1726567350.jfif', 'seller', 1, NULL, NULL, NULL, 611734);

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
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_attribute_id_foreign` (`attribute_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE;

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
