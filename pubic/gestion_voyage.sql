-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)

--

-- Host: localhost    Database: gestion_voyage

-- ------------------------------------------------------

-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!50503 SET NAMES utf8mb4 */

;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */

;

/*!40103 SET TIME_ZONE='+00:00' */

;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */

;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */

;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */

;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */

;

--

-- Table structure for table `logement`

--

DROP TABLE IF EXISTS `logement`;

/*!40101 SET @saved_cs_client     = @@character_set_client */

;

/*!50503 SET character_set_client = utf8mb4 */

;

CREATE TABLE
    `logement` (
        `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
        `nom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `capacite` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `lieu` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NOT NULL,
        `disponibilite` varchar(4) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        PRIMARY KEY (`code`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

/*!40101 SET character_set_client = @saved_cs_client */

;

--

-- Dumping data for table `logement`

--

LOCK TABLES `logement` WRITE;

/*!40000 ALTER TABLE `logement` DISABLE KEYS */

;

INSERT INTO `logement`
VALUES (
        'CO2',
        'logement 2',
        '13',
        'entré-couché',
        'Ctn',
        'cap.png',
        'non'
    ), (
        'ECC',
        'Nouveau logement update',
        '8',
        'salon, cuisine, chambre',
        'Cotonou',
        'cap.png',
        'non'
    ), (
        'new',
        'new',
        '56789',
        'YUIJKL',
        'YTUHJK',
        'b.png',
        'oui'
    ), (
        'nnnnnnnnn',
        'nnnnnnnnnn',
        '5678',
        'UUUUUUUUU',
        'UUUUU',
        'cap.png',
        'non'
    ), (
        'uhjk',
        'uhkjl',
        '5768',
        'hjk',
        'ytghj',
        'b.png',
        'non'
    ), (
        'YUIJiujkl;ddd',
        'yuijklm',
        '6789',
        'TYUHJK',
        'GYHJKkj,',
        'b.png',
        'oui'
    );

/*!40000 ALTER TABLE `logement` ENABLE KEYS */

;

UNLOCK TABLES;

--

-- Table structure for table `sejour`

--

DROP TABLE IF EXISTS `sejour`;

/*!40101 SET @saved_cs_client     = @@character_set_client */

;

/*!50503 SET character_set_client = utf8mb4 */

;

CREATE TABLE
    `sejour` (
        `id_sejour` int NOT NULL AUTO_INCREMENT,
        `debut` date NOT NULL,
        `fin` date NOT NULL,
        `id_voyageur` int NOT NULL,
        `code_logement` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        PRIMARY KEY (`id_sejour`),
        KEY `id_voyageur` (`id_voyageur`),
        KEY `code_logement` (`code_logement`),
        CONSTRAINT `sejour_ibfk_1` FOREIGN KEY (`id_voyageur`) REFERENCES `voyageur` (`id_voyageur`),
        CONSTRAINT `sejour_ibfk_2` FOREIGN KEY (`code_logement`) REFERENCES `logement` (`code`)
    ) ENGINE = InnoDB AUTO_INCREMENT = 32 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

/*!40101 SET character_set_client = @saved_cs_client */

;

--

-- Dumping data for table `sejour`

--

LOCK TABLES `sejour` WRITE;

/*!40000 ALTER TABLE `sejour` DISABLE KEYS */

;

INSERT INTO `sejour`
VALUES (
        2,
        '2023-10-20',
        '2023-11-01',
        2,
        'CO2'
    ), (
        3,
        '2023-10-20',
        '2023-11-01',
        2,
        'CO2'
    ), (
        4,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        5,
        '2023-10-20',
        '2023-11-01',
        2,
        'CO2'
    ), (
        6,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        7,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        8,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        11,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        12,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        13,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        14,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        15,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        16,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        17,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        18,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        19,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        20,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        21,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        22,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        23,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        24,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        25,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        26,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        27,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        28,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        29,
        '2023-11-20',
        '2024-01-20',
        2,
        'CO2'
    ), (
        30,
        '2023-11-20',
        '2024-01-20',
        1,
        'YUIJiujkl;ddd'
    );

/*!40000 ALTER TABLE `sejour` ENABLE KEYS */

;

UNLOCK TABLES;

--

-- Table structure for table `voyageur`

--

DROP TABLE IF EXISTS `voyageur`;

/*!40101 SET @saved_cs_client     = @@character_set_client */

;

/*!50503 SET character_set_client = utf8mb4 */

;

CREATE TABLE
    `voyageur` (
        `id_voyageur` int NOT NULL AUTO_INCREMENT,
        `nom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `prenom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `ville` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `region` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `sexe` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        PRIMARY KEY (`id_voyageur`)
    ) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

/*!40101 SET character_set_client = @saved_cs_client */

;

--

-- Dumping data for table `voyageur`

--

LOCK TABLES `voyageur` WRITE;

/*!40000 ALTER TABLE `voyageur` DISABLE KEYS */

;

INSERT INTO `voyageur`
VALUES (
        1,
        'ZOU',
        'Paul',
        'Cotonou',
        'Sud',
        'M'
    ), (
        2,
        'ZII',
        'Yvette',
        'Calavi',
        'Est',
        'F'
    );

/*!40000 ALTER TABLE `voyageur` ENABLE KEYS */

;

UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */

;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */

;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */

;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */

;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */

;

-- Dump completed on 2023-10-21 13:28:16