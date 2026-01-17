-- Database: pkaltim_kuliner
-- Website Artikel Wisata Kuliner Kalimantan Timur
-- Created for phpMyAdmin import

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Database: `pkaltim_kuliner`
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `pkaltim_kuliner` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `pkaltim_kuliner`;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `articles`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `is_published` tinyint(1) DEFAULT 1,
  `views` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `article_images`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `article_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(200) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `article_images_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Dumping data for table `users`
-- --------------------------------------------------------

INSERT INTO `users` (`id`, `username`, `email`, `hashed_password`, `is_active`, `created_at`) VALUES
(1, 'admin', 'admin@pkaltim.local', '$2b$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5GyYq5q5q5q5q', 1, NOW());

-- Note: Password default adalah 'admin123' (harus diubah setelah import!)
-- Untuk generate password hash baru, gunakan bcrypt dengan cost 12

-- --------------------------------------------------------
-- Dumping data for table `categories`
-- --------------------------------------------------------

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Makanan Tradisional', 'Kuliner tradisional khas Kalimantan Timur yang diwariskan turun temurun', NOW()),
(2, 'Makanan Modern', 'Kuliner modern dengan sentuhan lokal Kaltim', NOW()),
(3, 'Minuman Khas', 'Minuman tradisional dan modern khas Kalimantan Timur', NOW()),
(4, 'Kue & Jajanan', 'Kue tradisional dan jajanan khas Kaltim', NOW()),
(5, 'Seafood', 'Hidangan laut segar khas pesisir Kalimantan Timur', NOW());

-- --------------------------------------------------------
-- Dumping data for table `articles`
-- --------------------------------------------------------

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `excerpt`, `category_id`, `author_id`, `is_published`, `views`, `created_at`) VALUES
(1, 'Jahung Berau: Kuliner Ikonik Khas Berau', 'jahung-berau-kuliner-ikonik-khas-berau', 
'<p>Jahung Berau adalah salah satu kuliner khas yang menjadi ikon Kabupaten Berau, Kalimantan Timur. Makanan tradisional ini terbuat dari beras ketan yang dimasak dengan cara khusus dan disajikan dengan berbagai lauk pauk.</p><p>Jahung memiliki tekstur yang kenyal dan rasa yang gurih. Biasanya disajikan dengan ikan asin, sambal, dan sayuran. Makanan ini menjadi favorit masyarakat Berau dan sering disajikan dalam acara-acara adat maupun perayaan.</p><p>Untuk membuat Jahung, beras ketan direndam semalaman, kemudian dikukus hingga matang. Proses pembuatannya membutuhkan keahlian khusus agar tekstur Jahung menjadi sempurna.</p>', 
'Jahung Berau adalah kuliner tradisional khas Kabupaten Berau yang terbuat dari beras ketan dengan cita rasa yang khas.', 
1, 1, 1, 0, NOW()),

(2, 'Patin Bakar Balikpapan: Kelezatan Ikan Patin yang Legendaris', 'patin-bakar-balikpapan-kelezatan-ikan-patin-yang-legendaris',
'<p>Patin Bakar Balikpapan merupakan salah satu kuliner ikonik yang wajib dicoba saat berkunjung ke Balikpapan. Ikan patin segar dibakar dengan bumbu khas yang membuatnya memiliki cita rasa yang luar biasa.</p><p>Ikan patin yang digunakan biasanya masih segar, langsung dari sungai atau tambak. Proses pembakarannya menggunakan arang kayu untuk memberikan aroma smokey yang khas. Bumbu yang digunakan terdiri dari bawang putih, jahe, kunyit, dan rempah-rempah lainnya yang diracik khusus.</p><p>Patin Bakar biasanya disajikan dengan nasi putih hangat, sambal terasi, dan lalapan segar. Kombinasi rasa gurih, pedas, dan segar membuat kuliner ini sangat digemari oleh wisatawan maupun masyarakat lokal.</p>',
'Patin Bakar Balikpapan adalah kuliner ikonik dengan ikan patin segar yang dibakar dengan bumbu khas, wajib dicoba saat berkunjung ke Balikpapan.',
2, 1, 1, 0, NOW()),

(3, 'Amplang: Kerupuk Ikan Khas Tenggarong', 'amplang-kerupuk-ikan-khas-tenggarong',
'<p>Amplang adalah kerupuk ikan khas yang berasal dari Tenggarong, Kutai Kartanegara. Kerupuk ini terbuat dari ikan tenggiri atau ikan gabus yang dihaluskan, dicampur dengan tepung, dan kemudian digoreng hingga renyah.</p><p>Proses pembuatan Amplang membutuhkan keahlian khusus. Ikan yang sudah dihaluskan dicampur dengan bumbu-bumbu seperti garam, gula, dan bawang putih. Adonan kemudian dibentuk menjadi bulatan kecil atau bentuk lainnya, lalu dikeringkan sebelum digoreng.</p><p>Amplang memiliki tekstur yang sangat renyah dan rasa yang gurih. Kerupuk ini menjadi oleh-oleh favorit wisatawan yang berkunjung ke Tenggarong. Amplang juga sering disajikan sebagai camilan pendamping kopi atau teh.</p>',
'Amplang adalah kerupuk ikan khas Tenggarong yang terbuat dari ikan tenggiri, memiliki tekstur renyah dan rasa gurih yang khas.',
4, 1, 1, 0, NOW()),

(4, 'Es Kacang Merah Samarinda: Minuman Segar Khas Kalimantan', 'es-kacang-merah-samarinda-minuman-segar-khas-kalimantan',
'<p>Es Kacang Merah adalah minuman khas Samarinda yang sangat populer, terutama di musim panas. Minuman ini terbuat dari kacang merah yang direbus hingga empuk, kemudian disajikan dengan es serut, santan, dan gula merah cair.</p><p>Kacang merah yang digunakan harus direbus hingga benar-benar empuk namun tidak hancur. Santan yang digunakan biasanya santan segar yang memberikan rasa gurih yang khas. Gula merah cair memberikan rasa manis yang alami dan tidak terlalu manis.</p><p>Es Kacang Merah biasanya disajikan dalam gelas besar dengan es serut yang banyak. Minuman ini sangat menyegarkan dan cocok dinikmati di siang hari yang terik. Banyak warung dan kedai di Samarinda yang menjual minuman khas ini.</p>',
'Es Kacang Merah adalah minuman segar khas Samarinda yang terbuat dari kacang merah, santan, dan gula merah, sangat cocok dinikmati di siang hari.',
3, 1, 1, 0, NOW()),

(5, 'Kepiting Soka Bontang: Seafood Lezat dari Pesisir Kaltim', 'kepiting-soka-bontang-seafood-lezat-dari-pesisir-kaltim',
'<p>Kepiting Soka Bontang adalah salah satu kuliner seafood yang sangat populer di Bontang. Kepiting soka adalah kepiting yang masih muda dengan cangkang yang lunak, sehingga bisa dimakan seluruhnya termasuk cangkangnya.</p><p>Kepiting soka biasanya dimasak dengan berbagai cara, seperti digoreng tepung, dibakar, atau ditumis dengan bumbu pedas. Rasa daging kepiting yang manis dan tekstur cangkang yang renyah membuat kuliner ini sangat digemari.</p><p>Bontang sebagai kota pesisir memiliki akses yang mudah terhadap seafood segar. Kepiting soka biasanya ditangkap langsung dari laut dan diolah dengan cepat untuk menjaga kesegarannya. Kuliner ini menjadi salah satu daya tarik wisata kuliner di Bontang.</p>',
'Kepiting Soka Bontang adalah kuliner seafood dengan kepiting muda yang cangkangnya lunak, bisa dimakan seluruhnya dengan berbagai cara masak.',
5, 1, 1, 0, NOW());

COMMIT;
