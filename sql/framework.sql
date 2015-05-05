/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.73-community-log : Database - framework
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
-- CREATE DATABASE /*!32312 IF NOT EXISTS*/`framework` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `usuarios` */

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `edad` int(3) NOT NULL,
  `ci` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`apellido`,`edad`,`ci`,`email`,`pass`) values (17,'Bernardo Firpo','a',0,'as','bfirpo@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b'),(18,'Pepe','silva',22,'333','bfirpo@gmail','7c4a8d09ca3762af61e59520943dc26494f8941b'),(11,'aa','22',22,'2222','',NULL),(15,'pedro','rodriguez',27,'33333','bfirpo@gmail','7c4a8d09ca3762af61e59520943dc26494f8941b'),(25,'Edinson','Cavani',27,'33333','edi@cavani.com','7c4a8d09ca3762af61e59520943dc26494f8941b'),(24,'luis','suarez',22,'333','luisito@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
