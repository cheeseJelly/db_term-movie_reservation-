-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 17-06-24 20:20 
-- 서버 버전: 5.1.41
-- PHP 버전: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `db_term`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `booking_info`
--

CREATE TABLE IF NOT EXISTS `booking_info` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_type` varchar(30) CHARACTER SET ucs2 NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `movie_no` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `playMinutes` int(11) NOT NULL,
  PRIMARY KEY (`movie_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie_actor`
--

CREATE TABLE IF NOT EXISTS `movie_actor` (
  `movie_actor_rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_no` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_actor_rel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie_director`
--

CREATE TABLE IF NOT EXISTS `movie_director` (
  `movie_director_rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_no` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_director_rel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `movie_genre`
--

CREATE TABLE IF NOT EXISTS `movie_genre` (
  `movie_genre_rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_no` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_genre_rel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `people_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`people_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `review_no` int(11) NOT NULL AUTO_INCREMENT,
  `user_no` int(11) NOT NULL,
  `movie_no` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`review_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `showtime`
--

CREATE TABLE IF NOT EXISTS `showtime` (
  `showTime_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_no` int(11) NOT NULL,
  `theater_no` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`showTime_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `theater`
--

CREATE TABLE IF NOT EXISTS `theater` (
  `theater_no` int(11) NOT NULL AUTO_INCREMENT,
  `theater_name` varchar(100) NOT NULL,
  `max_row` int(11) NOT NULL,
  `max_col` int(11) NOT NULL,
  PRIMARY KEY (`theater_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `ticket_info`
--

CREATE TABLE IF NOT EXISTS `ticket_info` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `showtime_id` int(11) NOT NULL,
  `seat_no` varchar(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `ticket_type`
--

CREATE TABLE IF NOT EXISTS `ticket_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `user_no` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
