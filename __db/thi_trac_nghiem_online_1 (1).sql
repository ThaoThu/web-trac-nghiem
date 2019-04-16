-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 09, 2019 lúc 09:00 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thi_trac_nghiem_online_1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baithi`
--

CREATE TABLE `baithi` (
  `ma_bt` int(11) NOT NULL,
  `ma_ts` int(11) NOT NULL,
  `ma_lp` int(11) NOT NULL,
  `ma_dt` int(11) NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_thi` date NOT NULL,
  `trang_thai` int(1) DEFAULT '0',
  `so_cau_dung` int(11) NOT NULL,
  `diem` int(11) NOT NULL,
  `unique_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baithi`
--

INSERT INTO `baithi` (`ma_bt`, `ma_ts`, `ma_lp`, `ma_dt`, `noi_dung`, `ngay_thi`, `trang_thai`, `so_cau_dung`, `diem`, `unique_value`) VALUES
(177, 1041360136, 3, 14, 'a:10:{i:77;s:0:\"\";i:59;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";i:65;s:0:\"\";i:79;s:0:\"\";i:64;s:0:\"\";i:70;s:0:\"\";i:68;s:0:\"\";i:74;s:0:\"\";}', '2019-03-08', 0, 0, 0, 'df3347b9a749c47bcb50a73bb3037008'),
(178, 1041360148, 3, 14, 'a:0:{}', '2019-03-08', 1, 0, 0, '52922eba7c01e43912aed9cb2bcf2fd9'),
(179, 1041360149, 3, 14, 'a:10:{i:65;s:1:\"1\";i:70;s:1:\"2\";i:77;s:1:\"2\";i:59;s:1:\"2\";i:81;s:1:\"2\";i:74;s:1:\"3\";i:64;s:1:\"2\";i:68;s:1:\"1\";i:69;s:1:\"2\";i:79;s:1:\"1\";}', '2019-03-07', 1, 1, 1, '5db34c5e9bf6726488507e1a70fb5eb4'),
(180, 1041360155, 3, 14, 'a:10:{i:77;s:0:\"\";i:59;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";i:65;s:0:\"\";i:79;s:0:\"\";i:64;s:0:\"\";i:70;s:0:\"\";i:68;s:0:\"\";i:74;s:0:\"\";}', '2019-03-08', 0, 0, 0, '7de4f079b5324f111e7f96d4f90520ef'),
(181, 1041360156, 3, 14, 'a:10:{i:79;s:0:\"\";i:68;s:0:\"\";i:64;s:0:\"\";i:70;s:0:\"\";i:59;s:0:\"\";i:77;s:0:\"\";i:69;s:0:\"\";i:81;s:0:\"\";i:65;s:0:\"\";i:74;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'ffc1eeb64e495f35a4a9e889c4d26d0e'),
(182, 1041360157, 3, 14, 'a:10:{i:77;s:0:\"\";i:59;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";i:65;s:0:\"\";i:79;s:0:\"\";i:64;s:0:\"\";i:70;s:0:\"\";i:68;s:0:\"\";i:74;s:0:\"\";}', '0000-00-00', 0, 0, 0, '6d87d98af445b749ee0ea6cfd2eb1b70'),
(183, 1041360158, 3, 14, 'a:10:{i:74;s:0:\"\";i:68;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";i:77;s:0:\"\";i:65;s:0:\"\";i:79;s:0:\"\";i:70;s:0:\"\";i:64;s:0:\"\";i:59;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'de30ff29021073a1291e6e55a42d043d'),
(184, 1041360159, 3, 14, 'a:10:{i:68;s:0:\"\";i:65;s:0:\"\";i:59;s:0:\"\";i:79;s:0:\"\";i:77;s:0:\"\";i:70;s:0:\"\";i:69;s:0:\"\";i:64;s:0:\"\";i:81;s:0:\"\";i:74;s:0:\"\";}', '0000-00-00', 0, 0, 0, '86db3414e8bfb576e62843d9e66f2841'),
(185, 1041360160, 3, 14, 'a:10:{i:77;s:1:\"2\";i:68;s:1:\"4\";i:59;s:1:\"4\";i:64;s:1:\"4\";i:74;s:1:\"3\";i:79;s:1:\"3\";i:70;s:1:\"3\";i:81;s:1:\"4\";i:65;s:1:\"4\";i:69;s:1:\"2\";}', '2019-03-09', 1, 4, 4, 'de472ee3ce2f37435374ee5a981c778d'),
(186, 1041360161, 3, 14, 'a:10:{i:81;s:0:\"\";i:79;s:0:\"\";i:64;s:0:\"\";i:69;s:0:\"\";i:77;s:0:\"\";i:59;s:0:\"\";i:68;s:0:\"\";i:65;s:0:\"\";i:70;s:0:\"\";i:74;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'f24fc9a9730cf51f7580525160f2003e'),
(187, 1041360162, 3, 14, 'a:10:{i:64;s:0:\"\";i:81;s:0:\"\";i:59;s:0:\"\";i:69;s:0:\"\";i:74;s:0:\"\";i:77;s:0:\"\";i:70;s:0:\"\";i:68;s:0:\"\";i:65;s:0:\"\";i:79;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'f172393774389f2d12b63cce642d9d78'),
(188, 1041360150, 6, 14, 'a:10:{i:74;s:0:\"\";i:77;s:0:\"\";i:70;s:0:\"\";i:79;s:0:\"\";i:81;s:0:\"\";i:68;s:0:\"\";i:59;s:0:\"\";i:69;s:0:\"\";i:64;s:0:\"\";i:65;s:0:\"\";}', '0000-00-00', 0, 0, 0, '6bf9683225e2969dbf708401e72714c0'),
(222, 1041360136, 3, 17, 'a:5:{i:76;s:1:\"2\";i:75;s:1:\"3\";i:81;s:1:\"3\";i:47;s:1:\"3\";i:68;s:1:\"2\";}', '2019-03-09', 1, 1, 1, '7e5e9595ac303f00374b2dbaf93dd68b'),
(223, 1041360148, 3, 17, 'a:5:{i:76;s:1:\"2\";i:47;s:1:\"3\";i:68;s:1:\"3\";i:81;s:1:\"3\";i:75;s:1:\"1\";}', '2019-03-09', 1, 1, 1, '350c74ec89f2161f79b202c651a79dbe'),
(224, 1041360149, 3, 17, 'a:5:{i:68;s:1:\"1\";i:47;s:1:\"1\";i:81;s:1:\"1\";i:76;s:1:\"1\";i:75;s:1:\"1\";}', '2019-03-09', 1, 1, 1, '17ae0c5274821e147270a64c097b57ad'),
(225, 1041360155, 3, 17, 'a:5:{i:47;s:0:\"\";i:75;s:0:\"\";i:81;s:0:\"\";i:68;s:0:\"\";i:76;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'a7d627d122e4c83a24ff94f9c33f116a'),
(226, 1041360156, 3, 17, 'a:5:{i:75;s:0:\"\";i:76;s:0:\"\";i:68;s:0:\"\";i:47;s:0:\"\";i:81;s:0:\"\";}', '0000-00-00', 0, 0, 0, '71190bcf6f4591bf28bcb8c8fedfc232'),
(227, 1041360157, 3, 17, 'a:5:{i:76;s:0:\"\";i:81;s:0:\"\";i:68;s:0:\"\";i:75;s:0:\"\";i:47;s:0:\"\";}', '0000-00-00', 0, 0, 0, '958ece1f2725e45511b1ae142f41b8c8'),
(228, 1041360158, 3, 17, 'a:5:{i:81;s:0:\"\";i:75;s:0:\"\";i:76;s:0:\"\";i:68;s:0:\"\";i:47;s:0:\"\";}', '0000-00-00', 0, 0, 0, '1455a2f6321715b73e815410abcee90b'),
(229, 1041360159, 3, 17, 'a:5:{i:76;s:0:\"\";i:68;s:0:\"\";i:81;s:0:\"\";i:47;s:0:\"\";i:75;s:0:\"\";}', '0000-00-00', 0, 0, 0, '1dd7b7caadf4190ace4d1ca7848f2988'),
(230, 1041360160, 3, 17, 'a:5:{i:75;s:0:\"\";i:81;s:0:\"\";i:47;s:0:\"\";i:76;s:0:\"\";i:68;s:0:\"\";}', '0000-00-00', 0, 0, 0, '225e3c15111b4fed38deefe5720069ed'),
(231, 1041360161, 3, 17, 'a:5:{i:76;s:0:\"\";i:47;s:0:\"\";i:68;s:0:\"\";i:81;s:0:\"\";i:75;s:0:\"\";}', '0000-00-00', 0, 0, 0, '7ec5864520627f98664fed02aaf7374f'),
(232, 1041360162, 3, 17, 'a:5:{i:76;s:0:\"\";i:81;s:0:\"\";i:75;s:0:\"\";i:68;s:0:\"\";i:47;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'de734208ec504e0c20131c97ecab2437'),
(233, 1041360136, 3, 16, 'a:10:{i:61;s:0:\"\";i:78;s:0:\"\";i:75;s:0:\"\";i:73;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";i:67;s:0:\"\";i:59;s:0:\"\";i:79;s:0:\"\";i:71;s:0:\"\";}', '0000-00-00', 0, 0, 0, '3f9318ed1bd5581f8238dc3998d1416f'),
(234, 1041360148, 3, 16, 'a:10:{i:67;s:0:\"\";i:61;s:0:\"\";i:78;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";i:79;s:0:\"\";i:71;s:0:\"\";i:59;s:0:\"\";i:73;s:0:\"\";i:75;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'a18a3c3e51083ef81f31297ab4a23b39'),
(235, 1041360149, 3, 16, 'a:10:{i:71;s:0:\"\";i:67;s:0:\"\";i:61;s:0:\"\";i:59;s:0:\"\";i:75;s:0:\"\";i:81;s:0:\"\";i:73;s:0:\"\";i:79;s:0:\"\";i:78;s:0:\"\";i:69;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'b757c1281356cf3ca61b7dbb41debf27'),
(236, 1041360155, 3, 16, 'a:10:{i:71;s:0:\"\";i:73;s:0:\"\";i:75;s:0:\"\";i:59;s:0:\"\";i:67;s:0:\"\";i:81;s:0:\"\";i:79;s:0:\"\";i:78;s:0:\"\";i:61;s:0:\"\";i:69;s:0:\"\";}', '0000-00-00', 0, 0, 0, '8c6d44db6c14606a65278d59fc8e152d'),
(237, 1041360156, 3, 16, 'a:10:{i:61;s:0:\"\";i:79;s:0:\"\";i:67;s:0:\"\";i:73;s:0:\"\";i:69;s:0:\"\";i:59;s:0:\"\";i:71;s:0:\"\";i:81;s:0:\"\";i:78;s:0:\"\";i:75;s:0:\"\";}', '0000-00-00', 0, 0, 0, '11162f3e88342369e6425cba5c95b34b'),
(238, 1041360157, 3, 16, 'a:10:{i:78;s:0:\"\";i:69;s:0:\"\";i:79;s:0:\"\";i:71;s:0:\"\";i:73;s:0:\"\";i:75;s:0:\"\";i:59;s:0:\"\";i:67;s:0:\"\";i:81;s:0:\"\";i:61;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'a9421f46570c816ff25d43ab41b6fb5c'),
(239, 1041360158, 3, 16, 'a:10:{i:78;s:0:\"\";i:75;s:0:\"\";i:59;s:0:\"\";i:67;s:0:\"\";i:73;s:0:\"\";i:79;s:0:\"\";i:71;s:0:\"\";i:61;s:0:\"\";i:81;s:0:\"\";i:69;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'f1998ae31bf58b49eb48903d83e2ab4a'),
(240, 1041360159, 3, 16, 'a:10:{i:67;s:0:\"\";i:59;s:0:\"\";i:69;s:0:\"\";i:71;s:0:\"\";i:75;s:0:\"\";i:81;s:0:\"\";i:78;s:0:\"\";i:73;s:0:\"\";i:61;s:0:\"\";i:79;s:0:\"\";}', '0000-00-00', 0, 0, 0, '5abdc03f3d11b02acf1eaa853cdbd119'),
(241, 1041360160, 3, 16, 'a:10:{i:61;s:0:\"\";i:67;s:0:\"\";i:69;s:0:\"\";i:81;s:0:\"\";i:78;s:0:\"\";i:59;s:0:\"\";i:75;s:0:\"\";i:71;s:0:\"\";i:79;s:0:\"\";i:73;s:0:\"\";}', '0000-00-00', 0, 0, 0, '94e20b5b88bd2cefc0e83a8472bc2d67'),
(242, 1041360161, 3, 16, 'a:10:{i:73;s:0:\"\";i:61;s:0:\"\";i:78;s:0:\"\";i:59;s:0:\"\";i:71;s:0:\"\";i:67;s:0:\"\";i:75;s:0:\"\";i:79;s:0:\"\";i:69;s:0:\"\";i:81;s:0:\"\";}', '0000-00-00', 0, 0, 0, 'a09b0131b54f09b610e836e7f6bfc3dc'),
(243, 1041360162, 3, 16, 'a:10:{i:59;s:0:\"\";i:78;s:0:\"\";i:71;s:0:\"\";i:75;s:0:\"\";i:69;s:0:\"\";i:81;s:0:\"\";i:73;s:0:\"\";i:61;s:0:\"\";i:67;s:0:\"\";i:79;s:0:\"\";}', '0000-00-00', 0, 0, 0, '5e2a2172b4b6290f46a24909e22800e1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhoi`
--

CREATE TABLE `cauhoi` (
  `ma_ch` int(11) NOT NULL,
  `ma_mh` int(11) NOT NULL,
  `id_hp` int(11) NOT NULL,
  `noi_dung_ch` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `so_luong_dap_an` int(11) NOT NULL,
  `noi_dung_dap_an` text COLLATE utf8_unicode_ci NOT NULL,
  `dokho` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locked` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cauhoi`
--

INSERT INTO `cauhoi` (`ma_ch`, `ma_mh`, `id_hp`, `noi_dung_ch`, `so_luong_dap_an`, `noi_dung_dap_an`, `dokho`, `locked`) VALUES
(32, 5, 3, '<p>Kh&ocirc;ng c&oacute; kết nối Internet H&atilde;y thử: Kiểm tra c&aacute;p mạng, modem v&agrave; bộ định tuyến Kết nối lại với Wi-Fi</p>\r\n', 4, 'a:0:{}', '0', 1),
(35, 4, 6, '<p>I&#39;m very proud __ you.</p>\r\n', 1, 'a:1:{i:1;a:2:{i:0;s:2:\"in\";i:1;i:1;}}', 'de', 1),
(37, 5, 6, '<p>i get up __ 6 am everymorning.</p>\r\n', 2, 'a:4:{i:1;a:2:{i:0;s:2:\"at\";i:1;i:0;}i:2;a:2:{i:0;s:2:\"in\";i:1;i:1;}i:3;a:2:{i:0;s:2:\"on\";i:1;i:0;}i:4;a:2:{i:0;s:2:\"by\";i:1;i:0;}}', '0', 1),
(38, 5, 6, '<p>will you marry me?</p>\r\n', 2, 'a:2:{i:1;a:2:{i:0;s:8:\"yes,i do\";i:1;i:1;}i:2;a:2:{i:0;s:7:\"no,i do\";i:1;i:0;}}', '0', 1),
(47, 8, 10, '<p><strong>Thiết bị n&agrave;o sau đ&acirc;y d&ugrave;ng để kết nối mạng?</strong></p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:3:\"Ram\";i:1;i:0;}i:2;a:2:{i:0;s:3:\"Rom\";i:1;i:0;}i:3;a:2:{i:0;s:6:\"Router\";i:1;i:1;}i:4;a:2:{i:0;s:3:\"CPU\";i:1;i:0;}}', 'de', 1),
(58, 8, 10, '<p><strong>Hệ thống nhớ của m&aacute;y t&iacute;nh bao gồm:</strong></p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:35:\"Bộ nhớ trong, Bộ nhớ ngoài\";i:1;i:1;}i:2;a:2:{i:0;s:24:\"Cache, Bộ nhớ ngoài\";i:1;i:0;}i:3;a:2:{i:0;s:22:\"Bộ nhớ ngoài, ROM\";i:1;i:0;}i:4;a:2:{i:0;s:29:\"Đĩa quang, Bộ nhớ trong\";i:1;i:0;}}', 'tb', 1),
(59, 8, 10, '<p>Trong mạng m&aacute;y t&iacute;nh, thuật ngữ Share c&oacute; &yacute; nghĩa g&igrave;?</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:22:\"Chia sẻ tài nguyên\";i:1;i:1;}i:2;a:2:{i:0;s:56:\"Nhãn hiệu của một thiết bị kết nối mạng\";i:1;i:0;}i:3;a:2:{i:0;s:47:\"Thực hiện lệnh in trong mạng cục bộ\";i:1;i:0;}i:4;a:2:{i:0;s:59:\"Một phần mềm hỗ trợ sử dụng mạng cục bộ\";i:1;i:0;}}', 'kho', 1),
(60, 8, 11, '<p><strong>Bộ nhớ RAM v&agrave; ROM l&agrave; bộ nhớ g&igrave;?</strong></p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:14:\"Primary memory\";i:1;i:1;}i:2;a:2:{i:0;s:14:\"Receive memory\";i:1;i:0;}i:3;a:2:{i:0;s:16:\"Secondary memory\";i:1;i:0;}i:4;a:2:{i:0;s:21:\"Random access memory.\";i:1;i:0;}}', 'de', 0),
(61, 8, 11, '<p>C&aacute;c thiết bị n&agrave;o th&ocirc;ng dụng nhất hiện nay d&ugrave;ng để cung cấp dữ liệu cho m&aacute;y xử l&yacute;?</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:57:\"Bàn phím (Keyboard), Chuột (Mouse), Máy in (Printer)\";i:1;i:0;}i:2;a:2:{i:0;s:25:\"Máy quét ảnh (Scaner)\";i:1;i:0;}i:3;a:2:{i:0;s:68:\"Bàn phím (Keyboard), Chuột (Mouse) và Máy quét ảnh (Scaner)\";i:1;i:1;}i:4;a:2:{i:0;s:42:\"Máy quét ảnh (Scaner), Chuột (Mouse)\";i:1;i:0;}}', 'de', 0),
(62, 8, 11, '<p><strong>Kh&aacute;i niệm hệ điều h&agrave;nh l&agrave; g&igrave; ?</strong></p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:59:\"Cung cấp và xử lý các phần cứng và phần mềm\";i:1;i:0;}i:2;a:2:{i:0;s:93:\"Nghiên cứu phương pháp, kỹ thuật xử lý thông tin bằng máy tính điện tử\";i:1;i:0;}i:3;a:2:{i:0;s:62:\"Nghiên cứu về công nghệ phần cứng và phần mềm\";i:1;i:0;}i:4;a:2:{i:0;s:169:\"Là một phần mềm chạy trên máy tính, dùng để điều hành, quản lý các thiết bị phần cứng và các tài nguyên phần mềm trên máy tính\";i:1;i:1;}}', 'de', 0),
(63, 8, 12, '<p><strong>Cho biết c&aacute;ch x&oacute;a một tập tin hay thư mục m&agrave; kh&ocirc;ng di chuyển v&agrave;o Recycle Bin:?</strong></p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:51:\"Chọn thư mục hay tâp tin cần xóa -> Delete\";i:1;i:0;}i:2;a:2:{i:0;s:58:\"Chọn thư mục hay tâp tin cần xóa -> Ctrl + Delete\";i:1;i:0;}i:3;a:2:{i:0;s:57:\"Chọn thư mục hay tâp tin cần xóa -> Alt + Delete\";i:1;i:0;}i:4;a:2:{i:0;s:59:\"Chọn thư mục hay tâp tin cần xóa -> Shift + Delete\";i:1;i:1;}}', 'de', 0),
(64, 8, 12, '<p><strong>Danh s&aacute;ch c&aacute;c mục chọn trong thực đơn gọi l&agrave;&nbsp;</strong>:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:8:\"Menu pad\";i:1;i:0;}i:2;a:2:{i:0;s:12:\"Menu options\";i:1;i:0;}i:3;a:2:{i:0;s:8:\"Menu bar\";i:1;i:1;}i:4;a:2:{i:0;s:21:\"Tất cả đều sai\";i:1;i:0;}}', 'de', 0),
(65, 8, 12, '<p>C&ocirc;ng dụng của ph&iacute;m Print Screen l&agrave; g&igrave;?</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:37:\"In màn hình hiện hành ra máy in\";i:1;i:0;}i:2;a:2:{i:0;s:56:\"Không có công dụng gì khi sử dụng 1 mình nó.\";i:1;i:0;}i:3;a:2:{i:0;s:37:\"In văn bản hiện hành ra máy in\";i:1;i:0;}i:4;a:2:{i:0;s:30:\"Chụp màn hình hiện hành\";i:1;i:1;}}', 'de', 0),
(66, 8, 12, '<p>Nếu bạn muốn l&agrave;m cho cửa sổ nhỏ hơn (kh&ocirc;ng k&iacute;n m&agrave;n h&igrave;nh), bạn n&ecirc;n sử dụng n&uacute;t n&agrave;o?</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:7:\"Maximum\";i:1;i:0;}i:2;a:2:{i:0;s:7:\"Minimum\";i:1;i:0;}i:3;a:2:{i:0;s:12:\"Restore down\";i:1;i:1;}i:4;a:2:{i:0;s:5:\"Close\";i:1;i:0;}}', 'de', 0),
(67, 8, 11, '<p>Trong soạn thảo Word, c&ocirc;ng dụng của tổ hợp ph&iacute;m Ctrl &ndash; S l&agrave;:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:28:\"Tạo một văn bản mới\";i:1;i:0;}i:2;a:2:{i:0;s:54:\"Chức năng thay thế nội dung trong soạn thảo\";i:1;i:0;}i:3;a:2:{i:0;s:24:\"Định dạng chữ hoa\";i:1;i:0;}i:4;a:2:{i:0;s:47:\"Lưu nội dung tập tin văn bản vào đĩa\";i:1;i:1;}}', 'tb', 0),
(68, 8, 11, '<p>Trong soạn thảo Word, để ch&egrave;n c&aacute;c k&iacute; tự đặc biệt v&agrave;o văn bản, ta thực hiện:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:15:\"View – Symbol\";i:1;i:0;}i:2;a:2:{i:0;s:17:\"Format – Symbol\";i:1;i:0;}i:3;a:2:{i:0;s:16:\"Tools – Symbol\";i:1;i:0;}i:4;a:2:{i:0;s:17:\"Insert – Symbol\";i:1;i:1;}}', 'tb', 0),
(69, 8, 11, '<p>Trong soạn thảo Word, để kết th&uacute;c 1 đoạn (Paragraph) v&agrave; muốn sang 1 đoạn mới :</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:37:\"Bấm tổ hợp phím Ctrl – Enter\";i:1;i:0;}i:2;a:2:{i:0;s:17:\"Bấm phím Enter\";i:1;i:1;}i:3;a:2:{i:0;s:38:\"Bấm tổ hợp phím Shift – Enter\";i:1;i:0;}i:4;a:2:{i:0;s:43:\"Word tự động, không cần bấm phím\";i:1;i:0;}}', 'kho', 0),
(70, 8, 12, '<p>Trong soạn thảo Word, tổ hợp ph&iacute;m n&agrave;o cho ph&eacute;p đưa con trỏ về cuối văn bản :</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:11:\"Shift + End\";i:1;i:0;}i:2;a:2:{i:0;s:9:\"Alt + End\";i:1;i:0;}i:3;a:2:{i:0;s:10:\"Ctrl + End\";i:1;i:0;}i:4;a:2:{i:0;s:16:\"Ctrl + Alt + End\";i:1;i:1;}}', 'kho', 0),
(71, 8, 11, '<p>Trong soạn thảo Word, để chọn một đoạn văn bản ta thực hiện:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:27:\"Click 1 lần trên đoạn\";i:1;i:0;}i:2;a:2:{i:0;s:27:\"Click 2 lần trên đoạn\";i:1;i:0;}i:3;a:2:{i:0;s:27:\"Click 3 lần trên đoạn\";i:1;i:1;}i:4;a:2:{i:0;s:27:\"Click 4 lần trên đoạn\";i:1;i:0;}}', 'tb', 0),
(72, 8, 11, '<p>Trong soạn thảo Word, muốn đ&aacute;nh dấu lựa chọn một từ, ta thực hiện :</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:42:\"Nháy đúp chuột vào từ cần chọn\";i:1;i:1;}i:2;a:2:{i:0;s:33:\"Bấm tổ hợp phím Ctrl – C\";i:1;i:0;}i:3;a:2:{i:0;s:36:\"Nháy chuột vào từ cần chọn\";i:1;i:0;}i:4;a:2:{i:0;s:17:\"Bấm phím Enter\";i:1;i:0;}}', 'kho', 0),
(73, 8, 11, '<p>Trong soạn thảo Word, muốn t&aacute;ch một &ocirc; trong Table th&agrave;nh nhiều &ocirc;, ta thực hiện:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:21:\"Table – Merge Cells\";i:1;i:0;}i:2;a:2:{i:0;s:21:\"Table – Split Cells\";i:1;i:1;}i:3;a:2:{i:0;s:21:\"Tools – Split Cells\";i:1;i:0;}i:4;a:2:{i:0;s:15:\"Table – Cells\";i:1;i:0;}}', 'kho', 0),
(74, 8, 10, '<p>Trong soạn thảo Word, thao t&aacute;c n&agrave;o sau đ&acirc;y sẽ k&iacute;ch hoạt lệnh Paste (Chọn nhiều đ&aacute;p &aacute;n)</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:47:\"Tại thẻ Home, nhóm Clipboard, chọn Paste\";i:1;i:1;}i:2;a:2:{i:0;s:32:\"Bấm tổ hợp phím Ctrl + V.\";i:1;i:1;}i:3;a:2:{i:0;s:39:\"Chọn vào mục trong Office Clipboar\";i:1;i:0;}i:4;a:2:{i:0;s:24:\"Tất cả đều đúng\";i:1;i:0;}}', 'tb', 0),
(75, 8, 10, '<p>Phần mềm n&agrave;o c&oacute; thể soạn thảo văn bản với nội dung v&agrave; định dạng như sau:<br />\r\n&rdquo; C&ocirc;ng cha như n&uacute;i Th&aacute;i Sơn<br />\r\nNghĩa mẹ như nước trong nguồn chảy ra.<br />\r\nMột l&ograve;ng thờ mẹ k&iacute;nh cha,', 4, 'a:4:{i:1;a:2:{i:0;s:7:\"Notepad\";i:1;i:0;}i:2;a:2:{i:0;s:14:\"Microsoft Word\";i:1;i:0;}i:3;a:2:{i:0;s:7:\"WordPad\";i:1;i:0;}i:4;a:2:{i:0;s:24:\"Tất cả đều đúng\";i:1;i:1;}}', 'tb', 0),
(76, 8, 10, '<p>Trong bảng t&iacute;nh Excel, gi&aacute; trị trả về của c&ocirc;ng thức =LEN(&ldquo;TRUNG TAM TIN HOC&rdquo;) l&agrave;:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:2:\"15\";i:1;i:0;}i:2;a:2:{i:0;s:2:\"16\";i:1;i:0;}i:3;a:2:{i:0;s:2:\"17\";i:1;i:1;}i:4;a:2:{i:0;s:2:\"18\";i:1;i:0;}}', 'tb', 0),
(77, 8, 11, '<p>Trong bảng t&iacute;nh Excel, cho c&aacute;c gi&aacute; trị như sau: &ocirc; A4 = 4, &ocirc; A2 = 5, &ocirc; A3 = 6, &ocirc; A7 = 7 tại vị tr&iacute; &ocirc; B2 lập c&ocirc;ng thức B2 = Sum(A4,A2,Count(A3,A4)) cho biết kết quả &ocirc; B2 sau khi E', 4, 'a:4:{i:1;a:2:{i:0;s:1:\"9\";i:1;i:0;}i:2;a:2:{i:0;s:2:\"10\";i:1;i:0;}i:3;a:2:{i:0;s:2:\"11\";i:1;i:1;}i:4;a:2:{i:0;s:5:\"Lỗi\";i:1;i:0;}}', 'de', 0),
(78, 8, 11, '<p>Trong bảng t&iacute;nh Excel, &ocirc; A1 chứa nội dung &ldquo;TTTH ĐHKHTN&rdquo;. Khi thực hiện c&ocirc;ng thức = LEN(A1)<br />\r\nth&igrave; gi&aacute; trị trả về kết quả:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:1:\"6\";i:1;i:0;}i:2;a:2:{i:0;s:2:\"11\";i:1;i:1;}i:3;a:2:{i:0;s:1:\"5\";i:1;i:0;}i:4;a:2:{i:0;s:1:\"0\";i:1;i:0;}}', 'tb', 0),
(79, 8, 12, '<p>Trong bảng t&iacute;nh Excel, &ocirc; A1 chứa gi&aacute; trị 7.5. Ta lập c&ocirc;ng thức tại &ocirc; B1 c&oacute; nội dung như sau<br />\r\n=IF(A1&gt;=5, &ldquo;Trung B&igrave;nh&rdquo;, IF(A1&gt;=7, &ldquo;Kh&aacute;&rdquo;, IF(A1&gt;=8, &ldquo;Giỏ', 4, 'a:4:{i:1;a:2:{i:0;s:7:\"Giỏi.\";i:1;i:0;}i:2;a:2:{i:0;s:13:\"Xuất sắc.\";i:1;i:0;}i:3;a:2:{i:0;s:11:\"Trung Bình\";i:1;i:1;}i:4;a:2:{i:0;s:5:\"Khá.\";i:1;i:0;}}', 'kho', 0),
(80, 8, 12, '<p>Trong bảng t&iacute;nh Excel, h&agrave;m n&agrave;o d&ugrave;ng để t&igrave;m kiếm:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:7:\"Vlookup\";i:1;i:1;}i:2;a:2:{i:0;s:2:\"IF\";i:1;i:0;}i:3;a:2:{i:0;s:4:\"Left\";i:1;i:0;}i:4;a:2:{i:0;s:3:\"Sum\";i:1;i:0;}}', 'de', 0),
(81, 8, 10, '<p>Trong bảng t&iacute;nh Excel, để lưu tập tin đang mở dưới một t&ecirc;n kh&aacute;c, ta chọn:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:14:\"File / Save As\";i:1;i:1;}i:2;a:2:{i:0;s:11:\"File / Save\";i:1;i:0;}i:3;a:2:{i:0;s:10:\"File / New\";i:1;i:0;}i:4;a:2:{i:0;s:14:\"Edit / Replace\";i:1;i:0;}}', 'de', 0),
(82, 8, 11, '<p>Trong bảng t&iacute;nh Excel, h&agrave;m Today() trả về:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:23:\"Số ngày trong tháng\";i:1;i:0;}i:2;a:2:{i:0;s:22:\"Số tháng trong năm\";i:1;i:0;}i:3;a:2:{i:0;s:37:\"Ngày hiện hành của hệ thống\";i:1;i:1;}i:4;a:2:{i:0;s:22:\"Số giờ trong ngày\";i:1;i:0;}}', 'de', 0),
(83, 8, 12, '<p>Trong bảng t&iacute;nh Excel, c&aacute;c dạng địa chỉ sau đ&acirc;y, địa chỉ n&agrave;o l&agrave; địa chỉ tuyệt đối:</p>\r\n', 4, 'a:4:{i:1;a:2:{i:0;s:10:\" B$1$$10$D\";i:1;i:0;}i:2;a:2:{i:0;s:3:\"B$1\";i:1;i:0;}i:3;a:2:{i:0;s:8:\"$B1:$D10\";i:1;i:0;}i:4;a:2:{i:0;s:10:\"$B$1:$D$10\";i:1;i:1;}}', 'de', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnangweb`
--

CREATE TABLE `chucnangweb` (
  `id` int(11) NOT NULL,
  `ten_chuc_nang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chucnangweb`
--

INSERT INTO `chucnangweb` (`id`, `ten_chuc_nang`, `link`) VALUES
(1, 'Xem danh sách tài khoản', 'admin-user_list'),
(2, 'Xóa ds tài khoản', 'admin-user_delete'),
(3, 'Sửa ds tài khoản', 'admin-user_edit'),
(4, 'Thêm tài khoản', 'admin-user_add'),
(5, 'Xóa lớp', 'admin-class_delete'),
(6, 'Thêm lớp', 'admin-class_add'),
(7, 'Sửa ds lớp', 'admin-class_edit'),
(9, 'Xóa môn học', 'admin-subject_delete'),
(10, 'Thêm môn học', 'admin-subject_add'),
(11, 'Sửa môn học', 'admin-subject_edit'),
(12, 'Xem ds môn học', 'admin-subject_list'),
(13, 'Thêm học sinh', 'admin-student_add'),
(14, 'Sửa học sinh', 'admin-student_edit'),
(15, 'Xóa học sinh', 'admin-student_delete'),
(16, 'Thêm câu hỏi', 'admin-question_add'),
(17, 'Sửa câu hỏi', 'admin-question_edit'),
(18, 'Xóa câu hỏi', 'admin-question_delete'),
(19, 'Thêm kỳ thi', 'admin-exam_add'),
(20, 'Sửa kỳ thi', 'admin-exam_edit'),
(21, 'Xóa kỳ thi', 'admin-exam_delete'),
(27, 'Xem danh sách kết quả thi', 'list_ds_kq'),
(28, 'Xem kết quả bài thi', 'list_kq'),
(29, 'Xem danh sách lớp', 'admin-class_list'),
(31, 'Sửa danh sách lớp', 'admin-class_edit'),
(32, 'Thêm nhóm tk', 'admin-group_add'),
(33, 'Sửa nhóm tk', 'admin-group_edit'),
(34, 'Xóa nhóm tk', 'admin-group_delete'),
(35, 'Xem ds nhóm tk', 'admin-group_list'),
(36, 'Khôi phục mật khẩu', ''),
(37, 'Xem danh sách bài thi', ''),
(38, 'Sửa thông tin cá nhân', ''),
(39, 'Làm bài thi', ''),
(40, 'Xem chi tiết bài thi', ''),
(41, 'Thêm đề thi', 'admin-de_add'),
(42, 'Sửa đề thi', 'admin-de_edit'),
(43, 'Xóa đề thi', 'admin-de_delete'),
(44, 'Xem danh sách học sinh', 'admin-student_list'),
(45, 'Xem ds câu hỏi', 'admin-question_list'),
(46, 'Xem ds kì thi', 'admin-exam_list'),
(47, 'e', 'admin-w'),
(48, 'e', 'admin-w_d'),
(49, 'admin', 'admin-add,edit,delete'),
(50, 'admin', 'admin-add,edit,delete'),
(51, 'admin', 'admin-add,edit,delete'),
(52, 'e', 'user-aa'),
(53, 'e', 'user-gg'),
(54, 'e', 'user-gg'),
(55, 'test', 'user-c'),
(56, 'test', 'admin-c'),
(57, 'test', 'user-c');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dethi`
--

CREATE TABLE `dethi` (
  `ma_dt` int(11) NOT NULL,
  `ma_kt` int(11) NOT NULL,
  `ma_mh` int(11) NOT NULL,
  `so_luong_cau_hoi` int(11) NOT NULL,
  `ds_id_ch` text COLLATE utf8_unicode_ci NOT NULL,
  `tong_diem` int(11) NOT NULL,
  `thoi_gian_lam_bai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locked` int(1) DEFAULT '1',
  `ngaytao` date NOT NULL,
  `nguoitao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unique_val` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dethi`
--

INSERT INTO `dethi` (`ma_dt`, `ma_kt`, `ma_mh`, `so_luong_cau_hoi`, `ds_id_ch`, `tong_diem`, `thoi_gian_lam_bai`, `locked`, `ngaytao`, `nguoitao`, `unique_val`) VALUES
(14, 6, 8, 10, 'a:10:{i:0;s:2:\"81\";i:1;s:2:\"74\";i:2;s:2:\"59\";i:3;s:2:\"77\";i:4;s:2:\"64\";i:5;s:2:\"65\";i:6;s:2:\"68\";i:7;s:2:\"69\";i:8;s:2:\"70\";i:9;s:2:\"79\";}', 10, '10', 1, '2019-03-05', '1000007', 'a68472c4da8b3a74a8730b0c1a400b96'),
(15, 8, 8, 20, 'a:20:{i:0;s:2:\"47\";i:1;s:2:\"81\";i:2;s:2:\"58\";i:3;s:2:\"74\";i:4;s:2:\"75\";i:5;s:2:\"76\";i:6;s:2:\"59\";i:7;s:2:\"62\";i:8;s:2:\"77\";i:9;s:2:\"64\";i:10;s:2:\"65\";i:11;s:2:\"67\";i:12;s:2:\"68\";i:13;s:2:\"71\";i:14;s:2:\"78\";i:15;s:2:\"69\";i:16;s:2:\"72\";i:17;s:2:\"73\";i:18;s:2:\"70\";i:19;s:2:\"79\";}', 10, '2', 1, '0000-00-00', 'admin', '83ac028e8162bce57d2f6aff1afe26a3'),
(16, 8, 8, 10, 'a:10:{i:0;s:2:\"81\";i:1;s:2:\"75\";i:2;s:2:\"59\";i:3;s:2:\"61\";i:4;s:2:\"67\";i:5;s:2:\"71\";i:6;s:2:\"78\";i:7;s:2:\"69\";i:8;s:2:\"73\";i:9;s:2:\"79\";}', 10, '2', 1, '0000-00-00', 'admin', '14db82e6ec32b2636339670a96422fae'),
(17, 7, 8, 5, 'a:5:{i:0;s:2:\"47\";i:1;s:2:\"81\";i:2;s:2:\"75\";i:3;s:2:\"76\";i:4;s:2:\"68\";}', 5, '2', 1, '2019-03-09', 'admin', 'a61b1a5a52002e6c998193ccb79947a6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaovien`
--

CREATE TABLE `giaovien` (
  `ma_gv` int(11) NOT NULL,
  `ho_dem` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` datetime DEFAULT CURRENT_TIMESTAMP,
  `gioi_tinh` int(1) DEFAULT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `ma_mh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giaovien`
--

INSERT INTO `giaovien` (`ma_gv`, `ho_dem`, `ten`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `dien_thoai`, `ma_mh`) VALUES
(1, 'An Thị', 'Tâm', '1977-07-01 00:00:00', 0, 'Hà Nội', '0938765777', 2),
(1000004, 'Nguyễn Thị', 'Lan', '1976-12-11 00:00:00', 1, 'Nam Từ Liêm', '0975898435', 8),
(1000005, 'Nguyễn Thị', 'Nga', '1976-01-01 00:00:00', 0, 'Hà Nội', '0974875993', 8),
(1000006, 'Trần Văn', 'Anh', '1990-01-01 00:00:00', 0, 'Hà  Nam', '0984738223', 8),
(1000007, 'Trần Văn', 'Anh Văn', '1990-01-01 00:00:00', 0, 'Hà  Nam', '0984738223', 2),
(1000008, 'Nguyễn Thị', 'Nga', '1991-01-01 00:00:00', 1, 'Hà Nội', '0975898435', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocphan`
--

CREATE TABLE `hocphan` (
  `ma_hp` int(11) NOT NULL,
  `ma_mh` int(11) NOT NULL,
  `ten_hp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locked` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hocphan`
--

INSERT INTO `hocphan` (`ma_hp`, `ma_mh`, `ten_hp`, `locked`) VALUES
(3, 5, 'Chương1', 0),
(5, 2, 'Chương 1', 0),
(6, 4, 'unit1', 0),
(10, 8, 'Chương 1', 0),
(11, 8, 'Chương 2', 0),
(12, 8, 'Chương 3', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kythi`
--

CREATE TABLE `kythi` (
  `id_kt` int(11) NOT NULL,
  `ten_kt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian_bat_dau` datetime DEFAULT CURRENT_TIMESTAMP,
  `thoi_gian_ket_thuc` datetime DEFAULT CURRENT_TIMESTAMP,
  `locked` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kythi`
--

INSERT INTO `kythi` (`id_kt`, `ten_kt`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `locked`) VALUES
(6, 'Giữa kỳ', '2019-02-01 12:00:00', '2019-02-01 13:00:00', 1),
(7, 'Cuối kỳ', '2019-03-13 00:00:00', '2019-03-22 00:00:00', 0),
(8, 'Đầu năm', '2019-03-07 00:00:00', '2019-03-21 00:00:00', 0),
(9, 'Khảo Sát Chất Lượng', '2019-03-08 00:00:00', '2019-03-16 00:00:00', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `ma_lop` int(11) NOT NULL,
  `ten_lop` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`ma_lop`, `ten_lop`, `ghi_chu`) VALUES
(3, '12A1', ''),
(4, '12A2', ''),
(5, '12A3', ''),
(6, '12A4', ''),
(7, '12A5', ''),
(8, '12A6', ''),
(9, '12A7', ''),
(10, '12A8', ''),
(11, '12A9', ''),
(12, '12A10', ''),
(13, '12A11', ''),
(14, '12A12', ''),
(17, '123', '1 ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `ma_mh` int(11) NOT NULL,
  `ten_mh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locked` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`ma_mh`, `ten_mh`, `ghi_chu`, `locked`) VALUES
(2, 'Đường lối quân sự của Đảng', 'chua co', 0),
(3, 'Tư tưởng Hồ Chí Minh', '', 0),
(4, 'Tiếng Anh', '', 0),
(5, 'Nhập môn PM', '', 0),
(8, 'Tin học', ' ', 0),
(13, 'Toán cao cấp2', ' ', 1),
(14, 'Toán cao cấp1', ' ', 1),
(15, '123', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomtaikhoan`
--

CREATE TABLE `nhomtaikhoan` (
  `gid` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhomtaikhoan`
--

INSERT INTO `nhomtaikhoan` (`gid`, `name`) VALUES
(5, 'Giáo Viên'),
(6, 'Học sinh'),
(7, 'nhom'),
(4, 'Quản trị'),
(9, 'thi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id_nhom_tk` int(11) NOT NULL,
  `id_chuc_nang` int(11) NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`id_nhom_tk`, `id_chuc_nang`, `trang_thai`) VALUES
(4, 1, 1),
(4, 2, 1),
(4, 3, 1),
(4, 4, 1),
(4, 5, 1),
(4, 6, 1),
(4, 7, 1),
(4, 9, 1),
(4, 10, 1),
(4, 11, 1),
(4, 12, 1),
(4, 13, 1),
(4, 14, 1),
(4, 15, 1),
(4, 16, 1),
(4, 17, 1),
(4, 18, 1),
(4, 19, 1),
(4, 20, 1),
(4, 21, 1),
(4, 27, 1),
(4, 28, 1),
(4, 29, 1),
(4, 31, 1),
(4, 32, 1),
(4, 33, 1),
(4, 34, 1),
(4, 35, 1),
(4, 44, 1),
(4, 45, 1),
(4, 46, 1),
(5, 2, 0),
(5, 5, 0),
(5, 6, 0),
(5, 7, 0),
(5, 10, 0),
(5, 11, 0),
(5, 12, 1),
(5, 13, 1),
(5, 14, 1),
(5, 15, 0),
(5, 29, 1),
(5, 44, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gid` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip_login` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_ts` int(11) DEFAULT NULL,
  `ma_gv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `username`, `passwd`, `gid`, `email`, `last_login`, `ip_login`, `ma_ts`, `ma_gv`) VALUES
(4, 'giaovien1', 'e10adc3949ba59abbe56e057f20f883e', 5, 'antam@gmail.com', '2019-03-05 16:01:45', '::1', NULL, 1),
(34, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 4, 'thaothung1.04@gmail.com', '2019-03-09 10:18:23', '::1', NULL, NULL),
(35, 'thaothu', 'fcea920f7412b5da7be0cf42b8c93759', 4, 'thaothung1.04@gmail.com', '2017-12-29 02:24:38', '::1', NULL, NULL),
(42, '1041360136', 'e10adc3949ba59abbe56e057f20f883e', 6, '', '2019-03-09 13:33:11', '::1', 1041360136, NULL),
(46, '1041360148', 'c20ad4d76fe97759aa27a0c99bff6710', 6, 'thuvan@gmail.com', '2019-03-09 13:39:48', '::1', 1041360148, NULL),
(47, '1041360149', 'e10adc3949ba59abbe56e057f20f883e', 6, '1@x.com', '2019-03-09 13:42:17', '::1', 1041360149, NULL),
(48, '1041360150', '432f45b44c432414d2f97df0e5743818', 6, 'abc@gmail.com', '2019-02-18 22:17:37', '::1', 1041360150, NULL),
(51, '1041360155', 'e10adc3949ba59abbe56e057f20f883e', 6, 'namdh@x.com', '2019-03-08 14:18:37', '::1', 1041360155, NULL),
(52, '1041360156', 'e10adc3949ba59abbe56e057f20f883e', 6, 'lananhngthi@gmail.com', '2019-03-05 11:04:22', '::1', 1041360156, NULL),
(53, '1041360157', 'e10adc3949ba59abbe56e057f20f883e', 6, 'tuanthanh@gmail.com', '2019-03-05 11:05:40', '::1', 1041360157, NULL),
(54, '1041360158', 'e10adc3949ba59abbe56e057f20f883e', 6, 'quachhiendai@gmail.com', '2019-03-05 11:06:39', '::1', 1041360158, NULL),
(55, '1041360159', 'e10adc3949ba59abbe56e057f20f883e', 6, 'nguyennhulam@gmail.com', '2019-03-05 11:07:37', '::1', 1041360159, NULL),
(56, '1041360160', 'e10adc3949ba59abbe56e057f20f883e', 6, 'giap@gmail.com', '2019-03-09 13:43:05', '::1', 1041360160, NULL),
(57, '1041360161', 'e10adc3949ba59abbe56e057f20f883e', 6, 'minhnhatdang@gmail.com', '2019-03-05 11:09:34', '::1', 1041360161, NULL),
(58, '1041360162', 'e10adc3949ba59abbe56e057f20f883e', 6, 'lannhi@gmail.com', '2019-03-05 11:10:29', '::1', 1041360162, NULL),
(59, '1000004', '14e1b600b1fd579f47433b88e8d85291', 5, 'lan@gmail.com', '2019-03-05 16:05:11', '::1', NULL, 1000004),
(60, '1000005', '14e1b600b1fd579f47433b88e8d85291', 5, 'nga@gmail.com', '2019-03-05 16:09:29', '::1', NULL, 1000005),
(61, '1000006', '14e1b600b1fd579f47433b88e8d85291', 5, 'anhvantran@gmail.com', '2019-03-05 16:11:27', '::1', NULL, 1000006),
(62, '1000007', 'e10adc3949ba59abbe56e057f20f883e', 5, 'anhvantran@gmail.com', '2019-03-05 16:29:16', '::1', NULL, 1000007),
(63, '1000008', '14e1b600b1fd579f47433b88e8d85291', 5, 'nga@gmail.com', '2019-03-05 16:15:17', '::1', NULL, 1000008);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thisinh`
--

CREATE TABLE `thisinh` (
  `ma_ts` int(10) NOT NULL,
  `ma_lp` int(11) NOT NULL,
  `ho_dem` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` datetime DEFAULT NULL,
  `gioi_tinh` int(1) NOT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(14) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thisinh`
--

INSERT INTO `thisinh` (`ma_ts`, `ma_lp`, `ho_dem`, `ten`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `dien_thoai`) VALUES
(1041360136, 3, 'thu', 'thu', '2019-02-06 00:00:00', 1, 'HM1', '0988888888'),
(1041360148, 3, 'nguyễn văn', 'thu', '2019-02-01 00:00:00', 0, 'HM', '0988888888'),
(1041360149, 3, 'nguyễn văn', 'Lan', '2019-02-02 00:00:00', 0, 'Hà Nội', '0973402997'),
(1041360150, 6, 'nguyễn văn', 'thu', '2019-02-03 00:00:00', 1, 'Hà Nội', '0973403994'),
(1041360155, 3, 'Đinh Hữu', 'Nam', '2019-02-02 00:00:00', 0, 'Hà Nội', '0988888333'),
(1041360156, 3, 'Nguyễn Thị', 'Lan Anh', '1997-01-01 00:00:00', 1, 'Hà Nội', '0973999767'),
(1041360157, 3, 'Đình Văn', 'Tuấn Thành', '1997-12-12 00:00:00', 0, 'Bắc Ninh', '0973475993'),
(1041360158, 3, 'Quách Hiện', 'Đại', '1997-02-13 00:00:00', 0, 'Hà Nam', '0973984884'),
(1041360159, 3, 'Nguyễn Như', 'Lâm', '1997-12-01 00:00:00', 0, 'Bắc Giang', '0973674997'),
(1041360160, 3, 'Võ Đình', 'Giáp', '1997-03-24 00:00:00', 0, 'Hà Nội', '0983746633'),
(1041360161, 3, 'Đăng Nhật', 'Minh', '1997-12-03 00:00:00', 0, 'Tây Nguyên', '0974984884'),
(1041360162, 3, 'Đinh Tuyết Lan', 'Nhi', '1997-11-12 00:00:00', 1, 'Hà Nội', '0973940997');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baithi`
--
ALTER TABLE `baithi`
  ADD PRIMARY KEY (`ma_bt`),
  ADD UNIQUE KEY `unique` (`unique_value`),
  ADD KEY `ma_dt` (`ma_dt`),
  ADD KEY `ma_ts` (`ma_ts`),
  ADD KEY `ma_lp` (`ma_lp`);

--
-- Chỉ mục cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD PRIMARY KEY (`ma_ch`),
  ADD KEY `ma_mh` (`ma_mh`),
  ADD KEY `id_hp` (`id_hp`);

--
-- Chỉ mục cho bảng `chucnangweb`
--
ALTER TABLE `chucnangweb`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `dethi`
--
ALTER TABLE `dethi`
  ADD PRIMARY KEY (`ma_dt`),
  ADD KEY `ma_kt` (`ma_kt`),
  ADD KEY `ma_mh` (`ma_mh`);

--
-- Chỉ mục cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`ma_gv`),
  ADD KEY `ma_mh` (`ma_mh`);

--
-- Chỉ mục cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`ma_hp`),
  ADD KEY `ma_mh` (`ma_mh`);

--
-- Chỉ mục cho bảng `kythi`
--
ALTER TABLE `kythi`
  ADD PRIMARY KEY (`id_kt`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`ma_lop`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`ma_mh`);

--
-- Chỉ mục cho bảng `nhomtaikhoan`
--
ALTER TABLE `nhomtaikhoan`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id_nhom_tk`,`id_chuc_nang`),
  ADD KEY `id_chuc_nang` (`id_chuc_nang`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `ma_gv` (`ma_gv`),
  ADD UNIQUE KEY `ma_ts` (`ma_ts`),
  ADD KEY `gid` (`gid`);

--
-- Chỉ mục cho bảng `thisinh`
--
ALTER TABLE `thisinh`
  ADD PRIMARY KEY (`ma_ts`),
  ADD KEY `ma_lp` (`ma_lp`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baithi`
--
ALTER TABLE `baithi`
  MODIFY `ma_bt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  MODIFY `ma_ch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `chucnangweb`
--
ALTER TABLE `chucnangweb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `dethi`
--
ALTER TABLE `dethi`
  MODIFY `ma_dt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `ma_gv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000009;

--
-- AUTO_INCREMENT cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `ma_hp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `kythi`
--
ALTER TABLE `kythi`
  MODIFY `id_kt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `lop`
--
ALTER TABLE `lop`
  MODIFY `ma_lop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `ma_mh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `nhomtaikhoan`
--
ALTER TABLE `nhomtaikhoan`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `thisinh`
--
ALTER TABLE `thisinh`
  MODIFY `ma_ts` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1041360163;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baithi`
--
ALTER TABLE `baithi`
  ADD CONSTRAINT `baithi_ibfk_1` FOREIGN KEY (`ma_lp`) REFERENCES `lop` (`ma_lop`),
  ADD CONSTRAINT `baithi_ibfk_2` FOREIGN KEY (`ma_ts`) REFERENCES `thisinh` (`ma_ts`),
  ADD CONSTRAINT `baithi_ibfk_4` FOREIGN KEY (`ma_dt`) REFERENCES `dethi` (`ma_dt`);

--
-- Các ràng buộc cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD CONSTRAINT `cauhoi_ibfk_1` FOREIGN KEY (`ma_mh`) REFERENCES `monhoc` (`ma_mh`),
  ADD CONSTRAINT `cauhoi_ibfk_2` FOREIGN KEY (`id_hp`) REFERENCES `hocphan` (`ma_hp`);

--
-- Các ràng buộc cho bảng `dethi`
--
ALTER TABLE `dethi`
  ADD CONSTRAINT `dethi_ibfk_2` FOREIGN KEY (`ma_mh`) REFERENCES `monhoc` (`ma_mh`),
  ADD CONSTRAINT `dethi_ibfk_3` FOREIGN KEY (`ma_kt`) REFERENCES `kythi` (`id_kt`);

--
-- Các ràng buộc cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`ma_mh`) REFERENCES `monhoc` (`ma_mh`);

--
-- Các ràng buộc cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD CONSTRAINT `hocphan_ibfk_2` FOREIGN KEY (`ma_mh`) REFERENCES `monhoc` (`ma_mh`);

--
-- Các ràng buộc cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD CONSTRAINT `quyen_ibfk_1` FOREIGN KEY (`id_nhom_tk`) REFERENCES `nhomtaikhoan` (`gid`),
  ADD CONSTRAINT `quyen_ibfk_2` FOREIGN KEY (`id_chuc_nang`) REFERENCES `chucnangweb` (`id`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_2` FOREIGN KEY (`ma_gv`) REFERENCES `giaovien` (`ma_gv`),
  ADD CONSTRAINT `taikhoan_ibfk_3` FOREIGN KEY (`ma_ts`) REFERENCES `thisinh` (`ma_ts`),
  ADD CONSTRAINT `taikhoan_ibfk_4` FOREIGN KEY (`gid`) REFERENCES `nhomtaikhoan` (`gid`);

--
-- Các ràng buộc cho bảng `thisinh`
--
ALTER TABLE `thisinh`
  ADD CONSTRAINT `thisinh_ibfk_2` FOREIGN KEY (`ma_lp`) REFERENCES `lop` (`ma_lop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
