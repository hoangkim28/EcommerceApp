-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 08:11 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `phone_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_sku` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `created_at`, `updated_at`, `order`) VALUES
(1, NULL, 'Nam', 'nam', '2021-07-25 22:44:56', '2021-07-30 06:37:00', 1),
(2, NULL, 'Nữ', 'nu', '2021-07-25 22:45:01', '2021-07-30 06:37:00', 2),
(3, NULL, 'Bé trai', 'be-trai', '2021-07-25 22:45:08', '2021-07-26 16:54:45', 3),
(4, NULL, 'Bé gái', 'be-gai', '2021-07-25 22:45:15', '2021-07-26 16:54:45', 4),
(5, NULL, 'Phụ kiện', 'phu-kien', '2021-07-25 22:45:34', '2021-07-26 16:54:38', 5);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'Đen'),
(2, 'Trắng'),
(3, 'Xám'),
(4, 'Nâu'),
(5, 'Đỏ'),
(6, 'Vàng');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_discount` tinyint(1) NOT NULL DEFAULT 0,
  `max_discount` decimal(10,2) NOT NULL,
  `min_discount` decimal(10,2) NOT NULL,
  `min_quantity` int(11) DEFAULT NULL,
  `taget` tinyint(1) NOT NULL DEFAULT 0,
  `list` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 0, 1, 1, 1, 1, '{}', 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 0, 1, 1, 1, 1, '{}', 9),
(22, 1, 'gender', 'text', 'Gender', 0, 1, 1, 1, 1, 1, '{}', 6),
(23, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 0, 1, 1, 1, 1, '{}', 7),
(24, 4, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(25, 4, 'name', 'text', 'Tên', 1, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"3\"},\"validation\":{\"rule\":\"unique:colors,name\"}}', 2),
(26, 5, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(27, 5, 'name', 'text', 'Tên', 1, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"3\"},\"validation\":{\"rule\":\"unique:colors,name\"}}', 2),
(28, 7, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(29, 7, 'parent_id', 'select_dropdown', 'Danh mục cha', 0, 1, 1, 1, 1, 0, '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"Kh\\u00f4ng.\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"},\"display\":{\"width\":\"3\"}}', 3),
(30, 7, 'name', 'text', 'Tên danh mục', 1, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"3\"},\"validation\":{\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required\"},\"messages\":{\"required\":\"Vui l\\u00f2ng ch\\u1ecdn \\u1ea3nh \\u0111\\u1ea1i di\\u1ec7n!\"}}}', 4),
(31, 7, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:categories,slug\"},\"display\":{\"width\":\"3\"}}', 5),
(32, 7, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 6),
(33, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(34, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(35, 8, 'category_id', 'select_dropdown', 'Category Id', 1, 0, 0, 0, 1, 0, '{}', 3),
(36, 8, 'name', 'text', 'Tên', 1, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"4\"},\"validation\":{\"rule\":\"required|max:100\",\"messages\":{\"required\":\":attribute kh\\u00f4ng \\u0111\\u01b0\\u1ee3c \\u0111\\u1ec3 tr\\u1ed1ng!\",\"max\":\"T\\u1ed1i \\u0111a :max. k\\u00fd t\\u1ef1!\"}}}', 4),
(37, 8, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:products,slug\",\"messages\":{\"unique\":\"Slug n\\u00e0y \\u0111\\u00e3 t\\u1ed3n t\\u1ea1i!\"}},\"display\":{\"width\":\"4\"}}', 5),
(38, 8, 'image', 'image', 'Ảnh đại diện', 1, 0, 1, 1, 1, 1, '{\"display\":{\"width\":\"3\"},\"quality\":\"100%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"27%\"}],\"validation\":{\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required\"},\"messages\":{\"required\":\"Vui l\\u00f2ng ch\\u1ecdn \\u1ea3nh \\u0111\\u1ea1i di\\u1ec7n!\"}}}', 6),
(39, 8, 'more_image', 'multiple_images', 'Hình ảnh thêm', 0, 0, 1, 1, 1, 1, '{\"display\":{\"width\":\"9\"},\"quality\":\"90%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"27%\"}]}', 7),
(40, 8, 'description', 'text_area', 'Giới thiệu sơ lượt', 0, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"max:250\",\"messages\":{\"max\":\"T\\u1ed1i \\u0111a :max. k\\u00fd t\\u1ef1!\"}}}', 8),
(41, 8, 'content', 'rich_text_box', 'Nội dung chính', 0, 0, 1, 1, 1, 1, '{}', 9),
(42, 8, 'status', 'checkbox', 'Trạng thái', 1, 1, 1, 1, 1, 1, '{\"on\":\"Hi\\u1ec3n th\\u1ecb\",\"off\":\"\\u1ea8n\",\"checked\":\"on\",\"display\":{\"width\":\"3\"}}', 10),
(43, 8, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 11),
(44, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 12),
(45, 8, 'product_hasone_category_relationship', 'relationship', 'Danh mục', 0, 1, 1, 1, 1, 1, '{\"display\":{\"width\":\"4\"},\"validation\":{\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required\"},\"messages\":{\"required\":\"Tr\\u01b0\\u1eddng n\\u00e0y, :attribute kh\\u00f4ng \\u0111\\u01b0\\u1ee3c \\u0111\\u1ec3 tr\\u1ed1ng!\"}},\"model\":\"App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"addresses\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(46, 7, 'order', 'number', 'Thứ tự hiển thị', 1, 0, 0, 0, 0, 0, '{}', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2021-07-25 07:53:35', '2021-07-26 22:35:16'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(4, 'colors', 'colors', 'Màu sắc', 'Màu sắc', 'voyager-brush', 'App\\Models\\Color', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-07-25 22:09:43', '2021-08-10 20:11:30'),
(5, 'sizes', 'sizes', 'Kích thước', 'Kích thước', 'voyager-archive', 'App\\Models\\Size', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-07-25 22:10:14', '2021-08-10 20:14:54'),
(7, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'App\\Models\\Category', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"order\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":\"name\",\"scope\":null}', '2021-07-25 22:28:08', '2021-07-30 06:36:34'),
(8, 'products', 'products', 'Sản phẩm', 'Sản phẩm', 'voyager-bubble-hear', 'App\\Models\\Product', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"created_at\",\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"name\",\"scope\":null}', '2021-07-25 23:14:10', '2021-08-10 23:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-07-25 07:53:35', '2021-07-25 07:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', '#000000', NULL, 1, '2021-07-25 07:53:35', '2021-07-25 22:19:28', 'voyager-dashboard', 'null'),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 5, '2021-07-25 07:53:35', '2021-07-25 22:32:00', 'voyager.media.index', NULL),
(3, 1, 'Người dùng', '', '_self', 'voyager-person', '#000000', 17, 2, '2021-07-25 07:53:35', '2021-07-25 22:31:09', 'voyager.users.index', 'null'),
(4, 1, 'Roles - Quyền - Vai trò', '', '_self', 'voyager-lock', '#000000', 17, 1, '2021-07-25 07:53:35', '2021-07-25 22:30:55', 'voyager.roles.index', 'null'),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 6, '2021-07-25 07:53:35', '2021-07-25 22:32:00', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2021-07-25 07:53:35', '2021-07-25 22:18:56', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2021-07-25 07:53:35', '2021-07-25 22:18:56', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2021-07-25 07:53:35', '2021-07-25 22:18:56', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2021-07-25 07:53:35', '2021-07-25 22:18:56', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 7, '2021-07-25 07:53:35', '2021-07-25 22:32:00', 'voyager.settings.index', NULL),
(11, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2021-07-25 07:53:35', '2021-07-25 22:18:56', 'voyager.hooks', NULL),
(12, 1, 'Màu sắc', '', '_self', 'voyager-brush', NULL, 14, 1, '2021-07-25 22:09:43', '2021-07-25 22:18:59', 'voyager.colors.index', NULL),
(13, 1, 'Kích thước', '', '_self', 'voyager-archive', '#000000', 14, 2, '2021-07-25 22:10:14', '2021-07-25 22:20:53', 'voyager.sizes.index', 'null'),
(14, 1, 'Các thuộc tính', '', '_self', 'voyager-tag', '#000000', NULL, 4, '2021-07-25 22:18:47', '2021-07-25 22:32:00', NULL, ''),
(15, 1, 'CMS', '', '_self', 'voyager-data', '#000000', NULL, 2, '2021-07-25 22:23:01', '2021-07-25 22:23:11', NULL, ''),
(16, 1, 'Danh mục sản phẩm', '', '_self', 'voyager-categories', '#000000', 15, 1, '2021-07-25 22:28:08', '2021-07-25 22:29:20', 'voyager.categories.index', 'null'),
(17, 1, 'Người dùng', '', '_self', 'voyager-people', '#000000', NULL, 3, '2021-07-25 22:30:14', '2021-07-25 22:30:24', NULL, ''),
(18, 1, 'Sản phẩm', '', '_self', 'voyager-bubble-hear', '#000000', 15, 2, '2021-07-25 23:14:10', '2021-07-25 23:14:46', 'voyager.products.index', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2021_07_25_051203_create_categories_table', 1),
(24, '2021_07_25_051303_create_sizes_table', 1),
(25, '2021_07_25_051314_create_colors_table', 1),
(26, '2021_07_25_051531_create_products_table', 1),
(27, '2021_07_25_051542_create_product_skus_table', 1),
(28, '2021_07_25_051708_create_orders_table', 1),
(29, '2021_07_25_051716_create_order_details_table', 1),
(30, '2021_07_25_051731_create_bills_table', 1),
(31, '2021_07_25_051739_create_bill_details_table', 1),
(32, '2021_07_25_051757_create_customers_table', 1),
(33, '2021_07_25_051819_create_addresses_table', 1),
(34, '2021_07_25_060916_create_coupons_table', 1),
(35, '2021_07_26_083039_chang_more_image_product', 2),
(36, '2021_07_26_083039_change_more_image_product', 3),
(37, '2021_07_26_234650_add_order_to_category', 4),
(38, '2021_07_26_234650_add_order_category', 5),
(39, '2021_07_26_234929_change_gender_to_nullable_users', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `coupon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `phone_number`, `address`, `subtotal`, `total`, `coupon`, `created_at`, `updated_at`) VALUES
(1, 1, '123', '41243124', '124124', '123.00', '123.00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `sku_id`, `price`, `quantity`) VALUES
(1, 1, 7, '123.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(2, 'browse_bread', NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(3, 'browse_database', NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(4, 'browse_media', NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(5, 'browse_compass', NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(6, 'browse_menus', 'menus', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(7, 'read_menus', 'menus', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(8, 'edit_menus', 'menus', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(9, 'add_menus', 'menus', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(10, 'delete_menus', 'menus', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(11, 'browse_roles', 'roles', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(12, 'read_roles', 'roles', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(13, 'edit_roles', 'roles', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(14, 'add_roles', 'roles', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(15, 'delete_roles', 'roles', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(16, 'browse_users', 'users', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(17, 'read_users', 'users', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(18, 'edit_users', 'users', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(19, 'add_users', 'users', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(20, 'delete_users', 'users', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(21, 'browse_settings', 'settings', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(22, 'read_settings', 'settings', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(23, 'edit_settings', 'settings', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(24, 'add_settings', 'settings', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(25, 'delete_settings', 'settings', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(26, 'browse_hooks', NULL, '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(27, 'browse_colors', 'colors', '2021-07-25 22:09:43', '2021-07-25 22:09:43'),
(28, 'read_colors', 'colors', '2021-07-25 22:09:43', '2021-07-25 22:09:43'),
(29, 'edit_colors', 'colors', '2021-07-25 22:09:43', '2021-07-25 22:09:43'),
(30, 'add_colors', 'colors', '2021-07-25 22:09:43', '2021-07-25 22:09:43'),
(31, 'delete_colors', 'colors', '2021-07-25 22:09:43', '2021-07-25 22:09:43'),
(32, 'browse_sizes', 'sizes', '2021-07-25 22:10:14', '2021-07-25 22:10:14'),
(33, 'read_sizes', 'sizes', '2021-07-25 22:10:14', '2021-07-25 22:10:14'),
(34, 'edit_sizes', 'sizes', '2021-07-25 22:10:14', '2021-07-25 22:10:14'),
(35, 'add_sizes', 'sizes', '2021-07-25 22:10:14', '2021-07-25 22:10:14'),
(36, 'delete_sizes', 'sizes', '2021-07-25 22:10:14', '2021-07-25 22:10:14'),
(37, 'browse_categories', 'categories', '2021-07-25 22:28:08', '2021-07-25 22:28:08'),
(38, 'read_categories', 'categories', '2021-07-25 22:28:08', '2021-07-25 22:28:08'),
(39, 'edit_categories', 'categories', '2021-07-25 22:28:08', '2021-07-25 22:28:08'),
(40, 'add_categories', 'categories', '2021-07-25 22:28:08', '2021-07-25 22:28:08'),
(41, 'delete_categories', 'categories', '2021-07-25 22:28:08', '2021-07-25 22:28:08'),
(42, 'browse_products', 'products', '2021-07-25 23:14:10', '2021-07-25 23:14:10'),
(43, 'read_products', 'products', '2021-07-25 23:14:10', '2021-07-25 23:14:10'),
(44, 'edit_products', 'products', '2021-07-25 23:14:10', '2021-07-25 23:14:10'),
(45, 'add_products', 'products', '2021-07-25 23:14:10', '2021-07-25 23:14:10'),
(46, 'delete_products', 'products', '2021-07-25 23:14:10', '2021-07-25 23:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `more_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `image`, `more_image`, `description`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Giày Thể Thao Nam Biti\'s Hunter Core Refreshing Collection Contras Black DSMH06700DEN (Đen)', 'giay-the-thao-nam-biti-s-hunter-core-refreshing-collection-contras-black-dsmh06700den-den', 'products\\July2021\\GOU78plXkfp48kwItIz3.jpg', '[\"products\\\\July2021\\\\FIhBklF60X4MQyj92VqO.jpg\",\"products\\\\July2021\\\\sRUu217b1YTxfygX1f7a.jpg\",\"products\\\\July2021\\\\SpsUxx75YuWX4nuOUoGN.jpg\",\"products\\\\July2021\\\\4p2Mzo5W3bEb0iEycwMe.jpg\",\"products\\\\July2021\\\\e2ZgFAI5gF1I1jLK2abG.jpg\"]', NULL, NULL, 1, '2021-07-25 23:41:24', '2021-07-26 16:41:54'),
(2, 1, 'Giày Thể Thao Nam Biti\'s Hunter Core Refreshing Collection Contras Black DSMH06700DEN (Đỏ)', 'giay-the-thao-nam-biti-s-hunter-core-refreshing-collection-contras-black-dsmh06700den-do', 'products\\July2021\\GOU78plXkfp48kwItIz3.jpg', '[\"products\\\\July2021\\\\FIhBklF60X4MQyj92VqO.jpg\",\"products\\\\July2021\\\\sRUu217b1YTxfygX1f7a.jpg\",\"products\\\\July2021\\\\SpsUxx75YuWX4nuOUoGN.jpg\",\"products\\\\July2021\\\\4p2Mzo5W3bEb0iEycwMe.jpg\",\"products\\\\July2021\\\\e2ZgFAI5gF1I1jLK2abG.jpg\"]', NULL, NULL, 1, '2021-07-25 23:41:24', '2021-07-26 16:41:54'),
(3, 1, 'Giày Thể Thao Nam Biti’s Hunter X Z Collection InBlack DSMH06300XAM (Xám)', 'giay-the-thao-nam-biti-s-hunter-x-z-collection-inblack-dsmh06300xam-xam', 'products\\August2021\\WB8lXR8X9JVTkp5lrm27.jpg', NULL, NULL, NULL, 1, '2021-08-14 23:46:40', '2021-08-14 23:46:40'),
(4, 1, 'Giày Thể Thao Nam Biti’s Hunter Street Z Collection Low W&B DSMH06600TRG (Trắng)', 'giay-the-thao-nam-biti-s-hunter-street-z-collection-low-wandb-dsmh06600trg-trang', 'products\\August2021\\SSGDfLMDrrfTiXerX4wj.jpg', NULL, NULL, NULL, 1, '2021-08-15 00:13:17', '2021-08-15 00:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_skus`
--

CREATE TABLE `product_skus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `size_id` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `promotion_price` decimal(10,0) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_skus`
--

INSERT INTO `product_skus` (`id`, `product_id`, `color_id`, `size_id`, `price`, `promotion_price`, `quantity`, `default`) VALUES
(1, 1, 1, 2, '699000', NULL, 2, 1),
(2, 1, 1, 5, '699000', NULL, 5, 0),
(3, 1, 1, 7, '699000', NULL, 4, 0),
(4, 1, 1, 6, '699000', NULL, 8, 0),
(5, 1, 1, 3, '699000', NULL, 6, 0),
(6, 1, 1, 8, '699000', NULL, 12, 0),
(7, 1, 1, 1, '699000', NULL, 1, 0),
(8, 3, 3, 5, '999999', '888888', 10, 1),
(9, 4, 2, 5, '699000', '599000', 5, 1),
(10, 2, 5, 6, '699000', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2021-07-25 07:53:35', '2021-07-25 07:53:35'),
(2, 'user', 'Normal User', '2021-07-25 07:53:35', '2021-07-25 07:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Xóm giày', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Nâng niu bàn chân việt.', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings\\August2021\\oQcDtaBl3G76biodldRU.jpg', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Xóm giày', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Trang quản trị Xóm giày!', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`) VALUES
(1, '35'),
(2, '36'),
(3, '37'),
(4, '38'),
(5, '39'),
(6, '40'),
(7, '41'),
(8, '42'),
(9, '43'),
(10, '44'),
(11, '45');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `gender` tinyint(1) DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `gender`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'SuperAdmin', 'super@xomgiay.com', 'users/default.png', NULL, NULL, '$2y$10$8JSfxZ2/D1k1.cc3aNtiWeUikXK/FC2IaCZduv7trxzQXltLiKddy', '06h71BGq4Ps2KBOn3YCcTgl31gz5U2ud6ev4BMLC8WSBrl3kTzh5IIHxGMFI', '{\"locale\":\"vi\"}', '2021-07-25 07:53:46', '2021-07-26 16:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_user_id_foreign` (`user_id`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_details_bill_id_foreign` (`bill_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_sku_id_foreign` (`sku_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_skus`
--
ALTER TABLE `product_skus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_skus_product_id_foreign` (`product_id`),
  ADD KEY `product_skus_color_id_foreign` (`color_id`),
  ADD KEY `product_skus_size_id_foreign` (`size_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_details`
--
ALTER TABLE `bill_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_skus`
--
ALTER TABLE `product_skus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_sku_id_foreign` FOREIGN KEY (`sku_id`) REFERENCES `product_skus` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_skus`
--
ALTER TABLE `product_skus`
  ADD CONSTRAINT `product_skus_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_skus_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_skus_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
