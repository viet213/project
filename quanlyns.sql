-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 18, 2024 lúc 04:17 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyns`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhanvien`
--

CREATE TABLE `tbl_nhanvien` (
  `MaNV` varchar(13) NOT NULL,
  `HoTen` varchar(100) DEFAULT NULL,
  `GioiTinh` varchar(10) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `MaPB` int(11) DEFAULT NULL,
  `anh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`MaNV`, `HoTen`, `GioiTinh`, `NgaySinh`, `DiaChi`, `sdt`, `email`, `MaPB`, `anh`) VALUES
('NV001', 'Phạm Thị Lan', 'Nữ', '2003-11-30', 'sài gòn', '0991256237', 'lanne@gmail.com', 102, 'lan.png'),
('NV002', 'Nguyễn Trọng Hiếu', 'Nam', '2001-12-11', 'ha noi', '093734621', 'hieu@gmail.com', 101, 'hieu.png'),
('NV003', 'Lê Quang Minh', 'Nam', '2005-12-01', 'ha noi', '0393425617', 'quanhminh@gmail.com', 101, 'minh.png'),
('NV004', 'Vũ Đức Nam', 'Nam', '2000-03-12', 'ha noi', '0983627313', 'nam@gmail.com', 102, 'nam.png'),
('NV005', 'Phạm Phương Thảo', 'Nam', '2023-11-29', 'Hà nam', '036846527', 'Thaopp@gmail.com', 102, 'thao.png'),
('NV006', 'Vũ Hông Mai', 'Nữ', '2003-01-06', 'hưng yên', '0394132343', 'maine@gmail.com', 102, 'mai.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_phongban`
--

CREATE TABLE `tbl_phongban` (
  `MaPB` int(11) NOT NULL,
  `TenPB` varchar(100) DEFAULT NULL,
  `sdtPB` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_phongban`
--

INSERT INTO `tbl_phongban` (`MaPB`, `TenPB`, `sdtPB`) VALUES
(101, 'phòng kĩ thuật', '18001005'),
(102, 'phòng maketing', '18001006');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`UserID`, `Username`, `Password`, `Role`) VALUES
(1, 'admin', '124', 'admin'),
(2, 'user1', '1234', 'user'),
(3, 'user2', '12345678', 'user'),
(5, 'viet', '123', 'admin'),
(6, 'han', '123', 'user'),
(7, 'mai', '124', 'user'),
(9, 'vanviet', '123', 'user'),
(10, 'vanviet', '123', 'user'),
(11, 'vanviet', '123', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD KEY `MaPB` (`MaPB`);

--
-- Chỉ mục cho bảng `tbl_phongban`
--
ALTER TABLE `tbl_phongban`
  ADD PRIMARY KEY (`MaPB`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD CONSTRAINT `tbl_nhanvien_ibfk_1` FOREIGN KEY (`MaPB`) REFERENCES `tbl_phongban` (`MaPB`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
