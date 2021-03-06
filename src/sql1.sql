-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 01, 2015 at 01:19 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `creator` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `invite` varchar(13) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`creator`, `id`, `code`, `description`, `invite`, `date`) VALUES
('bob@utoronto.ca', 3, 'csc301', 'Software Engineering and stuff, so cool man.', '562c199878fce', '2015-10-24 23:51:52'),
('bob@utoronto.ca', 4, 'csc302', 'software engineering 2', '562c19dd90f32', '2015-10-24 23:53:01'),
('bob@utoronto.ca', 5, '', '', '562e8bdc03d3b', '2015-10-26 20:23:56'),
('tomorrow@mail.com', 6, 'csc309', 'wodkaowda', '5633da9cec8b9', '2015-10-30 21:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `num` int(11) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `flag` varchar(50) NOT NULL,
  `satisfied` int(11) NOT NULL,
  `unsatisfied` int(11) NOT NULL,
  /* voters is a csv holding the names of students that already voted in the poll */
  `voters` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `class`, `date`, `num`, `topic`, `flag`, `satisfied`, `unsatisfied`, `voters`) VALUES
(1, 'csc301', '2015-10-26 20:39:09', 1, 'swagging', 'ended', 0, 0, "empty"),
(2, 'csc301', '2015-10-26 20:41:54', 2, 'learning to github', 'ended', 0, 0, "empty"),
(3, 'csc302', '2015-10-26 20:42:04', 1, 'how to java', 'ended', 0, 0, "empty"),
(4, 'csc301', '2015-10-26 20:47:15', 3, 'learning github', 'ended', 0, 0, "empty"),
(5, 'csc301', '2015-10-26 20:56:02', 4, 'learning balls', 'ended', 0, 0, "empty"),
(6, 'csc301', '2015-10-26 20:57:56', 5, 'learning balls 2', 'ended', 0, 0, "empty"),
(7, 'csc309', '2015-10-30 21:01:31', 1, 'github', 'ended', 0, 0, "empty"),
(8, 'csc309', '2015-10-30 21:02:48', 2, 'lol', 'ended', 0, 0, "empty");

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(20) NOT NULL,
  `question` varchar(50) NOT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `creator` varchar(50) NOT NULL,
  `lecture` int(20) NOT NULL,
  `postTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `row_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`, `type`) VALUES
(10, 'Denis', 'dmarch1993@gmail.com', '12345', 'Student'),
(11, 'Kevin Color', 'kevincolor@gmail.com', '12345', 'Professor'),
(12, 'Bob', 'bob@utoronto.ca', '12345', 'Professor'),
(13, 'tom', 'tomorrow@mail.com', '12345', 'Professor'),
(14, 'rath', 'test@mail.com', '123', 'Student'),
(15, '1234', '1234@mail.com', '1234', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`code`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `row_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;