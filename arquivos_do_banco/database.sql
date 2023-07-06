# SQL-Front 5.1  (Build 4.16)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: mysql.purrfect.codes    Database: purrfect
# ------------------------------------------------------
# Server version 5.5.5-10.6.11-MariaDB-log

DROP DATABASE IF EXISTS `purrfect`;
CREATE DATABASE `purrfect` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `purrfect`;

#
# Source for table pessoa
#

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE `pessoa` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco_linha1` varchar(255) DEFAULT NULL,
  `endereco_linha2` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Dumping data for table pessoa
#

INSERT INTO `pessoa` VALUES (1,'Pessoa1','a','a','a',1);
INSERT INTO `pessoa` VALUES (3,'asd','asd@asd.sd','asd','asd',2);
INSERT INTO `pessoa` VALUES (4,'asd','asd','asd','asd',51);
INSERT INTO `pessoa` VALUES (6,'João da Silva','Joao@silva.edu','Av. João da Silva, 33','Cidade, SP',2);
INSERT INTO `pessoa` VALUES (7,'fulano','ful@no.com','rua das cores n10','bairro azul, tcity',2);

#
# Source for table telefone
#

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE `telefone` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `pessoa_id` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Dumping data for table telefone
#

INSERT INTO `telefone` VALUES (2,1,'(47) 98888-0123');
INSERT INTO `telefone` VALUES (3,1,'(82) 99999-1234');
INSERT INTO `telefone` VALUES (4,1,'(11) 99999-5678');
INSERT INTO `telefone` VALUES (40,4,'(11) 99999-9999');
INSERT INTO `telefone` VALUES (41,4,'(11) 11111-9999');
INSERT INTO `telefone` VALUES (42,4,'(11) 11111-2222');
INSERT INTO `telefone` VALUES (60,7,'47 999 888 777');
INSERT INTO `telefone` VALUES (70,3,'123-1234');
INSERT INTO `telefone` VALUES (71,3,'0800 123 1212');
INSERT INTO `telefone` VALUES (72,3,'+55 1234-1234');
INSERT INTO `telefone` VALUES (73,3,'(11) 1234-1234');
INSERT INTO `telefone` VALUES (75,6,'(11) 12345-6789');

#
# Source for table usuario
#

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '0',
  `excluido` binary(1) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Dumping data for table usuario
#

INSERT INTO `usuario` VALUES (1,'Claudia','himehimur@gmail.com','hih','*23AE809DDACAF96AF0FD78ED04B6A265E05AA257','1','0');
INSERT INTO `usuario` VALUES (2,'Administrador','adm@adm.ec','adm','*3DCFB64FE0CB05D63B9AF64492B5CD6269D82EE8','1','0');
INSERT INTO `usuario` VALUES (51,'Teste','sadasdkkk@1.com','teste','*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799','1','0');
INSERT INTO `usuario` VALUES (52,'a',NULL,NULL,NULL,'0','1');
INSERT INTO `usuario` VALUES (53,'b',NULL,NULL,NULL,'0','1');
INSERT INTO `usuario` VALUES (54,'Nome do usuário','usuario@dominio.co','123','*23AE809DDACAF96AF0FD78ED04B6A265E05AA257','0','0');
INSERT INTO `usuario` VALUES (55,'a','bbb11@a.com','aaa','*A02AA727CF2E8C5E6F07A382910C4028D65A053A','0','1');
INSERT INTO `usuario` VALUES (56,'111','1111@11.com','11','*0801D10217B06C5A9F32430C1A34E030D41A0257','0','0');

#
#  Foreign keys for table pessoa
#

ALTER TABLE `pessoa`
ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`Id`);

#
#  Foreign keys for table telefone
#

ALTER TABLE `telefone`
ADD CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`Id`);


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
