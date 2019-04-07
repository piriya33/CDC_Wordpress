# WordPress MySQL database migration
#
# Generated: Wednesday 5. July 2017 10:22 UTC
# Hostname: cdc-b.c1lzs9xai3ul.ap-southeast-1.rds.amazonaws.com
# Database: `CDC`
# --------------------------------------------------------

/*!40101 SET NAMES utf8mb4 */;

SET sql_mode='NO_AUTO_VALUE_ON_ZERO';



#
# Delete any existing table `wp_cimy_uef_data`
#

DROP TABLE IF EXISTS `wp_cimy_uef_data`;


#
# Table structure of table `wp_cimy_uef_data`
#

CREATE TABLE `wp_cimy_uef_data` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USER_ID` bigint(20) NOT NULL,
  `FIELD_ID` bigint(20) NOT NULL,
  `VALUE` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `FIELD_ID` (`FIELD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_cimy_uef_data`
#

#
# End of data contents of table `wp_cimy_uef_data`
# --------------------------------------------------------



#
# Delete any existing table `wp_cimy_uef_fields`
#

DROP TABLE IF EXISTS `wp_cimy_uef_fields`;


#
# Table structure of table `wp_cimy_uef_fields`
#

CREATE TABLE `wp_cimy_uef_fields` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `F_ORDER` bigint(20) NOT NULL,
  `FIELDSET` bigint(20) NOT NULL DEFAULT '0',
  `NAME` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LABEL` text COLLATE utf8mb4_unicode_ci,
  `DESCRIPTION` text COLLATE utf8mb4_unicode_ci,
  `TYPE` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RULES` text COLLATE utf8mb4_unicode_ci,
  `VALUE` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ID`),
  KEY `F_ORDER` (`F_ORDER`),
  KEY `NAME` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_cimy_uef_fields`
#

#
# End of data contents of table `wp_cimy_uef_fields`
# --------------------------------------------------------



#
# Delete any existing table `wp_cimy_uef_wp_fields`
#

DROP TABLE IF EXISTS `wp_cimy_uef_wp_fields`;


#
# Table structure of table `wp_cimy_uef_wp_fields`
#

CREATE TABLE `wp_cimy_uef_wp_fields` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `F_ORDER` bigint(20) NOT NULL,
  `NAME` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LABEL` text COLLATE utf8mb4_unicode_ci,
  `DESCRIPTION` text COLLATE utf8mb4_unicode_ci,
  `TYPE` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RULES` text COLLATE utf8mb4_unicode_ci,
  `VALUE` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ID`),
  KEY `F_ORDER` (`F_ORDER`),
  KEY `NAME` (`NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_cimy_uef_wp_fields`
#
INSERT INTO `wp_cimy_uef_wp_fields` ( `ID`, `F_ORDER`, `NAME`, `LABEL`, `DESCRIPTION`, `TYPE`, `RULES`, `VALUE`) VALUES
(1, 4, 'PASSWORD', 'Password', '', 'password', 'a:12:{s:5:"email";b:0;s:11:"email_admin";b:0;s:10:"max_length";i:100;s:12:"can_be_empty";b:0;s:4:"edit";s:7:"ok_edit";s:16:"advanced_options";s:0:"";s:11:"show_in_reg";b:1;s:15:"show_in_profile";b:1;s:11:"show_in_aeu";b:0;s:14:"show_in_search";b:0;s:12:"show_in_blog";b:0;s:10:"show_level";s:2:"-1";}', ''),
(2, 5, 'PASSWORD2', 'Password confirmation', '', 'password', 'a:11:{s:10:"max_length";i:100;s:12:"can_be_empty";b:0;s:4:"edit";s:7:"ok_edit";s:5:"email";b:0;s:11:"show_in_reg";b:1;s:15:"show_in_profile";b:1;s:11:"show_in_aeu";b:0;s:14:"show_in_search";b:0;s:12:"show_in_blog";b:0;s:10:"show_level";i:-1;s:16:"advanced_options";s:0:"";}', ''),
(3, 2, 'FIRSTNAME', 'First name', '', 'text', 'a:12:{s:5:"email";b:0;s:11:"email_admin";b:0;s:10:"max_length";i:100;s:12:"can_be_empty";b:1;s:4:"edit";s:7:"ok_edit";s:16:"advanced_options";s:0:"";s:11:"show_in_reg";b:1;s:15:"show_in_profile";b:1;s:11:"show_in_aeu";b:1;s:14:"show_in_search";b:0;s:12:"show_in_blog";b:0;s:10:"show_level";s:2:"-1";}', ''),
(4, 3, 'LASTNAME', 'Last name', '', 'text', 'a:11:{s:10:"max_length";i:100;s:12:"can_be_empty";b:1;s:4:"edit";s:7:"ok_edit";s:5:"email";b:0;s:11:"show_in_reg";b:1;s:15:"show_in_profile";b:1;s:11:"show_in_aeu";b:1;s:14:"show_in_search";b:0;s:12:"show_in_blog";b:0;s:10:"show_level";i:-1;s:16:"advanced_options";s:0:"";}', '') ;

#
# End of data contents of table `wp_cimy_uef_wp_fields`
# --------------------------------------------------------



#
# Delete any existing table `wp_commentmeta`
#

DROP TABLE IF EXISTS `wp_commentmeta`;


#
# Table structure of table `wp_commentmeta`
#

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_commentmeta`
#
INSERT INTO `wp_commentmeta` ( `meta_id`, `comment_id`, `meta_key`, `meta_value`) VALUES
(1, 2, 'akismet_result', 'false'),
(2, 2, 'akismet_history', 'a:2:{s:4:"time";d:1467389235.2390759;s:5:"event";s:9:"check-ham";}'),
(4, 2, 'akismet_history', 'a:3:{s:4:"time";d:1467459623.5420821;s:5:"event";s:15:"status-approved";s:4:"user";s:9:"cdc-admin";}'),
(19, 70, 'akismet_result', 'false'),
(20, 70, 'akismet_history', 'a:3:{s:4:"time";d:1468326833.3680689;s:5:"event";s:9:"check-ham";s:4:"user";s:9:"cdc-admin";}'),
(22, 77, 'akismet_result', 'true'),
(23, 77, 'akismet_history', 'a:2:{s:4:"time";d:1484030710.4238529;s:5:"event";s:10:"check-spam";}'),
(24, 77, 'akismet_as_submitted', 'a:11:{s:14:"comment_author";s:12:"DerekSaxonru";s:20:"comment_author_email";s:22:"jackiestyles@gmail.com";s:18:"comment_author_url";s:27:"http://instagram.com/Elinor";s:15:"comment_content";s:161:"I see your site needs some unique & fresh content. Writing \r\nmanually is time consuming, but there is tool for this task.\r\nJust search for - Digitalpoilo\'s tools";s:12:"comment_type";s:0:"";s:7:"user_ip";s:13:"46.48.226.207";s:10:"user_agent";s:81:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:35.0) Gecko/20100101 Firefox/35.0";s:4:"blog";s:26:"http://www.cupandhandle.co";s:9:"blog_lang";s:5:"en_US";s:12:"blog_charset";s:5:"UTF-8";s:9:"permalink";s:50:"http://www.cupandhandle.co/2016/06/30/hello-world/";}'),
(25, 81, 'notified', '') ;

#
# End of data contents of table `wp_commentmeta`
# --------------------------------------------------------



#
# Delete any existing table `wp_comments`
#

DROP TABLE IF EXISTS `wp_comments`;


#
# Table structure of table `wp_comments`
#

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10)),
  KEY `woo_idx_comment_type` (`comment_type`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_comments`
#
INSERT INTO `wp_comments` ( `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2016-06-30 09:59:52', '2016-06-30 09:59:52', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0),
(2, 1, 'Yoyo', 'yadamon@gmail.com', '', '180.180.141.163', '2016-07-01 16:07:15', '2016-07-01 16:07:15', 'Hello Hello!', 0, '1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '', 1, 0),
(3, 25, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-02 13:28:08', '2016-07-02 13:28:08', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(5, 25, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-02 13:28:24', '2016-07-02 13:28:24', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(11, 47, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 11:11:51', '2016-07-04 11:11:51', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(25, 47, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-04 11:12:36', '2016-07-04 11:12:36', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(30, 52, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 11:14:25', '2016-07-04 11:14:25', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(31, 52, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-04 11:14:28', '2016-07-04 11:14:28', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(35, 55, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 11:16:22', '2016-07-04 11:16:22', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(37, 55, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-04 11:16:30', '2016-07-04 11:16:30', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(39, 56, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 11:20:07', '2016-07-04 11:20:07', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(41, 56, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-04 11:20:12', '2016-07-04 11:20:12', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(45, 60, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 11:22:11', '2016-07-04 11:22:11', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(47, 60, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-04 11:22:10', '2016-07-04 11:22:10', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(48, 62, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 11:23:05', '2016-07-04 11:23:05', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(50, 62, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2016-07-04 11:23:14', '2016-07-04 11:23:14', 'Order status changed from On Hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(66, 68, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 13:01:57', '2016-07-04 13:01:57', 'Status changed from Pending to On hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(67, 66, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-04 13:01:57', '2016-07-04 13:01:57', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(68, 69, 'WooCommerce', 'woocommerce@cupandhandle.co', '', '', '2016-07-05 05:09:12', '2016-07-05 05:09:12', 'Awaiting BACS payment Order status changed from Pending Payment to On Hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(70, 1, 'cdc-admin', 'chalokedotcom@gmail.com', '', '101.108.250.169', '2016-07-12 12:33:53', '2016-07-12 12:33:53', 'Beep beep', 0, '1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '', 0, 1),
(76, 110, 'ActionScheduler', '', '', '', '2017-01-04 02:40:25', '2017-01-04 02:40:25', 'action created', 0, '1', 'ActionScheduler', 'action_log', 0, 0),
(77, 1, 'DerekSaxonru', 'jackiestyles@gmail.com', 'http://instagram.com/Elinor', '46.48.226.207', '2017-01-10 13:45:10', '2017-01-10 06:45:10', 'I see your site needs some unique &amp; fresh content. Writing \r\nmanually is time consuming, but there is tool for this task.\r\nJust search for - Digitalpoilo\'s tools', 0, 'spam', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:35.0) Gecko/20100101 Firefox/35.0', '', 0, 0),
(78, 190, 'WooCommerce', 'woocommerce@52.76.37.90', '', '', '2017-07-05 00:12:44', '2017-07-04 17:12:44', 'Awaiting BACS payment Order status changed from Pending payment to On hold.', 0, '1', 'WooCommerce', 'order_note', 0, 0),
(79, 192, 'ActionScheduler', '', '', '', '2017-07-05 00:14:02', '2017-07-04 17:14:02', 'action created', 0, '1', 'ActionScheduler', 'action_log', 0, 0),
(80, 193, 'ActionScheduler', '', '', '', '2017-07-05 00:14:02', '2017-07-04 17:14:02', 'action created', 0, '1', 'ActionScheduler', 'action_log', 0, 0),
(81, 191, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2017-07-05 00:14:02', '2017-07-04 17:14:02', 'Membership access granted from purchasing Supporting Membership (จ่ายด้วยเงินสด) (Order 190)', 0, '1', 'WooCommerce', 'user_membership_note', 0, 0),
(82, 190, 'cdc-admin', 'chalokedotcom@gmail.com', '', '', '2017-07-05 00:14:02', '2017-07-04 17:14:02', 'Order status changed from On hold to Completed.', 0, '1', 'WooCommerce', 'order_note', 0, 0) ;

#
# End of data contents of table `wp_comments`
# --------------------------------------------------------



#
# Delete any existing table `wp_cptch_images`
#

DROP TABLE IF EXISTS `wp_cptch_images`;


#
# Table structure of table `wp_cptch_images`
#

CREATE TABLE `wp_cptch_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  `package_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;


#
# Data contents of table `wp_cptch_images`
#
INSERT INTO `wp_cptch_images` ( `id`, `name`, `package_id`, `number`) VALUES
(1, '0.png', 1, 0),
(2, '1.png', 1, 1),
(3, '2.png', 1, 2),
(4, '3.png', 1, 3),
(5, '4.png', 1, 4),
(6, '5.png', 1, 5),
(7, '6.png', 1, 6),
(8, '7.png', 1, 7),
(9, '8.png', 1, 8),
(10, '9.png', 1, 9),
(11, '0.png', 2, 0),
(12, '1.png', 2, 1),
(13, '2.png', 2, 2),
(14, '3.png', 2, 3),
(15, '4.png', 2, 4),
(16, '5.png', 2, 5),
(17, '6.png', 2, 6),
(18, '7.png', 2, 7),
(19, '8.png', 2, 8),
(20, '9.png', 2, 9),
(21, '0.png', 3, 0),
(22, '1.png', 3, 1),
(23, '2.png', 3, 2),
(24, '3.png', 3, 3),
(25, '4.png', 3, 4),
(26, '5.png', 3, 5),
(27, '6.png', 3, 6),
(28, '7.png', 3, 7),
(29, '8.png', 3, 8),
(30, '9.png', 3, 9),
(31, '0.png', 4, 0),
(32, '1.png', 4, 1),
(33, '2.png', 4, 2),
(34, '3.png', 4, 3),
(35, '4.png', 4, 4),
(36, '5.png', 4, 5),
(37, '6.png', 4, 6),
(38, '7.png', 4, 7),
(39, '8.png', 4, 8),
(40, '9.png', 4, 9),
(41, '1.png', 5, 1),
(42, '2.png', 5, 2),
(43, '3.png', 5, 3),
(44, '4.png', 5, 4),
(45, '5.png', 5, 5),
(46, '6.png', 5, 6),
(47, '7.png', 5, 7),
(48, '8.png', 5, 8),
(49, '9.png', 5, 9),
(50, '1.png', 6, 1),
(51, '2.png', 6, 2),
(52, '3.png', 6, 3),
(53, '4.png', 6, 4),
(54, '5.png', 6, 5),
(55, '6.png', 6, 6),
(56, '7.png', 6, 7),
(57, '8.png', 6, 8),
(58, '9.png', 6, 9),
(59, '1.png', 7, 1),
(60, '2.png', 7, 2),
(61, '3.png', 7, 3),
(62, '4.png', 7, 4),
(63, '5.png', 7, 5),
(64, '6.png', 7, 6),
(65, '7.png', 7, 7),
(66, '8.png', 7, 8),
(67, '9.png', 7, 9),
(68, '1.png', 8, 1),
(69, '2.png', 8, 2),
(70, '3.png', 8, 3),
(71, '4.png', 8, 4),
(72, '5.png', 8, 5),
(73, '6.png', 8, 6),
(74, '7.png', 8, 7),
(75, '8.png', 8, 8),
(76, '9.png', 8, 9),
(77, '1.png', 9, 1),
(78, '2.png', 9, 2),
(79, '3.png', 9, 3),
(80, '4.png', 9, 4),
(81, '5.png', 9, 5),
(82, '6.png', 9, 6),
(83, '7.png', 9, 7),
(84, '8.png', 9, 8),
(85, '9.png', 9, 9),
(86, '1.png', 10, 1),
(87, '2.png', 10, 2),
(88, '3.png', 10, 3),
(89, '4.png', 10, 4),
(90, '5.png', 10, 5),
(91, '6.png', 10, 6),
(92, '7.png', 10, 7),
(93, '8.png', 10, 8),
(94, '9.png', 10, 9),
(95, '1.png', 11, 1),
(96, '2.png', 11, 2),
(97, '3.png', 11, 3),
(98, '4.png', 11, 4),
(99, '5.png', 11, 5),
(100, '6.png', 11, 6) ;
INSERT INTO `wp_cptch_images` ( `id`, `name`, `package_id`, `number`) VALUES
(101, '7.png', 11, 7),
(102, '8.png', 11, 8),
(103, '9.png', 11, 9),
(104, '1.png', 12, 1),
(105, '2.png', 12, 2),
(106, '3.png', 12, 3),
(107, '4.png', 12, 4),
(108, '5.png', 12, 5),
(109, '6.png', 12, 6),
(110, '7.png', 12, 7),
(111, '8.png', 12, 8),
(112, '9.png', 12, 9) ;

#
# End of data contents of table `wp_cptch_images`
# --------------------------------------------------------



#
# Delete any existing table `wp_cptch_packages`
#

DROP TABLE IF EXISTS `wp_cptch_packages`;


#
# Table structure of table `wp_cptch_packages`
#

CREATE TABLE `wp_cptch_packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  `folder` char(100) NOT NULL,
  `settings` longtext NOT NULL,
  `user_settings` longtext NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


#
# Data contents of table `wp_cptch_packages`
#
INSERT INTO `wp_cptch_packages` ( `id`, `name`, `folder`, `settings`, `user_settings`, `add_time`) VALUES
(1, 'Arabic ( black numbers - transparent background )', 'arabic_bt', '', '', '2017-07-04 23:46:55'),
(2, 'Arabic ( black numbers - white background )', 'arabic_bw', '', '', '2017-07-04 23:46:55'),
(3, 'Arabic ( white numbers - transparent background )', 'arabic_wt', '', '', '2017-07-04 23:46:55'),
(4, 'Arabic ( white numbers - black background )', 'arabic_wb', '', '', '2017-07-04 23:46:55'),
(5, 'Dots ( black dots - transparent background )', 'dots_bt', '', '', '2017-07-04 23:46:55'),
(6, 'Dots ( black dots - white background )', 'dots_bw', '', '', '2017-07-04 23:46:55'),
(7, 'Dots ( white dots - black background )', 'dots_wb', '', '', '2017-07-04 23:46:55'),
(8, 'Dots ( white dots - transparent background )', 'dots_wt', '', '', '2017-07-04 23:46:55'),
(9, 'Roman ( black numbers - transparent background )', 'roman_bt', '', '', '2017-07-04 23:46:55'),
(10, 'Roman ( black numbers - white background )', 'roman_bw', '', '', '2017-07-04 23:46:55'),
(11, 'Roman ( white numbers - black background )', 'roman_wb', '', '', '2017-07-04 23:46:55'),
(12, 'Roman ( white numbers - transparent background )', 'roman_wt', '', '', '2017-07-04 23:46:55') ;

#
# End of data contents of table `wp_cptch_packages`
# --------------------------------------------------------



#
# Delete any existing table `wp_cptch_whitelist`
#

DROP TABLE IF EXISTS `wp_cptch_whitelist`;


#
# Table structure of table `wp_cptch_whitelist`
#

CREATE TABLE `wp_cptch_whitelist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` char(31) NOT NULL,
  `ip_from_int` bigint(20) DEFAULT NULL,
  `ip_to_int` bigint(20) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#
# Data contents of table `wp_cptch_whitelist`
#

#
# End of data contents of table `wp_cptch_whitelist`
# --------------------------------------------------------



#
# Delete any existing table `wp_links`
#

DROP TABLE IF EXISTS `wp_links`;


#
# Table structure of table `wp_links`
#

CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_links`
#

#
# End of data contents of table `wp_links`
# --------------------------------------------------------



#
# Delete any existing table `wp_options`
#

DROP TABLE IF EXISTS `wp_options`;


#
# Table structure of table `wp_options`
#

CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9671 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_options`
#
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://52.76.37.90/', 'yes'),
(2, 'home', 'http://52.76.37.90/', 'yes'),
(3, 'blogname', 'Chaloke Dot Com', 'yes'),
(4, 'blogdescription', 'เส้นทางสู่การลงทุนอย่างเป็นระบบ', 'yes'),
(5, 'users_can_register', '1', 'yes'),
(6, 'admin_email', 'chalokedotcom@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '1', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'd/m/Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:32:{i:0;s:19:"akismet/akismet.php";i:1;s:61:"amazon-s3-and-cloudfront-pro/amazon-s3-and-cloudfront-pro.php";i:2;s:77:"amazon-s3-and-cloudfront-woocommerce/amazon-s3-and-cloudfront-woocommerce.php";i:3;s:43:"amazon-web-services/amazon-web-services.php";i:4;s:19:"bbpress/bbpress.php";i:5;s:43:"better-font-awesome/better-font-awesome.php";i:6;s:19:"captcha/captcha.php";i:7;s:49:"cimy-user-extra-fields/cimy_user_extra_fields.php";i:8;s:39:"cimy-user-manager/cimy_user_manager.php";i:9;s:49:"gd-bbpress-attachments/gd-bbpress-attachments.php";i:10;s:37:"gd-bbpress-tools/gd-bbpress-tools.php";i:11;s:43:"my-custom-functions/my-custom-functions.php";i:12;s:27:"redis-cache/redis-cache.php";i:13;s:41:"soliloquy-defaults/soliloquy-defaults.php";i:14;s:57:"soliloquy-featured-content/soliloquy-featured-content.php";i:15;s:37:"soliloquy-themes/soliloquy-themes.php";i:16;s:45:"soliloquy-thumbnails/soliloquy-thumbnails.php";i:17;s:23:"soliloquy/soliloquy.php";i:18;s:57:"storefront-blog-customiser/storefront-blog-customiser.php";i:19;s:43:"storefront-designer/storefront-designer.php";i:20;s:45:"storefront-powerpack/storefront-powerpack.php";i:21;s:52:"theme-customisations-master/theme-customisations.php";i:22;s:29:"ticker-ultimate/wp-ticker.php";i:23;s:37:"tinymce-advanced/tinymce-advanced.php";i:24;s:33:"w3-total-cache/w3-total-cache.php";i:25;s:51:"woocommerce-memberships/woocommerce-memberships.php";i:26;s:55:"woocommerce-subscriptions/woocommerce-subscriptions.php";i:27;s:27:"woocommerce/woocommerce.php";i:28;s:65:"wp-featured-content-and-slider/wp-featured-content-and-slider.php";i:29;s:63:"wp-migrate-db-pro-media-files/wp-migrate-db-pro-media-files.php";i:30;s:39:"wp-migrate-db-pro/wp-migrate-db-pro.php";i:31;s:33:"wp-user-avatar/wp-user-avatar.php";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '7', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', 'a:5:{i:0;s:83:"/var/www/staging/wp-content/plugins/really-simple-captcha/really-simple-captcha.php";i:1;s:51:"/var/www/staging/wp-content/themes/sf_cdc/style.css";i:2;s:59:"/var/www/staging/wp-content/themes/storefront/functions.php";i:3;s:55:"/var/www/staging/wp-content/themes/storefront/style.css";i:4;s:93:"/var/www/staging/wp-content/plugins/storefront-blog-customiser/storefront-blog-customiser.php";}', 'no'),
(40, 'template', 'storefront', 'yes'),
(41, 'stylesheet', 'storefront', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '500', 'yes'),
(62, 'medium_size_h', '1024', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '2048', 'yes'),
(66, 'image_default_link_type', '', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(79, 'widget_text', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(80, 'widget_rss', 'a:3:{i:1;a:0:{}s:12:"_multiwidget";i:1;i:3;a:0:{}}', 'yes'),
(81, 'uninstall_plugins', 'a:4:{s:23:"soliloquy/soliloquy.php";s:24:"soliloquy_uninstall_hook";s:43:"my-custom-functions/my-custom-functions.php";s:21:"MCFunctions_uninstall";s:41:"my-custom-functions/inc/php/uninstall.php";s:21:"MCFunctions_uninstall";s:19:"captcha/captcha.php";s:20:"cptch_delete_options";}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '11', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'initial_db_version', '36686', 'yes'),
(92, 'wp_user_roles', 'a:12:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:160:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:18:"manage_woocommerce";b:1;s:24:"view_woocommerce_reports";b:1;s:12:"edit_product";b:1;s:12:"read_product";b:1;s:14:"delete_product";b:1;s:13:"edit_products";b:1;s:20:"edit_others_products";b:1;s:16:"publish_products";b:1;s:21:"read_private_products";b:1;s:15:"delete_products";b:1;s:23:"delete_private_products";b:1;s:25:"delete_published_products";b:1;s:22:"delete_others_products";b:1;s:21:"edit_private_products";b:1;s:23:"edit_published_products";b:1;s:20:"manage_product_terms";b:1;s:18:"edit_product_terms";b:1;s:20:"delete_product_terms";b:1;s:20:"assign_product_terms";b:1;s:15:"edit_shop_order";b:1;s:15:"read_shop_order";b:1;s:17:"delete_shop_order";b:1;s:16:"edit_shop_orders";b:1;s:23:"edit_others_shop_orders";b:1;s:19:"publish_shop_orders";b:1;s:24:"read_private_shop_orders";b:1;s:18:"delete_shop_orders";b:1;s:26:"delete_private_shop_orders";b:1;s:28:"delete_published_shop_orders";b:1;s:25:"delete_others_shop_orders";b:1;s:24:"edit_private_shop_orders";b:1;s:26:"edit_published_shop_orders";b:1;s:23:"manage_shop_order_terms";b:1;s:21:"edit_shop_order_terms";b:1;s:23:"delete_shop_order_terms";b:1;s:23:"assign_shop_order_terms";b:1;s:16:"edit_shop_coupon";b:1;s:16:"read_shop_coupon";b:1;s:18:"delete_shop_coupon";b:1;s:17:"edit_shop_coupons";b:1;s:24:"edit_others_shop_coupons";b:1;s:20:"publish_shop_coupons";b:1;s:25:"read_private_shop_coupons";b:1;s:19:"delete_shop_coupons";b:1;s:27:"delete_private_shop_coupons";b:1;s:29:"delete_published_shop_coupons";b:1;s:26:"delete_others_shop_coupons";b:1;s:25:"edit_private_shop_coupons";b:1;s:27:"edit_published_shop_coupons";b:1;s:24:"manage_shop_coupon_terms";b:1;s:22:"edit_shop_coupon_terms";b:1;s:24:"delete_shop_coupon_terms";b:1;s:24:"assign_shop_coupon_terms";b:1;s:17:"edit_shop_webhook";b:1;s:17:"read_shop_webhook";b:1;s:19:"delete_shop_webhook";b:1;s:18:"edit_shop_webhooks";b:1;s:25:"edit_others_shop_webhooks";b:1;s:21:"publish_shop_webhooks";b:1;s:26:"read_private_shop_webhooks";b:1;s:20:"delete_shop_webhooks";b:1;s:28:"delete_private_shop_webhooks";b:1;s:30:"delete_published_shop_webhooks";b:1;s:27:"delete_others_shop_webhooks";b:1;s:26:"edit_private_shop_webhooks";b:1;s:28:"edit_published_shop_webhooks";b:1;s:25:"manage_shop_webhook_terms";b:1;s:23:"edit_shop_webhook_terms";b:1;s:25:"delete_shop_webhook_terms";b:1;s:25:"assign_shop_webhook_terms";b:1;s:20:"edit_membership_plan";b:1;s:20:"read_membership_plan";b:1;s:22:"delete_membership_plan";b:1;s:21:"edit_membership_plans";b:1;s:28:"edit_others_membership_plans";b:1;s:24:"publish_membership_plans";b:1;s:29:"read_private_membership_plans";b:1;s:23:"delete_membership_plans";b:1;s:31:"delete_private_membership_plans";b:1;s:33:"delete_published_membership_plans";b:1;s:30:"delete_others_membership_plans";b:1;s:29:"edit_private_membership_plans";b:1;s:31:"edit_published_membership_plans";b:1;s:20:"edit_user_membership";b:1;s:20:"read_user_membership";b:1;s:22:"delete_user_membership";b:1;s:21:"edit_user_memberships";b:1;s:28:"edit_others_user_memberships";b:1;s:24:"publish_user_memberships";b:1;s:29:"read_private_user_memberships";b:1;s:23:"delete_user_memberships";b:1;s:31:"delete_private_user_memberships";b:1;s:33:"delete_published_user_memberships";b:1;s:30:"delete_others_user_memberships";b:1;s:29:"edit_private_user_memberships";b:1;s:31:"edit_published_user_memberships";b:1;s:35:"manage_woocommerce_membership_plans";b:1;s:35:"manage_woocommerce_user_memberships";b:1;s:22:"view_cimy_extra_fields";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:3:{s:4:"read";b:1;s:7:"level_0";b:1;s:10:"edit_posts";b:1;}}s:8:"customer";a:2:{s:4:"name";s:8:"Customer";s:12:"capabilities";a:1:{s:4:"read";b:1;}}s:12:"shop_manager";a:2:{s:4:"name";s:12:"Shop Manager";s:12:"capabilities";a:138:{s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:4:"read";b:1;s:18:"read_private_pages";b:1;s:18:"read_private_posts";b:1;s:10:"edit_users";b:1;s:10:"edit_posts";b:1;s:10:"edit_pages";b:1;s:20:"edit_published_posts";b:1;s:20:"edit_published_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"edit_private_posts";b:1;s:17:"edit_others_posts";b:1;s:17:"edit_others_pages";b:1;s:13:"publish_posts";b:1;s:13:"publish_pages";b:1;s:12:"delete_posts";b:1;s:12:"delete_pages";b:1;s:20:"delete_private_pages";b:1;s:20:"delete_private_posts";b:1;s:22:"delete_published_pages";b:1;s:22:"delete_published_posts";b:1;s:19:"delete_others_posts";b:1;s:19:"delete_others_pages";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:17:"moderate_comments";b:1;s:15:"unfiltered_html";b:1;s:12:"upload_files";b:1;s:6:"export";b:1;s:6:"import";b:1;s:10:"list_users";b:1;s:18:"manage_woocommerce";b:1;s:24:"view_woocommerce_reports";b:1;s:12:"edit_product";b:1;s:12:"read_product";b:1;s:14:"delete_product";b:1;s:13:"edit_products";b:1;s:20:"edit_others_products";b:1;s:16:"publish_products";b:1;s:21:"read_private_products";b:1;s:15:"delete_products";b:1;s:23:"delete_private_products";b:1;s:25:"delete_published_products";b:1;s:22:"delete_others_products";b:1;s:21:"edit_private_products";b:1;s:23:"edit_published_products";b:1;s:20:"manage_product_terms";b:1;s:18:"edit_product_terms";b:1;s:20:"delete_product_terms";b:1;s:20:"assign_product_terms";b:1;s:15:"edit_shop_order";b:1;s:15:"read_shop_order";b:1;s:17:"delete_shop_order";b:1;s:16:"edit_shop_orders";b:1;s:23:"edit_others_shop_orders";b:1;s:19:"publish_shop_orders";b:1;s:24:"read_private_shop_orders";b:1;s:18:"delete_shop_orders";b:1;s:26:"delete_private_shop_orders";b:1;s:28:"delete_published_shop_orders";b:1;s:25:"delete_others_shop_orders";b:1;s:24:"edit_private_shop_orders";b:1;s:26:"edit_published_shop_orders";b:1;s:23:"manage_shop_order_terms";b:1;s:21:"edit_shop_order_terms";b:1;s:23:"delete_shop_order_terms";b:1;s:23:"assign_shop_order_terms";b:1;s:16:"edit_shop_coupon";b:1;s:16:"read_shop_coupon";b:1;s:18:"delete_shop_coupon";b:1;s:17:"edit_shop_coupons";b:1;s:24:"edit_others_shop_coupons";b:1;s:20:"publish_shop_coupons";b:1;s:25:"read_private_shop_coupons";b:1;s:19:"delete_shop_coupons";b:1;s:27:"delete_private_shop_coupons";b:1;s:29:"delete_published_shop_coupons";b:1;s:26:"delete_others_shop_coupons";b:1;s:25:"edit_private_shop_coupons";b:1;s:27:"edit_published_shop_coupons";b:1;s:24:"manage_shop_coupon_terms";b:1;s:22:"edit_shop_coupon_terms";b:1;s:24:"delete_shop_coupon_terms";b:1;s:24:"assign_shop_coupon_terms";b:1;s:17:"edit_shop_webhook";b:1;s:17:"read_shop_webhook";b:1;s:19:"delete_shop_webhook";b:1;s:18:"edit_shop_webhooks";b:1;s:25:"edit_others_shop_webhooks";b:1;s:21:"publish_shop_webhooks";b:1;s:26:"read_private_shop_webhooks";b:1;s:20:"delete_shop_webhooks";b:1;s:28:"delete_private_shop_webhooks";b:1;s:30:"delete_published_shop_webhooks";b:1;s:27:"delete_others_shop_webhooks";b:1;s:26:"edit_private_shop_webhooks";b:1;s:28:"edit_published_shop_webhooks";b:1;s:25:"manage_shop_webhook_terms";b:1;s:23:"edit_shop_webhook_terms";b:1;s:25:"delete_shop_webhook_terms";b:1;s:25:"assign_shop_webhook_terms";b:1;s:20:"edit_membership_plan";b:1;s:20:"read_membership_plan";b:1;s:22:"delete_membership_plan";b:1;s:21:"edit_membership_plans";b:1;s:28:"edit_others_membership_plans";b:1;s:24:"publish_membership_plans";b:1;s:29:"read_private_membership_plans";b:1;s:23:"delete_membership_plans";b:1;s:31:"delete_private_membership_plans";b:1;s:33:"delete_published_membership_plans";b:1;s:30:"delete_others_membership_plans";b:1;s:29:"edit_private_membership_plans";b:1;s:31:"edit_published_membership_plans";b:1;s:20:"edit_user_membership";b:1;s:20:"read_user_membership";b:1;s:22:"delete_user_membership";b:1;s:21:"edit_user_memberships";b:1;s:28:"edit_others_user_memberships";b:1;s:24:"publish_user_memberships";b:1;s:29:"read_private_user_memberships";b:1;s:23:"delete_user_memberships";b:1;s:31:"delete_private_user_memberships";b:1;s:33:"delete_published_user_memberships";b:1;s:30:"delete_others_user_memberships";b:1;s:29:"edit_private_user_memberships";b:1;s:31:"edit_published_user_memberships";b:1;s:35:"manage_woocommerce_membership_plans";b:1;s:35:"manage_woocommerce_user_memberships";b:1;}}s:13:"bbp_keymaster";a:2:{s:4:"name";s:9:"Keymaster";s:12:"capabilities";a:0:{}}s:13:"bbp_spectator";a:2:{s:4:"name";s:9:"Spectator";s:12:"capabilities";a:0:{}}s:11:"bbp_blocked";a:2:{s:4:"name";s:7:"Blocked";s:12:"capabilities";a:0:{}}s:13:"bbp_moderator";a:2:{s:4:"name";s:9:"Moderator";s:12:"capabilities";a:0:{}}s:15:"bbp_participant";a:2:{s:4:"name";s:11:"Participant";s:12:"capabilities";a:0:{}}}', 'yes'),
(93, 'widget_search', 'a:3:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;i:4;a:0:{}}', 'yes'),
(94, 'widget_recent-posts', 'a:2:{i:4;a:3:{s:5:"title";s:0:"";s:6:"number";i:5;s:9:"show_date";b:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(96, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 'sidebars_widgets', 'a:8:{s:19:"wp_inactive_widgets";a:14:{i:0;s:24:"wp_user_avatar_profile-3";i:1;s:7:"pages-3";i:2;s:7:"pages-4";i:3;s:10:"calendar-3";i:4;s:10:"calendar-4";i:5;s:6:"meta-2";i:6;s:8:"search-2";i:7;s:12:"categories-2";i:8;s:14:"recent-posts-4";i:9;s:17:"recent-comments-2";i:10;s:5:"rss-3";i:11;s:18:"bbp_login_widget-3";i:12;s:18:"bbp_login_widget-4";i:13;s:20:"bbp_replies_widget-3";}s:9:"sidebar-1";a:3:{i:0;s:8:"search-4";i:1;s:19:"bbp_topics_widget-6";i:2;s:10:"archives-2";}s:8:"header-1";a:0:{}s:8:"footer-1";a:1:{i:0;s:19:"bbp_forums_widget-3";}s:8:"footer-2";a:1:{i:0;s:19:"bbp_topics_widget-4";}s:8:"footer-3";a:1:{i:0;s:19:"bbp_topics_widget-3";}s:8:"footer-4";a:1:{i:0;s:19:"bbp_topics_widget-5";}s:13:"array_version";i:3;}', 'yes'),
(99, 'widget_pages', 'a:3:{s:12:"_multiwidget";i:1;i:3;a:0:{}i:4;a:0:{}}', 'yes'),
(100, 'widget_calendar', 'a:3:{s:12:"_multiwidget";i:1;i:3;a:0:{}i:4;a:0:{}}', 'yes'),
(101, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(102, 'widget_nav_menu', 'a:2:{s:12:"_multiwidget";i:1;i:3;a:2:{s:5:"title";s:9:"User Menu";s:8:"nav_menu";i:7;}}', 'yes'),
(103, 'cron', 'a:15:{i:1484043617;a:1:{s:26:"action_scheduler_run_queue";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:12:"every_minute";s:4:"args";a:0:{}s:8:"interval";i:60;}}}i:1484054442;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1484064435;a:1:{s:24:"akismet_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1484085592;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1484128515;a:1:{s:24:"jp_purge_transients_cron";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1484128810;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1498737159;a:2:{s:28:"woocommerce_cleanup_sessions";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:30:"woocommerce_tracker_send_event";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1498737218;a:1:{s:33:"as3cf_cron_update_replace_s3_urls";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:37:"as3cf_update_replace_s3_urls_interval";s:4:"args";a:0:{}s:8:"interval";i:120;}}}i:1498744584;a:1:{s:8:"do_pings";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:2:{s:8:"schedule";b:0;s:4:"args";a:0:{}}}}i:1498755600;a:1:{s:27:"woocommerce_scheduled_sales";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1499126400;a:1:{s:25:"woocommerce_geoip_updater";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:7:"monthly";s:4:"args";a:0:{}s:8:"interval";i:2635200;}}}i:1499188742;a:1:{s:23:"wcs_report_update_cache";a:1:{s:32:"d05129af466414caa8ce1b1a0a9158f2";a:2:{s:8:"schedule";b:0;s:4:"args";a:1:{s:12:"report_class";s:33:"WC_Report_Subscription_By_Product";}}}}i:1499341959;a:1:{s:32:"woocommerce_cancel_unpaid_orders";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:2:{s:8:"schedule";b:0;s:4:"args";a:0:{}}}}i:1530703330;a:1:{s:37:"wc_memberships_user_membership_expiry";a:1:{s:32:"3e5b9d87ec9acb6b0f0f88eb6019ab77";a:2:{s:8:"schedule";b:0;s:4:"args";a:1:{i:0;i:61;}}}}s:7:"version";i:2;}', 'yes'),
(107, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:57:"https://downloads.wordpress.org/release/wordpress-4.7.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:57:"https://downloads.wordpress.org/release/wordpress-4.7.zip";s:10:"no_content";s:68:"https://downloads.wordpress.org/release/wordpress-4.7-no-content.zip";s:11:"new_bundled";s:69:"https://downloads.wordpress.org/release/wordpress-4.7-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:3:"4.7";s:7:"version";s:3:"4.7";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.7";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1484042407;s:15:"version_checked";s:3:"4.7";s:12:"translations";a:0:{}}', 'no'),
(112, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1484042413;s:7:"checked";a:5:{s:6:"sf_cdc";s:3:"1.0";s:10:"storefront";s:5:"2.1.6";s:13:"twentyfifteen";s:3:"1.7";s:14:"twentyfourteen";s:3:"1.9";s:13:"twentysixteen";s:3:"1.3";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'no'),
(133, '_transient_is_multi_author', '0', 'yes'),
(138, 'recently_activated', 'a:1:{s:47:"really-simple-captcha/really-simple-captcha.php";i:1499186440;}', 'yes'),
(144, 'tantan_wordpress_s3', 'a:14:{s:17:"post_meta_version";i:3;s:6:"bucket";s:13:"cdc-wordpress";s:6:"region";s:14:"ap-southeast-1";s:6:"domain";s:4:"path";s:10:"cloudfront";s:0:"";s:13:"object-prefix";s:19:"wp-content/uploads/";s:10:"copy-to-s3";s:1:"1";s:13:"serve-from-s3";s:1:"1";s:17:"remove-local-file";s:1:"0";s:11:"force-https";s:1:"0";s:17:"object-versioning";s:1:"1";s:21:"use-yearmonth-folders";s:1:"1";s:20:"enable-object-prefix";s:1:"1";s:7:"licence";s:36:"fde045f0-6e03-4a1d-95e9-f3e18d11f889";}', 'yes'),
(145, 'widget_akismet_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(146, 'wordpress_api_key', '7d505e9b50d1', 'yes'),
(147, 'akismet_strictness', '0', 'yes'),
(152, 'woocommerce_default_country', 'TH:TH-13', 'yes'),
(153, 'woocommerce_allowed_countries', 'all', 'yes'),
(154, 'woocommerce_all_except_countries', 'a:0:{}', 'yes'),
(155, 'woocommerce_specific_allowed_countries', 'a:0:{}', 'yes'),
(156, 'woocommerce_ship_to_countries', 'specific', 'yes'),
(157, 'woocommerce_specific_ship_to_countries', 'a:1:{i:0;s:2:"TH";}', 'yes'),
(158, 'woocommerce_default_customer_address', 'geolocation', 'yes'),
(159, 'woocommerce_calc_taxes', 'yes', 'yes'),
(160, 'woocommerce_demo_store', 'no', 'yes'),
(161, 'woocommerce_demo_store_notice', 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'no'),
(162, 'woocommerce_currency', 'THB', 'yes'),
(163, 'woocommerce_currency_pos', 'left', 'yes'),
(164, 'woocommerce_price_thousand_sep', ',', 'yes'),
(165, 'woocommerce_price_decimal_sep', '.', 'yes'),
(166, 'woocommerce_price_num_decimals', '2', 'yes'),
(167, 'woocommerce_weight_unit', 'g', 'yes'),
(168, 'woocommerce_dimension_unit', 'mm', 'yes'),
(169, 'woocommerce_enable_review_rating', 'yes', 'yes'),
(170, 'woocommerce_review_rating_required', 'yes', 'no'),
(171, 'woocommerce_review_rating_verification_label', 'yes', 'no'),
(172, 'woocommerce_review_rating_verification_required', 'no', 'no'),
(173, 'woocommerce_shop_page_id', '4', 'yes'),
(174, 'woocommerce_shop_page_display', '', 'yes'),
(175, 'woocommerce_category_archive_display', '', 'yes'),
(176, 'woocommerce_default_catalog_orderby', 'menu_order', 'yes'),
(177, 'woocommerce_cart_redirect_after_add', 'no', 'yes'),
(178, 'woocommerce_enable_ajax_add_to_cart', 'yes', 'yes'),
(179, 'shop_catalog_image_size', 'a:3:{s:5:"width";s:3:"300";s:6:"height";s:3:"300";s:4:"crop";i:1;}', 'yes'),
(180, 'shop_single_image_size', 'a:3:{s:5:"width";s:3:"600";s:6:"height";s:3:"600";s:4:"crop";i:1;}', 'yes'),
(181, 'shop_thumbnail_image_size', 'a:3:{s:5:"width";s:3:"180";s:6:"height";s:3:"180";s:4:"crop";i:1;}', 'yes'),
(182, 'woocommerce_enable_lightbox', 'yes', 'yes'),
(183, 'woocommerce_manage_stock', 'yes', 'yes'),
(184, 'woocommerce_hold_stock_minutes', '10080', 'no'),
(185, 'woocommerce_notify_low_stock', 'yes', 'no'),
(186, 'woocommerce_notify_no_stock', 'yes', 'no'),
(187, 'woocommerce_stock_email_recipient', 'chalokedotcom@gmail.com', 'no'),
(188, 'woocommerce_notify_low_stock_amount', '2', 'no'),
(189, 'woocommerce_notify_no_stock_amount', '0', 'yes'),
(190, 'woocommerce_hide_out_of_stock_items', 'no', 'yes'),
(191, 'woocommerce_stock_format', '', 'yes'),
(192, 'woocommerce_file_download_method', 'force', 'no'),
(193, 'woocommerce_downloads_require_login', 'no', 'no'),
(194, 'woocommerce_downloads_grant_access_after_payment', 'yes', 'no'),
(195, 'woocommerce_prices_include_tax', 'yes', 'yes'),
(196, 'woocommerce_tax_based_on', 'shipping', 'yes'),
(197, 'woocommerce_shipping_tax_class', '', 'yes'),
(198, 'woocommerce_tax_round_at_subtotal', 'no', 'yes'),
(199, 'woocommerce_tax_classes', 'Reduced Rate\r\nZero Rate', 'yes'),
(200, 'woocommerce_tax_display_shop', 'incl', 'yes'),
(201, 'woocommerce_tax_display_cart', 'excl', 'no'),
(202, 'woocommerce_price_display_suffix', '', 'yes'),
(203, 'woocommerce_tax_total_display', 'itemized', 'no'),
(204, 'woocommerce_enable_shipping_calc', 'yes', 'no'),
(205, 'woocommerce_shipping_cost_requires_address', 'no', 'no'),
(206, 'woocommerce_ship_to_destination', 'billing', 'no'),
(207, 'woocommerce_enable_coupons', 'yes', 'yes'),
(208, 'woocommerce_calc_discounts_sequentially', 'no', 'no'),
(209, 'woocommerce_enable_guest_checkout', 'yes', 'no'),
(210, 'woocommerce_force_ssl_checkout', 'no', 'yes'),
(211, 'woocommerce_unforce_ssl_checkout', 'no', 'yes'),
(212, 'woocommerce_cart_page_id', '5', 'yes'),
(213, 'woocommerce_checkout_page_id', '6', 'yes'),
(214, 'woocommerce_terms_page_id', '', 'no'),
(215, 'woocommerce_checkout_pay_endpoint', 'order-pay', 'yes'),
(216, 'woocommerce_checkout_order_received_endpoint', 'order-received', 'yes'),
(217, 'woocommerce_myaccount_add_payment_method_endpoint', 'add-payment-method', 'yes'),
(218, 'woocommerce_myaccount_delete_payment_method_endpoint', 'delete-payment-method', 'yes'),
(219, 'woocommerce_myaccount_set_default_payment_method_endpoint', 'set-default-payment-method', 'yes'),
(220, 'woocommerce_myaccount_page_id', '7', 'yes'),
(221, 'woocommerce_enable_signup_and_login_from_checkout', 'yes', 'no'),
(222, 'woocommerce_enable_myaccount_registration', 'no', 'no'),
(223, 'woocommerce_enable_checkout_login_reminder', 'yes', 'no'),
(224, 'woocommerce_registration_generate_username', 'no', 'no'),
(225, 'woocommerce_registration_generate_password', 'no', 'no'),
(226, 'woocommerce_myaccount_orders_endpoint', 'orders', 'yes'),
(227, 'woocommerce_myaccount_view_order_endpoint', 'view-order', 'yes'),
(228, 'woocommerce_myaccount_downloads_endpoint', 'downloads', 'yes'),
(229, 'woocommerce_myaccount_edit_account_endpoint', 'edit-account', 'yes'),
(230, 'woocommerce_myaccount_edit_address_endpoint', 'edit-address', 'yes'),
(231, 'woocommerce_myaccount_payment_methods_endpoint', 'payment-methods', 'yes'),
(232, 'woocommerce_myaccount_lost_password_endpoint', 'lost-password', 'yes'),
(233, 'woocommerce_logout_endpoint', 'customer-logout', 'yes'),
(234, 'woocommerce_email_from_name', 'Chaloke Dot Com', 'no'),
(235, 'woocommerce_email_from_address', 'chalokedotcom@gmail.com', 'no'),
(236, 'woocommerce_email_header_image', '', 'no'),
(237, 'woocommerce_email_footer_text', 'Chaloke Dot Com - Powered by WooCommerce', 'no'),
(238, 'woocommerce_email_base_color', '#557da1', 'no'),
(239, 'woocommerce_email_background_color', '#f5f5f5', 'no'),
(240, 'woocommerce_email_body_background_color', '#fdfdfd', 'no'),
(241, 'woocommerce_email_text_color', '#505050', 'no') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(242, 'woocommerce_api_enabled', 'yes', 'yes'),
(245, 'woocommerce_admin_notices', 'a:1:{i:0;s:6:"update";}', 'yes'),
(246, 'widget_woocommerce_widget_cart', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(247, 'widget_woocommerce_layered_nav_filters', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(248, 'widget_woocommerce_layered_nav', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(249, 'widget_woocommerce_price_filter', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(250, 'widget_woocommerce_product_categories', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(251, 'widget_woocommerce_product_search', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(252, 'widget_woocommerce_product_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(253, 'widget_woocommerce_products', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(254, 'widget_woocommerce_rating_filter', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(255, 'widget_woocommerce_recent_reviews', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(256, 'widget_woocommerce_recently_viewed_products', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(257, 'widget_woocommerce_top_rated_products', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(258, 'woocommerce_meta_box_errors', 'a:0:{}', 'yes'),
(260, 'woocommerce_paypal-ec_settings', 'a:1:{s:7:"enabled";s:2:"no";}', 'yes'),
(261, 'woocommerce_stripe_settings', 'a:1:{s:7:"enabled";s:3:"yes";}', 'yes'),
(262, 'woocommerce_paypal_settings', 'a:3:{s:7:"enabled";s:2:"no";s:5:"email";s:23:"chalokedotcom@gmail.com";s:5:"debug";s:3:"yes";}', 'yes'),
(263, 'woocommerce_cheque_settings', 'a:1:{s:7:"enabled";s:2:"no";}', 'yes'),
(264, 'woocommerce_bacs_settings', 'a:5:{s:7:"enabled";s:3:"yes";s:5:"title";s:20:"Direct Bank Transfer";s:11:"description";s:548:"ชำระเงินโดยการโอนเงินเข้าบัญชีธนาคารของโฉลกดอทคอมโดยตรง กรุณาใช้ตัวเลขคำสั่งซื้อ (Order ID.) \r\nเพื่อการยืนยันคำสั่งซื้อ คำสั่งซื้อของท่านจะต้องรอการตรวจสอบโดยเจ้าหน้าที่ก่อนที่จะได้รับการอนุมัติ";s:12:"instructions";s:173:"Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won\'t be shipped until the funds have cleared in our account.";s:15:"account_details";s:0:"";}', 'yes'),
(265, 'woocommerce_cod_settings', 'a:1:{s:7:"enabled";s:2:"no";}', 'yes'),
(266, 'woocommerce_allow_tracking', 'yes', 'yes'),
(267, 'woocommerce_tracker_last_send', '1483453143', 'yes'),
(270, 'wc_memberships_redirect_page_id', '9', 'yes'),
(271, 'wc_memberships_restriction_mode', 'redirect', 'yes'),
(272, 'wc_memberships_show_excerpts', 'yes', 'yes'),
(273, 'wc_memberships_display_member_login_notice', 'both', 'yes'),
(274, 'wc_memberships_content_restricted_message', 'คุณกำลังเข้าสู่ส่วนของสมาชิกสนับสนุน กรุณา <a href="{login_url}">log in</a> หรือสมัคร {products} เพื่อดำเนินการต่อ', 'yes'),
(275, 'wc_memberships_content_restricted_message_no_products', 'คุณกำลังเข้าสู่ส่วนของสมาชิกสนับสนุน กรุณา <a href="{login_url}">log in</a> หรือสมัคร {products} เพื่อดำเนินการต่อ', 'yes'),
(276, 'wc_memberships_allow_cumulative_access_granting_orders', 'yes', 'yes'),
(277, 'wc_memberships_hide_restricted_products', 'no', 'yes'),
(278, 'wc_memberships_product_viewing_restricted_message', 'This product can only be viewed by members. To view or purchase this product, sign up by purchasing {products}, or <a href="{login_url}">log in</a> if you are a member.', 'yes'),
(279, 'wc_memberships_product_viewing_restricted_message_no_products', 'This product can only be viewed by members.', 'yes'),
(280, 'wc_memberships_product_purchasing_restricted_message', 'This product can only be purchased by members. To purchase this product, sign up by purchasing {products}, or <a href="{login_url}">log in</a> if you are a member.', 'yes'),
(281, 'wc_memberships_product_purchasing_restricted_message_no_products', 'This product can only be purchased by members.', 'yes'),
(282, 'wc_memberships_product_discount_message', 'Want a discount? Become a member by purchasing {products}, or <a href="{login_url}">log in</a> if you are a member.', 'yes'),
(283, 'wc_memberships_product_discount_message_no_products', 'Want a discount? Become a member.', 'yes'),
(284, 'wc_memberships_version', '1.8.5', 'yes'),
(285, 'wc_memberships_is_active', '1', 'yes'),
(286, 'woothemes-updater-activated', 'a:5:{s:57:"storefront-blog-customiser/storefront-blog-customiser.php";a:2:{i:3;s:15:"Please activate";i:4;b:0;}s:43:"storefront-designer/storefront-designer.php";a:5:{i:0;s:6:"518358";i:1;s:32:"40c9040f4cd8d35668e9c82c6cdbe001";i:2;s:32:"ef64489d051b1df6dd0670438cf02c4d";i:3;s:19:"2017-07-12 00:00:00";i:4;b:1;}s:51:"woocommerce-memberships/woocommerce-memberships.php";a:5:{i:0;s:6:"958589";i:1;s:32:"9288e7609ad0b487b81ef6232efa5cfc";i:2;s:32:"8e8fb912c76dbdd89967a53dee54b004";i:3;s:19:"2017-07-02 00:00:00";i:4;b:1;}s:55:"woocommerce-subscriptions/woocommerce-subscriptions.php";a:5:{i:0;s:5:"27147";i:1;s:32:"6115e6d7e297b623a169fdcf5728b224";i:2;s:32:"ec29f50f41615562bc4e8155879dfbd4";i:3;s:19:"2017-07-04 00:00:00";i:4;b:1;}s:45:"storefront-powerpack/storefront-powerpack.php";a:2:{i:3;s:15:"Please activate";i:4;b:0;}}', 'yes'),
(287, 'wc_memberships_member_login_message', 'สมาชิกสนับสนุนโปรด <a href="{login_url}">log in</a> เพื่อรับส่วนลดอัตโนมัติ', 'yes'),
(288, 'theme_mods_twentysixteen', 'a:6:{s:18:"nav_menu_locations";a:3:{s:7:"primary";i:6;s:8:"handheld";i:6;s:9:"secondary";i:7;}s:18:"custom_css_post_id";i:-1;s:11:"custom_logo";s:0:"";s:16:"background_color";s:6:"99b7c6";s:12:"header_image";s:13:"remove-header";s:16:"sidebars_widgets";a:2:{s:4:"time";i:1499158626;s:4:"data";a:2:{s:19:"wp_inactive_widgets";a:17:{i:0;s:7:"pages-3";i:1;s:7:"pages-4";i:2;s:10:"calendar-3";i:3;s:10:"calendar-4";i:4;s:8:"search-4";i:5;s:14:"recent-posts-4";i:6;s:5:"rss-3";i:7;s:10:"nav_menu-3";i:8;s:18:"bbp_login_widget-3";i:9;s:18:"bbp_login_widget-4";i:10;s:19:"bbp_forums_widget-3";i:11;s:19:"bbp_topics_widget-3";i:12;s:19:"bbp_topics_widget-4";i:13;s:19:"bbp_topics_widget-5";i:14;s:19:"bbp_topics_widget-6";i:15;s:20:"bbp_replies_widget-3";i:16;s:24:"wp_user_avatar_profile-3";}s:9:"sidebar-1";a:5:{i:0;s:8:"search-2";i:1;s:17:"recent-comments-2";i:2;s:10:"archives-2";i:3;s:12:"categories-2";i:4;s:6:"meta-2";}}}}', 'yes'),
(289, 'current_theme', 'Storefront', 'yes'),
(290, 'theme_mods_storefront', 'a:55:{i:0;b:0;s:17:"storefront_styles";s:5060:"\n			.main-navigation ul li a,\n			.site-title a,\n			ul.menu li a,\n			.site-branding h1 a,\n			.site-footer .storefront-handheld-footer-bar a:not(.button),\n			button.menu-toggle,\n			button.menu-toggle:hover {\n				color: #ffffff;\n			}\n\n			button.menu-toggle,\n			button.menu-toggle:hover {\n				border-color: #ffffff;\n			}\n\n			.main-navigation ul li a:hover,\n			.main-navigation ul li:hover > a,\n			.site-title a:hover,\n			a.cart-contents:hover,\n			.site-header-cart .widget_shopping_cart a:hover,\n			.site-header-cart:hover > li > a,\n			.site-header ul.menu li.current-menu-item > a {\n				color: #ffffff;\n			}\n\n			table th {\n				background-color: #f8f8f8;\n			}\n\n			table tbody td {\n				background-color: #fdfdfd;\n			}\n\n			table tbody tr:nth-child(2n) td,\n			fieldset,\n			fieldset legend {\n				background-color: #fbfbfb;\n			}\n\n			.site-header,\n			.secondary-navigation ul ul,\n			.main-navigation ul.menu > li.menu-item-has-children:after,\n			.secondary-navigation ul.menu ul,\n			.storefront-handheld-footer-bar,\n			.storefront-handheld-footer-bar ul li > a,\n			.storefront-handheld-footer-bar ul li.search .site-search,\n			button.menu-toggle,\n			button.menu-toggle:hover {\n				background-color: #338dc9;\n			}\n\n			p.site-description,\n			.site-header,\n			.storefront-handheld-footer-bar {\n				color: #ededed;\n			}\n\n			.storefront-handheld-footer-bar ul li.cart .count,\n			button.menu-toggle:after,\n			button.menu-toggle:before,\n			button.menu-toggle span:before {\n				background-color: #ffffff;\n			}\n\n			.storefront-handheld-footer-bar ul li.cart .count {\n				color: #338dc9;\n			}\n\n			.storefront-handheld-footer-bar ul li.cart .count {\n				border-color: #338dc9;\n			}\n\n			h1, h2, h3, h4, h5, h6 {\n				color: #333333;\n			}\n\n			.widget h1 {\n				border-bottom-color: #333333;\n			}\n\n			body,\n			.secondary-navigation a,\n			.onsale,\n			.pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current) {\n				color: #6d6d6d;\n			}\n\n			.widget-area .widget a,\n			.hentry .entry-header .posted-on a,\n			.hentry .entry-header .byline a {\n				color: #9f9f9f;\n			}\n\n			a  {\n				color: #338dc9;\n			}\n\n			a:focus,\n			.button:focus,\n			.button.alt:focus,\n			.button.added_to_cart:focus,\n			.button.wc-forward:focus,\n			button:focus,\n			input[type="button"]:focus,\n			input[type="reset"]:focus,\n			input[type="submit"]:focus {\n				outline-color: #338dc9;\n			}\n\n			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget a.button, .site-header-cart .widget_shopping_cart a.button {\n				background-color: #338dc9;\n				border-color: #338dc9;\n				color: #333333;\n			}\n\n			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {\n				background-color: #1a74b0;\n				border-color: #1a74b0;\n				color: #333333;\n			}\n\n			button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .widget a.button.checkout {\n				background-color: #333333;\n				border-color: #333333;\n				color: #ffffff;\n			}\n\n			button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover, .widget a.button.checkout:hover {\n				background-color: #1a1a1a;\n				border-color: #1a1a1a;\n				color: #ffffff;\n			}\n\n			.pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers.current {\n				background-color: #e6e6e6;\n				color: #6d6d6d;\n			}\n\n			#comments .comment-list .comment-content .comment-text {\n				background-color: #f8f8f8;\n			}\n\n			.site-footer {\n				background-color: #f0f0f0;\n				color: #6d6d6d;\n			}\n\n			.site-footer a:not(.button) {\n				color: #333333;\n			}\n\n			.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {\n				color: #333333;\n			}\n\n			#order_review {\n				background-color: #ffffff;\n			}\n\n			#payment .payment_methods > li .payment_box,\n			#payment .place-order {\n				background-color: #fafafa;\n			}\n\n			#payment .payment_methods > li:not(.woocommerce-notice) {\n				background-color: #f5f5f5;\n			}\n\n			#payment .payment_methods > li:not(.woocommerce-notice):hover {\n				background-color: #f0f0f0;\n			}\n\n			@media screen and ( min-width: 768px ) {\n				.secondary-navigation ul.menu a:hover {\n					color: #ffffff;\n				}\n\n				.secondary-navigation ul.menu a {\n					color: #ededed;\n				}\n\n				.site-header-cart .widget_shopping_cart,\n				.main-navigation ul.menu ul.sub-menu,\n				.main-navigation ul.nav-menu ul.children {\n					background-color: #247eba;\n				}\n\n				.site-header-cart .widget_shopping_cart .buttons,\n				.site-header-cart .widget_shopping_cart .total {\n					background-color: #2983bf;\n				}\n\n				.site-header {\n					border-bottom-color: #247eba;\n				}\n			}";s:29:"storefront_woocommerce_styles";s:2283:"\n			a.cart-contents,\n			.site-header-cart .widget_shopping_cart a {\n				color: #ffffff;\n			}\n\n			table.cart td.product-remove,\n			table.cart td.actions {\n				border-top-color: #ffffff;\n			}\n\n			.woocommerce-tabs ul.tabs li.active a,\n			ul.products li.product .price,\n			.onsale,\n			.widget_search form:before,\n			.widget_product_search form:before {\n				color: #6d6d6d;\n			}\n\n			.woocommerce-breadcrumb a,\n			a.woocommerce-review-link,\n			.product_meta a {\n				color: #9f9f9f;\n			}\n\n			.onsale {\n				border-color: #6d6d6d;\n			}\n\n			.star-rating span:before,\n			.quantity .plus, .quantity .minus,\n			p.stars a:hover:after,\n			p.stars a:after,\n			.star-rating span:before,\n			#payment .payment_methods li input[type=radio]:first-child:checked+label:before {\n				color: #338dc9;\n			}\n\n			.widget_price_filter .ui-slider .ui-slider-range,\n			.widget_price_filter .ui-slider .ui-slider-handle {\n				background-color: #338dc9;\n			}\n\n			.order_details {\n				background-color: #f8f8f8;\n			}\n\n			.order_details > li {\n				border-bottom: 1px dotted #e3e3e3;\n			}\n\n			.order_details:before,\n			.order_details:after {\n				background: -webkit-linear-gradient(transparent 0,transparent 0),-webkit-linear-gradient(135deg,#f8f8f8 33.33%,transparent 33.33%),-webkit-linear-gradient(45deg,#f8f8f8 33.33%,transparent 33.33%)\n			}\n\n			p.stars a:before,\n			p.stars a:hover~a:before,\n			p.stars.selected a.active~a:before {\n				color: #6d6d6d;\n			}\n\n			p.stars.selected a.active:before,\n			p.stars:hover a:before,\n			p.stars.selected a:not(.active):before,\n			p.stars.selected a.active:before {\n				color: #338dc9;\n			}\n\n			.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger {\n				background-color: #338dc9;\n				color: #333333;\n			}\n\n			.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover {\n				background-color: #1a74b0;\n				border-color: #1a74b0;\n				color: #333333;\n			}\n\n			.button.loading {\n				color: #338dc9;\n			}\n\n			.button.loading:hover {\n				background-color: #338dc9;\n			}\n\n			.button.loading:after {\n				color: #333333;\n			}\n\n			@media screen and ( min-width: 768px ) {\n				.site-header-cart .widget_shopping_cart,\n				.site-header .product_list_widget li .quantity {\n					color: #ededed;\n				}\n			}";s:11:"custom_logo";i:13;s:34:"storefront_header_background_color";s:7:"#338dc9";s:28:"storefront_header_text_color";s:7:"#ededed";s:28:"storefront_header_link_color";s:7:"#ffffff";s:16:"background_color";s:6:"ffffff";s:23:"storefront_accent_color";s:7:"#338dc9";s:34:"storefront_button_background_color";s:7:"#338dc9";s:18:"nav_menu_locations";a:3:{s:7:"primary";i:6;s:8:"handheld";i:6;s:9:"secondary";i:7;}s:16:"sd_header_layout";s:7:"compact";s:13:"sd_typography";s:9:"helvetica";s:8:"sd_scale";s:1:"2";s:17:"storefront_layout";s:5:"right";s:12:"sd_max_width";s:5:"false";s:14:"sd_fixed_width";s:4:"true";s:27:"sd_content_background_color";s:7:"#f7f7f7";s:26:"sd_button_background_style";s:7:"default";s:14:"sd_button_flat";b:0;s:17:"sd_button_shadows";b:0;s:24:"sbc_post_layout_homepage";s:11:"meta-hidden";s:25:"sbc_homepage_blog_columns";s:1:"2";s:23:"sbc_homepage_blog_limit";s:1:"6";s:24:"sbc_homepage_blog_toggle";b:1;s:22:"sbc_post_layout_single";s:15:"meta-inline-top";s:23:"sbc_post_layout_archive";s:11:"meta-hidden";s:23:"sbc_blog_archive_layout";b:0;s:19:"sbc_magazine_layout";b:1;s:18:"custom_css_post_id";i:-1;s:18:"jetpack_custom_css";a:3:{s:12:"preprocessor";s:0:"";s:7:"replace";b:0;s:13:"content_width";s:0:"";}s:39:"storefront_woocommerce_extension_styles";s:0:"";s:16:"sp_header_layout";s:7:"compact";s:13:"sp_typography";s:9:"helvetica";s:8:"sp_scale";s:1:"2";s:12:"sp_max_width";s:9:"max-width";s:14:"sp_fixed_width";s:5:"false";s:27:"sp_content_background_color";s:7:"#fcfcfc";s:26:"sp_button_background_style";s:7:"default";s:14:"sp_button_flat";b:0;s:17:"sp_button_shadows";b:0;s:19:"sp_homepage_content";b:1;s:22:"sp_homepage_categories";b:0;s:18:"sp_homepage_recent";b:0;s:20:"sp_homepage_featured";b:0;s:21:"sp_homepage_top_rated";b:0;s:19:"sp_homepage_on_sale";b:0;s:24:"sp_homepage_best_sellers";b:0;s:17:"sd_button_rounded";s:1:"2";s:20:"sp_designer_css_data";a:1:{i:3292764223167607000;b:0;}s:16:"sp_header_sticky";b:0;s:17:"sp_header_setting";a:0:{}s:16:"sp_content_frame";s:7:"default";s:27:"sp_content_frame_background";s:7:"#f2f2f2";s:16:"sd_footer_credit";b:0;}', 'yes'),
(291, 'theme_switched', '', 'yes'),
(294, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:"auto_add";a:0:{}}', 'yes'),
(295, 'WPLANG', '', 'yes'),
(296, 'wc_memberships_rules', 'a:1:{i:0;a:9:{s:18:"membership_plan_id";i:22;s:2:"id";s:18:"rule_5777c0431a3c2";s:10:"object_ids";a:1:{i:0;s:1:"9";}s:13:"discount_type";s:10:"percentage";s:15:"discount_amount";s:1:"5";s:6:"active";s:3:"yes";s:9:"rule_type";s:19:"purchasing_discount";s:12:"content_type";s:8:"taxonomy";s:17:"content_type_name";s:11:"product_cat";}}', 'yes'),
(308, 'wpos3_tool_errors_legacy_upload', 'a:0:{}', 'yes'),
(310, 'woocommerce_subscriptions_add_to_cart_button_text', 'Sign Up Now', 'yes'),
(311, 'woocommerce_subscriptions_order_button_text', 'Sign Up Now', 'yes'),
(312, 'woocommerce_subscriptions_subscriber_role', 'subscriber', 'yes'),
(313, 'woocommerce_subscriptions_cancelled_role', 'customer', 'yes'),
(314, 'woocommerce_subscriptions_accept_manual_renewals', 'no', 'yes'),
(315, 'woocommerce_subscriptions_turn_off_automatic_payments', 'no', 'yes'),
(316, 'woocommerce_subscriptions_allow_switching', 'no', 'yes'),
(317, 'woocommerce_subscriptions_apportion_recurring_price', 'no', 'yes'),
(318, 'woocommerce_subscriptions_apportion_sign_up_fee', 'no', 'yes'),
(319, 'woocommerce_subscriptions_apportion_length', 'no', 'yes'),
(320, 'woocommerce_subscriptions_switch_button_text', 'Upgrade or Downgrade', 'yes'),
(321, 'woocommerce_subscriptions_sync_payments', 'no', 'yes'),
(322, 'woocommerce_subscriptions_prorate_synced_payments', 'no', 'yes'),
(323, 'woocommerce_subscriptions_max_customer_suspensions', '0', 'yes'),
(324, 'woocommerce_subscriptions_multiple_purchase', 'yes', 'yes'),
(325, 'woocommerce_subscriptions_drip_downloadable_content_on_renewal', 'no', 'yes'),
(326, 'woocommerce_subscriptions_paypal_debugging_default_set', 'true', 'yes'),
(327, 'woocommerce_subscriptions_is_active', '1', 'yes'),
(328, 'wcs_upgrade_initial_total_subscription_count', '0', 'yes'),
(329, 'woocommerce_subscriptions_previous_version', '2.1.2', 'yes'),
(330, 'wc_subscriptions_siteurl', 'http://54._[wc_subscriptions_siteurl]_254.207.12', 'yes'),
(331, 'woocommerce_subscriptions_active_version', '2.2.8', 'yes'),
(332, 'product_cat_children', 'a:0:{}', 'yes'),
(333, 'woocommerce_gateway_order', 'a:6:{s:4:"bacs";i:0;s:7:"paysbuy";i:1;s:6:"cheque";i:2;s:3:"cod";i:3;s:6:"paypal";i:4;s:6:"stripe";i:5;}', 'yes'),
(334, 'woocommerce_myaccount_members_area_endpoint', 'members-area', 'yes'),
(335, 'woocommerce_paysbuy_settings', 'a:4:{s:7:"enabled";s:3:"yes";s:5:"title";s:7:"PaysBuy";s:11:"description";s:47:"ชำระด้วยบัญชี PaysBuy";s:5:"email";s:23:"chalokedotcom@gmail.com";}', 'yes'),
(336, 'woocommerce_bacs_accounts', 'a:2:{i:0;a:6:{s:12:"account_name";s:20:"สัมมนา 4";s:14:"account_number";s:10:"0104348928";s:9:"bank_name";s:49:"Siam Commercial Bank Public Company Limited (SCB)";s:9:"sort_code";s:0:"";s:4:"iban";s:49:"Siam Commercial Bank Public Company Limited (SCB)";s:3:"bic";s:8:"SICOTHBK";}i:1;a:6:{s:12:"account_name";s:7:"Bitcoin";s:14:"account_number";s:34:"1BDLun4knTdh7rzxzjQnx38Q6sGjCNCUa9";s:9:"bank_name";s:40:"Chaloke Dot Com Receiving Wallet Address";s:9:"sort_code";s:0:"";s:4:"iban";s:0:"";s:3:"bic";s:0:"";}}', 'yes'),
(352, 'storefront-designer-version', '1.8.4', 'yes'),
(354, 'widget_bbp_login_widget', 'a:3:{i:3;a:0:{}i:4;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(355, 'widget_bbp_views_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(356, 'widget_bbp_search_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(357, 'widget_bbp_forums_widget', 'a:2:{s:12:"_multiwidget";i:1;i:3;a:2:{s:5:"title";s:6:"Forums";s:12:"parent_forum";s:3:"any";}}', 'yes'),
(358, 'widget_bbp_topics_widget', 'a:5:{i:3;a:6:{s:5:"title";s:18:"Most Recent Topics";s:8:"order_by";s:7:"newness";s:12:"parent_forum";s:3:"any";s:9:"show_date";b:1;s:9:"show_user";b:0;s:9:"max_shown";i:5;}i:4;a:6:{s:5:"title";s:19:"Most Popular Topics";s:8:"order_by";s:7:"popular";s:12:"parent_forum";s:3:"any";s:9:"show_date";b:1;s:9:"show_user";b:0;s:9:"max_shown";i:5;}i:5;a:6:{s:5:"title";s:19:"Most Recent Replies";s:8:"order_by";s:9:"freshness";s:12:"parent_forum";s:3:"any";s:9:"show_date";b:1;s:9:"show_user";b:0;s:9:"max_shown";i:5;}i:6;a:6:{s:5:"title";s:50:"Recent Topics กระทู้ล่าสุด";s:8:"order_by";s:7:"newness";s:12:"parent_forum";s:3:"any";s:9:"show_date";b:1;s:9:"show_user";b:0;s:9:"max_shown";i:8;}s:12:"_multiwidget";i:1;}', 'yes'),
(359, 'widget_bbp_replies_widget', 'a:2:{i:3;a:4:{s:5:"title";s:14:"Recent Replies";s:9:"show_date";b:1;s:9:"show_user";b:1;s:9:"max_shown";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(360, 'widget_bbp_stats_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(361, '_bbp_private_forums', 'a:0:{}', 'yes'),
(362, '_bbp_hidden_forums', 'a:0:{}', 'yes'),
(363, '_bbp_db_version', '250', 'yes'),
(365, '_bbp_edit_lock', '30', 'yes'),
(366, '_bbp_throttle_time', '10', 'yes'),
(367, '_bbp_allow_anonymous', '0', 'yes'),
(368, '_bbp_allow_global_access', '1', 'yes'),
(369, '_bbp_default_role', 'bbp_participant', 'yes'),
(370, '_bbp_allow_revisions', '1', 'yes'),
(371, '_bbp_enable_favorites', '1', 'yes'),
(372, '_bbp_enable_subscriptions', '1', 'yes'),
(373, '_bbp_allow_topic_tags', '1', 'yes'),
(374, '_bbp_allow_search', '1', 'yes'),
(375, '_bbp_use_wp_editor', '1', 'yes'),
(376, '_bbp_use_autoembed', '1', 'yes'),
(377, '_bbp_thread_replies_depth', '2', 'yes') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(378, '_bbp_allow_threaded_replies', '1', 'yes'),
(379, '_bbp_topics_per_page', '30', 'yes'),
(380, '_bbp_replies_per_page', '30', 'yes'),
(381, '_bbp_topics_per_rss_page', '30', 'yes'),
(382, '_bbp_replies_per_rss_page', '30', 'yes'),
(383, '_bbp_root_slug', 'forums', 'yes'),
(384, '_bbp_include_root', '1', 'yes'),
(385, '_bbp_show_on_root', 'forums', 'yes'),
(386, '_bbp_forum_slug', 'forum', 'yes'),
(387, '_bbp_topic_slug', 'topic', 'yes'),
(388, '_bbp_topic_tag_slug', 'topic-tag', 'yes'),
(389, '_bbp_view_slug', 'view', 'yes'),
(390, '_bbp_reply_slug', 'reply', 'yes'),
(391, '_bbp_search_slug', 'search', 'yes'),
(392, '_bbp_user_slug', 'users', 'yes'),
(393, '_bbp_topic_archive_slug', 'topics', 'yes'),
(394, '_bbp_reply_archive_slug', 'replies', 'yes'),
(395, '_bbp_user_favs_slug', 'favorites', 'yes'),
(396, '_bbp_user_subs_slug', 'subscriptions', 'yes'),
(397, '_bbp_enable_akismet', '1', 'yes'),
(398, 'widget_wp_user_avatar_profile', 'a:2:{s:12:"_multiwidget";i:1;i:3;a:0:{}}', 'yes'),
(399, 'avatar_default_wp_user_avatar', '', 'yes'),
(400, 'wp_user_avatar_allow_upload', '1', 'yes'),
(401, 'wp_user_avatar_disable_gravatar', '0', 'yes'),
(402, 'wp_user_avatar_edit_avatar', '1', 'yes'),
(403, 'wp_user_avatar_resize_crop', '0', 'yes'),
(404, 'wp_user_avatar_resize_h', '96', 'yes'),
(405, 'wp_user_avatar_resize_upload', '0', 'yes'),
(406, 'wp_user_avatar_resize_w', '96', 'yes'),
(407, 'wp_user_avatar_tinymce', '1', 'yes'),
(408, 'wp_user_avatar_upload_size_limit', '2097152', 'yes'),
(409, 'wp_user_avatar_default_avatar_updated', '1', 'yes'),
(410, 'wp_user_avatar_users_updated', '1', 'yes'),
(411, 'wp_user_avatar_media_updated', '1', 'yes'),
(413, 'tadv_settings', 'a:6:{s:9:"toolbar_1";s:131:"bold,italic,strikethrough,blockquote,bullist,numlist,alignleft,aligncenter,alignright,link,unlink,table,fullscreen,undo,redo,wp_adv";s:9:"toolbar_2";s:107:"formatselect,alignjustify,outdent,indent,pastetext,removeformat,charmap,wp_more,emoticons,forecolor,wp_help";s:9:"toolbar_3";s:0:"";s:9:"toolbar_4";s:0:"";s:7:"options";s:15:"advlist,menubar";s:7:"plugins";s:107:"anchor,code,insertdatetime,nonbreaking,print,searchreplace,table,visualblocks,visualchars,emoticons,advlist";}', 'yes'),
(414, 'tadv_admin_settings', 'a:3:{s:7:"options";s:0:"";s:16:"disabled_plugins";s:0:"";s:16:"disabled_editors";s:0:"";}', 'yes'),
(415, 'tadv_version', '4000', 'yes'),
(416, 'gd-bbpress-tools', 'a:36:{s:7:"version";s:3:"1.9";s:4:"date";s:11:"2016.09.24.";s:5:"build";i:2144;s:6:"status";s:6:"stable";s:11:"update_wp44";i:0;s:10:"product_id";s:16:"gd-bbpress-tools";s:7:"edition";s:4:"free";s:8:"revision";i:0;s:14:"include_always";i:0;s:10:"include_js";i:1;s:11:"include_css";i:1;s:14:"toolbar_active";i:1;s:19:"toolbar_super_admin";i:1;s:16:"allowed_tags_div";i:1;s:20:"admin_disable_active";i:0;s:25:"admin_disable_super_admin";i:1;s:12:"quote_active";i:1;s:14:"quote_location";s:6:"header";s:12:"quote_method";s:6:"bbcode";s:17:"quote_super_admin";i:1;s:14:"bbcodes_active";i:1;s:14:"bbcodes_notice";i:1;s:20:"bbcodes_bbpress_only";i:0;s:27:"bbcodes_special_super_admin";i:1;s:22:"bbcodes_special_action";i:1;s:19:"bbcodes_deactivated";a:0:{}s:16:"signature_active";i:1;s:16:"signature_length";i:512;s:21:"signature_super_admin";i:1;s:16:"signature_method";s:6:"bbcode";s:30:"signature_enhanced_super_admin";i:1;s:34:"signature_buddypress_profile_group";s:1:"1";s:23:"view_mostreplies_active";i:1;s:24:"view_latesttopics_active";i:1;s:25:"view_searchresults_active";i:1;s:18:"upgrade_to_pro_190";i:1;}', 'yes'),
(417, 'gd-bbpress-attachments', 'a:33:{s:7:"version";s:3:"2.4";s:4:"date";s:11:"2016.09.24.";s:5:"build";i:2148;s:6:"status";s:6:"Stable";s:10:"product_id";s:22:"gd-bbpress-attachments";s:7:"edition";s:4:"free";s:8:"revision";i:0;s:18:"grid_topic_counter";i:1;s:18:"grid_reply_counter";i:1;s:18:"delete_attachments";s:6:"detach";s:14:"include_always";i:0;s:10:"include_js";i:1;s:11:"include_css";i:1;s:18:"hide_from_visitors";i:1;s:13:"max_file_size";i:5000;s:13:"max_to_upload";i:4;s:15:"attachment_icon";i:1;s:15:"attchment_icons";i:1;s:22:"image_thumbnail_active";i:1;s:22:"image_thumbnail_inline";i:0;s:23:"image_thumbnail_caption";i:1;s:19:"image_thumbnail_rel";s:8:"lightbox";s:19:"image_thumbnail_css";s:0:"";s:22:"image_thumbnail_size_x";i:150;s:22:"image_thumbnail_size_y";i:150;s:17:"log_upload_errors";i:1;s:24:"errors_visible_to_admins";i:1;s:28:"errors_visible_to_moderators";i:1;s:24:"errors_visible_to_author";i:1;s:24:"delete_visible_to_admins";s:4:"both";s:28:"delete_visible_to_moderators";s:4:"both";s:24:"delete_visible_to_author";s:6:"detach";s:18:"upgrade_to_pro_240";i:1;}', 'yes'),
(419, 'jetpack_activated', '1', 'yes'),
(420, 'jetpack_file_data', 'a:1:{s:5:"4.4.2";a:50:{s:32:"31e5b9ae08b62c2b0cd8a7792242298b";a:14:{s:4:"name";s:20:"Spelling and Grammar";s:11:"description";s:40:"Check your spelling, style, and grammar.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"6";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:7:"Writing";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:115:"after the deadline, afterthedeadline, spell, spellchecker, spelling, grammar, proofreading, style, language, cliche";}s:32:"3f41b2d629265b5de8108b463abbe8e2";a:14:{s:4:"name";s:8:"Carousel";s:11:"description";s:64:"Transform image galleries into gorgeous, full-screen slideshows.";s:14:"jumpstart_desc";s:79:"Brings your photos and images to life as full-size, easily navigable galleries.";s:4:"sort";s:2:"22";s:20:"recommendation_order";s:2:"12";s:10:"introduced";s:3:"1.5";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:17:"Photos and Videos";s:7:"feature";s:21:"Appearance, Jumpstart";s:25:"additional_search_queries";s:80:"gallery, carousel, diaporama, slideshow, images, lightbox, exif, metadata, image";}s:32:"c6ebb418dde302de09600a6025370583";a:14:{s:4:"name";s:8:"Comments";s:11:"description";s:65:"Allow comments with WordPress.com, Twitter, Facebook, or Google+.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"20";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.4";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:6:"Social";s:7:"feature";s:10:"Engagement";s:25:"additional_search_queries";s:53:"comments, comment, facebook, twitter, google+, social";}s:32:"836f9485669e1bbb02920cb474730df0";a:14:{s:4:"name";s:12:"Contact Form";s:11:"description";s:57:"Insert a customizable contact form anywhere on your site.";s:14:"jumpstart_desc";s:111:"Adds a button to your post and page editors, allowing you to build simple forms to help visitors stay in touch.";s:4:"sort";s:2:"15";s:20:"recommendation_order";s:2:"14";s:10:"introduced";s:3:"1.3";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:5:"Other";s:7:"feature";s:18:"Writing, Jumpstart";s:25:"additional_search_queries";s:44:"contact, form, grunion, feedback, submission";}s:32:"ea3970eebf8aac55fc3eca5dca0e0157";a:14:{s:4:"name";s:20:"Custom Content Types";s:11:"description";s:61:"Organize and display different types of content on your site.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"34";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"3.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:7:"Writing";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:72:"cpt, custom post types, portfolio, portfolios, testimonial, testimonials";}s:32:"d2bb05ccad3d8789df40ca3abb97336c";a:14:{s:4:"name";s:10:"Custom CSS";s:11:"description";s:53:"Tweak your site’s CSS without modifying your theme.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"2";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.7";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:10:"Appearance";s:7:"feature";s:10:"Appearance";s:25:"additional_search_queries";s:108:"css, customize, custom, style, editor, less, sass, preprocessor, font, mobile, appearance, theme, stylesheet";}s:32:"a2064eec5b9c7e0d816af71dee7a715f";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"53a4ec755022ef3953699734c343da02";a:14:{s:4:"name";s:21:"Enhanced Distribution";s:11:"description";s:27:"Increase reach and traffic.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"5";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.2";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:6:"Public";s:11:"module_tags";s:7:"Writing";s:7:"feature";s:10:"Engagement";s:25:"additional_search_queries";s:54:"google, seo, firehose, search, broadcast, broadcasting";}s:32:"72fecb67ee6704ba0a33e0225316ad06";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"d56e2886185a9eace719cc57d46770df";a:14:{s:4:"name";s:19:"Gravatar Hovercards";s:11:"description";s:58:"Enable pop-up business cards over commenters’ Gravatars.";s:14:"jumpstart_desc";s:131:"Let commenters link their profiles to their Gravatar accounts, making it easy for your visitors to learn more about your community.";s:4:"sort";s:2:"11";s:20:"recommendation_order";s:2:"13";s:10:"introduced";s:3:"1.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:18:"Social, Appearance";s:7:"feature";s:21:"Appearance, Jumpstart";s:25:"additional_search_queries";s:20:"gravatar, hovercards";}s:32:"e391e760617bd0e0736550e34a73d7fe";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:8:"2.0.3 ??";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"2e345370766346c616b3c5046e817720";a:14:{s:4:"name";s:15:"Infinite Scroll";s:11:"description";s:54:"Automatically load new content when a visitor scrolls.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"26";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.0";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:10:"Appearance";s:7:"feature";s:10:"Appearance";s:25:"additional_search_queries";s:33:"scroll, infinite, infinite scroll";}s:32:"bd69edbf134de5fae8fdcf2e70a45b56";a:14:{s:4:"name";s:8:"JSON API";s:11:"description";s:51:"Allow applications to securely access your content.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"19";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.9";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:6:"Public";s:11:"module_tags";s:19:"Writing, Developers";s:7:"feature";s:7:"General";s:25:"additional_search_queries";s:50:"api, rest, develop, developers, json, klout, oauth";}s:32:"8110b7a4423aaa619dfa46b8843e10d1";a:14:{s:4:"name";s:14:"Beautiful Math";s:11:"description";s:57:"Use LaTeX markup for complex equations and other geekery.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"12";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:7:"Writing";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:47:"latex, math, equation, equations, formula, code";}s:32:"fd7e85d3b4887fa6b6f997d6592c1f33";a:14:{s:4:"name";s:5:"Likes";s:11:"description";s:63:"Give visitors an easy way to show they appreciate your content.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"23";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.2";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:6:"Social";s:7:"feature";s:10:"Engagement";s:25:"additional_search_queries";s:26:"like, likes, wordpress.com";}s:32:"c5dfef41fad5bcdcaae8e315e5cfc420";a:14:{s:4:"name";s:6:"Manage";s:11:"description";s:54:"Manage all of your sites from a centralized dashboard.";s:14:"jumpstart_desc";s:151:"Helps you remotely manage plugins, turn on automated updates, and more from <a href="https://wordpress.com/plugins/" target="_blank">wordpress.com</a>.";s:4:"sort";s:1:"1";s:20:"recommendation_order";s:1:"3";s:10:"introduced";s:3:"3.4";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:35:"Centralized Management, Recommended";s:7:"feature";s:7:"General";s:25:"additional_search_queries";s:26:"manage, management, remote";}s:32:"fd6dc399b92bce76013427e3107c314f";a:14:{s:4:"name";s:8:"Markdown";s:11:"description";s:51:"Write posts or pages in plain-text Markdown syntax.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"31";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.8";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:7:"Writing";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:12:"md, markdown";}s:32:"c49a35b6482b0426cb07ad28ecf5d7df";a:14:{s:4:"name";s:12:"Mobile Theme";s:11:"description";s:47:"Optimize your site for smartphones and tablets.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"21";s:20:"recommendation_order";s:2:"11";s:10:"introduced";s:3:"1.8";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:31:"Appearance, Mobile, Recommended";s:7:"feature";s:10:"Appearance";s:25:"additional_search_queries";s:24:"mobile, theme, minileven";}s:32:"b42e38f6fafd2e4104ebe5bf39b4be47";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"771cfeeba0d3d23ec344d5e781fb0ae2";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"54f0661d27c814fc8bde39580181d939";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"46c4c413b5c72bbd3c3dbd14ff8f8adc";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"9ea52fa25783e5ceeb6bfaed3268e64e";a:14:{s:4:"name";s:7:"Monitor";s:11:"description";s:61:"Receive immediate notifications if your site goes down, 24/7.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"28";s:20:"recommendation_order";s:2:"10";s:10:"introduced";s:3:"2.6";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:11:"Recommended";s:7:"feature";s:8:"Security";s:25:"additional_search_queries";s:37:"monitor, uptime, downtime, monitoring";}s:32:"cfcaafd0fcad087899d715e0b877474d";a:14:{s:4:"name";s:13:"Notifications";s:11:"description";s:57:"Receive instant notifications of site comments and likes.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"13";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.9";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:5:"Other";s:7:"feature";s:7:"General";s:25:"additional_search_queries";s:62:"notification, notifications, toolbar, adminbar, push, comments";}s:32:"0d18bfa69bec61550c1d813ce64149b0";a:14:{s:4:"name";s:10:"Omnisearch";s:11:"description";s:66:"Search your entire database from a single field in your dashboard.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"16";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.3";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:10:"Developers";s:7:"feature";s:7:"General";s:25:"additional_search_queries";s:6:"search";}s:32:"3f0a11e23118f0788d424b646a6d465f";a:14:{s:4:"name";s:6:"Photon";s:11:"description";s:27:"Speed up images and photos.";s:14:"jumpstart_desc";s:141:"Mirrors and serves your images from our free and fast image CDN, improving your site’s performance with no additional load on your servers.";s:4:"sort";s:2:"25";s:20:"recommendation_order";s:1:"1";s:10:"introduced";s:3:"2.0";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:42:"Photos and Videos, Appearance, Recommended";s:7:"feature";s:34:"Recommended, Jumpstart, Appearance";s:25:"additional_search_queries";s:38:"photon, image, cdn, performance, speed";}s:32:"e37cfbcb72323fb1fe8255a2edb4d738";a:14:{s:4:"name";s:13:"Post by Email";s:11:"description";s:34:"Publish posts by sending an email.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"14";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.0";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:7:"Writing";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:20:"post by email, email";}s:32:"728290d131a480bfe7b9e405d7cd925f";a:14:{s:4:"name";s:7:"Protect";s:11:"description";s:43:"Prevent and block malicious login attempts.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"1";s:20:"recommendation_order";s:1:"4";s:10:"introduced";s:3:"3.4";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:11:"Recommended";s:7:"feature";s:8:"Security";s:25:"additional_search_queries";s:65:"security, secure, protection, botnet, brute force, protect, login";}s:32:"f9ce784babbbf4dcca99b8cd2ceb420c";a:14:{s:4:"name";s:9:"Publicize";s:11:"description";s:27:"Automated social marketing.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"10";s:20:"recommendation_order";s:1:"7";s:10:"introduced";s:3:"2.0";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:19:"Social, Recommended";s:7:"feature";s:10:"Engagement";s:25:"additional_search_queries";s:107:"facebook, twitter, google+, googleplus, google, path, tumblr, linkedin, social, tweet, connections, sharing";}s:32:"052c03877dd3d296a71531cb07ad939a";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"52edecb2a75222e75b2dce4356a4efce";a:14:{s:4:"name";s:13:"Related Posts";s:11:"description";s:64:"Increase page views by showing related content to your visitors.";s:14:"jumpstart_desc";s:113:"Keep visitors engaged on your blog by highlighting relevant and new content at the bottom of each published post.";s:4:"sort";s:2:"29";s:20:"recommendation_order";s:1:"9";s:10:"introduced";s:3:"2.9";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:11:"Recommended";s:7:"feature";s:21:"Engagement, Jumpstart";s:25:"additional_search_queries";s:22:"related, related posts";}s:32:"68b0d01689803c0ea7e4e60a86de2519";a:14:{s:4:"name";s:9:"SEO tools";s:11:"description";s:50:"Better results on search engines and social media.";s:14:"jumpstart_desc";s:50:"Better results on search engines and social media.";s:4:"sort";s:2:"35";s:20:"recommendation_order";s:2:"15";s:10:"introduced";s:3:"4.4";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:18:"Social, Appearance";s:7:"feature";s:18:"Traffic, Jumpstart";s:25:"additional_search_queries";s:81:"search engine optimization, social preview, meta description, custom title format";}s:32:"8b059cb50a66b717f1ec842e736b858c";a:14:{s:4:"name";s:7:"Sharing";s:11:"description";s:37:"Allow visitors to share your content.";s:14:"jumpstart_desc";s:116:"Twitter, Facebook and Google+ buttons at the bottom of each post, making it easy for visitors to share your content.";s:4:"sort";s:1:"7";s:20:"recommendation_order";s:1:"6";s:10:"introduced";s:3:"1.1";s:7:"changed";s:3:"1.2";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:19:"Social, Recommended";s:7:"feature";s:21:"Engagement, Jumpstart";s:25:"additional_search_queries";s:141:"share, sharing, sharedaddy, buttons, icons, email, facebook, twitter, google+, linkedin, pinterest, pocket, press this, print, reddit, tumblr";}s:32:"a6d2394329871857401255533a9873f7";a:14:{s:4:"name";s:16:"Shortcode Embeds";s:11:"description";s:50:"Embed media from popular sites without any coding.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"3";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.1";s:7:"changed";s:3:"1.2";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:46:"Photos and Videos, Social, Writing, Appearance";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:245:"shortcodes, shortcode, embeds, media, bandcamp, blip.tv, dailymotion, facebook, flickr, google calendars, google maps, google+, polldaddy, recipe, recipes, scribd, slideshare, slideshow, slideshows, soundcloud, ted, twitter, vimeo, vine, youtube";}s:32:"21496e2897ea5f81605e2f2ac3beb921";a:14:{s:4:"name";s:16:"WP.me Shortlinks";s:11:"description";s:54:"Create short and simple links for all posts and pages.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"8";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:6:"Social";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:17:"shortlinks, wp.me";}s:32:"e2a54a5d7879a4162709e6ffb540dd08";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"f5c537bc304f55b29c1a87e30be0cd24";a:14:{s:4:"name";s:8:"Sitemaps";s:11:"description";s:50:"Make it easy for search engines to find your site.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"13";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"3.9";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:6:"Public";s:11:"module_tags";s:20:"Recommended, Traffic";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:39:"sitemap, traffic, search, site map, seo";}s:32:"59a23643437358a9b557f1d1e20ab040";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"6a90f97c3194cfca5671728eaaeaf15e";a:14:{s:4:"name";s:14:"Single Sign On";s:11:"description";s:46:"Secure user authentication with WordPress.com.";s:14:"jumpstart_desc";s:98:"Lets you log in to all your Jetpack-enabled sites with one click using your WordPress.com account.";s:4:"sort";s:2:"30";s:20:"recommendation_order";s:1:"5";s:10:"introduced";s:3:"2.6";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:10:"Developers";s:7:"feature";s:19:"Security, Jumpstart";s:25:"additional_search_queries";s:34:"sso, single sign on, login, log in";}s:32:"b65604e920392e2f7134b646760b75e8";a:14:{s:4:"name";s:10:"Site Stats";s:11:"description";s:44:"Collect valuable traffic stats and insights.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"1";s:20:"recommendation_order";s:1:"2";s:10:"introduced";s:3:"1.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:23:"Site Stats, Recommended";s:7:"feature";s:10:"Engagement";s:25:"additional_search_queries";s:54:"statistics, tracking, analytics, views, traffic, stats";}s:32:"23a586dd7ead00e69ec53eb32ef740e4";a:14:{s:4:"name";s:13:"Subscriptions";s:11:"description";s:55:"Notify your readers of new posts and comments by email.";s:14:"jumpstart_desc";s:126:"Give visitors two easy subscription options — while commenting, or via a separate email subscription widget you can display.";s:4:"sort";s:1:"9";s:20:"recommendation_order";s:1:"8";s:10:"introduced";s:3:"1.2";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:6:"Social";s:7:"feature";s:21:"Engagement, Jumpstart";s:25:"additional_search_queries";s:74:"subscriptions, subscription, email, follow, followers, subscribers, signup";}s:32:"1d978b8d84d2f378fe1a702a67633b6d";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"b3b983461d7f3d27322a3551ed8a9405";a:14:{s:4:"name";s:15:"Tiled Galleries";s:11:"description";s:61:"Display image galleries in a variety of elegant arrangements.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"24";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.1";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:2:"No";s:11:"module_tags";s:17:"Photos and Videos";s:7:"feature";s:10:"Appearance";s:25:"additional_search_queries";s:43:"gallery, tiles, tiled, grid, mosaic, images";}s:32:"d924e5b05722b0e104448543598f54c0";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}s:32:"36741583b10c521997e563ad8e1e8b77";a:14:{s:4:"name";s:12:"Data Backups";s:11:"description";s:54:"Off-site backups, security scans, and automatic fixes.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"32";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:5:"0:1.2";s:7:"changed";s:0:"";s:10:"deactivate";s:5:"false";s:4:"free";s:5:"false";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:0:"";s:7:"feature";s:16:"Security, Health";s:25:"additional_search_queries";s:28:"vaultpress, backup, security";}s:32:"2b9b44f09b5459617d68dd82ee17002a";a:14:{s:4:"name";s:17:"Site Verification";s:11:"description";s:58:"Establish your site\'s authenticity with external services.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"33";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"3.0";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:0:"";s:7:"feature";s:10:"Engagement";s:25:"additional_search_queries";s:56:"webmaster, seo, google, bing, pinterest, search, console";}s:32:"5ab4c0db7c42e10e646342da0274c491";a:14:{s:4:"name";s:10:"VideoPress";s:11:"description";s:44:"Powerful, simple video hosting for WordPress";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"27";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.5";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:5:"false";s:19:"requires_connection";s:3:"Yes";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:17:"Photos and Videos";s:7:"feature";s:7:"Writing";s:25:"additional_search_queries";s:25:"video, videos, videopress";}s:32:"60a1d3aa38bc0fe1039e59dd60888543";a:14:{s:4:"name";s:17:"Widget Visibility";s:11:"description";s:42:"Control where widgets appear on your site.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:2:"17";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"2.4";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:10:"Appearance";s:7:"feature";s:10:"Appearance";s:25:"additional_search_queries";s:54:"widget visibility, logic, conditional, widgets, widget";}s:32:"174ed3416476c2cb9ff5b0f671280b15";a:14:{s:4:"name";s:21:"Extra Sidebar Widgets";s:11:"description";s:54:"Add images, Twitter streams, and more to your sidebar.";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:1:"4";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:3:"1.2";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:2:"No";s:13:"auto_activate";s:3:"Yes";s:11:"module_tags";s:18:"Social, Appearance";s:7:"feature";s:10:"Appearance";s:25:"additional_search_queries";s:65:"widget, widgets, facebook, gallery, twitter, gravatar, image, rss";}s:32:"28b931a1db19bd24869bd54b14e733d5";a:14:{s:4:"name";s:0:"";s:11:"description";s:0:"";s:14:"jumpstart_desc";s:0:"";s:4:"sort";s:0:"";s:20:"recommendation_order";s:0:"";s:10:"introduced";s:0:"";s:7:"changed";s:0:"";s:10:"deactivate";s:0:"";s:4:"free";s:0:"";s:19:"requires_connection";s:0:"";s:13:"auto_activate";s:0:"";s:11:"module_tags";s:0:"";s:7:"feature";s:0:"";s:25:"additional_search_queries";s:0:"";}}}', 'yes'),
(421, 'jetpack_available_modules', 'a:1:{s:5:"4.4.2";a:37:{s:18:"after-the-deadline";s:3:"1.1";s:8:"carousel";s:3:"1.5";s:8:"comments";s:3:"1.4";s:12:"contact-form";s:3:"1.3";s:20:"custom-content-types";s:3:"3.1";s:10:"custom-css";s:3:"1.7";s:21:"enhanced-distribution";s:3:"1.2";s:19:"gravatar-hovercards";s:3:"1.1";s:15:"infinite-scroll";s:3:"2.0";s:8:"json-api";s:3:"1.9";s:5:"latex";s:3:"1.1";s:5:"likes";s:3:"2.2";s:6:"manage";s:3:"3.4";s:8:"markdown";s:3:"2.8";s:9:"minileven";s:3:"1.8";s:7:"monitor";s:3:"2.6";s:5:"notes";s:3:"1.9";s:10:"omnisearch";s:3:"2.3";s:6:"photon";s:3:"2.0";s:13:"post-by-email";s:3:"2.0";s:7:"protect";s:3:"3.4";s:9:"publicize";s:3:"2.0";s:13:"related-posts";s:3:"2.9";s:9:"seo-tools";s:3:"4.4";s:10:"sharedaddy";s:3:"1.1";s:10:"shortcodes";s:3:"1.1";s:10:"shortlinks";s:3:"1.1";s:8:"sitemaps";s:3:"3.9";s:3:"sso";s:3:"2.6";s:5:"stats";s:3:"1.1";s:13:"subscriptions";s:3:"1.2";s:13:"tiled-gallery";s:3:"2.1";s:10:"vaultpress";s:5:"0:1.2";s:18:"verification-tools";s:3:"3.0";s:10:"videopress";s:3:"2.5";s:17:"widget-visibility";s:3:"2.4";s:7:"widgets";s:3:"1.2";}}', 'yes'),
(422, 'jetpack_options', 'a:8:{s:7:"version";s:16:"4.4.2:1483446341";s:11:"old_version";s:16:"4.1.1:1468403672";s:2:"id";i:114041390;s:6:"public";i:1;s:9:"jumpstart";s:19:"jumpstart_activated";s:14:"last_heartbeat";i:1483782912;s:20:"sync_bulk_reindexing";b:1;s:24:"custom_css_4.7_migration";b:1;}', 'yes'),
(423, 'jetpack_log', 'a:17:{i:0;a:4:{s:4:"time";i:1468403690;s:7:"user_id";i:1;s:7:"blog_id";b:0;s:4:"code";s:8:"register";}i:1;a:4:{s:4:"time";i:1468403706;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:9:"authorize";}i:2;a:5:{s:4:"time";i:1468404213;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:10:"sharedaddy";}i:3;a:5:{s:4:"time";i:1468404214;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:13:"subscriptions";}i:4;a:5:{s:4:"time";i:1468404214;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:19:"gravatar-hovercards";}i:5;a:5:{s:4:"time";i:1468404214;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:12:"contact-form";}i:6;a:5:{s:4:"time";i:1468404214;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:8:"carousel";}i:7;a:5:{s:4:"time";i:1468404214;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:6:"photon";}i:8;a:5:{s:4:"time";i:1468404214;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:13:"related-posts";}i:9;a:5:{s:4:"time";i:1468404215;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:8:"activate";s:4:"data";s:3:"sso";}i:10;a:5:{s:4:"time";i:1468404432;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:10:"deactivate";s:4:"data";s:6:"photon";}i:11;a:5:{s:4:"time";i:1468404438;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:10:"deactivate";s:4:"data";s:13:"post-by-email";}i:12;a:5:{s:4:"time";i:1468405163;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:10:"deactivate";s:4:"data";s:13:"post-by-email";}i:13;a:5:{s:4:"time";i:1468405183;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:10:"deactivate";s:4:"data";s:19:"gravatar-hovercards";}i:14;a:5:{s:4:"time";i:1468405262;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:10:"deactivate";s:4:"data";s:3:"sso";}i:15;a:5:{s:4:"time";i:1468405273;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:10:"deactivate";s:4:"data";s:20:"custom-content-types";}i:16;a:5:{s:4:"time";i:1483177098;s:7:"user_id";i:1;s:7:"blog_id";i:114041390;s:4:"code";s:24:"custom_css_4.7_migration";s:4:"data";s:5:"start";}}', 'no'),
(424, 'jetpack_private_options', 'a:1:{s:9:"authorize";s:78:"LLBJhhSZAnGcVCTBpqan9W6b57dgUfuX:PQgH7kPSxt4MBvPx3uA8a5B693plxF94:1483803070:1";}', 'yes'),
(425, 'jetpack_unique_connection', 'a:3:{s:9:"connected";i:1;s:12:"disconnected";i:1;s:7:"version";s:5:"3.6.1";}', 'yes'),
(426, 'jetpack_active_modules', 'a:20:{i:0;s:18:"after-the-deadline";i:1;s:12:"contact-form";i:6;s:8:"json-api";i:7;s:5:"latex";i:8;s:6:"manage";i:10;s:10:"omnisearch";i:12;s:7:"protect";i:13;s:9:"publicize";i:14;s:10:"sharedaddy";i:15;s:10:"shortcodes";i:16;s:10:"shortlinks";i:17;s:8:"sitemaps";i:18;s:5:"stats";i:19;s:13:"subscriptions";i:21;s:18:"verification-tools";i:22;s:17:"widget-visibility";i:23;s:7:"widgets";i:24;s:8:"carousel";i:26;s:13:"related-posts";i:27;s:21:"enhanced-distribution";}', 'yes'),
(429, 'widget_blog_subscription', 'a:2:{i:2;a:6:{s:5:"title";s:27:"Subscribe to Blog via Email";s:14:"subscribe_text";s:99:"Enter your email address to subscribe to this blog and receive notifications of new posts by email.";s:21:"subscribe_placeholder";s:13:"Email Address";s:16:"subscribe_button";s:9:"Subscribe";s:15:"success_message";s:128:"Success! An email was just sent to confirm your subscription. Please find the email now and click activate to start subscribing.";s:22:"show_subscribers_total";b:1;}s:12:"_multiwidget";i:1;}', 'yes'),
(430, 'widget_facebook-likebox', 'a:2:{i:2;a:2:{s:5:"title";s:22:"Follow us on Facebook!";s:9:"like_args";a:6:{s:4:"href";s:38:"https://www.facebook.com/ChalokeDotCom";s:5:"width";i:340;s:6:"height";i:130;s:10:"show_faces";b:0;s:6:"stream";b:1;s:5:"cover";b:0;}}s:12:"_multiwidget";i:1;}', 'yes'),
(431, 'widget_wpcom-goodreads', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(432, 'widget_googleplus-badge', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(433, 'widget_grofile', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(434, 'widget_image', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(435, 'widget_rss_links', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(436, 'widget_wpcom_social_media_icons_widget', 'a:2:{i:2;a:10:{s:5:"title";s:15:"Also find us on";s:17:"facebook_username";s:13:"ChalokeDotCom";s:16:"twitter_username";s:0:"";s:18:"instagram_username";s:0:"";s:18:"pinterest_username";s:0:"";s:17:"linkedin_username";s:0:"";s:15:"github_username";s:0:"";s:16:"youtube_username";s:24:"UCxx6Lgcyxs01U1U1p4so8Ng";s:14:"vimeo_username";s:0:"";s:19:"googleplus_username";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(437, 'widget_twitter_timeline', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(438, 'widget_jetpack_display_posts_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(439, 'jetpack_protect_key', 'ad0bf1aab3403dac3acc51704cb01e456d552aa4', 'yes'),
(441, 'stats_options', 'a:7:{s:9:"admin_bar";b:1;s:5:"roles";a:1:{i:0;s:13:"administrator";}s:11:"count_roles";a:0:{}s:7:"blog_id";i:114041390;s:12:"do_not_track";b:1;s:10:"hide_smile";b:1;s:7:"version";s:1:"9";}', 'yes'),
(442, 'jetpack_site_icon_url', 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-CDClogo2015_rev1_A.png', 'yes'),
(443, 'trusted_ip_header', 'O:8:"stdClass":3:{s:14:"trusted_header";s:11:"REMOTE_ADDR";s:8:"segments";i:1;s:7:"reverse";b:0;}', 'no'),
(445, 'sharing-options', 'a:1:{s:6:"global";a:5:{s:12:"button_style";s:4:"icon";s:13:"sharing_label";b:0;s:10:"open_links";s:4:"same";s:4:"show";a:1:{i:0;s:4:"post";}s:6:"custom";a:0:{}}}', 'yes'),
(447, 'sharing-services', 'a:2:{s:7:"visible";a:5:{i:0;s:7:"twitter";i:1;s:8:"facebook";i:2;s:13:"google-plus-1";i:3;s:6:"tumblr";i:4;s:6:"pocket";}s:6:"hidden";a:0:{}}', 'yes'),
(458, 'sharedaddy_disable_resources', '0', 'yes'),
(459, 'jetpack-twitter-cards-site-tag', '', 'yes'),
(460, 'cimy_uef_options', 'a:22:{s:18:"extra_fields_title";s:12:"Extra Fields";s:14:"users_per_page";i:50;s:17:"aue_hidden_fields";a:3:{i:0;s:5:"posts";i:1;s:5:"email";i:2;s:7:"website";}s:16:"wp_hidden_fields";a:5:{i:0;s:8:"password";i:1;s:9:"password2";i:2;s:8:"username";i:3;s:9:"firstname";i:4;s:8:"lastname";}s:14:"fieldset_title";b:0;s:17:"registration-logo";s:0:"";s:7:"captcha";s:4:"none";s:13:"welcome_email";s:51:"Username: USERNAME\r\nPassword: PASSWORD\r\nLOGINLINK\r\n";s:12:"confirm_form";b:0;s:13:"confirm_email";b:0;s:14:"password_meter";b:1;s:19:"mail_include_fields";b:0;s:11:"redirect_to";s:0:"";s:11:"file_fields";a:5:{s:11:"show_in_reg";i:0;s:15:"show_in_profile";i:0;s:11:"show_in_aeu";i:0;s:12:"show_in_blog";i:0;s:14:"show_in_search";i:0;}s:12:"image_fields";a:5:{s:11:"show_in_reg";i:0;s:15:"show_in_profile";i:0;s:11:"show_in_aeu";i:0;s:12:"show_in_blog";i:0;s:14:"show_in_search";i:0;}s:14:"tinymce_fields";a:5:{s:11:"show_in_reg";i:0;s:15:"show_in_profile";i:0;s:11:"show_in_aeu";i:0;s:12:"show_in_blog";i:0;s:14:"show_in_search";i:0;}s:7:"version";s:5:"2.7.1";s:11:"date_fields";a:5:{s:11:"show_in_reg";i:0;s:15:"show_in_profile";i:0;s:11:"show_in_aeu";i:0;s:12:"show_in_blog";i:0;s:14:"show_in_search";i:0;}s:20:"recaptcha_public_key";s:0:"";s:21:"recaptcha_private_key";s:0:"";s:19:"recaptcha2_site_key";s:0:"";s:21:"recaptcha2_secret_key";s:0:"";}', 'yes'),
(465, 'widget_widget_contact_info', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(466, 'widget_top-posts', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(486, 'storefront-blog-customiser-version', '1.2.1', 'yes'),
(488, 'wc_memberships_enable_subscriptions_sign_up_fees_discounts', 'no', 'yes'),
(541, 'jetpack_protect_blocked_attempts', '5631', 'no'),
(645, 'jetpack_sync_full_config', 'a:4:{s:9:"constants";b:1;s:9:"functions";b:1;s:7:"options";b:1;s:5:"users";a:1:{i:0;s:1:"1";}}', 'no'),
(646, 'jetpack_sync_full_enqueue_status', 'a:5:{s:9:"constants";a:3:{i:0;i:1;i:1;i:1;i:2;b:1;}s:9:"functions";a:3:{i:0;i:1;i:1;i:1;i:2;b:1;}s:7:"options";a:3:{i:0;i:1;i:1;i:1;i:2;b:1;}s:15:"network_options";b:0;s:5:"users";a:3:{i:0;i:1;i:1;i:1;i:2;b:1;}}', 'no'),
(656, 'widget_google_translate_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(657, 'widget_jetpack_my_community', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(660, 'jetpack_testimonial', '0', 'yes'),
(676, 'do_activate', '0', 'yes'),
(720, 'jpsq_sync_checkout', '0:0', 'no'),
(722, 'jetpack_next_sync_time_full-sync-enqueue', '1483802604', 'yes'),
(723, 'jpsq_full_sync_checkout', '0:0', 'no'),
(762, 'verification_services_codes', '0', 'yes'),
(764, 'open_graph_protocol_site_type', '', 'yes'),
(765, 'facebook_admins', 'a:0:{}', 'yes'),
(766, 'safecss_revision_migrated', '0', 'yes'),
(767, 'safecss', '', 'yes'),
(788, 'jetpack_active_plan', 'a:6:{s:10:"product_id";i:2002;s:12:"product_slug";s:12:"jetpack_free";s:18:"product_name_short";s:4:"Free";s:10:"free_trial";b:0;s:7:"expired";b:0;s:13:"user_is_owner";b:0;}', 'yes'),
(816, 'wpmdb_settings', 'a:11:{s:3:"key";s:40:"PEIRtDhQxYb/DBOjbGi3Wo6RSAozJkhfsqpG5M69";s:10:"allow_pull";b:0;s:10:"allow_push";b:0;s:8:"profiles";a:1:{i:0;a:22:{s:13:"save_computer";s:1:"1";s:9:"gzip_file";s:1:"1";s:13:"replace_guids";s:1:"0";s:12:"exclude_spam";s:1:"1";s:19:"keep_active_plugins";s:1:"1";s:13:"create_backup";s:1:"1";s:18:"exclude_post_types";s:1:"1";s:18:"exclude_transients";s:1:"1";s:25:"compatibility_older_mysql";s:1:"1";s:6:"action";s:4:"pull";s:15:"connection_info";s:64:"http://www.chaloke.com\r\nhpRnRfBlH1afBVIJ1Xl6dFr0Mfqiscuu/zOVzMrm";s:11:"replace_old";a:1:{i:1;s:4:"lung";}s:11:"replace_new";a:1:{i:1;s:2:"wp";}s:20:"table_migrate_option";s:14:"migrate_select";s:13:"select_tables";a:13:{i:0;s:25:"lung_pmpro_discount_codes";i:1;s:32:"lung_pmpro_discount_codes_levels";i:2;s:30:"lung_pmpro_discount_codes_uses";i:3;s:31:"lung_pmpro_membership_levelmeta";i:4;s:28:"lung_pmpro_membership_levels";i:5;s:28:"lung_pmpro_membership_orders";i:6;s:33:"lung_pmpro_memberships_categories";i:7;s:28:"lung_pmpro_memberships_pages";i:8;s:28:"lung_pmpro_memberships_users";i:9;s:13:"lung_postmeta";i:10;s:10:"lung_posts";i:11;s:13:"lung_usermeta";i:12;s:10:"lung_users";}s:17:"select_post_types";a:31:{i:0;s:8:"revision";i:1;s:10:"attachment";i:2;s:8:"bp-email";i:3;s:8:"campaign";i:4;s:8:"donation";i:5;s:8:"download";i:6;s:7:"edd_log";i:7;s:11:"edd_payment";i:8;s:19:"event_magic_tickets";i:9;s:5:"forum";i:10;s:10:"give_forms";i:11;s:8:"give_log";i:12;s:12:"give_payment";i:13;s:19:"migla_custom_values";i:14;s:15:"migla_odonation";i:15;s:17:"migla_odonation_p";i:16;s:17:"migla_stripe_plan";i:17;s:9:"miglaform";i:18;s:13:"nav_menu_item";i:19;s:4:"page";i:20;s:13:"pricing-table";i:21;s:7:"product";i:22;s:17:"product_variation";i:23;s:5:"reply";i:24;s:16:"scheduled_export";i:25;s:11:"shop_coupon";i:26;s:10:"shop_order";i:27;s:17:"shop_order_refund";i:28;s:9:"soliloquy";i:29;s:12:"testimonials";i:30;s:18:"wpcf7_contact_form";}s:13:"backup_option";s:23:"backup_only_with_prefix";s:22:"media_migration_option";s:7:"compare";s:22:"save_migration_profile";s:1:"1";s:29:"save_migration_profile_option";s:1:"0";s:18:"create_new_profile";s:0:"";s:4:"name";s:16:"chaloke.com 2017";}}s:7:"licence";s:36:"e4e3dca6-1b5f-40fb-af38-f6ef7f8388a4";s:10:"verify_ssl";b:0;s:17:"blacklist_plugins";a:0:{}s:11:"max_request";i:1048576;s:22:"delay_between_requests";i:0;s:18:"prog_tables_hidden";b:1;s:21:"pause_before_finalize";b:0;}', 'no'),
(817, 'wpmdb_schema_version', '1', 'no'),
(818, 'db_upgraded', '', 'yes'),
(854, 'stats_cache', 'a:2:{s:32:"fa246539e4fd843b22d4a33cf8fbae8f";a:1:{i:1483801999;a:6:{i:0;a:4:{s:7:"post_id";s:1:"0";s:10:"post_title";s:9:"Home page";s:14:"post_permalink";s:21:"http://54.254.207.12/";s:5:"views";s:2:"29";}i:1;a:4:{s:7:"post_id";s:2:"72";s:10:"post_title";s:10:"CDC Forums";s:14:"post_permalink";s:42:"http://www.cupandhandle.co/2016/07/12/cdc/";s:5:"views";s:1:"4";}i:2;a:4:{s:7:"post_id";s:2:"81";s:10:"post_title";s:18:"ลานบุญ";s:14:"post_permalink";s:46:"http://www.cupandhandle.co/2016/07/12/charity/";s:5:"views";s:1:"2";}i:3;a:4:{s:7:"post_id";s:1:"5";s:10:"post_title";s:4:"Cart";s:14:"post_permalink";s:32:"http://www.cupandhandle.co/cart/";s:5:"views";s:1:"1";}i:4;a:4:{s:7:"post_id";s:2:"79";s:10:"post_title";s:15:"The Living Room";s:14:"post_permalink";s:54:"http://www.cupandhandle.co/2016/07/12/the-living-room/";s:5:"views";s:1:"1";}i:5;a:4:{s:7:"post_id";s:4:"5186";s:10:"post_title";s:21:"#5186 (loading title)";s:14:"post_permalink";s:0:"";s:5:"views";s:1:"1";}}}s:32:"3433a3950059abc750f59a4532cd159a";a:1:{i:1483801999;a:0:{}}}', 'yes'),
(1368, 'can_compress_scripts', '1', 'no'),
(1625, 'woocommerce_db_version', '2.6.11', 'yes'),
(1633, '_site_transient_as3cfpro_plugins_to_install_installer', 'a:0:{}', 'no'),
(1636, '_transient_woocommerce_cache_excluded_uris', 'a:6:{i:0;s:3:"p=5";i:1;s:6:"/cart/";i:2;s:3:"p=6";i:3;s:10:"/checkout/";i:4;s:3:"p=7";i:5;s:12:"/my-account/";}', 'yes'),
(1637, '_transient_woocommerce_webhook_ids', 'a:0:{}', 'yes'),
(1638, '_transient_wc_attribute_taxonomies', 'a:0:{}', 'yes'),
(1646, '_transient_timeout_tlc__2d390320bcac2fe819beba9f3460ecd0', '1515336306', 'no') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1647, '_transient_tlc__2d390320bcac2fe819beba9f3460ecd0', 'a:2:{i:0;i:1483800306;i:1;a:4:{s:3:"day";a:91:{i:0;s:8:"all time";i:1;s:5:"1 day";i:2;s:6:"2 days";i:3;s:6:"3 days";i:4;s:6:"4 days";i:5;s:6:"5 days";i:6;s:6:"6 days";i:7;s:6:"7 days";i:8;s:6:"8 days";i:9;s:6:"9 days";i:10;s:7:"10 days";i:11;s:7:"11 days";i:12;s:7:"12 days";i:13;s:7:"13 days";i:14;s:7:"14 days";i:15;s:7:"15 days";i:16;s:7:"16 days";i:17;s:7:"17 days";i:18;s:7:"18 days";i:19;s:7:"19 days";i:20;s:7:"20 days";i:21;s:7:"21 days";i:22;s:7:"22 days";i:23;s:7:"23 days";i:24;s:7:"24 days";i:25;s:7:"25 days";i:26;s:7:"26 days";i:27;s:7:"27 days";i:28;s:7:"28 days";i:29;s:7:"29 days";i:30;s:7:"30 days";i:31;s:7:"31 days";i:32;s:7:"32 days";i:33;s:7:"33 days";i:34;s:7:"34 days";i:35;s:7:"35 days";i:36;s:7:"36 days";i:37;s:7:"37 days";i:38;s:7:"38 days";i:39;s:7:"39 days";i:40;s:7:"40 days";i:41;s:7:"41 days";i:42;s:7:"42 days";i:43;s:7:"43 days";i:44;s:7:"44 days";i:45;s:7:"45 days";i:46;s:7:"46 days";i:47;s:7:"47 days";i:48;s:7:"48 days";i:49;s:7:"49 days";i:50;s:7:"50 days";i:51;s:7:"51 days";i:52;s:7:"52 days";i:53;s:7:"53 days";i:54;s:7:"54 days";i:55;s:7:"55 days";i:56;s:7:"56 days";i:57;s:7:"57 days";i:58;s:7:"58 days";i:59;s:7:"59 days";i:60;s:7:"60 days";i:61;s:7:"61 days";i:62;s:7:"62 days";i:63;s:7:"63 days";i:64;s:7:"64 days";i:65;s:7:"65 days";i:66;s:7:"66 days";i:67;s:7:"67 days";i:68;s:7:"68 days";i:69;s:7:"69 days";i:70;s:7:"70 days";i:71;s:7:"71 days";i:72;s:7:"72 days";i:73;s:7:"73 days";i:74;s:7:"74 days";i:75;s:7:"75 days";i:76;s:7:"76 days";i:77;s:7:"77 days";i:78;s:7:"78 days";i:79;s:7:"79 days";i:80;s:7:"80 days";i:81;s:7:"81 days";i:82;s:7:"82 days";i:83;s:7:"83 days";i:84;s:7:"84 days";i:85;s:7:"85 days";i:86;s:7:"86 days";i:87;s:7:"87 days";i:88;s:7:"88 days";i:89;s:7:"89 days";i:90;s:7:"90 days";}s:4:"week";a:53:{i:0;s:8:"all time";i:1;s:6:"1 week";i:2;s:7:"2 weeks";i:3;s:7:"3 weeks";i:4;s:7:"4 weeks";i:5;s:7:"5 weeks";i:6;s:7:"6 weeks";i:7;s:7:"7 weeks";i:8;s:7:"8 weeks";i:9;s:7:"9 weeks";i:10;s:8:"10 weeks";i:11;s:8:"11 weeks";i:12;s:8:"12 weeks";i:13;s:8:"13 weeks";i:14;s:8:"14 weeks";i:15;s:8:"15 weeks";i:16;s:8:"16 weeks";i:17;s:8:"17 weeks";i:18;s:8:"18 weeks";i:19;s:8:"19 weeks";i:20;s:8:"20 weeks";i:21;s:8:"21 weeks";i:22;s:8:"22 weeks";i:23;s:8:"23 weeks";i:24;s:8:"24 weeks";i:25;s:8:"25 weeks";i:26;s:8:"26 weeks";i:27;s:8:"27 weeks";i:28;s:8:"28 weeks";i:29;s:8:"29 weeks";i:30;s:8:"30 weeks";i:31;s:8:"31 weeks";i:32;s:8:"32 weeks";i:33;s:8:"33 weeks";i:34;s:8:"34 weeks";i:35;s:8:"35 weeks";i:36;s:8:"36 weeks";i:37;s:8:"37 weeks";i:38;s:8:"38 weeks";i:39;s:8:"39 weeks";i:40;s:8:"40 weeks";i:41;s:8:"41 weeks";i:42;s:8:"42 weeks";i:43;s:8:"43 weeks";i:44;s:8:"44 weeks";i:45;s:8:"45 weeks";i:46;s:8:"46 weeks";i:47;s:8:"47 weeks";i:48;s:8:"48 weeks";i:49;s:8:"49 weeks";i:50;s:8:"50 weeks";i:51;s:8:"51 weeks";i:52;s:8:"52 weeks";}s:5:"month";a:25:{i:0;s:8:"all time";i:1;s:7:"1 month";i:2;s:8:"2 months";i:3;s:8:"3 months";i:4;s:8:"4 months";i:5;s:8:"5 months";i:6;s:8:"6 months";i:7;s:8:"7 months";i:8;s:8:"8 months";i:9;s:8:"9 months";i:10;s:9:"10 months";i:11;s:9:"11 months";i:12;s:9:"12 months";i:13;s:9:"13 months";i:14;s:9:"14 months";i:15;s:9:"15 months";i:16;s:9:"16 months";i:17;s:9:"17 months";i:18;s:9:"18 months";i:19;s:9:"19 months";i:20;s:9:"20 months";i:21;s:9:"21 months";i:22;s:9:"22 months";i:23;s:9:"23 months";i:24;s:9:"24 months";}s:4:"year";a:6:{i:0;s:8:"all time";i:1;s:6:"1 year";i:2;s:7:"2 years";i:3;s:7:"3 years";i:4;s:7:"4 years";i:5;s:7:"5 years";}}}', 'no'),
(2168, '_transient_product_query-transient-version', '1483488385', 'yes'),
(2173, '_transient_shipping-transient-version', '1483488402', 'yes') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(2637, '_site_transient_timeout_wpmdb_upgrade_data', '1483560685', 'no'),
(2638, '_site_transient_wpmdb_upgrade_data', 'a:4:{s:17:"wp-migrate-db-pro";a:2:{s:7:"version";s:5:"1.7.1";s:6:"tested";s:3:"4.7";}s:29:"wp-migrate-db-pro-media-files";a:2:{s:7:"version";s:5:"1.4.7";s:6:"tested";s:3:"4.7";}s:21:"wp-migrate-db-pro-cli";a:2:{s:7:"version";s:3:"1.3";s:6:"tested";s:3:"4.7";}s:33:"wp-migrate-db-pro-multisite-tools";a:2:{s:7:"version";s:5:"1.1.5";s:6:"tested";s:3:"4.7";}}', 'no'),
(6188, 'soliloquy', 'a:5:{s:3:"key";s:32:"12d7fc2cb6e0656d9788f71a7f7f7f99";s:4:"type";s:9:"developer";s:10:"is_expired";b:0;s:11:"is_disabled";b:0;s:10:"is_invalid";b:0;}', 'yes'),
(6192, 'soliloquy-publishing-default', 'active', 'yes'),
(6193, 'soliloquy_slide_view', 'list', 'yes'),
(6194, 'widget_soliloquy', 'a:2:{s:12:"_multiwidget";i:1;i:3;a:2:{s:5:"title";s:4:"tete";s:12:"soliloquy_id";i:160;}}', 'yes'),
(6195, 'soliloquy_upgrade_cpts', '1', 'yes'),
(6445, 'soliloquy_license_updates', '1499261272', 'yes'),
(6460, 'soliloquy_slide_position', 'after', 'yes'),
(6483, 'soliloquy_default_slider', '113', 'yes'),
(7013, 'fresh_site', '0', 'yes'),
(7141, 'theme_mods_sf_cdc', 'a:7:{i:0;b:0;s:18:"nav_menu_locations";a:3:{s:7:"primary";i:6;s:8:"handheld";i:6;s:9:"secondary";i:7;}s:17:"storefront_styles";s:4645:"\n			.main-navigation ul li a,\n			.site-title a,\n			ul.menu li a,\n			.site-branding h1 a,\n			.site-footer .storefront-handheld-footer-bar a:not(.button),\n			button.menu-toggle,\n			button.menu-toggle:hover {\n				color: #d5d9db;\n			}\n\n			button.menu-toggle,\n			button.menu-toggle:hover {\n				border-color: #d5d9db;\n			}\n\n			.main-navigation ul li a:hover,\n			.main-navigation ul li:hover > a,\n			.site-title a:hover,\n			a.cart-contents:hover,\n			.site-header-cart .widget_shopping_cart a:hover,\n			.site-header-cart:hover > li > a,\n			.site-header ul.menu li.current-menu-item > a {\n				color: #ffffff;\n			}\n\n			table th {\n				background-color: #f8f8f8;\n			}\n\n			table tbody td {\n				background-color: #fdfdfd;\n			}\n\n			table tbody tr:nth-child(2n) td {\n				background-color: #fbfbfb;\n			}\n\n			.site-header,\n			.secondary-navigation ul ul,\n			.main-navigation ul.menu > li.menu-item-has-children:after,\n			.secondary-navigation ul.menu ul,\n			.storefront-handheld-footer-bar,\n			.storefront-handheld-footer-bar ul li > a,\n			.storefront-handheld-footer-bar ul li.search .site-search,\n			button.menu-toggle,\n			button.menu-toggle:hover {\n				background-color: #2c2d33;\n			}\n\n			p.site-description,\n			.site-header,\n			.storefront-handheld-footer-bar {\n				color: #9aa0a7;\n			}\n\n			.storefront-handheld-footer-bar ul li.cart .count,\n			button.menu-toggle:after,\n			button.menu-toggle:before,\n			button.menu-toggle span:before {\n				background-color: #d5d9db;\n			}\n\n			.storefront-handheld-footer-bar ul li.cart .count {\n				color: #2c2d33;\n			}\n\n			.storefront-handheld-footer-bar ul li.cart .count {\n				border-color: #2c2d33;\n			}\n\n			h1, h2, h3, h4, h5, h6 {\n				color: #484c51;\n			}\n\n			.widget h1 {\n				border-bottom-color: #484c51;\n			}\n\n			body,\n			.secondary-navigation a,\n			.onsale,\n			.pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current) {\n				color: #43454b;\n			}\n\n			.widget-area .widget a,\n			.hentry .entry-header .posted-on a,\n			.hentry .entry-header .byline a {\n				color: #75777d;\n			}\n\n			a  {\n				color: #96588a;\n			}\n\n			a:focus,\n			.button:focus,\n			.button.alt:focus,\n			.button.added_to_cart:focus,\n			.button.wc-forward:focus,\n			button:focus,\n			input[type="button"]:focus,\n			input[type="reset"]:focus,\n			input[type="submit"]:focus {\n				outline-color: #96588a;\n			}\n\n			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget a.button, .site-header-cart .widget_shopping_cart a.button {\n				background-color: #96588a;\n				border-color: #96588a;\n				color: #ffffff;\n			}\n\n			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {\n				background-color: #7d3f71;\n				border-color: #7d3f71;\n				color: #ffffff;\n			}\n\n			button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers.current, .widget a.button.checkout {\n				background-color: #2c2d33;\n				border-color: #2c2d33;\n				color: #ffffff;\n			}\n\n			button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover, .widget a.button.checkout:hover {\n				background-color: #13141a;\n				border-color: #13141a;\n				color: #ffffff;\n			}\n\n			#comments .comment-list .comment-content .comment-text {\n				background-color: #f8f8f8;\n			}\n\n			.site-footer {\n				background-color: #f0f0f0;\n				color: #61656b;\n			}\n\n			.site-footer a:not(.button) {\n				color: #2c2d33;\n			}\n\n			.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {\n				color: #494c50;\n			}\n\n			#order_review,\n			#payment .payment_methods > li .payment_box {\n				background-color: #ffffff;\n			}\n\n			#payment .payment_methods > li {\n				background-color: #fafafa;\n			}\n\n			#payment .payment_methods > li:hover {\n				background-color: #f5f5f5;\n			}\n\n			@media screen and ( min-width: 768px ) {\n				.secondary-navigation ul.menu a:hover {\n					color: #b3b9c0;\n				}\n\n				.secondary-navigation ul.menu a {\n					color: #9aa0a7;\n				}\n\n				.site-header-cart .widget_shopping_cart,\n				.main-navigation ul.menu ul.sub-menu,\n				.main-navigation ul.nav-menu ul.children {\n					background-color: #24252b;\n				}\n			}";s:29:"storefront_woocommerce_styles";s:2231:"\n			a.cart-contents,\n			.site-header-cart .widget_shopping_cart a {\n				color: #d5d9db;\n			}\n\n			table.cart td.product-remove,\n			table.cart td.actions {\n				border-top-color: #ffffff;\n			}\n\n			.woocommerce-tabs ul.tabs li.active a,\n			ul.products li.product .price,\n			.onsale,\n			.widget_search form:before,\n			.widget_product_search form:before {\n				color: #43454b;\n			}\n\n			.woocommerce-breadcrumb a,\n			a.woocommerce-review-link,\n			.product_meta a {\n				color: #75777d;\n			}\n\n			.onsale {\n				border-color: #43454b;\n			}\n\n			.star-rating span:before,\n			.quantity .plus, .quantity .minus,\n			p.stars a:hover:after,\n			p.stars a:after,\n			.star-rating span:before,\n			#payment .payment_methods li input[type=radio]:first-child:checked+label:before {\n				color: #96588a;\n			}\n\n			.widget_price_filter .ui-slider .ui-slider-range,\n			.widget_price_filter .ui-slider .ui-slider-handle {\n				background-color: #96588a;\n			}\n\n			.woocommerce-breadcrumb,\n			#reviews .commentlist li .comment_container {\n				background-color: #f8f8f8;\n			}\n\n			.order_details {\n				background-color: #f8f8f8;\n			}\n\n			.order_details li {\n				border-bottom: 1px dotted #e3e3e3;\n			}\n\n			.order_details:before,\n			.order_details:after {\n				background: -webkit-linear-gradient(transparent 0,transparent 0),-webkit-linear-gradient(135deg,#f8f8f8 33.33%,transparent 33.33%),-webkit-linear-gradient(45deg,#f8f8f8 33.33%,transparent 33.33%)\n			}\n\n			p.stars a:before,\n			p.stars a:hover~a:before,\n			p.stars.selected a.active~a:before {\n				color: #43454b;\n			}\n\n			p.stars.selected a.active:before,\n			p.stars:hover a:before,\n			p.stars.selected a:not(.active):before,\n			p.stars.selected a.active:before {\n				color: #96588a;\n			}\n\n			.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger {\n				background-color: #96588a;\n				color: #ffffff;\n			}\n\n			.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover {\n				background-color: #7d3f71;\n				border-color: #7d3f71;\n				color: #ffffff;\n			}\n\n			@media screen and ( min-width: 768px ) {\n				.site-header-cart .widget_shopping_cart,\n				.site-header .product_list_widget li .quantity {\n					color: #9aa0a7;\n				}\n			}";s:39:"storefront_woocommerce_extension_styles";s:0:"";s:18:"custom_css_post_id";i:-1;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1483795307;s:4:"data";a:7:{s:19:"wp_inactive_widgets";a:13:{i:0;s:7:"pages-3";i:1;s:7:"pages-4";i:2;s:10:"calendar-3";i:3;s:10:"calendar-4";i:4;s:6:"meta-2";i:5;s:8:"search-2";i:6;s:12:"categories-2";i:7;s:14:"recent-posts-4";i:8;s:17:"recent-comments-2";i:9;s:5:"rss-3";i:10;s:18:"bbp_login_widget-3";i:11;s:18:"bbp_login_widget-4";i:12;s:20:"bbp_replies_widget-3";}s:9:"sidebar-1";a:5:{i:0;s:8:"search-4";i:1;s:19:"bbp_topics_widget-6";i:2;s:18:"facebook-likebox-2";i:3;s:33:"wpcom_social_media_icons_widget-2";i:4;s:10:"archives-2";}s:8:"header-1";a:0:{}s:8:"footer-1";a:2:{i:0;s:19:"bbp_forums_widget-3";i:1;s:10:"nav_menu-3";}s:8:"footer-2";a:1:{i:0;s:19:"bbp_topics_widget-4";}s:8:"footer-3";a:1:{i:0;s:19:"bbp_topics_widget-3";}s:8:"footer-4";a:2:{i:0;s:19:"bbp_topics_widget-5";i:1;s:19:"blog_subscription-2";}}}}', 'yes'),
(7329, 'w3tc_state', '{"common.install":1483789333,"common.show_note.plugins_updated":true,"common.show_note.plugins_updated.timestamp":1499186815}', 'no'),
(7568, 'theme_mods_twentyfifteen', 'a:3:{s:18:"custom_css_post_id";i:-1;s:18:"nav_menu_locations";a:3:{s:7:"primary";i:6;s:8:"handheld";i:6;s:9:"secondary";i:7;}s:16:"sidebars_widgets";a:2:{s:4:"time";i:1483794875;s:4:"data";a:7:{s:19:"wp_inactive_widgets";a:13:{i:0;s:7:"pages-3";i:1;s:7:"pages-4";i:2;s:10:"calendar-3";i:3;s:10:"calendar-4";i:4;s:6:"meta-2";i:5;s:8:"search-2";i:6;s:12:"categories-2";i:7;s:14:"recent-posts-4";i:8;s:17:"recent-comments-2";i:9;s:5:"rss-3";i:10;s:18:"bbp_login_widget-3";i:11;s:18:"bbp_login_widget-4";i:12;s:20:"bbp_replies_widget-3";}s:9:"sidebar-1";a:5:{i:0;s:8:"search-4";i:1;s:19:"bbp_topics_widget-6";i:2;s:18:"facebook-likebox-2";i:3;s:33:"wpcom_social_media_icons_widget-2";i:4;s:10:"archives-2";}s:8:"header-1";a:0:{}s:8:"footer-1";a:2:{i:0;s:19:"bbp_forums_widget-3";i:1;s:10:"nav_menu-3";}s:8:"footer-2";a:1:{i:0;s:19:"bbp_topics_widget-4";}s:8:"footer-3";a:1:{i:0;s:19:"bbp_topics_widget-3";}s:8:"footer-4";a:2:{i:0;s:19:"bbp_topics_widget-5";i:1;s:19:"blog_subscription-2";}}}}', 'yes'),
(7651, 'theme_switched_via_customizer', '', 'yes'),
(7652, 'customize_stashed_theme_mods', 'a:0:{}', 'no'),
(7780, 'storefront-powerpack-version', '1.3.0', 'yes'),
(7995, 'rewrite_rules', 'a:288:{s:9:"forums/?$";s:25:"index.php?post_type=forum";s:39:"forums/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?post_type=forum&feed=$matches[1]";s:34:"forums/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?post_type=forum&feed=$matches[1]";s:26:"forums/page/([0-9]{1,})/?$";s:43:"index.php?post_type=forum&paged=$matches[1]";s:9:"topics/?$";s:25:"index.php?post_type=topic";s:39:"topics/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?post_type=topic&feed=$matches[1]";s:34:"topics/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?post_type=topic&feed=$matches[1]";s:26:"topics/page/([0-9]{1,})/?$";s:43:"index.php?post_type=topic&paged=$matches[1]";s:28:"forums/forum/([^/]+)/edit/?$";s:34:"index.php?forum=$matches[1]&edit=1";s:28:"forums/topic/([^/]+)/edit/?$";s:34:"index.php?topic=$matches[1]&edit=1";s:28:"forums/reply/([^/]+)/edit/?$";s:34:"index.php?reply=$matches[1]&edit=1";s:32:"forums/topic-tag/([^/]+)/edit/?$";s:38:"index.php?topic-tag=$matches[1]&edit=1";s:48:"forums/users/([^/]+)/topics/page/?([0-9]{1,})/?$";s:59:"index.php?bbp_user=$matches[1]&bbp_tops=1&paged=$matches[2]";s:49:"forums/users/([^/]+)/replies/page/?([0-9]{1,})/?$";s:59:"index.php?bbp_user=$matches[1]&bbp_reps=1&paged=$matches[2]";s:51:"forums/users/([^/]+)/favorites/page/?([0-9]{1,})/?$";s:59:"index.php?bbp_user=$matches[1]&bbp_favs=1&paged=$matches[2]";s:55:"forums/users/([^/]+)/subscriptions/page/?([0-9]{1,})/?$";s:59:"index.php?bbp_user=$matches[1]&bbp_subs=1&paged=$matches[2]";s:30:"forums/users/([^/]+)/topics/?$";s:41:"index.php?bbp_user=$matches[1]&bbp_tops=1";s:31:"forums/users/([^/]+)/replies/?$";s:41:"index.php?bbp_user=$matches[1]&bbp_reps=1";s:33:"forums/users/([^/]+)/favorites/?$";s:41:"index.php?bbp_user=$matches[1]&bbp_favs=1";s:37:"forums/users/([^/]+)/subscriptions/?$";s:41:"index.php?bbp_user=$matches[1]&bbp_subs=1";s:28:"forums/users/([^/]+)/edit/?$";s:37:"index.php?bbp_user=$matches[1]&edit=1";s:23:"forums/users/([^/]+)/?$";s:30:"index.php?bbp_user=$matches[1]";s:40:"forums/view/([^/]+)/page/?([0-9]{1,})/?$";s:48:"index.php?bbp_view=$matches[1]&paged=$matches[2]";s:27:"forums/view/([^/]+)/feed/?$";s:47:"index.php?bbp_view=$matches[1]&feed=$matches[2]";s:22:"forums/view/([^/]+)/?$";s:30:"index.php?bbp_view=$matches[1]";s:34:"forums/search/page/?([0-9]{1,})/?$";s:27:"index.php?paged=$matches[1]";s:16:"forums/search/?$";s:20:"index.php?bbp_search";s:24:"^wc-auth/v([1]{1})/(.*)?";s:63:"index.php?wc-auth-version=$matches[1]&wc-auth-route=$matches[2]";s:22:"^wc-api/v([1-3]{1})/?$";s:51:"index.php?wc-api-version=$matches[1]&wc-api-route=/";s:24:"^wc-api/v([1-3]{1})(.*)?";s:61:"index.php?wc-api-version=$matches[1]&wc-api-route=$matches[2]";s:7:"shop/?$";s:27:"index.php?post_type=product";s:37:"shop/feed/(feed|rdf|rss|rss2|atom)/?$";s:44:"index.php?post_type=product&feed=$matches[1]";s:32:"shop/(feed|rdf|rss|rss2|atom)/?$";s:44:"index.php?post_type=product&feed=$matches[1]";s:24:"shop/page/([0-9]{1,})/?$";s:45:"index.php?post_type=product&paged=$matches[1]";s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:21:"^index.php/wp-json/?$";s:22:"index.php?rest_route=/";s:24:"^index.php/wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:16:"featured_post/?$";s:33:"index.php?post_type=featured_post";s:46:"featured_post/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_type=featured_post&feed=$matches[1]";s:41:"featured_post/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_type=featured_post&feed=$matches[1]";s:33:"featured_post/page/([0-9]{1,})/?$";s:51:"index.php?post_type=featured_post&paged=$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:23:"category/(.+?)/embed/?$";s:46:"index.php?category_name=$matches[1]&embed=true";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:32:"category/(.+?)/wc-api(/(.*))?/?$";s:54:"index.php?category_name=$matches[1]&wc-api=$matches[3]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:20:"tag/([^/]+)/embed/?$";s:36:"index.php?tag=$matches[1]&embed=true";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:29:"tag/([^/]+)/wc-api(/(.*))?/?$";s:44:"index.php?tag=$matches[1]&wc-api=$matches[3]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:21:"type/([^/]+)/embed/?$";s:44:"index.php?post_format=$matches[1]&embed=true";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:38:"forums/forum/.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:48:"forums/forum/.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:68:"forums/forum/.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:63:"forums/forum/.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:63:"forums/forum/.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:44:"forums/forum/.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:27:"forums/forum/(.+?)/embed/?$";s:38:"index.php?forum=$matches[1]&embed=true";s:31:"forums/forum/(.+?)/trackback/?$";s:32:"index.php?forum=$matches[1]&tb=1";s:51:"forums/forum/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:44:"index.php?forum=$matches[1]&feed=$matches[2]";s:46:"forums/forum/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:44:"index.php?forum=$matches[1]&feed=$matches[2]";s:39:"forums/forum/(.+?)/page/?([0-9]{1,})/?$";s:45:"index.php?forum=$matches[1]&paged=$matches[2]";s:46:"forums/forum/(.+?)/comment-page-([0-9]{1,})/?$";s:45:"index.php?forum=$matches[1]&cpage=$matches[2]";s:36:"forums/forum/(.+?)/wc-api(/(.*))?/?$";s:46:"index.php?forum=$matches[1]&wc-api=$matches[3]";s:42:"forums/forum/.+?/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:53:"forums/forum/.+?/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:35:"forums/forum/(.+?)(?:/([0-9]+))?/?$";s:44:"index.php?forum=$matches[1]&page=$matches[2]";s:40:"forums/topic/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:50:"forums/topic/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:70:"forums/topic/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:65:"forums/topic/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:65:"forums/topic/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:46:"forums/topic/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:29:"forums/topic/([^/]+)/embed/?$";s:38:"index.php?topic=$matches[1]&embed=true";s:33:"forums/topic/([^/]+)/trackback/?$";s:32:"index.php?topic=$matches[1]&tb=1";s:53:"forums/topic/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:44:"index.php?topic=$matches[1]&feed=$matches[2]";s:48:"forums/topic/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:44:"index.php?topic=$matches[1]&feed=$matches[2]";s:41:"forums/topic/([^/]+)/page/?([0-9]{1,})/?$";s:45:"index.php?topic=$matches[1]&paged=$matches[2]";s:48:"forums/topic/([^/]+)/comment-page-([0-9]{1,})/?$";s:45:"index.php?topic=$matches[1]&cpage=$matches[2]";s:38:"forums/topic/([^/]+)/wc-api(/(.*))?/?$";s:46:"index.php?topic=$matches[1]&wc-api=$matches[3]";s:44:"forums/topic/[^/]+/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:55:"forums/topic/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:37:"forums/topic/([^/]+)(?:/([0-9]+))?/?$";s:44:"index.php?topic=$matches[1]&page=$matches[2]";s:29:"forums/topic/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:39:"forums/topic/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:59:"forums/topic/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:54:"forums/topic/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:54:"forums/topic/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:35:"forums/topic/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:40:"forums/reply/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:50:"forums/reply/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:70:"forums/reply/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:65:"forums/reply/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:65:"forums/reply/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:46:"forums/reply/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:29:"forums/reply/([^/]+)/embed/?$";s:38:"index.php?reply=$matches[1]&embed=true";s:33:"forums/reply/([^/]+)/trackback/?$";s:32:"index.php?reply=$matches[1]&tb=1";s:41:"forums/reply/([^/]+)/page/?([0-9]{1,})/?$";s:45:"index.php?reply=$matches[1]&paged=$matches[2]";s:48:"forums/reply/([^/]+)/comment-page-([0-9]{1,})/?$";s:45:"index.php?reply=$matches[1]&cpage=$matches[2]";s:38:"forums/reply/([^/]+)/wc-api(/(.*))?/?$";s:46:"index.php?reply=$matches[1]&wc-api=$matches[3]";s:44:"forums/reply/[^/]+/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:55:"forums/reply/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:37:"forums/reply/([^/]+)(?:/([0-9]+))?/?$";s:44:"index.php?reply=$matches[1]&page=$matches[2]";s:29:"forums/reply/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:39:"forums/reply/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:59:"forums/reply/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:54:"forums/reply/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:54:"forums/reply/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:35:"forums/reply/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:57:"forums/topic-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:48:"index.php?topic-tag=$matches[1]&feed=$matches[2]";s:52:"forums/topic-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:48:"index.php?topic-tag=$matches[1]&feed=$matches[2]";s:33:"forums/topic-tag/([^/]+)/embed/?$";s:42:"index.php?topic-tag=$matches[1]&embed=true";s:45:"forums/topic-tag/([^/]+)/page/?([0-9]{1,})/?$";s:49:"index.php?topic-tag=$matches[1]&paged=$matches[2]";s:27:"forums/topic-tag/([^/]+)/?$";s:31:"index.php?topic-tag=$matches[1]";s:42:"forums/search/([^/]+)/page/?([0-9]{1,})/?$";s:50:"index.php?bbp_search=$matches[1]&paged=$matches[2]";s:24:"forums/search/([^/]+)/?$";s:32:"index.php?bbp_search=$matches[1]";s:55:"product-category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?product_cat=$matches[1]&feed=$matches[2]";s:50:"product-category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?product_cat=$matches[1]&feed=$matches[2]";s:31:"product-category/(.+?)/embed/?$";s:44:"index.php?product_cat=$matches[1]&embed=true";s:43:"product-category/(.+?)/page/?([0-9]{1,})/?$";s:51:"index.php?product_cat=$matches[1]&paged=$matches[2]";s:25:"product-category/(.+?)/?$";s:33:"index.php?product_cat=$matches[1]";s:52:"product-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?product_tag=$matches[1]&feed=$matches[2]";s:47:"product-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?product_tag=$matches[1]&feed=$matches[2]";s:28:"product-tag/([^/]+)/embed/?$";s:44:"index.php?product_tag=$matches[1]&embed=true";s:40:"product-tag/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?product_tag=$matches[1]&paged=$matches[2]";s:22:"product-tag/([^/]+)/?$";s:33:"index.php?product_tag=$matches[1]";s:35:"product/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:45:"product/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:65:"product/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:60:"product/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:60:"product/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:41:"product/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:24:"product/([^/]+)/embed/?$";s:40:"index.php?product=$matches[1]&embed=true";s:28:"product/([^/]+)/trackback/?$";s:34:"index.php?product=$matches[1]&tb=1";s:48:"product/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:46:"index.php?product=$matches[1]&feed=$matches[2]";s:43:"product/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:46:"index.php?product=$matches[1]&feed=$matches[2]";s:36:"product/([^/]+)/page/?([0-9]{1,})/?$";s:47:"index.php?product=$matches[1]&paged=$matches[2]";s:43:"product/([^/]+)/comment-page-([0-9]{1,})/?$";s:47:"index.php?product=$matches[1]&cpage=$matches[2]";s:33:"product/([^/]+)/wc-api(/(.*))?/?$";s:48:"index.php?product=$matches[1]&wc-api=$matches[3]";s:39:"product/[^/]+/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:50:"product/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:32:"product/([^/]+)(?:/([0-9]+))?/?$";s:46:"index.php?product=$matches[1]&page=$matches[2]";s:24:"product/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:34:"product/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:54:"product/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:49:"product/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:49:"product/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:30:"product/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:56:"ticker-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:59:"index.php?wptu-ticker-category=$matches[1]&feed=$matches[2]";s:51:"ticker-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:59:"index.php?wptu-ticker-category=$matches[1]&feed=$matches[2]";s:32:"ticker-category/([^/]+)/embed/?$";s:53:"index.php?wptu-ticker-category=$matches[1]&embed=true";s:44:"ticker-category/([^/]+)/page/?([0-9]{1,})/?$";s:60:"index.php?wptu-ticker-category=$matches[1]&paged=$matches[2]";s:26:"ticker-category/([^/]+)/?$";s:42:"index.php?wptu-ticker-category=$matches[1]";s:41:"featured_post/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:51:"featured_post/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:71:"featured_post/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:66:"featured_post/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:66:"featured_post/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:47:"featured_post/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:30:"featured_post/([^/]+)/embed/?$";s:46:"index.php?featured_post=$matches[1]&embed=true";s:34:"featured_post/([^/]+)/trackback/?$";s:40:"index.php?featured_post=$matches[1]&tb=1";s:54:"featured_post/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?featured_post=$matches[1]&feed=$matches[2]";s:49:"featured_post/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?featured_post=$matches[1]&feed=$matches[2]";s:42:"featured_post/([^/]+)/page/?([0-9]{1,})/?$";s:53:"index.php?featured_post=$matches[1]&paged=$matches[2]";s:49:"featured_post/([^/]+)/comment-page-([0-9]{1,})/?$";s:53:"index.php?featured_post=$matches[1]&cpage=$matches[2]";s:39:"featured_post/([^/]+)/wc-api(/(.*))?/?$";s:54:"index.php?featured_post=$matches[1]&wc-api=$matches[3]";s:45:"featured_post/[^/]+/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:56:"featured_post/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:38:"featured_post/([^/]+)(?:/([0-9]+))?/?$";s:52:"index.php?featured_post=$matches[1]&page=$matches[2]";s:30:"featured_post/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:40:"featured_post/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:60:"featured_post/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:55:"featured_post/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:55:"featured_post/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:36:"featured_post/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:56:"wpfcas-category/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:54:"index.php?wpfcas-category=$matches[1]&feed=$matches[2]";s:51:"wpfcas-category/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:54:"index.php?wpfcas-category=$matches[1]&feed=$matches[2]";s:32:"wpfcas-category/([^/]+)/embed/?$";s:48:"index.php?wpfcas-category=$matches[1]&embed=true";s:44:"wpfcas-category/([^/]+)/page/?([0-9]{1,})/?$";s:55:"index.php?wpfcas-category=$matches[1]&paged=$matches[2]";s:26:"wpfcas-category/([^/]+)/?$";s:37:"index.php?wpfcas-category=$matches[1]";s:12:"robots\\.txt$";s:18:"index.php?robots=1";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:8:"embed/?$";s:21:"index.php?&embed=true";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:17:"wc-api(/(.*))?/?$";s:29:"index.php?&wc-api=$matches[2]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:17:"comments/embed/?$";s:21:"index.php?&embed=true";s:26:"comments/wc-api(/(.*))?/?$";s:29:"index.php?&wc-api=$matches[2]";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:20:"search/(.+)/embed/?$";s:34:"index.php?s=$matches[1]&embed=true";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:29:"search/(.+)/wc-api(/(.*))?/?$";s:42:"index.php?s=$matches[1]&wc-api=$matches[3]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:23:"author/([^/]+)/embed/?$";s:44:"index.php?author_name=$matches[1]&embed=true";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:32:"author/([^/]+)/wc-api(/(.*))?/?$";s:52:"index.php?author_name=$matches[1]&wc-api=$matches[3]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:45:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$";s:74:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:54:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/wc-api(/(.*))?/?$";s:82:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&wc-api=$matches[5]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:32:"([0-9]{4})/([0-9]{1,2})/embed/?$";s:58:"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:41:"([0-9]{4})/([0-9]{1,2})/wc-api(/(.*))?/?$";s:66:"index.php?year=$matches[1]&monthnum=$matches[2]&wc-api=$matches[4]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:19:"([0-9]{4})/embed/?$";s:37:"index.php?year=$matches[1]&embed=true";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:28:"([0-9]{4})/wc-api(/(.*))?/?$";s:45:"index.php?year=$matches[1]&wc-api=$matches[3]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:53:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$";s:91:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:62:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/wc-api(/(.*))?/?$";s:99:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&wc-api=$matches[6]";s:62:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:73:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:61:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:53:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:25:"(.?.+?)/wc-api(/(.*))?/?$";s:49:"index.php?pagename=$matches[1]&wc-api=$matches[3]";s:28:"(.?.+?)/order-pay(/(.*))?/?$";s:52:"index.php?pagename=$matches[1]&order-pay=$matches[3]";s:33:"(.?.+?)/order-received(/(.*))?/?$";s:57:"index.php?pagename=$matches[1]&order-received=$matches[3]";s:25:"(.?.+?)/orders(/(.*))?/?$";s:49:"index.php?pagename=$matches[1]&orders=$matches[3]";s:29:"(.?.+?)/view-order(/(.*))?/?$";s:53:"index.php?pagename=$matches[1]&view-order=$matches[3]";s:28:"(.?.+?)/downloads(/(.*))?/?$";s:52:"index.php?pagename=$matches[1]&downloads=$matches[3]";s:31:"(.?.+?)/edit-account(/(.*))?/?$";s:55:"index.php?pagename=$matches[1]&edit-account=$matches[3]";s:31:"(.?.+?)/edit-address(/(.*))?/?$";s:55:"index.php?pagename=$matches[1]&edit-address=$matches[3]";s:34:"(.?.+?)/payment-methods(/(.*))?/?$";s:58:"index.php?pagename=$matches[1]&payment-methods=$matches[3]";s:32:"(.?.+?)/lost-password(/(.*))?/?$";s:56:"index.php?pagename=$matches[1]&lost-password=$matches[3]";s:34:"(.?.+?)/customer-logout(/(.*))?/?$";s:58:"index.php?pagename=$matches[1]&customer-logout=$matches[3]";s:37:"(.?.+?)/add-payment-method(/(.*))?/?$";s:61:"index.php?pagename=$matches[1]&add-payment-method=$matches[3]";s:40:"(.?.+?)/delete-payment-method(/(.*))?/?$";s:64:"index.php?pagename=$matches[1]&delete-payment-method=$matches[3]";s:45:"(.?.+?)/set-default-payment-method(/(.*))?/?$";s:69:"index.php?pagename=$matches[1]&set-default-payment-method=$matches[3]";s:31:"(.?.+?)/members-area(/(.*))?/?$";s:55:"index.php?pagename=$matches[1]&members-area=$matches[3]";s:36:"(.?.+?)/view-subscription(/(.*))?/?$";s:60:"index.php?pagename=$matches[1]&view-subscription=$matches[3]";s:32:"(.?.+?)/subscriptions(/(.*))?/?$";s:56:"index.php?pagename=$matches[1]&subscriptions=$matches[3]";s:31:".?.+?/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:42:".?.+?/attachment/([^/]+)/wc-api(/(.*))?/?$";s:51:"index.php?attachment=$matches[1]&wc-api=$matches[3]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes'),
(8049, 'post_by_email_address1', 'NULL', 'yes'),
(8050, 'monitor_receive_notifications', '1', 'yes'),
(8123, 'jetpack_nonce_1483802599_QhwaS8pzko', '1483802600', 'no'),
(8126, 'jetpack_sync_settings_disable', '0', 'yes'),
(8127, 'jpsq_sync-1483802604.241363-46898-10', 'a:5:{i:0;s:18:"deactivated_plugin";i:1;a:2:{i:0;s:19:"jetpack/jetpack.php";i:1;b:0;}i:2;i:1;i:3;d:1483802604.2413571;i:4;b:0;}', 'no'),
(8128, 'jpsq_sync-1483802604.258914-46898-11', 'a:5:{i:0;s:14:"updated_option";i:1;a:3:{i:0;s:14:"active_plugins";i:1;a:28:{i:0;s:19:"akismet/akismet.php";i:1;s:61:"amazon-s3-and-cloudfront-pro/amazon-s3-and-cloudfront-pro.php";i:2;s:77:"amazon-s3-and-cloudfront-woocommerce/amazon-s3-and-cloudfront-woocommerce.php";i:3;s:43:"amazon-web-services/amazon-web-services.php";i:4;s:19:"bbpress/bbpress.php";i:5;s:49:"cimy-user-extra-fields/cimy_user_extra_fields.php";i:6;s:39:"cimy-user-manager/cimy_user_manager.php";i:7;s:49:"gd-bbpress-attachments/gd-bbpress-attachments.php";i:8;s:37:"gd-bbpress-tools/gd-bbpress-tools.php";i:9;s:19:"jetpack/jetpack.php";i:10;s:27:"redis-cache/redis-cache.php";i:11;s:41:"soliloquy-defaults/soliloquy-defaults.php";i:12;s:57:"soliloquy-featured-content/soliloquy-featured-content.php";i:13;s:45:"soliloquy-thumbnails/soliloquy-thumbnails.php";i:14;s:23:"soliloquy/soliloquy.php";i:15;s:57:"storefront-blog-customiser/storefront-blog-customiser.php";i:16;s:43:"storefront-designer/storefront-designer.php";i:17;s:45:"storefront-powerpack/storefront-powerpack.php";i:18;s:52:"theme-customisations-master/theme-customisations.php";i:19;s:37:"tinymce-advanced/tinymce-advanced.php";i:20;s:33:"w3-total-cache/w3-total-cache.php";i:21;s:51:"woocommerce-memberships/woocommerce-memberships.php";i:22;s:55:"woocommerce-subscriptions/woocommerce-subscriptions.php";i:23;s:27:"woocommerce/woocommerce.php";i:24;s:39:"woothemes-updater/woothemes-updater.php";i:25;s:63:"wp-migrate-db-pro-media-files/wp-migrate-db-pro-media-files.php";i:26;s:39:"wp-migrate-db-pro/wp-migrate-db-pro.php";i:27;s:33:"wp-user-avatar/wp-user-avatar.php";}i:2;a:27:{i:0;s:19:"akismet/akismet.php";i:1;s:61:"amazon-s3-and-cloudfront-pro/amazon-s3-and-cloudfront-pro.php";i:2;s:77:"amazon-s3-and-cloudfront-woocommerce/amazon-s3-and-cloudfront-woocommerce.php";i:3;s:43:"amazon-web-services/amazon-web-services.php";i:4;s:19:"bbpress/bbpress.php";i:5;s:49:"cimy-user-extra-fields/cimy_user_extra_fields.php";i:6;s:39:"cimy-user-manager/cimy_user_manager.php";i:7;s:49:"gd-bbpress-attachments/gd-bbpress-attachments.php";i:8;s:37:"gd-bbpress-tools/gd-bbpress-tools.php";i:10;s:27:"redis-cache/redis-cache.php";i:11;s:41:"soliloquy-defaults/soliloquy-defaults.php";i:12;s:57:"soliloquy-featured-content/soliloquy-featured-content.php";i:13;s:45:"soliloquy-thumbnails/soliloquy-thumbnails.php";i:14;s:23:"soliloquy/soliloquy.php";i:15;s:57:"storefront-blog-customiser/storefront-blog-customiser.php";i:16;s:43:"storefront-designer/storefront-designer.php";i:17;s:45:"storefront-powerpack/storefront-powerpack.php";i:18;s:52:"theme-customisations-master/theme-customisations.php";i:19;s:37:"tinymce-advanced/tinymce-advanced.php";i:20;s:33:"w3-total-cache/w3-total-cache.php";i:21;s:51:"woocommerce-memberships/woocommerce-memberships.php";i:22;s:55:"woocommerce-subscriptions/woocommerce-subscriptions.php";i:23;s:27:"woocommerce/woocommerce.php";i:24;s:39:"woothemes-updater/woothemes-updater.php";i:25;s:63:"wp-migrate-db-pro-media-files/wp-migrate-db-pro-media-files.php";i:26;s:39:"wp-migrate-db-pro/wp-migrate-db-pro.php";i:27;s:33:"wp-user-avatar/wp-user-avatar.php";}}i:2;i:1;i:3;d:1483802604.258909;i:4;b:0;}', 'no'),
(8129, 'jpsq_sync-1483802604.268863-46898-12', 'a:5:{i:0;s:21:"jetpack_sync_constant";i:1;a:2:{i:0;s:16:"EMPTY_TRASH_DAYS";i:1;i:30;}i:2;i:1;i:3;d:1483802604.2688589;i:4;b:0;}', 'no'),
(8130, 'jpsq_sync-1483802604.272952-46898-13', 'a:5:{i:0;s:21:"jetpack_sync_constant";i:1;a:2:{i:0;s:17:"WP_POST_REVISIONS";i:1;b:1;}i:2;i:1;i:3;d:1483802604.2729499;i:4;b:0;}', 'no'),
(8131, 'jpsq_sync-1483802604.276457-46898-14', 'a:5:{i:0;s:21:"jetpack_sync_constant";i:1;a:2:{i:0;s:7:"ABSPATH";i:1;s:17:"/var/www/staging/";}i:2;i:1;i:3;d:1483802604.276453;i:4;b:0;}', 'no'),
(8132, 'jpsq_sync-1483802604.280355-46898-15', 'a:5:{i:0;s:21:"jetpack_sync_constant";i:1;a:2:{i:0;s:14:"WP_CONTENT_DIR";i:1;s:27:"/var/www/staging/wp-content";}i:2;i:1;i:3;d:1483802604.2803531;i:4;b:0;}', 'no'),
(8133, 'jpsq_sync-1483802604.284133-46898-16', 'a:5:{i:0;s:21:"jetpack_sync_constant";i:1;a:2:{i:0;s:16:"JETPACK__VERSION";i:1;s:5:"4.4.2";}i:2;i:1;i:3;d:1483802604.2841301;i:4;b:0;}', 'no'),
(8134, 'jpsq_sync-1483802604.287786-46898-17', 'a:5:{i:0;s:21:"jetpack_sync_constant";i:1;a:2:{i:0;s:20:"WP_CRON_LOCK_TIMEOUT";i:1;i:60;}i:2;i:1;i:3;d:1483802604.2877829;i:4;b:0;}', 'no'),
(8135, 'jetpack_constants_sync_checksum', 'a:16:{s:16:"EMPTY_TRASH_DAYS";i:2473281379;s:17:"WP_POST_REVISIONS";i:4261170317;s:26:"AUTOMATIC_UPDATER_DISABLED";i:634125391;s:7:"ABSPATH";i:2875356350;s:14:"WP_CONTENT_DIR";i:1211260673;s:9:"FS_METHOD";i:634125391;s:18:"DISALLOW_FILE_EDIT";i:634125391;s:18:"DISALLOW_FILE_MODS";i:634125391;s:19:"WP_AUTO_UPDATE_CORE";i:634125391;s:22:"WP_HTTP_BLOCK_EXTERNAL";i:634125391;s:19:"WP_ACCESSIBLE_HOSTS";i:634125391;s:16:"JETPACK__VERSION";i:1373516444;s:12:"IS_PRESSABLE";i:634125391;s:15:"DISABLE_WP_CRON";i:634125391;s:17:"ALTERNATE_WP_CRON";i:634125391;s:20:"WP_CRON_LOCK_TIMEOUT";i:3994858278;}', 'yes'),
(8136, 'jetpack_sync_https_history_main_network_site_url', 'a:1:{i:0;N;}', 'yes'),
(8137, 'jetpack_sync_https_history_site_url', 'a:1:{i:0;N;}', 'yes'),
(8138, 'jetpack_sync_https_history_home_url', 'a:1:{i:0;N;}', 'yes'),
(8139, 'jpsq_sync-1483802604.331254-46898-18', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:18:"wp_max_upload_size";i:1;i:2097152;}i:2;i:1;i:3;d:1483802604.3312509;i:4;b:0;}', 'no'),
(8140, 'jpsq_sync-1483802604.334946-46898-19', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:15:"is_main_network";i:1;b:0;}i:2;i:1;i:3;d:1483802604.3349431;i:4;b:0;}', 'no'),
(8141, 'jpsq_sync-1483802604.338655-46898-20', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:13:"is_multi_site";i:1;b:0;}i:2;i:1;i:3;d:1483802604.3386519;i:4;b:0;}', 'no'),
(8142, 'jpsq_sync-1483802604.342827-46898-21', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:17:"main_network_site";i:1;s:0:"";}i:2;i:1;i:3;d:1483802604.3428249;i:4;b:0;}', 'no'),
(8143, 'jpsq_sync-1483802604.346768-46898-22', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:8:"site_url";i:1;s:3:"://";}i:2;i:1;i:3;d:1483802604.346766;i:4;b:0;}', 'no'),
(8144, 'jpsq_sync-1483802604.350478-46898-23', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:8:"home_url";i:1;s:14:"://52.76.37.90";}i:2;i:1;i:3;d:1483802604.3504751;i:4;b:0;}', 'no'),
(8145, 'jpsq_sync-1483802604.354190-46898-24', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:16:"single_user_site";i:1;b:0;}i:2;i:1;i:3;d:1483802604.354188;i:4;b:0;}', 'no'),
(8146, 'jpsq_sync-1483802604.358137-46898-25', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:7:"updates";i:1;a:5:{s:7:"plugins";i:0;s:6:"themes";i:0;s:9:"wordpress";i:0;s:12:"translations";i:0;s:5:"total";i:0;}}i:2;i:1;i:3;d:1483802604.358135;i:4;b:0;}', 'no'),
(8147, 'jpsq_sync-1483802604.361839-46898-26', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:28:"has_file_system_write_access";i:1;b:1;}i:2;i:1;i:3;d:1483802604.3618369;i:4;b:0;}', 'no'),
(8148, 'jpsq_sync-1483802604.365583-46898-27', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:21:"is_version_controlled";i:1;b:1;}i:2;i:1;i:3;d:1483802604.3655801;i:4;b:0;}', 'no') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(8149, 'jpsq_sync-1483802604.369628-46898-28', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:10:"taxonomies";i:1;a:11:{s:8:"category";O:11:"WP_Taxonomy":23:{s:4:"name";s:8:"category";s:5:"label";s:10:"Categories";s:6:"labels";O:8:"stdClass":21:{s:4:"name";s:10:"Categories";s:13:"singular_name";s:8:"Category";s:12:"search_items";s:17:"Search Categories";s:13:"popular_items";N;s:9:"all_items";s:14:"All Categories";s:11:"parent_item";s:15:"Parent Category";s:17:"parent_item_colon";s:16:"Parent Category:";s:9:"edit_item";s:13:"Edit Category";s:9:"view_item";s:13:"View Category";s:11:"update_item";s:15:"Update Category";s:12:"add_new_item";s:16:"Add New Category";s:13:"new_item_name";s:17:"New Category Name";s:26:"separate_items_with_commas";N;s:19:"add_or_remove_items";N;s:21:"choose_from_most_used";N;s:9:"not_found";s:20:"No categories found.";s:8:"no_terms";s:13:"No categories";s:21:"items_list_navigation";s:26:"Categories list navigation";s:10:"items_list";s:15:"Categories list";s:9:"menu_name";s:10:"Categories";s:14:"name_admin_bar";s:8:"category";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:13:"show_tagcloud";b:1;s:18:"show_in_quick_edit";b:1;s:17:"show_admin_column";b:1;s:11:"meta_box_cb";s:24:"post_categories_meta_box";s:11:"object_type";a:1:{i:0;s:4:"post";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:17:"manage_categories";s:10:"edit_terms";s:15:"edit_categories";s:12:"delete_terms";s:17:"delete_categories";s:12:"assign_terms";s:17:"assign_categories";}s:7:"rewrite";a:4:{s:10:"with_front";b:1;s:12:"hierarchical";b:1;s:7:"ep_mask";i:512;s:4:"slug";s:8:"category";}s:9:"query_var";s:13:"category_name";s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:1;s:12:"show_in_rest";b:1;s:9:"rest_base";s:10:"categories";s:21:"rest_controller_class";s:24:"WP_REST_Terms_Controller";}s:8:"post_tag";O:11:"WP_Taxonomy":23:{s:4:"name";s:8:"post_tag";s:5:"label";s:4:"Tags";s:6:"labels";O:8:"stdClass":21:{s:4:"name";s:4:"Tags";s:13:"singular_name";s:3:"Tag";s:12:"search_items";s:11:"Search Tags";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:8:"All Tags";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:8:"Edit Tag";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:10:"Update Tag";s:12:"add_new_item";s:11:"Add New Tag";s:13:"new_item_name";s:12:"New Tag Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:4:"Tags";s:14:"name_admin_bar";s:8:"post_tag";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:13:"show_tagcloud";b:1;s:18:"show_in_quick_edit";b:1;s:17:"show_admin_column";b:1;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:4:"post";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:16:"manage_post_tags";s:10:"edit_terms";s:14:"edit_post_tags";s:12:"delete_terms";s:16:"delete_post_tags";s:12:"assign_terms";s:16:"assign_post_tags";}s:7:"rewrite";a:4:{s:10:"with_front";b:1;s:12:"hierarchical";b:0;s:7:"ep_mask";i:1024;s:4:"slug";s:3:"tag";}s:9:"query_var";s:3:"tag";s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:1;s:12:"show_in_rest";b:1;s:9:"rest_base";s:4:"tags";s:21:"rest_controller_class";s:24:"WP_REST_Terms_Controller";}s:8:"nav_menu";O:11:"WP_Taxonomy":20:{s:4:"name";s:8:"nav_menu";s:5:"label";s:16:"Navigation Menus";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:16:"Navigation Menus";s:13:"singular_name";s:15:"Navigation Menu";s:12:"search_items";s:11:"Search Tags";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:16:"Navigation Menus";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:8:"Edit Tag";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:10:"Update Tag";s:12:"add_new_item";s:11:"Add New Tag";s:13:"new_item_name";s:12:"New Tag Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:16:"Navigation Menus";s:14:"name_admin_bar";s:15:"Navigation Menu";s:8:"archives";s:16:"Navigation Menus";}s:11:"description";s:0:"";s:6:"public";b:0;s:18:"publicly_queryable";b:0;s:12:"hierarchical";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:0;s:18:"show_in_quick_edit";b:0;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:13:"nav_menu_item";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:17:"manage_categories";s:10:"edit_terms";s:17:"manage_categories";s:12:"delete_terms";s:17:"manage_categories";s:12:"assign_terms";s:10:"edit_posts";}s:7:"rewrite";b:0;s:9:"query_var";b:0;s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:1;}s:13:"link_category";O:11:"WP_Taxonomy":20:{s:4:"name";s:13:"link_category";s:5:"label";s:15:"Link Categories";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:15:"Link Categories";s:13:"singular_name";s:13:"Link Category";s:12:"search_items";s:22:"Search Link Categories";s:13:"popular_items";N;s:9:"all_items";s:19:"All Link Categories";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:18:"Edit Link Category";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:20:"Update Link Category";s:12:"add_new_item";s:21:"Add New Link Category";s:13:"new_item_name";s:22:"New Link Category Name";s:26:"separate_items_with_commas";N;s:19:"add_or_remove_items";N;s:21:"choose_from_most_used";N;s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:15:"Link Categories";s:14:"name_admin_bar";s:13:"Link Category";s:8:"archives";s:19:"All Link Categories";}s:11:"description";s:0:"";s:6:"public";b:0;s:18:"publicly_queryable";b:0;s:12:"hierarchical";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:1;s:18:"show_in_quick_edit";b:1;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:4:"link";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:12:"manage_links";s:10:"edit_terms";s:12:"manage_links";s:12:"delete_terms";s:12:"manage_links";s:12:"assign_terms";s:12:"manage_links";}s:7:"rewrite";b:0;s:9:"query_var";b:0;s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:1;}s:11:"post_format";O:11:"WP_Taxonomy":20:{s:4:"name";s:11:"post_format";s:5:"label";s:6:"Format";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:6:"Format";s:13:"singular_name";s:6:"Format";s:12:"search_items";s:11:"Search Tags";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:6:"Format";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:8:"Edit Tag";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:10:"Update Tag";s:12:"add_new_item";s:11:"Add New Tag";s:13:"new_item_name";s:12:"New Tag Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:6:"Format";s:14:"name_admin_bar";s:6:"Format";s:8:"archives";s:6:"Format";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:0;s:18:"show_in_quick_edit";b:0;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:4:"post";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:17:"manage_categories";s:10:"edit_terms";s:17:"manage_categories";s:12:"delete_terms";s:17:"manage_categories";s:12:"assign_terms";s:10:"edit_posts";}s:7:"rewrite";a:4:{s:10:"with_front";b:1;s:12:"hierarchical";b:0;s:7:"ep_mask";i:0;s:4:"slug";s:4:"type";}s:9:"query_var";s:11:"post_format";s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:1;}s:9:"topic-tag";O:11:"WP_Taxonomy":20:{s:4:"name";s:9:"topic-tag";s:5:"label";s:10:"Topic Tags";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:10:"Topic Tags";s:13:"singular_name";s:9:"Topic Tag";s:12:"search_items";s:11:"Search Tags";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:8:"All Tags";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:8:"Edit Tag";s:9:"view_item";s:14:"View Topic Tag";s:11:"update_item";s:10:"Update Tag";s:12:"add_new_item";s:11:"Add New Tag";s:13:"new_item_name";s:12:"New Tag Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:10:"Topic Tags";s:14:"name_admin_bar";s:9:"Topic Tag";s:8:"archives";s:8:"All Tags";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:1;s:18:"show_in_quick_edit";b:1;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:5:"topic";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:17:"manage_topic_tags";s:10:"edit_terms";s:15:"edit_topic_tags";s:12:"delete_terms";s:17:"delete_topic_tags";s:12:"assign_terms";s:17:"assign_topic_tags";}s:7:"rewrite";a:4:{s:10:"with_front";b:0;s:12:"hierarchical";b:0;s:7:"ep_mask";i:0;s:4:"slug";s:16:"forums/topic-tag";}s:9:"query_var";s:9:"topic-tag";s:21:"update_count_callback";s:23:"_update_post_term_count";s:8:"_builtin";b:0;}s:12:"action-group";O:11:"WP_Taxonomy":20:{s:4:"name";s:12:"action-group";s:5:"label";s:12:"Action Group";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:12:"Action Group";s:13:"singular_name";s:12:"Action Group";s:12:"search_items";s:11:"Search Tags";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:12:"Action Group";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:8:"Edit Tag";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:10:"Update Tag";s:12:"add_new_item";s:11:"Add New Tag";s:13:"new_item_name";s:12:"New Tag Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:12:"Action Group";s:14:"name_admin_bar";s:12:"Action Group";s:8:"archives";s:12:"Action Group";}s:11:"description";s:0:"";s:6:"public";b:0;s:18:"publicly_queryable";b:0;s:12:"hierarchical";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:0;s:18:"show_in_quick_edit";b:0;s:17:"show_admin_column";b:1;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:16:"scheduled-action";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:17:"manage_categories";s:10:"edit_terms";s:17:"manage_categories";s:12:"delete_terms";s:17:"manage_categories";s:12:"assign_terms";s:10:"edit_posts";}s:7:"rewrite";b:0;s:9:"query_var";b:0;s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:0;}s:12:"product_type";O:11:"WP_Taxonomy":20:{s:4:"name";s:12:"product_type";s:5:"label";s:4:"Tags";s:6:"labels";O:8:"stdClass":21:{s:4:"name";s:4:"Tags";s:13:"singular_name";s:3:"Tag";s:12:"search_items";s:11:"Search Tags";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:8:"All Tags";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:8:"Edit Tag";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:10:"Update Tag";s:12:"add_new_item";s:11:"Add New Tag";s:13:"new_item_name";s:12:"New Tag Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:4:"Tags";s:14:"name_admin_bar";s:12:"product_type";}s:11:"description";s:0:"";s:6:"public";b:0;s:18:"publicly_queryable";b:0;s:12:"hierarchical";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:0;s:18:"show_in_quick_edit";b:0;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:7:"product";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:17:"manage_categories";s:10:"edit_terms";s:17:"manage_categories";s:12:"delete_terms";s:17:"manage_categories";s:12:"assign_terms";s:10:"edit_posts";}s:7:"rewrite";b:0;s:9:"query_var";s:12:"product_type";s:21:"update_count_callback";s:0:"";s:8:"_builtin";b:0;}s:11:"product_cat";O:11:"WP_Taxonomy":20:{s:4:"name";s:11:"product_cat";s:5:"label";s:18:"Product Categories";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:18:"Product Categories";s:13:"singular_name";s:16:"Product Category";s:12:"search_items";s:25:"Search Product Categories";s:13:"popular_items";N;s:9:"all_items";s:22:"All Product Categories";s:11:"parent_item";s:23:"Parent Product Category";s:17:"parent_item_colon";s:24:"Parent Product Category:";s:9:"edit_item";s:21:"Edit Product Category";s:9:"view_item";s:13:"View Category";s:11:"update_item";s:23:"Update Product Category";s:12:"add_new_item";s:24:"Add New Product Category";s:13:"new_item_name";s:25:"New Product Category Name";s:26:"separate_items_with_commas";N;s:19:"add_or_remove_items";N;s:21:"choose_from_most_used";N;s:9:"not_found";s:25:"No Product Category found";s:8:"no_terms";s:13:"No categories";s:21:"items_list_navigation";s:26:"Categories list navigation";s:10:"items_list";s:15:"Categories list";s:9:"menu_name";s:10:"Categories";s:14:"name_admin_bar";s:16:"Product Category";s:8:"archives";s:22:"All Product Categories";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:13:"show_tagcloud";b:1;s:18:"show_in_quick_edit";b:1;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:24:"post_categories_meta_box";s:11:"object_type";a:1:{i:0;s:7:"product";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:20:"manage_product_terms";s:10:"edit_terms";s:18:"edit_product_terms";s:12:"delete_terms";s:20:"delete_product_terms";s:12:"assign_terms";s:20:"assign_product_terms";}s:7:"rewrite";a:4:{s:10:"with_front";b:0;s:12:"hierarchical";b:1;s:7:"ep_mask";i:0;s:4:"slug";s:16:"product-category";}s:9:"query_var";s:11:"product_cat";s:21:"update_count_callback";s:16:"_wc_term_recount";s:8:"_builtin";b:0;}s:11:"product_tag";O:11:"WP_Taxonomy":20:{s:4:"name";s:11:"product_tag";s:5:"label";s:12:"Product Tags";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:12:"Product Tags";s:13:"singular_name";s:11:"Product Tag";s:12:"search_items";s:19:"Search Product Tags";s:13:"popular_items";s:20:"Popular Product Tags";s:9:"all_items";s:16:"All Product Tags";s:11:"parent_item";N;s:17:"parent_item_colon";N;s:9:"edit_item";s:16:"Edit Product Tag";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:18:"Update Product Tag";s:12:"add_new_item";s:19:"Add New Product Tag";s:13:"new_item_name";s:20:"New Product Tag Name";s:26:"separate_items_with_commas";s:33:"Separate Product Tags with commas";s:19:"add_or_remove_items";s:26:"Add or remove Product Tags";s:21:"choose_from_most_used";s:38:"Choose from the most used Product tags";s:9:"not_found";s:21:"No Product Tags found";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:4:"Tags";s:14:"name_admin_bar";s:11:"Product Tag";s:8:"archives";s:16:"All Product Tags";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:13:"show_tagcloud";b:1;s:18:"show_in_quick_edit";b:1;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:1:{i:0;s:7:"product";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:20:"manage_product_terms";s:10:"edit_terms";s:18:"edit_product_terms";s:12:"delete_terms";s:20:"delete_product_terms";s:12:"assign_terms";s:20:"assign_product_terms";}s:7:"rewrite";a:4:{s:10:"with_front";b:0;s:12:"hierarchical";b:0;s:7:"ep_mask";i:0;s:4:"slug";s:11:"product-tag";}s:9:"query_var";s:11:"product_tag";s:21:"update_count_callback";s:16:"_wc_term_recount";s:8:"_builtin";b:0;}s:22:"product_shipping_class";O:11:"WP_Taxonomy":20:{s:4:"name";s:22:"product_shipping_class";s:5:"label";s:16:"Shipping Classes";s:6:"labels";O:8:"stdClass":22:{s:4:"name";s:16:"Shipping Classes";s:13:"singular_name";s:14:"Shipping Class";s:12:"search_items";s:23:"Search Shipping Classes";s:13:"popular_items";s:12:"Popular Tags";s:9:"all_items";s:20:"All Shipping Classes";s:11:"parent_item";s:21:"Parent Shipping Class";s:17:"parent_item_colon";s:22:"Parent Shipping Class:";s:9:"edit_item";s:19:"Edit Shipping Class";s:9:"view_item";s:8:"View Tag";s:11:"update_item";s:21:"Update Shipping Class";s:12:"add_new_item";s:22:"Add New Shipping Class";s:13:"new_item_name";s:23:"New Shipping Class Name";s:26:"separate_items_with_commas";s:25:"Separate tags with commas";s:19:"add_or_remove_items";s:18:"Add or remove tags";s:21:"choose_from_most_used";s:30:"Choose from the most used tags";s:9:"not_found";s:14:"No tags found.";s:8:"no_terms";s:7:"No tags";s:21:"items_list_navigation";s:20:"Tags list navigation";s:10:"items_list";s:9:"Tags list";s:9:"menu_name";s:16:"Shipping Classes";s:14:"name_admin_bar";s:14:"Shipping Class";s:8:"archives";s:20:"All Shipping Classes";}s:11:"description";s:0:"";s:6:"public";b:1;s:18:"publicly_queryable";b:1;s:12:"hierarchical";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:13:"show_tagcloud";b:0;s:18:"show_in_quick_edit";b:0;s:17:"show_admin_column";b:0;s:11:"meta_box_cb";s:18:"post_tags_meta_box";s:11:"object_type";a:2:{i:0;s:7:"product";i:1;s:17:"product_variation";}s:3:"cap";O:8:"stdClass":4:{s:12:"manage_terms";s:20:"manage_product_terms";s:10:"edit_terms";s:18:"edit_product_terms";s:12:"delete_terms";s:20:"delete_product_terms";s:12:"assign_terms";s:20:"assign_product_terms";}s:7:"rewrite";b:0;s:9:"query_var";s:22:"product_shipping_class";s:21:"update_count_callback";s:23:"_update_post_term_count";s:8:"_builtin";b:0;}}}i:2;i:1;i:3;d:1483802604.369626;i:4;b:0;}', 'no') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(8150, 'jpsq_sync-1483802604.376235-46898-29', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:10:"post_types";i:1;a:22:{s:4:"post";O:12:"WP_Post_Type":29:{s:4:"name";s:4:"post";s:5:"label";s:5:"Posts";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:5:"Posts";s:13:"singular_name";s:4:"Post";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:9:"All Posts";s:8:"archives";s:13:"Post Archives";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:5:"Posts";s:14:"name_admin_bar";s:4:"Post";}s:11:"description";s:0:"";s:6:"public";b:1;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:0;s:18:"publicly_queryable";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";i:5;s:9:"menu_icon";N;s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";b:1;s:8:"_builtin";b:1;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_post";s:9:"read_post";s:9:"read_post";s:11:"delete_post";s:11:"delete_post";s:10:"edit_posts";s:10:"edit_posts";s:17:"edit_others_posts";s:17:"edit_others_posts";s:13:"publish_posts";s:13:"publish_posts";s:18:"read_private_posts";s:18:"read_private_posts";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_posts";s:20:"delete_private_posts";s:20:"delete_private_posts";s:22:"delete_published_posts";s:22:"delete_published_posts";s:19:"delete_others_posts";s:19:"delete_others_posts";s:18:"edit_private_posts";s:18:"edit_private_posts";s:20:"edit_published_posts";s:20:"edit_published_posts";s:12:"create_posts";s:10:"edit_posts";}s:7:"rewrite";b:0;s:12:"show_in_rest";b:1;s:9:"rest_base";s:5:"posts";s:21:"rest_controller_class";s:24:"WP_REST_Posts_Controller";}s:4:"page";O:12:"WP_Post_Type":29:{s:4:"name";s:4:"page";s:5:"label";s:5:"Pages";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:5:"Pages";s:13:"singular_name";s:4:"Page";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Page";s:9:"edit_item";s:9:"Edit Page";s:8:"new_item";s:8:"New Page";s:9:"view_item";s:9:"View Page";s:10:"view_items";s:10:"View Pages";s:12:"search_items";s:12:"Search Pages";s:9:"not_found";s:15:"No pages found.";s:18:"not_found_in_trash";s:24:"No pages found in Trash.";s:17:"parent_item_colon";s:12:"Parent Page:";s:9:"all_items";s:9:"All Pages";s:8:"archives";s:13:"Page Archives";s:10:"attributes";s:15:"Page Attributes";s:16:"insert_into_item";s:16:"Insert into page";s:21:"uploaded_to_this_item";s:21:"Uploaded to this page";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter pages list";s:21:"items_list_navigation";s:21:"Pages list navigation";s:10:"items_list";s:10:"Pages list";s:9:"menu_name";s:5:"Pages";s:14:"name_admin_bar";s:4:"Page";}s:11:"description";s:0:"";s:6:"public";b:1;s:12:"hierarchical";b:1;s:19:"exclude_from_search";b:0;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";i:20;s:9:"menu_icon";N;s:15:"capability_type";s:4:"page";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";b:1;s:8:"_builtin";b:1;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_page";s:9:"read_post";s:9:"read_page";s:11:"delete_post";s:11:"delete_page";s:10:"edit_posts";s:10:"edit_pages";s:17:"edit_others_posts";s:17:"edit_others_pages";s:13:"publish_posts";s:13:"publish_pages";s:18:"read_private_posts";s:18:"read_private_pages";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_pages";s:20:"delete_private_posts";s:20:"delete_private_pages";s:22:"delete_published_posts";s:22:"delete_published_pages";s:19:"delete_others_posts";s:19:"delete_others_pages";s:18:"edit_private_posts";s:18:"edit_private_pages";s:20:"edit_published_posts";s:20:"edit_published_pages";s:12:"create_posts";s:10:"edit_pages";}s:7:"rewrite";b:0;s:12:"show_in_rest";b:1;s:9:"rest_base";s:5:"pages";s:21:"rest_controller_class";s:24:"WP_REST_Posts_Controller";}s:10:"attachment";O:12:"WP_Post_Type":29:{s:4:"name";s:10:"attachment";s:5:"label";s:5:"Media";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:5:"Media";s:13:"singular_name";s:5:"Media";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:10:"Edit Media";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:20:"View Attachment Page";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:5:"Media";s:8:"archives";s:5:"Media";s:10:"attributes";s:21:"Attachment Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:5:"Media";s:14:"name_admin_bar";s:5:"Media";}s:11:"description";s:0:"";s:6:"public";b:1;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:0;s:18:"publicly_queryable";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";b:1;s:8:"_builtin";b:1;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_post";s:9:"read_post";s:9:"read_post";s:11:"delete_post";s:11:"delete_post";s:10:"edit_posts";s:10:"edit_posts";s:17:"edit_others_posts";s:17:"edit_others_posts";s:13:"publish_posts";s:13:"publish_posts";s:18:"read_private_posts";s:18:"read_private_posts";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_posts";s:20:"delete_private_posts";s:20:"delete_private_posts";s:22:"delete_published_posts";s:22:"delete_published_posts";s:19:"delete_others_posts";s:19:"delete_others_posts";s:18:"edit_private_posts";s:18:"edit_private_posts";s:20:"edit_published_posts";s:20:"edit_published_posts";s:12:"create_posts";s:12:"upload_files";}s:7:"rewrite";b:0;s:12:"show_in_rest";b:1;s:9:"rest_base";s:5:"media";s:21:"rest_controller_class";s:30:"WP_REST_Attachments_Controller";}s:8:"revision";O:12:"WP_Post_Type":26:{s:4:"name";s:8:"revision";s:5:"label";s:9:"Revisions";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:9:"Revisions";s:13:"singular_name";s:8:"Revision";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:9:"Revisions";s:8:"archives";s:9:"Revisions";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:9:"Revisions";s:14:"name_admin_bar";s:8:"Revision";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:0;s:16:"delete_with_user";b:1;s:8:"_builtin";b:1;s:10:"_edit_link";s:24:"revision.php?revision=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_post";s:9:"read_post";s:9:"read_post";s:11:"delete_post";s:11:"delete_post";s:10:"edit_posts";s:10:"edit_posts";s:17:"edit_others_posts";s:17:"edit_others_posts";s:13:"publish_posts";s:13:"publish_posts";s:18:"read_private_posts";s:18:"read_private_posts";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_posts";s:20:"delete_private_posts";s:20:"delete_private_posts";s:22:"delete_published_posts";s:22:"delete_published_posts";s:19:"delete_others_posts";s:19:"delete_others_posts";s:18:"edit_private_posts";s:18:"edit_private_posts";s:20:"edit_published_posts";s:20:"edit_published_posts";s:12:"create_posts";s:10:"edit_posts";}s:7:"rewrite";b:0;}s:13:"nav_menu_item";O:12:"WP_Post_Type":27:{s:4:"name";s:13:"nav_menu_item";s:5:"label";s:21:"Navigation Menu Items";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:21:"Navigation Menu Items";s:13:"singular_name";s:20:"Navigation Menu Item";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:21:"Navigation Menu Items";s:8:"archives";s:21:"Navigation Menu Items";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:21:"Navigation Menu Items";s:14:"name_admin_bar";s:20:"Navigation Menu Item";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";b:0;s:8:"_builtin";b:1;s:10:"_edit_link";s:0:"";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_post";s:9:"read_post";s:9:"read_post";s:11:"delete_post";s:11:"delete_post";s:10:"edit_posts";s:10:"edit_posts";s:17:"edit_others_posts";s:17:"edit_others_posts";s:13:"publish_posts";s:13:"publish_posts";s:18:"read_private_posts";s:18:"read_private_posts";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_posts";s:20:"delete_private_posts";s:20:"delete_private_posts";s:22:"delete_published_posts";s:22:"delete_published_posts";s:19:"delete_others_posts";s:19:"delete_others_posts";s:18:"edit_private_posts";s:18:"edit_private_posts";s:20:"edit_published_posts";s:20:"edit_published_posts";s:12:"create_posts";s:10:"edit_posts";}s:7:"rewrite";b:0;s:8:"supports";a:0:{}}s:10:"custom_css";O:12:"WP_Post_Type":26:{s:4:"name";s:10:"custom_css";s:5:"label";s:10:"Custom CSS";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:10:"Custom CSS";s:13:"singular_name";s:10:"Custom CSS";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:10:"Custom CSS";s:8:"archives";s:10:"Custom CSS";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:10:"Custom CSS";s:14:"name_admin_bar";s:10:"Custom CSS";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:0;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";b:0;s:8:"_builtin";b:1;s:10:"_edit_link";s:0:"";s:3:"cap";O:8:"stdClass":13:{s:9:"edit_post";s:8:"edit_css";s:9:"read_post";s:4:"read";s:11:"delete_post";s:18:"edit_theme_options";s:10:"edit_posts";s:8:"edit_css";s:17:"edit_others_posts";s:8:"edit_css";s:13:"publish_posts";s:18:"edit_theme_options";s:18:"read_private_posts";s:4:"read";s:12:"delete_posts";s:18:"edit_theme_options";s:22:"delete_published_posts";s:18:"edit_theme_options";s:20:"delete_private_posts";s:18:"edit_theme_options";s:19:"delete_others_posts";s:18:"edit_theme_options";s:20:"edit_published_posts";s:8:"edit_css";s:12:"create_posts";s:8:"edit_css";}s:7:"rewrite";b:0;}s:19:"customize_changeset";O:12:"WP_Post_Type":26:{s:4:"name";s:19:"customize_changeset";s:5:"label";s:10:"Changesets";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:10:"Changesets";s:13:"singular_name";s:9:"Changeset";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:17:"Add New Changeset";s:9:"edit_item";s:14:"Edit Changeset";s:8:"new_item";s:13:"New Changeset";s:9:"view_item";s:14:"View Changeset";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:17:"Search Changesets";s:9:"not_found";s:20:"No changesets found.";s:18:"not_found_in_trash";s:29:"No changesets found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:14:"All Changesets";s:8:"archives";s:14:"All Changesets";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:10:"Changesets";s:14:"name_admin_bar";s:9:"Changeset";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:19:"customize_changeset";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:0;s:16:"delete_with_user";b:0;s:8:"_builtin";b:1;s:10:"_edit_link";s:0:"";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"customize";s:9:"read_post";s:9:"customize";s:11:"delete_post";s:9:"customize";s:10:"edit_posts";s:9:"customize";s:17:"edit_others_posts";s:9:"customize";s:13:"publish_posts";s:9:"customize";s:18:"read_private_posts";s:9:"customize";s:4:"read";s:4:"read";s:12:"delete_posts";s:9:"customize";s:20:"delete_private_posts";s:9:"customize";s:22:"delete_published_posts";s:9:"customize";s:19:"delete_others_posts";s:9:"customize";s:18:"edit_private_posts";s:9:"customize";s:20:"edit_published_posts";s:12:"do_not_allow";s:12:"create_posts";s:9:"customize";}s:7:"rewrite";b:0;}s:5:"forum";O:12:"WP_Post_Type":26:{s:4:"name";s:5:"forum";s:5:"label";s:6:"Forums";s:6:"labels";O:8:"stdClass":28:{s:4:"name";s:6:"Forums";s:13:"singular_name";s:5:"Forum";s:7:"add_new";s:9:"New Forum";s:12:"add_new_item";s:16:"Create New Forum";s:9:"edit_item";s:10:"Edit Forum";s:8:"new_item";s:9:"New Forum";s:9:"view_item";s:10:"View Forum";s:10:"view_items";s:10:"View Pages";s:12:"search_items";s:13:"Search Forums";s:9:"not_found";s:15:"No forums found";s:18:"not_found_in_trash";s:24:"No forums found in Trash";s:17:"parent_item_colon";s:13:"Parent Forum:";s:9:"all_items";s:10:"All Forums";s:8:"archives";s:10:"All Forums";s:10:"attributes";s:15:"Page Attributes";s:16:"insert_into_item";s:16:"Insert into page";s:21:"uploaded_to_this_item";s:21:"Uploaded to this page";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter pages list";s:21:"items_list_navigation";s:21:"Pages list navigation";s:10:"items_list";s:10:"Pages list";s:9:"menu_name";s:6:"Forums";s:4:"edit";s:4:"Edit";s:4:"view";s:10:"View Forum";s:14:"name_admin_bar";s:5:"Forum";}s:11:"description";s:14:"bbPress Forums";s:6:"public";b:1;s:12:"hierarchical";b:1;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";i:555555;s:9:"menu_icon";s:0:"";s:15:"capability_type";s:5:"forum";s:12:"map_meta_cap";b:0;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";s:6:"forums";s:9:"query_var";s:5:"forum";s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":11:{s:9:"edit_post";s:10:"edit_forum";s:9:"read_post";s:10:"read_forum";s:11:"delete_post";s:12:"delete_forum";s:10:"edit_posts";s:11:"edit_forums";s:17:"edit_others_posts";s:18:"edit_others_forums";s:13:"publish_posts";s:14:"publish_forums";s:18:"read_private_posts";s:19:"read_private_forums";s:17:"read_hidden_posts";s:18:"read_hidden_forums";s:12:"delete_posts";s:13:"delete_forums";s:19:"delete_others_posts";s:20:"delete_others_forums";s:12:"create_posts";s:11:"edit_forums";}s:7:"rewrite";a:5:{s:4:"slug";s:12:"forums/forum";s:10:"with_front";b:0;s:5:"pages";b:1;s:5:"feeds";b:1;s:7:"ep_mask";i:1;}}s:5:"topic";O:12:"WP_Post_Type":26:{s:4:"name";s:5:"topic";s:5:"label";s:6:"Topics";s:6:"labels";O:8:"stdClass":28:{s:4:"name";s:6:"Topics";s:13:"singular_name";s:5:"Topic";s:7:"add_new";s:9:"New Topic";s:12:"add_new_item";s:16:"Create New Topic";s:9:"edit_item";s:10:"Edit Topic";s:8:"new_item";s:9:"New Topic";s:9:"view_item";s:10:"View Topic";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:13:"Search Topics";s:9:"not_found";s:15:"No topics found";s:18:"not_found_in_trash";s:24:"No topics found in Trash";s:17:"parent_item_colon";s:6:"Forum:";s:9:"all_items";s:10:"All Topics";s:8:"archives";s:10:"All Topics";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:6:"Topics";s:4:"edit";s:4:"Edit";s:4:"view";s:10:"View Topic";s:14:"name_admin_bar";s:5:"Topic";}s:11:"description";s:14:"bbPress Topics";s:6:"public";b:1;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";i:555555;s:9:"menu_icon";s:0:"";s:15:"capability_type";s:5:"topic";s:12:"map_meta_cap";b:0;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";s:6:"topics";s:9:"query_var";s:5:"topic";s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":11:{s:9:"edit_post";s:10:"edit_topic";s:9:"read_post";s:10:"read_topic";s:11:"delete_post";s:12:"delete_topic";s:10:"edit_posts";s:11:"edit_topics";s:17:"edit_others_posts";s:18:"edit_others_topics";s:13:"publish_posts";s:14:"publish_topics";s:18:"read_private_posts";s:19:"read_private_topics";s:17:"read_hidden_posts";s:18:"read_hidden_topics";s:12:"delete_posts";s:13:"delete_topics";s:19:"delete_others_posts";s:20:"delete_others_topics";s:12:"create_posts";s:11:"edit_topics";}s:7:"rewrite";a:5:{s:4:"slug";s:12:"forums/topic";s:10:"with_front";b:0;s:5:"pages";b:1;s:5:"feeds";b:1;s:7:"ep_mask";i:1;}}s:5:"reply";O:12:"WP_Post_Type":26:{s:4:"name";s:5:"reply";s:5:"label";s:7:"Replies";s:6:"labels";O:8:"stdClass":28:{s:4:"name";s:7:"Replies";s:13:"singular_name";s:5:"Reply";s:7:"add_new";s:9:"New Reply";s:12:"add_new_item";s:16:"Create New Reply";s:9:"edit_item";s:10:"Edit Reply";s:8:"new_item";s:9:"New Reply";s:9:"view_item";s:10:"View Reply";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:14:"Search Replies";s:9:"not_found";s:16:"No replies found";s:18:"not_found_in_trash";s:25:"No replies found in Trash";s:17:"parent_item_colon";s:6:"Topic:";s:9:"all_items";s:11:"All Replies";s:8:"archives";s:11:"All Replies";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:7:"Replies";s:4:"edit";s:4:"Edit";s:4:"view";s:10:"View Reply";s:14:"name_admin_bar";s:5:"Reply";}s:11:"description";s:15:"bbPress Replies";s:6:"public";b:1;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";i:555555;s:9:"menu_icon";s:0:"";s:15:"capability_type";s:5:"reply";s:12:"map_meta_cap";b:0;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";s:5:"reply";s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":10:{s:9:"edit_post";s:10:"edit_reply";s:9:"read_post";s:10:"read_reply";s:11:"delete_post";s:12:"delete_reply";s:10:"edit_posts";s:12:"edit_replies";s:17:"edit_others_posts";s:19:"edit_others_replies";s:13:"publish_posts";s:15:"publish_replies";s:18:"read_private_posts";s:20:"read_private_replies";s:12:"delete_posts";s:14:"delete_replies";s:19:"delete_others_posts";s:21:"delete_others_replies";s:12:"create_posts";s:12:"edit_replies";}s:7:"rewrite";a:5:{s:4:"slug";s:12:"forums/reply";s:10:"with_front";b:0;s:5:"pages";b:1;s:5:"feeds";b:0;s:7:"ep_mask";i:1;}}s:9:"soliloquy";O:12:"WP_Post_Type":26:{s:4:"name";s:9:"soliloquy";s:5:"label";s:17:"Soliloquy Sliders";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:17:"Soliloquy Sliders";s:13:"singular_name";s:9:"Soliloquy";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:24:"Add New Soliloquy Slider";s:9:"edit_item";s:21:"Edit Soliloquy Slider";s:8:"new_item";s:20:"New Soliloquy Slider";s:9:"view_item";s:21:"View Soliloquy Slider";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:24:"Search Soliloquy Sliders";s:9:"not_found";s:27:"No Soliloquy sliders found.";s:18:"not_found_in_trash";s:36:"No Soliloquy sliders found in trash.";s:17:"parent_item_colon";s:0:"";s:9:"all_items";s:9:"Soliloquy";s:8:"archives";s:9:"Soliloquy";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:9:"Soliloquy";s:14:"name_admin_bar";s:9:"Soliloquy";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";i:248;s:9:"menu_icon";s:64:"/wp-content/plugins/soliloquy/assets/css/images/menu-icon@2x.png";s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_post";s:9:"read_post";s:9:"read_post";s:11:"delete_post";s:11:"delete_post";s:10:"edit_posts";s:10:"edit_posts";s:17:"edit_others_posts";s:17:"edit_others_posts";s:13:"publish_posts";s:13:"publish_posts";s:18:"read_private_posts";s:18:"read_private_posts";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_posts";s:20:"delete_private_posts";s:20:"delete_private_posts";s:22:"delete_published_posts";s:22:"delete_published_posts";s:19:"delete_others_posts";s:19:"delete_others_posts";s:18:"edit_private_posts";s:18:"edit_private_posts";s:20:"edit_published_posts";s:20:"edit_published_posts";s:12:"create_posts";s:10:"edit_posts";}s:7:"rewrite";b:0;}s:16:"scheduled-action";O:12:"WP_Post_Type":27:{s:4:"name";s:16:"scheduled-action";s:5:"label";s:17:"Scheduled Actions";s:6:"labels";O:8:"stdClass":28:{s:4:"name";s:17:"Scheduled Actions";s:13:"singular_name";s:16:"Scheduled Action";s:7:"add_new";s:3:"Add";s:12:"add_new_item";s:24:"Add New Scheduled Action";s:9:"edit_item";s:21:"Edit Scheduled Action";s:8:"new_item";s:20:"New Scheduled Action";s:9:"view_item";s:11:"View Action";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:24:"Search Scheduled Actions";s:9:"not_found";s:16:"No actions found";s:18:"not_found_in_trash";s:25:"No actions found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:17:"Scheduled Actions";s:8:"archives";s:17:"Scheduled Actions";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:17:"Scheduled Actions";s:4:"edit";s:4:"Edit";s:4:"view";s:11:"View Action";s:14:"name_admin_bar";s:16:"Scheduled Action";}s:11:"description";s:64:"Scheduled actions are hooks triggered on a cetain date and time.";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";s:9:"tools.php";s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:4:"post";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_post";s:9:"read_post";s:9:"read_post";s:11:"delete_post";s:11:"delete_post";s:10:"edit_posts";s:10:"edit_posts";s:17:"edit_others_posts";s:17:"edit_others_posts";s:13:"publish_posts";s:13:"publish_posts";s:18:"read_private_posts";s:18:"read_private_posts";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_posts";s:20:"delete_private_posts";s:20:"delete_private_posts";s:22:"delete_published_posts";s:22:"delete_published_posts";s:19:"delete_others_posts";s:19:"delete_others_posts";s:18:"edit_private_posts";s:18:"edit_private_posts";s:20:"edit_published_posts";s:20:"edit_published_posts";s:12:"create_posts";s:10:"edit_posts";}s:7:"rewrite";b:0;s:7:"ep_mask";i:0;}s:7:"product";O:12:"WP_Post_Type":26:{s:4:"name";s:7:"product";s:5:"label";s:8:"Products";s:6:"labels";O:8:"stdClass":29:{s:4:"name";s:8:"Products";s:13:"singular_name";s:7:"Product";s:7:"add_new";s:11:"Add Product";s:12:"add_new_item";s:15:"Add New Product";s:9:"edit_item";s:12:"Edit Product";s:8:"new_item";s:11:"New Product";s:9:"view_item";s:12:"View Product";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:15:"Search Products";s:9:"not_found";s:17:"No Products found";s:18:"not_found_in_trash";s:26:"No Products found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:8:"Products";s:8:"archives";s:8:"Products";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:19:"Insert into product";s:21:"uploaded_to_this_item";s:24:"Uploaded to this product";s:14:"featured_image";s:13:"Product Image";s:18:"set_featured_image";s:17:"Set product image";s:21:"remove_featured_image";s:20:"Remove product image";s:18:"use_featured_image";s:20:"Use as product image";s:17:"filter_items_list";s:15:"Filter products";s:21:"items_list_navigation";s:19:"Products navigation";s:10:"items_list";s:13:"Products list";s:9:"menu_name";s:8:"Products";s:4:"edit";s:4:"Edit";s:4:"view";s:12:"View Product";s:6:"parent";s:14:"Parent Product";s:14:"name_admin_bar";s:7:"Product";}s:11:"description";s:53:"This is where you can add new products to your store.";s:6:"public";b:1;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:0;s:18:"publicly_queryable";b:1;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:1;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:7:"product";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";s:4:"shop";s:9:"query_var";s:7:"product";s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:12:"edit_product";s:9:"read_post";s:12:"read_product";s:11:"delete_post";s:14:"delete_product";s:10:"edit_posts";s:13:"edit_products";s:17:"edit_others_posts";s:20:"edit_others_products";s:13:"publish_posts";s:16:"publish_products";s:18:"read_private_posts";s:21:"read_private_products";s:4:"read";s:4:"read";s:12:"delete_posts";s:15:"delete_products";s:20:"delete_private_posts";s:23:"delete_private_products";s:22:"delete_published_posts";s:25:"delete_published_products";s:19:"delete_others_posts";s:22:"delete_others_products";s:18:"edit_private_posts";s:21:"edit_private_products";s:20:"edit_published_posts";s:23:"edit_published_products";s:12:"create_posts";s:13:"edit_products";}s:7:"rewrite";a:5:{s:4:"slug";s:7:"product";s:10:"with_front";b:0;s:5:"feeds";b:1;s:5:"pages";b:1;s:7:"ep_mask";i:1;}}s:17:"product_variation";O:12:"WP_Post_Type":27:{s:4:"name";s:17:"product_variation";s:5:"label";s:10:"Variations";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:10:"Variations";s:13:"singular_name";s:10:"Variations";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:10:"Variations";s:8:"archives";s:10:"Variations";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:10:"Variations";s:14:"name_admin_bar";s:10:"Variations";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:7:"product";s:12:"map_meta_cap";b:0;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";s:17:"product_variation";s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:0:"";s:3:"cap";O:8:"stdClass":8:{s:9:"edit_post";s:12:"edit_product";s:9:"read_post";s:12:"read_product";s:11:"delete_post";s:14:"delete_product";s:10:"edit_posts";s:13:"edit_products";s:17:"edit_others_posts";s:20:"edit_others_products";s:13:"publish_posts";s:16:"publish_products";s:18:"read_private_posts";s:21:"read_private_products";s:12:"create_posts";s:13:"edit_products";}s:7:"rewrite";a:5:{s:4:"slug";s:17:"product_variation";s:10:"with_front";b:1;s:5:"pages";b:1;s:5:"feeds";b:0;s:7:"ep_mask";i:1;}s:8:"supports";b:0;}s:10:"shop_order";O:12:"WP_Post_Type":26:{s:4:"name";s:10:"shop_order";s:5:"label";s:6:"Orders";s:6:"labels";O:8:"stdClass":29:{s:4:"name";s:6:"Orders";s:13:"singular_name";s:5:"Order";s:7:"add_new";s:9:"Add Order";s:12:"add_new_item";s:13:"Add New Order";s:9:"edit_item";s:10:"Edit Order";s:8:"new_item";s:9:"New Order";s:9:"view_item";s:10:"View Order";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:13:"Search Orders";s:9:"not_found";s:15:"No Orders found";s:18:"not_found_in_trash";s:24:"No Orders found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:6:"Orders";s:8:"archives";s:6:"Orders";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:13:"Filter orders";s:21:"items_list_navigation";s:17:"Orders navigation";s:10:"items_list";s:11:"Orders list";s:9:"menu_name";s:6:"Orders";s:4:"edit";s:4:"Edit";s:4:"view";s:10:"View Order";s:6:"parent";s:13:"Parent Orders";s:14:"name_admin_bar";s:5:"Order";}s:11:"description";s:38:"This is where store orders are stored.";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";s:11:"woocommerce";s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:10:"shop_order";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:15:"edit_shop_order";s:9:"read_post";s:15:"read_shop_order";s:11:"delete_post";s:17:"delete_shop_order";s:10:"edit_posts";s:16:"edit_shop_orders";s:17:"edit_others_posts";s:23:"edit_others_shop_orders";s:13:"publish_posts";s:19:"publish_shop_orders";s:18:"read_private_posts";s:24:"read_private_shop_orders";s:4:"read";s:4:"read";s:12:"delete_posts";s:18:"delete_shop_orders";s:20:"delete_private_posts";s:26:"delete_private_shop_orders";s:22:"delete_published_posts";s:28:"delete_published_shop_orders";s:19:"delete_others_posts";s:25:"delete_others_shop_orders";s:18:"edit_private_posts";s:24:"edit_private_shop_orders";s:20:"edit_published_posts";s:26:"edit_published_shop_orders";s:12:"create_posts";s:16:"edit_shop_orders";}s:7:"rewrite";b:0;}s:17:"shop_order_refund";O:12:"WP_Post_Type":34:{s:4:"name";s:17:"shop_order_refund";s:5:"label";s:7:"Refunds";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:7:"Refunds";s:13:"singular_name";s:7:"Refunds";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:12:"Search Posts";s:9:"not_found";s:15:"No posts found.";s:18:"not_found_in_trash";s:24:"No posts found in Trash.";s:17:"parent_item_colon";N;s:9:"all_items";s:7:"Refunds";s:8:"archives";s:7:"Refunds";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:7:"Refunds";s:14:"name_admin_bar";s:7:"Refunds";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:0;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:10:"shop_order";s:12:"map_meta_cap";b:0;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";s:17:"shop_order_refund";s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:0:"";s:3:"cap";O:8:"stdClass":8:{s:9:"edit_post";s:15:"edit_shop_order";s:9:"read_post";s:15:"read_shop_order";s:11:"delete_post";s:17:"delete_shop_order";s:10:"edit_posts";s:16:"edit_shop_orders";s:17:"edit_others_posts";s:23:"edit_others_shop_orders";s:13:"publish_posts";s:19:"publish_shop_orders";s:18:"read_private_posts";s:24:"read_private_shop_orders";s:12:"create_posts";s:16:"edit_shop_orders";}s:7:"rewrite";a:5:{s:4:"slug";s:17:"shop_order_refund";s:10:"with_front";b:1;s:5:"pages";b:1;s:5:"feeds";b:0;s:7:"ep_mask";i:1;}s:8:"supports";b:0;s:26:"exclude_from_orders_screen";b:0;s:20:"add_order_meta_boxes";b:0;s:24:"exclude_from_order_count";b:1;s:24:"exclude_from_order_views";b:0;s:26:"exclude_from_order_reports";b:0;s:32:"exclude_from_order_sales_reports";b:1;s:10:"class_name";s:15:"WC_Order_Refund";}s:11:"shop_coupon";O:12:"WP_Post_Type":26:{s:4:"name";s:11:"shop_coupon";s:5:"label";s:7:"Coupons";s:6:"labels";O:8:"stdClass":29:{s:4:"name";s:7:"Coupons";s:13:"singular_name";s:6:"Coupon";s:7:"add_new";s:10:"Add Coupon";s:12:"add_new_item";s:14:"Add New Coupon";s:9:"edit_item";s:11:"Edit Coupon";s:8:"new_item";s:10:"New Coupon";s:9:"view_item";s:11:"View Coupon";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:14:"Search Coupons";s:9:"not_found";s:16:"No Coupons found";s:18:"not_found_in_trash";s:25:"No Coupons found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:7:"Coupons";s:8:"archives";s:7:"Coupons";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:14:"Filter coupons";s:21:"items_list_navigation";s:18:"Coupons navigation";s:10:"items_list";s:12:"Coupons list";s:9:"menu_name";s:7:"Coupons";s:4:"edit";s:4:"Edit";s:4:"view";s:12:"View Coupons";s:6:"parent";s:13:"Parent Coupon";s:14:"name_admin_bar";s:6:"Coupon";}s:11:"description";s:75:"This is where you can add new coupons that customers can use in your store.";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";s:11:"woocommerce";s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:11:"shop_coupon";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:16:"edit_shop_coupon";s:9:"read_post";s:16:"read_shop_coupon";s:11:"delete_post";s:18:"delete_shop_coupon";s:10:"edit_posts";s:17:"edit_shop_coupons";s:17:"edit_others_posts";s:24:"edit_others_shop_coupons";s:13:"publish_posts";s:20:"publish_shop_coupons";s:18:"read_private_posts";s:25:"read_private_shop_coupons";s:4:"read";s:4:"read";s:12:"delete_posts";s:19:"delete_shop_coupons";s:20:"delete_private_posts";s:27:"delete_private_shop_coupons";s:22:"delete_published_posts";s:29:"delete_published_shop_coupons";s:19:"delete_others_posts";s:26:"delete_others_shop_coupons";s:18:"edit_private_posts";s:25:"edit_private_shop_coupons";s:20:"edit_published_posts";s:27:"edit_published_shop_coupons";s:12:"create_posts";s:17:"edit_shop_coupons";}s:7:"rewrite";b:0;}s:12:"shop_webhook";O:12:"WP_Post_Type":27:{s:4:"name";s:12:"shop_webhook";s:5:"label";s:8:"Webhooks";s:6:"labels";O:8:"stdClass":29:{s:4:"name";s:8:"Webhooks";s:13:"singular_name";s:7:"Webhook";s:7:"add_new";s:11:"Add Webhook";s:12:"add_new_item";s:15:"Add New Webhook";s:9:"edit_item";s:12:"Edit Webhook";s:8:"new_item";s:11:"New Webhook";s:9:"view_item";s:12:"View Webhook";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:15:"Search Webhooks";s:9:"not_found";s:17:"No Webhooks found";s:18:"not_found_in_trash";s:26:"No Webhooks found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:8:"Webhooks";s:8:"archives";s:8:"Webhooks";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:8:"Webhooks";s:4:"edit";s:4:"Edit";s:4:"view";s:13:"View Webhooks";s:6:"parent";s:14:"Parent Webhook";s:14:"name_admin_bar";s:7:"Webhook";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:0;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:12:"shop_webhook";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:17:"edit_shop_webhook";s:9:"read_post";s:17:"read_shop_webhook";s:11:"delete_post";s:19:"delete_shop_webhook";s:10:"edit_posts";s:18:"edit_shop_webhooks";s:17:"edit_others_posts";s:25:"edit_others_shop_webhooks";s:13:"publish_posts";s:21:"publish_shop_webhooks";s:18:"read_private_posts";s:26:"read_private_shop_webhooks";s:4:"read";s:4:"read";s:12:"delete_posts";s:20:"delete_shop_webhooks";s:20:"delete_private_posts";s:28:"delete_private_shop_webhooks";s:22:"delete_published_posts";s:30:"delete_published_shop_webhooks";s:19:"delete_others_posts";s:27:"delete_others_shop_webhooks";s:18:"edit_private_posts";s:26:"edit_private_shop_webhooks";s:20:"edit_published_posts";s:28:"edit_published_shop_webhooks";s:12:"create_posts";s:18:"edit_shop_webhooks";}s:7:"rewrite";b:0;s:8:"supports";b:0;}s:17:"shop_subscription";O:12:"WP_Post_Type":34:{s:4:"name";s:17:"shop_subscription";s:5:"label";s:13:"Subscriptions";s:6:"labels";O:8:"stdClass":29:{s:4:"name";s:13:"Subscriptions";s:13:"singular_name";s:12:"Subscription";s:7:"add_new";s:16:"Add Subscription";s:12:"add_new_item";s:20:"Add New Subscription";s:9:"edit_item";s:17:"Edit Subscription";s:8:"new_item";s:16:"New Subscription";s:9:"view_item";s:17:"View Subscription";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:20:"Search Subscriptions";s:9:"not_found";s:22:"No Subscriptions found";s:18:"not_found_in_trash";s:31:"No Subscriptions found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:13:"Subscriptions";s:8:"archives";s:13:"Subscriptions";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:13:"Subscriptions";s:4:"edit";s:4:"Edit";s:4:"view";s:17:"View Subscription";s:6:"parent";s:20:"Parent Subscriptions";s:14:"name_admin_bar";s:12:"Subscription";}s:11:"description";s:39:"This is where subscriptions are stored.";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";s:11:"woocommerce";s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:10:"shop_order";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:15:"edit_shop_order";s:9:"read_post";s:15:"read_shop_order";s:11:"delete_post";s:17:"delete_shop_order";s:10:"edit_posts";s:16:"edit_shop_orders";s:17:"edit_others_posts";s:23:"edit_others_shop_orders";s:13:"publish_posts";s:19:"publish_shop_orders";s:18:"read_private_posts";s:24:"read_private_shop_orders";s:4:"read";s:4:"read";s:12:"delete_posts";s:18:"delete_shop_orders";s:20:"delete_private_posts";s:26:"delete_private_shop_orders";s:22:"delete_published_posts";s:28:"delete_published_shop_orders";s:19:"delete_others_posts";s:25:"delete_others_shop_orders";s:18:"edit_private_posts";s:24:"edit_private_shop_orders";s:20:"edit_published_posts";s:26:"edit_published_shop_orders";s:12:"create_posts";s:16:"edit_shop_orders";}s:7:"rewrite";b:0;s:26:"exclude_from_orders_screen";b:1;s:20:"add_order_meta_boxes";b:1;s:24:"exclude_from_order_count";b:1;s:24:"exclude_from_order_views";b:1;s:27:"exclude_from_order_webhooks";b:1;s:26:"exclude_from_order_reports";b:1;s:32:"exclude_from_order_sales_reports";b:1;s:10:"class_name";s:15:"WC_Subscription";}s:18:"wc_membership_plan";O:12:"WP_Post_Type":26:{s:4:"name";s:18:"wc_membership_plan";s:5:"label";s:16:"Membership Plans";s:6:"labels";O:8:"stdClass":28:{s:4:"name";s:16:"Membership Plans";s:13:"singular_name";s:15:"Membership Plan";s:7:"add_new";s:19:"Add Membership Plan";s:12:"add_new_item";s:23:"Add New Membership Plan";s:9:"edit_item";s:20:"Edit Membership Plan";s:8:"new_item";s:19:"New Membership Plan";s:9:"view_item";s:20:"View Membership Plan";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:23:"Search Membership Plans";s:9:"not_found";s:25:"No Membership Plans found";s:18:"not_found_in_trash";s:34:"No Membership Plans found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:11:"Memberships";s:8:"archives";s:11:"Memberships";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:11:"Memberships";s:4:"edit";s:4:"Edit";s:4:"view";s:21:"View Membership Plans";s:14:"name_admin_bar";s:15:"Membership Plan";}s:11:"description";s:47:"This is where you can add new Membership Plans.";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";s:11:"woocommerce";s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:15:"membership_plan";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:20:"edit_membership_plan";s:9:"read_post";s:20:"read_membership_plan";s:11:"delete_post";s:22:"delete_membership_plan";s:10:"edit_posts";s:21:"edit_membership_plans";s:17:"edit_others_posts";s:28:"edit_others_membership_plans";s:13:"publish_posts";s:24:"publish_membership_plans";s:18:"read_private_posts";s:29:"read_private_membership_plans";s:4:"read";s:4:"read";s:12:"delete_posts";s:23:"delete_membership_plans";s:20:"delete_private_posts";s:31:"delete_private_membership_plans";s:22:"delete_published_posts";s:33:"delete_published_membership_plans";s:19:"delete_others_posts";s:30:"delete_others_membership_plans";s:18:"edit_private_posts";s:29:"edit_private_membership_plans";s:20:"edit_published_posts";s:31:"edit_published_membership_plans";s:12:"create_posts";s:21:"edit_membership_plans";}s:7:"rewrite";b:0;}s:18:"wc_user_membership";O:12:"WP_Post_Type":26:{s:4:"name";s:18:"wc_user_membership";s:5:"label";s:7:"Members";s:6:"labels";O:8:"stdClass":28:{s:4:"name";s:7:"Members";s:13:"singular_name";s:15:"User Membership";s:7:"add_new";s:10:"Add Member";s:12:"add_new_item";s:23:"Add New User Membership";s:9:"edit_item";s:20:"Edit User Membership";s:8:"new_item";s:19:"New User Membership";s:9:"view_item";s:20:"View User Membership";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:14:"Search Members";s:9:"not_found";s:25:"No User Memberships found";s:18:"not_found_in_trash";s:34:"No User Memberships found in trash";s:17:"parent_item_colon";N;s:9:"all_items";s:11:"Memberships";s:8:"archives";s:11:"Memberships";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:11:"Memberships";s:4:"edit";s:4:"Edit";s:4:"view";s:21:"View User Memberships";s:14:"name_admin_bar";s:15:"User Membership";}s:11:"description";s:47:"This is where you can add new User Memberships.";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";s:11:"woocommerce";s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:1;s:13:"menu_position";N;s:9:"menu_icon";N;s:15:"capability_type";s:15:"user_membership";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:20:"edit_user_membership";s:9:"read_post";s:20:"read_user_membership";s:11:"delete_post";s:22:"delete_user_membership";s:10:"edit_posts";s:21:"edit_user_memberships";s:17:"edit_others_posts";s:28:"edit_others_user_memberships";s:13:"publish_posts";s:24:"publish_user_memberships";s:18:"read_private_posts";s:29:"read_private_user_memberships";s:4:"read";s:4:"read";s:12:"delete_posts";s:23:"delete_user_memberships";s:20:"delete_private_posts";s:31:"delete_private_user_memberships";s:22:"delete_published_posts";s:33:"delete_published_user_memberships";s:19:"delete_others_posts";s:30:"delete_others_user_memberships";s:18:"edit_private_posts";s:29:"edit_private_user_memberships";s:20:"edit_published_posts";s:31:"edit_published_user_memberships";s:12:"create_posts";s:21:"edit_user_memberships";}s:7:"rewrite";b:0;}s:8:"feedback";O:12:"WP_Post_Type":29:{s:4:"name";s:8:"feedback";s:5:"label";s:8:"Feedback";s:6:"labels";O:8:"stdClass":26:{s:4:"name";s:8:"Feedback";s:13:"singular_name";s:8:"Feedback";s:7:"add_new";s:7:"Add New";s:12:"add_new_item";s:12:"Add New Post";s:9:"edit_item";s:9:"Edit Post";s:8:"new_item";s:8:"New Post";s:9:"view_item";s:9:"View Post";s:10:"view_items";s:10:"View Posts";s:12:"search_items";s:15:"Search Feedback";s:9:"not_found";s:17:"No feedback found";s:18:"not_found_in_trash";s:17:"No feedback found";s:17:"parent_item_colon";N;s:9:"all_items";s:8:"Feedback";s:8:"archives";s:8:"Feedback";s:10:"attributes";s:15:"Post Attributes";s:16:"insert_into_item";s:16:"Insert into post";s:21:"uploaded_to_this_item";s:21:"Uploaded to this post";s:14:"featured_image";s:14:"Featured Image";s:18:"set_featured_image";s:18:"Set featured image";s:21:"remove_featured_image";s:21:"Remove featured image";s:18:"use_featured_image";s:21:"Use as featured image";s:17:"filter_items_list";s:17:"Filter posts list";s:21:"items_list_navigation";s:21:"Posts list navigation";s:10:"items_list";s:10:"Posts list";s:9:"menu_name";s:8:"Feedback";s:14:"name_admin_bar";s:8:"Feedback";}s:11:"description";s:0:"";s:6:"public";b:0;s:12:"hierarchical";b:0;s:19:"exclude_from_search";b:1;s:18:"publicly_queryable";b:0;s:7:"show_ui";b:1;s:12:"show_in_menu";b:1;s:17:"show_in_nav_menus";b:0;s:17:"show_in_admin_bar";b:0;s:13:"menu_position";N;s:9:"menu_icon";s:18:"dashicons-feedback";s:15:"capability_type";s:4:"page";s:12:"map_meta_cap";b:1;s:20:"register_meta_box_cb";N;s:10:"taxonomies";a:0:{}s:11:"has_archive";b:0;s:9:"query_var";b:0;s:10:"can_export";b:1;s:16:"delete_with_user";N;s:8:"_builtin";b:0;s:10:"_edit_link";s:16:"post.php?post=%d";s:3:"cap";O:8:"stdClass":15:{s:9:"edit_post";s:9:"edit_page";s:9:"read_post";s:9:"read_page";s:11:"delete_post";s:11:"delete_page";s:10:"edit_posts";s:10:"edit_pages";s:17:"edit_others_posts";s:17:"edit_others_pages";s:13:"publish_posts";s:13:"publish_pages";s:18:"read_private_posts";s:18:"read_private_pages";s:4:"read";s:4:"read";s:12:"delete_posts";s:12:"delete_pages";s:20:"delete_private_posts";s:20:"delete_private_pages";s:22:"delete_published_posts";s:22:"delete_published_pages";s:19:"delete_others_posts";s:19:"delete_others_pages";s:18:"edit_private_posts";s:18:"edit_private_pages";s:20:"edit_published_posts";s:20:"edit_published_pages";s:12:"create_posts";b:0;}s:7:"rewrite";b:0;s:8:"supports";a:0:{}s:12:"show_in_rest";b:1;s:21:"rest_controller_class";s:29:"Grunion_Contact_Form_Endpoint";}}}i:2;i:1;i:3;d:1483802604.3762319;i:4;b:0;}', 'no') ;
INSERT INTO `wp_options` ( `option_id`, `option_name`, `option_value`, `autoload`) VALUES
(8151, 'jpsq_sync-1483802604.386000-46898-30', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:18:"post_type_features";i:1;a:21:{s:4:"post";a:10:{s:5:"title";b:1;s:6:"editor";b:1;s:6:"author";b:1;s:9:"thumbnail";b:1;s:7:"excerpt";b:1;s:10:"trackbacks";b:1;s:13:"custom-fields";b:1;s:8:"comments";b:1;s:9:"revisions";b:1;s:12:"post-formats";b:1;}s:4:"page";a:8:{s:5:"title";b:1;s:6:"editor";b:1;s:6:"author";b:1;s:9:"thumbnail";b:1;s:15:"page-attributes";b:1;s:13:"custom-fields";b:1;s:8:"comments";b:1;s:9:"revisions";b:1;}s:10:"attachment";a:3:{s:5:"title";b:1;s:6:"author";b:1;s:8:"comments";b:1;}s:16:"attachment:audio";a:1:{s:9:"thumbnail";b:1;}s:16:"attachment:video";a:1:{s:9:"thumbnail";b:1;}s:8:"revision";a:1:{s:6:"author";b:1;}s:13:"nav_menu_item";a:2:{s:5:"title";b:1;s:6:"editor";b:1;}s:10:"custom_css";a:2:{s:5:"title";b:1;s:9:"revisions";b:1;}s:19:"customize_changeset";a:2:{s:5:"title";b:1;s:6:"author";b:1;}s:7:"product";a:9:{s:9:"thumbnail";b:1;s:5:"title";b:1;s:6:"editor";b:1;s:7:"excerpt";b:1;s:8:"comments";b:1;s:13:"custom-fields";b:1;s:15:"page-attributes";b:1;s:9:"publicize";b:1;s:14:"wpcom-markdown";b:1;}s:5:"forum";a:3:{s:5:"title";b:1;s:6:"editor";b:1;s:9:"revisions";b:1;}s:5:"topic";a:3:{s:5:"title";b:1;s:6:"editor";b:1;s:9:"revisions";b:1;}s:5:"reply";a:3:{s:5:"title";b:1;s:6:"editor";b:1;s:9:"revisions";b:1;}s:9:"soliloquy";a:1:{s:5:"title";b:1;}s:16:"scheduled-action";a:3:{s:5:"title";b:1;s:6:"editor";b:1;s:8:"comments";b:1;}s:10:"shop_order";a:3:{s:5:"title";b:1;s:8:"comments";b:1;s:13:"custom-fields";b:1;}s:11:"shop_coupon";a:1:{s:5:"title";b:1;}s:17:"shop_subscription";a:3:{s:5:"title";b:1;s:8:"comments";b:1;s:13:"custom-fields";b:1;}s:18:"wc_membership_plan";a:1:{s:5:"title";b:1;}s:18:"wc_user_membership";a:1:{s:0:"";b:1;}s:8:"feedback";a:2:{s:5:"title";b:1;s:6:"editor";b:1;}}}i:2;i:1;i:3;d:1483802604.385998;i:4;b:0;}', 'no'),
(8152, 'jpsq_sync-1483802604.389999-46898-31', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:27:"rest_api_allowed_post_types";i:1;a:10:{i:0;s:4:"post";i:1;s:4:"page";i:2;s:8:"revision";i:3;s:7:"product";i:4;s:5:"forum";i:5;s:5:"topic";i:6;s:5:"reply";i:7;s:8:"feedback";i:8;s:13:"jetpack-comic";i:9;s:19:"jetpack-testimonial";}}i:2;i:1;i:3;d:1483802604.389997;i:4;b:0;}', 'no'),
(8153, 'jpsq_sync-1483802604.393698-46898-32', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:32:"rest_api_allowed_public_metadata";i:1;a:18:{i:0;s:13:"_bbp_forum_id";i:1;s:13:"_bbp_topic_id";i:2;s:11:"_bbp_status";i:3;s:15:"_bbp_forum_type";i:4;s:25:"_bbp_forum_subforum_count";i:5;s:16:"_bbp_reply_count";i:6;s:22:"_bbp_total_reply_count";i:7;s:16:"_bbp_topic_count";i:8;s:22:"_bbp_total_topic_count";i:9;s:23:"_bbp_topic_count_hidden";i:10;s:18:"_bbp_last_topic_id";i:11;s:18:"_bbp_last_reply_id";i:12;s:21:"_bbp_last_active_time";i:13;s:19:"_bbp_last_active_id";i:14;s:18:"_bbp_sticky_topics";i:15;s:16:"_bbp_voice_count";i:16;s:23:"_bbp_reply_count_hidden";i:17;s:26:"_bbp_anonymous_reply_count";}}i:2;i:1;i:3;d:1483802604.3936951;i:4;b:0;}', 'no'),
(8154, 'jpsq_sync-1483802604.397523-46898-33', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:24:"sso_is_two_step_required";i:1;b:0;}i:2;i:1;i:3;d:1483802604.3975201;i:4;b:0;}', 'no'),
(8155, 'jpsq_sync-1483802604.412332-46898-34', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:26:"sso_should_hide_login_form";i:1;b:0;}i:2;i:1;i:3;d:1483802604.412329;i:4;b:0;}', 'no'),
(8156, 'jpsq_sync-1483802604.416034-46898-35', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:18:"sso_match_by_email";i:1;b:1;}i:2;i:1;i:3;d:1483802604.4160309;i:4;b:0;}', 'no'),
(8157, 'jpsq_sync-1483802604.419806-46898-36', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:21:"sso_new_user_override";i:1;b:0;}i:2;i:1;i:3;d:1483802604.4198041;i:4;b:0;}', 'no'),
(8158, 'jpsq_sync-1483802604.423375-46898-37', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:29:"sso_bypass_default_login_form";i:1;b:0;}i:2;i:1;i:3;d:1483802604.423372;i:4;b:0;}', 'no'),
(8159, 'jpsq_sync-1483802604.426904-46898-38', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:10:"wp_version";i:1;s:3:"4.7";}i:2;i:1;i:3;d:1483802604.4269011;i:4;b:0;}', 'no'),
(8160, 'jpsq_sync-1483802604.431792-46898-39', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:11:"get_plugins";i:1;a:30:{s:19:"akismet/akismet.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:7:"Akismet";s:9:"PluginURI";s:20:"https://akismet.com/";s:7:"Version";s:3:"3.2";s:11:"Description";s:405:"Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="https://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.";s:6:"Author";s:10:"Automattic";s:9:"AuthorURI";s:41:"https://automattic.com/wordpress-plugins/";s:10:"TextDomain";s:7:"akismet";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:7:"Akismet";s:10:"AuthorName";s:10:"Automattic";}s:43:"amazon-web-services/amazon-web-services.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:19:"Amazon Web Services";s:9:"PluginURI";s:56:"http://wordpress.org/extend/plugins/amazon-web-services/";s:7:"Version";s:5:"1.0.1";s:11:"Description";s:109:"Includes the Amazon Web Services PHP libraries, stores access keys, and allows other plugins to hook into it.";s:6:"Author";s:16:"Delicious Brains";s:9:"AuthorURI";s:27:"http://deliciousbrains.com/";s:10:"TextDomain";s:19:"amazon-web-services";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:1;s:5:"Title";s:19:"Amazon Web Services";s:10:"AuthorName";s:16:"Delicious Brains";}s:19:"bbpress/bbpress.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:7:"bbPress";s:9:"PluginURI";s:19:"https://bbpress.org";s:7:"Version";s:6:"2.5.12";s:11:"Description";s:70:"bbPress is forum software with a twist from the creators of WordPress.";s:6:"Author";s:21:"The bbPress Community";s:9:"AuthorURI";s:19:"https://bbpress.org";s:10:"TextDomain";s:7:"bbpress";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:0;s:5:"Title";s:7:"bbPress";s:10:"AuthorName";s:21:"The bbPress Community";}s:35:"cimy-swift-smtp/cimy_swift_smtp.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:15:"Cimy Swift SMTP";s:9:"PluginURI";s:67:"http://www.marcocimmino.net/cimy-wordpress-plugins/cimy-swift-smtp/";s:7:"Version";s:5:"2.6.2";s:11:"Description";s:43:"Send email via SMTP (Compatible with GMAIL)";s:6:"Author";s:13:"Marco Cimmino";s:9:"AuthorURI";s:30:"mailto:cimmino.marco@gmail.com";s:10:"TextDomain";s:15:"cimy-swift-smtp";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:15:"Cimy Swift SMTP";s:10:"AuthorName";s:13:"Marco Cimmino";}s:49:"cimy-user-extra-fields/cimy_user_extra_fields.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:22:"Cimy User Extra Fields";s:9:"PluginURI";s:74:"http://www.marcocimmino.net/cimy-wordpress-plugins/cimy-user-extra-fields/";s:7:"Version";s:5:"2.7.1";s:11:"Description";s:54:"Add some useful fields to registration and user\'s info";s:6:"Author";s:13:"Marco Cimmino";s:9:"AuthorURI";s:30:"mailto:cimmino.marco@gmail.com";s:10:"TextDomain";s:22:"cimy-user-extra-fields";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:22:"Cimy User Extra Fields";s:10:"AuthorName";s:13:"Marco Cimmino";}s:39:"cimy-user-manager/cimy_user_manager.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:17:"Cimy User Manager";s:9:"PluginURI";s:69:"http://www.marcocimmino.net/cimy-wordpress-plugins/cimy-user-manager/";s:7:"Version";s:5:"1.5.0";s:11:"Description";s:114:"Import and export users from/to CSV files, supports all WordPress profile data also Cimy User Extra Fields plug-in";s:6:"Author";s:13:"Marco Cimmino";s:9:"AuthorURI";s:30:"mailto:cimmino.marco@gmail.com";s:10:"TextDomain";s:17:"cimy-user-manager";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:17:"Cimy User Manager";s:10:"AuthorName";s:13:"Marco Cimmino";}s:49:"gd-bbpress-attachments/gd-bbpress-attachments.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:22:"GD bbPress Attachments";s:9:"PluginURI";s:30:"https://bbpress.dev4press.com/";s:7:"Version";s:3:"2.4";s:11:"Description";s:137:"Implements attachments upload to the topics and replies in bbPress plugin through media library and adds additional forum based controls.";s:6:"Author";s:14:"Milan Petrovic";s:9:"AuthorURI";s:26:"https://www.dev4press.com/";s:10:"TextDomain";s:22:"gd-bbpress-attachments";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:22:"GD bbPress Attachments";s:10:"AuthorName";s:14:"Milan Petrovic";}s:37:"gd-bbpress-tools/gd-bbpress-tools.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:16:"GD bbPress Tools";s:9:"PluginURI";s:30:"https://bbpress.dev4press.com/";s:7:"Version";s:3:"1.9";s:11:"Description";s:128:"Adds different expansions and tools to the bbPress 2.x plugin powered forums: BBCode support, signatures, custom views, quote...";s:6:"Author";s:14:"Milan Petrovic";s:9:"AuthorURI";s:26:"https://www.dev4press.com/";s:10:"TextDomain";s:16:"gd-bbpress-tools";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:16:"GD bbPress Tools";s:10:"AuthorName";s:14:"Milan Petrovic";}s:19:"jetpack/jetpack.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:24:"Jetpack by WordPress.com";s:9:"PluginURI";s:18:"http://jetpack.com";s:7:"Version";s:5:"4.4.2";s:11:"Description";s:218:"Bring the power of the WordPress.com cloud to your self-hosted WordPress. Jetpack enables you to connect your blog to a WordPress.com account to use the powerful features normally only available to WordPress.com users.";s:6:"Author";s:10:"Automattic";s:9:"AuthorURI";s:18:"http://jetpack.com";s:10:"TextDomain";s:7:"jetpack";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:0;s:5:"Title";s:24:"Jetpack by WordPress.com";s:10:"AuthorName";s:10:"Automattic";}s:27:"redis-cache/redis-cache.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:18:"Redis Object Cache";s:9:"PluginURI";s:42:"https://wordpress.org/plugins/redis-cache/";s:7:"Version";s:5:"1.3.5";s:11:"Description";s:120:"A persistent object cache backend powered by Redis. Supports Predis, PhpRedis, HHVM, replication, clustering and WP-CLI.";s:6:"Author";s:11:"Till Krüss";s:9:"AuthorURI";s:16:"https://till.im/";s:10:"TextDomain";s:11:"redis-cache";s:10:"DomainPath";s:10:"/languages";s:7:"Network";b:0;s:5:"Title";s:18:"Redis Object Cache";s:10:"AuthorName";s:11:"Till Krüss";}s:23:"soliloquy/soliloquy.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:9:"Soliloquy";s:9:"PluginURI";s:22:"http://soliloquywp.com";s:7:"Version";s:7:"2.5.2.8";s:11:"Description";s:57:"Soliloquy is the best responsive WordPress slider plugin.";s:6:"Author";s:14:"Soliloquy Team";s:9:"AuthorURI";s:22:"http://soliloquywp.com";s:10:"TextDomain";s:9:"soliloquy";s:10:"DomainPath";s:9:"languages";s:7:"Network";b:0;s:5:"Title";s:9:"Soliloquy";s:10:"AuthorName";s:14:"Soliloquy Team";}s:41:"soliloquy-defaults/soliloquy-defaults.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:26:"Soliloquy - Defaults Addon";s:9:"PluginURI";s:23:"https://soliloquywp.com";s:7:"Version";s:5:"2.1.2";s:11:"Description";s:66:"Enables defaults to be set and inherited by new Soliloquy sliders.";s:6:"Author";s:15:"Soliloquy Teams";s:9:"AuthorURI";s:23:"https://soliloquywp.com";s:10:"TextDomain";s:18:"soliloquy-defaults";s:10:"DomainPath";s:9:"languages";s:7:"Network";b:0;s:5:"Title";s:26:"Soliloquy - Defaults Addon";s:10:"AuthorName";s:15:"Soliloquy Teams";}s:57:"soliloquy-featured-content/soliloquy-featured-content.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:34:"Soliloquy - Featured Content Addon";s:9:"PluginURI";s:23:"https://soliloquywp.com";s:7:"Version";s:5:"2.4.4";s:11:"Description";s:46:"Enables featured content sliders in Soliloquy.";s:6:"Author";s:14:"Soliloquy Team";s:9:"AuthorURI";s:23:"https://soliloquywp.com";s:10:"TextDomain";s:12:"soliloquy-fc";s:10:"DomainPath";s:9:"languages";s:7:"Network";b:0;s:5:"Title";s:34:"Soliloquy - Featured Content Addon";s:10:"AuthorName";s:14:"Soliloquy Team";}s:45:"soliloquy-thumbnails/soliloquy-thumbnails.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:28:"Soliloquy - Thumbnails Addon";s:9:"PluginURI";s:22:"http://soliloquywp.com";s:7:"Version";s:5:"2.3.3";s:11:"Description";s:49:"Enables thumbnails display for Soliloquy sliders.";s:6:"Author";s:14:"Soliloquy Team";s:9:"AuthorURI";s:22:"http://soliloquywp.com";s:10:"TextDomain";s:20:"soliloquy-thumbnails";s:10:"DomainPath";s:9:"languages";s:7:"Network";b:0;s:5:"Title";s:28:"Soliloquy - Thumbnails Addon";s:10:"AuthorName";s:14:"Soliloquy Team";}s:57:"storefront-blog-customiser/storefront-blog-customiser.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:26:"Storefront Blog Customiser";s:9:"PluginURI";s:57:"http://woothemes.com/products/storefront-blog-customiser/";s:7:"Version";s:5:"1.2.1";s:11:"Description";s:56:"Adds blog customisation settings to the Storefront theme";s:6:"Author";s:9:"WooThemes";s:9:"AuthorURI";s:21:"http://woothemes.com/";s:10:"TextDomain";s:26:"storefront-blog-customiser";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:0;s:5:"Title";s:26:"Storefront Blog Customiser";s:10:"AuthorName";s:9:"WooThemes";}s:43:"storefront-designer/storefront-designer.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:19:"Storefront Designer";s:9:"PluginURI";s:50:"http://woothemes.com/products/storefront-designer/";s:7:"Version";s:5:"1.8.4";s:11:"Description";s:65:"Adds a bunch of additional design options to the Storefront theme";s:6:"Author";s:9:"WooThemes";s:9:"AuthorURI";s:21:"http://woothemes.com/";s:10:"TextDomain";s:19:"storefront-designer";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:0;s:5:"Title";s:19:"Storefront Designer";s:10:"AuthorName";s:9:"WooThemes";}s:45:"storefront-powerpack/storefront-powerpack.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:20:"Storefront Powerpack";s:9:"PluginURI";s:51:"http://woothemes.com/products/storefront-powerpack/";s:7:"Version";s:5:"1.3.0";s:11:"Description";s:134:"Up your game with Storefront Powerpack and get access to host of neat gadgets that enable effortless customisation of your Storefront.";s:6:"Author";s:9:"WooThemes";s:9:"AuthorURI";s:21:"http://woothemes.com/";s:10:"TextDomain";s:20:"storefront-powerpack";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:0;s:5:"Title";s:20:"Storefront Powerpack";s:10:"AuthorName";s:9:"WooThemes";}s:52:"theme-customisations-master/theme-customisations.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:20:"Theme Customisations";s:9:"PluginURI";s:48:"http://github.com/woothemes/theme-customisations";s:7:"Version";s:5:"1.0.0";s:11:"Description";s:67:"A handy little plugin to contain your theme customisation snippets.";s:6:"Author";s:9:"WooThemes";s:9:"AuthorURI";s:25:"http://www.woothemes.com/";s:10:"TextDomain";s:27:"theme-customisations-master";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:20:"Theme Customisations";s:10:"AuthorName";s:9:"WooThemes";}s:37:"tinymce-advanced/tinymce-advanced.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:16:"TinyMCE Advanced";s:9:"PluginURI";s:51:"http://www.laptoptips.ca/projects/tinymce-advanced/";s:7:"Version";s:5:"4.4.3";s:11:"Description";s:81:"Enables advanced features and plugins in TinyMCE, the visual editor in WordPress.";s:6:"Author";s:10:"Andrew Ozz";s:9:"AuthorURI";s:25:"http://www.laptoptips.ca/";s:10:"TextDomain";s:16:"tinymce-advanced";s:10:"DomainPath";s:6:"/langs";s:7:"Network";b:0;s:5:"Title";s:16:"TinyMCE Advanced";s:10:"AuthorName";s:10:"Andrew Ozz";}s:33:"w3-total-cache/w3-total-cache.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:14:"W3 Total Cache";s:9:"PluginURI";s:57:"https://www.w3-edge.com/wordpress-plugins/w3-total-cache/";s:7:"Version";s:7:"0.9.5.1";s:11:"Description";s:244:"The highest rated and most complete WordPress performance plugin. Dramatically improve the speed and user experience of your site. Add browser, page, object and database caching as well as minify and content delivery network (CDN) to WordPress.";s:6:"Author";s:16:"Frederick Townes";s:9:"AuthorURI";s:42:"http://www.linkedin.com/in/fredericktownes";s:10:"TextDomain";s:14:"w3-total-cache";s:10:"DomainPath";s:0:"";s:7:"Network";b:1;s:5:"Title";s:14:"W3 Total Cache";s:10:"AuthorName";s:16:"Frederick Townes";}s:27:"woocommerce/woocommerce.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:11:"WooCommerce";s:9:"PluginURI";s:24:"https://woocommerce.com/";s:7:"Version";s:6:"2.6.11";s:11:"Description";s:64:"An e-commerce toolkit that helps you sell anything. Beautifully.";s:6:"Author";s:9:"WooThemes";s:9:"AuthorURI";s:23:"https://woocommerce.com";s:10:"TextDomain";s:11:"woocommerce";s:10:"DomainPath";s:16:"/i18n/languages/";s:7:"Network";b:0;s:5:"Title";s:11:"WooCommerce";s:10:"AuthorName";s:9:"WooThemes";}s:39:"woothemes-updater/woothemes-updater.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:18:"WooCommerce Helper";s:9:"PluginURI";s:33:"https://woocommerce.com/products/";s:7:"Version";s:5:"1.7.2";s:11:"Description";s:132:"Hi there. I\'m here to help you manage subscriptions for your WooCommerce products, as well as help out when you need a guiding hand.";s:6:"Author";s:11:"WooCommerce";s:9:"AuthorURI";s:24:"https://woocommerce.com/";s:10:"TextDomain";s:17:"woothemes-updater";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:1;s:5:"Title";s:18:"WooCommerce Helper";s:10:"AuthorName";s:11:"WooCommerce";}s:51:"woocommerce-memberships/woocommerce-memberships.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:23:"WooCommerce Memberships";s:9:"PluginURI";s:58:"http://www.woothemes.com/products/woocommerce-memberships/";s:7:"Version";s:5:"1.7.3";s:11:"Description";s:90:"Sell memberships that provide access to restricted content, products, discounts, and more!";s:6:"Author";s:20:"WooThemes / SkyVerge";s:9:"AuthorURI";s:25:"http://www.woothemes.com/";s:10:"TextDomain";s:23:"woocommerce-memberships";s:10:"DomainPath";s:16:"/i18n/languages/";s:7:"Network";b:0;s:5:"Title";s:23:"WooCommerce Memberships";s:10:"AuthorName";s:20:"WooThemes / SkyVerge";}s:57:"woocommerce-gateway-stripe/woocommerce-gateway-stripe.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:26:"WooCommerce Stripe Gateway";s:9:"PluginURI";s:57:"https://wordpress.org/plugins/woocommerce-gateway-stripe/";s:7:"Version";s:5:"3.0.6";s:11:"Description";s:53:"Take credit card payments on your store using Stripe.";s:6:"Author";s:10:"Automattic";s:9:"AuthorURI";s:24:"https://woocommerce.com/";s:10:"TextDomain";s:26:"woocommerce-gateway-stripe";s:10:"DomainPath";s:10:"/languages";s:7:"Network";b:0;s:5:"Title";s:26:"WooCommerce Stripe Gateway";s:10:"AuthorName";s:10:"Automattic";}s:55:"woocommerce-subscriptions/woocommerce-subscriptions.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:25:"WooCommerce Subscriptions";s:9:"PluginURI";s:62:"http://www.woocommerce.com/products/woocommerce-subscriptions/";s:7:"Version";s:5:"2.1.2";s:11:"Description";s:77:"Sell products and services with recurring payments in your WooCommerce Store.";s:6:"Author";s:14:"Prospress Inc.";s:9:"AuthorURI";s:21:"http://prospress.com/";s:10:"TextDomain";s:25:"woocommerce-subscriptions";s:10:"DomainPath";s:0:"";s:7:"Network";b:0;s:5:"Title";s:25:"WooCommerce Subscriptions";s:10:"AuthorName";s:14:"Prospress Inc.";}s:39:"wp-migrate-db-pro/wp-migrate-db-pro.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:17:"WP Migrate DB Pro";s:9:"PluginURI";s:45:"http://deliciousbrains.com/wp-migrate-db-pro/";s:7:"Version";s:5:"1.6.1";s:11:"Description";s:59:"Export, push, and pull to migrate your WordPress databases.";s:6:"Author";s:16:"Delicious Brains";s:9:"AuthorURI";s:26:"http://deliciousbrains.com";s:10:"TextDomain";s:13:"wp-migrate-db";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:1;s:5:"Title";s:17:"WP Migrate DB Pro";s:10:"AuthorName";s:16:"Delicious Brains";}s:63:"wp-migrate-db-pro-media-files/wp-migrate-db-pro-media-files.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:29:"WP Migrate DB Pro Media Files";s:9:"PluginURI";s:45:"http://deliciousbrains.com/wp-migrate-db-pro/";s:7:"Version";s:5:"1.4.5";s:11:"Description";s:71:"An extension to WP Migrate DB Pro, allows the migration of media files.";s:6:"Author";s:16:"Delicious Brains";s:9:"AuthorURI";s:26:"http://deliciousbrains.com";s:10:"TextDomain";s:29:"wp-migrate-db-pro-media-files";s:10:"DomainPath";s:0:"";s:7:"Network";b:1;s:5:"Title";s:29:"WP Migrate DB Pro Media Files";s:10:"AuthorName";s:16:"Delicious Brains";}s:61:"amazon-s3-and-cloudfront-pro/amazon-s3-and-cloudfront-pro.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:13:"WP Offload S3";s:9:"PluginURI";s:41:"http://deliciousbrains.com/wp-offload-s3/";s:7:"Version";s:5:"1.1.4";s:11:"Description";s:91:"Speed up your WordPress site by offloading your media and assets to Amazon S3 & CloudFront.";s:6:"Author";s:16:"Delicious Brains";s:9:"AuthorURI";s:27:"http://deliciousbrains.com/";s:10:"TextDomain";s:24:"amazon-s3-and-cloudfront";s:10:"DomainPath";s:11:"/languages/";s:7:"Network";b:1;s:5:"Title";s:13:"WP Offload S3";s:10:"AuthorName";s:16:"Delicious Brains";}s:77:"amazon-s3-and-cloudfront-woocommerce/amazon-s3-and-cloudfront-woocommerce.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:33:"WP Offload S3 - WooCommerce Addon";s:9:"PluginURI";s:59:"http://deliciousbrains.com/wp-offload-s3/#woocommerce-addon";s:7:"Version";s:5:"1.0.5";s:11:"Description";s:82:"WP Offload S3 addon to integrate WooCommerce with Amazon S3. Requires Pro Upgrade.";s:6:"Author";s:16:"Delicious Brains";s:9:"AuthorURI";s:26:"http://deliciousbrains.com";s:10:"TextDomain";s:36:"amazon-s3-and-cloudfront-woocommerce";s:10:"DomainPath";s:0:"";s:7:"Network";b:1;s:5:"Title";s:33:"WP Offload S3 - WooCommerce Addon";s:10:"AuthorName";s:16:"Delicious Brains";}s:33:"wp-user-avatar/wp-user-avatar.php";a:12:{s:3:"Woo";s:0:"";s:4:"Name";s:14:"WP User Avatar";s:9:"PluginURI";s:44:"http://wordpress.org/plugins/wp-user-avatar/";s:7:"Version";s:5:"2.0.8";s:11:"Description";s:101:"Use any image from your WordPress Media Library as a custom user avatar. Add your own Default Avatar.";s:6:"Author";s:11:"flippercode";s:9:"AuthorURI";s:27:"http://www.flippercode.com/";s:10:"TextDomain";s:14:"wp-user-avatar";s:10:"DomainPath";s:6:"/lang/";s:7:"Network";b:0;s:5:"Title";s:14:"WP User Avatar";s:10:"AuthorName";s:11:"flippercode";}}}i:2;i:1;i:3;d:1483802604.4317901;i:4;b:0;}', 'no'),
(8161, 'jpsq_sync-1483802604.439591-46898-40', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:14:"active_modules";i:1;a:20:{i:0;s:18:"after-the-deadline";i:1;s:12:"contact-form";i:6;s:8:"json-api";i:7;s:5:"latex";i:8;s:6:"manage";i:10;s:10:"omnisearch";i:12;s:7:"protect";i:13;s:9:"publicize";i:14;s:10:"sharedaddy";i:15;s:10:"shortcodes";i:16;s:10:"shortlinks";i:17;s:8:"sitemaps";i:18;s:5:"stats";i:19;s:13:"subscriptions";i:21;s:18:"verification-tools";i:22;s:17:"widget-visibility";i:23;s:7:"widgets";i:24;s:8:"carousel";i:26;s:13:"related-posts";i:27;s:21:"enhanced-distribution";}}i:2;i:1;i:3;d:1483802604.4395881;i:4;b:0;}', 'no'),
(8162, 'jpsq_sync-1483802604.443358-46898-41', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:16:"hosting_provider";i:1;s:7:"unknown";}i:2;i:1;i:3;d:1483802604.443356;i:4;b:0;}', 'no'),
(8163, 'jpsq_sync-1483802604.447000-46898-42', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:6:"locale";i:1;s:5:"en_US";}i:2;i:1;i:3;d:1483802604.4469979;i:4;b:0;}', 'no'),
(8164, 'jpsq_sync-1483802604.450874-46898-43', 'a:5:{i:0;s:21:"jetpack_sync_callable";i:1;a:2:{i:0;s:13:"site_icon_url";i:1;s:119:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-CDClogo2015_rev1_A.png";}i:2;i:1;i:3;d:1483802604.4508719;i:4;b:0;}', 'no'),
(8165, 'jetpack_callables_sync_checksum', 'a:26:{s:18:"wp_max_upload_size";i:677931734;s:15:"is_main_network";i:734881840;s:13:"is_multi_site";i:734881840;s:17:"main_network_site";i:856364347;s:8:"site_url";i:3351765247;s:8:"home_url";i:3580305381;s:16:"single_user_site";i:734881840;s:7:"updates";i:3425443202;s:28:"has_file_system_write_access";i:4261170317;s:21:"is_version_controlled";i:4261170317;s:10:"taxonomies";i:3468720797;s:10:"post_types";i:4089010277;s:18:"post_type_features";i:2175734207;s:27:"rest_api_allowed_post_types";i:950794522;s:32:"rest_api_allowed_public_metadata";i:915280507;s:24:"sso_is_two_step_required";i:734881840;s:26:"sso_should_hide_login_form";i:734881840;s:18:"sso_match_by_email";i:4261170317;s:21:"sso_new_user_override";i:734881840;s:29:"sso_bypass_default_login_form";i:734881840;s:10:"wp_version";i:1977511605;s:11:"get_plugins";i:3356364252;s:14:"active_modules";i:341296789;s:16:"hosting_provider";i:769900095;s:6:"locale";i:110763218;s:13:"site_icon_url";i:1795625050;}', 'yes'),
(8166, 'jetpack_next_sync_time_sync', '1483802664', 'yes'),
(8175, 'anarcho_cfunctions_settings', 'a:1:{s:26:"anarcho_cfunctions-content";s:497:"/* Enter Your Custom Functions Here */\r\nadd_action( \'init\', \'child_theme_init\' );\r\nfunction child_theme_init() {\r\n      add_action( \'storefront_before_content\', \'woa_add_full_slider\', 5 );\r\n}\r\n\r\nfunction woa_add_full_slider() { \r\n if ( is_front_page() ) :\r\n      ?> \r\n            <div id="slider">\r\n                    <?php echo do_shortcode("[featured-content-slider design=\\"design-4\\" image_style=\\"circle\\" slides_column=\\"2\\"]"); ?>\r\n          \r\n            </div> \r\n      <?php\r\n endif; \r\n}";}', 'yes'),
(8176, 'anarcho_cfunctions_error', '0', 'yes'),
(9272, '_site_transient_timeout_as3cfpro_upgrade_data', '1484042419', 'no'),
(9273, '_site_transient_as3cfpro_upgrade_data', 'a:8:{s:28:"amazon-s3-and-cloudfront-pro";a:2:{s:7:"version";s:3:"1.3";s:6:"tested";s:3:"4.7";}s:28:"amazon-s3-and-cloudfront-edd";a:2:{s:7:"version";s:5:"1.0.4";s:6:"tested";s:3:"4.7";}s:36:"amazon-s3-and-cloudfront-woocommerce";a:2:{s:7:"version";s:5:"1.0.6";s:6:"tested";s:3:"4.7";}s:31:"amazon-s3-and-cloudfront-assets";a:2:{s:7:"version";s:5:"1.2.3";s:6:"tested";s:3:"4.7";}s:45:"amazon-s3-and-cloudfront-enable-media-replace";a:2:{s:7:"version";s:5:"1.0.3";s:6:"tested";s:3:"4.7";}s:36:"amazon-s3-and-cloudfront-meta-slider";a:2:{s:7:"version";s:5:"1.0.2";s:6:"tested";s:3:"4.7";}s:29:"amazon-s3-and-cloudfront-wpml";a:2:{s:7:"version";s:5:"1.0.1";s:6:"tested";s:3:"4.7";}s:39:"amazon-s3-and-cloudfront-acf-image-crop";a:2:{s:7:"version";s:3:"1.0";s:6:"tested";s:3:"4.7";}}', 'no'),
(9543, 'akismet_spam_count', '1', 'yes'),
(9595, 'update_replace_s3_urls_session', 'a:5:{s:6:"status";i:1;s:17:"total_attachments";i:0;s:21:"processed_attachments";i:0;s:15:"blogs_processed";b:0;s:5:"blogs";a:1:{i:1;a:6:{s:6:"prefix";s:3:"wp_";s:9:"processed";b:0;s:17:"total_attachments";N;s:18:"last_attachment_id";N;s:15:"highest_post_id";N;s:12:"last_post_id";N;}}}', 'no'),
(9633, '_transient_wc_count_comments', 'O:8:"stdClass":7:{s:8:"approved";s:1:"4";s:4:"spam";s:1:"1";s:14:"total_comments";i:5;s:3:"all";i:5;s:9:"moderated";i:0;s:5:"trash";i:0;s:12:"post-trashed";i:0;}', 'yes'),
(9634, '_transient_as_comment_count', 'O:8:"stdClass":7:{s:8:"approved";s:1:"3";s:4:"spam";s:1:"1";s:14:"total_comments";i:4;s:3:"all";i:4;s:9:"moderated";i:0;s:5:"trash";i:0;s:12:"post-trashed";i:0;}', 'yes'),
(9635, '_site_transient_timeout_theme_roots', '1484044208', 'no'),
(9636, '_site_transient_theme_roots', 'a:5:{s:6:"sf_cdc";s:7:"/themes";s:10:"storefront";s:7:"/themes";s:13:"twentyfifteen";s:7:"/themes";s:14:"twentyfourteen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";}', 'no'),
(9637, '_site_transient_update_plugins', 'O:8:"stdClass":4:{s:12:"last_checked";i:1484042411;s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:16:{s:19:"akismet/akismet.php";O:8:"stdClass":6:{s:2:"id";s:2:"15";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:3:"3.2";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:54:"https://downloads.wordpress.org/plugin/akismet.3.2.zip";}s:43:"amazon-web-services/amazon-web-services.php";O:8:"stdClass":6:{s:2:"id";s:5:"44146";s:4:"slug";s:19:"amazon-web-services";s:6:"plugin";s:43:"amazon-web-services/amazon-web-services.php";s:11:"new_version";s:5:"1.0.1";s:3:"url";s:50:"https://wordpress.org/plugins/amazon-web-services/";s:7:"package";s:68:"https://downloads.wordpress.org/plugin/amazon-web-services.1.0.1.zip";}s:19:"bbpress/bbpress.php";O:8:"stdClass":6:{s:2:"id";s:5:"11780";s:4:"slug";s:7:"bbpress";s:6:"plugin";s:19:"bbpress/bbpress.php";s:11:"new_version";s:6:"2.5.12";s:3:"url";s:38:"https://wordpress.org/plugins/bbpress/";s:7:"package";s:57:"https://downloads.wordpress.org/plugin/bbpress.2.5.12.zip";}s:35:"cimy-swift-smtp/cimy_swift_smtp.php";O:8:"stdClass":6:{s:2:"id";s:4:"5926";s:4:"slug";s:15:"cimy-swift-smtp";s:6:"plugin";s:35:"cimy-swift-smtp/cimy_swift_smtp.php";s:11:"new_version";s:5:"2.6.2";s:3:"url";s:46:"https://wordpress.org/plugins/cimy-swift-smtp/";s:7:"package";s:64:"https://downloads.wordpress.org/plugin/cimy-swift-smtp.2.6.2.zip";}s:49:"cimy-user-extra-fields/cimy_user_extra_fields.php";O:8:"stdClass":6:{s:2:"id";s:4:"5909";s:4:"slug";s:22:"cimy-user-extra-fields";s:6:"plugin";s:49:"cimy-user-extra-fields/cimy_user_extra_fields.php";s:11:"new_version";s:5:"2.7.1";s:3:"url";s:53:"https://wordpress.org/plugins/cimy-user-extra-fields/";s:7:"package";s:71:"https://downloads.wordpress.org/plugin/cimy-user-extra-fields.2.7.1.zip";}s:39:"cimy-user-manager/cimy_user_manager.php";O:8:"stdClass":6:{s:2:"id";s:5:"12727";s:4:"slug";s:17:"cimy-user-manager";s:6:"plugin";s:39:"cimy-user-manager/cimy_user_manager.php";s:11:"new_version";s:5:"1.5.0";s:3:"url";s:48:"https://wordpress.org/plugins/cimy-user-manager/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/cimy-user-manager.1.5.0.zip";}s:49:"gd-bbpress-attachments/gd-bbpress-attachments.php";O:8:"stdClass":7:{s:2:"id";s:5:"25091";s:4:"slug";s:22:"gd-bbpress-attachments";s:6:"plugin";s:49:"gd-bbpress-attachments/gd-bbpress-attachments.php";s:11:"new_version";s:3:"2.4";s:3:"url";s:53:"https://wordpress.org/plugins/gd-bbpress-attachments/";s:7:"package";s:65:"https://downloads.wordpress.org/plugin/gd-bbpress-attachments.zip";s:14:"upgrade_notice";s:150:"Added download attribute to attached files links. Many updates and improvements. PHP minimal requirement to 5.3. WordPress minimal requirement to 4.0.";}s:37:"gd-bbpress-tools/gd-bbpress-tools.php";O:8:"stdClass":7:{s:2:"id";s:5:"28086";s:4:"slug";s:16:"gd-bbpress-tools";s:6:"plugin";s:37:"gd-bbpress-tools/gd-bbpress-tools.php";s:11:"new_version";s:3:"1.9";s:3:"url";s:47:"https://wordpress.org/plugins/gd-bbpress-tools/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/gd-bbpress-tools.zip";s:14:"upgrade_notice";s:100:"Many updates and improvements. PHP minimal requirement to 5.3. WordPress minimal requirement to 4.0.";}s:19:"jetpack/jetpack.php";O:8:"stdClass":7:{s:2:"id";s:5:"20101";s:4:"slug";s:7:"jetpack";s:6:"plugin";s:19:"jetpack/jetpack.php";s:11:"new_version";s:5:"4.4.2";s:3:"url";s:38:"https://wordpress.org/plugins/jetpack/";s:7:"package";s:56:"https://downloads.wordpress.org/plugin/jetpack.4.4.2.zip";s:14:"upgrade_notice";s:88:"Jetpack 4.4.2 fixes compatibility issues with WordPress 4.7. Please upgrade immediately.";}s:43:"my-custom-functions/my-custom-functions.php";O:8:"stdClass":6:{s:2:"id";s:5:"53296";s:4:"slug";s:19:"my-custom-functions";s:6:"plugin";s:43:"my-custom-functions/my-custom-functions.php";s:11:"new_version";s:3:"3.5";s:3:"url";s:50:"https://wordpress.org/plugins/my-custom-functions/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/my-custom-functions.3.5.zip";}s:27:"redis-cache/redis-cache.php";O:8:"stdClass":7:{s:2:"id";s:5:"55213";s:4:"slug";s:11:"redis-cache";s:6:"plugin";s:27:"redis-cache/redis-cache.php";s:11:"new_version";s:5:"1.3.5";s:3:"url";s:42:"https://wordpress.org/plugins/redis-cache/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/redis-cache.1.3.5.zip";s:14:"upgrade_notice";s:107:"This update contains various changes, including performance improvements and better Batcache compatibility.";}s:37:"tinymce-advanced/tinymce-advanced.php";O:8:"stdClass":6:{s:2:"id";s:3:"731";s:4:"slug";s:16:"tinymce-advanced";s:6:"plugin";s:37:"tinymce-advanced/tinymce-advanced.php";s:11:"new_version";s:5:"4.4.3";s:3:"url";s:47:"https://wordpress.org/plugins/tinymce-advanced/";s:7:"package";s:65:"https://downloads.wordpress.org/plugin/tinymce-advanced.4.4.3.zip";}s:33:"w3-total-cache/w3-total-cache.php";O:8:"stdClass":6:{s:2:"id";s:4:"9376";s:4:"slug";s:14:"w3-total-cache";s:6:"plugin";s:33:"w3-total-cache/w3-total-cache.php";s:11:"new_version";s:7:"0.9.5.1";s:3:"url";s:45:"https://wordpress.org/plugins/w3-total-cache/";s:7:"package";s:65:"https://downloads.wordpress.org/plugin/w3-total-cache.0.9.5.1.zip";}s:27:"woocommerce/woocommerce.php";O:8:"stdClass":6:{s:2:"id";s:5:"25331";s:4:"slug";s:11:"woocommerce";s:6:"plugin";s:27:"woocommerce/woocommerce.php";s:11:"new_version";s:6:"2.6.11";s:3:"url";s:42:"https://wordpress.org/plugins/woocommerce/";s:7:"package";s:61:"https://downloads.wordpress.org/plugin/woocommerce.2.6.11.zip";}s:57:"woocommerce-gateway-stripe/woocommerce-gateway-stripe.php";O:8:"stdClass":7:{s:2:"id";s:5:"72276";s:4:"slug";s:26:"woocommerce-gateway-stripe";s:6:"plugin";s:57:"woocommerce-gateway-stripe/woocommerce-gateway-stripe.php";s:11:"new_version";s:5:"3.0.6";s:3:"url";s:57:"https://wordpress.org/plugins/woocommerce-gateway-stripe/";s:7:"package";s:75:"https://downloads.wordpress.org/plugin/woocommerce-gateway-stripe.3.0.6.zip";s:14:"upgrade_notice";s:300:"Fix - When adding declined cards, fatal error is thrown.\nFix - After a failed/declined process, valid cards are not accepted.\nFix - When paying via pay order page/link, billing info is not sent.\nFix - Account for all types of errors for proper localization.\nFix - Correctly reference Stripe fees/net ";}s:33:"wp-user-avatar/wp-user-avatar.php";O:8:"stdClass":6:{s:2:"id";s:5:"37680";s:4:"slug";s:14:"wp-user-avatar";s:6:"plugin";s:33:"wp-user-avatar/wp-user-avatar.php";s:11:"new_version";s:5:"2.0.8";s:3:"url";s:45:"https://wordpress.org/plugins/wp-user-avatar/";s:7:"package";s:57:"https://downloads.wordpress.org/plugin/wp-user-avatar.zip";}}}', 'no'),
(9641, 'anarcho_cfunctions_service_info', 'a:2:{s:7:"version";s:4:"4.04";s:11:"old_version";s:1:"0";}', 'yes'),
(9642, 'widget_media_audio', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(9643, 'widget_media_image', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(9644, 'widget_media_video', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(9645, 'woocommerce_enable_reviews', 'yes', 'yes'),
(9646, 'woocommerce_shipping_debug_mode', 'no', 'no'),
(9647, 'woocommerce_version', '3.1.0', 'yes'),
(9648, 'woocommerce_tracker_ua', 'a:2:{i:0;s:115:"mozilla/5.0 (windows nt 10.0; win64; x64) applewebkit/537.36 (khtml, like gecko) chrome/58.0.3029.110 safari/537.36";i:1;s:115:"mozilla/5.0 (windows nt 10.0; win64; x64) applewebkit/537.36 (khtml, like gecko) chrome/59.0.3071.115 safari/537.36";}', 'yes'),
(9649, 'woocommerce_helper_data', 'a:1:{s:11:"did-migrate";b:1;}', 'yes'),
(9650, 'storefront_nux_fresh_site', '0', 'yes'),
(9652, 'storefront_nux_dismissed', '1', 'yes'),
(9655, 'soliloquy_review', 'a:2:{s:4:"time";i:1499160226;s:9:"dismissed";b:1;}', 'yes'),
(9656, 'as3cfpro_licence_issue_type', 'subscription_expired', 'no'),
(9657, 'wpfcas-category_children', 'a:0:{}', 'yes'),
(9658, 'better-font-awesome_options', 'a:4:{s:7:"version";s:6:"latest";s:8:"minified";i:1;s:18:"remove_existing_fa";s:0:"";s:18:"hide_admin_notices";s:0:"";}', 'yes'),
(9663, 'cptch_options', 'a:26:{s:21:"plugin_option_version";s:5:"4.3.0";s:7:"str_key";a:2:{s:4:"time";i:1499187188;s:3:"key";s:32:"5cf26f6359ced7516ccf98b9f745d3bc";}s:4:"type";s:12:"math_actions";s:12:"math_actions";a:2:{i:0;s:4:"plus";i:1;s:5:"minus";}s:14:"operand_format";a:2:{i:0;s:7:"numbers";i:1;s:5:"words";}s:12:"images_count";i:5;s:5:"title";s:0:"";s:15:"required_symbol";s:1:"*";s:21:"display_reload_button";b:1;s:14:"enlarge_images";b:0;s:13:"used_packages";a:4:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"6";i:3;s:1:"7";}s:17:"enable_time_limit";b:0;s:10:"time_limit";i:120;s:9:"no_answer";s:29:"Please enter a CAPTCHA value.";s:12:"wrong_answer";s:35:"Please enter a valid CAPTCHA value.";s:14:"time_limit_off";s:60:"Time limit is exhausted. Please enter a CAPTCHA value again.";s:21:"time_limit_off_notice";s:51:"Time limit is exhausted. Please reload the CAPTCHA.";s:17:"whitelist_message";s:25:"You are in the whitelist.";s:13:"load_via_ajax";b:0;s:28:"use_limit_attempts_whitelist";b:0;s:23:"display_settings_notice";i:1;s:22:"suggest_feature_banner";i:1;s:5:"forms";a:15:{s:8:"wp_login";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:11:"wp_register";a:2:{s:6:"enable";b:1;s:20:"hide_from_registered";b:0;}s:16:"wp_lost_password";a:2:{s:6:"enable";b:1;s:20:"hide_from_registered";b:0;}s:11:"wp_comments";a:2:{s:6:"enable";b:1;s:20:"hide_from_registered";b:1;}s:11:"bws_contact";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:7:"general";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:14:"bws_subscriber";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:11:"cf7_contact";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:19:"buddypress_register";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:19:"buddypress_comments";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:16:"buddypress_group";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:17:"woocommerce_login";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:20:"woocommerce_register";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:25:"woocommerce_lost_password";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}s:20:"woocommerce_checkout";a:2:{s:6:"enable";b:0;s:20:"hide_from_registered";b:0;}}s:17:"plugin_db_version";s:3:"1.4";s:13:"first_install";i:1499186877;s:19:"go_settings_counter";i:4;}', 'yes'),
(9664, 'bstwbsftwppdtplgns_options', 'a:1:{s:8:"bws_menu";a:1:{s:7:"version";a:1:{s:19:"captcha/captcha.php";s:5:"2.0.6";}}}', 'yes'),
(9665, 'w3tc_extensions_hooks', '{"actions":[],"filters":[],"next_check_date":1499273218}', 'yes'),
(9666, 'category_children', 'a:0:{}', 'yes'),
(9667, 'wpmdb_error_log', '********************************************\n******  Log date: 2017/07/05 10:12:54 ******\n********************************************\n\nWPMDB Error: <b>Version Mismatch</b> &mdash; We\'ve detected you have version 1.7.1 of WP Migrate DB Pro at www.chaloke.com but are using 1.7.2 here. Please go to the <a href="http://52.76.37.90/wp-admin/plugins.php">Plugins page</a> on both installs and check for updates.\n\nAttempted to connect to: http://www.chaloke.com/wp-admin/admin-ajax.php\n\nArray\n(\n    [error] => 1\n    [error_id] => version_mismatch\n    [message] => <b>Version Mismatch</b> &mdash; We\'ve detected you have version 1.7.1 of WP Migrate DB Pro at www.chaloke.com but are using 1.7.2 here. Please go to the <a href="%%plugins_url%%">Plugins page</a> on both installs and check for updates.\n)\n\n\n', 'no'),
(9668, 'wpmdb_usage', 'a:2:{s:6:"action";s:4:"pull";s:4:"time";i:1499250167;}', 'no'),
(9669, 'wpmdb_state_timeout_595cbdf9d04e1', '1499336584', 'no'),
(9670, 'wpmdb_state_595cbdf9d04e1', 'a:25:{s:6:"action";s:19:"wpmdb_migrate_table";s:6:"intent";s:4:"pull";s:3:"url";s:22:"http://www.chaloke.com";s:3:"key";s:40:"hpRnRfBlH1afBVIJ1Xl6dFr0Mfqiscuu/zOVzMrm";s:9:"form_data";s:2245:"save_computer=1&gzip_file=1&action=pull&connection_info=http%3A%2F%2Fwww.chaloke.com%0D%0AhpRnRfBlH1afBVIJ1Xl6dFr0Mfqiscuu%2FzOVzMrm&replace_old%5B%5D=&replace_new%5B%5D=&replace_old%5B%5D=lung&replace_new%5B%5D=wp&table_migrate_option=migrate_select&select_tables%5B%5D=lung_pmpro_discount_codes&select_tables%5B%5D=lung_pmpro_discount_codes_levels&select_tables%5B%5D=lung_pmpro_discount_codes_uses&select_tables%5B%5D=lung_pmpro_membership_levelmeta&select_tables%5B%5D=lung_pmpro_membership_levels&select_tables%5B%5D=lung_pmpro_membership_orders&select_tables%5B%5D=lung_pmpro_memberships_categories&select_tables%5B%5D=lung_pmpro_memberships_pages&select_tables%5B%5D=lung_pmpro_memberships_users&select_tables%5B%5D=lung_postmeta&select_tables%5B%5D=lung_posts&select_tables%5B%5D=lung_usermeta&select_tables%5B%5D=lung_users&exclude_post_types=1&select_post_types%5B%5D=revision&select_post_types%5B%5D=attachment&select_post_types%5B%5D=bp-email&select_post_types%5B%5D=campaign&select_post_types%5B%5D=donation&select_post_types%5B%5D=download&select_post_types%5B%5D=edd_log&select_post_types%5B%5D=edd_payment&select_post_types%5B%5D=event_magic_tickets&select_post_types%5B%5D=forum&select_post_types%5B%5D=give_forms&select_post_types%5B%5D=give_log&select_post_types%5B%5D=give_payment&select_post_types%5B%5D=migla_custom_values&select_post_types%5B%5D=migla_odonation&select_post_types%5B%5D=migla_odonation_p&select_post_types%5B%5D=migla_stripe_plan&select_post_types%5B%5D=miglaform&select_post_types%5B%5D=nav_menu_item&select_post_types%5B%5D=page&select_post_types%5B%5D=pricing-table&select_post_types%5B%5D=product&select_post_types%5B%5D=product_variation&select_post_types%5B%5D=reply&select_post_types%5B%5D=scheduled_export&select_post_types%5B%5D=shop_coupon&select_post_types%5B%5D=shop_order&select_post_types%5B%5D=shop_order_refund&select_post_types%5B%5D=soliloquy&select_post_types%5B%5D=testimonials&select_post_types%5B%5D=wpcf7_contact_form&exclude_spam=1&keep_active_plugins=1&exclude_transients=1&compatibility_older_mysql=1&create_backup=1&backup_option=backup_only_with_prefix&media_migration_option=compare&save_migration_profile=1&save_migration_profile_option=0&create_new_profile=&remote_json_data=";s:5:"stage";s:6:"backup";s:5:"nonce";s:10:"9af9f9b702";s:12:"site_details";a:2:{s:5:"local";a:9:{s:12:"is_multisite";s:5:"false";s:8:"site_url";s:18:"http://52.76.37.90";s:8:"home_url";s:18:"http://52.76.37.90";s:6:"prefix";s:3:"wp_";s:15:"uploads_baseurl";s:38:"http://52.76.37.90/wp-content/uploads/";s:7:"uploads";a:6:{s:4:"path";s:43:"/var/www/staging/wp-content/uploads/2017/07";s:3:"url";s:45:"http://52.76.37.90/wp-content/uploads/2017/07";s:6:"subdir";s:8:"/2017/07";s:7:"basedir";s:35:"/var/www/staging/wp-content/uploads";s:7:"baseurl";s:37:"http://52.76.37.90/wp-content/uploads";s:5:"error";b:0;}s:11:"uploads_dir";s:33:"wp-content/uploads/wp-migrate-db/";s:8:"subsites";a:0:{}s:13:"subsites_info";a:0:{}}s:6:"remote";a:9:{s:12:"is_multisite";s:5:"false";s:8:"site_url";s:22:"http://www.chaloke.com";s:8:"home_url";s:22:"http://www.chaloke.com";s:6:"prefix";s:5:"lung_";s:15:"uploads_baseurl";s:42:"http://www.chaloke.com/wp-content/uploads/";s:7:"uploads";a:6:{s:4:"path";s:75:"/home/chalokecom/domains/chaloke.com/public_html/wp-content/uploads/2017/07";s:3:"url";s:49:"http://www.chaloke.com/wp-content/uploads/2017/07";s:6:"subdir";s:8:"/2017/07";s:7:"basedir";s:67:"/home/chalokecom/domains/chaloke.com/public_html/wp-content/uploads";s:7:"baseurl";s:41:"http://www.chaloke.com/wp-content/uploads";s:5:"error";b:0;}s:11:"uploads_dir";s:33:"wp-content/uploads/wp-migrate-db/";s:8:"subsites";a:0:{}s:13:"subsites_info";a:0:{}}}s:11:"temp_prefix";s:5:"_mig_";s:5:"error";i:0;s:15:"remote_state_id";s:13:"595cbdff54725";s:13:"dump_filename";s:31:"cdc-backup-20170705102249-yodqk";s:8:"dump_url";s:87:"http://52.76.37.90/wp-content/uploads/wp-migrate-db/cdc-backup-20170705102249-yodqk.sql";s:10:"db_version";s:6:"5.6.27";s:8:"site_url";s:18:"http://52.76.37.90";s:18:"find_replace_pairs";a:2:{s:11:"replace_old";a:1:{i:1;s:4:"lung";}s:11:"replace_new";a:1:{i:1;s:2:"wp";}}s:18:"migration_state_id";s:13:"595cbdf9d04e1";s:5:"table";s:10:"wp_options";s:11:"current_row";s:0:"";s:10:"last_table";s:1:"0";s:12:"primary_keys";s:0:"";s:4:"gzip";i:1;s:10:"bottleneck";d:2097152;s:6:"prefix";s:5:"lung_";s:16:"dumpfile_created";b:1;}', 'no') ;

#
# End of data contents of table `wp_options`
# --------------------------------------------------------



#
# Delete any existing table `wp_postmeta`
#

DROP TABLE IF EXISTS `wp_postmeta`;


#
# Table structure of table `wp_postmeta`
#

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=1507 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_postmeta`
#
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(4, 10, '_wp_attached_file', '2016/07/CDClogo2015_rev1_A.png'),
(5, 10, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:2500;s:6:"height";i:2500;s:4:"file";s:30:"2016/07/CDClogo2015_rev1_A.png";s:5:"sizes";a:7:{s:9:"thumbnail";a:4:{s:4:"file";s:30:"CDClogo2015_rev1_A-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:30:"CDClogo2015_rev1_A-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:12:"medium_large";a:4:{s:4:"file";s:30:"CDClogo2015_rev1_A-768x768.png";s:5:"width";i:768;s:6:"height";i:768;s:9:"mime-type";s:9:"image/png";}s:5:"large";a:4:{s:4:"file";s:32:"CDClogo2015_rev1_A-1024x1024.png";s:5:"width";i:1024;s:6:"height";i:1024;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:30:"CDClogo2015_rev1_A-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:30:"CDClogo2015_rev1_A-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:11:"shop_single";a:4:{s:4:"file";s:30:"CDClogo2015_rev1_A-600x600.png";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(6, 11, '_wp_attached_file', '2016/07/cropped-CDClogo2015_rev1_A-e1499158089226.png'),
(7, 11, '_wp_attachment_context', 'site-icon'),
(8, 11, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:127;s:6:"height";i:127;s:4:"file";s:53:"2016/07/cropped-CDClogo2015_rev1_A-e1499158089226.png";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:13:"site_icon-270";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-270x270.png";s:5:"width";i:270;s:6:"height";i:270;s:9:"mime-type";s:9:"image/png";}s:13:"site_icon-192";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-192x192.png";s:5:"width";i:192;s:6:"height";i:192;s:9:"mime-type";s:9:"image/png";}s:13:"site_icon-180";a:4:{s:4:"file";s:38:"cropped-CDClogo2015_rev1_A-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"site_icon-32";a:4:{s:4:"file";s:36:"cropped-CDClogo2015_rev1_A-32x32.png";s:5:"width";i:32;s:6:"height";i:32;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(9, 12, '_wp_attached_file', '2016/07/CDClogo2015_rev1100px_A-simple-copy-2.png'),
(10, 12, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:617;s:6:"height";i:208;s:4:"file";s:49:"2016/07/CDClogo2015_rev1100px_A-simple-copy-2.png";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:49:"CDClogo2015_rev1100px_A-simple-copy-2-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:49:"CDClogo2015_rev1100px_A-simple-copy-2-300x101.png";s:5:"width";i:300;s:6:"height";i:101;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:49:"CDClogo2015_rev1100px_A-simple-copy-2-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:49:"CDClogo2015_rev1100px_A-simple-copy-2-300x208.png";s:5:"width";i:300;s:6:"height";i:208;s:9:"mime-type";s:9:"image/png";}s:11:"shop_single";a:4:{s:4:"file";s:49:"CDClogo2015_rev1100px_A-simple-copy-2-600x208.png";s:5:"width";i:600;s:6:"height";i:208;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(11, 13, '_wp_attached_file', '2016/07/cropped-CDClogo2015_rev1100px_A-simple-copy-2.png'),
(12, 13, '_wp_attachment_context', 'custom-logo'),
(13, 13, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:326;s:6:"height";i:110;s:4:"file";s:57:"2016/07/cropped-CDClogo2015_rev1100px_A-simple-copy-2.png";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:57:"cropped-CDClogo2015_rev1100px_A-simple-copy-2-150x110.png";s:5:"width";i:150;s:6:"height";i:110;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:57:"cropped-CDClogo2015_rev1100px_A-simple-copy-2-300x101.png";s:5:"width";i:300;s:6:"height";i:101;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:57:"cropped-CDClogo2015_rev1100px_A-simple-copy-2-180x110.png";s:5:"width";i:180;s:6:"height";i:110;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:57:"cropped-CDClogo2015_rev1100px_A-simple-copy-2-300x110.png";s:5:"width";i:300;s:6:"height";i:110;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(15, 15, '_wp_attached_file', '2016/07/CDClogo2015_rev1_A-simple-copy-2.png'),
(16, 15, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1083;s:6:"height";i:417;s:4:"file";s:44:"2016/07/CDClogo2015_rev1_A-simple-copy-2.png";s:5:"sizes";a:7:{s:9:"thumbnail";a:4:{s:4:"file";s:44:"CDClogo2015_rev1_A-simple-copy-2-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:44:"CDClogo2015_rev1_A-simple-copy-2-300x116.png";s:5:"width";i:300;s:6:"height";i:116;s:9:"mime-type";s:9:"image/png";}s:12:"medium_large";a:4:{s:4:"file";s:44:"CDClogo2015_rev1_A-simple-copy-2-768x296.png";s:5:"width";i:768;s:6:"height";i:296;s:9:"mime-type";s:9:"image/png";}s:5:"large";a:4:{s:4:"file";s:45:"CDClogo2015_rev1_A-simple-copy-2-1024x394.png";s:5:"width";i:1024;s:6:"height";i:394;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:44:"CDClogo2015_rev1_A-simple-copy-2-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:44:"CDClogo2015_rev1_A-simple-copy-2-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:11:"shop_single";a:4:{s:4:"file";s:44:"CDClogo2015_rev1_A-simple-copy-2-600x417.png";s:5:"width";i:600;s:6:"height";i:417;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(17, 16, '_wp_attached_file', '2016/07/cropped-CDClogo2015_rev1_A-simple-copy-2.png'),
(18, 16, '_wp_attachment_context', 'custom-logo'),
(19, 16, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:373;s:6:"height";i:110;s:4:"file";s:52:"2016/07/cropped-CDClogo2015_rev1_A-simple-copy-2.png";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:52:"cropped-CDClogo2015_rev1_A-simple-copy-2-150x110.png";s:5:"width";i:150;s:6:"height";i:110;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:51:"cropped-CDClogo2015_rev1_A-simple-copy-2-300x88.png";s:5:"width";i:300;s:6:"height";i:88;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:52:"cropped-CDClogo2015_rev1_A-simple-copy-2-180x110.png";s:5:"width";i:180;s:6:"height";i:110;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:52:"cropped-CDClogo2015_rev1_A-simple-copy-2-300x110.png";s:5:"width";i:300;s:6:"height";i:110;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(38, 19, '_menu_item_type', 'post_type'),
(39, 19, '_menu_item_menu_item_parent', '0'),
(40, 19, '_menu_item_object_id', '4'),
(41, 19, '_menu_item_object', 'page'),
(42, 19, '_menu_item_target', ''),
(43, 19, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(44, 19, '_menu_item_xfn', ''),
(45, 19, '_menu_item_url', ''),
(58, 22, '_edit_last', '1'),
(59, 22, '_edit_lock', '1467477914:1'),
(60, 22, '_product_ids', 'a:2:{i:0;i:23;i:1;i:38;}'),
(61, 22, '_access_length', '1 years'),
(62, 22, '_members_area_sections', 'a:4:{i:0;s:21:"my-membership-content";i:1;s:22:"my-membership-products";i:2;s:23:"my-membership-discounts";i:3;s:19:"my-membership-notes";}'),
(63, 22, '_access_while_subscription_active', 'no'),
(64, 23, '_edit_last', '1'),
(65, 23, '_edit_lock', '1467630159:1'),
(68, 23, '_visibility', 'visible'),
(69, 23, '_stock_status', 'instock'),
(70, 23, 'total_sales', '6'),
(71, 23, '_downloadable', 'no'),
(72, 23, '_virtual', 'yes'),
(73, 23, '_tax_status', 'none'),
(74, 23, '_tax_class', ''),
(75, 23, '_purchase_note', ''),
(76, 23, '_featured', 'no'),
(77, 23, '_weight', ''),
(78, 23, '_length', ''),
(79, 23, '_width', ''),
(80, 23, '_height', ''),
(81, 23, '_sku', ''),
(82, 23, '_product_attributes', 'a:0:{}'),
(83, 23, '_regular_price', '1296'),
(84, 23, '_sale_price', ''),
(85, 23, '_sale_price_dates_from', ''),
(86, 23, '_sale_price_dates_to', ''),
(87, 23, '_price', '1296'),
(88, 23, '_sold_individually', ''),
(89, 23, '_manage_stock', 'no'),
(90, 23, '_backorders', 'no'),
(91, 23, '_stock', ''),
(92, 23, '_upsell_ids', 'a:0:{}'),
(93, 23, '_crosssell_ids', 'a:0:{}'),
(94, 23, '_product_version', '2.6.2'),
(95, 23, '_product_image_gallery', ''),
(96, 23, '_wc_memberships_product_viewing_restricted_message', ''),
(97, 23, '_wc_memberships_use_custom_product_viewing_restricted_message', 'no'),
(98, 23, '_wc_memberships_product_purchasing_restricted_message', ''),
(99, 23, '_wc_memberships_use_custom_product_purchasing_restricted_message', 'no'),
(100, 23, '_wc_memberships_force_public', 'no'),
(101, 23, '_wc_rating_count', 'a:0:{}'),
(102, 23, '_wc_average_rating', '0'),
(103, 23, '_wc_review_count', '0'),
(104, 25, '_order_key', 'wc_order_5777c16875fbe'),
(105, 25, '_order_currency', 'THB'),
(106, 25, '_prices_include_tax', 'yes'),
(107, 25, '_customer_ip_address', '125.24.67.46'),
(108, 25, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(109, 25, '_customer_user', '1'),
(110, 25, '_created_via', 'checkout'),
(111, 25, '_cart_hash', '867f68e8d63c6ad975957c23967c384f'),
(112, 25, '_order_version', '2.6.2'),
(113, 25, '_billing_first_name', 'Piriya'),
(114, 25, '_billing_last_name', 'Sambandaraksa'),
(115, 25, '_billing_company', 'Chaloke Dot Com Company Limited'),
(116, 25, '_billing_email', 'yadamon@gmail.com'),
(117, 25, '_billing_phone', '0944895944'),
(118, 25, '_billing_country', 'TH'),
(119, 25, '_billing_address_1', '19 Moo1 Klong 5'),
(120, 25, '_billing_address_2', 'Ladsawai'),
(121, 25, '_billing_city', 'Lamlugga'),
(122, 25, '_billing_state', 'TH-13'),
(123, 25, '_billing_postcode', '12150'),
(124, 25, '_shipping_first_name', 'Piriya'),
(125, 25, '_shipping_last_name', 'Sambandaraksa'),
(126, 25, '_shipping_company', 'Chaloke Dot Com Company Limited'),
(127, 25, '_shipping_country', 'TH'),
(128, 25, '_shipping_address_1', '19 Moo1 Klong 5'),
(129, 25, '_shipping_address_2', 'Ladsawai'),
(130, 25, '_shipping_city', 'Lamlugga'),
(131, 25, '_shipping_state', 'TH-13'),
(132, 25, '_shipping_postcode', '12150'),
(133, 25, '_payment_method', 'bacs'),
(134, 25, '_payment_method_title', 'Direct Bank Transfer'),
(135, 25, '_order_shipping', '') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(136, 25, '_cart_discount', '0'),
(137, 25, '_cart_discount_tax', '0'),
(138, 25, '_order_tax', '0'),
(139, 25, '_order_shipping_tax', '0'),
(140, 25, '_order_total', '1296.00'),
(141, 25, '_recorded_sales', 'yes'),
(142, 25, '_order_stock_reduced', '1'),
(143, 25, '_download_permissions_granted', '1'),
(148, 25, '_wc_memberships_access_granted', 'a:1:{i:26;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(149, 25, '_completed_date', '2016-07-02 13:28:24'),
(151, 27, '_wp_attached_file', '2016/07/CDC-Membership.png'),
(152, 27, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:54:"wp-content/uploads/2016/07/02133321/CDC-Membership.png";s:6:"region";s:14:"ap-southeast-1";}'),
(153, 27, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:458;s:6:"height";i:528;s:4:"file";s:26:"2016/07/CDC-Membership.png";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:26:"CDC-Membership-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:26:"CDC-Membership-260x300.png";s:5:"width";i:260;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:26:"CDC-Membership-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:26:"CDC-Membership-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(154, 23, '_thumbnail_id', '27'),
(155, 1, '_edit_lock', '1499160005:1'),
(158, 1, '_edit_last', '1'),
(161, 1, '_wc_memberships_content_restricted_message', ''),
(162, 1, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(163, 1, '_wc_memberships_force_public', 'no'),
(164, 31, '_wp_attached_file', '2016/07/CDCDL.jpg'),
(165, 31, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:45:"wp-content/uploads/2016/07/02144732/CDCDL.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(166, 31, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:458;s:6:"height";i:528;s:4:"file";s:17:"2016/07/CDCDL.jpg";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"CDCDL-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:17:"CDCDL-260x300.jpg";s:5:"width";i:260;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:17:"CDCDL-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:17:"CDCDL-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(167, 32, '_wp_attached_file', '2016/06/MS-EOD.png'),
(168, 32, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:46:"wp-content/uploads/2016/06/02163248/MS-EOD.png";s:6:"region";s:14:"ap-southeast-1";}'),
(169, 32, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:330;s:6:"height";i:220;s:4:"file";s:18:"2016/06/MS-EOD.png";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:18:"MS-EOD-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:18:"MS-EOD-300x200.png";s:5:"width";i:300;s:6:"height";i:200;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:18:"MS-EOD-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:18:"MS-EOD-300x220.png";s:5:"width";i:300;s:6:"height";i:220;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(174, 16, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:80:"wp-content/uploads/2016/07/04093947/cropped-CDClogo2015_rev1_A-simple-copy-2.png";s:6:"region";s:14:"ap-southeast-1";}'),
(175, 15, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:72:"wp-content/uploads/2016/07/04093949/CDClogo2015_rev1_A-simple-copy-2.png";s:6:"region";s:14:"ap-southeast-1";}'),
(176, 13, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:85:"wp-content/uploads/2016/07/04093949/cropped-CDClogo2015_rev1100px_A-simple-copy-2.png";s:6:"region";s:14:"ap-southeast-1";}'),
(177, 12, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:77:"wp-content/uploads/2016/07/04093949/CDClogo2015_rev1100px_A-simple-copy-2.png";s:6:"region";s:14:"ap-southeast-1";}'),
(179, 10, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:58:"wp-content/uploads/2016/07/04093950/CDClogo2015_rev1_A.png";s:6:"region";s:14:"ap-southeast-1";}'),
(185, 38, '_edit_last', '1'),
(186, 38, '_edit_lock', '1483790985:1'),
(187, 38, '_visibility', 'visible'),
(188, 38, '_stock_status', 'instock'),
(189, 38, 'total_sales', '5'),
(190, 38, '_downloadable', 'no'),
(191, 38, '_virtual', 'yes'),
(192, 38, '_tax_status', 'none'),
(193, 38, '_tax_class', ''),
(194, 38, '_purchase_note', ''),
(195, 38, '_featured', 'no'),
(196, 38, '_weight', ''),
(197, 38, '_length', ''),
(198, 38, '_width', ''),
(199, 38, '_height', ''),
(200, 38, '_sku', 'sub01'),
(201, 38, '_product_attributes', 'a:0:{}'),
(202, 38, '_regular_price', '1296'),
(203, 38, '_sale_price', ''),
(204, 38, '_sale_price_dates_from', '0'),
(205, 38, '_sale_price_dates_to', '0'),
(206, 38, '_price', '1296'),
(207, 38, '_sold_individually', ''),
(208, 38, '_manage_stock', 'no'),
(209, 38, '_backorders', 'no'),
(210, 38, '_stock', ''),
(211, 38, '_upsell_ids', 'a:0:{}'),
(212, 38, '_crosssell_ids', 'a:0:{}'),
(213, 38, '_product_version', '2.6.11'),
(214, 38, '_subscription_payment_sync_date', 'a:2:{s:3:"day";i:0;s:5:"month";s:2:"01";}'),
(215, 38, '_product_image_gallery', ''),
(216, 38, '_wc_memberships_product_viewing_restricted_message', ''),
(217, 38, '_wc_memberships_use_custom_product_viewing_restricted_message', 'no'),
(218, 38, '_wc_memberships_product_purchasing_restricted_message', ''),
(219, 38, '_wc_memberships_use_custom_product_purchasing_restricted_message', 'no'),
(220, 38, '_wc_memberships_force_public', 'no'),
(221, 38, '_subscription_price', '1296'),
(222, 38, '_subscription_trial_length', '0'),
(223, 38, '_subscription_sign_up_fee', ''),
(224, 38, '_subscription_period', 'year'),
(225, 38, '_subscription_period_interval', '1'),
(226, 38, '_subscription_length', '0'),
(227, 38, '_subscription_trial_period', 'day'),
(228, 38, '_subscription_limit', 'no'),
(229, 38, '_subscription_one_time_shipping', 'no'),
(230, 38, '_wc_rating_count', 'a:0:{}'),
(231, 38, '_wc_average_rating', '0'),
(232, 40, '_wp_attached_file', '2016/07/MS11.jpg'),
(233, 40, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:44:"wp-content/uploads/2016/07/04103437/MS11.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(234, 40, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:458;s:6:"height";i:528;s:4:"file";s:16:"2016/07/MS11.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:16:"MS11-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:16:"MS11-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:16:"MS11-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(235, 41, '_wp_attached_file', '2016/07/CDC-ADV-MS.png'),
(236, 41, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:50:"wp-content/uploads/2016/07/04103438/CDC-ADV-MS.png";s:6:"region";s:14:"ap-southeast-1";}'),
(237, 41, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:458;s:6:"height";i:528;s:4:"file";s:22:"2016/07/CDC-ADV-MS.png";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:22:"CDC-ADV-MS-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:22:"CDC-ADV-MS-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:22:"CDC-ADV-MS-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(238, 42, '_wp_attached_file', '2016/07/CDC-BASIC-MS.png'),
(239, 42, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:52:"wp-content/uploads/2016/07/04103441/CDC-BASIC-MS.png";s:6:"region";s:14:"ap-southeast-1";}'),
(240, 42, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:458;s:6:"height";i:528;s:4:"file";s:24:"2016/07/CDC-BASIC-MS.png";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:24:"CDC-BASIC-MS-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:24:"CDC-BASIC-MS-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:24:"CDC-BASIC-MS-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(241, 43, '_wp_attached_file', '2016/07/CDC-Membership1.png'),
(242, 43, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:55:"wp-content/uploads/2016/07/04103442/CDC-Membership1.png";s:6:"region";s:14:"ap-southeast-1";}'),
(243, 43, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:458;s:6:"height";i:528;s:4:"file";s:27:"2016/07/CDC-Membership1.png";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:27:"CDC-Membership1-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:27:"CDC-Membership1-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:27:"CDC-Membership1-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(244, 38, '_thumbnail_id', '43'),
(248, 38, '_wp_old_slug', 'supporting-membership-2'),
(249, 38, '_wc_review_count', '0'),
(251, 23, '_wp_old_slug', 'supporting-membership__trashed'),
(339, 47, '_order_key', 'wc_order_577a44774c6d9'),
(340, 47, '_order_currency', 'THB'),
(341, 47, '_prices_include_tax', 'yes'),
(342, 47, '_customer_ip_address', '203.131.210.147'),
(343, 47, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(344, 47, '_customer_user', '1'),
(345, 47, '_created_via', 'checkout') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(346, 47, '_cart_hash', '469c96b1d89157d72999de5b26ae59c6'),
(347, 47, '_order_version', '2.6.2'),
(348, 47, '_billing_first_name', 'Piriya'),
(349, 47, '_billing_last_name', 'Sambandaraksa'),
(350, 47, '_billing_company', 'Chaloke Dot Com Company Limited'),
(351, 47, '_billing_email', 'yadamon@gmail.com'),
(352, 47, '_billing_phone', '0944895944'),
(353, 47, '_billing_country', 'TH'),
(354, 47, '_billing_address_1', '19 Moo1 Klong 5'),
(355, 47, '_billing_address_2', 'Ladsawai'),
(356, 47, '_billing_city', 'Lamlugga'),
(357, 47, '_billing_state', 'TH-13'),
(358, 47, '_billing_postcode', '12150'),
(359, 47, '_shipping_first_name', 'Piriya'),
(360, 47, '_shipping_last_name', 'Sambandaraksa'),
(361, 47, '_shipping_company', 'Chaloke Dot Com Company Limited'),
(362, 47, '_shipping_country', 'TH'),
(363, 47, '_shipping_address_1', '19 Moo1 Klong 5'),
(364, 47, '_shipping_address_2', 'Ladsawai'),
(365, 47, '_shipping_city', 'Lamlugga'),
(366, 47, '_shipping_state', 'TH-13'),
(367, 47, '_shipping_postcode', '12150'),
(368, 47, '_payment_method', 'bacs'),
(369, 47, '_payment_method_title', 'Direct Bank Transfer'),
(370, 47, '_order_shipping', ''),
(371, 47, '_cart_discount', '0'),
(372, 47, '_cart_discount_tax', '0'),
(373, 47, '_order_tax', '0'),
(374, 47, '_order_shipping_tax', '0'),
(375, 47, '_order_total', '1296.00'),
(420, 47, '_recorded_sales', 'yes'),
(421, 47, '_order_stock_reduced', '1'),
(443, 47, '_download_permissions_granted', '1'),
(446, 47, '_wc_memberships_access_granted', 'a:1:{i:26;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(448, 47, '_completed_date', '2016-07-04 11:12:37'),
(449, 52, '_order_key', 'wc_order_577a451085c01'),
(450, 52, '_order_currency', 'THB'),
(451, 52, '_prices_include_tax', 'yes'),
(452, 52, '_customer_ip_address', '203.131.210.147'),
(453, 52, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(454, 52, '_customer_user', '1'),
(455, 52, '_created_via', 'checkout'),
(456, 52, '_cart_hash', '469c96b1d89157d72999de5b26ae59c6'),
(457, 52, '_order_version', '2.6.2'),
(458, 52, '_billing_first_name', 'Piriya'),
(459, 52, '_billing_last_name', 'Sambandaraksa'),
(460, 52, '_billing_company', 'Chaloke Dot Com Company Limited'),
(461, 52, '_billing_email', 'yadamon@gmail.com'),
(462, 52, '_billing_phone', '0944895944'),
(463, 52, '_billing_country', 'TH'),
(464, 52, '_billing_address_1', '19 Moo1 Klong 5'),
(465, 52, '_billing_address_2', 'Ladsawai'),
(466, 52, '_billing_city', 'Lamlugga'),
(467, 52, '_billing_state', 'TH-13'),
(468, 52, '_billing_postcode', '12150'),
(469, 52, '_shipping_first_name', 'Piriya'),
(470, 52, '_shipping_last_name', 'Sambandaraksa'),
(471, 52, '_shipping_company', 'Chaloke Dot Com Company Limited'),
(472, 52, '_shipping_country', 'TH'),
(473, 52, '_shipping_address_1', '19 Moo1 Klong 5'),
(474, 52, '_shipping_address_2', 'Ladsawai'),
(475, 52, '_shipping_city', 'Lamlugga'),
(476, 52, '_shipping_state', 'TH-13'),
(477, 52, '_shipping_postcode', '12150'),
(478, 52, '_payment_method', 'bacs'),
(479, 52, '_payment_method_title', 'Direct Bank Transfer'),
(480, 52, '_order_shipping', ''),
(481, 52, '_cart_discount', '0'),
(482, 52, '_cart_discount_tax', '0'),
(483, 52, '_order_tax', '0'),
(484, 52, '_order_shipping_tax', '0'),
(485, 52, '_order_total', '1296.00'),
(530, 52, '_recorded_sales', 'yes'),
(531, 52, '_order_stock_reduced', '1'),
(532, 52, '_download_permissions_granted', '1'),
(535, 52, '_completed_date', '2016-07-04 11:14:28'),
(536, 23, '_wp_old_slug', 'supporting-membership-2__trashed'),
(537, 55, '_order_key', 'wc_order_577a4586a8287'),
(538, 55, '_order_currency', 'THB'),
(539, 55, '_prices_include_tax', 'yes'),
(540, 55, '_customer_ip_address', '203.131.210.147'),
(541, 55, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(542, 55, '_customer_user', '1'),
(543, 55, '_created_via', 'checkout'),
(544, 55, '_cart_hash', '867f68e8d63c6ad975957c23967c384f'),
(545, 55, '_order_version', '2.6.2'),
(546, 55, '_billing_first_name', 'Piriya'),
(547, 55, '_billing_last_name', 'Sambandaraksa'),
(548, 55, '_billing_company', 'Chaloke Dot Com Company Limited'),
(549, 55, '_billing_email', 'yadamon@gmail.com'),
(550, 55, '_billing_phone', '0944895944'),
(551, 55, '_billing_country', 'TH'),
(552, 55, '_billing_address_1', '19 Moo1 Klong 5'),
(553, 55, '_billing_address_2', 'Ladsawai'),
(554, 55, '_billing_city', 'Lamlugga'),
(555, 55, '_billing_state', 'TH-13'),
(556, 55, '_billing_postcode', '12150'),
(557, 55, '_shipping_first_name', 'Piriya'),
(558, 55, '_shipping_last_name', 'Sambandaraksa'),
(559, 55, '_shipping_company', 'Chaloke Dot Com Company Limited') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(560, 55, '_shipping_country', 'TH'),
(561, 55, '_shipping_address_1', '19 Moo1 Klong 5'),
(562, 55, '_shipping_address_2', 'Ladsawai'),
(563, 55, '_shipping_city', 'Lamlugga'),
(564, 55, '_shipping_state', 'TH-13'),
(565, 55, '_shipping_postcode', '12150'),
(566, 55, '_payment_method', 'bacs'),
(567, 55, '_payment_method_title', 'Direct Bank Transfer'),
(568, 55, '_order_shipping', ''),
(569, 55, '_cart_discount', '0'),
(570, 55, '_cart_discount_tax', '0'),
(571, 55, '_order_tax', '0'),
(572, 55, '_order_shipping_tax', '0'),
(573, 55, '_order_total', '1296.00'),
(574, 55, '_recorded_sales', 'yes'),
(575, 55, '_order_stock_reduced', '1'),
(576, 55, '_download_permissions_granted', '1'),
(577, 55, '_wc_memberships_access_granted', 'a:1:{i:26;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(578, 55, '_completed_date', '2016-07-04 11:16:30'),
(579, 56, '_order_key', 'wc_order_577a466685b64'),
(580, 56, '_order_currency', 'THB'),
(581, 56, '_prices_include_tax', 'yes'),
(582, 56, '_customer_ip_address', '203.131.210.147'),
(583, 56, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(584, 56, '_customer_user', '0'),
(585, 56, '_created_via', 'checkout'),
(586, 56, '_cart_hash', '469c96b1d89157d72999de5b26ae59c6'),
(587, 56, '_order_version', '2.6.2'),
(588, 56, '_billing_first_name', 'test'),
(589, 56, '_billing_last_name', 'test'),
(590, 56, '_billing_company', ''),
(591, 56, '_billing_email', 'testuser@gmail.com'),
(592, 56, '_billing_phone', '0987654321'),
(593, 56, '_billing_country', 'TH'),
(594, 56, '_billing_address_1', 'test'),
(595, 56, '_billing_address_2', ''),
(596, 56, '_billing_city', 'test'),
(597, 56, '_billing_state', 'TH-13'),
(598, 56, '_billing_postcode', '12150'),
(599, 56, '_shipping_first_name', 'test'),
(600, 56, '_shipping_last_name', 'test'),
(601, 56, '_shipping_company', ''),
(602, 56, '_shipping_country', 'TH'),
(603, 56, '_shipping_address_1', 'test'),
(604, 56, '_shipping_address_2', ''),
(605, 56, '_shipping_city', 'test'),
(606, 56, '_shipping_state', 'TH-13'),
(607, 56, '_shipping_postcode', '12150'),
(608, 56, '_payment_method', 'bacs'),
(609, 56, '_payment_method_title', 'Direct Bank Transfer'),
(610, 56, '_order_shipping', ''),
(611, 56, '_cart_discount', '0'),
(612, 56, '_cart_discount_tax', '0'),
(613, 56, '_order_tax', '0'),
(614, 56, '_order_shipping_tax', '0'),
(615, 56, '_order_total', '1296.00'),
(660, 56, '_recorded_sales', 'yes'),
(661, 56, '_order_stock_reduced', '1'),
(662, 56, '_download_permissions_granted', '1'),
(668, 56, '_wc_memberships_access_granted', 'a:1:{i:58;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(671, 56, '_completed_date', '2016-07-04 11:20:12'),
(672, 60, '_order_key', 'wc_order_577a46e3b3bca'),
(673, 60, '_order_currency', 'THB'),
(674, 60, '_prices_include_tax', 'yes'),
(675, 60, '_customer_ip_address', '203.131.210.147'),
(676, 60, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(677, 60, '_customer_user', '0'),
(678, 60, '_created_via', 'checkout'),
(679, 60, '_cart_hash', '867f68e8d63c6ad975957c23967c384f'),
(680, 60, '_order_version', '2.6.2'),
(681, 60, '_billing_first_name', 'asas'),
(682, 60, '_billing_last_name', 'asasa'),
(683, 60, '_billing_company', ''),
(684, 60, '_billing_email', 'test2@gmail.com'),
(685, 60, '_billing_phone', '0987654322'),
(686, 60, '_billing_country', 'TH'),
(687, 60, '_billing_address_1', 'asasasa'),
(688, 60, '_billing_address_2', ''),
(689, 60, '_billing_city', 'asasa'),
(690, 60, '_billing_state', 'TH-13'),
(691, 60, '_billing_postcode', '12150'),
(692, 60, '_shipping_first_name', 'asas'),
(693, 60, '_shipping_last_name', 'asasa'),
(694, 60, '_shipping_company', ''),
(695, 60, '_shipping_country', 'TH'),
(696, 60, '_shipping_address_1', 'asasasa'),
(697, 60, '_shipping_address_2', ''),
(698, 60, '_shipping_city', 'asasa'),
(699, 60, '_shipping_state', 'TH-13'),
(700, 60, '_shipping_postcode', '12150'),
(701, 60, '_payment_method', 'bacs'),
(702, 60, '_payment_method_title', 'Direct Bank Transfer'),
(703, 60, '_order_shipping', ''),
(704, 60, '_cart_discount', '0'),
(705, 60, '_cart_discount_tax', '0'),
(706, 60, '_order_tax', '0'),
(707, 60, '_order_shipping_tax', '0'),
(708, 60, '_order_total', '1296.00'),
(709, 60, '_recorded_sales', 'yes'),
(710, 60, '_order_stock_reduced', '1') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(711, 60, '_download_permissions_granted', '1'),
(716, 60, '_wc_memberships_access_granted', 'a:1:{i:61;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(717, 60, '_completed_date', '2016-07-04 11:22:10'),
(718, 62, '_order_key', 'wc_order_577a47197280a'),
(719, 62, '_order_currency', 'THB'),
(720, 62, '_prices_include_tax', 'yes'),
(721, 62, '_customer_ip_address', '203.131.210.147'),
(722, 62, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(723, 62, '_customer_user', '0'),
(724, 62, '_created_via', 'checkout'),
(725, 62, '_cart_hash', '867f68e8d63c6ad975957c23967c384f'),
(726, 62, '_order_version', '2.6.2'),
(727, 62, '_billing_first_name', 'asas'),
(728, 62, '_billing_last_name', 'asasa'),
(729, 62, '_billing_company', ''),
(730, 62, '_billing_email', 'test2@gmail.com'),
(731, 62, '_billing_phone', '0987654322'),
(732, 62, '_billing_country', 'TH'),
(733, 62, '_billing_address_1', 'asasasa'),
(734, 62, '_billing_address_2', ''),
(735, 62, '_billing_city', 'asasa'),
(736, 62, '_billing_state', 'TH-13'),
(737, 62, '_billing_postcode', '12150'),
(738, 62, '_shipping_first_name', 'asas'),
(739, 62, '_shipping_last_name', 'asasa'),
(740, 62, '_shipping_company', ''),
(741, 62, '_shipping_country', 'TH'),
(742, 62, '_shipping_address_1', 'asasasa'),
(743, 62, '_shipping_address_2', ''),
(744, 62, '_shipping_city', 'asasa'),
(745, 62, '_shipping_state', 'TH-13'),
(746, 62, '_shipping_postcode', '12150'),
(747, 62, '_payment_method', 'bacs'),
(748, 62, '_payment_method_title', 'Direct Bank Transfer'),
(749, 62, '_order_shipping', ''),
(750, 62, '_cart_discount', '0'),
(751, 62, '_cart_discount_tax', '0'),
(752, 62, '_order_tax', '0'),
(753, 62, '_order_shipping_tax', '0'),
(754, 62, '_order_total', '1296.00'),
(755, 62, '_recorded_sales', 'yes'),
(756, 62, '_order_stock_reduced', '1'),
(757, 62, '_download_permissions_granted', '1'),
(758, 62, '_wc_memberships_access_granted', 'a:1:{i:61;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(759, 62, '_completed_date', '2016-07-04 11:23:14'),
(793, 66, '_order_key', 'wc_order_577a597b3e0b2'),
(794, 66, '_order_currency', 'THB'),
(795, 66, '_prices_include_tax', 'yes'),
(796, 66, '_customer_ip_address', '203.131.210.147'),
(797, 66, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(798, 66, '_customer_user', '1'),
(799, 66, '_created_via', 'checkout'),
(800, 66, '_cart_hash', '469c96b1d89157d72999de5b26ae59c6'),
(801, 66, '_order_version', '2.6.2'),
(802, 66, '_billing_first_name', 'Piriya'),
(803, 66, '_billing_last_name', 'Sambandaraksa'),
(804, 66, '_billing_company', 'Chaloke Dot Com Company Limited'),
(805, 66, '_billing_email', 'yadamon@gmail.com'),
(806, 66, '_billing_phone', '0944895944'),
(807, 66, '_billing_country', 'TH'),
(808, 66, '_billing_address_1', '19 Moo1 Klong 5'),
(809, 66, '_billing_address_2', 'Ladsawai'),
(810, 66, '_billing_city', 'Lamlugga'),
(811, 66, '_billing_state', 'TH-13'),
(812, 66, '_billing_postcode', '12150'),
(813, 66, '_shipping_first_name', 'Piriya'),
(814, 66, '_shipping_last_name', 'Sambandaraksa'),
(815, 66, '_shipping_company', 'Chaloke Dot Com Company Limited'),
(816, 66, '_shipping_country', 'TH'),
(817, 66, '_shipping_address_1', '19 Moo1 Klong 5'),
(818, 66, '_shipping_address_2', 'Ladsawai'),
(819, 66, '_shipping_city', 'Lamlugga'),
(820, 66, '_shipping_state', 'TH-13'),
(821, 66, '_shipping_postcode', '12150'),
(822, 66, '_payment_method', 'bacs'),
(823, 66, '_payment_method_title', 'Direct Bank Transfer'),
(824, 66, '_order_shipping', ''),
(825, 66, '_cart_discount', '0'),
(826, 66, '_cart_discount_tax', '0'),
(827, 66, '_order_tax', '0'),
(828, 66, '_order_shipping_tax', '0'),
(829, 66, '_order_total', '1296.00'),
(873, 68, '_order_key', 'wc_order_577a5e45371d3'),
(874, 68, '_order_currency', 'THB'),
(875, 68, '_prices_include_tax', 'yes'),
(876, 68, '_created_via', 'checkout'),
(877, 68, '_billing_period', 'year'),
(878, 68, '_billing_interval', '1'),
(879, 68, '_customer_user', '1'),
(880, 68, '_order_version', '2.6.2'),
(881, 68, '_shipping_first_name', 'Piriya'),
(882, 68, '_shipping_last_name', 'Sambandaraksa'),
(883, 68, '_shipping_company', 'Chaloke Dot Com Company Limited'),
(884, 68, '_shipping_address_1', '19 Moo1 Klong 5'),
(885, 68, '_shipping_address_2', 'Ladsawai'),
(886, 68, '_shipping_city', 'Lamlugga'),
(887, 68, '_shipping_state', 'TH-13'),
(888, 68, '_shipping_postcode', '12150'),
(889, 68, '_shipping_country', 'TH'),
(890, 68, '_billing_first_name', 'Piriya') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(891, 68, '_billing_last_name', 'Sambandaraksa'),
(892, 68, '_billing_company', 'Chaloke Dot Com Company Limited'),
(893, 68, '_billing_address_1', '19 Moo1 Klong 5'),
(894, 68, '_billing_address_2', 'Ladsawai'),
(895, 68, '_billing_city', 'Lamlugga'),
(896, 68, '_billing_state', 'TH-13'),
(897, 68, '_billing_postcode', '12150'),
(898, 68, '_billing_country', 'TH'),
(899, 68, '_billing_email', 'yadamon@gmail.com'),
(900, 68, '_billing_phone', '0944895944'),
(901, 68, '_schedule_trial_end', '0'),
(902, 68, '_schedule_end', '0'),
(903, 68, '_schedule_next_payment', '2017-07-04 13:01:56'),
(904, 68, '_requires_manual_renewal', 'true'),
(905, 68, '_payment_method', 'bacs'),
(906, 68, '_payment_method_title', 'Direct Bank Transfer'),
(907, 68, '_customer_ip_address', '203.131.210.147'),
(908, 68, '_customer_user_agent', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'),
(909, 68, '_cart_hash', '469c96b1d89157d72999de5b26ae59c6'),
(910, 68, '_order_shipping', ''),
(911, 68, '_cart_discount', '0'),
(912, 68, '_cart_discount_tax', '0'),
(913, 68, '_order_tax', '0'),
(914, 68, '_order_shipping_tax', '0'),
(915, 68, '_order_total', '1296.00'),
(916, 68, '_suspension_count', '1'),
(917, 66, '_recorded_sales', 'yes'),
(918, 66, '_order_stock_reduced', '1'),
(919, 69, '_order_key', 'wc_order_577b40f81ab92'),
(920, 69, '_order_currency', 'THB'),
(921, 69, '_prices_include_tax', 'yes'),
(922, 69, '_customer_ip_address', '1.46.40.18'),
(923, 69, '_customer_user_agent', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 6P Build/MTC19V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Mobile Safari/537.36'),
(924, 69, '_customer_user', '0'),
(925, 69, '_created_via', 'checkout'),
(926, 69, '_cart_hash', '867f68e8d63c6ad975957c23967c384f'),
(927, 69, '_order_version', '2.6.2'),
(928, 69, '_billing_first_name', 'Piopijh'),
(929, 69, '_billing_last_name', 'Whshf'),
(930, 69, '_billing_company', ''),
(931, 69, '_billing_email', 'yadamon@gmail.com'),
(932, 69, '_billing_phone', '0987654321'),
(933, 69, '_billing_country', 'TH'),
(934, 69, '_billing_address_1', 'Gsbjs'),
(935, 69, '_billing_address_2', ''),
(936, 69, '_billing_city', 'Vhsus'),
(937, 69, '_billing_state', 'TH-13'),
(938, 69, '_billing_postcode', '12150'),
(939, 69, '_shipping_first_name', 'Piopijh'),
(940, 69, '_shipping_last_name', 'Whshf'),
(941, 69, '_shipping_company', ''),
(942, 69, '_shipping_country', 'TH'),
(943, 69, '_shipping_address_1', 'Gsbjs'),
(944, 69, '_shipping_address_2', ''),
(945, 69, '_shipping_city', 'Vhsus'),
(946, 69, '_shipping_state', 'TH-13'),
(947, 69, '_shipping_postcode', '12150'),
(948, 69, '_payment_method', 'bacs'),
(949, 69, '_payment_method_title', 'Direct Bank Transfer'),
(950, 69, '_order_shipping', ''),
(951, 69, '_cart_discount', '0'),
(952, 69, '_cart_discount_tax', '0'),
(953, 69, '_order_tax', '0'),
(954, 69, '_order_shipping_tax', '0'),
(955, 69, '_order_total', '1296.00'),
(956, 69, '_recorded_sales', 'yes'),
(957, 69, '_order_stock_reduced', '1'),
(963, 72, '_edit_lock', '1468308712:1'),
(964, 72, '_edit_last', '1'),
(965, 72, '_bbp_last_active_time', '2016-07-19 11:51:58'),
(966, 72, '_bbp_forum_subforum_count', '3'),
(967, 72, '_bbp_reply_count', '0'),
(968, 72, '_bbp_total_reply_count', '0'),
(969, 72, '_bbp_topic_count', '0'),
(970, 72, '_bbp_total_topic_count', '2'),
(971, 72, '_bbp_topic_count_hidden', '0'),
(972, 72, '_bbp_forum_type', 'category'),
(973, 72, '_wc_memberships_content_restricted_message', ''),
(974, 72, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(975, 72, '_wc_memberships_force_public', 'no'),
(976, 74, '_edit_lock', '1468928854:1'),
(977, 74, '_edit_last', '1'),
(978, 74, '_bbp_last_active_time', '2016-07-12 05:23:48'),
(979, 74, '_bbp_forum_subforum_count', '0'),
(980, 74, '_bbp_reply_count', '0'),
(981, 74, '_bbp_total_reply_count', '0'),
(982, 74, '_bbp_topic_count', '1'),
(983, 74, '_bbp_total_topic_count', '1'),
(984, 74, '_bbp_topic_count_hidden', '0'),
(985, 74, '_bbp_status', 'closed'),
(986, 74, '_wc_memberships_content_restricted_message', ''),
(987, 74, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(988, 74, '_wc_memberships_force_public', 'no'),
(989, 76, '_menu_item_type', 'post_type'),
(990, 76, '_menu_item_menu_item_parent', '0'),
(991, 76, '_menu_item_object_id', '72'),
(992, 76, '_menu_item_object', 'forum'),
(993, 76, '_menu_item_target', ''),
(994, 76, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(995, 76, '_menu_item_xfn', '') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(996, 76, '_menu_item_url', ''),
(997, 76, '_menu_item_orphaned', '1468300877'),
(998, 77, '_menu_item_type', 'post_type'),
(999, 77, '_menu_item_menu_item_parent', '0'),
(1000, 77, '_menu_item_object_id', '72'),
(1001, 77, '_menu_item_object', 'forum'),
(1002, 77, '_menu_item_target', ''),
(1003, 77, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(1004, 77, '_menu_item_xfn', ''),
(1005, 77, '_menu_item_url', ''),
(1007, 72, '_bbp_last_topic_id', '105'),
(1008, 72, '_bbp_last_reply_id', '98'),
(1009, 72, '_bbp_last_active_id', '105'),
(1010, 72, '_bbp_status', 'open'),
(1019, 79, '_edit_lock', '1468301068:1'),
(1020, 79, '_edit_last', '1'),
(1021, 79, '_bbp_last_active_time', '2016-07-19 11:51:58'),
(1022, 79, '_bbp_forum_subforum_count', '0'),
(1023, 79, '_bbp_reply_count', '0'),
(1024, 79, '_bbp_total_reply_count', '0'),
(1025, 79, '_bbp_topic_count', '1'),
(1026, 79, '_bbp_total_topic_count', '1'),
(1027, 79, '_bbp_topic_count_hidden', '0'),
(1028, 79, '_wc_memberships_content_restricted_message', ''),
(1029, 79, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1030, 79, '_wc_memberships_force_public', 'no'),
(1031, 79, '_bbp_last_topic_id', '105'),
(1032, 79, '_bbp_last_reply_id', '105'),
(1033, 79, '_bbp_last_active_id', '105'),
(1034, 74, '_bbp_last_topic_id', '0'),
(1035, 81, '_edit_lock', '1468330435:1'),
(1036, 81, '_edit_last', '1'),
(1037, 81, '_bbp_last_active_time', '2016-07-12 05:27:23'),
(1038, 81, '_bbp_forum_subforum_count', '0'),
(1039, 81, '_bbp_reply_count', '0'),
(1040, 81, '_bbp_total_reply_count', '0'),
(1041, 81, '_bbp_topic_count', '0'),
(1042, 81, '_bbp_total_topic_count', '0'),
(1043, 81, '_bbp_topic_count_hidden', '0'),
(1044, 81, '_wc_memberships_content_restricted_message', ''),
(1045, 81, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1046, 81, '_wc_memberships_force_public', 'no'),
(1061, 81, '_bbp_last_reply_id', '0'),
(1064, 86, '_wp_attached_file', '2016/07/Screenshot_2014-02-08-10-34-47.jpg'),
(1065, 86, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:70:"wp-content/uploads/2016/07/12075454/Screenshot_2014-02-08-10-34-47.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1066, 86, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1080;s:6:"height";i:1920;s:4:"file";s:42:"2016/07/Screenshot_2014-02-08-10-34-47.jpg";s:5:"sizes";a:7:{s:9:"thumbnail";a:4:{s:4:"file";s:42:"Screenshot_2014-02-08-10-34-47-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:42:"Screenshot_2014-02-08-10-34-47-500x889.jpg";s:5:"width";i:500;s:6:"height";i:889;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:43:"Screenshot_2014-02-08-10-34-47-768x1365.jpg";s:5:"width";i:768;s:6:"height";i:1365;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:44:"Screenshot_2014-02-08-10-34-47-1024x1820.jpg";s:5:"width";i:1024;s:6:"height";i:1820;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:42:"Screenshot_2014-02-08-10-34-47-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:42:"Screenshot_2014-02-08-10-34-47-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:42:"Screenshot_2014-02-08-10-34-47-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"1";s:8:"keywords";a:0:{}}}'),
(1067, 87, '_wp_attached_file', '2016/07/CDClogo2015_rev1_A1.png'),
(1068, 87, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:59:"wp-content/uploads/2016/07/12075502/CDClogo2015_rev1_A1.png";s:6:"region";s:14:"ap-southeast-1";}'),
(1069, 87, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:2500;s:6:"height";i:2500;s:4:"file";s:31:"2016/07/CDClogo2015_rev1_A1.png";s:5:"sizes";a:7:{s:9:"thumbnail";a:4:{s:4:"file";s:31:"CDClogo2015_rev1_A1-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:31:"CDClogo2015_rev1_A1-500x500.png";s:5:"width";i:500;s:6:"height";i:500;s:9:"mime-type";s:9:"image/png";}s:12:"medium_large";a:4:{s:4:"file";s:31:"CDClogo2015_rev1_A1-768x768.png";s:5:"width";i:768;s:6:"height";i:768;s:9:"mime-type";s:9:"image/png";}s:5:"large";a:4:{s:4:"file";s:33:"CDClogo2015_rev1_A1-1024x1024.png";s:5:"width";i:1024;s:6:"height";i:1024;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:31:"CDClogo2015_rev1_A1-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:12:"shop_catalog";a:4:{s:4:"file";s:31:"CDClogo2015_rev1_A1-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:11:"shop_single";a:4:{s:4:"file";s:31:"CDClogo2015_rev1_A1-600x600.png";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1070, 87, '_wp_attachment_wp_user_avatar', '1'),
(1080, 91, '_wp_attached_file', '2016/07/bitcoin.jpg'),
(1081, 91, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:47:"wp-content/uploads/2016/07/12130029/bitcoin.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1082, 91, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1756;s:6:"height";i:840;s:4:"file";s:19:"2016/07/bitcoin.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:19:"bitcoin-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:19:"bitcoin-500x239.jpg";s:5:"width";i:500;s:6:"height";i:239;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:19:"bitcoin-768x367.jpg";s:5:"width";i:768;s:6:"height";i:367;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:20:"bitcoin-1024x490.jpg";s:5:"width";i:1024;s:6:"height";i:490;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:19:"bitcoin-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:19:"bitcoin-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:19:"bitcoin-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:19:"bitcoin-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1083, 91, '_bbp_attachment', '1'),
(1093, 94, '_menu_item_type', 'post_type'),
(1094, 94, '_menu_item_menu_item_parent', '0'),
(1095, 94, '_menu_item_object_id', '81'),
(1096, 94, '_menu_item_object', 'forum'),
(1097, 94, '_menu_item_target', ''),
(1098, 94, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(1099, 94, '_menu_item_xfn', ''),
(1100, 94, '_menu_item_url', ''),
(1111, 2, '_edit_lock', '1468342202:1'),
(1112, 2, '_edit_last', '1'),
(1113, 2, '_wc_memberships_content_restricted_message', ''),
(1114, 2, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1115, 2, '_wc_memberships_force_public', 'no'),
(1122, 99, '_menu_item_type', 'post_type'),
(1123, 99, '_menu_item_menu_item_parent', '0'),
(1124, 99, '_menu_item_object_id', '72'),
(1125, 99, '_menu_item_object', 'forum'),
(1126, 99, '_menu_item_target', ''),
(1127, 99, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(1128, 99, '_menu_item_xfn', ''),
(1129, 99, '_menu_item_url', ''),
(1130, 99, '_menu_item_orphaned', '1468343358'),
(1131, 100, '_menu_item_type', 'post_type'),
(1132, 100, '_menu_item_menu_item_parent', '0'),
(1133, 100, '_menu_item_object_id', '81'),
(1134, 100, '_menu_item_object', 'forum'),
(1135, 100, '_menu_item_target', ''),
(1136, 100, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(1137, 100, '_menu_item_xfn', ''),
(1138, 100, '_menu_item_url', ''),
(1139, 100, '_menu_item_orphaned', '1468343358'),
(1140, 101, '_menu_item_type', 'post_type'),
(1141, 101, '_menu_item_menu_item_parent', '0'),
(1142, 101, '_menu_item_object_id', '79'),
(1143, 101, '_menu_item_object', 'forum'),
(1144, 101, '_menu_item_target', ''),
(1145, 101, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(1146, 101, '_menu_item_xfn', ''),
(1147, 101, '_menu_item_url', ''),
(1148, 101, '_menu_item_orphaned', '1468343358'),
(1149, 102, '_menu_item_type', 'post_type'),
(1150, 102, '_menu_item_menu_item_parent', '0'),
(1151, 102, '_menu_item_object_id', '74'),
(1152, 102, '_menu_item_object', 'forum'),
(1153, 102, '_menu_item_target', ''),
(1154, 102, '_menu_item_classes', 'a:1:{i:0;s:0:"";}') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1155, 102, '_menu_item_xfn', ''),
(1156, 102, '_menu_item_url', ''),
(1157, 102, '_menu_item_orphaned', '1468343358'),
(1158, 103, '_menu_item_type', 'custom'),
(1159, 103, '_menu_item_menu_item_parent', '0'),
(1160, 103, '_menu_item_object_id', '103'),
(1161, 103, '_menu_item_object', 'custom'),
(1162, 103, '_menu_item_target', ''),
(1163, 103, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(1164, 103, '_menu_item_xfn', ''),
(1165, 103, '_menu_item_url', '/'),
(1167, 87, '_edit_lock', '1468424681:1'),
(1168, 38, '_jetpack_related_posts_cache', 'a:1:{s:32:"32b0bf150bb6bd30c74ed5fafdacd61f";a:2:{s:7:"expires";i:1483716748;s:7:"payload";a:2:{i:0;a:1:{s:2:"id";i:23;}i:1;a:1:{s:2:"id";i:1517;}}}}'),
(1169, 74, '_jetpack_related_posts_cache', 'a:1:{s:32:"814d76ec02c40abc2456346584cd2203";a:2:{s:7:"expires";i:1483746752;s:7:"payload";a:2:{i:0;a:1:{s:2:"id";i:81;}i:1;a:1:{s:2:"id";i:79;}}}}'),
(1170, 72, '_jetpack_related_posts_cache', 'a:1:{s:32:"814d76ec02c40abc2456346584cd2203";a:2:{s:7:"expires";i:1483794797;s:7:"payload";a:0:{}}}'),
(1171, 79, '_jetpack_related_posts_cache', 'a:1:{s:32:"814d76ec02c40abc2456346584cd2203";a:2:{s:7:"expires";i:1483815243;s:7:"payload";a:2:{i:0;a:1:{s:2:"id";i:81;}i:1;a:1:{s:2:"id";i:74;}}}}'),
(1172, 105, '_wpas_done_all', '1'),
(1173, 105, '_bbp_akismet_result', 'false'),
(1174, 105, '_bbp_akismet_history', 'a:4:{s:4:"time";d:1468929118.7348831;s:7:"message";s:37:"Akismet cleared this post as not spam";s:5:"event";s:9:"check-ham";s:4:"user";s:9:"cdc-admin";}'),
(1175, 105, '_bbp_akismet_as_submitted', 'a:64:{s:14:"comment_author";s:9:"cdc-admin";s:20:"comment_author_email";s:23:"chalokedotcom@gmail.com";s:18:"comment_author_url";s:0:"";s:15:"comment_content";s:30:"Guess I should see that fixed!";s:15:"comment_post_ID";i:79;s:12:"comment_type";s:5:"topic";s:9:"permalink";s:54:"http://54.254.207.12/forums/forum/cdc/the-living-room/";s:8:"referrer";s:54:"http://54.254.207.12/forums/forum/cdc/the-living-room/";s:10:"user_agent";s:110:"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36";s:7:"user_ID";i:1;s:7:"user_ip";s:12:"125.25.24.11";s:9:"user_role";s:27:"administrator,bbp_keymaster";s:4:"blog";s:20:"http://54.254.207.12";s:12:"blog_charset";s:5:"UTF-8";s:9:"blog_lang";s:5:"en_US";s:20:"POST_bbp_topic_title";s:21:"Oh no! Topic is wonky";s:22:"POST_bbp_topic_content";s:30:"Guess I should see that fixed!";s:19:"POST_bbp_topic_tags";s:0:"";s:20:"POST_bbp_stick_topic";s:7:"unstick";s:21:"POST_bbp_topic_status";s:7:"publish";s:21:"POST_bbp_topic_submit";s:0:"";s:17:"POST_bbp_forum_id";s:2:"79";s:11:"POST_action";s:13:"bbp-new-topic";s:31:"POST__bbp_unfiltered_html_topic";s:10:"4546a5bb1c";s:13:"POST__wpnonce";s:10:"6d181d82ba";s:21:"POST__wp_http_referer";s:34:"/forums/forum/cdc/the-living-room/";s:15:"SERVER_SOFTWARE";s:21:"Apache/2.4.7 (Ubuntu)";s:11:"REQUEST_URI";s:34:"/forums/forum/cdc/the-living-room/";s:15:"REDIRECT_STATUS";s:3:"200";s:9:"HTTP_HOST";s:13:"54.254.207.12";s:15:"HTTP_CONNECTION";s:10:"keep-alive";s:14:"CONTENT_LENGTH";s:4:"1452";s:18:"HTTP_CACHE_CONTROL";s:9:"max-age=0";s:11:"HTTP_ORIGIN";s:20:"http://54.254.207.12";s:30:"HTTP_UPGRADE_INSECURE_REQUESTS";s:1:"1";s:15:"HTTP_USER_AGENT";s:110:"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36";s:12:"CONTENT_TYPE";s:68:"multipart/form-data; boundary=----WebKitFormBoundaryUIVtcxLrhfA0qNaA";s:11:"HTTP_ACCEPT";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:12:"HTTP_REFERER";s:54:"http://54.254.207.12/forums/forum/cdc/the-living-room/";s:20:"HTTP_ACCEPT_ENCODING";s:13:"gzip, deflate";s:20:"HTTP_ACCEPT_LANGUAGE";s:26:"th-TH,th;q=0.8,en-GB;q=0.6";s:11:"HTTP_COOKIE";s:0:"";s:4:"PATH";s:60:"/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin";s:16:"SERVER_SIGNATURE";s:73:"<address>Apache/2.4.7 (Ubuntu) Server at 54.254.207.12 Port 80</address>\n";s:11:"SERVER_NAME";s:13:"54.254.207.12";s:11:"SERVER_ADDR";s:13:"192.168.0.118";s:11:"SERVER_PORT";s:2:"80";s:11:"REMOTE_ADDR";s:12:"125.25.24.11";s:13:"DOCUMENT_ROOT";s:16:"/var/www/staging";s:14:"REQUEST_SCHEME";s:4:"http";s:14:"CONTEXT_PREFIX";s:0:"";s:21:"CONTEXT_DOCUMENT_ROOT";s:16:"/var/www/staging";s:12:"SERVER_ADMIN";s:19:"webmaster@localhost";s:15:"SCRIPT_FILENAME";s:26:"/var/www/staging/index.php";s:11:"REMOTE_PORT";s:5:"53272";s:12:"REDIRECT_URL";s:34:"/forums/forum/cdc/the-living-room/";s:17:"GATEWAY_INTERFACE";s:7:"CGI/1.1";s:15:"SERVER_PROTOCOL";s:8:"HTTP/1.1";s:14:"REQUEST_METHOD";s:4:"POST";s:12:"QUERY_STRING";s:0:"";s:11:"SCRIPT_NAME";s:10:"/index.php";s:8:"PHP_SELF";s:10:"/index.php";s:18:"REQUEST_TIME_FLOAT";s:14:"1468929118.038";s:12:"REQUEST_TIME";s:10:"1468929118";}'),
(1176, 105, '_bbp_forum_id', '79'),
(1177, 105, '_bbp_topic_id', '105'),
(1178, 105, '_bbp_author_ip', '125.25.24.11'),
(1179, 105, '_bbp_last_reply_id', '0'),
(1180, 105, '_bbp_last_active_id', '105'),
(1181, 105, '_bbp_last_active_time', '2016-07-19 11:51:58'),
(1182, 105, '_bbp_reply_count', '0'),
(1183, 105, '_bbp_reply_count_hidden', '0'),
(1184, 105, '_bbp_voice_count', '1'),
(1185, 105, '_jetpack_related_posts_cache', 'a:1:{s:32:"ac89c1ee27f07c7472c8d350fb700438";a:2:{s:7:"expires";i:1483554545;s:7:"payload";a:0:{}}}'),
(1189, 23, '_jetpack_related_posts_cache', 'a:1:{s:32:"32b0bf150bb6bd30c74ed5fafdacd61f";a:2:{s:7:"expires";i:1477516298;s:7:"payload";a:2:{i:0;a:1:{s:2:"id";i:38;}i:1;a:1:{s:2:"id";i:1517;}}}}'),
(1190, 1, '_jetpack_related_posts_cache', 'a:1:{s:32:"8f6677c9d6b0f903e98ad32ec61f8deb";a:2:{s:7:"expires";i:1483551997;s:7:"payload";a:0:{}}}'),
(1191, 81, '_jetpack_related_posts_cache', 'a:1:{s:32:"814d76ec02c40abc2456346584cd2203";a:2:{s:7:"expires";i:1483829244;s:7:"payload";a:2:{i:0;a:1:{s:2:"id";i:79;}i:1;a:1:{s:2:"id";i:74;}}}}'),
(1194, 110, '_action_manager_schedule', 'O:30:"ActionScheduler_SimpleSchedule":1:{s:41:"\0ActionScheduler_SimpleSchedule\0timestamp";s:10:"1488336025";}'),
(1199, 113, '_publicize_pending', '1'),
(1200, 113, '_sol_slider_data', 'a:3:{s:6:"config";a:38:{s:4:"type";s:8:"defaults";s:12:"slider_theme";s:4:"base";s:11:"slider_size";s:7:"default";s:12:"slider_width";i:960;s:13:"slider_height";i:300;s:10:"transition";s:4:"fade";s:8:"duration";i:5000;s:5:"speed";i:400;s:8:"position";s:6:"center";s:6:"gutter";i:20;s:6:"slider";i:1;s:16:"caption_position";s:6:"bottom";s:13:"caption_delay";i:0;s:6:"mobile";i:0;s:12:"mobile_width";i:600;s:13:"mobile_height";i:200;s:4:"auto";i:1;s:6:"smooth";i:1;s:10:"dimensions";i:0;s:6:"arrows";i:1;s:7:"control";i:1;s:9:"pauseplay";i:0;s:14:"mobile_caption";i:0;s:5:"hover";i:0;s:5:"pause";i:1;s:10:"mousewheel";i:0;s:8:"keyboard";i:1;s:3:"css";i:1;s:4:"loop";i:1;s:6:"random";i:0;s:5:"delay";i:0;s:5:"start";i:0;s:9:"aria_live";s:6:"polite";s:7:"classes";a:1:{i:0;s:24:"soliloquy-default-slider";}s:5:"title";s:26:"Soliloquy Default Settings";s:4:"slug";s:24:"soliloquy-default-slider";s:3:"rtl";i:0;s:10:"sort_order";s:6:"manual";}s:2:"id";i:113;s:6:"slider";a:0:{}}'),
(1205, 116, '_edit_lock', '1483805875:1'),
(1206, 117, '_wp_attached_file', '2017/01/Talk2017_2_20percent_small.jpg'),
(1207, 117, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:66:"wp-content/uploads/2017/01/07090317/Talk2017_2_20percent_small.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1208, 117, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1734;s:6:"height";i:907;s:4:"file";s:38:"2017/01/Talk2017_2_20percent_small.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-500x262.jpg";s:5:"width";i:500;s:6:"height";i:262;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-768x402.jpg";s:5:"width";i:768;s:6:"height";i:402;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:39:"Talk2017_2_20percent_small-1024x536.jpg";s:5:"width";i:1024;s:6:"height";i:536;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:38:"Talk2017_2_20percent_small-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1209, 117, '_sol_has_slider', 'a:1:{i:0;i:116;}'),
(1210, 116, '_sol_in_slider', 'a:2:{i:0;i:117;i:1;i:120;}'),
(1211, 116, '_sol_slider_data', 'a:4:{s:2:"id";i:116;s:6:"slider";a:2:{i:117;a:9:{s:6:"status";s:6:"active";s:2:"id";i:117;s:13:"attachment_id";i:117;s:3:"src";s:119:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07090317/Talk2017_2_20percent_small.jpg";s:5:"title";s:26:"Talk2017_2_20percent_small";s:4:"link";s:0:"";s:3:"alt";s:26:"Talk2017_2_20percent_small";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:120;a:9:{s:6:"status";s:6:"active";s:2:"id";i:120;s:13:"attachment_id";i:120;s:3:"src";s:113:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07095341/cdc_amibroker2016_21.jpg";s:5:"title";s:20:"cdc_amibroker2016_21";s:4:"link";s:0:"";s:3:"alt";s:20:"cdc_amibroker2016_21";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}}s:6:"config";a:49:{s:4:"type";s:7:"default";s:11:"slider_size";s:12:"medium_large";s:12:"slider_theme";s:4:"base";s:12:"slider_width";i:800;s:13:"slider_height";i:300;s:8:"position";s:6:"center";s:10:"transition";s:4:"fade";s:8:"duration";i:5000;s:5:"speed";i:400;s:16:"caption_position";s:6:"bottom";s:13:"caption_delay";i:0;s:6:"gutter";i:20;s:4:"auto";i:1;s:6:"smooth";i:0;s:10:"dimensions";i:0;s:6:"arrows";i:1;s:7:"control";i:1;s:9:"pauseplay";i:0;s:14:"mobile_caption";i:0;s:5:"hover";i:0;s:5:"pause";i:1;s:10:"mousewheel";i:0;s:6:"slider";i:0;s:6:"mobile";i:0;s:12:"mobile_width";i:600;s:13:"mobile_height";i:200;s:8:"keyboard";i:1;s:3:"css";i:1;s:4:"loop";i:1;s:6:"random";i:0;s:5:"delay";i:0;s:5:"start";i:0;s:14:"autoplay_video";i:0;s:9:"aria_live";s:6:"polite";s:10:"sort_order";s:6:"manual";s:7:"classes";a:1:{i:0;s:24:"soliloquy-default-slider";}s:5:"title";s:9:"frontpage";s:4:"slug";s:9:"frontpage";s:3:"rtl";i:0;s:10:"thumbnails";i:0;s:16:"thumbnails_width";i:0;s:17:"thumbnails_height";i:70;s:19:"thumbnails_position";s:6:"bottom";s:17:"thumbnails_margin";i:0;s:14:"thumbnails_num";i:3;s:15:"thumbnails_crop";i:1;s:15:"thumbnails_loop";i:0;s:17:"thumbnails_arrows";i:0;s:17:"mobile_thumbnails";i:0;}s:6:"status";s:7:"publish";}'),
(1212, 116, '_edit_last', '1'),
(1214, 116, '_publicize_pending', '1'),
(1216, 118, '_wp_attached_file', '2017/01/cdc_amibroker2016_2.jpg'),
(1217, 118, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:59:"wp-content/uploads/2017/01/07094923/cdc_amibroker2016_2.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1218, 118, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1734;s:6:"height";i:907;s:4:"file";s:31:"2017/01/cdc_amibroker2016_2.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-500x262.jpg";s:5:"width";i:500;s:6:"height";i:262;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-768x402.jpg";s:5:"width";i:768;s:6:"height";i:402;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:32:"cdc_amibroker2016_2-1024x536.jpg";s:5:"width";i:1024;s:6:"height";i:536;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:31:"cdc_amibroker2016_2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1219, 120, '_wp_attached_file', '2017/01/cdc_amibroker2016_21.jpg'),
(1220, 120, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:60:"wp-content/uploads/2017/01/07095341/cdc_amibroker2016_21.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1221, 120, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1734;s:6:"height";i:907;s:4:"file";s:32:"2017/01/cdc_amibroker2016_21.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-500x262.jpg";s:5:"width";i:500;s:6:"height";i:262;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-768x402.jpg";s:5:"width";i:768;s:6:"height";i:402;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:33:"cdc_amibroker2016_21-1024x536.jpg";s:5:"width";i:1024;s:6:"height";i:536;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:32:"cdc_amibroker2016_21-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1222, 120, '_sol_has_slider', 'a:1:{i:0;i:116;}'),
(1223, 122, '_edit_lock', '1483783836:1'),
(1224, 122, '_edit_last', '1'),
(1225, 122, '_wp_page_template', 'default'),
(1226, 122, '_wc_memberships_content_restricted_message', ''),
(1227, 122, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1228, 122, '_wc_memberships_force_public', 'no'),
(1229, 116, '_jetpack_dont_email_post_to_subs', '1'),
(1230, 125, '_wp_trash_meta_status', 'publish'),
(1231, 125, '_wp_trash_meta_time', '1483784544'),
(1232, 125, '_publicize_pending', '1'),
(1233, 126, '_wp_trash_meta_status', 'publish'),
(1234, 126, '_wp_trash_meta_time', '1483784608'),
(1235, 126, '_publicize_pending', '1'),
(1236, 38, '_wc_memberships_exclude_discounts', 'no'),
(1237, 127, '_wp_trash_meta_status', 'publish'),
(1238, 127, '_wp_trash_meta_time', '1483794770'),
(1239, 127, '_publicize_pending', '1'),
(1240, 128, '_wp_trash_meta_status', 'publish'),
(1241, 128, '_wp_trash_meta_time', '1483795307'),
(1242, 128, '_publicize_pending', '1'),
(1245, 133, '_edit_lock', '1499248627:1'),
(1246, 133, '_edit_last', '1'),
(1247, 133, '_wp_page_template', 'default'),
(1248, 133, '_wc_memberships_content_restricted_message', ''),
(1249, 133, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1250, 133, '_wc_memberships_force_public', 'no'),
(1251, 135, '_wp_trash_meta_status', 'publish'),
(1252, 135, '_wp_trash_meta_time', '1483803569'),
(1253, 136, '_wp_trash_meta_status', 'publish'),
(1254, 136, '_wp_trash_meta_time', '1483803664'),
(1256, 138, '_wp_trash_meta_status', 'publish'),
(1257, 138, '_wp_trash_meta_time', '1483803753'),
(1258, 142, '_wp_trash_meta_status', 'publish'),
(1259, 142, '_wp_trash_meta_time', '1483805358'),
(1260, 143, '_edit_lock', '1498743981:1'),
(1261, 144, '_wp_attached_file', '2017/01/test1.jpg'),
(1262, 144, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:45:"wp-content/uploads/2017/01/07232038/test1.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1263, 144, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1181;s:6:"height";i:300;s:4:"file";s:17:"2017/01/test1.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"test1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:17:"test1-500x127.jpg";s:5:"width";i:500;s:6:"height";i:127;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:17:"test1-768x195.jpg";s:5:"width";i:768;s:6:"height";i:195;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:18:"test1-1024x260.jpg";s:5:"width";i:1024;s:6:"height";i:260;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:17:"test1-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:17:"test1-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:17:"test1-600x300.jpg";s:5:"width";i:600;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:17:"test1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1264, 144, '_sol_has_slider', 'a:1:{i:0;i:143;}'),
(1265, 143, '_sol_in_slider', 'a:3:{i:0;i:144;i:1;i:145;i:2;i:146;}'),
(1266, 143, '_sol_slider_data', 'a:4:{s:2:"id";i:143;s:6:"slider";a:3:{i:144;a:9:{s:6:"status";s:6:"active";s:2:"id";i:144;s:13:"attachment_id";i:144;s:3:"src";s:98:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07232038/test1.jpg";s:5:"title";s:5:"test1";s:4:"link";s:0:"";s:3:"alt";s:5:"test1";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:145;a:9:{s:6:"status";s:6:"active";s:2:"id";i:145;s:13:"attachment_id";i:145;s:3:"src";s:98:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07232049/test2.jpg";s:5:"title";s:5:"test2";s:4:"link";s:0:"";s:3:"alt";s:5:"test2";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:146;a:9:{s:6:"status";s:6:"active";s:2:"id";i:146;s:13:"attachment_id";i:146;s:3:"src";s:98:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07232059/test3.jpg";s:5:"title";s:5:"test3";s:4:"link";s:0:"";s:3:"alt";s:5:"test3";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}}s:6:"config";a:49:{s:4:"type";s:7:"default";s:11:"slider_size";s:7:"default";s:12:"slider_theme";s:4:"base";s:12:"slider_width";i:1181;s:13:"slider_height";i:300;s:8:"position";s:6:"center";s:10:"transition";s:10:"horizontal";s:8:"duration";i:5000;s:5:"speed";i:400;s:16:"caption_position";s:6:"bottom";s:13:"caption_delay";i:0;s:6:"gutter";i:20;s:4:"auto";i:1;s:6:"smooth";i:1;s:10:"dimensions";i:1;s:6:"arrows";i:1;s:7:"control";i:1;s:9:"pauseplay";i:0;s:14:"mobile_caption";i:0;s:5:"hover";i:1;s:5:"pause";i:1;s:10:"mousewheel";i:0;s:6:"slider";i:0;s:6:"mobile";i:0;s:12:"mobile_width";i:600;s:13:"mobile_height";i:200;s:8:"keyboard";i:1;s:3:"css";i:1;s:4:"loop";i:1;s:6:"random";i:0;s:5:"delay";i:0;s:5:"start";i:0;s:14:"autoplay_video";i:0;s:9:"aria_live";s:6:"polite";s:10:"sort_order";s:6:"manual";s:7:"classes";a:1:{i:0;s:24:"soliloquy-default-slider";}s:5:"title";s:4:"Test";s:4:"slug";s:3:"143";s:3:"rtl";i:0;s:10:"thumbnails";i:0;s:16:"thumbnails_width";i:0;s:17:"thumbnails_height";i:0;s:19:"thumbnails_position";s:5:"right";s:17:"thumbnails_margin";i:0;s:14:"thumbnails_num";i:3;s:15:"thumbnails_crop";i:0;s:15:"thumbnails_loop";i:0;s:17:"thumbnails_arrows";i:0;s:17:"mobile_thumbnails";i:0;}s:6:"status";s:7:"publish";}'),
(1267, 145, '_wp_attached_file', '2017/01/test2.jpg'),
(1268, 145, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:45:"wp-content/uploads/2017/01/07232049/test2.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1269, 145, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1181;s:6:"height";i:300;s:4:"file";s:17:"2017/01/test2.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"test2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:17:"test2-500x127.jpg";s:5:"width";i:500;s:6:"height";i:127;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:17:"test2-768x195.jpg";s:5:"width";i:768;s:6:"height";i:195;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:18:"test2-1024x260.jpg";s:5:"width";i:1024;s:6:"height";i:260;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:17:"test2-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:17:"test2-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:17:"test2-600x300.jpg";s:5:"width";i:600;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:17:"test2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1270, 145, '_sol_has_slider', 'a:1:{i:0;i:143;}'),
(1271, 146, '_wp_attached_file', '2017/01/test3.jpg'),
(1272, 146, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:45:"wp-content/uploads/2017/01/07232059/test3.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1273, 146, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1181;s:6:"height";i:300;s:4:"file";s:17:"2017/01/test3.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:17:"test3-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:17:"test3-500x127.jpg";s:5:"width";i:500;s:6:"height";i:127;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:17:"test3-768x195.jpg";s:5:"width";i:768;s:6:"height";i:195;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:18:"test3-1024x260.jpg";s:5:"width";i:1024;s:6:"height";i:260;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:17:"test3-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:17:"test3-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:17:"test3-600x300.jpg";s:5:"width";i:600;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:17:"test3-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1274, 146, '_sol_has_slider', 'a:1:{i:0;i:143;}'),
(1275, 143, '_edit_last', '1'),
(1276, 147, '_wp_page_template', 'default'),
(1279, 149, '_wp_trash_meta_status', 'publish'),
(1280, 149, '_wp_trash_meta_time', '1498737679'),
(1281, 147, '_edit_lock', '1499247095:1'),
(1282, 1, '_pingme', '1'),
(1283, 1, '_encloseme', '1'),
(1284, 1, '_pingme', '1'),
(1285, 1, '_encloseme', '1'),
(1286, 154, '_wp_trash_meta_status', 'publish'),
(1287, 154, '_wp_trash_meta_time', '1498744974'),
(1288, 155, '_wp_trash_meta_status', 'publish'),
(1289, 155, '_wp_trash_meta_time', '1498745432'),
(1290, 148, '_edit_lock', '1499247093:1'),
(1291, 156, '_edit_lock', '1498749858:1'),
(1292, 157, '_wp_attached_file', '2017/06/size-ref-block_336x280.gif'),
(1293, 157, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:62:"wp-content/uploads/2017/06/29222131/size-ref-block_336x280.gif";s:6:"region";s:14:"ap-southeast-1";}'),
(1294, 157, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:336;s:6:"height";i:280;s:4:"file";s:34:"2017/06/size-ref-block_336x280.gif";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:4:"file";s:34:"size-ref-block_336x280-150x150.gif";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/gif";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:34:"size-ref-block_336x280-180x180.gif";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/gif";}s:12:"shop_catalog";a:4:{s:4:"file";s:34:"size-ref-block_336x280-300x280.gif";s:5:"width";i:300;s:6:"height";i:280;s:9:"mime-type";s:9:"image/gif";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:34:"size-ref-block_336x280-150x150.gif";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/gif";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1295, 157, '_sol_has_slider', 'a:1:{i:0;i:156;}'),
(1296, 156, '_sol_in_slider', 'a:9:{i:0;i:157;i:1;i:158;i:2;i:159;i:3;a:34:{s:2:"id";i:41;s:5:"title";s:10:"CDC ADV MS";s:8:"filename";s:14:"CDC-ADV-MS.png";s:3:"url";s:103:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103438/CDC-ADV-MS.png";s:4:"link";s:0:"";s:3:"alt";s:0:"";s:6:"author";s:1:"1";s:11:"description";s:0:"";s:7:"caption";s:0:"";s:4:"name";s:10:"cdc-adv-ms";s:6:"status";s:7:"inherit";s:10:"uploadedTo";i:38;s:4:"date";s:24:"2016-07-04T10:34:38.000Z";s:8:"modified";s:24:"2016-07-04T10:34:38.000Z";s:9:"menuOrder";i:0;s:4:"mime";s:9:"image/png";s:4:"type";s:5:"image";s:7:"subtype";s:3:"png";s:4:"icon";s:55:"http://52.76.37.90/wp-includes/images/media/default.png";s:13:"dateFormatted";s:12:"July 4, 2016";s:6:"nonces";a:3:{s:6:"update";s:10:"e0454c9f8c";s:6:"delete";s:10:"114e16e940";s:4:"edit";s:10:"f4c9908135";}s:8:"editLink";s:56:"http://52.76.37.90/wp-admin/post.php?post=41&action=edit";s:4:"meta";b:0;s:10:"authorName";s:9:"cdc-admin";s:14:"uploadedToLink";s:56:"http://52.76.37.90/wp-admin/post.php?post=38&action=edit";s:15:"uploadedToTitle";s:21:"Supporting Membership";s:15:"filesizeInBytes";i:208770;s:21:"filesizeHumanReadable";s:6:"204 KB";s:6:"height";i:528;s:5:"width";i:458;s:11:"orientation";s:8:"portrait";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:6:"height";i:150;s:5:"width";i:150;s:3:"url";s:111:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103438/CDC-ADV-MS-150x150.png";s:11:"orientation";s:9:"landscape";}s:4:"full";a:4:{s:3:"url";s:103:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103438/CDC-ADV-MS.png";s:6:"height";i:528;s:5:"width";i:458;s:11:"orientation";s:8:"portrait";}}s:6:"compat";a:2:{s:4:"item";s:0:"";s:4:"meta";s:0:"";}s:18:"bulk_local_warning";b:0;}i:4;a:34:{s:2:"id";i:42;s:5:"title";s:12:"CDC BASIC MS";s:8:"filename";s:16:"CDC-BASIC-MS.png";s:3:"url";s:105:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103441/CDC-BASIC-MS.png";s:4:"link";s:0:"";s:3:"alt";s:0:"";s:6:"author";s:1:"1";s:11:"description";s:0:"";s:7:"caption";s:0:"";s:4:"name";s:12:"cdc-basic-ms";s:6:"status";s:7:"inherit";s:10:"uploadedTo";i:38;s:4:"date";s:24:"2016-07-04T10:34:41.000Z";s:8:"modified";s:24:"2016-07-04T10:34:41.000Z";s:9:"menuOrder";i:0;s:4:"mime";s:9:"image/png";s:4:"type";s:5:"image";s:7:"subtype";s:3:"png";s:4:"icon";s:55:"http://52.76.37.90/wp-includes/images/media/default.png";s:13:"dateFormatted";s:12:"July 4, 2016";s:6:"nonces";a:3:{s:6:"update";s:10:"13535e9535";s:6:"delete";s:10:"7da8da1e1c";s:4:"edit";s:10:"641dc147c3";}s:8:"editLink";s:56:"http://52.76.37.90/wp-admin/post.php?post=42&action=edit";s:4:"meta";b:0;s:10:"authorName";s:9:"cdc-admin";s:14:"uploadedToLink";s:56:"http://52.76.37.90/wp-admin/post.php?post=38&action=edit";s:15:"uploadedToTitle";s:21:"Supporting Membership";s:15:"filesizeInBytes";i:746394;s:21:"filesizeHumanReadable";s:6:"729 KB";s:6:"height";i:528;s:5:"width";i:458;s:11:"orientation";s:8:"portrait";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:6:"height";i:150;s:5:"width";i:150;s:3:"url";s:113:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103441/CDC-BASIC-MS-150x150.png";s:11:"orientation";s:9:"landscape";}s:4:"full";a:4:{s:3:"url";s:105:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103441/CDC-BASIC-MS.png";s:6:"height";i:528;s:5:"width";i:458;s:11:"orientation";s:8:"portrait";}}s:6:"compat";a:2:{s:4:"item";s:0:"";s:4:"meta";s:0:"";}s:18:"bulk_local_warning";b:0;}i:5;a:34:{s:2:"id";i:43;s:5:"title";s:14:"CDC Membership";s:8:"filename";s:19:"CDC-Membership1.png";s:3:"url";s:108:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103442/CDC-Membership1.png";s:4:"link";s:0:"";s:3:"alt";s:0:"";s:6:"author";s:1:"1";s:11:"description";s:0:"";s:7:"caption";s:0:"";s:4:"name";s:16:"cdc-membership-2";s:6:"status";s:7:"inherit";s:10:"uploadedTo";i:38;s:4:"date";s:24:"2016-07-04T10:34:42.000Z";s:8:"modified";s:24:"2016-07-04T10:34:42.000Z";s:9:"menuOrder";i:0;s:4:"mime";s:9:"image/png";s:4:"type";s:5:"image";s:7:"subtype";s:3:"png";s:4:"icon";s:55:"http://52.76.37.90/wp-includes/images/media/default.png";s:13:"dateFormatted";s:12:"July 4, 2016";s:6:"nonces";a:3:{s:6:"update";s:10:"b0c4e5f116";s:6:"delete";s:10:"a3edaffa5e";s:4:"edit";s:10:"281c747bf7";}s:8:"editLink";s:56:"http://52.76.37.90/wp-admin/post.php?post=43&action=edit";s:4:"meta";b:0;s:10:"authorName";s:9:"cdc-admin";s:14:"uploadedToLink";s:56:"http://52.76.37.90/wp-admin/post.php?post=38&action=edit";s:15:"uploadedToTitle";s:21:"Supporting Membership";s:15:"filesizeInBytes";i:278692;s:21:"filesizeHumanReadable";s:6:"272 KB";s:6:"height";i:528;s:5:"width";i:458;s:11:"orientation";s:8:"portrait";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:6:"height";i:150;s:5:"width";i:150;s:3:"url";s:116:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103442/CDC-Membership1-150x150.png";s:11:"orientation";s:9:"landscape";}s:4:"full";a:4:{s:3:"url";s:108:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103442/CDC-Membership1.png";s:6:"height";i:528;s:5:"width";i:458;s:11:"orientation";s:8:"portrait";}}s:6:"compat";a:2:{s:4:"item";s:0:"";s:4:"meta";s:0:"";}s:18:"bulk_local_warning";b:0;}i:6;a:34:{s:2:"id";i:159;s:5:"title";s:19:"Talk2016_20percent1";s:8:"filename";s:23:"Talk2016_20percent1.jpg";s:3:"url";s:112:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222200/Talk2016_20percent1.jpg";s:4:"link";s:0:"";s:3:"alt";s:0:"";s:6:"author";s:1:"1";s:11:"description";s:0:"";s:7:"caption";s:0:"";s:4:"name";s:19:"talk2016_20percent1";s:6:"status";s:7:"inherit";s:10:"uploadedTo";i:156;s:4:"date";s:24:"2017-06-29T15:22:00.000Z";s:8:"modified";s:24:"2017-06-29T15:22:00.000Z";s:9:"menuOrder";i:0;s:4:"mime";s:10:"image/jpeg";s:4:"type";s:5:"image";s:7:"subtype";s:4:"jpeg";s:4:"icon";s:55:"http://52.76.37.90/wp-includes/images/media/default.png";s:13:"dateFormatted";s:13:"June 29, 2017";s:6:"nonces";a:3:{s:6:"update";s:10:"50793fbe1d";s:6:"delete";s:10:"7cc5988126";s:4:"edit";s:10:"77132bb611";}s:8:"editLink";s:57:"http://52.76.37.90/wp-admin/post.php?post=159&action=edit";s:4:"meta";b:0;s:10:"authorName";s:9:"cdc-admin";s:14:"uploadedToLink";s:57:"http://52.76.37.90/wp-admin/post.php?post=156&action=edit";s:15:"uploadedToTitle";s:10:"Auto Draft";s:15:"filesizeInBytes";i:228352;s:21:"filesizeHumanReadable";s:6:"223 KB";s:6:"height";i:628;s:5:"width";i:1200;s:11:"orientation";s:9:"landscape";s:5:"sizes";a:4:{s:9:"thumbnail";a:4:{s:6:"height";i:150;s:5:"width";i:150;s:3:"url";s:120:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222200/Talk2016_20percent1-150x150.jpg";s:11:"orientation";s:9:"landscape";}s:6:"medium";a:4:{s:6:"height";i:262;s:5:"width";i:500;s:3:"url";s:120:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222200/Talk2016_20percent1-500x262.jpg";s:11:"orientation";s:9:"landscape";}s:5:"large";a:4:{s:6:"height";i:513;s:5:"width";i:980;s:3:"url";s:121:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222200/Talk2016_20percent1-1024x536.jpg";s:11:"orientation";s:9:"landscape";}s:4:"full";a:4:{s:3:"url";s:112:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222200/Talk2016_20percent1.jpg";s:6:"height";i:628;s:5:"width";i:1200;s:11:"orientation";s:9:"landscape";}}s:6:"compat";a:2:{s:4:"item";s:0:"";s:4:"meta";s:0:"";}s:18:"bulk_local_warning";b:0;}i:7;a:34:{s:2:"id";i:158;s:5:"title";s:8:"size-ref";s:8:"filename";s:12:"size-ref.jpg";s:3:"url";s:101:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222138/size-ref.jpg";s:4:"link";s:0:"";s:3:"alt";s:0:"";s:6:"author";s:1:"1";s:11:"description";s:0:"";s:7:"caption";s:0:"";s:4:"name";s:8:"size-ref";s:6:"status";s:7:"inherit";s:10:"uploadedTo";i:156;s:4:"date";s:24:"2017-06-29T15:21:38.000Z";s:8:"modified";s:24:"2017-06-29T15:21:38.000Z";s:9:"menuOrder";i:0;s:4:"mime";s:10:"image/jpeg";s:4:"type";s:5:"image";s:7:"subtype";s:4:"jpeg";s:4:"icon";s:55:"http://52.76.37.90/wp-includes/images/media/default.png";s:13:"dateFormatted";s:13:"June 29, 2017";s:6:"nonces";a:3:{s:6:"update";s:10:"3d798e5649";s:6:"delete";s:10:"8ca3fb0537";s:4:"edit";s:10:"16195067ab";}s:8:"editLink";s:57:"http://52.76.37.90/wp-admin/post.php?post=158&action=edit";s:4:"meta";b:0;s:10:"authorName";s:9:"cdc-admin";s:14:"uploadedToLink";s:57:"http://52.76.37.90/wp-admin/post.php?post=156&action=edit";s:15:"uploadedToTitle";s:10:"Auto Draft";s:15:"filesizeInBytes";i:23621;s:21:"filesizeHumanReadable";s:5:"23 KB";s:6:"height";i:90;s:5:"width";i:728;s:11:"orientation";s:9:"landscape";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:6:"height";i:90;s:5:"width";i:150;s:3:"url";s:108:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222138/size-ref-150x90.jpg";s:11:"orientation";s:9:"landscape";}s:6:"medium";a:4:{s:6:"height";i:62;s:5:"width";i:500;s:3:"url";s:108:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222138/size-ref-500x62.jpg";s:11:"orientation";s:9:"landscape";}s:4:"full";a:4:{s:3:"url";s:101:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222138/size-ref.jpg";s:6:"height";i:90;s:5:"width";i:728;s:11:"orientation";s:9:"landscape";}}s:6:"compat";a:2:{s:4:"item";s:0:"";s:4:"meta";s:0:"";}s:18:"bulk_local_warning";b:0;}i:8;a:34:{s:2:"id";i:157;s:5:"title";s:22:"size-ref-block_336x280";s:8:"filename";s:26:"size-ref-block_336x280.gif";s:3:"url";s:115:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222131/size-ref-block_336x280.gif";s:4:"link";s:0:"";s:3:"alt";s:0:"";s:6:"author";s:1:"1";s:11:"description";s:0:"";s:7:"caption";s:0:"";s:4:"name";s:22:"size-ref-block_336x280";s:6:"status";s:7:"inherit";s:10:"uploadedTo";i:156;s:4:"date";s:24:"2017-06-29T15:21:31.000Z";s:8:"modified";s:24:"2017-06-29T15:21:31.000Z";s:9:"menuOrder";i:0;s:4:"mime";s:9:"image/gif";s:4:"type";s:5:"image";s:7:"subtype";s:3:"gif";s:4:"icon";s:55:"http://52.76.37.90/wp-includes/images/media/default.png";s:13:"dateFormatted";s:13:"June 29, 2017";s:6:"nonces";a:3:{s:6:"update";s:10:"4680f50157";s:6:"delete";s:10:"c0348d8416";s:4:"edit";s:10:"f40c3f05c0";}s:8:"editLink";s:57:"http://52.76.37.90/wp-admin/post.php?post=157&action=edit";s:4:"meta";b:0;s:10:"authorName";s:9:"cdc-admin";s:14:"uploadedToLink";s:57:"http://52.76.37.90/wp-admin/post.php?post=156&action=edit";s:15:"uploadedToTitle";s:10:"Auto Draft";s:15:"filesizeInBytes";i:47764;s:21:"filesizeHumanReadable";s:5:"47 KB";s:6:"height";i:280;s:5:"width";i:336;s:11:"orientation";s:9:"landscape";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:6:"height";i:150;s:5:"width";i:150;s:3:"url";s:123:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222131/size-ref-block_336x280-150x150.gif";s:11:"orientation";s:9:"landscape";}s:4:"full";a:4:{s:3:"url";s:115:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222131/size-ref-block_336x280.gif";s:6:"height";i:280;s:5:"width";i:336;s:11:"orientation";s:9:"landscape";}}s:6:"compat";a:2:{s:4:"item";s:0:"";s:4:"meta";s:0:"";}s:18:"bulk_local_warning";b:0;}}'),
(1297, 156, '_sol_slider_data', 'a:4:{s:2:"id";i:156;s:6:"slider";a:6:{i:157;a:9:{s:6:"status";s:6:"active";s:2:"id";i:157;s:13:"attachment_id";i:157;s:3:"src";s:115:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222131/size-ref-block_336x280.gif";s:5:"title";s:22:"size-ref-block_336x280";s:4:"link";s:0:"";s:3:"alt";s:22:"size-ref-block_336x280";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:158;a:9:{s:6:"status";s:6:"active";s:2:"id";i:158;s:13:"attachment_id";i:158;s:3:"src";s:101:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222138/size-ref.jpg";s:5:"title";s:8:"size-ref";s:4:"link";s:0:"";s:3:"alt";s:8:"size-ref";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:159;a:9:{s:6:"status";s:6:"active";s:2:"id";i:159;s:13:"attachment_id";i:159;s:3:"src";s:112:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/06/29222200/Talk2016_20percent1.jpg";s:5:"title";s:19:"Talk2016_20percent1";s:4:"link";s:0:"";s:3:"alt";s:19:"Talk2016_20percent1";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:41;a:9:{s:6:"status";s:6:"active";s:2:"id";i:41;s:13:"attachment_id";i:41;s:3:"src";s:103:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103438/CDC-ADV-MS.png";s:5:"title";s:10:"CDC ADV MS";s:4:"link";s:0:"";s:3:"alt";s:10:"CDC ADV MS";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:42;a:9:{s:6:"status";s:6:"active";s:2:"id";i:42;s:13:"attachment_id";i:42;s:3:"src";s:105:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103441/CDC-BASIC-MS.png";s:5:"title";s:12:"CDC BASIC MS";s:4:"link";s:0:"";s:3:"alt";s:12:"CDC BASIC MS";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}i:43;a:9:{s:6:"status";s:6:"active";s:2:"id";i:43;s:13:"attachment_id";i:43;s:3:"src";s:108:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04103442/CDC-Membership1.png";s:5:"title";s:14:"CDC Membership";s:4:"link";s:0:"";s:3:"alt";s:14:"CDC Membership";s:7:"caption";s:0:"";s:4:"type";s:5:"image";}}s:6:"config";a:49:{s:4:"type";s:7:"default";s:11:"slider_size";s:7:"default";s:12:"slider_theme";s:7:"classic";s:12:"slider_width";i:1181;s:13:"slider_height";i:300;s:8:"position";s:6:"center";s:10:"transition";s:10:"horizontal";s:8:"duration";i:5000;s:5:"speed";i:400;s:16:"caption_position";s:6:"bottom";s:13:"caption_delay";i:0;s:6:"gutter";i:20;s:4:"auto";i:1;s:6:"smooth";i:1;s:10:"dimensions";i:1;s:6:"arrows";i:1;s:7:"control";i:1;s:9:"pauseplay";i:0;s:14:"mobile_caption";i:0;s:5:"hover";i:1;s:5:"pause";i:1;s:10:"mousewheel";i:0;s:6:"slider";i:0;s:6:"mobile";i:0;s:12:"mobile_width";i:600;s:13:"mobile_height";i:200;s:8:"keyboard";i:1;s:3:"css";i:1;s:4:"loop";i:1;s:6:"random";i:0;s:5:"delay";i:0;s:5:"start";i:0;s:14:"autoplay_video";i:0;s:9:"aria_live";s:6:"polite";s:10:"sort_order";s:6:"manual";s:7:"classes";a:1:{i:0;s:24:"soliloquy-default-slider";}s:5:"title";s:4:"1234";s:4:"slug";s:4:"1234";s:3:"rtl";i:0;s:10:"thumbnails";i:0;s:16:"thumbnails_width";i:0;s:17:"thumbnails_height";i:0;s:19:"thumbnails_position";s:5:"right";s:17:"thumbnails_margin";i:0;s:14:"thumbnails_num";i:3;s:15:"thumbnails_crop";i:0;s:15:"thumbnails_loop";i:0;s:17:"thumbnails_arrows";i:0;s:17:"mobile_thumbnails";i:0;}s:6:"status";s:7:"publish";}'),
(1298, 158, '_wp_attached_file', '2017/06/size-ref.jpg'),
(1299, 158, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:48:"wp-content/uploads/2017/06/29222138/size-ref.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1300, 158, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:728;s:6:"height";i:90;s:4:"file";s:20:"2017/06/size-ref.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:19:"size-ref-150x90.jpg";s:5:"width";i:150;s:6:"height";i:90;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:19:"size-ref-500x62.jpg";s:5:"width";i:500;s:6:"height";i:62;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:19:"size-ref-180x90.jpg";s:5:"width";i:180;s:6:"height";i:90;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:19:"size-ref-300x90.jpg";s:5:"width";i:300;s:6:"height";i:90;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:19:"size-ref-600x90.jpg";s:5:"width";i:600;s:6:"height";i:90;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:19:"size-ref-150x90.jpg";s:5:"width";i:150;s:6:"height";i:90;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1301, 158, '_sol_has_slider', 'a:1:{i:0;i:156;}'),
(1302, 159, '_wp_attached_file', '2017/06/Talk2016_20percent1.jpg'),
(1303, 159, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:59:"wp-content/uploads/2017/06/29222200/Talk2016_20percent1.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1304, 159, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1200;s:6:"height";i:628;s:4:"file";s:31:"2017/06/Talk2016_20percent1.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:31:"Talk2016_20percent1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:31:"Talk2016_20percent1-500x262.jpg";s:5:"width";i:500;s:6:"height";i:262;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:31:"Talk2016_20percent1-768x402.jpg";s:5:"width";i:768;s:6:"height";i:402;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:32:"Talk2016_20percent1-1024x536.jpg";s:5:"width";i:1024;s:6:"height";i:536;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:31:"Talk2016_20percent1-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:31:"Talk2016_20percent1-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:31:"Talk2016_20percent1-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:31:"Talk2016_20percent1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1305, 159, '_sol_has_slider', 'a:1:{i:0;i:156;}'),
(1306, 156, '_edit_last', '1'),
(1308, 160, '_edit_lock', '1499165050:1'),
(1309, 160, '_edit_last', '1'),
(1310, 161, '_wp_attached_file', '2017/07/Talk2017_3_20percent2.jpg'),
(1311, 161, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:61:"wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1312, 161, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1734;s:6:"height";i:907;s:4:"file";s:33:"2017/07/Talk2017_3_20percent2.jpg";s:5:"sizes";a:8:{s:9:"thumbnail";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-500x262.jpg";s:5:"width";i:500;s:6:"height";i:262;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-768x402.jpg";s:5:"width";i:768;s:6:"height";i:402;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:34:"Talk2017_3_20percent2-1024x536.jpg";s:5:"width";i:1024;s:6:"height";i:536;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-600x600.jpg";s:5:"width";i:600;s:6:"height";i:600;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:33:"Talk2017_3_20percent2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1313, 162, '_wp_attached_file', '2017/07/Slider-Fallback-Image.jpg'),
(1314, 162, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:61:"wp-content/uploads/2017/07/04153309/Slider-Fallback-Image.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1315, 162, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:960;s:6:"height";i:300;s:4:"file";s:33:"2017/07/Slider-Fallback-Image.jpg";s:5:"sizes";a:7:{s:9:"thumbnail";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-500x156.jpg";s:5:"width";i:500;s:6:"height";i:156;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-768x240.jpg";s:5:"width";i:768;s:6:"height";i:240;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-600x300.jpg";s:5:"width";i:600;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:33:"Slider-Fallback-Image-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1316, 160, '_sol_slider_data', 'a:3:{s:2:"id";i:160;s:6:"config";a:73:{s:4:"type";s:2:"fc";s:11:"slider_size";s:7:"default";s:12:"slider_theme";s:4:"base";s:12:"slider_width";i:960;s:13:"slider_height";i:300;s:8:"position";s:6:"center";s:10:"transition";s:4:"fade";s:8:"duration";i:5000;s:5:"speed";i:400;s:16:"caption_position";s:6:"bottom";s:13:"caption_delay";i:0;s:6:"gutter";i:20;s:4:"auto";i:1;s:6:"smooth";i:0;s:10:"dimensions";i:1;s:6:"arrows";i:1;s:7:"control";i:1;s:9:"pauseplay";i:0;s:14:"mobile_caption";i:0;s:5:"hover";i:1;s:5:"pause";i:1;s:10:"mousewheel";i:0;s:6:"slider";i:1;s:6:"mobile";i:1;s:12:"mobile_width";i:600;s:13:"mobile_height";i:200;s:8:"keyboard";i:0;s:3:"css";i:1;s:4:"loop";i:1;s:6:"random";i:0;s:5:"delay";i:0;s:5:"start";i:0;s:14:"autoplay_video";i:0;s:9:"aria_live";s:6:"polite";s:10:"sort_order";s:6:"manual";s:7:"classes";a:1:{i:0;s:24:"soliloquy-default-slider";}s:5:"title";s:13:"featuredslide";s:4:"slug";s:13:"featuredslide";s:3:"rtl";i:0;s:13:"fc_post_types";a:1:{i:0;s:4:"post";}s:8:"fc_terms";a:0:{}s:17:"fc_terms_relation";s:3:"AND";s:8:"fc_query";s:7:"include";s:9:"fc_inc_ex";a:0:{}s:9:"fc_sticky";i:0;s:10:"fc_orderby";s:4:"date";s:11:"fc_meta_key";s:0:"";s:8:"fc_order";s:4:"DESC";s:9:"fc_number";i:5;s:9:"fc_offset";i:0;s:9:"fc_status";s:7:"publish";s:11:"fc_post_url";i:0;s:13:"fc_post_title";i:1;s:18:"fc_post_title_link";i:1;s:15:"fc_content_type";s:4:"none";s:17:"fc_content_length";i:0;s:19:"fc_content_ellipses";i:0;s:15:"fc_content_html";i:0;s:12:"fc_read_more";i:1;s:17:"fc_read_more_text";s:39:"อ่านเพิ่มเติม";s:11:"fc_fallback";s:119:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04161445/Slider-Fallback-Image_600p.jpg";s:23:"fc_disable_post_classes";i:0;s:11:"fc_no_cache";i:0;s:10:"thumbnails";i:0;s:16:"thumbnails_width";i:50;s:17:"thumbnails_height";i:50;s:19:"thumbnails_position";s:6:"bottom";s:17:"thumbnails_margin";i:0;s:14:"thumbnails_num";i:5;s:15:"thumbnails_crop";i:0;s:15:"thumbnails_loop";i:0;s:17:"thumbnails_arrows";i:0;s:17:"mobile_thumbnails";i:0;}s:6:"status";s:7:"publish";}'),
(1318, 147, '_edit_last', '1'),
(1319, 147, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1320, 147, '_wc_memberships_content_restricted_message', ''),
(1321, 147, '_wc_memberships_force_public', 'no'),
(1322, 165, '_wp_attached_file', '2016/07/cropped-cropped-CDClogo2015_rev1_A.png'),
(1323, 165, '_wp_attachment_context', 'custom-logo'),
(1324, 165, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:74:"wp-content/uploads/2016/07/04154711/cropped-cropped-CDClogo2015_rev1_A.png";s:6:"region";s:14:"ap-southeast-1";}'),
(1325, 165, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:240;s:6:"height";i:240;s:4:"file";s:46:"2016/07/cropped-cropped-CDClogo2015_rev1_A.png";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:46:"cropped-cropped-CDClogo2015_rev1_A-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:46:"cropped-cropped-CDClogo2015_rev1_A-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:46:"cropped-cropped-CDClogo2015_rev1_A-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1326, 11, '_edit_lock', '1499158838:1'),
(1327, 11, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:81:"wp-content/uploads/2016/07/04093950/cropped-CDClogo2015_rev1_A-e1499158089226.png";s:6:"region";s:14:"ap-southeast-1";}'),
(1328, 11, '_wp_attachment_backup_sizes', 'a:1:{s:9:"full-orig";a:3:{s:5:"width";i:512;s:6:"height";i:512;s:4:"file";s:30:"cropped-CDClogo2015_rev1_A.png";}}'),
(1329, 11, '_edit_last', '1'),
(1330, 11, 'amazonS3_cache', 'a:1:{s:119:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-CDClogo2015_rev1_A.png";a:1:{s:9:"timestamp";i:1499158104;}}'),
(1331, 11, '_oembed_750cb584301a62f1a54b67e8650da565', '{{unknown}}'),
(1332, 166, '_wp_trash_meta_status', 'publish'),
(1333, 166, '_wp_trash_meta_time', '1499158156'),
(1334, 167, '_wp_attached_file', '2016/07/cropped-cropped-CDClogo2015_rev1_A-e1499158089226.png'),
(1335, 167, '_wp_attachment_context', 'custom-logo'),
(1336, 167, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:89:"wp-content/uploads/2016/07/04155348/cropped-cropped-CDClogo2015_rev1_A-e1499158089226.png";s:6:"region";s:14:"ap-southeast-1";}'),
(1337, 167, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:240;s:6:"height";i:240;s:4:"file";s:61:"2016/07/cropped-cropped-CDClogo2015_rev1_A-e1499158089226.png";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:61:"cropped-cropped-CDClogo2015_rev1_A-e1499158089226-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:61:"cropped-cropped-CDClogo2015_rev1_A-e1499158089226-180x180.png";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:9:"image/png";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:61:"cropped-cropped-CDClogo2015_rev1_A-e1499158089226-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1338, 169, '_wp_attached_file', '2017/07/cropped-Talk2017_3_20percent2.jpg'),
(1339, 169, '_wp_attachment_context', 'custom-header'),
(1340, 169, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:69:"wp-content/uploads/2017/07/04155447/cropped-Talk2017_3_20percent2.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1341, 169, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1200;s:6:"height";i:375;s:4:"file";s:41:"2017/07/cropped-Talk2017_3_20percent2.jpg";s:5:"sizes";a:9:{s:9:"thumbnail";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-500x156.jpg";s:5:"width";i:500;s:6:"height";i:156;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-768x240.jpg";s:5:"width";i:768;s:6:"height";i:240;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:42:"cropped-Talk2017_3_20percent2-1024x320.jpg";s:5:"width";i:1024;s:6:"height";i:320;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-600x375.jpg";s:5:"width";i:600;s:6:"height";i:375;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:42:"cropped-Talk2017_3_20percent2-1200x375.jpg";s:5:"width";i:1200;s:6:"height";i:375;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:41:"cropped-Talk2017_3_20percent2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1342, 169, '_wp_attachment_custom_header_last_used_twentysixteen', '1499158488'),
(1343, 169, '_wp_attachment_is_custom_header', 'twentysixteen'),
(1344, 168, '_wp_trash_meta_status', 'publish'),
(1345, 168, '_wp_trash_meta_time', '1499158538'),
(1346, 170, '_wp_trash_meta_status', 'publish'),
(1347, 170, '_wp_trash_meta_time', '1499158559'),
(1348, 171, '_wp_trash_meta_status', 'publish'),
(1349, 171, '_wp_trash_meta_time', '1499158915'),
(1350, 172, '_wp_trash_meta_status', 'publish'),
(1351, 172, '_wp_trash_meta_time', '1499159255'),
(1352, 173, '_wp_trash_meta_status', 'publish'),
(1353, 173, '_wp_trash_meta_time', '1499159298'),
(1354, 174, '_wp_trash_meta_status', 'publish'),
(1355, 174, '_wp_trash_meta_time', '1499159411'),
(1356, 175, '_wp_attached_file', '2017/07/Slider-Fallback-Image_600p.jpg'),
(1357, 175, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:66:"wp-content/uploads/2017/07/04161445/Slider-Fallback-Image_600p.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1358, 175, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:600;s:6:"height";i:300;s:4:"file";s:38:"2017/07/Slider-Fallback-Image_600p.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:38:"Slider-Fallback-Image_600p-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:38:"Slider-Fallback-Image_600p-500x250.jpg";s:5:"width";i:500;s:6:"height";i:250;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:38:"Slider-Fallback-Image_600p-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:38:"Slider-Fallback-Image_600p-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:38:"Slider-Fallback-Image_600p-600x300.jpg";s:5:"width";i:600;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:38:"Slider-Fallback-Image_600p-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1359, 1, 'amazonS3_cache', 'a:4:{s:114:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2.jpg";i:161;s:122:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2-500x262.jpg";i:161;s:71:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2.jpg";i:161;s:79:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262.jpg";i:161;}'),
(1360, 1, '_pingme', '1'),
(1361, 1, '_encloseme', '1'),
(1362, 178, '_edit_lock', '1499245576:1'),
(1363, 178, '_edit_last', '1'),
(1364, 177, '_edit_lock', '1499192483:1'),
(1365, 178, 'amazonS3_cache', 'a:4:{s:100:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/12130029/bitcoin.jpg";i:91;s:108:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/12130029/bitcoin-500x239.jpg";i:91;s:57:"http://52.76.37.90/wp-content/uploads/2016/07/bitcoin.jpg";i:91;s:65:"http://52.76.37.90/wp-content/uploads/2016/07/bitcoin-500x239.jpg";i:91;}'),
(1366, 178, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1367, 178, '_wc_memberships_content_restricted_message', ''),
(1368, 178, '_wc_memberships_force_public', 'no'),
(1369, 178, 'wpfcas_slide_icon', 'fa fa-hand-spock-o'),
(1370, 178, 'wpfcas_slide_link', ''),
(1371, 177, '_edit_last', '1'),
(1373, 177, '_pingme', '1'),
(1374, 177, '_encloseme', '1'),
(1375, 177, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1376, 177, '_wc_memberships_content_restricted_message', ''),
(1377, 177, '_wc_memberships_force_public', 'no'),
(1378, 177, 'wpfcas_slide_icon', '') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1379, 177, 'wpfcas_slide_link', ''),
(1380, 177, 'amazonS3_cache', 'a:8:{s:71:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2.jpg";i:161;s:79:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262.jpg";i:161;s:114:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2.jpg";i:161;s:122:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2-500x262.jpg";i:161;s:119:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07090317/Talk2017_2_20percent_small.jpg";i:117;s:127:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07090317/Talk2017_2_20percent_small-500x262.jpg";i:117;s:76:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small.jpg";i:117;s:84:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262.jpg";i:117;}'),
(1381, 177, '_pingme', '1'),
(1382, 177, '_encloseme', '1'),
(1383, 181, '_edit_lock', '1499192466:1'),
(1384, 182, '_edit_lock', '1499246265:1'),
(1385, 178, '_thumbnail_id', '194'),
(1386, 182, '_edit_last', '1'),
(1387, 182, '_thumbnail_id', '199'),
(1388, 182, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1389, 182, '_wc_memberships_content_restricted_message', ''),
(1390, 182, '_wc_memberships_force_public', 'no'),
(1391, 182, 'wpfcas_slide_icon', 'fa fa-newspaper-o'),
(1392, 182, 'wpfcas_slide_link', ''),
(1393, 184, '_edit_lock', '1499170043:1'),
(1394, 185, '_wp_trash_meta_status', 'publish'),
(1395, 185, '_wp_trash_meta_time', '1499172062'),
(1396, 186, '_edit_lock', '1499244688:1'),
(1397, 186, '_edit_last', '1'),
(1398, 186, '_thumbnail_id', '91'),
(1399, 186, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1400, 186, '_wc_memberships_content_restricted_message', ''),
(1401, 186, '_wc_memberships_force_public', 'no'),
(1402, 186, 'wpfcas_slide_icon', 'fa fa-btc'),
(1403, 186, 'wpfcas_slide_link', ''),
(1404, 187, '_wp_trash_meta_status', 'publish'),
(1405, 187, '_wp_trash_meta_time', '1499172546'),
(1406, 188, '_wp_trash_meta_status', 'publish'),
(1407, 188, '_wp_trash_meta_time', '1499172569'),
(1408, 189, '_wp_trash_meta_status', 'publish'),
(1409, 189, '_wp_trash_meta_time', '1499172592'),
(1410, 190, '_order_key', 'wc_order_595bcc8b0c292'),
(1411, 190, '_customer_user', '19'),
(1412, 190, '_payment_method', 'bacs'),
(1413, 190, '_payment_method_title', 'Direct Bank Transfer'),
(1414, 190, '_transaction_id', ''),
(1415, 190, '_customer_ip_address', '118.174.154.184'),
(1416, 190, '_customer_user_agent', 'mozilla/5.0 (windows nt 10.0; wow64) applewebkit/537.36 (khtml, like gecko) chrome/59.0.3071.86 safari/537.36 opr/46.0.2597.32'),
(1417, 190, '_created_via', 'checkout'),
(1418, 190, '_date_completed', '1499188442'),
(1419, 190, '_completed_date', '2017-07-05 00:14:02'),
(1420, 190, '_date_paid', ''),
(1421, 190, '_paid_date', ''),
(1422, 190, '_cart_hash', 'aa4372a9dcab20df663f71757176775b'),
(1423, 190, '_billing_first_name', 'เทสต์'),
(1424, 190, '_billing_last_name', 'ทดสอบศักดิ์'),
(1425, 190, '_billing_company', 'หนึ่งสองหนึ่งสอง'),
(1426, 190, '_billing_address_1', '13 เอล์มสตรีท'),
(1427, 190, '_billing_address_2', ''),
(1428, 190, '_billing_city', 'Lamlugga'),
(1429, 190, '_billing_state', 'TH-13'),
(1430, 190, '_billing_postcode', '12150'),
(1431, 190, '_billing_country', 'TH'),
(1432, 190, '_billing_email', 'test@test.com'),
(1433, 190, '_billing_phone', '0987655678'),
(1434, 190, '_shipping_first_name', ''),
(1435, 190, '_shipping_last_name', ''),
(1436, 190, '_shipping_company', ''),
(1437, 190, '_shipping_address_1', ''),
(1438, 190, '_shipping_address_2', ''),
(1439, 190, '_shipping_city', ''),
(1440, 190, '_shipping_state', ''),
(1441, 190, '_shipping_postcode', ''),
(1442, 190, '_shipping_country', ''),
(1443, 190, '_order_currency', 'THB'),
(1444, 190, '_cart_discount', '0'),
(1445, 190, '_cart_discount_tax', '0'),
(1446, 190, '_order_shipping', '0'),
(1447, 190, '_order_shipping_tax', '0'),
(1448, 190, '_order_tax', '0'),
(1449, 190, '_order_total', '1296.00'),
(1450, 190, '_order_version', '3.1.0'),
(1451, 190, '_prices_include_tax', 'yes'),
(1452, 190, '_billing_address_index', 'เทสต์ ทดสอบศักดิ์ หนึ่งสองหนึ่งสอง 13 เอล์มสตรีท  Lamlugga TH-13 12150 TH test@test.com 0987655678'),
(1453, 190, '_shipping_address_index', '        '),
(1454, 190, '_shipping_method', ''),
(1455, 190, '_recorded_sales', 'yes'),
(1456, 190, '_recorded_coupon_usage_counts', 'yes'),
(1457, 190, '_order_stock_reduced', 'yes'),
(1458, 190, '_download_permissions_granted', 'yes'),
(1459, 191, '_product_id', '23'),
(1460, 191, '_order_id', '190'),
(1461, 190, '_wc_memberships_access_granted', 'a:1:{i:191;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(1462, 191, '_start_date', '2017-07-04 17:14:02'),
(1463, 191, '_end_date', '2018-07-04 17:14:02'),
(1464, 192, '_action_manager_schedule', 'O:30:"ActionScheduler_SimpleSchedule":1:{s:41:"\0ActionScheduler_SimpleSchedule\0timestamp";s:10:"1530724442";}'),
(1465, 193, '_action_manager_schedule', 'O:30:"ActionScheduler_SimpleSchedule":1:{s:41:"\0ActionScheduler_SimpleSchedule\0timestamp";s:10:"1530465242";}'),
(1466, 190, '_wc_memberships_access_granted', 'a:1:{i:191;a:2:{s:15:"already_granted";s:3:"yes";s:21:"granting_order_status";s:9:"completed";}}'),
(1467, 194, '_wp_attached_file', '2017/07/fc_moving.jpg'),
(1468, 194, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:49:"wp-content/uploads/2017/07/05155810/fc_moving.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1469, 194, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:644;s:6:"height";i:350;s:4:"file";s:21:"2017/07/fc_moving.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:21:"fc_moving-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:21:"fc_moving-500x272.jpg";s:5:"width";i:500;s:6:"height";i:272;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:21:"fc_moving-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:21:"fc_moving-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:21:"fc_moving-600x350.jpg";s:5:"width";i:600;s:6:"height";i:350;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:21:"fc_moving-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1470, 186, '_wp_trash_meta_status', 'publish'),
(1471, 186, '_wp_trash_meta_time', '1499245213'),
(1472, 186, '_wp_desired_post_slug', 'and-theres-a-third-content'),
(1473, 195, '_edit_lock', '1499247122:1'),
(1474, 195, '_edit_last', '1'),
(1475, 195, '_thumbnail_id', '161'),
(1476, 195, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1477, 195, '_wc_memberships_content_restricted_message', ''),
(1478, 195, '_wc_memberships_force_public', 'no') ;
INSERT INTO `wp_postmeta` ( `meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1479, 195, 'wpfcas_slide_icon', 'fa fa-microphone'),
(1480, 195, 'wpfcas_slide_link', 'http://52.76.37.90/2017/07/05/เปิดรับสมัคร-cdc-talk-webinar-2017/'),
(1481, 196, '_edit_lock', '1499249376:1'),
(1482, 196, '_oembed_fc1e203d862c8429a317484bc7fedd1b', '<iframe width="980" height="551" src="https://www.youtube.com/embed/bDvldl-OzvU?feature=oembed" frameborder="0" allowfullscreen></iframe>'),
(1483, 196, '_oembed_time_fc1e203d862c8429a317484bc7fedd1b', '1499245821'),
(1484, 196, '_edit_last', '1'),
(1485, 197, '_wp_attached_file', '2017/07/LINK-สมัคร-web-20171.png'),
(1487, 197, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:150;s:6:"height";i:150;s:4:"file";s:42:"2017/07/LINK-สมัคร-web-20171.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:13:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}s:14:"resized_images";a:2:{i:0;s:9:"960x300_c";i:1;s:9:"600x200_c";}}}'),
(1488, 196, '_oembed_992a253106e3c2a698a11b9e6f118ab9', '{{unknown}}'),
(1489, 196, 'amazonS3_cache', 'a:4:{s:153:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/05161146/LINK-%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3-web-20171.png";i:197;s:110:"http://52.76.37.90/wp-content/uploads/2017/07/LINK-%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3-web-20171.png";i:197;s:80:"http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171.png";i:197;s:123:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/05161146/LINK-สมัคร-web-20171.png";i:197;}'),
(1490, 196, '_pingme', '1'),
(1491, 196, '_encloseme', '1'),
(1492, 196, '_wc_memberships_use_custom_content_restricted_message', 'no'),
(1493, 196, '_wc_memberships_content_restricted_message', ''),
(1494, 196, '_wc_memberships_force_public', 'no'),
(1495, 196, 'wpfcas_slide_icon', ''),
(1496, 196, 'wpfcas_slide_link', ''),
(1497, 199, '_wp_attached_file', '2017/07/fc_placeholder_blue.jpg'),
(1498, 199, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:59:"wp-content/uploads/2017/07/05161718/fc_placeholder_blue.jpg";s:6:"region";s:14:"ap-southeast-1";}'),
(1499, 199, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:644;s:6:"height";i:350;s:4:"file";s:31:"2017/07/fc_placeholder_blue.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:31:"fc_placeholder_blue-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:31:"fc_placeholder_blue-500x272.jpg";s:5:"width";i:500;s:6:"height";i:272;s:9:"mime-type";s:10:"image/jpeg";}s:14:"shop_thumbnail";a:4:{s:4:"file";s:31:"fc_placeholder_blue-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"shop_catalog";a:4:{s:4:"file";s:31:"fc_placeholder_blue-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:11:"shop_single";a:4:{s:4:"file";s:31:"fc_placeholder_blue-600x350.jpg";s:5:"width";i:600;s:6:"height";i:350;s:9:"mime-type";s:10:"image/jpeg";}s:13:"d4p-bbp-thumb";a:4:{s:4:"file";s:31:"fc_placeholder_blue-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(1500, 147, 'amazonS3_cache', 'a:19:{s:80:"http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171.png";i:197;s:123:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/05161146/LINK-สมัคร-web-20171.png";i:197;s:76:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small.jpg";i:117;s:84:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262.jpg";i:117;s:119:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07090317/Talk2017_2_20percent_small.jpg";i:117;s:127:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/01/07090317/Talk2017_2_20percent_small-500x262.jpg";i:117;s:71:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2.jpg";i:161;s:79:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262.jpg";i:161;s:114:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2.jpg";i:161;s:122:"http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/Talk2017_3_20percent2-500x262.jpg";i:161;s:82:"http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171_c.png";a:1:{s:9:"timestamp";i:1499246633;}s:90:"http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171-600x200_c.png";a:1:{s:9:"timestamp";i:1499246579;}s:86:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262_c.jpg";a:1:{s:9:"timestamp";i:1499246633;}s:94:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262-600x200_c.jpg";a:1:{s:9:"timestamp";i:1499246579;}s:81:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262_c.jpg";a:1:{s:9:"timestamp";i:1499246633;}s:89:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262-600x200_c.jpg";a:1:{s:9:"timestamp";i:1499246579;}s:90:"http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171-960x300_c.png";a:1:{s:9:"timestamp";i:1499246633;}s:94:"http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262-960x300_c.jpg";a:1:{s:9:"timestamp";i:1499246633;}s:89:"http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262-960x300_c.jpg";a:1:{s:9:"timestamp";i:1499246633;}}'),
(1501, 147, '_oembed_992a253106e3c2a698a11b9e6f118ab9', '{{unknown}}'),
(1503, 197, 'amazonS3_info', 'a:3:{s:6:"bucket";s:13:"cdc-wordpress";s:3:"key";s:70:"wp-content/uploads/2017/07/05161146/LINK-สมัคร-web-20171.png";s:6:"region";s:14:"ap-southeast-1";}'),
(1504, 137, '_edit_lock', '1499247098:1'),
(1505, 196, '_pingme', '1'),
(1506, 196, '_encloseme', '1') ;

#
# End of data contents of table `wp_postmeta`
# --------------------------------------------------------



#
# Delete any existing table `wp_posts`
#

DROP TABLE IF EXISTS `wp_posts`;


#
# Table structure of table `wp_posts`
#

CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_posts`
#
INSERT INTO `wp_posts` ( `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2016-06-30 09:59:52', '2016-06-30 09:59:52', '<img src="http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262.jpg" alt="" width="500" height="262" class="alignnone size-medium wp-image-161" />\r\n\r\nHello Hello Hello\r\nContent goes here.', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2017-07-04 16:18:00', '2017-07-04 09:18:00', '', 0, 'http://54.254.207.12/?p=1', 0, 'post', '', 3),
(2, 1, '2016-06-30 09:59:52', '2016-06-30 09:59:52', '[profileedit]\r\n\r\n&nbsp;\r\n\r\nThis is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\r\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like piña coladas. (And gettin\' caught in the rain.)</blockquote>\r\n...or something like this:\r\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\r\nAs a new WordPress user, you should go to <a href="http://54.254.207.12/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2016-07-12 16:10:06', '2016-07-12 16:10:06', '', 0, 'http://54.254.207.12/?page_id=2', 0, 'page', '', 0),
(4, 1, '2016-07-01 11:02:25', '2016-07-01 11:02:25', '', 'Shop', '', 'publish', 'closed', 'closed', '', 'shop', '', '', '2016-07-01 11:02:25', '2016-07-01 11:02:25', '', 0, 'http://54.254.207.12/shop/', 0, 'page', '', 0),
(5, 1, '2016-07-01 11:02:25', '2016-07-01 11:02:25', '[woocommerce_cart]', 'Cart', '', 'publish', 'closed', 'closed', '', 'cart', '', '', '2016-07-01 11:02:25', '2016-07-01 11:02:25', '', 0, 'http://54.254.207.12/cart/', 0, 'page', '', 0),
(6, 1, '2016-07-01 11:02:25', '2016-07-01 11:02:25', '[woocommerce_checkout]', 'Checkout', '', 'publish', 'closed', 'closed', '', 'checkout', '', '', '2016-07-01 11:02:25', '2016-07-01 11:02:25', '', 0, 'http://54.254.207.12/checkout/', 0, 'page', '', 0),
(7, 1, '2016-07-01 11:02:25', '2016-07-01 11:02:25', '[woocommerce_my_account]', 'My Account', '', 'publish', 'closed', 'closed', '', 'my-account', '', '', '2016-07-01 11:02:25', '2016-07-01 11:02:25', '', 0, 'http://54.254.207.12/my-account/', 0, 'page', '', 0),
(9, 1, '2016-07-02 11:41:34', '2016-07-02 11:41:34', '[wcm_content_restricted]', 'Content restricted', '', 'publish', 'closed', 'closed', '', 'content-restricted', '', '', '2016-07-02 11:41:34', '2016-07-02 11:41:34', '', 0, 'http://54.254.207.12/content-restricted/', 0, 'page', '', 0),
(10, 1, '2016-07-02 12:24:43', '2016-07-02 12:24:43', '', 'CDClogo2015_rev1_A', '', 'inherit', 'open', 'closed', '', 'cdclogo2015_rev1_a', '', '', '2016-07-02 12:24:43', '2016-07-02 12:24:43', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/CDClogo2015_rev1_A.png', 0, 'attachment', 'image/png', 0),
(11, 1, '2016-07-02 12:24:51', '2016-07-02 12:24:51', 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-CDClogo2015_rev1_A.png', 'cropped-CDClogo2015_rev1_A.png', '', 'inherit', 'open', 'closed', '', 'cropped-cdclogo2015_rev1_a-png', '', '', '2017-07-04 15:48:24', '2017-07-04 08:48:24', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/cropped-CDClogo2015_rev1_A.png', 0, 'attachment', 'image/png', 0),
(12, 1, '2016-07-02 12:25:50', '2016-07-02 12:25:50', '', 'CDClogo2015_rev1100px_A simple copy 2', '', 'inherit', 'open', 'closed', '', 'cdclogo2015_rev1100px_a-simple-copy-2', '', '', '2016-07-02 12:25:50', '2016-07-02 12:25:50', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/CDClogo2015_rev1100px_A-simple-copy-2.png', 0, 'attachment', 'image/png', 0),
(13, 1, '2016-07-02 12:25:56', '2016-07-02 12:25:56', 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093949/cropped-CDClogo2015_rev1100px_A-simple-copy-2.png', 'cropped-CDClogo2015_rev1100px_A-simple-copy-2.png', '', 'inherit', 'open', 'closed', '', 'cropped-cdclogo2015_rev1100px_a-simple-copy-2-png', '', '', '2016-07-02 12:25:56', '2016-07-02 12:25:56', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/cropped-CDClogo2015_rev1100px_A-simple-copy-2.png', 0, 'attachment', 'image/png', 0),
(15, 1, '2016-07-02 12:32:50', '2016-07-02 12:32:50', '', 'CDClogo2015_rev1_A simple copy 2', '', 'inherit', 'open', 'closed', '', 'cdclogo2015_rev1_a-simple-copy-2', '', '', '2016-07-02 12:32:50', '2016-07-02 12:32:50', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/CDClogo2015_rev1_A-simple-copy-2.png', 0, 'attachment', 'image/png', 0),
(16, 1, '2016-07-02 12:32:59', '2016-07-02 12:32:59', 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093947/cropped-CDClogo2015_rev1_A-simple-copy-2.png', 'cropped-CDClogo2015_rev1_A-simple-copy-2.png', '', 'inherit', 'open', 'closed', '', 'cropped-cdclogo2015_rev1_a-simple-copy-2-png', '', '', '2016-07-02 12:32:59', '2016-07-02 12:32:59', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/cropped-CDClogo2015_rev1_A-simple-copy-2.png', 0, 'attachment', 'image/png', 0),
(19, 1, '2016-07-02 12:39:57', '2016-07-02 12:39:57', ' ', '', '', 'publish', 'closed', 'closed', '', '19', '', '', '2016-07-13 04:35:44', '2016-07-13 04:35:44', '', 0, 'http://54.254.207.12/?p=19', 4, 'nav_menu_item', '', 0),
(22, 1, '2016-07-02 13:23:15', '2016-07-02 13:23:15', '', 'Supporting', '', 'publish', 'closed', 'closed', '', 'supporting', '', '', '2016-07-02 16:16:31', '2016-07-02 16:16:31', '', 0, 'http://www.cupandhandle.co/?post_type=wc_membership_plan&#038;p=22', 0, 'wc_membership_plan', '', 0),
(23, 1, '2016-07-02 13:26:22', '2016-07-02 13:26:22', 'สมัครเพื่อเป็นสมาชิกสนับสนุนของชมรมโฉลกดอทคอม!\r\n\r\nชมรมของเราสามารถอยู่ได้ด้วยการสนับสนุนของสมาชิกทุกคน\r\n\r\nร่วมกันสนับสนุนทีมงานของชมรมเพียง 1,296 บาท ต่อ ปี\r\n(หรือเท่ากับเดือนละ 108 บาท)\r\n\r\nสมาชิกสนับสนุนจะได้นับสิทธิประโยชน์ดังนี้\r\n<ol>\r\n 	<li>สามารถใช้งาน CDC Downloader เพื่อ update ข้อมูลราคาหุ้นและสินค้าต่างๆใน Metastock ได้ (end of day data)</li>\r\n 	<li>รับส่วนลดในการสมัครคอร์ส และงานสัมมนาต่างๆ 10% หรือมากกว่า</li>\r\n 	<li>รับส่วนลดในการสมัครคอร์ส webinar 10%</li>\r\n 	<li>รับส่วนลดในการซื้อบทเรียนออนไลน์ 10% (ใช้ coupon code)</li>\r\n</ol>\r\nการสมัครสมาชิกด้วยเงินสดนั้น เหมือนกับการจ่ายด้วยบัตรเครดิตทุกประการ เพียงแต่จะไม่มีการตัดเงินอัตโนมัติ ซึ่งจะหมายความว่าสมาชิกจะต้องทำการต่ออายุสมาชิกด้วยตนเอง โดยจะมีจดหมายแจ้งเตือนวันหมดอายุสมาชิกทาง email ล่วงหน้า 30 วัน ก่อนถึงวันหมดอายุ\r\n* ในกรณีที่ต่ออายุก่อนอายุสมาชิกเดิมสิ้นสุด อายุสมาชิกใหม่จะถูกนำมาบวกเพิ่มจากอายุสมาชิกเดิม หมายความว่า สมาชิกสามารถที่จะทำการต่ออายุสมาชิกเมื่อใดก็ได้โดยไม่มีการเสียโอกาสใดๆ', 'Supporting Membership (จ่ายด้วยเงินสด)', '', 'publish', 'closed', 'closed', '', 'supporting-membership-2', '', '', '2016-07-04 11:15:51', '2016-07-04 11:15:51', '', 0, 'http://www.cupandhandle.co/?post_type=product&#038;p=23', 0, 'product', '', 0),
(25, 1, '2016-07-02 13:28:08', '2016-07-02 13:28:08', '', 'Order &ndash; July 2, 2016 @ 01:28 PM', '', 'wc-completed', 'open', 'closed', 'order_5777c1687250e', 'order-jul-02-2016-0128-pm', '', '', '2016-07-02 13:28:24', '2016-07-02 13:28:24', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=25', 0, 'shop_order', '', 2),
(27, 1, '2016-07-02 13:33:20', '2016-07-02 13:33:20', '', 'CDC Membership', '', 'inherit', 'open', 'closed', '', 'cdc-membership', '', '', '2016-07-02 13:33:20', '2016-07-02 13:33:20', '', 23, 'http://54.254.207.12/wp-content/uploads/2016/07/CDC-Membership.png', 0, 'attachment', 'image/png', 0),
(28, 1, '2016-07-04 10:59:08', '2016-07-04 10:59:08', 'สมัครเพื่อเป็นสมาชิกสนับสนุนของชมรมโฉลกดอทคอม!\n\nชมรมของเราสามารถอยู่ได้ด้วยการสนับสนุนของสมาชิกทุกคน\n\nร่วมกันสนับสนุนทีมงานของชมรมเพียง 1,296 บาท ต่อ ปี\n(หรือเท่ากับเดือนละ 108 บาท)\n\nสมาชิกสนับสนุนจะได้นับสิทธิประโยชน์ดังนี้\n<ol>\n 	<li>สามารถใช้งาน CDC Downloader เพื่อ update ข้อมูลราคาหุ้นและสินค้าต่างๆใน Metastock ได้ (end of day data)</li>\n 	<li>รับส่วนลดในการสมัครคอร์ส และงานสัมมนาต่างๆ 10% หรือมากกว่า</li>\n 	<li>รับส่วนลดในการสมัครคอร์ส webinar 10%</li>\n 	<li>รับส่วนลดในการซื้อบทเรียนออนไลน์ 10% (ใช้ coupon code)</li>\n</ol>\nการสมัครสมาชิกด้วยเงินสดนั้น เหมือนกับการจ่ายด้วยบัตรเครดิตทุกประการ เพียงแต่จะไม่มีการตัดเงินอัตโนมัติ ซึ่งจะหมายความว่าสมาชิกจะต้องทำการต่ออายุสมาชิกด้วยตนเอง โดยจะมีจดหมายแจ้งเตือนวันหมดอายุสมาชิกทาง email ล่วงหน้า 30 วัน ก่อนถึงวันหมดอายุ\n* ในกรณีที่ต่ออายุก่อนอายุสมาชิกเดิมสิ้นสุด อายุสมาชิกใหม่จะถูกนำมา', 'Supporting Membership (จ่ายด้วยเงินสด)', '', 'inherit', 'closed', 'closed', '', '23-autosave-v1', '', '', '2016-07-04 10:59:08', '2016-07-04 10:59:08', '', 23, 'http://54.254.207.12/2016/07/02/23-autosave-v1/', 0, 'revision', '', 0),
(30, 1, '2016-07-02 13:58:57', '2016-07-02 13:58:57', '<img class="alignnone size-medium wp-image-29" src="http://54.254.207.12/wp-content/uploads/2016/06/MS-EOD-300x200.png" alt="MS-EOD" width="300" height="200" />Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2016-07-02 13:58:57', '2016-07-02 13:58:57', '', 1, 'http://54.254.207.12/2016/07/02/1-revision-v1/', 0, 'revision', '', 0),
(31, 1, '2016-07-02 14:47:32', '2016-07-02 14:47:32', '', 'CDCDL', '', 'inherit', 'open', 'closed', '', 'cdcdl', '', '', '2016-07-02 14:47:32', '2016-07-02 14:47:32', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/CDCDL.jpg', 0, 'attachment', 'image/jpeg', 0),
(32, 1, '2016-07-02 16:32:48', '2016-07-02 16:32:48', '', 'MS-EOD', '', 'inherit', 'open', 'closed', '', 'ms-eod', '', '', '2016-07-02 16:32:48', '2016-07-02 16:32:48', '', 1, 'http://54.254.207.12/wp-content/uploads/2016/06/MS-EOD.png', 0, 'attachment', 'image/png', 0),
(33, 1, '2016-07-02 16:32:56', '2016-07-02 16:32:56', '<img class="alignnone size-medium wp-image-32" src="http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/06/02163248/MS-EOD-300x200.png" alt="MS-EOD" width="300" height="200" />', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2016-07-02 16:32:56', '2016-07-02 16:32:56', '', 1, 'http://54.254.207.12/2016/07/02/1-revision-v1/', 0, 'revision', '', 0),
(38, 1, '2016-07-04 10:33:11', '2016-07-04 10:33:11', 'สมัครเพื่อเป็นสมาชิกสนับสนุนของชมรมโฉลกดอทคอม!\r\n\r\nชมรมของเราสามารถอยู่ได้ด้วยการสนับสนุนของสมาชิกทุกคน\r\n\r\nร่วมกันสนับสนุนทีมงานของชมรมเพียง 1,296 บาท ต่อ ปี\r\n(หรือเท่ากับเดือนละ 108 บาท)\r\n\r\nสมาชิกสนับสนุนจะได้นับสิทธิประโยชน์ดังนี้\r\n<ol>\r\n 	<li>สามารถใช้งาน CDC Downloader เพื่อ update ข้อมูลราคาหุ้นและสินค้าต่างๆใน Metastock ได้ (end of day data)</li>\r\n 	<li>รับส่วนลดในการสมัครคอร์ส และงานสัมมนาต่างๆ 10% หรือมากกว่า</li>\r\n 	<li>รับส่วนลดในการสมัครคอร์ส webinar 10%</li>\r\n 	<li>รับส่วนลดในการซื้อบทเรียนออนไลน์ 10% (ใช้ coupon code)</li>\r\n</ol>\r\nสำหรับผู้ที่สมัครสมาชิกสนับสนุนด้วยบัตรเครดิต จะสามารถเลือกที่จะให้ทางชมรม ทำการตัดค่าสมาชิกรายปีอัตโนมัติ\r\nโดยจะมีการแจ้งเตือนก่อนล่วงหน้า 30 วัน ก่อนการตัดบัตรทุกครั้ง\r\n\r\nในกรณีที่สมาชิกเลือกชำระด้วยเงินสด สมาชิกจะต้องต่ออายุด้วยตนเองทุกครั้ง โดยจะมีจดหมายแจ้งเตือนล่วงหน้า 30 วันก่อนหมดอายุสมาชิก', 'Supporting Membership', '', 'private', 'open', 'closed', '', 'supporting-membership', '', '', '2017-01-07 11:56:12', '2017-01-07 11:56:12', '', 0, 'http://54.254.207.12/?post_type=product&#038;p=38', 0, 'product', '', 0),
(39, 1, '2016-07-04 11:11:03', '2016-07-04 11:11:03', 'สมัครเพื่อเป็นสมาชิกสนับสนุนของชมรมโฉลกดอทคอม!\n\nชมรมของเราสามารถอยู่ได้ด้วยการสนับสนุนของสมาชิกทุกคน\n\nร่วมกันสนับสนุนทีมงานของชมรมเพียง 1,296 บาท ต่อ ปี\n(หรือเท่ากับเดือนละ 108 บาท)\n\nสมาชิกสนับสนุนจะได้นับสิทธิประโยชน์ดังนี้\n<ol>\n 	<li>สามารถใช้งาน CDC Downloader เพื่อ update ข้อมูลราคาหุ้นและสินค้าต่างๆใน Metastock ได้ (end of day data)</li>\n 	<li>รับส่วนลดในการสมัครคอร์ส และงานสัมมนาต่างๆ 10% หรือมากกว่า</li>\n 	<li>รับส่วนลดในการสมัครคอร์ส webinar 10%</li>\n 	<li>รับส่วนลดในการซื้อบทเรียนออนไลน์ 10% (ใช้ coupon code)</li>\n</ol>\nสำหรับผู้ที่สมัครสมาชิกสนับสนุนด้วยบัตรเครดิต จะสามารถเลือกที่จะให้ทางชมรม ทำการตัดค่าสมาชิกรายปีอัตโนมัติ\nโดยจะมีการแจ้งเตือนก่อนล่วงหน้า 30 วัน ก่อนการตัดบัตรทุกครั้ง\n\nในกรณีที่สมาชิกเลือกชำระด้วยเงินสด สมาชิกจะต้องต่ออายุด้วยตนเองทุกครั้ง โดยจะมีจดหมายแจ้งเตือนล่วงหน้า 30 วันก่อนหมดอายุสมาชิก', 'Supporting Membership', '', 'inherit', 'closed', 'closed', '', '38-autosave-v1', '', '', '2016-07-04 11:11:03', '2016-07-04 11:11:03', '', 38, 'http://54.254.207.12/2016/07/04/38-autosave-v1/', 0, 'revision', '', 0),
(40, 1, '2016-07-04 10:34:37', '2016-07-04 10:34:37', '', 'MS11', '', 'inherit', 'open', 'closed', '', 'ms11', '', '', '2016-07-04 10:34:37', '2016-07-04 10:34:37', '', 38, 'http://54.254.207.12/wp-content/uploads/2016/07/MS11.jpg', 0, 'attachment', 'image/jpeg', 0),
(41, 1, '2016-07-04 10:34:38', '2016-07-04 10:34:38', '', 'CDC ADV MS', '', 'inherit', 'open', 'closed', '', 'cdc-adv-ms', '', '', '2016-07-04 10:34:38', '2016-07-04 10:34:38', '', 38, 'http://54.254.207.12/wp-content/uploads/2016/07/CDC-ADV-MS.png', 0, 'attachment', 'image/png', 0),
(42, 1, '2016-07-04 10:34:41', '2016-07-04 10:34:41', '', 'CDC BASIC MS', '', 'inherit', 'open', 'closed', '', 'cdc-basic-ms', '', '', '2016-07-04 10:34:41', '2016-07-04 10:34:41', '', 38, 'http://54.254.207.12/wp-content/uploads/2016/07/CDC-BASIC-MS.png', 0, 'attachment', 'image/png', 0),
(43, 1, '2016-07-04 10:34:42', '2016-07-04 10:34:42', '', 'CDC Membership', '', 'inherit', 'open', 'closed', '', 'cdc-membership-2', '', '', '2016-07-04 10:34:42', '2016-07-04 10:34:42', '', 38, 'http://54.254.207.12/wp-content/uploads/2016/07/CDC-Membership1.png', 0, 'attachment', 'image/png', 0),
(47, 1, '2016-07-04 11:11:51', '2016-07-04 11:11:51', '', 'Order &ndash; July 4, 2016 @ 11:11 AM', '', 'wc-completed', 'open', 'closed', 'order_577a4477480d9', 'order-jul-04-2016-1111-am', '', '', '2016-07-04 11:12:36', '2016-07-04 11:12:36', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=47', 0, 'shop_order', '', 2),
(52, 1, '2016-07-04 11:14:24', '2016-07-04 11:14:24', '', 'Order &ndash; July 4, 2016 @ 11:14 AM', '', 'wc-completed', 'open', 'closed', 'order_577a451080e90', 'order-jul-04-2016-1114-am', '', '', '2016-07-04 11:14:28', '2016-07-04 11:14:28', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=52', 0, 'shop_order', '', 2),
(55, 1, '2016-07-04 11:16:22', '2016-07-04 11:16:22', '', 'Order &ndash; July 4, 2016 @ 11:16 AM', '', 'wc-completed', 'open', 'closed', 'order_577a4586a3ff5', 'order-jul-04-2016-1116-am', '', '', '2016-07-04 11:16:30', '2016-07-04 11:16:30', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=55', 0, 'shop_order', '', 2),
(56, 1, '2016-07-04 11:20:06', '2016-07-04 11:20:06', '', 'Order &ndash; July 4, 2016 @ 11:20 AM', '', 'wc-completed', 'open', 'closed', 'order_577a4666813f0', 'order-jul-04-2016-1120-am', '', '', '2016-07-04 11:20:11', '2016-07-04 11:20:11', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=56', 0, 'shop_order', '', 2),
(60, 1, '2016-07-04 11:22:11', '2016-07-04 11:22:11', '', 'Order &ndash; July 4, 2016 @ 11:22 AM', '', 'wc-completed', 'open', 'closed', 'order_577a46e3afdcf', 'order-jul-04-2016-1122-am', '', '', '2016-07-04 11:22:10', '2016-07-04 11:22:10', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=60', 0, 'shop_order', '', 2),
(62, 1, '2016-07-04 11:23:05', '2016-07-04 11:23:05', '', 'Order &ndash; July 4, 2016 @ 11:23 AM', '', 'wc-completed', 'open', 'closed', 'order_577a47196e9c3', 'order-jul-04-2016-1123-am', '', '', '2016-07-04 11:23:14', '2016-07-04 11:23:14', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=62', 0, 'shop_order', '', 2),
(66, 1, '2016-07-04 13:01:57', '2016-07-04 13:01:57', '', 'Order &ndash; July 4, 2016 @ 01:01 PM', '', 'wc-on-hold', 'open', 'closed', 'order_577a597b39d06', 'order-jul-04-2016-1241-pm', '', '', '2016-07-04 13:01:57', '2016-07-04 13:01:57', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=66', 0, 'shop_order', '', 1),
(68, 1, '2016-07-04 13:01:56', '2016-07-04 13:01:56', '', 'Subscription &ndash; Jul 04, 2016 @ 01:01 PM', '', 'wc-on-hold', 'open', 'closed', 'order_577a5e4532a08', 'subscription-jul-04-2016-0101-pm', '', '', '2016-07-04 13:01:57', '2016-07-04 13:01:57', '', 66, 'http://www.cupandhandle.co/?post_type=shop_subscription&#038;p=68', 0, 'shop_subscription', '', 1),
(69, 1, '2016-07-05 05:09:12', '2016-07-05 05:09:12', '', 'Order &ndash; July 5, 2016 @ 05:09 AM', '', 'wc-on-hold', 'open', 'closed', 'order_577b40f8151b7', 'order-jul-05-2016-0509-am', '', '', '2016-07-05 05:09:12', '2016-07-05 05:09:12', '', 0, 'http://www.cupandhandle.co/?post_type=shop_order&#038;p=69', 0, 'shop_order', '', 1),
(72, 1, '2016-07-12 05:18:02', '2016-07-12 05:18:02', 'Members are encourage to talk, discuss, share and even questions trading ideas and other activities. The forum is also home to our merit making circle, because because ;)', 'CDC Forums', '', 'publish', 'closed', 'open', '', 'cdc', '', '', '2016-07-12 07:34:12', '2016-07-12 07:34:12', '', 0, 'http://54.254.207.12/?post_type=forum&#038;p=72', 0, 'forum', '', 0),
(73, 1, '2016-07-12 05:18:02', '2016-07-12 05:18:02', 'Members are encourage to talk, discuss, share and even questions trading ideas and other activities. The forum is also home to our merit making circle, because because ;)', 'CDC Forums', '', 'inherit', 'closed', 'closed', '', '72-revision-v1', '', '', '2016-07-12 05:18:02', '2016-07-12 05:18:02', '', 72, 'http://54.254.207.12/2016/07/12/72-revision-v1/', 0, 'revision', '', 0),
(74, 1, '2016-07-12 05:20:04', '2016-07-12 05:20:04', 'ประกาศต่างๆจากทางชมรม กำหนดการ ตารางการจัดอบรม ตารางกิจกรรม และคำถามที่พบบ่อย ทั้งหมดสามารถอ่านได้จากที่นี่ครับ', 'Official Announcement and FAQ', '', 'publish', 'closed', 'open', '', 'official-announcement-and-faq', '', '', '2016-07-12 05:20:04', '2016-07-12 05:20:04', '', 72, 'http://54.254.207.12/?post_type=forum&#038;p=74', 0, 'forum', '', 0),
(75, 1, '2016-07-12 05:20:04', '2016-07-12 05:20:04', 'ประกาศต่างๆจากทางชมรม กำหนดการ ตารางการจัดอบรม ตารางกิจกรรม และคำถามที่พบบ่อย ทั้งหมดสามารถอ่านได้จากที่นี่ครับ', 'Official Announcement and FAQ', '', 'inherit', 'closed', 'closed', '', '74-revision-v1', '', '', '2016-07-12 05:20:04', '2016-07-12 05:20:04', '', 74, 'http://54.254.207.12/2016/07/12/74-revision-v1/', 0, 'revision', '', 0),
(76, 1, '2016-07-12 05:21:16', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2016-07-12 05:21:16', '0000-00-00 00:00:00', '', 0, 'http://54.254.207.12/?p=76', 1, 'nav_menu_item', '', 0),
(77, 1, '2016-07-12 05:21:49', '2016-07-12 05:21:49', '', 'Forums', '', 'publish', 'closed', 'closed', '', 'forums', '', '', '2016-07-13 04:35:44', '2016-07-13 04:35:44', '', 0, 'http://54.254.207.12/?p=77', 2, 'nav_menu_item', '', 0),
(79, 1, '2016-07-12 05:26:31', '2016-07-12 05:26:31', 'ห้องนั่งเล่นของสมาชิกโฉลกดอทคอม\r\n\r\nพูดคุย แลกเปลี่ยนความคิดเห็น และพบปะเพื่อนใหม่ๆได้ที่นี่', 'The Living Room', '', 'publish', 'closed', 'open', '', 'the-living-room', '', '', '2016-07-12 05:26:39', '2016-07-12 05:26:39', '', 72, 'http://54.254.207.12/?post_type=forum&#038;p=79', 1, 'forum', '', 0),
(80, 1, '2016-07-12 05:26:31', '2016-07-12 05:26:31', 'ห้องนั่งเล่นของสมาชิกโฉลกดอทคอม\r\n\r\nพูดคุย แลกเปลี่ยนความคิดเห็น และพบปะเพื่อนใหม่ๆได้ที่นี่', 'The Living Room', '', 'inherit', 'closed', 'closed', '', '79-revision-v1', '', '', '2016-07-12 05:26:31', '2016-07-12 05:26:31', '', 79, 'http://54.254.207.12/2016/07/12/79-revision-v1/', 0, 'revision', '', 0),
(81, 1, '2016-07-12 05:28:15', '2016-07-12 05:28:15', 'ลานทำบุญของชาวโฉลกดอทคอม ใครอยากทำบุญเข้ามาหางานบุญ ใครมีงานบุญก็เข้ามาบอกบุญกันได้ครับ', 'ลานบุญ', '', 'publish', 'closed', 'open', '', 'charity', '', '', '2016-07-12 05:28:15', '2016-07-12 05:28:15', '', 72, 'http://54.254.207.12/?post_type=forum&#038;p=81', 2, 'forum', '', 0),
(82, 1, '2016-07-12 05:28:15', '2016-07-12 05:28:15', 'ลานทำบุญของชาวโฉลกดอทคอม ใครอยากทำบุญเข้ามาหางานบุญ ใครมีงานบุญก็เข้ามาบอกบุญกันได้ครับ', 'ลานบุญ', '', 'inherit', 'closed', 'closed', '', '81-revision-v1', '', '', '2016-07-12 05:28:15', '2016-07-12 05:28:15', '', 81, 'http://54.254.207.12/2016/07/12/81-revision-v1/', 0, 'revision', '', 0),
(86, 1, '2016-07-12 07:54:54', '2016-07-12 07:54:54', '', 'Screenshot_2014-02-08-10-34-47', '', 'inherit', 'open', 'closed', '', 'screenshot_2014-02-08-10-34-47', '', '', '2016-07-12 07:54:54', '2016-07-12 07:54:54', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/Screenshot_2014-02-08-10-34-47.jpg', 0, 'attachment', 'image/jpeg', 0),
(87, 1, '2016-07-12 07:55:01', '2016-07-12 07:55:01', '', 'CDClogo2015_rev1_A', '', 'inherit', 'open', 'closed', '', 'cdclogo2015_rev1_a-2', '', '', '2016-07-12 07:55:01', '2016-07-12 07:55:01', '', 0, 'http://54.254.207.12/wp-content/uploads/2016/07/CDClogo2015_rev1_A1.png', 0, 'attachment', 'image/png', 0),
(91, 1, '2016-07-12 13:00:29', '2016-07-12 13:00:29', '', 'bitcoin', '', 'inherit', 'open', 'closed', '', 'bitcoin', '', '', '2017-07-04 16:25:27', '2017-07-04 09:25:27', '', 178, 'http://54.254.207.12/forums/reply/89/bitcoin/', 0, 'attachment', 'image/jpeg', 0),
(94, 1, '2016-07-12 13:39:12', '2016-07-12 13:39:12', ' ', '', '', 'publish', 'closed', 'closed', '', '94', '', '', '2016-07-13 04:35:44', '2016-07-13 04:35:44', '', 72, 'http://54.254.207.12/?p=94', 3, 'nav_menu_item', '', 0),
(96, 1, '2016-07-12 16:10:06', '2016-07-12 16:10:06', '[profileedit]\r\n\r\n&nbsp;\r\n\r\nThis is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\r\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like piña coladas. (And gettin\' caught in the rain.)</blockquote>\r\n...or something like this:\r\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\r\nAs a new WordPress user, you should go to <a href="http://54.254.207.12/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2016-07-12 16:10:06', '2016-07-12 16:10:06', '', 2, 'http://54.254.207.12/2016/07/12/2-revision-v1/', 0, 'revision', '', 0),
(97, 1, '2016-07-12 16:10:11', '2016-07-12 16:10:11', '[profileedit]\r\n\r\n&nbsp;\r\n\r\nThis is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\r\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like piña coladas. (And gettin\' caught in the rain.)</blockquote>\r\n...or something like this:\r\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\r\nAs a new WordPress user, you should go to <a href="http://54.254.207.12/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'inherit', 'closed', 'closed', '', '2-autosave-v1', '', '', '2016-07-12 16:10:11', '2016-07-12 16:10:11', '', 2, 'http://54.254.207.12/2016/07/12/2-autosave-v1/', 0, 'revision', '', 0),
(99, 1, '2016-07-12 17:09:18', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2016-07-12 17:09:18', '0000-00-00 00:00:00', '', 0, 'http://54.254.207.12/?p=99', 1, 'nav_menu_item', '', 0),
(100, 1, '2016-07-12 17:09:18', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2016-07-12 17:09:18', '0000-00-00 00:00:00', '', 72, 'http://54.254.207.12/?p=100', 1, 'nav_menu_item', '', 0),
(101, 1, '2016-07-12 17:09:18', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2016-07-12 17:09:18', '0000-00-00 00:00:00', '', 72, 'http://54.254.207.12/?p=101', 1, 'nav_menu_item', '', 0),
(102, 1, '2016-07-12 17:09:18', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2016-07-12 17:09:18', '0000-00-00 00:00:00', '', 72, 'http://54.254.207.12/?p=102', 1, 'nav_menu_item', '', 0),
(103, 1, '2016-07-13 04:35:44', '2016-07-13 04:35:44', '', 'Home', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2016-07-13 04:35:44', '2016-07-13 04:35:44', '', 0, 'http://54.254.207.12/?p=103', 1, 'nav_menu_item', '', 0),
(104, 1, '2016-07-19 11:49:47', '2016-07-19 11:49:47', 'ประกาศต่างๆจากทางชมรม กำหนดการ ตารางการจัดอบรม ตารางกิจกรรม และคำถามที่พบบ่อย ทั้งหมดสามารถอ่านได้จากที่นี่ครับ', 'Official Announcement and FAQ', '', 'inherit', 'closed', 'closed', '', '74-autosave-v1', '', '', '2016-07-19 11:49:47', '2016-07-19 11:49:47', '', 74, 'http://54.254.207.12/2016/07/19/74-autosave-v1/', 0, 'revision', '', 0),
(105, 1, '2016-07-19 11:51:58', '2016-07-19 11:51:58', 'Guess I should see that fixed!', 'Oh no! Topic is wonky', '', 'publish', 'closed', 'closed', '', 'oh-no-topic-is-wonky', '', '', '2016-07-19 11:51:58', '2016-07-19 11:51:58', '', 79, 'http://54.254.207.12/forums/topic/oh-no-topic-is-wonky/', 0, 'topic', '', 0),
(110, 0, '2017-03-01 02:40:25', '2017-03-01 02:40:25', '[]', 'woocommerce_subscriptions_clear_upgrade_log', '', 'pending', 'open', 'closed', '', '', '', '', '2017-03-01 02:40:25', '2017-03-01 02:40:25', '', 0, '/?post_type=scheduled-action&p=110', 0, 'scheduled-action', '', 1),
(113, 1, '2017-01-07 08:26:48', '2017-01-07 08:26:48', '', 'Soliloquy Default Settings', '', 'publish', 'closed', 'closed', '', 'soliloquy-default-slider', '', '', '2017-01-07 08:26:48', '2017-01-07 08:26:48', '', 0, '/?post_type=soliloquy&p=113', 0, 'soliloquy', '', 0),
(116, 1, '2017-01-07 09:48:50', '2017-01-07 09:48:50', '', 'frontpage', '', 'publish', 'closed', 'closed', '', 'frontpage', '', '', '2017-01-07 23:16:09', '2017-01-07 16:16:09', '', 0, '/?post_type=soliloquy&#038;p=116', 0, 'soliloquy', '', 0),
(117, 1, '2017-01-07 09:03:17', '2017-01-07 09:03:17', '', 'Talk2017_2_20percent_small', '', 'inherit', 'open', 'closed', '', 'talk2017_2_20percent_small', '', '', '2017-01-07 09:03:17', '2017-01-07 09:03:17', '', 116, '/wp-content/uploads/2017/01/Talk2017_2_20percent_small.jpg', 0, 'attachment', 'image/jpeg', 0),
(118, 1, '2017-01-07 09:49:23', '2017-01-07 09:49:23', '', 'cdc_amibroker2016_2', '', 'inherit', 'open', 'closed', '', 'cdc_amibroker2016_2', '', '', '2017-01-07 09:49:23', '2017-01-07 09:49:23', '', 116, '/wp-content/uploads/2017/01/cdc_amibroker2016_2.jpg', 0, 'attachment', 'image/jpeg', 0),
(119, 1, '2017-01-07 09:51:50', '0000-00-00 00:00:00', '{\n    "custom_css[storefront]": {\n        "value": "/*\\nYou can add your own CSS here.\\n\\nClick the help icon above to learn more.\\n*/\\n",\n        "type": "custom_css",\n        "user_id": 1\n    }\n}', '', '', 'auto-draft', 'closed', 'closed', '', '6685a5ae-9aa2-4c9e-a817-a2957cd82e5c', '', '', '2017-01-07 09:51:50', '0000-00-00 00:00:00', '', 0, '/?p=119', 0, 'customize_changeset', '', 0),
(120, 1, '2017-01-07 09:53:41', '2017-01-07 09:53:41', '', 'cdc_amibroker2016_21', '', 'inherit', 'open', 'closed', '', 'cdc_amibroker2016_21', '', '', '2017-01-07 09:53:41', '2017-01-07 09:53:41', '', 116, '/wp-content/uploads/2017/01/cdc_amibroker2016_21.jpg', 0, 'attachment', 'image/jpeg', 0),
(121, 1, '2017-01-07 10:01:53', '0000-00-00 00:00:00', '{\n    "show_on_front": {\n        "value": "page",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'auto-draft', 'closed', 'closed', '', 'eecd27f2-c0e5-4439-a4bc-57c60fe2a3ce', '', '', '2017-01-07 10:01:53', '0000-00-00 00:00:00', '', 0, '/?p=121', 0, 'customize_changeset', '', 0),
(122, 1, '2017-01-07 10:10:19', '0000-00-00 00:00:00', '', 'Home', '', 'draft', 'closed', 'closed', '', '', '', '', '2017-01-07 10:10:19', '2017-01-07 10:10:19', '', 0, '/?page_id=122', 0, 'page', '', 0),
(123, 1, '2017-01-07 10:08:38', '2017-01-07 10:08:38', '[soliloquy id="116"]', 'Home', '', 'inherit', 'closed', 'closed', '', '122-revision-v1', '', '', '2017-01-07 10:08:38', '2017-01-07 10:08:38', '', 122, '/2017/01/07/122-revision-v1/', 0, 'revision', '', 0),
(124, 1, '2017-01-07 10:09:31', '2017-01-07 10:09:31', '', 'Home', '', 'inherit', 'closed', 'closed', '', '122-revision-v1', '', '', '2017-01-07 10:09:31', '2017-01-07 10:09:31', '', 122, '/2017/01/07/122-revision-v1/', 0, 'revision', '', 0),
(125, 1, '2017-01-07 10:22:24', '2017-01-07 10:22:24', '{\n    "storefront::sbc_post_layout_homepage": {\n        "value": "meta-inline-bottom",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sbc_homepage_blog_columns": {\n        "value": "1",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '2f1015f7-5151-42d1-af95-72abe8d8e98f', '', '', '2017-01-07 10:22:24', '2017-01-07 10:22:24', '', 0, '/2017/01/07/2f1015f7-5151-42d1-af95-72abe8d8e98f/', 0, 'customize_changeset', '', 0),
(126, 1, '2017-01-07 10:23:28', '2017-01-07 10:23:28', '{\n    "storefront::storefront_layout": {\n        "value": "right",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sd_max_width": {\n        "value": "false",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'e2767465-815a-48e7-9e0e-90259244819e', '', '', '2017-01-07 10:23:28', '2017-01-07 10:23:28', '', 0, '/2017/01/07/e2767465-815a-48e7-9e0e-90259244819e/', 0, 'customize_changeset', '', 0),
(127, 1, '2017-01-07 13:12:50', '2017-01-07 13:12:50', '{\n    "old_sidebars_widgets_data": {\n        "value": {\n            "wp_inactive_widgets": [\n                "pages-3",\n                "pages-4",\n                "calendar-3",\n                "calendar-4",\n                "meta-2",\n                "search-2",\n                "categories-2",\n                "recent-posts-4",\n                "recent-comments-2",\n                "rss-3",\n                "bbp_login_widget-3",\n                "bbp_login_widget-4",\n                "bbp_replies_widget-3"\n            ],\n            "sidebar-1": [\n                "search-4",\n                "bbp_topics_widget-6",\n                "facebook-likebox-2",\n                "wpcom_social_media_icons_widget-2",\n                "archives-2"\n            ],\n            "header-1": [\n\n            ],\n            "footer-1": [\n                "bbp_forums_widget-3",\n                "nav_menu-3"\n            ],\n            "footer-2": [\n                "bbp_topics_widget-4"\n            ],\n            "footer-3": [\n                "bbp_topics_widget-3"\n            ],\n            "footer-4": [\n                "bbp_topics_widget-5",\n                "blog_subscription-2"\n            ]\n        },\n        "type": "global_variable",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '15868129-5582-4dc6-8cd7-f7c11c5b6eb7', '', '', '2017-01-07 13:12:50', '2017-01-07 13:12:50', '', 0, '/?p=127', 0, 'customize_changeset', '', 0),
(128, 1, '2017-01-07 13:21:47', '2017-01-07 13:21:47', '{\n    "old_sidebars_widgets_data": {\n        "value": {\n            "wp_inactive_widgets": [\n                "pages-3",\n                "pages-4",\n                "calendar-3",\n                "calendar-4",\n                "meta-2",\n                "search-2",\n                "categories-2",\n                "recent-posts-4",\n                "recent-comments-2",\n                "rss-3",\n                "bbp_login_widget-3",\n                "bbp_login_widget-4",\n                "bbp_replies_widget-3"\n            ],\n            "sidebar-1": [\n                "search-4",\n                "bbp_topics_widget-6",\n                "facebook-likebox-2",\n                "wpcom_social_media_icons_widget-2",\n                "archives-2"\n            ],\n            "header-1": [\n\n            ],\n            "footer-1": [\n                "bbp_forums_widget-3",\n                "nav_menu-3"\n            ],\n            "footer-2": [\n                "bbp_topics_widget-4"\n            ],\n            "footer-3": [\n                "bbp_topics_widget-3"\n            ],\n            "footer-4": [\n                "bbp_topics_widget-5",\n                "blog_subscription-2"\n            ]\n        },\n        "type": "global_variable",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '13743b5f-6ca2-42bc-97b0-0e06187017ff', '', '', '2017-01-07 13:21:47', '2017-01-07 13:21:47', '', 0, '/2017/01/07/13743b5f-6ca2-42bc-97b0-0e06187017ff/', 0, 'customize_changeset', '', 0),
(130, 1, '2017-01-07 13:38:22', '0000-00-00 00:00:00', '{\n    "storefront::sp_homepage_content": {\n        "value": true,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_categories": {\n        "value": true,\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'auto-draft', 'closed', 'closed', '', '9372d074-5426-4812-86f0-3bb244e997fb', '', '', '2017-01-07 13:38:22', '0000-00-00 00:00:00', '', 0, '/?p=130', 0, 'customize_changeset', '', 0),
(131, 1, '2017-01-07 15:13:03', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2017-01-07 15:13:03', '0000-00-00 00:00:00', '', 0, '/?p=131', 0, 'post', '', 0),
(132, 1, '2017-01-07 15:29:05', '0000-00-00 00:00:00', '{\n    "storefront::nav_menu_locations[secondary]": {\n        "value": 7,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::nav_menu_locations[primary]": {\n        "value": 6,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_header_setting": {\n        "value": "%7B%7D",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_content_frame": {\n        "value": "default",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_header_sticky": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'auto-draft', 'closed', 'closed', '', 'ebfc6802-8f09-45b0-9d35-c71f36e95813', '', '', '2017-01-07 15:32:20', '2017-01-07 15:32:20', '', 0, 'http://52.76.37.90/?p=132', 0, 'customize_changeset', '', 0),
(133, 1, '2017-01-07 22:38:00', '2017-01-07 15:38:00', '[soliloquy id="116"]', 'Home Page', '', 'publish', 'closed', 'closed', '', 'home-page', '', '', '2017-01-07 22:44:03', '2017-01-07 15:44:03', '', 0, 'http://52.76.37.90/?page_id=133', 0, 'page', '', 0),
(134, 1, '2017-01-07 22:38:00', '2017-01-07 15:38:00', 'Helloooo Geronimo!', 'Home Page', '', 'inherit', 'closed', 'closed', '', '133-revision-v1', '', '', '2017-01-07 22:38:00', '2017-01-07 15:38:00', '', 133, 'http://52.76.37.90/2017/01/07/133-revision-v1/', 0, 'revision', '', 0),
(135, 1, '2017-01-07 22:39:29', '2017-01-07 15:39:29', '{\n    "show_on_front": {\n        "value": "page",\n        "type": "option",\n        "user_id": 1\n    },\n    "page_on_front": {\n        "value": "133",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'ff5b4dcc-69cd-4b04-b030-ea02068c2e86', '', '', '2017-01-07 22:39:29', '2017-01-07 15:39:29', '', 0, 'http://52.76.37.90/2017/01/07/ff5b4dcc-69cd-4b04-b030-ea02068c2e86/', 0, 'customize_changeset', '', 0),
(136, 1, '2017-01-07 22:41:04', '2017-01-07 15:41:04', '{\n    "storefront::sp_homepage_content": {\n        "value": true,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_categories": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_recent": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_featured": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_top_rated": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_on_sale": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_homepage_best_sellers": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'edafa216-9e95-4c86-8806-6d52d9276e9f', '', '', '2017-01-07 22:41:04', '2017-01-07 15:41:04', '', 0, 'http://52.76.37.90/?p=136', 0, 'customize_changeset', '', 0),
(137, 1, '2017-01-07 22:42:32', '2017-01-07 15:42:32', '', 'Post', '', 'publish', 'closed', 'closed', '', 'post', '', '', '2017-01-07 22:42:32', '2017-01-07 15:42:32', '', 0, 'http://52.76.37.90/?page_id=137', 0, 'page', '', 0),
(138, 1, '2017-01-07 22:42:32', '2017-01-07 15:42:32', '{\n    "page_for_posts": {\n        "value": "137",\n        "type": "option",\n        "user_id": 1\n    },\n    "nav_menus_created_posts": {\n        "value": [\n            137\n        ],\n        "type": "option",\n        "user_id": 1\n    },\n    "page_on_front": {\n        "value": "133",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '752a1d84-5501-4e3c-8cbb-85bfbf40207c', '', '', '2017-01-07 22:42:32', '2017-01-07 15:42:32', '', 0, 'http://52.76.37.90/?p=138', 0, 'customize_changeset', '', 0),
(139, 1, '2017-01-07 22:42:32', '2017-01-07 15:42:32', '', 'Post', '', 'inherit', 'closed', 'closed', '', '137-revision-v1', '', '', '2017-01-07 22:42:32', '2017-01-07 15:42:32', '', 137, 'http://52.76.37.90/2017/01/07/137-revision-v1/', 0, 'revision', '', 0),
(140, 1, '2017-01-07 22:44:03', '2017-01-07 15:44:03', '[soliloquy id="116"]', 'Home Page', '', 'inherit', 'closed', 'closed', '', '133-revision-v1', '', '', '2017-01-07 22:44:03', '2017-01-07 15:44:03', '', 133, 'http://52.76.37.90/2017/01/07/133-revision-v1/', 0, 'revision', '', 0),
(141, 1, '2017-01-07 22:46:19', '0000-00-00 00:00:00', '{\n    "show_on_front": {\n        "value": "page",\n        "type": "option",\n        "user_id": 1\n    },\n    "page_on_front": {\n        "value": "137",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'auto-draft', 'closed', 'closed', '', '5b1cc6ec-9028-4749-a531-49b038a49bd2', '', '', '2017-01-07 22:46:19', '0000-00-00 00:00:00', '', 0, 'http://52.76.37.90/?p=141', 0, 'customize_changeset', '', 0),
(142, 1, '2017-01-07 23:09:18', '2017-01-07 16:09:18', '{\n    "show_on_front": {\n        "value": "posts",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'c0f3e8d9-f558-45b5-b0d2-77740106c3c2', '', '', '2017-01-07 23:09:18', '2017-01-07 16:09:18', '', 0, 'http://52.76.37.90/2017/01/07/c0f3e8d9-f558-45b5-b0d2-77740106c3c2/', 0, 'customize_changeset', '', 0),
(143, 1, '2017-01-07 23:22:17', '2017-01-07 16:22:17', '', 'Test', '', 'publish', 'closed', 'closed', '', '143', '', '', '2017-06-29 20:48:20', '2017-06-29 13:48:20', '', 0, 'http://52.76.37.90/?post_type=soliloquy&#038;p=143', 0, 'soliloquy', '', 0),
(144, 1, '2017-01-07 23:20:38', '2017-01-07 16:20:38', '', 'test1', '', 'inherit', 'open', 'closed', '', 'test1', '', '', '2017-01-07 23:20:38', '2017-01-07 16:20:38', '', 143, 'http://52.76.37.90/wp-content/uploads/2017/01/test1.jpg', 0, 'attachment', 'image/jpeg', 0),
(145, 1, '2017-01-07 23:20:49', '2017-01-07 16:20:49', '', 'test2', '', 'inherit', 'open', 'closed', '', 'test2', '', '', '2017-01-07 23:20:49', '2017-01-07 16:20:49', '', 143, 'http://52.76.37.90/wp-content/uploads/2017/01/test2.jpg', 0, 'attachment', 'image/jpeg', 0),
(146, 1, '2017-01-07 23:20:59', '2017-01-07 16:20:59', '', 'test3', '', 'inherit', 'open', 'closed', '', 'test3', '', '', '2017-01-07 23:20:59', '2017-01-07 16:20:59', '', 143, 'http://52.76.37.90/wp-content/uploads/2017/01/test3.jpg', 0, 'attachment', 'image/jpeg', 0),
(147, 1, '2017-06-29 19:01:18', '2017-06-29 12:01:18', '', 'Welcome', '', 'publish', 'closed', 'closed', '', 'welcome', '', '', '2017-07-05 16:31:03', '2017-07-05 09:31:03', '', 0, 'http://52.76.37.90/?page_id=147', 0, 'page', '', 0),
(148, 1, '2017-06-29 19:01:19', '2017-06-29 12:01:19', '', 'Blog', '', 'publish', 'closed', 'closed', '', 'blog', '', '', '2017-06-29 19:01:19', '2017-06-29 12:01:19', '', 0, 'http://52.76.37.90/?page_id=148', 0, 'page', '', 0),
(149, 1, '2017-06-29 19:01:18', '2017-06-29 12:01:18', '{\n    "nav_menus_created_posts": {\n        "value": [\n            147,\n            148\n        ],\n        "type": "option",\n        "user_id": 1\n    },\n    "show_on_front": {\n        "starter_content": true,\n        "value": "page",\n        "type": "option",\n        "user_id": 1\n    },\n    "page_on_front": {\n        "starter_content": true,\n        "value": 147,\n        "type": "option",\n        "user_id": 1\n    },\n    "page_for_posts": {\n        "starter_content": true,\n        "value": 148,\n        "type": "option",\n        "user_id": 1\n    },\n    "sidebars_widgets[header-1]": {\n        "value": [\n\n        ],\n        "type": "option",\n        "user_id": 1\n    },\n    "widget_wp_user_avatar_profile[3]": {\n        "value": [\n\n        ],\n        "type": "option",\n        "user_id": 1\n    },\n    "storefront::sd_typography": {\n        "value": "helvetica",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sd_button_background_style": {\n        "value": "default",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sd_button_rounded": {\n        "value": "1",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '1ce2e735-2d4a-4254-a0b4-8b269bec4e81', '', '', '2017-06-29 19:01:18', '2017-06-29 12:01:18', '', 0, 'http://52.76.37.90/?p=149', 0, 'customize_changeset', '', 0) ;
INSERT INTO `wp_posts` ( `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(150, 1, '2017-06-29 19:01:18', '2017-06-29 12:01:18', 'This is your homepage which is what most visitors will see when they first visit your shop.\n\nYou can change this text by editing the &quot;Welcome&quot; page via the &quot;Pages&quot; menu in your dashboard.', 'Welcome', '', 'inherit', 'closed', 'closed', '', '147-revision-v1', '', '', '2017-06-29 19:01:18', '2017-06-29 12:01:18', '', 147, 'http://52.76.37.90/2017/06/29/147-revision-v1/', 0, 'revision', '', 0),
(151, 1, '2017-06-29 19:01:19', '2017-06-29 12:01:19', '', 'Blog', '', 'inherit', 'closed', 'closed', '', '148-revision-v1', '', '', '2017-06-29 19:01:19', '2017-06-29 12:01:19', '', 148, 'http://52.76.37.90/2017/06/29/148-revision-v1/', 0, 'revision', '', 0),
(152, 1, '2017-06-29 20:56:11', '2017-06-29 13:56:11', 'Hello Hello Hello\n', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-autosave-v1', '', '', '2017-06-29 20:56:11', '2017-06-29 13:56:11', '', 1, 'http://52.76.37.90/2017/06/29/1-autosave-v1/', 0, 'revision', '', 0),
(153, 1, '2017-06-29 20:56:24', '2017-06-29 13:56:24', 'Hello Hello Hello\r\nContent goes here.', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2017-06-29 20:56:24', '2017-06-29 13:56:24', '', 1, 'http://52.76.37.90/2017/06/29/1-revision-v1/', 0, 'revision', '', 0) ;
INSERT INTO `wp_posts` ( `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(154, 1, '2017-06-29 21:02:54', '2017-06-29 14:02:54', '{\n    "storefront::storefront_layout": {\n        "value": "right",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sd_fixed_width": {\n        "value": "true",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'e17d62e2-d182-472f-9cce-6cd93d5b5675', '', '', '2017-06-29 21:02:54', '2017-06-29 14:02:54', '', 0, 'http://52.76.37.90/?p=154', 0, 'customize_changeset', '', 0),
(155, 1, '2017-06-29 21:10:32', '2017-06-29 14:10:32', '{\n    "storefront::sp_max_width": {\n        "value": "default",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_designer_css_data[3292764223167607000]": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_header_sticky": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_header_setting": {\n        "value": "%7B%7D",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "page_on_front": {\n        "value": "147",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'e52c19d3-5e46-498d-9f93-cd1ea08a7252', '', '', '2017-06-29 21:10:32', '2017-06-29 14:10:32', '', 0, 'http://52.76.37.90/?p=155', 0, 'customize_changeset', '', 0),
(156, 1, '2017-06-29 22:22:35', '2017-06-29 15:22:35', '', '1234', '', 'publish', 'closed', 'closed', '', '1234', '', '', '2017-06-29 22:22:35', '2017-06-29 15:22:35', '', 0, 'http://52.76.37.90/?post_type=soliloquy&#038;p=156', 0, 'soliloquy', '', 0),
(157, 1, '2017-06-29 22:21:31', '2017-06-29 15:21:31', '', 'size-ref-block_336x280', '', 'inherit', 'open', 'closed', '', 'size-ref-block_336x280', '', '', '2017-06-29 22:21:31', '2017-06-29 15:21:31', '', 156, 'http://52.76.37.90/wp-content/uploads/2017/06/size-ref-block_336x280.gif', 0, 'attachment', 'image/gif', 0),
(158, 1, '2017-06-29 22:21:38', '2017-06-29 15:21:38', '', 'size-ref', '', 'inherit', 'open', 'closed', '', 'size-ref', '', '', '2017-06-29 22:21:38', '2017-06-29 15:21:38', '', 156, 'http://52.76.37.90/wp-content/uploads/2017/06/size-ref.jpg', 0, 'attachment', 'image/jpeg', 0),
(159, 1, '2017-06-29 22:22:00', '2017-06-29 15:22:00', '', 'Talk2016_20percent1', '', 'inherit', 'open', 'closed', '', 'talk2016_20percent1', '', '', '2017-06-29 22:22:00', '2017-06-29 15:22:00', '', 156, 'http://52.76.37.90/wp-content/uploads/2017/06/Talk2016_20percent1.jpg', 0, 'attachment', 'image/jpeg', 0),
(160, 1, '2017-07-04 15:35:14', '2017-07-04 08:35:14', '', 'Featured Contents', '', 'publish', 'closed', 'closed', '', 'featured-contents', '', '', '2017-07-04 16:21:19', '2017-07-04 09:21:19', '', 0, 'http://52.76.37.90/?post_type=soliloquy&#038;p=160', 0, 'soliloquy', '', 0),
(161, 1, '2017-07-04 15:25:05', '2017-07-04 08:25:05', '', 'Talk2017_3_20percent2', '', 'inherit', 'open', 'closed', '', 'talk2017_3_20percent2', '', '', '2017-07-04 15:25:05', '2017-07-04 08:25:05', '', 160, 'http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2.jpg', 0, 'attachment', 'image/jpeg', 0),
(162, 1, '2017-07-04 15:33:09', '2017-07-04 08:33:09', '', 'Slider-Fallback-Image', '', 'inherit', 'open', 'closed', '', 'slider-fallback-image', '', '', '2017-07-04 15:33:09', '2017-07-04 08:33:09', '', 160, 'http://52.76.37.90/wp-content/uploads/2017/07/Slider-Fallback-Image.jpg', 0, 'attachment', 'image/jpeg', 0),
(163, 1, '2017-07-04 15:39:45', '2017-07-04 08:39:45', '[soliloquy id="160"]\r\n\r\nThis is your homepage which is what most visitors will see when they first visit your shop.\r\n\r\nYou can change this text by editing the &quot;Welcome&quot; page via the &quot;Pages&quot; menu in your dashboard.', 'Welcome', '', 'inherit', 'closed', 'closed', '', '147-revision-v1', '', '', '2017-07-04 15:39:45', '2017-07-04 08:39:45', '', 147, 'http://52.76.37.90/2017/07/04/147-revision-v1/', 0, 'revision', '', 0),
(164, 1, '2017-07-04 15:44:06', '2017-07-04 08:44:06', '[soliloquy id="160"]\n\n', 'Welcome', '', 'inherit', 'closed', 'closed', '', '147-autosave-v1', '', '', '2017-07-04 15:44:06', '2017-07-04 08:44:06', '', 147, 'http://52.76.37.90/2017/07/04/147-autosave-v1/', 0, 'revision', '', 0),
(165, 1, '2017-07-04 15:47:11', '2017-07-04 08:47:11', 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-cropped-CDClogo2015_rev1_A.png', 'cropped-cropped-CDClogo2015_rev1_A.png', '', 'inherit', 'open', 'closed', '', 'cropped-cropped-cdclogo2015_rev1_a-png', '', '', '2017-07-04 15:47:11', '2017-07-04 08:47:11', '', 0, 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-cropped-CDClogo2015_rev1_A.png', 0, 'attachment', 'image/png', 0),
(166, 1, '2017-07-04 15:49:16', '2017-07-04 08:49:16', '{\n    "blogdescription": {\n        "value": "\\u0e40\\u0e2a\\u0e49\\u0e19\\u0e17\\u0e32\\u0e07\\u0e2a\\u0e39\\u0e48\\u0e01\\u0e32\\u0e23\\u0e25\\u0e07\\u0e17\\u0e38\\u0e19\\u0e2d\\u0e22\\u0e48\\u0e32\\u0e07\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e23\\u0e30\\u0e1a\\u0e1a",\n        "type": "option",\n        "user_id": 1\n    },\n    "twentysixteen::custom_logo": {\n        "value": 165,\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'c1a0050a-355d-4453-b30b-7a2a4c4c6e13', '', '', '2017-07-04 15:49:16', '2017-07-04 08:49:16', '', 0, 'http://52.76.37.90/?p=166', 0, 'customize_changeset', '', 0),
(167, 1, '2017-07-04 15:53:48', '2017-07-04 08:53:48', 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-cropped-CDClogo2015_rev1_A-e1499158089226.png', 'cropped-cropped-CDClogo2015_rev1_A-e1499158089226.png', '', 'inherit', 'open', 'closed', '', 'cropped-cropped-cdclogo2015_rev1_a-e1499158089226-png', '', '', '2017-07-04 15:53:48', '2017-07-04 08:53:48', '', 0, 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2016/07/04093950/cropped-cropped-CDClogo2015_rev1_A-e1499158089226.png', 0, 'attachment', 'image/png', 0),
(168, 1, '2017-07-04 15:55:38', '2017-07-04 08:55:38', '{\n    "twentysixteen::custom_logo": {\n        "value": 167,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "twentysixteen::background_color": {\n        "value": "#99b7c6",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "twentysixteen::header_image": {\n        "value": "remove-header",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "twentysixteen::header_image_data": {\n        "value": "remove-header",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "show_on_front": {\n        "value": "page",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '457d8748-e079-483e-8c1c-9d7527c0cde3', '', '', '2017-07-04 15:55:38', '2017-07-04 08:55:38', '', 0, 'http://52.76.37.90/?p=168', 0, 'customize_changeset', '', 0),
(169, 1, '2017-07-04 15:54:47', '2017-07-04 08:54:47', '', 'cropped-Talk2017_3_20percent2.jpg', '', 'inherit', 'open', 'closed', '', 'cropped-talk2017_3_20percent2-jpg', '', '', '2017-07-04 15:54:47', '2017-07-04 08:54:47', '', 0, 'http://s3-ap-southeast-1.amazonaws.com/cdc-wordpress/wp-content/uploads/2017/07/04152505/cropped-Talk2017_3_20percent2.jpg', 0, 'attachment', 'image/jpeg', 0),
(170, 1, '2017-07-04 15:55:59', '2017-07-04 08:55:59', '{\n    "twentysixteen::custom_logo": {\n        "value": "",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'e9bfc1e5-d5b4-4807-9a57-b2458b908838', '', '', '2017-07-04 15:55:59', '2017-07-04 08:55:59', '', 0, 'http://52.76.37.90/2017/07/04/e9bfc1e5-d5b4-4807-9a57-b2458b908838/', 0, 'customize_changeset', '', 0),
(171, 1, '2017-07-04 16:01:55', '2017-07-04 09:01:55', '{\n    "storefront::custom_logo": {\n        "value": 13,\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::storefront_layout": {\n        "value": "right",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sbc_post_layout_archive": {\n        "value": "meta-hidden",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sbc_post_layout_homepage": {\n        "value": "meta-hidden",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "show_on_front": {\n        "value": "posts",\n        "type": "option",\n        "user_id": 1\n    },\n    "storefront::sbc_homepage_blog_columns": {\n        "value": "2",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sbc_homepage_blog_limit": {\n        "value": "6",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '6d9c7898-8bad-444b-a0c4-260a91ca647e', '', '', '2017-07-04 16:01:55', '2017-07-04 09:01:55', '', 0, 'http://52.76.37.90/?p=171', 0, 'customize_changeset', '', 0),
(172, 1, '2017-07-04 16:07:35', '2017-07-04 09:07:35', '{\n    "storefront::sp_max_width": {\n        "value": "default",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_content_frame": {\n        "value": "frame",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '23c6d3f6-41eb-44fc-882b-384ed1b3b9f2', '', '', '2017-07-04 16:07:35', '2017-07-04 09:07:35', '', 0, 'http://52.76.37.90/?p=172', 0, 'customize_changeset', '', 0),
(173, 1, '2017-07-04 16:08:18', '2017-07-04 09:08:18', '{\n    "storefront::sp_content_frame_background": {\n        "value": "#f2f2f2",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '0f2215d9-d32b-4c9d-9609-1deb6f610206', '', '', '2017-07-04 16:08:18', '2017-07-04 09:08:18', '', 0, 'http://52.76.37.90/2017/07/04/0f2215d9-d32b-4c9d-9609-1deb6f610206/', 0, 'customize_changeset', '', 0),
(174, 1, '2017-07-04 16:10:11', '2017-07-04 09:10:11', '{\n    "storefront::sp_max_width": {\n        "value": "max-width",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "storefront::sp_content_frame": {\n        "value": "default",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '313e733a-e1bc-4f77-8221-5aaa80ed7a32', '', '', '2017-07-04 16:10:11', '2017-07-04 09:10:11', '', 0, 'http://52.76.37.90/2017/07/04/313e733a-e1bc-4f77-8221-5aaa80ed7a32/', 0, 'customize_changeset', '', 0),
(175, 1, '2017-07-04 16:14:45', '2017-07-04 09:14:45', '', 'Slider-Fallback-Image_600p', '', 'inherit', 'open', 'closed', '', 'slider-fallback-image_600p', '', '', '2017-07-04 16:14:45', '2017-07-04 09:14:45', '', 160, 'http://52.76.37.90/wp-content/uploads/2017/07/Slider-Fallback-Image_600p.jpg', 0, 'attachment', 'image/jpeg', 0),
(176, 1, '2017-07-04 16:18:00', '2017-07-04 09:18:00', '<img src="http://52.76.37.90/wp-content/uploads/2017/07/Talk2017_3_20percent2-500x262.jpg" alt="" width="500" height="262" class="alignnone size-medium wp-image-161" />\r\n\r\nHello Hello Hello\r\nContent goes here.', 'Hello world!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2017-07-04 16:18:00', '2017-07-04 09:18:00', '', 1, 'http://52.76.37.90/2017/07/04/1-revision-v1/', 0, 'revision', '', 0),
(177, 1, '2017-07-04 16:26:32', '2017-07-04 09:26:32', 'Just to see how it goes\r\n<img src="http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262.jpg" alt="" width="500" height="262" class="alignnone size-medium wp-image-117" />', 'A second post', '', 'publish', 'open', 'open', '', 'a-second-post', '', '', '2017-07-04 16:27:39', '2017-07-04 09:27:39', '', 0, 'http://52.76.37.90/?p=177', 0, 'post', '', 0),
(178, 1, '2017-07-05 16:07:02', '2017-07-05 09:07:02', 'ชมรมทำความสะอาดบ้านครั้งใหญ่ ย้ายฐานข้อมูลใหม่ทั้งหมด เพื่อความปลอดภัย ต้องรบกวนให้สมาชิกสนับสนุนทุกท่าน Reset Password ใหม่นะครับ', 'We\'ve moved!', '', 'publish', 'closed', 'closed', '', 'this-is-a-featured-content', '', '', '2017-07-05 16:07:41', '2017-07-05 09:07:41', '', 0, 'http://52.76.37.90/?post_type=featured_post&#038;p=178', 0, 'featured_post', '', 0),
(179, 1, '2017-07-04 16:26:32', '2017-07-04 09:26:32', 'Just to see how it goes\r\n', 'A second post', '', 'inherit', 'closed', 'closed', '', '177-revision-v1', '', '', '2017-07-04 16:26:32', '2017-07-04 09:26:32', '', 177, 'http://52.76.37.90/2017/07/04/177-revision-v1/', 0, 'revision', '', 0),
(180, 1, '2017-07-04 16:27:39', '2017-07-04 09:27:39', 'Just to see how it goes\r\n<img src="http://52.76.37.90/wp-content/uploads/2017/01/Talk2017_2_20percent_small-500x262.jpg" alt="" width="500" height="262" class="alignnone size-medium wp-image-117" />', 'A second post', '', 'inherit', 'closed', 'closed', '', '177-revision-v1', '', '', '2017-07-04 16:27:39', '2017-07-04 09:27:39', '', 177, 'http://52.76.37.90/2017/07/04/177-revision-v1/', 0, 'revision', '', 0),
(181, 1, '2017-07-04 16:41:53', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2017-07-04 16:41:53', '0000-00-00 00:00:00', '', 0, 'http://52.76.37.90/?post_type=featured_post&p=181', 0, 'featured_post', '', 0),
(182, 1, '2017-07-04 19:06:27', '2017-07-04 12:06:27', 'ศึกษา เรียนรู้ พูดคุย ติดตามข่าวสาร กิจกรรมและคอร์สอบรมต่างๆได้ เร็วๆนี้!', 'ติดต่ามข่าวสารชมรม', '', 'publish', 'closed', 'closed', '', 'another-featured-content', '', '', '2017-07-05 16:18:46', '2017-07-05 09:18:46', '', 0, 'http://52.76.37.90/?post_type=featured_post&#038;p=182', 0, 'featured_post', '', 0),
(183, 1, '2017-07-05 15:58:07', '2017-07-05 08:58:07', 'ชมรมทำความสะอาดบ้านครั้งใหญ่ ย้ายฐานข้อมูลใหม่ทั้งหมด เพื่อความปลอดภัย ต้องรบกวนให้สมาชิกสนับสนุนทุกท่าน Reset Password ใหม่นะครับ', 'We\'ve moved!', '', 'inherit', 'closed', 'closed', '', '178-autosave-v1', '', '', '2017-07-05 15:58:07', '2017-07-05 08:58:07', '', 178, 'http://52.76.37.90/2017/07/04/178-autosave-v1/', 0, 'revision', '', 0),
(184, 1, '2017-07-04 19:05:53', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2017-07-04 19:05:53', '0000-00-00 00:00:00', '', 0, 'http://52.76.37.90/?post_type=featured_post&p=184', 0, 'featured_post', '', 0),
(185, 1, '2017-07-04 19:41:02', '2017-07-04 12:41:02', '{\n    "storefront::sd_content_background_color": {\n        "value": "#f7f7f7",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'eac538c0-8f3d-4b18-be83-d851d2fc84d7', '', '', '2017-07-04 19:41:02', '2017-07-04 12:41:02', '', 0, 'http://52.76.37.90/2017/07/04/eac538c0-8f3d-4b18-be83-d851d2fc84d7/', 0, 'customize_changeset', '', 0),
(186, 1, '2017-07-04 19:44:46', '2017-07-04 12:44:46', 'Hooray for more', 'And there\'s a third content', '', 'trash', 'closed', 'closed', '', 'and-theres-a-third-content__trashed', '', '', '2017-07-05 16:00:13', '2017-07-05 09:00:13', '', 0, 'http://52.76.37.90/?post_type=featured_post&#038;p=186', 0, 'featured_post', '', 0),
(187, 1, '2017-07-04 19:49:05', '2017-07-04 12:49:05', '{\n    "storefront::sp_header_setting": {\n        "value": "%7B%7D",\n        "type": "theme_mod",\n        "user_id": 1\n    },\n    "sidebars_widgets[header-1]": {\n        "value": [\n\n        ],\n        "type": "option",\n        "user_id": 1\n    },\n    "widget_soliloquy[3]": {\n        "value": {\n            "encoded_serialized_instance": "YToyOntzOjU6InRpdGxlIjtzOjQ6InRldGUiO3M6MTI6InNvbGlsb3F1eV9pZCI7aToxNjA7fQ==",\n            "title": "tete",\n            "is_widget_customizer_js_value": true,\n            "instance_hash_key": "38060a98d2e3d973b16b4825f9500057"\n        },\n        "type": "option",\n        "user_id": 1\n    },\n    "sidebars_widgets[footer-1]": {\n        "value": [\n            "bbp_forums_widget-3"\n        ],\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '57686700-789b-4068-b2a2-0074cb0f91c6', '', '', '2017-07-04 19:49:05', '2017-07-04 12:49:05', '', 0, 'http://52.76.37.90/?p=187', 0, 'customize_changeset', '', 0),
(188, 1, '2017-07-04 19:49:29', '2017-07-04 12:49:29', '{\n    "storefront::sd_footer_credit": {\n        "value": false,\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'ffe44a32-e412-442b-aa66-7d321833ffb0', '', '', '2017-07-04 19:49:29', '2017-07-04 12:49:29', '', 0, 'http://52.76.37.90/2017/07/04/ffe44a32-e412-442b-aa66-7d321833ffb0/', 0, 'customize_changeset', '', 0),
(189, 1, '2017-07-04 19:49:51', '2017-07-04 12:49:51', '{\n    "storefront::sd_button_rounded": {\n        "value": "2",\n        "type": "theme_mod",\n        "user_id": 1\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'c4b9cae5-5b96-49c6-9ca7-5570da10d2bc', '', '', '2017-07-04 19:49:51', '2017-07-04 12:49:51', '', 0, 'http://52.76.37.90/2017/07/04/c4b9cae5-5b96-49c6-9ca7-5570da10d2bc/', 0, 'customize_changeset', '', 0),
(190, 1, '2017-07-05 00:12:43', '2017-07-04 17:12:43', '', 'Order &ndash; July 5, 2017 @ 12:12 AM', 'นี่คือ Note', 'wc-completed', 'open', 'closed', 'order_595bcc8b0c561', 'order-jul-04-2017-0512-pm', '', '', '2017-07-05 00:14:02', '2017-07-04 17:14:02', '', 0, 'http://52.76.37.90/?post_type=shop_order&#038;p=190', 0, 'shop_order', '', 2),
(191, 19, '2017-07-05 00:14:02', '2017-07-04 17:14:02', '', '', '', 'wcm-active', 'open', 'closed', 'um_595bccda7337a', '191', '', '', '2017-07-05 00:14:02', '2017-07-04 17:14:02', '', 22, 'http://52.76.37.90/?post_type=wc_user_membership&p=191', 0, 'wc_user_membership', '', 1),
(192, 0, '2018-07-05 00:14:02', '2018-07-04 17:14:02', '{"user_membership_id":191}', 'wc_memberships_user_membership_expiry', '', 'pending', 'open', 'closed', '', '', '', '', '2018-07-05 00:14:02', '2018-07-04 17:14:02', '', 0, 'http://52.76.37.90/?post_type=scheduled-action&p=192', 0, 'scheduled-action', '', 1),
(193, 0, '2018-07-02 00:14:02', '2018-07-01 17:14:02', '{"user_membership_id":191}', 'wc_memberships_user_membership_expiring_soon', '', 'pending', 'open', 'closed', '', '', '', '', '2018-07-02 00:14:02', '2018-07-01 17:14:02', '', 0, 'http://52.76.37.90/?post_type=scheduled-action&p=193', 0, 'scheduled-action', '', 1),
(194, 1, '2017-07-05 15:58:10', '2017-07-05 08:58:10', '', 'fc_moving', '', 'inherit', 'open', 'closed', '', 'fc_moving', '', '', '2017-07-05 15:58:10', '2017-07-05 08:58:10', '', 178, 'http://52.76.37.90/wp-content/uploads/2017/07/fc_moving.jpg', 0, 'attachment', 'image/jpeg', 0),
(195, 1, '2017-07-05 16:04:04', '2017-07-05 09:04:04', 'ยังเปิดรับสมัครอยู่นะครับ สำหรับ CDC Webinar ครึ่งหลังปี 2017 อ่านข้อมูลเพิ่มเติมทางนี้ได้เลย', 'CDC Webinar 2017 รอบที่สอง', '', 'publish', 'closed', 'closed', '', 'cdc-webinar-2017-%e0%b8%a3%e0%b8%ad%e0%b8%9a%e0%b8%97%e0%b8%b5%e0%b9%88%e0%b8%aa%e0%b8%ad%e0%b8%87', '', '', '2017-07-05 16:20:54', '2017-07-05 09:20:54', '', 0, 'http://52.76.37.90/?post_type=featured_post&#038;p=195', 0, 'featured_post', '', 0),
(196, 1, '2017-07-05 16:14:47', '2017-07-05 09:14:47', '[embed]https://youtu.be/bDvldl-OzvU[/embed]\r\n\r\n<strong>เปิดรับสมัคร CDC Talk Webinar 2017 (JAN-JUNE)</strong>\r\n\r\nCDC Talk Webinar สัมนาออนไลน์ของชมรมโฉลก ที่ให้ความรู้ ความมั่นใจ ในการลงทุนกับเพื่อนๆสมาชิก\r\nสามารถติดตามข่าวสารการลงทุน วิเคราะห์แนวโน้มสถานะการณ์การลงทุนในตลาดทุนทั่วโลก\r\nปัจจัยสำคัญต่อการลงทุน การวิเคราะห์ทางเทคนิค กับตลาดหุ้น, Commodities ต่าง ๆ เช่น ทองคำ, น้ำมัน, ยางพารา ฯลฯ\r\nและติดตามความเคลื่อนไหวในการพัฒนาระบบการลงทุนตามแนวทางชมรม ฝึกวินัยการลงทุน\r\nและพัฒนาพอร์ตการลงทุนให้เติบโตอย่างยั่งยืนไปด้วยกันทุกวันจันทร์ :)\r\nคุณลุงโฉลกสอนทุกอย่างที่ทุกคนอยากเรียน ตอบทุกคำถามที่ทุกคนอยากรู้\r\n\r\nโดย คุณลุงโฉลก สัมพันธารักษ์ ปรมาจารย์แห่งการลงทุน ที่มีประสบการณ์มากกว่า40ปี\r\n\r\n<!--more-->ด้วยเทคโนโลยีปัจจุบัน ทำให้โลกนี้เล็กลง\r\nวันนี้เราสามารถฟังคุณลุงโฉลก วิเคราะห์การลงทุน\r\nเห็นกราฟที่หน้าจอเหมือนนั่งอยู่ข้าง ๆ คุณลุง\r\nซักถามโต้ตอบ แถมท้ายด้วยการฟังธรรมะสอนใจ\r\n\r\nทั้งหมดนี้ เรานั่งอยู่หน้าคอมที่บ้าน\r\nหรือนั่งชิลจิบเครื่องดื่มเย็น ๆ อยู่ริมชายหาด\r\nระยะทางไกลไม่ใช่ปัญหา\r\nอยู่ต่างจังหวัด หรือต่างประเทศ\r\nก็เข้าร่วมสัมนาได้อย่างง่ายดายพร้อมกันทั่วโลก\r\nไม่ต้องเดินทางอีกต่อไป!!!\r\n\r\nCDC Talk Webinar 2017 (JAN-JUNE)\r\n\r\nส่องโลกการลงทุน สรุปสถานะการณ์ อัพเดทแนวโน้มตลาดทั่วโลก มุมมองการวิเคราะห์ที่นักลงทุนควรติดตาม\r\n\r\nทั้งตลาดหุ้น futures, ทองคำ, น้ำมัน, ค่าเงิน และ commodities ต่าง ๆ\r\n\r\nฟังธรรมมะขัดเกลาจิตใจ บรรยายสด พร้อมถามตอบแบบ Interactive เหมือนนั่งฟังคุณลุงในห้องจริง\r\n\r\n<strong>*** CDC Talk Webinar 2017 เรามีบันทึกย้อนหลังให้ชมด้วยครับ ***</strong>\r\n\r\n(ขอให้สมัครด้วย <strong>GMAIL</strong> เท่านั้น เพื่อจะสามารถรับชมย้อนหลังได้ครับ)\r\n\r\nรายได้ทั้งหมดหลังหักค่าใช้จ่าย สมทบทุนสร้างสถานปฏิบัติธรรม CDC โดยมูลนิธิโฉลกดอทคอม\r\n\r\n+++ สมัครด่วน !!! รับจำนวนจำกัด +++\r\n\r\nวิทยากร :\r\nคุณลุงโฉลก สัมพันธารักษ์\r\n\r\nวัน/เวลา : ทุกวันจันทร์ เวลา 20.00 – 21.30 น.\r\nเริ่มจันทร์ที่ 2 มกราคม – ครั้งสุดท้ายจันทร์ที่ 26 มิถุนายน 2560\r\n\r\nอัตราค่าสมัคร : 6000 บาท\r\n\r\n*** สมาชิก CDC Talk Webinar เดิม ลด 10% เหลือเพียง 5400 บาท\r\n\r\n*** สมาชิกเวป Chaloke.com ลด 5% เหลือเพียง 5700 บาท\r\n\r\n**** Early Bird Promotion พิเศษ สำหรับท่านที่สนใจสมัคก่อน 30 พย. 59 เหลือเพียง 5400 บาท****\r\n\r\nหมายเหตุ\r\n\r\n– เลือกรับส่วนได้เพียงแบบใดแบบหนึ่ง ไม่สามารถนำมารวมกันได้\r\n\r\n– กลุ่มปิดใน Facebook เราไม่เปิดให้สมัครได้ทั่วไป ทีมงานจะส่ง invite ให้เฉพาะสมาชิก CDC Talk Webinar เท่านั้น\r\n\r\nหากสมัคร CDC Talk แล้วต้องการเข้าร่วมกลุ่ม กรุณาแจ้งไปที่ info@cdcwebinarteam.com\r\n\r\n*** CDC Talk Webinar 2017 (JAN-JUNE) หากเต็มก็ปิดรับสมัครเลยนะครับ***\r\n\r\nขั้นตอนการสมัคร CDC Talk Webinar 2017 (JAN-JUNE)\r\n\r\n1. โอนเงินเข้าบัญชี\r\nกรุณาตรวจสอบเลขบัญชีให้แม่นยำ และอย่าโอนผิดบัญชี\r\nบัญชี : ออมทรัพย์ ธ.ไทยพาณิชย์\r\nสาขา : ลาดพร้าว 59\r\nชื่อบัญชี : งานสัมมนา 2 โดย นาย โฉลก สัมพันธารักษ์\r\nเลขที่บัญชี : 0104339911\r\n\r\nแจ้งโอนเงินและกรอกข้อมูลผู้สมัครที่ฟอร์มตาม Link ด้านล่างนี้\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\n<img class="alignnone size-full wp-image-197" src="http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171.png" alt="" width="150" height="150" />\r\n\r\n**** Early Bird Promotion พิเศษ สำหรับท่านที่สนใจสมัคก่อน 30 พย. 59 เหลือเพียง 5400 บาท****\r\n\r\nผู้ที่สมัครทุกท่านจะได้รับ email ตอบรับการสมัครภายใน 7 วัน (อาจมีล่าช้าบ้าง)\r\n\r\nสำหรับทุกคำถามขอให้โพสไว้ในกระทู้นี้หรือที่\r\nemail : info@cdcwebinar.com หรือ\r\nCDC Webinar Facebook Page https://www.facebook.com/CDCWebinar\r\n\r\nหมายเหตุ :\r\n– กรุณากรอกข้อมูลให้ครบทุกช่องและ email ต้องถูกต้องและใช้ได้จริง มิฉะนั้นถือว่าการจองไม่สมบูรณ์ และทีมงานจะไม่สามารถส่ง เมล์ตอบรับหรือ Link ทางเข้าห้องสัมนาให้ได้\r\n– เพื่อความสะดวกและรวดเร็วในการทำงานกรุณาโอนเงินก่อนค่อยมากรอกข้อมูลการจอง ไม่รับจองก่อนโอนทุกกรณี หากตรวจพบเราขอลบการสมัครออกและต้องเริ่มสมัครใหม่อีกครั้งนะครับ\r\n– กรุณาอ่านและทำตามขั้นตอนอย่างเคร่งครัดเพื่อลดความผิดพลาดใด ๆ ที่จะทำให้เกิดความล่าช้า\r\n– เพื่อความสะดวกรวดเร็วในการรับสมัคร ขอความร่วมมือให้ “แยกสมัคร” เช่นหากคุณต้องการสมัครพร้อมกันหลายคน เช่น 3 คน\r\nก็ให้โอนเงิน 3 ครั้ง และ ลงทะเบียน 3 รอบ คือแยกทำทีละ 1 คน และ email ที่ใช้สมัครของแต่ละคน ต้องไม่ซ้ำกัน\r\n\r\nดูวิธีเตรียมพร้อมสำหรับเข้าร่วมสัมนาออนไลน์ทาง Webinar ได้ที่กระทู้ที่คุณหมอสืบพงษ์ทีมงาน CDC Webinar Team อธิบายไว้แล้วตามนี้ครับ\r\n\r\nQuick Reference Guide https://goo.gl/VTNsT4\r\nMobile Web version https://goo.gl/i8HD8o\r\n\r\nสอบถามข้อมูลเพิ่มเติม\r\nสามารถโทรติดต่อสอบถามข้อมูลได้ที่หมายเลขโทรศัพท์: 098-765-5641\r\nหรือ ติดต่อที่\r\n\r\ne-mail: info@chaloke.com\r\n\r\nFB : CDC ChalokeDotCom\r\n\r\nYoutube : CDC chaloke dot com\r\n\r\n@Line : @chalokedotcom', 'เปิดรับสมัคร CDC TALK WEBINAR 2017', '', 'publish', 'open', 'open', '', '%e0%b9%80%e0%b8%9b%e0%b8%b4%e0%b8%94%e0%b8%a3%e0%b8%b1%e0%b8%9a%e0%b8%aa%e0%b8%a1%e0%b8%b1%e0%b8%84%e0%b8%a3-cdc-talk-webinar-2017', '', '', '2017-07-05 16:35:39', '2017-07-05 09:35:39', '', 0, 'http://52.76.37.90/?p=196', 0, 'post', '', 0),
(197, 1, '2017-07-05 16:11:46', '2017-07-05 09:11:46', '', 'LINK-สมัคร-web-20171', '', 'inherit', 'open', 'closed', '', 'link-%e0%b8%aa%e0%b8%a1%e0%b8%b1%e0%b8%84%e0%b8%a3-web-20171', '', '', '2017-07-05 16:11:46', '2017-07-05 09:11:46', '', 196, 'http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171.png', 0, 'attachment', 'image/png', 0),
(198, 1, '2017-07-05 16:14:47', '2017-07-05 09:14:47', '[embed]https://youtu.be/bDvldl-OzvU[/embed]\r\n\r\n<strong>เปิดรับสมัคร CDC Talk Webinar 2017 (JAN-JUNE)</strong>\r\n\r\nCDC Talk Webinar สัมนาออนไลน์ของชมรมโฉลก ที่ให้ความรู้ ความมั่นใจ ในการลงทุนกับเพื่อนๆสมาชิก\r\nสามารถติดตามข่าวสารการลงทุน วิเคราะห์แนวโน้มสถานะการณ์การลงทุนในตลาดทุนทั่วโลก\r\nปัจจัยสำคัญต่อการลงทุน การวิเคราะห์ทางเทคนิค กับตลาดหุ้น, Commodities ต่าง ๆ เช่น ทองคำ, น้ำมัน, ยางพารา ฯลฯ\r\nและติดตามความเคลื่อนไหวในการพัฒนาระบบการลงทุนตามแนวทางชมรม ฝึกวินัยการลงทุน\r\nและพัฒนาพอร์ตการลงทุนให้เติบโตอย่างยั่งยืนไปด้วยกันทุกวันจันทร์ :)\r\nคุณลุงโฉลกสอนทุกอย่างที่ทุกคนอยากเรียน ตอบทุกคำถามที่ทุกคนอยากรู้\r\n\r\nโดย คุณลุงโฉลก สัมพันธารักษ์ ปรมาจารย์แห่งการลงทุน ที่มีประสบการณ์มากกว่า40ปี\r\n\r\nด้วยเทคโนโลยีปัจจุบัน ทำให้โลกนี้เล็กลง\r\nวันนี้เราสามารถฟังคุณลุงโฉลก วิเคราะห์การลงทุน\r\nเห็นกราฟที่หน้าจอเหมือนนั่งอยู่ข้าง ๆ คุณลุง\r\nซักถามโต้ตอบ แถมท้ายด้วยการฟังธรรมะสอนใจ\r\n\r\nทั้งหมดนี้ เรานั่งอยู่หน้าคอมที่บ้าน\r\nหรือนั่งชิลจิบเครื่องดื่มเย็น ๆ อยู่ริมชายหาด\r\nระยะทางไกลไม่ใช่ปัญหา\r\nอยู่ต่างจังหวัด หรือต่างประเทศ\r\nก็เข้าร่วมสัมนาได้อย่างง่ายดายพร้อมกันทั่วโลก\r\nไม่ต้องเดินทางอีกต่อไป!!!\r\n\r\nCDC Talk Webinar 2017 (JAN-JUNE)\r\n\r\nส่องโลกการลงทุน สรุปสถานะการณ์ อัพเดทแนวโน้มตลาดทั่วโลก มุมมองการวิเคราะห์ที่นักลงทุนควรติดตาม\r\n\r\nทั้งตลาดหุ้น futures, ทองคำ, น้ำมัน, ค่าเงิน และ commodities ต่าง ๆ\r\n\r\nฟังธรรมมะขัดเกลาจิตใจ บรรยายสด พร้อมถามตอบแบบ Interactive เหมือนนั่งฟังคุณลุงในห้องจริง\r\n\r\n<strong>*** CDC Talk Webinar 2017 เรามีบันทึกย้อนหลังให้ชมด้วยครับ ***</strong>\r\n\r\n(ขอให้สมัครด้วย <strong>GMAIL</strong> เท่านั้น เพื่อจะสามารถรับชมย้อนหลังได้ครับ)\r\n\r\nรายได้ทั้งหมดหลังหักค่าใช้จ่าย สมทบทุนสร้างสถานปฏิบัติธรรม CDC โดยมูลนิธิโฉลกดอทคอม\r\n\r\n+++ สมัครด่วน !!! รับจำนวนจำกัด +++\r\n\r\nวิทยากร :\r\nคุณลุงโฉลก สัมพันธารักษ์\r\n\r\nวัน/เวลา : ทุกวันจันทร์ เวลา 20.00 – 21.30 น.\r\nเริ่มจันทร์ที่ 2 มกราคม – ครั้งสุดท้ายจันทร์ที่ 26 มิถุนายน 2560\r\n\r\nอัตราค่าสมัคร : 6000 บาท\r\n\r\n*** สมาชิก CDC Talk Webinar เดิม ลด 10% เหลือเพียง 5400 บาท\r\n\r\n*** สมาชิกเวป Chaloke.com ลด 5% เหลือเพียง 5700 บาท\r\n\r\n**** Early Bird Promotion พิเศษ สำหรับท่านที่สนใจสมัคก่อน 30 พย. 59 เหลือเพียง 5400 บาท****\r\n\r\nหมายเหตุ\r\n\r\n– เลือกรับส่วนได้เพียงแบบใดแบบหนึ่ง ไม่สามารถนำมารวมกันได้\r\n\r\n– กลุ่มปิดใน Facebook เราไม่เปิดให้สมัครได้ทั่วไป ทีมงานจะส่ง invite ให้เฉพาะสมาชิก CDC Talk Webinar เท่านั้น\r\n\r\nหากสมัคร CDC Talk แล้วต้องการเข้าร่วมกลุ่ม กรุณาแจ้งไปที่ info@cdcwebinarteam.com\r\n\r\n*** CDC Talk Webinar 2017 (JAN-JUNE) หากเต็มก็ปิดรับสมัครเลยนะครับ***\r\n\r\nขั้นตอนการสมัคร CDC Talk Webinar 2017 (JAN-JUNE)\r\n\r\n1. โอนเงินเข้าบัญชี\r\nกรุณาตรวจสอบเลขบัญชีให้แม่นยำ และอย่าโอนผิดบัญชี\r\nบัญชี : ออมทรัพย์ ธ.ไทยพาณิชย์\r\nสาขา : ลาดพร้าว 59\r\nชื่อบัญชี : งานสัมมนา 2 โดย นาย โฉลก สัมพันธารักษ์\r\nเลขที่บัญชี : 0104339911\r\n\r\nแจ้งโอนเงินและกรอกข้อมูลผู้สมัครที่ฟอร์มตาม Link ด้านล่างนี้\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\n<img class="alignnone size-full wp-image-197" src="http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171.png" alt="" width="150" height="150" />\r\n\r\n**** Early Bird Promotion พิเศษ สำหรับท่านที่สนใจสมัคก่อน 30 พย. 59 เหลือเพียง 5400 บาท****\r\n\r\nผู้ที่สมัครทุกท่านจะได้รับ email ตอบรับการสมัครภายใน 7 วัน (อาจมีล่าช้าบ้าง)\r\n\r\nสำหรับทุกคำถามขอให้โพสไว้ในกระทู้นี้หรือที่\r\nemail : info@cdcwebinar.com หรือ\r\nCDC Webinar Facebook Page https://www.facebook.com/CDCWebinar\r\n\r\nหมายเหตุ :\r\n– กรุณากรอกข้อมูลให้ครบทุกช่องและ email ต้องถูกต้องและใช้ได้จริง มิฉะนั้นถือว่าการจองไม่สมบูรณ์ และทีมงานจะไม่สามารถส่ง เมล์ตอบรับหรือ Link ทางเข้าห้องสัมนาให้ได้\r\n– เพื่อความสะดวกและรวดเร็วในการทำงานกรุณาโอนเงินก่อนค่อยมากรอกข้อมูลการจอง ไม่รับจองก่อนโอนทุกกรณี หากตรวจพบเราขอลบการสมัครออกและต้องเริ่มสมัครใหม่อีกครั้งนะครับ\r\n– กรุณาอ่านและทำตามขั้นตอนอย่างเคร่งครัดเพื่อลดความผิดพลาดใด ๆ ที่จะทำให้เกิดความล่าช้า\r\n– เพื่อความสะดวกรวดเร็วในการรับสมัคร ขอความร่วมมือให้ “แยกสมัคร” เช่นหากคุณต้องการสมัครพร้อมกันหลายคน เช่น 3 คน\r\nก็ให้โอนเงิน 3 ครั้ง และ ลงทะเบียน 3 รอบ คือแยกทำทีละ 1 คน และ email ที่ใช้สมัครของแต่ละคน ต้องไม่ซ้ำกัน\r\n\r\nดูวิธีเตรียมพร้อมสำหรับเข้าร่วมสัมนาออนไลน์ทาง Webinar ได้ที่กระทู้ที่คุณหมอสืบพงษ์ทีมงาน CDC Webinar Team อธิบายไว้แล้วตามนี้ครับ\r\n\r\nQuick Reference Guide https://goo.gl/VTNsT4\r\nMobile Web version https://goo.gl/i8HD8o\r\n\r\nสอบถามข้อมูลเพิ่มเติม\r\nสามารถโทรติดต่อสอบถามข้อมูลได้ที่หมายเลขโทรศัพท์: 098-765-5641\r\nหรือ ติดต่อที่\r\n\r\ne-mail: info@chaloke.com\r\n\r\nFB : CDC ChalokeDotCom\r\n\r\nYoutube : CDC chaloke dot com\r\n\r\n@Line : @chalokedotcom', 'เปิดรับสมัคร CDC TALK WEBINAR 2017', '', 'inherit', 'closed', 'closed', '', '196-revision-v1', '', '', '2017-07-05 16:14:47', '2017-07-05 09:14:47', '', 196, 'http://52.76.37.90/2017/07/05/196-revision-v1/', 0, 'revision', '', 0),
(199, 1, '2017-07-05 16:17:18', '2017-07-05 09:17:18', '', 'fc_placeholder_blue', '', 'inherit', 'open', 'closed', '', 'fc_placeholder_blue', '', '', '2017-07-05 16:17:18', '2017-07-05 09:17:18', '', 182, 'http://52.76.37.90/wp-content/uploads/2017/07/fc_placeholder_blue.jpg', 0, 'attachment', 'image/jpeg', 0),
(200, 1, '2017-07-05 16:24:52', '0000-00-00 00:00:00', '{\n    "show_on_front": {\n        "value": "posts",\n        "type": "option",\n        "user_id": 1\n    },\n    "page_for_posts": {\n        "value": "148",\n        "type": "option",\n        "user_id": 1\n    },\n    "page_on_front": {\n        "value": "147",\n        "type": "option",\n        "user_id": 1\n    }\n}', '', '', 'auto-draft', 'closed', 'closed', '', 'b5addaf5-2e74-4a90-a5eb-d8a2bde2c378', '', '', '2017-07-05 16:24:52', '2017-07-05 09:24:52', '', 0, 'http://52.76.37.90/?p=200', 0, 'customize_changeset', '', 0),
(201, 1, '2017-07-05 16:31:03', '2017-07-05 09:31:03', '', 'Welcome', '', 'inherit', 'closed', 'closed', '', '147-revision-v1', '', '', '2017-07-05 16:31:03', '2017-07-05 09:31:03', '', 147, 'http://52.76.37.90/2017/07/05/147-revision-v1/', 0, 'revision', '', 0) ;
INSERT INTO `wp_posts` ( `ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(202, 1, '2017-07-05 16:35:39', '2017-07-05 09:35:39', '[embed]https://youtu.be/bDvldl-OzvU[/embed]\r\n\r\n<strong>เปิดรับสมัคร CDC Talk Webinar 2017 (JAN-JUNE)</strong>\r\n\r\nCDC Talk Webinar สัมนาออนไลน์ของชมรมโฉลก ที่ให้ความรู้ ความมั่นใจ ในการลงทุนกับเพื่อนๆสมาชิก\r\nสามารถติดตามข่าวสารการลงทุน วิเคราะห์แนวโน้มสถานะการณ์การลงทุนในตลาดทุนทั่วโลก\r\nปัจจัยสำคัญต่อการลงทุน การวิเคราะห์ทางเทคนิค กับตลาดหุ้น, Commodities ต่าง ๆ เช่น ทองคำ, น้ำมัน, ยางพารา ฯลฯ\r\nและติดตามความเคลื่อนไหวในการพัฒนาระบบการลงทุนตามแนวทางชมรม ฝึกวินัยการลงทุน\r\nและพัฒนาพอร์ตการลงทุนให้เติบโตอย่างยั่งยืนไปด้วยกันทุกวันจันทร์ :)\r\nคุณลุงโฉลกสอนทุกอย่างที่ทุกคนอยากเรียน ตอบทุกคำถามที่ทุกคนอยากรู้\r\n\r\nโดย คุณลุงโฉลก สัมพันธารักษ์ ปรมาจารย์แห่งการลงทุน ที่มีประสบการณ์มากกว่า40ปี\r\n\r\n<!--more-->ด้วยเทคโนโลยีปัจจุบัน ทำให้โลกนี้เล็กลง\r\nวันนี้เราสามารถฟังคุณลุงโฉลก วิเคราะห์การลงทุน\r\nเห็นกราฟที่หน้าจอเหมือนนั่งอยู่ข้าง ๆ คุณลุง\r\nซักถามโต้ตอบ แถมท้ายด้วยการฟังธรรมะสอนใจ\r\n\r\nทั้งหมดนี้ เรานั่งอยู่หน้าคอมที่บ้าน\r\nหรือนั่งชิลจิบเครื่องดื่มเย็น ๆ อยู่ริมชายหาด\r\nระยะทางไกลไม่ใช่ปัญหา\r\nอยู่ต่างจังหวัด หรือต่างประเทศ\r\nก็เข้าร่วมสัมนาได้อย่างง่ายดายพร้อมกันทั่วโลก\r\nไม่ต้องเดินทางอีกต่อไป!!!\r\n\r\nCDC Talk Webinar 2017 (JAN-JUNE)\r\n\r\nส่องโลกการลงทุน สรุปสถานะการณ์ อัพเดทแนวโน้มตลาดทั่วโลก มุมมองการวิเคราะห์ที่นักลงทุนควรติดตาม\r\n\r\nทั้งตลาดหุ้น futures, ทองคำ, น้ำมัน, ค่าเงิน และ commodities ต่าง ๆ\r\n\r\nฟังธรรมมะขัดเกลาจิตใจ บรรยายสด พร้อมถามตอบแบบ Interactive เหมือนนั่งฟังคุณลุงในห้องจริง\r\n\r\n<strong>*** CDC Talk Webinar 2017 เรามีบันทึกย้อนหลังให้ชมด้วยครับ ***</strong>\r\n\r\n(ขอให้สมัครด้วย <strong>GMAIL</strong> เท่านั้น เพื่อจะสามารถรับชมย้อนหลังได้ครับ)\r\n\r\nรายได้ทั้งหมดหลังหักค่าใช้จ่าย สมทบทุนสร้างสถานปฏิบัติธรรม CDC โดยมูลนิธิโฉลกดอทคอม\r\n\r\n+++ สมัครด่วน !!! รับจำนวนจำกัด +++\r\n\r\nวิทยากร :\r\nคุณลุงโฉลก สัมพันธารักษ์\r\n\r\nวัน/เวลา : ทุกวันจันทร์ เวลา 20.00 – 21.30 น.\r\nเริ่มจันทร์ที่ 2 มกราคม – ครั้งสุดท้ายจันทร์ที่ 26 มิถุนายน 2560\r\n\r\nอัตราค่าสมัคร : 6000 บาท\r\n\r\n*** สมาชิก CDC Talk Webinar เดิม ลด 10% เหลือเพียง 5400 บาท\r\n\r\n*** สมาชิกเวป Chaloke.com ลด 5% เหลือเพียง 5700 บาท\r\n\r\n**** Early Bird Promotion พิเศษ สำหรับท่านที่สนใจสมัคก่อน 30 พย. 59 เหลือเพียง 5400 บาท****\r\n\r\nหมายเหตุ\r\n\r\n– เลือกรับส่วนได้เพียงแบบใดแบบหนึ่ง ไม่สามารถนำมารวมกันได้\r\n\r\n– กลุ่มปิดใน Facebook เราไม่เปิดให้สมัครได้ทั่วไป ทีมงานจะส่ง invite ให้เฉพาะสมาชิก CDC Talk Webinar เท่านั้น\r\n\r\nหากสมัคร CDC Talk แล้วต้องการเข้าร่วมกลุ่ม กรุณาแจ้งไปที่ info@cdcwebinarteam.com\r\n\r\n*** CDC Talk Webinar 2017 (JAN-JUNE) หากเต็มก็ปิดรับสมัครเลยนะครับ***\r\n\r\nขั้นตอนการสมัคร CDC Talk Webinar 2017 (JAN-JUNE)\r\n\r\n1. โอนเงินเข้าบัญชี\r\nกรุณาตรวจสอบเลขบัญชีให้แม่นยำ และอย่าโอนผิดบัญชี\r\nบัญชี : ออมทรัพย์ ธ.ไทยพาณิชย์\r\nสาขา : ลาดพร้าว 59\r\nชื่อบัญชี : งานสัมมนา 2 โดย นาย โฉลก สัมพันธารักษ์\r\nเลขที่บัญชี : 0104339911\r\n\r\nแจ้งโอนเงินและกรอกข้อมูลผู้สมัครที่ฟอร์มตาม Link ด้านล่างนี้\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\nhttps://goo.gl/nhyh6k\r\n\r\n<img class="alignnone size-full wp-image-197" src="http://52.76.37.90/wp-content/uploads/2017/07/LINK-สมัคร-web-20171.png" alt="" width="150" height="150" />\r\n\r\n**** Early Bird Promotion พิเศษ สำหรับท่านที่สนใจสมัคก่อน 30 พย. 59 เหลือเพียง 5400 บาท****\r\n\r\nผู้ที่สมัครทุกท่านจะได้รับ email ตอบรับการสมัครภายใน 7 วัน (อาจมีล่าช้าบ้าง)\r\n\r\nสำหรับทุกคำถามขอให้โพสไว้ในกระทู้นี้หรือที่\r\nemail : info@cdcwebinar.com หรือ\r\nCDC Webinar Facebook Page https://www.facebook.com/CDCWebinar\r\n\r\nหมายเหตุ :\r\n– กรุณากรอกข้อมูลให้ครบทุกช่องและ email ต้องถูกต้องและใช้ได้จริง มิฉะนั้นถือว่าการจองไม่สมบูรณ์ และทีมงานจะไม่สามารถส่ง เมล์ตอบรับหรือ Link ทางเข้าห้องสัมนาให้ได้\r\n– เพื่อความสะดวกและรวดเร็วในการทำงานกรุณาโอนเงินก่อนค่อยมากรอกข้อมูลการจอง ไม่รับจองก่อนโอนทุกกรณี หากตรวจพบเราขอลบการสมัครออกและต้องเริ่มสมัครใหม่อีกครั้งนะครับ\r\n– กรุณาอ่านและทำตามขั้นตอนอย่างเคร่งครัดเพื่อลดความผิดพลาดใด ๆ ที่จะทำให้เกิดความล่าช้า\r\n– เพื่อความสะดวกรวดเร็วในการรับสมัคร ขอความร่วมมือให้ “แยกสมัคร” เช่นหากคุณต้องการสมัครพร้อมกันหลายคน เช่น 3 คน\r\nก็ให้โอนเงิน 3 ครั้ง และ ลงทะเบียน 3 รอบ คือแยกทำทีละ 1 คน และ email ที่ใช้สมัครของแต่ละคน ต้องไม่ซ้ำกัน\r\n\r\nดูวิธีเตรียมพร้อมสำหรับเข้าร่วมสัมนาออนไลน์ทาง Webinar ได้ที่กระทู้ที่คุณหมอสืบพงษ์ทีมงาน CDC Webinar Team อธิบายไว้แล้วตามนี้ครับ\r\n\r\nQuick Reference Guide https://goo.gl/VTNsT4\r\nMobile Web version https://goo.gl/i8HD8o\r\n\r\nสอบถามข้อมูลเพิ่มเติม\r\nสามารถโทรติดต่อสอบถามข้อมูลได้ที่หมายเลขโทรศัพท์: 098-765-5641\r\nหรือ ติดต่อที่\r\n\r\ne-mail: info@chaloke.com\r\n\r\nFB : CDC ChalokeDotCom\r\n\r\nYoutube : CDC chaloke dot com\r\n\r\n@Line : @chalokedotcom', 'เปิดรับสมัคร CDC TALK WEBINAR 2017', '', 'inherit', 'closed', 'closed', '', '196-revision-v1', '', '', '2017-07-05 16:35:39', '2017-07-05 09:35:39', '', 196, 'http://52.76.37.90/2017/07/05/196-revision-v1/', 0, 'revision', '', 0) ;

#
# End of data contents of table `wp_posts`
# --------------------------------------------------------



#
# Delete any existing table `wp_term_relationships`
#

DROP TABLE IF EXISTS `wp_term_relationships`;


#
# Table structure of table `wp_term_relationships`
#

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_term_relationships`
#
INSERT INTO `wp_term_relationships` ( `object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(19, 6, 0),
(23, 2, 0),
(23, 11, 0),
(23, 12, 0),
(23, 16, 0),
(38, 14, 0),
(38, 16, 0),
(77, 6, 0),
(94, 6, 0),
(103, 6, 0),
(177, 1, 0),
(192, 27, 0),
(193, 27, 0),
(196, 28, 0) ;

#
# End of data contents of table `wp_term_relationships`
# --------------------------------------------------------



#
# Delete any existing table `wp_term_taxonomy`
#

DROP TABLE IF EXISTS `wp_term_taxonomy`;


#
# Table structure of table `wp_term_taxonomy`
#

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_term_taxonomy`
#
INSERT INTO `wp_term_taxonomy` ( `term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 2),
(2, 2, 'product_type', '', 0, 1),
(3, 3, 'product_type', '', 0, 0),
(4, 4, 'product_type', '', 0, 0),
(5, 5, 'product_type', '', 0, 0),
(6, 6, 'nav_menu', '', 0, 4),
(7, 7, 'nav_menu', '', 0, 0),
(8, 8, 'product_cat', '', 0, 0),
(9, 9, 'product_cat', '', 0, 0),
(10, 10, 'product_cat', '', 0, 0),
(11, 11, 'product_tag', '', 0, 1),
(12, 12, 'product_tag', '', 0, 1),
(13, 13, 'product_shipping_class', 'Free EMS or Kerry Shipping for customers in Thailand', 0, 0),
(14, 14, 'product_type', '', 0, 0),
(15, 15, 'product_type', '', 0, 0),
(16, 16, 'product_cat', '', 0, 1),
(17, 17, 'product_visibility', '', 0, 0),
(18, 18, 'product_visibility', '', 0, 0),
(19, 19, 'product_visibility', '', 0, 0),
(20, 20, 'product_visibility', '', 0, 0),
(21, 21, 'product_visibility', '', 0, 0),
(22, 22, 'product_visibility', '', 0, 0),
(23, 23, 'product_visibility', '', 0, 0),
(24, 24, 'product_visibility', '', 0, 0),
(25, 25, 'product_visibility', '', 0, 0),
(26, 26, 'wpfcas-category', '', 0, 0),
(27, 27, 'action-group', '', 0, 0),
(28, 28, 'category', '', 0, 1) ;

#
# End of data contents of table `wp_term_taxonomy`
# --------------------------------------------------------



#
# Delete any existing table `wp_termmeta`
#

DROP TABLE IF EXISTS `wp_termmeta`;


#
# Table structure of table `wp_termmeta`
#

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_termmeta`
#
INSERT INTO `wp_termmeta` ( `meta_id`, `term_id`, `meta_key`, `meta_value`) VALUES
(1, 8, 'order', '0'),
(2, 9, 'order', '0'),
(3, 10, 'order', '0'),
(4, 8, 'product_count_product_cat', '0'),
(5, 11, 'product_count_product_tag', '1'),
(6, 12, 'product_count_product_tag', '1'),
(7, 16, 'order', '0'),
(8, 16, 'product_count_product_cat', '1') ;

#
# End of data contents of table `wp_termmeta`
# --------------------------------------------------------



#
# Delete any existing table `wp_terms`
#

DROP TABLE IF EXISTS `wp_terms`;


#
# Table structure of table `wp_terms`
#

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_terms`
#
INSERT INTO `wp_terms` ( `term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'simple', 'simple', 0),
(3, 'grouped', 'grouped', 0),
(4, 'variable', 'variable', 0),
(5, 'external', 'external', 0),
(6, 'Navigation', 'navigation', 0),
(7, 'User Control', 'user-control', 0),
(8, 'Membership', 'membership', 0),
(9, 'Courses', 'courses', 0),
(10, 'Products', 'products', 0),
(11, 'membership', 'membership', 0),
(12, 'supporting', 'supporting', 0),
(13, 'Free Shipping', 'free', 0),
(14, 'subscription', 'subscription', 0),
(15, 'Variable Subscription', 'variable-subscription', 0),
(16, 'Subscriptions', 'subscriptions', 0),
(17, 'exclude-from-search', 'exclude-from-search', 0),
(18, 'exclude-from-catalog', 'exclude-from-catalog', 0),
(19, 'featured', 'featured', 0),
(20, 'outofstock', 'outofstock', 0),
(21, 'rated-1', 'rated-1', 0),
(22, 'rated-2', 'rated-2', 0),
(23, 'rated-3', 'rated-3', 0),
(24, 'rated-4', 'rated-4', 0),
(25, 'rated-5', 'rated-5', 0),
(26, 'Front Page', 'fp', 0),
(27, 'woocommerce-memberships', 'woocommerce-memberships', 0),
(28, 'Courses', 'courses', 0) ;

#
# End of data contents of table `wp_terms`
# --------------------------------------------------------



#
# Delete any existing table `wp_usermeta`
#

DROP TABLE IF EXISTS `wp_usermeta`;


#
# Table structure of table `wp_usermeta`
#

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_usermeta`
#
INSERT INTO `wp_usermeta` ( `umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'cdc-admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'wp_capabilities', 'a:2:{s:13:"administrator";b:1;s:13:"bbp_keymaster";b:1;}'),
(11, 1, 'wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wcs_pointer,bws_shortcode_button_tooltip'),
(13, 1, 'show_welcome_panel', '1'),
(15, 1, 'wp_dashboard_quick_press_last_post_id', '131'),
(16, 1, 'manageedit-shop_ordercolumnshidden', 'a:1:{i:0;s:15:"billing_address";}'),
(17, 1, 'wp_user-settings', 'libraryContent=browse&mfold=o&editor=tinymce'),
(18, 1, 'wp_user-settings-time', '1499246091'),
(19, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";i:4;s:15:"title-attribute";}'),
(20, 1, 'metaboxhidden_nav-menus', 'a:5:{i:0;s:30:"woocommerce_endpoints_nav_link";i:1;s:21:"add-post-type-product";i:2;s:12:"add-post_tag";i:3;s:15:"add-product_cat";i:4;s:15:"add-product_tag";}'),
(21, 1, 'nav_menu_recently_edited', '6'),
(23, 1, 'billing_first_name', 'Piriya'),
(24, 1, 'billing_last_name', 'Sambandaraksa'),
(25, 1, 'billing_company', 'Chaloke Dot Com Company Limited'),
(26, 1, 'billing_email', 'yadamon@gmail.com'),
(27, 1, 'billing_phone', '0944895944'),
(28, 1, 'billing_country', 'TH'),
(29, 1, 'billing_address_1', '19 Moo1 Klong 5'),
(30, 1, 'billing_address_2', 'Ladsawai'),
(31, 1, 'billing_city', 'Lamlugga'),
(32, 1, 'billing_state', 'TH-13'),
(33, 1, 'billing_postcode', '12150'),
(34, 1, 'paying_customer', '1'),
(37, 1, 'closedpostboxes_product', 'a:1:{i:0;s:11:"commentsdiv";}'),
(38, 1, 'metaboxhidden_product', 'a:2:{i:0;s:10:"postcustom";i:1;s:7:"slugdiv";}'),
(39, 1, 'meta-box-order_dashboard', 'a:4:{s:6:"normal";s:75:"dashboard_right_now,dashboard_activity,woocommerce_dashboard_recent_reviews";s:4:"side";s:21:"dashboard_quick_press";s:7:"column3";s:28:"woocommerce_dashboard_status";s:7:"column4";s:17:"dashboard_primary";}'),
(40, 1, 'closedpostboxes_dashboard', 'a:0:{}'),
(41, 1, 'metaboxhidden_dashboard', 'a:0:{}'),
(42, 1, '_wc_plugin_framework_memberships_dismissed_messages', 'a:1:{s:18:"get-started-notice";b:1;}'),
(137, 1, '_woocommerce_persistent_cart', 'a:1:{s:4:"cart";a:1:{s:32:"a5771bce93e200c36f7cd9dfd0e5deaa";a:9:{s:10:"product_id";i:38;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:8:"line_tax";i:0;s:13:"line_subtotal";i:1296;s:17:"line_subtotal_tax";i:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}}'),
(164, 1, 'wp_user_avatar', '87'),
(165, 1, 'last_update', '1468310146'),
(166, 1, 'jetpack_tracks_wpcom_id', '1293504'),
(167, 5, 'nickname', 'test1'),
(168, 5, 'first_name', ''),
(169, 5, 'last_name', ''),
(170, 5, 'description', ''),
(171, 5, 'rich_editing', 'true'),
(172, 5, 'comment_shortcuts', 'false'),
(173, 5, 'admin_color', 'fresh'),
(174, 5, 'use_ssl', '0'),
(175, 5, 'show_admin_bar_front', 'true'),
(176, 5, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(177, 5, 'wp_user_level', '0'),
(178, 5, 'default_password_nag', '1'),
(191, 7, 'nickname', 'nokhooktatooto'),
(192, 7, 'first_name', 'tirawan'),
(193, 7, 'last_name', 'nampadung'),
(194, 7, 'description', ''),
(195, 7, 'rich_editing', 'true'),
(196, 7, 'comment_shortcuts', 'false'),
(197, 7, 'admin_color', 'fresh'),
(198, 7, 'use_ssl', '0'),
(199, 7, 'show_admin_bar_front', 'true'),
(200, 7, 'wp_capabilities', 'a:2:{s:10:"subscriber";b:1;s:15:"bbp_participant";b:1;}'),
(201, 7, 'wp_user_level', '0'),
(202, 7, 'last_update', '1472617702'),
(204, 7, 'session_tokens', 'a:1:{s:64:"8c6c54d45d64572a6a44c145acc4b1d153e16d8fc963278fea4be4c03b5cbf50";a:4:{s:10:"expiration";i:1477620266;s:2:"ip";s:12:"27.55.64.194";s:2:"ua";s:130:"Mozilla/5.0 (iPad; CPU OS 7_0_2 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) GSA/9.0.60246 Mobile/11A501 Safari/9537.53";s:5:"login";i:1476410666;}}'),
(205, 7, 'manageedit-shop_ordercolumnshidden', 'a:1:{i:0;s:15:"billing_address";}'),
(206, 7, 'wp__bbp_forum_subscriptions', '81'),
(249, 11, 'nickname', 'CrefLof'),
(250, 11, 'first_name', 'CrefLof'),
(251, 11, 'last_name', 'CrefLof'),
(252, 11, 'description', ''),
(253, 11, 'rich_editing', 'true'),
(254, 11, 'comment_shortcuts', 'false'),
(255, 11, 'admin_color', 'fresh'),
(256, 11, 'use_ssl', '0'),
(257, 11, 'show_admin_bar_front', 'true'),
(258, 11, 'locale', ''),
(259, 11, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(260, 11, 'wp_user_level', '0'),
(261, 11, 'last_update', '1483541082'),
(263, 12, 'nickname', 'Sotojeano'),
(264, 12, 'first_name', 'Sotojeano'),
(265, 12, 'last_name', 'Sotojeano'),
(266, 12, 'description', ''),
(267, 12, 'rich_editing', 'true'),
(268, 12, 'comment_shortcuts', 'false'),
(269, 12, 'admin_color', 'fresh'),
(270, 12, 'use_ssl', '0'),
(271, 12, 'show_admin_bar_front', 'true'),
(272, 12, 'locale', ''),
(273, 12, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(274, 12, 'wp_user_level', '0'),
(275, 12, 'last_update', '1483566280'),
(291, 14, 'nickname', 'bestdoci'),
(292, 14, 'first_name', 'bestdoci'),
(293, 14, 'last_name', 'bestdoci'),
(294, 14, 'description', ''),
(295, 14, 'rich_editing', 'true') ;
INSERT INTO `wp_usermeta` ( `umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(296, 14, 'comment_shortcuts', 'false'),
(297, 14, 'admin_color', 'fresh'),
(298, 14, 'use_ssl', '0'),
(299, 14, 'show_admin_bar_front', 'true'),
(300, 14, 'locale', ''),
(301, 14, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(302, 14, 'wp_user_level', '0'),
(303, 14, 'last_update', '1483604384'),
(319, 16, 'nickname', 'WebPilotcog'),
(320, 16, 'first_name', 'WebPilotcog'),
(321, 16, 'last_name', 'WebPilotcog'),
(322, 16, 'description', ''),
(323, 16, 'rich_editing', 'true'),
(324, 16, 'comment_shortcuts', 'false'),
(325, 16, 'admin_color', 'fresh'),
(326, 16, 'use_ssl', '0'),
(327, 16, 'show_admin_bar_front', 'true'),
(328, 16, 'locale', ''),
(329, 16, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(330, 16, 'wp_user_level', '0'),
(331, 16, 'last_update', '1483698266'),
(332, 1, '_woocommerce_persistent_cart_1', 'a:1:{s:4:"cart";a:0:{}}'),
(333, 1, 'community-events-location', 'a:1:{s:2:"ip";s:11:"125.25.40.0";}'),
(350, 18, 'nickname', 'tawee004'),
(351, 18, 'first_name', 'tawee'),
(352, 18, 'last_name', 'wsb'),
(353, 18, 'description', ''),
(354, 18, 'rich_editing', 'true'),
(355, 18, 'comment_shortcuts', 'false'),
(356, 18, 'admin_color', 'fresh'),
(357, 18, 'use_ssl', '0'),
(358, 18, 'show_admin_bar_front', 'true'),
(359, 18, 'locale', ''),
(360, 18, 'wp_capabilities', 'a:2:{s:10:"subscriber";b:1;s:15:"bbp_participant";b:1;}'),
(361, 18, 'wp_user_level', '0'),
(362, 18, 'last_update', '1499062085'),
(364, 18, 'session_tokens', 'a:2:{s:64:"22e92e28f77b9327ab2f043e64efbd6d31fa268bb1b94bf10d4c9e4edeac26ef";a:4:{s:10:"expiration";i:1499235246;s:2:"ip";s:14:"223.24.162.156";s:2:"ua";s:114:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36";s:5:"login";i:1499062446;}s:64:"4b05f4cfa5c7f79703a688d87e5dc0e4dbd0570bf34a405678e12ea27648b0fa";a:4:{s:10:"expiration";i:1499235402;s:2:"ip";s:14:"223.24.162.156";s:2:"ua";s:114:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36";s:5:"login";i:1499062602;}}'),
(365, 1, 'session_tokens', 'a:4:{s:64:"9442edc5e0c18bb291d987502e473c4a0b8ad60ad259d7b37571d450e0cceed0";a:4:{s:10:"expiration";i:1499330602;s:2:"ip";s:14:"118.172.250.12";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36";s:5:"login";i:1499157802;}s:64:"1f23b349e5209658d4e5b02595c88b22f86085df38eace52f244c349b02c2293";a:4:{s:10:"expiration";i:1499330615;s:2:"ip";s:14:"118.172.250.12";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36";s:5:"login";i:1499157815;}s:64:"32bd9504d4f7c3c24938bdd7806206cc76f644ec0c7bb05e316eb74b6dc4d64b";a:4:{s:10:"expiration";i:1499359091;s:2:"ip";s:15:"118.174.154.184";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36";s:5:"login";i:1499186291;}s:64:"381ab8fb5f38ce690b62019d3c1e8481be42256ac1805d0083409abbdca4e5eb";a:4:{s:10:"expiration";i:1499359098;s:2:"ip";s:15:"118.174.154.184";s:2:"ua";s:115:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36";s:5:"login";i:1499186298;}}'),
(366, 1, 'closedpostboxes_page', 'a:0:{}'),
(367, 1, 'metaboxhidden_page', 'a:4:{i:0;s:10:"postcustom";i:1;s:16:"commentstatusdiv";i:2;s:11:"commentsdiv";i:3;s:7:"slugdiv";}'),
(368, 1, 'meta-box-order_page', 'a:3:{s:4:"side";s:36:"submitdiv,pageparentdiv,postimagediv";s:6:"normal";s:94:"postcustom,commentstatusdiv,commentsdiv,slugdiv,authordiv,wc-memberships-post-memberships-data";s:8:"advanced";s:0:"";}'),
(369, 1, 'screen_layout_page', '2'),
(370, 1, 'closedpostboxes_featured_post', 'a:0:{}'),
(371, 1, 'metaboxhidden_featured_post', 'a:1:{i:0;s:7:"slugdiv";}'),
(372, 19, 'nickname', 'Test11'),
(373, 19, 'first_name', 'เทสต์'),
(374, 19, 'last_name', 'ทดสอบศักดิ์'),
(375, 19, 'description', ''),
(376, 19, 'rich_editing', 'true'),
(377, 19, 'comment_shortcuts', 'false'),
(378, 19, 'admin_color', 'fresh'),
(379, 19, 'use_ssl', '0'),
(380, 19, 'show_admin_bar_front', 'true'),
(381, 19, 'locale', ''),
(382, 19, 'wp_capabilities', 'a:2:{s:10:"subscriber";b:1;s:15:"bbp_participant";b:1;}'),
(383, 19, 'wp_user_level', '0'),
(384, 19, 'last_update', '1499188442'),
(386, 19, 'session_tokens', 'a:1:{s:64:"1a1e1e1272f9015011cfc22219b2c136813dfcf67f471df4fbf05c487f794f3a";a:4:{s:10:"expiration";i:1499361047;s:2:"ip";s:15:"118.174.154.184";s:2:"ua";s:126:"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36 OPR/46.0.2597.32";s:5:"login";i:1499188247;}}'),
(388, 19, 'billing_first_name', 'เทสต์'),
(389, 19, 'billing_last_name', 'ทดสอบศักดิ์'),
(390, 19, 'billing_company', 'หนึ่งสองหนึ่งสอง'),
(391, 19, 'billing_address_1', '13 เอล์มสตรีท'),
(392, 19, 'billing_city', 'Lamlugga'),
(393, 19, 'billing_state', 'TH-13'),
(394, 19, 'billing_postcode', '12150'),
(395, 19, 'billing_country', 'TH'),
(396, 19, 'billing_email', 'test@test.com'),
(397, 19, 'billing_phone', '0987655678'),
(398, 19, 'shipping_method', ''),
(399, 19, '_woocommerce_persistent_cart_1', 'a:1:{s:4:"cart";a:0:{}}'),
(400, 19, 'paying_customer', '1') ;

#
# End of data contents of table `wp_usermeta`
# --------------------------------------------------------



#
# Delete any existing table `wp_users`
#

DROP TABLE IF EXISTS `wp_users`;


#
# Table structure of table `wp_users`
#

CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_users`
#
INSERT INTO `wp_users` ( `ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'cdc-admin', '$P$B.j484GIxHP3WPdHvk1z0KwHSjCMFF/', 'cdc-admin', 'chalokedotcom@gmail.com', '', '2016-06-30 09:59:52', '', 0, 'cdc-admin'),
(5, 'test1', '$P$BCf.7I6ZHPhIWYycKsDZGpnS/./l0i1', 'test1', 'piriya33@gmail.com', '', '2016-07-13 10:05:16', '1468404317:$P$BOlIFuYlsIj.tw8YDPNYRVcKGKpJti/', 0, 'test1'),
(7, 'nokhooktatooto', '$P$Bymj2NS26vh9ZcdF3EYcavIXJh6y8A/', 'nokhooktatooto', 'nokhooktatooto@gmail.com', '', '2016-08-31 04:28:21', '', 0, 'nokhooktatooto'),
(11, 'CrefLof', '$P$BKLZxXwFuAt5RFQ6cWBP38PuPoJtNf/', 'creflof', 'matryona.grechanin.o.v.a@gmail.com', '', '2017-01-04 14:44:42', '', 0, 'CrefLof'),
(12, 'Sotojeano', '$P$BSNmjJ9gpl6mg8G3QfsawAA/fhL.fU1', 'sotojeano', 'support889@gmail.com', '', '2017-01-04 21:44:39', '', 0, 'Sotojeano'),
(14, 'bestdoci', '$P$B93ewSsZdJFq3UkRPLUfwMH9tQgMkK/', 'bestdoci', 'mamontvlad@outlook.com', '', '2017-01-05 08:19:44', '', 0, 'bestdoci'),
(16, 'WebPilotcog', '$P$Bwk/LjOVrwBIRqAC80cbfcCTYZyU5E0', 'webpilotcog', 'webpilot@strdonetsk.com', '', '2017-01-06 10:24:26', '', 0, 'WebPilotcog'),
(18, 'tawee004', '$P$Ba.uDqqLC3p3rX29bVbpUVHpaAwVer.', 'tawee004', 'tawee.wsb04@gmail.com', '', '2017-07-03 06:08:05', '', 0, 'tawee004'),
(19, 'Test11', '$P$Bi5YNqO80G5RgKZrXOYQcowoD2hZXf/', 'test11', 'test@test.com', '', '2017-07-04 17:10:36', '', 0, 'Test11') ;

#
# End of data contents of table `wp_users`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_api_keys`
#

DROP TABLE IF EXISTS `wp_woocommerce_api_keys`;


#
# Table structure of table `wp_woocommerce_api_keys`
#

CREATE TABLE `wp_woocommerce_api_keys` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_key` char(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_secret` char(43) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nonces` longtext COLLATE utf8mb4_unicode_ci,
  `truncated_key` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_access` datetime DEFAULT NULL,
  PRIMARY KEY (`key_id`),
  KEY `consumer_key` (`consumer_key`),
  KEY `consumer_secret` (`consumer_secret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_api_keys`
#

#
# End of data contents of table `wp_woocommerce_api_keys`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_attribute_taxonomies`
#

DROP TABLE IF EXISTS `wp_woocommerce_attribute_taxonomies`;


#
# Table structure of table `wp_woocommerce_attribute_taxonomies`
#

CREATE TABLE `wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_label` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_orderby` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_public` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`attribute_id`),
  KEY `attribute_name` (`attribute_name`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_attribute_taxonomies`
#

#
# End of data contents of table `wp_woocommerce_attribute_taxonomies`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_downloadable_product_permissions`
#

DROP TABLE IF EXISTS `wp_woocommerce_downloadable_product_permissions`;


#
# Table structure of table `wp_woocommerce_downloadable_product_permissions`
#

CREATE TABLE `wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `download_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `order_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `downloads_remaining` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`),
  KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`(191),`download_id`),
  KEY `download_order_product` (`download_id`,`order_id`,`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_downloadable_product_permissions`
#

#
# End of data contents of table `wp_woocommerce_downloadable_product_permissions`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_log`
#

DROP TABLE IF EXISTS `wp_woocommerce_log`;


#
# Table structure of table `wp_woocommerce_log`
#

CREATE TABLE `wp_woocommerce_log` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `context` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`log_id`),
  KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


#
# Data contents of table `wp_woocommerce_log`
#

#
# End of data contents of table `wp_woocommerce_log`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_order_itemmeta`
#

DROP TABLE IF EXISTS `wp_woocommerce_order_itemmeta`;


#
# Table structure of table `wp_woocommerce_order_itemmeta`
#

CREATE TABLE `wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `order_item_id` (`order_item_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_order_itemmeta`
#
INSERT INTO `wp_woocommerce_order_itemmeta` ( `meta_id`, `order_item_id`, `meta_key`, `meta_value`) VALUES
(1, 1, '_qty', '1'),
(2, 1, '_tax_class', ''),
(3, 1, '_product_id', '23'),
(4, 1, '_variation_id', '0'),
(5, 1, '_line_subtotal', '1296'),
(6, 1, '_line_total', '1296'),
(7, 1, '_line_subtotal_tax', '0'),
(8, 1, '_line_tax', '0'),
(9, 1, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(10, 2, '_qty', '1'),
(11, 2, '_tax_class', ''),
(12, 2, '_product_id', '38'),
(13, 2, '_variation_id', '0'),
(14, 2, '_line_subtotal', '0'),
(15, 2, '_line_total', '0'),
(16, 2, '_line_subtotal_tax', '0'),
(17, 2, '_line_tax', '0'),
(18, 2, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(19, 3, '_qty', '1'),
(20, 3, '_tax_class', ''),
(21, 3, '_product_id', '38'),
(22, 3, '_variation_id', '0'),
(23, 3, '_line_subtotal', '1296'),
(24, 3, '_line_total', '1296'),
(25, 3, '_line_subtotal_tax', '0'),
(26, 3, '_line_tax', '0'),
(27, 3, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(28, 3, '_has_trial', 'true'),
(29, 4, '_qty', '1'),
(30, 4, '_tax_class', ''),
(31, 4, '_product_id', '38'),
(32, 4, '_variation_id', '0'),
(33, 4, '_line_subtotal', '1296'),
(34, 4, '_line_total', '1296'),
(35, 4, '_line_subtotal_tax', '0'),
(36, 4, '_line_tax', '0'),
(37, 4, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(38, 5, '_qty', '1'),
(39, 5, '_tax_class', ''),
(40, 5, '_product_id', '38'),
(41, 5, '_variation_id', '0'),
(42, 5, '_line_subtotal', '1296'),
(43, 5, '_line_total', '1296'),
(44, 5, '_line_subtotal_tax', '0'),
(45, 5, '_line_tax', '0'),
(46, 5, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(47, 6, '_qty', '1'),
(48, 6, '_tax_class', ''),
(49, 6, '_product_id', '38'),
(50, 6, '_variation_id', '0'),
(51, 6, '_line_subtotal', '1296'),
(52, 6, '_line_total', '1296'),
(53, 6, '_line_subtotal_tax', '0'),
(54, 6, '_line_tax', '0'),
(55, 6, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(56, 7, '_qty', '1'),
(57, 7, '_tax_class', ''),
(58, 7, '_product_id', '38'),
(59, 7, '_variation_id', '0'),
(60, 7, '_line_subtotal', '1296'),
(61, 7, '_line_total', '1296'),
(62, 7, '_line_subtotal_tax', '0'),
(63, 7, '_line_tax', '0'),
(64, 7, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(65, 8, '_qty', '1'),
(66, 8, '_tax_class', ''),
(67, 8, '_product_id', '23'),
(68, 8, '_variation_id', '0'),
(69, 8, '_line_subtotal', '1296'),
(70, 8, '_line_total', '1296'),
(71, 8, '_line_subtotal_tax', '0'),
(72, 8, '_line_tax', '0'),
(73, 8, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(74, 9, '_qty', '1'),
(75, 9, '_tax_class', ''),
(76, 9, '_product_id', '38'),
(77, 9, '_variation_id', '0'),
(78, 9, '_line_subtotal', '1296'),
(79, 9, '_line_total', '1296'),
(80, 9, '_line_subtotal_tax', '0'),
(81, 9, '_line_tax', '0'),
(82, 9, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(92, 11, '_qty', '1'),
(93, 11, '_tax_class', ''),
(94, 11, '_product_id', '23'),
(95, 11, '_variation_id', '0'),
(96, 11, '_line_subtotal', '1296'),
(97, 11, '_line_total', '1296'),
(98, 11, '_line_subtotal_tax', '0'),
(99, 11, '_line_tax', '0'),
(100, 11, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(101, 12, '_qty', '1'),
(102, 12, '_tax_class', ''),
(103, 12, '_product_id', '23'),
(104, 12, '_variation_id', '0'),
(105, 12, '_line_subtotal', '1296'),
(106, 12, '_line_total', '1296'),
(107, 12, '_line_subtotal_tax', '0'),
(108, 12, '_line_tax', '0'),
(109, 12, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}') ;
INSERT INTO `wp_woocommerce_order_itemmeta` ( `meta_id`, `order_item_id`, `meta_key`, `meta_value`) VALUES
(119, 14, '_qty', '1'),
(120, 14, '_tax_class', ''),
(121, 14, '_product_id', '38'),
(122, 14, '_variation_id', '0'),
(123, 14, '_line_subtotal', '1296'),
(124, 14, '_line_total', '1296'),
(125, 14, '_line_subtotal_tax', '0'),
(126, 14, '_line_tax', '0'),
(127, 14, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(128, 15, '_qty', '1'),
(129, 15, '_tax_class', ''),
(130, 15, '_product_id', '38'),
(131, 15, '_variation_id', '0'),
(132, 15, '_line_subtotal', '1296'),
(133, 15, '_line_total', '1296'),
(134, 15, '_line_subtotal_tax', '0'),
(135, 15, '_line_tax', '0'),
(136, 15, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(137, 16, '_qty', '1'),
(138, 16, '_tax_class', ''),
(139, 16, '_product_id', '38'),
(140, 16, '_variation_id', '0'),
(141, 16, '_line_subtotal', '1296'),
(142, 16, '_line_total', '1296'),
(143, 16, '_line_subtotal_tax', '0'),
(144, 16, '_line_tax', '0'),
(145, 16, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(146, 17, '_qty', '1'),
(147, 17, '_tax_class', ''),
(148, 17, '_product_id', '23'),
(149, 17, '_variation_id', '0'),
(150, 17, '_line_subtotal', '1296'),
(151, 17, '_line_total', '1296'),
(152, 17, '_line_subtotal_tax', '0'),
(153, 17, '_line_tax', '0'),
(154, 17, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}'),
(155, 18, '_product_id', '23'),
(156, 18, '_variation_id', '0'),
(157, 18, '_qty', '1'),
(158, 18, '_tax_class', ''),
(159, 18, '_line_subtotal', '1296'),
(160, 18, '_line_subtotal_tax', '0'),
(161, 18, '_line_total', '1296'),
(162, 18, '_line_tax', '0'),
(163, 18, '_line_tax_data', 'a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}') ;

#
# End of data contents of table `wp_woocommerce_order_itemmeta`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_order_items`
#

DROP TABLE IF EXISTS `wp_woocommerce_order_items`;


#
# Table structure of table `wp_woocommerce_order_items`
#

CREATE TABLE `wp_woocommerce_order_items` (
  `order_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_order_items`
#
INSERT INTO `wp_woocommerce_order_items` ( `order_item_id`, `order_item_name`, `order_item_type`, `order_id`) VALUES
(1, 'Supporting Membership', 'line_item', 25),
(2, 'Supporting Membership (Credit Card)', 'line_item', 45),
(3, 'Supporting Membership (Credit Card)', 'line_item', 46),
(4, 'Supporting Membership', 'line_item', 47),
(5, 'Supporting Membership', 'line_item', 48),
(6, 'Supporting Membership', 'line_item', 52),
(7, 'Supporting Membership', 'line_item', 53),
(8, 'Supporting Membership (จ่ายด้วยเงินสด)', 'line_item', 55),
(9, 'Supporting Membership', 'line_item', 56),
(11, 'Supporting Membership (จ่ายด้วยเงินสด)', 'line_item', 60),
(12, 'Supporting Membership (จ่ายด้วยเงินสด)', 'line_item', 62),
(14, 'Supporting Membership', 'line_item', 67),
(15, 'Supporting Membership', 'line_item', 66),
(16, 'Supporting Membership', 'line_item', 68),
(17, 'Supporting Membership (จ่ายด้วยเงินสด)', 'line_item', 69),
(18, 'Supporting Membership (จ่ายด้วยเงินสด)', 'line_item', 190) ;

#
# End of data contents of table `wp_woocommerce_order_items`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_payment_tokenmeta`
#

DROP TABLE IF EXISTS `wp_woocommerce_payment_tokenmeta`;


#
# Table structure of table `wp_woocommerce_payment_tokenmeta`
#

CREATE TABLE `wp_woocommerce_payment_tokenmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_token_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `payment_token_id` (`payment_token_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_payment_tokenmeta`
#

#
# End of data contents of table `wp_woocommerce_payment_tokenmeta`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_payment_tokens`
#

DROP TABLE IF EXISTS `wp_woocommerce_payment_tokens`;


#
# Table structure of table `wp_woocommerce_payment_tokens`
#

CREATE TABLE `wp_woocommerce_payment_tokens` (
  `token_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gateway_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`token_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_payment_tokens`
#

#
# End of data contents of table `wp_woocommerce_payment_tokens`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_sessions`
#

DROP TABLE IF EXISTS `wp_woocommerce_sessions`;


#
# Table structure of table `wp_woocommerce_sessions`
#

CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_expiry` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`session_key`),
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=451 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_sessions`
#
INSERT INTO `wp_woocommerce_sessions` ( `session_id`, `session_key`, `session_value`, `session_expiry`) VALUES
(416, '0512c29f7cd231efe90664b9bad158ec', 'a:19:{s:4:"cart";s:307:"a:1:{s:32:"37693cfc748049e45d87b8c7d8b9aacd";a:9:{s:10:"product_id";i:23;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:8:"line_tax";i:0;s:13:"line_subtotal";i:1296;s:17:"line_subtotal_tax";i:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";d:1296;s:5:"total";i:0;s:8:"subtotal";i:1296;s:15:"subtotal_ex_tax";i:1296;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";s:10:"wc_notices";N;}', 1484023885),
(442, '1', 'a:19:{s:8:"customer";s:793:"a:25:{s:2:"id";i:1;s:8:"postcode";s:5:"12150";s:4:"city";s:8:"Lamlugga";s:9:"address_1";s:15:"19 Moo1 Klong 5";s:7:"address";s:15:"19 Moo1 Klong 5";s:9:"address_2";s:8:"Ladsawai";s:5:"state";s:5:"TH-13";s:7:"country";s:2:"TH";s:17:"shipping_postcode";s:0:"";s:13:"shipping_city";s:0:"";s:18:"shipping_address_1";s:0:"";s:16:"shipping_address";s:0:"";s:18:"shipping_address_2";s:0:"";s:14:"shipping_state";s:5:"TH-13";s:16:"shipping_country";s:2:"TH";s:13:"is_vat_exempt";b:0;s:19:"calculated_shipping";b:0;s:10:"first_name";s:6:"Piriya";s:9:"last_name";s:13:"Sambandaraksa";s:7:"company";s:31:"Chaloke Dot Com Company Limited";s:5:"phone";s:10:"0944895944";s:5:"email";s:17:"yadamon@gmail.com";s:19:"shipping_first_name";s:0:"";s:18:"shipping_last_name";s:0:"";s:16:"shipping_company";s:0:"";}";s:4:"cart";s:6:"a:0:{}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";i:0;s:5:"total";i:0;s:8:"subtotal";i:0;s:15:"subtotal_ex_tax";i:0;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";}', 1499359055),
(435, '17', 'a:19:{s:8:"customer";s:668:"a:25:{s:2:"id";i:17;s:8:"postcode";s:0:"";s:4:"city";s:0:"";s:9:"address_1";s:0:"";s:7:"address";s:0:"";s:9:"address_2";s:0:"";s:5:"state";s:0:"";s:7:"country";s:2:"TH";s:17:"shipping_postcode";s:0:"";s:13:"shipping_city";s:0:"";s:18:"shipping_address_1";s:0:"";s:16:"shipping_address";s:0:"";s:18:"shipping_address_2";s:0:"";s:14:"shipping_state";s:0:"";s:16:"shipping_country";s:2:"TH";s:13:"is_vat_exempt";b:0;s:19:"calculated_shipping";b:0;s:10:"first_name";s:0:"";s:9:"last_name";s:0:"";s:7:"company";s:0:"";s:5:"phone";s:0:"";s:5:"email";s:17:"toesaporn@msn.com";s:19:"shipping_first_name";s:0:"";s:18:"shipping_last_name";s:0:"";s:16:"shipping_company";s:0:"";}";s:4:"cart";s:6:"a:0:{}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";i:0;s:5:"total";i:0;s:8:"subtotal";i:0;s:15:"subtotal_ex_tax";i:0;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";}', 1499007476),
(436, '18', 'a:1:{s:8:"customer";s:672:"a:25:{s:2:"id";i:18;s:8:"postcode";s:0:"";s:4:"city";s:0:"";s:9:"address_1";s:0:"";s:7:"address";s:0:"";s:9:"address_2";s:0:"";s:5:"state";s:0:"";s:7:"country";s:2:"TH";s:17:"shipping_postcode";s:0:"";s:13:"shipping_city";s:0:"";s:18:"shipping_address_1";s:0:"";s:16:"shipping_address";s:0:"";s:18:"shipping_address_2";s:0:"";s:14:"shipping_state";s:0:"";s:16:"shipping_country";s:2:"TH";s:13:"is_vat_exempt";b:0;s:19:"calculated_shipping";b:0;s:10:"first_name";s:0:"";s:9:"last_name";s:0:"";s:7:"company";s:0:"";s:5:"phone";s:0:"";s:5:"email";s:21:"tawee.wsb04@gmail.com";s:19:"shipping_first_name";s:0:"";s:18:"shipping_last_name";s:0:"";s:16:"shipping_company";s:0:"";}";}', 1499235246),
(440, '1884dc36e731c38702ecfc4dcdc6d9f7', 'a:20:{s:4:"cart";s:307:"a:1:{s:32:"37693cfc748049e45d87b8c7d8b9aacd";a:9:{s:10:"product_id";i:23;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:13:"line_subtotal";d:1296;s:8:"line_tax";d:0;s:17:"line_subtotal_tax";d:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";d:1296;s:5:"total";d:1296;s:8:"subtotal";i:1296;s:15:"subtotal_ex_tax";i:1296;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";s:8:"customer";s:649:"a:25:{s:2:"id";i:0;s:8:"postcode";s:0:"";s:4:"city";s:0:"";s:9:"address_1";s:0:"";s:7:"address";s:0:"";s:9:"address_2";s:0:"";s:5:"state";s:0:"";s:7:"country";s:2:"TH";s:17:"shipping_postcode";s:0:"";s:13:"shipping_city";s:0:"";s:18:"shipping_address_1";s:0:"";s:16:"shipping_address";s:0:"";s:18:"shipping_address_2";s:0:"";s:14:"shipping_state";s:0:"";s:16:"shipping_country";s:2:"TH";s:13:"is_vat_exempt";b:0;s:19:"calculated_shipping";b:1;s:10:"first_name";s:0:"";s:9:"last_name";s:0:"";s:7:"company";s:0:"";s:5:"phone";s:0:"";s:5:"email";s:0:"";s:19:"shipping_first_name";s:0:"";s:18:"shipping_last_name";s:0:"";s:16:"shipping_company";s:0:"";}";s:21:"chosen_payment_method";s:4:"bacs";}', 1499337118),
(449, '19', 'a:21:{s:8:"customer";s:946:"a:25:{s:2:"id";i:19;s:8:"postcode";s:5:"12150";s:4:"city";s:8:"Lamlugga";s:9:"address_1";s:33:"13 เอล์มสตรีท";s:7:"address";s:33:"13 เอล์มสตรีท";s:9:"address_2";s:0:"";s:5:"state";s:5:"TH-13";s:7:"country";s:2:"TH";s:17:"shipping_postcode";s:5:"12150";s:13:"shipping_city";s:8:"Lamlugga";s:18:"shipping_address_1";s:33:"13 เอล์มสตรีท";s:16:"shipping_address";s:33:"13 เอล์มสตรีท";s:18:"shipping_address_2";s:0:"";s:14:"shipping_state";s:5:"TH-13";s:16:"shipping_country";s:2:"TH";s:13:"is_vat_exempt";b:0;s:19:"calculated_shipping";b:1;s:10:"first_name";s:15:"เทสต์";s:9:"last_name";s:33:"ทดสอบศักดิ์";s:7:"company";s:48:"หนึ่งสองหนึ่งสอง";s:5:"phone";s:10:"0987655678";s:5:"email";s:13:"test@test.com";s:19:"shipping_first_name";s:0:"";s:18:"shipping_last_name";s:0:"";s:16:"shipping_company";s:0:"";}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:21:"chosen_payment_method";s:4:"bacs";s:19:"wcs_renewal_coupons";s:6:"a:0:{}";s:4:"cart";s:6:"a:0:{}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:19:"cart_contents_total";i:0;s:5:"total";i:0;s:8:"subtotal";i:0;s:15:"subtotal_ex_tax";i:0;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";}', 1499361059),
(413, '82a0e8c53064654b9b62c7d2fc654604', 'a:19:{s:4:"cart";s:307:"a:1:{s:32:"37693cfc748049e45d87b8c7d8b9aacd";a:9:{s:10:"product_id";i:23;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:8:"line_tax";i:0;s:13:"line_subtotal";i:1296;s:17:"line_subtotal_tax";i:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";d:1296;s:5:"total";i:0;s:8:"subtotal";i:1296;s:15:"subtotal_ex_tax";i:1296;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";s:10:"wc_notices";N;}', 1484023861),
(414, 'cc5394f2998b768695bad550e1914584', 'a:19:{s:4:"cart";s:307:"a:1:{s:32:"37693cfc748049e45d87b8c7d8b9aacd";a:9:{s:10:"product_id";i:23;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:8:"line_tax";i:0;s:13:"line_subtotal";i:1296;s:17:"line_subtotal_tax";i:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";d:1296;s:5:"total";i:0;s:8:"subtotal";i:1296;s:15:"subtotal_ex_tax";i:1296;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";s:10:"wc_notices";N;}', 1484023881),
(450, 'f10205af9a420951f69c0cce3fcda21d', 'a:19:{s:4:"cart";s:307:"a:1:{s:32:"37693cfc748049e45d87b8c7d8b9aacd";a:9:{s:10:"product_id";i:23;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:13:"line_subtotal";d:1296;s:8:"line_tax";d:0;s:17:"line_subtotal_tax";d:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";d:1296;s:5:"total";d:1296;s:8:"subtotal";i:1296;s:15:"subtotal_ex_tax";i:1296;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";s:8:"customer";s:649:"a:25:{s:2:"id";i:0;s:8:"postcode";s:0:"";s:4:"city";s:0:"";s:9:"address_1";s:0:"";s:7:"address";s:0:"";s:9:"address_2";s:0:"";s:5:"state";s:0:"";s:7:"country";s:2:"TH";s:17:"shipping_postcode";s:0:"";s:13:"shipping_city";s:0:"";s:18:"shipping_address_1";s:0:"";s:16:"shipping_address";s:0:"";s:18:"shipping_address_2";s:0:"";s:14:"shipping_state";s:0:"";s:16:"shipping_country";s:2:"TH";s:13:"is_vat_exempt";b:0;s:19:"calculated_shipping";b:0;s:10:"first_name";s:0:"";s:9:"last_name";s:0:"";s:7:"company";s:0:"";s:5:"phone";s:0:"";s:5:"email";s:0:"";s:19:"shipping_first_name";s:0:"";s:18:"shipping_last_name";s:0:"";s:16:"shipping_company";s:0:"";}";}', 1499400532),
(415, 'f3b4f4a3a7cce3dfcc704500f7d9c422', 'a:19:{s:4:"cart";s:307:"a:1:{s:32:"37693cfc748049e45d87b8c7d8b9aacd";a:9:{s:10:"product_id";i:23;s:12:"variation_id";i:0;s:9:"variation";a:0:{}s:8:"quantity";i:1;s:10:"line_total";d:1296;s:8:"line_tax";i:0;s:13:"line_subtotal";i:1296;s:17:"line_subtotal_tax";i:0;s:13:"line_tax_data";a:2:{s:5:"total";a:0:{}s:8:"subtotal";a:0:{}}}}";s:15:"applied_coupons";s:6:"a:0:{}";s:23:"coupon_discount_amounts";s:6:"a:0:{}";s:27:"coupon_discount_tax_amounts";s:6:"a:0:{}";s:21:"removed_cart_contents";s:6:"a:0:{}";s:19:"cart_contents_total";d:1296;s:5:"total";i:0;s:8:"subtotal";i:1296;s:15:"subtotal_ex_tax";i:1296;s:9:"tax_total";i:0;s:5:"taxes";s:6:"a:0:{}";s:14:"shipping_taxes";s:6:"a:0:{}";s:13:"discount_cart";i:0;s:17:"discount_cart_tax";i:0;s:14:"shipping_total";i:0;s:18:"shipping_tax_total";i:0;s:9:"fee_total";i:0;s:4:"fees";s:6:"a:0:{}";s:10:"wc_notices";N;}', 1484023883) ;

#
# End of data contents of table `wp_woocommerce_sessions`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_shipping_zone_locations`
#

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_locations`;


#
# Table structure of table `wp_woocommerce_shipping_zone_locations`
#

CREATE TABLE `wp_woocommerce_shipping_zone_locations` (
  `location_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` bigint(20) unsigned NOT NULL,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `location_id` (`location_id`),
  KEY `location_type` (`location_type`),
  KEY `location_type_code` (`location_type`,`location_code`(90))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_shipping_zone_locations`
#
INSERT INTO `wp_woocommerce_shipping_zone_locations` ( `location_id`, `zone_id`, `location_code`, `location_type`) VALUES
(1, 1, 'TH', 'country') ;

#
# End of data contents of table `wp_woocommerce_shipping_zone_locations`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_shipping_zone_methods`
#

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_methods`;


#
# Table structure of table `wp_woocommerce_shipping_zone_methods`
#

CREATE TABLE `wp_woocommerce_shipping_zone_methods` (
  `zone_id` bigint(20) unsigned NOT NULL,
  `instance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_order` bigint(20) unsigned NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`instance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_shipping_zone_methods`
#
INSERT INTO `wp_woocommerce_shipping_zone_methods` ( `zone_id`, `instance_id`, `method_id`, `method_order`, `is_enabled`) VALUES
(1, 1, 'free_shipping', 1, 1) ;

#
# End of data contents of table `wp_woocommerce_shipping_zone_methods`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_shipping_zones`
#

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zones`;


#
# Table structure of table `wp_woocommerce_shipping_zones`
#

CREATE TABLE `wp_woocommerce_shipping_zones` (
  `zone_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_order` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_shipping_zones`
#
INSERT INTO `wp_woocommerce_shipping_zones` ( `zone_id`, `zone_name`, `zone_order`) VALUES
(1, 'Standard Shipping', 0) ;

#
# End of data contents of table `wp_woocommerce_shipping_zones`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_tax_rate_locations`
#

DROP TABLE IF EXISTS `wp_woocommerce_tax_rate_locations`;


#
# Table structure of table `wp_woocommerce_tax_rate_locations`
#

CREATE TABLE `wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate_id` bigint(20) unsigned NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `tax_rate_id` (`tax_rate_id`),
  KEY `location_type` (`location_type`),
  KEY `location_type_code` (`location_type`,`location_code`(90))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_tax_rate_locations`
#

#
# End of data contents of table `wp_woocommerce_tax_rate_locations`
# --------------------------------------------------------



#
# Delete any existing table `wp_woocommerce_tax_rates`
#

DROP TABLE IF EXISTS `wp_woocommerce_tax_rates`;


#
# Table structure of table `wp_woocommerce_tax_rates`
#

CREATE TABLE `wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tax_rate_country` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) unsigned NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT '0',
  `tax_rate_shipping` int(1) NOT NULL DEFAULT '1',
  `tax_rate_order` bigint(20) unsigned NOT NULL,
  `tax_rate_class` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`tax_rate_id`),
  KEY `tax_rate_country` (`tax_rate_country`),
  KEY `tax_rate_state` (`tax_rate_state`(191)),
  KEY `tax_rate_class` (`tax_rate_class`(191)),
  KEY `tax_rate_priority` (`tax_rate_priority`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


#
# Data contents of table `wp_woocommerce_tax_rates`
#
INSERT INTO `wp_woocommerce_tax_rates` ( `tax_rate_id`, `tax_rate_country`, `tax_rate_state`, `tax_rate`, `tax_rate_name`, `tax_rate_priority`, `tax_rate_compound`, `tax_rate_shipping`, `tax_rate_order`, `tax_rate_class`) VALUES
(1, 'TH', '', '7.0000', 'VAT', 1, 0, 1, 0, '') ;

#
# End of data contents of table `wp_woocommerce_tax_rates`
# --------------------------------------------------------

#
# Add constraints back in and apply any alter data queries.
#

