-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2021 a las 05:26:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shoistore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(10) NOT NULL,
  `about_heading` text NOT NULL,
  `about_short_desc` text NOT NULL,
  `about_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `about_us`
--

INSERT INTO `about_us` (`about_id`, `about_heading`, `about_short_desc`, `about_desc`) VALUES
(1, 'Sobre Nosotros', '\r\n', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_username` text NOT NULL,
  `admin_image` text NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_country` text NOT NULL,
  `admin_job` varchar(255) NOT NULL,
  `admin_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_username`, `admin_image`, `admin_contact`, `admin_country`, `admin_job`, `admin_about`) VALUES
(14, 'Admin1', 'admin1@gmail.com', '$2y$10$nLRvuim/ZpF7qvuuyhjY0OduP2pDxRmRvW8lWJfB45sTBVVNUClb2', 'Adminuno', '45055327_181413502761320_6466495446528294912_n.jpg', '9999999', 'Chile', 'Administrador', ' Soy admin :)'),
(15, 'Admin2', 'admin2@gmail.com', '$2y$10$j4ab4HdEKNu2KBAW3bR4LerNOpwwXCiUXjKl0D1ofGgr.Xlv1qYXO', 'admindos', '91288518_1251760988350252_8060549846651633664_n.jpg', '8888888', 'Argentina', 'Administrador', ' Soy admin :)'),
(16, 'Admin3', 'admin3@gmail.com', '$2y$10$YRndZ1dlIRQI9fyXX0X7x.AGlFa71U7ng7ZLsiWsgKu93WsqEC3KO', 'admintres', 'depositphotos_24914541-stock-photo-yellow-labrador-retriever-puppy.jpg', '7777777777', 'Colombia', 'Administrador', ' Soy admin :)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boxes_section`
--

CREATE TABLE `boxes_section` (
  `box_id` int(10) NOT NULL,
  `box_title` text NOT NULL,
  `box_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bundle_product_relation`
--

CREATE TABLE `bundle_product_relation` (
  `rel_id` int(10) NOT NULL,
  `rel_title` varchar(255) NOT NULL,
  `product_id` int(10) NOT NULL,
  `bundle_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `product_weight` decimal(10,1) NOT NULL,
  `product_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_meta`
--

CREATE TABLE `cart_meta` (
  `meta_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `cart_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_top` text NOT NULL,
  `cat_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_top`, `cat_image`) VALUES
(12, 'Hombre', 'yes', 'hombre.jpg'),
(13, 'Mujer', 'yes', 'mujer.jfif'),
(14, 'Niño', 'no', 'niño.jpg'),
(15, 'Niña', 'no', 'niña.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(10) NOT NULL,
  `contact_email` text NOT NULL,
  `contact_heading` text NOT NULL,
  `contact_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `contact_email`, `contact_heading`, `contact_desc`) VALUES
(1, 'ShoiStore@gmail.com', 'Contáctanos', 'Si tiene alguna pregunta, no dude en contactarnos, nuestro centro de servicio al cliente está trabajando para usted las 24 horas del día, los 7 días de la semana.\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `country_id` int(10) NOT NULL,
  `country_name` text NOT NULL,
  `country_code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `product_id` int(10) NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_price` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_limit` int(100) NOT NULL,
  `coupon_used` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_username` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_confirm_code` text NOT NULL,
  `customer_role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_username`, `customer_contact`, `customer_image`, `customer_ip`, `customer_confirm_code`, `customer_role`) VALUES
(21, 'cliente1', 'cliente1@gmail.com', '$2y$10$Cv33GcTQZb2BF/D/rPUG0exRZxWXQTMDE77mupGRjuwrNst4LfYre', 'clienteuno', '66666666', '44319759_10218116191124259_4670590507049549824_n.jpg', '::1', '', 'customer'),
(22, 'cliente2', 'cliente2@gmail.com', '$2y$10$/oNDVUBDmBu/vCEXYtTWC.90RXHNle7dTAvTISBv2g095hFuwKjIO', 'clientedos', '55555555', 'Thanos.jpg', '::1', '', 'customer'),
(23, 'cliente3', 'cliente3@gmail.com', '$2y$10$tMydztT5rcQW7rHuCnSoAuuF4Ch9afeFlG6d7Drqx1JoN5hqwG1dS', 'clientetres', '444444444', '16d49e5803e8da9118b89b122a056b74.png', '::1', '', 'customer'),
(24, 'vendedor1', 'vendedor1@gmail.com', '$2y$10$vnm79LAgIjd92vbqHpbgq.MgfTOQIXw.kxDFPkmyzow1M2iIKIz3i', 'vendedoruno', '333333333333', '43880598_1371419656322024_2934071006630772736_n.jpg', '::1', '', 'vendor'),
(25, 'vendedor2', 'vendedor2@gmail.com', '$2y$10$O3dM2y9m9VLbs1Hfc9DbH.rYxxDBK1Du.d2iDhxhpvzpbaOgLASYG', 'vendedordos', '2222222222', '81500091_136440527804441_14757035182653440_o.jpg', '::1', '', 'vendor'),
(26, 'vendedor3', 'vendedor3@gmail.com', '$2y$10$6Rg8OI9WT7cFKKdc9pYxt.z9zYIrex2.iVpbaaWlaxs.Z9v9VZ.pK', 'vendedortres', '1111111111', '45744352_2126827274297467_9168775009588477952_n.jpg', '::1', '', 'vendor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers_addresses`
--

CREATE TABLE `customers_addresses` (
  `addresse_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `billing_first_name` text NOT NULL,
  `billing_last_name` text NOT NULL,
  `billing_country` text NOT NULL,
  `billing_address_1` text NOT NULL,
  `billing_address_2` text NOT NULL,
  `billing_state` text NOT NULL,
  `billing_city` text NOT NULL,
  `billing_postcode` text NOT NULL,
  `shipping_first_name` text NOT NULL,
  `shipping_last_name` text NOT NULL,
  `shipping_country` text NOT NULL,
  `shipping_address_1` text NOT NULL,
  `shipping_address_2` text NOT NULL,
  `shipping_state` text NOT NULL,
  `shipping_city` text NOT NULL,
  `shipping_postcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customers_addresses`
--

INSERT INTO `customers_addresses` (`addresse_id`, `customer_id`, `billing_first_name`, `billing_last_name`, `billing_country`, `billing_address_1`, `billing_address_2`, `billing_state`, `billing_city`, `billing_postcode`, `shipping_first_name`, `shipping_last_name`, `shipping_country`, `shipping_address_1`, `shipping_address_2`, `shipping_state`, `shipping_city`, `shipping_postcode`) VALUES
(18, 21, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 22, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, 23, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 24, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, 25, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 26, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers_history`
--

CREATE TABLE `customers_history` (
  `history_id` int(10) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `downloads`
--

CREATE TABLE `downloads` (
  `download_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `product_id` int(10) NOT NULL,
  `variation_id` int(10) NOT NULL,
  `download_title` text NOT NULL,
  `download_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enquiry_types`
--

CREATE TABLE `enquiry_types` (
  `enquiry_id` int(10) NOT NULL,
  `enquiry_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enquiry_types`
--

INSERT INTO `enquiry_types` (`enquiry_id`, `enquiry_title`) VALUES
(1, 'Pedidos y Entregas'),
(2, 'Soporte Técnico'),
(3, 'Preocupación por el precio'),
(4, 'Pregunta sobre servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `site_title` text NOT NULL,
  `meta_author` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `enable_vendor` text NOT NULL,
  `new_product_status` text NOT NULL,
  `edited_product_status` text NOT NULL,
  `order_status_change` text NOT NULL,
  `order_status_for_withdraw` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `meta_author`, `meta_description`, `meta_keywords`, `enable_vendor`, `new_product_status`, `edited_product_status`, `order_status_change`, `order_status_for_withdraw`) VALUES
(1, 'ShoiStore', 'Italo/Cristopher/Jeremy', 'Tienda de ropa deportiva y accesorios', 'shoistore,tienda,ropa,ropadeportiva', 'yes', 'active', 'no', 'yes', 'completed');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hide_admin_orders`
--

CREATE TABLE `hide_admin_orders` (
  `hide_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `icons`
--

CREATE TABLE `icons` (
  `icon_id` int(10) NOT NULL,
  `icon_product` int(10) NOT NULL,
  `icon_title` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `icons`
--

INSERT INTO `icons` (`icon_id`, `icon_product`, `icon_title`, `icon_image`) VALUES
(1, 1, 'statue', 'icon image.jpg'),
(2, 2, 'Icon-2', 'icon-2.png'),
(3, 3, 'Icon-3', 'icon-3.png'),
(4, 4, 'Icon-4', 'icon-4.jpg'),
(5, 3, 'dummy', 'icon image.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturer_id` int(10) NOT NULL,
  `manufacturer_title` text NOT NULL,
  `manufacturer_top` text NOT NULL,
  `manufacturer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_title`, `manufacturer_top`, `manufacturer_image`) VALUES
(7, 'Nike', 'yes', 'Poleras.jpg'),
(8, 'Adidas', 'yes', 'Poleras.jpg'),
(9, 'Reebok', 'no', 'Poleras.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `shipping_type` text NOT NULL,
  `shipping_cost` decimal(10,1) NOT NULL,
  `payment_method` text NOT NULL,
  `order_date` text NOT NULL,
  `order_total` decimal(10,1) NOT NULL,
  `order_note` text NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_addresses`
--

CREATE TABLE `orders_addresses` (
  `addresse_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `billing_first_name` text NOT NULL,
  `billing_last_name` text NOT NULL,
  `billing_country` text NOT NULL,
  `billing_address_1` text NOT NULL,
  `billing_address_2` text NOT NULL,
  `billing_state` text NOT NULL,
  `billing_city` text NOT NULL,
  `billing_postcode` text NOT NULL,
  `is_shipping_address` text NOT NULL,
  `shipping_first_name` text NOT NULL,
  `shipping_last_name` text NOT NULL,
  `shipping_country` text NOT NULL,
  `shipping_address_1` text NOT NULL,
  `shipping_address_2` text NOT NULL,
  `shipping_state` text NOT NULL,
  `shipping_city` text NOT NULL,
  `shipping_postcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_items`
--

CREATE TABLE `orders_items` (
  `item_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `price` decimal(10,1) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_items_meta`
--

CREATE TABLE `orders_items_meta` (
  `meta_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_notes`
--

CREATE TABLE `orders_notes` (
  `note_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `sub_order_id` text NOT NULL,
  `item_id` int(10) NOT NULL,
  `note_content` text NOT NULL,
  `note_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(10) NOT NULL,
  `code` int(10) NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(10) NOT NULL,
  `commission_percentage` int(10) NOT NULL,
  `minimum_withdraw_limit` int(10) NOT NULL,
  `days_before_withdraw` int(10) NOT NULL,
  `enable_paypal` text NOT NULL,
  `paypal_email` text NOT NULL,
  `paypal_sandbox` text NOT NULL,
  `paypal_currency_code` text NOT NULL,
  `paypal_app_client_id` text NOT NULL,
  `paypal_app_client_secret` text NOT NULL,
  `enable_stripe` text NOT NULL,
  `stripe_secret_key` text NOT NULL,
  `stripe_publishable_key` text NOT NULL,
  `stripe_currency_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `commission_percentage`, `minimum_withdraw_limit`, `days_before_withdraw`, `enable_paypal`, `paypal_email`, `paypal_sandbox`, `paypal_currency_code`, `paypal_app_client_id`, `paypal_app_client_secret`, `enable_stripe`, `stripe_secret_key`, `stripe_publishable_key`, `stripe_currency_code`) VALUES
(1, 10, 10, 2, 'yes', 'sad.ahmed22224@gmail.com', 'on', 'USD', 'AQzJGGDi4KZrbX318v6yXzSVQRLesCslKVzNKuGkA1UMAHwBArHr0onrVEZtSAtOi_LbunG2ymrmd45_', 'EFTT61XQPRNeUbai0KMcEwyvRBEqwBUv3z2mgPq-zXjgVmpbMfJNVHfLSY_CBXdIH3G3M5rzuPvme4N_', 'yes', 'sk_test_RtRMOCdX6IIK2f9Q94CilE5k', 'pk_test_NcOLIMZPgVJid1099xnjs1Ka', 'CAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `p_cat_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `manufacturer_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` text NOT NULL,
  `product_seo_desc` text NOT NULL,
  `product_url` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_psp_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_features` text NOT NULL,
  `product_video` text NOT NULL,
  `product_keywords` text NOT NULL,
  `product_label` text NOT NULL,
  `product_type` text NOT NULL,
  `product_weight` decimal(10,1) NOT NULL,
  `product_views` int(10) NOT NULL,
  `product_vendor_status` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `vendor_id`, `p_cat_id`, `cat_id`, `manufacturer_id`, `date`, `product_title`, `product_seo_desc`, `product_url`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_psp_price`, `product_desc`, `product_features`, `product_video`, `product_keywords`, `product_label`, `product_type`, `product_weight`, `product_views`, `product_vendor_status`, `status`) VALUES
(51, '24', 12, 12, 7, '2021-11-05 02:55:51', 'Air Jordan 1 Mid', 'Corresponde a un producto de la mundial conocida Nike, considera como la mejor empresa de zapatillas del mundo', 'ZapatillasBasket', 'nike1.jpg', 'nike2.jpg', 'nike3.jpg', 110000, 120000, 'Zapatillas nike jordan para basket o uso cotidiano', 'de talla 38 a 45', 'https://www.youtube.com/watch?v=MFZy6n3pnXw', 'jordan,nike,air', 'zapatilla,nike,ropa', 'physical_product', '2.0', 0, 'active', 'product');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_stock`
--

CREATE TABLE `products_stock` (
  `stock_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `variation_id` int(10) NOT NULL,
  `stock_status` text NOT NULL,
  `enable_stock` text NOT NULL,
  `stock_quantity` text NOT NULL,
  `allow_backorders` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products_stock`
--

INSERT INTO `products_stock` (`stock_id`, `product_id`, `variation_id`, `stock_status`, `enable_stock`, `stock_quantity`, `allow_backorders`) VALUES
(34, 2, 0, 'onbackorder', 'yes', '-4', 'notify'),
(35, 18, 0, 'instock', 'yes', '2', 'no'),
(36, 11, 0, 'instock', 'yes', '17', 'no'),
(37, 39, 345, 'instock', 'yes', '6', 'no'),
(38, 39, 344, 'onbackorder', 'yes', '0', 'yes'),
(39, 39, 343, 'outofstock', 'yes', '0', 'no'),
(40, 39, 342, 'outofstock', 'yes', '0', 'no'),
(41, 34, 332, 'instock', 'yes', '4', 'no'),
(42, 34, 331, 'instock', 'no', '0', 'no'),
(43, 34, 330, 'onbackorder', 'yes', '-2', 'yes'),
(44, 34, 89, 'onbackorder', 'yes', '-4', 'notify'),
(45, 34, 88, 'instock', 'no', '0', 'no'),
(46, 34, 87, 'instock', 'no', '0', 'no'),
(47, 34, 86, 'instock', 'yes', '12', 'no'),
(48, 34, 85, 'instock', 'yes', '19', 'no'),
(49, 3, 0, 'instock', 'yes', '3', 'no'),
(50, 4, 0, 'instock', 'yes', '4', 'no'),
(51, 5, 0, 'instock', 'yes', '5', 'no'),
(52, 6, 0, 'instock', 'yes', '17', 'yes'),
(53, 7, 0, 'outofstock', 'no', '0', 'no'),
(54, 8, 0, 'onbackorder', 'yes', '1', 'yes'),
(55, 9, 2, 'instock', 'yes', '1', 'no'),
(56, 14, 0, 'instock', 'yes', '2', 'no'),
(57, 15, 0, 'instock', 'yes', '2', 'no'),
(58, 16, 0, 'onbackorder', 'yes', '-3', 'notify'),
(59, 17, 0, 'onbackorder', 'yes', '-3', 'notify'),
(60, 20, 0, 'instock', 'no', '0', 'yes'),
(61, 40, 347, 'instock', 'no', '0', 'no'),
(62, 40, 359, 'instock', 'no', '0', 'no'),
(63, 40, 358, 'instock', 'no', '0', 'no'),
(64, 40, 357, 'instock', 'no', '0', 'no'),
(65, 40, 356, 'instock', 'no', '0', 'no'),
(66, 40, 355, 'instock', 'yes', '1', 'no'),
(67, 40, 354, 'instock', 'yes', '3', 'notify'),
(68, 40, 352, 'instock', 'no', '0', 'no'),
(69, 40, 351, 'instock', 'no', '0', 'no'),
(70, 40, 348, 'instock', 'yes', '3', 'no'),
(71, 40, 360, 'instock', 'yes', '99', 'no'),
(72, 40, 361, 'instock', 'no', '0', 'no'),
(73, 31, 283, 'instock', 'no', '0', 'no'),
(74, 31, 282, 'instock', 'no', '0', 'no'),
(75, 31, 281, 'instock', 'no', '0', 'no'),
(76, 31, 280, 'instock', 'no', '0', 'no'),
(77, 31, 279, 'instock', 'no', '0', 'no'),
(78, 31, 278, 'instock', 'no', '0', 'no'),
(79, 31, 277, 'instock', 'no', '0', 'no'),
(80, 31, 276, 'instock', 'yes', '1', 'no'),
(81, 31, 275, 'instock', 'no', '0', 'no'),
(82, 31, 274, 'instock', 'no', '0', 'no'),
(83, 31, 273, 'instock', 'no', '0', 'no'),
(84, 31, 272, 'instock', 'no', '0', 'no'),
(85, 31, 271, 'instock', 'no', '0', 'no'),
(86, 31, 270, 'instock', 'no', '0', 'no'),
(87, 31, 269, 'instock', 'no', '0', 'no'),
(88, 31, 268, 'instock', 'no', '0', 'no'),
(89, 31, 267, 'instock', 'no', '0', 'no'),
(90, 31, 266, 'instock', 'no', '0', 'no'),
(93, 41, 453, 'instock', 'no', '0', 'no'),
(94, 41, 452, 'instock', 'no', '0', 'no'),
(95, 41, 451, 'instock', 'no', '0', 'no'),
(96, 41, 450, 'instock', 'no', '0', 'no'),
(97, 41, 449, 'instock', 'no', '0', 'no'),
(98, 41, 448, 'instock', 'no', '0', 'no'),
(99, 41, 447, 'instock', 'no', '0', 'no'),
(100, 41, 446, 'instock', 'no', '0', 'no'),
(101, 41, 445, 'instock', 'no', '0', 'no'),
(102, 41, 444, 'instock', 'no', '0', 'no'),
(103, 41, 443, 'instock', 'no', '0', 'no'),
(104, 41, 442, 'instock', 'no', '0', 'no'),
(105, 41, 441, 'instock', 'no', '0', 'no'),
(106, 41, 440, 'instock', 'no', '0', 'no'),
(107, 41, 439, 'instock', 'no', '0', 'no'),
(108, 41, 438, 'instock', 'no', '0', 'no'),
(109, 41, 454, 'instock', 'no', '0', 'no'),
(110, 41, 458, 'onbackorder', 'yes', '0', 'notify'),
(115, 3, 476, 'instock', 'yes', '2', 'no'),
(116, 3, 475, 'instock', 'no', '0', 'no'),
(117, 3, 474, 'instock', 'no', '0', 'no'),
(118, 3, 473, 'instock', 'no', '0', 'no'),
(119, 3, 472, 'instock', 'no', '0', 'no'),
(120, 3, 471, 'instock', 'no', '0', 'no'),
(121, 3, 470, 'instock', 'no', '0', 'no'),
(122, 3, 469, 'instock', 'no', '0', 'no'),
(123, 3, 468, 'instock', 'no', '0', 'no'),
(124, 38, 478, 'outofstock', 'yes', '-3', 'no'),
(125, 38, 479, 'outofstock', 'yes', '0', 'no'),
(126, 16, 481, 'instock', 'yes', '1', 'no'),
(128, 16, 483, 'outofstock', 'yes', '0', 'no'),
(130, 16, 485, 'instock', 'yes', '3', 'no'),
(131, 16, 486, 'instock', 'no', '8', 'no'),
(132, 17, 488, 'instock', 'yes', '1', 'no'),
(133, 17, 489, 'instock', 'yes', '2', 'no'),
(134, 16, 490, 'instock', 'no', '0', 'no'),
(135, 17, 491, 'instock', 'yes', '3', 'no'),
(136, 41, 492, 'outofstock', 'yes', '0', 'no'),
(140, 46, 494, 'instock', 'yes', '53', 'no'),
(141, 46, 495, 'instock', 'yes', '12', 'no'),
(142, 46, 496, 'instock', 'yes', '4', 'no'),
(191, 30, 503, 'instock', 'yes', '8', 'no'),
(193, 30, 504, 'instock', 'yes', '5', 'no'),
(194, 30, 505, 'instock', 'yes', '7', 'no'),
(195, 30, 506, 'instock', 'yes', '3', 'no'),
(196, 48, 0, 'instock', 'yes', '6', 'no'),
(202, 10, 0, 'instock', 'yes', '8', 'no'),
(207, 8828, 607, 'instock', 'no', '0', 'no'),
(208, 8828, 606, 'instock', 'no', '0', 'no'),
(209, 8828, 605, 'instock', 'no', '0', 'no'),
(210, 8828, 604, 'instock', 'no', '0', 'no'),
(211, 8828, 603, 'instock', 'no', '0', 'no'),
(212, 8828, 608, 'instock', 'no', '0', 'no'),
(213, 51, 0, 'instock', 'yes', '17', 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_attributes`
--

CREATE TABLE `product_attributes` (
  `attribute_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `attribute_name` text NOT NULL,
  `attribute_values` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_attributes`
--

INSERT INTO `product_attributes` (`attribute_id`, `product_id`, `attribute_name`, `attribute_values`) VALUES
(90, 0, '', ''),
(91, 3, 'Color', 'Red|Blue|Yellow'),
(92, 3, 'Size', '12|14|16'),
(95, 38, 'Memory', '8 GB|12 GB|16 GB'),
(96, 38, 'Processor', 'i3 7en|i5 7en|i7 7en'),
(97, 16, 'Os', 'Windows|Mac-Os'),
(98, 16, 'Edition', 'Ultra|Delux|Ultimate'),
(99, 17, 'Operating System', 'Windows|MacOS|linux Os'),
(110, 8828, 'Memory', '4 GB|8 GB|12 GB|16 GB|32 GB'),
(112, 8828, 'Processor', 'i3 7th-generation|i5 7th-generation|i7 7th-generation'),
(113, 8828, 'Storage', '128 GB SSD|256 GB SSD|512GB SSD|1TB SSD|2TB SSD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_categories`
--

CREATE TABLE `product_categories` (
  `p_cat_id` int(10) NOT NULL,
  `p_cat_title` text NOT NULL,
  `p_cat_top` text NOT NULL,
  `p_cat_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_categories`
--

INSERT INTO `product_categories` (`p_cat_id`, `p_cat_title`, `p_cat_top`, `p_cat_image`) VALUES
(12, 'Zapatillas', 'yes', 'Zapatillas.jpg'),
(13, 'Polerones', 'no', 'Polerones.jpg'),
(14, 'Poleras', 'no', 'Poleras.jpg'),
(15, 'Buzos', 'no', 'Buzos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_variations`
--

CREATE TABLE `product_variations` (
  `variation_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_img1` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_psp_price` int(10) NOT NULL,
  `product_weight` decimal(10,1) NOT NULL,
  `product_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `review_title` text NOT NULL,
  `review_rating` int(10) NOT NULL,
  `review_content` text NOT NULL,
  `review_date` text NOT NULL,
  `review_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews_meta`
--

CREATE TABLE `reviews_meta` (
  `meta_id` int(10) NOT NULL,
  `review_id` int(10) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `service_id` int(10) NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `service_desc` text NOT NULL,
  `service_button` varchar(255) NOT NULL,
  `service_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(10) NOT NULL,
  `shipping_type` int(10) NOT NULL,
  `shipping_zone` int(10) NOT NULL,
  `shipping_country` int(10) NOT NULL,
  `shipping_weight` decimal(10,1) NOT NULL,
  `shipping_cost` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping_type`
--

CREATE TABLE `shipping_type` (
  `type_id` int(11) NOT NULL,
  `vendor_id` text NOT NULL,
  `type_name` text NOT NULL,
  `type_order` int(11) NOT NULL,
  `type_default` varchar(255) NOT NULL,
  `type_local` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `slide_id` int(10) NOT NULL,
  `slide_name` varchar(255) NOT NULL,
  `slide_image` text NOT NULL,
  `slide_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`slide_id`, `slide_name`, `slide_image`, `slide_url`) VALUES
(8, 'ShoisTORE', 'hjjh.gif', 'http://localhost/updated_ecom_store/index.php'),
(10, 'fgmbxjfgs', 'Mira los pro.gif', 'http://localhost/updated_ecom_store/shop.php'),
(11, 'asdkja', 'Marcass.gif', 'http://localhost/updated_ecom_store/shop.php'),
(12, 'tyiyutik', 'Reg.gif', 'http://localhost/updated_ecom_store/customer_register.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_settings`
--

CREATE TABLE `store_settings` (
  `settings_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `store_cover_image` text NOT NULL,
  `store_profile_image` text NOT NULL,
  `store_name` text NOT NULL,
  `store_country` text NOT NULL,
  `store_address_1` text NOT NULL,
  `store_address_2` text NOT NULL,
  `store_state` text NOT NULL,
  `store_city` text NOT NULL,
  `store_postcode` text NOT NULL,
  `paypal_email` text NOT NULL,
  `phone_no` text NOT NULL,
  `store_email` text NOT NULL,
  `seo_title` text NOT NULL,
  `meta_author` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `store_settings`
--

INSERT INTO `store_settings` (`settings_id`, `vendor_id`, `store_cover_image`, `store_profile_image`, `store_name`, `store_country`, `store_address_1`, `store_address_2`, `store_state`, `store_city`, `store_postcode`, `paypal_email`, `phone_no`, `store_email`, `seo_title`, `meta_author`, `meta_description`, `meta_keywords`) VALUES
(10, '24', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, '25', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, '26', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terms`
--

CREATE TABLE `terms` (
  `term_id` int(10) NOT NULL,
  `term_title` varchar(100) NOT NULL,
  `term_link` varchar(100) NOT NULL,
  `term_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variations_meta`
--

CREATE TABLE `variations_meta` (
  `meta_id` int(10) NOT NULL,
  `variation_id` int(10) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendor_accounts`
--

CREATE TABLE `vendor_accounts` (
  `account_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `current_balance` decimal(10,1) NOT NULL,
  `pending_clearance` decimal(10,1) NOT NULL,
  `withdrawals` decimal(10,1) NOT NULL,
  `month_earnings` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendor_accounts`
--

INSERT INTO `vendor_accounts` (`account_id`, `vendor_id`, `current_balance`, `pending_clearance`, `withdrawals`, `month_earnings`) VALUES
(4, 24, '0.0', '0.0', '0.0', '0.0'),
(5, 25, '0.0', '0.0', '0.0', '0.0'),
(6, 26, '0.0', '0.0', '0.0', '0.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendor_commissions`
--

CREATE TABLE `vendor_commissions` (
  `commission_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `commission_paid_date` text NOT NULL,
  `commission_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendor_orders`
--

CREATE TABLE `vendor_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `shipping_type` text NOT NULL,
  `shipping_cost` decimal(10,1) NOT NULL,
  `order_total` decimal(10,1) NOT NULL,
  `net_amount` decimal(10,1) NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendor_withdraws`
--

CREATE TABLE `vendor_withdraws` (
  `withdraw_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `amount` decimal(10,1) NOT NULL,
  `method` text NOT NULL,
  `date` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist_meta`
--

CREATE TABLE `wishlist_meta` (
  `meta_id` int(10) NOT NULL,
  `wishlist_id` int(255) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zones`
--

CREATE TABLE `zones` (
  `zone_id` int(10) NOT NULL,
  `vendor_id` text NOT NULL,
  `zone_name` text NOT NULL,
  `zone_order` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zones_locations`
--

CREATE TABLE `zones_locations` (
  `location_id` int(10) NOT NULL,
  `zone_id` int(10) NOT NULL,
  `location_code` text NOT NULL,
  `location_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indices de la tabla `boxes_section`
--
ALTER TABLE `boxes_section`
  ADD PRIMARY KEY (`box_id`);

--
-- Indices de la tabla `bundle_product_relation`
--
ALTER TABLE `bundle_product_relation`
  ADD PRIMARY KEY (`rel_id`);

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indices de la tabla `cart_meta`
--
ALTER TABLE `cart_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indices de la tabla `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indices de la tabla `customers_addresses`
--
ALTER TABLE `customers_addresses`
  ADD PRIMARY KEY (`addresse_id`);

--
-- Indices de la tabla `customers_history`
--
ALTER TABLE `customers_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indices de la tabla `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_id`);

--
-- Indices de la tabla `enquiry_types`
--
ALTER TABLE `enquiry_types`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indices de la tabla `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hide_admin_orders`
--
ALTER TABLE `hide_admin_orders`
  ADD PRIMARY KEY (`hide_id`);

--
-- Indices de la tabla `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`icon_id`);

--
-- Indices de la tabla `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indices de la tabla `orders_addresses`
--
ALTER TABLE `orders_addresses`
  ADD PRIMARY KEY (`addresse_id`);

--
-- Indices de la tabla `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indices de la tabla `orders_items_meta`
--
ALTER TABLE `orders_items_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indices de la tabla `orders_notes`
--
ALTER TABLE `orders_notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indices de la tabla `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `products_stock`
--
ALTER TABLE `products_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indices de la tabla `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indices de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`p_cat_id`);

--
-- Indices de la tabla `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`variation_id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indices de la tabla `reviews_meta`
--
ALTER TABLE `reviews_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indices de la tabla `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indices de la tabla `shipping_type`
--
ALTER TABLE `shipping_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indices de la tabla `store_settings`
--
ALTER TABLE `store_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indices de la tabla `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`);

--
-- Indices de la tabla `variations_meta`
--
ALTER TABLE `variations_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indices de la tabla `vendor_accounts`
--
ALTER TABLE `vendor_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indices de la tabla `vendor_commissions`
--
ALTER TABLE `vendor_commissions`
  ADD PRIMARY KEY (`commission_id`);

--
-- Indices de la tabla `vendor_orders`
--
ALTER TABLE `vendor_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendor_withdraws`
--
ALTER TABLE `vendor_withdraws`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- Indices de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- Indices de la tabla `wishlist_meta`
--
ALTER TABLE `wishlist_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indices de la tabla `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indices de la tabla `zones_locations`
--
ALTER TABLE `zones_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `boxes_section`
--
ALTER TABLE `boxes_section`
  MODIFY `box_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bundle_product_relation`
--
ALTER TABLE `bundle_product_relation`
  MODIFY `rel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cart_meta`
--
ALTER TABLE `cart_meta`
  MODIFY `meta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT de la tabla `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `customers_addresses`
--
ALTER TABLE `customers_addresses`
  MODIFY `addresse_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `customers_history`
--
ALTER TABLE `customers_history`
  MODIFY `history_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT de la tabla `downloads`
--
ALTER TABLE `downloads`
  MODIFY `download_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `enquiry_types`
--
ALTER TABLE `enquiry_types`
  MODIFY `enquiry_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hide_admin_orders`
--
ALTER TABLE `hide_admin_orders`
  MODIFY `hide_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `icons`
--
ALTER TABLE `icons`
  MODIFY `icon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders_addresses`
--
ALTER TABLE `orders_addresses`
  MODIFY `addresse_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `orders_items_meta`
--
ALTER TABLE `orders_items_meta`
  MODIFY `meta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `orders_notes`
--
ALTER TABLE `orders_notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `products_stock`
--
ALTER TABLE `products_stock`
  MODIFY `stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT de la tabla `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `attribute_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `p_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `variation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `reviews_meta`
--
ALTER TABLE `reviews_meta`
  MODIFY `meta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT de la tabla `shipping_type`
--
ALTER TABLE `shipping_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `slide_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `store_settings`
--
ALTER TABLE `store_settings`
  MODIFY `settings_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `variations_meta`
--
ALTER TABLE `variations_meta`
  MODIFY `meta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1287;

--
-- AUTO_INCREMENT de la tabla `vendor_accounts`
--
ALTER TABLE `vendor_accounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vendor_commissions`
--
ALTER TABLE `vendor_commissions`
  MODIFY `commission_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `vendor_orders`
--
ALTER TABLE `vendor_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vendor_withdraws`
--
ALTER TABLE `vendor_withdraws`
  MODIFY `withdraw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `wishlist_meta`
--
ALTER TABLE `wishlist_meta`
  MODIFY `meta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `zones`
--
ALTER TABLE `zones`
  MODIFY `zone_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `zones_locations`
--
ALTER TABLE `zones_locations`
  MODIFY `location_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
