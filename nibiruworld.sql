-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Jun 2021 pada 02.32
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nibiruworld`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_users-chat` int(11) NOT NULL,
  `id_friend-chat` int(11) NOT NULL,
  `chat` varchar(3000) NOT NULL,
  `chat-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chattrue`
--

CREATE TABLE `chattrue` (
  `id_chattrue` int(11) NOT NULL,
  `id_users-chattrue` int(11) NOT NULL,
  `id_friend-chattrue` int(11) NOT NULL,
  `id_last-chattrue` int(11) NOT NULL,
  `minichat` varchar(2500) NOT NULL,
  `status_chattrue` int(1) NOT NULL DEFAULT 0,
  `last` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_users-comment` int(11) NOT NULL,
  `id_status-comment` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `gambar_comment` varchar(200) DEFAULT NULL,
  `comment-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `friend`
--

CREATE TABLE `friend` (
  `id_friend` int(11) NOT NULL,
  `id_users-friend` int(11) NOT NULL,
  `id_friend-friend` int(11) NOT NULL,
  `friend-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `friendreq`
--

CREATE TABLE `friendreq` (
  `id_friendreq` int(11) NOT NULL,
  `id_users-friendreq` int(11) NOT NULL,
  `id_friend-friendreq` int(11) NOT NULL,
  `friendreq-created_at` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likecomment`
--

CREATE TABLE `likecomment` (
  `id_likecomment` int(11) NOT NULL,
  `id_users-likecomment` int(11) NOT NULL,
  `id_status-likecomment` int(11) NOT NULL,
  `id_comment-likecomment` int(11) NOT NULL,
  `likecomment-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likereply`
--

CREATE TABLE `likereply` (
  `id_likereply` int(11) NOT NULL,
  `id_users-likereply` int(11) NOT NULL,
  `id_status-likereply` int(11) NOT NULL,
  `id_comment-likereply` int(11) NOT NULL,
  `id_reply-likereply` int(11) NOT NULL,
  `likereply-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likestatus`
--

CREATE TABLE `likestatus` (
  `id_likestatus` int(11) NOT NULL,
  `id_users-likestatus` int(11) NOT NULL,
  `id_status-likestatus` int(11) NOT NULL,
  `likestatus-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `motor`
--

CREATE TABLE `motor` (
  `id_user-motor` int(11) NOT NULL,
  `manusia-asw+bro` varchar(456) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL,
  `id_users-notification` int(11) NOT NULL,
  `notification` varchar(1000) NOT NULL,
  `routes_notification` varchar(100) NOT NULL,
  `key_notification` int(11) NOT NULL,
  `status_notification` int(1) NOT NULL DEFAULT 0,
  `notification-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reply`
--

CREATE TABLE `reply` (
  `id_reply` int(11) NOT NULL,
  `id_users-reply` int(11) NOT NULL,
  `id_status-reply` int(11) NOT NULL,
  `id_comment-reply` int(11) NOT NULL,
  `reply` varchar(1000) NOT NULL,
  `gambar_reply` varchar(200) DEFAULT NULL,
  `reply-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `id_users-status` int(11) NOT NULL,
  `slug_status` varchar(100) NOT NULL,
  `status` varchar(2000) NOT NULL,
  `gambar_status` varchar(200) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `status-created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'aswassaw227@gmail.com', 'iwXLg1mBHLLCqtAQ5DfxLpfF+KW3TeKJNYSwUfiguKU=', '1623889445');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT 'New',
  `lastname` varchar(50) NOT NULL DEFAULT 'User',
  `slug_users` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fotoprofil` varchar(200) NOT NULL DEFAULT 'default.png',
  `description` varchar(400) NOT NULL DEFAULT 'Tidak ada deskripsi',
  `users-created_at` varchar(50) DEFAULT 'Tidak Diketahui',
  `users-updated_at` varchar(50) NOT NULL DEFAULT 'Tidak Diketahui',
  `level` int(1) NOT NULL DEFAULT 3,
  `is_active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `firstname`, `lastname`, `slug_users`, `email`, `password`, `fotoprofil`, `description`, `users-created_at`, `users-updated_at`, `level`, `is_active`) VALUES
(1, 'superadmin', 'New', 'User', 'superadmin', 'superadmin@gmail.com', '$2y$10$WqjsX5L/eC0VQ7o00/cbSOVr4ncaV9M/1/m1znwsSkfdfACq8CSoe', 'default.png', 'Tidak ada deskripsi', 'Thursday, 17-06-2121, 07:18:55', 'Thursday, 17-06-2121, 07:25:08', 1, 1),
(2, 'admin', 'New', 'User', 'admin', 'admin@gmail.com', '$2y$10$RuzDoBFfBN1wuAb1yTFMX.mMUuteyNkje5LlAsdYYogKUPfVT2EKS', 'default.png', 'Tidak ada deskripsi', 'Thursday, 17-06-2121, 07:20:45', 'Tidak Diketahui', 2, 1),
(3, 'user', 'New', 'User', 'user', 'user@gmail.com', '$2y$10$4V.ZJN8qhAkh2JKOwtXutO8bamMPFc4U7HyuTxSpa83DpIrSMzL22', 'default.png', 'Tidak ada deskripsi', 'Thursday, 17-06-2121, 07:24:05', 'Tidak Diketahui', 3, 1);

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
-- Indeks untuk tabel `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id_friend`);

--
-- Indeks untuk tabel `friendreq`
--
ALTER TABLE `friendreq`
  ADD PRIMARY KEY (`id_friendreq`);

--
-- Indeks untuk tabel `likecomment`
--
ALTER TABLE `likecomment`
  ADD PRIMARY KEY (`id_likecomment`);

--
-- Indeks untuk tabel `likereply`
--
ALTER TABLE `likereply`
  ADD PRIMARY KEY (`id_likereply`);

--
-- Indeks untuk tabel `likestatus`
--
ALTER TABLE `likestatus`
  ADD PRIMARY KEY (`id_likestatus`);

--
-- Indeks untuk tabel `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id_user-motor`);

--
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`);

--
-- Indeks untuk tabel `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id_reply`);

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
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `chattrue`
--
ALTER TABLE `chattrue`
  MODIFY `id_chattrue` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `friend`
--
ALTER TABLE `friend`
  MODIFY `id_friend` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `friendreq`
--
ALTER TABLE `friendreq`
  MODIFY `id_friendreq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likecomment`
--
ALTER TABLE `likecomment`
  MODIFY `id_likecomment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likereply`
--
ALTER TABLE `likereply`
  MODIFY `id_likereply` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likestatus`
--
ALTER TABLE `likestatus`
  MODIFY `id_likestatus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `motor`
--
ALTER TABLE `motor`
  MODIFY `id_user-motor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reply`
--
ALTER TABLE `reply`
  MODIFY `id_reply` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
