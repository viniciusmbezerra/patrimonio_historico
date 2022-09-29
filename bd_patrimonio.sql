-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: patrimonio_historico
-- ------------------------------------------------------
-- Server version       8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `objeto`
--

DROP TABLE IF EXISTS `objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objeto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `tipo` tinytext,
  `posicao` tinytext,
  `rotacao` tinytext,
  `cor` varchar(10) DEFAULT NULL,
  `idPai` int NOT NULL,
  PRIMARY KEY (`id`,`idPai`),
  KEY `fk_objeto_objetoPai1_idx` (`idPai`),
  CONSTRAINT `fk_objeto_objetoPai1` FOREIGN KEY (`idPai`) REFERENCES `objetopai` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objeto`
--

LOCK TABLES `objeto` WRITE;
/*!40000 ALTER TABLE `objeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objetopai`
--

DROP TABLE IF EXISTS `objetopai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objetopai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `posicao` tinytext,
  `rotacao` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetopai`
--

LOCK TABLES `objetopai` WRITE;
/*!40000 ALTER TABLE `objetopai` DISABLE KEYS */;
/*!40000 ALTER TABLE `objetopai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patrimonio`
--

DROP TABLE IF EXISTS `patrimonio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patrimonio` (
  `idpatrimonio` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `fk_idusuario` int NOT NULL,
  PRIMARY KEY (`idpatrimonio`,`fk_idusuario`),
  KEY `fk_patrimonio_usuario_idx` (`fk_idusuario`),
  CONSTRAINT `fk_patrimonio_usuario` FOREIGN KEY (`fk_idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patrimonio`
--

LOCK TABLES `patrimonio` WRITE;
/*!40000 ALTER TABLE `patrimonio` DISABLE KEYS */;
INSERT INTO `patrimonio` VALUES (3,'Torre Eifel','A Torre Eiffel (em franc├¬s: Tour Eiffel, /tu╩Ç ╔øf╔øl/) ├® uma torre treli├ºa de ferro do s├®culo XIX localizada no Champ de Mars, em Paris, a qual se tornou um ├¡cone mundial da Fran├ºa. A torre, que ├® o edif├¡cio mais alto da cidade,[1] ├® o monumento pago mais visitado do mundo, com milh├Áes de pessoas frequentando-o anualmente. Nomeada em homenagem ao seu projetista, o engenheiro Gustave Eiffel, foi constru├¡da como o arco de entrada da Exposi├º├úo Universal de 1889.','https://goo.gl/maps/A7MR3UukiZQQYobr9','uploads/patrimonio/imagem/Eiffel_Tower_Marsfeld_Paris.jpg',1),(4,'Cristo Rendentor','Cristo Redentor ├® uma est├ítua art d├®co que retrata Jesus Cristo, localizada no topo do morro do Corcovado, a 709 metros acima do n├¡vel do mar, com vista para parte consider├ível da cidade brasileira do Rio de Janeiro.','https://goo.gl/maps/Wsg1p1TAhhJsHWoV8','uploads/patrimonio/imagem/cristo_redentor.jpg',1),(6,'Port├úo de Brandemburgo','O Port├úo de Brandemburgo, ou Porta de Brandemburgo (em alem├úo: Brandenburger Tor), ├® uma antiga porta da cidade, reconstru├¡da no final do s├®culo XVIII como um arco do triunfo neocl├íssico, e hoje um dos marcos mais conhecidos da Alemanha.[1]','https://goo.gl/maps/u51ZFsfAxjdKwiZKA','uploads/patrimonio/imagem/Portao-De-Brandenburgo-Alemanha-Berlim-4.jpg',5),(7,'Kremlin','Kremlin Moscovo ou Moscou, geralmente designado o Kremlin, ├® um complexo fortificado no centro da capital russa, nas margens do rio Moskva ao sul, com a Catedral de S├úo Bas├¡lio e a Pra├ºa Vermelha a leste e o Jardim de Alexandre a oeste.','https://goo.gl/maps/XiE6jw5agGBtM9d3A','uploads/patrimonio/imagem/kremlin.jpg',6),(8,'Coliseu','Coliseu (em italiano: Colosseo), tamb├®m conhecido como Anfiteatro Flaviano (em latim: Amphitheatrum Flavium; em italiano: Anfiteatro Flavio), ├® um anfiteatro oval localizado no centro da cidade de Roma, capital da It├ília. Constru├¡do com tijolos revestidos de argamassa e areia, e originalmente cobertos com travertino[1] ├® o maior anfiteatro j├í constru├¡do e est├í situado a leste do F├│rum Romano.','https://goo.gl/maps/6UttR3mXomypJd7s5','uploads/patrimonio/imagem/Colosseo_2020.jpg',1),(9,'Siri Cascudo','O Krusty Krab ├® um restaurante de fast food fict├¡cio presente no seriado animado SpongeBob SquarePants, famoso por comercializar seu hamb├║rguer de assinatura, o Krabby Patty, cuja f├│rmula ├® um segredo comercial bem guardado. Fundado por Mr.','https://goo.gl/maps/FarGcZVwo8nBEmbr8','uploads/patrimonio/imagem/siri cascudo.jpg',1),(10,'Muralha da China','Grande Muralha da China ├® uma s├®rie de fortifica├º├Áes feitas de pedra, tijolo, terra compactada, madeira e outros materiais, geralmente constru├¡da ao longo de uma linha leste-oeste atrav├®s das fronteiras ...','https://goo.gl/maps/JXSxjqdEjq7i7rWG6','uploads/patrimonio/imagem/muralha da china.jpg',1),(11,'Monte Everest','O monte Everest ou, na sua forma portuguesa, Evereste, tamb├®m conhecido no Nepal como Sagarm─üth─ü, no Tibete como Chomolungma e Zh┼½m├╣lÃÄngmÃÄ F─ông em chin├¬s, ├® a montanha de maior altitude da Terra. Seu pico est├í a 8 848,86 metros acima do n├¡vel do mar, na subcordilheira Mahalangur Himal dos Himalaias.','https://goo.gl/maps/FarGcZVwo8nBEmbr8','uploads/patrimonio/imagem/monte_everest.jpg',1),(14,'Jerusalem','Jerusal├®m, localizada em um planalto nas montanhas da Judeia entre o Mediterr├óneo e o mar Morto, ├® uma das cidades mais antigas do mundo. ├ë considerada sagrada pelas tr├¬s principais religi├Áes abra├ómicas ÔÇö juda├¡smo, cristianismo e islamismo. Israelenses e palestinos reivindicam a cidade como sua capital.','https://localhost','uploads/patrimonio/imagem/Jeru.jpg',1);
/*!40000 ALTER TABLE `patrimonio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `admin` tinyint DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Vin├¡cius','vinicius@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',1),(5,'Harry','harry@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',1),(6,'Sophia','sophia@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',0),(7,'Nazareno','naza@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;