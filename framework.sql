# Host: 127.0.0.1  (Version 5.5.53)
# Date: 2018-12-29 10:53:54
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "permission_role"
#

CREATE TABLE `permission_role` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

#
# Data for table "permission_role"
#

INSERT INTO `permission_role` VALUES (1,1,1),(2,2,1),(3,3,2),(4,4,2),(5,5,1),(6,6,1),(7,7,1),(8,8,1);

#
# Structure for table "permissions"
#

CREATE TABLE `permissions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(20) NOT NULL DEFAULT '' COMMENT '前端路由',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `description` varchar(20) NOT NULL DEFAULT '',
  `icon` varchar(30) NOT NULL DEFAULT '',
  `sort_order` tinyint(2) NOT NULL DEFAULT '0' COMMENT '排序编号',
  `parent_id` int(5) NOT NULL DEFAULT '0' COMMENT '父级id',
  `is_display` tinyint(2) NOT NULL DEFAULT '0' COMMENT '菜单是否显示，0：不显示，1：显示',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

#
# Data for table "permissions"
#

INSERT INTO `permissions` VALUES (1,'aaa','测试','测试','',0,0,0),(2,'bbb','测试2','测试2','',0,0,1),(3,'ccc','测试3','测试3','',0,2,1),(4,'ddd','测试4','测试4','',3,3,1),(5,'eee','测试5','测试5','',1,3,1),(6,'fff','测试6','测试6','',2,3,1),(7,'ggg','测试7','测试7','',0,2,1),(8,'hhh','测试8','测试8','',1,2,1);

#
# Structure for table "role_user"
#

CREATE TABLE `role_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# Data for table "role_user"
#

INSERT INTO `role_user` VALUES (1,1,1),(2,1,2);

#
# Structure for table "roles"
#

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# Data for table "roles"
#

INSERT INTO `roles` VALUES (1,'测试'),(2,'测试2');

#
# Structure for table "users"
#

CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'唐朝','123456');
