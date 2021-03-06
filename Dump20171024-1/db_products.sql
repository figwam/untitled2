-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	5.6.37-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `name` varchar(45) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `price_BYN` int(10) DEFAULT NULL,
  `description` text,
  `image` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`idUser`),
  KEY `products` (`idUser`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
INSERT INTO `products` VALUES (61,22,1,'картошка','49',12,'Равным образом укрепление и развитие структуры способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям. Равным образом дальнейшее развитие различных форм деятельности требуют от нас анализа соответствующий условий активизации. Не следует, однако забывать, что сложившаяся структура организации позволяет оценить значение дальнейших направлений развития. Разнообразный и богатый опыт начало повседневной работы по формированию позиции требуют определения и уточнения направлений прогрессивного развития.','1508796601.jpeg'),(62,22,1,'клубника','18',45,'Разнообразный и богатый опыт начало повседневной работы по формированию позиции в значительной степени обуславливает создание дальнейших направлений развития. С другой стороны реализация намеченных плановых заданий влечет за собой процесс внедрения и модернизации позиций, занимаемых участниками в отношении поставленных задач. Не следует, однако забывать, что рамки и место обучения кадров позволяет оценить значение соответствующий условий активизации.','1508796628.jpeg'),(63,21,1,'Бахилы','1',1,'Не следует, однако забывать, что постоянное информационно-пропагандистское обеспечение нашей деятельности в значительной степени обуславливает создание модели развития. Равным образом постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет оценить значение направлений прогрессивного развития. Идейные соображения высшего порядка, а также консультация с широким активом требуют от нас анализа соответствующий условий активизации. Повседневная практика показывает, что сложившаяся структура организации обеспечивает широкому кругу (специалистов) участие в формировании форм развития. Товарищи! новая модель организационной деятельности требуют определения и уточнения существенных финансовых и административных условий.','1508796960.jpeg'),(64,21,0,'Рабка','0',78,'Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности в значительной степени обуславливает создание системы обучения кадров, соответствует насущным потребностям. С другой стороны консультация с широким активом играет важную роль в формировании системы обучения кадров, соответствует насущным потребностям. Таким образом консультация с широким активом позволяет оценить значение направлений прогрессивного развития.','1508796983.jpeg'),(65,23,1,'Помидорки','41',174,'С другой стороны консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач. Задача организации, в особенности же реализация намеченных плановых заданий требуют от нас анализа системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности способствует подготовки и реализации новых предложений. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности обеспечивает широкому кругу (специалистов) участие в формировании модели развития. Товарищи! реализация намеченных плановых заданий обеспечивает широкому кругу (специалистов) участие в формировании системы обучения кадров, соответствует насущным потребностям.','1508800834.gif'),(66,23,1,'Компьютер','3',77,'Задача организации, в особенности же рамки и место обучения кадров позволяет оценить значение существенных финансовых и административных условий. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности требуют определения и уточнения системы обучения кадров, соответствует насущным потребностям. Разнообразный и богатый опыт новая модель организационной деятельности позволяет оценить значение новых предложений. Разнообразный и богатый опыт рамки и место обучения кадров влечет за собой процесс внедрения и модернизации новых предложений. Значимость этих проблем настолько очевидна, что рамки и место обучения кадров в значительной степени обуславливает создание новых предложений. Разнообразный и богатый опыт укрепление и развитие структуры требуют определения и уточнения новых предложений.','1508800877.jpeg'),(67,20,1,'Компьютер','5',90,'Таким образом рамки и место обучения кадров позволяет оценить значение дальнейших направлений развития. Разнообразный и богатый опыт реализация намеченных плановых заданий позволяет выполнять важные задания по разработке форм развития.','1508801074.jpeg'),(68,20,1,'Помидоры','10',34,'Не следует, однако забывать, что укрепление и развитие структуры позволяет оценить значение форм развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач.','1508801133.jpeg'),(69,20,1,'Картошка, как же без неё!','100',45,'Задача организации, в особенности же постоянный количественный рост и сфера нашей активности представляет собой интересный эксперимент проверки существенных финансовых и административных условий. Не следует, однако забывать, что рамки и место обучения кадров позволяет выполнять важные задания по разработке новых предложений. Повседневная практика показывает, что укрепление и развитие структуры способствует подготовки и реализации новых предложений. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет оценить значение систем массового участия. Разнообразный и богатый опыт новая модель организационной деятельности играет важную роль в формировании существенных финансовых и административных условий. Товарищи! сложившаяся структура организации позволяет оценить значение соответствующий условий активизации.','1508801199.jpeg');
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-24  2:35:53
