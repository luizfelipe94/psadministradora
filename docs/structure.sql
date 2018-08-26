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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-26 10:20:02
