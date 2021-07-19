-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 04:49 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookfilm`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_fd`
--

CREATE TABLE `book_fd` (
  `ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BookTicket_ID` int(11) NOT NULL,
  `FoodDrink_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_fd`
--

INSERT INTO `book_fd` (`ID`, `Quantity`, `TotalPrice`, `created_at`, `updated_at`, `BookTicket_ID`, `FoodDrink_ID`) VALUES
(15, 1, '259000.00', NULL, NULL, 16, 1),
(16, 1, '100000.00', NULL, NULL, 17, 14),
(17, 1, '100000.00', NULL, NULL, 18, 14),
(18, 1, '259000.00', NULL, NULL, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_sit`
--

CREATE TABLE `book_sit` (
  `ID` int(11) NOT NULL,
  `Sit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` int(11) NOT NULL,
  `Count` int(11) NOT NULL,
  `Price` decimal(65,0) NOT NULL,
  `TotalMoney` decimal(65,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BookTicket_ID` int(11) NOT NULL,
  `RoomDetail_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_sit`
--

INSERT INTO `book_sit` (`ID`, `Sit`, `Type`, `Count`, `Price`, `TotalMoney`, `created_at`, `updated_at`, `BookTicket_ID`, `RoomDetail_ID`) VALUES
(10, 'D9, D10,', 3, 2, '15000', '30000', NULL, NULL, 7, NULL),
(12, 'B8, B9,', 3, 2, '15000', '30000', NULL, NULL, 9, NULL),
(15, 'C5,', 3, 1, '15000', '15000', NULL, NULL, 11, NULL),
(16, 'D5, D6,', 2, 2, '10000', '20000', NULL, NULL, 11, NULL),
(17, 'I5,', 1, 1, '5000', '5000', NULL, NULL, 11, NULL),
(20, 'A1,', 3, 1, '15000', '15000', NULL, NULL, 14, NULL),
(22, 'A1, A2,', 3, 2, '15000', '30000', NULL, NULL, 16, NULL),
(23, 'B1, B2,', 3, 2, '15000', '30000', NULL, NULL, 17, NULL),
(24, 'F1, F2,', 2, 2, '10000', '20000', NULL, NULL, 18, NULL),
(25, 'A1, A2,', 3, 2, '15000', '30000', NULL, NULL, 19, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_ticket`
--

CREATE TABLE `book_ticket` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `Sit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CountTicket` int(11) NOT NULL,
  `TotalPrice` decimal(8,2) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Film_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_ticket`
--

INSERT INTO `book_ticket` (`ID`, `Date`, `Time`, `CreatedDate`, `Sit`, `CountTicket`, `TotalPrice`, `Status`, `created_at`, `updated_at`, `User_ID`, `Film_ID`) VALUES
(1, '2021-07-01', '13:00:00', '2021-07-01 13:17:33', 'B8, B9, G8, G9, L8, L9,', 6, '658000.00', 0, NULL, NULL, 1, 7),
(5, '2021-07-31', '01:00:00', '2021-07-01 20:01:03', 'C9, C10, G9, G10, K9, K10,', 6, '648000.00', 1, NULL, NULL, 2, 1),
(7, '2021-05-07', '01:00:00', '2021-07-05 13:48:58', 'D9, D10,', 2, '90000.00', 0, NULL, NULL, 4, 5),
(8, '2021-07-15', '01:00:00', '2021-07-05 15:01:36', 'F8, F9,', 2, '209000.00', 0, NULL, NULL, 4, 8),
(9, '2021-07-05', '09:00:00', '2021-07-05 15:20:17', 'B8, B9,', 2, '90000.00', 0, NULL, NULL, 1, 2),
(10, '2021-07-27', '11:00:00', '2021-07-06 14:42:22', 'D5, D6, H5, H6,', 4, '190000.00', 0, NULL, NULL, 1, 1),
(11, '2021-08-06', '01:00:00', '2021-07-07 09:51:46', 'C5, D5, D6, I5,', 4, '309000.00', 1, NULL, NULL, 5, 6),
(12, '2021-07-08', '11:00:00', '2021-07-07 10:14:59', 'K5,', 1, '55000.00', 0, NULL, NULL, 5, 1),
(13, '2021-07-12', '09:00:00', '2021-07-11 19:56:49', 'A1, A2,', 2, '199000.00', 0, NULL, NULL, 1, 5),
(14, '2021-07-12', '09:00:00', '2021-07-11 20:30:50', 'A1,', 1, '174000.00', 0, NULL, NULL, 1, 2),
(15, '2021-07-13', '09:00:00', '2021-07-12 14:23:23', 'A1, A2,', 2, '239000.00', 0, NULL, NULL, 2, 2),
(16, '2021-07-19', '11:00:00', '2021-07-18 20:37:33', 'A1, A2,', 2, '379000.00', 1, NULL, NULL, 7, 2),
(17, '2021-07-19', '11:00:00', '2021-07-18 20:46:08', 'B1, B2,', 2, '220000.00', 1, NULL, NULL, 7, 2),
(18, '2021-07-19', '01:00:00', '2021-07-18 20:48:47', 'F1, F2,', 2, '230000.00', 1, NULL, NULL, 7, 3),
(19, '2021-07-19', '09:00:00', '2021-07-18 21:16:06', 'A1, A2,', 2, '389000.00', 1, NULL, NULL, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DisplayOrder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Name`, `Link`, `DisplayOrder`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Comedy', 'hai', '1', 1, NULL, NULL),
(2, 'Family', 'gia-dinh', '2', 0, NULL, NULL),
(3, 'Action', 'hanh-dong', '3', 1, NULL, NULL),
(4, 'Drama', 'chinh-kich', '4', 1, NULL, NULL),
(5, 'Horror', 'kinh-di', '', 1, NULL, NULL),
(7, 'Adventure', 'phieu-luu', '', 1, NULL, NULL),
(8, 'Bank Robbery', 'cuop-ngan-hang', '', 1, NULL, NULL),
(9, 'Romantic', 'tinh-cam', '', 1, NULL, NULL),
(10, 'Funny', 'hanh-kich', '', 1, NULL, NULL),
(11, 'Mentality', 'tam-ly', '', 1, NULL, NULL),
(12, 'Science Fiction', 'khoa-hoc-vien-tuong', '', 1, NULL, NULL),
(13, 'Nervous', 'hoi-hop', '', 1, NULL, NULL),
(14, 'Cartoon', 'hoat-hinh', '', 1, NULL, NULL),
(15, 'Anime', 'anime', '', 1, NULL, NULL),
(16, 'Legend', 'than-thoai', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categoryfilm`
--

CREATE TABLE `categoryfilm` (
  `ID` int(11) NOT NULL,
  `Film_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoryfilm`
--

INSERT INTO `categoryfilm` (`ID`, `Film_ID`, `Category_ID`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 1, 16, NULL, NULL),
(3, 2, 4, NULL, NULL),
(4, 2, 5, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 4, 7, NULL, NULL),
(7, 4, 16, NULL, NULL),
(8, 5, 3, NULL, NULL),
(9, 5, 8, NULL, NULL),
(10, 6, 2, NULL, NULL),
(11, 6, 9, NULL, NULL),
(12, 7, 4, NULL, NULL),
(13, 7, 10, NULL, NULL),
(14, 8, 11, NULL, NULL),
(15, 9, 3, NULL, NULL),
(16, 9, 12, NULL, NULL),
(17, 10, 13, NULL, NULL),
(18, 10, 12, NULL, NULL),
(19, 11, 3, NULL, NULL),
(20, 11, 5, NULL, NULL),
(21, 12, 2, NULL, NULL),
(22, 12, 14, NULL, NULL),
(23, 13, 3, NULL, NULL),
(24, 13, 1, NULL, NULL),
(25, 14, 3, NULL, NULL),
(26, 15, 1, NULL, NULL),
(27, 15, 9, NULL, NULL),
(28, 16, 15, NULL, NULL),
(30, 2, 16, NULL, NULL),
(34, 18, 1, NULL, NULL),
(35, 18, 2, NULL, NULL),
(42, 16, 2, NULL, NULL),
(47, 14, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Rate` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Film_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID`, `Content`, `Rate`, `CreatedDate`, `Status`, `created_at`, `updated_at`, `User_ID`, `Film_ID`) VALUES
(1, 'abc xyz', 5, '2021-06-28 09:35:24', 1, NULL, NULL, 1, 2),
(2, 'Phim cũng tạm được, còn nhiều sạn', 9, '2021-06-28 10:20:43', 1, NULL, NULL, 2, 2),
(3, 'Phim hay', 9, '2021-06-28 14:21:30', 1, NULL, NULL, 1, 3),
(4, 'Phim hay, cảnh quay hoành tráng, không bõ 40k mua vé', 10, '2021-07-04 20:49:18', 1, NULL, NULL, 4, 1),
(5, 'Cao Thái Hà sexy quá vậy ', 9, '2021-07-04 20:57:42', 1, NULL, NULL, 4, 8),
(6, 'Phim hack não ghê', 9, '2021-07-05 13:47:23', 1, NULL, NULL, 4, 5),
(7, 'Phim sắp chiếu rồi. Yeah!!!!!', 9, '2021-07-05 14:26:31', 1, NULL, NULL, 4, 14),
(8, '                            ok', 9, '2021-07-05 14:28:46', 1, NULL, NULL, 2, 7),
(9, '                            Xem trailer phim có vẻ nhạt', 8, '2021-07-05 14:40:17', 1, NULL, NULL, 4, 6),
(10, '                            Bộ phim huyền thoại', 10, '2021-07-05 15:23:06', 1, NULL, NULL, 1, 4),
(11, '                            Nhìn poster phim hầm hố vãi', 10, '2021-07-07 09:40:05', 1, NULL, NULL, 1, 9),
(12, '                            Đặt vé thành công', 7, '2021-07-07 09:53:12', 1, NULL, NULL, 5, 6),
(13, '                            phim hay', 8, '2021-07-07 10:08:09', 1, NULL, NULL, 5, 1),
(14, '                            PHIM HAY VAX', 8, '2021-07-12 14:26:07', 1, NULL, NULL, 2, 2),
(15, '                            Phim hay', 9, '2021-07-18 20:32:45', 1, NULL, NULL, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Metatitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Actor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ReleaseDate` datetime NOT NULL,
  `Country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Vote` float NOT NULL,
  `AgeRestriction` int(11) NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Trailer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`ID`, `Name`, `Metatitle`, `Image`, `Director`, `Actor`, `Time`, `ReleaseDate`, `Country`, `Vote`, `AgeRestriction`, `Description`, `Trailer`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Godzilla Đại Chiến Kong - Godzilla vs. Kong', 'Godzilla-dai-Chien-Kong---Godzilla-vs.-Kong', 'godzilla-vs-kong.jpg', 'Adam Wingard', 'Alexander Skarsgård, Millie Bobby Brown, Rebecca Hall, Brian Tyree Henry,…', '110 phút', '2021-03-26 00:00:00', 'USA', 4.2, 13, 'Two arch-enemies Kong and Godzilla will face off in a battle of the century. Kong and his teammates along with Jia is an orphaned young girl who will embark on a perilous expedition to find her true home.\r\n\r\nUnfortunately, they unexpectedly encountered Godzilla and prevented its destruction of the earth. The clash between the two giants by the unseen forces behind, is just the beginning of the mystery deep underground.', 'https://www.youtube.com/embed/yFpuUGFS1Kg', 0, NULL, NULL),
(2, 'Song Song', 'Song-Song', 'song-song.jpg', 'Nguyễn Hữu Hoàng', 'Nabi Nhã Phương, Trương Thế Vinh, Tiến Luật, Khương Ngọc, Hoàng Phi,..', '180 phút', '2021-04-02 00:00:00', 'Viet Nam', 4.3, 16, 'With a mix of sensational, psychological, and thrilling genres, Song Song promises to bring a very unique color to the horror series in theaters this month. Right at the title of the film, Song Song has created a lot of curiosity and excitement for the audience. Song Song is inspired by the butterfly effect, about a woman who must find a way to correct the mistake of accidentally changing the past, turning their lives upside down.\r\nOn a stormy night, Phong (Thuan Phat) accidentally witnessed his neighbor Son (Tien Luat) trying to move a dead body. Because he was too scared, Phong ran out of the house but was hit by a truck and died on the spot before Mr. Son\'s helplessness. How will things turn out? Please watch the movie to get the answer.', 'https://www.youtube.com/embed/hhiKQbGxEOw', 1, NULL, NULL),
(3, 'Ấn Quỷ - The Unholy', 'an-Quy---The-Unholy', 'an-quy.png', 'Evan Spiliotopoulos', 'Cricket Brown, Jeffrey Dean Morgan, Katie Aselton, William Sadler, Cary Elwes,...', '90 phút', '2021-04-02 00:00:00', 'England', 4, 13, 'The screenplay of the film is based on the novel Shrine released in 1983. The content shows that the film has thin lines between faith and blind faith, Demon Seal has sent a message of faith that can bring faith believe, the ideal of life but still have to be alert so as not to get lost.\r\n\r\nIn a rural area in New England, where the deaf girl Alice was born and raised is where the film takes place.\r\n\r\nSuddenly, one day, a mysterious force healed Alice, enabling her to hear and speak normally and to heal all diseases for others. In the presence of hundreds of thousands of people. Also from here a series of horrifying and monstrous events occurred.', 'https://www.youtube.com/embed/f1Nv2O7VJuo', 1, NULL, NULL),
(4, 'Harry Potter Và Bảo Bối Tử Thần Phần 2 - Harry Potter And The Deathly Hallows Part 2', 'Harry-Potter-Va-Bao-Boi-Tu-Than-Phan-2---Harry-Potter-And-The-Deathly-Hallows-Part-2', 'harry-potter.jpg', 'David Yates', 'Daniel Radcliffe, Rupert Grint, Emma Watson, Ralph Fiennes,…', '130 phút', '2021-04-02 00:00:00', 'USA', 4.7, 10, 'Without the guidance of the professors, the group of friends Harry (Daniel Radcliffe), Ron (Rupert Grint) and Hermione (Emma Watson) begin a journey to destroy the Horcruxes - the items that help Lord Voldemort ( Ralph Fiennes) attains immortality.\r\n\r\nAt this time, when the three must agree with each other more than ever, the dark forces are plotting to divide the group of friends. At that time, Lord Voldemort\'s Death Eaters took over the leadership of the Ministry of Magic and Hogwarts, and frantically searched for Harry and his besties - before the ultimate final battle.', 'https://www.youtube.com/embed/eONDcHfpG0s', 1, NULL, NULL),
(5, 'Siêu Trộm - Way Down', 'Sieu-Trom---Way-Down', 'way-down.jpg', 'Jaume Balagueró', 'Freddie Highmore, Astrid Bergès-Frisbey, Sam Riley, Liam Cunningham,...', '118 phút', '2021-04-02 00:00:00', 'USA', 4.3, 18, 'As a Spanish movie blockbuster on the topic of Bank robbery, Super Theft - Way Down promises to bring the audience extremely voyeuristic and unpredictable experiences.\r\n\r\nOcean explorer Walter Moeland has just succeeded in salvaging a shipwreck in Spanish waters, and at the same time found 3 gold coins that are said to lead to the \"endless\" buried treasure of the legend. Sir Francis Drake.\r\n\r\nHowever, the Spanish authorities decided to confiscate the entire product, including 3 coins, and all legal efforts could not help Walter gain ownership. His treasure is now hidden in the safe of the most secure bank in the world - Bank of Spain.\r\n\r\nNot giving up hope, Walter formed a team of \"super thieves\", with the most genius and brave minds, starting to plan to get back what belongs to him.', 'https://www.youtube.com/embed/XfLslifRe0g', 1, NULL, NULL),
(6, 'Khát Vọng Đổi Đời - Minari', 'Khat-Vong-doi-doi---Minari', 'minari.jpg', 'Lee Isaac Chung', 'Steven Yeun, Yeri Han, Alan Kim, Noel Kate Cho, Scott Haze, Yuh-Jung Youn, Will Patton,…', '115 phút', '2021-04-02 00:00:00', 'Korea', 3.7, 16, 'The film\'s content revolves around the story of a Korean family who move to rural Arkansas in search of the American dream.\r\n\r\nThrough a series of hardships and challenges with their new life in the arid Ozarks, they discover the undeniable power of the two words \"family\" and what really makes a family home. Come to the theater to see the exciting happenings.', 'https://www.youtube.com/embed/z4bqat8idns', 1, NULL, NULL),
(7, 'Cô Gái Trẻ Hứa Hẹn - Promising Young Woman', 'Co-Gai-Tre-Hua-Hen---Promising-Young-Woman', 'Promising-Young-Woman-1-poster_KP.jpg', 'Emerald Fennell', 'Carey Mulligan, Bo Burnham, Alison Brie', '113 phút', '2021-04-02 00:00:00', 'England', 4.3, 18, 'The black comedy The Promised Young Girl by British director Emerald Fennell has just been premiered on April 2 at cinemas nationwide.\r\n\r\nBefore her best friend Nina Fisher was sexually assaulted and then committed suicide for not finding justice, Cassandra Cassie Thomas suffered severe psychological trauma and dropped out of school. Now, 30-year-old Cassie wanders among Ohio nightclubs, posing as a drunken \"fat prey\" to attract and educate spoiled naughty boys.', 'https://www.youtube.com/embed/-CNNp-ylxwY', 1, NULL, NULL),
(8, 'Kiều', 'Kieu', 'kieu.jpg', 'Mai Thu Huyền', 'Cao Thái Hà, Phan Thị Mơ,…', '125 phút', '2021-03-08 00:00:00', 'Viet Nam', 4.3, 18, 'Following the films adapted from literary works, Kieu is a bright name, promising to bring the 7th movie fans the ultimate relaxing moments.\r\n\r\nThe film is based on the classic literary work of the same name by the great poet Nguyen Du. Just after releasing the short trailer, Kieu made many viewers curious and looking forward to it. Will Kieu on the screen attract the audience? Please come to the theater to get the most accurate answer.', 'https://www.youtube.com/embed/AHMQlyNXDm8', 1, NULL, NULL),
(9, 'Cuộc Chiến Sinh Tử - Mortal Kombat', 'Cuoc-Chien-Sinh-Tu---Mortal-Kombat', 'mortal-kombat-elle-man-1.jpg', 'Simon McQuoid', 'Lewis Tan, Jessica McNamee, Tadanobu Asano', '110 phút', '2021-07-09 00:00:00', 'Chinese', 4.7, 18, 'The film is about Cole Young, a talented young boxer, MMA champion, who accidentally owns a mysterious Dragon-shaped birthmark on his body. From there, he was chased and threatened by a Ninja with the ability to use icy powers, Sub-zero.\r\n\r\nThrough an encounter with a person named Sonya Blade, he gradually understood more about the birthmark on his body. A millennial war is coming to an end and Cole Young is the last hope to turn the tide.', 'https://www.youtube.com/embed/NYH2sLid0Zc', 1, NULL, NULL),
(10, 'Bản Năng Hoang Dại - Voyagers', 'Ban-Nang-Hoang-Dai---Voyagers', 'voyagers.jpg', 'Neil Burger', 'Tye Sheridan, Lily-Rose Depp, Fionn Whitehead, Chanté Adams, Isaac Hempstead Wright,…', '108 phút', '2021-07-09 00:00:00', 'USA', 4, 13, 'The film is about the not-so-distant future when humanity is on the verge of genocide, a group of teenagers are raised to serve the purpose of intellectual exploitation and acceptance. They embark on an exploratory journey to explore another distant planet.\r\n\r\nBut when they discover the hidden secret behind this noble mission, all begin to resist this training and begin to let their primal instincts take over. At that time, the fate of the entire squadron fell into chaos, they were buried in fear, lust and thirst for power.', 'https://www.youtube.com/embed/PiyN2zS32jE', 1, NULL, NULL),
(11, 'Bàn Tay Diệt Quỷ - Evil Expeller', 'Ban-Tay-Diet-Quy---Evil-Expeller', 'ban-tay-diet-quy.jpg', 'Kim Joo Hwan', 'Park Seo Joon, Ahn Sung Ki, Woo Do Hwan, Choi Woo Sik,…', '128 phút', '2021-07-09 00:00:00', 'Korea', 4, 16, 'The film is about a martial artist after he suddenly possessed the \"Devil\'s Hand\", so MMA fighter Yong Hoo (played by Park Seo Joon) embarked on a journey of exorcism, the axis of demons, and the confrontation with Bishop Shadow. Evening (Woo Do Hwan) – Satan\'s demon disguised as a human.\r\n\r\nSince then, the truth about Yong Hoo\'s father\'s death is gradually revealed as well as the reason why he became \"the chosen one\". Let\'s go to the theater to see more interesting details.', 'https://www.youtube.com/embed/-zBfJFu84O8', 1, NULL, NULL),
(12, 'Nào Mình Cùng Mơ - Dreambuilders', 'Nao-Minh-Cung-Mo---Dreambuilders', 'dreambuilers-cgv-phim-hoat-hinh_1_.jpg', 'Nào Mình Cùng Mơ - Dreambuilders', 'Rasmus Botoft, Martin Buch, Caroline Vedel, Emilie Kroyer Koppel,…', '81 phút', '2021-08-08 00:00:00', 'England', 4, 8, 'The film\'s content is the colorful journey of little Minna into the land of dreams, where there are cute and busy \"dream builders\". Minna\'s life turns upside down when her father takes another step forward.\r\n\r\nThe newly arrived sister Jenny is one of those \"hot Instagram\" nasty ones. So Minna decided to infiltrate and manipulate the dream, teaching Jenny a lesson. And miracles as well as unexpected incidents happened to the \"dream factory\". Let\'s take a look at the exciting details that take place in theaters.', 'https://www.youtube.com/embed/MNMH5s4k1LE', 1, NULL, NULL),
(13, 'Lật Mặt: 48h', 'Lat-Mat:-48h', 'poster-lat-mat_lpmy.jpg', 'Lý Hải', 'Ốc Thanh Vân, Võ Thành Tâm, Mạc Văn Khoa, Huỳnh Đông...', '110 phút', '2021-08-19 00:00:00', 'Việt Nam', 4, 12, 'The story revolves around the journey of escaping from the gangsters of the family of Mr. Hien - a martial arts master with a background as a boxer in the past. Because he needed a large amount of money, he accidentally fell into the trap of bad people but luckily escaped.\r\n\r\nHien and his wife and children had to flee to an old friend\'s hometown to escape the chase, but they still followed him to the place and chased him down. Will Hien escape the hunt and protect his wife and children? Let\'s follow the movie happenings in theaters', 'https://www.youtube.com/embed/ykBfss-8H4Y', 1, NULL, NULL),
(14, 'Người Nhân Bản - SEOBOK', 'Nguoi-Nhan-Ban---SEOBOK', 'seobok-nguoi-nhan-ban.jpg', 'Lee Yong-zoo', 'Gong Yoo, Park Bo-gum, Jo Woo-jin, Jang Young-nam, Park Byung-eun,…', '110 phút', '2021-07-19 00:00:00', 'Korea', 4.3, 12, 'The film tells the story of Ki-hun - a former agent who has lived isolated from the outside world since the incident in the past, accepting the last mission from the Intelligence Agency. He was responsible for moving Seobok, a test subject created by cloning stem cells and genetically modifying them.\r\n\r\nHowever, things did not go well for them, when Seobok became the target of other forces with unpredictable ambitions and plots. Will Ki-hun overcome all the dangers that lie ahead, or will Seobok eventually fall into the hands of someone who wants to usurp the destiny of all mankind? Check out this much-awaited movie in theaters.', 'https://www.youtube.com/embed/eFf0nos163o', 1, NULL, NULL),
(15, 'Phim \"1990\"', 'Phim-\"1990\"', 'rsz_1990.jpg', 'Nhất Trung', 'Diễm My, Ninh Dương Lan Ngọc, Nhã Phương...', '120 phút', '2021-08-19 00:00:00', 'Việt Nam', 4, 10, 'The movie \'1990\' is a handshake between three Ngoc actresses of Vietnamese cinema: Diem My - Ninh Duong Lan Ngoc and Nha Phuong.\r\n\r\nThe movie \'1990\' is in the Comedy - Romance genre, with the content revolving around a group of close friends consisting of three girls with three different personalities. When the age threshold of \"30 difference\" hit all three at the same time, a series of problems related to marriage, work, love, career, ... one after another appeared, forcing them to help. , support each other to overcome this turbulent milestone.', 'https://www.youtube.com/embed/bDRGW_d-3XI', 1, NULL, NULL),
(16, 'Thám Tử Lừng Danh Conan: Viên Đạn Đỏ', 'Tham-Tu-Lung-Danh-Conan:-Vien-dan-do', 'conan.jpg', 'Nagaoka Tomoka', 'Takayama Minami, Yamazaki Wakana, Koyama Rikiya, Yamaguchi Kappei', '110 phút', '2021-08-24 00:00:00', 'Japan', 4, 6, 'The film is set when the city of Tokyo (Japan) is preparing to welcome the world\'s largest sports Olympics called \"WSG: World Sports Games\". This is also an important event for Japan to announce to the world about the \"linear vacuum superconducting\" train with 1-0-2.\r\n\r\nThe film is about Detective Conan\'s journey to find a solution to the mysterious disappearance of the sponsors of the Olympics. The film promises to bring a very unique mind-bending performance.', 'https://www.youtube.com/embed/Jrt1aUU2_Xs', 1, NULL, NULL),
(18, 'Bố già', 'Bo-gia', 'bo-gia.jpg', 'Vũ Ngọc Đãng', 'Trấn Thành, NSND Ngọc Giàu, Tuấn Trần, Ngân Chi, Lê Giang,…', '128 phút', '2021-03-12 00:00:00', 'Việt Nam', 4, 5, 'With humane and meaningful content, the Godfather web-drama has achieved great success. To continue that success, the movie Bo Gia was released with the desire to bring Vietnamese audiences a new breeze.\r\n\r\nThe film revolves around the small family of Ba Sang and Quan, living in a poor working-class neighborhood. Ba Sang is a man who cares about money, always loves his son, but the gap between generations has caused many conflicts. Will the feelings of the father and son of the Sang family become better and create a bond from the differences?\r\nThe Godfather carries a human message about family, conveying to the audience lessons by telling very new. According to recorded information, the cast in the movie \"The Godfather\" will remain the same as in the previous web-drama. However, this time, the Godfather will bring a completely different father and children with a very different fate. If you love The Godfather and this talented cast, make sure you go to the cinema to support the movie.', 'https://www.youtube.com/embed/jluSu8Rw6YE', 1, NULL, NULL),
(19, 'Bố Già', 'Bo-Gia', 'bo-gia-abc.jpg', 'Vu Ngoc Dang', 'Tran Thanh , Luu Van Huy', '128 phút', '2021-07-02 00:00:00', 'Viet Nam', 4, 12, 'As a single father since his wife left, Mr. Sang became the sole support for his eldest son Quan and adopted daughter Bu Tot. Quan is a young man with progressive ideas, does not want his father to suffer because of being oppressed by his relatives, and Mr. Sang is a gentle man who is always patient with people around. As a result, the father-son relationship is increasingly strained. The gap between two different generations, is it easy to understand and sympathize with each other?', 'https://www.youtube.com/embed/jluSu8Rw6YE', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_drink`
--

CREATE TABLE `food_drink` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` decimal(65,0) NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_drink`
--

INSERT INTO `food_drink` (`ID`, `Name`, `Image`, `Price`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'LINE 3 SINGLE COMBO', 'bap-nuoc.png', '259000', '<p>1 ly Line 3 (kèm nước) + 1 bắp ngọt lớn</p>\r\n<p>* Miễn phí đổi vị bắp Phô mai, Caramel *</p>\r\n<p>**Nhận trong ngày xem phim**</p>', NULL, NULL),
(14, 'MILO COMBO 2021', 'bap-nuoc.jpg', '100000', '<p>1 bắp lớn + 2 nước lớn. Nhận trong ng&agrave;y xem phim.</p><p>* Miễn ph&iacute; đổi vị bắp Caramel *</p><p>**Đổi vị ph&ocirc; mai phụ thu th&ecirc;m tiền**</p>', NULL, NULL),
(16, 'MY COMBO', 'bap-nuoc.jpg', '100000', '<p>1 bắp lớn + 2 nước lớn. Nhận trong ng&agrave;y xem phim.</p><p>* Miễn ph&iacute; đổi vị bắp Caramel *</p><p>**Đổi vị ph&ocirc; mai phụ thu th&ecirc;m tiền**</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL,
  `Point` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID`, `Point`, `Name`, `created_at`, `updated_at`, `User_ID`) VALUES
(1, 50, 'Bạc', NULL, NULL, 1),
(2, 20, 'Đồng', NULL, NULL, 2),
(3, 20, 'Đồng', NULL, NULL, 4),
(4, 20, 'Đồng', NULL, NULL, 5),
(5, 40, 'Sliver', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(34, '2021_06_25_064045_create_film_table', 2),
(35, '2021_06_25_065234_create_category_table', 2),
(36, '2021_06_25_065413_create_categoryfilm_table', 2),
(37, '2021_06_25_070158_create_comment_table', 2),
(38, '2021_06_25_070411_create_reply_table', 2),
(39, '2021_06_25_070821_create_food_drink_table', 2),
(40, '2021_06_25_071050_create_book_ticket_table', 2),
(41, '2021_06_25_071524_create_book_fd_table', 2),
(42, '2021_06_25_071730_create_member_table', 2),
(43, '2021_06_25_072211_create_room_table', 2),
(44, '2021_06_25_072300_create_room_detail_table', 2),
(45, '2021_06_25_072547_create_book_sit_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `ID` int(11) NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Comment_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`ID`, `Content`, `CreatedDate`, `created_at`, `updated_at`, `User_ID`, `Comment_ID`) VALUES
(1, 'def glm', '2021-06-28 10:23:33', NULL, NULL, 2, 1),
(2, 'clgt?????????????????', '2021-06-28 14:17:17', NULL, NULL, 1, 1),
(3, 'Phim đúng chuẩn kinh dị', '2021-06-28 14:21:55', NULL, NULL, 1, 3),
(4, 'Phim hay mà', '2021-06-28 14:26:42', NULL, NULL, 2, 3),
(5, 'Ôi cô cô cũng xem phim này hả?', '2021-07-04 21:07:35', NULL, NULL, 2, 5),
(6, 'Ok babe', '2021-07-05 14:33:20', NULL, NULL, 4, 8),
(7, 'Nhạt như cô cô bình luận vậy', '2021-07-07 09:44:11', NULL, NULL, 5, 9),
(8, 'cam on ban', '2021-07-07 10:08:25', NULL, NULL, 5, 13);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ID`, `Name`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Phòng 1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_detail`
--

CREATE TABLE `room_detail` (
  `ID` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `Row` int(11) NOT NULL,
  `Column` int(11) NOT NULL,
  `Price` decimal(8,0) NOT NULL,
  `TicketPrice` decimal(8,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Room_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_detail`
--

INSERT INTO `room_detail` (`ID`, `Level`, `Row`, `Column`, `Price`, `TicketPrice`, `created_at`, `updated_at`, `Room_ID`) VALUES
(1, 1, 3, 10, '15', '55000', NULL, NULL, 1),
(2, 2, 4, 10, '10', '55000', NULL, NULL, 1),
(3, 3, 4, 10, '10', '55000', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BirthDay` datetime NOT NULL,
  `Type` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Account`, `Email`, `Password`, `Fullname`, `Address`, `Phone`, `Sex`, `BirthDay`, `Type`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'hung5001', NULL, '12345', 'Hưng Đỗ Công', 'Hà Nội', '0362243247', 'Nam', '1996-02-15 00:00:00', 1, 1, NULL, NULL),
(2, 'duongqua', NULL, '12345', 'Dương Quá', 'Núi Võ Đang', '0849965645', 'Nam', '1990-01-01 00:00:00', 1, 1, NULL, NULL),
(3, 'admin', NULL, '123456', 'Administrator', '', '', '', '0000-00-00 00:00:00', 0, 1, NULL, NULL),
(4, 'longcoco', NULL, '12345', 'Long Cô Cô', 'Hoàng Quốc Việt - Cầu Giấy-Hà Nội', '0849965645', 'Nữ', '1980-01-01 00:00:00', 1, 1, NULL, NULL),
(5, 'truongtp', NULL, '12345', 'Trương Tam Phong', 'Yang hoo', '0978654321', 'Nam', '1988-01-01 00:00:00', 1, 1, NULL, NULL),
(7, 'PhucAptech', 'phucpvts2008046@fpt.edu.vn', '123456', 'Phuc', 'Binh Chanh', '0963236247', 'Nam', '2021-07-15 00:00:00', 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_fd`
--
ALTER TABLE `book_fd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_fd_bookticket_id_foreign` (`BookTicket_ID`),
  ADD KEY `book_fd_fooddrink_id_foreign` (`FoodDrink_ID`);

--
-- Indexes for table `book_sit`
--
ALTER TABLE `book_sit`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_sit_bookticket_id_foreign` (`BookTicket_ID`),
  ADD KEY `book_sit_roomdetail_id_foreign` (`RoomDetail_ID`);

--
-- Indexes for table `book_ticket`
--
ALTER TABLE `book_ticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_ticket_user_id_foreign` (`User_ID`),
  ADD KEY `book_ticket_film_id_foreign` (`Film_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categoryfilm`
--
ALTER TABLE `categoryfilm`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categoryfilm_category_id_foreign` (`Category_ID`),
  ADD KEY `categoryfilm_film_id_foreign` (`Film_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `comment_user_id_foreign` (`User_ID`),
  ADD KEY `comment_film_id_foreign` (`Film_ID`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `food_drink`
--
ALTER TABLE `food_drink`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `member_user_id_foreign` (`User_ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `reply_user_id_foreign` (`User_ID`),
  ADD KEY `reply_comment_id_foreign` (`Comment_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `room_detail`
--
ALTER TABLE `room_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `room_detail_room_id_foreign` (`Room_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_fd`
--
ALTER TABLE `book_fd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `book_sit`
--
ALTER TABLE `book_sit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `book_ticket`
--
ALTER TABLE `book_ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categoryfilm`
--
ALTER TABLE `categoryfilm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `food_drink`
--
ALTER TABLE `food_drink`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_detail`
--
ALTER TABLE `room_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_fd`
--
ALTER TABLE `book_fd`
  ADD CONSTRAINT `book_fd_bookticket_id_foreign` FOREIGN KEY (`BookTicket_ID`) REFERENCES `book_ticket` (`ID`),
  ADD CONSTRAINT `book_fd_fooddrink_id_foreign` FOREIGN KEY (`FoodDrink_ID`) REFERENCES `food_drink` (`ID`);

--
-- Constraints for table `book_sit`
--
ALTER TABLE `book_sit`
  ADD CONSTRAINT `book_sit_bookticket_id_foreign` FOREIGN KEY (`BookTicket_ID`) REFERENCES `book_ticket` (`ID`),
  ADD CONSTRAINT `book_sit_roomdetail_id_foreign` FOREIGN KEY (`RoomDetail_ID`) REFERENCES `room_detail` (`ID`);

--
-- Constraints for table `book_ticket`
--
ALTER TABLE `book_ticket`
  ADD CONSTRAINT `book_ticket_film_id_foreign` FOREIGN KEY (`Film_ID`) REFERENCES `film` (`ID`),
  ADD CONSTRAINT `book_ticket_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `categoryfilm`
--
ALTER TABLE `categoryfilm`
  ADD CONSTRAINT `categoryfilm_category_id_foreign` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`ID`),
  ADD CONSTRAINT `categoryfilm_film_id_foreign` FOREIGN KEY (`Film_ID`) REFERENCES `film` (`ID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_film_id_foreign` FOREIGN KEY (`Film_ID`) REFERENCES `film` (`ID`),
  ADD CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_comment_id_foreign` FOREIGN KEY (`Comment_ID`) REFERENCES `comment` (`ID`),
  ADD CONSTRAINT `reply_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `room_detail`
--
ALTER TABLE `room_detail`
  ADD CONSTRAINT `room_detail_room_id_foreign` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
