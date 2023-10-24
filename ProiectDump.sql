-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: proiect
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (6,'M',12,'2023-10-23 00:00:00'),(8,'ras',14,'2023-10-23 15:30:40'),(10,'rhddd',10,'2023-10-23 16:34:03');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'sosig132@gmail.com','Andre Munteanu','092c09a7b3f6ea20267ad6ff476866bf71cebec82bd0333b55f66c769d829837989b1c9b313b5c5dd7b257f8801b5704a5fff9239af118655511cc63c41f245e1iYYRWcGU9XOY00mCbdJokhvrCR8zTbVHmA7hLsRqWU=','6893deb64cb801f9c0e9860ff74732a2.png','0741370795'),(11,'andremunteanu2@gmail.com','Alex Munteanu','1a7e052eb056337858ef84aabc27e539f9726923ec26982ec328306f05af5287de64b1db2a79e3d8559dd7fadb0119e9fdfdd5505485cf82aded0b01fb8e6381xfXhSb7Zf5Le5slfMx4dV4hjgQp33YdzRO7VoZPyjZY=','c09e7ca6392a79a801441a1bbd56ba32.png','0727122142'),(12,'johndoe@gmail.com','John Does','e13b75f3f65d97076e9ed6bc6c9fec68b2b9307ce712f106c4fb529ef266a8e0c3373fda315fe58b3904a092aeee42916b80e767d76eb42013fdee5df26dd890TfxywhIon8bIt6bpczeo/sVQIlR9OnW82bY/ASu7uQU=','34f53d501d5af9652d7449acd1208698.png','0761380895'),(14,'l@l.l','MASFIUFNas','dfe0b8b3e3a12cd52c3bb3b3ac7c8895214378f471dafcd1e766bf759cf4785536a2d8e7ab577ef630f290ed7f86fcdb538c40d42751ae79994bfbdd1a582774g0AsifnZX3LkL9QhVpgKm92WQEiWC3exiaZxQ5gGek0=','default.png','0741370798'),(15,'andre.munteanu@s.unibuc.ro','Andre Munteanu','0f8d40927d1b3aab4f5621a445768b9e765ddd82d7d065a1b0a33fafbab1ec14123abcf4f13e71050b1c199baf112c1e5b5498630982740f2f63ac4908de7b7el/v5eD/1bbVDBDZ/m5Yw7X5X6DT7ZRAsn6aBDZS5LbI=','8c98642807b36d8328c9be58e05c43d5.png','0741370787');
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

-- Dump completed on 2023-10-24  9:47:32
