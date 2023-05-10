-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 May 2023, 22:58:56
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `profilestop`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `about_name` varchar(255) NOT NULL,
  `about_title` text NOT NULL,
  `about_desc` text NOT NULL,
  `about_photo` varchar(255) NOT NULL,
  `about_age` varchar(100) NOT NULL,
  `about_free` varchar(255) NOT NULL,
  `about_email` varchar(255) NOT NULL,
  `about_address` varchar(255) NOT NULL,
  `about_lang` varchar(255) NOT NULL,
  `about_exp` varchar(255) NOT NULL,
  `about_skill` varchar(255) NOT NULL,
  `about_exp_yrs` varchar(255) NOT NULL,
  `about_project` varchar(255) NOT NULL,
  `about_awards` varchar(255) NOT NULL,
  `about_happy` varchar(100) NOT NULL,
  `about_button` varchar(255) NOT NULL,
  `about_hire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `about`
--

INSERT INTO `about` (`about_id`, `about_name`, `about_title`, `about_desc`, `about_photo`, `about_age`, `about_free`, `about_email`, `about_address`, `about_lang`, `about_exp`, `about_skill`, `about_exp_yrs`, `about_project`, `about_awards`, `about_happy`, `about_button`, `about_hire`) VALUES
(1, 'İlker Şahin Koç', 'Front-End Developer', 'Merhaba Ben İlker Şahin Koç 17 Yaşındayım VE İstanbul Doğumluyum.', 'about-file-1683548821.jpg', '17', 'Çalışmıyor', 'ilkersahinkoc05@gmail.com', 'İstanbul', 'Türkçe, İngilizce', '2', 'Full Stack Developer', '4', '790', '10', '720', 'No Link', '05454178681');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` text NOT NULL,
  `blog_desc` text NOT NULL,
  `blog_photo` varchar(100) NOT NULL,
  `blog_status` int(11) NOT NULL,
  `blog_date_created` datetime NOT NULL,
  `blog_date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_desc`, `blog_photo`, `blog_status`, `blog_date_created`, `blog_date_updated`) VALUES
(3, 'kgjjhgkjgj', 'tyjyjyjj', 'default.png', 1, '2022-04-05 23:33:16', '0000-00-00 00:00:00'),
(4, 'eyeuryjtyj', 'jjjkukkkuuytuyrtr5yutuuiuiuiui', 'default.png', 1, '2022-04-05 23:35:55', '0000-00-00 00:00:00'),
(5, 'ryuyjyjyjj', 'jjujukjkjj', 'default.png', 1, '2022-04-05 23:53:12', '0000-00-00 00:00:00'),
(6, 'bibi', 'hhhthththth', 'default.png', 1, '2022-04-05 23:53:24', '0000-00-00 00:00:00'),
(7, 'fdggdggh', 'hhhhhhht', 'blog-photo-1649186558.png', 1, '2022-04-06 00:22:38', '0000-00-00 00:00:00'),
(8, 'bgdhghghdthghgh', 'Introduction​In this tutorial, we will have a look at a few important tasks to perform in the server for initial set up of the server and basic server hardening. These steps will increase the security of your server as well as usability. We will perform a series of tasks such as creating a new sudo user, updating packages, setting timezone and securing SSH server, etc.&amp;nbsp;Prerequisites​Cloud VPS with CentOS 7 installed.Step 1: Log in via SSH​When your server is created TanzaHost sends you an email with the default username, password, and server IP address. For first time login, you need to use those credentials to log in to your server.&amp;nbsp;Step 2: Change Logged in User Password​Upon the first login, it is very important to change the password of the current user. Use the following command for the same.passwdIt will ask you to provide your existing password unless you are logged in as the root user.&amp;nbsp;Step 3: Create a New Sudo User​If you are logged in as root user, it is recommended to create a sudo user. If you are logged in as sudo user with username in format client_xxxxxx_x, which TanzaHost already created for you, it is still a best practice to create a new sudo user.A Sudo user is a user having superuser privileges. In simple terms, this user can perform administrative commands and tasks as the root user.', 'blog-photo-1649186620.jpeg', 1, '2022-04-06 00:23:40', '0000-00-00 00:00:00'),
(9, 'cbfghhf', 'jfjjjjyj', 'default.png', 1, '2022-04-06 00:23:52', '0000-00-00 00:00:00'),
(10, 'jkkukryyyertretrtt', 'ettrtehythryjyrjyjy', 'default.png', 1, '2022-04-06 00:24:02', '0000-00-00 00:00:00'),
(12, 'tttttttttttttttttttttt', 'wertyuisadfg', 'default.png', 0, '2022-04-06 00:24:26', '0000-00-00 00:00:00'),
(54, 'Initial Server Setup with CentOS 7', 'Introduction​In this tutorial, we will have a look at a few important tasks to perform in the server for initial set up of the server and basic server hardening.', 'default.png', 1, '2022-04-05 23:26:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_info` text NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `contact_fb` varchar(255) NOT NULL,
  `contact_tw` varchar(255) NOT NULL,
  `contact_insta` varchar(255) NOT NULL,
  `contact_wts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_info`, `contact_email`, `contact_phone`, `contact_address`, `contact_fb`, `contact_tw`, `contact_insta`, `contact_wts`) VALUES
(1, 'Sosyal Medya Hesaplarım', 'admin@admin.com', '05454178681', 'İstanbul', 'İlker Şahin Koç', 'İlker Şahin Koç', 'İlker Şahin Koç', '5454178681'),
(3, '', '', '', '', '', '', '', ''),
(4, '', '', '7878788', 'hghghgh', 'fghfhfghh', 'ghghhdg', 'ghghhghgf', 'hfhfgghg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `education`
--

CREATE TABLE `education` (
  `education_id` int(11) NOT NULL,
  `education_year` varchar(255) NOT NULL,
  `education_title` varchar(255) NOT NULL,
  `education_desc` text NOT NULL,
  `education_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages_views`
--

CREATE TABLE `pages_views` (
  `id` int(11) NOT NULL,
  `total_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `page_views`
--

CREATE TABLE `page_views` (
  `page_id` int(11) NOT NULL,
  `visitor_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portifolio`
--

CREATE TABLE `portifolio` (
  `portifolio_id` int(11) NOT NULL,
  `portifolio_title` varchar(255) NOT NULL,
  `portifolio_desc` text NOT NULL,
  `portifolio_photo` varchar(100) NOT NULL,
  `portifolio_status` int(11) NOT NULL,
  `p_created` datetime NOT NULL,
  `p_updated` datetime NOT NULL,
  `portifolio_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `services_title` text NOT NULL,
  `services_desc` text NOT NULL,
  `services_photo` varchar(100) NOT NULL,
  `services_status` int(11) NOT NULL,
  `services_date_created` datetime NOT NULL,
  `services_date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `services`
--

INSERT INTO `services` (`services_id`, `services_title`, `services_desc`, `services_photo`, `services_status`, `services_date_created`, `services_date_updated`) VALUES
(2, 'Masaka Frances', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Distinctio, Praesentium.', 'user.png', 1, '2022-04-05 11:12:25', '0000-00-00 00:00:00'),
(7, 'App Development', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Distinctio, Praesentium.', 'default.png', 1, '2022-04-06 06:50:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_settings`
--

CREATE TABLE `site_settings` (
  `settings_id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `site_description` text NOT NULL,
  `site_logo` varchar(100) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `email_from_title` varchar(255) NOT NULL,
  `seo_meta_title` varchar(100) NOT NULL,
  `seo_meta_tags` varchar(100) NOT NULL,
  `seo_meta_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `site_settings`
--

INSERT INTO `site_settings` (`settings_id`, `site_name`, `site_description`, `site_logo`, `email_from`, `email_from_title`, `seo_meta_title`, `seo_meta_tags`, `seo_meta_description`) VALUES
(1, 'ProfilesTop', 'CV Sitesi', 'logo-file-1683496653.png', 'support@tanzahost.com', 'TanzaMe', 'tanzame', 'tanzame,tanzahost,tanzaweb,portfolio,personal,codecanyon,', 'tanzame');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `user_status` int(11) NOT NULL,
  `reg_token` varchar(255) NOT NULL,
  `token_time` varchar(255) NOT NULL,
  `user_date_created` datetime NOT NULL,
  `user_date_updated` datetime NOT NULL,
  `user_last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `email`, `user_name`, `user_password`, `user_photo`, `user_status`, `reg_token`, `token_time`, `user_date_created`, `user_date_updated`, `user_last_login`) VALUES
(1, '?lker', 'admin@admin.com', 'admin', '$2y$10$ooPSSBX46J/pGHvEZBnGL.i5JPnOM9dRgYOrvR5984.y2TkPs9kXW', 'admin-photo-1683497714.png', 1, '8c2ca882e50bf439f11a9749a86c6caa', '1649078730', '2022-04-04 18:25:30', '2023-05-08 10:59:02', '2023-05-09 22:08:46');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Tablo için indeksler `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Tablo için indeksler `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Tablo için indeksler `portifolio`
--
ALTER TABLE `portifolio`
  ADD PRIMARY KEY (`portifolio_id`);

--
-- Tablo için indeksler `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- Tablo için indeksler `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `portifolio`
--
ALTER TABLE `portifolio`
  MODIFY `portifolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
