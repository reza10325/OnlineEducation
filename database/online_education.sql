--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questions_id` int(11) NOT NULL,
  `answer_text` text COLLATE utf8_persian_ci NOT NULL,
  `istrue` enum('yes','no') COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_id` (`questions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answers_given`
--

CREATE TABLE IF NOT EXISTS `answers_given` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answers_id` text COLLATE utf8_persian_ci NOT NULL,
  `success` enum('yes','no','not answer') COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fields_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `period-time` int(11) NOT NULL,
  `start_period` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_period` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cost_fixed` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_id` (`fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses_detail`
--

CREATE TABLE IF NOT EXISTS `courses_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courses_id` int(11) NOT NULL,
  `status` enum('articles','refrences') COLLATE utf8_persian_ci NOT NULL DEFAULT 'articles',
  `link` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_id` (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courses_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL COMMENT 'managers id',
  `time_exam` int(11) NOT NULL COMMENT 'modat zamane exam',
  `date_exam` timestamp NULL COMMENT 'tarikhe exam',
  `result` enum('hide','show') COLLATE utf8_persian_ci NOT NULL DEFAULT 'hide',
  `randomize` enum('yes','no') COLLATE utf8_persian_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `courses_id` (`courses_id`),
  KEY `creator_id` (`creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--


CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('admin','financial','teacher') COLLATE utf8_persian_ci NOT NULL DEFAULT 'admin',
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_persian_ci NOT NULL,
  `melli_code` int(10) NOT NULL,
  `mobile` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `melli_code` (`melli_code`,`mobile`,`email`),
  KEY `name` (`name`),
  KEY `family` (`family`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL COMMENT 'id from users or managers table (check sender type)',
  `reciver_id` int(11) NOT NULL COMMENT 'id from users or managers table (check reciver type)',
  `sender_type` enum('managers','users') COLLATE utf8_persian_ci NOT NULL,
  `reciver_type` enum('managers','users') COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attach` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `sender_status` enum('read','delete') COLLATE utf8_persian_ci NOT NULL,
  `reciever_status` enum('unread','read','delete') COLLATE utf8_persian_ci NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`,`reciver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  `randomize` enum('yes','no') COLLATE utf8_persian_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `birth_day` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_persian_ci NOT NULL,
  `melli_code` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `field_id` int(11) NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `melli_code` (`melli_code`,`email`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `username` (`username`),
  KEY `name` (`name`),
  KEY `family` (`family`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_course`
--

CREATE TABLE IF NOT EXISTS `users_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `users_id` (`users_id`),
  KEY `courses_id` (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
