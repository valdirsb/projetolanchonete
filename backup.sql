-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: lanchonete
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,1,'Casa','Rua 3, Nº 15, 5ª Etapa'),(2,1,'Trabalho','Av. Joaquim Nabuco, 4141');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `adm` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Valdir Barbosa','valdirsb@gmail.com','$2y$10$7YnowQtUe.Muk20ZSIsmauLWer27gsJ0iIc4bQOeiVlTLW7LpXuCi','PKD6283V6QcJbRLKtDEUQ8CxwcaEvLiAkmGePa5x9S8lDZktoORQl5wuX5hV',NULL,1),(2,'valdir','teste@teste.com.br','$2y$10$wxhz82ac/CX0h28T/Dp37uaxjt5O5JkQrwmiEyCYB12auTnriQYKG',NULL,NULL,0),(4,'José Teste','jose@teste.com','$2y$10$4qcZAh4FiSsr.g6vET6J4.6p7dahU00bsfZzm/6dTc5Myl8l.2uAe',NULL,NULL,0);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (7,'Pastéis','/media/images/categories/1593026395.jpeg'),(8,'Sanduiches','/media/images/categories/1593026435.jpeg'),(9,'Lanches e porções','/media/images/categories/1593026459.jpeg'),(10,'Sobremesas','/media/images/categories/1593026490.jpeg'),(11,'Bebidas','/media/images/categories/1593026561.jpeg'),(12,'Combos','/media/images/categories/1593026592.jpeg');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `obs` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` VALUES (1,1,16,2,10.00,20.00,NULL),(2,1,22,2,5.00,10.00,NULL),(3,2,16,1,10.00,10.00,NULL),(4,2,24,3,5.00,15.00,NULL),(5,3,16,2,1.00,1.00,'la la la'),(6,5,16,2,3.00,6.00,'sem obs'),(7,5,22,3,3.00,9.00,'sem mais obs'),(8,6,25,4,8.00,32.00,'sem obs lalala'),(9,7,25,4,8.00,32.00,'sem obs lalala'),(10,7,36,2,3.50,7.00,'sem mais  asa obs'),(11,8,25,4,8.00,32.00,'sem obs lalala'),(12,8,36,2,3.50,7.00,'sem mais  asa obs'),(13,9,25,3,8.00,24.00,'Hamburguer OBS'),(14,9,19,2,5.00,10.00,'Pastel de frango com catupiry OBS'),(15,9,45,2,3.00,6.00,'Refrigerante OBS'),(16,10,25,4,8.00,32.00,'outro Hamburguer OBS'),(17,10,19,3,5.00,15.00,'outro Pastel de frango com catupiry OBS'),(18,10,45,3,3.00,9.00,'mais um Refrigerante OBS'),(19,11,26,2,10.00,20.00,'outro Hamburguer OBS'),(20,11,20,3,5.00,15.00,'outro Pastel de frango com catupiry OBS'),(21,11,45,3,3.00,9.00,'mais um Refrigerante OBS'),(22,12,26,2,10.00,20.00,'outro Hamburguer OBS'),(23,12,20,3,5.00,15.00,'outro Pastel de frango com catupiry OBS'),(24,12,45,3,3.00,9.00,'mais um Refrigerante OBS'),(25,13,25,2,8.00,16.00,NULL),(26,13,19,3,5.00,15.00,NULL),(27,14,25,2,8.00,16.00,NULL),(28,14,19,3,5.00,15.00,NULL),(29,14,43,2,2.50,5.00,NULL),(30,15,16,3,3.00,9.00,'observações do pastel de frango'),(31,15,32,2,16.00,32.00,'informações do x camarão'),(32,15,44,2,4.00,8.00,'bebida coca cola'),(33,15,48,1,39.99,39.99,'um combo especial'),(34,16,81,2,8.00,16.00,'Quero bastante camarão porque meu amor adora camarão'),(35,16,35,3,8.00,24.00,'Minha princesa adora batata frita'),(36,16,32,1,16.00,16.00,'Esse é meu'),(37,17,81,2,8.00,16.00,'Quero bastante camarão porque meu amor adora camarão'),(38,17,35,3,8.00,24.00,'Minha princesa adora batata frita'),(39,17,32,1,16.00,16.00,'Esse é meu'),(40,17,26,1,10.00,10.00,'Mais um'),(41,18,32,1,16.00,16.00,'Esse é meu'),(42,18,26,1,10.00,10.00,'Mais um');
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT 1,
  `valor` decimal(10,2) NOT NULL,
  `cartao` tinyint(1) DEFAULT 0,
  `dinheiro` tinyint(1) DEFAULT 0,
  `troco` decimal(10,2) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,1,4,20.00,0,0,NULL,NULL,NULL,'2020-07-09 03:41:02'),(2,1,2,3,20.00,0,0,NULL,NULL,NULL,'2020-07-10 02:45:26'),(3,11,1,4,250.00,0,1,NULL,NULL,NULL,'2020-07-10 02:45:56'),(4,12,1,4,50.00,0,1,100.00,NULL,NULL,'2020-07-09 03:41:08'),(5,1,1,2,50.00,0,0,NULL,NULL,NULL,'2020-07-10 02:45:21'),(6,15,1,1,0.00,1,0,NULL,NULL,NULL,'2020-07-09 04:28:11'),(7,1,1,1,39.00,0,0,NULL,NULL,NULL,'2020-07-09 04:28:14'),(8,13,1,5,39.00,1,0,NULL,NULL,NULL,'2020-07-09 03:33:41'),(9,1,1,1,40.00,0,0,NULL,NULL,NULL,'2020-07-09 04:28:17'),(10,8,1,5,56.00,0,0,NULL,NULL,'2020-07-08 05:49:40','2020-07-09 03:40:14'),(11,1,1,4,44.00,0,0,NULL,NULL,'2020-07-08 08:02:31','2020-07-08 15:37:24'),(12,1,1,4,44.00,0,0,NULL,NULL,'2020-07-08 03:11:51','2020-07-09 03:34:00'),(13,1,1,5,31.00,0,0,NULL,NULL,'2020-07-10 03:28:25','2020-07-10 23:36:34'),(14,1,1,1,36.00,0,1,80.00,NULL,'2020-07-10 03:54:32','2020-07-10 03:54:32'),(15,1,1,1,88.99,1,0,0.00,NULL,'2020-07-10 04:03:30','2020-07-10 04:03:30'),(16,1,1,4,56.00,1,0,0.00,NULL,'2020-07-10 23:33:07','2020-07-10 23:36:19'),(17,1,1,1,66.00,1,0,0.00,'Rapido','2020-07-10 23:46:59','2020-07-10 23:46:59'),(18,1,1,1,26.00,0,1,50.00,NULL,'2020-07-10 23:48:05','2020-07-10 23:48:05');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `produto` varchar(50) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `disponivel` tinyint(1) NOT NULL,
  `imagem` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (16,7,'Pastel de Frango','Frango desfiado, milho e ervilha',3.00,1,'/media/images/1593027439.jpeg'),(17,7,'Pastel de Frango com Bacon','Frango desfiado, queijo mussarela, bacon, milho e ervilha',5.00,1,'/media/images/1593027614.jpeg'),(18,7,'Pastel de Frango com Queijo Coalho','Frango desfiado, queijo coalho, milho e ervilha',4.00,1,NULL),(19,7,'Pastel de Frango com Catupiry','Frango desfiado, catupiry, milho e ervilha',5.00,1,'/media/images/1593027952.jpeg'),(20,7,'Pastel de Frango Defumado','Frango defumado com cream cheese',5.00,1,NULL),(21,7,'Pastel de Frango Especial','Frango, queijo prato, coalho, ovos de codorna, milho e ervilha',5.00,1,NULL),(22,7,'Pastel de Carne','Carne moída, milho e ervilha',3.00,1,'/media/images/1593029382.jpeg'),(23,7,'Pastel de Calabresa','Calabresa e queijo',4.00,1,'/media/images/1593029502.jpeg'),(24,7,'Pastel de Charque','Charque desfiada',5.00,1,'/media/images/1593029635.jpeg'),(25,8,'Hambúrguer','Carne gourmet, farofa de alho, tomate, cebola caramelizada, alface e molho especial',8.00,1,'/media/images/1593029887.jpeg'),(26,8,'X-Burguer','Carne gourmet, queijo, presunto, farofa de alho, tomate, cebola caramelizada, alface e molho especial',10.00,1,'/media/images/1593032953.jpeg'),(27,8,'X-Egg Burguer','Carne gourmet, queijo, ovo, farofa de alho, tomate, cebola caramelizada, alface e molho especial',10.00,1,'/media/images/1593033134.jpeg'),(28,8,'X-Calabresa','Carne gourmet, queijo, calabresa, farofa de alho, tomate, cebola caramelizada, alface e molho especial',11.00,1,NULL),(29,8,'X-Bacon','Carne gourmet, queijo,bacon, farofa de alho, tomate, cebola caramelizada, alface e molho especial',11.00,1,'/media/images/1593038367.jpeg'),(30,8,'X-Filé de Frango','Carne gourmet de frango, queijo, presunto, farofa de alho, tomate, cebola caramelizada, alface e molho especial',9.00,1,'/media/images/1593038497.jpeg'),(31,8,'X-Coração','Carne gourmet, queijo, coração, farofa de alho, tomate, cebola caramelizada, alface e molho especial',15.00,1,NULL),(32,8,'X-Camarão','Carne gourmet, queijo, camarão, farofa de alho, tomate, cebola caramelizada, alface e molho especial',16.00,1,'/media/images/1593038687.jpeg'),(33,9,'Batata Frita Pequena','Batata frita com cheddar e bacon',3.00,1,'/media/images/1593038965.jpeg'),(34,9,'Batata Frita Média','Batata frita com cheddar e bacon',5.00,1,'/media/images/1593038986.jpeg'),(35,9,'Batata Frita Grande','Batata frita com cheddar e bacon',8.00,1,'/media/images/1593039014.jpeg'),(36,9,'Coxinha de frango','Coxinha de batata, frango',3.50,1,'/media/images/1593039313.jpeg'),(37,9,'Coxinha de frango com catupiry','Coxinha de batata, frango, catupiry',4.00,1,'/media/images/1593039407.jpeg'),(38,9,'Coxinha de frango Creme Cheese','Coxinha de batata, frango, creme cheese',4.00,1,NULL),(39,9,'Coxinha de Charque','Coxinha de batata, charque',5.00,1,'/media/images/1593039577.jpeg'),(40,10,'Mousse de Maracujá','Mousse de Maracujá',0.00,1,'/media/images/1593039728.jpeg'),(41,10,'Pudim','Pudim',0.00,1,'/media/images/1593039790.jpeg'),(42,10,'Brawnie','Brawnie',0.00,1,'/media/images/1593039908.jpeg'),(43,11,'Refrigerante Lata (220ml)','Refrigerante Lata 220ml',2.50,1,'/media/images/1593040115.jpeg'),(44,11,'Refrigerante Lata (350ml)','Refrigerante Lata 350ml',4.00,1,'/media/images/1593040182.jpeg'),(45,11,'Refrigerante KS','Refrigerante KS 290ml',3.00,1,'/media/images/1593040272.jpeg'),(46,12,'Combo 1','01 Hambúrguer + Batata Pequena + 01 Refri Lata',13.99,1,'/media/images/1593040926.jpeg'),(47,12,'Combo 2','01 X-Búrguer + Batata Pequena + 01 Refri Lata',15.99,1,'/media/images/1593040975.jpeg'),(48,12,'Combo 3','03 X-Búrguer + Batata Grande + 01 Refri de 1 Litro',39.99,1,'/media/images/1593041080.jpeg'),(49,12,'Combo 4','02 Coxinha + Batata Média + 01 Refri Lata',12.99,1,'/media/images/1593041199.jpeg'),(61,7,'Pastel Nordestino','Charque com queijo coalho',6.00,1,NULL),(62,7,'Pastel Medalhão','Carne moída, mussarela e bacon',5.00,1,NULL),(63,7,'Pastel de carne com queijo','Carne moída, queijo prato, milho e ervilha',5.00,1,NULL),(64,7,'Pastel de carne de sol com queijo','Carne de sol desfiada com queijo coalho',6.00,1,NULL),(65,7,'Pastel Sertanejo','Charque desfiada, carne de sol, queijo coalho e ovo de codorna',7.00,1,NULL),(66,7,'Pastel Paulistano','Carne, calabresa, queijo coalho, ovo de codorna, milho e ervilha',5.00,1,NULL),(67,7,'Pastel de carne especial','Carne, charque desfiada, queijo coalho, milho e ervilha',5.00,1,NULL),(68,7,'Pastel  de queijo coalho','Queijo coalho',3.00,1,NULL),(69,7,'Pastel Misto','Queijo e presunto',3.00,1,NULL),(70,7,'Pastel Dois queijos','Mussarela e catupiry',4.00,1,NULL),(71,7,'Pastel Três queijos','Queijo coalho, mussarela e prato',5.00,1,NULL),(72,7,'Pastel a moda da casa','Mussarela, presunto, bacon e azeitona',5.00,1,NULL),(73,7,'Pastel Pizza','Queijo, presunto, calabresa, tomate e orégano',5.00,1,NULL),(74,7,'Pastel Italiano','Queijo, mussarela e molho de tomate',4.00,1,NULL),(75,7,'Pastel Portuguesa','Mussarela , presunto, ovo, azeitona, pimenta, cebola e tomate',4.00,1,NULL),(76,7,'Pastel de Camarão','Bobó de camarão',10.00,1,NULL),(77,7,'Pastel de Camarão com catupiry','Bobó de camarão com catupiry',8.00,1,NULL),(78,7,'Pastel de Camarão com mussarela','Camarão frito, mussarela e orégano',8.00,1,NULL),(79,7,'Pastel de Camarão com queijo coalho','Camarão com queijo coalho',8.00,1,NULL),(80,7,'Pastel de Camarão com dois queijos','Camarão, queijo prato e cheddar',10.00,1,NULL),(81,7,'Pastel de Camarão especial','Camarão com cream cheese',8.00,1,NULL),(82,7,'Pastel de Bacalhau com  cream cheese','Bacalhau desfiado e cream cheese',8.00,1,NULL),(83,7,'Pastel Romeu e Julieta','Queijo e Goiabada',4.00,1,NULL),(84,7,'Pastel Cartola','Banana, queijo, canela e açúcar',4.00,1,NULL),(85,9,'Coxinha de frango com cheedar','Coxinha de batata,  frango e cheedar',4.00,1,NULL),(86,9,'Coxinha de frango com queijo','Coxinha de batata, frango e queijo',4.00,1,NULL),(87,9,'Coxinha de charque com cream cheese','Coxinha de batata, charque e cream cheese',6.00,1,NULL),(88,9,'Coxinha de charque com cheddar','Coxinha de batata, charque e cheddar',6.00,1,NULL),(89,9,'Coxinha de charque com catupiry','Coxinha de batata, charque e catupiry',6.00,1,NULL),(90,9,'Coxinha de charque com queijo','Coxinha de batata, charque e queijo',6.00,1,NULL),(91,9,'Coxinha de Camarão','Coxinha de batata e camarão',6.00,1,NULL),(92,9,'Coxinha de Camarão com cream cheese','Coxinha de batata, camarão e cream cheese',6.00,1,NULL),(93,9,'Coxinha de Camarão com cheddar','Coxinha de Batata, camarão e cheddar',6.00,1,NULL),(94,9,'Coxinha de Camarão com catupiry','Coxinha de batata, camarão e catupiry',6.00,1,NULL),(95,9,'Coxinha de bobó de camarão','Coxinha de batata e bobó de camarão',6.00,1,NULL),(96,9,'Coxinha Nordestinha','Coxinha de batata nordestina',7.00,1,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Aberto'),(2,'Preparando'),(3,'Saiu para entrega'),(4,'Pedido Entregue'),(5,'Pedido Cancelado');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT '0',
  `address` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Valdir','valdirsb@gmail.com','$2y$10$Mc1uiQyIDzUDYJ7CJHkhRepmsVAy4QpH6/HD.h6SUm7JuDILpfp.K','0','Rua 3, nº 15, 5ª Etapa de Rio Doce, Olinda - PE'),(8,'Sandra','sandraeu26@gmail.com','$2y$10$sS1b1rp6zLVzQ/gZCgwK7OjbS.lDFo8LatrROjrV/T.5K4eJ3sgBW','0','Rua da patativa número 26'),(9,'Sandro','sandro.projetoss@gmail.com','$2y$10$TC7MS5swq1skVlyEGTuCeercudLEXY8gBt7/xnvMWWBeYDhuy3oKq','0','Ouro preto'),(10,'Milena Fernanda','milenamotaalbuquerque@gmail.com','$2y$10$Z8gsMreSkk9XGsamR7cJ6en/5U3GSciUSB2rdEWzOeZRZW/fCvTiG','0','Rua curupira, número 243 b'),(11,'jandi de souza santos','jandiprojetos@hotmail.com','$2y$10$XQ3ZsZK7xbYZkVd1yTq9Ku6sHiFHLkFAxOQKbev/3kfKhl.nJBwSK','0','rio de janeiro, 104 - bairro novo do carmelo - camaragibe - PE.'),(12,'Hemeson','hemesonoliveira04@gmail.com','$2y$10$dWYP8X74NDNdeHBkRDYZX.oK9p.sfs59DJSzD3.rBEE/mBxFQ.vLu','0','Rua Camburio - Vasco da Gama \r\nN* 100'),(13,'Leonardo Favilla','leonardo_paulista_29@hotmail.com','$2y$10$/coHFjs.QS.IbdlFuhINx.7WgG/YCsdBahkks4BACqTqMH6dWYxmG','0','Rua jose pessoa 345'),(14,'dsfds','sandro.projetos@hotmail.com','$2y$10$XosJKSgTpqC8krQ.//5V7.5rVoPe28W9DcnDuOzfktRhgABM6.Q6S','0','dfadfadfad'),(15,'Erick','eriick674@gmail.com','$2y$10$JQeTqPxWX.Tc/bLEtQaHku0ifeKqE2UjgFqGrc26azOGuNVyKoLDy','0','salgadinho');
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

-- Dump completed on 2020-07-12 17:13:45
