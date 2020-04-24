-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: lms_team1
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL COMMENT '과목 ID',
  `name` varchar(255) NOT NULL COMMENT '과목 이름',
  `capacity` int(11) NOT NULL COMMENT '정원',
  `master_id` int(11) DEFAULT NULL COMMENT '담당 강사 유저 ID',
  PRIMARY KEY (`class_id`),
  KEY `master_id_idx` (`master_id`) /*!80000 INVISIBLE */,
  CONSTRAINT `classes_users_master_id` FOREIGN KEY (`master_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='과목 목록 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (191001,'DB',40,NULL),(191002,'NETWORK',40,NULL),(192004,'com',30,2),(192005,'coding',40,2),(192009,'TEST과목',3,2),(192099,'실험',8,6),(19203123,'asddsad',-1,2);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture_keywords`
--

DROP TABLE IF EXISTS `lecture_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecture_keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '키워드 ID',
  `lecture_id` int(11) NOT NULL COMMENT '소속 강의 ID',
  `keyword` varchar(255) NOT NULL COMMENT '키워드',
  `weight` float NOT NULL COMMENT '중요도',
  PRIMARY KEY (`keyword_id`),
  UNIQUE KEY `keyword_id_UNIQUE` (`keyword_id`),
  KEY `lecturekeyword_lecture_id_idx` (`lecture_id`),
  CONSTRAINT `lecturekeywords_lecture_id` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='강의 키워드 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture_keywords`
--

LOCK TABLES `lecture_keywords` WRITE;
/*!40000 ALTER TABLE `lecture_keywords` DISABLE KEYS */;
INSERT INTO `lecture_keywords` VALUES (24,1910016,'키워드1',2),(25,1910016,'키워드2',2),(26,1910016,'키워드3',3),(27,1910016,'키워드1',1),(30,1920991,'키1',1),(31,1920991,'키2',2),(32,1920991,'키3',3),(33,1920991,'키4',4);
/*!40000 ALTER TABLE `lecture_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lectures`
--

DROP TABLE IF EXISTS `lectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lectures` (
  `lecture_id` int(11) NOT NULL COMMENT '강의 ID',
  `name` varchar(255) NOT NULL COMMENT '강의 이름',
  `start_time` datetime NOT NULL COMMENT '시작 시간',
  `end_time` datetime NOT NULL COMMENT '종료 시간',
  `class_id` int(11) NOT NULL COMMENT '소속 과목 ID',
  PRIMARY KEY (`lecture_id`),
  KEY `class_id_idx` (`class_id`),
  CONSTRAINT `lectures_classes_class_id` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='강의 목록 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lectures`
--

LOCK TABLES `lectures` WRITE;
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;
INSERT INTO `lectures` VALUES (1910011,'sql','1999-04-21 00:00:00','2019-12-31 00:00:00',191001),(1910012,'dml','2019-04-30 00:00:00','2019-12-03 00:00:00',191001),(1910013,'transaction','2019-01-01 01:01:01','2019-12-31 01:01:01',191001),(1910014,'tuning','2019-12-01 01:01:01','2019-12-07 02:03:04',191001),(1910015,'ERD','2019-12-05 03:00:00','2019-12-06 03:00:00',191001),(1910016,'1강중복','1993-03-04 00:00:00','2019-12-12 00:00:00',191001),(1910019,'test','1993-03-04 00:00:00','1993-03-03 00:00:00',191001),(1920991,'1강','1993-03-04 00:00:00','2019-12-12 00:00:00',192099),(1920992,'2강','1993-03-04 00:00:00','2019-12-12 00:00:00',192099),(2378912,'test','2019-12-12 00:00:00','2019-10-10 00:00:00',191001);
/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parameter` (
  `question_id` int(11) NOT NULL,
  `key_value` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `param1` text,
  `param2` text,
  `param3` text,
  `param4` text,
  `param5` text,
  `answer` text,
  PRIMARY KEY (`question_id`,`key_value`),
  CONSTRAINT `param_questions_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (19100111,1,2,'0.2','-0.6','0','0','0','1'),(19100111,2,2,'0.3','2.5','0','0','0','2');
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_bank`
--

DROP TABLE IF EXISTS `question_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `question` varchar(1023) NOT NULL,
  `bogi` text,
  `answer` text NOT NULL,
  `difficulty` float NOT NULL,
  `real_difficulty` float DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='문제 은행';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_bank`
--

LOCK TABLES `question_bank` WRITE;
/*!40000 ALTER TABLE `question_bank` DISABLE KEYS */;
INSERT INTO `question_bank` VALUES (1,0,19100112,'aaa',NULL,'aaa',4,3),(4,0,19100112,'aaa',NULL,'aaa',4,10),(5,0,19100112,'aaa',NULL,'aaa',4,10),(6,0,19100113,'문제를 맞춰라',NULL,'1',2,10),(8,0,5,'객관',NULL,'3',9,0);
/*!40000 ALTER TABLE `question_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_bank_keyword`
--

DROP TABLE IF EXISTS `question_bank_keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_bank_keyword` (
  `bank_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `score_portion` float NOT NULL,
  PRIMARY KEY (`bank_id`,`keyword`),
  CONSTRAINT `bank_bankkeyword_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `question_bank` (`bank_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_bank_keyword`
--

LOCK TABLES `question_bank_keyword` WRITE;
/*!40000 ALTER TABLE `question_bank_keyword` DISABLE KEYS */;
INSERT INTO `question_bank_keyword` VALUES (1,'DB',5),(1,'OS',15),(1,'System',10),(8,'키워드3',10);
/*!40000 ALTER TABLE `question_bank_keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_keywords`
--

DROP TABLE IF EXISTS `question_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_keywords` (
  `question_id` int(11) NOT NULL COMMENT '문항 ID',
  `keyword` varchar(255) NOT NULL COMMENT '키워드',
  `lecture_id` int(11) NOT NULL,
  `score_portion` float NOT NULL COMMENT '키워드 배점',
  PRIMARY KEY (`question_id`,`lecture_id`,`keyword`),
  KEY `questionkeywords_lectures_lecture_id_idx` (`lecture_id`),
  KEY `qk_lk_keyword_idx` (`keyword`),
  CONSTRAINT `questionkeywords_lectures_lecture_id` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questionkeywords_questions_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='문항 키워드 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_keywords`
--

LOCK TABLES `question_keywords` WRITE;
/*!40000 ALTER TABLE `question_keywords` DISABLE KEYS */;
INSERT INTO `question_keywords` VALUES (19100112,'DB',1910011,5),(19100112,'OS',1910011,15),(19100112,'System',1910011,10);
/*!40000 ALTER TABLE `question_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_log`
--

DROP TABLE IF EXISTS `question_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_log` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `q_answer` varchar(45) NOT NULL,
  `s_answer` varchar(45) DEFAULT NULL,
  `result` int(11) NOT NULL,
  PRIMARY KEY (`question_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='temporary';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_log`
--

LOCK TABLES `question_log` WRITE;
/*!40000 ALTER TABLE `question_log` DISABLE KEYS */;
INSERT INTO `question_log` VALUES (1,1,'단답','단답',1),(1,2,'단답','asdf',0),(11,1,'단답2','단답1',0),(11,3,'단답2','단답2',1),(19100111,1,'bb','bb',1),(19100111,3,'bb','cc',0),(19100111,4,'bb','cc',0),(19100112,1,'aaa','aaa',1),(19100112,3,'aaa','bbb',0),(19100112,5,'aaa','1',0),(19100113,1,'1','2',0),(19100142,1,'11','단답2',0),(19100142,3,'11','단답2',0);
/*!40000 ALTER TABLE `question_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL COMMENT '문항 ID',
  `type` int(11) NOT NULL COMMENT '문항 유형',
  `question` varchar(1023) NOT NULL COMMENT '문제',
  `bogi` text COMMENT '보기',
  `answer` text NOT NULL COMMENT '답',
  `difficulty` float NOT NULL COMMENT '난이도',
  `real_difficulty` float NOT NULL DEFAULT '0' COMMENT '실질 난이도',
  `lecture_id` int(11) NOT NULL COMMENT '소속 강의 ID',
  PRIMARY KEY (`question_id`),
  KEY `questions_lecture_lecture_id_idx` (`lecture_id`),
  CONSTRAINT `questions_lectures_lecture_id` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`lecture_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='강의 아이템 - 문항 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (123,2,'123','','',1,0,1910011),(19100111,2,'1111','','',1,0,1910011),(19100112,0,'aaa','','aaa',4,6.66667,1910011),(19100141,1,'문제1','1<br/>2<br/>3<br/>4<br/>5','1',1,0,1910014),(19100142,1,'문제2','11<br/>21<br/>31<br/>41<br/>51','11',2,10,1910014);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_classes`
--

DROP TABLE IF EXISTS `user_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_classes` (
  `role` varchar(255) NOT NULL COMMENT '강사/학생 역할',
  `class_id` int(11) NOT NULL COMMENT '과목 ID',
  `user_id` int(11) NOT NULL COMMENT '유저 ID',
  PRIMARY KEY (`class_id`,`user_id`),
  KEY `user_id_idx` (`user_id`) /*!80000 INVISIBLE */,
  CONSTRAINT `userclasses_classes_class_id` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userclasses_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='과목-유저 매핑 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_classes`
--

LOCK TABLES `user_classes` WRITE;
/*!40000 ALTER TABLE `user_classes` DISABLE KEYS */;
INSERT INTO `user_classes` VALUES ('student',191001,1),('student',191001,2),('student',191001,3),('student',191001,4),('student',191001,5),('student',191002,1),('student',192099,5);
/*!40000 ALTER TABLE `user_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '유저 ID',
  `email` varchar(255) NOT NULL COMMENT '이메일',
  `password` varchar(255) NOT NULL COMMENT '비밀번호',
  `type` int(11) NOT NULL COMMENT '강사/학생 유형',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='유저 목록 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'1111@naver.com','1111',0),(2,'2222@naver.com','2222',1),(3,'3333@naver.com','3333',0),(4,'4444@naver.com','4444',0),(5,'5555@naver.com','5555',0),(6,'6666@naver.com','6666',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-24 14:29:57
