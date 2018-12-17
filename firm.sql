/*
SQLyog v10.2 
MySQL - 5.5.53 : Database - firm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`firm` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `firm`;

/*Table structure for table `qy_admin` */

DROP TABLE IF EXISTS `qy_admin`;

CREATE TABLE `qy_admin` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `user` varchar(20) NOT NULL COMMENT '管理员昵称',
  `password` varchar(32) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `qy_admin` */

insert  into `qy_admin`(`id`,`user`,`password`) values (1,'10','1'),(2,'16','c4ca4238a0b923820dcc509a6f75849b'),(5,'1','c4ca4238a0b923820dcc509a6f75849b'),(6,'2','c81e728d9d4c2f636f067f89cc14862c'),(16,'1','c4ca4238a0b923820dcc509a6f75849b'),(25,'admin','21232f297a57a5a743894a0e4a801fc3'),(24,'1','c4ca4238a0b923820dcc509a6f75849b'),(10,'6','1679091c5a880faf6fb5e6087eb1b2dc'),(23,'1','c4ca4238a0b923820dcc509a6f75849b'),(12,'8','c9f0f895fb98ab9159f51fd0297e236d'),(20,'1','c4ca4238a0b923820dcc509a6f75849b'),(17,'1','c4ca4238a0b923820dcc509a6f75849b'),(26,'abc','900150983cd24fb0d6963f7d28e17f72'),(27,'123','202cb962ac59075b964b07152d234b70'),(28,'12','96e79218965eb72c92a549dd5a330112');

/*Table structure for table `qy_article` */

DROP TABLE IF EXISTS `qy_article`;

CREATE TABLE `qy_article` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(60) DEFAULT NULL COMMENT '文章标题',
  `keyword` varchar(100) DEFAULT NULL COMMENT '文章关键词',
  `desc` varchar(255) DEFAULT NULL COMMENT '文章描述',
  `author` varchar(30) DEFAULT NULL COMMENT '文章作者',
  `pic` varchar(255) DEFAULT NULL COMMENT '文章缩略图',
  `centent` text COMMENT '文章内容',
  `click` mediumint(9) DEFAULT '0' COMMENT '点击数',
  `zan` mediumint(9) DEFAULT '0' COMMENT '点赞数',
  `time` int(10) DEFAULT NULL COMMENT '发布时间',
  `cateid` mediumint(9) DEFAULT NULL COMMENT '所属栏目',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `qy_article` */

insert  into `qy_article`(`id`,`title`,`keyword`,`desc`,`author`,`pic`,`centent`,`click`,`zan`,`time`,`cateid`) values (2,'a','c','a','b','\\uploads/20181214\\f0b5e786e3a4cc1c78ed955de0c152fe.png','<p>a</p>',0,0,NULL,13),(3,'测试标题测试标题测试标题测试标题测试标题测试标题','c','aa','b','\\uploads/20181214\\49464049fdd9006b6005ecd7d7a9d040.png','<p>存储</p>',0,0,NULL,13),(4,'标题','登录页','描述测试描述测试描述测试描述测试描述测试描述测试描述测试描述测试描述测试描述测试描述测试描述测试描述测试','信息','\\uploads/20181216\\2329b4a07189005fe9578a1a75b87fc9.png','<p>aa</p>',0,0,NULL,1),(5,'测试标题测试标题测试标题测试标题测试标题测试标题测试标题测试标题测试标题测试标题测试标题测试标题','啊啊','啊啊','啊啊','\\uploads/20181214\\2a57c1e422955cb5944e0853e8754bf1.png','<p>啊啊</p>',0,0,NULL,6),(6,'1','1','1','1','\\uploads/20181214\\0a1c6c91fa92b8aceceac1824355e846.png','<p>1</p>',0,0,NULL,6),(9,'测试','1','1','1','\\uploads/20181214\\0dde52574832c97f7ef985707a0aac58.jpg','<p>1</p>',0,0,NULL,13),(10,'2','2','2','2','\\uploads/20181214\\5540fe6908bdc85cf2c0f22696779b8d.png','<p>2</p>',0,0,NULL,12),(12,'再测','ccc','ccc','cc','\\uploads/20181214\\3f980f419e412be4eeab719677d02452.png','<p>ccc</p>',0,0,NULL,6),(24,'dd','dd','dd','dd','\\uploads/20181215\\8dc0ecdfc65c0f1fdc9ef1692b9b4d26.png','<p>dd</p>',0,0,NULL,1),(14,'2','2','2','2',NULL,'<p>2</p>',0,0,NULL,13),(16,'w','w','w','w','\\uploads/20181214\\89138b1aa5c3bee57773d7b4636bc7cd.png','<p>w</p>',0,0,NULL,12),(18,'xa','xa','xa','xa','\\uploads/20181214\\c0dc154f8c55bc1b7f839807ba3b2039.png','<p>xa</p>',0,0,NULL,6),(19,'q','q','q','q','\\uploads/20181214\\a2c875fb9d598781a56684bbf65ed981.png','<p>q</p>',0,0,NULL,12);

/*Table structure for table `qy_cate` */

DROP TABLE IF EXISTS `qy_cate`;

CREATE TABLE `qy_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `catename` varchar(50) NOT NULL COMMENT '栏目名称',
  `type` varchar(10) NOT NULL DEFAULT '1' COMMENT '栏目类型1代表文章列表2代表单页3代表图片列表',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级栏目id 0代表最上级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `qy_cate` */

insert  into `qy_cate`(`id`,`catename`,`type`,`pid`) values (1,'中国','1',0),(12,'内蒙古','1',1),(6,'上海','2',1),(13,'赤峰','2',12),(17,'欧洲','3',0);

/*Table structure for table `qy_conf` */

DROP TABLE IF EXISTS `qy_conf`;

CREATE TABLE `qy_conf` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '配置项id',
  `cnname` varchar(50) DEFAULT NULL COMMENT '配置中文名称',
  `enname` varchar(50) DEFAULT NULL COMMENT '配置英文名称',
  `type` tinyint(1) DEFAULT '1' COMMENT '配置类型1单行文本框2文本域3单选按钮4复选按钮5下拉菜单',
  `value` varchar(255) DEFAULT NULL COMMENT '配置值',
  `values` varchar(255) DEFAULT NULL COMMENT '配置可选值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `qy_conf` */

insert  into `qy_conf`(`id`,`cnname`,`enname`,`type`,`value`,`values`) values (1,'站点配置','conf',1,'1','111'),(2,'测试2','ceshi1',2,'1',''),(3,'是否关闭网站','guanbui',3,'是','是,否'),(5,'session时间','aaa',5,'两个小时','一个小时,两个小时,三个小时'),(12,'验证码是否启用','qqq',4,'','选我');

/*Table structure for table `qy_link` */

DROP TABLE IF EXISTS `qy_link`;

CREATE TABLE `qy_link` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `title` varchar(60) DEFAULT NULL COMMENT '链接标题',
  `desc` varchar(255) DEFAULT NULL COMMENT '链接描述',
  `url` varchar(160) DEFAULT NULL COMMENT '链接地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `qy_link` */

insert  into `qy_link`(`id`,`title`,`desc`,`url`) values (16,'3','','http://www.baidus.com'),(13,'百度','baidu','http://www.baidu.com'),(14,'2','','http://www.baiqdu.com'),(15,'11111111111111111111111111111111111','','http://www.baiduc.com'),(17,'4','s','http://www.baisdus.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
