-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2016 at 09:39 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `battingscore`
--

CREATE TABLE IF NOT EXISTS `battingscore` (
  `id` int(25) unsigned NOT NULL,
  `match_id` int(25) unsigned NOT NULL,
  `team_id` int(25) unsigned NOT NULL,
  `batsman_id` int(25) unsigned DEFAULT NULL,
  `if_batted` varchar(50) DEFAULT NULL,
  `runs` int(25) unsigned DEFAULT NULL,
  `balls_faced` int(25) unsigned DEFAULT NULL,
  `if_out` varchar(50) DEFAULT NULL,
  `wicket_by` int(25) unsigned DEFAULT NULL,
  `wicket_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `battingscore`
--

INSERT INTO `battingscore` (`id`, `match_id`, `team_id`, `batsman_id`, `if_batted`, `runs`, `balls_faced`, `if_out`, `wicket_by`, `wicket_type`) VALUES
(1, 1, 2, 1, 'no', NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, 6, 'no', NULL, NULL, NULL, NULL, NULL),
(3, 1, 2, 2, 'yes', 45, 22, 'no', NULL, NULL),
(4, 1, 1, 4, 'yes', 10, 12, 'yes', 1, 'run out'),
(6, 1, 1, 5, 'yes', 25, 15, 'yes', 1, 'caught'),
(7, 1, 1, 5, 'yes', 25, 15, 'yes', 1, 'caught'),
(8, 1, 1, 5, 'yes', 25, 15, 'yes', 1, 'caught'),
(9, 4, 3, 8, 'yes', 109, 88, 'no', NULL, NULL),
(10, 1, 1, 7, 'yes', 20, 10, 'yes', 3, 'Bowled Out'),
(11, 1, 1, 7, 'yes', 20, 10, 'yes', 3, 'Bowled Out'),
(12, 4, 4, 9, 'yes', 2, 4, 'no', NULL, NULL),
(13, 4, 4, 10, 'yes', 34, 23, 'no', NULL, NULL),
(14, 4, 4, 14, 'yes', 88, 56, 'yes', 17, 'Bowled Out');

-- --------------------------------------------------------

--
-- Table structure for table `bowlingscore`
--

CREATE TABLE IF NOT EXISTS `bowlingscore` (
  `id` int(25) unsigned NOT NULL,
  `match_id` int(25) unsigned NOT NULL,
  `team_id` int(25) unsigned NOT NULL,
  `bowler_id` int(25) unsigned DEFAULT NULL,
  `wickets_taken` int(25) unsigned NOT NULL,
  `runs_given` int(25) unsigned NOT NULL,
  `overs_bowled` decimal(3,1) NOT NULL,
  `current_bowling` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bowlingscore`
--

INSERT INTO `bowlingscore` (`id`, `match_id`, `team_id`, `bowler_id`, `wickets_taken`, `runs_given`, `overs_bowled`, `current_bowling`) VALUES
(1, 1, 1, 5, 3, 0, '2.1', '3/0'),
(2, 1, 1, 6, 4, 22, '7.0', '4/22'),
(3, 1, 1, 6, 4, 22, '7.0', '4/22'),
(4, 2, 1, 6, 4, 19, '4.0', '4/19'),
(5, 2, 1, 6, 4, 19, '4.0', '4/19'),
(6, 2, 1, 6, 4, 19, '4.0', '4/19'),
(7, 4, 4, 9, 3, 20, '2.4', '3/20'),
(8, 4, 4, 10, 3, 20, '2.1', '3/20'),
(9, 1, 1, 11, 4, 10, '4.0', '4/10'),
(10, 2, 1, 11, 4, 7, '10.0', '4/7'),
(11, 1, 2, 1, 4, 80, '0.3', '4/80'),
(12, 4, 4, 14, 3, 17, '1.3', '3/17'),
(13, 4, 4, 12, 1, 15, '2.1', '1/15'),
(14, 4, 3, 17, 2, 14, '2.5', '2/14'),
(15, 4, 3, 18, 3, 28, '6.0', '3/28'),
(16, 4, 3, 20, 0, 34, '4.0', '0/34');

-- --------------------------------------------------------

--
-- Table structure for table `matchlist`
--

CREATE TABLE IF NOT EXISTS `matchlist` (
  `id` int(25) unsigned NOT NULL,
  `team1_id` int(25) unsigned NOT NULL,
  `team2_id` int(25) unsigned NOT NULL,
  `tournament_name` varchar(100) NOT NULL,
  `date_of_match` date NOT NULL,
  `match_name` varchar(50) DEFAULT NULL,
  `venue` varchar(25) DEFAULT NULL,
  `toss_result` varchar(50) DEFAULT NULL,
  `team1_score` varchar(50) DEFAULT NULL,
  `team2_score` varchar(50) DEFAULT NULL,
  `team1_extra` int(25) unsigned DEFAULT NULL,
  `team2_extra` int(25) unsigned DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `id_player_of_the_match` int(25) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matchlist`
--

INSERT INTO `matchlist` (`id`, `team1_id`, `team2_id`, `tournament_name`, `date_of_match`, `match_name`, `venue`, `toss_result`, `team1_score`, `team2_score`, `team1_extra`, `team2_extra`, `result`, `id_player_of_the_match`) VALUES
(1, 2, 1, 'World T20 2016', '2016-03-08', 'Australia vs Bangladesh', 'Kolkata', 'Australia, who chose to field', '156/5', '158/2', 3, 5, 'Bangladesh won by 8 wickets (with 8 balls remainin', 7),
(2, 1, 5, 'Imaginary cup 2016', '2016-04-05', 'Bangladesh vs India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 2, 'imaginary cup 2016', '2016-04-06', 'Bangladesh vs Australia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 4, 'World T20 2016', '2016-04-03', 'West Indies vs England', 'Dhaka', 'England won, chose to bat', '150/4', '152/5', 4, 5, 'WI won by5wickets (with2balls remaining)', 8),
(5, 2, 5, 'World T20 2016', '2016-03-27', 'Australia vs India', 'Dhaka', 'Australia, who chose to field', '156/5', '146 / 6 (20 overs)', 2, 4, 'Australia won by 3 wickets (with 9 balls remaining', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(25) unsigned NOT NULL,
  `user_id` int(25) unsigned NOT NULL,
  `match_id` int(25) unsigned NOT NULL,
  `message` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `id` int(25) unsigned NOT NULL,
  `player_name` varchar(100) NOT NULL,
  `team_id` int(25) unsigned NOT NULL,
  `category` varchar(1000) NOT NULL,
  `matches_played` int(25) DEFAULT NULL,
  `best_bowling` varchar(25) DEFAULT NULL,
  `total_wickets` int(25) DEFAULT NULL,
  `total_balls` int(25) DEFAULT NULL,
  `total_runs_given` int(25) DEFAULT NULL,
  `bowling_strike_rate` double(10,3) DEFAULT NULL,
  `bowling_avg` double(10,3) DEFAULT NULL,
  `bowling_economy` double(10,3) DEFAULT NULL,
  `best_batting` int(25) DEFAULT NULL,
  `innings_played` int(25) DEFAULT NULL,
  `not_outs` int(25) DEFAULT NULL,
  `total_runs` int(25) DEFAULT NULL,
  `batting_strike_rate` double(10,3) DEFAULT NULL,
  `sr_sum` double(10,3) DEFAULT NULL,
  `batting_avg` double(10,3) DEFAULT NULL,
  `hundreds` int(25) DEFAULT NULL,
  `fifties` int(25) DEFAULT NULL,
  `zeroes` int(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `player_name`, `team_id`, `category`, `matches_played`, `best_bowling`, `total_wickets`, `total_balls`, `total_runs_given`, `bowling_strike_rate`, `bowling_avg`, `bowling_economy`, `best_batting`, `innings_played`, `not_outs`, `total_runs`, `batting_strike_rate`, `sr_sum`, `batting_avg`, `hundreds`, `fifties`, `zeroes`) VALUES
(1, 'Aaron Finch', 2, 'Right-handed batsman , Slow left-arm orthodox bowler', 3, '4/80', 19, 45, 92, 2.368, 4.842, 12.267, 0, 2, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(2, 'James Faulkner', 2, 'Right-handed batsman , Left-arm fast medium bowler', 2, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 45, 2, 1, 45, 102.273, 204.545, 45.000, 0, 0, 0),
(3, 'Glenn Maxwell', 2, 'Right-handed batsman , Right-arm off spin bowler', 0, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(4, 'Mushfiqur Rahim', 1, 'Right handed batsman, Wicket-keeper', 1, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 10, 1, 0, 10, 83.333, 83.333, 10.000, 0, 0, 0),
(5, 'Mashrafe Mortaza', 1, 'Right handed batsman , Right arm fast medium bowler', 2, '3/0', 3, 13, 0, 4.333, 0.000, 0.000, 25, 2, 0, 50, 83.334, 166.667, 25.000, 0, 0, 0),
(6, 'Tamim Iqbal', 1, 'Left handed batsman,Right arm off break bowler', 1, '4/19', 20, 156, 101, 7.800, 5.050, 3.885, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(7, 'Shakib Al Hasan', 1, 'Left handed batsman , Slow left-arm orthodox bowler', 3, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 33, 3, 0, 73, 181.159, 543.478, 24.333, 0, 0, 0),
(8, 'Darren Sammy', 3, 'Batsman', 1, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 109, 1, 1, 109, 123.864, 123.864, 0.000, 1, 0, 0),
(9, 'joe root', 4, 'Right handed batsman , Right arm fast medium', 1, '3/20', 3, 16, 20, 5.333, 6.667, 7.500, 2, 1, 1, 2, 50.000, 50.000, 0.000, 0, 0, 0),
(10, 'stokes', 4, ' Slow left-arm orthodox bowler', 1, '3/20', 3, 13, 20, 4.333, 6.667, 9.231, 34, 1, 1, 34, 147.826, 147.826, 0.000, 0, 0, 0),
(11, 'Taskin Ahmed', 1, ' Right arm fast medium bowler', 0, '4/7', 8, 84, 17, 10.500, 2.125, 1.214, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(12, 'james anderson', 4, 'Right handed batsman , Right arm fast medium', 0, '1/15', 1, 13, 15, 13.000, 15.000, 6.923, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(13, 'sam billings', 4, 'Left handed batsman , Slow left-arm orthodox bowler', 0, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(14, 'jos buttler', 4, 'Left handed batsman,Right arm off break bowler', 1, '2/17', 5, 23, 34, 4.600, 6.800, 8.870, 88, 1, 0, 88, 157.143, 157.143, 88.000, 0, 1, 0),
(15, 'james taylor', 4, 'Right-handed Batsman', 0, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(16, 'james vince', 4, 'All-Rounder', 0, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(17, 'Samuel Badree ', 3, 'Left handed batsman , Slow left-arm orthodox bowler', 0, '2/14', 2, 17, 14, 8.500, 7.000, 4.941, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(18, 'Darren Bravo', 3, 'Right-handed Batsman', 0, '3/28', 3, 36, 28, 12.000, 9.333, 4.667, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(19, 'Jermaine Blackwood', 3, 'All-rounder ( Right-handed Batsman , Right-arm off spin Bowler )', 0, NULL, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0),
(20, 'Sulieman Benn ', 3, 'All-rounder ( Right-handed Batsman , Right-arm off spin Bowler )', 0, '0/34', 0, 24, 34, 0.000, 0.000, 8.500, 0, 0, 0, 0, 0.000, 0.000, 0.000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(25) unsigned NOT NULL,
  `team_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `team_name`) VALUES
(2, 'Australia'),
(1, 'Bangladesh'),
(4, 'England'),
(5, 'India'),
(3, 'West Indies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(25) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(25) unsigned NOT NULL,
  `video_name` varchar(100) DEFAULT NULL,
  `video_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_name`, `video_link`) VALUES
(1, 'best catches', 'https://www.youtube.com/embed/vYE7lZ5sXZw');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int(25) unsigned NOT NULL,
  `user_id` int(25) unsigned NOT NULL,
  `match_id` int(25) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battingscore`
--
ALTER TABLE `battingscore`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_match_id_map2` (`match_id`),
  ADD KEY `FK_team_id_map2` (`team_id`),
  ADD KEY `FK_batsman_map` (`batsman_id`),
  ADD KEY `FK_wicket_by_map` (`wicket_by`);

--
-- Indexes for table `bowlingscore`
--
ALTER TABLE `bowlingscore`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_match_id_map` (`match_id`),
  ADD KEY `FK_team_id_map` (`team_id`),
  ADD KEY `FK_bowler_map` (`bowler_id`);

--
-- Indexes for table `matchlist`
--
ALTER TABLE `matchlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_match_team_map1` (`team1_id`),
  ADD KEY `FK_match_team_map2` (`team2_id`),
  ADD KEY `FK_player_of_the_match_map` (`id_player_of_the_match`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_map22` (`user_id`),
  ADD KEY `FK_match_map22` (`match_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_player_team_map` (`team_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_name` (`team_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_map` (`user_id`),
  ADD KEY `FK_match_map_` (`match_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battingscore`
--
ALTER TABLE `battingscore`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `bowlingscore`
--
ALTER TABLE `bowlingscore`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `matchlist`
--
ALTER TABLE `matchlist`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `id` int(25) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `battingscore`
--
ALTER TABLE `battingscore`
  ADD CONSTRAINT `FK_batsman_map` FOREIGN KEY (`batsman_id`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_match_id_map2` FOREIGN KEY (`match_id`) REFERENCES `matchlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_team_id_map2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_wicket_by_map` FOREIGN KEY (`wicket_by`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bowlingscore`
--
ALTER TABLE `bowlingscore`
  ADD CONSTRAINT `FK_bowler_map` FOREIGN KEY (`bowler_id`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_match_id_map` FOREIGN KEY (`match_id`) REFERENCES `matchlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_team_id_map` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matchlist`
--
ALTER TABLE `matchlist`
  ADD CONSTRAINT `FK_match_team_map1` FOREIGN KEY (`team1_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_match_team_map2` FOREIGN KEY (`team2_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_player_of_the_match_map` FOREIGN KEY (`id_player_of_the_match`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_match_map22` FOREIGN KEY (`match_id`) REFERENCES `matchlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_users_map22` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `FK_player_team_map` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `FK_match_map_` FOREIGN KEY (`match_id`) REFERENCES `matchlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_map` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
