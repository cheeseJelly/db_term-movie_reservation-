-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- 생성 시간: 17-06-24 13:55
-- 서버 버전: 5.6.35
-- PHP 버전: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `db_term`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `booking_info`
--

CREATE TABLE `booking_info` (
  `booking_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_type` varchar(30) CHARACTER SET ucs2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie`
--

CREATE TABLE `movie` (
  `movie_no` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `playMinutes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie_actor`
--

CREATE TABLE `movie_actor` (
  `movie_actor_rel_id` int(11) NOT NULL,
  `movie_no` int(11) NOT NULL,
  `people_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie_director`
--

CREATE TABLE `movie_director` (
  `movie_director_rel_id` int(11) NOT NULL,
  `movie_no` int(11) NOT NULL,
  `people_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie_genre`
--

CREATE TABLE `movie_genre` (
  `movie_genre_rel_id` int(11) NOT NULL,
  `movie_no` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `people`
--

CREATE TABLE `people` (
  `people_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `review_no` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `showTime_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `seat`
--

CREATE TABLE `seat` (
  `seat_no` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `showtime`
--

CREATE TABLE `showtime` (
  `showTime_id` int(11) NOT NULL,
  `movie_no` int(11) NOT NULL,
  `theater_no` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `show_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `theater`
--

CREATE TABLE `theater` (
  `theater_no` int(11) NOT NULL,
  `theater_name` varchar(100) NOT NULL,
  `max_row` int(11) NOT NULL,
  `max_col` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `ticket_info`
--

CREATE TABLE `ticket_info` (
  `ticket_id` int(11) NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `seat_no` varchar(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `ticket_type`
--

CREATE TABLE `ticket_type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `id` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `user_no` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `booking_info`
--
ALTER TABLE `booking_info`
  ADD PRIMARY KEY (`booking_id`);

--
-- 테이블의 인덱스 `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- 테이블의 인덱스 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_no`);

--
-- 테이블의 인덱스 `movie_actor`
--
ALTER TABLE `movie_actor`
  ADD PRIMARY KEY (`movie_actor_rel_id`);

--
-- 테이블의 인덱스 `movie_director`
--
ALTER TABLE `movie_director`
  ADD PRIMARY KEY (`movie_director_rel_id`);

--
-- 테이블의 인덱스 `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`movie_genre_rel_id`);

--
-- 테이블의 인덱스 `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`people_id`);

--
-- 테이블의 인덱스 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_no`),
  ADD KEY `review_no` (`review_no`);

--
-- 테이블의 인덱스 `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_no`);

--
-- 테이블의 인덱스 `showtime`
--
ALTER TABLE `showtime`
  ADD PRIMARY KEY (`showTime_id`);

--
-- 테이블의 인덱스 `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theater_no`);

--
-- 테이블의 인덱스 `ticket_info`
--
ALTER TABLE `ticket_info`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `ticket_id` (`ticket_id`);

--
-- 테이블의 인덱스 `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`type_id`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `booking_info`
--
ALTER TABLE `booking_info`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 테이블의 AUTO_INCREMENT `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 테이블의 AUTO_INCREMENT `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 테이블의 AUTO_INCREMENT `movie_actor`
--
ALTER TABLE `movie_actor`
  MODIFY `movie_actor_rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 테이블의 AUTO_INCREMENT `movie_director`
--
ALTER TABLE `movie_director`
  MODIFY `movie_director_rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 테이블의 AUTO_INCREMENT `movie_genre`
--
ALTER TABLE `movie_genre`
  MODIFY `movie_genre_rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 테이블의 AUTO_INCREMENT `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `review_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 테이블의 AUTO_INCREMENT `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- 테이블의 AUTO_INCREMENT `showtime`
--
ALTER TABLE `showtime`
  MODIFY `showTime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 테이블의 AUTO_INCREMENT `theater`
--
ALTER TABLE `theater`
  MODIFY `theater_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 테이블의 AUTO_INCREMENT `ticket_info`
--
ALTER TABLE `ticket_info`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- 테이블의 AUTO_INCREMENT `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
