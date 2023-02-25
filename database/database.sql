-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mvc_cinema_is
DROP DATABASE IF EXISTS `mvc_cinema_is`;
CREATE DATABASE IF NOT EXISTS `mvc_cinema_is` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mvc_cinema_is`;

-- Dumping structure for table mvc_cinema_is.actor
DROP TABLE IF EXISTS `actor`;
CREATE TABLE IF NOT EXISTS `actor` (
  `actor_id` int(10) NOT NULL AUTO_INCREMENT,
  `forename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.actor: ~47 rows (approximately)
INSERT INTO `actor` (`actor_id`, `forename`, `surname`, `date_of_birth`) VALUES
	(1, 'Robert', 'Pattinson', '1986-05-13'),
	(2, 'Zoe', 'Kravitz', '1988-12-01'),
	(3, 'Paul ', 'Dano', '1984-06-19'),
	(4, 'Jeffrey ', 'Wright ', '1965-07-14'),
	(5, 'John', 'Turturro', '1968-10-10'),
	(6, 'Michael ', 'B. Jordan ', '1987-02-09'),
	(7, ' Sylvester ', 'Stallone ', '1946-07-06'),
	(8, ' Florian ', ' Munteanu ', '1990-10-10'),
	(9, ' Tessa ', ' Thompson ', '1983-10-03'),
	(10, 'Alex', 'Wolff', '1997-11-01'),
	(11, 'Toni', 'Colette', '1972-11-01'),
	(12, 'Gabriel', 'Byrne', '1950-03-12'),
	(13, 'Milly', 'Shapiro', '2002-07-16'),
	(14, 'Tom', 'Cruise', '1962-07-03'),
	(15, 'Miles', 'Teller', '1987-02-20'),
	(16, 'Val', 'Kilmer', '1959-12-31'),
	(17, 'Jennifer', 'Connelly', '1970-12-12'),
	(18, 'Sam', 'Worthington', '1976-08-02'),
	(19, 'Zoe', 'Saldana', '1978-06-19'),
	(20, 'Kate', 'Winslet', '1975-10-05'),
	(21, 'Stephen', 'Lang', '1952-07-11'),
	(22, 'Sosie', 'Bacon', '1992-03-15'),
	(23, 'Kyle', 'Gallner', '1986-10-22'),
	(24, 'Jessie', 'T. Usher', '1992-02-29'),
	(25, 'Vera', 'Farmiga', '1973-08-06'),
	(26, 'Patrick', 'Wilson', '1973-07-03'),
	(27, 'Sterling', 'Jerins', '2004-06-15'),
	(28, 'Joseph', 'Bishara', '1970-07-26'),
	(29, 'Amie', 'Donald', '2010-01-28'),
	(30, 'Jenna', 'Davis', '2004-05-05'),
	(31, 'Allison', 'Williams', '1988-04-13'),
	(32, 'Antonio', 'Banderas', '1960-08-10'),
	(33, 'Salma', 'Hayek', '1966-09-02'),
	(34, 'Florence', 'Pugh', '1996-01-03'),
	(35, 'Margot', 'Robbie', '1990-07-02'),
	(36, 'Brad', 'Pitt', '1963-12-18'),
	(37, 'Tobey', 'Maguire', '1975-06-27'),
	(38, 'Phoebe', 'Tonkin', '1989-07-12'),
	(39, 'Jason', 'Statham', '1967-07-26'),
	(40, 'Aubrey', 'plaza', '1984-06-26'),
	(41, 'Hugh', 'Grant', '1960-09-09'),
	(42, 'Bradley', 'Cooper', '1975-01-05'),
	(43, 'Cate', 'Blanchett', '1969-05-14'),
	(44, 'Paul', 'Anderson', '1978-11-19'),
	(45, 'Jake', 'Gyllenhaal', '1980-12-19'),
	(46, '50', 'Cent', '1975-07-06'),
	(47, 'Miguel', 'Gomez', '1985-08-20'),
	(48, 'Amie', 'Donald', '2004-06-21'),
	(49, 'Jenna', 'Davis', '2001-10-25');

-- Dumping structure for table mvc_cinema_is.actor_role
DROP TABLE IF EXISTS `actor_role`;
CREATE TABLE IF NOT EXISTS `actor_role` (
  `actor_role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `played_role` varchar(55) NOT NULL,
  PRIMARY KEY (`actor_role_id`),
  KEY `fk_actor_role_movie_id` (`movie_id`),
  KEY `fk_actor_role_actor_id` (`actor_id`),
  CONSTRAINT `fk_actor_role_actor_id` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`actor_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_actor_role_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.actor_role: ~25 rows (approximately)
INSERT INTO `actor_role` (`actor_role_id`, `movie_id`, `actor_id`, `played_role`) VALUES
	(18, 1, 1, 'Batman'),
	(19, 1, 1, 'Batman'),
	(20, 1, 2, 'Catwomen'),
	(21, 1, 3, 'Riddler'),
	(22, 1, 4, 'Gordon'),
	(23, 2, 10, 'Peter'),
	(24, 2, 11, 'Annie'),
	(25, 2, 12, 'Steve'),
	(26, 2, 13, 'Charlie'),
	(27, 3, 14, 'Pete Mitchell'),
	(28, 3, 15, 'Bradley Bradshaw'),
	(29, 3, 16, 'Tom Kazansky'),
	(30, 3, 17, 'Penny Benjamin'),
	(31, 4, 18, 'Jake Sully'),
	(32, 4, 19, 'Neytiri'),
	(33, 4, 20, 'Ronal'),
	(34, 4, 21, 'Miles Quaritch'),
	(35, 5, 22, 'Rose Cotter'),
	(36, 5, 23, 'Joel'),
	(37, 5, 24, 'Trevor'),
	(38, 6, 25, 'Lorraine Warren'),
	(39, 6, 26, 'Ed Warren'),
	(40, 6, 27, 'judy Warren'),
	(41, 6, 28, 'Bathsheba Sherman'),
	(48, 10, 48, 'M3gan'),
	(49, 10, 49, 'M3gan');

-- Dumping structure for table mvc_cinema_is.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.category: ~10 rows (approximately)
INSERT INTO `category` (`category_id`, `name`, `active`) VALUES
	(1, 'Action', 1),
	(2, 'Science Fiction', 1),
	(3, 'Thriller', 1),
	(4, 'Horror', 1),
	(5, 'Romance', 1),
	(6, 'Comedy', 1),
	(7, 'Crime', 1),
	(8, 'Adventure', 1),
	(9, 'Mystery', 1),
	(10, 'Drama', 1);

-- Dumping structure for table mvc_cinema_is.director
DROP TABLE IF EXISTS `director`;
CREATE TABLE IF NOT EXISTS `director` (
  `director_id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`director_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.director: ~15 rows (approximately)
INSERT INTO `director` (`director_id`, `forename`, `surname`, `date_of_birth`) VALUES
	(3, 'Matt', 'Reeves', '1966-04-27'),
	(5, 'Ari', 'Aster', '1986-07-15'),
	(6, 'Joseph', 'Kosinski', '1974-05-03'),
	(7, 'James', 'Cameron', '1954-08-16'),
	(8, 'Parker', 'Finn', '1987-03-18'),
	(9, 'Michael', 'Chaves', '1950-01-01'),
	(10, 'James', 'Wan', '1977-02-26'),
	(11, 'Gerald', 'JohnStone', '1976-03-04'),
	(12, 'Joel', 'Crawford', '1985-04-11'),
	(13, 'Damien', 'Chazelle', '1985-01-19'),
	(14, 'Guy', 'Ritchie', '1968-09-10'),
	(64, 'Guillermo', 'del-Toro', '1964-10-09'),
	(65, 'Antoine', 'Fuqua', '1966-01-16'),
	(66, 'Steven', 'Caple-Jr', '1988-02-16'),
	(67, 'Gerard', 'Johnstone', '1975-05-10');

-- Dumping structure for table mvc_cinema_is.movie
DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `image_url` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `most_popular` tinyint(1) unsigned NOT NULL,
  `inCinema_at` date NOT NULL DEFAULT current_timestamp(),
  `movie_length` int(10) unsigned NOT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.movie: ~6 rows (approximately)
INSERT INTO `movie` (`movie_id`, `name`, `image_url`, `price`, `description`, `most_popular`, `inCinema_at`, `movie_length`) VALUES
	(1, 'Batman', 'https://wallpapercave.com/wp/wp9429759.jpg', 620, 'Batman ventures into Gotham City underworld when a sadistic killer leaves behind a trail of cryptic clues. As the evidence begins to lead closer to home and the scale of the perpetrators plans become clear, he must forge new relationships, unmask the culprit and bring justice to the abuse of power and corruption that has long plagued the metropolis.', 1, '2023-02-24', 175),
	(2, 'Hereditary', 'https://images2.alphacoders.com/927/927005.jpg', 540, 'When the matriarch of the Graham family passes away, her daughter and grandchildren begin to unravel cryptic and increasingly terrifying secrets about their ancestry, trying to outrun the sinister fate they have inherited.', 1, '2023-02-24', 127),
	(3, 'Top Gun Maverick', 'https://images.hdqwalls.com/wallpapers/2022-top-gun-maverick-zz.jpg', 440, 'After more than 30 years of service as one of the Navy\'s top aviators, Pete "Maverick" Mitchell is where he belongs, pushing the envelope as a courageous test pilot and dodging the advancement in rank that would ground him. Training a detachment of graduates for a special assignment, Maverick must confront the ghosts of his past and his deepest fears, culminating in a mission that demands the ultimate sacrifice from those who choose to fly it.', 1, '2023-02-24', 131),
	(4, 'Avatar The Way of Water', 'https://images5.alphacoders.com/129/1292802.jpg', 580, 'Jake Sully and Ney\'tiri have formed a family and are doing everything to stay together. However, they must leave their home and explore the regions of Pandora. When an ancient threat resurfaces, Jake must fight a difficult war against the humans.', 1, '2023-02-24', 192),
	(5, 'Smile', 'https://wallpapercave.com/wp/wp11514004.jpg', 420, 'After witnessing a bizarre, traumatic incident involving a patient, Dr. Rose Cotter starts experiencing frightening occurrences that she cant explain. As an overwhelming terror begins taking over her life, Rose must confront her troubling past in order to survive and escape her horrifying new reality.', 0, '2023-02-24', 115),
	(6, 'The Conjuring', 'https://images2.alphacoders.com/650/650627.jpg', 360, 'In 1970, paranormal investigators and demonologists Lorraine (Vera Farmiga) and Ed (Patrick Wilson) Warren are summoned to the home of Carolyn (Lili Taylor) and Roger (Ron Livingston) Perron. The Perrons and their five daughters have recently moved into a secluded farmhouse, where a supernatural presence has made itself known. Though the manifestations are relatively benign at first, events soon escalate in horrifying fashion, especially after the Warrens discover the house\'s macabre history.', 0, '2023-02-24', 112),
	(10, 'M3gan', 'https://i.cbc.ca/1.6705330.1672965706!/fileImage/httpImage/image.jpg_gen/derivatives/16x9_780/m3gan.jpg', 600, 'M3GAN is a marvel of artificial intelligence, a lifelike doll thats programmed to be a childs greatest companion and a parents greatest ally. Designed by Gemma, a brilliant roboticist, M3GAN can listen, watch and learn as it plays the role of friend and teacher, playmate and protector. When Gemma becomes the unexpected caretaker of her 8-year-old niece, she decides to give the girl an M3GAN prototype, a decision that leads to unimaginable consequences.', 0, '2023-02-24', 107);

-- Dumping structure for table mvc_cinema_is.movie_category
DROP TABLE IF EXISTS `movie_category`;
CREATE TABLE IF NOT EXISTS `movie_category` (
  `movie_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_category_id`),
  KEY `fk_movie_category_movie_id` (`movie_id`),
  KEY `fk_movie_category_category_id` (`category_id`),
  CONSTRAINT `fk_movie_category_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_movie_category_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.movie_category: ~18 rows (approximately)
INSERT INTO `movie_category` (`movie_category_id`, `movie_id`, `category_id`) VALUES
	(6, 3, 1),
	(7, 3, 8),
	(8, 3, 10),
	(9, 4, 1),
	(10, 4, 8),
	(11, 4, 2),
	(12, 5, 4),
	(13, 5, 3),
	(14, 6, 4),
	(23, 10, 3),
	(24, 10, 4),
	(25, 10, 9),
	(26, 10, 10),
	(27, 1, 1),
	(28, 1, 7),
	(29, 1, 10),
	(30, 2, 3),
	(31, 2, 4);

-- Dumping structure for table mvc_cinema_is.movie_director
DROP TABLE IF EXISTS `movie_director`;
CREATE TABLE IF NOT EXISTS `movie_director` (
  `movie_director_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_director_id`),
  KEY `fk_movie_director_movie_id` (`movie_id`),
  KEY `fk_movie_director_director_id` (`director_id`),
  CONSTRAINT `fk_movie_director_director_id` FOREIGN KEY (`director_id`) REFERENCES `director` (`director_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_movie_director_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.movie_director: ~7 rows (approximately)
INSERT INTO `movie_director` (`movie_director_id`, `movie_id`, `director_id`) VALUES
	(1, 1, 3),
	(2, 2, 5),
	(3, 3, 6),
	(4, 4, 7),
	(5, 5, 8),
	(6, 6, 9),
	(7, 6, 10),
	(10, 10, 67);

-- Dumping structure for table mvc_cinema_is.reservation
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_price` decimal(10,0) NOT NULL,
  `data_created` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_reservation_user_id` (`user_id`),
  CONSTRAINT `fk_reservation_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.reservation: ~17 rows (approximately)
INSERT INTO `reservation` (`reservation_id`, `total_price`, `data_created`, `user_id`) VALUES
	(6, 1160, '2023-01-10', 1),
	(8, 540, '2023-01-15', 1),
	(9, 620, '2023-01-17', 1),
	(10, 620, '2023-01-17', 1),
	(12, 1560, '2023-01-18', 4),
	(13, 1040, '2023-01-19', 4),
	(14, 1020, '2023-01-22', 4),
	(15, 1860, '2023-01-23', 6),
	(16, 2480, '2023-01-12', 7),
	(17, 1780, '2023-01-19', 8),
	(18, 2980, '2023-01-17', 9),
	(19, 2180, '2023-01-22', 10),
	(20, 2420, '2023-01-15', 11),
	(21, 4560, '2023-01-24', 12),
	(22, 4080, '2023-01-24', 13),
	(23, 1320, '2022-01-11', 14),
	(24, 12560, '2022-01-23', 14);

-- Dumping structure for table mvc_cinema_is.reservation_item
DROP TABLE IF EXISTS `reservation_item`;
CREATE TABLE IF NOT EXISTS `reservation_item` (
  `reservation_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`reservation_item_id`),
  KEY `fk_reservation_item_movie_id` (`movie_id`),
  KEY `fk_reservation_item_reservation_id` (`reservation_id`),
  CONSTRAINT `fk_reservation_item_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_reservation_item_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.reservation_item: ~39 rows (approximately)
INSERT INTO `reservation_item` (`reservation_item_id`, `reservation_id`, `movie_id`, `price`, `quantity`) VALUES
	(5, 6, 1, 620, 1),
	(6, 6, 2, 540, 1),
	(8, 8, 2, 540, 1),
	(9, 9, 1, 620, 1),
	(10, 10, 1, 620, 1),
	(15, 12, 4, 580, 1),
	(16, 12, 3, 440, 1),
	(17, 12, 2, 540, 1),
	(18, 13, 1, 620, 1),
	(19, 13, 5, 420, 1),
	(20, 14, 3, 440, 1),
	(21, 14, 4, 580, 1),
	(22, 15, 1, 620, 3),
	(23, 15, 2, 540, 2),
	(24, 15, 3, 440, 1),
	(25, 16, 5, 420, 4),
	(26, 16, 3, 440, 1),
	(27, 16, 6, 360, 1),
	(28, 17, 6, 360, 1),
	(29, 17, 3, 440, 2),
	(30, 17, 2, 540, 1),
	(31, 18, 4, 580, 3),
	(32, 18, 1, 620, 2),
	(33, 19, 5, 420, 2),
	(34, 19, 2, 540, 1),
	(35, 19, 6, 360, 1),
	(36, 19, 3, 440, 1),
	(37, 20, 6, 360, 4),
	(38, 20, 3, 440, 1),
	(39, 20, 2, 540, 1),
	(40, 21, 4, 580, 6),
	(41, 21, 2, 540, 2),
	(42, 22, 1, 620, 6),
	(43, 22, 6, 360, 1),
	(44, 23, 3, 440, 3),
	(45, 24, 6, 360, 7),
	(46, 24, 3, 440, 7),
	(47, 24, 2, 540, 6),
	(48, 24, 1, 620, 6);

-- Dumping structure for table mvc_cinema_is.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.role: ~3 rows (approximately)
INSERT INTO `role` (`role_id`, `name`, `active`) VALUES
	(1, 'Customer', 1),
	(2, 'Admin', 1),
	(3, 'SuperAdmin', 1);

-- Dumping structure for table mvc_cinema_is.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(55) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.user: ~11 rows (approximately)
INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `last_name`, `gender`, `age`) VALUES
	(1, 'test@test.com', '$2y$10$UM8.82aMI3qRjPduxC1AMueCNOL8VIKMAU5PtjL5DpUCvXFBAR6Q6', 'test', 'test', 'm', 21),
	(4, 'test@test2.com', '$2y$10$K1eIqMeNvs5P2yc//OspjeuHtqG9q2ZLk04rT7bKNMr/1sK6rPC9i', 'test2', 'test2', 'm', 1),
	(6, 'test@test3.com', '$2y$10$R7uDe/HcreAKEIgCNf1J.ecXFIA0kq6ciPXAX0D9wV.EUoXwyOKQa', 'test3', 'test3', 'm', 36),
	(7, 'test@test4.com', '$2y$10$SdHEfYcoVWdJ1D4ARQ5hjuhJRC0ZcLra4S5I3DZb2AfKS6IrtgceC', 'test4', 'test4', 'm', 19),
	(8, 'test@test5.com', '$2y$10$sj/qAn1/W3dvRFT4FsP2H.752OhCqBZ3.99A7egQhFbWLEz.MwsqW', 'test5', 'test5', 'm', 28),
	(9, 'test@test6.com', '$2y$10$F2q6xAJgaalHc5K.cJKNf.YagfWlAViElQ78mMv4e5rAFbTjtRzg2', 'test6', 'test6', 'm', 36),
	(10, 'test@test7.com', '$2y$10$5L6aeCFU2GpdKBqQqwkWDeI/AD8vaXUR7YLcshWlDWpIGFDywCXo2', 'test7', 'test7', 'f', 30),
	(11, 'test@test8.com', '$2y$10$at5/uFF.QdvN/oO3zAGaFOhMl74SvDIR4.NpBskLtBEeFK.O7e6/u', 'test8', 'test8', 'f', 41),
	(12, 'test@test9.com', '$2y$10$pEWz73dtRFjpFv4jkrqm7OIkPDdQweH13bPxwIHsTgNNesVqD/TEW', 'test9', 'test9', 'm', 24),
	(13, 'test@test10.com', '$2y$10$vF61O6DdbuM7nTDAiBRR5eQJMFeqRabfgQY7CXQqRwPjPLyIT4Uoe', 'test10', 'test10', 'f', 10),
	(14, 'test@test11.com', '$2y$10$.IzCepJ5G3q2HVdM4HT8qOSaMgGPiGT/RptPmeMns5clTA7WoeaI.', 'test11', 'test11', 'm', 53);

-- Dumping structure for table mvc_cinema_is.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `fk_user_role_user_id` (`user_id`),
  KEY `fk_user_role_role_id` (`role_id`),
  CONSTRAINT `fk_user_role_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_user_role_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mvc_cinema_is.user_role: ~13 rows (approximately)
INSERT INTO `user_role` (`user_role_id`, `user_id`, `role_id`) VALUES
	(1, 1, 3),
	(2, 1, 2),
	(3, 1, 1),
	(4, 4, 1),
	(5, 6, 1),
	(6, 7, 1),
	(7, 8, 1),
	(8, 9, 1),
	(9, 10, 1),
	(10, 11, 1),
	(11, 12, 1),
	(12, 13, 1),
	(13, 14, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
