-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:43 PM
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
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_date` timestamp NULL DEFAULT current_timestamp(),
  `likes_count` int(255) NOT NULL DEFAULT 0
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
(1, 'Burpee', 'Start by standing, then lower into a squat position with your hands touching the floor. Do a push-up by jumping your feet back, then return to a squat position, and jump high into the air while raising your arms. This exercise works the entire body, including the core muscles, legs, chest, and increases the heart rate significantly.', '20 x 3', 150, 'lose_weight', 'turun_berat/burpee.gif'),
(2, 'Jumping Jack', 'Stand with your feet together and your hands at your sides. Jump and open your legs to the side while raising your arms above your head, then return to the starting position. This exercise increases stamina and cardio strength, and helps burn calories quickly.', '50 x 3', 90, 'lose_weight', 'turun_berat/jumpingjack.gif'),
(3, 'Mountain Climbers', 'From a plank position, pull your right knee towards your chest, then return it and replace it with your left knee. This movement is done quickly like \"climbing\". Mountain climbers activate the abdominal muscles, arms, shoulders and legs, and are effective in increasing calorie burning.', '40 x 3', 135, 'lose_weight', 'turun_berat/mountainclimber.gif'),
(4, 'High Knees', 'Stand straight and lift your right knee as high as possible, then replace it with your left knee, do it quickly. High knees train the core muscles, legs, and increase heart rate, so they are effective in burning calories.', '50 x 3', 105, 'lose_weight', 'turun_berat/highknee.gif'),
(5, 'Skater Hop', 'From a standing position, jump to the right side with your left foot raised, then jump to the left side with your right foot raised, as if doing a figure skating movement. This exercise trains the leg muscles, hips, and improves coordination and cardio.', '30 x 3', 120, 'lose_weight', 'turun_berat/skaterhop.gif'),
(6, 'Bodyweight Squats', 'Stand with your feet shoulder-width apart, lower your body until your thighs are parallel to the floor as if sitting on a chair, then return to standing. Squats work the thighs, buttocks, and calves, and increase core strength and calorie burning.', '25 x 3', 90, 'lose_weight', 'turun_berat/bodyweightsquat.gif'),
(7, 'Plank to Push-Up', 'Starting from a plank position, lift your body to a push-up position, then lower it back to a plank. This exercise works the core, chest, arms and shoulders, and increases endurance and strength of the upper body and core muscles.', '15 x 3 ', 90, 'lose_weight', 'turun_berat/plankpushup.gif'),
(8, 'Push-Up', 'Starting in a plank position and hands under your shoulders, lower your body until your chest is close to the floor, then push back to the starting position. Push-ups train your chest muscles, triceps, shoulders and increase upper body strength.', '15 x 3', 75, 'build_muscle', 'besar_otot/pushup.gif'),
(9, 'Pull-Up', 'Holding the bar above your head, pull your body up until your chin is over the bar, then lower it back down. Pull-ups are a bodyweight exercise to strengthen the back, biceps, and shoulders, and increase upper body strength.', '10 x 3', 60, 'build_muscle', 'besar_otot/pullup.gif'),
(10, 'Bench Press ', 'Lie on a bench, push the barbell or dumbbells up until your arms are straight, then lower them until they approach your chest. This exercise is very effective for training the chest, shoulders and triceps muscles, as well as building upper body muscle mass.', '12 x 3', 105, 'build_muscle', 'besar_otot/benchpress.gif'),
(11, 'Bicep Curl', 'Stand straight while holding dumbbells in both hands, lift the dumbbells towards your shoulders by folding your elbows, then lower them slowly. This exercise targets the bicep muscles and helps in building arm muscles.', '12 x 3', 45, 'build_muscle', 'besar_otot/bicepcurl.gif'),
(12, 'Dumbbell Shoulder Press', 'Sit or stand with dumbbells in both hands at shoulder level, push the dumbbells up until your arms are straight, then lower them to the starting position. The shoulder press works the shoulder muscles, triceps and upper back, helping to enlarge and strengthen the shoulders.', '12 x 3', 60, 'build_muscle', 'besar_otot/dumbellshoulderpress.gif'),
(13, 'Deadlift', 'Standing with the barbell in front of you, bend your knees slightly, then lift the barbell keeping your back straight until you stand up straight, then lower it back down. Deadlifts are very effective for working the lower back, thighs, buttocks, and hamstrings, as well as strengthening the core muscles.', '10 x 3', 120, 'build_muscle', 'besar_otot/deadlift.gif'),
(14, 'Lunges', 'With dumbbells in both hands, step forward on one leg and bend both knees until the back knee almost touches the floor, then return to the starting position. Lunges work the thighs, buttocks, and calves, and strengthen the leg muscles as a whole.', '12 x 3', 60, 'build_muscle', 'besar_otot/lunges.gif'),
(15, 'Jog in Place', 'Jogging in place is done by running lightly without moving. Alternately raise your knees, and swing your arms to maintain balance. This exercise functions to increase cardio endurance and activate leg muscles.', '5mnt x 3 ', 150, 'maintain', 'pelihara_stamina/joginplace.gif'),
(16, 'Jump Rope', 'Do small jumps with both feet while rotating the rope above your head and under your feet. This movement increases your heart rate and burns a lot of calories, as well as strengthening your leg muscles, calves and improving coordination.', '1mnt x 3', 135, 'maintain', 'pelihara_stamina/jumprope.gif'),
(17, 'Butt Kick', 'In this movement, stand straight with your feet hip-width apart. Do light jumps, alternately kicking your heels towards your buttocks. This is a cardio exercise that improves leg flexibility and endurance, especially working the hamstrings and calf muscles.', '1mnt x 3', 100, 'maintain', 'pelihara_stamina/buttkick.gif'),
(18, 'Bear Crawl', 'From a crawling position, move forward using your hands and feet, keeping your body low to the floor. This movement trains upper body strength, abdominals and coordination. Bear crawls also increase endurance by activating almost all muscles.', '30dtk x 3', 90, 'maintain', 'pelihara_stamina/bearcrawl.gif'),
(19, 'Russian Twist', 'Sit with your knees bent, tilt your body back slightly, and twist your body from side to side while holding your hands in front of your chest or adding weight with dumbbells. This exercise is very effective for working the core muscles, especially the abdominal obliques, and increasing core strength and stability.', '25 x 3', 45, 'maintain', 'pelihara_stamina/russiantwist.gif'),
(20, 'Step-Up', 'With a bench or step in front of you, raise one leg onto the bench, then push your body up until your leg is straight. Lower and switch to the other leg. This exercise trains leg strength and increases heart rate, as well as helping cardio endurance.', '20 x 3', 75, 'maintain', 'pelihara_stamina/stepup.gif'),
(21, 'Plank Hold', 'Start in a push-up position, but keep your body straight by resting on your elbows and toes. Make sure your body remains straight from head to toe, and hold this position. Planks are effective for strengthening core, arm and back muscles, as well as increasing body stability.', '1mnt x 3', 60, 'maintain', 'pelihara_stamina/plankhold.gif');

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
  `exercise_complete` int(100) NOT NULL DEFAULT 0,
  `day_streak` int(100) NOT NULL DEFAULT 0,
  `calories_burn` int(11) NOT NULL DEFAULT 0,
  `badge` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `username`, `password`, `gender`, `age`, `birthdate`, `weight`, `height`, `goal`, `profile_photo`, `exercise_complete`, `day_streak`, `calories_burn`, `badge`) VALUES
(38, 'Christina', 'christina@gmail.com', 'christina', '09876', 'Perempuan', NULL, '2024-11-03', 60, 170, 'maintain', 'Cyberpunk Nightcity 1x1.png', 0, 0, 0, NULL),
(39, 'inari', 'inari@gmail.com', 'inari', 'fedcba', 'Perempuan', NULL, '2024-11-05', 55, 165, 'lose_weight', 'inari kon.jpg', 0, 0, 0, NULL),
(40, 'edwin purba', 'edwin@gmail.com', 'edwin', '12345', 'Laki-laki', NULL, '2024-11-20', 70, 175, 'build_muscle', 'Chess ngnl.jpg', 4, 1, 330, NULL),
(43, 'Yanami Anna', 'haga@gmail.com', 'konami', '12345', 'Perempuan', NULL, '2005-11-29', 60, 170, 'build_muscle', '67471d347b82e.jpg', 0, 0, 0, NULL),
(44, 'ayam', 'ayam@outlook.com', 'ayam', '12345', 'Perempuan', NULL, '2024-11-25', 90, 100, 'build_muscle', '674464c7e1bbd.jpg', 0, 0, 0, NULL);

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
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`post_id`);

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
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `community` (`post_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `community`
--
ALTER TABLE `community`
  ADD CONSTRAINT `community_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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
