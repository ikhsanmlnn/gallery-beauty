-- DATABASE: galeri_4ia07
-- Project: CRUD Galeri Gambar - Sistem Multimedia
-- Kelompok 4IA07 - Universitas Gunadarma

CREATE DATABASE IF NOT EXISTS `galeri_4ia07` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `galeri_4ia07`;

-- Tabel: gambar
CREATE TABLE IF NOT EXISTS `gambar` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul`       VARCHAR(150)     NOT NULL,
  `deskripsi`   TEXT,
  `kategori`    VARCHAR(60)      DEFAULT 'Umum',
  `filename`    VARCHAR(255)     NOT NULL,
  `warna`       VARCHAR(7)       DEFAULT '#6C63FF',
  `created_at`  DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel: anggota (untuk halaman anggota kelompok)
CREATE TABLE IF NOT EXISTS `anggota` (
  `id`    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama`  VARCHAR(100)     NOT NULL,
  `npm`   VARCHAR(20)      NOT NULL,
  `peran` VARCHAR(60)      DEFAULT 'Anggota',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Anggota Kelompok (ganti sesuai kelompok Anda)
INSERT INTO `anggota` (`nama`, `npm`, `peran`) VALUES
('Ikhsan Maulana',       '50422696', 'Programmer'),
('Galih Sapta Apriliyanto',   '50421032', 'Programmer'),
('Attilla Ghozali',      '50421056', 'Manual Book');

-- Sample Image Data
INSERT INTO `gambar` (`judul`, `deskripsi`, `kategori`, `filename`, `warna`) VALUES
('The Mysterious Man', 'A man who walked at the Subway Corridor',  'General', 'Sample 1.jpg', '#FF6B6B'),
('Jasmine', 'A beautiful jasmine inside a pot.', 'Nature', 'Sample 2.jpg', '#4ECDC4'),
('Old Car', 'An old country road car',  'Art',   'Sample 3.jpg', '#45B7D1'),
('Beautiful Way', 'A beautiful driveway cross the sea',  'Architecture',   'Sample 4.jpg', '#45B7D1');