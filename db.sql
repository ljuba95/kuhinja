/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.25-MariaDB-1~xenial : Database - kuhinja
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kuhinja` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kuhinja`;

/*Table structure for table `recipes` */

DROP TABLE IF EXISTS `recipes`;

CREATE TABLE `recipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `text` text CHARACTER SET latin1,
  `img` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `time_needed` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk` (`user_id`),
  CONSTRAINT `fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `recipes` */

insert  into `recipes`(`id`,`name`,`text`,`img`,`time_needed`,`date_created`,`user_id`) values (1,'Palacinke sa kremom','MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM','http://3m25hz1w7ubc1phdlj1vq9a9.wpengine.netdna-cdn.com/wp-content/uploads/2017/02/pancakes-900x350-900x300.png',30,'2017-12-10',3866),(4,'Pilece belo',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla nulla orci, nec sodales massa interdum a. Proin sagittis auctor libero, in consectetur dui placerat in. Mauris vitae cursus nibh. Praesent accumsan auctor lectus pharetra fringilla. Proin et velit tortor. Sed nec nisl eget felis aliquam finibus sit amet eget arcu. Praesent justo erat, eleifend et diam ornare, tincidunt vulputate nisl. Nunc auctor turpis ac placerat blandit. Nullam faucibus quam nisi, vitae fringilla mauris finibus a. Aenean accumsan ultricies malesuada. Mauris vitae varius neque. Curabitur finibus ultricies enim, quis eleifend enim aliquam vel. Vestibulum quis elit sit amet eros finibus viverra in euismod massa.\r\n\r\nProin nec orci mollis lectus molestie blandit. Etiam consequat urna dignissim tincidunt pellentesque. Mauris commodo augue ut cursus tempor. Donec vel mi in velit dapibus pulvinar. Sed non varius est. Donec sit amet leo eu elit dapibus congue tempor sit amet augue. Ut sed nisl malesuada, volutpat enim tristique, pharetra sapien. Cras ultricies, ipsum vel aliquam lacinia, purus nisl semper diam, vitae malesuada lorem sapien nec nisi. Aliquam vehicula leo pharetra leo aliquet, vel venenatis quam eleifend. Morbi porttitor at mi ac lobortis. Maecenas non diam nec turpis rutrum molestie quis in est. Sed feugiat efficitur sodales. Aenean nec mattis nisi.\r\n\r\nPellentesque consequat mi et nunc luctus, at tristique lacus laoreet. Donec vel dignissim dolor. Duis congue sem mauris, a lobortis orci aliquam id. Curabitur pharetra est pharetra sem placerat condimentum. Vivamus varius consequat velit vestibulum posuere. Donec ut augue convallis, dignissim ipsum id, elementum enim. Maecenas tempus nunc quis justo porttitor aliquet. Sed feugiat odio vitae purus porttitor mattis. Aenean pulvinar mollis velit a tristique. ','/storage/salmon-dish-food-meal-46239_resized.jpeg',1,'2017-12-10',3866),(8,'asdfweaf','afweafw','/storage/pexels-photo-248797_resized_4.jpeg',21,'2017-12-10',3866),(11,'Torta','Umutiti bjelanca sa še?erom, dodati brašno i prašak za pecivo. Smjesu izliti u kalup, obložen papirom za pe?enje, pa pe?i na 200 C oko 30 minuta. Prokuhati 100 ml mlijeka i vanilin še?er. Pe?en biskvit odvojiti od papira, izbockati pa preliti vrelim mlijekom. Ostaviti da se ohladi.\r\n400 ml mlijeka prokuhati. Umutiti žumanca i še?er, pa preliti vrelim mlijekom. Vratiti na ringlu, pa prokuhati kremu miješaju?i svo vrijeme. ?im prokuha maknuti sa vatre. U toplu kremu umiksati želatinu fix. Posebno umutiti 300 ml slatke pavlake, pa sjediniti sa mlakom kremom. Ostaviti da se ohladi.\r\n?okoladu i jaffa keks naribati. Dodati u kremu, koja se potpuno ohladila, pa sve dobro sjediniti.','/storage/torta-tahan-karamel12_resized.jpg',40,'2017-12-20',3866);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3871 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`) values (3866,'Milos Ljubisavljevic','ljuba95@hotmail.com','3858f62230ac3c915f300c664312c63f'),(3869,'Uroš Ljubisavljevic','ljuba012@gmail.com','3858f62230ac3c915f300c664312c63f'),(3870,'Jelena Sremcev','jelena.sremcev@hotmail.com','6ca6702d65bad041d52c1510399ac282');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
