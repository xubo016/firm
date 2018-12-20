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
  `email` varchar(60) DEFAULT NULL COMMENT '电子邮箱',
  `password` varchar(32) NOT NULL COMMENT '管理员密码',
  `repassword` varchar(32) NOT NULL COMMENT '确认密码',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `delete_time` timestamp NULL DEFAULT NULL COMMENT '软删除',
  `ip` varchar(20) DEFAULT NULL COMMENT '管理员ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `qy_admin` */

insert  into `qy_admin`(`id`,`user`,`email`,`password`,`repassword`,`create_time`,`update_time`,`delete_time`,`ip`) values (1,'admin',NULL,'21232f297a57a5a743894a0e4a801fc3','',NULL,NULL,NULL,NULL),(2,'abc','931274989@qq.com','670b14728ad9902aecba32e22fa4f6bd','670b14728ad9902aecba32e22fa4f6bd','2018-12-20 18:02:15','2018-12-20 18:02:15',NULL,NULL);

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
  `create_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `cateid` mediumint(9) DEFAULT NULL COMMENT '所属栏目',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `qy_article` */

insert  into `qy_article`(`id`,`title`,`keyword`,`desc`,`author`,`pic`,`centent`,`click`,`zan`,`create_time`,`cateid`) values (1,'测试','关键字','描述','author','\\uploads/20181220\\da4daaa26b0b862bfae3b53331e7da61.png','<p>内容测试</p>',0,0,'2018-12-20 17:52:36',1),(2,'测试2','关键字','ok','author','\\uploads/20181220\\d831b1d53e0b662c656ba1649a18f3f2.png','<p>neiron</p>',0,0,'2018-12-20 17:53:27',2);

/*Table structure for table `qy_auth_group` */

DROP TABLE IF EXISTS `qy_auth_group`;

CREATE TABLE `qy_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态默认1 开启 0关闭',
  `rules` varchar(255) NOT NULL DEFAULT '' COMMENT '权限内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `qy_auth_group` */

insert  into `qy_auth_group`(`id`,`title`,`status`,`rules`) values (1,'超级管理员',1,''),(2,'管理员',1,'2,16,33,34,35,17,18,19,21,22,42,43,44,45,46');

/*Table structure for table `qy_auth_group_access` */

DROP TABLE IF EXISTS `qy_auth_group_access`;

CREATE TABLE `qy_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '管理员id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `qy_auth_group_access` */

insert  into `qy_auth_group_access`(`uid`,`group_id`) values (1,1),(2,2);

/*Table structure for table `qy_auth_rule` */

DROP TABLE IF EXISTS `qy_auth_rule`;

CREATE TABLE `qy_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '控制器方法名称',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '权限名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '权限类型',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '权限状态',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '上级id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `qy_auth_rule` */

insert  into `qy_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`) values (1,'admin','管理员管理权限',1,1,'',0,0),(2,'cate','栏目管理权限',1,1,'',0,0),(3,'admin/add','管理员添加权限',1,1,'',1,1),(4,'admin/edit','管理员修改权限',1,1,'',1,1),(18,'article/add','文章添加权限',1,1,'',17,1),(20,'admin/lst','管理员列表权限',1,1,'',1,1),(17,'article','文章管理权限',1,1,'',0,0),(16,'cate/add','栏目添加权限',1,1,'',2,1),(15,'admin/ajax_del','管理员删除权限',1,1,'',1,1),(19,'article/edit','文章修改权限',1,1,'',17,1),(21,'article/lst','文章列表权限',1,1,'',17,1),(22,'article/del','文章删除权限',1,1,'',17,1),(23,'AuthGroup','用户组管理权限',1,1,'',0,0),(24,'AuthGroup/add','用户组添加权限',1,1,'',23,1),(25,'AuthGroup/lst','用户组列表权限',1,1,'',23,1),(26,'AuthGroup/edit','用户组修改权限',1,1,'',23,1),(27,'AuthGroup/del','用户组删除权限',1,1,'',23,1),(28,'AuthRule','权限管理权限',1,1,'',0,0),(29,'AuthRule/add','权限添加权限',1,1,'',28,1),(30,'AuthRule/lst','权限列表权限',1,1,'',28,1),(31,'AuthRule/edit','权限修改权限',1,1,'',28,1),(32,'AuthRule/del','权限删除权限',1,1,'',28,1),(33,'cate/lst','栏目列表权限',1,1,'',2,1),(34,'cate/del','栏目删除权限',1,1,'',2,1),(35,'cate/edit','栏目修改权限',1,1,'',2,1),(36,'Conf','系统管理权限',1,1,'',0,0),(37,'Conf/add','配置添加权限',1,1,'',36,1),(38,'Conf/lst','配置列表权限',1,1,'',36,1),(39,'Conf/edit','配置修改权限',1,1,'',36,1),(40,'Conf/del','配置删除权限',1,1,'',36,1),(41,'Conf/conf','配置项权限',1,1,'',36,1),(42,'Link','链接管理权限',1,1,'',0,0),(43,'Link/add','链接添加权限',1,1,'',42,1),(44,'Link/lst','链接列表权限',1,1,'',42,1),(45,'Link/edit','链接修改权限',1,1,'',42,1),(46,'Link/del','链接删除权限',1,1,'',42,1);

/*Table structure for table `qy_cate` */

DROP TABLE IF EXISTS `qy_cate`;

CREATE TABLE `qy_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `catename` varchar(50) NOT NULL COMMENT '栏目名称',
  `type` varchar(10) NOT NULL DEFAULT '1' COMMENT '栏目类型1代表文章列表2代表单页3代表图片列表',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级栏目id 0代表最上级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `qy_cate` */

insert  into `qy_cate`(`id`,`catename`,`type`,`pid`) values (1,'中国','1',0),(2,'内蒙古','1',1),(3,'赤峰','2',2);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `qy_conf` */

insert  into `qy_conf`(`id`,`cnname`,`enname`,`type`,`value`,`values`) values (1,'网站名称','name',1,NULL,'');

/*Table structure for table `qy_link` */

DROP TABLE IF EXISTS `qy_link`;

CREATE TABLE `qy_link` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `title` varchar(60) DEFAULT NULL COMMENT '链接标题',
  `desc` varchar(255) DEFAULT NULL COMMENT '链接描述',
  `url` varchar(160) DEFAULT NULL COMMENT '链接地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `qy_link` */

insert  into `qy_link`(`id`,`title`,`desc`,`url`) values (1,'百度','baidu','http://www.baidu.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
