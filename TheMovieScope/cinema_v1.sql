-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: cinema
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artiste` (
  `idArtiste` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `dateNaiss` date DEFAULT NULL,
  PRIMARY KEY (`idArtiste`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artiste`
--

LOCK TABLES `artiste` WRITE;
/*!40000 ALTER TABLE `artiste` DISABLE KEYS */;
INSERT INTO `artiste` VALUES (1,'Scott','Ridley','1943-01-26'),(2,'Hitchcock','Alfred','1899-02-27'),(3,'Kurosawa','Akira','1910-03-28'),(4,'Woo','John','1946-04-29'),(5,'Tarantino','Quentin','1963-05-30'),(6,'Cameron','James','1954-06-30'),(7,'Tarkovski','Andrei','1932-11-23'),(13,'Henry','Thomas','1971-09-09'),(14,'James','Stewart','1908-05-20'),(15,'Timera','Youssouf','1999-06-11'),(16,'toto','titi','1999-07-01');
/*!40000 ALTER TABLE `artiste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film`
--

DROP TABLE IF EXISTS `film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film` (
  `idFilm` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) DEFAULT NULL,
  `annee` varchar(4) DEFAULT NULL,
  `resume` varchar(512) DEFAULT NULL,
  `Artiste_idRealisateur` int(10) unsigned NOT NULL,
  `Genre_idGenre` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idFilm`),
  KEY `fk_Film_Artiste_idx` (`Artiste_idRealisateur`),
  KEY `fk_Film_Genre1_idx` (`Genre_idGenre`),
  CONSTRAINT `fk_Film_Artiste` FOREIGN KEY (`Artiste_idRealisateur`) REFERENCES `artiste` (`idArtiste`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Film_Genre1` FOREIGN KEY (`Genre_idGenre`) REFERENCES `genre` (`idGenre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film`
--

LOCK TABLES `film` WRITE;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` VALUES (1,'Alien','1979','Durant le voyage de retour d\'un immense cargo spatial en mission commerciale de routine, ses passagers, cinq hommes et deux femmes plongés en hibernation, sont tirés de leur léthargie dix mois plus tôt que prévu par Mother, l\'ordinateur de bord. Ce dernier a en effet capté dans le silence interplanétaire des signaux sonores, et suivant une certaine clause du contrat de navigation, les astronautes sont chargés de prospecter tout indice de vie dans l\'espace.',1,6),(2,'Vertigo','1958','Scottie, inspecteur de police, a été limogé parce qu\'il est sujet au vertige. Un de ses vieux amis le charge de surveiller sa très belle femme, Madeleine, dont le comportement étrange lui fait craindre qu\'elle ne se suicide. Scottie la prend en filature, la sauve d\'une noyade volontaire puis s\'éprend d\'elle. Cependant, en raison de sa peur du vide, il ne parvient pas à l\'empêcher de se précipiter du haut d\'un clocher.',2,8),(3,'Psychose','1960','Phoenix, Arizona. Marion Crane et Sam Loomis sont amants mais le manque d\'argent compromet leur mariage. Sam doit verser une pension alimentaire à son ex-femme et éponger les dettes de son père. Marion supporte de plus en plus mal cet amour se limitant à des rencontres furtives. De retour au bureau, elle assiste à une transaction immobilière entre un riche client et son patron, qui la charge de déposer à la banque 40.000 dollars.',2,3),(4,'Kagemusha','1980','En 1573, le Japon est le théâtre de guerres incessantes entre clans rivaux. Le plus puissant de ces clans est commandé par Shingen Takeda. Au cours du siège du château de Noda, Takeda est blessé à mort par un tireur embusqué.',3,9),(9,'lesBTS','2021','L\'histoire d\'une classe de BTS qui cherche à réussir un TP test consistant à créer un site WEB simulant un site de review de film.',15,1);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `idGenre` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Action'),(2,'Comique'),(3,'Horreur'),(4,'Comedie'),(5,'Dramatique'),(6,'Fiction'),(7,'Peplum'),(8,'Thriller'),(9,'Guerre');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internaute`
--

DROP TABLE IF EXISTS `internaute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `internaute` (
  `idInternaute` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` int(1) DEFAULT NULL,
  PRIMARY KEY (`idInternaute`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internaute`
--

LOCK TABLES `internaute` WRITE;
/*!40000 ALTER TABLE `internaute` DISABLE KEYS */;
INSERT INTO `internaute` VALUES (1,'Mohammed','Tobji','mohammed.tobji@lycee-jeanrostand.fr','tobji1234',0),(2,'Mohamed','Madani','mohamed.madani@lycee-jeanrostand.fr','madani1111',0),(3,'Admin','Test','admin','1234',1),(4,'Internaute','Test','internaute','1234',0);
/*!40000 ALTER TABLE `internaute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jouer`
--

DROP TABLE IF EXISTS `jouer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jouer` (
  `Artiste_idArtiste` int(10) unsigned NOT NULL,
  `Film_idFilm` int(10) unsigned NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Artiste_idArtiste`,`Film_idFilm`),
  KEY `fk_Jouer_idFilm_idx` (`Film_idFilm`),
  KEY `fk_Jouer_idArtiste_idx` (`Artiste_idArtiste`),
  CONSTRAINT `fk_Jouer_idArtiste` FOREIGN KEY (`Artiste_idArtiste`) REFERENCES `artiste` (`idArtiste`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jouer_idFilm` FOREIGN KEY (`Film_idFilm`) REFERENCES `film` (`idFilm`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jouer`
--

LOCK TABLES `jouer` WRITE;
/*!40000 ALTER TABLE `jouer` DISABLE KEYS */;
INSERT INTO `jouer` VALUES (13,1,'Eliott'),(14,2,'Scottie');
/*!40000 ALTER TABLE `jouer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noter`
--

DROP TABLE IF EXISTS `noter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noter` (
  `Internaute_idInternaute` int(10) unsigned NOT NULL,
  `Film_idFilm` int(10) unsigned NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(128) NOT NULL,
  PRIMARY KEY (`Internaute_idInternaute`,`Film_idFilm`),
  KEY `fk_Noter_idFilm_idx` (`Film_idFilm`),
  KEY `fk_Noter_idInternaute_idx` (`Internaute_idInternaute`),
  CONSTRAINT `fk_Noter_idFilm` FOREIGN KEY (`Film_idFilm`) REFERENCES `film` (`idFilm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Noter_idInternaute` FOREIGN KEY (`Internaute_idInternaute`) REFERENCES `internaute` (`idInternaute`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noter`
--

LOCK TABLES `noter` WRITE;
/*!40000 ALTER TABLE `noter` DISABLE KEYS */;
INSERT INTO `noter` VALUES (1,3,5,'Bof, la fin n\'est pas à la hauteur du reste du film'),(2,1,7,'J\'ai adorer le film !');
/*!40000 ALTER TABLE `noter` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-04 20:46:00
