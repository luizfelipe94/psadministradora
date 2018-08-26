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
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `manutencao`
--

LOCK TABLES `manutencao` WRITE;
/*!40000 ALTER TABLE `manutencao` DISABLE KEYS */;
INSERT INTO `manutencao` VALUES (1,'0000-00-00 00:00:00','oficina amigo 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis ',2,'pneus','troca dos 4 pneus','OK'),(2,'2019-02-03 08:08:55','oficina amigo 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis ',1,'lataria','pintura das portas','PE'),(3,'0000-00-00 00:00:00','oficina amigo 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luct3213us et ultrice312s posu31231ere cubilia ',1,'pneus','troca do pneu dianteiro esquerdo','OK'),(4,'0000-00-00 00:00:00','oficina amigo 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu lectus a mauris cursus tempor nec at risus. Maecenas id consequat purus, sit amet fringilla arcu. Vestibulum ante ipsum primis in faucibus orci luct3213us et ultrice312s posu31231ere cubilia ',1,'farol','troca dos 4 faróis','CA');
/*!40000 ALTER TABLE `manutencao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Luiz Felipe','16214467789','88963321',NULL,'luizlipefs@hotmail.com',NULL,NULL,NULL,NULL),(2,'testelogin','123456789','123456789','123456789','testelogin@testelogin.com',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','$2y$12$LcslqgGLEPZ3xQsMfFJXnehcqjZnNUrHj9pLx1yJtl3CkB8BNEC/u','ADMIN',1),(6,'luizlipefs','123456','ADMIN',NULL),(9,'testehash','202cb962ac59075b964b07152d234b70','ADMIN',NULL),(10,'teste md5','$2y$12$70jFUImbrVdvfC/wnu1tMu3cubhgC1Sxh2eDCZI9dLbRasx/CBUs6','ADMIN',NULL),(11,'testelogin','$2y$12$8nq3xeRiPiYrPNeMTrWB1OnH49j.J9IP.Sb.ZNzAaFNWEdd/.oMpK','ADMIN',2),(12,'admin1','admin1','CLIENTE',NULL),(14,'luizlipefs1','$2y$12$kgdGa.0AVjjSl4tGkS4qvuGU.lSwaym7bbo64zate8yiaGLM2qWwG','ADMIN',NULL),(15,'admin2','$2y$12$LcslqgGLEPZ3xQsMfFJXnehcqjZnNUrHj9pLx1yJtl3CkB8BNEC/u','ADMIN',NULL),(16,'testeauth','$2y$12$fEzWGnufUWSL/qGgvYb5Pued.P8FUbybIDk/bQ3qyAH1hQR4ZVVEe','ADMIN',NULL),(17,'luizlipefs','$2y$12$ATNzpUcBHVUbX3F4znAh7u08Hq51YmnuTO2/gIvuZfzeyJrINqSs.','ADMIN',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2018-08-26 10:19:30
