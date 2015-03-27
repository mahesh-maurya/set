-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `tbl_banner_master`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_banner_master`;
CREATE TABLE IF NOT EXISTS `tbl_banner_master` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` varchar(200) NOT NULL,
  `banner_position` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `banner_code` text NOT NULL,
  `widget_name` varchar(300) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` datetime NOT NULL,
  `page_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `device_type` varchar(100) NOT NULL DEFAULT 'web',
  `sort_order` int(11) DEFAULT NULL,
  `ip_location` varchar(50) NOT NULL DEFAULT 'in',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_categories`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(300) NOT NULL,
  `category_description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `slug` varchar(500) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_config`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `configID` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(300) NOT NULL,
  `site_email` varchar(400) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`configID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_main_menu`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_main_menu`;
CREATE TABLE IF NOT EXISTS `tbl_main_menu` (
  `main_menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(300) NOT NULL,
  `menu_description` text,
  `position` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`main_menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_menus`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_menus`;
CREATE TABLE IF NOT EXISTS `tbl_menus` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `main_menuID` int(11) NOT NULL,
  `menu_name` varchar(300) NOT NULL,
  `menu_image` varchar(200) NOT NULL,
  `menu_description` text,
  `parentID` int(11) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  `system_url` varchar(400) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_page_location_mapping`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_page_location_mapping`;
CREATE TABLE IF NOT EXISTS `tbl_page_location_mapping` (
  `mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `location_name` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`mapping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_page_master`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_page_master`;
CREATE TABLE IF NOT EXISTS `tbl_page_master` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(200) NOT NULL,
  `template` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `meta_keyword` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_passwordhistory`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_passwordhistory`;
CREATE TABLE IF NOT EXISTS `tbl_passwordhistory` (
  `pass_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`pass_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_profiles`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_profiles`;
CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `tbl_profiles_fields`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_profiles_fields`;
CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE `tbl_role`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `description` text,
  `status` enum('active','inactive') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_role_permission`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_role_permission`;
CREATE TABLE IF NOT EXISTS `tbl_role_permission` (
  `rolePermissionID` int(11) NOT NULL AUTO_INCREMENT,
  `roleID` int(11) DEFAULT NULL,
  `permissionName` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`rolePermissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_static_pages`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_static_pages`;
CREATE TABLE IF NOT EXISTS `tbl_static_pages` (
  `staticpage_id` int(50) NOT NULL AUTO_INCREMENT,
  `category_id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `type` varchar(100) NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `status` int(50) NOT NULL,
  PRIMARY KEY (`staticpage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_terms`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_terms`;
CREATE TABLE IF NOT EXISTS `tbl_terms` (
  `termID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL,
  `term_name` varchar(300) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY (`termID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_users`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- -------------------------------------------
-- TABLE DATA tbl_categories
-- -------------------------------------------
INSERT INTO `tbl_categories` (`categoryID`,`category_name`,`category_description`,`created`,`modified`,`slug`) VALUES
('3','Articles','articles','2013-05-04 13:03:26','2013-07-29 11:08:20','articles');
INSERT INTO `tbl_categories` (`categoryID`,`category_name`,`category_description`,`created`,`modified`,`slug`) VALUES
('12','FAQ\'s','faq','2013-07-24 12:54:45','2013-07-24 12:54:45','faqs');



-- -------------------------------------------
-- TABLE DATA tbl_config
-- -------------------------------------------
INSERT INTO `tbl_config` (`configID`,`site_name`,`site_email`,`logo`,`created`,`modified`) VALUES
('1','MyProject','rajnikant.mehta@grey.com','cae321c0244284f7eba98736e1297ec9.jpeg','0000-00-00 00:00:00','0000-00-00 00:00:00');



-- -------------------------------------------
-- TABLE DATA tbl_main_menu
-- -------------------------------------------
INSERT INTO `tbl_main_menu` (`main_menuID`,`menu_name`,`menu_description`,`position`,`created`,`modified`) VALUES
('1','BackEnd Header Menu','This is Header Part of system','1','2013-03-08 16:08:22','2013-05-04 12:54:21');
INSERT INTO `tbl_main_menu` (`main_menuID`,`menu_name`,`menu_description`,`position`,`created`,`modified`) VALUES
('3','Indian Idol Frontend Menu','Dynamic menu on frontend','1','2013-05-15 11:32:08','2013-05-15 11:32:08');



-- -------------------------------------------
-- TABLE DATA tbl_menus
-- -------------------------------------------
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('5','1','Users','','profile main menu
','70','8','/profile/profile','1','2013-03-08 18:50:24','2013-07-11 17:14:42');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('6','1','Add profile','','Add user profile','5','8','/admin/create','1','2013-03-08 18:51:14','2013-03-15 11:02:11');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('7','1','List Profile','','For listing','5','9','/profile/profile','1','2013-03-11 12:59:42','2013-03-15 19:12:46');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('9','1','Create Role','','creating a role','10','3','/role/create','1','2013-03-14 18:38:24','2013-05-16 11:32:48');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('10','1','Role','','managing roles','70','6','/role/manageRole','1','2013-03-14 18:46:45','2013-05-16 11:31:30');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('11','1','Manage Permissions','','managing permissions','10','7','/rolepermission/index','1','2013-03-14 18:47:41','2013-05-16 11:33:15');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('13','1','Create Menu','','for creating new menu','12','9','/mainMenu/create','1','2013-03-14 18:50:22','2013-03-15 12:51:54');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('14','1','Menu','','Listing all menus ','53','1','/mainMenu/admin','1','2013-03-14 18:51:07','2013-07-29 14:22:50');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('16','1','Categories','','for managing categories','53','3','/categories/admin','1','2013-03-15 12:11:07','2013-07-29 10:57:12');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('20','1','Configuration','','System configurations are managable by this link.','70','4','/config/index','1','2013-03-15 16:16:18','2013-05-16 11:18:03');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('33','1','Manage Pages','','manage pages','72','4','/pageMaster/admin','1','2013-05-02 14:43:55','2013-07-24 17:57:17');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('34','1','Manage Page Locations','','manage page locations','72','5','/pageLocationMapping/admin','1','2013-05-02 14:44:51','2013-07-24 17:56:51');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('53','1','Content','','for managing contents and approvals','0','1','/config/index','1','2013-05-03 16:18:11','2013-07-29 14:21:41');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('58','1','Static Pages','','creating and managing articles','53','2','/staticPages/admin','1','2013-05-04 15:45:34','2013-07-29 14:22:52');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('70','1','System','','user,role, permissions','0','3','#','1','2013-05-16 11:14:13','2013-07-29 14:21:49');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('71','1','List roles','','roles list','10','5','/role/manageRole','1','2013-05-16 11:33:55','2013-07-11 16:56:00');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('72','1','Page','','Page details','0','2','#','1','2013-07-24 17:43:17','2013-07-29 14:21:46');
INSERT INTO `tbl_menus` (`menuID`,`main_menuID`,`menu_name`,`menu_image`,`menu_description`,`parentID`,`sortOrder`,`system_url`,`active`,`created`,`modified`) VALUES
('73','1','Banner','','Banner','53','4','/banner/admin','1','2013-07-25 11:02:01','2013-07-29 14:23:01');



-- -------------------------------------------
-- TABLE DATA tbl_passwordhistory
-- -------------------------------------------
INSERT INTO `tbl_passwordhistory` (`pass_id`,`user_id`,`password`,`created_at`) VALUES
('3','1','e3479f16e3e5acdb66cf5c74f904a0cd','2013-03-06 18:13:10');
INSERT INTO `tbl_passwordhistory` (`pass_id`,`user_id`,`password`,`created_at`) VALUES
('4','1','75d80f7c94267bf1bf4c3c81f0daa98d','2013-06-17 14:53:38');
INSERT INTO `tbl_passwordhistory` (`pass_id`,`user_id`,`password`,`created_at`) VALUES
('8','1','2c45722694bc46fcfc7295eb77ec5790','2013-07-17 17:34:45');
INSERT INTO `tbl_passwordhistory` (`pass_id`,`user_id`,`password`,`created_at`) VALUES
('9','1','e6e061838856bf47e1de730719fb2609','2013-07-23 10:52:41');



-- -------------------------------------------
-- TABLE DATA tbl_profiles
-- -------------------------------------------
INSERT INTO `tbl_profiles` (`user_id`,`lastname`,`firstname`) VALUES
('1','Project Admin','Super Administrator');
INSERT INTO `tbl_profiles` (`user_id`,`lastname`,`firstname`) VALUES
('2','Demo','Demo');
INSERT INTO `tbl_profiles` (`user_id`,`lastname`,`firstname`) VALUES
('3','sony','Idol');
INSERT INTO `tbl_profiles` (`user_id`,`lastname`,`firstname`) VALUES
('4','user','user');



-- -------------------------------------------
-- TABLE DATA tbl_profiles_fields
-- -------------------------------------------
INSERT INTO `tbl_profiles_fields` (`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) VALUES
('1','lastname','Last Name','VARCHAR','50','3','1','','','Incorrect Last Name (length between 3 and 50 characters).','','','','','1','3');
INSERT INTO `tbl_profiles_fields` (`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) VALUES
('2','firstname','First Name','VARCHAR','50','3','1','','','Incorrect First Name (length between 3 and 50 characters).','','','','','0','3');



-- -------------------------------------------
-- TABLE DATA tbl_role
-- -------------------------------------------
INSERT INTO `tbl_role` (`id`,`name`,`description`,`status`,`created`,`modified`) VALUES
('1','Admin','','active','2012-01-19 18:38:46','2013-03-15 14:30:00');
INSERT INTO `tbl_role` (`id`,`name`,`description`,`status`,`created`,`modified`) VALUES
('2','Vendor','','active','2012-01-19 18:42:23','2013-03-15 14:30:06');
INSERT INTO `tbl_role` (`id`,`name`,`description`,`status`,`created`,`modified`) VALUES
('13','user','','active','2013-03-06 19:01:02','2013-07-23 14:04:14');



-- -------------------------------------------
-- TABLE DATA tbl_role_permission
-- -------------------------------------------
INSERT INTO `tbl_role_permission` (`rolePermissionID`,`roleID`,`permissionName`,`created`) VALUES
('1','1','.Admin.Admin,.Admin.View,.Admin.Create,.Admin.Update,.Admin.Delete,.Banner.View,.Banner.Create,.Banner.Update,.Banner.Delete,.Banner.Index,.Banner.Admin,.Banner.Adminrhs,.Categories.View,.Categories.Create,.Categories.Update,.Categories.Delete,.Categories.Index,.Categories.Admin,.Config.View,.Config.Create,.Config.Update,.Config.Delete,.Config.Index,.Config.Admin,.MainMenu.View,.MainMenu.Create,.MainMenu.Update,.MainMenu.Delete,.MainMenu.Index,.MainMenu.Admin,.Menus.View,.Menus.Create,.Menus.Update,.Menus.Delete,.Menus.Index,.Menus.Admin,.Menus.Sort,.Menus.Sortitems,.PageLocationMapping.View,.PageLocationMapping.Create,.PageLocationMapping.Update,.PageLocationMapping.Delete,.PageLocationMapping.Index,.PageLocationMapping.Admin,.PageLocationMapping.LocationListByPage,.PageMaster.View,.PageMaster.Create,.PageMaster.Update,.PageMaster.Delete,.PageMaster.Index,.PageMaster.Admin,.Profile.Profile,.Profile.Edit,.Profile.Changepassword,.ProfileField.View,.ProfileField.Create,.ProfileField.Update,.ProfileField.Delete,.ProfileField.Admin,.Role.Create,.Role.ManageRole,.Role.Delete,.Role.Update,.RolePermission.View,.RolePermission.Create,.RolePermission.Update,.RolePermission.Delete,.RolePermission.Index,.RolePermission.Admin,.Site.Index,.Site.Error,.Site.Login,.Site.Logout,.Site.Clearassets,.Site.Clearcache,.StaticPages.View,.StaticPages.Create,.StaticPages.Update,.StaticPages.Delete,.StaticPages.Admin,.Terms.View,.Terms.Create,.Terms.Update,.Terms.Delete,.Terms.Index,.Terms.Admin,.Terms.Sort,.Terms.Sortitems','2013-03-11 18:14:38');
INSERT INTO `tbl_role_permission` (`rolePermissionID`,`roleID`,`permissionName`,`created`) VALUES
('2','2','','2013-03-11 18:14:38');
INSERT INTO `tbl_role_permission` (`rolePermissionID`,`roleID`,`permissionName`,`created`) VALUES
('3','13','','2013-03-11 18:14:38');



-- -------------------------------------------
-- TABLE DATA tbl_static_pages
-- -------------------------------------------
INSERT INTO `tbl_static_pages` (`staticpage_id`,`category_id`,`title`,`content`,`type`,`attachment`,`slug`,`created_date`,`created_by`,`updated_date`,`updated_by`,`tags`,`status`) VALUES
('4','36','Article title','<p>
	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
','image','8cd772c360c0bef6edd4a7b99b36bbd2.jpg','Array','2013-07-24 16:10:40','1','2013-07-24 16:30:28','1','Lorem Ipsum','1');



-- -------------------------------------------
-- TABLE DATA tbl_terms
-- -------------------------------------------
INSERT INTO `tbl_terms` (`termID`,`categoryID`,`parentID`,`term_name`,`sortOrder`,`created`,`modified`,`slug`) VALUES
('36','11','0','Article-1','0','2013-07-24 12:55:27','2013-07-24 12:55:27','article-1');
INSERT INTO `tbl_terms` (`termID`,`categoryID`,`parentID`,`term_name`,`sortOrder`,`created`,`modified`,`slug`) VALUES
('37','11','0','Article-2','0','2013-07-24 12:55:38','2013-07-24 12:55:38','article-2');
INSERT INTO `tbl_terms` (`termID`,`categoryID`,`parentID`,`term_name`,`sortOrder`,`created`,`modified`,`slug`) VALUES
('38','12','0','FAQ-1','1','2013-07-24 12:56:02','2013-07-29 13:04:01','faq-1');
INSERT INTO `tbl_terms` (`termID`,`categoryID`,`parentID`,`term_name`,`sortOrder`,`created`,`modified`,`slug`) VALUES
('39','12','0','FAQ-2','0','2013-07-24 12:56:13','2013-07-24 12:56:13','faq-2');



-- -------------------------------------------
-- TABLE DATA tbl_users
-- -------------------------------------------
INSERT INTO `tbl_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`,`role`) VALUES
('1','admin','e6e061838856bf47e1de730719fb2609','webmaster@example.com','d24684e06c83f3eac66ed17ac4f5b2d5','2013-03-06 18:12:46','2013-07-29 09:05:23','1','1','1');
INSERT INTO `tbl_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`,`role`) VALUES
('2','demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2013-03-06 18:12:46','0000-00-00 00:00:00','0','1','1,13');
INSERT INTO `tbl_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`,`role`) VALUES
('3','idol','134b8f8409c02ead865b39d3f70a1bc1','idol@setindia.com','ad216f911dff2ed4b208ca59133c349a','2013-04-19 18:50:21','2013-05-08 16:26:11','0','1','13');
INSERT INTO `tbl_users` (`id`,`username`,`password`,`email`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`,`role`) VALUES
('4','user','ee11cbb19052e40b07aac0ca060c23ee','user@user.com','86cc7dfbc661a7bf1ebcdda116bcefa6','2013-05-06 15:20:15','2013-05-13 10:38:41','0','1','13');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
