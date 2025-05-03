CREATE DATABASE IF NOT EXISTS `tp_mvc`;

USE `tp_mvc`;

CREATE TABLE IF NOT EXISTS `fakultas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `dekan` varchar(100) NOT NULL,
    `address` varchar(200) NOT NULL,
    `email` varchar(100),
    `tanggal_didirikan` date,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `jurusan` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `kaprodi` varchar(100) NOT NULL,
    `akreditasi` varchar(10),
    `tanggal_didirikan` date,
    `email` varchar(100),
    `id_fakultas` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `students` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `nim` varchar(20) NOT NULL,
    `phone` varchar(20) NOT NULL,
    `join_date` date NOT NULL DEFAULT CURRENT_DATE,
    `id_jurusan` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO `fakultas` (`name`, `dekan`, `address`, `email`, `tanggal_didirikan`) VALUES
('Fakultas Teknik', 'Dr. Ir. Budi Santoso', 'Jl. Teknik No. 1', 'teknik@univ.ac.id', '1980-05-15'),
('Fakultas Ekonomi', 'Dr. Siti Aminah', 'Jl. Ekonomi No. 2', 'ekonomi@univ.ac.id', '1985-09-10');

INSERT INTO `jurusan` (`name`, `kaprodi`, `akreditasi`, `tanggal_didirikan`, `email`, `id_fakultas`) VALUES
('Teknik Informatika', 'Dr. Andi Wijaya', 'A', '1990-03-20', 'informatika@univ.ac.id', 1),
('Teknik Sipil', 'Dr. Rina Kusuma', 'B', '1992-07-15', 'sipil@univ.ac.id', 1),
('Manajemen', 'Dr. Agus Pratama', 'A', '1995-11-25', 'manajemen@univ.ac.id', 2);

INSERT INTO `students` (`name`, `nim`, `phone`, `join_date`, `id_jurusan`) VALUES
('Ahmad Fauzi', 'TI2023001', '081234567890', '2023-08-01', 1),
('Siti Nurhaliza', 'TI2023002', '081345678901', '2023-08-01', 1),
('Budi Hartono', 'TS2023001', '081456789012', '2023-08-01', 2),
('Dewi Sartika', 'MN2023001', '081567890123', '2023-08-01', 3);