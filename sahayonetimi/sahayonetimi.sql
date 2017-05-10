-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: sahayonetimi.czcxelqgoz35.eu-central-1.rds.amazonaws.com    Database: sahayonetimi
-- ------------------------------------------------------
-- Server version	5.6.27-log

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `appointmentsID` int(11) NOT NULL AUTO_INCREMENT,
  `customerdealersID` int(11) NOT NULL,
  `appointmentDate` datetime NOT NULL,
  `not` mediumtext NOT NULL,
  `dateAdd` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `cdtype` tinyint(1) NOT NULL,
  PRIMARY KEY (`appointmentsID`),
  KEY `index1` (`worldID`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargocase`
--

DROP TABLE IF EXISTS `cargocase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargocase` (
  `cargocaseID` int(11) NOT NULL AUTO_INCREMENT,
  `warehouseID` int(11) NOT NULL,
  `salescompleteID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`cargocaseID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargocase`
--

LOCK TABLES `cargocase` WRITE;
/*!40000 ALTER TABLE `cargocase` DISABLE KEYS */;
INSERT INTO `cargocase` VALUES (1,1,24,14,1,2),(2,2,23,14,1,0),(3,1,33,14,1,2),(4,2,35,14,1,0),(5,2,37,14,1,0),(6,1,39,14,1,2),(7,1,38,14,1,2),(8,1,45,14,1,2);
/*!40000 ALTER TABLE `cargocase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(35) NOT NULL DEFAULT '',
  `state` char(20) NOT NULL DEFAULT '',
  `code` varchar(2) CHARACTER SET utf8 NOT NULL,
  `areaCode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'Kabul','Kabol','AF',''),(2,'Qandahar','Qandahar','AF','22'),(3,'Herat','Herat','AF',''),(4,'Mazar-e-Sharif','Balkh','AF','25'),(5,'Amsterdam','Noord-Holland','NL','20'),(6,'Rotterdam','Zuid-Holland','NL','10'),(7,'Haag','Zuid-Holland','NL',NULL),(8,'Utrecht','Utrecht','NL','30'),(9,'Eindhoven','Noord-Brabant','NL','40'),(10,'Tilburg','Noord-Brabant','NL','13'),(11,'Groningen','Groningen','NL','50'),(12,'Breda','Noord-Brabant','NL','76'),(13,'Apeldoorn','Gelderland','NL','55'),(14,'Nijmegen','Gelderland','NL','24'),(15,'Enschede','Overijssel','NL','53'),(16,'Haarlem','Noord-Holland','NL','23'),(17,'Almere','Flevoland','NL','36'),(18,'Arnhem','Gelderland','NL','26'),(19,'Zaanstad','Noord-Holland','NL',NULL),(20,'Â´s-Hertogenbosch','Noord-Brabant','NL',NULL),(21,'Amersfoort','Utrecht','NL','33'),(22,'Maastricht','Limburg','NL','43'),(23,'Dordrecht','Zuid-Holland','NL','78'),(24,'Leiden','Zuid-Holland','NL','71'),(25,'Haarlemmermeer','Noord-Holland','NL',NULL),(26,'Zoetermeer','Zuid-Holland','NL','79'),(27,'Emmen','Drenthe','NL','591'),(28,'Zwolle','Overijssel','NL','38'),(29,'Ede','Gelderland','NL','318'),(30,'Delft','Zuid-Holland','NL','15'),(31,'Heerlen','Limburg','NL',NULL),(32,'Alkmaar','Noord-Holland','NL',NULL),(34,'Tirana','Tirana','AL',''),(35,'Alger','Alger','DZ',NULL),(36,'Oran','Oran','DZ','41'),(37,'Constantine','Constantine','DZ','31'),(38,'Annaba','Annaba','DZ','38'),(39,'Batna','Batna','DZ','33'),(40,'SÃ©tif','SÃ©tif','DZ',NULL),(41,'Sidi Bel AbbÃ¨s','Sidi Bel AbbÃ¨s','DZ',NULL),(42,'Skikda','Skikda','DZ','38'),(43,'Biskra','Biskra','DZ',NULL),(44,'Blida (el-Boulaida)','Blida','DZ',NULL),(45,'BÃ©jaÃ¯a','BÃ©jaÃ¯a','DZ',NULL),(46,'Mostaganem','Mostaganem','DZ',NULL),(47,'TÃ©bessa','TÃ©bessa','DZ',NULL),(48,'Tlemcen (Tilimsen)','Tlemcen','DZ',NULL),(49,'BÃ©char','BÃ©char','DZ',NULL),(50,'Tiaret','Tiaret','DZ',NULL),(51,'Ech-Chleff (el-Asnam)','Chlef','DZ',NULL),(52,'GhardaÃ¯a','GhardaÃ¯a','DZ',NULL),(53,'Tafuna','Tutuila','AS',NULL),(54,'Fagatogo','Tutuila','AS',NULL),(55,'Andorra la Vella','Andorra la Vella','AD',''),(56,'Luanda','Luanda','AO',NULL),(57,'Huambo','Huambo','AO',NULL),(58,'Lobito','Benguela','AO',NULL),(59,'Benguela','Benguela','AO',NULL),(60,'Namibe','Namibe','AO',NULL),(61,'South Hill','Â–','AI',''),(62,'The Valley','Â–','AI',NULL),(63,'Saint JohnÂ´s','St John','AG','268'),(64,'Dubai','Dubai','AE','4'),(65,'Abu Dhabi','Abu Dhabi','AE','2'),(66,'Sharja','Sharja','AE',''),(67,'al-Ayn','Abu Dhabi','AE',''),(68,'Ajman','Ajman','AE','6'),(69,'Buenos Aires','Distrito Federal','AR','11'),(70,'La Matanza','Buenos Aires','AR',NULL),(71,'CÃ³rdoba','CÃ³rdoba','AR',NULL),(72,'Rosario','Santa FÃ©','AR','341'),(73,'Lomas de Zamora','Buenos Aires','AR',NULL),(74,'Quilmes','Buenos Aires','AR',NULL),(75,'Almirante Brown','Buenos Aires','AR',NULL),(76,'La Plata','Buenos Aires','AR','221'),(77,'Mar del Plata','Buenos Aires','AR','223'),(78,'San Miguel de TucumÃ¡n','TucumÃ¡n','AR',NULL),(79,'LanÃºs','Buenos Aires','AR',NULL),(80,'Merlo','Buenos Aires','AR',NULL),(81,'General San MartÃ­n','Buenos Aires','AR',NULL),(82,'Salta','Salta','AR','387'),(83,'Moreno','Buenos Aires','AR',NULL),(84,'Santa FÃ©','Santa FÃ©','AR',NULL),(85,'Avellaneda','Buenos Aires','AR',NULL),(86,'Tres de Febrero','Buenos Aires','AR',NULL),(87,'MorÃ³n','Buenos Aires','AR',NULL),(88,'Florencio Varela','Buenos Aires','AR',NULL),(89,'San Isidro','Buenos Aires','AR',NULL),(90,'Tigre','Buenos Aires','AR',NULL),(91,'Malvinas Argentinas','Buenos Aires','AR',NULL),(92,'Vicente LÃ³pez','Buenos Aires','AR',NULL),(93,'Berazategui','Buenos Aires','AR',NULL),(94,'Corrientes','Corrientes','AR','3783'),(95,'San Miguel','Buenos Aires','AR',NULL),(96,'BahÃ­a Blanca','Buenos Aires','AR',NULL),(97,'Esteban EcheverrÃ­a','Buenos Aires','AR',NULL),(98,'Resistencia','Chaco','AR','3722'),(99,'JosÃ© C. Paz','Buenos Aires','AR',NULL),(100,'ParanÃ¡','Entre Rios','AR',NULL),(101,'Godoy Cruz','Mendoza','AR',NULL),(102,'Posadas','Misiones','AR','3752'),(103,'GuaymallÃ©n','Mendoza','AR',NULL),(104,'Santiago del Estero','Santiago del Estero','AR','385'),(105,'San Salvador de Jujuy','Jujuy','AR',NULL),(106,'Hurlingham','Buenos Aires','AR',NULL),(107,'NeuquÃ©n','NeuquÃ©n','AR',NULL),(108,'ItuzaingÃ³','Buenos Aires','AR',NULL),(109,'San Fernando','Buenos Aires','AR',NULL),(110,'Formosa','Formosa','AR','3717'),(111,'Las Heras','Mendoza','AR',NULL),(112,'La Rioja','La Rioja','AR','3822'),(113,'San Fernando del Valle de Cata','Catamarca','AR',NULL),(114,'RÃ­o Cuarto','CÃ³rdoba','AR',NULL),(115,'Comodoro Rivadavia','Chubut','AR','297'),(116,'Mendoza','Mendoza','AR','261'),(117,'San NicolÃ¡s de los Arroyos','Buenos Aires','AR',NULL),(118,'San Juan','San Juan','AR','264'),(119,'Escobar','Buenos Aires','AR',NULL),(120,'Concordia','Entre Rios','AR','345'),(121,'Pilar','Buenos Aires','AR',NULL),(122,'San Luis','San Luis','AR','2652'),(123,'Ezeiza','Buenos Aires','AR',NULL),(124,'San Rafael','Mendoza','AR','2627'),(125,'Tandil','Buenos Aires','AR','2293'),(126,'Yerevan','Yerevan','AM','11'),(127,'Gjumri','ÂŠirak','AM',''),(128,'Vanadzor','Lori','AM',NULL),(129,'Oranjestad','Â–','AW',NULL),(130,'Sydney','New South Wales','AU','2'),(131,'Melbourne','Victoria','AU','3'),(132,'Brisbane','Queensland','AU','7'),(133,'Perth','West Australia','AU','8'),(134,'Adelaide','South Australia','AU','8'),(135,'Canberra','Capital Region','AU','2'),(136,'Gold Coast','Queensland','AU','7'),(137,'Newcastle','New South Wales','AU','2'),(138,'Central Coast','New South Wales','AU',NULL),(139,'Wollongong','New South Wales','AU','2'),(140,'Hobart','Tasmania','AU','3'),(141,'Geelong','Victoria','AU','3'),(142,'Townsville','Queensland','AU','7'),(143,'Cairns','Queensland','AU','7'),(144,'Baku','Baki','AZ',NULL),(145,'GÃ¤ncÃ¤','GÃ¤ncÃ¤','AZ',NULL),(146,'Sumqayit','Sumqayit','AZ',NULL),(147,'MingÃ¤Ã§evir','MingÃ¤Ã§evir','AZ',NULL),(148,'Nassau','New Providence','BS',''),(149,'al-Manama','al-Manama','BH',NULL),(150,'Dhaka','Dhaka','BD','2'),(151,'Chittagong','Chittagong','BD','31'),(152,'Khulna','Khulna','BD','41'),(153,'Rajshahi','Rajshahi','BD','721'),(154,'Narayanganj','Dhaka','BD',NULL),(155,'Rangpur','Rajshahi','BD','521'),(156,'Mymensingh','Dhaka','BD','91'),(157,'Barisal','Barisal','BD','431'),(158,'Tungi','Dhaka','BD',NULL),(159,'Jessore','Khulna','BD','421'),(160,'Comilla','Chittagong','BD','81'),(161,'Nawabganj','Rajshahi','BD',NULL),(162,'Dinajpur','Rajshahi','BD','531'),(163,'Bogra','Rajshahi','BD','51'),(164,'Sylhet','Sylhet','BD','821'),(165,'Brahmanbaria','Chittagong','BD','851'),(166,'Tangail','Dhaka','BD','921'),(167,'Jamalpur','Dhaka','BD','981'),(168,'Pabna','Rajshahi','BD','731'),(169,'Naogaon','Rajshahi','BD','741'),(170,'Sirajganj','Rajshahi','BD',NULL),(171,'Narsinghdi','Dhaka','BD',NULL),(172,'Saidpur','Rajshahi','BD','5526'),(173,'Gazipur','Dhaka','BD','681'),(174,'Bridgetown','St Michael','BB',NULL),(175,'Antwerpen','Antwerpen','BE',NULL),(176,'Gent','East Flanderi','BE','9'),(177,'Charleroi','Hainaut','BE','71'),(178,'LiÃ¨ge','LiÃ¨ge','BE',NULL),(179,'Bruxelles [Brussel]','Bryssel','BE',NULL),(180,'Brugge','West Flanderi','BE',NULL),(181,'Schaerbeek','Bryssel','BE',NULL),(182,'Namur','Namur','BE','81'),(183,'Mons','Hainaut','BE','65'),(184,'Belize City','Belize City','BZ',NULL),(185,'Belmopan','Cayo','BZ',NULL),(186,'Cotonou','Atlantique','BJ',NULL),(187,'Porto-Novo','OuÃ©mÃ©','BJ',NULL),(188,'Djougou','Atacora','BJ',NULL),(189,'Parakou','Borgou','BJ',NULL),(190,'Saint George','Saint GeorgeÂ´s','BM',NULL),(191,'Hamilton','Hamilton','BM',NULL),(192,'Thimphu','Thimphu','BT',NULL),(193,'Santa Cruz de la Sierra','Santa Cruz','BO',NULL),(194,'La Paz','La Paz','BO','2'),(195,'El Alto','La Paz','BO',NULL),(196,'Cochabamba','Cochabamba','BO','4'),(197,'Oruro','Oruro','BO','2'),(198,'Sucre','Chuquisaca','BO','4'),(199,'PotosÃ­','PotosÃ­','BO',NULL),(200,'Tarija','Tarija','BO','4'),(201,'Sarajevo','Federaatio','BA',NULL),(202,'Banja Luka','Republika Srpska','BA',NULL),(203,'Zenica','Federaatio','BA',NULL),(204,'Gaborone','Gaborone','BW','31'),(205,'Francistown','Francistown','BW','24'),(206,'SÃ£o Paulo','SÃ£o Paulo','BR',NULL),(207,'Rio de Janeiro','Rio de Janeiro','BR','21'),(208,'Salvador','Bahia','BR','71'),(209,'Belo Horizonte','Minas Gerais','BR','31'),(210,'Fortaleza','CearÃ¡','BR','85'),(211,'BrasÃ­lia','Distrito Federal','BR',NULL),(212,'Curitiba','ParanÃ¡','BR','41'),(213,'Recife','Pernambuco','BR','81'),(214,'Porto Alegre','Rio Grande do Sul','BR','51'),(215,'Manaus','Amazonas','BR','92'),(216,'BelÃ©m','ParÃ¡','BR',NULL),(217,'Guarulhos','SÃ£o Paulo','BR',NULL),(218,'GoiÃ¢nia','GoiÃ¡s','BR',NULL),(219,'Campinas','SÃ£o Paulo','BR','19'),(220,'SÃ£o GonÃ§alo','Rio de Janeiro','BR',NULL),(221,'Nova IguaÃ§u','Rio de Janeiro','BR',NULL),(222,'SÃ£o LuÃ­s','MaranhÃ£o','BR',NULL),(223,'MaceiÃ³','Alagoas','BR',NULL),(224,'Duque de Caxias','Rio de Janeiro','BR',NULL),(225,'SÃ£o Bernardo do Campo','SÃ£o Paulo','BR',NULL),(226,'Teresina','PiauÃ­','BR','86'),(227,'Natal','Rio Grande do Norte','BR','84'),(228,'Osasco','SÃ£o Paulo','BR',NULL),(229,'Campo Grande','Mato Grosso do Sul','BR','67'),(230,'Santo AndrÃ©','SÃ£o Paulo','BR',NULL),(231,'JoÃ£o Pessoa','ParaÃ­ba','BR',NULL),(232,'JaboatÃ£o dos Guararapes','Pernambuco','BR',NULL),(233,'Contagem','Minas Gerais','BR',NULL),(234,'SÃ£o JosÃ© dos Campos','SÃ£o Paulo','BR',NULL),(235,'UberlÃ¢ndia','Minas Gerais','BR',NULL),(236,'Feira de Santana','Bahia','BR','75'),(237,'RibeirÃ£o Preto','SÃ£o Paulo','BR',NULL),(238,'Sorocaba','SÃ£o Paulo','BR','15'),(239,'NiterÃ³i','Rio de Janeiro','BR',NULL),(240,'CuiabÃ¡','Mato Grosso','BR',NULL),(241,'Juiz de Fora','Minas Gerais','BR','32'),(242,'Aracaju','Sergipe','BR','79'),(243,'SÃ£o JoÃ£o de Meriti','Rio de Janeiro','BR',NULL),(244,'Londrina','ParanÃ¡','BR','43'),(245,'Joinville','Santa Catarina','BR','47'),(246,'Belford Roxo','Rio de Janeiro','BR',NULL),(247,'Santos','SÃ£o Paulo','BR','13'),(248,'Ananindeua','ParÃ¡','BR',NULL),(249,'Campos dos Goytacazes','Rio de Janeiro','BR',NULL),(250,'MauÃ¡','SÃ£o Paulo','BR',NULL),(251,'CarapicuÃ­ba','SÃ£o Paulo','BR',NULL),(252,'Olinda','Pernambuco','BR',NULL),(253,'Campina Grande','ParaÃ­ba','BR','83'),(254,'SÃ£o JosÃ© do Rio Preto','SÃ£o Paulo','BR',NULL),(255,'Caxias do Sul','Rio Grande do Sul','BR','54'),(256,'Moji das Cruzes','SÃ£o Paulo','BR',NULL),(257,'Diadema','SÃ£o Paulo','BR',NULL),(258,'Aparecida de GoiÃ¢nia','GoiÃ¡s','BR',NULL),(259,'Piracicaba','SÃ£o Paulo','BR',NULL),(260,'Cariacica','EspÃ­rito Santo','BR',NULL),(261,'Vila Velha','EspÃ­rito Santo','BR',NULL),(262,'Pelotas','Rio Grande do Sul','BR','532'),(263,'Bauru','SÃ£o Paulo','BR','14'),(264,'Porto Velho','RondÃ´nia','BR','69'),(265,'Serra','EspÃ­rito Santo','BR',NULL),(266,'Betim','Minas Gerais','BR',NULL),(267,'JundÃ­aÃ­','SÃ£o Paulo','BR',NULL),(268,'Canoas','Rio Grande do Sul','BR',NULL),(269,'Franca','SÃ£o Paulo','BR',NULL),(270,'SÃ£o Vicente','SÃ£o Paulo','BR',NULL),(271,'MaringÃ¡','ParanÃ¡','BR',NULL),(272,'Montes Claros','Minas Gerais','BR','38'),(273,'AnÃ¡polis','GoiÃ¡s','BR',NULL),(274,'FlorianÃ³polis','Santa Catarina','BR',NULL),(275,'PetrÃ³polis','Rio de Janeiro','BR',NULL),(276,'Itaquaquecetuba','SÃ£o Paulo','BR',NULL),(277,'VitÃ³ria','EspÃ­rito Santo','BR',NULL),(278,'Ponta Grossa','ParanÃ¡','BR','42'),(279,'Rio Branco','Acre','BR','68'),(280,'Foz do IguaÃ§u','ParanÃ¡','BR',NULL),(281,'MacapÃ¡','AmapÃ¡','BR',NULL),(282,'IlhÃ©us','Bahia','BR',NULL),(283,'VitÃ³ria da Conquista','Bahia','BR',NULL),(284,'Uberaba','Minas Gerais','BR','34'),(285,'Paulista','Pernambuco','BR',NULL),(286,'Limeira','SÃ£o Paulo','BR',NULL),(287,'Blumenau','Santa Catarina','BR','47'),(288,'Caruaru','Pernambuco','BR','81'),(289,'SantarÃ©m','ParÃ¡','BR',NULL),(290,'Volta Redonda','Rio de Janeiro','BR','24'),(291,'Novo Hamburgo','Rio Grande do Sul','BR',NULL),(292,'Caucaia','CearÃ¡','BR',NULL),(293,'Santa Maria','Rio Grande do Sul','BR','34'),(294,'Cascavel','ParanÃ¡','BR',NULL),(295,'GuarujÃ¡','SÃ£o Paulo','BR',NULL),(296,'RibeirÃ£o das Neves','Minas Gerais','BR',NULL),(297,'Governador Valadares','Minas Gerais','BR','33'),(298,'TaubatÃ©','SÃ£o Paulo','BR',NULL),(299,'Imperatriz','MaranhÃ£o','BR',NULL),(300,'GravataÃ­','Rio Grande do Sul','BR',NULL),(301,'Embu','SÃ£o Paulo','BR',NULL),(302,'MossorÃ³','Rio Grande do Norte','BR',NULL),(303,'VÃ¡rzea Grande','Mato Grosso','BR',NULL),(304,'Petrolina','Pernambuco','BR',NULL),(305,'Barueri','SÃ£o Paulo','BR',NULL),(306,'ViamÃ£o','Rio Grande do Sul','BR',NULL),(307,'Ipatinga','Minas Gerais','BR',NULL),(308,'Juazeiro','Bahia','BR',NULL),(309,'Juazeiro do Norte','CearÃ¡','BR','74'),(310,'TaboÃ£o da Serra','SÃ£o Paulo','BR',NULL),(311,'SÃ£o JosÃ© dos Pinhais','ParanÃ¡','BR',NULL),(312,'MagÃ©','Rio de Janeiro','BR',NULL),(313,'Suzano','SÃ£o Paulo','BR',NULL),(314,'SÃ£o Leopoldo','Rio Grande do Sul','BR',NULL),(315,'MarÃ­lia','SÃ£o Paulo','BR',NULL),(316,'SÃ£o Carlos','SÃ£o Paulo','BR',NULL),(317,'SumarÃ©','SÃ£o Paulo','BR',NULL),(318,'Presidente Prudente','SÃ£o Paulo','BR',NULL),(319,'DivinÃ³polis','Minas Gerais','BR',NULL),(320,'Sete Lagoas','Minas Gerais','BR',NULL),(321,'Rio Grande','Rio Grande do Sul','BR','53'),(322,'Itabuna','Bahia','BR','73'),(323,'JequiÃ©','Bahia','BR',NULL),(324,'Arapiraca','Alagoas','BR',NULL),(325,'Colombo','ParanÃ¡','BR',NULL),(326,'Americana','SÃ£o Paulo','BR',NULL),(327,'Alvorada','Rio Grande do Sul','BR',NULL),(328,'Araraquara','SÃ£o Paulo','BR',NULL),(329,'ItaboraÃ­','Rio de Janeiro','BR',NULL),(330,'Santa BÃ¡rbara dÂ´Oeste','SÃ£o Paulo','BR',NULL),(331,'Nova Friburgo','Rio de Janeiro','BR',NULL),(332,'JacareÃ­','SÃ£o Paulo','BR',NULL),(333,'AraÃ§atuba','SÃ£o Paulo','BR',NULL),(334,'Barra Mansa','Rio de Janeiro','BR',NULL),(335,'Praia Grande','SÃ£o Paulo','BR',NULL),(336,'MarabÃ¡','ParÃ¡','BR',NULL),(337,'CriciÃºma','Santa Catarina','BR',NULL),(338,'Boa Vista','Roraima','BR','95'),(339,'Passo Fundo','Rio Grande do Sul','BR','54'),(340,'Dourados','Mato Grosso do Sul','BR',NULL),(341,'Santa Luzia','Minas Gerais','BR',NULL),(342,'Rio Claro','SÃ£o Paulo','BR',NULL),(343,'MaracanaÃº','CearÃ¡','BR',NULL),(344,'Guarapuava','ParanÃ¡','BR',NULL),(345,'RondonÃ³polis','Mato Grosso','BR',NULL),(346,'SÃ£o JosÃ©','Santa Catarina','BR',NULL),(347,'Cachoeiro de Itapemirim','EspÃ­rito Santo','BR',NULL),(348,'NilÃ³polis','Rio de Janeiro','BR',NULL),(349,'Itapevi','SÃ£o Paulo','BR',NULL),(350,'Cabo de Santo Agostinho','Pernambuco','BR',NULL),(351,'CamaÃ§ari','Bahia','BR',NULL),(352,'Sobral','CearÃ¡','BR','88'),(353,'ItajaÃ­','Santa Catarina','BR',NULL),(354,'ChapecÃ³','Santa Catarina','BR',NULL),(355,'Cotia','SÃ£o Paulo','BR',NULL),(356,'Lages','Santa Catarina','BR',NULL),(357,'Ferraz de Vasconcelos','SÃ£o Paulo','BR',NULL),(358,'Indaiatuba','SÃ£o Paulo','BR',NULL),(359,'HortolÃ¢ndia','SÃ£o Paulo','BR',NULL),(360,'Caxias','MaranhÃ£o','BR',NULL),(361,'SÃ£o Caetano do Sul','SÃ£o Paulo','BR',NULL),(362,'Itu','SÃ£o Paulo','BR',NULL),(363,'Nossa Senhora do Socorro','Sergipe','BR',NULL),(364,'ParnaÃ­ba','PiauÃ­','BR',NULL),(365,'PoÃ§os de Caldas','Minas Gerais','BR',NULL),(366,'TeresÃ³polis','Rio de Janeiro','BR',NULL),(367,'Barreiras','Bahia','BR','77'),(368,'Castanhal','ParÃ¡','BR',NULL),(369,'Alagoinhas','Bahia','BR','75'),(370,'Itapecerica da Serra','SÃ£o Paulo','BR',NULL),(371,'Uruguaiana','Rio Grande do Sul','BR','55'),(372,'ParanaguÃ¡','ParanÃ¡','BR',NULL),(373,'IbiritÃ©','Minas Gerais','BR',NULL),(374,'Timon','MaranhÃ£o','BR',NULL),(375,'LuziÃ¢nia','GoiÃ¡s','BR',NULL),(376,'MacaÃ©','Rio de Janeiro','BR',NULL),(377,'TeÃ³filo Otoni','Minas Gerais','BR',NULL),(378,'Moji-GuaÃ§u','SÃ£o Paulo','BR',NULL),(379,'Palmas','Tocantins','BR','63'),(380,'Pindamonhangaba','SÃ£o Paulo','BR',NULL),(381,'Francisco Morato','SÃ£o Paulo','BR',NULL),(382,'BagÃ©','Rio Grande do Sul','BR',NULL),(383,'Sapucaia do Sul','Rio Grande do Sul','BR',NULL),(384,'Cabo Frio','Rio de Janeiro','BR',NULL),(385,'Itapetininga','SÃ£o Paulo','BR',NULL),(386,'Patos de Minas','Minas Gerais','BR',NULL),(387,'Camaragibe','Pernambuco','BR',NULL),(388,'BraganÃ§a Paulista','SÃ£o Paulo','BR',NULL),(389,'Queimados','Rio de Janeiro','BR',NULL),(390,'AraguaÃ­na','Tocantins','BR',NULL),(391,'Garanhuns','Pernambuco','BR','81'),(392,'VitÃ³ria de Santo AntÃ£o','Pernambuco','BR',NULL),(393,'Santa Rita','ParaÃ­ba','BR',NULL),(394,'Barbacena','Minas Gerais','BR',NULL),(395,'Abaetetuba','ParÃ¡','BR',NULL),(396,'JaÃº','SÃ£o Paulo','BR',NULL),(397,'Lauro de Freitas','Bahia','BR',NULL),(398,'Franco da Rocha','SÃ£o Paulo','BR',NULL),(399,'Teixeira de Freitas','Bahia','BR',NULL),(400,'Varginha','Minas Gerais','BR',NULL),(401,'RibeirÃ£o Pires','SÃ£o Paulo','BR',NULL),(402,'SabarÃ¡','Minas Gerais','BR',NULL),(403,'Catanduva','SÃ£o Paulo','BR',NULL),(404,'Rio Verde','GoiÃ¡s','BR',NULL),(405,'Botucatu','SÃ£o Paulo','BR',NULL),(406,'Colatina','EspÃ­rito Santo','BR',NULL),(407,'Santa Cruz do Sul','Rio Grande do Sul','BR',NULL),(408,'Linhares','EspÃ­rito Santo','BR',NULL),(409,'Apucarana','ParanÃ¡','BR',NULL),(410,'Barretos','SÃ£o Paulo','BR',NULL),(411,'GuaratinguetÃ¡','SÃ£o Paulo','BR',NULL),(412,'Cachoeirinha','Rio Grande do Sul','BR',NULL),(413,'CodÃ³','MaranhÃ£o','BR',NULL),(414,'JaraguÃ¡ do Sul','Santa Catarina','BR',NULL),(415,'CubatÃ£o','SÃ£o Paulo','BR',NULL),(416,'Itabira','Minas Gerais','BR',NULL),(417,'Itaituba','ParÃ¡','BR',NULL),(418,'Araras','SÃ£o Paulo','BR',NULL),(419,'Resende','Rio de Janeiro','BR',NULL),(420,'Atibaia','SÃ£o Paulo','BR',NULL),(421,'Pouso Alegre','Minas Gerais','BR',NULL),(422,'Toledo','ParanÃ¡','BR',NULL),(423,'Crato','CearÃ¡','BR',NULL),(424,'Passos','Minas Gerais','BR',NULL),(425,'Araguari','Minas Gerais','BR',NULL),(426,'SÃ£o JosÃ© de Ribamar','MaranhÃ£o','BR',NULL),(427,'Pinhais','ParanÃ¡','BR',NULL),(428,'SertÃ£ozinho','SÃ£o Paulo','BR',NULL),(429,'Conselheiro Lafaiete','Minas Gerais','BR',NULL),(430,'Paulo Afonso','Bahia','BR',NULL),(431,'Angra dos Reis','Rio de Janeiro','BR',NULL),(432,'EunÃ¡polis','Bahia','BR',NULL),(433,'Salto','SÃ£o Paulo','BR',NULL),(434,'Ourinhos','SÃ£o Paulo','BR',NULL),(435,'Parnamirim','Rio Grande do Norte','BR',NULL),(436,'Jacobina','Bahia','BR',NULL),(437,'Coronel Fabriciano','Minas Gerais','BR',NULL),(438,'Birigui','SÃ£o Paulo','BR',NULL),(439,'TatuÃ­','SÃ£o Paulo','BR',NULL),(440,'Ji-ParanÃ¡','RondÃ´nia','BR',NULL),(441,'Bacabal','MaranhÃ£o','BR',NULL),(442,'CametÃ¡','ParÃ¡','BR',NULL),(443,'GuaÃ­ba','Rio Grande do Sul','BR',NULL),(444,'SÃ£o LourenÃ§o da Mata','Pernambuco','BR',NULL),(445,'Santana do Livramento','Rio Grande do Sul','BR',NULL),(446,'Votorantim','SÃ£o Paulo','BR',NULL),(447,'Campo Largo','ParanÃ¡','BR',NULL),(448,'Patos','ParaÃ­ba','BR',NULL),(449,'Ituiutaba','Minas Gerais','BR',NULL),(450,'CorumbÃ¡','Mato Grosso do Sul','BR',NULL),(451,'PalhoÃ§a','Santa Catarina','BR',NULL),(452,'Barra do PiraÃ­','Rio de Janeiro','BR',NULL),(453,'Bento GonÃ§alves','Rio Grande do Sul','BR',NULL),(454,'PoÃ¡','SÃ£o Paulo','BR',NULL),(455,'Ãguas Lindas de GoiÃ¡s','GoiÃ¡s','BR',NULL),(456,'London','England','GB','20'),(457,'Birmingham','England','GB','121'),(458,'Glasgow','Scotland','GB','141'),(459,'Liverpool','England','GB','151'),(460,'Edinburgh','Scotland','GB','131'),(461,'Sheffield','England','GB','114'),(462,'Manchester','England','GB','161'),(463,'Leeds','England','GB','113'),(464,'Bristol','England','GB','117'),(465,'Cardiff','Wales','GB','29'),(466,'Coventry','England','GB','24'),(467,'Leicester','England','GB','116'),(468,'Bradford','England','GB','1274'),(469,'Belfast','North Ireland','GB',NULL),(470,'Nottingham','England','GB','115'),(471,'Kingston upon Hull','England','GB','1482'),(472,'Plymouth','England','GB','1752'),(473,'Stoke-on-Trent','England','GB',NULL),(474,'Wolverhampton','England','GB','1902'),(475,'Derby','England','GB','1332'),(476,'Swansea','Wales','GB','1792'),(477,'Southampton','England','GB','23'),(478,'Aberdeen','Scotland','GB','1224'),(479,'Northampton','England','GB','1604'),(480,'Dudley','England','GB','1384'),(481,'Portsmouth','England','GB','23'),(482,'Newcastle upon Tyne','England','GB','191'),(483,'Sunderland','England','GB','191'),(484,'Luton','England','GB','1582'),(485,'Swindon','England','GB','1793'),(486,'Southend-on-Sea','England','GB',NULL),(487,'Walsall','England','GB','1922'),(488,'Bournemouth','England','GB','1202'),(489,'Peterborough','England','GB','1733'),(490,'Brighton','England','GB','1273'),(491,'Blackpool','England','GB','1253'),(492,'Dundee','Scotland','GB',NULL),(493,'West Bromwich','England','GB','121'),(494,'Reading','England','GB','118'),(495,'Oldbury/Smethwick (Warley)','England','GB',NULL),(496,'Middlesbrough','England','GB','1642'),(497,'Huddersfield','England','GB','1484'),(498,'Oxford','England','GB','1865'),(499,'Poole','England','GB','1202'),(500,'Bolton','England','GB','1204'),(501,'Blackburn','England','GB','1254'),(502,'Newport','Wales','GB',NULL),(503,'Preston','England','GB','1772'),(504,'Stockport','England','GB','161'),(505,'Norwich','England','GB','1603'),(506,'Rotherham','England','GB','1709'),(507,'Cambridge','England','GB','1223'),(508,'Watford','England','GB','1923'),(509,'Ipswich','England','GB','1473'),(510,'Slough','England','GB','1753'),(511,'Exeter','England','GB',NULL),(512,'Cheltenham','England','GB',NULL),(513,'Gloucester','England','GB','1452'),(514,'Saint Helens','England','GB',NULL),(515,'Sutton Coldfield','England','GB','121'),(516,'York','England','GB','1904'),(517,'Oldham','England','GB','161'),(518,'Basildon','England','GB',NULL),(519,'Worthing','England','GB','605'),(520,'Chelmsford','England','GB',NULL),(521,'Colchester','England','GB','1206'),(522,'Crawley','England','GB','1293'),(523,'Gillingham','England','GB',NULL),(524,'Solihull','England','GB',NULL),(525,'Rochdale','England','GB',NULL),(526,'Birkenhead','England','GB',NULL),(527,'Worcester','England','GB','774'),(528,'Hartlepool','England','GB',NULL),(529,'Halifax','England','GB',NULL),(530,'Woking/Byfleet','England','GB',NULL),(531,'Southport','England','GB',NULL),(532,'Maidstone','England','GB',NULL),(533,'Eastbourne','England','GB','1323'),(534,'Grimsby','England','GB',NULL),(535,'Saint Helier','Jersey','GB',NULL),(536,'Douglas','Â–','GB',NULL),(537,'Road Town','Tortola','VG',NULL),(538,'Bandar Seri Begawan','Brunei and Muara','BN',NULL),(539,'Sofija','Grad Sofija','BG',NULL),(540,'Plovdiv','Plovdiv','BG','32'),(541,'Varna','Varna','BG','52'),(542,'Burgas','Burgas','BG',NULL),(543,'Ruse','Ruse','BG','82'),(544,'Stara Zagora','Haskovo','BG','42'),(545,'Pleven','Lovec','BG','64'),(546,'Sliven','Burgas','BG','44'),(547,'Dobric','Varna','BG',NULL),(548,'ÂŠumen','Varna','BG',NULL),(549,'Ouagadougou','Kadiogo','BF',NULL),(550,'Bobo-Dioulasso','Houet','BF',NULL),(551,'Koudougou','BoulkiemdÃ©','BF',NULL),(552,'Bujumbura','Bujumbura','BI',NULL),(553,'George Town','Grand Cayman','KY',NULL),(554,'Santiago de Chile','Santiago','CL',NULL),(555,'Puente Alto','Santiago','CL',NULL),(556,'ViÃ±a del Mar','ValparaÃ­so','CL',NULL),(557,'ValparaÃ­so','ValparaÃ­so','CL',NULL),(558,'Talcahuano','BÃ­obÃ­o','CL','41'),(559,'Antofagasta','Antofagasta','CL','55'),(560,'San Bernardo','Santiago','CL',NULL),(561,'Temuco','La AraucanÃ­a','CL','45'),(562,'ConcepciÃ³n','BÃ­obÃ­o','CL',NULL),(563,'Rancagua','OÂ´Higgins','CL','72'),(564,'Arica','TarapacÃ¡','CL','58'),(565,'Talca','Maule','CL','71'),(566,'ChillÃ¡n','BÃ­obÃ­o','CL',NULL),(567,'Iquique','TarapacÃ¡','CL','57'),(568,'Los Angeles','BÃ­obÃ­o','CL',NULL),(569,'Puerto Montt','Los Lagos','CL','65'),(570,'Coquimbo','Coquimbo','CL','51'),(571,'Osorno','Los Lagos','CL','64'),(572,'La Serena','Coquimbo','CL','51'),(573,'Calama','Antofagasta','CL','55'),(574,'Valdivia','Los Lagos','CL','63'),(575,'Punta Arenas','Magallanes','CL','61'),(576,'CopiapÃ³','Atacama','CL',NULL),(577,'QuilpuÃ©','ValparaÃ­so','CL',NULL),(578,'CuricÃ³','Maule','CL',NULL),(579,'Ovalle','Coquimbo','CL','53'),(580,'Coronel','BÃ­obÃ­o','CL',NULL),(581,'San Pedro de la Paz','BÃ­obÃ­o','CL',NULL),(582,'Melipilla','Santiago','CL',NULL),(583,'Avarua','Rarotonga','CK',NULL),(584,'San JosÃ©','San JosÃ©','CR',NULL),(585,'Djibouti','Djibouti','DJ',NULL),(586,'Roseau','St George','DM',NULL),(587,'Santo Domingo de GuzmÃ¡n','Distrito Nacional','DO',NULL),(588,'Santiago de los Caballeros','Santiago','DO',NULL),(589,'La Romana','La Romana','DO',NULL),(590,'San Pedro de MacorÃ­s','San Pedro de MacorÃ­','DO',NULL),(591,'San Francisco de MacorÃ­s','Duarte','DO',NULL),(592,'San Felipe de Puerto Plata','Puerto Plata','DO',NULL),(593,'Guayaquil','Guayas','EC','4'),(594,'Quito','Pichincha','EC','2'),(595,'Cuenca','Azuay','EC',NULL),(596,'Machala','El Oro','EC',NULL),(597,'Santo Domingo de los Colorados','Pichincha','EC',NULL),(598,'Portoviejo','ManabÃ­','EC',NULL),(599,'Ambato','Tungurahua','EC',NULL),(600,'Manta','ManabÃ­','EC',NULL),(601,'Duran [Eloy Alfaro]','Guayas','EC',NULL),(602,'Ibarra','Imbabura','EC',NULL),(603,'Quevedo','Los RÃ­os','EC',NULL),(604,'Milagro','Guayas','EC',NULL),(605,'Loja','Loja','EC',NULL),(606,'RÃ­obamba','Chimborazo','EC',NULL),(607,'Esmeraldas','Esmeraldas','EC',NULL),(608,'Cairo','Kairo','EG','2'),(609,'Alexandria','Aleksandria','EG','3'),(610,'Giza','Giza','EG',NULL),(611,'Shubra al-Khayma','al-Qalyubiya','EG',NULL),(612,'Port Said','Port Said','EG','66'),(613,'Suez','Suez','EG','62'),(614,'al-Mahallat al-Kubra','al-Gharbiya','EG',NULL),(615,'Tanta','al-Gharbiya','EG',NULL),(616,'al-Mansura','al-Daqahliya','EG',NULL),(617,'Luxor','Luxor','EG','95'),(618,'Asyut','Asyut','EG',NULL),(619,'Bahtim','al-Qalyubiya','EG',NULL),(620,'Zagazig','al-Sharqiya','EG','55'),(621,'al-Faiyum','al-Faiyum','EG',NULL),(622,'Ismailia','Ismailia','EG','64'),(623,'Kafr al-Dawwar','al-Buhayra','EG',NULL),(624,'Assuan','Assuan','EG',NULL),(625,'Damanhur','al-Buhayra','EG',NULL),(626,'al-Minya','al-Minya','EG',NULL),(627,'Bani Suwayf','Bani Suwayf','EG',NULL),(628,'Qina','Qina','EG','96'),(629,'Sawhaj','Sawhaj','EG',NULL),(630,'Shibin al-Kawm','al-Minufiya','EG',NULL),(631,'Bulaq al-Dakrur','Giza','EG',NULL),(632,'Banha','al-Qalyubiya','EG',NULL),(633,'Warraq al-Arab','Giza','EG',NULL),(634,'Kafr al-Shaykh','Kafr al-Shaykh','EG',NULL),(635,'Mallawi','al-Minya','EG',NULL),(636,'Bilbays','al-Sharqiya','EG',NULL),(637,'Mit Ghamr','al-Daqahliya','EG',NULL),(638,'al-Arish','Shamal Sina','EG',NULL),(639,'Talkha','al-Daqahliya','EG',NULL),(640,'Qalyub','al-Qalyubiya','EG',NULL),(641,'Jirja','Sawhaj','EG',NULL),(642,'Idfu','Qina','EG',NULL),(643,'al-Hawamidiya','Giza','EG',NULL),(644,'Disuq','Kafr al-Shaykh','EG',NULL),(645,'San Salvador','San Salvador','SV',NULL),(646,'Santa Ana','Santa Ana','SV',NULL),(647,'Mejicanos','San Salvador','SV',NULL),(648,'Soyapango','San Salvador','SV',NULL),(649,'San Miguel','San Miguel','SV',NULL),(650,'Nueva San Salvador','La Libertad','SV',NULL),(651,'Apopa','San Salvador','SV',NULL),(652,'Asmara','Maekel','ER',NULL),(653,'Madrid','Madrid','ES','91'),(654,'Barcelona','Katalonia','ES','93'),(655,'Valencia','Valencia','ES','96'),(656,'Sevilla','Andalusia','ES','95'),(657,'Zaragoza','Aragonia','ES','976'),(658,'MÃ¡laga','Andalusia','ES',NULL),(659,'Bilbao','Baskimaa','ES','94'),(660,'Las Palmas de Gran Canaria','Canary Islands','ES',NULL),(661,'Murcia','Murcia','ES','968'),(662,'Palma de Mallorca','Balears','ES','971'),(663,'Valladolid','Castilla and LeÃ³n','ES','983'),(664,'CÃ³rdoba','Andalusia','ES',NULL),(665,'Vigo','Galicia','ES',NULL),(666,'Alicante [Alacant]','Valencia','ES',NULL),(667,'GijÃ³n','Asturia','ES',NULL),(668,'LÂ´Hospitalet de Llobregat','Katalonia','ES',NULL),(669,'Granada','Andalusia','ES','958'),(670,'A CoruÃ±a (La CoruÃ±a)','Galicia','ES',NULL),(671,'Vitoria-Gasteiz','Baskimaa','ES',NULL),(672,'Santa Cruz de Tenerife','Canary Islands','ES',NULL),(673,'Badalona','Katalonia','ES',NULL),(674,'Oviedo','Asturia','ES','407'),(675,'MÃ³stoles','Madrid','ES',NULL),(676,'Elche [Elx]','Valencia','ES',NULL),(677,'Sabadell','Katalonia','ES',NULL),(678,'Santander','Cantabria','ES','942'),(679,'Jerez de la Frontera','Andalusia','ES',NULL),(680,'Pamplona [IruÃ±a]','Navarra','ES',NULL),(681,'Donostia-San SebastiÃ¡n','Baskimaa','ES',NULL),(682,'Cartagena','Murcia','ES',NULL),(683,'LeganÃ©s','Madrid','ES',NULL),(684,'Fuenlabrada','Madrid','ES',NULL),(685,'AlmerÃ­a','Andalusia','ES',NULL),(686,'Terrassa','Katalonia','ES',NULL),(687,'AlcalÃ¡ de Henares','Madrid','ES',NULL),(688,'Burgos','Castilla and LeÃ³n','ES','947'),(689,'Salamanca','Castilla and LeÃ³n','ES','923'),(690,'Albacete','Kastilia-La Mancha','ES','967'),(691,'Getafe','Madrid','ES',NULL),(692,'CÃ¡diz','Andalusia','ES',NULL),(693,'AlcorcÃ³n','Madrid','ES',NULL),(694,'Huelva','Andalusia','ES','959'),(695,'LeÃ³n','Castilla and LeÃ³n','ES',NULL),(696,'CastellÃ³n de la Plana [Castell','Valencia','ES',NULL),(697,'Badajoz','Extremadura','ES','924'),(698,'[San CristÃ³bal de] la Laguna','Canary Islands','ES',NULL),(699,'LogroÃ±o','La Rioja','ES',NULL),(700,'Santa Coloma de Gramenet','Katalonia','ES',NULL),(701,'Tarragona','Katalonia','ES','977'),(702,'Lleida (LÃ©rida)','Katalonia','ES',NULL),(703,'JaÃ©n','Andalusia','ES',NULL),(704,'Ourense (Orense)','Galicia','ES',NULL),(705,'MatarÃ³','Katalonia','ES',NULL),(706,'Algeciras','Andalusia','ES',NULL),(707,'Marbella','Andalusia','ES',NULL),(708,'Barakaldo','Baskimaa','ES',NULL),(709,'Dos Hermanas','Andalusia','ES',NULL),(710,'Santiago de Compostela','Galicia','ES',NULL),(711,'TorrejÃ³n de Ardoz','Madrid','ES',NULL),(712,'Cape Town','Western Cape','ZA','21'),(713,'Soweto','Gauteng','ZA',NULL),(714,'Johannesburg','Gauteng','ZA','11'),(715,'Port Elizabeth','Eastern Cape','ZA','41'),(716,'Pretoria','Gauteng','ZA','12'),(717,'Inanda','KwaZulu-Natal','ZA',NULL),(718,'Durban','KwaZulu-Natal','ZA','31'),(719,'Vanderbijlpark','Gauteng','ZA',NULL),(720,'Kempton Park','Gauteng','ZA',NULL),(721,'Alberton','Gauteng','ZA',NULL),(722,'Pinetown','KwaZulu-Natal','ZA',NULL),(723,'Pietermaritzburg','KwaZulu-Natal','ZA',NULL),(724,'Benoni','Gauteng','ZA',NULL),(725,'Randburg','Gauteng','ZA',NULL),(726,'Umlazi','KwaZulu-Natal','ZA',NULL),(727,'Bloemfontein','Free State','ZA','51'),(728,'Vereeniging','Gauteng','ZA','11'),(729,'Wonderboom','Gauteng','ZA',NULL),(730,'Roodepoort','Gauteng','ZA',NULL),(731,'Boksburg','Gauteng','ZA',NULL),(732,'Klerksdorp','North West','ZA',NULL),(733,'Soshanguve','Gauteng','ZA',NULL),(734,'Newcastle','KwaZulu-Natal','ZA',NULL),(735,'East London','Eastern Cape','ZA','431'),(736,'Welkom','Free State','ZA','57'),(737,'Kimberley','Northern Cape','ZA',NULL),(738,'Uitenhage','Eastern Cape','ZA','41'),(739,'Chatsworth','KwaZulu-Natal','ZA',NULL),(740,'Mdantsane','Eastern Cape','ZA',NULL),(741,'Krugersdorp','Gauteng','ZA',NULL),(742,'Botshabelo','Free State','ZA',NULL),(743,'Brakpan','Gauteng','ZA',NULL),(744,'Witbank','Mpumalanga','ZA',NULL),(745,'Oberholzer','Gauteng','ZA',NULL),(746,'Germiston','Gauteng','ZA',NULL),(747,'Springs','Gauteng','ZA',NULL),(748,'Westonaria','Gauteng','ZA',NULL),(749,'Randfontein','Gauteng','ZA',NULL),(750,'Paarl','Western Cape','ZA',NULL),(751,'Potchefstroom','North West','ZA',NULL),(752,'Rustenburg','North West','ZA',NULL),(753,'Nigel','Gauteng','ZA',NULL),(754,'George','Western Cape','ZA','712'),(755,'Ladysmith','KwaZulu-Natal','ZA',NULL),(756,'Addis Abeba','Addis Abeba','ET',NULL),(757,'Dire Dawa','Dire Dawa','ET',NULL),(758,'Nazret','Oromia','ET',NULL),(759,'Gonder','Amhara','ET',NULL),(760,'Dese','Amhara','ET',NULL),(761,'Mekele','Tigray','ET',NULL),(762,'Bahir Dar','Amhara','ET',NULL),(763,'Stanley','East Falkland','FK',NULL),(764,'Suva','Central','FJ',''),(765,'Quezon','National Capital Reg','PH',NULL),(766,'Manila','National Capital Reg','PH','2'),(767,'Kalookan','National Capital Reg','PH',NULL),(768,'Davao','Southern Mindanao','PH',NULL),(769,'Cebu','Central Visayas','PH',NULL),(770,'Zamboanga','Western Mindanao','PH','62'),(771,'Pasig','National Capital Reg','PH',NULL),(772,'Valenzuela','National Capital Reg','PH',NULL),(773,'Las PiÃ±as','National Capital Reg','PH',NULL),(774,'Antipolo','Southern Tagalog','PH',NULL),(775,'Taguig','National Capital Reg','PH',NULL),(776,'Cagayan de Oro','Northern Mindanao','PH',NULL),(777,'ParaÃ±aque','National Capital Reg','PH',NULL),(778,'Makati','National Capital Reg','PH',NULL),(779,'Bacolod','Western Visayas','PH',NULL),(780,'General Santos','Southern Mindanao','PH','83'),(781,'Marikina','National Capital Reg','PH',NULL),(782,'DasmariÃ±as','Southern Tagalog','PH',NULL),(783,'Muntinlupa','National Capital Reg','PH',NULL),(784,'Iloilo','Western Visayas','PH','33'),(785,'Pasay','National Capital Reg','PH',NULL),(786,'Malabon','National Capital Reg','PH',NULL),(787,'San JosÃ© del Monte','Central Luzon','PH',NULL),(788,'Bacoor','Southern Tagalog','PH',NULL),(789,'Iligan','Central Mindanao','PH',NULL),(790,'Calamba','Southern Tagalog','PH',NULL),(791,'Mandaluyong','National Capital Reg','PH',NULL),(792,'Butuan','Caraga','PH',NULL),(793,'Angeles','Central Luzon','PH',NULL),(794,'Tarlac','Central Luzon','PH','452'),(795,'Mandaue','Central Visayas','PH',NULL),(796,'Baguio','CAR','PH',NULL),(797,'Batangas','Southern Tagalog','PH',NULL),(798,'Cainta','Southern Tagalog','PH',NULL),(799,'San Pedro','Southern Tagalog','PH',NULL),(800,'Navotas','National Capital Reg','PH',NULL),(801,'Cabanatuan','Central Luzon','PH',NULL),(802,'San Fernando','Central Luzon','PH',NULL),(803,'Lipa','Southern Tagalog','PH',NULL),(804,'Lapu-Lapu','Central Visayas','PH',NULL),(805,'San Pablo','Southern Tagalog','PH',NULL),(806,'BiÃ±an','Southern Tagalog','PH',NULL),(807,'Taytay','Southern Tagalog','PH',NULL),(808,'Lucena','Southern Tagalog','PH',NULL),(809,'Imus','Southern Tagalog','PH',NULL),(810,'Olongapo','Central Luzon','PH',NULL),(811,'Binangonan','Southern Tagalog','PH',NULL),(812,'Santa Rosa','Southern Tagalog','PH',NULL),(813,'Tagum','Southern Mindanao','PH',NULL),(814,'Tacloban','Eastern Visayas','PH',NULL),(815,'Malolos','Central Luzon','PH',NULL),(816,'Mabalacat','Central Luzon','PH',NULL),(817,'Cotabato','Central Mindanao','PH',NULL),(818,'Meycauayan','Central Luzon','PH',NULL),(819,'Puerto Princesa','Southern Tagalog','PH',NULL),(820,'Legazpi','Bicol','PH',NULL),(821,'Silang','Southern Tagalog','PH',NULL),(822,'Ormoc','Eastern Visayas','PH',NULL),(823,'San Carlos','Ilocos','PH',NULL),(824,'Kabankalan','Western Visayas','PH',NULL),(825,'Talisay','Central Visayas','PH',NULL),(826,'Valencia','Northern Mindanao','PH',NULL),(827,'Calbayog','Eastern Visayas','PH',NULL),(828,'Santa Maria','Central Luzon','PH',NULL),(829,'Pagadian','Western Mindanao','PH',NULL),(830,'Cadiz','Western Visayas','PH',NULL),(831,'Bago','Western Visayas','PH',NULL),(832,'Toledo','Central Visayas','PH',NULL),(833,'Naga','Bicol','PH',NULL),(834,'San Mateo','Southern Tagalog','PH',NULL),(835,'Panabo','Southern Mindanao','PH',NULL),(836,'Koronadal','Southern Mindanao','PH',NULL),(837,'Marawi','Central Mindanao','PH',NULL),(838,'Dagupan','Ilocos','PH',NULL),(839,'Sagay','Western Visayas','PH',NULL),(840,'Roxas','Western Visayas','PH',NULL),(841,'Lubao','Central Luzon','PH',NULL),(842,'Digos','Southern Mindanao','PH',NULL),(843,'San Miguel','Central Luzon','PH',NULL),(844,'Malaybalay','Northern Mindanao','PH',NULL),(845,'Tuguegarao','Cagayan Valley','PH',NULL),(846,'Ilagan','Cagayan Valley','PH',NULL),(847,'Baliuag','Central Luzon','PH',NULL),(848,'Surigao','Caraga','PH',NULL),(849,'San Carlos','Western Visayas','PH',NULL),(850,'San Juan del Monte','National Capital Reg','PH',NULL),(851,'Tanauan','Southern Tagalog','PH',NULL),(852,'Concepcion','Central Luzon','PH',NULL),(853,'Rodriguez (Montalban)','Southern Tagalog','PH',NULL),(854,'Sariaya','Southern Tagalog','PH',NULL),(855,'Malasiqui','Ilocos','PH',NULL),(856,'General Mariano Alvarez','Southern Tagalog','PH',NULL),(857,'Urdaneta','Ilocos','PH',NULL),(858,'Hagonoy','Central Luzon','PH',NULL),(859,'San Jose','Southern Tagalog','PH','309'),(860,'Polomolok','Southern Mindanao','PH',NULL),(861,'Santiago','Cagayan Valley','PH',NULL),(862,'Tanza','Southern Tagalog','PH',NULL),(863,'Ozamis','Northern Mindanao','PH',NULL),(864,'Mexico','Central Luzon','PH',NULL),(865,'San Jose','Central Luzon','PH',NULL),(866,'Silay','Western Visayas','PH',NULL),(867,'General Trias','Southern Tagalog','PH',NULL),(868,'Tabaco','Bicol','PH',NULL),(869,'Cabuyao','Southern Tagalog','PH',NULL),(870,'Calapan','Southern Tagalog','PH',NULL),(871,'Mati','Southern Mindanao','PH',NULL),(872,'Midsayap','Central Mindanao','PH',NULL),(873,'Cauayan','Cagayan Valley','PH',NULL),(874,'Gingoog','Northern Mindanao','PH',NULL),(875,'Dumaguete','Central Visayas','PH',NULL),(876,'San Fernando','Ilocos','PH',NULL),(877,'Arayat','Central Luzon','PH',NULL),(878,'Bayawan (Tulong)','Central Visayas','PH',NULL),(879,'Kidapawan','Central Mindanao','PH',NULL),(880,'Daraga (Locsin)','Bicol','PH',NULL),(881,'Marilao','Central Luzon','PH',NULL),(882,'Malita','Southern Mindanao','PH',NULL),(883,'Dipolog','Western Mindanao','PH',NULL),(884,'Cavite','Southern Tagalog','PH','46'),(885,'Danao','Central Visayas','PH',NULL),(886,'Bislig','Caraga','PH',NULL),(887,'Talavera','Central Luzon','PH',NULL),(888,'Guagua','Central Luzon','PH',NULL),(889,'Bayambang','Ilocos','PH',NULL),(890,'Nasugbu','Southern Tagalog','PH',NULL),(891,'Baybay','Eastern Visayas','PH',NULL),(892,'Capas','Central Luzon','PH',NULL),(893,'Sultan Kudarat','ARMM','PH',NULL),(894,'Laoag','Ilocos','PH',NULL),(895,'Bayugan','Caraga','PH',NULL),(896,'Malungon','Southern Mindanao','PH',NULL),(897,'Santa Cruz','Southern Tagalog','PH','831'),(898,'Sorsogon','Bicol','PH',NULL),(899,'Candelaria','Southern Tagalog','PH',NULL),(900,'Ligao','Bicol','PH',NULL),(901,'TÃ³rshavn','Streymoyar','FO',NULL),(902,'Libreville','Estuaire','GA',NULL),(903,'Serekunda','Kombo St Mary','GM',NULL),(904,'Banjul','Banjul','GM',NULL),(905,'Tbilisi','Tbilisi','GE',NULL),(906,'Kutaisi','Imereti','GE',NULL),(907,'Rustavi','Kvemo Kartli','GE',NULL),(908,'Batumi','Adzaria [AtÂšara]','GE',NULL),(909,'Sohumi','Abhasia [Aphazeti]','GE',NULL),(910,'Accra','Greater Accra','GH',NULL),(911,'Kumasi','Ashanti','GH',NULL),(912,'Tamale','Northern','GH',NULL),(913,'Tema','Greater Accra','GH',NULL),(914,'Sekondi-Takoradi','Western','GH',NULL),(915,'Gibraltar','Â–','GI',NULL),(916,'Saint GeorgeÂ´s','St George','GD',NULL),(917,'Nuuk','Kitaa','GL',NULL),(918,'Les Abymes','Grande-Terre','GP',NULL),(919,'Basse-Terre','Basse-Terre','GP',NULL),(920,'Tamuning','Â–','GU',NULL),(921,'AgaÃ±a','Â–','GU',NULL),(922,'Ciudad de Guatemala','Guatemala','GT',NULL),(923,'Mixco','Guatemala','GT',NULL),(924,'Villa Nueva','Guatemala','GT',NULL),(925,'Quetzaltenango','Quetzaltenango','GT',''),(926,'Conakry','Conakry','GN',NULL),(927,'Bissau','Bissau','GW',NULL),(928,'Georgetown','Georgetown','GY',NULL),(929,'Port-au-Prince','Ouest','HT',NULL),(930,'Carrefour','Ouest','HT',NULL),(931,'Delmas','Ouest','HT',NULL),(932,'Le-Cap-HaÃ¯tien','Nord','HT',NULL),(933,'Tegucigalpa','Distrito Central','HN','2'),(934,'San Pedro Sula','CortÃ©s','HN','5'),(935,'La Ceiba','AtlÃ¡ntida','HN',NULL),(936,'Kowloon and New Kowloon','Kowloon and New Kowl','HK',NULL),(937,'Victoria','Hongkong','HK',NULL),(938,'Longyearbyen','LÃ¤nsimaa','SJ',NULL),(939,'Jakarta','Jakarta Raya','ID','21'),(940,'Surabaya','East Java','ID','31'),(941,'Bandung','West Java','ID','22'),(942,'Medan','Sumatera Utara','ID','61'),(943,'Palembang','Sumatera Selatan','ID','71'),(944,'Tangerang','West Java','ID',NULL),(945,'Semarang','Central Java','ID','24'),(946,'Ujung Pandang','Sulawesi Selatan','ID',NULL),(947,'Malang','East Java','ID','34'),(948,'Bandar Lampung','Lampung','ID',NULL),(949,'Bekasi','West Java','ID',NULL),(950,'Padang','Sumatera Barat','ID','75'),(951,'Surakarta','Central Java','ID',NULL),(952,'Banjarmasin','Kalimantan Selatan','ID','511'),(953,'Pekan Baru','Riau','ID',NULL),(954,'Denpasar','Bali','ID','36'),(955,'Yogyakarta','Yogyakarta','ID','27'),(956,'Pontianak','Kalimantan Barat','ID',NULL),(957,'Samarinda','Kalimantan Timur','ID','541'),(958,'Jambi','Jambi','ID',NULL),(959,'Depok','West Java','ID',NULL),(960,'Cimahi','West Java','ID',NULL),(961,'Balikpapan','Kalimantan Timur','ID','542'),(962,'Manado','Sulawesi Utara','ID','431'),(963,'Mataram','Nusa Tenggara Barat','ID','370'),(964,'Pekalongan','Central Java','ID','285'),(965,'Tegal','Central Java','ID',''),(966,'Bogor','West Java','ID','25'),(967,'Ciputat','West Java','ID',NULL),(968,'Pondokgede','West Java','ID',NULL),(969,'Cirebon','West Java','ID','23'),(970,'Kediri','East Java','ID',NULL),(971,'Ambon','Molukit','ID','911'),(972,'Jember','East Java','ID','33'),(973,'Cilacap','Central Java','ID',NULL),(974,'Cimanggis','West Java','ID',NULL),(975,'Pematang Siantar','Sumatera Utara','ID',NULL),(976,'Purwokerto','Central Java','ID',NULL),(977,'Ciomas','West Java','ID',NULL),(978,'Tasikmalaya','West Java','ID','265'),(979,'Madiun','East Java','ID','35'),(980,'Bengkulu','Bengkulu','ID',NULL),(981,'Karawang','West Java','ID',NULL),(982,'Banda Aceh','Aceh','ID',NULL),(983,'Palu','Sulawesi Tengah','ID',NULL),(984,'Pasuruan','East Java','ID',NULL),(985,'Kupang','Nusa Tenggara Timur','ID','39'),(986,'Tebing Tinggi','Sumatera Utara','ID',NULL),(987,'Percut Sei Tuan','Sumatera Utara','ID',NULL),(988,'Binjai','Sumatera Utara','ID',NULL),(989,'Sukabumi','West Java','ID',NULL),(990,'Waru','East Java','ID',NULL),(991,'Pangkal Pinang','Sumatera Selatan','ID',NULL),(992,'Magelang','Central Java','ID',NULL),(993,'Blitar','East Java','ID',NULL),(994,'Serang','West Java','ID',NULL),(995,'Probolinggo','East Java','ID',NULL),(996,'Cilegon','West Java','ID',NULL),(997,'Cianjur','West Java','ID',NULL),(998,'Ciparay','West Java','ID',NULL),(999,'Lhokseumawe','Aceh','ID',NULL),(1000,'Taman','East Java','ID',NULL),(1001,'Depok','Yogyakarta','ID',NULL),(1002,'Citeureup','West Java','ID',NULL),(1003,'Pemalang','Central Java','ID',NULL),(1004,'Klaten','Central Java','ID',NULL),(1005,'Salatiga','Central Java','ID',NULL),(1006,'Cibinong','West Java','ID',NULL),(1007,'Palangka Raya','Kalimantan Tengah','ID',NULL),(1008,'Mojokerto','East Java','ID',NULL),(1009,'Purwakarta','West Java','ID','28'),(1010,'Garut','West Java','ID',NULL),(1011,'Kudus','Central Java','ID','291'),(1012,'Kendari','Sulawesi Tenggara','ID',NULL),(1013,'Jaya Pura','West Irian','ID',NULL),(1014,'Gorontalo','Sulawesi Utara','ID',NULL),(1015,'Majalaya','West Java','ID',NULL),(1016,'Pondok Aren','West Java','ID',NULL),(1017,'Jombang','East Java','ID','32'),(1018,'Sunggal','Sumatera Utara','ID',NULL),(1019,'Batam','Riau','ID','77'),(1020,'Padang Sidempuan','Sumatera Utara','ID',NULL),(1021,'Sawangan','West Java','ID',NULL),(1022,'Banyuwangi','East Java','ID',NULL),(1023,'Tanjung Pinang','Riau','ID',NULL),(1024,'Mumbai (Bombay)','Maharashtra','IN','22'),(1025,'Delhi','Delhi','IN','11'),(1026,'Calcutta [Kolkata]','West Bengali','IN',NULL),(1027,'Chennai (Madras)','Tamil Nadu','IN','44'),(1028,'Hyderabad','Andhra Pradesh','IN','40'),(1029,'Ahmedabad','Gujarat','IN','79'),(1030,'Bangalore','Karnataka','IN','80'),(1031,'Kanpur','Uttar Pradesh','IN','512'),(1032,'Nagpur','Maharashtra','IN','712'),(1033,'Lucknow','Uttar Pradesh','IN','522'),(1034,'Pune','Maharashtra','IN','20'),(1035,'Surat','Gujarat','IN','261'),(1036,'Jaipur','Rajasthan','IN','141'),(1037,'Indore','Madhya Pradesh','IN','731'),(1038,'Bhopal','Madhya Pradesh','IN','755'),(1039,'Ludhiana','Punjab','IN','161'),(1040,'Vadodara (Baroda)','Gujarat','IN','265'),(1041,'Kalyan','Maharashtra','IN',NULL),(1042,'Madurai','Tamil Nadu','IN','452'),(1043,'Haora (Howrah)','West Bengali','IN',NULL),(1044,'Varanasi (Benares)','Uttar Pradesh','IN',NULL),(1045,'Patna','Bihar','IN','612'),(1046,'Srinagar','Jammu and Kashmir','IN','194'),(1047,'Agra','Uttar Pradesh','IN','562'),(1048,'Coimbatore','Tamil Nadu','IN','422'),(1049,'Thane (Thana)','Maharashtra','IN',NULL),(1050,'Allahabad','Uttar Pradesh','IN',NULL),(1051,'Meerut','Uttar Pradesh','IN','121'),(1052,'Vishakhapatnam','Andhra Pradesh','IN',NULL),(1053,'Jabalpur','Madhya Pradesh','IN','761'),(1054,'Amritsar','Punjab','IN','183'),(1055,'Faridabad','Haryana','IN','129'),(1056,'Vijayawada','Andhra Pradesh','IN','866'),(1057,'Gwalior','Madhya Pradesh','IN','751'),(1058,'Jodhpur','Rajasthan','IN','291'),(1059,'Nashik (Nasik)','Maharashtra','IN',NULL),(1060,'Hubli-Dharwad','Karnataka','IN',NULL),(1061,'Solapur (Sholapur)','Maharashtra','IN',NULL),(1062,'Ranchi','Jharkhand','IN','651'),(1063,'Bareilly','Uttar Pradesh','IN','581'),(1064,'Guwahati (Gauhati)','Assam','IN',NULL),(1065,'Shambajinagar (Aurangabad)','Maharashtra','IN',NULL),(1066,'Cochin (Kochi)','Kerala','IN','484'),(1067,'Rajkot','Gujarat','IN','281'),(1068,'Kota','Rajasthan','IN','744'),(1069,'Thiruvananthapuram (Trivandrum','Kerala','IN',NULL),(1070,'Pimpri-Chinchwad','Maharashtra','IN',NULL),(1071,'Jalandhar (Jullundur)','Punjab','IN',NULL),(1072,'Gorakhpur','Uttar Pradesh','IN','551'),(1073,'Chandigarh','Chandigarh','IN','172'),(1074,'Mysore','Karnataka','IN','821'),(1075,'Aligarh','Uttar Pradesh','IN','571'),(1076,'Guntur','Andhra Pradesh','IN','863'),(1077,'Jamshedpur','Jharkhand','IN','657'),(1078,'Ghaziabad','Uttar Pradesh','IN','120'),(1079,'Warangal','Andhra Pradesh','IN','870'),(1080,'Raipur','Chhatisgarh','IN','771'),(1081,'Moradabad','Uttar Pradesh','IN','591'),(1082,'Durgapur','West Bengali','IN',NULL),(1083,'Amravati','Maharashtra','IN','721'),(1084,'Calicut (Kozhikode)','Kerala','IN',NULL),(1085,'Bikaner','Rajasthan','IN','151'),(1086,'Bhubaneswar','Orissa','IN','674'),(1087,'Kolhapur','Maharashtra','IN','231'),(1088,'Kataka (Cuttack)','Orissa','IN',NULL),(1089,'Ajmer','Rajasthan','IN','145'),(1090,'Bhavnagar','Gujarat','IN','278'),(1091,'Tiruchirapalli','Tamil Nadu','IN','431'),(1092,'Bhilai','Chhatisgarh','IN',NULL),(1093,'Bhiwandi','Maharashtra','IN',NULL),(1094,'Saharanpur','Uttar Pradesh','IN','132'),(1095,'Ulhasnagar','Maharashtra','IN',NULL),(1096,'Salem','Tamil Nadu','IN',NULL),(1097,'Ujjain','Madhya Pradesh','IN','734'),(1098,'Malegaon','Maharashtra','IN',NULL),(1099,'Jamnagar','Gujarat','IN','288'),(1100,'Bokaro Steel City','Jharkhand','IN','6542'),(1101,'Akola','Maharashtra','IN','724'),(1102,'Belgaum','Karnataka','IN',NULL),(1103,'Rajahmundry','Andhra Pradesh','IN',NULL),(1104,'Nellore','Andhra Pradesh','IN',NULL),(1105,'Udaipur','Rajasthan','IN','294'),(1106,'New Bombay','Maharashtra','IN',NULL),(1107,'Bhatpara','West Bengali','IN',NULL),(1108,'Gulbarga','Karnataka','IN',NULL),(1109,'New Delhi','Delhi','IN','11'),(1110,'Jhansi','Uttar Pradesh','IN','510'),(1111,'Gaya','Bihar','IN','631'),(1112,'Kakinada','Andhra Pradesh','IN',NULL),(1113,'Dhule (Dhulia)','Maharashtra','IN',NULL),(1114,'Panihati','West Bengali','IN',NULL),(1115,'Nanded (Nander)','Maharashtra','IN',NULL),(1116,'Mangalore','Karnataka','IN',NULL),(1117,'Dehra Dun','Uttaranchal','IN','135'),(1118,'Kamarhati','West Bengali','IN',NULL),(1119,'Davangere','Karnataka','IN',NULL),(1120,'Asansol','West Bengali','IN','341'),(1121,'Bhagalpur','Bihar','IN','641'),(1122,'Bellary','Karnataka','IN',NULL),(1123,'Barddhaman (Burdwan)','West Bengali','IN',NULL),(1124,'Rampur','Uttar Pradesh','IN','595'),(1125,'Jalgaon','Maharashtra','IN','257'),(1126,'Muzaffarpur','Bihar','IN','621'),(1127,'Nizamabad','Andhra Pradesh','IN',NULL),(1128,'Muzaffarnagar','Uttar Pradesh','IN','131'),(1129,'Patiala','Punjab','IN','175'),(1130,'Shahjahanpur','Uttar Pradesh','IN','5842'),(1131,'Kurnool','Andhra Pradesh','IN',NULL),(1132,'Tiruppur (Tirupper)','Tamil Nadu','IN',NULL),(1133,'Rohtak','Haryana','IN',NULL),(1134,'South Dum Dum','West Bengali','IN',NULL),(1135,'Mathura','Uttar Pradesh','IN','565'),(1136,'Chandrapur','Maharashtra','IN','7172'),(1137,'Barahanagar (Baranagar)','West Bengali','IN',NULL),(1138,'Darbhanga','Bihar','IN','6272'),(1139,'Siliguri (Shiliguri)','West Bengali','IN',NULL),(1140,'Raurkela','Orissa','IN',NULL),(1141,'Ambattur','Tamil Nadu','IN',NULL),(1142,'Panipat','Haryana','IN','180'),(1143,'Firozabad','Uttar Pradesh','IN','5612'),(1144,'Ichalkaranji','Maharashtra','IN',NULL),(1145,'Jammu','Jammu and Kashmir','IN','191'),(1146,'Ramagundam','Andhra Pradesh','IN',NULL),(1147,'Eluru','Andhra Pradesh','IN','8812'),(1148,'Brahmapur','Orissa','IN',NULL),(1149,'Alwar','Rajasthan','IN','144'),(1150,'Pondicherry','Pondicherry','IN',NULL),(1151,'Thanjavur','Tamil Nadu','IN','4362'),(1152,'Bihar Sharif','Bihar','IN',NULL),(1153,'Tuticorin','Tamil Nadu','IN',NULL),(1154,'Imphal','Manipur','IN','3852'),(1155,'Latur','Maharashtra','IN','2382'),(1156,'Sagar','Madhya Pradesh','IN','7582'),(1157,'Farrukhabad-cum-Fatehgarh','Uttar Pradesh','IN',NULL),(1158,'Sangli','Maharashtra','IN','233'),(1159,'Parbhani','Maharashtra','IN','2452'),(1160,'Nagar Coil','Tamil Nadu','IN',NULL),(1161,'Bijapur','Karnataka','IN',NULL),(1162,'Kukatpalle','Andhra Pradesh','IN',NULL),(1163,'Bally','West Bengali','IN',NULL),(1164,'Bhilwara','Rajasthan','IN','1482'),(1165,'Ratlam','Madhya Pradesh','IN','7412'),(1166,'Avadi','Tamil Nadu','IN',NULL),(1167,'Dindigul','Tamil Nadu','IN','451'),(1168,'Ahmadnagar','Maharashtra','IN',NULL),(1169,'Bilaspur','Chhatisgarh','IN',NULL),(1170,'Shimoga','Karnataka','IN',NULL),(1171,'Kharagpur','West Bengali','IN','3222'),(1172,'Mira Bhayandar','Maharashtra','IN',NULL),(1173,'Vellore','Tamil Nadu','IN','416'),(1174,'Jalna','Maharashtra','IN','2482'),(1175,'Burnpur','West Bengali','IN',NULL),(1176,'Anantapur','Andhra Pradesh','IN','8554'),(1177,'Allappuzha (Alleppey)','Kerala','IN',NULL),(1178,'Tirupati','Andhra Pradesh','IN',NULL),(1179,'Karnal','Haryana','IN',NULL),(1180,'Burhanpur','Madhya Pradesh','IN','7325'),(1181,'Hisar (Hissar)','Haryana','IN',NULL),(1182,'Tiruvottiyur','Tamil Nadu','IN',NULL),(1183,'Mirzapur-cum-Vindhyachal','Uttar Pradesh','IN',NULL),(1184,'Secunderabad','Andhra Pradesh','IN',NULL),(1185,'Nadiad','Gujarat','IN','268'),(1186,'Dewas','Madhya Pradesh','IN','7272'),(1187,'Murwara (Katni)','Madhya Pradesh','IN',NULL),(1188,'Ganganagar','Rajasthan','IN','154'),(1189,'Vizianagaram','Andhra Pradesh','IN',NULL),(1190,'Erode','Tamil Nadu','IN','424'),(1191,'Machilipatnam (Masulipatam)','Andhra Pradesh','IN',NULL),(1192,'Bhatinda (Bathinda)','Punjab','IN',NULL),(1193,'Raichur','Karnataka','IN',NULL),(1194,'Agartala','Tripura','IN','381'),(1195,'Arrah (Ara)','Bihar','IN',NULL),(1196,'Satna','Madhya Pradesh','IN','7672'),(1197,'Lalbahadur Nagar','Andhra Pradesh','IN',NULL),(1198,'Aizawl','Mizoram','IN','389'),(1199,'Uluberia','West Bengali','IN',NULL),(1200,'Katihar','Bihar','IN','6452'),(1201,'Cuddalore','Tamil Nadu','IN','4142'),(1202,'Hugli-Chinsurah','West Bengali','IN',NULL),(1203,'Dhanbad','Jharkhand','IN','326'),(1204,'Raiganj','West Bengali','IN','3523'),(1205,'Sambhal','Uttar Pradesh','IN',NULL),(1206,'Durg','Chhatisgarh','IN',NULL),(1207,'Munger (Monghyr)','Bihar','IN',NULL),(1208,'Kanchipuram','Tamil Nadu','IN','44'),(1209,'North Dum Dum','West Bengali','IN',NULL),(1210,'Karimnagar','Andhra Pradesh','IN',NULL),(1211,'Bharatpur','Rajasthan','IN','5644'),(1212,'Sikar','Rajasthan','IN','1572'),(1213,'Hardwar (Haridwar)','Uttaranchal','IN',NULL),(1214,'Dabgram','West Bengali','IN',NULL),(1215,'Morena','Madhya Pradesh','IN','7532'),(1216,'Noida','Uttar Pradesh','IN',NULL),(1217,'Hapur','Uttar Pradesh','IN',NULL),(1218,'Bhusawal','Maharashtra','IN',NULL),(1219,'Khandwa','Madhya Pradesh','IN','733'),(1220,'Yamuna Nagar','Haryana','IN',NULL),(1221,'Sonipat (Sonepat)','Haryana','IN',NULL),(1222,'Tenali','Andhra Pradesh','IN',NULL),(1223,'Raurkela Civil Township','Orissa','IN',NULL),(1224,'Kollam (Quilon)','Kerala','IN',NULL),(1225,'Kumbakonam','Tamil Nadu','IN',NULL),(1226,'Ingraj Bazar (English Bazar)','West Bengali','IN',NULL),(1227,'Timkur','Karnataka','IN',NULL),(1228,'Amroha','Uttar Pradesh','IN','5922'),(1229,'Serampore','West Bengali','IN',NULL),(1230,'Chapra','Bihar','IN',NULL),(1231,'Pali','Rajasthan','IN',NULL),(1232,'Maunath Bhanjan','Uttar Pradesh','IN',NULL),(1233,'Adoni','Andhra Pradesh','IN',NULL),(1234,'Jaunpur','Uttar Pradesh','IN','5452'),(1235,'Tirunelveli','Tamil Nadu','IN','462'),(1236,'Bahraich','Uttar Pradesh','IN','5252'),(1237,'Gadag Betigeri','Karnataka','IN',NULL),(1238,'Proddatur','Andhra Pradesh','IN',NULL),(1239,'Chittoor','Andhra Pradesh','IN','8572'),(1240,'Barrackpur','West Bengali','IN',NULL),(1241,'Bharuch (Broach)','Gujarat','IN',NULL),(1242,'Naihati','West Bengali','IN',NULL),(1243,'Shillong','Meghalaya','IN','364'),(1244,'Sambalpur','Orissa','IN','663'),(1245,'Junagadh','Gujarat','IN','285'),(1246,'Rae Bareli','Uttar Pradesh','IN','535'),(1247,'Rewa','Madhya Pradesh','IN','7662'),(1248,'Gurgaon','Haryana','IN','124'),(1249,'Khammam','Andhra Pradesh','IN',NULL),(1250,'Bulandshahr','Uttar Pradesh','IN','5732'),(1251,'Navsari','Gujarat','IN','2637'),(1252,'Malkajgiri','Andhra Pradesh','IN',NULL),(1253,'Midnapore (Medinipur)','West Bengali','IN',NULL),(1254,'Miraj','Maharashtra','IN',NULL),(1255,'Raj Nandgaon','Chhatisgarh','IN',NULL),(1256,'Alandur','Tamil Nadu','IN',NULL),(1257,'Puri','Orissa','IN','6752'),(1258,'Navadwip','West Bengali','IN',NULL),(1259,'Sirsa','Haryana','IN',NULL),(1260,'Korba','Chhatisgarh','IN',NULL),(1261,'Faizabad','Uttar Pradesh','IN','5278'),(1262,'Etawah','Uttar Pradesh','IN','5688'),(1263,'Pathankot','Punjab','IN',NULL),(1264,'Gandhinagar','Gujarat','IN','2712'),(1265,'Palghat (Palakkad)','Kerala','IN',NULL),(1266,'Veraval','Gujarat','IN',NULL),(1267,'Hoshiarpur','Punjab','IN','1882'),(1268,'Ambala','Haryana','IN',NULL),(1269,'Sitapur','Uttar Pradesh','IN','5862'),(1270,'Bhiwani','Haryana','IN',NULL),(1271,'Cuddapah','Andhra Pradesh','IN',NULL),(1272,'Bhimavaram','Andhra Pradesh','IN',NULL),(1273,'Krishnanagar','West Bengali','IN','3472'),(1274,'Chandannagar','West Bengali','IN',NULL),(1275,'Mandya','Karnataka','IN',NULL),(1276,'Dibrugarh','Assam','IN','373'),(1277,'Nandyal','Andhra Pradesh','IN',NULL),(1278,'Balurghat','West Bengali','IN','3522'),(1279,'Neyveli','Tamil Nadu','IN',NULL),(1280,'Fatehpur','Uttar Pradesh','IN','5240'),(1281,'Mahbubnagar','Andhra Pradesh','IN',NULL),(1282,'Budaun','Uttar Pradesh','IN',NULL),(1283,'Porbandar','Gujarat','IN',NULL),(1284,'Silchar','Assam','IN','3842'),(1285,'Berhampore (Baharampur)','West Bengali','IN',NULL),(1286,'Purnea (Purnia)','Jharkhand','IN',NULL),(1287,'Bankura','West Bengali','IN','3242'),(1288,'Rajapalaiyam','Tamil Nadu','IN',NULL),(1289,'Titagarh','West Bengali','IN',NULL),(1290,'Halisahar','West Bengali','IN',NULL),(1291,'Hathras','Uttar Pradesh','IN','5722'),(1292,'Bhir (Bid)','Maharashtra','IN',NULL),(1293,'Pallavaram','Tamil Nadu','IN',NULL),(1294,'Anand','Gujarat','IN','2692'),(1295,'Mango','Jharkhand','IN',NULL),(1296,'Santipur','West Bengali','IN',NULL),(1297,'Bhind','Madhya Pradesh','IN','7534'),(1298,'Gondiya','Maharashtra','IN',NULL),(1299,'Tiruvannamalai','Tamil Nadu','IN',NULL),(1300,'Yeotmal (Yavatmal)','Maharashtra','IN',NULL),(1301,'Kulti-Barakar','West Bengali','IN',NULL),(1302,'Moga','Punjab','IN','1636'),(1303,'Shivapuri','Madhya Pradesh','IN',NULL),(1304,'Bidar','Karnataka','IN',NULL),(1305,'Guntakal','Andhra Pradesh','IN',NULL),(1306,'Unnao','Uttar Pradesh','IN','515'),(1307,'Barasat','West Bengali','IN','33'),(1308,'Tambaram','Tamil Nadu','IN',NULL),(1309,'Abohar','Punjab','IN',NULL),(1310,'Pilibhit','Uttar Pradesh','IN','5882'),(1311,'Valparai','Tamil Nadu','IN',NULL),(1312,'Gonda','Uttar Pradesh','IN','5262'),(1313,'Surendranagar','Gujarat','IN',NULL),(1314,'Qutubullapur','Andhra Pradesh','IN',NULL),(1315,'Beawar','Rajasthan','IN','1462'),(1316,'Hindupur','Andhra Pradesh','IN',NULL),(1317,'Gandhidham','Gujarat','IN',NULL),(1318,'Haldwani-cum-Kathgodam','Uttaranchal','IN',NULL),(1319,'Tellicherry (Thalassery)','Kerala','IN',NULL),(1320,'Wardha','Maharashtra','IN','7152'),(1321,'Rishra','West Bengali','IN',NULL),(1322,'Bhuj','Gujarat','IN','2832'),(1323,'Modinagar','Uttar Pradesh','IN',NULL),(1324,'Gudivada','Andhra Pradesh','IN',NULL),(1325,'Basirhat','West Bengali','IN',NULL),(1326,'Uttarpara-Kotrung','West Bengali','IN',NULL),(1327,'Ongole','Andhra Pradesh','IN',NULL),(1328,'North Barrackpur','West Bengali','IN',NULL),(1329,'Guna','Madhya Pradesh','IN','7542'),(1330,'Haldia','West Bengali','IN',NULL),(1331,'Habra','West Bengali','IN',NULL),(1332,'Kanchrapara','West Bengali','IN',NULL),(1333,'Tonk','Rajasthan','IN','1435'),(1334,'Champdani','West Bengali','IN',NULL),(1335,'Orai','Uttar Pradesh','IN','5162'),(1336,'Pudukkottai','Tamil Nadu','IN','4322'),(1337,'Sasaram','Bihar','IN','6184'),(1338,'Hazaribag','Jharkhand','IN',NULL),(1339,'Palayankottai','Tamil Nadu','IN',NULL),(1340,'Banda','Uttar Pradesh','IN','5192'),(1341,'Godhra','Gujarat','IN',NULL),(1342,'Hospet','Karnataka','IN',NULL),(1343,'Ashoknagar-Kalyangarh','West Bengali','IN',NULL),(1344,'Achalpur','Maharashtra','IN',NULL),(1345,'Patan','Gujarat','IN',NULL),(1346,'Mandasor','Madhya Pradesh','IN',NULL),(1347,'Damoh','Madhya Pradesh','IN','7638'),(1348,'Satara','Maharashtra','IN','2162'),(1349,'Meerut Cantonment','Uttar Pradesh','IN',NULL),(1350,'Dehri','Bihar','IN',NULL),(1351,'Delhi Cantonment','Delhi','IN',NULL),(1352,'Chhindwara','Madhya Pradesh','IN','7162'),(1353,'Bansberia','West Bengali','IN',NULL),(1354,'Nagaon','Assam','IN','3672'),(1355,'Kanpur Cantonment','Uttar Pradesh','IN',NULL),(1356,'Vidisha','Madhya Pradesh','IN','7592'),(1357,'Bettiah','Bihar','IN','6254'),(1358,'Purulia','Jharkhand','IN','3252'),(1359,'Hassan','Karnataka','IN',NULL),(1360,'Ambala Sadar','Haryana','IN',NULL),(1361,'Baidyabati','West Bengali','IN',NULL),(1362,'Morvi','Gujarat','IN',NULL),(1363,'Raigarh','Chhatisgarh','IN',NULL),(1364,'Vejalpur','Gujarat','IN',NULL),(1365,'Baghdad','Baghdad','IQ','1'),(1366,'Mosul','Ninawa','IQ','60'),(1367,'Irbil','Irbil','IQ','66'),(1368,'Kirkuk','al-Tamim','IQ','50'),(1369,'Basra','Basra','IQ','40'),(1370,'al-Sulaymaniya','al-Sulaymaniya','IQ',NULL),(1371,'al-Najaf','al-Najaf','IQ',NULL),(1372,'Karbala','Karbala','IQ','32'),(1373,'al-Hilla','Babil','IQ',NULL),(1374,'al-Nasiriya','DhiQar','IQ',NULL),(1375,'al-Amara','Maysan','IQ',NULL),(1376,'al-Diwaniya','al-Qadisiya','IQ',NULL),(1377,'al-Ramadi','al-Anbar','IQ',NULL),(1378,'al-Kut','Wasit','IQ',NULL),(1379,'Baquba','Diyala','IQ',NULL),(1380,'Teheran','Teheran','IR',NULL),(1381,'Mashhad','Khorasan','IR','511'),(1382,'Esfahan','Esfahan','IR','311'),(1383,'Tabriz','East Azerbaidzan','IR','411'),(1384,'Shiraz','Fars','IR',NULL),(1385,'Karaj','Teheran','IR',NULL),(1386,'Ahvaz','Khuzestan','IR',NULL),(1387,'Qom','Qom','IR',NULL),(1388,'Kermanshah','Kermanshah','IR',NULL),(1389,'Urmia','West Azerbaidzan','IR',NULL),(1390,'Zahedan','Sistan va Baluchesta','IR',NULL),(1391,'Rasht','Gilan','IR',NULL),(1392,'Hamadan','Hamadan','IR',NULL),(1393,'Kerman','Kerman','IR',NULL),(1394,'Arak','Markazi','IR',NULL),(1395,'Ardebil','Ardebil','IR',NULL),(1396,'Yazd','Yazd','IR','352'),(1397,'Qazvin','Qazvin','IR',NULL),(1398,'Zanjan','Zanjan','IR','242'),(1399,'Sanandaj','Kordestan','IR',NULL),(1400,'Bandar-e-Abbas','Hormozgan','IR',NULL),(1401,'Khorramabad','Lorestan','IR',NULL),(1402,'Eslamshahr','Teheran','IR',NULL),(1403,'Borujerd','Lorestan','IR',NULL),(1404,'Abadan','Khuzestan','IR',NULL),(1405,'Dezful','Khuzestan','IR',NULL),(1406,'Kashan','Esfahan','IR',NULL),(1407,'Sari','Mazandaran','IR',NULL),(1408,'Gorgan','Golestan','IR',NULL),(1409,'Najafabad','Esfahan','IR',NULL),(1410,'Sabzevar','Khorasan','IR',NULL),(1411,'Khomeynishahr','Esfahan','IR',NULL),(1412,'Amol','Mazandaran','IR',NULL),(1413,'Neyshabur','Khorasan','IR',NULL),(1414,'Babol','Mazandaran','IR',NULL),(1415,'Khoy','West Azerbaidzan','IR',NULL),(1416,'Malayer','Hamadan','IR',NULL),(1417,'Bushehr','Bushehr','IR',NULL),(1418,'Qaemshahr','Mazandaran','IR',NULL),(1419,'Qarchak','Teheran','IR',NULL),(1420,'Qods','Teheran','IR',NULL),(1421,'Sirjan','Kerman','IR',NULL),(1422,'Bojnurd','Khorasan','IR',NULL),(1423,'Maragheh','East Azerbaidzan','IR',NULL),(1424,'Birjand','Khorasan','IR',NULL),(1425,'Ilam','Ilam','IR',NULL),(1426,'Bukan','West Azerbaidzan','IR',NULL),(1427,'Masjed-e-Soleyman','Khuzestan','IR',NULL),(1428,'Saqqez','Kordestan','IR',NULL),(1429,'Gonbad-e Qabus','Mazandaran','IR',NULL),(1430,'Saveh','Qom','IR',NULL),(1431,'Mahabad','West Azerbaidzan','IR',NULL),(1432,'Varamin','Teheran','IR',NULL),(1433,'Andimeshk','Khuzestan','IR',NULL),(1434,'Khorramshahr','Khuzestan','IR',NULL),(1435,'Shahrud','Semnan','IR',NULL),(1436,'Marv Dasht','Fars','IR',NULL),(1437,'Zabol','Sistan va Baluchesta','IR',NULL),(1438,'Shahr-e Kord','Chaharmahal va Bakht','IR',NULL),(1439,'Bandar-e Anzali','Gilan','IR',NULL),(1440,'Rafsanjan','Kerman','IR',NULL),(1441,'Marand','East Azerbaidzan','IR',NULL),(1442,'Torbat-e Heydariyeh','Khorasan','IR',NULL),(1443,'Jahrom','Fars','IR',NULL),(1444,'Semnan','Semnan','IR',NULL),(1445,'Miandoab','West Azerbaidzan','IR',NULL),(1446,'Qomsheh','Esfahan','IR',NULL),(1447,'Dublin','Leinster','IE','1'),(1448,'Cork','Munster','IE','21'),(1449,'ReykjavÃ­k','HÃ¶fuÃ°borgarsvÃ¦Ã°i','IS',NULL),(1450,'Jerusalem','Jerusalem','IL','2'),(1451,'Tel Aviv-Jaffa','Tel Aviv','IL',NULL),(1452,'Haifa','Haifa','IL','4'),(1453,'Rishon Le Ziyyon','Ha Merkaz','IL',NULL),(1454,'Beerseba','Ha Darom','IL',NULL),(1455,'Holon','Tel Aviv','IL','3'),(1456,'Petah Tiqwa','Ha Merkaz','IL','3'),(1457,'Ashdod','Ha Darom','IL','8'),(1458,'Netanya','Ha Merkaz','IL','9'),(1459,'Bat Yam','Tel Aviv','IL','3'),(1460,'Bene Beraq','Tel Aviv','IL',NULL),(1461,'Ramat Gan','Tel Aviv','IL','3'),(1462,'Ashqelon','Ha Darom','IL',NULL),(1463,'Rehovot','Ha Merkaz','IL','8'),(1464,'Roma','Latium','IT',NULL),(1465,'Milano','Lombardia','IT',NULL),(1466,'Napoli','Campania','IT',NULL),(1467,'Torino','Piemonte','IT',NULL),(1468,'Palermo','Sisilia','IT','91'),(1469,'Genova','Liguria','IT',NULL),(1470,'Bologna','Emilia-Romagna','IT','51'),(1471,'Firenze','Toscana','IT',NULL),(1472,'Catania','Sisilia','IT','95'),(1473,'Bari','Apulia','IT','80'),(1474,'Venezia','Veneto','IT',NULL),(1475,'Messina','Sisilia','IT','90'),(1476,'Verona','Veneto','IT','45'),(1477,'Trieste','Friuli-Venezia Giuli','IT','40'),(1478,'Padova','Veneto','IT',NULL),(1479,'Taranto','Apulia','IT','99'),(1480,'Brescia','Lombardia','IT','30'),(1481,'Reggio di Calabria','Calabria','IT',NULL),(1482,'Modena','Emilia-Romagna','IT','59'),(1483,'Prato','Toscana','IT','574'),(1484,'Parma','Emilia-Romagna','IT','521'),(1485,'Cagliari','Sardinia','IT','70'),(1486,'Livorno','Toscana','IT','586'),(1487,'Perugia','Umbria','IT','75'),(1488,'Foggia','Apulia','IT','881'),(1489,'Reggio nellÂ´ Emilia','Emilia-Romagna','IT',NULL),(1490,'Salerno','Campania','IT','89'),(1491,'Ravenna','Emilia-Romagna','IT','544'),(1492,'Ferrara','Emilia-Romagna','IT','532'),(1493,'Rimini','Emilia-Romagna','IT','541'),(1494,'Syrakusa','Sisilia','IT',NULL),(1495,'Sassari','Sardinia','IT','79'),(1496,'Monza','Lombardia','IT','39'),(1497,'Bergamo','Lombardia','IT','35'),(1498,'Pescara','Abruzzit','IT','85'),(1499,'Latina','Latium','IT',NULL),(1500,'Vicenza','Veneto','IT','444'),(1501,'Terni','Umbria','IT','744'),(1502,'ForlÃ¬','Emilia-Romagna','IT',NULL),(1503,'Trento','Trentino-Alto Adige','IT','461'),(1504,'Novara','Piemonte','IT','321'),(1505,'Piacenza','Emilia-Romagna','IT','523'),(1506,'Ancona','Marche','IT','71'),(1507,'Lecce','Apulia','IT','832'),(1508,'Bolzano','Trentino-Alto Adige','IT','471'),(1509,'Catanzaro','Calabria','IT','961'),(1510,'La Spezia','Liguria','IT','187'),(1511,'Udine','Friuli-Venezia Giuli','IT','432'),(1512,'Torre del Greco','Campania','IT',NULL),(1513,'Andria','Apulia','IT',NULL),(1514,'Brindisi','Apulia','IT','831'),(1515,'Giugliano in Campania','Campania','IT',NULL),(1516,'Pisa','Toscana','IT','50'),(1517,'Barletta','Apulia','IT',NULL),(1518,'Arezzo','Toscana','IT',NULL),(1519,'Alessandria','Piemonte','IT','131'),(1520,'Cesena','Emilia-Romagna','IT',NULL),(1521,'Pesaro','Marche','IT','721'),(1523,'Wien','Wien','AT',NULL),(1524,'Graz','Steiermark','AT','316'),(1525,'Linz','North Austria','AT','70'),(1526,'Salzburg','Salzburg','AT','662'),(1527,'Innsbruck','Tiroli','AT','512'),(1528,'Klagenfurt','KÃ¤rnten','AT','463'),(1529,'Spanish Town','St. Catherine','JM',NULL),(1530,'Kingston','St. Andrew','JM',NULL),(1531,'Portmore','St. Andrew','JM',NULL),(1532,'Tokyo','Tokyo-to','JP','3'),(1533,'Jokohama [Yokohama]','Kanagawa','JP',NULL),(1534,'Osaka','Osaka','JP','66'),(1535,'Nagoya','Aichi','JP','52'),(1536,'Sapporo','Hokkaido','JP','11'),(1537,'Kioto','Kyoto','JP',NULL),(1538,'Kobe','Hyogo','JP','78'),(1539,'Fukuoka','Fukuoka','JP','92'),(1540,'Kawasaki','Kanagawa','JP','44'),(1541,'Hiroshima','Hiroshima','JP','82'),(1542,'Kitakyushu','Fukuoka','JP','93'),(1543,'Sendai','Miyagi','JP','22'),(1544,'Chiba','Chiba','JP','43'),(1545,'Sakai','Osaka','JP','72'),(1546,'Kumamoto','Kumamoto','JP','96'),(1547,'Okayama','Okayama','JP','862'),(1548,'Sagamihara','Kanagawa','JP',NULL),(1549,'Hamamatsu','Shizuoka','JP',NULL),(1550,'Kagoshima','Kagoshima','JP','99'),(1551,'Funabashi','Chiba','JP','47'),(1552,'Higashiosaka','Osaka','JP',NULL),(1553,'Hachioji','Tokyo-to','JP','42'),(1554,'Niigata','Niigata','JP','25'),(1555,'Amagasaki','Hyogo','JP',NULL),(1556,'Himeji','Hyogo','JP','79'),(1557,'Shizuoka','Shizuoka','JP','54'),(1558,'Urawa','Saitama','JP',NULL),(1559,'Matsuyama','Ehime','JP','89'),(1560,'Matsudo','Chiba','JP','47'),(1561,'Kanazawa','Ishikawa','JP','76'),(1562,'Kawaguchi','Saitama','JP','482'),(1563,'Ichikawa','Chiba','JP','47'),(1564,'Omiya','Saitama','JP','48'),(1565,'Utsunomiya','Tochigi','JP','28'),(1566,'Oita','Oita','JP',NULL),(1567,'Nagasaki','Nagasaki','JP','95'),(1568,'Yokosuka','Kanagawa','JP',NULL),(1569,'Kurashiki','Okayama','JP','86'),(1570,'Gifu','Gifu','JP','58'),(1571,'Hirakata','Osaka','JP',NULL),(1572,'Nishinomiya','Hyogo','JP',NULL),(1573,'Toyonaka','Osaka','JP','6'),(1574,'Wakayama','Wakayama','JP','73'),(1575,'Fukuyama','Hiroshima','JP',NULL),(1576,'Fujisawa','Kanagawa','JP',NULL),(1577,'Asahikawa','Hokkaido','JP','166'),(1578,'Machida','Tokyo-to','JP','427'),(1579,'Nara','Nara','JP',NULL),(1580,'Takatsuki','Osaka','JP',NULL),(1581,'Iwaki','Fukushima','JP',NULL),(1582,'Nagano','Nagano','JP','262'),(1583,'Toyohashi','Aichi','JP',NULL),(1584,'Toyota','Aichi','JP','565'),(1585,'Suita','Osaka','JP',NULL),(1586,'Takamatsu','Kagawa','JP','878'),(1587,'Koriyama','Fukushima','JP',NULL),(1588,'Okazaki','Aichi','JP','564'),(1589,'Kawagoe','Saitama','JP',NULL),(1590,'Tokorozawa','Saitama','JP',NULL),(1591,'Toyama','Toyama','JP','764'),(1592,'Kochi','Kochi','JP',NULL),(1593,'Kashiwa','Chiba','JP',NULL),(1594,'Akita','Akita','JP','96'),(1595,'Miyazaki','Miyazaki','JP','985'),(1596,'Koshigaya','Saitama','JP',NULL),(1597,'Naha','Okinawa','JP','98'),(1598,'Aomori','Aomori','JP','177'),(1599,'Hakodate','Hokkaido','JP','138'),(1600,'Akashi','Hyogo','JP',NULL),(1601,'Yokkaichi','Mie','JP','748'),(1602,'Fukushima','Fukushima','JP',NULL),(1603,'Morioka','Iwate','JP','196'),(1604,'Maebashi','Gumma','JP',NULL),(1605,'Kasugai','Aichi','JP','568'),(1606,'Otsu','Shiga','JP',NULL),(1607,'Ichihara','Chiba','JP',NULL),(1608,'Yao','Osaka','JP','729'),(1609,'Ichinomiya','Aichi','JP',NULL),(1610,'Tokushima','Tokushima','JP',NULL),(1611,'Kakogawa','Hyogo','JP',NULL),(1612,'Ibaraki','Osaka','JP',NULL),(1613,'Neyagawa','Osaka','JP',NULL),(1614,'Shimonoseki','Yamaguchi','JP','832'),(1615,'Yamagata','Yamagata','JP',NULL),(1616,'Fukui','Fukui','JP',NULL),(1617,'Hiratsuka','Kanagawa','JP',NULL),(1618,'Mito','Ibaragi','JP','292'),(1619,'Sasebo','Nagasaki','JP','956'),(1620,'Hachinohe','Aomori','JP',NULL),(1621,'Takasaki','Gumma','JP',NULL),(1622,'Shimizu','Shizuoka','JP',NULL),(1623,'Kurume','Fukuoka','JP','942'),(1624,'Fuji','Shizuoka','JP',NULL),(1625,'Soka','Saitama','JP',NULL),(1626,'Fuchu','Tokyo-to','JP',NULL),(1627,'Chigasaki','Kanagawa','JP',NULL),(1628,'Atsugi','Kanagawa','JP',NULL),(1629,'Numazu','Shizuoka','JP',NULL),(1630,'Ageo','Saitama','JP',NULL),(1631,'Yamato','Kanagawa','JP',NULL),(1632,'Matsumoto','Nagano','JP','263'),(1633,'Kure','Hiroshima','JP','823'),(1634,'Takarazuka','Hyogo','JP',NULL),(1635,'Kasukabe','Saitama','JP',NULL),(1636,'Chofu','Tokyo-to','JP',NULL),(1637,'Odawara','Kanagawa','JP',NULL),(1638,'Kofu','Yamanashi','JP','552'),(1639,'Kushiro','Hokkaido','JP',NULL),(1640,'Kishiwada','Osaka','JP','724'),(1641,'Hitachi','Ibaragi','JP',NULL),(1642,'Nagaoka','Niigata','JP','258'),(1643,'Itami','Hyogo','JP',NULL),(1644,'Uji','Kyoto','JP','774'),(1645,'Suzuka','Mie','JP',NULL),(1646,'Hirosaki','Aomori','JP',NULL),(1647,'Ube','Yamaguchi','JP','836'),(1648,'Kodaira','Tokyo-to','JP',NULL),(1649,'Takaoka','Toyama','JP','766'),(1650,'Obihiro','Hokkaido','JP',NULL),(1651,'Tomakomai','Hokkaido','JP',NULL),(1652,'Saga','Saga','JP',NULL),(1653,'Sakura','Chiba','JP',NULL),(1654,'Kamakura','Kanagawa','JP',NULL),(1655,'Mitaka','Tokyo-to','JP',NULL),(1656,'Izumi','Osaka','JP',NULL),(1657,'Hino','Tokyo-to','JP',NULL),(1658,'Hadano','Kanagawa','JP',NULL),(1659,'Ashikaga','Tochigi','JP',NULL),(1660,'Tsu','Mie','JP','592'),(1661,'Sayama','Saitama','JP',NULL),(1662,'Yachiyo','Chiba','JP',NULL),(1663,'Tsukuba','Ibaragi','JP',NULL),(1664,'Tachikawa','Tokyo-to','JP',NULL),(1665,'Kumagaya','Saitama','JP',NULL),(1666,'Moriguchi','Osaka','JP',NULL),(1667,'Otaru','Hokkaido','JP',NULL),(1668,'Anjo','Aichi','JP',NULL),(1669,'Narashino','Chiba','JP',NULL),(1670,'Oyama','Tochigi','JP',NULL),(1671,'Ogaki','Gifu','JP','584'),(1672,'Matsue','Shimane','JP',NULL),(1673,'Kawanishi','Hyogo','JP',NULL),(1674,'Hitachinaka','Tokyo-to','JP',NULL),(1675,'Niiza','Saitama','JP',NULL),(1676,'Nagareyama','Chiba','JP',NULL),(1677,'Tottori','Tottori','JP',NULL),(1678,'Tama','Ibaragi','JP',NULL),(1679,'Iruma','Saitama','JP',NULL),(1680,'Ota','Gumma','JP',NULL),(1681,'Omuta','Fukuoka','JP','9445'),(1682,'Komaki','Aichi','JP',NULL),(1683,'Ome','Tokyo-to','JP',NULL),(1684,'Kadoma','Osaka','JP',NULL),(1685,'Yamaguchi','Yamaguchi','JP','839'),(1686,'Higashimurayama','Tokyo-to','JP',NULL),(1687,'Yonago','Tottori','JP',NULL),(1688,'Matsubara','Osaka','JP',NULL),(1689,'Musashino','Tokyo-to','JP',NULL),(1690,'Tsuchiura','Ibaragi','JP',NULL),(1691,'Joetsu','Niigata','JP',NULL),(1692,'Miyakonojo','Miyazaki','JP',NULL),(1693,'Misato','Saitama','JP',NULL),(1694,'Kakamigahara','Gifu','JP',NULL),(1695,'Daito','Osaka','JP',NULL),(1696,'Seto','Aichi','JP',NULL),(1697,'Kariya','Aichi','JP',NULL),(1698,'Urayasu','Chiba','JP',NULL),(1699,'Beppu','Oita','JP',NULL),(1700,'Niihama','Ehime','JP',NULL),(1701,'Minoo','Osaka','JP',NULL),(1702,'Fujieda','Shizuoka','JP',NULL),(1703,'Abiko','Chiba','JP',NULL),(1704,'Nobeoka','Miyazaki','JP',NULL),(1705,'Tondabayashi','Osaka','JP',NULL),(1706,'Ueda','Nagano','JP',NULL),(1707,'Kashihara','Nara','JP',NULL),(1708,'Matsusaka','Mie','JP',NULL),(1709,'Isesaki','Gumma','JP',NULL),(1710,'Zama','Kanagawa','JP',NULL),(1711,'Kisarazu','Chiba','JP',NULL),(1712,'Noda','Chiba','JP',NULL),(1713,'Ishinomaki','Miyagi','JP',NULL),(1714,'Fujinomiya','Shizuoka','JP',NULL),(1715,'Kawachinagano','Osaka','JP',NULL),(1716,'Imabari','Ehime','JP',NULL),(1717,'Aizuwakamatsu','Fukushima','JP',NULL),(1718,'Higashihiroshima','Hiroshima','JP',NULL),(1719,'Habikino','Osaka','JP',NULL),(1720,'Ebetsu','Hokkaido','JP',NULL),(1721,'Hofu','Yamaguchi','JP',NULL),(1722,'Kiryu','Gumma','JP',NULL),(1723,'Okinawa','Okinawa','JP','98'),(1724,'Yaizu','Shizuoka','JP',NULL),(1725,'Toyokawa','Aichi','JP',NULL),(1726,'Ebina','Kanagawa','JP',NULL),(1727,'Asaka','Saitama','JP',NULL),(1728,'Higashikurume','Tokyo-to','JP',NULL),(1729,'Ikoma','Nara','JP',NULL),(1730,'Kitami','Hokkaido','JP',NULL),(1731,'Koganei','Tokyo-to','JP',NULL),(1732,'Iwatsuki','Saitama','JP',NULL),(1733,'Mishima','Shizuoka','JP',NULL),(1734,'Handa','Aichi','JP',NULL),(1735,'Muroran','Hokkaido','JP',NULL),(1736,'Komatsu','Ishikawa','JP',NULL),(1737,'Yatsushiro','Kumamoto','JP',NULL),(1738,'Iida','Nagano','JP',NULL),(1739,'Tokuyama','Yamaguchi','JP',NULL),(1740,'Kokubunji','Tokyo-to','JP',NULL),(1741,'Akishima','Tokyo-to','JP',NULL),(1742,'Iwakuni','Yamaguchi','JP',NULL),(1743,'Kusatsu','Shiga','JP',NULL),(1744,'Kuwana','Mie','JP',NULL),(1745,'Sanda','Hyogo','JP',NULL),(1746,'Hikone','Shiga','JP',NULL),(1747,'Toda','Saitama','JP',NULL),(1748,'Tajimi','Gifu','JP',NULL),(1749,'Ikeda','Osaka','JP',NULL),(1750,'Fukaya','Saitama','JP',NULL),(1751,'Ise','Mie','JP',NULL),(1752,'Sakata','Yamagata','JP',NULL),(1753,'Kasuga','Fukuoka','JP',NULL),(1754,'Kamagaya','Chiba','JP',NULL),(1755,'Tsuruoka','Yamagata','JP',NULL),(1756,'Hoya','Tokyo-to','JP',NULL),(1757,'Nishio','Chiba','JP',NULL),(1758,'Tokai','Aichi','JP',NULL),(1759,'Inazawa','Aichi','JP',NULL),(1760,'Sakado','Saitama','JP',NULL),(1761,'Isehara','Kanagawa','JP',NULL),(1762,'Takasago','Hyogo','JP',NULL),(1763,'Fujimi','Saitama','JP',NULL),(1764,'Urasoe','Okinawa','JP',NULL),(1765,'Yonezawa','Yamagata','JP',NULL),(1766,'Konan','Aichi','JP',NULL),(1767,'Yamatokoriyama','Nara','JP',NULL),(1768,'Maizuru','Kyoto','JP',NULL),(1769,'Onomichi','Hiroshima','JP',NULL),(1770,'Higashimatsuyama','Saitama','JP',NULL),(1771,'Kimitsu','Chiba','JP',NULL),(1772,'Isahaya','Nagasaki','JP',NULL),(1773,'Kanuma','Tochigi','JP',NULL),(1774,'Izumisano','Osaka','JP',NULL),(1775,'Kameoka','Kyoto','JP',NULL),(1776,'Mobara','Chiba','JP',NULL),(1777,'Narita','Chiba','JP',NULL),(1778,'Kashiwazaki','Niigata','JP',NULL),(1779,'Tsuyama','Okayama','JP',NULL),(1780,'Sanaa','Sanaa','YE',NULL),(1781,'Aden','Aden','YE','2'),(1782,'Taizz','Taizz','YE',NULL),(1783,'Hodeida','Hodeida','YE',NULL),(1784,'al-Mukalla','Hadramawt','YE',NULL),(1785,'Ibb','Ibb','YE',NULL),(1786,'Amman','Amman','JO',NULL),(1787,'al-Zarqa','al-Zarqa','JO',NULL),(1788,'Irbid','Irbid','JO',NULL),(1789,'al-Rusayfa','al-Zarqa','JO',NULL),(1790,'Wadi al-Sir','Amman','JO',NULL),(1791,'Flying Fish Cove','Â–','CX',NULL),(1800,'Phnom Penh','Phnom Penh','KH',NULL),(1801,'Battambang','Battambang','KH',NULL),(1802,'Siem Reap','Siem Reap','KH',NULL),(1803,'Douala','Littoral','CM',NULL),(1804,'YaoundÃ©','Centre','CM',NULL),(1805,'Garoua','Nord','CM',NULL),(1806,'Maroua','ExtrÃªme-Nord','CM',NULL),(1807,'Bamenda','Nord-Ouest','CM',NULL),(1808,'Bafoussam','Ouest','CM',NULL),(1809,'Nkongsamba','Littoral','CM',NULL),(1810,'MontrÃ©al','QuÃ©bec','CA',NULL),(1811,'Calgary','Alberta','CA',NULL),(1812,'Toronto','Ontario','CA','416'),(1813,'North York','Ontario','CA',NULL),(1814,'Winnipeg','Manitoba','CA','204'),(1815,'Edmonton','Alberta','CA','780'),(1816,'Mississauga','Ontario','CA',NULL),(1817,'Scarborough','Ontario','CA',NULL),(1818,'Vancouver','British Colombia','CA',NULL),(1819,'Etobicoke','Ontario','CA',NULL),(1820,'London','Ontario','CA',NULL),(1821,'Hamilton','Ontario','CA',NULL),(1822,'Ottawa','Ontario','CA',NULL),(1823,'Laval','QuÃ©bec','CA',NULL),(1824,'Surrey','British Colombia','CA',NULL),(1825,'Brampton','Ontario','CA',NULL),(1826,'Windsor','Ontario','CA',NULL),(1827,'Saskatoon','Saskatchewan','CA',NULL),(1828,'Kitchener','Ontario','CA',NULL),(1829,'Markham','Ontario','CA',NULL),(1830,'Regina','Saskatchewan','CA','306'),(1831,'Burnaby','British Colombia','CA',NULL),(1832,'QuÃ©bec','QuÃ©bec','CA',NULL),(1833,'York','Ontario','CA',NULL),(1834,'Richmond','British Colombia','CA',NULL),(1835,'Vaughan','Ontario','CA',NULL),(1836,'Burlington','Ontario','CA',NULL),(1837,'Oshawa','Ontario','CA',NULL),(1838,'Oakville','Ontario','CA',NULL),(1839,'Saint Catharines','Ontario','CA',NULL),(1840,'Longueuil','QuÃ©bec','CA',NULL),(1841,'Richmond Hill','Ontario','CA',NULL),(1842,'Thunder Bay','Ontario','CA','807'),(1843,'Nepean','Ontario','CA',NULL),(1844,'Cape Breton','Nova Scotia','CA',NULL),(1845,'East York','Ontario','CA',NULL),(1846,'Halifax','Nova Scotia','CA',NULL),(1847,'Cambridge','Ontario','CA',NULL),(1848,'Gloucester','Ontario','CA',NULL),(1849,'Abbotsford','British Colombia','CA',NULL),(1850,'Guelph','Ontario','CA',NULL),(1851,'Saint JohnÂ´s','Newfoundland','CA',NULL),(1852,'Coquitlam','British Colombia','CA',NULL),(1853,'Saanich','British Colombia','CA',NULL),(1854,'Gatineau','QuÃ©bec','CA',NULL),(1855,'Delta','British Colombia','CA',NULL),(1856,'Sudbury','Ontario','CA',NULL),(1857,'Kelowna','British Colombia','CA',NULL),(1858,'Barrie','Ontario','CA',NULL),(1859,'Praia','SÃ£o Tiago','CV',NULL),(1860,'Almaty','Almaty Qalasy','KZ',NULL),(1861,'Qaraghandy','Qaraghandy','KZ',NULL),(1862,'Shymkent','South Kazakstan','KZ','325'),(1863,'Taraz','Taraz','KZ',NULL),(1864,'Astana','Astana','KZ','7172'),(1865,'Ã–skemen','East Kazakstan','KZ',NULL),(1866,'Pavlodar','Pavlodar','KZ','318'),(1867,'Semey','East Kazakstan','KZ',NULL),(1868,'AqtÃ¶be','AqtÃ¶be','KZ',NULL),(1869,'Qostanay','Qostanay','KZ',NULL),(1870,'Petropavl','North Kazakstan','KZ',NULL),(1871,'Oral','West Kazakstan','KZ',NULL),(1872,'Temirtau','Qaraghandy','KZ',NULL),(1873,'Qyzylorda','Qyzylorda','KZ',NULL),(1874,'Aqtau','Mangghystau','KZ',NULL),(1875,'Atyrau','Atyrau','KZ','312'),(1876,'Ekibastuz','Pavlodar','KZ',NULL),(1877,'KÃ¶kshetau','North Kazakstan','KZ',NULL),(1878,'Rudnyy','Qostanay','KZ',NULL),(1879,'Taldyqorghan','Almaty','KZ',NULL),(1880,'Zhezqazghan','Qaraghandy','KZ',NULL),(1881,'Nairobi','Nairobi','KE','20'),(1882,'Mombasa','Coast','KE','41'),(1883,'Kisumu','Nyanza','KE','57'),(1884,'Nakuru','Rift Valley','KE','51'),(1885,'Machakos','Eastern','KE',NULL),(1886,'Eldoret','Rift Valley','KE',NULL),(1887,'Meru','Eastern','KE','64'),(1888,'Nyeri','Central','KE',NULL),(1889,'Bangui','Bangui','CF',NULL),(1890,'Shanghai','Shanghai','CN','21'),(1891,'Peking','Peking','CN',NULL),(1892,'Chongqing','Chongqing','CN','23'),(1893,'Tianjin','Tianjin','CN','22'),(1894,'Wuhan','Hubei','CN','27'),(1895,'Harbin','Heilongjiang','CN','451'),(1896,'Shenyang','Liaoning','CN','24'),(1897,'Kanton [Guangzhou]','Guangdong','CN',NULL),(1898,'Chengdu','Sichuan','CN','28'),(1899,'Nanking [Nanjing]','Jiangsu','CN',NULL),(1900,'Changchun','Jilin','CN','431'),(1901,'XiÂ´an','Shaanxi','CN',NULL),(1902,'Dalian','Liaoning','CN','411'),(1903,'Qingdao','Shandong','CN','532'),(1904,'Jinan','Shandong','CN','531'),(1905,'Hangzhou','Zhejiang','CN','571'),(1906,'Zhengzhou','Henan','CN','371'),(1907,'Shijiazhuang','Hebei','CN','311'),(1908,'Taiyuan','Shanxi','CN','351'),(1909,'Kunming','Yunnan','CN','871'),(1910,'Changsha','Hunan','CN','731'),(1911,'Nanchang','Jiangxi','CN','791'),(1912,'Fuzhou','Fujian','CN','591'),(1913,'Lanzhou','Gansu','CN','931'),(1914,'Guiyang','Guizhou','CN','851'),(1915,'Ningbo','Zhejiang','CN','574'),(1916,'Hefei','Anhui','CN','551'),(1917,'UrumtÂši [ÃœrÃ¼mqi]','Xinxiang','CN',NULL),(1918,'Anshan','Liaoning','CN','412'),(1919,'Fushun','Liaoning','CN','413'),(1920,'Nanning','Guangxi','CN','771'),(1921,'Zibo','Shandong','CN','533'),(1922,'Qiqihar','Heilongjiang','CN','452'),(1923,'Jilin','Jilin','CN','432'),(1924,'Tangshan','Hebei','CN','315'),(1925,'Baotou','Inner Mongolia','CN','472'),(1926,'Shenzhen','Guangdong','CN','755'),(1927,'Hohhot','Inner Mongolia','CN','471'),(1928,'Handan','Hebei','CN',NULL),(1929,'Wuxi','Jiangsu','CN',NULL),(1930,'Xuzhou','Jiangsu','CN','516'),(1931,'Datong','Shanxi','CN','352'),(1932,'Yichun','Heilongjiang','CN',NULL),(1933,'Benxi','Liaoning','CN','414'),(1934,'Luoyang','Henan','CN','379'),(1935,'Suzhou','Jiangsu','CN',NULL),(1936,'Xining','Qinghai','CN','971'),(1937,'Huainan','Anhui','CN',NULL),(1938,'Jixi','Heilongjiang','CN','4617'),(1939,'Daqing','Heilongjiang','CN','459'),(1940,'Fuxin','Liaoning','CN',NULL),(1941,'Amoy [Xiamen]','Fujian','CN',NULL),(1942,'Liuzhou','Guangxi','CN','772'),(1943,'Shantou','Guangdong','CN','754'),(1944,'Jinzhou','Liaoning','CN','416'),(1945,'Mudanjiang','Heilongjiang','CN','467'),(1946,'Yinchuan','Ningxia','CN','951'),(1947,'Changzhou','Jiangsu','CN','519'),(1948,'Zhangjiakou','Hebei','CN','313'),(1949,'Dandong','Liaoning','CN','415'),(1950,'Hegang','Heilongjiang','CN',NULL),(1951,'Kaifeng','Henan','CN','378'),(1952,'Jiamusi','Heilongjiang','CN',NULL),(1953,'Liaoyang','Liaoning','CN','419'),(1954,'Hengyang','Hunan','CN',NULL),(1955,'Baoding','Hebei','CN','312'),(1956,'Hunjiang','Jilin','CN',NULL),(1957,'Xinxiang','Henan','CN','373'),(1958,'Huangshi','Hubei','CN','714'),(1959,'Haikou','Hainan','CN','898'),(1960,'Yantai','Shandong','CN',NULL),(1961,'Bengbu','Anhui','CN','552'),(1962,'Xiangtan','Hunan','CN','732'),(1963,'Weifang','Shandong','CN','536'),(1964,'Wuhu','Anhui','CN','553'),(1965,'Pingxiang','Jiangxi','CN',NULL),(1966,'Yingkou','Liaoning','CN','417'),(1967,'Anyang','Henan','CN','372'),(1968,'Panzhihua','Sichuan','CN',NULL),(1969,'Pingdingshan','Henan','CN',NULL),(1970,'Xiangfan','Hubei','CN',NULL),(1971,'Zhuzhou','Hunan','CN',NULL),(1972,'Jiaozuo','Henan','CN',NULL),(1973,'Wenzhou','Zhejiang','CN','577'),(1974,'Zhangjiang','Guangdong','CN',NULL),(1975,'Zigong','Sichuan','CN',NULL),(1976,'Shuangyashan','Heilongjiang','CN',NULL),(1977,'Zaozhuang','Shandong','CN',NULL),(1978,'Yakeshi','Inner Mongolia','CN',NULL),(1979,'Yichang','Hubei','CN',NULL),(1980,'Zhenjiang','Jiangsu','CN','511'),(1981,'Huaibei','Anhui','CN',NULL),(1982,'Qinhuangdao','Hebei','CN',NULL),(1983,'Guilin','Guangxi','CN','773'),(1984,'Liupanshui','Guizhou','CN',NULL),(1985,'Panjin','Liaoning','CN',NULL),(1986,'Yangquan','Shanxi','CN','353'),(1987,'Jinxi','Liaoning','CN',NULL),(1988,'Liaoyuan','Jilin','CN',NULL),(1989,'Lianyungang','Jiangsu','CN',NULL),(1990,'Xianyang','Shaanxi','CN','910'),(1991,'TaiÂ´an','Shandong','CN',NULL),(1992,'Chifeng','Inner Mongolia','CN','476'),(1993,'Shaoguan','Guangdong','CN','751'),(1994,'Nantong','Jiangsu','CN','513'),(1995,'Leshan','Sichuan','CN',NULL),(1996,'Baoji','Shaanxi','CN','917'),(1997,'Linyi','Shandong','CN',NULL),(1998,'Tonghua','Jilin','CN',NULL),(1999,'Siping','Jilin','CN','434'),(2000,'Changzhi','Shanxi','CN',NULL),(2001,'Tengzhou','Shandong','CN',NULL),(2002,'Chaozhou','Guangdong','CN',NULL),(2003,'Yangzhou','Jiangsu','CN','514'),(2004,'Dongwan','Guangdong','CN',NULL),(2005,'MaÂ´anshan','Anhui','CN',NULL),(2006,'Foshan','Guangdong','CN','757'),(2007,'Yueyang','Hunan','CN','730'),(2008,'Xingtai','Hebei','CN',NULL),(2009,'Changde','Hunan','CN','736'),(2010,'Shihezi','Xinxiang','CN',NULL),(2011,'Yancheng','Jiangsu','CN',NULL),(2012,'Jiujiang','Jiangxi','CN','792'),(2013,'Dongying','Shandong','CN',NULL),(2014,'Shashi','Hubei','CN',NULL),(2015,'Xintai','Shandong','CN',NULL),(2016,'Jingdezhen','Jiangxi','CN','798'),(2017,'Tongchuan','Shaanxi','CN',NULL),(2018,'Zhongshan','Guangdong','CN',NULL),(2019,'Shiyan','Hubei','CN',NULL),(2020,'Tieli','Heilongjiang','CN',NULL),(2021,'Jining','Shandong','CN','537'),(2022,'Wuhai','Inner Mongolia','CN',NULL),(2023,'Mianyang','Sichuan','CN','816'),(2024,'Luzhou','Sichuan','CN',NULL),(2025,'Zunyi','Guizhou','CN','852'),(2026,'Shizuishan','Ningxia','CN',NULL),(2027,'Neijiang','Sichuan','CN',NULL),(2028,'Tongliao','Inner Mongolia','CN','475'),(2029,'Tieling','Liaoning','CN',NULL),(2030,'Wafangdian','Liaoning','CN',NULL),(2031,'Anqing','Anhui','CN','556'),(2032,'Shaoyang','Hunan','CN','739'),(2033,'Laiwu','Shandong','CN',NULL),(2034,'Chengde','Hebei','CN','314'),(2035,'Tianshui','Gansu','CN','938'),(2036,'Nanyang','Henan','CN','377'),(2037,'Cangzhou','Hebei','CN',NULL),(2038,'Yibin','Sichuan','CN','831'),(2039,'Huaiyin','Jiangsu','CN',NULL),(2040,'Dunhua','Jilin','CN','4435'),(2041,'Yanji','Jilin','CN','433'),(2042,'Jiangmen','Guangdong','CN','750'),(2043,'Tongling','Anhui','CN',NULL),(2044,'Suihua','Heilongjiang','CN',NULL),(2045,'Gongziling','Jilin','CN',NULL),(2046,'Xiantao','Hubei','CN',NULL),(2047,'Chaoyang','Liaoning','CN','421'),(2048,'Ganzhou','Jiangxi','CN','797'),(2049,'Huzhou','Zhejiang','CN','572'),(2050,'Baicheng','Jilin','CN',NULL),(2051,'Shangzi','Heilongjiang','CN',NULL),(2052,'Yangjiang','Guangdong','CN',NULL),(2053,'Qitaihe','Heilongjiang','CN',NULL),(2054,'Gejiu','Yunnan','CN',NULL),(2055,'Jiangyin','Jiangsu','CN',NULL),(2056,'Hebi','Henan','CN',NULL),(2057,'Jiaxing','Zhejiang','CN',NULL),(2058,'Wuzhou','Guangxi','CN',NULL),(2059,'Meihekou','Jilin','CN',NULL),(2060,'Xuchang','Henan','CN',NULL),(2061,'Liaocheng','Shandong','CN',NULL),(2062,'Haicheng','Liaoning','CN',NULL),(2063,'Qianjiang','Hubei','CN',NULL),(2064,'Baiyin','Gansu','CN',NULL),(2065,'BeiÂ´an','Heilongjiang','CN',NULL),(2066,'Yixing','Jiangsu','CN',NULL),(2067,'Laizhou','Shandong','CN',NULL),(2068,'Qaramay','Xinxiang','CN',NULL),(2069,'Acheng','Heilongjiang','CN',NULL),(2070,'Dezhou','Shandong','CN',NULL),(2071,'Nanping','Fujian','CN',NULL),(2072,'Zhaoqing','Guangdong','CN',NULL),(2073,'Beipiao','Liaoning','CN',NULL),(2074,'Fengcheng','Jiangxi','CN','7888'),(2075,'Fuyu','Jilin','CN',NULL),(2076,'Xinyang','Henan','CN','373'),(2077,'Dongtai','Jiangsu','CN',NULL),(2078,'Yuci','Shanxi','CN',NULL),(2079,'Honghu','Hubei','CN',NULL),(2080,'Ezhou','Hubei','CN',NULL),(2081,'Heze','Shandong','CN',NULL),(2082,'Daxian','Sichuan','CN',NULL),(2083,'Linfen','Shanxi','CN',NULL),(2084,'Tianmen','Hubei','CN',NULL),(2085,'Yiyang','Hunan','CN','7038'),(2086,'Quanzhou','Fujian','CN','595'),(2087,'Rizhao','Shandong','CN',NULL),(2088,'Deyang','Sichuan','CN',NULL),(2089,'Guangyuan','Sichuan','CN',NULL),(2090,'Changshu','Jiangsu','CN','512'),(2091,'Zhangzhou','Fujian','CN','596'),(2092,'Hailar','Inner Mongolia','CN',NULL),(2093,'Nanchong','Sichuan','CN',NULL),(2094,'Jiutai','Jilin','CN',NULL),(2095,'Zhaodong','Heilongjiang','CN',NULL),(2096,'Shaoxing','Zhejiang','CN','575'),(2097,'Fuyang','Anhui','CN','571'),(2098,'Maoming','Guangdong','CN','7683'),(2099,'Qujing','Yunnan','CN',NULL),(2100,'Ghulja','Xinxiang','CN',NULL),(2101,'Jiaohe','Jilin','CN',NULL),(2102,'Puyang','Henan','CN',NULL),(2103,'Huadian','Jilin','CN',NULL),(2104,'Jiangyou','Sichuan','CN',NULL),(2105,'Qashqar','Xinxiang','CN',NULL),(2106,'Anshun','Guizhou','CN','853'),(2107,'Fuling','Sichuan','CN',NULL),(2108,'Xinyu','Jiangxi','CN',NULL),(2109,'Hanzhong','Shaanxi','CN','916'),(2110,'Danyang','Jiangsu','CN',NULL),(2111,'Chenzhou','Hunan','CN',NULL),(2112,'Xiaogan','Hubei','CN',NULL),(2113,'Shangqiu','Henan','CN',NULL),(2114,'Zhuhai','Guangdong','CN',NULL),(2115,'Qingyuan','Guangdong','CN',NULL),(2116,'Aqsu','Xinxiang','CN',NULL),(2117,'Jining','Inner Mongolia','CN',NULL),(2118,'Xiaoshan','Zhejiang','CN',NULL),(2119,'Zaoyang','Hubei','CN',NULL),(2120,'Xinghua','Jiangsu','CN',NULL),(2121,'Hami','Xinxiang','CN','9022'),(2122,'Huizhou','Guangdong','CN','752'),(2123,'Jinmen','Hubei','CN',NULL),(2124,'Sanming','Fujian','CN',NULL),(2125,'Ulanhot','Inner Mongolia','CN',NULL),(2126,'Korla','Xinxiang','CN',NULL),(2127,'Wanxian','Sichuan','CN',NULL),(2128,'RuiÂ´an','Zhejiang','CN',NULL),(2129,'Zhoushan','Zhejiang','CN',NULL),(2130,'Liangcheng','Shandong','CN',NULL),(2131,'Jiaozhou','Shandong','CN',NULL),(2132,'Taizhou','Jiangsu','CN',NULL),(2133,'Suzhou','Anhui','CN',NULL),(2134,'Yichun','Jiangxi','CN',NULL),(2135,'Taonan','Jilin','CN',NULL),(2136,'Pingdu','Shandong','CN',NULL),(2137,'JiÂ´an','Jiangxi','CN',NULL),(2138,'Longkou','Shandong','CN',NULL),(2139,'Langfang','Hebei','CN',NULL),(2140,'Zhoukou','Henan','CN',NULL),(2141,'Suining','Sichuan','CN',NULL),(2142,'Yulin','Guangxi','CN','912'),(2143,'Jinhua','Zhejiang','CN',NULL),(2144,'LiuÂ´an','Anhui','CN',NULL),(2145,'Shuangcheng','Heilongjiang','CN','4615'),(2146,'Suizhou','Hubei','CN',NULL),(2147,'Ankang','Shaanxi','CN','915'),(2148,'Weinan','Shaanxi','CN','913'),(2149,'Longjing','Jilin','CN',NULL),(2150,'DaÂ´an','Jilin','CN',NULL),(2151,'Lengshuijiang','Hunan','CN',NULL),(2152,'Laiyang','Shandong','CN',NULL),(2153,'Xianning','Hubei','CN',NULL),(2154,'Dali','Yunnan','CN','872'),(2155,'Anda','Heilongjiang','CN',NULL),(2156,'Jincheng','Shanxi','CN',NULL),(2157,'Longyan','Fujian','CN',NULL),(2158,'Xichang','Sichuan','CN','834'),(2159,'Wendeng','Shandong','CN',NULL),(2160,'Hailun','Heilongjiang','CN','4652'),(2161,'Binzhou','Shandong','CN',NULL),(2162,'Linhe','Inner Mongolia','CN',NULL),(2163,'Wuwei','Gansu','CN',NULL),(2164,'Duyun','Guizhou','CN',NULL),(2165,'Mishan','Heilongjiang','CN',NULL),(2166,'Shangrao','Jiangxi','CN',NULL),(2167,'Changji','Xinxiang','CN','994'),(2168,'Meixian','Guangdong','CN',NULL),(2169,'Yushu','Jilin','CN','976'),(2170,'Tiefa','Liaoning','CN',NULL),(2171,'HuaiÂ´an','Jiangsu','CN',NULL),(2172,'Leiyang','Hunan','CN',NULL),(2173,'Zalantun','Inner Mongolia','CN',NULL),(2174,'Weihai','Shandong','CN',NULL),(2175,'Loudi','Hunan','CN',NULL),(2176,'Qingzhou','Shandong','CN',NULL),(2177,'Qidong','Jiangsu','CN',NULL),(2178,'Huaihua','Hunan','CN',NULL),(2179,'Luohe','Henan','CN',NULL),(2180,'Chuzhou','Anhui','CN',NULL),(2181,'Kaiyuan','Liaoning','CN',NULL),(2182,'Linqing','Shandong','CN',NULL),(2183,'Chaohu','Anhui','CN',NULL),(2184,'Laohekou','Hubei','CN',NULL),(2185,'Dujiangyan','Sichuan','CN',NULL),(2186,'Zhumadian','Henan','CN','3011'),(2187,'Linchuan','Jiangxi','CN',NULL),(2188,'Jiaonan','Shandong','CN',NULL),(2189,'Sanmenxia','Henan','CN',NULL),(2190,'Heyuan','Guangdong','CN',NULL),(2191,'Manzhouli','Inner Mongolia','CN',NULL),(2192,'Lhasa','Tibet','CN','891'),(2193,'Lianyuan','Hunan','CN',NULL),(2194,'Kuytun','Xinxiang','CN',NULL),(2195,'Puqi','Hubei','CN',NULL),(2196,'Hongjiang','Hunan','CN',NULL),(2197,'Qinzhou','Guangxi','CN',NULL),(2198,'Renqiu','Hebei','CN',NULL),(2199,'Yuyao','Zhejiang','CN',NULL),(2200,'Guigang','Guangxi','CN',NULL),(2201,'Kaili','Guizhou','CN',NULL),(2202,'YanÂ´an','Shaanxi','CN',NULL),(2203,'Beihai','Guangxi','CN','779'),(2204,'Xuangzhou','Anhui','CN',NULL),(2205,'Quzhou','Zhejiang','CN',NULL),(2206,'YongÂ´an','Fujian','CN',NULL),(2207,'Zixing','Hunan','CN',NULL),(2208,'Liyang','Jiangsu','CN',NULL),(2209,'Yizheng','Jiangsu','CN',NULL),(2210,'Yumen','Gansu','CN',NULL),(2211,'Liling','Hunan','CN',NULL),(2212,'Yuncheng','Shanxi','CN',NULL),(2213,'Shanwei','Guangdong','CN',NULL),(2214,'Cixi','Zhejiang','CN',NULL),(2215,'Yuanjiang','Hunan','CN',NULL),(2216,'Bozhou','Anhui','CN',NULL),(2217,'Jinchang','Gansu','CN',NULL),(2218,'FuÂ´an','Fujian','CN',NULL),(2219,'Suqian','Jiangsu','CN',NULL),(2220,'Shishou','Hubei','CN',NULL),(2221,'Hengshui','Hebei','CN',NULL),(2222,'Danjiangkou','Hubei','CN',NULL),(2223,'Fujin','Heilongjiang','CN',NULL),(2224,'Sanya','Hainan','CN',NULL),(2225,'Guangshui','Hubei','CN',NULL),(2226,'Huangshan','Anhui','CN',NULL),(2227,'Xingcheng','Liaoning','CN',NULL),(2228,'Zhucheng','Shandong','CN',NULL),(2229,'Kunshan','Jiangsu','CN',NULL),(2230,'Haining','Zhejiang','CN','5834'),(2231,'Pingliang','Gansu','CN','933'),(2232,'Fuqing','Fujian','CN',NULL),(2233,'Xinzhou','Shanxi','CN',NULL),(2234,'Jieyang','Guangdong','CN',NULL),(2235,'Zhangjiagang','Jiangsu','CN',NULL),(2236,'Tong Xian','Peking','CN',NULL),(2237,'YaÂ´an','Sichuan','CN',NULL),(2238,'Jinzhou','Liaoning','CN',NULL),(2239,'Emeishan','Sichuan','CN',NULL),(2240,'Enshi','Hubei','CN',NULL),(2241,'Bose','Guangxi','CN',NULL),(2242,'Yuzhou','Henan','CN',NULL),(2243,'Kaiyuan','Yunnan','CN',NULL),(2244,'Tumen','Jilin','CN',NULL),(2245,'Putian','Fujian','CN',NULL),(2246,'Linhai','Zhejiang','CN','576'),(2247,'Xilin Hot','Inner Mongolia','CN',NULL),(2248,'Shaowu','Fujian','CN',NULL),(2249,'Junan','Shandong','CN',NULL),(2250,'Huaying','Sichuan','CN',NULL),(2251,'Pingyi','Shandong','CN',NULL),(2252,'Huangyan','Zhejiang','CN',NULL),(2253,'Bishkek','Bishkek shaary','KG',NULL),(2254,'Osh','Osh','KG',NULL),(2255,'Bikenibeu','South Tarawa','KI',NULL),(2256,'Bairiki','South Tarawa','KI',NULL),(2257,'SantafÃ© de BogotÃ¡','SantafÃ© de BogotÃ¡','CO',NULL),(2258,'Cali','Valle','CO','2'),(2259,'MedellÃ­n','Antioquia','CO',NULL),(2260,'Barranquilla','AtlÃ¡ntico','CO','5'),(2261,'Cartagena','BolÃ­var','CO',NULL),(2262,'CÃºcuta','Norte de Santander','CO',NULL),(2263,'Bucaramanga','Santander','CO','7'),(2264,'IbaguÃ©','Tolima','CO',NULL),(2265,'Pereira','Risaralda','CO','6'),(2266,'Santa Marta','Magdalena','CO','5'),(2267,'Manizales','Caldas','CO','6'),(2268,'Bello','Antioquia','CO',NULL),(2269,'Pasto','NariÃ±o','CO','27'),(2270,'Neiva','Huila','CO','8'),(2271,'Soledad','AtlÃ¡ntico','CO','831'),(2272,'Armenia','QuindÃ­o','CO','6'),(2273,'Villavicencio','Meta','CO','8'),(2274,'Soacha','Cundinamarca','CO',NULL),(2275,'Valledupar','Cesar','CO',NULL),(2276,'MonterÃ­a','CÃ³rdoba','CO',NULL),(2277,'ItagÃ¼Ã­','Antioquia','CO',NULL),(2278,'Palmira','Valle','CO','2'),(2279,'Buenaventura','Valle','CO','222'),(2280,'Floridablanca','Santander','CO',NULL),(2281,'Sincelejo','Sucre','CO',NULL),(2282,'PopayÃ¡n','Cauca','CO',NULL),(2283,'Barrancabermeja','Santander','CO',NULL),(2284,'Dos Quebradas','Risaralda','CO',NULL),(2285,'TuluÃ¡','Valle','CO',NULL),(2286,'Envigado','Antioquia','CO',NULL),(2287,'Cartago','Valle','CO',NULL),(2288,'Girardot','Cundinamarca','CO',NULL),(2289,'Buga','Valle','CO',NULL),(2290,'Tunja','BoyacÃ¡','CO',NULL),(2291,'Florencia','CaquetÃ¡','CO',NULL),(2292,'Maicao','La Guajira','CO',NULL),(2293,'Sogamoso','BoyacÃ¡','CO',NULL),(2294,'Giron','Santander','CO',NULL),(2295,'Moroni','Njazidja','KM',NULL),(2296,'Brazzaville','Brazzaville','CG',NULL),(2297,'Pointe-Noire','Kouilou','CG',NULL),(2298,'Kinshasa','Kinshasa','CD',NULL),(2299,'Lubumbashi','Shaba','CD',NULL),(2300,'Mbuji-Mayi','East Kasai','CD',NULL),(2301,'Kolwezi','Shaba','CD',NULL),(2302,'Kisangani','Haute-ZaÃ¯re','CD',NULL),(2303,'Kananga','West Kasai','CD',NULL),(2304,'Likasi','Shaba','CD',NULL),(2305,'Bukavu','South Kivu','CD',NULL),(2306,'Kikwit','Bandundu','CD',NULL),(2307,'Tshikapa','West Kasai','CD',NULL),(2308,'Matadi','Bas-ZaÃ¯re','CD',NULL),(2309,'Mbandaka','Equateur','CD',NULL),(2310,'Mwene-Ditu','East Kasai','CD',NULL),(2311,'Boma','Bas-ZaÃ¯re','CD',NULL),(2312,'Uvira','South Kivu','CD',NULL),(2313,'Butembo','North Kivu','CD',NULL),(2314,'Goma','North Kivu','CD',NULL),(2315,'Kalemie','Shaba','CD',NULL),(2316,'Bantam','Home Island','CC',NULL),(2317,'West Island','West Island','CC',NULL),(2318,'Pyongyang','Pyongyang-si','KP',NULL),(2319,'Hamhung','Hamgyong N','KP',NULL),(2320,'Chongjin','Hamgyong P','KP',NULL),(2321,'Nampo','Nampo-si','KP',NULL),(2322,'Sinuiju','Pyongan P','KP',NULL),(2323,'Wonsan','Kangwon','KP',NULL),(2324,'Phyongsong','Pyongan N','KP',NULL),(2325,'Sariwon','Hwanghae P','KP',NULL),(2326,'Haeju','Hwanghae N','KP',NULL),(2327,'Kanggye','Chagang','KP',NULL),(2328,'Kimchaek','Hamgyong P','KP',NULL),(2329,'Hyesan','Yanggang','KP',NULL),(2330,'Kaesong','Kaesong-si','KP',NULL),(2331,'Seoul','Seoul','KR',NULL),(2332,'Pusan','Pusan','KR',NULL),(2333,'Inchon','Inchon','KR',NULL),(2334,'Taegu','Taegu','KR',NULL),(2335,'Taejon','Taejon','KR',NULL),(2336,'Kwangju','Kwangju','KR',NULL),(2337,'Ulsan','Kyongsangnam','KR',NULL),(2338,'Songnam','Kyonggi','KR',NULL),(2339,'Puchon','Kyonggi','KR',NULL),(2340,'Suwon','Kyonggi','KR',NULL),(2341,'Anyang','Kyonggi','KR',NULL),(2342,'Chonju','Chollabuk','KR',NULL),(2343,'Chongju','Chungchongbuk','KR',NULL),(2344,'Koyang','Kyonggi','KR',NULL),(2345,'Ansan','Kyonggi','KR',NULL),(2346,'Pohang','Kyongsangbuk','KR',NULL),(2347,'Chang-won','Kyongsangnam','KR',NULL),(2348,'Masan','Kyongsangnam','KR',NULL),(2349,'Kwangmyong','Kyonggi','KR',NULL),(2350,'Chonan','Chungchongnam','KR',NULL),(2351,'Chinju','Kyongsangnam','KR',NULL),(2352,'Iksan','Chollabuk','KR',NULL),(2353,'Pyongtaek','Kyonggi','KR',NULL),(2354,'Kumi','Kyongsangbuk','KR',NULL),(2355,'Uijongbu','Kyonggi','KR',NULL),(2356,'Kyongju','Kyongsangbuk','KR',NULL),(2357,'Kunsan','Chollabuk','KR',NULL),(2358,'Cheju','Cheju','KR',NULL),(2359,'Kimhae','Kyongsangnam','KR',NULL),(2360,'Sunchon','Chollanam','KR',NULL),(2361,'Mokpo','Chollanam','KR',NULL),(2362,'Yong-in','Kyonggi','KR',NULL),(2363,'Wonju','Kang-won','KR',NULL),(2364,'Kunpo','Kyonggi','KR',NULL),(2365,'Chunchon','Kang-won','KR',NULL),(2366,'Namyangju','Kyonggi','KR',NULL),(2367,'Kangnung','Kang-won','KR',NULL),(2368,'Chungju','Chungchongbuk','KR',NULL),(2369,'Andong','Kyongsangbuk','KR',NULL),(2370,'Yosu','Chollanam','KR',NULL),(2371,'Kyongsan','Kyongsangbuk','KR',NULL),(2372,'Paju','Kyonggi','KR',NULL),(2373,'Yangsan','Kyongsangnam','KR',NULL),(2374,'Ichon','Kyonggi','KR',NULL),(2375,'Asan','Chungchongnam','KR',NULL),(2376,'Koje','Kyongsangnam','KR',NULL),(2377,'Kimchon','Kyongsangbuk','KR',NULL),(2378,'Nonsan','Chungchongnam','KR',NULL),(2379,'Kuri','Kyonggi','KR',NULL),(2380,'Chong-up','Chollabuk','KR',NULL),(2381,'Chechon','Chungchongbuk','KR',NULL),(2382,'Sosan','Chungchongnam','KR',NULL),(2383,'Shihung','Kyonggi','KR',NULL),(2384,'Tong-yong','Kyongsangnam','KR',NULL),(2385,'Kongju','Chungchongnam','KR',NULL),(2386,'Yongju','Kyongsangbuk','KR',NULL),(2387,'Chinhae','Kyongsangnam','KR',NULL),(2388,'Sangju','Kyongsangbuk','KR',NULL),(2389,'Poryong','Chungchongnam','KR',NULL),(2390,'Kwang-yang','Chollanam','KR',NULL),(2391,'Miryang','Kyongsangnam','KR',NULL),(2392,'Hanam','Kyonggi','KR',NULL),(2393,'Kimje','Chollabuk','KR',NULL),(2394,'Yongchon','Kyongsangbuk','KR',NULL),(2395,'Sachon','Kyongsangnam','KR',NULL),(2396,'Uiwang','Kyonggi','KR',NULL),(2397,'Naju','Chollanam','KR',NULL),(2398,'Namwon','Chollabuk','KR',NULL),(2399,'Tonghae','Kang-won','KR',NULL),(2400,'Mun-gyong','Kyongsangbuk','KR',NULL),(2401,'Athenai','Attika','GR',NULL),(2402,'Thessaloniki','Central Macedonia','GR','231'),(2403,'Pireus','Attika','GR',NULL),(2404,'Patras','West Greece','GR','2610'),(2405,'Peristerion','Attika','GR','210'),(2406,'Herakleion','Crete','GR',NULL),(2407,'Kallithea','Attika','GR','210'),(2408,'Larisa','Thessalia','GR',NULL),(2409,'Zagreb','Grad Zagreb','HR','1'),(2410,'Split','Split-Dalmatia','HR','21'),(2411,'Rijeka','Primorje-Gorski Kota','HR','51'),(2412,'Osijek','Osijek-Baranja','HR','31'),(2413,'La Habana','La Habana','CU',NULL),(2414,'Santiago de Cuba','Santiago de Cuba','CU','226'),(2415,'CamagÃ¼ey','CamagÃ¼ey','CU',NULL),(2416,'HolguÃ­n','HolguÃ­n','CU',NULL),(2417,'Santa Clara','Villa Clara','CU',NULL),(2418,'GuantÃ¡namo','GuantÃ¡namo','CU',NULL),(2419,'Pinar del RÃ­o','Pinar del RÃ­o','CU',NULL),(2420,'Bayamo','Granma','CU','23'),(2421,'Cienfuegos','Cienfuegos','CU','432'),(2422,'Victoria de las Tunas','Las Tunas','CU',NULL),(2423,'Matanzas','Matanzas','CU','52'),(2424,'Manzanillo','Granma','CU','23'),(2425,'Sancti-SpÃ­ritus','Sancti-SpÃ­ritus','CU',NULL),(2426,'Ciego de Ãvila','Ciego de Ãvila','CU',NULL),(2427,'al-Salimiya','Hawalli','KW',NULL),(2428,'Jalib al-Shuyukh','Hawalli','KW',NULL),(2429,'Kuwait','al-Asima','KW',NULL),(2430,'Nicosia','Nicosia','CY','22'),(2431,'Limassol','Limassol','CY','25'),(2432,'Vientiane','Viangchan','LA',NULL),(2433,'Savannakhet','Savannakhet','LA',NULL),(2434,'Riga','Riika','LV',NULL),(2435,'Daugavpils','Daugavpils','LV',NULL),(2436,'Liepaja','Liepaja','LV',NULL),(2437,'Maseru','Maseru','LS',NULL),(2438,'Beirut','Beirut','LB',NULL),(2439,'Tripoli','al-Shamal','LB',NULL),(2440,'Monrovia','Montserrado','LR',NULL),(2441,'Tripoli','Tripoli','LY',NULL),(2442,'Bengasi','Bengasi','LY',NULL),(2443,'Misrata','Misrata','LY',NULL),(2444,'al-Zawiya','al-Zawiya','LY',NULL),(2445,'Schaan','Schaan','LI',NULL),(2446,'Vaduz','Vaduz','LI',NULL),(2447,'Vilnius','Vilna','LT',NULL),(2448,'Kaunas','Kaunas','LT',NULL),(2449,'Klaipeda','Klaipeda','LT',NULL),(2450,'ÂŠiauliai','ÂŠiauliai','LT',NULL),(2451,'Panevezys','Panevezys','LT',NULL),(2452,'Luxembourg [Luxemburg/LÃ«tzebuerg]','Luxembourg','LU',NULL),(2453,'El-AaiÃºn','El-AaiÃºn','EH',NULL),(2454,'Macao','Macau','MO',NULL),(2455,'Antananarivo','Antananarivo','MG',NULL),(2456,'Toamasina','Toamasina','MG',NULL),(2457,'AntsirabÃ©','Antananarivo','MG',NULL),(2458,'Mahajanga','Mahajanga','MG',NULL),(2459,'Fianarantsoa','Fianarantsoa','MG',NULL),(2460,'Skopje','Skopje','MK','2'),(2461,'Blantyre','Blantyre','MW',NULL),(2462,'Lilongwe','Lilongwe','MW',NULL),(2463,'Male','Maale','MV',NULL),(2464,'Kuala Lumpur','Wilayah Persekutuan','MY','3'),(2465,'Ipoh','Perak','MY','5'),(2466,'Johor Baharu','Johor','MY',NULL),(2467,'Petaling Jaya','Selangor','MY',NULL),(2468,'Kelang','Selangor','MY',NULL),(2469,'Kuala Terengganu','Terengganu','MY','9'),(2470,'Pinang','Pulau Pinang','MY',NULL),(2471,'Kota Bharu','Kelantan','MY',NULL),(2472,'Kuantan','Pahang','MY','9'),(2473,'Taiping','Perak','MY',NULL),(2474,'Seremban','Negeri Sembilan','MY','6'),(2475,'Kuching','Sarawak','MY','8'),(2476,'Sibu','Sarawak','MY','8'),(2477,'Sandakan','Sabah','MY','8'),(2478,'Alor Setar','Kedah','MY',NULL),(2479,'Selayang Baru','Selangor','MY',NULL),(2480,'Sungai Petani','Kedah','MY',NULL),(2481,'Shah Alam','Selangor','MY',NULL),(2482,'Bamako','Bamako','ML',NULL),(2483,'Birkirkara','Outer Harbour','MT',NULL),(2484,'Valletta','Inner Harbour','MT',NULL),(2485,'Casablanca','Casablanca','MA','22'),(2486,'Rabat','Rabat-SalÃ©-Zammour-','MA','37'),(2487,'Marrakech','Marrakech-Tensift-Al','MA',NULL),(2488,'FÃ¨s','FÃ¨s-Boulemane','MA',NULL),(2489,'Tanger','Tanger-TÃ©touan','MA',NULL),(2490,'SalÃ©','Rabat-SalÃ©-Zammour-','MA',NULL),(2491,'MeknÃ¨s','MeknÃ¨s-Tafilalet','MA',NULL),(2492,'Oujda','Oriental','MA','56'),(2493,'KÃ©nitra','Gharb-Chrarda-BÃ©ni','MA',NULL),(2494,'TÃ©touan','Tanger-TÃ©touan','MA',NULL),(2495,'Safi','Doukkala-Abda','MA',NULL),(2496,'Agadir','Souss Massa-DraÃ¢','MA','548'),(2497,'Mohammedia','Casablanca','MA',NULL),(2498,'Khouribga','Chaouia-Ouardigha','MA',NULL),(2499,'Beni-Mellal','Tadla-Azilal','MA',NULL),(2500,'TÃ©mara','Rabat-SalÃ©-Zammour-','MA',NULL),(2501,'El Jadida','Doukkala-Abda','MA',NULL),(2502,'Nador','Oriental','MA',NULL),(2503,'Ksar el Kebir','Tanger-TÃ©touan','MA',NULL),(2504,'Settat','Chaouia-Ouardigha','MA',NULL),(2505,'Taza','Taza-Al Hoceima-Taou','MA',NULL),(2506,'El Araich','Tanger-TÃ©touan','MA',NULL),(2507,'Dalap-Uliga-Darrit','Majuro','MH',NULL),(2508,'Fort-de-France','Fort-de-France','MQ',NULL),(2509,'Nouakchott','Nouakchott','MR',NULL),(2510,'NouÃ¢dhibou','Dakhlet NouÃ¢dhibou','MR',NULL),(2511,'Port-Louis','Port-Louis','MU',NULL),(2512,'Beau Bassin-Rose Hill','Plaines Wilhelms','MU',NULL),(2513,'Vacoas-Phoenix','Plaines Wilhelms','MU',NULL),(2514,'Mamoutzou','Mamoutzou','YT',NULL),(2515,'Ciudad de MÃ©xico','Distrito Federal','MX',NULL),(2516,'Guadalajara','Jalisco','MX','33'),(2517,'Ecatepec de Morelos','MÃ©xico','MX',NULL),(2518,'Puebla','Puebla','MX','222'),(2519,'NezahualcÃ³yotl','MÃ©xico','MX',NULL),(2520,'JuÃ¡rez','Chihuahua','MX',NULL),(2521,'Tijuana','Baja California','MX','664'),(2522,'LeÃ³n','Guanajuato','MX',NULL),(2523,'Monterrey','Nuevo LeÃ³n','MX','81'),(2524,'Zapopan','Jalisco','MX',NULL),(2525,'Naucalpan de JuÃ¡rez','MÃ©xico','MX',NULL),(2526,'Mexicali','Baja California','MX','686'),(2527,'CuliacÃ¡n','Sinaloa','MX',NULL),(2528,'Acapulco de JuÃ¡rez','Guerrero','MX',NULL),(2529,'Tlalnepantla de Baz','MÃ©xico','MX',NULL),(2530,'MÃ©rida','YucatÃ¡n','MX',NULL),(2531,'Chihuahua','Chihuahua','MX','614'),(2532,'San Luis PotosÃ­','San Luis PotosÃ­','MX',NULL),(2533,'Guadalupe','Nuevo LeÃ³n','MX',NULL),(2534,'Toluca','MÃ©xico','MX','815'),(2535,'Aguascalientes','Aguascalientes','MX','449'),(2536,'QuerÃ©taro','QuerÃ©taro de Arteag','MX',NULL),(2537,'Morelia','MichoacÃ¡n de Ocampo','MX','443'),(2538,'Hermosillo','Sonora','MX','662'),(2539,'Saltillo','Coahuila de Zaragoza','MX','844'),(2540,'TorreÃ³n','Coahuila de Zaragoza','MX',NULL),(2541,'Centro (Villahermosa)','Tabasco','MX',NULL),(2542,'San NicolÃ¡s de los Garza','Nuevo LeÃ³n','MX',NULL),(2543,'Durango','Durango','MX','618'),(2544,'ChimalhuacÃ¡n','MÃ©xico','MX',NULL),(2545,'Tlaquepaque','Jalisco','MX',NULL),(2546,'AtizapÃ¡n de Zaragoza','MÃ©xico','MX',NULL),(2547,'Veracruz','Veracruz','MX','229'),(2548,'CuautitlÃ¡n Izcalli','MÃ©xico','MX',NULL),(2549,'Irapuato','Guanajuato','MX','462'),(2550,'Tuxtla GutiÃ©rrez','Chiapas','MX',NULL),(2551,'TultitlÃ¡n','MÃ©xico','MX',NULL),(2552,'Reynosa','Tamaulipas','MX','899'),(2553,'Benito JuÃ¡rez','Quintana Roo','MX',NULL),(2554,'Matamoros','Tamaulipas','MX','871'),(2555,'Xalapa','Veracruz','MX',NULL),(2556,'Celaya','Guanajuato','MX','461'),(2557,'MazatlÃ¡n','Sinaloa','MX',NULL),(2558,'Ensenada','Baja California','MX','646'),(2559,'Ahome','Sinaloa','MX',NULL),(2560,'Cajeme','Sonora','MX',NULL),(2561,'Cuernavaca','Morelos','MX','777'),(2562,'TonalÃ¡','Jalisco','MX',NULL),(2563,'Valle de Chalco Solidaridad','MÃ©xico','MX',NULL),(2564,'Nuevo Laredo','Tamaulipas','MX','867'),(2565,'Tepic','Nayarit','MX',NULL),(2566,'Tampico','Tamaulipas','MX','833'),(2567,'Ixtapaluca','MÃ©xico','MX',NULL),(2568,'Apodaca','Nuevo LeÃ³n','MX',NULL),(2569,'Guasave','Sinaloa','MX',NULL),(2570,'GÃ³mez Palacio','Durango','MX',NULL),(2571,'Tapachula','Chiapas','MX',NULL),(2572,'NicolÃ¡s Romero','MÃ©xico','MX',NULL),(2573,'Coatzacoalcos','Veracruz','MX',NULL),(2574,'Uruapan','MichoacÃ¡n de Ocampo','MX',NULL),(2575,'Victoria','Tamaulipas','MX',NULL),(2576,'Oaxaca de JuÃ¡rez','Oaxaca','MX',NULL),(2577,'Coacalco de BerriozÃ¡bal','MÃ©xico','MX',NULL),(2578,'Pachuca de Soto','Hidalgo','MX',NULL),(2579,'General Escobedo','Nuevo LeÃ³n','MX',NULL),(2580,'Salamanca','Guanajuato','MX',NULL),(2581,'Santa Catarina','Nuevo LeÃ³n','MX',NULL),(2582,'TehuacÃ¡n','Puebla','MX',NULL),(2583,'Chalco','MÃ©xico','MX',NULL),(2584,'CÃ¡rdenas','Tabasco','MX',NULL),(2585,'Campeche','Campeche','MX','981'),(2586,'La Paz','MÃ©xico','MX',NULL),(2587,'OthÃ³n P. Blanco (Chetumal)','Quintana Roo','MX',NULL),(2588,'Texcoco','MÃ©xico','MX',NULL),(2589,'La Paz','Baja California Sur','MX',NULL),(2590,'Metepec','MÃ©xico','MX',NULL),(2591,'Monclova','Coahuila de Zaragoza','MX',NULL),(2592,'Huixquilucan','MÃ©xico','MX',NULL),(2593,'Chilpancingo de los Bravo','Guerrero','MX',NULL),(2594,'Puerto Vallarta','Jalisco','MX','322'),(2595,'Fresnillo','Zacatecas','MX',NULL),(2596,'Ciudad Madero','Tamaulipas','MX',NULL),(2597,'Soledad de Graciano SÃ¡nchez','San Luis PotosÃ­','MX',NULL),(2598,'San Juan del RÃ­o','QuerÃ©taro','MX',NULL),(2599,'San Felipe del Progreso','MÃ©xico','MX',NULL),(2600,'CÃ³rdoba','Veracruz','MX',NULL),(2601,'TecÃ¡mac','MÃ©xico','MX',NULL),(2602,'Ocosingo','Chiapas','MX',NULL),(2603,'Carmen','Campeche','MX',NULL),(2604,'LÃ¡zaro CÃ¡rdenas','MichoacÃ¡n de Ocampo','MX',NULL),(2605,'Jiutepec','Morelos','MX',NULL),(2606,'Papantla','Veracruz','MX',NULL),(2607,'Comalcalco','Tabasco','MX',NULL),(2608,'Zamora','MichoacÃ¡n de Ocampo','MX',NULL),(2609,'Nogales','Sonora','MX','631'),(2610,'Huimanguillo','Tabasco','MX',NULL),(2611,'Cuautla','Morelos','MX',NULL),(2612,'MinatitlÃ¡n','Veracruz','MX',NULL),(2613,'Poza Rica de Hidalgo','Veracruz','MX',NULL),(2614,'Ciudad Valles','San Luis PotosÃ­','MX',NULL),(2615,'Navolato','Sinaloa','MX',NULL),(2616,'San Luis RÃ­o Colorado','Sonora','MX',NULL),(2617,'PÃ©njamo','Guanajuato','MX',NULL),(2618,'San AndrÃ©s Tuxtla','Veracruz','MX',NULL),(2619,'Guanajuato','Guanajuato','MX',NULL),(2620,'Navojoa','Sonora','MX',NULL),(2621,'ZitÃ¡cuaro','MichoacÃ¡n de Ocampo','MX',NULL),(2622,'Boca del RÃ­o','Veracruz-Llave','MX',NULL),(2623,'Allende','Guanajuato','MX',NULL),(2624,'Silao','Guanajuato','MX',NULL),(2625,'Macuspana','Tabasco','MX',NULL),(2626,'San Juan Bautista Tuxtepec','Oaxaca','MX',NULL),(2627,'San CristÃ³bal de las Casas','Chiapas','MX',NULL),(2628,'Valle de Santiago','Guanajuato','MX',NULL),(2629,'Guaymas','Sonora','MX',NULL),(2630,'Colima','Colima','MX',NULL),(2631,'Dolores Hidalgo','Guanajuato','MX',NULL),(2632,'Lagos de Moreno','Jalisco','MX',NULL),(2633,'Piedras Negras','Coahuila de Zaragoza','MX',NULL),(2634,'Altamira','Tamaulipas','MX',NULL),(2635,'TÃºxpam','Veracruz','MX',NULL),(2636,'San Pedro Garza GarcÃ­a','Nuevo LeÃ³n','MX',NULL),(2637,'CuauhtÃ©moc','Chihuahua','MX',NULL),(2638,'Manzanillo','Colima','MX',NULL),(2639,'Iguala de la Independencia','Guerrero','MX',NULL),(2640,'Zacatecas','Zacatecas','MX',NULL),(2641,'Tlajomulco de ZÃºÃ±iga','Jalisco','MX',NULL),(2642,'Tulancingo de Bravo','Hidalgo','MX',NULL),(2643,'Zinacantepec','MÃ©xico','MX',NULL),(2644,'San MartÃ­n Texmelucan','Puebla','MX',NULL),(2645,'TepatitlÃ¡n de Morelos','Jalisco','MX',NULL),(2646,'MartÃ­nez de la Torre','Veracruz','MX',NULL),(2647,'Orizaba','Veracruz','MX',NULL),(2648,'ApatzingÃ¡n','MichoacÃ¡n de Ocampo','MX',NULL),(2649,'Atlixco','Puebla','MX',NULL),(2650,'Delicias','Chihuahua','MX',NULL),(2651,'Ixtlahuaca','MÃ©xico','MX',NULL),(2652,'El Mante','Tamaulipas','MX',NULL),(2653,'Lerdo','Durango','MX',NULL),(2654,'Almoloya de JuÃ¡rez','MÃ©xico','MX',NULL),(2655,'AcÃ¡mbaro','Guanajuato','MX',NULL),(2656,'AcuÃ±a','Coahuila de Zaragoza','MX',NULL),(2657,'Guadalupe','Zacatecas','MX',NULL),(2658,'Huejutla de Reyes','Hidalgo','MX',NULL),(2659,'Hidalgo','MichoacÃ¡n de Ocampo','MX',NULL),(2660,'Los Cabos','Baja California Sur','MX',NULL),(2661,'ComitÃ¡n de DomÃ­nguez','Chiapas','MX',NULL),(2662,'CunduacÃ¡n','Tabasco','MX',NULL),(2663,'RÃ­o Bravo','Tamaulipas','MX',NULL),(2664,'Temapache','Veracruz','MX',NULL),(2665,'Chilapa de Alvarez','Guerrero','MX',NULL),(2666,'Hidalgo del Parral','Chihuahua','MX',NULL),(2667,'San Francisco del RincÃ³n','Guanajuato','MX',NULL),(2668,'Taxco de AlarcÃ³n','Guerrero','MX',NULL),(2669,'Zumpango','MÃ©xico','MX',NULL),(2670,'San Pedro Cholula','Puebla','MX',NULL),(2671,'Lerma','MÃ©xico','MX',NULL),(2672,'TecomÃ¡n','Colima','MX',NULL),(2673,'Las Margaritas','Chiapas','MX',NULL),(2674,'Cosoleacaque','Veracruz','MX',NULL),(2675,'San Luis de la Paz','Guanajuato','MX',NULL),(2676,'JosÃ© Azueta','Guerrero','MX',NULL),(2677,'Santiago Ixcuintla','Nayarit','MX',NULL),(2678,'San Felipe','Guanajuato','MX',NULL),(2679,'Tejupilco','MÃ©xico','MX',NULL),(2680,'Tantoyuca','Veracruz','MX',NULL),(2681,'Salvatierra','Guanajuato','MX',NULL),(2682,'Tultepec','MÃ©xico','MX',NULL),(2683,'Temixco','Morelos','MX',NULL),(2684,'Matamoros','Coahuila de Zaragoza','MX',NULL),(2685,'PÃ¡nuco','Veracruz','MX',NULL),(2686,'El Fuerte','Sinaloa','MX',NULL),(2687,'Tierra Blanca','Veracruz','MX',NULL),(2688,'Weno','Chuuk','FM',NULL),(2689,'Palikir','Pohnpei','FM',NULL),(2690,'Chisinau','Chisinau','MD',NULL),(2691,'Tiraspol','Dnjestria','MD',NULL),(2692,'Balti','Balti','MD',NULL),(2693,'Bender (TÃ®ghina)','Bender (TÃ®ghina)','MD',NULL),(2694,'Monte-Carlo','Â–','MC',NULL),(2695,'Monaco-Ville','Â–','MC',NULL),(2696,'Ulan Bator','Ulaanbaatar','MN',NULL),(2697,'Plymouth','Plymouth','MS',NULL),(2698,'Maputo','Maputo','MZ',NULL),(2699,'Matola','Maputo','MZ',NULL),(2700,'Beira','Sofala','MZ',NULL),(2701,'Nampula','Nampula','MZ',NULL),(2702,'Chimoio','Manica','MZ',NULL),(2703,'NaÃ§ala-Porto','Nampula','MZ',NULL),(2704,'Quelimane','ZambÃ©zia','MZ',NULL),(2705,'Mocuba','ZambÃ©zia','MZ',NULL),(2706,'Tete','Tete','MZ',NULL),(2707,'Xai-Xai','Gaza','MZ',NULL),(2708,'Gurue','ZambÃ©zia','MZ',NULL),(2709,'Maxixe','Inhambane','MZ',NULL),(2710,'Rangoon (Yangon)','Rangoon [Yangon]','MM',NULL),(2711,'Mandalay','Mandalay','MM',NULL),(2712,'Moulmein (Mawlamyine)','Mon','MM',NULL),(2713,'Pegu (Bago)','Pegu [Bago]','MM',NULL),(2714,'Bassein (Pathein)','Irrawaddy [Ayeyarwad','MM',NULL),(2715,'Monywa','Sagaing','MM',NULL),(2716,'Sittwe (Akyab)','Rakhine','MM',NULL),(2717,'Taunggyi (Taunggye)','Shan','MM',NULL),(2718,'Meikhtila','Mandalay','MM',NULL),(2719,'Mergui (Myeik)','Tenasserim [Tanintha','MM',NULL),(2720,'Lashio (Lasho)','Shan','MM',NULL),(2721,'Prome (Pyay)','Pegu [Bago]','MM',NULL),(2722,'Henzada (Hinthada)','Irrawaddy [Ayeyarwad','MM',NULL),(2723,'Myingyan','Mandalay','MM',NULL),(2724,'Tavoy (Dawei)','Tenasserim [Tanintha','MM',NULL),(2725,'Pagakku (Pakokku)','Magwe [Magway]','MM',NULL),(2726,'Windhoek','Khomas','NA',NULL),(2727,'Yangor','Â–','NR',NULL),(2728,'Yaren','Â–','NR',NULL),(2729,'Kathmandu','Central','NP',NULL),(2730,'Biratnagar','Eastern','NP',NULL),(2731,'Pokhara','Western','NP',NULL),(2732,'Lalitapur','Central','NP',NULL),(2733,'Birgunj','Central','NP',NULL),(2734,'Managua','Managua','NI',NULL),(2735,'LeÃ³n','LeÃ³n','NI',NULL),(2736,'Chinandega','Chinandega','NI',NULL),(2737,'Masaya','Masaya','NI',NULL),(2738,'Niamey','Niamey','NE',NULL),(2739,'Zinder','Zinder','NE',NULL),(2740,'Maradi','Maradi','NE',NULL),(2741,'Lagos','Lagos','NG','1'),(2742,'Ibadan','Oyo & Osun','NG','2'),(2743,'Ogbomosho','Oyo & Osun','NG',NULL),(2744,'Kano','Kano & Jigawa','NG','64'),(2745,'Oshogbo','Oyo & Osun','NG','35'),(2746,'Ilorin','Kwara & Kogi','NG','31'),(2747,'Abeokuta','Ogun','NG','39'),(2748,'Port Harcourt','Rivers & Bayelsa','NG','84'),(2749,'Zaria','Kaduna','NG','69'),(2750,'Ilesha','Oyo & Osun','NG',NULL),(2751,'Onitsha','Anambra & Enugu & Eb','NG','46'),(2752,'Iwo','Oyo & Osun','NG',NULL),(2753,'Ado-Ekiti','Ondo & Ekiti','NG',NULL),(2754,'Abuja','Federal Capital Dist','NG','9'),(2755,'Kaduna','Kaduna','NG','62'),(2756,'Mushin','Lagos','NG',NULL),(2757,'Maiduguri','Borno & Yobe','NG','76'),(2758,'Enugu','Anambra & Enugu & Eb','NG','42'),(2759,'Ede','Oyo & Osun','NG',NULL),(2760,'Aba','Imo & Abia','NG','82'),(2761,'Ife','Oyo & Osun','NG',NULL),(2762,'Ila','Oyo & Osun','NG',NULL),(2763,'Oyo','Oyo & Osun','NG','38'),(2764,'Ikerre','Ondo & Ekiti','NG',NULL),(2765,'Benin City','Edo & Delta','NG',NULL),(2766,'Iseyin','Oyo & Osun','NG',NULL),(2767,'Katsina','Katsina','NG','65'),(2768,'Jos','Plateau & Nassarawa','NG','73'),(2769,'Sokoto','Sokoto & Kebbi & Zam','NG',NULL),(2770,'Ilobu','Oyo & Osun','NG',NULL),(2771,'Offa','Kwara & Kogi','NG',NULL),(2772,'Ikorodu','Lagos','NG',NULL),(2773,'Ilawe-Ekiti','Ondo & Ekiti','NG',NULL),(2774,'Owo','Ondo & Ekiti','NG','51'),(2775,'Ikirun','Oyo & Osun','NG',NULL),(2776,'Shaki','Oyo & Osun','NG',NULL),(2777,'Calabar','Cross River','NG','87'),(2778,'Ondo','Ondo & Ekiti','NG',NULL),(2779,'Akure','Ondo & Ekiti','NG','34'),(2780,'Gusau','Sokoto & Kebbi & Zam','NG','63'),(2781,'Ijebu-Ode','Ogun','NG',NULL),(2782,'Effon-Alaiye','Oyo & Osun','NG',NULL),(2783,'Kumo','Bauchi & Gombe','NG',NULL),(2784,'Shomolu','Lagos','NG',NULL),(2785,'Oka-Akoko','Ondo & Ekiti','NG',NULL),(2786,'Ikare','Ondo & Ekiti','NG','50'),(2787,'Sapele','Edo & Delta','NG','54'),(2788,'Deba Habe','Bauchi & Gombe','NG',NULL),(2789,'Minna','Niger','NG','66'),(2790,'Warri','Edo & Delta','NG','53'),(2791,'Bida','Niger','NG',NULL),(2792,'Ikire','Oyo & Osun','NG',NULL),(2793,'Makurdi','Benue','NG','44'),(2794,'Lafia','Plateau & Nassarawa','NG','47'),(2795,'Inisa','Oyo & Osun','NG',NULL),(2796,'Shagamu','Ogun','NG',NULL),(2797,'Awka','Anambra & Enugu & Eb','NG','48'),(2798,'Gombe','Bauchi & Gombe','NG','72'),(2799,'Igboho','Oyo & Osun','NG',NULL),(2800,'Ejigbo','Oyo & Osun','NG',NULL),(2801,'Agege','Lagos','NG',NULL),(2802,'Ise-Ekiti','Ondo & Ekiti','NG',NULL),(2803,'Ugep','Cross River','NG',NULL),(2804,'Epe','Lagos','NG',NULL),(2805,'Alofi','Â–','NU',NULL),(2806,'Kingston','Â–','NF',NULL),(2807,'Oslo','Oslo','NO','2'),(2808,'Bergen','Hordaland','NO','5'),(2809,'Trondheim','SÃ¸r-TrÃ¸ndelag','NO',NULL),(2810,'Stavanger','Rogaland','NO',NULL),(2811,'BÃ¦rum','Akershus','NO',NULL),(2812,'Abidjan','Abidjan','CI',NULL),(2813,'BouakÃ©','BouakÃ©','CI',NULL),(2814,'Yamoussoukro','Yamoussoukro','CI',NULL),(2815,'Daloa','Daloa','CI',NULL),(2816,'Korhogo','Korhogo','CI',NULL),(2817,'al-Sib','Masqat','OM',NULL),(2818,'Salala','Zufar','OM',NULL),(2819,'Bawshar','Masqat','OM',NULL),(2820,'Suhar','al-Batina','OM',NULL),(2821,'Masqat','Masqat','OM',NULL),(2822,'Karachi','Sindh','PK','21'),(2823,'Lahore','Punjab','PK','42'),(2824,'Faisalabad','Punjab','PK','41'),(2825,'Rawalpindi','Punjab','PK','51'),(2826,'Multan','Punjab','PK','61'),(2827,'Hyderabad','Sindh','PK',NULL),(2828,'Gujranwala','Punjab','PK','431'),(2829,'Peshawar','Nothwest Border Prov','PK','91'),(2830,'Quetta','Baluchistan','PK','81'),(2831,'Islamabad','Islamabad','PK','51'),(2832,'Sargodha','Punjab','PK','451'),(2833,'Sialkot','Punjab','PK','524'),(2834,'Bahawalpur','Punjab','PK',NULL),(2835,'Sukkur','Sindh','PK',NULL),(2836,'Jhang','Punjab','PK',NULL),(2837,'Sheikhupura','Punjab','PK',NULL),(2838,'Larkana','Sindh','PK',NULL),(2839,'Gujrat','Punjab','PK',NULL),(2840,'Mardan','Nothwest Border Prov','PK',NULL),(2841,'Kasur','Punjab','PK',NULL),(2842,'Rahim Yar Khan','Punjab','PK',NULL),(2843,'Sahiwal','Punjab','PK','441'),(2844,'Okara','Punjab','PK','442'),(2845,'Wah','Punjab','PK',NULL),(2846,'Dera Ghazi Khan','Punjab','PK',NULL),(2847,'Mirpur Khas','Sind','PK',NULL),(2848,'Nawabshah','Sind','PK',NULL),(2849,'Mingora','Nothwest Border Prov','PK',NULL),(2850,'Chiniot','Punjab','PK',NULL),(2851,'Kamoke','Punjab','PK',NULL),(2852,'Mandi Burewala','Punjab','PK',NULL),(2853,'Jhelum','Punjab','PK',NULL),(2854,'Sadiqabad','Punjab','PK',NULL),(2855,'Jacobabad','Sind','PK',NULL),(2856,'Shikarpur','Sind','PK',NULL),(2857,'Khanewal','Punjab','PK',NULL),(2858,'Hafizabad','Punjab','PK',NULL),(2859,'Kohat','Nothwest Border Prov','PK',NULL),(2860,'Muzaffargarh','Punjab','PK',NULL),(2861,'Khanpur','Punjab','PK',NULL),(2862,'Gojra','Punjab','PK',NULL),(2863,'Bahawalnagar','Punjab','PK',NULL),(2864,'Muridke','Punjab','PK',NULL),(2865,'Pak Pattan','Punjab','PK',NULL),(2866,'Abottabad','Nothwest Border Prov','PK',NULL),(2867,'Tando Adam','Sind','PK',NULL),(2868,'Jaranwala','Punjab','PK',NULL),(2869,'Khairpur','Sind','PK',NULL),(2870,'Chishtian Mandi','Punjab','PK',NULL),(2871,'Daska','Punjab','PK',NULL),(2872,'Dadu','Sind','PK',NULL),(2873,'Mandi Bahauddin','Punjab','PK',NULL),(2874,'Ahmadpur East','Punjab','PK',NULL),(2875,'Kamalia','Punjab','PK',NULL),(2876,'Khuzdar','Baluchistan','PK',NULL),(2877,'Vihari','Punjab','PK',NULL),(2878,'Dera Ismail Khan','Nothwest Border Prov','PK',NULL),(2879,'Wazirabad','Punjab','PK',NULL),(2880,'Nowshera','Nothwest Border Prov','PK',NULL),(2881,'Koror','Koror','PW',NULL),(2882,'Ciudad de PanamÃ¡','PanamÃ¡','PA',NULL),(2883,'San Miguelito','San Miguelito','PA',NULL),(2884,'Port Moresby','National Capital Dis','PG',''),(2885,'AsunciÃ³n','AsunciÃ³n','PY',NULL),(2886,'Ciudad del Este','Alto ParanÃ¡','PY',NULL),(2887,'San Lorenzo','Central','PY',NULL),(2888,'LambarÃ©','Central','PY',NULL),(2889,'Fernando de la Mora','Central','PY',NULL),(2890,'Lima','Lima','PE','1'),(2891,'Arequipa','Arequipa','PE','54'),(2892,'Trujillo','La Libertad','PE','44'),(2893,'Chiclayo','Lambayeque','PE','74'),(2894,'Callao','Callao','PE','14'),(2895,'Iquitos','Loreto','PE','94'),(2896,'Chimbote','Ancash','PE','44'),(2897,'Huancayo','JunÃ­n','PE',NULL),(2898,'Piura','Piura','PE','74'),(2899,'Cusco','Cusco','PE','84'),(2900,'Pucallpa','Ucayali','PE',NULL),(2901,'Tacna','Tacna','PE','54'),(2902,'Ica','Ica','PE','34'),(2903,'Sullana','Piura','PE',NULL),(2904,'Juliaca','Puno','PE',NULL),(2905,'HuÃ¡nuco','Huanuco','PE',NULL),(2906,'Ayacucho','Ayacucho','PE',NULL),(2907,'Chincha Alta','Ica','PE',NULL),(2908,'Cajamarca','Cajamarca','PE','44'),(2909,'Puno','Puno','PE',NULL),(2910,'Ventanilla','Callao','PE',NULL),(2911,'Castilla','Piura','PE',NULL),(2912,'Adamstown','Â–','PN',NULL),(2913,'Garapan','Saipan','MP',NULL),(2914,'Lisboa','Lisboa','PT',NULL),(2915,'Porto','Porto','PT','22'),(2916,'Amadora','Lisboa','PT','21'),(2917,'CoÃ­mbra','CoÃ­mbra','PT',NULL),(2918,'Braga','Braga','PT','253'),(2919,'San Juan','San Juan','PR',NULL),(2920,'BayamÃ³n','BayamÃ³n','PR',NULL),(2921,'Ponce','Ponce','PR',NULL),(2922,'Carolina','Carolina','PR',NULL),(2923,'Caguas','Caguas','PR',NULL),(2924,'Arecibo','Arecibo','PR',NULL),(2925,'Guaynabo','Guaynabo','PR',NULL),(2926,'MayagÃ¼ez','MayagÃ¼ez','PR',NULL),(2927,'Toa Baja','Toa Baja','PR',NULL),(2928,'Warszawa','Mazowieckie','PL',NULL),(2929,'LÃ³dz','Lodzkie','PL',NULL),(2930,'KrakÃ³w','Malopolskie','PL',NULL),(2931,'Wroclaw','Dolnoslaskie','PL','71'),(2932,'Poznan','Wielkopolskie','PL','61'),(2933,'Gdansk','Pomorskie','PL','58'),(2934,'Szczecin','Zachodnio-Pomorskie','PL','91'),(2935,'Bydgoszcz','Kujawsko-Pomorskie','PL',NULL),(2936,'Lublin','Lubelskie','PL','81'),(2937,'Katowice','Slaskie','PL','32'),(2938,'Bialystok','Podlaskie','PL','85'),(2939,'Czestochowa','Slaskie','PL','34'),(2940,'Gdynia','Pomorskie','PL','58'),(2941,'Sosnowiec','Slaskie','PL','32'),(2942,'Radom','Mazowieckie','PL',NULL),(2943,'Kielce','Swietokrzyskie','PL','41'),(2944,'Gliwice','Slaskie','PL',NULL),(2945,'Torun','Kujawsko-Pomorskie','PL',NULL),(2946,'Bytom','Slaskie','PL',NULL),(2947,'Zabrze','Slaskie','PL','32'),(2948,'Bielsko-Biala','Slaskie','PL',NULL),(2949,'Olsztyn','Warminsko-Mazurskie','PL',NULL),(2950,'RzeszÃ³w','Podkarpackie','PL',NULL),(2951,'Ruda Slaska','Slaskie','PL',NULL),(2952,'Rybnik','Slaskie','PL','36'),(2953,'Walbrzych','Dolnoslaskie','PL',NULL),(2954,'Tychy','Slaskie','PL','59'),(2955,'Dabrowa GÃ³rnicza','Slaskie','PL',NULL),(2956,'Plock','Mazowieckie','PL','24'),(2957,'Elblag','Warminsko-Mazurskie','PL','50'),(2958,'Opole','Opolskie','PL',NULL),(2959,'GorzÃ³w Wielkopolski','Lubuskie','PL',NULL),(2960,'Wloclawek','Kujawsko-Pomorskie','PL',NULL),(2961,'ChorzÃ³w','Slaskie','PL',NULL),(2962,'TarnÃ³w','Malopolskie','PL',NULL),(2963,'Zielona GÃ³ra','Lubuskie','PL',NULL),(2964,'Koszalin','Zachodnio-Pomorskie','PL','94'),(2965,'Legnica','Dolnoslaskie','PL','76'),(2966,'Kalisz','Wielkopolskie','PL','62'),(2967,'Grudziadz','Kujawsko-Pomorskie','PL',NULL),(2968,'Slupsk','Pomorskie','PL',NULL),(2969,'Jastrzebie-ZdrÃ³j','Slaskie','PL',NULL),(2970,'Jaworzno','Slaskie','PL',NULL),(2971,'Jelenia GÃ³ra','Dolnoslaskie','PL',NULL),(2972,'Malabo','Bioko','GQ',NULL),(2973,'Doha','Doha','QA',NULL),(2974,'Paris','ÃŽle-de-France','FR','1'),(2975,'Marseille','Provence-Alpes-CÃ´te','FR','4'),(2976,'Lyon','RhÃ´ne-Alpes','FR','4'),(2977,'Toulouse','Midi-PyrÃ©nÃ©es','FR','5'),(2978,'Nice','Provence-Alpes-CÃ´te','FR','4'),(2979,'Nantes','Pays de la Loire','FR','2'),(2980,'Strasbourg','Alsace','FR','3'),(2981,'Montpellier','Languedoc-Roussillon','FR','4'),(2982,'Bordeaux','Aquitaine','FR','5'),(2983,'Rennes','Haute-Normandie','FR','2'),(2984,'Le Havre','Champagne-Ardenne','FR','2'),(2985,'Reims','Nord-Pas-de-Calais','FR','3'),(2986,'Lille','RhÃ´ne-Alpes','FR','3'),(2987,'St-Ã‰tienne','Bretagne','FR',NULL),(2988,'Toulon','Provence-Alpes-CÃ´te','FR','4'),(2989,'Grenoble','RhÃ´ne-Alpes','FR','4'),(2990,'Angers','Pays de la Loire','FR','2'),(2991,'Dijon','Bourgogne','FR','3'),(2992,'Brest','Bretagne','FR','2'),(2993,'Le Mans','Pays de la Loire','FR','2'),(2994,'Clermont-Ferrand','Auvergne','FR',NULL),(2995,'Amiens','Picardie','FR',NULL),(2996,'Aix-en-Provence','Provence-Alpes-CÃ´te','FR',NULL),(2997,'Limoges','Limousin','FR','5'),(2998,'NÃ®mes','Languedoc-Roussillon','FR',NULL),(2999,'Tours','Centre','FR','2'),(3000,'Villeurbanne','RhÃ´ne-Alpes','FR','4'),(3001,'Metz','Lorraine','FR',NULL),(3002,'BesanÃ§on','Franche-ComtÃ©','FR',NULL),(3003,'Caen','Basse-Normandie','FR','2'),(3004,'OrlÃ©ans','Centre','FR',NULL),(3005,'Mulhouse','Alsace','FR','3'),(3006,'Rouen','Haute-Normandie','FR','2'),(3007,'Boulogne-Billancourt','ÃŽle-de-France','FR',NULL),(3008,'Perpignan','Languedoc-Roussillon','FR','4'),(3009,'Nancy','Lorraine','FR','3'),(3010,'Roubaix','Nord-Pas-de-Calais','FR',NULL),(3011,'Argenteuil','ÃŽle-de-France','FR',NULL),(3012,'Tourcoing','Nord-Pas-de-Calais','FR',NULL),(3013,'Montreuil','ÃŽle-de-France','FR',NULL),(3014,'Cayenne','Cayenne','GF',NULL),(3015,'Faaa','Tahiti','PF',NULL),(3016,'Papeete','Tahiti','PF',NULL),(3017,'Saint-Denis','Saint-Denis','RE',NULL),(3047,'Kigali','Kigali','RW',NULL),(3048,'Stockholm','Lisboa','SE','8'),(3049,'Gothenburg [GÃ¶teborg]','West GÃ¶tanmaan lÃ¤n','SE',NULL),(3050,'MalmÃ¶','SkÃ¥ne lÃ¤n','SE',NULL),(3051,'Uppsala','Uppsala lÃ¤n','SE','18'),(3052,'LinkÃ¶ping','East GÃ¶tanmaan lÃ¤n','SE',NULL),(3053,'VÃ¤sterÃ¥s','VÃ¤stmanlands lÃ¤n','SE',NULL),(3054,'Ã–rebro','Ã–rebros lÃ¤n','SE',NULL),(3055,'NorrkÃ¶ping','East GÃ¶tanmaan lÃ¤n','SE',NULL),(3056,'Helsingborg','SkÃ¥ne lÃ¤n','SE','42'),(3057,'JÃ¶nkÃ¶ping','JÃ¶nkÃ¶pings lÃ¤n','SE',NULL),(3058,'UmeÃ¥','VÃ¤sterbottens lÃ¤n','SE',NULL),(3059,'Lund','SkÃ¥ne lÃ¤n','SE',NULL),(3060,'BorÃ¥s','West GÃ¶tanmaan lÃ¤n','SE',NULL),(3061,'Sundsvall','VÃ¤sternorrlands lÃ¤','SE','60'),(3062,'GÃ¤vle','GÃ¤vleborgs lÃ¤n','SE',NULL),(3063,'Jamestown','Saint Helena','SH',NULL),(3064,'Basseterre','St George Basseterre','KN',NULL),(3065,'Castries','Castries','LC',NULL),(3066,'Kingstown','St George','VC',NULL),(3067,'Saint-Pierre','Saint-Pierre','PM',NULL),(3068,'Berlin','Berliini','DE','30'),(3069,'Hamburg','Hamburg','DE','40'),(3070,'Munich [MÃ¼nchen]','Baijeri','DE',NULL),(3071,'KÃ¶ln','Nordrhein-Westfalen','DE',NULL),(3072,'Frankfurt am Main','Hessen','DE','69'),(3073,'Essen','Nordrhein-Westfalen','DE','201'),(3074,'Dortmund','Nordrhein-Westfalen','DE','231'),(3075,'Stuttgart','Baden-WÃ¼rttemberg','DE','711'),(3076,'DÃ¼sseldorf','Nordrhein-Westfalen','DE',NULL),(3077,'Bremen','Bremen','DE','421'),(3078,'Duisburg','Nordrhein-Westfalen','DE','203'),(3079,'Hannover','Niedersachsen','DE','511'),(3080,'Leipzig','Saksi','DE','341'),(3081,'NÃ¼rnberg','Baijeri','DE',NULL),(3082,'Dresden','Saksi','DE','351'),(3083,'Bochum','Nordrhein-Westfalen','DE',NULL),(3084,'Wuppertal','Nordrhein-Westfalen','DE','202'),(3085,'Bielefeld','Nordrhein-Westfalen','DE','521'),(3086,'Mannheim','Baden-WÃ¼rttemberg','DE','621'),(3087,'Bonn','Nordrhein-Westfalen','DE','228'),(3088,'Gelsenkirchen','Nordrhein-Westfalen','DE','209'),(3089,'Karlsruhe','Baden-WÃ¼rttemberg','DE','721'),(3090,'Wiesbaden','Hessen','DE','611'),(3091,'MÃ¼nster','Nordrhein-Westfalen','DE',NULL),(3092,'MÃ¶nchengladbach','Nordrhein-Westfalen','DE',NULL),(3093,'Chemnitz','Saksi','DE','371'),(3094,'Augsburg','Baijeri','DE','821'),(3095,'Halle/Saale','Anhalt Sachsen','DE',NULL),(3096,'Braunschweig','Niedersachsen','DE','531'),(3097,'Aachen','Nordrhein-Westfalen','DE','241'),(3098,'Krefeld','Nordrhein-Westfalen','DE','2151'),(3099,'Magdeburg','Anhalt Sachsen','DE','391'),(3100,'Kiel','Schleswig-Holstein','DE','431'),(3101,'Oberhausen','Nordrhein-Westfalen','DE','208'),(3102,'LÃ¼beck','Schleswig-Holstein','DE',NULL),(3103,'Hagen','Nordrhein-Westfalen','DE','2331'),(3104,'Rostock','Mecklenburg-Vorpomme','DE','381'),(3105,'Freiburg im Breisgau','Baden-WÃ¼rttemberg','DE',NULL),(3106,'Erfurt','ThÃ¼ringen','DE','361'),(3107,'Kassel','Hessen','DE','561'),(3108,'SaarbrÃ¼cken','Saarland','DE',NULL),(3109,'Mainz','Rheinland-Pfalz','DE','6131'),(3110,'Hamm','Nordrhein-Westfalen','DE','2381'),(3111,'Herne','Nordrhein-Westfalen','DE','2323'),(3112,'MÃ¼lheim an der Ruhr','Nordrhein-Westfalen','DE',NULL),(3113,'Solingen','Nordrhein-Westfalen','DE','212'),(3114,'OsnabrÃ¼ck','Niedersachsen','DE',NULL),(3115,'Ludwigshafen am Rhein','Rheinland-Pfalz','DE',NULL),(3116,'Leverkusen','Nordrhein-Westfalen','DE','214'),(3117,'Oldenburg','Niedersachsen','DE','441'),(3118,'Neuss','Nordrhein-Westfalen','DE','2131'),(3119,'Heidelberg','Baden-WÃ¼rttemberg','DE','6221'),(3120,'Darmstadt','Hessen','DE','6151'),(3121,'Paderborn','Nordrhein-Westfalen','DE','5251'),(3122,'Potsdam','Brandenburg','DE','331'),(3123,'WÃ¼rzburg','Baijeri','DE',NULL),(3124,'Regensburg','Baijeri','DE','941'),(3125,'Recklinghausen','Nordrhein-Westfalen','DE','2361'),(3126,'GÃ¶ttingen','Niedersachsen','DE',NULL),(3127,'Bremerhaven','Bremen','DE','471'),(3128,'Wolfsburg','Niedersachsen','DE','5361'),(3129,'Bottrop','Nordrhein-Westfalen','DE','2041'),(3130,'Remscheid','Nordrhein-Westfalen','DE','2191'),(3131,'Heilbronn','Baden-WÃ¼rttemberg','DE','7131'),(3132,'Pforzheim','Baden-WÃ¼rttemberg','DE','7231'),(3133,'Offenbach am Main','Hessen','DE',NULL),(3134,'Ulm','Baden-WÃ¼rttemberg','DE','731'),(3135,'Ingolstadt','Baijeri','DE','841'),(3136,'Gera','ThÃ¼ringen','DE','365'),(3137,'Salzgitter','Niedersachsen','DE','5341'),(3138,'Cottbus','Brandenburg','DE','355'),(3139,'Reutlingen','Baden-WÃ¼rttemberg','DE',NULL),(3140,'FÃ¼rth','Baijeri','DE',NULL),(3141,'Siegen','Nordrhein-Westfalen','DE','271'),(3142,'Koblenz','Rheinland-Pfalz','DE','261'),(3143,'Moers','Nordrhein-Westfalen','DE',NULL),(3144,'Bergisch Gladbach','Nordrhein-Westfalen','DE','2202'),(3145,'Zwickau','Saksi','DE','375'),(3146,'Hildesheim','Niedersachsen','DE','5121'),(3147,'Witten','Nordrhein-Westfalen','DE',NULL),(3148,'Schwerin','Mecklenburg-Vorpomme','DE','385'),(3149,'Erlangen','Baijeri','DE','9131'),(3150,'Kaiserslautern','Rheinland-Pfalz','DE',NULL),(3151,'Trier','Rheinland-Pfalz','DE',NULL),(3152,'Jena','ThÃ¼ringen','DE',NULL),(3153,'Iserlohn','Nordrhein-Westfalen','DE',NULL),(3154,'GÃ¼tersloh','Nordrhein-Westfalen','DE',NULL),(3155,'Marl','Nordrhein-Westfalen','DE',NULL),(3156,'LÃ¼nen','Nordrhein-Westfalen','DE',NULL),(3157,'DÃ¼ren','Nordrhein-Westfalen','DE',NULL),(3158,'Ratingen','Nordrhein-Westfalen','DE',NULL),(3159,'Velbert','Nordrhein-Westfalen','DE',NULL),(3160,'Esslingen am Neckar','Baden-WÃ¼rttemberg','DE',NULL),(3161,'Honiara','Honiara','SB',NULL),(3162,'Lusaka','Lusaka','ZM',NULL),(3163,'Ndola','Copperbelt','ZM',NULL),(3164,'Kitwe','Copperbelt','ZM',NULL),(3165,'Kabwe','Central','ZM',NULL),(3166,'Chingola','Copperbelt','ZM',NULL),(3167,'Mufulira','Copperbelt','ZM',NULL),(3168,'Luanshya','Copperbelt','ZM',NULL),(3169,'Apia','Upolu','WS',NULL),(3170,'Serravalle','Serravalle/Dogano','SM',NULL),(3171,'San Marino','San Marino','SM',NULL),(3172,'SÃ£o TomÃ©','Aqua Grande','ST',NULL),(3173,'Riyadh','Riyadh','SA','1'),(3174,'Jedda','Mekka','SA',NULL),(3175,'Mekka','Mekka','SA',NULL),(3176,'Medina','Medina','SA',NULL),(3177,'al-Dammam','al-Sharqiya','SA',NULL),(3178,'al-Taif','Mekka','SA',NULL),(3179,'Tabuk','Tabuk','SA',NULL),(3180,'Burayda','al-Qasim','SA',NULL),(3181,'al-Hufuf','al-Sharqiya','SA',NULL),(3182,'al-Mubarraz','al-Sharqiya','SA',NULL),(3183,'Khamis Mushayt','Asir','SA','7'),(3184,'Hail','Hail','SA',NULL),(3185,'al-Kharj','Riad','SA',NULL),(3186,'al-Khubar','al-Sharqiya','SA',NULL),(3187,'Jubayl','al-Sharqiya','SA',NULL),(3188,'Hafar al-Batin','al-Sharqiya','SA',NULL),(3189,'al-Tuqba','al-Sharqiya','SA',NULL),(3190,'Yanbu','Medina','SA',NULL),(3191,'Abha','Asir','SA','7'),(3192,'AraÂ´ar','al-Khudud al-Samaliy','SA',NULL),(3193,'al-Qatif','al-Sharqiya','SA',NULL),(3194,'al-Hawiya','Mekka','SA',NULL),(3195,'Unayza','Qasim','SA',NULL),(3196,'Najran','Najran','SA','7'),(3197,'Pikine','Cap-Vert','SN',NULL),(3198,'Dakar','Cap-Vert','SN',NULL),(3199,'ThiÃ¨s','ThiÃ¨s','SN',NULL),(3200,'Kaolack','Kaolack','SN',NULL),(3201,'Ziguinchor','Ziguinchor','SN',NULL),(3202,'Rufisque','Cap-Vert','SN',NULL),(3203,'Saint-Louis','Saint-Louis','SN',NULL),(3204,'Mbour','ThiÃ¨s','SN',NULL),(3205,'Diourbel','Diourbel','SN',NULL),(3206,'Victoria','MahÃ©','SC',NULL),(3207,'Freetown','Western','SL',NULL),(3208,'Singapore','Â–','SG',NULL),(3209,'Bratislava','Bratislava','SK','2'),(3210,'KoÂšice','VÃ½chodnÃ© Slovensko','SK',NULL),(3211,'PreÂšov','VÃ½chodnÃ© Slovensko','SK',NULL),(3212,'Ljubljana','Osrednjeslovenska','SI',NULL),(3213,'Maribor','Podravska','SI',NULL),(3214,'Mogadishu','Banaadir','SO',NULL),(3215,'Hargeysa','Woqooyi Galbeed','SO',NULL),(3216,'Kismaayo','Jubbada Hoose','SO',NULL),(3217,'Colombo','Western','LK',NULL),(3218,'Dehiwala','Western','LK',NULL),(3219,'Moratuwa','Western','LK',NULL),(3220,'Jaffna','Northern','LK',NULL),(3221,'Kandy','Central','LK',NULL),(3222,'Sri Jayawardenepura Kotte','Western','LK',NULL),(3223,'Negombo','Western','LK',NULL),(3224,'Omdurman','Khartum','SD',NULL),(3225,'Khartum','Khartum','SD',NULL),(3226,'Sharq al-Nil','Khartum','SD',NULL),(3227,'Port Sudan','al-Bahr al-Ahmar','SD',NULL),(3228,'Kassala','Kassala','SD',NULL),(3229,'Obeid','Kurdufan al-Shamaliy','SD',NULL),(3230,'Nyala','Darfur al-Janubiya','SD',NULL),(3231,'Wad Madani','al-Jazira','SD',NULL),(3232,'al-Qadarif','al-Qadarif','SD',NULL),(3233,'Kusti','al-Bahr al-Abyad','SD',NULL),(3234,'al-Fashir','Darfur al-Shamaliya','SD',NULL),(3235,'Juba','Bahr al-Jabal','SD',NULL),(3236,'Helsinki [Helsingfors]','Newmaa','FI',NULL),(3237,'Espoo','Newmaa','FI','9'),(3238,'Tampere','Pirkanmaa','FI','3'),(3239,'Vantaa','Newmaa','FI','9'),(3240,'Turku [Ã…bo]','Varsinais-Suomi','FI',NULL),(3241,'Oulu','Pohjois-Pohjanmaa','FI','8'),(3242,'Lahti','PÃ¤ijÃ¤t-HÃ¤me','FI','3'),(3243,'Paramaribo','Paramaribo','SR',NULL),(3244,'Mbabane','Hhohho','SZ',NULL),(3245,'ZÃ¼rich','ZÃ¼rich','CH',NULL),(3246,'Geneve','Geneve','CH',NULL),(3247,'Basel','Basel-Stadt','CH','61'),(3248,'Bern','Bern','CH','31'),(3249,'Lausanne','Vaud','CH','21'),(3250,'Damascus','Damascus','SY','11'),(3251,'Aleppo','Aleppo','SY','21'),(3252,'Hims','Hims','SY',NULL),(3253,'Hama','Hama','SY','33'),(3254,'Latakia','Latakia','SY',NULL),(3255,'al-Qamishliya','al-Hasaka','SY',NULL),(3256,'Dayr al-Zawr','Dayr al-Zawr','SY',NULL),(3257,'Jaramana','Damaskos','SY',NULL),(3258,'Duma','Damaskos','SY',NULL),(3259,'al-Raqqa','al-Raqqa','SY',NULL),(3260,'Idlib','Idlib','SY',NULL),(3261,'Dushanbe','Karotegin','TJ',NULL),(3262,'Khujand','Khujand','TJ',NULL),(3263,'Taipei','Taipei','TW','2'),(3264,'Kaohsiung','Kaohsiung','TW','7'),(3265,'Taichung','Taichung','TW','4'),(3266,'Tainan','Tainan','TW','6'),(3267,'Panchiao','Taipei','TW',NULL),(3268,'Chungho','Taipei','TW',NULL),(3269,'Keelung (Chilung)','Keelung','TW',NULL),(3270,'Sanchung','Taipei','TW',NULL),(3271,'Hsinchuang','Taipei','TW',NULL),(3272,'Hsinchu','Hsinchu','TW',NULL),(3273,'Chungli','Taoyuan','TW',NULL),(3274,'Fengshan','Kaohsiung','TW',NULL),(3275,'Taoyuan','Taoyuan','TW','3'),(3276,'Chiayi','Chiayi','TW','5'),(3277,'Hsintien','Taipei','TW',NULL),(3278,'Changhwa','Changhwa','TW',NULL),(3279,'Yungho','Taipei','TW',NULL),(3280,'Tucheng','Taipei','TW',NULL),(3281,'Pingtung','Pingtung','TW','8'),(3282,'Yungkang','Tainan','TW',NULL),(3283,'Pingchen','Taoyuan','TW',NULL),(3284,'Tali','Taichung','TW',NULL),(3285,'Taiping','','TW',NULL),(3286,'Pate','Taoyuan','TW',NULL),(3287,'Fengyuan','Taichung','TW','4'),(3288,'Luchou','Taipei','TW',NULL),(3289,'Hsichuh','Taipei','TW',NULL),(3290,'Shulin','Taipei','TW',NULL),(3291,'Yuanlin','Changhwa','TW',NULL),(3292,'Yangmei','Taoyuan','TW',NULL),(3293,'Taliao','','TW',NULL),(3294,'Kueishan','','TW',NULL),(3295,'Tanshui','Taipei','TW',NULL),(3296,'Taitung','Taitung','TW','89'),(3297,'Hualien','Hualien','TW',NULL),(3298,'Nantou','Nantou','TW',NULL),(3299,'Lungtan','Taipei','TW',NULL),(3300,'Touliu','YÃ¼nlin','TW',NULL),(3301,'Tsaotun','Nantou','TW',NULL),(3302,'Kangshan','Kaohsiung','TW',NULL),(3303,'Ilan','Ilan','TW',NULL),(3304,'Miaoli','Miaoli','TW',NULL),(3305,'Dar es Salaam','Dar es Salaam','TZ',NULL),(3306,'Dodoma','Dodoma','TZ',NULL),(3307,'Mwanza','Mwanza','TZ',NULL),(3308,'Zanzibar','Zanzibar West','TZ',NULL),(3309,'Tanga','Tanga','TZ',NULL),(3310,'Mbeya','Mbeya','TZ',NULL),(3311,'Morogoro','Morogoro','TZ',NULL),(3312,'Arusha','Arusha','TZ',NULL),(3313,'Moshi','Kilimanjaro','TZ',NULL),(3314,'Tabora','Tabora','TZ',NULL),(3315,'KÃ¸benhavn','KÃ¸benhavn','DK',NULL),(3316,'Ã…rhus','Ã…rhus','DK',NULL),(3317,'Odense','Fyn','DK',''),(3318,'Aalborg','Nordjylland','DK',''),(3319,'Frederiksberg','Frederiksberg','DK',NULL),(3320,'Bangkok','Bangkok','TH','2'),(3321,'Nonthaburi','Nonthaburi','TH',NULL),(3322,'Nakhon Ratchasima','Nakhon Ratchasima','TH','44'),(3323,'Chiang Mai','Chiang Mai','TH','53'),(3324,'Udon Thani','Udon Thani','TH',NULL),(3325,'Hat Yai','Songkhla','TH',NULL),(3326,'Khon Kaen','Khon Kaen','TH','43'),(3327,'Pak Kret','Nonthaburi','TH',NULL),(3328,'Nakhon Sawan','Nakhon Sawan','TH',NULL),(3329,'Ubon Ratchathani','Ubon Ratchathani','TH','45'),(3330,'Songkhla','Songkhla','TH','74'),(3331,'Nakhon Pathom','Nakhon Pathom','TH',NULL),(3332,'LomÃ©','Maritime','TG',NULL),(3333,'Fakaofo','Fakaofo','TK',NULL),(3334,'NukuÂ´alofa','Tongatapu','TO',NULL),(3335,'Chaguanas','Caroni','TT',NULL),(3336,'Port-of-Spain','Port-of-Spain','TT',NULL),(3337,'NÂ´DjamÃ©na','Chari-Baguirmi','TD',NULL),(3338,'Moundou','Logone Occidental','TD',NULL),(3339,'Praha','HlavnÃ­ mesto Praha','CZ',NULL),(3340,'Brno','JiznÃ­ Morava','CZ','54'),(3341,'Ostrava','SevernÃ­ Morava','CZ','69'),(3342,'Plzen','ZapadnÃ­ Cechy','CZ','377'),(3343,'Olomouc','SevernÃ­ Morava','CZ',NULL),(3344,'Liberec','SevernÃ­ Cechy','CZ','48'),(3345,'CeskÃ© Budejovice','JiznÃ­ Cechy','CZ',NULL),(3346,'Hradec KrÃ¡lovÃ©','VÃ½chodnÃ­ Cechy','CZ',NULL),(3347,'ÃšstÃ­ nad Labem','SevernÃ­ Cechy','CZ',NULL),(3348,'Pardubice','VÃ½chodnÃ­ Cechy','CZ',NULL),(3349,'Tunis','Tunis','TN','1'),(3350,'Sfax','Sfax','TN','4'),(3351,'Ariana','Ariana','TN',NULL),(3352,'Ettadhamen','Ariana','TN',NULL),(3353,'Sousse','Sousse','TN','3'),(3354,'Kairouan','Kairouan','TN',NULL),(3355,'Biserta','Biserta','TN',NULL),(3356,'GabÃ¨s','GabÃ¨s','TN',NULL),(3357,'Istanbul','Istanbul','TR','212'),(3358,'Ankara','Ankara','TR','312'),(3359,'Izmir','Izmir','TR','232'),(3360,'Adana','Adana','TR','322'),(3361,'Bursa','Bursa','TR','224'),(3362,'Gaziantep','Gaziantep','TR','342'),(3363,'Konya','Konya','TR','332'),(3364,'Mersin (IÃ§el)','IÃ§el','TR',NULL),(3365,'Antalya','Antalya','TR','242'),(3366,'Diyarbakir','Diyarbakir','TR','412'),(3367,'Kayseri','Kayseri','TR','352'),(3368,'Eskisehir','Eskisehir','TR','222'),(3369,'Sanliurfa','Sanliurfa','TR','414'),(3370,'Samsun','Samsun','TR','362'),(3371,'Malatya','Malatya','TR','422'),(3372,'Gebze','Kocaeli','TR',NULL),(3373,'Denizli','Denizli','TR','258'),(3374,'Sivas','Sivas','TR','346'),(3375,'Erzurum','Erzurum','TR','442'),(3376,'Tarsus','Adana','TR',NULL),(3377,'Kahramanmaras','Kahramanmaras','TR','344'),(3378,'ElÃ¢zig','ElÃ¢zig','TR',NULL),(3379,'Van','Van','TR','432'),(3380,'Sultanbeyli','Istanbul','TR',NULL),(3381,'Izmit (Kocaeli)','Kocaeli','TR',NULL),(3382,'Manisa','Manisa','TR','236'),(3383,'Batman','Batman','TR','488'),(3384,'Balikesir','Balikesir','TR','266'),(3385,'Sakarya (Adapazari)','Sakarya','TR',NULL),(3386,'Iskenderun','Hatay','TR',NULL),(3387,'Osmaniye','Osmaniye','TR',NULL),(3388,'Ã‡orum','Ã‡orum','TR',NULL),(3389,'KÃ¼tahya','KÃ¼tahya','TR',NULL),(3390,'Hatay (Antakya)','Hatay','TR',NULL),(3391,'Kirikkale','Kirikkale','TR','318'),(3392,'Adiyaman','Adiyaman','TR','416'),(3393,'Trabzon','Trabzon','TR','462'),(3394,'Ordu','Ordu','TR','452'),(3395,'Aydin','Aydin','TR','256'),(3396,'Usak','Usak','TR',NULL),(3397,'Edirne','Edirne','TR','284'),(3398,'Ã‡orlu','Tekirdag','TR',NULL),(3399,'Isparta','Isparta','TR','246'),(3400,'KarabÃ¼k','KarabÃ¼k','TR',NULL),(3401,'Kilis','Kilis','TR',NULL),(3402,'Alanya','Antalya','TR',NULL),(3403,'Kiziltepe','Mardin','TR',NULL),(3404,'Zonguldak','Zonguldak','TR','372'),(3405,'Siirt','Siirt','TR','484'),(3406,'Viransehir','Sanliurfa','TR',NULL),(3407,'Tekirdag','Tekirdag','TR',NULL),(3408,'Karaman','Karaman','TR','338'),(3409,'Afyon','Afyon','TR','272'),(3410,'Aksaray','Aksaray','TR','382'),(3411,'Ceyhan','Adana','TR',NULL),(3412,'Erzincan','Erzincan','TR','446'),(3413,'Bismil','Diyarbakir','TR',NULL),(3414,'Nazilli','Aydin','TR',NULL),(3415,'Tokat','Tokat','TR','356'),(3416,'Kars','Kars','TR','474'),(3417,'InegÃ¶l','Bursa','TR',NULL),(3418,'Bandirma','Balikesir','TR',NULL),(3419,'Ashgabat','Ahal','TM','12'),(3420,'ChÃ¤rjew','Lebap','TM',NULL),(3421,'Dashhowuz','Dashhowuz','TM','322'),(3422,'Mary','Mary','TM',NULL),(3423,'Cockburn Town','Grand Turk','TC',NULL),(3424,'Funafuti','Funafuti','TV',NULL),(3425,'Kampala','Central','UG',NULL),(3426,'Kyiv','Kiova','UA',NULL),(3427,'Harkova [Harkiv]','Harkova','UA',NULL),(3428,'Dnipropetrovsk','Dnipropetrovsk','UA',NULL),(3429,'Donetsk','Donetsk','UA','62'),(3430,'Odesa','Odesa','UA',NULL),(3431,'Zaporizzja','Zaporizzja','UA',NULL),(3432,'Lviv','Lviv','UA','322'),(3433,'Kryvyi Rig','Dnipropetrovsk','UA',NULL),(3434,'Mykolajiv','Mykolajiv','UA',NULL),(3435,'Mariupol','Donetsk','UA',NULL),(3436,'Lugansk','Lugansk','UA','642'),(3437,'Vinnytsja','Vinnytsja','UA',NULL),(3438,'Makijivka','Donetsk','UA',NULL),(3439,'Herson','Herson','UA',NULL),(3440,'Sevastopol','Krim','UA','69'),(3441,'Simferopol','Krim','UA','652'),(3442,'Pultava [Poltava]','Pultava','UA',NULL),(3443,'TÂšernigiv','TÂšernigiv','UA',NULL),(3444,'TÂšerkasy','TÂšerkasy','UA',NULL),(3445,'Gorlivka','Donetsk','UA',NULL),(3446,'Zytomyr','Zytomyr','UA',NULL),(3447,'Sumy','Sumy','UA','54'),(3448,'Dniprodzerzynsk','Dnipropetrovsk','UA',NULL),(3449,'Kirovograd','Kirovograd','UA','52'),(3450,'Hmelnytskyi','Hmelnytskyi','UA',NULL),(3451,'TÂšernivtsi','TÂšernivtsi','UA',NULL),(3452,'Rivne','Rivne','UA','36'),(3453,'KrementÂšuk','Pultava','UA',NULL),(3454,'Ivano-Frankivsk','Ivano-Frankivsk','UA',NULL),(3455,'Ternopil','Ternopil','UA','3522'),(3456,'Lutsk','Volynia','UA',NULL),(3457,'Bila Tserkva','Kiova','UA',NULL),(3458,'Kramatorsk','Donetsk','UA',NULL),(3459,'Melitopol','Zaporizzja','UA',NULL),(3460,'KertÂš','Krim','UA',NULL),(3461,'Nikopol','Dnipropetrovsk','UA',NULL),(3462,'Berdjansk','Zaporizzja','UA',NULL),(3463,'Pavlograd','Dnipropetrovsk','UA',NULL),(3464,'Sjeverodonetsk','Lugansk','UA',NULL),(3465,'Slovjansk','Donetsk','UA',NULL),(3466,'Uzgorod','Taka-Karpatia','UA',NULL),(3467,'AltÂševsk','Lugansk','UA',NULL),(3468,'LysytÂšansk','Lugansk','UA',NULL),(3469,'Jevpatorija','Krim','UA',NULL),(3470,'Kamjanets-Podilskyi','Hmelnytskyi','UA',NULL),(3471,'Jenakijeve','Donetsk','UA',NULL),(3472,'Krasnyi LutÂš','Lugansk','UA',NULL),(3473,'Stahanov','Lugansk','UA',NULL),(3474,'Oleksandrija','Kirovograd','UA',NULL),(3475,'Konotop','Sumy','UA',NULL),(3476,'Kostjantynivka','Donetsk','UA',NULL),(3477,'BerdytÂšiv','Zytomyr','UA',NULL),(3478,'Izmajil','Odesa','UA',NULL),(3479,'ÂŠostka','Sumy','UA',NULL),(3480,'Uman','TÂšerkasy','UA','4744'),(3481,'Brovary','Kiova','UA',NULL),(3482,'MukatÂševe','Taka-Karpatia','UA',NULL),(3483,'Budapest','Budapest','HU','1'),(3484,'Debrecen','HajdÃº-Bihar','HU','52'),(3485,'Miskolc','Borsod-AbaÃºj-ZemplÃ','HU','46'),(3486,'Szeged','CsongrÃ¡d','HU','62'),(3487,'PÃ©cs','Baranya','HU',NULL),(3488,'GyÃ¶r','GyÃ¶r-Moson-Sopron','HU',NULL),(3489,'NyiregyhÃ¡za','Szabolcs-SzatmÃ¡r-Be','HU',NULL),(3490,'KecskemÃ©t','BÃ¡cs-Kiskun','HU',NULL),(3491,'SzÃ©kesfehÃ©rvÃ¡r','FejÃ©r','HU',NULL),(3492,'Montevideo','Montevideo','UY','2'),(3493,'NoumÃ©a','Â–','NC',NULL),(3494,'Auckland','Auckland','NZ','9'),(3495,'Christchurch','Canterbury','NZ','3'),(3496,'Manukau','Auckland','NZ',NULL),(3497,'North Shore','Auckland','NZ',NULL),(3498,'Waitakere','Auckland','NZ',NULL),(3499,'Wellington','Wellington','NZ','4'),(3500,'Dunedin','Dunedin','NZ','3'),(3501,'Hamilton','Hamilton','NZ',NULL),(3502,'Lower Hutt','Wellington','NZ',NULL),(3503,'Toskent','Toskent Shahri','UZ',NULL),(3504,'Namangan','Namangan','UZ',NULL),(3505,'Samarkand','Samarkand','UZ','66'),(3506,'Andijon','Andijon','UZ',NULL),(3507,'Buhoro','Buhoro','UZ',NULL),(3508,'Karsi','Qashqadaryo','UZ',NULL),(3509,'Nukus','Karakalpakistan','UZ',NULL),(3510,'KÃ¼kon','Fargona','UZ',NULL),(3511,'Fargona','Fargona','UZ',NULL),(3512,'Circik','Toskent','UZ',NULL),(3513,'Margilon','Fargona','UZ',NULL),(3514,'Ãœrgenc','Khorazm','UZ',NULL),(3515,'Angren','Toskent','UZ',NULL),(3516,'Cizah','Cizah','UZ',NULL),(3517,'Navoi','Navoi','UZ',NULL),(3518,'Olmalik','Toskent','UZ',NULL),(3519,'Termiz','Surkhondaryo','UZ',NULL),(3520,'Minsk','Horad Minsk','BY','17'),(3521,'Gomel','Gomel','BY','2322'),(3522,'Mogiljov','Mogiljov','BY',NULL),(3523,'Vitebsk','Vitebsk','BY','212'),(3524,'Grodno','Grodno','BY','1511'),(3525,'Brest','Brest','BY',NULL),(3526,'Bobruisk','Mogiljov','BY',NULL),(3527,'BaranovitÂši','Brest','BY',NULL),(3528,'Borisov','Minsk','BY',NULL),(3529,'Pinsk','Brest','BY',NULL),(3530,'OrÂša','Vitebsk','BY',NULL),(3531,'Mozyr','Gomel','BY',NULL),(3532,'Novopolotsk','Vitebsk','BY',NULL),(3533,'Lida','Grodno','BY',NULL),(3534,'Soligorsk','Minsk','BY',NULL),(3535,'MolodetÂšno','Minsk','BY',NULL),(3536,'Mata-Utu','Wallis','WF',NULL),(3537,'Port-Vila','Shefa','VU',NULL),(3538,'CittÃ  del Vaticano','Â–','VA',NULL),(3539,'Caracas','Distrito Federal','VE','212'),(3540,'MaracaÃ­bo','Zulia','VE',NULL),(3541,'Barquisimeto','Lara','VE','251'),(3542,'Valencia','Carabobo','VE',NULL),(3543,'Ciudad Guayana','BolÃ­var','VE','285'),(3544,'Petare','Miranda','VE',NULL),(3545,'Maracay','Aragua','VE','243'),(3546,'Barcelona','AnzoÃ¡tegui','VE',NULL),(3547,'MaturÃ­n','Monagas','VE',NULL),(3548,'San CristÃ³bal','TÃ¡chira','VE',NULL),(3549,'Ciudad BolÃ­var','BolÃ­var','VE',NULL),(3550,'CumanÃ¡','Sucre','VE',NULL),(3551,'MÃ©rida','MÃ©rida','VE',NULL),(3552,'Cabimas','Zulia','VE','264'),(3553,'Barinas','Barinas','VE',NULL),(3554,'Turmero','Aragua','VE',NULL),(3555,'Baruta','Miranda','VE',NULL),(3556,'Puerto Cabello','Carabobo','VE','242'),(3557,'Santa Ana de Coro','FalcÃ³n','VE',NULL),(3558,'Los Teques','Miranda','VE','212'),(3559,'Punto Fijo','FalcÃ³n','VE',NULL),(3560,'Guarenas','Miranda','VE',NULL),(3561,'Acarigua','Portuguesa','VE',NULL),(3562,'Puerto La Cruz','AnzoÃ¡tegui','VE',NULL),(3563,'Ciudad Losada','','VE',NULL),(3564,'Guacara','Carabobo','VE',NULL),(3565,'Valera','Trujillo','VE',NULL),(3566,'Guanare','Portuguesa','VE',NULL),(3567,'CarÃºpano','Sucre','VE',NULL),(3568,'Catia La Mar','Distrito Federal','VE',NULL),(3569,'El Tigre','AnzoÃ¡tegui','VE',NULL),(3570,'Guatire','Miranda','VE',NULL),(3571,'Calabozo','GuÃ¡rico','VE',NULL),(3572,'Pozuelos','AnzoÃ¡tegui','VE',NULL),(3573,'Ciudad Ojeda','Zulia','VE',NULL),(3574,'Ocumare del Tuy','Miranda','VE',NULL),(3575,'Valle de la Pascua','GuÃ¡rico','VE',NULL),(3576,'Araure','Portuguesa','VE',NULL),(3577,'San Fernando de Apure','Apure','VE',NULL),(3578,'San Felipe','Yaracuy','VE',NULL),(3579,'El LimÃ³n','Aragua','VE',NULL),(3580,'Moscow','Moscow (City)','RU','495'),(3581,'St Petersburg','Pietari','RU',NULL),(3582,'Novosibirsk','Novosibirsk','RU','383'),(3583,'Nizni Novgorod','Nizni Novgorod','RU',NULL),(3584,'Jekaterinburg','Sverdlovsk','RU',NULL),(3585,'Samara','Samara','RU','8462'),(3586,'Omsk','Omsk','RU','3812'),(3587,'Kazan','Tatarstan','RU','843'),(3588,'Ufa','BaÂškortostan','RU','3472'),(3589,'TÂšeljabinsk','TÂšeljabinsk','RU',NULL),(3590,'Rostov-na-Donu','Rostov-na-Donu','RU',NULL),(3591,'Perm','Perm','RU','3422'),(3592,'Volgograd','Volgograd','RU','8442'),(3593,'Voronez','Voronez','RU',NULL),(3594,'Krasnojarsk','Krasnojarsk','RU',NULL),(3595,'Saratov','Saratov','RU','8452'),(3596,'Toljatti','Samara','RU',NULL),(3597,'Uljanovsk','Uljanovsk','RU',NULL),(3598,'Izevsk','Udmurtia','RU',NULL),(3599,'Krasnodar','Krasnodar','RU','8612'),(3600,'Jaroslavl','Jaroslavl','RU',NULL),(3601,'Habarovsk','Habarovsk','RU',NULL),(3602,'Vladivostok','Primorje','RU','4232'),(3603,'Irkutsk','Irkutsk','RU','3952'),(3604,'Barnaul','Altai','RU','3852'),(3605,'Novokuznetsk','Kemerovo','RU',NULL),(3606,'Penza','Penza','RU','8412'),(3607,'Rjazan','Rjazan','RU',NULL),(3608,'Orenburg','Orenburg','RU','3532'),(3609,'Lipetsk','Lipetsk','RU','474'),(3610,'Nabereznyje TÂšelny','Tatarstan','RU',NULL),(3611,'Tula','Tula','RU','487'),(3612,'Tjumen','Tjumen','RU',NULL),(3613,'Kemerovo','Kemerovo','RU','3842'),(3614,'Astrahan','Astrahan','RU',NULL),(3615,'Tomsk','Tomsk','RU','3822'),(3616,'Kirov','Kirov','RU','833'),(3617,'Ivanovo','Ivanovo','RU','493'),(3618,'TÂšeboksary','TÂšuvassia','RU',NULL),(3619,'Brjansk','Brjansk','RU',NULL),(3620,'Tver','Tver','RU','482'),(3621,'Kursk','Kursk','RU','471'),(3622,'Magnitogorsk','TÂšeljabinsk','RU',NULL),(3623,'Kaliningrad','Kaliningrad','RU','401'),(3624,'Nizni Tagil','Sverdlovsk','RU',NULL),(3625,'Murmansk','Murmansk','RU','8152'),(3626,'Ulan-Ude','Burjatia','RU',NULL),(3627,'Kurgan','Kurgan','RU','352'),(3628,'Arkangeli','Arkangeli','RU',NULL),(3629,'SotÂši','Krasnodar','RU',NULL),(3630,'Smolensk','Smolensk','RU','481'),(3631,'Orjol','Orjol','RU',NULL),(3632,'Stavropol','Stavropol','RU','8652'),(3633,'Belgorod','Belgorod','RU','472'),(3634,'Kaluga','Kaluga','RU','484'),(3635,'Vladimir','Vladimir','RU','492'),(3636,'MahatÂškala','Dagestan','RU',NULL),(3637,'TÂšerepovets','Vologda','RU',NULL),(3638,'Saransk','Mordva','RU','834'),(3639,'Tambov','Tambov','RU','475'),(3640,'Vladikavkaz','North Ossetia-Alania','RU','867'),(3641,'TÂšita','TÂšita','RU',NULL),(3642,'Vologda','Vologda','RU','817'),(3643,'Veliki Novgorod','Novgorod','RU',NULL),(3644,'Komsomolsk-na-Amure','Habarovsk','RU',NULL),(3645,'Kostroma','Kostroma','RU','494'),(3646,'Volzski','Volgograd','RU',NULL),(3647,'Taganrog','Rostov-na-Donu','RU',NULL),(3648,'Petroskoi','Karjala','RU',NULL),(3649,'Bratsk','Irkutsk','RU',NULL),(3650,'Dzerzinsk','Nizni Novgorod','RU',NULL),(3651,'Surgut','Hanti-Mansia','RU','3462'),(3652,'Orsk','Orenburg','RU',NULL),(3653,'Sterlitamak','BaÂškortostan','RU',NULL),(3654,'Angarsk','Irkutsk','RU',NULL),(3655,'JoÂškar-Ola','Marinmaa','RU',NULL),(3656,'Rybinsk','Jaroslavl','RU',NULL),(3657,'Prokopjevsk','Kemerovo','RU',NULL),(3658,'Niznevartovsk','Hanti-Mansia','RU',NULL),(3659,'NaltÂšik','Kabardi-Balkaria','RU',NULL),(3660,'Syktyvkar','Komi','RU','821'),(3661,'Severodvinsk','Arkangeli','RU',NULL),(3662,'Bijsk','Altai','RU',NULL),(3663,'Niznekamsk','Tatarstan','RU',NULL),(3664,'BlagoveÂštÂšensk','Amur','RU',NULL),(3665,'ÂŠahty','Rostov-na-Donu','RU',NULL),(3666,'Staryi Oskol','Belgorod','RU',NULL),(3667,'Zelenograd','Moscow (City)','RU',NULL),(3668,'Balakovo','Saratov','RU',NULL),(3669,'Novorossijsk','Krasnodar','RU',NULL),(3670,'Pihkova','Pihkova','RU',NULL),(3671,'Zlatoust','TÂšeljabinsk','RU',NULL),(3672,'Jakutsk','Saha (Jakutia)','RU',NULL),(3673,'Podolsk','Moskova','RU',NULL),(3674,'Petropavlovsk-KamtÂšatski','KamtÂšatka','RU',NULL),(3675,'Kamensk-Uralski','Sverdlovsk','RU',NULL),(3676,'Engels','Saratov','RU',NULL),(3677,'Syzran','Samara','RU',NULL),(3678,'Grozny','TÂšetÂšenia','RU',NULL),(3679,'NovotÂšerkassk','Rostov-na-Donu','RU',NULL),(3680,'Berezniki','Perm','RU',NULL),(3681,'Juzno-Sahalinsk','Sahalin','RU',NULL),(3682,'Volgodonsk','Rostov-na-Donu','RU',NULL),(3683,'Abakan','Hakassia','RU',NULL),(3684,'Maikop','Adygea','RU',NULL),(3685,'Miass','TÂšeljabinsk','RU',NULL),(3686,'Armavir','Krasnodar','RU',NULL),(3687,'Ljubertsy','Moskova','RU',NULL),(3688,'Rubtsovsk','Altai','RU',NULL),(3689,'Kovrov','Vladimir','RU',NULL),(3690,'Nahodka','Primorje','RU',NULL),(3691,'Ussurijsk','Primorje','RU',NULL),(3692,'Salavat','BaÂškortostan','RU',NULL),(3693,'MytiÂštÂši','Moskova','RU',NULL),(3694,'Kolomna','Moskova','RU',NULL),(3695,'Elektrostal','Moskova','RU',NULL),(3696,'Murom','Vladimir','RU',NULL),(3697,'Kolpino','Pietari','RU',NULL),(3698,'Norilsk','Krasnojarsk','RU','39152'),(3699,'Almetjevsk','Tatarstan','RU',NULL),(3700,'Novomoskovsk','Tula','RU',NULL),(3701,'Dimitrovgrad','Uljanovsk','RU',NULL),(3702,'Pervouralsk','Sverdlovsk','RU',NULL),(3703,'Himki','Moskova','RU',NULL),(3704,'BalaÂšiha','Moskova','RU',NULL),(3705,'Nevinnomyssk','Stavropol','RU',NULL),(3706,'Pjatigorsk','Stavropol','RU',NULL),(3707,'Korolev','Moskova','RU',NULL),(3708,'Serpuhov','Moskova','RU',NULL),(3709,'Odintsovo','Moskova','RU',NULL),(3710,'Orehovo-Zujevo','Moskova','RU',NULL),(3711,'KamyÂšin','Volgograd','RU',NULL),(3712,'NovotÂšeboksarsk','TÂšuvassia','RU',NULL),(3713,'TÂšerkessk','KaratÂšai-TÂšerkessi','RU',NULL),(3714,'AtÂšinsk','Krasnojarsk','RU',NULL),(3715,'Magadan','Magadan','RU','41322'),(3716,'MitÂšurinsk','Tambov','RU',NULL),(3717,'Kislovodsk','Stavropol','RU',NULL),(3718,'Jelets','Lipetsk','RU',NULL),(3719,'Seversk','Tomsk','RU',NULL),(3720,'Noginsk','Moskova','RU',NULL),(3721,'Velikije Luki','Pihkova','RU',NULL),(3722,'NovokuibyÂševsk','Samara','RU',NULL),(3723,'Neftekamsk','BaÂškortostan','RU',NULL),(3724,'Leninsk-Kuznetski','Kemerovo','RU',NULL),(3725,'Oktjabrski','BaÂškortostan','RU',NULL),(3726,'Sergijev Posad','Moskova','RU',NULL),(3727,'Arzamas','Nizni Novgorod','RU',NULL),(3728,'Kiseljovsk','Kemerovo','RU',NULL),(3729,'Novotroitsk','Orenburg','RU',NULL),(3730,'Obninsk','Kaluga','RU',NULL),(3731,'Kansk','Krasnojarsk','RU',NULL),(3732,'Glazov','Udmurtia','RU',NULL),(3733,'Solikamsk','Perm','RU',NULL),(3734,'Sarapul','Udmurtia','RU',NULL),(3735,'Ust-Ilimsk','Irkutsk','RU',NULL),(3736,'ÂŠtÂšolkovo','Moskova','RU',NULL),(3737,'MezduretÂšensk','Kemerovo','RU',NULL),(3738,'Usolje-Sibirskoje','Irkutsk','RU',NULL),(3739,'Elista','Kalmykia','RU',NULL),(3740,'NovoÂšahtinsk','Rostov-na-Donu','RU',NULL),(3741,'Votkinsk','Udmurtia','RU',NULL),(3742,'Kyzyl','Tyva','RU',NULL),(3743,'Serov','Sverdlovsk','RU',NULL),(3744,'Zelenodolsk','Tatarstan','RU',NULL),(3745,'Zeleznodoroznyi','Moskova','RU',NULL),(3746,'KineÂšma','Ivanovo','RU',NULL),(3747,'Kuznetsk','Penza','RU',NULL),(3748,'Uhta','Komi','RU',NULL),(3749,'Jessentuki','Stavropol','RU',NULL),(3750,'Tobolsk','Tjumen','RU',NULL),(3751,'Neftejugansk','Hanti-Mansia','RU',NULL),(3752,'Bataisk','Rostov-na-Donu','RU',NULL),(3753,'Nojabrsk','Yamalin Nenetsia','RU',NULL),(3754,'BalaÂšov','Saratov','RU',NULL),(3755,'Zeleznogorsk','Kursk','RU',NULL),(3756,'Zukovski','Moskova','RU',NULL),(3757,'Anzero-Sudzensk','Kemerovo','RU',NULL),(3758,'Bugulma','Tatarstan','RU',NULL),(3759,'Zeleznogorsk','Krasnojarsk','RU',NULL),(3760,'Novouralsk','Sverdlovsk','RU',NULL),(3761,'PuÂškin','Pietari','RU',NULL),(3762,'Vorkuta','Komi','RU',NULL),(3763,'Derbent','Dagestan','RU',NULL),(3764,'Kirovo-TÂšepetsk','Kirov','RU',NULL),(3765,'Krasnogorsk','Moskova','RU',NULL),(3766,'Klin','Moskova','RU',NULL),(3767,'TÂšaikovski','Perm','RU',NULL),(3768,'Novyi Urengoi','Yamalin Nenetsia','RU',NULL),(3769,'Ho Chi Minh City','Ho Chi Minh City','VN','8'),(3770,'Hanoi','Hanoi','VN','4'),(3771,'Haiphong','Haiphong','VN','31'),(3772,'Da Nang','Quang Nam-Da Nang','VN',NULL),(3773,'BiÃªn Hoa','Dong Nai','VN',NULL),(3774,'Nha Trang','Khanh Hoa','VN','58'),(3775,'Hue','Thua Thien-Hue','VN','54'),(3776,'Can Tho','Can Tho','VN','71'),(3777,'Cam Pha','Quang Binh','VN',NULL),(3778,'Nam Dinh','Nam Ha','VN','350'),(3779,'Quy Nhon','Binh Dinh','VN',NULL),(3780,'Vung Tau','Ba Ria-Vung Tau','VN','64'),(3781,'Rach Gia','Kien Giang','VN',NULL),(3782,'Long Xuyen','An Giang','VN','76'),(3783,'Thai Nguyen','Bac Thai','VN','280'),(3784,'Hong Gai','Quang Ninh','VN',NULL),(3785,'Phan ThiÃªt','Binh Thuan','VN',NULL),(3786,'Cam Ranh','Khanh Hoa','VN',NULL),(3787,'Vinh','Nghe An','VN',NULL),(3788,'My Tho','Tien Giang','VN',NULL),(3789,'Da Lat','Lam Dong','VN',NULL),(3790,'Buon Ma Thuot','Dac Lac','VN',NULL),(3791,'Tallinn','Harjumaa','EE',''),(3792,'Tartu','Tartumaa','EE',NULL),(3793,'New York','New York','US',NULL),(3794,'Los Angeles','California','US',NULL),(3795,'Chicago','Illinois','US',NULL),(3796,'Houston','Texas','US',NULL),(3797,'Philadelphia','Pennsylvania','US',NULL),(3798,'Phoenix','Arizona','US','602'),(3799,'San Diego','California','US',NULL),(3800,'Dallas','Texas','US',NULL),(3801,'San Antonio','Texas','US',NULL),(3802,'Detroit','Michigan','US',NULL),(3803,'San Jose','California','US',NULL),(3804,'Indianapolis','Indiana','US','317'),(3805,'San Francisco','California','US',NULL),(3806,'Jacksonville','Florida','US',NULL),(3807,'Columbus','Ohio','US','614'),(3808,'Austin','Texas','US','512'),(3809,'Baltimore','Maryland','US',NULL),(3810,'Memphis','Tennessee','US',NULL),(3811,'Milwaukee','Wisconsin','US',NULL),(3812,'Boston','Massachusetts','US','617'),(3813,'Washington','District of Columbia','US','202'),(3814,'Nashville-Davidson','Tennessee','US',NULL),(3815,'El Paso','Texas','US',NULL),(3816,'Seattle','Washington','US',NULL),(3817,'Denver','Colorado','US','303'),(3818,'Charlotte','North Carolina','US',NULL),(3819,'Fort Worth','Texas','US',NULL),(3820,'Portland','Oregon','US',NULL),(3821,'Oklahoma City','Oklahoma','US','405'),(3822,'Tucson','Arizona','US',NULL),(3823,'New Orleans','Louisiana','US',NULL),(3824,'Las Vegas','Nevada','US',NULL),(3825,'Cleveland','Ohio','US',NULL),(3826,'Long Beach','California','US',NULL),(3827,'Albuquerque','New Mexico','US',NULL),(3828,'Kansas City','Missouri','US',NULL),(3829,'Fresno','California','US',NULL),(3830,'Virginia Beach','Virginia','US',NULL),(3831,'Atlanta','Georgia','US','404'),(3832,'Sacramento','California','US','916'),(3833,'Oakland','California','US',NULL),(3834,'Mesa','Arizona','US',NULL),(3835,'Tulsa','Oklahoma','US',NULL),(3836,'Omaha','Nebraska','US',NULL),(3837,'Minneapolis','Minnesota','US',NULL),(3838,'Honolulu','Hawaii','US','808'),(3839,'Miami','Florida','US',NULL),(3840,'Colorado Springs','Colorado','US',NULL),(3841,'Saint Louis','Missouri','US',NULL),(3842,'Wichita','Kansas','US',NULL),(3843,'Santa Ana','California','US',NULL),(3844,'Pittsburgh','Pennsylvania','US',NULL),(3845,'Arlington','Texas','US',NULL),(3846,'Cincinnati','Ohio','US',NULL),(3847,'Anaheim','California','US',NULL),(3848,'Toledo','Ohio','US',NULL),(3849,'Tampa','Florida','US',NULL),(3850,'Buffalo','New York','US',NULL),(3851,'Saint Paul','Minnesota','US','651'),(3852,'Corpus Christi','Texas','US',NULL),(3853,'Aurora','Colorado','US',NULL),(3854,'Raleigh','North Carolina','US','919'),(3855,'Newark','New Jersey','US',NULL),(3856,'Lexington-Fayette','Kentucky','US',NULL),(3857,'Anchorage','Alaska','US',NULL),(3858,'Louisville','Kentucky','US',NULL),(3859,'Riverside','California','US',NULL),(3860,'Saint Petersburg','Florida','US',NULL),(3861,'Bakersfield','California','US',NULL),(3862,'Stockton','California','US',NULL),(3863,'Birmingham','Alabama','US',NULL),(3864,'Jersey City','New Jersey','US',NULL),(3865,'Norfolk','Virginia','US',NULL),(3866,'Baton Rouge','Louisiana','US','225'),(3867,'Hialeah','Florida','US',NULL),(3868,'Lincoln','Nebraska','US','402'),(3869,'Greensboro','North Carolina','US',NULL),(3870,'Plano','Texas','US',NULL),(3871,'Rochester','New York','US',NULL),(3872,'Glendale','Arizona','US',NULL),(3873,'Akron','Ohio','US',NULL),(3874,'Garland','Texas','US',NULL),(3875,'Madison','Wisconsin','US','608'),(3876,'Fort Wayne','Indiana','US',NULL),(3877,'Fremont','California','US',NULL),(3878,'Scottsdale','Arizona','US',NULL),(3879,'Montgomery','Alabama','US','334'),(3880,'Shreveport','Louisiana','US',NULL),(3881,'Augusta-Richmond County','Georgia','US',NULL),(3882,'Lubbock','Texas','US',NULL),(3883,'Chesapeake','Virginia','US',NULL),(3884,'Mobile','Alabama','US',NULL),(3885,'Des Moines','Iowa','US','515'),(3886,'Grand Rapids','Michigan','US',NULL),(3887,'Richmond','Virginia','US',NULL),(3888,'Yonkers','New York','US',NULL),(3889,'Spokane','Washington','US',NULL),(3890,'Glendale','California','US',NULL),(3891,'Tacoma','Washington','US',NULL),(3892,'Irving','Texas','US',NULL),(3893,'Huntington Beach','California','US',NULL),(3894,'Modesto','California','US',NULL),(3895,'Durham','North Carolina','US',NULL),(3896,'Columbus','Georgia','US',NULL),(3897,'Orlando','Florida','US',NULL),(3898,'Boise City','Idaho','US',NULL),(3899,'Winston-Salem','North Carolina','US',NULL),(3900,'San Bernardino','California','US',NULL),(3901,'Jackson','Mississippi','US','601'),(3902,'Little Rock','Arkansas','US','501'),(3903,'Salt Lake City','Utah','US','385'),(3904,'Reno','Nevada','US',NULL),(3905,'Newport News','Virginia','US',NULL),(3906,'Chandler','Arizona','US',NULL),(3907,'Laredo','Texas','US',NULL),(3908,'Henderson','Nevada','US',NULL),(3909,'Arlington','Virginia','US',NULL),(3910,'Knoxville','Tennessee','US',NULL),(3911,'Amarillo','Texas','US',NULL),(3912,'Providence','Rhode Island','US','401'),(3913,'Chula Vista','California','US',NULL),(3914,'Worcester','Massachusetts','US',NULL),(3915,'Oxnard','California','US',NULL),(3916,'Dayton','Ohio','US',NULL),(3917,'Garden Grove','California','US',NULL),(3918,'Oceanside','California','US',NULL),(3919,'Tempe','Arizona','US',NULL),(3920,'Huntsville','Alabama','US',NULL),(3921,'Ontario','California','US',NULL),(3922,'Chattanooga','Tennessee','US',NULL),(3923,'Fort Lauderdale','Florida','US',NULL),(3924,'Springfield','Massachusetts','US','417'),(3925,'Springfield','Missouri','US',NULL),(3926,'Santa Clarita','California','US',NULL),(3927,'Salinas','California','US',NULL),(3928,'Tallahassee','Florida','US','850'),(3929,'Rockford','Illinois','US',NULL),(3930,'Pomona','California','US',NULL),(3931,'Metairie','Louisiana','US',NULL),(3932,'Paterson','New Jersey','US',NULL),(3933,'Overland Park','Kansas','US',NULL),(3934,'Santa Rosa','California','US',NULL),(3935,'Syracuse','New York','US',NULL),(3936,'Kansas City','Kansas','US',NULL),(3937,'Hampton','Virginia','US',NULL),(3938,'Lakewood','Colorado','US',NULL),(3939,'Vancouver','Washington','US',NULL),(3940,'Irvine','California','US',NULL),(3941,'Aurora','Illinois','US',NULL),(3942,'Moreno Valley','California','US',NULL),(3943,'Pasadena','California','US',NULL),(3944,'Hayward','California','US',NULL),(3945,'Brownsville','Texas','US',NULL),(3946,'Bridgeport','Connecticut','US',NULL),(3947,'Hollywood','Florida','US',NULL),(3948,'Warren','Michigan','US',NULL),(3949,'Torrance','California','US',NULL),(3950,'Eugene','Oregon','US',NULL),(3951,'Pembroke Pines','Florida','US',NULL),(3952,'Salem','Oregon','US',NULL),(3953,'Pasadena','Texas','US',NULL),(3954,'Escondido','California','US',NULL),(3955,'Sunnyvale','California','US',NULL),(3956,'Savannah','Georgia','US',NULL),(3957,'Fontana','California','US',NULL),(3958,'Orange','California','US',NULL),(3959,'Naperville','Illinois','US',NULL),(3960,'Alexandria','Virginia','US',NULL),(3961,'Rancho Cucamonga','California','US',NULL),(3962,'Grand Prairie','Texas','US',NULL),(3963,'East Los Angeles','California','US',NULL),(3964,'Fullerton','California','US',NULL),(3965,'Corona','California','US',NULL),(3966,'Flint','Michigan','US',NULL),(3967,'Paradise','Nevada','US',NULL),(3968,'Mesquite','Texas','US',NULL),(3969,'Sterling Heights','Michigan','US',NULL),(3970,'Sioux Falls','South Dakota','US',NULL),(3971,'New Haven','Connecticut','US',NULL),(3972,'Topeka','Kansas','US','785'),(3973,'Concord','California','US','603'),(3974,'Evansville','Indiana','US',NULL),(3975,'Hartford','Connecticut','US','860'),(3976,'Fayetteville','North Carolina','US',NULL),(3977,'Cedar Rapids','Iowa','US',NULL),(3978,'Elizabeth','New Jersey','US',NULL),(3979,'Lansing','Michigan','US','517'),(3980,'Lancaster','California','US',NULL),(3981,'Fort Collins','Colorado','US',NULL),(3982,'Coral Springs','Florida','US',NULL),(3983,'Stamford','Connecticut','US',NULL),(3984,'Thousand Oaks','California','US',NULL),(3985,'Vallejo','California','US',NULL),(3986,'Palmdale','California','US',NULL),(3987,'Columbia','South Carolina','US','803'),(3988,'El Monte','California','US',NULL),(3989,'Abilene','Texas','US',NULL),(3990,'North Las Vegas','Nevada','US',NULL),(3991,'Ann Arbor','Michigan','US',NULL),(3992,'Beaumont','Texas','US',NULL),(3993,'Waco','Texas','US',NULL),(3994,'Macon','Georgia','US',NULL),(3995,'Independence','Missouri','US',NULL),(3996,'Peoria','Illinois','US',NULL),(3997,'Inglewood','California','US',NULL),(3998,'Springfield','Illinois','US',NULL),(3999,'Simi Valley','California','US',NULL),(4000,'Lafayette','Louisiana','US',NULL),(4001,'Gilbert','Arizona','US',NULL),(4002,'Carrollton','Texas','US',NULL),(4003,'Bellevue','Washington','US',NULL),(4004,'West Valley City','Utah','US',NULL),(4005,'Clarksville','Tennessee','US',NULL),(4006,'Costa Mesa','California','US',NULL),(4007,'Peoria','Arizona','US',NULL),(4008,'South Bend','Indiana','US',NULL),(4009,'Downey','California','US',NULL),(4010,'Waterbury','Connecticut','US',NULL),(4011,'Manchester','New Hampshire','US',NULL),(4012,'Allentown','Pennsylvania','US',NULL),(4013,'McAllen','Texas','US',NULL),(4014,'Joliet','Illinois','US',NULL),(4015,'Lowell','Massachusetts','US',NULL),(4016,'Provo','Utah','US',NULL),(4017,'West Covina','California','US',NULL),(4018,'Wichita Falls','Texas','US',NULL),(4019,'Erie','Pennsylvania','US',NULL),(4020,'Daly City','California','US',NULL),(4021,'Citrus Heights','California','US',NULL),(4022,'Norwalk','California','US',NULL),(4023,'Gary','Indiana','US',NULL),(4024,'Berkeley','California','US',NULL),(4025,'Santa Clara','California','US',NULL),(4026,'Green Bay','Wisconsin','US',NULL),(4027,'Cape Coral','Florida','US',NULL),(4028,'Arvada','Colorado','US',NULL),(4029,'Pueblo','Colorado','US',NULL),(4030,'Sandy','Utah','US',NULL),(4031,'Athens-Clarke County','Georgia','US',NULL),(4032,'Cambridge','Massachusetts','US',NULL),(4033,'Westminster','Colorado','US',NULL),(4034,'San Buenaventura','California','US',NULL),(4035,'Portsmouth','Virginia','US',NULL),(4036,'Livonia','Michigan','US',NULL),(4037,'Burbank','California','US',NULL),(4038,'Clearwater','Florida','US',NULL),(4039,'Midland','Texas','US',NULL),(4040,'Davenport','Iowa','US',NULL),(4041,'Mission Viejo','California','US',NULL),(4042,'Miami Beach','Florida','US',NULL),(4043,'Sunrise Manor','Nevada','US',NULL),(4044,'New Bedford','Massachusetts','US',NULL),(4045,'El Cajon','California','US',NULL),(4046,'Norman','Oklahoma','US',NULL),(4047,'Richmond','California','US',NULL),(4048,'Albany','New York','US','518'),(4049,'Brockton','Massachusetts','US',NULL),(4050,'Roanoke','Virginia','US',NULL),(4051,'Billings','Montana','US',NULL),(4052,'Compton','California','US',NULL),(4053,'Gainesville','Florida','US',NULL),(4054,'Fairfield','California','US',NULL),(4055,'Arden-Arcade','California','US',NULL),(4056,'San Mateo','California','US',NULL),(4057,'Visalia','California','US',NULL),(4058,'Boulder','Colorado','US',NULL),(4059,'Cary','North Carolina','US',NULL),(4060,'Santa Monica','California','US',NULL),(4061,'Fall River','Massachusetts','US',NULL),(4062,'Kenosha','Wisconsin','US',NULL),(4063,'Elgin','Illinois','US',NULL),(4064,'Odessa','Texas','US',NULL),(4065,'Carson','California','US',NULL),(4066,'Charleston','South Carolina','US','843'),(4067,'Charlotte Amalie','St Thomas','VI',NULL),(4068,'Harare','Harare','ZW',NULL),(4069,'Bulawayo','Bulawayo','ZW',NULL),(4070,'Chitungwiza','Harare','ZW',NULL),(4071,'Mount Darwin','Harare','ZW',NULL),(4072,'Mutare','Manicaland','ZW',NULL),(4073,'Gweru','Midlands','ZW',NULL),(4074,'Gaza','Gaza','PS',NULL),(4075,'Khan Yunis','Khan Yunis','PS',NULL),(4076,'Hebron','Hebron','PS',NULL),(4077,'Jabaliya','North Gaza','PS',NULL),(4078,'Nablus','Nablus','PS',NULL),(4079,'Rafah','Rafah','PS',NULL);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `adress` mediumtext,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `country` varchar(5) NOT NULL,
  `city` int(11) NOT NULL,
  `cityother` varchar(35) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  PRIMARY KEY (`companyID`),
  KEY `index1` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (14,'Ceidasoftware',NULL,NULL,'imadige@gmail.com','TUR',4122,'',1,'2013-04-23 23:22:56');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companysettings`
--

DROP TABLE IF EXISTS `companysettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companysettings` (
  `companysettingsID` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(45) DEFAULT NULL,
  `cur` tinyint(1) NOT NULL,
  `companyID` int(11) NOT NULL,
  PRIMARY KEY (`companysettingsID`),
  KEY `index1` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companysettings`
--

LOCK TABLES `companysettings` WRITE;
/*!40000 ALTER TABLE `companysettings` DISABLE KEYS */;
INSERT INTO `companysettings` VALUES (1,NULL,1,14);
/*!40000 ALTER TABLE `companysettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `code` char(2) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT '',
  `currencyCode` char(3) DEFAULT NULL,
  `fipsCode` char(2) DEFAULT NULL,
  `isoNumeric` char(4) DEFAULT NULL,
  `north` varchar(30) DEFAULT NULL,
  `south` varchar(30) DEFAULT NULL,
  `east` varchar(30) DEFAULT NULL,
  `west` varchar(30) DEFAULT NULL,
  `capital` varchar(30) DEFAULT NULL,
  `continentName` varchar(15) DEFAULT NULL,
  `continent` char(2) DEFAULT NULL,
  `areaInSqKm` varchar(20) DEFAULT NULL,
  `languages` varchar(100) DEFAULT NULL,
  `isoAlpha3` char(3) DEFAULT NULL,
  `geonameId` int(10) DEFAULT NULL,
  `phoneCode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES ('AD','Andorra','EUR','AN','020','42.65604389629997','42.42849259876837','1.7865427778319827','1.4071867141112762','Andorra la Vella','Europe','EU','468.0','ca','AND',3041565,'0376'),('AE','United Arab Emirates','AED','AE','784','26.08415985107422','22.633329391479492','56.38166046142578','51.58332824707031','Abu Dhabi','Asia','AS','82880.0','ar-AE,fa,en,hi,ur','ARE',290557,'0971'),('AF','Afghanistan','AFN','AF','004','38.483418','29.377472','74.879448','60.478443','Kabul','Asia','AS','647500.0','fa-AF,ps,uz-AF,tk','AFG',1149361,'0093'),('AG','Antigua and Barbuda','XCD','AC','028','17.729387','16.996979','-61.672421','-61.906425','St. John\'s','North America','NA','443.0','en-AG','ATG',3576396,'1268'),('AI','Anguilla','XCD','AV','660','18.283424','18.166815','-62.971359','-63.172901','The Valley','North America','NA','102.0','en-AI','AIA',3573511,'1264'),('AL','Albania','ALL','AL','008','42.665611','39.648361','21.068472','19.293972','Tirana','Europe','EU','28748.0','sq,el','ALB',783754,'0355'),('AM','Armenia','AMD','AM','051','41.301834','38.830528','46.772435045159995','43.44978','Yerevan','Asia','AS','29800.0','hy','ARM',174982,'0374'),('AO','Angola','AOA','AO','024','-4.376826','-18.042076','24.082119','11.679219','Luanda','Africa','AF','1246700.0','pt-AO','AGO',3351879,'0244'),('AQ','Antarctica','','AY','010','-60.515533','-89.9999','179.9999','-179.9999','','Antarctica','AN','1.4E7','','ATA',6697173,NULL),('AR','Argentina','ARS','AR','032','-21.781277','-55.061314','-53.591835','-73.58297','Buenos Aires','South America','SA','2766890.0','es-AR,en,it,de,fr,gn','ARG',3865483,'0054'),('AS','American Samoa','USD','AQ','016','-11.0497','-14.382478','-169.416077','-171.091888','Pago Pago','Oceania','OC','199.0','en-AS,sm,to','ASM',5880801,'1684'),('AT','Austria','EUR','AU','040','49.0211627691393','46.3726520216244','17.1620685652599','9.53095237240833','Vienna','Europe','EU','83858.0','de-AT,hr,hu,sl','AUT',2782113,'0043'),('AU','Australia','AUD','AS','036','-10.062805','-43.64397','153.639252','112.911057','Canberra','Oceania','OC','7686850.0','en-AU','AUS',2077456,'0061'),('AW','Aruba','AWG','AA','533','12.623718127152925','12.411707706190716','-69.86575120104982','-70.0644737196045','Oranjestad','North America','NA','193.0','nl-AW,es,en','ABW',3577279,'0297'),('AX','Åland','EUR','','248','60.488861','59.90675','21.011862','19.317694','Mariehamn','Europe','EU','','sv-AX','ALA',661882,NULL),('AZ','Azerbaijan','AZN','AJ','031','41.90564','38.38915252685547','50.370083','44.774113','Baku','Asia','AS','86600.0','az,ru,hy','AZE',587116,'0994'),('BA','Bosnia and Herzegovina','BAM','BK','070','45.239193','42.546112','19.622223','15.718945','Sarajevo','Europe','EU','51129.0','bs,hr-BA,sr-BA','BIH',3277605,'0387'),('BB','Barbados','BBD','BB','052','13.327257','13.039844','-59.420376','-59.648922','Bridgetown','North America','NA','431.0','en-BB','BRB',3374084,'1246'),('BD','Bangladesh','BDT','BG','050','26.631945','20.743334','92.673668','88.028336','Dhaka','Asia','AS','144000.0','bn-BD,en','BGD',1210997,'0880'),('BE','Belgium','EUR','BE','056','51.505444','49.49361','6.403861','2.546944','Brussels','Europe','EU','30510.0','nl-BE,fr-BE,de-BE','BEL',2802361,'0032'),('BF','Burkina Faso','XOF','UV','854','15.082593','9.401108','2.405395','-5.518916','Ouagadougou','Africa','AF','274200.0','fr-BF','BFA',2361809,'0226'),('BG','Bulgaria','BGN','BU','100','44.21764','41.242084','28.612167','22.371166','Sofia','Europe','EU','110910.0','bg,tr-BG','BGR',732800,'0359'),('BH','Bahrain','BHD','BA','048','26.282583','25.796862','50.664471','50.45414','Manama','Asia','AS','665.0','ar-BH,en,fa,ur','BHR',290291,'0973'),('BI','Burundi','BIF','BY','108','-2.310123','-4.465713','30.847729','28.993061','Bujumbura','Africa','AF','27830.0','fr-BI,rn','BDI',433561,'0257'),('BJ','Benin','XOF','BN','204','12.418347','6.225748','3.851701','0.774575','Porto-Novo','Africa','AF','112620.0','fr-BJ','BEN',2395170,'0229'),('BL','Saint Barthélemy','EUR','TB','652','17.928808791949283','17.878183227405575','-62.788983372985854','-62.8739118253784','Gustavia','North America','NA','21.0','fr','BLM',3578476,NULL),('BM','Bermuda','BMD','BD','060','32.393833','32.246639','-64.651993','-64.89605','Hamilton','North America','NA','53.0','en-BM,pt','BMU',3573345,'1441'),('BN','Brunei','BND','BX','096','5.047167','4.003083','115.359444','114.071442','Bandar Seri Begawan','Asia','AS','5770.0','ms-BN,en-BN','BRN',1820814,NULL),('BO','Bolivia','BOB','BL','068','-9.680567','-22.896133','-57.45809600000001','-69.640762','Sucre','South America','SA','1098580.0','es-BO,qu,ay','BOL',3923057,'0591'),('BQ','Bonaire','USD','','535','12.304535','12.017149','-68.192307','-68.416458','','North America','NA','','nl,pap,en','BES',7626844,NULL),('BR','Brazil','BRL','BR','076','5.264877','-33.750706','-32.392998','-73.985535','Brasília','South America','SA','8511965.0','pt-BR,es,en,fr','BRA',3469034,'0055'),('BS','Bahamas','BSD','BF','044','26.919243','22.852743','-74.423874','-78.995911','Nassau','North America','NA','13940.0','en-BS','BHS',3572887,'1242'),('BT','Bhutan','BTN','BT','064','28.323778','26.70764','92.125191','88.75972','Thimphu','Asia','AS','47000.0','dz','BTN',1252634,'0975'),('BV','Bouvet Island','NOK','BV','074','-54.400322','-54.462383','3.487976','3.335499','','Antarctica','AN','','','BVT',3371123,NULL),('BW','Botswana','BWP','BC','072','-17.780813','-26.907246','29.360781','19.999535','Gaborone','Africa','AF','600370.0','en-BW,tn-BW','BWA',933860,'0267'),('BY','Belarus','BYR','BO','112','56.165806','51.256416','32.770805','23.176889','Minsk','Europe','EU','207600.0','be,ru','BLR',630336,'0375'),('BZ','Belize','BZD','BH','084','18.496557','15.8893','-87.776985','-89.224815','Belmopan','North America','NA','22966.0','en-BZ,es','BLZ',3582678,'0501'),('CA','Canada','CAD','CA','124','83.110626','41.67598','-52.636291','-141','Ottawa','North America','NA','9984670.0','en-CA,fr-CA,iu','CAN',6251999,'0001'),('CC','Cocos [Keeling] Islands','AUD','CK','166','-12.072459094','-12.208725839','96.929489344','96.816941408','West Island','Asia','AS','14.0','ms-CC,en','CCK',1547376,NULL),('CD','Democratic Republic of the Congo','CDF','CG','180','5.386098','-13.455675','31.305912','12.204144','Kinshasa','Africa','AF','2345410.0','fr-CD,ln,kg','COD',203312,NULL),('CF','Central African Republic','XAF','CT','140','11.007569','2.220514','27.463421','14.420097','Bangui','Africa','AF','622984.0','fr-CF,sg,ln,kg','CAF',239880,'0236'),('CG','Republic of the Congo','XAF','CF','178','3.703082','-5.027223','18.649839','11.205009','Brazzaville','Africa','AF','342000.0','fr-CG,kg,ln-CG','COG',2260494,'0242'),('CH','Switzerland','CHF','SZ','756','47.805332','45.825695','10.491472','5.957472','Berne','Europe','EU','41290.0','de-CH,fr-CH,it-CH,rm','CHE',2658434,'0041'),('CI','Ivory Coast','XOF','IV','384','10.736642','4.357067','-2.494897','-8.599302','Yamoussoukro','Africa','AF','322460.0','fr-CI','CIV',2287781,NULL),('CK','Cook Islands','NZD','CW','184','-10.023114','-21.944164','-157.312134','-161.093658','Avarua','Oceania','OC','240.0','en-CK,mi','COK',1899402,'0682'),('CL','Chile','CLP','CI','152','-17.507553','-55.9256225109217','-66.417557','-80.785851','Santiago','South America','SA','756950.0','es-CL','CHL',3895114,'0056'),('CM','Cameroon','XAF','CM','120','13.078056','1.652548','16.192116','8.494763','Yaoundé','Africa','AF','475440.0','en-CM,fr-CM','CMR',2233387,'0237'),('CN','China','CNY','CH','156','53.56086','15.775416','134.773911','73.557693','Beijing','Asia','AS','9596960.0','zh-CN,yue,wuu,dta,ug,za','CHN',1814991,'0086'),('CO','Colombia','COP','CO','170','13.380502','-4.225869','-66.869835','-81.728111','Bogotá','South America','SA','1138910.0','es-CO','COL',3686110,'0057'),('CR','Costa Rica','CRC','CS','188','11.216819','8.032975','-82.555992','-85.950623','San José','North America','NA','51100.0','es-CR,en','CRI',3624060,'0506'),('CU','Cuba','CUP','CU','192','23.226042','19.828083','-74.131775','-84.957428','Havana','North America','NA','110860.0','es-CU','CUB',3562981,'0053'),('CV','Cape Verde','CVE','CV','132','17.197178','14.808022','-22.669443','-25.358747','Praia','Africa','AF','4033.0','pt-CV','CPV',3374766,'0238'),('CW','Curacao','ANG','UC','531','12.385672','12.032745','-68.733948','-69.157204','Willemstad','North America','NA','','nl,pap','CUW',7626836,NULL),('CX','Christmas Island','AUD','KT','162','-10.412356007','-10.5704829995','105.712596992','105.533276992','The Settlement','Asia','AS','135.0','en,zh,ms-CC','CXR',2078138,'0061'),('CY','Cyprus','EUR','CY','196','35.701527','34.6332846722908','34.59791599999994','32.27308300000004','Nicosia','Europe','EU','9250.0','el-CY,tr-CY,en','CYP',146669,'0357'),('CZ','Czech Republic','CZK','EZ','203','51.058887','48.542915','18.860111','12.096194','Prague','Europe','EU','78866.0','cs,sk','CZE',3077311,'0420'),('DE','Germany','EUR','GM','276','55.055637','47.275776','15.039889','5.865639','Berlin','Europe','EU','357021.0','de','DEU',2921044,'0049'),('DJ','Djibouti','DJF','DJ','262','12.706833','10.909917','43.416973','41.773472','Djibouti','Africa','AF','23000.0','fr-DJ,ar,so-DJ,aa','DJI',223816,'0253'),('DK','Denmark','DKK','DA','208','57.748417','54.562389','15.158834','8.075611','Copenhagen','Europe','EU','43094.0','da-DK,en,fo,de-DK','DNK',2623032,'0045'),('DM','Dominica','XCD','DO','212','15.631809','15.20169','-61.244152','-61.484108','Roseau','North America','NA','754.0','en-DM','DMA',3575830,'1767'),('DO','Dominican Republic','DOP','DR','214','19.929859','17.543159','-68.32','-72.003487','Santo Domingo','North America','NA','48730.0','es-DO','DOM',3508796,'1809'),('DZ','Algeria','DZD','AG','012','37.093723','18.960028','11.979548','-8.673868','Algiers','Africa','AF','2381740.0','ar-DZ','DZA',2589581,'0213'),('EC','Ecuador','USD','EC','218','1.43902','-4.998823','-75.184586','-81.078598','Quito','South America','SA','283560.0','es-EC','ECU',3658394,'0593'),('EE','Estonia','EUR','EN','233','59.676224','57.516193','28.209972','21.837584','Tallinn','Europe','EU','45226.0','et,ru','EST',453733,'0372'),('EG','Egypt','EGP','EG','818','31.667334','21.725389','36.89833068847656','24.698111','Cairo','Africa','AF','1001450.0','ar-EG,en,fr','EGY',357994,'0020'),('EH','Western Sahara','MAD','WI','732','27.669674','20.774158','-8.670276','-17.103182','El Aaiún','Africa','AF','266000.0','ar,mey','ESH',2461445,NULL),('ER','Eritrea','ERN','ER','232','18.003084','12.359555','43.13464','36.438778','Asmara','Africa','AF','121320.0','aa-ER,ar,tig,kun,ti-ER','ERI',338010,'0291'),('ES','Spain','EUR','SP','724','43.7913565913767','36.0001044260548','4.32778473043961','-9.30151567231899','Madrid','Europe','EU','504782.0','es-ES,ca,gl,eu,oc','ESP',2510769,'0034'),('ET','Ethiopia','ETB','ET','231','14.89375','3.402422','47.986179','32.999939','Addis Ababa','Africa','AF','1127127.0','am,en-ET,om-ET,ti-ET,so-ET,sid','ETH',337996,'0251'),('FI','Finland','EUR','FI','246','70.096054','59.808777','31.580944','20.556944','Helsinki','Europe','EU','337030.0','fi-FI,sv-FI,smn','FIN',660013,'0358'),('FJ','Fiji','FJD','FJ','242','-12.480111','-20.67597','-178.424438','177.129334','Suva','Oceania','OC','18270.0','en-FJ,fj','FJI',2205218,'0679'),('FK','Falkland Islands','FKP','FK','238','-51.24065','-52.360512','-57.712486','-61.345192','Stanley','South America','SA','12173.0','en-FK','FLK',3474414,NULL),('FM','Micronesia','USD','FM','583','10.08904','1.02629','163.03717','137.33648','Palikir','Oceania','OC','702.0','en-FM,chk,pon,yap,kos,uli,woe,nkr,kpg','FSM',2081918,NULL),('FO','Faroe Islands','DKK','FO','234','62.400749','61.394943','-6.399583','-7.458','Tórshavn','Europe','EU','1399.0','fo,da-FO','FRO',2622320,'0298'),('FR','France','EUR','FR','250','51.092804','41.371582','9.561556','-5.142222','Paris','Europe','EU','547030.0','fr-FR,frp,br,co,ca,eu,oc','FRA',3017382,'0033'),('GA','Gabon','XAF','GB','266','2.322612','-3.978806','14.502347','8.695471','Libreville','Africa','AF','267667.0','fr-GA','GAB',2400553,'0241'),('GB','United Kingdom','GBP','UK','826','59.360249','49.906193','1.759','-8.623555','London','Europe','EU','244820.0','en-GB,cy-GB,gd','GBR',2635167,'0044'),('GD','Grenada','XCD','GJ','308','12.318283928171299','11.986893','-61.57676970108031','-61.802344','St. George\'s','North America','NA','344.0','en-GD','GRD',3580239,'1473'),('GE','Georgia','GEL','GG','268','43.586498','41.053196','46.725971','40.010139','Tbilisi','Asia','AS','69700.0','ka,ru,hy,az','GEO',614540,'0995'),('GF','French Guiana','EUR','FG','254','5.776496','2.127094','-51.613949','-54.542511','Cayenne','South America','SA','91000.0','fr-GF','GUF',3381670,'0594'),('GG','Guernsey','GBP','GK','831','49.731727816705416','49.40764156876899','-2.1577152112246267','-2.673194593476069','St Peter Port','Europe','EU','78.0','en,fr','GGY',3042362,NULL),('GH','Ghana','GHS','GH','288','11.173301','4.736723','1.191781','-3.25542','Accra','Africa','AF','239460.0','en-GH,ak,ee,tw','GHA',2300660,'0233'),('GI','Gibraltar','GIP','GI','292','36.155439135670726','36.10903070140248','-5.338285164001491','-5.36626149743654','Gibraltar','Europe','EU','6.5','en-GI,es,it,pt','GIB',2411586,'0350'),('GL','Greenland','DKK','GL','304','83.627357','59.777401','-11.312319','-73.04203','Nuuk','North America','NA','2166086.0','kl,da-GL,en','GRL',3425505,'0299'),('GM','Gambia','GMD','GA','270','13.826571','13.064252','-13.797793','-16.825079','Banjul','Africa','AF','11300.0','en-GM,mnk,wof,wo,ff','GMB',2413451,'0220'),('GN','Guinea','GNF','GV','324','12.67622','7.193553','-7.641071','-14.926619','Conakry','Africa','AF','245857.0','fr-GN','GIN',2420477,'0224'),('GP','Guadeloupe','EUR','GP','312','16.516848','15.867565','-61','-61.544765','Basse-Terre','North America','NA','1780.0','fr-GP','GLP',3579143,'0590'),('GQ','Equatorial Guinea','XAF','EK','226','2.346989','0.92086','11.335724','9.346865','Malabo','Africa','AF','28051.0','es-GQ,fr','GNQ',2309096,'0240'),('GR','Greece','EUR','GR','300','41.7484999849641','34.8020663391466','28.2470831714347','19.3736035624134','Athens','Europe','EU','131940.0','el-GR,en,fr','GRC',390903,'0030'),('GS','South Georgia and the South Sandwich Islands','GBP','SX','239','-53.970467','-59.479259','-26.229326','-38.021175','Grytviken','Antarctica','AN','3903.0','en','SGS',3474415,'0500'),('GT','Guatemala','GTQ','GT','320','17.81522','13.737302','-88.223198','-92.23629','Guatemala City','North America','NA','108890.0','es-GT','GTM',3595528,'0502'),('GU','Guam','USD','GQ','316','13.654402','13.23376','144.956894','144.61806','Hagåtña','Oceania','OC','549.0','en-GU,ch-GU','GUM',4043988,'1671'),('GW','Guinea-Bissau','XOF','PU','624','12.680789','10.924265','-13.636522','-16.717535','Bissau','Africa','AF','36120.0','pt-GW,pov','GNB',2372248,'0245'),('GY','Guyana','GYD','GY','328','8.557567','1.17508','-56.480251','-61.384762','Georgetown','South America','SA','214970.0','en-GY','GUY',3378535,'0592'),('HK','Hong Kong','HKD','HK','344','22.559778','22.15325','114.434753','113.837753','Hong Kong','Asia','AS','1092.0','zh-HK,yue,zh,en','HKG',1819730,'0852'),('HM','Heard Island and McDonald Islands','AUD','HM','334','-52.909416','-53.192001','73.859146','72.596535','','Antarctica','AN','412.0','','HMD',1547314,NULL),('HN','Honduras','HNL','HO','340','16.510256','12.982411','-83.155403','-89.350792','Tegucigalpa','North America','NA','112090.0','es-HN','HND',3608932,'0504'),('HR','Croatia','HRK','HR','191','46.53875','42.43589','19.427389','13.493222','Zagreb','Europe','EU','56542.0','hr-HR,sr','HRV',3202326,'0385'),('HT','Haiti','HTG','HA','332','20.08782','18.021032','-71.613358','-74.478584','Port-au-Prince','North America','NA','27750.0','ht,fr-HT','HTI',3723988,'0509'),('HU','Hungary','HUF','HU','348','48.585667','45.74361','22.906','16.111889','Budapest','Europe','EU','93030.0','hu-HU','HUN',719819,'0036'),('ID','Indonesia','IDR','ID','360','5.904417','-10.941861','141.021805','95.009331','Jakarta','Asia','AS','1919440.0','id,en,nl,jv','IDN',1643084,'0062'),('IE','Ireland','EUR','EI','372','55.387917','51.451584','-6.002389','-10.478556','Dublin','Europe','EU','70280.0','en-IE,ga-IE','IRL',2963597,'0353'),('IL','Israel','ILS','IS','376','33.340137','29.496639','35.876804','34.270278754419145','','Asia','AS','20770.0','he,ar-IL,en-IL,','ISR',294640,'0972'),('IM','Isle of Man','GBP','IM','833','54.419724','54.055916','-4.3115','-4.798722','Douglas','Europe','EU','572.0','en,gv','IMN',3042225,NULL),('IN','India','INR','IN','356','35.504223','6.747139','97.403305','68.186691','New Delhi','Asia','AS','3287590.0','en-IN,hi,bn,te,mr,ta,ur,gu,kn,ml,or,pa,as,bh,sat,ks,ne,sd,kok,doi,mni,sit,sa,fr,lus,inc','IND',1269750,'0091'),('IO','British Indian Ocean Territory','USD','IO','086','-5.268333','-7.438028','72.493164','71.259972','','Asia','AS','60.0','en-IO','IOT',1282588,'0246'),('IQ','Iraq','IQD','IZ','368','37.378029','29.069445','48.575916','38.795887','Baghdad','Asia','AS','437072.0','ar-IQ,ku,hy','IRQ',99237,'0964'),('IR','Iran','IRR','IR','364','39.777222','25.064083','63.317471','44.047279','Tehran','Asia','AS','1648000.0','fa-IR,ku','IRN',130758,NULL),('IS','Iceland','ISK','IC','352','66.53463','63.393253','-13.495815','-24.546524','Reykjavik','Europe','EU','103000.0','is,en,de,da,sv,no','ISL',2629691,'0354'),('IT','Italy','EUR','IT','380','47.095196','36.652779','18.513445','6.614889','Rome','Europe','EU','301230.0','it-IT,de-IT,fr-IT,sc,ca,co,sl','ITA',3175395,'0039'),('JE','Jersey','GBP','JE','832','49.265057','49.169834','-2.022083','-2.260028','Saint Helier','Europe','EU','116.0','en,pt','JEY',3042142,NULL),('JM','Jamaica','JMD','JM','388','18.526976','17.703554','-76.180321','-78.366638','Kingston','North America','NA','10991.0','en-JM','JAM',3489940,'1876'),('JO','Jordan','JOD','JO','400','33.367668','29.185888','39.301167','34.959999','Amman','Asia','AS','92300.0','ar-JO,en','JOR',248816,'0962'),('JP','Japan','JPY','JA','392','45.52314','24.249472','145.820892','122.93853','Tokyo','Asia','AS','377835.0','ja','JPN',1861060,'0081'),('KE','Kenya','KES','KE','404','5.019938','-4.678047','41.899078','33.908859','Nairobi','Africa','AF','582650.0','en-KE,sw-KE','KEN',192950,'0254'),('KG','Kyrgyzstan','KGS','KG','417','43.238224','39.172832','80.283165','69.276611','Bishkek','Asia','AS','198500.0','ky,uz,ru','KGZ',1527747,'0996'),('KH','Cambodia','KHR','CB','116','14.686417','10.409083','107.627724','102.339996','Phnom Penh','Asia','AS','181040.0','km,fr,en','KHM',1831722,'0855'),('KI','Kiribati','AUD','KR','296','4.71957','-11.446881150186856','-150.215347','169.556137','Tarawa','Oceania','OC','811.0','en-KI,gil','KIR',4030945,'0686'),('KM','Comoros','KMF','CN','174','-11.362381','-12.387857','44.538223','43.21579','Moroni','Africa','AF','2170.0','ar,fr-KM','COM',921929,'0269'),('KN','Saint Kitts and Nevis','XCD','SC','659','17.420118','17.095343','-62.543266','-62.86956','Basseterre','North America','NA','261.0','en-KN','KNA',3575174,'1869'),('KP','North Korea','KPW','KN','408','43.006054','37.673332','130.674866','124.315887','Pyongyang','Asia','AS','120540.0','ko-KP','PRK',1873107,NULL),('KR','South Korea','KRW','KS','410','38.612446','33.190945','129.584671','125.887108','Seoul','Asia','AS','98480.0','ko-KR,en','KOR',1835841,NULL),('KW','Kuwait','KWD','KU','414','30.095945','28.524611','48.431473','46.555557','Kuwait City','Asia','AS','17820.0','ar-KW,en','KWT',285570,'0965'),('KY','Cayman Islands','KYD','CJ','136','19.7617','19.263029','-79.727272','-81.432777','George Town','North America','NA','262.0','en-KY','CYM',3580718,'1345'),('KZ','Kazakhstan','KZT','KZ','398','55.451195','40.936333','87.312668','46.491859','Astana','Asia','AS','2717300.0','kk,ru','KAZ',1522867,'0076'),('LA','Laos','LAK','LA','418','22.500389','13.910027','107.697029','100.093056','Vientiane','Asia','AS','236800.0','lo,fr,en','LAO',1655842,NULL),('LB','Lebanon','LBP','LE','422','34.691418','33.05386','36.639194','35.114277','Beirut','Asia','AS','10400.0','ar-LB,fr-LB,en,hy','LBN',272103,'0961'),('LC','Saint Lucia','XCD','ST','662','14.103245','13.704778','-60.874203','-61.07415','Castries','North America','NA','616.0','en-LC','LCA',3576468,'1758'),('LI','Liechtenstein','CHF','LS','438','47.2706251386959','47.0484284123471','9.63564281136796','9.47167359782014','Vaduz','Europe','EU','160.0','de-LI','LIE',3042058,'0423'),('LK','Sri Lanka','LKR','CE','144','9.831361','5.916833','81.881279','79.652916','Colombo','Asia','AS','65610.0','si,ta,en','LKA',1227603,'0094'),('LR','Liberia','LRD','LI','430','8.551791','4.353057','-7.365113','-11.492083','Monrovia','Africa','AF','111370.0','en-LR','LBR',2275384,'0231'),('LS','Lesotho','LSL','LT','426','-28.572058','-30.668964','29.465761','27.029068','Maseru','Africa','AF','30355.0','en-LS,st,zu,xh','LSO',932692,'0266'),('LT','Lithuania','LTL','LH','440','56.446918','53.901306','26.871944','20.941528','Vilnius','Europe','EU','65200.0','lt,ru,pl','LTU',597427,'0370'),('LU','Luxembourg','EUR','LU','442','50.184944','49.446583','6.528472','5.734556','Luxembourg','Europe','EU','2586.0','lb,de-LU,fr-LU','LUX',2960313,'0352'),('LV','Latvia','EUR','LG','428','58.082306','55.668861','28.241167','20.974277','Riga','Europe','EU','64589.0','lv,ru,lt','LVA',458258,'0371'),('LY','Libya','LYD','LY','434','33.168999','19.508045','25.150612','9.38702','Tripoli','Africa','AF','1759540.0','ar-LY,it,en','LBY',2215636,NULL),('MA','Morocco','MAD','MO','504','35.9224966985384','27.662115','-0.991750000000025','-13.168586','Rabat','Africa','AF','446550.0','ar-MA,fr','MAR',2542007,'0212'),('MC','Monaco','EUR','MN','492','43.75196717037228','43.72472839869377','7.439939260482788','7.408962249755859','Monaco','Europe','EU','1.95','fr-MC,en,it','MCO',2993457,'0377'),('MD','Moldova','MDL','MD','498','48.490166','45.468887','30.135445','26.618944','Chişinău','Europe','EU','33843.0','ro,ru,gag,tr','MDA',617790,NULL),('ME','Montenegro','EUR','MJ','499','43.570137','41.850166','20.358833','18.461306','Podgorica','Europe','EU','14026.0','sr,hu,bs,sq,hr,rom','MNE',3194884,NULL),('MF','Saint Martin','EUR','RN','663','18.130354','18.052231','-63.012993','-63.152767','Marigot','North America','NA','53.0','fr','MAF',3578421,NULL),('MG','Madagascar','MGA','MA','450','-11.945433','-25.608952','50.48378','43.224876','Antananarivo','Africa','AF','587040.0','fr-MG,mg','MDG',1062947,'0261'),('MH','Marshall Islands','USD','RM','584','14.62','5.587639','171.931808','165.524918','Majuro','Oceania','OC','181.3','mh,en-MH','MHL',2080185,'0692'),('MK','Macedonia','MKD','MK','807','42.361805','40.860195','23.038139','20.464695','Skopje','Europe','EU','25333.0','mk,sq,tr,rmm,sr','MKD',718075,NULL),('ML','Mali','XOF','ML','466','25.000002','10.159513','4.244968','-12.242614','Bamako','Africa','AF','1240000.0','fr-ML,bm','MLI',2453866,'0223'),('MM','Myanmar [Burma]','MMK','BM','104','28.543249','9.784583','101.176781','92.189278','Nay Pyi Taw','Asia','AS','678500.0','my','MMR',1327865,'0095'),('MN','Mongolia','MNT','MG','496','52.154251','41.567638','119.924309','87.749664','Ulan Bator','Asia','AS','1565000.0','mn,ru','MNG',2029969,'0976'),('MO','Macao','MOP','MC','446','22.222334','22.180389','113.565834','113.528946','Macao','Asia','AS','254.0','zh,zh-MO,pt','MAC',1821275,NULL),('MP','Northern Mariana Islands','USD','CQ','580','20.55344','14.11023','146.06528','144.88626','Saipan','Oceania','OC','477.0','fil,tl,zh,ch-MP,en-MP','MNP',4041468,'1670'),('MQ','Martinique','EUR','MB','474','14.878819','14.392262','-60.81551','-61.230118','Fort-de-France','North America','NA','1100.0','fr-MQ','MTQ',3570311,'0596'),('MR','Mauritania','MRO','MR','478','27.298073','14.715547','-4.827674','-17.066521','Nouakchott','Africa','AF','1030700.0','ar-MR,fuc,snk,fr,mey,wo','MRT',2378080,'0222'),('MS','Montserrat','XCD','MH','500','16.824060205313184','16.674768935441556','-62.144100129608205','-62.24138237036129','Plymouth','North America','NA','102.0','en-MS','MSR',3578097,'1664'),('MT','Malta','EUR','MT','470','36.0821530995456','35.8061835000002','14.5764915000002','14.1834251000001','Valletta','Europe','EU','316.0','mt,en-MT','MLT',2562770,'0356'),('MU','Mauritius','MUR','MP','480','-10.319255','-20.525717','63.500179','56.512718','Port Louis','Africa','AF','2040.0','en-MU,bho,fr','MUS',934292,'0230'),('MV','Maldives','MVR','MV','462','7.091587495414767','-0.692694','73.637276','72.693222','Malé','Asia','AS','300.0','dv,en','MDV',1282028,'0960'),('MW','Malawi','MWK','MI','454','-9.367541','-17.125','35.916821','32.67395','Lilongwe','Africa','AF','118480.0','ny,yao,tum,swk','MWI',927384,'0265'),('MX','Mexico','MXN','MX','484','32.716759','14.532866','-86.703392','-118.453949','Mexico City','North America','NA','1972550.0','es-MX','MEX',3996063,'0052'),('MY','Malaysia','MYR','MY','458','7.363417','0.855222','119.267502','99.643448','Kuala Lumpur','Asia','AS','329750.0','ms-MY,en,zh,ta,te,ml,pa,th','MYS',1733045,'0060'),('MZ','Mozambique','MZN','MZ','508','-10.471883','-26.868685','40.842995','30.217319','Maputo','Africa','AF','801590.0','pt-MZ,vmw','MOZ',1036973,'0258'),('NA','Namibia','NAD','WA','516','-16.959894','-28.97143','25.256701','11.71563','Windhoek','Africa','AF','825418.0','en-NA,af,de,hz,naq','NAM',3355338,'0264'),('NC','New Caledonia','XPF','NC','540','-19.549778','-22.698','168.129135','163.564667','Noumea','Oceania','OC','19060.0','fr-NC','NCL',2139685,'0687'),('NE','Niger','XOF','NG','562','23.525026','11.696975','15.995643','0.16625','Niamey','Africa','AF','1267000.0','fr-NE,ha,kr,dje','NER',2440476,'0227'),('NF','Norfolk Island','AUD','NF','574','-28.995170686948427','-29.063076742954735','167.99773740209957','167.91543230151365','Kingston','Oceania','OC','34.6','en-NF','NFK',2155115,'0672'),('NG','Nigeria','NGN','NI','566','13.892007','4.277144','14.680073','2.668432','Abuja','Africa','AF','923768.0','en-NG,ha,yo,ig,ff','NGA',2328926,'0234'),('NI','Nicaragua','NIO','NU','558','15.025909','10.707543','-82.738289','-87.690308','Managua','North America','NA','129494.0','es-NI,en','NIC',3617476,'0505'),('NL','Netherlands','EUR','NL','528','53.512196','50.753918','7.227944','3.362556','Amsterdam','Europe','EU','41526.0','nl-NL,fy-NL','NLD',2750405,'0031'),('NO','Norway','NOK','NO','578','71.18811','57.977917','31.078052520751953','4.650167','Oslo','Europe','EU','324220.0','no,nb,nn,se,fi','NOR',3144096,'0047'),('NP','Nepal','NPR','NP','524','30.43339','26.356722','88.199333','80.056274','Kathmandu','Asia','AS','140800.0','ne,en','NPL',1282988,'0977'),('NR','Nauru','AUD','NR','520','-0.504306','-0.552333','166.945282','166.899033','','Oceania','OC','21.0','na,en-NR','NRU',2110425,'0674'),('NU','Niue','NZD','NE','570','-18.951069','-19.152193','-169.775177','-169.951004','Alofi','Oceania','OC','260.0','niu,en-NU','NIU',4036232,'0683'),('NZ','New Zealand','NZD','NZ','554','-34.389668','-47.286026','-180','166.7155','Wellington','Oceania','OC','268680.0','en-NZ,mi','NZL',2186224,'0064'),('OM','Oman','OMR','MU','512','26.387972','16.64575','59.836582','51.882','Muscat','Asia','AS','212460.0','ar-OM,en,bal,ur','OMN',286963,'0968'),('PA','Panama','PAB','PM','591','9.637514','7.197906','-77.17411','-83.051445','Panama City','North America','NA','78200.0','es-PA,en','PAN',3703430,'0507'),('PE','Peru','PEN','PE','604','-0.012977','-18.349728','-68.677986','-81.326744','Lima','South America','SA','1285220.0','es-PE,qu,ay','PER',3932488,'0051'),('PF','French Polynesia','XPF','FP','258','-7.903573','-27.653572','-134.929825','-152.877167','Papeete','Oceania','OC','4167.0','fr-PF,ty','PYF',4030656,'0689'),('PG','Papua New Guinea','PGK','PP','598','-1.318639','-11.657861','155.96344','140.842865','Port Moresby','Oceania','OC','462840.0','en-PG,ho,meu,tpi','PNG',2088628,'0675'),('PH','Philippines','PHP','RP','608','21.120611','4.643306','126.601524','116.931557','Manila','Asia','AS','300000.0','tl,en-PH,fil','PHL',1694008,'0063'),('PK','Pakistan','PKR','PK','586','37.097','23.786722','77.840919','60.878613','Islamabad','Asia','AS','803940.0','ur-PK,en-PK,pa,sd,ps,brh','PAK',1168579,'0092'),('PL','Poland','PLN','PL','616','54.839138','49.006363','24.150749','14.123','Warsaw','Europe','EU','312685.0','pl','POL',798544,'0048'),('PM','Saint Pierre and Miquelon','EUR','SB','666','47.146286','46.786041','-56.252991','-56.420658','Saint-Pierre','North America','NA','242.0','fr-PM','SPM',3424932,'0508'),('PN','Pitcairn Islands','NZD','PC','612','-24.315865','-24.672565','-124.77285','-128.346436','Adamstown','Oceania','OC','47.0','en-PN','PCN',4030699,NULL),('PR','Puerto Rico','USD','RQ','630','18.520166','17.926405','-65.242737','-67.942726','San Juan','North America','NA','9104.0','en-PR,es-PR','PRI',4566966,'1787'),('PS','Palestine','ILS','WE','275','32.54638671875','31.216541290283203','35.5732955932617','34.21665954589844','','Asia','AS','5970.0','ar-PS','PSE',6254930,NULL),('PT','Portugal','EUR','PO','620','42.154311127408','36.96125','-6.18915930748288','-9.50052660716588','Lisbon','Europe','EU','92391.0','pt-PT,mwl','PRT',2264397,'0351'),('PW','Palau','USD','PS','585','8.46966','2.8036','134.72307','131.11788','Melekeok - Palau State Capital','Oceania','OC','458.0','pau,sov,en-PW,tox,ja,fil,zh','PLW',1559582,'0680'),('PY','Paraguay','PYG','PA','600','-19.294041','-27.608738','-54.259354','-62.647076','Asunción','South America','SA','406750.0','es-PY,gn','PRY',3437598,'0595'),('QA','Qatar','QAR','QA','634','26.154722','24.482944','51.636639','50.757221','Doha','Asia','AS','11437.0','ar-QA,es','QAT',289688,'0974'),('RE','Réunion','EUR','RE','638','-20.868391324576944','-21.383747301469107','55.838193901930026','55.21219224792685','Saint-Denis','Africa','AF','2517.0','fr-RE','REU',935317,'0262'),('RO','Romania','RON','RO','642','48.266945','43.627304','29.691055','20.269972','Bucharest','Europe','EU','237500.0','ro,hu,rom','ROU',798549,'0040'),('RS','Serbia','RSD','RI','688','46.18138885498047','42.232215881347656','23.00499725341797','18.817020416259766','Belgrade','Europe','EU','88361.0','sr,hu,bs,rom','SRB',6290252,NULL),('RU','Russia','RUB','RS','643','81.857361','41.188862','-169.05','19.25','Moscow','Europe','EU','1.71E7','ru,tt,xal,cau,ady,kv,ce,tyv,cv,udm,tut,mns,bua,myv,mdf,chm,ba,inh,tut,kbd,krc,ava,sah,nog','RUS',2017370,NULL),('RW','Rwanda','RWF','RW','646','-1.053481','-2.840679','30.895958','28.856794','Kigali','Africa','AF','26338.0','rw,en-RW,fr-RW,sw','RWA',49518,'0250'),('SA','Saudi Arabia','SAR','SA','682','32.158333','15.61425','55.666584','34.495693','Riyadh','Asia','AS','1960582.0','ar-SA','SAU',102358,'0966'),('SB','Solomon Islands','SBD','BP','090','-6.589611','-11.850555','166.980865','155.508606','Honiara','Oceania','OC','28450.0','en-SB,tpi','SLB',2103350,'0677'),('SC','Seychelles','SCR','SE','690','-4.283717','-9.753867','56.29770287937299','46.204769','Victoria','Africa','AF','455.0','en-SC,fr-SC','SYC',241170,'0248'),('SD','Sudan','SDG','SU','729','22.232219696044922','8.684720993041992','38.60749816894531','21.827774047851562','Khartoum','Africa','AF','1861484.0','ar-SD,en,fia','SDN',366755,'0249'),('SE','Sweden','SEK','SW','752','69.0625','55.337112','24.1562924839185','11.118694','Stockholm','Europe','EU','449964.0','sv-SE,se,sma,fi-SE','SWE',2661886,'0046'),('SG','Singapore','SGD','SN','702','1.471278','1.258556','104.007469','103.638275','Singapore','Asia','AS','692.7','cmn,en-SG,ms-SG,ta-SG,zh-SG','SGP',1880251,'0065'),('SH','Saint Helena','SHP','SH','654','-7.887815','-16.019543','-5.638753','-14.42123','Jamestown','Africa','AF','410.0','en-SH','SHN',3370751,'0290'),('SI','Slovenia','EUR','SI','705','46.8766275518195','45.421812998164','16.6106311807','13.3753342064709','Ljubljana','Europe','EU','20273.0','sl,sh','SVN',3190538,'0386'),('SJ','Svalbard and Jan Mayen','NOK','SV','744','80.762085','79.220306','33.287334','17.699389','Longyearbyen','Europe','EU','62049.0','no,ru','SJM',607072,NULL),('SK','Slovakia','EUR','LO','703','49.603168','47.728111','22.570444','16.84775','Bratislava','Europe','EU','48845.0','sk,hu','SVK',3057568,'0421'),('SL','Sierra Leone','SLL','SL','694','10','6.929611','-10.284238','-13.307631','Freetown','Africa','AF','71740.0','en-SL,men,tem','SLE',2403846,'0232'),('SM','San Marino','EUR','SM','674','43.99223730851663','43.8937092171425','12.51653186779788','12.403538978820734','San Marino','Europe','EU','61.2','it-SM','SMR',3168068,'0378'),('SN','Senegal','XOF','SG','686','16.691633','12.307275','-11.355887','-17.535236','Dakar','Africa','AF','196190.0','fr-SN,wo,fuc,mnk','SEN',2245662,'0221'),('SO','Somalia','SOS','SO','706','11.979166','-1.674868','51.412636','40.986595','Mogadishu','Africa','AF','637657.0','so-SO,ar-SO,it,en-SO','SOM',51537,'0252'),('SR','Suriname','SRD','NS','740','6.004546','1.831145','-53.977493','-58.086563','Paramaribo','South America','SA','163270.0','nl-SR,en,srn,hns,jv','SUR',3382998,'0597'),('SS','South Sudan','SSP','OD','728','12.219148635864258','3.493394374847412','35.9405517578125','24.140274047851562','Juba','Africa','AF','644329.0','en','SSD',7909807,NULL),('ST','São Tomé and Príncipe','STD','TP','678','1.701323','0.024766','7.466374','6.47017','São Tomé','Africa','AF','1001.0','pt-ST','STP',2410758,'0239'),('SV','El Salvador','USD','ES','222','14.445067','13.148679','-87.692162','-90.128662','San Salvador','North America','NA','21040.0','es-SV','SLV',3585968,'0503'),('SX','Sint Maarten','ANG','NN','534','18.070248','18.011692','-63.012993','-63.144039','Philipsburg','North America','NA','','nl,en','SXM',7609695,NULL),('SY','Syria','SYP','SY','760','37.319138','32.310665','42.385029','35.727222','Damascus','Asia','AS','185180.0','ar-SY,ku,hy,arc,fr,en','SYR',163843,NULL),('SZ','Swaziland','SZL','WZ','748','-25.719648','-27.317101','32.13726','30.794107','Mbabane','Africa','AF','17363.0','en-SZ,ss-SZ','SWZ',934841,'0268'),('TC','Turks and Caicos Islands','USD','TK','796','21.961878','21.422626','-71.123642','-72.483871','Cockburn Town','North America','NA','430.0','en-TC','TCA',3576916,'1649'),('TD','Chad','XAF','CD','148','23.450369','7.441068','24.002661','13.473475','N\'Djamena','Africa','AF','1284000.0','fr-TD,ar-TD,sre','TCD',2434508,'0235'),('TF','French Southern Territories','EUR','FS','260','-37.790722','-49.735184','77.598808','50.170258','Port-aux-Français','Antarctica','AN','7829.0','fr','ATF',1546748,NULL),('TG','Togo','XOF','TO','768','11.138977','6.104417','1.806693','-0.147324','Lomé','Africa','AF','56785.0','fr-TG,ee,hna,kbp,dag,ha','TGO',2363686,'0228'),('TH','Thailand','THB','TH','764','20.463194','5.61','105.639389','97.345642','Bangkok','Asia','AS','514000.0','th,en','THA',1605651,'0066'),('TJ','Tajikistan','TJS','TI','762','41.042252','36.674137','75.137222','67.387138','Dushanbe','Asia','AS','143100.0','tg,ru','TJK',1220409,'0992'),('TK','Tokelau','NZD','TL','772','-8.553613662719727','-9.381111145019531','-171.21142578125','-172.50033569335938','','Oceania','OC','10.0','tkl,en-TK','TKL',4031074,'0690'),('TL','East Timor','USD','TT','626','-8.135833740234375','-9.463626861572266','127.30859375','124.04609680175781','Dili','Oceania','OC','15007.0','tet,pt-TL,id,en','TLS',1966436,'0670'),('TM','Turkmenistan','TMT','TX','795','42.795555','35.141083','66.684303','52.441444','Ashgabat','Asia','AS','488100.0','tk,ru,uz','TKM',1218197,'0993'),('TN','Tunisia','TND','TS','788','37.543915','30.240417','11.598278','7.524833','Tunis','Africa','AF','163610.0','ar-TN,fr','TUN',2464461,'0216'),('TO','Tonga','TOP','TN','776','-15.562988','-21.455057','-173.907578','-175.682266','Nuku\'alofa','Oceania','OC','748.0','to,en-TO','TON',4032283,'0676'),('TR','Turkey','TRY','TU','792','42.107613','35.815418','44.834999','25.668501','Ankara','Asia','AS','780580.0','tr-TR,ku,diq,az,av','TUR',298795,'0090'),('TT','Trinidad and Tobago','TTD','TD','780','11.338342','10.036105','-60.517933','-61.923771','Port of Spain','North America','NA','5128.0','en-TT,hns,fr,es,zh','TTO',3573591,'1868'),('TV','Tuvalu','AUD','TV','798','-5.641972','-10.801169','179.863281','176.064865','Funafuti','Oceania','OC','26.0','tvl,en,sm,gil','TUV',2110297,'0688'),('TW','Taiwan','TWD','TW','158','25.3002899036181','21.896606934717','122.006739823315','119.534691','Taipei','Asia','AS','35980.0','zh-TW,zh,nan,hak','TWN',1668284,NULL),('TZ','Tanzania','TZS','TZ','834','-0.990736','-11.745696','40.443222','29.327168','Dodoma','Africa','AF','945087.0','sw-TZ,en,ar','TZA',149590,NULL),('UA','Ukraine','UAH','UP','804','52.369362','44.390415','40.20739','22.128889','Kyiv','Europe','EU','603700.0','uk,ru-UA,rom,pl,hu','UKR',690791,'0380'),('UG','Uganda','UGX','UG','800','4.214427','-1.48405','35.036049','29.573252','Kampala','Africa','AF','236040.0','en-UG,lg,sw,ar','UGA',226074,'0256'),('UM','U.S. Minor Outlying Islands','USD','','581','28.219814','-0.389006','166.654526','-177.392029','','Oceania','OC','0.0','en-UM','UMI',5854968,NULL),('US','United States','USD','US','840','49.388611','24.544245','-66.954811','-124.733253','Washington','North America','NA','9629091.0','en-US,es-US,haw,fr','USA',6252001,'0001'),('UY','Uruguay','UYU','UY','858','-30.082224','-34.980816','-53.073933','-58.442722','Montevideo','South America','SA','176220.0','es-UY','URY',3439705,'0598'),('UZ','Uzbekistan','UZS','UZ','860','45.575001','37.184444','73.132278','55.996639','Tashkent','Asia','AS','447400.0','uz,ru,tg','UZB',1512440,'0998'),('VA','Vatican City','EUR','VT','336','41.90743830885576','41.90027960306854','12.45837546629481','12.44570678169205','Vatican','Europe','EU','0.44','la,it,fr','VAT',3164670,NULL),('VC','Saint Vincent and the Grenadines','XCD','VC','670','13.377834','12.583984810969037','-61.11388','-61.46090317727658','Kingstown','North America','NA','389.0','en-VC,fr','VCT',3577815,'1784'),('VE','Venezuela','VEF','VE','862','12.201903','0.626311','-59.80378','-73.354073','Caracas','South America','SA','912050.0','es-VE','VEN',3625428,'0058'),('VG','British Virgin Islands','USD','VI','092','18.757221','18.383710898211305','-64.268768','-64.71312752730364','Road Town','North America','NA','153.0','en-VG','VGB',3577718,NULL),('VI','U.S. Virgin Islands','USD','VQ','850','18.415382','17.673931','-64.565193','-65.101333','Charlotte Amalie','North America','NA','352.0','en-VI','VIR',4796775,NULL),('VN','Vietnam','VND','VM','704','23.388834','8.559611','109.464638','102.148224','Hanoi','Asia','AS','329560.0','vi,en,fr,zh,km','VNM',1562822,NULL),('VU','Vanuatu','VUV','NH','548','-13.073444','-20.248945','169.904785','166.524979','Port Vila','Oceania','OC','12200.0','bi,en-VU,fr-VU','VUT',2134431,'0678'),('WF','Wallis and Futuna','XPF','WF','876','-13.216758181061444','-14.314559989820843','-176.16174317718253','-178.1848112896414','Mata-Utu','Oceania','OC','274.0','wls,fud,fr-WF','WLF',4034749,'0681'),('WS','Samoa','WST','WS','882','-13.432207','-14.040939','-171.415741','-172.798599','Apia','Oceania','OC','2944.0','sm,en-WS','WSM',4034894,'0685'),('XK','Kosovo','EUR','KV','0','43.2682495807952','41.856369601859925','21.80335088694943','19.977481504492914','Pristina','Europe','EU','','sq,sr','XKX',831053,NULL),('YE','Yemen','YER','YM','887','18.9999989031009','12.1110910264462','54.5305388163283','42.5325394314234','Sanaa','Asia','AS','527970.0','ar-YE','YEM',69543,'0967'),('YT','Mayotte','EUR','MF','175','-12.648891','-13.000132','45.29295','45.03796','Mamoutzou','Africa','AF','374.0','fr-YT','MYT',1024031,'0262'),('ZA','South Africa','ZAR','SF','710','-22.126612','-34.839828','32.895973','16.458021','Pretoria','Africa','AF','1219912.0','zu,xh,af,nso,en-ZA,tn,st,ts,ss,ve,nr','ZAF',953987,'0027'),('ZM','Zambia','ZMW','ZA','894','-8.22436','-18.079473','33.705704','21.999371','Lusaka','Africa','AF','752614.0','en-ZM,bem,loz,lun,lue,ny,toi','ZMB',895949,'0260'),('ZW','Zimbabwe','ZWL','ZI','716','-15.608835','-22.417738','33.056305','25.237028','Harare','Africa','AF','390580.0','en-ZW,sn,nr,nd','ZWE',878675,'0263');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencyd`
--

DROP TABLE IF EXISTS `currencyd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencyd` (
  `currencydID` int(11) NOT NULL AUTO_INCREMENT,
  `currencyID` tinyint(4) NOT NULL,
  `moneya` varchar(45) NOT NULL,
  `cur` varchar(45) NOT NULL,
  `dateAdd` date NOT NULL,
  PRIMARY KEY (`currencydID`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencyd`
--

LOCK TABLES `currencyd` WRITE;
/*!40000 ALTER TABLE `currencyd` DISABLE KEYS */;
INSERT INTO `currencyd` VALUES (1,1,'USD','2.0379','2013-08-30'),(2,3,'CAD','1.9474','2013-08-30'),(3,4,'DKK','0.36306','2013-08-30'),(4,5,'SEK','0.31228','2013-08-30'),(5,6,'CHF','2.2005','2013-08-30'),(6,7,'NOK','0.33666','2013-08-30'),(7,8,'SAR','0.54661','2013-08-30'),(8,9,'KWD','7.2887','2013-08-30'),(9,10,'AUD','1.8338','2013-08-30'),(10,2,'EUR','2.7018','2013-08-30'),(11,11,'GBP','3.1658','2013-08-30'),(12,1,'USD','2.04440029','2013-08-31'),(13,3,'CAD','1.94131549','2013-08-31'),(14,4,'DKK','0.361987648','2013-08-31'),(15,5,'SEK','0.308369161','2013-08-31'),(16,6,'CHF','2.19639122','2013-08-31'),(17,7,'NOK','0.333987541','2013-08-31'),(18,8,'SAR','0.545100492','2013-08-31'),(19,9,'KWD','7.16127252','2013-08-31'),(20,10,'AUD','1.81951625','2013-08-31'),(21,2,'EUR','2.7002439','2013-08-31'),(22,11,'GBP','3.16779824','2013-08-31'),(23,0,'TRY','1','2013-08-31'),(24,0,'TRY','1','2013-09-03'),(25,1,'USD','2.01990006','2013-09-03'),(26,2,'EUR','2.66505613','2013-09-03'),(27,3,'CAD','1.91695989','2013-09-03'),(28,4,'DKK','0.357251643','2013-09-03'),(29,5,'SEK','0.305905784','2013-09-03'),(30,6,'CHF','2.16147687','2013-09-03'),(31,7,'NOK','0.332073589','2013-09-03'),(32,8,'SAR','0.538567972','2013-09-03'),(33,9,'KWD','7.06926237','2013-09-03'),(34,10,'AUD','1.81407224','2013-09-03'),(35,11,'GBP','3.13912668','2013-09-03'),(36,0,'TRY','1','2013-09-07'),(37,1,'USD','2.04599813','2013-09-07'),(38,2,'EUR','2.69683014','2013-09-07'),(39,3,'CAD','1.96749523','2013-09-07'),(40,4,'DKK','0.36157902','2013-09-07'),(41,5,'SEK','0.308565162','2013-09-07'),(42,6,'CHF','2.18169896','2013-09-07'),(43,7,'NOK','0.336799936','2013-09-07'),(44,8,'SAR','0.545512205','2013-09-07'),(45,9,'KWD','7.16085023','2013-09-07'),(46,10,'AUD','1.88027228','2013-09-07'),(47,11,'GBP','3.19871348','2013-09-07'),(48,1,'USD','2.04294','2013-11-12'),(49,3,'CAD','1.95034','2013-11-12'),(50,4,'DKK','0.367217','2013-11-12'),(51,5,'SEK','0.311147','2013-11-12'),(52,6,'CHF','2.2222','2013-11-12'),(53,7,'NOK','0.332185','2013-11-12'),(54,8,'SAR','0.544711','2013-11-12'),(55,9,'KWD','7.19142','2013-11-12'),(56,10,'AUD','1.91221','2013-11-12'),(57,2,'EUR','2.73861','2013-11-12'),(58,11,'GBP','3.26585','2013-11-12'),(59,0,'TRY','1','2013-11-12'),(60,0,'TRY','1.00','2014-02-05'),(61,1,'USD','2.2383','2014-02-05'),(62,2,'EUR','3.0301','2014-02-05'),(63,3,'CAD','2.0201','2014-02-05'),(64,4,'DKK','0.4061','2014-02-05'),(65,5,'SEK','0.3431','2014-02-05'),(66,6,'CHF','2.4778','2014-02-05'),(67,7,'NOK','0.3593','2014-02-05'),(68,8,'SAR','0.5969','2014-02-05'),(69,9,'KWD','7.9134','2014-02-05'),(70,10,'AUD','1.9951','2014-02-05'),(71,11,'GBP','3.6511','2014-02-05'),(72,0,'TRY','1.00','2014-03-04'),(73,1,'USD','2.232','2014-03-04'),(74,2,'EUR','3.0653','2014-03-04'),(75,3,'CAD','2.0149','2014-03-04'),(76,4,'DKK','0.4107','2014-03-04'),(77,5,'SEK','0.3447','2014-03-04'),(78,6,'CHF','2.5271','2014-03-04'),(79,7,'NOK','0.369','2014-03-04'),(80,8,'SAR','0.5951','2014-03-04'),(81,9,'KWD','7.9283','2014-03-04'),(82,10,'AUD','1.9945','2014-03-04'),(83,11,'GBP','3.7193','2014-03-04');
/*!40000 ALTER TABLE `currencyd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencymoney`
--

DROP TABLE IF EXISTS `currencymoney`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencymoney` (
  `currencymoneyID` int(11) NOT NULL,
  `currencyID` tinyint(4) NOT NULL,
  `moneya` varchar(45) NOT NULL,
  `cur` varchar(45) NOT NULL,
  PRIMARY KEY (`currencymoneyID`),
  KEY `index` (`currencyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencymoney`
--

LOCK TABLES `currencymoney` WRITE;
/*!40000 ALTER TABLE `currencymoney` DISABLE KEYS */;
INSERT INTO `currencymoney` VALUES (1,0,'TRY','1.00'),(2,1,'USD','2.232'),(3,2,'EUR','3.0653'),(4,3,'CAD','2.0149'),(5,4,'DKK','0.4107'),(6,5,'SEK','0.3447'),(7,6,'CHF','2.5271'),(8,7,'NOK','0.369'),(9,8,'SAR','0.5951'),(10,9,'KWD','7.9283'),(11,10,'AUD','1.9945'),(12,11,'GBP','3.7193');
/*!40000 ALTER TABLE `currencymoney` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customergroups`
--

DROP TABLE IF EXISTS `customergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customergroups` (
  `customerGroupsID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `companyID` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `worldID` int(11) NOT NULL,
  PRIMARY KEY (`customerGroupsID`),
  KEY `index1` (`worldID`,`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customergroups`
--

LOCK TABLES `customergroups` WRITE;
/*!40000 ALTER TABLE `customergroups` DISABLE KEYS */;
INSERT INTO `customergroups` VALUES (1,'Bilgisayar',14,1,1);
/*!40000 ALTER TABLE `customergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(75) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `cphone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `country` varchar(5) NOT NULL,
  `city` int(11) NOT NULL,
  `county` varchar(75) DEFAULT NULL,
  `adress` mediumtext NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `opportunity` tinyint(1) NOT NULL,
  `addEmployeesID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `cgID` int(11) NOT NULL,
  `taxno` varchar(45) DEFAULT NULL,
  `taxnotype` tinyint(1) DEFAULT NULL,
  `taxoffice` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`customerID`),
  KEY `index1` (`worldID`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dealers`
--

DROP TABLE IF EXISTS `dealers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dealers` (
  `dealersID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `cphone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `adres` mediumtext NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` varchar(45) NOT NULL,
  `country` varchar(5) NOT NULL,
  `city` int(11) NOT NULL,
  `county` varchar(45) DEFAULT NULL,
  `addEmployeesID` int(11) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `taxno` varchar(45) DEFAULT NULL,
  `taxnotype` tinyint(1) DEFAULT NULL,
  `taxoffice` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dealersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dealers`
--

LOCK TABLES `dealers` WRITE;
/*!40000 ALTER TABLE `dealers` DISABLE KEYS */;
/*!40000 ALTER TABLE `dealers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `employeesID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `erights` tinyint(1) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL,
  `companyID` int(11) NOT NULL,
  `avatar` varchar(45) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `admins` int(11) NOT NULL,
  PRIMARY KEY (`employeesID`),
  KEY `index1` (`companyID`,`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (11,'Samed Ceylan',1,'imadige@gmail.com','6f923ffee96d9e8cfa1a7346aef39e7c','Bilgisayar Yazılım Uzmanı',14,'y7a1k2t9e1i5.jpg',1,'2013-04-23 23:22:56',0,1),(17,'Rohat Honak',3,'delete10@gmail.com','0dedc20a4f2c4f56ea7ac6b5d38b0250','Satış',14,NULL,1,'2014-02-05 22:52:24',1,0);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeesmailstatus`
--

DROP TABLE IF EXISTS `employeesmailstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employeesmailstatus` (
  `employeesmailstatusID` int(11) NOT NULL AUTO_INCREMENT,
  `employeesID` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`employeesmailstatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeesmailstatus`
--

LOCK TABLES `employeesmailstatus` WRITE;
/*!40000 ALTER TABLE `employeesmailstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeesmailstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeesstatus`
--

DROP TABLE IF EXISTS `employeesstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employeesstatus` (
  `employeesstatusID` int(11) NOT NULL AUTO_INCREMENT,
  `employeesID` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `dateAdd` datetime NOT NULL,
  PRIMARY KEY (`employeesstatusID`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeesstatus`
--

LOCK TABLES `employeesstatus` WRITE;
/*!40000 ALTER TABLE `employeesstatus` DISABLE KEYS */;
INSERT INTO `employeesstatus` VALUES (1,11,'127.0.0.1','2013-11-10 12:10:53'),(2,11,'127.0.0.1','2013-11-11 23:38:03'),(3,11,'127.0.0.1','2013-11-12 19:43:24'),(4,11,'127.0.0.1','2013-11-14 22:12:12'),(5,11,'127.0.0.1','2013-11-16 23:10:31'),(6,11,'127.0.0.1','2013-11-18 00:03:51'),(7,11,'127.0.0.1','2013-11-19 20:48:35'),(8,11,'127.0.0.1','2013-11-21 21:03:23'),(9,11,'127.0.0.1','2013-11-26 20:17:18'),(10,11,'127.0.0.1','2013-11-28 21:09:04'),(11,11,'127.0.0.1','2013-11-29 00:50:45'),(12,11,'127.0.0.1','2013-11-30 17:26:14'),(13,11,'127.0.0.1','2013-12-01 20:33:44'),(14,11,'127.0.0.1','2014-01-07 19:24:48'),(15,11,'127.0.0.1','2014-01-09 19:03:56'),(16,11,'127.0.0.1','2014-01-11 17:37:55'),(17,11,'127.0.0.1','2014-01-12 22:57:47'),(18,11,'127.0.0.1','2014-01-12 23:24:18'),(19,11,'127.0.0.1','2014-01-13 18:50:36'),(20,11,'127.0.0.1','2014-01-13 20:17:05'),(21,11,'127.0.0.1','2014-02-01 14:04:20'),(22,11,'127.0.0.1','2014-02-01 15:04:00'),(23,11,'127.0.0.1','2014-02-01 19:41:20'),(24,11,'127.0.0.1','2014-02-03 05:47:27'),(25,11,'127.0.0.1','2014-02-04 21:42:28'),(26,11,'127.0.0.1','2014-02-04 23:15:51'),(27,11,'127.0.0.1','2014-02-04 23:23:59'),(28,11,'127.0.0.1','2014-02-05 20:35:22'),(29,11,'127.0.0.1','2014-02-05 20:50:47'),(30,11,'127.0.0.1','2014-02-05 21:38:44'),(31,11,'127.0.0.1','2014-02-05 22:33:41'),(32,11,'127.0.0.1','2014-02-06 19:32:36'),(33,11,'127.0.0.1','2014-02-07 19:24:34'),(34,11,'127.0.0.1','2014-02-08 00:44:08'),(35,11,'127.0.0.1','2014-02-09 10:31:16'),(36,11,'127.0.0.1','2014-02-11 19:40:18'),(37,11,'127.0.0.1','2014-02-13 19:25:53'),(38,11,'127.0.0.1','2014-02-14 21:39:51'),(39,11,'127.0.0.1','2014-02-15 11:03:14'),(40,11,'127.0.0.1','2014-02-15 19:24:36'),(41,11,'127.0.0.1','2014-02-16 11:14:58'),(42,11,'127.0.0.1','2014-02-16 11:21:01'),(43,11,'127.0.0.1','2014-02-16 19:46:04'),(44,11,'127.0.0.1','2014-02-16 21:33:18'),(45,11,'127.0.0.1','2014-02-19 00:02:28'),(46,11,'127.0.0.1','2014-03-01 12:47:33'),(47,11,'127.0.0.1','2014-03-01 14:18:39'),(48,11,'127.0.0.1','2014-03-02 20:59:53'),(49,11,'127.0.0.1','2014-03-03 21:57:11'),(50,11,'127.0.0.1','2014-03-10 18:31:39'),(51,11,'127.0.0.1','2014-03-10 20:18:40'),(52,11,'127.0.0.1','2014-03-11 18:05:20'),(53,11,'127.0.0.1','2014-03-11 18:43:21'),(54,11,'127.0.0.1','2014-04-10 19:30:46'),(55,11,'127.0.0.1','2014-12-23 08:19:11'),(56,11,'127.0.0.1','2014-12-27 03:07:04'),(57,11,'88.243.182.47','2016-09-04 17:36:49'),(58,11,'::1','2016-09-04 17:47:19'),(59,11,'88.243.182.47','2016-09-04 18:21:03');
/*!40000 ALTER TABLE `employeesstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeesworld`
--

DROP TABLE IF EXISTS `employeesworld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employeesworld` (
  `employeesworldID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  PRIMARY KEY (`employeesworldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeesworld`
--

LOCK TABLES `employeesworld` WRITE;
/*!40000 ALTER TABLE `employeesworld` DISABLE KEYS */;
INSERT INTO `employeesworld` VALUES (1,1,11,14);
/*!40000 ALTER TABLE `employeesworld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mailserver`
--

DROP TABLE IF EXISTS `mailserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mailserver` (
  `idmailserver` int(11) NOT NULL,
  `mailserver` varchar(100) DEFAULT NULL,
  `mailuser` varchar(100) DEFAULT NULL,
  `mailparola` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idmailserver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mailserver`
--

LOCK TABLES `mailserver` WRITE;
/*!40000 ALTER TABLE `mailserver` DISABLE KEYS */;
INSERT INTO `mailserver` VALUES (1,'127.0.0.1','noreply@sahayonetimi.com','aWqdje4235scsdfwq3432'),(2,'127.0.0.1','noreply@managerfield.com','aWqdje4235scsdfwq3432');
/*!40000 ALTER TABLE `mailserver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `messagesID` tinyint(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `employeesID` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `companyID` int(11) NOT NULL,
  `updateDate` datetime NOT NULL,
  PRIMARY KEY (`messagesID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (5,'adas',11,'2014-03-03 22:16:23',14,'2014-03-03 22:46:10');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesanswer`
--

DROP TABLE IF EXISTS `messagesanswer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesanswer` (
  `messagesanswerID` int(11) NOT NULL AUTO_INCREMENT,
  `messagesID` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `text` text NOT NULL,
  `employeesID` int(11) NOT NULL,
  PRIMARY KEY (`messagesanswerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesanswer`
--

LOCK TABLES `messagesanswer` WRITE;
/*!40000 ALTER TABLE `messagesanswer` DISABLE KEYS */;
INSERT INTO `messagesanswer` VALUES (1,1,'2014-03-02 21:18:53','asdsa',11),(2,1,'2014-03-02 21:18:56','asd',11),(3,1,'2014-03-02 21:32:07','Model Generator\r\n\r\nThis generator generates a model class for the specified database table.\r\n\r\nFields with * are required. Click on the highlighted fields to edit them.\r\nDatabase Connection *	\r\n',11),(4,1,'2014-03-02 21:57:47','asdasd',11),(5,5,'2014-03-03 22:46:10','sd',11);
/*!40000 ALTER TABLE `messagesanswer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesread`
--

DROP TABLE IF EXISTS `messagesread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesread` (
  `messagesreadID` int(11) NOT NULL AUTO_INCREMENT,
  `messagesID` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `readd` tinyint(1) NOT NULL,
  PRIMARY KEY (`messagesreadID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesread`
--

LOCK TABLES `messagesread` WRITE;
/*!40000 ALTER TABLE `messagesread` DISABLE KEYS */;
INSERT INTO `messagesread` VALUES (9,5,11,1);
/*!40000 ALTER TABLE `messagesread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesusers`
--

DROP TABLE IF EXISTS `messagesusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesusers` (
  `messagesusersID` int(11) NOT NULL AUTO_INCREMENT,
  `messagesID` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  PRIMARY KEY (`messagesusersID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesusers`
--

LOCK TABLES `messagesusers` WRITE;
/*!40000 ALTER TABLE `messagesusers` DISABLE KEYS */;
INSERT INTO `messagesusers` VALUES (1,5,11);
/*!40000 ALTER TABLE `messagesusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentnotifications`
--

DROP TABLE IF EXISTS `paymentnotifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentnotifications` (
  `paymentnotificationsID` int(11) NOT NULL AUTO_INCREMENT,
  `text` mediumtext NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `customerdealerID` int(11) NOT NULL,
  `cdtype` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `customerdealerName` varchar(100) NOT NULL,
  `paymentStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`paymentnotificationsID`),
  KEY `index1` (`worldID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentnotifications`
--

LOCK TABLES `paymentnotifications` WRITE;
/*!40000 ALTER TABLE `paymentnotifications` DISABLE KEYS */;
INSERT INTO `paymentnotifications` VALUES (1,'Garanti bankası hesabına 1000 TL ödeme yapıldı',1,14,11,8,1,'2013-07-25 23:58:28','Saray Elektronik ve Bilgisayar',0);
/*!40000 ALTER TABLE `paymentnotifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problematicproducts`
--

DROP TABLE IF EXISTS `problematicproducts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problematicproducts` (
  `problematicproductsID` int(11) NOT NULL AUTO_INCREMENT,
  `productsID` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `problematicStatus` int(11) NOT NULL,
  `customerdealerID` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `employeesText` mediumtext,
  `cdtype` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  PRIMARY KEY (`problematicproductsID`),
  KEY `index1` (`productsID`,`companyID`),
  KEY `index2` (`companyID`,`productsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problematicproducts`
--

LOCK TABLES `problematicproducts` WRITE;
/*!40000 ALTER TABLE `problematicproducts` DISABLE KEYS */;
/*!40000 ALTER TABLE `problematicproducts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productbasket`
--

DROP TABLE IF EXISTS `productbasket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productbasket` (
  `productbasketID` int(11) NOT NULL AUTO_INCREMENT,
  `productsID` int(11) NOT NULL,
  `productbottomsID` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `salesPrice` double NOT NULL,
  `salesCur` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `unitPrice` double NOT NULL,
  `unitCur` tinyint(1) NOT NULL,
  `purchasePrice` double NOT NULL,
  `purchaseCur` tinyint(1) NOT NULL,
  PRIMARY KEY (`productbasketID`),
  KEY `index` (`worldID`,`employeesID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productbasket`
--

LOCK TABLES `productbasket` WRITE;
/*!40000 ALTER TABLE `productbasket` DISABLE KEYS */;
/*!40000 ALTER TABLE `productbasket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productbottoms`
--

DROP TABLE IF EXISTS `productbottoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productbottoms` (
  `productbottomsID` int(11) NOT NULL AUTO_INCREMENT,
  `productsID` int(11) NOT NULL,
  `bottomvalue1` varchar(45) DEFAULT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `bottomvalue2` varchar(45) DEFAULT NULL,
  `bottomvalue3` varchar(45) DEFAULT NULL,
  `bottomvalue4` varchar(45) DEFAULT NULL,
  `bottomvalue5` varchar(45) DEFAULT NULL,
  `bottomvalue6` varchar(45) DEFAULT NULL,
  `bottomvalue7` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`productbottomsID`),
  KEY `index1` (`productsID`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productbottoms`
--

LOCK TABLES `productbottoms` WRITE;
/*!40000 ALTER TABLE `productbottoms` DISABLE KEYS */;
INSERT INTO `productbottoms` VALUES (95,42,'1',1,14,'','','','','',''),(96,42,'3',1,14,'','','','','','');
/*!40000 ALTER TABLE `productbottoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productdetail`
--

DROP TABLE IF EXISTS `productdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productdetail` (
  `productdetailID` int(11) NOT NULL AUTO_INCREMENT,
  `productsID` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `purchasePrice` double NOT NULL,
  `purchaseCur` tinyint(1) NOT NULL,
  `salePrice` double NOT NULL,
  `saleCur` tinyint(1) NOT NULL,
  `reducedPrice` double DEFAULT NULL,
  `reduceCur` tinyint(1) DEFAULT NULL,
  `dealerPrice` double DEFAULT NULL,
  `dealerCur` tinyint(1) DEFAULT NULL,
  `dateAdd` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  PRIMARY KEY (`productdetailID`),
  KEY `index1` (`worldID`,`productsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productdetail`
--

LOCK TABLES `productdetail` WRITE;
/*!40000 ALTER TABLE `productdetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `productdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productgroups`
--

DROP TABLE IF EXISTS `productgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productgroups` (
  `productgroupsID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `tax` double NOT NULL,
  `worldID` int(11) NOT NULL,
  `pgID` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `companyID` int(11) DEFAULT NULL,
  PRIMARY KEY (`productgroupsID`),
  KEY `index` (`worldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productgroups`
--

LOCK TABLES `productgroups` WRITE;
/*!40000 ALTER TABLE `productgroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `productgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productimages`
--

DROP TABLE IF EXISTS `productimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productimages` (
  `productimagesID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `images` varchar(45) NOT NULL,
  `mainimages` tinyint(1) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  PRIMARY KEY (`productimagesID`),
  KEY `index1` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productimages`
--

LOCK TABLES `productimages` WRITE;
/*!40000 ALTER TABLE `productimages` DISABLE KEYS */;
/*!40000 ALTER TABLE `productimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `productsID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `productgroupsID` int(11) NOT NULL,
  PRIMARY KEY (`productsID`),
  KEY `index1` (`productgroupsID`),
  FULLTEXT KEY `index2` (`name`),
  FULLTEXT KEY `index3` (`brand`),
  FULLTEXT KEY `index4` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salescargo`
--

DROP TABLE IF EXISTS `salescargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salescargo` (
  `salescargoID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `payment` tinyint(1) DEFAULT NULL,
  `follownumber` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `charge` double DEFAULT NULL,
  `chargeCur` tinyint(1) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `salescompleteID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  PRIMARY KEY (`salescargoID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salescargo`
--

LOCK TABLES `salescargo` WRITE;
/*!40000 ALTER TABLE `salescargo` DISABLE KEYS */;
INSERT INTO `salescargo` VALUES (34,'ARAS',0,'1231234532',1,'2014-02-13 21:11:56',NULL,0,1,39,14,1),(35,'Aras',0,NULL,1,'2014-02-13 21:23:00',NULL,0,1,38,14,1),(36,'yurt içi',0,'10123123542',1,'2014-12-27 05:09:51',NULL,0,1,45,14,1);
/*!40000 ALTER TABLE `salescargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salescompletecustomer`
--

DROP TABLE IF EXISTS `salescompletecustomer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salescompletecustomer` (
  `salescompleteID` int(11) NOT NULL AUTO_INCREMENT,
  `customerdealerID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `cdtype` tinyint(1) NOT NULL,
  `salesStatus` tinyint(1) NOT NULL,
  `salesEs` tinyint(1) NOT NULL,
  `salesEsDate` datetime NOT NULL,
  `dateAdd` datetime NOT NULL,
  `visitsID` int(11) DEFAULT NULL,
  PRIMARY KEY (`salescompleteID`),
  KEY `index1` (`worldID`),
  KEY `index2` (`customerdealerID`),
  KEY `index3` (`employeesID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salescompletecustomer`
--

LOCK TABLES `salescompletecustomer` WRITE;
/*!40000 ALTER TABLE `salescompletecustomer` DISABLE KEYS */;
/*!40000 ALTER TABLE `salescompletecustomer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesdetail`
--

DROP TABLE IF EXISTS `salesdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesdetail` (
  `salesdetailID` int(11) NOT NULL AUTO_INCREMENT,
  `productsID` int(11) NOT NULL,
  `productbottomsID` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `salesPrice` double NOT NULL,
  `salesCur` tinyint(1) NOT NULL,
  `salescompleteID` int(11) NOT NULL,
  `unitPrice` double NOT NULL,
  `unitCur` tinyint(1) NOT NULL,
  `purchasePrice` double NOT NULL,
  `purchaseCur` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`salesdetailID`),
  KEY `index1` (`productsID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesdetail`
--

LOCK TABLES `salesdetail` WRITE;
/*!40000 ALTER TABLE `salesdetail` DISABLE KEYS */;
INSERT INTO `salesdetail` VALUES (53,42,95,1,81.42,1,45,81.42,1,35.4,1,1);
/*!40000 ALTER TABLE `salesdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesmoneyreceived`
--

DROP TABLE IF EXISTS `salesmoneyreceived`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesmoneyreceived` (
  `salesmoneyreceivedID` int(11) NOT NULL AUTO_INCREMENT,
  `salescompleteID` int(11) NOT NULL,
  `receivedPrice` double NOT NULL,
  `receivedCur` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `unpayment` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `deletedDateAdd` datetime DEFAULT NULL,
  `deletedEmployeesID` int(11) DEFAULT NULL,
  PRIMARY KEY (`salesmoneyreceivedID`),
  KEY `index1` (`salescompleteID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesmoneyreceived`
--

LOCK TABLES `salesmoneyreceived` WRITE;
/*!40000 ALTER TABLE `salesmoneyreceived` DISABLE KEYS */;
INSERT INTO `salesmoneyreceived` VALUES (2,45,10,1,'2014-12-27 04:03:51',0,0,'2014-12-27 04:04:17',11);
/*!40000 ALTER TABLE `salesmoneyreceived` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesreturn`
--

DROP TABLE IF EXISTS `salesreturn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesreturn` (
  `salesreturnID` int(11) NOT NULL AUTO_INCREMENT,
  `salesdetailID` int(11) NOT NULL,
  `productsID` int(11) NOT NULL,
  `salescompleteID` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `salesreturnPrice` double NOT NULL,
  `salesreturnCur` tinyint(1) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `dateAdd` datetime NOT NULL,
  `productbottomsID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `deletedDateAdd` datetime DEFAULT NULL,
  `deletedEmployeesID` int(11) DEFAULT NULL,
  PRIMARY KEY (`salesreturnID`),
  KEY `index1` (`salescompleteID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesreturn`
--

LOCK TABLES `salesreturn` WRITE;
/*!40000 ALTER TABLE `salesreturn` DISABLE KEYS */;
INSERT INTO `salesreturn` VALUES (9,50,42,39,1,81.42,1,11,'aa','2014-02-14 00:00:00',95,1,14,1,NULL,NULL);
/*!40000 ALTER TABLE `salesreturn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `ticketID` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `images1` varchar(45) DEFAULT NULL,
  `images2` varchar(45) DEFAULT NULL,
  `images3` varchar(45) DEFAULT NULL,
  `images4` varchar(45) DEFAULT NULL,
  `language` tinyint(1) NOT NULL,
  `cevap` tinyint(1) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `updateDate` int(11) NOT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (16,'Kredi alırken;\r\n        TAM DESTEK danışma hattımız 444 0 335 ile ihtiyacınıza uygun çözümler\r\n\r\n        Avantajlı kampanyalar\r\n    Kredi aldıktan sonra;\r\n        Ek Kredi  ile ilave kredi ihtiyacı söz konusu olursa taksitlerinizi arttırmadan kredi tutarını arttırabilme\r\n        Ödemelerde zorlanacağını düşünenlere Taksit Küçültme\r\n    Krediniz biterken;\r\n        Gelir belgesiz indirimli hazır kredi\r\n    Garanti\'deki hesabınızda para tutuyorsanız;\r\n        Hesabınızın getirisi ile kredinizi ödeyen Hesaplı Kredi','g1v2e5s1l2u2.jpg','n5e5t6z8i7p3l2.jpg','a8p3v4k9x2.jpg','i3w5g4b4v8.jpg',1,0,11,14,4,'2014-02-16 14:51:07',2014),(17,'<script>alert(2)</script><span>deneme</span>deneme',NULL,NULL,NULL,NULL,1,0,11,14,0,'2014-12-27 04:50:46',2014);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticketanswer`
--

DROP TABLE IF EXISTS `ticketanswer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticketanswer` (
  `ticketanswerID` int(11) NOT NULL AUTO_INCREMENT,
  `ticketID` int(11) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `text` text NOT NULL,
  `images1` varchar(45) DEFAULT NULL,
  `images2` varchar(45) DEFAULT NULL,
  `images3` varchar(45) DEFAULT NULL,
  `images4` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ticketanswerID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticketanswer`
--

LOCK TABLES `ticketanswer` WRITE;
/*!40000 ALTER TABLE `ticketanswer` DISABLE KEYS */;
INSERT INTO `ticketanswer` VALUES (1,16,11,'2014-02-16 15:33:10','test mesajı',NULL,NULL,NULL,NULL),(4,16,11,'2014-02-16 15:34:49','çok güzel oldu',NULL,NULL,NULL,NULL),(5,16,11,'2014-02-16 19:56:56','deneme','q1y5r5b3l9.jpg',NULL,NULL,NULL),(6,16,11,'2014-03-01 14:48:23','sas',NULL,NULL,NULL,NULL),(7,16,11,'2014-03-01 14:48:52','sas',NULL,NULL,NULL,NULL),(8,1,11,'2014-03-02 21:17:25','ses1',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ticketanswer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visits` (
  `visitsID` int(11) NOT NULL AUTO_INCREMENT,
  `visitDate` datetime NOT NULL,
  `appointmentsID` int(11) DEFAULT NULL,
  `visitType` tinyint(1) NOT NULL,
  `explanation` mediumtext,
  `status` tinyint(1) NOT NULL,
  `customerdealerID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `employeesID` int(11) NOT NULL,
  `cdtype` tinyint(1) NOT NULL,
  PRIMARY KEY (`visitsID`),
  KEY `index1` (`worldID`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visits`
--

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse` (
  `warehouseID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`warehouseID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse`
--

LOCK TABLES `warehouse` WRITE;
/*!40000 ALTER TABLE `warehouse` DISABLE KEYS */;
INSERT INTO `warehouse` VALUES (1,'İstanbul',14,1,1),(2,'Ankara',14,1,1);
/*!40000 ALTER TABLE `warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouseadjustment`
--

DROP TABLE IF EXISTS `warehouseadjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouseadjustment` (
  `warehouseadjustmentID` int(11) NOT NULL AUTO_INCREMENT,
  `salesdetailID` int(11) NOT NULL,
  `warehouseID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `salescompleteID` int(11) NOT NULL,
  PRIMARY KEY (`warehouseadjustmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouseadjustment`
--

LOCK TABLES `warehouseadjustment` WRITE;
/*!40000 ALTER TABLE `warehouseadjustment` DISABLE KEYS */;
INSERT INTO `warehouseadjustment` VALUES (18,51,1,14,1,1,39),(19,50,1,14,1,1,38),(20,53,1,14,1,1,45);
/*!40000 ALTER TABLE `warehouseadjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehousebottomstok`
--

DROP TABLE IF EXISTS `warehousebottomstok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehousebottomstok` (
  `warehousebottomstokID` int(11) NOT NULL AUTO_INCREMENT,
  `warehouseID` int(11) NOT NULL,
  `productbottomsID` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `productsID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  PRIMARY KEY (`warehousebottomstokID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehousebottomstok`
--

LOCK TABLES `warehousebottomstok` WRITE;
/*!40000 ALTER TABLE `warehousebottomstok` DISABLE KEYS */;
INSERT INTO `warehousebottomstok` VALUES (52,1,95,10,42,14,1),(53,2,96,10,42,14,1);
/*!40000 ALTER TABLE `warehousebottomstok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `world`
--

DROP TABLE IF EXISTS `world`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `world` (
  `worldID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `companyID` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`worldID`),
  KEY `index1` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `world`
--

LOCK TABLES `world` WRITE;
/*!40000 ALTER TABLE `world` DISABLE KEYS */;
INSERT INTO `world` VALUES (1,'Modargo',14,1);
/*!40000 ALTER TABLE `world` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worldemployees`
--

DROP TABLE IF EXISTS `worldemployees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worldemployees` (
  `worldemployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `employeesID` int(11) NOT NULL,
  `worldID` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`worldemployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worldemployees`
--

LOCK TABLES `worldemployees` WRITE;
/*!40000 ALTER TABLE `worldemployees` DISABLE KEYS */;
INSERT INTO `worldemployees` VALUES (1,17,1,1),(2,17,2,0);
/*!40000 ALTER TABLE `worldemployees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-04 18:33:43
