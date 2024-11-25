-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambatugym`
--

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `badge_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `criteria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community_post`
--

CREATE TABLE `community_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_date` timestamp NULL DEFAULT NULL,
  `likes_count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `repetisi` varchar(55) NOT NULL,
  `kalori_terbakar` int(255) NOT NULL,
  `goal` enum('lose_weight','build_muscle','maintain') NOT NULL,
  `video_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `exercise_name`, `description`, `repetisi`, `kalori_terbakar`, `goal`, `video_url`) VALUES
(1, 'Burpee', 'Dimulai dengan berdiri, kemudian turun ke posisi squat dengan tangan menyentuh lantai. Lakukan push-up dengan melompatkan kaki ke belakang, lalu kembali ke posisi squat, dan lompat tinggi ke udara sambil mengangkat tangan. Latihan ini melatih seluruh tubuh, termasuk otot inti, kaki, dada, dan meningkatkan detak jantung secara signifikan.', '20 x 3', 150, 'lose_weight', 'turun_berat/burpee.gif'),
(2, 'Jumping Jack', 'Berdiri dengan kaki rapat dan tangan di samping. Lompat dan buka kaki ke samping sambil mengangkat tangan di atas kepala, lalu kembali ke posisi awal. Latihan ini meningkatkan stamina dan kekuatan kardio, serta membantu pembakaran kalori yang cepat.', '50 x 3', 90, 'lose_weight', 'turun_berat/jumpingjack.gif'),
(3, 'Mountain Climbers', 'Dari posisi plank, tarik lutut kanan ke arah dada, lalu kembalikan dan ganti dengan lutut kiri. Gerakan ini dilakukan cepat seperti \"memanjat\". Mountain climbers mengaktifkan otot perut, lengan, bahu, dan kaki, serta efektif untuk meningkatkan pembakaran kalori.', '40 x 3', 135, 'lose_weight', 'turun_berat/mountainclimber.gif'),
(4, 'High Knees', 'Berdiri tegak dan angkat lutut kanan setinggi mungkin, lalu ganti dengan lutut kiri, dilakukan secara cepat. High knees melatih otot inti, kaki, dan meningkatkan detak jantung, sehingga efektif dalam membakar kalori.', '50 x 3', 105, 'lose_weight', 'turun_berat/highknee.gif'),
(5, 'Skater Hop', 'Dari posisi berdiri, lompat ke samping kanan dengan kaki kiri diangkat, lalu lompat ke samping kiri dengan kaki kanan diangkat, seolah-olah melakukan gerakan seperti pemain skating. Latihan ini melatih otot kaki, pinggul, dan meningkatkan koordinasi serta kardio.\r\n\r\n', '30 x 3', 120, 'lose_weight', 'turun_berat/skaterhop.gif'),
(6, 'Bodyweight Squats', 'Berdiri dengan kaki selebar bahu, turunkan tubuh hingga paha sejajar dengan lantai seolah duduk di kursi, lalu kembali berdiri. Squats melatih otot paha, bokong, dan betis, serta meningkatkan kekuatan inti dan pembakaran kalori.', '25 x 3', 90, 'lose_weight', 'turun_berat/bodyweightsquat.gif'),
(7, 'Plank to Push-Up', 'Dimulai dari posisi plank, angkat tubuh ke posisi push-up, lalu turunkan kembali ke plank. Latihan ini melatih otot inti, dada, lengan, dan bahu, serta meningkatkan ketahanan dan kekuatan otot tubuh bagian atas dan inti.', '15 x 3 ', 90, 'lose_weight', 'turun_berat/plankpushup.gif'),
(8, 'Push-Up', 'Dimulai dengan posisi plank dan tangan di bawah bahu, turunkan tubuh hingga dada mendekati lantai, lalu dorong kembali ke posisi awal. Push-up melatih otot dada, tricep, bahu, dan meningkatkan kekuatan tubuh bagian atas.', '15 x 3', 75, 'build_muscle', 'besar_otot/pushup.gif'),
(9, 'Pull-Up', 'Dengan memegang palang di atas kepala, tarik tubuh ke atas hingga dagu melewati palang, lalu turunkan kembali. Pull-up adalah latihan berat badan untuk menguatkan punggung, bicep, dan bahu, serta meningkatkan kekuatan tubuh bagian atas.', '10 x 3', 60, 'build_muscle', 'besar_otot/pullup.gif'),
(10, 'Bench Press ', 'Berbaring di bangku, dorong barbel atau dumbel ke atas hingga tangan lurus, lalu turunkan hingga mendekati dada. Latihan ini sangat efektif untuk melatih otot dada, bahu, dan tricep, serta membangun massa otot tubuh bagian atas.', '12 x 3', 105, 'build_muscle', 'besar_otot/benchpress.gif'),
(11, 'Bicep Curl', 'Berdiri tegak sambil memegang dumbel di kedua tangan, angkat dumbel ke arah bahu dengan melipat siku, lalu turunkan perlahan. Latihan ini menargetkan otot bicep dan membantu dalam pembentukan otot lengan.', '12 x 3', 45, 'build_muscle', 'besar_otot/bicepcurl.gif'),
(12, 'Dumbbell Shoulder Press', 'Duduk atau berdiri dengan dumbel di kedua tangan sejajar dengan bahu, dorong dumbel ke atas hingga tangan lurus, lalu turunkan ke posisi awal. Shoulder press melatih otot bahu, tricep, dan punggung atas, membantu memperbesar dan memperkuat bahu.', '12 x 3', 60, 'build_muscle', 'besar_otot/dumbellshoulderpress.gif'),
(13, 'Deadlift', 'Dengan berdiri dan barbel di depan, tekuk lutut sedikit, lalu angkat barbel dengan menjaga punggung lurus hingga berdiri tegak, kemudian turunkan kembali. Deadlift sangat efektif untuk melatih punggung bawah, paha, bokong, dan hamstring, serta memperkuat otot inti.', '10 x 3', 120, 'build_muscle', 'besar_otot/deadlift.gif'),
(14, 'Lunges', 'Dengan dumbel di kedua tangan, maju dengan satu kaki dan tekuk kedua lutut hingga lutut belakang hampir menyentuh lantai, lalu kembali ke posisi awal. Lunges melatih otot paha, bokong, dan betis, serta memperkuat otot kaki secara keseluruhan.\r\n\r\n', '12 x 3', 60, 'build_muscle', 'besar_otot/lunges.gif'),
(15, 'Jogging di tempat', 'Jogging di tempat dilakukan dengan cara berlari ringan tanpa berpindah tempat. Angkat lutut secara bergantian, dan ayunkan lengan untuk menjaga keseimbangan. Latihan ini berfungsi meningkatkan daya tahan kardio dan mengaktifkan otot kaki.', '5mnt x 3 ', 150, 'maintain', 'pelihara_stamina/joginplace.gif'),
(16, 'Jump Rope', 'Lakukan lompatan kecil dengan kedua kaki sambil memutar tali di atas kepala dan di bawah kaki. Gerakan ini meningkatkan detak jantung dan membakar banyak kalori, serta memperkuat otot kaki, betis, dan meningkatkan koordinasi.', '1mnt x 3', 135, 'maintain', 'pelihara_stamina/jumprope.gif'),
(17, 'Butt Kick', 'Dalam gerakan ini, posisi berdiri tegak dengan kaki selebar pinggul. Lakukan lompatan ringan, secara bergantian menendang tumit ke arah bokong. Ini adalah latihan kardio yang meningkatkan fleksibilitas kaki dan daya tahan tubuh, terutama melatih hamstring dan otot betis.', '1mnt x 3', 100, 'maintain', 'pelihara_stamina/buttkick.gif'),
(18, 'Bear Crawl', 'Dari posisi merangkak, maju dengan menggunakan tangan dan kaki, menjaga tubuh rendah ke lantai. Gerakan ini melatih kekuatan tubuh bagian atas, perut, dan koordinasi. Bear crawl juga meningkatkan daya tahan tubuh dengan mengaktifkan hampir semua otot.', '30dtk x 3', 90, 'maintain', 'pelihara_stamina/bearcrawl.gif'),
(19, 'Russian Twist', 'Duduk dengan lutut ditekuk, miringkan badan sedikit ke belakang, dan putar tubuh dari sisi ke sisi sambil memegang tangan di depan dada atau menambah beban dengan dumbel. Latihan ini sangat efektif untuk melatih otot inti, khususnya bagian perut obliques, dan meningkatkan kekuatan serta stabilitas inti.', '25 x 3', 45, 'maintain', 'pelihara_stamina/russiantwist.gif'),
(20, 'Step-Up', 'Dengan bangku atau pijakan di depan, naikkan satu kaki ke atas bangku, kemudian dorong tubuh ke atas hingga kaki lurus. Turunkan dan ganti dengan kaki lainnya. Latihan ini melatih kekuatan kaki dan meningkatkan detak jantung, serta membantu daya tahan kardio.', '20 x 3', 75, 'maintain', 'pelihara_stamina/stepup.gif'),
(21, 'Plank Hold', 'Mulai dengan posisi push-up, namun tahan tubuh tetap lurus dengan bertumpu pada siku dan ujung kaki. Pastikan tubuh tetap lurus dari kepala hingga kaki, dan tahan posisi ini. Plank efektif untuk menguatkan otot inti, lengan, dan punggung, serta meningkatkan stabilitas tubuh.\r\n\r\n', '1mnt x 3', 60, 'maintain', 'pelihara_stamina/plankhold.gif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `weight` decimal(65,0) NOT NULL,
  `height` decimal(65,0) NOT NULL,
  `goal` varchar(100) NOT NULL,
  `profile_photo` varchar(100) DEFAULT NULL,
  `badge` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `username`, `password`, `gender`, `age`, `birthdate`, `weight`, `height`, `goal`, `profile_photo`, `badge`) VALUES
(37, 'Peter Parker', 'peter@gmail.com', 'peterparker', 'abcde', 'Laki-laki', NULL, '2024-11-02', 75, 180, 'build_muscle', 'cropped-1920-1080-1080594.png', NULL),
(38, 'Christina', 'christina@gmail.com', 'christina', '09876', 'Perempuan', NULL, '2024-11-03', 60, 170, 'maintain', 'Cyberpunk Nightcity 1x1.png', NULL),
(39, 'inari', 'inari@gmail.com', 'inari', 'fedcba', 'Perempuan', NULL, '2024-11-05', 55, 165, 'lose_weight', 'inari kon.jpg', NULL),
(40, 'edwin purba', 'edwin@gmail.com', 'edwin', '12345', 'Laki-laki', NULL, '2024-11-20', 70, 175, 'build_muscle', 'Chess ngnl.jpg', NULL),
(43, 'Yanami Anna', 'yanamianna@gmail.com', 'anna', '12345', 'Perempuan', NULL, '2005-11-29', 60, 170, 'maintain', '674402e8e2e90.jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_badge`
--

CREATE TABLE `user_badge` (
  `user_badge_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `date_earned` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_stat`
--

CREATE TABLE `user_stat` (
  `user_id` int(11) NOT NULL,
  `total_workout_complete` int(11) NOT NULL,
  `total_calories_burned` decimal(10,0) NOT NULL,
  `streak_days` int(11) NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_workout_progress`
--

CREATE TABLE `user_workout_progress` (
  `progress_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `progress_date` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('completed','skipped') NOT NULL,
  `calories_burned` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`badge_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD UNIQUE KEY `post_id_2` (`post_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `users_id` (`user_id`);

--
-- Indexes for table `community_post`
--
ALTER TABLE `community_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username` (`username`);

--
-- Indexes for table `user_badge`
--
ALTER TABLE `user_badge`
  ADD PRIMARY KEY (`user_badge_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- Indexes for table `user_stat`
--
ALTER TABLE `user_stat`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_workout_progress`
--
ALTER TABLE `user_workout_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `p` (`exercise_id`),
  ADD KEY `user id relation` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `community_post`
--
ALTER TABLE `community_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_badge`
--
ALTER TABLE `user_badge`
  MODIFY `user_badge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_workout_progress`
--
ALTER TABLE `user_workout_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `community_post` (`post_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `community_post`
--
ALTER TABLE `community_post`
  ADD CONSTRAINT `community_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `user_badge_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_badge_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`badge_id`);

--
-- Constraints for table `user_stat`
--
ALTER TABLE `user_stat`
  ADD CONSTRAINT `user_stat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_workout_progress`
--
ALTER TABLE `user_workout_progress`
  ADD CONSTRAINT `p` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `user id relation` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
