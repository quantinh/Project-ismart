-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 16, 2022 lúc 02:23 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ismart`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `display_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `avatar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `reg_date` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `tel` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `role` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `admin_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `active` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `fullname`, `display_name`, `username`, `email`, `gender`, `avatar`, `password`, `reg_date`, `tel`, `address`, `role`, `admin_status`, `active`, `creator`, `editor`, `edit_date`) VALUES
(1, 'Hà Quan Tính', 'Admin', 'admin', 'htinh7444@gmail.com', 'male', 'public/images/upload/admins/quantinh.jpg', '532b2efbb65211802092ed6fc7342c0f', '8/8/2021', '0377953849', 'k245 Âu Cơ, TP Đà Nẵng', '1', 'Approved', 'Hà Quan Tính', 'Admin', '', '21/12/2021 04:12:23'),
(28, 'Trần Thế Ngọc Anh ', 'Member01', 'admin02', 'thengoc@gmail.com', 'male', 'public/images/upload/admins/thanh.jpg', '3dcadc502bb432c908977ea7609d5e9f', '23/11/2021', '0377953844', 'H192 Ông ích Kiêm, Đà Nẵng', '2', 'Approved', 'Hà Quan Tính', 'Hà Quan Tính', '', '21/12/2021 04:12:10'),
(32, 'Lương Quang Anh', 'Member02', 'admin03', 'luonganh@gmail.com', 'male', 'public/images/upload/admins/sang.jpg', 'c510e3d0437234929af69119685f2a89', '24/11/2021', '0377968862', '192 Ông ích Kiêm,  TP Đà Nẵng', '3', 'Approved', 'Hà Quan Tính', 'Hà Quan Tính', '', '21/12/2021 04:12:25'),
(33, 'Trần Văn Nghĩa', 'Member03', 'admin04', 'nghia@gmail.com', 'male', 'public/images/upload/admins/nghia.jpg', 'c510e3d0437234929af69119685f2a89', '24/11/2021', '0377968880', '269 Tôn Đức Thắng', '2', 'Approved', 'Hà Quan Tính', 'Hà Quan Tính', '', '21/12/2021 04:12:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_banners`
--

CREATE TABLE `tbl_banners` (
  `banner_id` int(11) NOT NULL,
  `banner_title` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `banner_link` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `banner_desc` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `banner_thumb` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_order` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `banner_status` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_banners`
--

INSERT INTO `tbl_banners` (`banner_id`, `banner_title`, `banner_link`, `banner_desc`, `banner_thumb`, `num_order`, `banner_status`, `creator`, `create_date`, `editor`, `edit_date`) VALUES
(1, 'Banner-1', 'ban-ner-1', '<p>Banner n&agrave;y thuộc quyền sở hữu chủ Admin 1 desinger</p>\r\n', 'public/images/upload/banners/banner-1.png', '1', 'Approved', 'admin', '11/01/2022', '', ''),
(2, 'Banner-2', 'ban-ner-2', '<p>Banner n&agrave;y thuộc quyền sở hữu của nh&oacute;m Admin&nbsp;</p>\r\n', 'public/images/upload/banners/banner-2.png', '2', 'Approved', 'admin', '11/01/2022', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blocks`
--

CREATE TABLE `tbl_blocks` (
  `block_id` int(11) NOT NULL,
  `block_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `block_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `block_content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_blocks`
--

INSERT INTO `tbl_blocks` (`block_id`, `block_title`, `block_code`, `block_content`, `creator`, `create_date`) VALUES
(1, 'Thông tin khối header', 'infor_header', 'Trích dẫn thêm thông tin cho khối header\r\n', 'admin', '20/12/2021'),
(2, 'Thông tin khối footer', 'info_footer', 'Trích dẫn, thay đổi thông tin cho khối footer\r\n\r\n', 'admin', '20/12/2021'),
(3, 'Tạo khối header', 'create_header', 'Tạo khối header\r\n\r\n', 'admin', '20/12/2021'),
(4, 'Tạo khối footer', 'create_footer', 'Tạo khối footer\r\n', 'admin', '20/12/2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_order` int(11) NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `address`, `phone`, `email`, `num_order`, `create_date`) VALUES
(1, 'Trần Thanh Hải', '149 Ông Ích Khiêm, TP Gia Lai', '0377953567', 'thanhhai@gmail.com', 0, '11/01/2022 20:05:32'),
(3, 'Phạm Văn An', '269 Tô Hoài, TP Đồng Nai', '0377953850', 'vanan@gmail.com', 0, '11/01/2022 21:41:57'),
(4, 'Trần Văn Đông', '192 Nguyễn Huệ, TP Hồ Chí Minh', '0377953678', 'vandong@gmail.com', 0, '11/01/2022 22:50:41'),
(5, 'Dương Hồng Quân ', '295 Tô Hiệu, TP Hà Nội', '0377958945', 'hongquan@gmail.com', 0, '12/01/2022 08:39:05'),
(6, 'Hà Quan Tính', 'k245 Âu Cơ, TP Đà Nẵng', '0377953849', 'htinh7444@gmail.com', 0, '14/02/2022 14:34:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_medias`
--

CREATE TABLE `tbl_medias` (
  `media_id` int(11) NOT NULL,
  `media_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `media_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `media_thumb` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `media_status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `menu_url_static` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `page_slug` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `menu_order` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_menus`
--

INSERT INTO `tbl_menus` (`menu_id`, `menu_title`, `menu_url_static`, `page_slug`, `product_id`, `post_id`, `menu_order`) VALUES
(52, 'Trang chủ', 'trang-chu.html', '', 0, 0, '1'),
(53, 'Sản phẩm', 'san-pham.html', '', 0, 0, '2'),
(54, 'Giới thiệu', 'gioi-thieu.html', '', 0, 0, '3'),
(55, 'Liên hệ', 'lien-he.html', '', 0, 0, '4'),
(56, 'Blog', 'bai-viet.html', '', 0, 0, '5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `order_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_num` int(11) NOT NULL,
  `total_num` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `order_code`, `order_status`, `customer_name`, `email`, `phone`, `address`, `note`, `product_num`, `total_num`, `total_price`, `payment`, `create_date`, `edit_date`) VALUES
(3, 'MKGP3HA/B', 'Hủy đơn hàng', 'Trần Văn Đông', 'vandong@gmail.com', '0377953678', '192 Nguyễn Huệ', 'Đặt điện thoại Samsung Galaxy Tab S7 màu xanh ngọc (full box , kèm sặc , tai nghe, phụ kiện ốp lưng tặng kèm), địa chỉ số nhà 192 Nguyễn Huệ, Phường Hòa khánh Nam, Tp Đà Nẵng', 0, 1, 41990000, 'payment-home', '11/01/2022 22:50:41', ''),
(4, 'MKGP3SA/A', 'Hủy đơn hàng', 'Dương Hồng Quân ', 'hongquan@gmail.com', '0377958945', 'H295 Tô Hiệu', 'Laptop Apple MacBook Pro 14 M1 Pro 2021 (01 chiếc, new full box, kèm sạc, bao chống sốc) Phường Hòa Minh, Quận Liên Chiểu, Tp Đà Nẵng .', 0, 1, 52990000, 'direct-payment', '12/01/2022 08:39:04', ''),
(9, 'MKGP3SA/C', 'Thành công', 'Trần Văn An', 'vanan@gmail.com', '0377953850', '269 Tôn Đức Thắng', 'Đặt hàng máy tính tuf, thanh toán tại nhà ) 269 Tôn Đức Thắng, Quận Liên Chiểu, Tp Đà Nẵng', 0, 1, 30840000, 'payment-home', '11/01/2022 21:41:57', ''),
(33, 'MKGP1644824090', 'Đang vận chuyển', 'Hà Quan Tính', 'htinh7444@gmail.com', '0377953849', 'k245 Âu Cơ, TP Đà Nẵng', 'mua điện thoại với đơn hàng sau đang sale', 0, 1, 38200000, 'payment-home', '14/02/2022 14:34:50', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `page_slug` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `page_content` varchar(1000) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `page_thumb` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `page_desc` varchar(1000) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `active` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `page_status` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_pages`
--

INSERT INTO `tbl_pages` (`page_id`, `page_title`, `page_slug`, `page_content`, `page_thumb`, `page_desc`, `category`, `active`, `page_status`, `creator`, `create_date`) VALUES
(1, 'Giới thiệu', 'gioi-thieu-1', '<p>&nbsp;</p>\r\n\r\n<p>Năm 1988, 13 nh&agrave; khoa học trẻ th&agrave;nh lập C&ocirc;ng ty c&ocirc;ng ngh&ecirc;&nbsp;với mong muốn x&acirc;y dựng&nbsp;<strong><i>&ldquo;một tổ chức kiểu mới, gi&agrave;u mạnh bằng nỗ lực lao động s&aacute;ng tạo trong khoa học kỹ thuật v&agrave; c&ocirc;ng nghệ, l&agrave;m kh&aacute;ch h&agrave;ng h&agrave;i l&ograve;ng, g&oacute;p phần hưng thịnh quốc gia, đem lại cho mỗi th&agrave;nh vi&ecirc;n của m&igrave;nh điều kiện ph&aacute;t triển đầy đủ nhất về t&agrave;i năng v&agrave; một cuộc sống đầy đủ về vật chất, phong ph&uacute; về tinh thần.&rdquo;</i></strong></p>\r\n', 'public/images/upload/pages/stevejob.jpg', '<p>Kh&ocirc;ng ngừng đổi mới, li&ecirc;n tục s&aacute;ng tạo v&agrave; lu&ocirc;n ti&ecirc;n phong mang lại cho kh&aacute;ch h&agrave;ng c&aacute;c sản phẩm/ giải ph&aacute;p/ dịch vụ c&ocirc;ng nghệ tối ưu nhất đ&atilde; gi&uacute;p Ismart.com&nbsp;ph&aacute;t triển mạnh mẽ trong những năm qua. V&agrave;&nbsp;trở th&agrave;nh website&nbsp;tốt&nbsp;nhất trong khu vực kinh tế tư nh&acirc;n của Việt Nam với hơn&nbsp;<strong>28.000</strong>&nbsp;c&aacute;n bộ nh&acirc;n vi&ecirc;n, trong đ&oacute; c&oacute;&nbsp;<strong>17.628</strong>&nbsp;nh&acirc;n sự khối C&ocirc;ng nghệ để ph&aacute;t triển.&nbsp;</p>\r\n', 'Giới thiệu', NULL, 'Approved', 'admin', '03/02/2022'),
(2, 'Liên hệ với chúng tôi để được chuyên viên cung cấp thông tin chính xác hơn về sản phẩm', 'lien-he', '<p><strong style=\"color: rgb(0, 0, 0);\">Th&ocirc;ng tin li&ecirc;n hệ:</strong>&nbsp;<strong><u>Ismart.com</u></strong></p>\r\n\r\n<p><u><strong>S</strong><a href=\"http://localhost:8181/Unt/Front-end/Repeat%20-%20Exercise/Congcu&amp;ptpmqt/contact.html#\"><span style=\"color:#000000;\"><strong><strong>ĐT</strong>:</strong></span>&nbsp;</a><strong>0377.953.849</strong></u></p>\r\n\r\n<p><u><a href=\"http://localhost:8181/Unt/Front-end/Repeat%20-%20Exercise/Congcu&amp;ptpmqt/contact.html#\"><span style=\"color:#000000;\"><strong>Email:</strong></span>&nbsp;</a><strong>htinh7444@gmail.com</strong></u></p>\r\n\r\n<p><u><a href=\"http://localhost:8181/Unt/Front-end/Repeat%20-%20Exercise/Congcu&amp;ptpmqt/contact.html#\"><span style=\"color:#000000;\"><strong>Địa chỉ:</strong></span>&nbsp;</a><strong>145 &Acirc;u Cơ, Quận Li&ecirc;n Chiểu, TP Đ&agrave; Nẵng</strong></u></p>\r\n', 'public/images/upload/pages/baeminceo.jpg', '<h3><em>Để kh&ocirc;ng ngừng n&acirc;ng cao chất lượng dịch vụ v&agrave; đ&aacute;p ứng tốt hơn nữa c&aacute;c y&ecirc;u cầu của bạn, ch&uacute;ng t&ocirc;i mong muốn nhận được c&aacute;c th&ocirc;ng tin phản hồi. Nếu bạn&nbsp;c&oacute; bất kỳ thắc mắc hoặc đ&oacute;ng g&oacute;p n&agrave;o, xin vui l&ograve;ng li&ecirc;n hệ với ch&uacute;ng t&ocirc;i theo th&ocirc;ng tin dưới đ&acirc;y. Ch&uacute;ng t&ocirc;i sẽ phản hồi lại bạn&nbsp;trong thời gian sớm nhất.</em></h3>\r\n\r\n<div class=\"ddict_btn\" style=\"top: 75px; left: 779.763px;\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n', 'Liên hệ', NULL, 'Approved', 'admin', '11/01/2022'),
(3, 'Doanh nghiệp EU tìm kiếm cơ hội hợp tác đầu tư công nghệ xanh tại Việt Nam', 'gioi-thieu', '<p>Trung t&acirc;m mạng lưới doanh nghiệp EU - Việt Nam (EBVN) cho biết, c&oacute; 6 doanh nghiệp (DN) ch&acirc;u &Acirc;u đ&atilde; tham gia v&agrave;o Chương tr&igrave;nh x&uacute;c tiến thương mại lĩnh vực c&ocirc;ng nghệ xanh của EVBN nhằm t&igrave;m hiểu về thị trường c&ocirc;ng nghệ xanh tại Việt Nam v&agrave; t&igrave;m kiếm cơ hội hợp t&aacute;c đầu tư với c&aacute;c đối t&aacute;c Việt Nam.</p>\r\n', 'public/images/upload/pages/doanhnghiep.jpg', '<p>Trọng t&acirc;m của chương tr&igrave;nh x&uacute;c tiến thương mại l&agrave; việc c&aacute;c DN ch&acirc;u &Acirc;u đ&atilde; tham gia v&agrave;o gian h&agrave;ng trưng b&agrave;y những sản phẩm v&agrave; c&ocirc;ng nghệ trong lĩnh vực c&ocirc;ng nghệ xanh trong khu gian h&agrave;ng của EVBN (European Pavilion) thuộc Triển l&atilde;m quốc tế h&agrave;ng đầu về ng&agrave;nh tiết kiệm năng lượng v&agrave; năng lượng t&aacute;i tạo tại Việt Nam (RE &amp; EE Vietnam 2016) đang diễn ra từ ng&agrav', 'Giới thiệu', NULL, 'Approved', 'admin', '11/01/2022'),
(4, 'Djokovic thắng kiện ở tòa án, tiếp tục ở lại Australia', 'gioi-thieu', '<p>V&agrave;o đ&ecirc;m qua (5/1), Novak Djokovic đ&atilde; bị Lực lượng Bi&ecirc;n ph&ograve;ng Australia giữ lại thẩm vấn trong 8 tiếng tại s&acirc;n bay Melbourne, sau đ&oacute; thị thực của tay vợt người Serbia đ&atilde; bị hủy. Djokovic được đưa về tạm tr&uacute; tại kh&aacute;ch sạn Park ở Carlton v&agrave; y&ecirc;u cầu phải rời Australia ngay trong ng&agrave;y h&ocirc;m nay (6/1).</p>\r\n', 'public/images/upload/pages/tennis.jpg', '<p>Ngay sau khi thị thực của Djokovic bị hủy, đội ngũ luật sư của tay vợt người Serbia đ&atilde; kiện l&ecirc;n T&ograve;a &aacute;n Li&ecirc;n bang nhằm chống lại quyết định của Lực lượng Bi&ecirc;n ph&ograve;ng Australia. Được biết c&aacute;c luật sư của Djokovic gi&agrave;nh chiến thắng bước đầu sau phi&ecirc;n điều trần trực tuyến, nhờ đ&oacute; Djokovic sẽ kh&ocirc;ng phải rời Australia trong ng&agrave;y h&ocirc;m nay.</p>\r\n', 'Giới thiệu', NULL, 'Approved', 'admin', '11/01/2022');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `post_slug` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `post_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `post_desc` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `post_thumb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `post_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `parent_cat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `active` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `approver` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `approver_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `post_title`, `post_slug`, `post_content`, `post_desc`, `post_thumb`, `post_status`, `parent_cat`, `active`, `create_date`, `creator`, `editor`, `edit_date`, `approver`, `approver_date`, `cat_id`) VALUES
(12, 'HLV Malaysia phủ nhận nội bộ lục đục trước trận gặp đội tuyển Việt Nam', 'hlv-malaysia-phu-nhan-noi-bo-luc-duc-00', '<p>&quot;T&ocirc;i kh&ocirc;ng r&otilde; th&ocirc;ng tin từ đầu, nhưng t&ocirc;i kh&ocirc;ng thấy c&oacute; vấn đề g&igrave; lớn trong đội cả. Mọi người c&oacute; thể thấy rằng, c&aacute;c cầu thủ của t&ocirc;i đ&atilde; l&agrave;m việc rất chăm chỉ trong trận đấu. Tất nhi&ecirc;n, c&aacute;c cầu thủ đ&ocirc;i khi c&oacute; xu hướng thể hiện sự thất vọng. Đ&oacute; l&agrave; một phần của b&oacute;ng đ&aacute;&quot;, HLV Tan Cheng Hoe ph&aacute;t biểu tr&ecirc;n tờ New Straits Times của Malaysia.</p>\r\n', '<p>Đặc biệt sau trận thắng Campuchia ng&agrave;y ra qu&acirc;n, cầu thủ Akhyar Rashid đưa ra ph&aacute;t biểu nhạy cảm: &quot;Thật tuyệt vời khi gi&agrave;nh chiến thắng ở trận đấu c&oacute; nhiều cầu thủ nội hơn trong đội h&igrave;nh xuất ph&aacute;t&quot;.</p>\r\n', 'public/images/upload/posts/malaysia.jpg', 'Approved', 'Bóng đá trong nước', 'không hoạt động', '08/12/21 09:12', 'Hà Quan Tính', 'Hà Quan Tính', '21/12/21 04:12', '', NULL, NULL),
(13, 'Messi và Mbappe lập cú đúp, PSG phục hận trước Club Brugge', 'messi-va-mbappe-lap-cu-dup', '<p>Ở lượt đầu ti&ecirc;n của v&ograve;ng bảng Champions League, PSG đ&atilde; bị Club Brugge cầm h&ograve;a 1-1 tr&ecirc;n đất Bỉ. Đ&oacute; l&agrave; trận đấu kh&oacute; khăn của đội b&oacute;ng tới từ nước Ph&aacute;p v&agrave; việc chỉ gi&agrave;nh được một điểm khiến PSG chịu nhiều sự chỉ tr&iacute;ch. Tuy nhi&ecirc;n, mọi sự kh&oacute; chịu do Club Brugge mang lại đ&atilde; được PSG tr&uacute;t bỏ ở lượt trận cuối c&ugrave;ng khi hai đội gặp lại nhau tại Paris.</p>\r\n', '<p>C&oacute; th&ecirc;m ba điểm từ lượt đấu cuối c&ugrave;ng, PSG kết th&uacute;c v&ograve;ng bảng ở vị tr&iacute; thứ hai với 11 điểm, k&eacute;m đội đầu bảng&nbsp;<a data-auto-link-id=\"613222b5fb044100119a1441\" href=\"https://dantri.com.vn/man-city.tag\">Man City</a>&nbsp;một điểm. Club Brugge vẫn chỉ c&oacute; một điểm.</p>\r\n', 'public/images/upload/posts/messi.jpg', 'Approved', 'Bóng đá châu âu', 'không hoạt động', '08/12/21 09:12', 'Hà Quan Tính', 'Hà Quan Tính', '22/12/21 08:12', '', NULL, NULL),
(14, 'Đảng viêng được chuyển tiền khôn ra nước ngoài trái quy định', 'dang-vien-duoc-chuyen-tien', '<p>Trong Quy định số 37 của Trung ương, Điều 9 quy định, Đảng vi&ecirc;n kh&ocirc;ng được b&aacute;o c&aacute;o, lập hồ sơ, k&ecirc; khai l&yacute; lịch, k&ecirc; khai t&agrave;i sản, thu nhập kh&ocirc;ng trung thực. Sử dụng văn bằng, chứng chỉ, chứng nhận giả, kh&ocirc;ng hợp ph&aacute;p;&nbsp;<a contenteditable=\"false\" href=\"https://dantri.com.vn/xa-hoi/dang-vien-khong-duoc-nhap-quoc-tich-mua-tai-san-o-nuoc-ngoai-20211027203355638.htm\">nhập quốc tịch, chuyển tiền, t&agrave;i sản ra nước ngo&agrave;i</a>, mở t&agrave;i khoản v&agrave; mua b&aacute;n t&agrave;i sản ở ngo&agrave;i tr&aacute;i quy định.&nbsp;</p>\r\n', '<p>Ủy ban Kiểm tra Trung ương đ&atilde; c&oacute; hướng dẫn cụ thể thực hiện điều tr&ecirc;n.&nbsp;Theo đ&oacute;, đảng vi&ecirc;n kh&ocirc;ng được b&aacute;o c&aacute;o, lập hồ sơ, k&ecirc; khai l&yacute; lịch, lịch sử bản th&acirc;n kh&ocirc;ng đ&uacute;ng, kh&ocirc;ng đầy đủ, kh&ocirc;ng cụ thể, kh&ocirc;ng r&otilde; r&agrave;ng; che giấu, tẩy x&oacute;a, th&ecirc;m bớt, thay đổi t&agrave;i liệu, th&ocirc;ng tin trong hồ sơ, hoặc k&ecirc; khai kh&ocirc;ng đ&uacute;ng quy định về nội dung, thời gian, thời điểm, người v&agrave; nơi quản l&yacute; hoặc thủ tục x&aacute;c nhận.</p>\r\n', 'public/images/upload/posts/hanoi.jpg', 'Approved', 'Xã Hội ', 'không hoạt động', '08/12/21 09:12', 'Hà Quan Tính', 'Hà Quan Tính', '21/12/21 04:12', '', NULL, NULL),
(15, 'Tổng Bí thư: Văn kiện Đại hội Đảng phải phản ánh tiếng nói chung', 'tong-bi-thu-van-kien-dai-hoi-dang-phai-phan-anh-tieng-noi-chung', '<p>S&aacute;ng nay (11/11), tại TP Hạ Long, tỉnh Quảng Ninh v&agrave; Tập đo&agrave;n C&ocirc;ng nghiệp - Than Kho&aacute;ng sản Việt Nam (TKV) đ&atilde; tổ chức gặp mặt Kỷ niệm 85 năm Ng&agrave;y Truyền thống c&ocirc;ng nh&acirc;n v&ugrave;ng mỏ - truyền thống ng&agrave;nh Than 12/11 (1936- 2021), tuy&ecirc;n dương c&aacute;c điển h&igrave;nh ti&ecirc;n tiến.&nbsp;</p>\r\n', '<p>B&iacute; thư Tỉnh ủy Nguyễn Xu&acirc;n K&yacute;, l&atilde;nh đạo UBND tỉnh, l&atilde;nh đạo TKV, c&aacute;c l&atilde;nh đạo, nguy&ecirc;n l&atilde;nh đạo tỉnh Quảng Ninh, ng&agrave;nh Than qua c&aacute;c thời kỳ c&ugrave;ng dự.</p>\r\n\r\n<p>V&ugrave;ng mỏ Quảng Ninh được biết đến c&aacute;i n&ocirc;i phong tr&agrave;o c&aacute;ch mạng của giai cấp c&ocirc;ng nh&acirc;n.</p>\r\n', 'public/images/upload/posts/bi-thu-tinh.jpg', 'Approved', 'Xã Hội ', 'không hoạt động', '08/12/21 09:12', 'Hà Quan Tính', 'Hà Quan Tính', '31/01/22 12:01', '', NULL, NULL),
(16, 'Giá USD bất ngờ tăng mạnh nhất 2 năm qua', 'gia-tien-bat-ngo-tang-manh', '<p>Chiều nay 6/12, gi&aacute; USD tiếp tục được c&aacute;c ng&acirc;n h&agrave;ng điều chỉnh tăng mạnh so với phi&ecirc;n s&aacute;ng.</p>\r\n\r\n<p>B&aacute;o gi&aacute; từ&nbsp;<a data-auto-link-id=\"6131d2a9fb044100119a1430\" href=\"https://dantri.com.vn/vietcombank.tag\">Vietcombank</a>&nbsp;cho thấy, gi&aacute; mua - b&aacute;n USD l&agrave; 222.930 - 23.170 đồng, tăng tiếp 150 đồng mỗi chiều so với s&aacute;ng nay v&agrave; tăng tới 220 - 260 đồng mỗi chiều so với chốt phi&ecirc;n cuối tuần trước.</p>\r\n\r\n<p>Tại VietinBank, USD cũng tăng mạnh 320 - 360 đồng mỗi chiều so với chốt phi&ecirc;n cuối tuần qua, l&ecirc;n 23.005 - 23.245 đồng (mua - b&aacute;n).</p>\r\n', '<p>Tại khối ng&acirc;n h&agrave;ng thương mại cổ phần tư nh&acirc;n, sau 31 lần điều chỉnh, gi&aacute; USD hiện được c&aacute;c ng&acirc;n h&agrave;ng giao dịch ở 23.040 - 23.240 đồng, tức tăng mỗi chiều 340 đồng v&agrave; 370 đồng.</p>\r\n\r\n<p>H&ocirc;m nay (6/12), tỷ gi&aacute; trung t&acirc;m đột ngột được điều chỉnh tăng mạnh tới 38 đồng so với phi&ecirc;n liền trước, đang được ni&ecirc;m yết ở mức 23.165 đồng/USD.</p>\r\n', 'public/images/upload/posts/gia-usd.jpg', 'Approved', 'Chứng khoáng', 'không hoạt động', '08/12/21 09:12', 'Hà Quan Tính', 'Hà Quan Tính', '25/01/22 10:01', '', NULL, NULL),
(17, 'Phát hành \"chui\" hơn 500 tỷ đồng trái phiếu, Apec Group bị phạt', 'phat-hanh-chui-hon-500', '<p>Ủy ban&nbsp;<a data-auto-link-id=\"61323072fb044100119a1454\" href=\"https://dantri.com.vn/kinh-doanh/chung-khoan.htm\">Chứng kho&aacute;n</a>&nbsp;Nh&agrave; nước (UBCKNN) mới đ&acirc;y c&oacute; quyết định xử phạt đối với CTCP Tập đo&agrave;n Apec Group (H&agrave; Nội) về h&agrave;nh vi vi phạm trong việc c&ocirc;ng bố th&ocirc;ng tin khi ch&agrave;o b&aacute;n tr&aacute;i phiếu.</p>\r\n', '<p>Cụ thể, CTCP Tập đo&agrave;n Apec Group (Apec Group) ch&agrave;o b&aacute;n một l&ocirc; tr&aacute;i phiếu với trị gi&aacute; 8,1 tỷ đồng trong năm 2020 v&agrave; 16 l&ocirc; tr&aacute;i phiếu kh&aacute;c với tổng gi&aacute; trị 499,707 tỷ đồng trong giai đoạn từ 18/1 đến 6/8 năm nay ra c&ocirc;ng ch&uacute;ng th&ocirc;ng qua phương tiện th&ocirc;ng tin đại ch&uacute;ng v&agrave; cho c&aacute;c nh&agrave; đầu tư kh&ocirc;ng x&aacute;c định.</p>\r\n', 'public/images/upload/posts/hoi-nghi-trung-uong-4-copy.jpg', 'Approved', 'Chính trị', 'không hoạt động', '08/12/21 09:12', 'Hà Quan Tính', 'Hà Quan Tính', '31/01/22 12:01', '', NULL, NULL),
(18, 'Marathon Trung Nam ', 'marathon-trung-nam-vuot-trung-khoi', '<p>Đ&acirc;y l&agrave; cung đường chạy ở v&ugrave;ng biển ph&iacute;a Đ&ocirc;ng của miền T&acirc;y Nam Bộ. Giải đấu được tổ chức tr&ecirc;n c&acirc;y cầu dẫn với đường chạy d&agrave;i 25km tại một trong những dự &aacute;n điện gi&oacute; tr&ecirc;n biển đầu ti&ecirc;n của Việt Nam hiện tại - Nh&agrave; m&aacute;y điện gi&oacute; Đ&ocirc;ng Hải 1 của Trungnam Group.</p>\r\n', '<p>Giải đấu c&oacute; quy m&ocirc; hơn 600 Vận động vi&ecirc;n chuy&ecirc;n nghiệp v&agrave; b&aacute;n chuy&ecirc;n nghiệp tr&ecirc;n khắp cả nước c&ugrave;ng hội tụ về tỉnh Tr&agrave; Vinh, thể hiện tinh thần thể thao cao thượng v&agrave; sự tự h&agrave;o d&acirc;n tộc của c&aacute;c vận động vi&ecirc;n, người tham gia khi lần đầu ti&ecirc;n được chạy tr&ecirc;n v&ugrave;ng biển qu&ecirc; hương.</p>\r\n', 'public/images/upload/posts/que-huong.jpeg', 'Approved', 'Thể thao', 'không hoạt động', '26/01/22 03:01', 'Hà Quan Tính', 'Hà Quan Tính', '31/01/22 12:01', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_posts_cat`
--

CREATE TABLE `tbl_posts_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `cat_slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_order` int(50) NOT NULL,
  `cat_status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `parent_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_posts_cat`
--

INSERT INTO `tbl_posts_cat` (`cat_id`, `cat_title`, `cat_slug`, `num_order`, `cat_status`, `create_date`, `creator`, `editor`, `edit_date`, `parent_id`) VALUES
(22, 'Thể thao', 'the-thao', 1, 'Approved', '08/12/21 08:12', 'Hà Quan Tính', 'Hà Quan Tính', '17/12/21 06:12', 0),
(23, 'Bóng đá trong nước', 'bong-da-trong-nuoc', 2, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 22),
(24, 'Bóng đá châu âu', 'bong-da-chau-au', 3, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 22),
(25, 'Xã Hội ', 'xa-hoi', 4, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 0),
(26, 'Chính trị', 'chinh-tri', 5, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 25),
(27, 'Ngoại thương', 'ngoai-thuong', 6, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 25),
(28, 'Kinh doanh', 'kinh-doanh', 7, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 0),
(30, 'Chứng khoáng', 'chung-khoang', 8, 'Approved', '08/12/21 09:12', 'Hà Quan Tính', '', '', 28),
(31, 'Doanh nghiệp', 'doanh-nghiep', 9, 'Approved', '11/12/21 02:12', 'Hà Quan Tính', '', '', 28);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_slug` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_thumb` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_price_new` int(12) NOT NULL,
  `product_price_old` int(12) NOT NULL,
  `product_desc` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `parent_cat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_qty` int(12) NOT NULL,
  `product_num` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_sold` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `product_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_code`, `product_title`, `product_slug`, `product_thumb`, `product_price_new`, `product_price_old`, `product_desc`, `product_content`, `parent_cat`, `product_brand`, `product_type`, `product_qty`, `product_num`, `product_sold`, `product_status`, `creator`, `create_date`, `editor`, `edit_date`) VALUES
(2, 'MKGP3SA/A', 'Laptop MacBook Pro 14 M1 Pro 2021', 'laptop-macbook-pro-14-m1-pro-2021', 'public/images/upload/products/apple-macbook-pro-14-m1-pro.jpg', 52990000, 51000000, 'Sự đẳng cấp không chỉ ở thiết kế thời thượng, sang trọng mà còn sở hữu sức mạnh siêu năng với con chip Apple M1 Pro phiên bản nâng cấp ấn tượng đến từ nhà Apple, mang đến cho bạn trải nghiệm làm việc chuyên nghiệp nhất dù là các tác vụ đồ họa - kỹ thuật chuyên sâu.', '<p><a href=\"https://www.thegioididong.com/tin-tuc/apple-m1-pro-la-gi-1391496\" target=\"_blank\" title=\"Tìm hiểu thêm về chip Apple M1 Pro\">Apple M1 Pro</a>&nbsp;l&agrave; phi&ecirc;n bản kế nhiệm của con chip Apple M1 với tiến tr&igrave;nh&nbsp;<strong>5 nm</strong>, t&iacute;ch hợp&nbsp;<strong>8&nbsp;l&otilde;i CPU</strong>&nbsp;với&nbsp;<strong>6&nbsp;l&otilde;i&nbsp;</strong>hiệu suất cao v&agrave;&nbsp;<strong>2&nbsp;l&otilde;i</strong>&nbsp;tiết kiệm điện mang đến cho bạn một hiệu suất l&agrave;m việc cực kỳ cao với tốc độ xử l&yacute; nhanh ch&oacute;ng nhanh hơn&nbsp;<strong>70%&nbsp;</strong>v&agrave; hiệu năng tăng&nbsp;<strong>1.7 lần&nbsp;</strong>so với c&aacute;c thế hệ tiền nhiệm đồng thời tiết kiệm một lượng điện năng đ&aacute;ng kể để k&eacute;o d&agrave;i thời lượng pin hơn.</p>\r\n', 'Máy tính', '', '', 1, '2', '1', 'Approved', 'Hà Quan Tính', '11/12/21 03:12', 'Hà Quan Tính', '18/12/21 11:12'),
(10, 'MKGP3SA/S', 'Laptop Apple MacBook Pro 16 M1 Max 2021', 'laptop-apple-macbook-pro-16-m1-pro-2021', 'public/images/upload/products/apple-macbook-pro-16-m1-max.jpg', 90990000, 90000000, 'Thật ấn tượng với Apple MacBook Pro 16 M1 Max 2021 mang trên mình \"bộ áo mới\" độc đáo, cuốn hút mọi ánh nhìn cùng màn hình tai thỏ lần đầu tiên xuất hiện ở dòng Mac và ẩn bên trong là bộ cấu hình mạnh mẽ tuyệt vời đến từ con chip M1 Max tân tiến.', '<p><a href=\"https://www.thegioididong.com/apple-macbook-pro-2021\" target=\"_blank\" title=\"Các sản phẩm Macbook Pro 2021 hiện đang bán tại thegioididong.com\">MacBook Pro 2021</a>&nbsp;với những cải tiến vượt bậc về mặt hiệu năng, hứa hẹn gi&uacute;p người d&ugrave;ng c&oacute; trải nghiệm mượt m&agrave; trong c&aacute;c t&aacute;c vụ nặng như chỉnh sửa h&igrave;nh ảnh phức tạp, render video,... hướng đến đối tượng người d&ugrave;ng c&oacute; nhu cầu sản xuất, s&aacute;ng tạo nội dung, kỹ thuật, c&ocirc;n nghệ chuy&ecirc;n nghiệp.</p>\r\n', 'Máy tính', '', '', 1, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', 'Hà Quan Tính', '18/12/21 11:12'),
(11, 'MKGP3SA/X', 'Laptop MacBook Pro 14 M1 Max 2021', 'laptop-macbook-pro-14-m1-max-2021', 'public/images/upload/products/macbook-pro-m1-2020-gray.jpg', 87900000, 85900000, 'Sự ra đời của chiếc MacBook Pro 14 M1 Max 2021 như đại diện cho một thế hệ laptop mới, tân tiến và đầy tiềm năng với bộ vi xử lý hiện đại, cùng thiết kế sang trọng, thời thượng, xứng tầm người cộng sự đắc lực trên mọi cuộc hành trình của bạn.', '<p>Dựa v&agrave;o nền tảng của&nbsp;<strong>chip M1</strong>, bộ vi xử l&yacute;&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/apple-m1-max-la-gi-1391498\" target=\"_blank\" title=\"Tìm hiểu về chip Apple M1 Max\">Apple M1 Max</a>&nbsp;được n&acirc;ng cấp v&agrave; cải tiến mang đến tốc độ xử l&yacute; đ&aacute;ng kinh ngạc trong hầu hết mọi t&aacute;c vụ, được đ&aacute;nh gi&aacute; l&agrave; nhanh hơn đến<strong>&nbsp;70%</strong>&nbsp;so với thế hệ tiền nhiệm. Kh&ocirc;ng dừng lại ở đ&oacute;, c&aacute;c t&aacute;c vụ đồ họa cũng được đẩy nhanh hơn gấp<strong>&nbsp;4 lần</strong>&nbsp;so với chip M1 nhờ hiệu suất vượt trội của card đồ họa&nbsp;<strong>GPU 32 l&otilde;i lớn</strong>. Thế nhưng con chip n&agrave;y vẫn đảm bảo tiết kiệm điện năng tối ưu d&ugrave; mang đến hiệu năng cực khủng.</p>\r\n', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(12, 'MKGP3SA/Y', 'Laptop Apple MacBook Pro 14 M1 Pro 2021', 'laptop-apple-macbook-pro-14-m1-pro-2021', 'public/images/upload/products/apple-macbook-pro-m1-2020.jpg', 64990000, 64000000, 'Apple MacBook Pro 14 inch M1 Pro 2021 gây ấn tượng mạnh khi mang trên mình vẻ ngoài có nhiều cải tiến mới, độc đáo và cuốn hút mọi ánh nhìn cùng hiệu năng mạnh mẽ, đỉnh cao đến từ con chip M1 Pro hiện đại, đáp ứng tối ưu nhu cầu sử dụng cho giới công nghệ, kỹ thuật cũng như cá nhà sáng tạo nội dung chuyên nghiệp.', '<p><strong>MacBook Pro 14 inch M1 Pro 2021</strong>&nbsp;sở hữu bộ CPU&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/apple-m1-pro-la-gi-1391496\" target=\"_blank\" title=\"Tìm hiểu về chip Apple M1 Pro\"><strong>Apple M1 Pro</strong></a>&nbsp;cấu tr&uacute;c&nbsp;<strong>10 nh&acirc;n</strong>&nbsp;mang một sức mạnh hiệu năng v&ocirc; c&ugrave;ng mạnh mẽ được sản xuất dựa tr&ecirc;n tiến tr&igrave;nh l&agrave;&nbsp;<strong>5 nm</strong>, c&oacute; tận&nbsp;<strong>33.7 tỷ</strong>&nbsp;b&oacute;ng b&aacute;n dẫn đạt&nbsp;tốc độ băng th&ocirc;ng l&ecirc;n đến&nbsp;<strong>200GB/s memory bandwidth</strong><strong>&nbsp;</strong>cho hiệu&nbsp;suất của Apple nhanh hơn khoảng&nbsp;<strong>70%&nbsp;</strong>so với thế hệ tiền nhiệm Apple M1,&nbsp;từ đ&oacute; đem lại cho bạn một tốc độ xử l&yacute; đ&aacute;ng kinh ngạc gi&uacute;p giải quyết tốt từ c&aacute;c c&ocirc;ng việc văn ph&ograve;ng cơ bản đến phức tạp tr&ecirc;n c&aacute;c phần mềm Office 365 cũng như đồ họa chuy&ecirc;n nghiệp t', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(14, 'MKGP3SA/G', 'Laptop Asus ROG Zephyrus G14 Alan Walker GA401QEC ', 'laptop-asusrog-zephyrus-g14-alan-walker-ga401qec-r9', 'public/images/upload/products/asus-rog-zephyrus-gaming.jpg', 44990000, 44000000, 'Cùng bạn đối đầu mọi thách thức trên chiến trường ảo nhờ bộ vi xử lý mạnh mẽ AMD và phong cách thiết kế độc đáo, khẳng định chất tôi riêng của siêu phẩm độc nhất vô nhị Asus ROG Zephyrus Gaming G14 Alan Walker (K2064T), hứa hẹn sẽ mang đến những trải nghiệm tuyệt hảo khó quên cho người dùng. Nếu là một fan của Alan Walker thì đây chính là sản phẩm bạn không thể bỏ lỡ.', '<p>Đập v&agrave;o mắt người d&ugrave;ng l&agrave; 2 mảnh vải đen th&ecirc;u chữ trắng nổi bật được ốp tr&ecirc;n nắp lưng m&aacute;y được l&agrave;m thủ c&ocirc;ng ho&agrave;n to&agrave;n bằng tay, ph&iacute;a g&oacute;c dưới l&agrave; chữ k&yacute; của ch&iacute;nh DJ Alan Walker được khắc bằng laser tinh xảo, đảm bảo mọi &aacute;nh nh&igrave;n xung quanh sẽ đổ dồn về chủ nh&acirc;n sở hữu si&ecirc;u phẩm n&agrave;y.&nbsp;</p>\r\n', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(15, 'MKGP3SA/K', 'Laptop Asus TUF Gaming FX506HCB i5', 'laptop-asus-tuf-gaming-fx506hcb-i5', 'public/images/upload/products/asus-tuf-gaming-fx506hcb.jpg', 24990000, 24990000, 'Laptop Asus TUF Gaming FX506HCB i5 (HN1138W) không chỉ mang trong mình bộ CPU Intel Core i5 thế hệ 11 mạnh mẽ mà còn sở hữu ngoại hình ấn tượng, cho bạn thỏa sức sáng tạo đồ họa cũng như chiến game cực đã.', '<p>Vẻ ngo&agrave;i mạnh mẽ được chế t&aacute;c từ nhựa cao cấp, nắp lưng bằng kim loại bền bỉ t&ocirc; th&ecirc;m phần nổi bật với logo TUF, phủ sắc x&aacute;m thời thượng, tổng thể như một cỗ m&aacute;y chiến đấu đầy uy lực nhưng vẫn rất nổi bật, bắt mắt.</p>\r\n', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(16, 'MKGP3SA/C', 'Laptop Asus TUF Gaming FX516PM i7', 'laptop-asus-tuf-gaming-fx516pm-i7', 'public/images/upload/products/asus-tuf-gaming-fx516pm-i7.jpg', 30840000, 30800000, 'Diện mạo thanh lịch nhưng sở hữu cấu hình mạnh mẽ vượt trội, laptop Asus TUF Gaming FX516PM i7 11370H (HN002T) hứa hẹn sẽ cùng bạn chinh chiến trên mọi chiến trường ảo cùng ưu thế thuận lợi nhất.', '<p>Đ&aacute;nh thức sức mạnh thật sự nhờ bộ vi xử l&yacute; mạnh mẽ&nbsp;<a href=\"https://www.thegioididong.com/laptop?g=core-i7\" target=\"_blank\" title=\"Một số laptop có CPU Intel Core i7 đang kinh doanh tại thegioididong.com\">Intel Core i7</a>&nbsp;<strong>Tiger Lake 11370H</strong>&nbsp;sở hữu&nbsp;<strong>4 nh&acirc;n 8 luồng</strong>&nbsp;cho tốc độ cơ bản đạt&nbsp;<strong>3.30 GHz</strong>&nbsp;v&agrave; đạt tối đa l&ecirc;n đến&nbsp;<strong>4.8 GHz</strong>&nbsp;nhờ&nbsp;<strong>Turbo Boost,</strong>&nbsp;mang đến kh&ocirc;ng gian giải tr&iacute; cực đ&atilde; với h&agrave;ng loạt c&aacute;c tựa game thịnh h&agrave;nh hay trở th&agrave;nh người cộng sự đắc lực, c&ugrave;ng bạn ho&agrave;n th&agrave;nh c&aacute;c nhiệm vụ trong văn ph&ograve;ng nhanh ch&oacute;ng một c&aacute;ch hiệu quả c&ugrave;ng Work, Excel,...</p>\r\n', 'Máy tính', '', '', 0, '1', '1', 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(17, 'MKGP3SA/G', 'Laptop Asus ROG Strix Gaming G15 G513IH R7', 'laptop-asus-rog-strix-gaming-g15-g513ih-r7', 'public/images/upload/products/asus-rog-strix-gaming-g15.jpg', 21810000, 21810000, 'Laptop Asus ROG Strix Gaming G15 G513IH R7 4800H (HN015T) sở hữu cấu hình vượt trội cùng thiết kế độc đáo, thu hút mọi ánh nhìn, nhất là những game thủ đam mê trải nghiệm những trận chiến ảo đầy kịch tính, sẵn sàng đi cùng bạn đến bất kỳ đâu.', '<p><a href=\"https://www.thegioididong.com/laptop-asus\" target=\"_blank\" title=\"Một số laptop Asus đang kinh doanh tại thegioididong.com\">Laptop Asus</a>&nbsp;sở hữu trọng lượng&nbsp;<strong>2.1 kg</strong>&nbsp;v&agrave; d&agrave;y<strong>&nbsp;20.6 mm</strong>, với phần nắp lưng được thiết kế từ kim loại cao cấp v&agrave; lớp vỏ được chế t&aacute;c từ chất liệu nhựa bền bỉ, thuận lợi cho sự tản nhiệt, lu&ocirc;n trong trạng th&aacute;i sẵn s&agrave;ng t&aacute;c chiến c&ugrave;ng bạn tr&ecirc;n mọi chiến trường ảo đầy hấp dẫn.</p>\r\n', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(18, 'MKGP3SA/H', 'Laptop Asus TUF Gaming FX706HE i7', 'laptop-asus-tuf-gaming-fx706he-i7', 'public/images/upload/products/asus-tuf-gaming-fx706he-i7.jpg', 29890000, 29890000, 'Sự đẳng cấp của mẫu laptop Asus TUF Gaming FX706HE i7 11800H (HX011T) không chỉ thể hiện qua cấu hình mạnh mẽ từ CPU Intel Core i7 thế hệ 11 mà còn từ ngoại hình ấn tượng mà nó mang lại, bạn có thể thỏa sức sáng tạo đồ họa, chiến game cực đỉnh.', '<p>Asus TUF&nbsp;thể hiện th&ocirc;ng qua thiết kế với sự kết hợp lớp vỏ bằng nhựa v&agrave; nắp lưng bằng kim loại được bao bọc bởi m&agrave;u x&aacute;m cực chất Eclipse Gray.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&quot;&gt;</p>\r\n', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 03:12', '', ''),
(19, 'MKGP3HA/B', 'Điện thoại Samsung Galaxy Z ', 'dien-thoai-sam-sung-galaxy-fold3', 'public/images/upload/products/samsung-galaxy-z-fold-3.jpg', 41990000, 41990000, 'Galaxy Z Fold3 5G, chiếc điện thoại được nâng cấp toàn diện về nhiều mặt, đặc biệt đây là điện thoại màn hình gập đầu tiên trên thế giới có camera ẩn (08/2021). Sản phẩm sẽ là một “cú hit” của Samsung góp phần mang đến những trải nghiệm mới cho người dùng.', '<p>C&oacute; thể thấy mẫu smartphone Galaxy Z Fold3 lần n&agrave;y vẫn giữ nguy&ecirc;n ngoại h&igrave;nh c&ugrave;ng cơ chế m&agrave;n h&igrave;nh gập mở dạng quyển s&aacute;ch như của tiền nhiệm, hồ biến chiếc smartphone th&agrave;nh một chiếc m&aacute;y t&iacute;nh bảng mini một c&aacute;ch dễ d&agrave;ng v&agrave; ngược lại.</p>\r\n', 'Điện thoại', '', '', 0, '1', '1', 'Approved', 'Hà Quan Tính', '11/12/21 04:12', '', ''),
(20, 'MKGP3IK/O', 'Điện thoại Xiaomi 11T', 'dien-thoai-xi-ao-mi', 'public/images/upload/products/xiaomi-11t-grey.jpg', 11390000, 11000000, 'Xiaomi 11T 5G sở hữu màn hình AMOLED, viên pin siêu khủng cùng camera độ phân giải 108 MP, chiếc smartphone này của Xiaomi sẽ đáp ứng mọi nhu cầu sử dụng của bạn, từ giải trí đến làm việc đều vô cùng mượt mà. ', '<p>Xiaomi đ&atilde; trang bị cho m&aacute;y cụm 3 camera sau gồm camera ch&iacute;nh 108 MP, camera g&oacute;c rộng c&oacute; độ ph&acirc;n giải 8 MP c&ugrave;ng camera telemacro 5 MP kết hợp c&ugrave;ng phần cứng b&ecirc;n trong cho khả năng lấy n&eacute;t, thu s&aacute;ng v&agrave; zoom cực tốt để cho ra những bức ảnh chi tiết d&ugrave; bạn chụp gần hay chụp xa.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 04:12', '', ''),
(21, 'MKGP3OI/Y', 'Điện thoại OPPO Reno6 ', 'dien-thoai-oppo-renno6', 'public/images/upload/products/oppo-reno6-z-5g-auroro.jpg', 9490000, 9000000, 'Reno6 Z 5G đến từ nhà OPPO với hàng loạt sự nâng cấp và cải tiến không chỉ ngoại hình bên ngoài mà còn sức mạnh bên trong. Đặc biệt, chiếc điện thoại được hãng đánh giá “chuyên gia chân dung bắt trọn mọi cảm xúc chân thật nhất”, đây chắc chắn sẽ là một “siêu phẩm\" mà bạn không thể bỏ qua.\r\n', '<p>Hệ thống camera sau được trang bị tối t&acirc;n, trong đ&oacute; c&oacute; camera ch&iacute;nh 64 MP,&nbsp;<a href=\"https://www.thegioididong.com/dtdd-camera-goc-rong\" target=\"_blank\" title=\"Tham khảo điện thoại có camera góc siêu rộng tại Thegioididong.com\">camera g&oacute;c si&ecirc;u rộng</a>&nbsp;8 MP v&agrave;&nbsp;<a href=\"https://www.thegioididong.com/dtdd-camera-macro\" target=\"_blank\" title=\"Tham khảo điện thoại có camera macro kinh doanh tại Thegioididong.com\">camera macro</a>&nbsp;2 MP c&ugrave;ng camera trước 32 MP lu&ocirc;n sẵn s&agrave;ng bắt trọn mọi cảm x&uacute;c trong khung h&igrave;nh, gi&uacute;p người d&ugrave;ng thoải m&aacute;i ghi lại những khoảnh khắc trong cuộc sống một c&aacute;ch ấn tượng nhất.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 04:12', '', ''),
(22, 'MKGP3UI/T', 'Điện thoại Vivo V23e ', 'dien-thoai-vivo-v23-e', 'public/images/upload/products/Vivo-V23e.jpg', 8490000, 8490000, 'Vivo V23e - sản phẩm tầm trung được đầu tư lớn về khả năng selfie cùng ngoại hình mỏng nhẹ, bên cạnh thiết kế vuông vức theo xu hướng hiện tại thì V23e còn có hiệu năng tốt và một viên pin có khả năng sạc cực nhanh', '<p>Vivo V23e vẫn giữ đặc điểm nổi bật của&nbsp;<a href=\"https://www.thegioididong.com/dtdd-vivo-v\" title=\"Tham khảo thông tin sản phẩm tại TGDD\">Vivo V Series</a>&nbsp;với thiết kế mỏng 7.36 mm ấn tượng (ở phi&ecirc;n bản m&agrave;u đen). Viền m&agrave;n h&igrave;nh 2 cạnh b&ecirc;n c&oacute; độ mỏng ở mức vừa phải, tuy nhi&ecirc;n th&igrave; phần cạnh dưới th&igrave; c&oacute; d&agrave;y hơn một ch&uacute;t.</p>\r\n', 'Điện thoại', '', '', 0, '1', '1', 'Approved', 'Hà Quan Tính', '11/12/21 05:12', '', ''),
(23, 'MKGP3KH/J', 'Điện thoại iPhone 13 128GB ', 'dien-thoai-iphone-13', 'public/images/upload/products/iphone-13-midnight.jpg', 24490000, 24490000, 'Trong khi sức hút đến từ bộ 4 phiên bản iPhone 12 vẫn chưa nguội đi, thì Apple đã mang đến cho người dùng một siêu phẩm mới iPhone 13 - điện thoại có nhiều cải tiến thú vị sẽ mang lại những trải nghiệm hấp dẫn nhất cho người dùng.', '<p>Con chip&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-chip-apple-a15-bionic-suc-manh-cuc-khung-duoc-he-1339072\" title=\"Tìm hiểu về con chip Apple A15 Bionic\">Apple A15 Bionic</a>&nbsp;si&ecirc;u mạnh được sản xuất tr&ecirc;n quy tr&igrave;nh 5 nm gi&uacute;p&nbsp;<a href=\"https://www.thegioididong.com/dtdd/iphone-13\" title=\"Tham khảo điện thoại iPhone 13 chính hãng tại thegioididong.com\">iPhone 13</a>&nbsp;đạt hiệu năng ấn tượng, với CPU nhanh hơn 50%,&nbsp;GPU nhanh hơn 30% so với c&aacute;c đối thủ trong c&ugrave;ng ph&acirc;n kh&uacute;c.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '11/12/21 05:12', '', ''),
(27, 'MKGP3KY/P', 'Tai nghe Bluetooth AirPods Pro MagSafe Charge Apple ', 'tai-nghe-bluetooth-airpods-pro', 'public/images/upload/products/bluetooth-airpods-pro.jpg', 52990000, 52980000, 'Tai nghe Bluetooth AirPods Pro MagSafe Charge Apple MLWK3 trắng được chế tác với vẻ ngoài tinh giản, gam màu trắng trẻ trung, sáng đẹp, phối hợp tuyệt vời với mọi trang phục từ đời thường đến công sở, dự tiệc của bạn. ', '<p>K&iacute;ch thước housing nhỏ nhắn đi k&egrave;m&nbsp;<strong>3 k&iacute;ch cỡ n&uacute;t tai&nbsp;</strong>mềm mại kh&aacute;c nhau cho bạn dễ d&agrave;ng lựa chọn để đảm bảo đeo tai nghe dạng&nbsp;<strong>in-ear</strong>&nbsp;thoải m&aacute;i, b&aacute;m chặt v&agrave;o khổ tai v&agrave; hỗ trợ loại bỏ tiếng ồn tối ưu. Mặt kh&aacute;c, hộp sạc c&oacute; dạng h&igrave;nh chữ nhật đặt tai nghe kiểu đứng gọn g&agrave;ng, an to&agrave;n với bản lề thiết kế vừa kh&iacute;t.</p>\r\n', 'Tai nghe', '', '', 0, '10', NULL, 'Approved', 'Hà Quan Tính', '11/01/22 05:01', '', ''),
(28, 'MKGP3KO/J', 'Tai nghe Bluetooth True Wireless Beats Studio Buds ', 'tai-nghe-bluetooth-true-wireless', 'public/images/upload/products/bluetooth-true-wireless-beats.jpg', 3192000, 3200000, 'Phiên bản Beats Studio Buds MJ503 màu đỏ cực bắt mắt với hộp sạc kiểu dáng mềm mại, mới lạ, rất trẻ trung cho người trẻ năng động. Vỏ ngoài hộp sạc và tai nghe dùng chất liệu nhựa nhám sang trọng, chống trầy, tiện lợi cho bạn mang theo đến mọi nơi nhờ kích thước gọn nhẹ.', '<p>Đi k&egrave;m theo thiết bị c&oacute;&nbsp;<strong>3 cặp đệm tai</strong>&nbsp;cỡ S-M-L tương th&iacute;ch cho mọi đối tượng người d&ugrave;ng.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/54/247433/bluetooth-true-wireless-beats-studio-buds-mj503-do-2-1.jpg\" onclick=\"return false;\"><img alt=\"Đệm tai êm ái - Beats Studio Buds MJ503 Đỏ\" data-src=\"https://cdn.tgdd.vn/Products/Images/54/247433/bluetooth-true-wireless-beats-studio-buds-mj503-do-2-1.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/54/247433/bluetooth-true-wireless-beats-studio-buds-mj503-do-2-1.jpg\" title=\"Đệm tai êm ái - Beats Studio Buds MJ503 Đỏ\" /></a></p>\r\n\r\n<h3>Thỏa m&atilde;n th&iacute;nh gi&aacute;c c&ugrave;ng chất &acirc;m đỉnh cao của tai nghe Beats</h3>\r\n\r\n<p>Nổi tiếng về chất lượng &acirc;m thanh, Beats lại c&agrave;ng tập trung cải thiện chất &acirc;m hơn nữa tr&ecirc;n tai nghe Beats Studio Buds MJ503, trang bị mỗi b&ecirc;n tai nghe với&nbsp;<strong>driver k&eacute;p độc quyền</strong>&nbsp;gi&uacu', 'Tai nghe', '', '', 0, '10', '2', 'Approved', 'Hà Quan Tính', '11/01/22 05:01', '', ''),
(29, 'MKGP3KQ/J', 'Tai nghe Bluetooth True Wireless Mozard', 'tai-nghe-bluetooth-true-wireless-mozard', 'public/images/upload/products/bluetooth-true-wireless-mozard-q8.jpg', 560000, 500000, 'Tai nghe Bluetooth True Wireless Mozard Q8 với 2 phiên bản màu xanh navy và trắng bạc sang trọng, tinh tế, dễ lựa chọn\r\nThiết kế hộp sạc nhỏ gọn với dáng hộp bo tròn mềm mại, chất liệu nhựa bóng trong suốt ở mặt chính nổi bật sản phẩm ở bên trong, rất tiện lợi để bạn bảo quản và mang theo.', '<p>K&iacute;ch thước&nbsp;<a href=\"https://www.thegioididong.com/tai-nghe\" target=\"_blank\" title=\"Tai nghe giá rẻ chính hãng bán tại Thế Giới Di Động\">tai nghe</a>&nbsp;nhỏ nhắn, đệm&nbsp;cao su &ecirc;m &aacute;i (đi k&egrave;m 3 cỡ đệm cao su),&nbsp;đảm bảo thoải m&aacute;i cho người d&ugrave;ng khi sử dụng trong thời gian d&agrave;i. Đồng thời, thật dễ d&agrave;ng để giữ chắc chắn tai nghe trong hộp sạc với ch&acirc;n gắn nam ch&acirc;m, an t&acirc;m để bạn mang theo tai nghe trong balo, giỏ x&aacute;ch tr&ecirc;n mọi h&agrave;nh tr&igrave;nh.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/54/232355/bluetooth-true-wireless-mozard-q8-191520-101525.jpg\" onclick=\"return false;\"><img alt=\"Thoải mái khi đeo - Tai nghe Bluetooth True Wireless Mozard Q8\" data-src=\"https://cdn.tgdd.vn/Products/Images/54/232355/bluetooth-true-wireless-mozard-q8-191520-101525.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/54/232355/bluetooth-true-wireless-mozard-q8-191520-101525.jpg\" title=\"Thoải mái ', 'Tai nghe', '', '', 0, '5', NULL, 'Approved', 'Hà Quan Tính', '11/01/22 05:01', '', ''),
(30, 'MKGP3KP/J', 'Tai nghe Bluetooth True Wireless Mozard ', 'tai-nghe-bluetooth-true-wireless', 'public/images/upload/products/tai-nghe-bluetooth-true-wireless-mozard-ts13.jpg', 290000, 299000, 'Tai nghe True Wireless sành điệu, màu đen cá tính\r\nLà mẫu tai nghe không dây thời thượng, Mozard TS13 tạo ấn tượng mạnh với củ tai nhỏ nhẹ, cho thao tác đeo, sử dụng cực thoải mái, tiện lợi. Trọng lượng chỉ 39 gam nên vô cùng thích hợp để mang theo bên mình đi bất kỳ đâu.\r\n\r\nHộp sạc thiết kế với những đường cong tinh tế, có tính thẩm mỹ cao, bản lề bật lên/đóng lại dễ dàng, nắp hộp và thân được làm khít và phủ một lớp nhựa nhám, ngăn côn trùng, bụi bẩn xâm nhập vào bên trong tối ưu. Khi sử dụng thì cảm giác rất bám tay, ít bám mồ hôi cũng như dấu vân tay, là sản phẩm có độ hoàn thiện cao so với trong phân khúc.', '<h3>T&aacute;i tạo chất &acirc;m s&ocirc;i động, mạnh mẽ cho bạn ho&agrave;n to&agrave;n h&ograve;a m&igrave;nh v&agrave;o thế giới &acirc;m nhạc b&ugrave;ng nổ</h3>\r\n\r\n<p>Trải nghiệm nghe nhạc lofi, nhạc h&aacute;t rất hay, phần bass nhẹ, ổn định, kể cả c&aacute;c bản bolero th&igrave; tai nghe vẫn đ&aacute;p ứng tốt.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/54/230363/tai-nghe-bluetooth-true-wireless-mozard-ts13-den-180520-110503.jpg\" onclick=\"return false;\"><img alt=\"Tai nghe Bluetooth True Wireless Mozard TS13 Đen - Tái tạo chất âm sôi động, mạnh mẽ\" data-src=\"https://cdn.tgdd.vn/Products/Images/54/230363/tai-nghe-bluetooth-true-wireless-mozard-ts13-den-180520-110503.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/54/230363/tai-nghe-bluetooth-true-wireless-mozard-ts13-den-180520-110503.jpg\" title=\"Tai nghe Bluetooth True Wireless Mozard TS13 Đen - Tái tạo chất âm sôi động, mạnh mẽ\" /></a></p>\r\n\r\n<h3>Trang bị 3 cặp đệm tai kh&aacute;c k&iacute;ch cỡ đeo vừa vặn nhiều khổ', 'Tai nghe', '', '', 1, '10', '6', 'Approved', 'Hà Quan Tính', '11/01/22 05:01', '', ''),
(31, 'MKGT13A/A', 'Tai nghe Bluetooth True Wireless Rezo QT13', 'tai-nghe-bluetooth-true-wireless-rezo', 'public/images/upload/products/bluetooth-true-wireless-rezo-qt13.jpeg', 560000, 950000, 'Gọn nhẹ, trẻ trung và thời trang với tone màu trắng và xanh Navy\r\nRezo QT13 là mẫu tai nghe True Wireless được thiết kế đơn giản, hoàn chỉnh đến từng chi tiết nhỏ, 2 housing kích cỡ đồng nhất, đeo vừa vặn vào khuôn tai và bám chặt mà không gây khó chịu khi di chuyển nhờ sử dụng nút tai mềm nhẹ, có độ bám tốt.\r\n\r\nMặt khác, chiếc hộp sạc đi kèm được thiết kế chuyên dụng để cất giữ và nạp pin cho housing, cho bạn thao tác lấy và đặt housing ra/vào dễ dàng, kích thước hộp sạc nhỏ nhắn, tiện cho vào túi áo, túi xách hoặc balo để mang theo bên mình đến mọi nơi. ', '<h3>Gọn nhẹ, trẻ trung v&agrave; thời trang với tone m&agrave;u trắng v&agrave; xanh Navy</h3>\r\n\r\n<p>Rezo QT13 l&agrave; mẫu&nbsp;<a href=\"https://www.thegioididong.com/tai-nghe-khong-day\" target=\"_blank\" title=\"Tai nghe không dây giá rẻ chính hãng bán tại Thế Giới Di Động\">tai nghe True Wireless</a>&nbsp;được thiết kế đơn giản, ho&agrave;n chỉnh đến từng chi tiết nhỏ, 2 housing k&iacute;ch cỡ đồng nhất, đeo vừa vặn v&agrave;o khu&ocirc;n tai v&agrave; b&aacute;m chặt m&agrave; kh&ocirc;ng g&acirc;y kh&oacute; chịu khi di chuyển nhờ sử dụng n&uacute;t tai mềm nhẹ, c&oacute; độ b&aacute;m tốt.</p>\r\n\r\n<p>Mặt kh&aacute;c, chiếc hộp sạc đi k&egrave;m được thiết kế chuy&ecirc;n dụng để cất giữ v&agrave; nạp pin cho housing, cho bạn thao t&aacute;c lấy v&agrave; đặt housing ra/v&agrave;o dễ d&agrave;ng, k&iacute;ch thước hộp sạc nhỏ nhắn, tiện cho v&agrave;o t&uacute;i &aacute;o, t&uacute;i x&aacute;ch hoặc balo để mang theo b&ecirc;n m&igrave;nh đến mọi nơi.&nbsp;</p>\r\n\r\n<h3>&Acirc;m thanh ', 'Tai nghe', '', '', 0, '10', NULL, 'Approved', 'Hà Quan Tính', '28/01/22 05:01', '', ''),
(39, 'MKGT27A/E', 'OPPO A52', 'oppo-a52', 'public/images/upload/products/oppo-a52-black-600x600-600x600.jpg', 6500000, 7000000, 'Chiếc smartphone của OPPO còn trang bị RAM 4 GB với chuẩn LPDDR4x siêu nhanh, giúp máy luôn ổn định kể cả khi bạn mở nhiều ứng dụng và trò chơi cùng lúc mà không lo máy chậm hay bị tải lại ứng dụng thường xuyên.\r\n\r\nNgoài ra, với bộ nhớ trong 64 GB chuẩn UFS 2.1 cho tốc độ đọc ghi cao hơn 61%, nhờ đó việc ghi chép dữ liệu, truy câp file ứng dụng trở nên nhanh chóng hơn. Bạn cũng có thể dễ dàng mở rộng bộ nhớ thêm tối đa 256 GB với thẻ nhớ MicroSD để lưu trữ nhiều hơn.\r\n\r\nOPPO A52 mang một vẻ ngoài rất bắt mắt với thiết kế nguyên khối chắc chắn, mặt lưng có hiệu ứng ánh sáng đồng tâm từ cụm camera khá ấn tượng. Các cạnh được bo cong mềm mại, giúp bạn cần nắm và sử dụng thiết bị thoải mái dễ dàng hơn.\r\n\r\nMàn hình tràn viền nốt ruồi ngày càng phổ biến, giờ đã xuất hiện trên OPPO A52. Thiết bị sở hữu một màn hình cực lớn 6.5 inch, độ phân giải Full HD+ với tỷ lệ hiển thị đạt 90,5%, cung cấp một không gian rộng rãi để bạn có thể đắm chìm vào những bộ phim chất lượng cao hay tận hưởng những t', '<p><a href=\"https://www.thegioididong.com/dtdd/oppo-a52\" target=\"_blank\" title=\"Tham khảo giá điện thoại OPPO A52 tại Thegioididong.com\" type=\"Tham khảo giá điện thoại OPPO A52 tại Thegioididong.com\">OPPO A52</a>&nbsp;l&agrave; mẫu smartphone mới của&nbsp;<a href=\"https://www.thegioididong.com/dtdd-oppo\" target=\"_blank\" title=\"Tham khảo điện thoại OPPO chính hãng tại Thegioididong.com\" type=\"Tham khảo điện thoại OPPO chính hãng tại Thegioididong.com\">OPPO</a>&nbsp;hướng đến người d&ugrave;ng tầm trung. Thiết bị sở hữu sức mạnh từ vi xử l&yacute; Qualcomm Snapdragon, m&agrave;n h&igrave;nh tr&agrave;n viền nốt ruồi, pin khủng. Khiến cho chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd\" target=\"_blank\" title=\"Tham khảo giá điện thoại, smartphone chính hãng tại Thegioididong.com\" type=\"Tham khảo giá điện thoại, smartphone chính hãng tại Thegioididong.com\">điện thoại&nbsp;</a>n&agrave;y trở th&agrave;nh một ứng cử vi&ecirc;n cạnh tranh trong tầm gi&aacute;.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 10:01', 'Hà Quan Tính', '03/02/22 08:02'),
(41, 'MKGT18A/O', 'Xiaomi Redmi Note 9S', 'xiaomi-redmi-note-9s', 'public/images/upload/products/xiaomi-redmi-note-9s-4gb-green-400x460-600x600.jpg', 5990000, 6500000, 'Thiết kế cao cấp, vân tay dời sang cạnh bên\r\nKhác với màn hình đục lỗ trên người anh tiền nhiệm Redmi Note 8, Redmi Note 9s có thiết kế màn hình đục lỗ với camera trước đặt trong màn hình tương tự như trên hầu hết các máy flagship hiện nay.\r\n\r\nMáy được trang bị màn hình IPS LCD với kích thước 6.67 inch, độ phân giải Full HD+ và tỉ lệ màn hình 20:9, cho hình ảnh hiển thị rõ nét và rộng rãi.\r\n\r\n\r\n\r\nCạnh dưới của Redmi Note 9s gồm có cổng USB-C, dải loa, mic thoại và jack tai nghe 3.5 mm. Trong khi đó, cạnh phải sẽ là nơi đặt nút nguồn tích hợp cả cảm biến vân tay và cụm phím tăng giảm âm lượng.', '<p><a href=\"https://www.thegioididong.com/dtdd/xiaomi-redmi-note-9s\" target=\"_blank\" title=\"Tham khảo giá bán của điện thoại Redmi Note 9s tại thegioididong.com\" type=\"Tham khảo giá bán của điện thoại Redmi Note 9s tại thegioididong.com\">Redmi Note 9s</a>&nbsp;l&agrave; sản phẩm tầm trung nh&agrave;&nbsp;<a href=\"https://www.thegioididong.com/dtdd-xiaomi\" target=\"_blank\" title=\"Tham khảo giá điện thoại Xiaomi chính hãng đang kinh doanh tại thegioididong.com\" type=\"Tham khảo giá điện thoại Xiaomi chính hãng đang kinh doanh tại thegioididong.com\">Xiaomi</a>, g&acirc;y ấn tượng với thiết kế tr&agrave;n viền độc đ&aacute;o, cấu h&igrave;nh mạnh mẽ v&agrave; hệ thống bốn camera sau chất lượng.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '03/02/22 08:02'),
(42, 'MKGT26A/T', 'Samsung Galaxy A31', 'samsung-galaxy-a31', 'public/images/upload/products/samsung-galaxy-a31-055720-045750-600x600.jpg', 6490000, 7000000, 'Thiết kế đặc trưng của dòng Galaxy A 2020\r\nTổng thể thiết kế của Galaxy A31 mang nhiều nét tương đồng với hai người anh em Galaxy A31 và A71. Mặt lưng của thiết bị vẫn được tạo điểm nhấn với cụm camera lớn và các vân kim cương đẹp mắt.\r\n\r\n\r\n\r\nỞ mặt trước, Samsung trang bị cho A31 màn hình tràn viền Infinity-U với kích thước 6.4 inch, sử dụng tấm nền Super AMOLED với độ phân giải Full HD+ cho hình ảnh sắc nét và tươi sáng.\r\n\r\n\r\n\r\nViền màn hình được làm mỏng ở các cạnh bên và cạnh trên, tuy nhiên phần “cằm” máy vẫn khá dày chứ không được làm thanh thoát như trên các mẫu máy cao cấp hơn.\r\n\r\n\r\n\r\nĐặc biệt hơn màn hình của A31 được tích hợp luôn cảm biến vân tay quang học thay vì đặt ở mặt lưng như trên M31. Đồng nghĩa với việc vị trí đặt tay mở khóa sẽ tự nhiên hơn và cảm giác sử dụng cũng hiện đại, cao cấp hơn.\r\n\r\nCụm 4 camera thoải mái sáng tạo\r\nSamsung năm nay tập trung khá nhiều vào camera trên smartphone. Cụm 4 camera của A31 bao gồm cảm biến chính lên đến 48 MP, camera góc rộng 8 MP, ', '<p><a href=\"https://www.thegioididong.com/dtdd/samsung-galaxy-a31\" target=\"_blank\" title=\"Xem thông tin chi tiết điện thoại Samsung Galaxy A31\" type=\"Xem thông tin chi tiết điện thoại Samsung Galaxy A31\">Galaxy A31</a>&nbsp;l&agrave; mẫu&nbsp;<a href=\"https://www.thegioididong.com/dtdd\" target=\"_blank\" title=\"Tham khảo giá điện thoại smartphone chính hãng, giá rẻ\" type=\"Tham khảo giá điện thoại smartphone chính hãng, giá rẻ\">smartphone</a>&nbsp;tầm trung mới ra mắt đầu năm 2020 của Samsung. Thiết bị g&acirc;y ấn tượng mạnh với ngoại h&igrave;nh thời trang, cụm 4 camera đa chức năng, v&acirc;n tay dưới m&agrave;n h&igrave;nh v&agrave; vi&ecirc;n pin khủng l&ecirc;n đến 5000 mAh.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '03/02/22 08:02'),
(43, 'MKGT54A/U', 'Vivo Y30', 'vivo-y30', 'public/images/upload/products/vivo-y30-600x600-600x600.jpg', 4990000, 6300000, 'Màn hình \"nốt ruồi\" tràn viền kích thước lớn \r\nMàn hình máy có kích thước lớn 6.47 inch được tối ưu trên tấm nền IPS cho góc nhìn rộng độ sáng cao cùng chất lượng hiển thị rõ nét.\r\n\r\n\r\n\r\nMàn hình của máy có diện tích hiển thị lên tới 90.7% cùng tỉ lệ 19.5 / 9 đảm bảo máy có màn hình có kích thước lớn mà vẫn nằm gọn trong bàn tay người dùng.\r\n\r\n\r\n\r\nMặt lưng của máy được hoàn thiện bằng thiết kế viền 3D độc đáo với họa tiết vân sáng tỏa ra từ cụm camera trông rất hiện đại và tinh tế.\r\n\r\n\r\n\r\nHiệu năng tốt, chiến game mượt mà\r\nKhá chiều lòng người sử dụng khi Vivo Y30 được trang bị vi xử lý MediaTek Helio P35 đảm bảo mang tới hiệu năng mạnh mẽ chiến game hàng ngày.\r\n\r\n\r\n\r\nBên cạnh đó, dung lượng RAM 4 GB cùng bộ nhớ trong 128 GB mang tới trải nghiệm sử dụng mượt mà. Ngoài ra, máy còn có khả năng lưu trữ thêm 256 GB dữ liệu qua cổng MicroSD.\r\n\r\n\r\n\r\nHơn nữa, máy còn được hỗ trợ công nghệ Multi-Turbo 3.0 cho khả năng tăng tốc trò chơi, nâng cao tốc độ khung hình, giảm tình trạng giật, lag khi', '<p><a href=\"https://www.thegioididong.com/dtdd-vivo\" target=\"_blank\" title=\"Tham khảo giá điện thoại smartphone Vivo chính hãng\" type=\"Tham khảo giá điện thoại smartphone Vivo chính hãng\">Vivo</a>&nbsp;vừa ra mắt th&ecirc;m d&ograve;ng sản phẩm&nbsp;<a href=\"https://www.thegioididong.com/dtdd/vivo-y30\" target=\"_blank\" title=\"Tham khảo giá điện thoại Vivo Y30 chính hãng\" type=\"Tham khảo giá điện thoại Vivo Y30 chính hãng\">Vivo Y30</a>&nbsp;mới, một thiết bị sở hữu cho m&igrave;nh thiết kế nốt ruồi tr&agrave;n viền thời thượng, cụm 4 camera sau c&ugrave;ng dung lượng pin lớn đ&aacute;p ứng tốt nhu cầu sử dụng của đại đa số người d&ugrave;ng.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '03/02/22 08:02'),
(44, 'MKGT81A/F', 'iPhone Xs Max 256GB', 'iphone-xs-max-256gb', 'public/images/upload/products/iphone-xs-max-256gb-white-600x600.jpg', 30990000, 30990000, 'Sau 1 năm mong chờ, chiếc smartphone cao cấp nhất của Apple đã chính thức ra mắt mang tên iPhone Xs Max 256 GB. Máy các trang bị các tính năng cao cấp nhất từ chip A12 Bionic, dàn loa đa chiều cho tới camera kép tích hợp trí tuệ nhân tạo.', '<h3>Hiệu năng đỉnh cao c&ugrave;ng chip Apple A12</h3>\r\n\r\n<p>iPhone Xs Max được Apple trang bị cho con chip mới toanh h&agrave;ng đầu của h&atilde;ng mang t&ecirc;n&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/chi-tiet-chip-apple-a12-bionic-ben-trong-iphone-xs-xs-max-1116982\" target=\"_blank\" title=\"Tìm hiểu chip Apple A12\" type=\"Tìm hiểu chip Apple A12\">Apple A12</a>.</p>\r\n\r\n<p>Chip A12 Bionic được x&acirc;y dựng tr&ecirc;n tiến tr&igrave;nh 7nm đầu ti&ecirc;n m&agrave; h&atilde;ng sản xuất với 6 nh&acirc;n đ&aacute;p ứng vượt trội trong việc xử l&yacute; c&aacute;c t&aacute;c vụ v&agrave; khả năng tiết kiệm năng lượng tối ưu.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '03/02/22 08:02'),
(45, 'MKGT12A/Q', 'Samsung Galaxy A11', 'samsung-galaxy-a11', 'public/images/upload/products/samsung-galaxy-a11-xanh-600x600-600x600.jpg', 3690000, 3990000, 'Màn hình Infinity-O siêu tràn viền 6.4 inch\r\nVì là smartphone giá rẻ, Galaxy A11 không dùng màn hình AMOLED thường thấy của Samsung, thay vào đó là màn hình PLS TFT độ phân giải HD+. Điểm cộng cho màn hình của máy là kích thước đến 6.4 inch rộng rãi, phù hợp nhiều nhu cầu sử dụng khác nhau.\r\n\r\n\r\n\r\nMàn hình trên Galaxy A11 sẽ phù hợp cho việc sử dụng cho mục đích xem phim, chơi game thông thường và không đòi hỏi yêu cầu quá cao về đồ họa.\r\n\r\n\r\n\r\nMặc dù nằm ở phân khúc giá rẻ máy vẫn sở hữu thiết kế Infinity-O thời thượng với camera trước dạng đục lỗ của các dòng flagship cao cấp như Galaxy S20, Galaxy Note 10,…\r\n\r\n\r\n\r\nViền dưới của màn hình cũng còn khá dày, nhưng là một smartphone giá rẻ nên điều này hoàn toàn chấp nhận được. Nói về ưu điểm thì phần viền dày cũng góp phần hạn chế vô tình chạm vào màn hình.\r\n\r\n\r\n\r\nXem thêm: 4 loại thiết kế màn hình vô cực Infinity của Samsung\r\n\r\nLưu giữ khoảnh khắc thường ngày với bộ 3 camera đa dụng\r\nVề camera, Galaxy A11 được trang bị 3 camera mặt sau', '<p><a href=\"https://www.thegioididong.com/dtdd/samsung-galaxy-a11\" target=\"_blank\" title=\"Tham khảo giá điện thoại Samsung Galaxy A11 tại thegioididong.com\" type=\"Tham khảo giá điện thoại Samsung Galaxy A11 tại thegioididong.com\">Samsung Galaxy A11</a>&nbsp;với thiết kế m&agrave;n h&igrave;nh Infinity-O si&ecirc;u&nbsp;tr&agrave;n viền, bộ ba camera ấn tượng, đi k&egrave;m với mức gi&aacute; phải chăng hứa hẹn sẽ tạo n&ecirc;n cơn sốt tr&ecirc;n thị trường&nbsp;<a href=\"https://www.thegioididong.com/dtdd\" target=\"_blank\" title=\"Tham khảo các dòng điện thoại chính hãng giá tốt tại thegioididong.com\" type=\"Tham khảo các dòng điện thoại chính hãng giá tốt tại thegioididong.com\">điện thoại</a>&nbsp;gi&aacute; rẻ.</p>\r\n', 'Samsung', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', '', ''),
(46, 'MKGT67T/B', 'Huawei MatePad T8 ', 'huawei-matepad-t8', 'public/images/upload/products/huawei-matepad-t8-600x600-200x200.jpg', 3290000, 4300000, 'Thiết kế nguyên khối liền mạch, màn hình viền mỏng\r\nMáy tính bảng Huawei MatePad T8 mang cho mình thiết kế chắc chắn, viền màn hình 2 bên mỏng tạo cho trải nghiệm xem rộng rãi và cảm giác cầm nắm tốt.\r\n\r\n\r\n\r\nMáy được trang bị màn hình kích thước 8 inch với độ phân giải HD 1280x800 pixel, tuy màn hình có độ phân giải không cao, nhưng vẫn đảm bảo chất lượng hiển thị tốt, màu sắc rõ ràng nhờ vào công nghệ màn hình IPS.\r\n\r\nCấu hình khá tốt trong tầm giá\r\nHuawei MatePad T8 sở hữu vi xử lý MediaTek MT8768 8 nhân, RAM 2 GB giúp chiếc máy tính bảng này có thể đáp ứng tốt các nhu cầu cơ bản như lướt web, xem phim hay chơi một số các tựa game nhẹ.\r\n\r\n\r\n\r\nMáy có bộ nhớ trong 32 GB, tuy bộ nhớ không quá nhiều nhưng vẩn đủ để bạn có thể lưu trữ hay tải nhiều ứng dụng. Nếu bạn muốn có thêm không gian lưu trữ thì máy vẫn có hỗ trợ thẻ nhớ ngoài Micro SD dung lượng 512 GB, giúp bạn không phải lo lắng về khả năng lưu trữ của máy.\r\n\r\n\r\n\r\nThời lượng pin của máy rất ấn tượng khi được trang bị viên pin 510', '<p><a href=\"https://www.thegioididong.com/may-tinh-bang/huawei-matepad-t8\" target=\"_blank\" title=\"Máy tính bảng Huawei MatePad T8 tại Thế Giới Di Động\" type=\"Máy tính bảng Huawei MatePad T8 tại Thế Giới Di Động\">Huawei MatePad T8</a>&nbsp;l&agrave; một trong những mẫu&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang\" target=\"_blank\" title=\"Tham khảo máy tính bảng tại Thế Giới Di Động\">m&aacute;y t&iacute;nh bảng</a>&nbsp;gi&aacute; rẻ của&nbsp;Huawei&nbsp;c&oacute; thiết kế nguy&ecirc;n khối c&ugrave;ng một cấu h&igrave;nh cơ bản, đủ d&ugrave;ng cho c&aacute;c t&aacute;c vụ hằng ng&agrave;y của mọi người d&ugrave;ng.</p>\r\n', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', '', ''),
(47, 'MKGT87A/N', 'iPad Pro 12.9 inch Wifi ', 'ipad-pro-12-9-inch-wifi-cellular-128gb', 'public/images/upload/products/ipad-pro-12-9-inch-wifi-cellular-128gb-2020-bac-600x600-200x200.jpg', 31990000, 33000000, 'Thiết kế tràn viền không khuyết điểm\r\niPad Pro 12.9 (2020) có thiết kế không khác với người tiền nhiệm thiết kế kim loại nguyên khối với độ hoàn thiện cực cao, 4 cạnh được vát thẳng vuông vức cho tổng thể mặt trước của hài hòa và đẹp mắt hơn. \r\n\r\n\r\n\r\nTuy nhiên vẫn có sự thay đổi trên iPad Pro 12.9 (2020), hệ thống camera sau được đặt trong một hình vuông hơi lồi hơn so với mặt lưng.\r\n\r\nMáy có kích thước vô cùng mỏng nhẹ với độ dày chỉ vỏn vẹn 5.9 mm, trọng lượng 471 g, rất tiện lợi để sử dụng và mang theo bên mình.\r\n\r\n\r\n\r\nCác góc cạnh được bo tròn mềm mại để mang đến cảm giác cầm tay thoải mái, chắc chắn.\r\n\r\n\r\n\r\nMàn hình Retina kích thước lớn tần số 120Hz\r\nApple còn trang bị cho iPad Pro 2020 màn hình Liquid Retina kích thước lớn 12.9 inch giúp hiển thị sắc nét, màu sắc sống động, độ tương phản cao.\r\n\r\n\r\n\r\nApple cũng ưu tiên sử dụng màn hình có tần số 120 Hz sẽ mang lại cho iPad Pro khả năng hiển thị hình ảnh sắc nét, tốc độ xử lý hình ảnh nhanh chóng. \r\n\r\n\r\n\r\nNhờ vậy, người dùng sẽ có', '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li>M&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cung-tim-hieu-ve-man-hinh-liquid-retina-tren-iph-1125106\" target=\"_blank\">Liquid Retina</a>, 12.9&quot;</p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p>iPadOS 13</p>\r\n	</li>\r\n	<li>CPU\r\n	<p>Apple A12Z Bionic, 4 nh&acirc;n 2.5 GHz &amp; 4 nh&acirc;n 1.6 GHz</p>\r\n	</li>\r\n	<li>RAM\r\n	<p>6 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>128 GB</p>\r\n	</li>\r\n</ul>\r\n', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '27/01/22 11:01'),
(48, 'MKGT93A/M', 'Samsung Galaxy Tab A8 8', 'samsung-galaxy-tab-a8-8', 'public/images/upload/products/samsung-galaxy-tab-a8-t295-2019-silver-200x200.jpg', 3690000, 3800000, 'Màn hình lớn thoải mái sử dụng\r\nƯu điểm của những chiếc máy tính bảng khi so với smartphone là kích thước màn hình lớn hơn đem lại không gian lớn hơn để sử dụng.\r\n\r\n\r\n\r\nMàn hình của chiếc máy tính bảng Samsung được thiết kế theo tỷ lệ 16:10 – rất lý tưởng cho việc đọc sách, tạp chí, đọc báo hoặc lướt web.\r\n\r\n\r\n\r\nMàn hình của máy có độ phân giải 1280 x 800 pixels cho hình ảnh hiển thị chi tiết, giúp bạn thoải mái lướt web hay xem phim phụ đề mà không mỏi mắt.\r\n\r\n\r\n\r\nChiếc máy tính bảng này được thiết kế với vỏ kim loại nhám nhẹ cùng các góc bo tròn cho cảm giác chắc chắn, không bám vân tay khi cầm.\r\n\r\n\r\n\r\nMáy chỉ dày 8 mm và có khối lượng nhẹ nhàng, nên rất thuận tiện khi bạn muốn nó đồng hành bên mình trong những chuyến đi xa.', '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li>M&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-tft-lcd-la-gi-905743\" target=\"_blank\">TFT LCD</a>, 8&quot;</p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-android-90-pie-va-nhung-tinh-nang-moi-noi-1107119\" target=\"_blank\">Android 9.0 (Pie)</a></p>\r\n	</li>\r\n	<li>CPU\r\n	<p>Snapdragon 429, 4 nh&acirc;n 2.0 GHz</p>\r\n	</li>\r\n	<li>RAM\r\n	<p>2 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>32 GB</p>\r\n	</li>\r\n</ul>\r\n', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', '', ''),
(49, 'MKGT96A/J', 'Samsung Galaxy Tab A 8.0 ', 'samsung-galaxy-tab-a-8-0-spen', 'public/images/upload/products/samsung-galaxy-tab-a8-plus-p205-black-600x600.jpg', 6990000, 7500000, 'Thiết kế được làm tinh tế hơn\r\nNguyên khối và siêu mỏng là hai đặc điểm nổi bật tạo nên nét tinh tế cho Galaxy Tab A.\r\n\r\n\r\n\r\nMáy chỉ dày 8.9 mm và có khối lượng nhẹ nhàng, chiếc máy tính bảng này rất thuận tiện khi bạn muốn nó đồng hành bên mình trong những chuyến đi xa.\r\n\r\n\r\n\r\nBật trình duyệt web của bạn lên và nâng tầm trải nghiệm đọc của bạn lên một đẳng cấp mới với máy tính bảng Galaxy Tab A.\r\n\r\nMàn hình của chiếc máy tính bảng Samsung được thiết kế theo tỷ lệ 4:3 – rất lý tưởng cho việc đọc sách, tạp chí, đọc báo hoặc lướt web.', '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li>M&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-tft-lcd-la-gi-905743\" target=\"_blank\">WUXGA TFT</a>, 8&quot;</p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-android-90-pie-va-nhung-tinh-nang-moi-noi-1107119\" target=\"_blank\">Android 9.0 (Pie)</a></p>\r\n	</li>\r\n	<li>CPU\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kham-pha-dong-chip-moi-exynos-7904-cua-samsung-1172068\" target=\"_blank\">Exynos 7904 8 nh&acirc;n</a>, 2 nh&acirc;n 1.8 GHz &amp; 6 nh&acirc;n 1.6 GHz</p>\r\n	</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>32 GB</p>\r\n	</li>\r\n</ul>\r\n', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '27/01/22 11:01'),
(50, 'MKGT18A/Z', 'Huawei MediaPad M5 ', 'huawei-mediapad-m5-lite', 'public/images/upload/products/huawei-mediapad-m5-lite-gray-600x600.jpg', 7990000, 8200000, 'Hệ điều hành Android từ Google\r\nHuawei Mediapad M5 Lite được sử dụng hệ điều hành Android 8.0 với đầy đủ sự hỗ trợ chính thức từ Google, hệ điều hành thông minh tối ưu thao tác, phần cứng và ứng dụng cho bạn trải nghiệm tốt nhất.\r\n\r\n\r\n\r\nHệ điều hành Android được tùy biến dành riêng cho máy tính bảng với việc bố trí các nút nhấn, thao tác tiện lợi hơn trên màn hình rộng. Bạn có thể chia màn hình để sử dụng 2 ứng dụng cùng lúc.\r\n\r\n\r\n\r\nMàn hình lớn 10.1 inch giải trí cao cấp\r\nLà một thiết bị dành cho giải trí cao cấp và làm việc chuyên nghiệp nên Huawei Mediapad M5 Lite có màn hình lớn đến 10.1 inch, gần tương đương với 1 chiếc laptop cỡ nhỏ, cho bạn rất nhiều không gian hiển thị để sử dụng.\r\n\r\n\r\n\r\nMàn hình IPS với độ phân giải Full HD vừa mang đến được màu sắc chân thực, vừa có độ nét cao nên chắc chắn sẽ tái hiện lại những thước phim, đồ họa chơi game đẹp và chất lượng.\r\n\r\n', '<h2>Th&ocirc;ng số kỹ thuật</h2>\r\n\r\n<ul>\r\n	<li>M&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ips-lcd-la-gi-905752\" target=\"_blank\">IPS LCD Full HD</a>, 10.1&quot;</p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/co-nhung-gi-moi-tren-android-80-1018266\" target=\"_blank\">Android 8.0</a></p>\r\n	</li>\r\n	<li>CPU\r\n	<p>Kirin 659, 1.7 GHz</p>\r\n	</li>\r\n	<li>RAM\r\n	<p>4 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n</ul>\r\n', 'Máy tính bảng', '', '', 0, '1', '1', 'Approved', 'Hà Quan Tính', '25/01/22 11:01', 'Hà Quan Tính', '27/01/22 11:01'),
(52, 'MKGT22A/Q', 'Realme 5 (3GB/64GB)', 'realme-5-3gb-64gb', 'public/images/upload/products/realme-5-600x600-1-600x600-copy.jpg', 3690000, 3680000, 'Những chiếc smartphone Realme luôn gây được sự chú ý của người dùng bởi những trang bị trên máy so với tầm giá tiền và mới đây \"siêu phẩm giá rẻ\" Realme 5 3GB/64GB ra mắt lại một lần nữa khiến người dùng không khỏi \"trầm trồ\".', '<h3>Camera &quot;b&aacute; đạo&quot; trong ph&acirc;n kh&uacute;c</h3>\r\n\r\n<p>Realme 5 sở hữu cho m&igrave;nh tới 4 camera sau ở trong ph&acirc;n kh&uacute;c m&agrave; những chiếc m&aacute;y kh&aacute;c đang &quot;loay hoay&quot; với cụm camera k&eacute;p.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/207649/realme-5-tgdd-8.jpg\" onclick=\"return false;\"><img alt=\"Điện thoại Realme 5 | Camera sau\" data-original=\"https://cdn.tgdd.vn/Products/Images/42/207649/realme-5-tgdd-8.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/42/207649/realme-5-tgdd-8.jpg\" title=\"Điện thoại Realme 5 | Camera sau\" /></a></p>\r\n\r\n<p>Với cụm camera n&agrave;y th&igrave;&nbsp;Realme 5 tự tin đ&aacute;p ứng cho bạn hầu hết c&aacute;c nhu cầu trong cuộc sống thường ng&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 08:02', 'Hà Quan Tính', '03/02/22 08:02'),
(53, 'MKGT21A/B', 'Xiaomi Redmi Note 8', 'xiaomi-redmi-note-8-3gb-32gb', 'public/images/upload/products/xiaomi-redmi-note-8-32gb-white-600x600.jpg', 3990000, 3980000, 'Xiaomi Redmi Note 8 4GB/64GB là chiếc smartphone tầm trung mới nhất của Xiaomi, chiếc máy này gây ấn tượng với cấu hình phần cứng mạnh mẽ, hệ thống 4 camera sau chất lượng và đi kèm giá bán cực kỳ hấp dẫn.', '<h3>4 camera chất lượng h&agrave;ng đầu</h3>\r\n\r\n<p>Kh&ocirc;ng chỉ c&oacute; 2 hay 3 camera m&agrave; với chiếc smartphone mới&nbsp;Xiaomi Redmi Note 8 th&igrave; người d&ugrave;ng sẽ c&oacute; tới 4 camera để thỏa m&atilde;n nhu cầu chụp ảnh của m&igrave;nh.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/209535/xiaomi-redmi-note-8-64gb-8.jpg\" onclick=\"return false;\"><img alt=\"Điện thoại Xiaomi Redmi Note 8 | Thiết kế mới với bộ 4 camera\" data-original=\"https://cdn.tgdd.vn/Products/Images/42/209535/xiaomi-redmi-note-8-64gb-8.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/42/209535/xiaomi-redmi-note-8-64gb-8.jpg\" title=\"Điện thoại Xiaomi Redmi Note 8 | Thiết kế mới với bộ 4 camera\" /></a></p>\r\n\r\n<p>Xiaomi Redmi Note 8 sở hữu cho m&igrave;nh camera ch&iacute;nh với độ ph&acirc;n giải khủng &quot;khủng&quot; với &quot;số chấm&quot; l&ecirc;n tới 48 MP.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 08:02', '', ''),
(54, 'MKGY18A/P', 'iPhone 11 Pro Max 64GB', 'iphone-11-pro-max-64gb', 'public/images/upload/products/iphone-11-pro-max-green-600x600.jpg', 22000000, 25000000, 'Trong năm 2019 thì chiếc smartphone được nhiều người mong muốn sở hữu trên tay và sử dụng nhất không ai khác chính là iPhone 11 Pro Max 64GB tới từ nhà Apple.', '<h3 dir=\"ltr\">Camera được cải tiến mạnh mẽ</h3>\r\n\r\n<p dir=\"ltr\">Chắc chắn l&yacute; do lớn nhất m&agrave; bạn muốn n&acirc;ng cấp l&ecirc;n iPhone 11 Pro Max ch&iacute;nh l&agrave; cụm camera mới được Apple n&acirc;ng cấp rất nhiều.</p>\r\n\r\n<p dir=\"ltr\">Lần đầu ti&ecirc;n ch&uacute;ng ta sẽ c&oacute; một chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd-apple-iphone\" target=\"_blank\" title=\"Tham khảo iPhone chính hãng\">iPhone</a>&nbsp;với 3 camera ở mặt sau v&agrave; cả 3 camera n&agrave;y đều c&oacute; độ ph&acirc;n giải l&agrave; 12 MP.</p>\r\n', 'Điện thoại', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 08:02', 'Hà Quan Tính', '03/02/22 08:02'),
(55, 'MKGT16A/I', 'Asus VivoBook X509MA N4000', 'asus-vivobook-x509ma-n4000-4gb-256gb-win10', 'public/images/upload/products/asus-vivobook-x509ma-br061t-220527-600x600.jpg', 6990000, 6990000, 'Thông số kỹ thuật\r\nCPU:\r\nIntel Celeron, N4000, 1.10 GHz\r\nRAM:\r\n4 GB, DDR4 (1 khe), 2400 MHz\r\nỔ cứng:\r\nSSD 256GB NVMe PCIe, Hỗ trợ khe cắm HDD SATA\r\nMàn hình:\r\n15.6 inch, HD (1366 x 768)\r\nCard màn hình:\r\nCard đồ họa tích hợp, Intel UHD Graphics\r\nCổng kết nối:\r\n2 x USB 2.0, HDMI, USB 3.0, USB Type-C\r\nHệ điều hành:\r\nWindows 10 Home SL\r\nThiết kế:\r\nVỏ nhựa, PIN liền\r\nKích thước:\r\nDày 22.9 mm, 1.8 kg\r\nThời điểm ra mắt:\r\n2019', '<h3>Thiết kế tinh tế sang trọng</h3>\r\n\r\n<p>Chiếc&nbsp;<a href=\"https://www.thegioididong.com/laptop\" title=\"Xem thêm các mẫu laptop đang kinh doanh tại thegioididong.com\" type=\"Xem thêm các mẫu laptop đang kinh doanh tại thegioididong.com\">laptop</a>&nbsp;mang phong c&aacute;ch trẻ trung sang trọng, độ mỏng&nbsp;<strong>22.9 mm</strong>. Vỏ m&aacute;y t&iacute;nh được l&agrave;m bằng nhựa gi&uacute;p giảm thiểu c&acirc;n nặng, chỉ c&ograve;n&nbsp;<strong>1.8 kg</strong>&nbsp;dễ d&agrave;ng c&ugrave;ng bạn trải nghiệm c&aacute;c cuộc h&agrave;nh tr&igrave;nh.</p>\r\n\r\n<h3>Viền m&agrave;n h&igrave;nh mỏng</h3>\r\n\r\n<p>Laptop&nbsp;<a href=\"https://www.thegioididong.com/laptop-asus\" title=\"Xem thêm các sản phẩm laptop Asus đang bán tại Thegioididong.com\" type=\"Xem thêm các sản phẩm laptop Asus đang bán tại Thegioididong.com\">Asus</a>&nbsp;c&oacute; độ ph&acirc;n giải HD ngo&agrave;i ra n&oacute; c&ograve;n c&oacute; viền m&agrave;n h&igrave;nh mỏng c&oacute; lớp chống ch&oacute;i cho cảm gi&am', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', 'Hà Quan Tính', '03/02/22 09:02');
INSERT INTO `tbl_products` (`product_id`, `product_code`, `product_title`, `product_slug`, `product_thumb`, `product_price_new`, `product_price_old`, `product_desc`, `product_content`, `parent_cat`, `product_brand`, `product_type`, `product_qty`, `product_num`, `product_sold`, `product_status`, `creator`, `create_date`, `editor`, `edit_date`) VALUES
(57, 'MKGT48A/U', 'Acer Aspire A315 34 C2H9 N4000', 'acer-aspire-a315-34-c2h9-n4000-4gb-256gb-win10', 'public/images/upload/products/acer-aspire-a315-34-c2h9-n4000-4gb-256gb-win10-nx9-1-600x600.jpg', 6990000, 6990000, 'Thông số kỹ thuật\r\nCPU:\r\nIntel Celeron, N4000, 1.10 GHz\r\n\r\nRAM:\r\n4 GB, DDR4 (On board +1 khe), 2400 MHz\r\n\r\nỔ cứng:\r\nSSD 256GB NVMe PCIe, Hỗ trợ khe cắm HDD SATA\r\n\r\nMàn hình:\r\n15.6 inch, HD (1366 x 768)\r\n\r\nCard màn hình:\r\nCard đồ họa tích hợp, Intel® UHD Graphics 600\r\n\r\nCổng kết nối:\r\n2 x USB 2.0, USB 3.1, HDMI, LAN (RJ45)\r\n\r\nHệ điều hành:\r\nWindows 10 Home SL\r\n\r\nThiết kế:\r\nVỏ nhựa, PIN liền\r\n\r\nKích thước:\r\nDày 19.9 mm, 1.7 kg\r\n\r\nThời điểm ra mắt:\r\n2019', '<h3><strong>Ổ cứng SSD nhanh ch&oacute;ng, dung lượng đủ d&ugrave;ng</strong></h3>\r\n\r\n<p>Laptop Acer Aspire A315 l&agrave; m&aacute;y t&iacute;nh hiếm hoi trong tầm gi&aacute; dưới 10 triệu&nbsp;được trang bị&nbsp;<strong><a href=\"https://www.thegioididong.com/laptop?f=o-cung-ssd\" target=\"_blank\" title=\"Laptop chính hãng được trang bị ổ cứng SSD đang được kinh doanh tại Thegioididong.com\" type=\"Laptop chính hãng được trang bị ổ cứng SSD đang được kinh doanh tại Thegioididong.com\">ổ cứng SSD</a>&nbsp;</strong>cực nhanh. Nghĩa l&agrave; bạn&nbsp;chỉ mất&nbsp;<strong>10 - 15 gi&acirc;y</strong>&nbsp;để khởi động m&aacute;y v&agrave;&nbsp;<strong>3 gi&acirc;y</strong>&nbsp;để mở ứng dụng thường d&ugrave;ng như Chrome, Excel,&nbsp;<a href=\"https://www.thegioididong.com/phan-mem-microsoft-office\" target=\"_blank\" title=\"Tham  khảo phần mềm MICROSOFT OFFICE bản quyền tại Thế giới di động \">Microsoft Office</a>,... Dung lượng&nbsp;<strong>256 GB</strong>&nbsp;cho kh&ocirc;ng gian đủ để lưu trữ ', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', '', ''),
(58, 'MKGT18A/Z', 'Acer Aspire 3 A315 54K 30FK i3 7020U', 'acer-aspire-3-a315-54k-30fk-i3-7020u-4gb-1tb-win10', 'public/images/upload/products/acer-aspire-3-a315-54-30fk-i3-7020u-4gb-1tb-win10-18-600x600.jpg', 9790000, 9790000, 'Thông số kỹ thuật\r\nCPU:\r\nIntel Core i3 Kabylake Refresh, 7020U, 2.30 GHz\r\n\r\nRAM:\r\n4 GB, DDR4 (1 khe), 2133 MHz\r\n\r\nỔ cứng:\r\nHDD: 1 TB SATA3, Hỗ trợ khe cắm SSD M.2 PCIe\r\n\r\nMàn hình:\r\n15.6 inch, HD 720 (1280 x 720)\r\n\r\nCard màn hình:\r\nCard đồ họa tích hợp, Intel® HD Graphics 620\r\n\r\nCổng kết nối:\r\n2 x USB 2.0, USB 3.1, HDMI, LAN (RJ45)\r\n\r\nHệ điều hành:\r\nWindows 10 Home SL\r\n\r\nThiết kế:\r\nVỏ nhựa, PIN liền\r\n\r\nKích thước:\r\nDày 19.9 mm, 1.7 kg\r\n\r\nThời điểm ra mắt:\r\n2019', '<h3>Cấu h&igrave;nh văn ph&ograve;ng cơ bản</h3>\r\n\r\n<p><a href=\"https://www.thegioididong.com/laptop-acer\" target=\"_blank\" title=\"Xem thêm các sản phẩm laptop Acer đang bán tại Thegioididong.com\" type=\"Xem thêm các sản phẩm laptop Acer đang bán tại Thegioididong.com\">Laptop Acer</a>&nbsp;Aspire 3 A315 54 30FK i3 được trang bị bộ xử l&yacute; Intel&nbsp;<strong><a href=\"https://www.thegioididong.com/laptop?g=core-i3\" target=\"_blank\" title=\"Xem thêm các laptop Core i3 đang bán tại Thegioididong.com\" type=\"Xem thêm các laptop Core i3 đang bán tại Thegioididong.com\">Core i3</a>&nbsp;</strong>7020U, bộ nhớ<strong>&nbsp;RAM 4 GB</strong>&nbsp;gi&uacute;p chiếc m&aacute;y n&agrave;y c&oacute; thể thực hiện được c&aacute;c t&aacute;c vụ cơ bản như lướt web, l&agrave;m việc văn ph&ograve;ng, xử l&yacute; h&igrave;nh ảnh đơn giản trong Photoshop.&nbsp;</p>\r\n\r\n<p>Ngo&agrave;i ra,&nbsp;<strong>ổ cứng HDD 1 TB SATA3</strong>&nbsp;gi&uacute;p chiếc m&aacute;y c&oacute; nhiều kh&ocirc;ng gian để lưu ', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', '', ''),
(59, 'MKGT38A/T', 'Asus VivoBook A512FA i3 8145U/4GB/512GB/Win10', 'asus-vivobook-a512fa-i3-8145u-4gb-512gb-win10', 'public/images/upload/products/asus-vivobook-a512fa-i3-8145u-4gb-512gb-win10-ej1-220574copy-600x600-copy.jpg', 13290000, 13290000, 'Thông số kỹ thuật\r\nCPU:\r\nIntel Core i3 Coffee Lake, 8145U, 2.10 GHz\r\n\r\nRAM:\r\n4 GB, DDR4 (On board +1 khe), 2400 MHz\r\n\r\nỔ cứng:\r\nSSD 512GB, Hỗ trợ khe cắm HDD SATA\r\n\r\nMàn hình:\r\n15.6 inch, Full HD (1920 x 1080)\r\n\r\nCard màn hình:\r\nCard đồ họa tích hợp, Intel® UHD Graphics 620\r\n\r\nCổng kết nối:\r\n2 x USB 2.0, HDMI, USB 3.0, USB Type-C\r\n\r\nHệ điều hành:\r\nWindows 10 Home SL\r\n\r\nThiết kế:\r\nVỏ nhựa - nắp lưng bằng kim loại, PIN liền\r\n\r\nKích thước:\r\nDày 19.9 mm, 1.7 kg\r\n\r\nThời điểm ra mắt:\r\n2019', '<h3>Thiết kế gọn nhẹ</h3>\r\n\r\n<p>Laptop&nbsp;<a href=\"https://www.thegioididong.com/laptop-asus\" title=\"Xem thêm một số mẫu laptop ASUS tại thegioididong.com\" type=\"Xem thêm một số mẫu laptop ASUS tại thegioididong.com\">Asus</a>&nbsp;mang một chất liệu vỏ nhựa - nắp bằng kim loại nhỏ gọn chỉ với khối lượng&nbsp;<strong>1.7 kg</strong>&nbsp;c&ugrave;ng với độ d&agrave;y chỉ&nbsp;<strong>19.9 mm</strong>&nbsp;sẽ gi&uacute;p bạn dễ d&agrave;ng đem theo laptop đến cơ quan, trường học hằng ng&agrave;y.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/44/220574/asus-vivobook-a512fa-i3-ej1868t5.jpg\" onclick=\"return false;\"><img alt=\"Laptop ASUS VivoBook A512FA i3 có thiết kế sang trọng, hiện đại\" data-original=\"https://cdn.tgdd.vn/Products/Images/44/220574/asus-vivobook-a512fa-i3-ej1868t5.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/44/220574/asus-vivobook-a512fa-i3-ej1868t5.jpg\" title=\"Laptop ASUS VivoBook A512FA i3 có thiết kế sang trọng, hiện đại\" /></a></p>\r\n\r\n<h3>Hiệu năng vừa phả', 'Máy tính', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', '', ''),
(60, 'MKGT78A/R', 'Samsung Galaxy Tab A8 ', 'sam-sung-galaxy-tab-a8', 'public/images/upload/products/samsung-galaxy-tab-a8-thumb-1.jpg', 7640000, 7540000, 'Samsung Galaxy Tab A8 (2022) là 1 phiên bản tuyệt vời trong Galaxy Tab A Series, sản phẩm này chắc chắn sẽ trở thành công cụ liên lạc online trong thời hiện đại mà bạn chắc chắn sẽ rất hài lòng khi sở hữu.', '<h3>Th&ocirc;ng tin sản phẩm</h3>\r\n\r\n<h3>Nghe nh&igrave;n m&atilde;n nh&atilde;n với m&agrave;n h&igrave;nh lớn v&agrave; &acirc;m thanh ch&acirc;n thật&nbsp;</h3>\r\n\r\n<p><a href=\"https://www.thegioididong.com/may-tinh-bang/samsung-galaxy-tab-a8\" target=\"_blank\" title=\"Samsung Galaxy Tab A8 (2022)\">Samsung Galaxy Tab A8 (2022)</a>&nbsp;c&oacute; k&iacute;ch thước m&agrave;n h&igrave;nh<strong>&nbsp;10.5 inch</strong>, tỉ lệ&nbsp;16:10 cho kh&ocirc;ng gian hiển thị rộng hơn, rất l&yacute; tưởng cho người d&ugrave;ng trải nghiệm xem phim, livestream, chơi game.&nbsp;</p>\r\n\r\n<p>M&agrave;n h&igrave;nh&nbsp;<strong>TFT LCD</strong>&nbsp;c&oacute; độ ph&acirc;n giải&nbsp;1200 x 1920 Pixels t&aacute;i hiện h&igrave;nh ảnh kh&aacute; chi tiết, m&agrave;u sắc trung thực, phong ph&uacute;. Tận hưởng &acirc;m thanh sống động đến từ hệ thống&nbsp;4 loa hỗ trợ c&ocirc;ng nghệ&nbsp;<strong>Dolby Atmos</strong>&nbsp;cung cấp &acirc;m thanh v&ograve;m b&ugrave;ng nổ, nghe nhạc rất đ&atilde; tai.&nbsp;&', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', 'Hà Quan Tính', '03/02/22 09:02'),
(61, 'MKGT10Y/Z', 'Nokia Tab T20 4G', 'nokia-tab-t20-4g', 'public/images/upload/products/nokia-t20-thumb.jpeg', 5960000, 5960000, 'Qua các thông tin nổi bật được nêu trên, thì đây thực sự là một sản phẩm lý tưởng dành cho học sinh, sinh viên nhằm hỗ trợ việc học tập online một cách hiệu quả với giá thành trang bị sản phẩm rất tốt, nếu bạn muốn chọn mua cho mình một sản phẩm đáp ứng nhu cầu giải trí cả ngày mà không cần cắm sạc, thì đây thực sự là một lựa chọn không thể bỏ qua.', '<h3>Th&ocirc;ng tin sản phẩm</h3>\r\n\r\n<h3><a href=\"https://www.thegioididong.com/dtdd-nokia\" target=\"_blank\">Nokia</a>&nbsp;đ&aacute;nh dấu sự trở lại của h&atilde;ng tr&ecirc;n thị trường&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang\" target=\"_blank\">m&aacute;y t&iacute;nh bảng</a>&nbsp;sau nhiều năm vắng b&oacute;ng bằng việc ra mắt&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang/nokia-t20?src=osp\">Nokia Tab T20</a>&nbsp;m&aacute;y c&oacute; thiết kế kim loại sang trọng, hiệu năng ổn định c&ugrave;ng m&agrave;n h&igrave;nh hiển thị sắc n&eacute;t, mang đến một lựa chọn kh&ocirc;ng thể bỏ qua trong ph&acirc;n kh&uacute;c.</h3>\r\n\r\n<h3>Thiết kế bền bỉ</h3>\r\n\r\n<p>M&aacute;y c&oacute; thiết kế cứng c&aacute;p với mặt lưng được ho&agrave;n thiện từ kim loại mang đến c&aacute;i nh&igrave;n sang trọng v&agrave; đẳng cấp hơn tr&ecirc;n một chiếc&nbsp;tablet,&nbsp;mặt lưng cũng được gia c&ocirc;ng ho&agrave;n thiện mờ gi&uacute;p hạn chế b&aacute;m dấu v&acirc;n tay trong ', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', '', ''),
(62, 'MKGP35A/I', 'iPad 10.2 inch Wifi 32GB', 'ipad-10-2-inch-wifi-32-g-b', 'public/images/upload/products/ipad-10-2-inch-wifi-32gb-2019-gold-600x600.jpg', 9990000, 9990000, 'Thông số kỹ thuật\r\nMàn hình\r\nLED backlit LCD, 10.2\"\r\n\r\nHệ điều hành\r\niPadOS 13\r\n\r\nCPU\r\nApple A10 Fusion 4 nhân, 2.34 GHz\r\n\r\nRAM\r\n3 GB\r\n\r\nBộ nhớ trong\r\n32 GB', '<h3>M&agrave;n h&igrave;nh lớn, x&agrave;i đ&atilde; hơn</h3>\r\n\r\n<p>Chắc chắn những người lựa chọn&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang-apple-ipad\" target=\"_blank\" title=\"Tham khảo iPad chính hãng\">iPad</a>&nbsp;phần lớn đều th&iacute;ch m&agrave;n h&igrave;nh k&iacute;ch thước lớn của n&oacute;.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/522/213099/ipad-10-2-inch-wifi-cellular-32gb-2019-tgdd13.jpg\" onclick=\"return false;\"><img alt=\"Điện thoại iPad 10.2 inch Wifi Cellular 32GB (2019) | Màn hình giải trí sắc nét\" data-original=\"https://cdn.tgdd.vn/Products/Images/522/213099/ipad-10-2-inch-wifi-cellular-32gb-2019-tgdd13.jpg\" src=\"https://cdn.tgdd.vn/Products/Images/522/213099/ipad-10-2-inch-wifi-cellular-32gb-2019-tgdd13.jpg\" title=\"Điện thoại iPad 10.2 inch Wifi Cellular 32GB (2019) | Màn hình giải trí sắc nét\" /></a></p>\r\n\r\n<p>So với thế hệ tiền nhiệm th&igrave; iPad năm nay được Apple n&acirc;ng cấp k&iacute;ch thước m&agrave;n h&igrave;nh l&ecirc;n m', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', '', ''),
(63, 'MKGP34H/A', 'Samsung Galaxy Tab A7 ', 'sam-sung-galaxy-tab-a7', 'public/images/upload/products/samsung-galaxy-tab-a7-2020-vangdong.jpg', 7750000, 7750000, 'Mua Galaxy Tab A7 2020 chính hãng, giá rẻ tại CellphoneS\r\nHãy đến ngay một trong rất nhiều các cửa hàng thuộc hệ thống CellphoneS tại Hà Nội và thành phố Hồ Chí Minh, nếu bạn muốn có ngay chiếc máy tính bảng Samsung Galaxy Tab A7 chính hãng. CellphoneS sẽ khiến bạn hoàn toàn yên tâm bởi sản phẩm kinh doanh tại cửa hàng đều đảm bảo chính hãng, chất lượng và có mức giá tốt. Không chỉ thế, đội ngũ nhân viên chuyên nghiệp và thân thiện sẽ giúp bạn có được một sản phẩm phù hợp nhất với mong muốn của mình. Ngoài ra, bạn cũng có thể tham khảo thêm Samsung Tab A8 với nhiều nâng cấp về cấu hình.', '<h3>M&agrave;n h&igrave;nh 10.4 inch d&ugrave;ng tấm nền TFT v&agrave; thiết kể v&aacute;t phẳng viền m&aacute;y</h3>\r\n\r\n<p>Chiếc&nbsp;<a href=\"https://cellphones.com.vn/tablet/samsung.html\" target=\"_self\" title=\"Máy tính bảng Samsung chính hãng\">m&aacute;y t&iacute;nh bảng Samsung</a>&nbsp;được ra mắt lần n&agrave;y sở hữu m&agrave;n h&igrave;nh l&ecirc;n đến 10.4 inch, với m&agrave;n h&igrave;nh lớn như thế n&agrave;y chắc chắc chiếc Tab A7 n&agrave;y sẽ cho trải nghiệm sử dụng tốt hơn nhiều so với c&aacute;c thế hệ 8 inch trước đ&oacute;. Ngo&agrave;i ra, kh&aacute;ch h&agrave;ng cũng c&oacute; thể tham khảo&nbsp;<a href=\"https://cellphones.com.vn/samsung-galaxy-tab-a7-lite.html\">Galaxy Tab A7 Lite</a>&nbsp;với m&agrave;n h&igrave;nh nhỏ gọn cũng mức gi&aacute; phải chăng hơn.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Máy tính bảng', '', '', 0, '1', NULL, 'Approved', 'Hà Quan Tính', '03/02/22 09:02', 'Hà Quan Tính', '03/02/22 09:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_products_cat`
--

CREATE TABLE `tbl_products_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `cat_slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_order` int(11) NOT NULL,
  `cat_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_products_cat`
--

INSERT INTO `tbl_products_cat` (`cat_id`, `cat_title`, `cat_slug`, `num_order`, `cat_status`, `create_date`, `creator`, `editor`, `edit_date`, `parent_id`) VALUES
(10, 'Điện thoại', 'dien-thoai', 1, 'Approved', '10/12/21 09:12', 'Hà Quan Tính', '', '', 0),
(12, 'Máy tính', 'may-tinh', 11, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 0),
(13, 'Dell', 'may-tinh-del', 12, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(14, 'Asus', 'may-tinh-asus', 13, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(15, 'Hp', 'may-tinh-hp', 14, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(16, 'Lenovo', 'may-tinh-lenovo', 15, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(17, 'Acer', 'may-tinh-acer', 16, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(18, 'Msi', 'may-tinh-msi', 17, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(19, 'MacBook', 'mac-book', 18, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 12),
(20, 'Iphone', 'i-phone', 2, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 10),
(21, 'Samsung', 'sam-sung', 6, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', 'Hà Quan Tính', '11/01/22 04:01', 10),
(22, 'Oppo', 'op-po', 7, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 10),
(23, 'Vivo', 'vi-vo', 8, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 10),
(24, 'Xiaomi', 'xi-ao-mi', 9, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 10),
(25, 'Realme', 'real-me', 10, 'Approved', '11/12/21 03:12', 'Hà Quan Tính', '', '', 10),
(26, 'Iphone X', 'i-phone-x', 3, 'Approved', '11/01/22 04:01', 'Hà Quan Tính', '', '', 20),
(27, 'Iphone 8', 'i-phone-8', 4, 'Approved', '11/01/22 04:01', 'Hà Quan Tính', '', '', 20),
(28, 'Iphone 8 Plus', 'i-phone-8-plus', 5, 'Approved', '11/01/22 04:01', 'Hà Quan Tính', '', '', 20),
(29, 'Tai nghe', 'tai-nghe-chinh-hang', 19, 'Approved', '11/01/22 04:01', 'Hà Quan Tính', '', '', 0),
(30, 'Máy tính bảng', 'may-tinh-bang', 20, 'Approved', '11/01/22 04:01', 'Hà Quan Tính', '', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_products_order`
--

CREATE TABLE `tbl_products_order` (
  `product_order_id` int(12) NOT NULL,
  `order_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_qty` int(12) NOT NULL,
  `sub_total` int(12) NOT NULL,
  `product_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_products_order`
--

INSERT INTO `tbl_products_order` (`product_order_id`, `order_code`, `product_qty`, `sub_total`, `product_id`) VALUES
(1, 'MKGP3HA/B', 1, 41990000, 19),
(2, 'MKGP3SA/A', 1, 52990000, 2),
(3, 'MKGP3SA/C', 1, 30840000, 16),
(22, 'QTAD1642477965', 1, 290000, 30),
(23, 'QTAD1642478073', 1, 290000, 30),
(24, 'QTAD1642478468', 1, 290000, 30),
(25, 'QTAD1642478520', 1, 290000, 30),
(26, 'QTAD1642493624', 1, 8490000, 22),
(27, 'MKGP1642497257', 1, 3192000, 28),
(28, 'MKGP1642497400', 1, 3192000, 28),
(29, 'MKGP1642497430', 1, 290000, 30),
(30, 'QTAD1642497472', 1, 290000, 30),
(31, 'MKGP1643884636', 1, 7990000, 50),
(32, 'QTAD1643902670', 1, 9990000, 62),
(33, 'QTAD1644824090', 1, 38200000, 60);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sliders`
--

CREATE TABLE `tbl_sliders` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slider_link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slider_desc` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_order` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slider_thumb` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slider_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `creator` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `edit_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_sliders`
--

INSERT INTO `tbl_sliders` (`slider_id`, `slider_title`, `slider_link`, `slider_desc`, `num_order`, `slider_thumb`, `slider_status`, `creator`, `create_date`, `editor`, `edit_date`) VALUES
(8, 'Slider-1', 'www.slider-1.com', '<p>sllider1 website</p>\r\n', '1', 'public/images/upload/sliders/slider-1.png', 'Approved', 'admin', '21/12/2021', 'Hà Quan Tính', '21/12/21 04:12'),
(9, 'Slider-2', 'www.slider-2.com', '<p>slider2 website</p>\r\n', '2', 'public/images/upload/sliders/slider-2.png', 'Approved', 'admin', '21/12/2021', 'Hà Quan Tính', '21/12/21 04:12'),
(10, 'Slider-3', 'www.slider-3.com', '<p>slider website 3</p>\r\n', '3', 'public/images/upload/sliders/slider-3.png', 'Approved', 'admin', '21/12/2021', 'Hà Quan Tính', '21/12/21 04:12'),
(11, 'Slider-4', '-www-slider-4-com', '<p>website 4 webpack</p>\r\n', '4', 'public/images/upload/sliders/slider-4.png', 'Approved', 'admin', '21/12/2021', 'Hà Quan Tính', '21/12/21 06:12'),
(12, 'Slider-5', '-www-slider-5-com', '<p>slider n&agrave;y do dội admin tạo</p>\r\n', '5', 'public/images/upload/sliders/slider-5.png', 'Approved', 'admin', '11/01/2022', '', ''),
(13, 'Slider-6', '-www-slider-6-com', '<p>slider n&agrave;y do đội admin tạo</p>\r\n', '6', 'public/images/upload/sliders/slider-6.png', 'Approved', 'admin', '11/01/2022', '', ''),
(14, 'Slider-7', '-www-slider-7-com', '<p>slider n&agrave;y do đội sản xuất admin tạo</p>\r\n', '7', 'public/images/upload/sliders/slider-7.png', 'Approved', 'admin', '11/01/2022', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_transaction` int(11) DEFAULT NULL,
  `is_active` enum('0','1') COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT '0',
  `active_token` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `reg_date` int(15) NOT NULL,
  `reset_token` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `reset_date` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fullname`, `username`, `password`, `email`, `address`, `tel`, `gender`, `num_transaction`, `is_active`, `active_token`, `reg_date`, `reset_token`, `reset_date`) VALUES
(1, 'Hà Quan Tính', 'admin01', '675fc3e18e7f9cf95d71a71548950048', 'htinh7444@gmail.com', '145 Âu Cơ,Tp Đà Nẵng', '0377968862', 'male', NULL, '0', '22fd775929d1107a0f5bf291e4437ebd', 1640961955, NULL, NULL),
(2, 'Cao Tùng Anh', 'tung03', '15e8c5796b5e760e036d61d141907acb', 'caotunganh@gmail.com', '245 Lê  Duẫn, Tp Đà Nẵng', '0377968987', 'male', NULL, '0', '17f073f8f756bf4f826f74524d30f953', 1642411523, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_banners`
--
ALTER TABLE `tbl_banners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Chỉ mục cho bảng `tbl_blocks`
--
ALTER TABLE `tbl_blocks`
  ADD PRIMARY KEY (`block_id`);

--
-- Chỉ mục cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_medias`
--
ALTER TABLE `tbl_medias`
  ADD PRIMARY KEY (`media_id`);

--
-- Chỉ mục cho bảng `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Chỉ mục cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Chỉ mục cho bảng `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Chỉ mục cho bảng `tbl_posts_cat`
--
ALTER TABLE `tbl_posts_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_products_cat`
--
ALTER TABLE `tbl_products_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `tbl_products_order`
--
ALTER TABLE `tbl_products_order`
  ADD PRIMARY KEY (`product_order_id`);

--
-- Chỉ mục cho bảng `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `tbl_banners`
--
ALTER TABLE `tbl_banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_blocks`
--
ALTER TABLE `tbl_blocks`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_medias`
--
ALTER TABLE `tbl_medias`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_posts_cat`
--
ALTER TABLE `tbl_posts_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `tbl_products_cat`
--
ALTER TABLE `tbl_products_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `tbl_products_order`
--
ALTER TABLE `tbl_products_order`
  MODIFY `product_order_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
