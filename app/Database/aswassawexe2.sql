-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2020 pada 06.43
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aswassawexe2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_users-chat` varchar(500) NOT NULL,
  `id_friend-chat` varchar(500) NOT NULL,
  `chat` varchar(3000) NOT NULL,
  `chat-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_users-chat`, `id_friend-chat`, `chat`, `chat-created_at`) VALUES
(1, '1', '2', 'Halo Bro', 'Saturday, 25-07-2020, 13:59:28'),
(2, '2', '1', 'Halo juga bro', 'Saturday, 25-07-2020, 14:00:17'),
(3, '2', '1', 'Ada apaan? Kon ngechat?', 'Saturday, 25-07-2020, 14:00:36'),
(4, '1', '2', 'Santuy, cuma gabut doang', 'Saturday, 25-07-2020, 14:00:50'),
(5, '68', '1', 'Halo', 'Monday, 27-07-2020, 12:24:19'),
(6, '1', '68', 'Hai', 'Wednesday, 29-07-2020, 11:20:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chattrue`
--

CREATE TABLE `chattrue` (
  `id_chattrue` int(11) NOT NULL,
  `id_users-chattrue` varchar(500) NOT NULL,
  `id_friend-chattrue` varchar(500) NOT NULL,
  `minichat` varchar(2500) NOT NULL,
  `last` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chattrue`
--

INSERT INTO `chattrue` (`id_chattrue`, `id_users-chattrue`, `id_friend-chattrue`, `minichat`, `last`) VALUES
(2, '68', '1', 'Hai', 'Wednesday, 29-07-2020, 11:20:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_users-comment` varchar(500) NOT NULL,
  `id_status-comment` varchar(500) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `gambar_comment` varchar(200) DEFAULT NULL,
  `comment-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`id_comment`, `id_users-comment`, `id_status-comment`, `comment`, `gambar_comment`, `comment-created_at`) VALUES
(1, '1', '3', 'Mantap', NULL, 'Saturday, 25-07-2020, 14:02:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `id_users-status` varchar(500) NOT NULL,
  `slug_status` varchar(100) NOT NULL,
  `status` varchar(2000) NOT NULL,
  `gambar_status` varchar(200) DEFAULT NULL,
  `status-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `id_users-status`, `slug_status`, `status`, `gambar_status`, `status-created_at`) VALUES
(2, '1', 'status-341153831-532656088-1448853526', 'Status 2', NULL, 'Saturday, 25-07-2020, 13:50:27'),
(3, '1', 'status-1177814215-2066951740-707591286', 'Tes Status Pertama', '1595703134_954c175580fa4a8201f1.png', 'Saturday, 25-07-2020, 13:52:14'),
(5, '68', 'status-1306605153-135983888-1895195817', 'Percobaan Status 1', '1595827238_a610a3cae65b51ed2ae2.jpg', 'Monday, 27-07-2020, 12:20:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(128) NOT NULL,
  `token-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`id_token`, `email`, `token`, `token-created_at`) VALUES
(15, 'user123@usermail.com', 'UDEIgAsmr5P61s+WW/+3uWNrtTHbzTAl5tnJj2rXAm4=', '1595784673'),
(16, 'usercopy@usermail.com', '5AdcDa5aX6HuowGmmxZm1ywMndtQJYiu7mKaS5fdzW8=', '1595784696'),
(19, 'aswassaw227@gmail.coms', 'jv03C6w2tcWjBaMkY6bBxa0pARIyumuedtklo0VhUzo=', '1595996024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT 'No',
  `lastname` varchar(50) NOT NULL DEFAULT 'Name',
  `slug_users` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fotoprofil` varchar(200) NOT NULL DEFAULT 'default.png',
  `description` varchar(400) NOT NULL DEFAULT 'Tidak ada deskripsi',
  `users-created_at` varchar(50) DEFAULT 'Tidak Diketahui',
  `users-updated_at` varchar(50) NOT NULL DEFAULT 'Tidak Diketahui',
  `level` int(11) NOT NULL DEFAULT 3,
  `is_active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `firstname`, `lastname`, `slug_users`, `email`, `password`, `fotoprofil`, `description`, `users-created_at`, `users-updated_at`, `level`, `is_active`) VALUES
(1, 'userPercobaan227', 'No', 'Name', 'userpercobaan227', 'usercoba227@gmail.com', '$2y$10$KtKIwrF/TsU32QfY3dSOuuFfE6oFa67O7NXUiw7l2uge3j7GK2SxS', '1595702983_bff1c1b92c30bae76097.png', 'Tidak ada deskripsi', 'Saturday, 25-07-2020, 12:37:36', 'Tidak Diketahui', 1, 1),
(19, 'User111', 'No', 'Name', 'user111', 'user111@usermail.com', '$2y$10$R9KpOzcYa4lX6ruOxDduV.UiNrNkY.JXpEiG4AEwQUs.BmhYxA2dW', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:23:56', 'Tidak Diketahui', 3, 1),
(20, 'User222', 'No', 'Name', 'user222', 'user222@usermail.com', '$2y$10$N8iF56H6uAXMxypbv4bs8uurCUIj7GmNTxh2IYqP01MOX37VM48m2', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:24:20', 'Tidak Diketahui', 3, 0),
(21, 'User333', 'No', 'Name', 'user333', 'user333@usermail.com', '$2y$10$W.AajI6VB7FWayFYz66Rh.x2zw3DZgZyAVfdCmM5JjOMZErIoyHNS', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:25:04', 'Tidak Diketahui', 3, 0),
(22, 'User444', 'No', 'Name', 'user444', 'user444@usermail.com', '$2y$10$6eqFghXXojFr4vzZIQeT0emq5Kl5P7MKIO0qtiTctFYUyKpH9RDQS', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:25:24', 'Tidak Diketahui', 3, 0),
(23, 'User555', 'No', 'Name', 'user555', 'user555@usermail.com', '$2y$10$Jigr4txlk41oqRNUll8S3ei91klg5ES/EDuOFKTKnLcZrKDWVOxMi', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:25:45', 'Tidak Diketahui', 3, 0),
(24, 'User666', 'No', 'Name', 'user666', 'user666@usermail.com', '$2y$10$xF6LJEnMBdJQGeofOxhdPu1BLHQBrDA47zKyD1lzS7ywsP5Zc9.A6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:26:08', 'Tidak Diketahui', 3, 0),
(25, 'User777', 'No', 'Name', 'user777', 'user777@usermail.com', '$2y$10$eOKYF9IRxSESyUMELwf1sO7qN/HQkOeHXb510c77kpqSmxgCw6/9K', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:26:33', 'Tidak Diketahui', 3, 0),
(26, 'User888', 'No', 'Name', 'user888', 'user888@usermail.com', '$2y$10$eWfO1lewnt7Y/SB89Y3VZOU6W1Z.jbgBRNeL.4i4X0AQFRuAecKAK', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:26:59', 'Tidak Diketahui', 3, 0),
(27, 'User999', 'No', 'Name', 'user999', 'user999@usermail.com', '$2y$10$tP8IyGkm8rT.HnwJKE4CF.Adme92TesksjHD.6iA1VRp2MxAKK2ne', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:27:23', 'Tidak Diketahui', 3, 0),
(28, 'User123', 'No', 'Name', 'user123', 'user123@usermail.com', '$2y$10$g9HVSBhseuj/VAmZ2vxjZ.NuO/5QJJ9rHqTePustq2DR95QDDAf.q', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:12', 'Tidak Diketahui', 3, 0),
(29, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(30, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(31, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(32, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(33, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(34, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(35, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(36, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(37, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(38, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(39, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(40, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(41, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(42, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(43, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(44, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(45, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(46, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(47, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(48, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(49, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(50, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(51, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(52, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(53, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(54, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(55, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(56, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(57, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(58, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(59, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(60, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(61, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(62, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(63, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(64, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(65, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(66, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(67, 'UserCopy', 'No', 'Name', 'usercopy', 'usercopy@usermail.com', '$2y$10$KWHBVmxD3iA/Q6Av524ZoeJ2DiG9lWhTfG8ULbrfpkEWjpSwYJ0m6', 'default.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 00:31:36', 'Tidak Diketahui', 3, 0),
(68, 'Aswassaw227', 'Andry', 'Pebrianto', 'aswassaw227', 'aswassaw227@gmail.com', '$2y$10$jdHm7aOq2zyBXCPEwpjNt.T7c2Hycv/bOtD4ArcNnT60.BhG4nUZO', '1595827130_08b2ca45b49db1e2ab41.png', 'Tidak ada deskripsi', 'Monday, 27-07-2020, 12:16:24', 'Monday, 27-07-2020, 12:19:39', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indeks untuk tabel `chattrue`
--
ALTER TABLE `chattrue`
  ADD PRIMARY KEY (`id_chattrue`);

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `chattrue`
--
ALTER TABLE `chattrue`
  MODIFY `id_chattrue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
