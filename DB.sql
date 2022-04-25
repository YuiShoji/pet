-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022-04-25 16:34:58
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `pet`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT 'カテゴリ名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'Snack'),
(3, 'Bed/Blanket'),
(4, 'Toy'),
(5, 'Care Goods'),
(6, 'Cleaning Goods'),
(7, 'Other');

-- --------------------------------------------------------

--
-- テーブルの構造 `dogs`
--

CREATE TABLE `dogs` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '犬種'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `dogs`
--

INSERT INTO `dogs` (`id`, `name`) VALUES
(1, 'ミニチュアダックスフンド'),
(2, 'ポメラニアン'),
(3, '柴犬'),
(4, 'チワワ'),
(5, 'ミニチュアシュナウザー'),
(6, 'マルチーズ'),
(7, 'ゴールデンレトリバー'),
(8, 'ラブラドール'),
(9, 'ヨークシャテリア'),
(10, 'トイプードル'),
(11, 'その他小型犬'),
(12, 'その他中型犬'),
(13, 'その他大型犬'),
(14, 'ミックス');

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `other` varchar(250) DEFAULT NULL,
  `del_flg` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`id`, `name`, `category_id`, `price`, `other`, `del_flg`, `updated_at`, `created_at`) VALUES
(1, '皮膚にやさしいシャンプー', 5, 1500, '内容量：500ml', 0, '2022-04-25 05:28:50', '2022-04-20 04:32:25'),
(3, '早食い防止食器', 7, 1080, '素材：プラスチック', 0, '2022-04-20 05:15:44', '2022-04-20 05:15:44'),
(4, '伸びるリード', 7, 1500, '伸縮自在なリードです。', 0, '2022-04-20 05:31:26', '2022-04-20 05:31:26'),
(5, 'チューイングボーン', 2, 888, '内容量：15本入り\r\n小型犬におすすめのサイズ', 0, '2022-04-21 01:31:11', '2022-04-20 05:32:39'),
(8, 'ペットのトイレ用 除菌消臭スプレー', 5, 398, '床などにこぼしてしまったときも簡単にお掃除ができて気持ちがいいです。値段も手ごろなので使いやすいです。', 0, '2022-04-21 01:33:45', '2022-04-21 01:33:45'),
(9, 'おいしいほしいも', 1, 1500, NULL, 1, '2022-04-25 05:31:01', '2022-04-21 01:41:06'),
(17, '低カロリーフード', 1, 2900, '小型犬向け\r\n内容量：2kg', 0, '2022-04-25 05:30:51', '2022-04-21 05:00:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('yuiyuiwanwan1@gmail.com', '$2y$10$oH/MzBTX/fZT4g/JaaWKWOq0oK4oiW8FFUVStkU/bLu.YHTu4H1ZO', '2022-04-10 22:29:39'),
('shoji@argo-aichi.com', '$2y$10$I4jnTu/Nh1scZg/OHFKIFebBAdf9Pz2CzpoeFQMttKNhtOOJuF.ea', '2022-04-10 23:15:05'),
('test0412@test.jp', '$2y$10$8D.r4kfv9dFCZ8JIfd7SgeFbP.Kvz8kRG3gTb9Zptwx8MVEMcG0X6', '2022-04-11 16:18:29'),
('test2022@gmail.com', '$2y$10$nQ7bunRgPh6pOf4oFblLTe8QFIqqeqrx57OfHjlTN3De8nPJ5sE1q', '2022-04-17 17:09:24'),
('test1@test.jp', '$2y$10$dE1QWzcIonEIUeECD8DBR.tauCt0H9fGAnZ1vw1aIP6RX1LDMvLYy', '2022-04-17 17:23:25'),
('yuiyuiwanwan@gmail.com', '$2y$10$L/x.U.66mqyTsWmcRDnqPOzHHufdw7biOHdJCN.zCNqlm3ldvb7zG', '2022-04-18 17:20:14');

-- --------------------------------------------------------

--
-- テーブルの構造 `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `star` varchar(11) NOT NULL,
  `review` varchar(250) NOT NULL,
  `del_flg` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `dog_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `owner` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `del_flg` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `dog_id`, `created_at`, `updated_at`, `owner`, `remember_token`, `del_flg`) VALUES
(1, '管理者', 'kanri@test.jp', '$2y$10$6koh89tdAOCDyscV2r5yjOdEXJ2IQ.0eagydrl3mkEuJkJeg6tg2C', NULL, 3, '2022-04-25 05:33:57', '2022-04-25 05:33:57', 1, NULL, 0),
(2, 'testuser', 'testuser@test.jp', '$2y$10$9X6sxZphoLLRXL.y26DCfuSfQhRHpJOWx7bi33iy2uwsDBTshZh3K', NULL, 10, '2022-04-25 06:29:36', '2022-04-25 06:29:36', 0, NULL, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dog_id` (`dog_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `dogs`
--
ALTER TABLE `dogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- テーブルの制約 `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dog_id`) REFERENCES `dogs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
