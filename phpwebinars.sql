-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: phpwebinars
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (7,'Холодильники'),(8,'Теливизоры'),(9,'Стиральные машины'),(10,'Пылесосы'),(11,'Кондиционеры'),(12,'Духовые шкафы'),(13,'Микроволновые печи'),(14,'Утюги');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `article` varchar(255) DEFAULT NULL,
  `price` double unsigned DEFAULT NULL,
  `amount` int(10) unsigned DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (63,'Холодильник Weissgauff WCD 486 NFB','12341',62990,431,'ШхВхГ: 79.50х180х69.20 см\r\nкласс энергопотребления A+\r\nNo Frost\r\nобщий объем 401 л\r\nинверторный компрессор\r\nобъем холодильной камеры 268 л\r\nобъем морозильной камеры 133 л\r\nоднокомпрессорный\r\nмощность замораживания 16 кг/сутки',7),(65,'Холодильник Weissgauff WRK 2000 WNF','12311',40670,44,'Коротко о товаре\r\nШхВхГ: 60х193.50х67 см\r\nкласс энергопотребления A+\r\nNo Frost\r\nобщий объем 342 л\r\nобъем холодильной камеры 245 л\r\nобъем морозильной камеры 97 л',7),(66,'Холодильник LG DoorCooling+ GA-B509CLWL','444',41990,3,'Коротко о товаре\r\nШхВхГ: 59.50х203х68.20 см\r\nкласс энергопотребления A+\r\nNo Frost\r\nобщий объем 384 л',7),(67,'Холодильник ATLANT ХМ 4008-022','434',15990,2,'\r\nКоротко о товаре\r\nлинейка: SOFT LINE 40 Serie\r\nШхВхГ: 60х142х63 см\r\nкласс энергопотребления A\r\nкапельная система разморозки\r\nобщий объем 244 л',7),(68,'Холодильник LG GA-B419 SDJL','34',33990,34,'\r\nКоротко о товаре\r\nШхВхГ: 59.50х190.70х65.50 см\r\nкласс энергопотребления A+\r\nNo Frost\r\nобщий объем 302 л\r\nинверторный компрессо',7),(69,'Телевизор Xiaomi Mi TV 4S 43 T2 42.5\" (2019)','343',23990,34,'Коротко о товаре\r\n4K UHD (3840x2160), HDR\r\nдиагональ экрана 42.5\"\r\nчастота обновления экрана 60 Гц\r\nSmart TV (Android), Wi-Fi',8),(70,'Телевизор LG 55UM7300 55\" (2019)','5555',34230,43,'Коротко о товаре\r\n4K UHD (3840x2160), HDR\r\nдиагональ экрана 55\", TFT IPS\r\nчастота обновления экрана 50 Гц\r\nSmart TV (webOS), Wi-Fi\r\nмощность звука 20 Вт (2х10 Вт',8),(71,'Телевизор OLED LG OLED55B9P 54.6\" (2019)','34',119990,8,'Коротко о товаре\r\n4K UHD (3840x2160), HDR\r\nдиагональ экрана 54.6\"\r\nчастота обновления экрана 100 Гц\r\nSmart TV (webOS), Wi-Fi',8),(72,'Телевизор OLED LG OLED55CXR 55\" (2020)','345dfa',154990,1,'Коротко о товаре\r\n4K UHD (3840x2160), HDR\r\nдиагональ экрана 55\"\r\nчастота обновления экрана 100 Гц\r\nSmart TV (webOS), Wi-Fi',8),(73,'Стиральная машина Weissgauff WM 4826 D Chrome','342we3',21490,50,'отдельно стоящая\r\nШхГхВ: 59.50х47х85 см\r\nдозагрузка белья отсутствует\r\nзагрузка: 6 кг\r\nотжим при 1200 об/м',9),(74,'Стиральная машина Weissgauff WM 4726 D','343',18990,45,'отдельно стоящая\r\nШхГхВ: 59.50х47х85 см\r\nдозагрузка белья через основной люк\r\nзагрузка: 6 кг\r\nотжим при 1200 об/мин',9),(75,'Стиральная машина Weissgauff WM 40275 TD','5555',26990,33,'отдельно стоящая\r\nШхГхВ: 40х61х87.50 см\r\nдозагрузка белья через основной люк\r\nзагрузка: 7.5 кг',9),(76,'Пылесос LG VK76A02NTL','32reww',6290,2,'Коротко о товаре\r\nсухая уборка\r\nс контейнером 1.50 л\r\nмощность всасывания: 380 Вт\r\nпотребляемая мощность: 2000 Вт\r\nфильтр тонкой очистки в компл',10),(77,'Пылесос Philips FC9573 PowerPro Active','9999sds',11710,2,'\r\nКоротко о товаре\r\nсухая уборка\r\nс контейнером 1.50 л\r\nмощность всасывания: 410 Вт\r\nпотребляемая мощность: 1900 Вт\r\nтурбощетка в комплекте\r\nрегулятор мощности на корпусе',10),(78,'Настенная сплит-система AUX ASW-H09B4/LK-700R1','23ку2',18990,23,'Коротко о товаре\r\nобогрев и охлаждение\r\nрежим вентиляции, поддержания температуры, ночной, осушения воздуха\r\nмощность охлаждения 2700 Вт / обогрева 2800 Вт',11),(79,'Настенная сплит-система Mitsubishi Heavy Industries SRK20ZSPR-S / SRC20ZSPR-S','as43re',29200,23,'Коротко о товаре\r\nобогрев и охлаждение\r\nрежим вентиляции, поддержания температуры, ночной, осушения воздуха\r\nмощность охлаждения 2000 Вт / обогрева 2700 Вт',11),(80,'Настенная сплит-система Electrolux EACS-09HG2/N3','555522eew',25400,23,'Коротко о товаре\r\nобогрев и охлаждение\r\nрежим вентиляции, поддержания температуры, ночной, осушения воздуха\r\nдезодорирующий фильтр, плазменный фильтр, фильтр тонкой очистки\r\nмощность охлаждения 2640 Вт / обогрева 2640 Вт',11),(81,'Электрический духовой шкаф Weissgauff EOY 451 PDBНовинка','wa3dw',17990,2,'\r\nКоротко о товаре\r\nнезависимая установка\r\nШхГхВ: 45х56.50х59.50 см\r\nобъем 50 л\r\n8 режимов нагрева\r\nгидролизная очистка',12),(82,'Электрический духовой шкаф Weissgauff EOV 29 PDX','2erwqe',16990,2,'независимая установка\r\nШхГхВ: 59.50х57.50х59.50 см\r\nобъем 60 л\r\n9 режимов нагрева\r\nмаксимальная температура 250°C\r\nгидролизная очистка',12),(83,'Микроволновая печь LG MS-20R42D','233eer',6790,50,'Коротко о товаре\r\nобъем 20 л\r\nмощность 700 Вт\r\nвнутреннее покрытие камеры: эмаль\r\nкнопочные переключатели\r\nдисплей\r\nсистема равномерного распределения микроволн',13),(84,'Микроволновая печь LG MS-2042DB','22ewe',6990,2,'Коротко о товаре\r\nобъем 20 л\r\nмощность 700 Вт\r\nвнутреннее покрытие камеры: эмаль\r\nсенсорные переключатели\r\nдисплей\r\nсистема равномерного распределения',13),(111,'тест6','9999',5555,1,'',7);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `products_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES (27,111,'orig (1).webp','/upload/products/111/orig (1).webp'),(31,111,'orig (2).webp','/upload/products/111/orig (2).webp'),(32,111,'orig.webp','/upload/products/111/orig.webp'),(34,111,'','/upload/products/111/'),(35,79,'','/upload/products/79/'),(37,63,'orig (1).webp','/upload/products/63/orig (1).webp'),(70,63,'orig (1)_0.webp','/upload/products/63/orig (1)_0.webp'),(71,63,'orig (1)_1.webp','/upload/products/63/orig (1)_1.webp'),(72,63,'orig (2).webp','/upload/products/63/orig (2).webp'),(73,63,'orig.webp','/upload/products/63/orig.webp'),(74,63,'orig (1)_2.webp','/upload/products/63/orig (1)_2.webp'),(75,63,'orig (2)_0.webp','/upload/products/63/orig (2)_0.webp'),(76,63,'orig_0.webp','/upload/products/63/orig_0.webp'),(85,65,'65_85_upload1596364880.jpg','/upload/products/65/65_85_upload1596364880.jpg'),(118,65,'','/upload/products/65/');
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-02 20:11:50
