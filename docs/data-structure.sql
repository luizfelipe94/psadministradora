-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: uberdatamanager
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.29-MariaDB

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
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(64) DEFAULT NULL,
  `bairro` varchar(64) DEFAULT NULL,
  `cidade` varchar(64) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `id_Perfil` int(11) NOT NULL,
  PRIMARY KEY (`idEndereco`),
  KEY `id_Perfil` (`id_Perfil`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_Perfil`) REFERENCES `perfil` (`idPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manutencao`
--

DROP TABLE IF EXISTS `manutencao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manutencao` (
  `idManutencao` int(11) NOT NULL AUTO_INCREMENT,
  `dataManutencao` datetime NOT NULL,
  `estabelecimento` varchar(64) NOT NULL,
  `detalhes` varchar(256) NOT NULL,
  `id_Veiculo` int(11) NOT NULL,
  `tipoServico` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`idManutencao`),
  KEY `id_Veiculo` (`id_Veiculo`),
  CONSTRAINT `manutencao_ibfk_1` FOREIGN KEY (`id_Veiculo`) REFERENCES `veiculo` (`idVeiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manutencao`
--

LOCK TABLES `manutencao` WRITE;
/*!40000 ALTER TABLE `manutencao` DISABLE KEYS */;
INSERT INTO `manutencao` VALUES (1,'0000-00-00 00:00:00','oficina amigo 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis ',2,'pneus','troca dos 4 pneus','OK'),(2,'2019-02-03 08:08:55','oficina amigo 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis ',1,'lataria','pintura das portas','PE'),(3,'0000-00-00 00:00:00','oficina amigo 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luct3213us et ultrice312s posu31231ere cubilia ',1,'pneus','troca do pneu dianteiro esquerdo','OK'),(4,'0000-00-00 00:00:00','oficina amigo 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luct3213us et ultrice312s posu31231ere cubilia ',1,'farol','troca dos 4 faróis','CA');
/*!40000 ALTER TABLE `manutencao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cnh` varchar(30) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `profissao` varchar(45) DEFAULT NULL,
  `educacao` varchar(45) DEFAULT NULL,
  `sobreMim` varchar(256) DEFAULT NULL,
  `id_Veiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPerfil`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `rg` (`rg`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cnh` (`cnh`),
  KEY `id_Veiculo` (`id_Veiculo`),
  CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_Veiculo`) REFERENCES `veiculo` (`idVeiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Luiz Felipe','16214467789','88963321',NULL,'luizlipefs@hotmail.com',NULL,NULL,NULL,NULL),(2,'testelogin','123456789','123456789','123456789','testelogin@testelogin.com',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico` (
  `idServico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `nota` enum('A','B','C','D','E') DEFAULT NULL,
  `id_Manutencao` int(11) DEFAULT NULL,
  PRIMARY KEY (`idServico`),
  KEY `id_Manutencao` (`id_Manutencao`),
  CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_Manutencao`) REFERENCES `manutencao` (`idManutencao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone` (
  `idTelefone` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('COM','RES','CEL') DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `id_Perfil` int(11) NOT NULL,
  PRIMARY KEY (`idTelefone`),
  KEY `id_Perfil` (`id_Perfil`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`id_Perfil`) REFERENCES `perfil` (`idPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `userpass` varchar(128) NOT NULL,
  `tipo` enum('ADMIN','CLIENTE','MOTORISTA') DEFAULT NULL,
  `id_Perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `id_Perfil_UNIQUE` (`id_Perfil`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_Perfil`) REFERENCES `perfil` (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','$2y$12$LcslqgGLEPZ3xQsMfFJXnehcqjZnNUrHj9pLx1yJtl3CkB8BNEC/u','ADMIN',1),(6,'luizlipefs','123456','ADMIN',NULL),(9,'testehash','202cb962ac59075b964b07152d234b70','ADMIN',NULL),(10,'teste md5','$2y$12$70jFUImbrVdvfC/wnu1tMu3cubhgC1Sxh2eDCZI9dLbRasx/CBUs6','ADMIN',NULL),(11,'testelogin','$2y$12$8nq3xeRiPiYrPNeMTrWB1OnH49j.J9IP.Sb.ZNzAaFNWEdd/.oMpK','ADMIN',2),(12,'admin1','admin1','CLIENTE',NULL),(14,'luizlipefs1','$2y$12$kgdGa.0AVjjSl4tGkS4qvuGU.lSwaym7bbo64zate8yiaGLM2qWwG','ADMIN',NULL),(15,'admin2','$2y$12$LcslqgGLEPZ3xQsMfFJXnehcqjZnNUrHj9pLx1yJtl3CkB8BNEC/u','ADMIN',NULL),(16,'testeauth','$2y$12$fEzWGnufUWSL/qGgvYb5Pued.P8FUbybIDk/bQ3qyAH1hQR4ZVVEe','ADMIN',NULL),(17,'luizlipefs','$2y$12$ATNzpUcBHVUbX3F4znAh7u08Hq51YmnuTO2/gIvuZfzeyJrINqSs.','ADMIN',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculo` (
  `idVeiculo` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(64) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `ano` int(11) NOT NULL,
  `cor` varchar(32) NOT NULL,
  `km` int(11) NOT NULL,
  PRIMARY KEY (`idVeiculo`),
  UNIQUE KEY `placa` (`placa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculo`
--

LOCK TABLES `veiculo` WRITE;
/*!40000 ALTER TABLE `veiculo` DISABLE KEYS */;
INSERT INTO `veiculo` VALUES (1,'ford ka','ABC-123',2010,'preto',80),(2,'celta','ABA-123',2011,'AZUL',125),(4,'teste1','ABC-111',2010,'branco',14),(5,'Teste2','ABC-112',2008,'vermelho',112),(6,'Teste111','ASD-133',2313,'Vermelho',213),(7,'ford dashboard teste','AAA-231',2014,'azul',122);
/*!40000 ALTER TABLE `veiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-26 10:20:34
