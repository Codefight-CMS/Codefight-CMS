-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2013 at 02:04 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `codefight`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_banner`
--

DROP TABLE IF EXISTS `cf_banner`;
CREATE TABLE IF NOT EXISTS `cf_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(64) NOT NULL DEFAULT '',
  `banner_url` varchar(255) NOT NULL DEFAULT '',
  `banner_image` varchar(64) NOT NULL DEFAULT '',
  `banner_group` varchar(255) NOT NULL DEFAULT '',
  `banner_html_text` text,
  `expire_impressions` int(7) DEFAULT '0',
  `expire_clicks` int(7) DEFAULT '0',
  `expire_date` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cf_banner`
--


-- --------------------------------------------------------

--
-- Table structure for table `cf_banner_history`
--

DROP TABLE IF EXISTS `cf_banner_history`;
CREATE TABLE IF NOT EXISTS `cf_banner_history` (
  `banner_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL DEFAULT '0',
  `banner_shown` int(5) NOT NULL DEFAULT '0',
  `banner_clicked` int(5) NOT NULL DEFAULT '0',
  `banner_history_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`banner_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cf_banner_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `cf_file`
--

DROP TABLE IF EXISTS `cf_file`;
CREATE TABLE IF NOT EXISTS `cf_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_title` varchar(255) DEFAULT NULL,
  `file_description` text,
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `file_size` decimal(8,2) DEFAULT '0.00',
  `is_image` int(1) DEFAULT '0',
  `image_width` int(11) DEFAULT '0',
  `image_height` int(11) DEFAULT '0',
  `file_access` varchar(255) DEFAULT NULL,
  `file_access_members` varchar(255) DEFAULT NULL,
  `file_status` int(1) NOT NULL DEFAULT '0',
  `file_publish_date` datetime DEFAULT '0000-00-00 00:00:00',
  `file_expire_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `cf_file`
--

INSERT INTO `cf_file` (`file_id`, `file_title`, `file_description`, `folder_id`, `file_name`, `file_path`, `file_type`, `file_ext`, `file_size`, `is_image`, `image_width`, `image_height`, `file_access`, `file_access_members`, `file_status`, `file_publish_date`, `file_expire_date`) VALUES
(11, 'Software Box', 'Codefight software package box', 2, 'Codefight-CMS-A-Codeigniter-CMS.jpg', 'media/gallery/', 'image/jpeg', '.jpg', 191.14, 1, 716, 762, 'public', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Screenshot', 'This is a screenshot image file.', 2, 'codefight-1.2_.0_.png', 'media/gallery/', 'image/png', '.png', 13.76, 1, 720, 285, 'public', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Codefight CMS 2.0 Youtube video', 'Codefight cms preview', 1, 'codefight-cms-2-0-preview.png', 'media/', 'image/png', '.png', 59.80, 1, 500, 296, 'public', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Penguins', 'Penguins sample image', 1, 'Penguins.jpg', 'media/', 'image/jpeg', '.jpg', 759.60, 1, 1024, 768, 'all', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cf_folder`
--

DROP TABLE IF EXISTS `cf_folder`;
CREATE TABLE IF NOT EXISTS `cf_folder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_parent_id` int(11) NOT NULL DEFAULT '0',
  `folder_path` varchar(255) DEFAULT NULL,
  `folder_name` varchar(255) DEFAULT NULL,
  `folder_status` int(1) DEFAULT '0',
  `folder_thumb` varchar(255) DEFAULT NULL,
  `folder_access` varchar(255) DEFAULT NULL,
  `folder_access_members` varchar(255) DEFAULT NULL,
  `folder_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`folder_id`),
  KEY `folder_sort` (`folder_sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cf_folder`
--

INSERT INTO `cf_folder` (`folder_id`, `folder_parent_id`, `folder_path`, `folder_name`, `folder_status`, `folder_thumb`, `folder_access`, `folder_access_members`, `folder_sort`) VALUES
(1, 0, '/', 'Home', 1, NULL, 'all', NULL, 1),
(2, 1, '/gallery/', 'gallery', 1, 'codefight-1.2_.0-2_.png', 'public', NULL, 3),
(3, 1, '/banners/', 'banners', 1, '', 'public', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_data_int`
--

DROP TABLE IF EXISTS `cf_form_data_int`;
CREATE TABLE IF NOT EXISTS `cf_form_data_int` (
  `form_submitted_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_data` int(11) NOT NULL,
  KEY `form_submitted_id` (`form_submitted_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_form_data_int`
--


-- --------------------------------------------------------

--
-- Table structure for table `cf_form_data_text`
--

DROP TABLE IF EXISTS `cf_form_data_text`;
CREATE TABLE IF NOT EXISTS `cf_form_data_text` (
  `form_submitted_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_data` text,
  KEY `form_submitted_id` (`form_submitted_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_form_data_text`
--

INSERT INTO `cf_form_data_text` (`form_submitted_id`, `form_item_id`, `form_item_data`) VALUES
(8, 16, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n \nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?\n\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'),
(2, 16, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n \nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?\n\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'),
(21, 16, 'Hi,\nThanks for downloading and trying codefight cms.\nHopefully you will like it.\nAny feedback from you will be highly appreciated as it will help to make it more better and better.\nThanks.\n\nRegards,\nDamu');

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_data_varchar`
--

DROP TABLE IF EXISTS `cf_form_data_varchar`;
CREATE TABLE IF NOT EXISTS `cf_form_data_varchar` (
  `form_submitted_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_data` varchar(255) DEFAULT NULL,
  KEY `form_submitted_id` (`form_submitted_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_form_data_varchar`
--

INSERT INTO `cf_form_data_varchar` (`form_submitted_id`, `form_item_id`, `form_item_data`) VALUES
(8, 14, 'dbashyal@xyz.com'),
(8, 13, 'Damodar Bashyal'),
(2, 13, 'Damodar Bashyal'),
(2, 14, 'dbashyal@xyz.com'),
(8, 18, 'hydrogen,oxygen,'),
(8, 17, 'Male'),
(21, 13, 'Damodar Bashyal'),
(21, 22, '0400000000'),
(21, 14, 'dbashyal@gmail.com'),
(21, 21, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_group`
--

DROP TABLE IF EXISTS `cf_form_group`;
CREATE TABLE IF NOT EXISTS `cf_form_group` (
  `form_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_group_name` varchar(25) DEFAULT NULL,
  `form_group_identifier` varchar(35) DEFAULT NULL,
  `form_group_send_to` text,
  PRIMARY KEY (`form_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cf_form_group`
--

INSERT INTO `cf_form_group` (`form_group_id`, `form_group_name`, `form_group_identifier`, `form_group_send_to`) VALUES
(4, 'Contact Us', 'contact_us', 'noreply@codefightcms.com');

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_item`
--

DROP TABLE IF EXISTS `cf_form_item`;
CREATE TABLE IF NOT EXISTS `cf_form_item` (
  `form_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_item_name` varchar(50) NOT NULL,
  `form_item_label` varchar(50) NOT NULL,
  `form_item_input_type` varchar(15) NOT NULL,
  `form_item_validations` varchar(200) NOT NULL,
  `form_item_default_value` varchar(200) NOT NULL,
  `form_item_parameters` varchar(200) NOT NULL,
  `form_item_data_type` varchar(7) NOT NULL DEFAULT 'varchar',
  `form_item_grid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`form_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `cf_form_item`
--

INSERT INTO `cf_form_item` (`form_item_id`, `form_item_name`, `form_item_label`, `form_item_input_type`, `form_item_validations`, `form_item_default_value`, `form_item_parameters`, `form_item_data_type`, `form_item_grid`) VALUES
(13, 'name', 'Your Name', 'textbox', 'trim|xss_clean', '', 'class="txtFld"', 'varchar', 1),
(14, 'contact_email', 'Contact Email', 'textbox', 'trim|required|valid_email', '', 'class="txtFld"', 'varchar', 1),
(15, 'submit', 'Submit', 'submit', '', '', ' class="btn btn-primary"', 'varchar', 0),
(16, 'message', 'Your Message', 'textarea', 'trim|required', '', 'class="txtFld"', 'text', 0),
(17, 'gender', 'Gender', 'radio', '', 'm=Male|f=Female', '', 'varchar', 1),
(18, 'newsletters_options[]', 'Select newsletters you would like to subscribe', 'checkbox', '', '1=maths|2=computer|3=science', '', 'varchar', 0),
(20, 'file', 'file', 'file', 'trim|required', '', 'class=&quot;txtFld&quot;', 'text', 0),
(21, 'receive_by', 'Who do you want to receive this submission?', 'select', 'trim|required', 'Admin=Admin|Sales=Sales|Support=Support', 'class=&quot;txtFld&quot;', 'varchar', 0),
(22, 'contact_number', 'Contact Number', 'textbox', 'trim', '', 'class="txtFld"', 'varchar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_item_to_group`
--

DROP TABLE IF EXISTS `cf_form_item_to_group`;
CREATE TABLE IF NOT EXISTS `cf_form_item_to_group` (
  `form_group_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_sort` int(11) NOT NULL,
  `form_item_grid` int(11) NOT NULL DEFAULT '0',
  KEY `form_groups_id` (`form_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_form_item_to_group`
--

INSERT INTO `cf_form_item_to_group` (`form_group_id`, `form_item_id`, `form_item_sort`, `form_item_grid`) VALUES
(4, 14, 3, 1),
(4, 13, 1, 1),
(4, 15, 8, 0),
(4, 16, 6, 0),
(4, 21, 7, 0),
(4, 22, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_submitted`
--

DROP TABLE IF EXISTS `cf_form_submitted`;
CREATE TABLE IF NOT EXISTS `cf_form_submitted` (
  `form_submitted_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_group_id` int(11) NOT NULL,
  `form_status` int(11) NOT NULL,
  PRIMARY KEY (`form_submitted_id`),
  KEY `form_groups_id` (`form_group_id`,`form_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `cf_form_submitted`
--

INSERT INTO `cf_form_submitted` (`form_submitted_id`, `form_group_id`, `form_status`) VALUES
(8, 4, 0),
(2, 4, 1),
(21, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_group`
--

DROP TABLE IF EXISTS `cf_group`;
CREATE TABLE IF NOT EXISTS `cf_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `group_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `groups_title` (`group_title`),
  KEY `groups_sort` (`group_sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cf_group`
--

INSERT INTO `cf_group` (`group_id`, `group_title`, `group_description`, `group_sort`) VALUES
(1, 'Administrator', 'Users who have admin access rights go to this group.', 1),
(2, 'Public', 'General users go to this group.', 4),
(3, 'Registered User', 'Registered User Group.', 3),
(4, 'Authors', 'Give access to only certain areas for authors like article/cms sections.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cf_group_permission`
--

DROP TABLE IF EXISTS `cf_group_permission`;
CREATE TABLE IF NOT EXISTS `cf_group_permission` (
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_group_permission`
--

INSERT INTO `cf_group_permission` (`group_id`, `module_id`) VALUES
(1, 0),
(1, 1),
(1, 11),
(1, 12),
(1, 2),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 3),
(1, 45),
(1, 20),
(1, 21),
(1, 4),
(1, 22),
(1, 23),
(1, 52),
(1, 5),
(1, 25),
(1, 26),
(1, 27),
(1, 6),
(1, 28),
(1, 29),
(1, 7),
(1, 30),
(1, 31),
(1, 32),
(1, 49),
(1, 33),
(1, 34),
(1, 35),
(1, 50),
(1, 51),
(1, 8),
(1, 46),
(1, 47),
(1, 48),
(1, 9),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 10),
(1, 42),
(1, 43),
(1, 44),
(4, 1),
(4, 12),
(4, 5),
(4, 25),
(4, 26),
(4, 27);

-- --------------------------------------------------------

--
-- Table structure for table `cf_installs`
--

DROP TABLE IF EXISTS `cf_installs`;
CREATE TABLE IF NOT EXISTS `cf_installs` (
  `installs_id` int(11) NOT NULL AUTO_INCREMENT,
  `website` varchar(255) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`installs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cf_installs`
--

INSERT INTO `cf_installs` (`installs_id`, `website`, `count`, `date`) VALUES
(1, 'tools/version', 1, '2012-03-28 15:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `cf_menu`
--

DROP TABLE IF EXISTS `cf_menu`;
CREATE TABLE IF NOT EXISTS `cf_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_active` int(1) NOT NULL DEFAULT '0',
  `menu_parent_id` int(11) DEFAULT '0',
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_params` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL,
  `menu_type` varchar(255) NOT NULL DEFAULT 'pages',
  `menu_meta_title` varchar(70) DEFAULT NULL,
  `menu_meta_keywords` varchar(200) DEFAULT NULL,
  `menu_meta_description` varchar(150) DEFAULT NULL,
  `menu_sort` int(11) NOT NULL DEFAULT '0',
  `websites_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `cf_menu`
--

INSERT INTO `cf_menu` (`menu_id`, `menu_active`, `menu_parent_id`, `menu_link`, `menu_params`, `menu_title`, `menu_type`, `menu_meta_title`, `menu_meta_keywords`, `menu_meta_description`, `menu_sort`, `websites_id`) VALUES
(72, 1, 0, 'codefight-cms-preview-built-with-codeigniter-2.0-framework-demo-code', NULL, 'Preview / Demo', 'page', '', '', '', 4, ',1,'),
(86, 1, 0, 'releases', '', 'Releases', 'blog', '', '', '', 10, ',1,3,'),
(71, 1, 0, 'privacy-policy', NULL, 'Privacy Policy', 'page', '', '', '', 8, ',3,4,'),
(40, 1, 0, 'http://twitter.com/dbashyal', NULL, 'Twitter', 'favourite-links', '', '', '', 1, ',1,2,3,'),
(41, 1, 0, 'http://www.linkedin.com/in/dbashyal', NULL, 'Linked In', 'favourite-links', '', '', '', 2, ',1,2,3,'),
(75, 1, 0, 'home', NULL, 'Home', 'page', '', '', '', 0, ',1,2,3,4,'),
(88, 1, 0, 'jobs', '', 'JOBS', 'blog', '', '', '', 20, ',4,'),
(69, 1, 0, 'http://zoosper.com', NULL, 'zoosper', 'sponsored-links', '', '', '', 0, ',1,2,3,'),
(70, 1, 0, 'http://codefight.org/', '', 'Codefight CMS', 'blog-roll', '', '', '', 0, ',1,'),
(80, 1, 0, 'blog', NULL, 'Blog', 'page', '', '', '', 1, ',1,2,3,4,'),
(81, 1, 0, 'download-latest-codefight-cms', '', 'Downloads', 'page', '', '', '', 2, ',1,3,'),
(82, 1, 0, 'about-us', NULL, 'About Us', 'page', '', '', '', 5, ',2,3,4,'),
(83, 1, 0, 'contact-us', NULL, 'Contact Us', 'page', '', '', '', 6, ',1,2,3,4,'),
(84, 1, 0, 'http://www.tenthweb.com/forums/viewforum.php?title=codefight.org&f=49', NULL, 'Forum', 'page', '', '', '', 3, ',1,3,'),
(109, 1, 0, 'advertising', NULL, 'Advertising', 'blog', '', '', '', 1, ',2,'),
(85, 1, 0, 'search', NULL, 'Search', 'page', '', '', '', 9, ',2,3,4,'),
(89, 1, 0, 'web-resources', '', 'Web Resources', 'blog', '', '', '', 11, ',4,'),
(90, 1, 0, 'codeigniter', '', 'Codeigniter', 'blog', '', '', '', 13, ',1,'),
(91, 1, 0, 'zend', '', 'Zend', 'blog', '', '', '', 12, ',4,'),
(92, 1, 0, 'magento', '', 'Magento', 'blog', '', '', '', 14, ',4,'),
(93, 1, 0, 'diary', '', 'Diary', 'blog', '', '', '', 15, ',1,4,'),
(94, 1, 0, 'nepal', '', 'Nepal', 'blog', '', '', '', 16, ',1,'),
(95, 1, 0, 'australia', '', 'Australia', 'blog', '', '', '', 17, ',4,'),
(96, 1, 0, 'guest-articles', '', 'Guest Articles', 'blog', '', '', '', 18, ',4,'),
(97, 1, 0, 'tips', '', 'Tips', 'blog', '', '', '', 19, ',4,'),
(98, 1, 0, 'http://learntipsandtricks.com/blog', '', 'Tips & Tricks', 'blog-roll', '', '', '', 1, ',1,'),
(99, 1, 0, 'http://sponsormeclub.org/', '', 'sponsorMEclub', 'blog-roll', '', '', '', 3, ',1,'),
(100, 1, 0, 'http://houseforlove.com/blog/tag/story', '', 'Lost Soul', 'blog-roll', '', '', '', 2, ',1,'),
(101, 1, 0, 'http://sketchawebsite.com/', '', 'HTML5 Templates', 'blog-roll', '', '', '', 4, ',1,'),
(102, 0, 0, 'http://forums.zoosper.com/', NULL, 'Forums', 'sponsored-links', '', '', '', 0, ',1,'),
(103, 1, 0, 'http://astore.zoosper.com/node/22/cat/Books', NULL, 'Zoosper Shopping Centre', 'sponsored-links', '', '', '', 0, ',1,'),
(104, 1, 0, 'http://www.clixGalore.com/PSale.aspx?BID=528&amp;AfID=86513&amp;AdID=26', NULL, 'Earn Commission For Life', 'sponsored-links', '', '', '', 0, ',1,'),
(105, 1, 0, 'http://www.dpbolvw.net/click-3424053-10422157', NULL, 'Host Monster', 'favourite-links', '', '', '', 4, ',1,'),
(106, 1, 0, 'http://www.facebook.com/codefight', NULL, 'Facebook', 'favourite-links', '', '', '', 0, ',1,'),
(107, 1, 0, 'http://astore.zoosper.com/node/22/cat/Books', NULL, 'Zoosper Shopping Centre', 'favourite-links', '', '', '', 3, ',1,'),
(108, 1, 0, 'codefight-cms', '', 'CodeFight CMS', 'blog', '', '', '', 5, ',1,'),
(110, 1, 0, 'affiliate-marketing', NULL, 'Affiliate Marketing', 'blog', '', '', '', 2, ',2,'),
(111, 1, 0, 'google-page-rank', NULL, 'Google Page Rank', 'blog', '', '', '', 6, ',2,'),
(112, 1, 0, 'search-engine-optimization', NULL, 'Search Engine Optimization', 'blog', '', '', '', 7, ',2,'),
(113, 1, 0, 'http://astore.zoosper.org/search?node=22&keywords=codeigniter&x=0&y=0&preview=', '', 'Books', 'blog-roll', '', '', '', 0, ',1,'),
(114, 1, 0, 'alexa', NULL, 'Alexa', 'blog', '', '', '', 3, ',2,'),
(115, 1, 0, 'social-media', NULL, 'Social Media', 'blog', '', '', '', 8, ',2,'),
(116, 1, 0, 'facebook', NULL, 'Facebook', 'blog', '', '', '', 4, ',2,'),
(117, 1, 0, 'twitter', NULL, 'Twitter', 'blog', '', '', '', 9, ',2,'),
(118, 1, 0, 'adsense', NULL, 'Adsense', 'blog', '', '', '', 0, ',2,'),
(119, 1, 0, 'javascript:void(0)', 'onclick="language_selection();"', 'Select Language', 'page', '', '', '', 7, ',1,'),
(120, 1, 0, 'login|logout', '', '[Login|Logout]', 'page', '', '', '', 10, ',1,');

-- --------------------------------------------------------

--
-- Table structure for table `cf_module`
--

DROP TABLE IF EXISTS `cf_module`;
CREATE TABLE IF NOT EXISTS `cf_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `void` int(11) NOT NULL DEFAULT '0',
  `menu` text NOT NULL,
  `child` text NOT NULL,
  `is_menu` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `cf_module`
--

INSERT INTO `cf_module` (`module_id`, `parent`, `status`, `sort`, `url`, `title`, `void`, `menu`, `child`, `is_menu`) VALUES
(1, 'top', 1, 1, 'cp', 'Admin', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:2:"cp";s:5:"title";s:5:"Admin";s:5:"child";a:2:{s:5:"cp/cp";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:5:"cp/cp";s:5:"title";s:4:"Home";}s:9:"cp/update";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:9:"cp/update";s:5:"title";s:17:"Codefight Updates";}}}', 'a:2:{i:0;s:5:"cp/cp";i:1;s:9:"cp/update";}', 1),
(2, 'top', 1, 4, 'menu', 'Menu', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:4:"menu";s:5:"title";s:4:"Menu";s:5:"child";a:6:{s:9:"menu/page";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:9:"menu/page";s:5:"title";s:10:"Page Links";}s:9:"menu/blog";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:9:"menu/blog";s:5:"title";s:15:"Blog Categories";}s:14:"menu/blog-roll";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:14:"menu/blog-roll";s:5:"title";s:9:"Blog Roll";}s:16:"menu/classifieds";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:16:"menu/classifieds";s:5:"title";s:21:"Classified Categories";}s:20:"menu/favourite-links";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:20:"menu/favourite-links";s:5:"title";s:15:"Favourite Links";}s:20:"menu/sponsored-links";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:20:"menu/sponsored-links";s:5:"title";s:15:"Sponsored Links";}}}', 'a:6:{i:0;s:9:"menu/page";i:1;s:9:"menu/blog";i:2;s:14:"menu/blog-roll";i:3;s:16:"menu/classifieds";i:4;s:20:"menu/favourite-links";i:5;s:20:"menu/sponsored-links";}', 1),
(3, 'top', 1, 11, 'user', 'User', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:4:"user";s:5:"title";s:4:"User";s:5:"child";a:3:{s:10:"user/index";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:10:"user/index";s:5:"title";s:5:"Users";}s:5:"group";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:5:"group";s:5:"title";s:6:"Groups";}s:17:"group/permissions";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:17:"group/permissions";s:5:"title";s:17:"Group Permissions";}}}', 'a:3:{i:0;s:10:"user/index";i:1;s:5:"group";i:2;s:17:"group/permissions";}', 1),
(4, 'top', 1, 15, 'form', 'Form', 0, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:4:"form";s:5:"title";s:4:"Form";s:5:"child";a:3:{s:9:"form/item";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:9:"form/item";s:5:"title";s:5:"Items";}s:10:"form/group";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:10:"form/group";s:5:"title";s:5:"Group";}s:14:"form/submitted";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:14:"form/submitted";s:5:"title";s:9:"Submitted";}}}', 'a:3:{i:0;s:9:"form/item";i:1;s:10:"form/group";i:2;s:14:"form/submitted";}', 1),
(5, 'top', 1, 19, 'page', 'CMS', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:4:"page";s:5:"title";s:3:"CMS";s:5:"child";a:3:{s:9:"page/page";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:9:"page/page";s:5:"title";s:11:"Static Page";}s:9:"page/blog";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:9:"page/blog";s:5:"title";s:12:"Blog Article";}s:10:"page/block";a:4:{s:7:"is_menu";i:0;s:4:"void";i:1;s:3:"url";s:10:"page/block";s:5:"title";s:13:"Static Blocks";}}}', 'a:3:{i:0;s:9:"page/page";i:1;s:9:"page/blog";i:2;s:10:"page/block";}', 1),
(6, 'top', 1, 23, 'comment', 'Comments', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:7:"comment";s:5:"title";s:8:"Comments";s:5:"child";a:2:{s:23:"comment/pending-comment";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:23:"comment/pending-comment";s:5:"title";s:16:"Pending Comments";}s:24:"comment/approved-comment";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:24:"comment/approved-comment";s:5:"title";s:17:"Approved Comments";}}}', 'a:2:{i:0;s:23:"comment/pending-comment";i:1;s:24:"comment/approved-comment";}', 1),
(7, 'top', 1, 26, 'media', 'Media', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:5:"media";s:5:"title";s:5:"Media";s:5:"child";a:2:{s:4:"file";a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:4:"file";s:5:"title";s:12:"File Manager";s:5:"child";a:3:{s:16:"file/manage-file";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:16:"file/manage-file";s:5:"title";s:12:"Manage Files";}s:16:"file/upload-file";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:16:"file/upload-file";s:5:"title";s:11:"Upload File";}s:16:"file/file-status";a:4:{s:7:"is_menu";i:0;s:4:"void";i:0;s:3:"url";s:16:"file/file-status";s:5:"title";s:18:"Change File Status";}}}s:6:"folder";a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:6:"folder";s:5:"title";s:14:"Folder Manager";s:5:"child";a:4:{s:20:"folder/manage-folder";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:20:"folder/manage-folder";s:5:"title";s:14:"Manage Folders";}s:20:"folder/create-folder";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:20:"folder/create-folder";s:5:"title";s:13:"Create Folder";}s:20:"folder/folder-status";a:4:{s:7:"is_menu";i:0;s:4:"void";i:0;s:3:"url";s:20:"folder/folder-status";s:5:"title";s:20:"Change folder Status";}s:18:"folder/search-file";a:4:{s:7:"is_menu";i:0;s:4:"void";i:0;s:3:"url";s:18:"folder/search-file";s:5:"title";s:25:"Search Files under folder";}}}}}', 'a:2:{i:0;s:4:"file";i:1;s:6:"folder";}', 1),
(8, 'top', 1, 36, 'banner', 'Banner', 1, 'a:5:{s:7:"is_menu";i:0;s:4:"void";i:1;s:3:"url";s:6:"banner";s:5:"title";s:6:"Banner";s:5:"child";a:3:{s:13:"banner/manage";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:13:"banner/manage";s:5:"title";s:6:"Manage";}s:13:"banner/create";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:13:"banner/create";s:5:"title";s:17:"Create New Banner";}s:13:"banner/status";a:4:{s:7:"is_menu";i:0;s:4:"void";i:0;s:3:"url";s:13:"banner/status";s:5:"title";s:20:"Change Banner Status";}}}', 'a:3:{i:0;s:13:"banner/manage";i:1;s:13:"banner/create";i:2;s:13:"banner/status";}', 0),
(9, 'top', 1, 40, 'tools', 'Tools', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:5:"tools";s:5:"title";s:5:"Tools";s:5:"child";a:4:{s:13:"modulecreator";a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:13:"modulecreator";s:5:"title";s:6:"Module";s:5:"child";a:2:{s:20:"modulecreator/create";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:20:"modulecreator/create";s:5:"title";s:6:"Create";}s:15:"moduleinstaller";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:15:"moduleinstaller";s:5:"title";s:7:"Install";}}}s:13:"setting/cache";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:13:"setting/cache";s:5:"title";s:11:"Clear Cache";}s:15:"setting/sitemap";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:15:"setting/sitemap";s:5:"title";s:16:"Generate Sitemap";}s:4:"trim";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:4:"trim";s:5:"title";s:11:"Shorten URL";}}}', 'a:4:{i:0;s:13:"modulecreator";i:1;s:13:"setting/cache";i:2;s:15:"setting/sitemap";i:3;s:4:"trim";}', 1),
(10, 'top', 1, 47, 'setting', 'Settings', 1, 'a:5:{s:7:"is_menu";i:1;s:4:"void";i:1;s:3:"url";s:7:"setting";s:5:"title";s:8:"Settings";s:5:"child";a:3:{s:12:"setting/site";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:12:"setting/site";s:5:"title";s:8:"Defaults";}s:16:"setting/websites";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:16:"setting/websites";s:5:"title";s:8:"Websites";}s:12:"setting/keys";a:4:{s:7:"is_menu";i:1;s:4:"void";i:0;s:3:"url";s:12:"setting/keys";s:5:"title";s:4:"Keys";}}}', 'a:3:{i:0;s:12:"setting/site";i:1;s:16:"setting/websites";i:2;s:12:"setting/keys";}', 1),
(11, 'cp', 1, 2, 'cp/cp', 'Home', 0, '', '', 1),
(12, 'cp', 1, 3, 'cp/update', 'Codefight Updates', 0, '', '', 1),
(13, 'menu', 1, 5, 'menu/page', 'Page Links', 0, '', '', 1),
(14, 'menu', 1, 6, 'menu/blog', 'Blog Categories', 0, '', '', 1),
(15, 'menu', 1, 7, 'menu/blog-roll', 'Blog Roll', 0, '', '', 1),
(16, 'menu', 1, 8, 'menu/classifieds', 'Classified Categories', 0, '', '', 1),
(17, 'menu', 1, 9, 'menu/favourite-links', 'Favourite Links', 0, '', '', 1),
(18, 'menu', 1, 10, 'menu/sponsored-links', 'Sponsored Links', 0, '', '', 1),
(19, 'user', 1, 12, 'user/user', 'Users', 0, '', '', 1),
(20, 'user', 1, 13, 'group', 'Groups', 0, '', '', 1),
(21, 'user', 1, 14, 'group/permissions', 'Group Permissions', 0, '', '', 1),
(22, 'form', 1, 16, 'form/item', 'Items', 0, '', '', 1),
(23, 'form', 1, 17, 'form/group', 'Group', 0, '', '', 1),
(24, 'form', 1, 18, 'menu/submitted', 'Submitted', 0, '', '', 1),
(25, 'page', 1, 20, 'page/page', 'Static Page', 0, '', '', 1),
(26, 'page', 1, 21, 'page/blog', 'Blog Article', 0, '', '', 1),
(27, 'page', 1, 22, 'page/block', 'Static Blocks', 1, '', '', 0),
(28, 'comment', 1, 24, 'comment/pending-comment', 'Pending Comments', 0, '', '', 1),
(29, 'comment', 1, 25, 'comment/approved-comment', 'Approved Comments', 0, '', '', 1),
(30, 'media', 1, 27, 'file', 'File Manager', 1, '', 'a:3:{i:0;s:16:"file/manage-file";i:1;s:16:"file/upload-file";i:2;s:16:"file/file-status";}', 1),
(31, 'file', 1, 28, 'file/manage-file', 'Manage Files', 0, '', '', 1),
(32, 'file', 1, 29, 'file/upload-file', 'Upload File', 0, '', '', 1),
(33, 'media', 1, 31, 'folder', 'Folder Manager', 1, '', 'a:4:{i:0;s:20:"folder/manage-folder";i:1;s:20:"folder/create-folder";i:2;s:20:"folder/folder-status";i:3;s:18:"folder/search-file";}', 1),
(34, 'folder', 1, 32, 'folder/manage-folder', 'Manage Folders', 0, '', '', 1),
(35, 'folder', 1, 33, 'folder/create-folder', 'Create Folder', 0, '', '', 1),
(36, 'tools', 1, 41, 'modulecreator', 'Module', 1, '', 'a:2:{i:0;s:20:"modulecreator/create";i:1;s:15:"moduleinstaller";}', 1),
(37, 'modulecreator', 1, 42, 'modulecreator/create', 'Create', 0, '', '', 1),
(38, 'modulecreator', 1, 43, 'moduleinstaller', 'Install', 0, '', '', 1),
(39, 'tools', 1, 44, 'setting/cache', 'Clear Cache', 0, '', '', 1),
(40, 'tools', 1, 45, 'setting/sitemap', 'Generate Sitemap', 0, '', '', 1),
(41, 'tools', 1, 46, 'trim', 'Shorten URL', 0, '', '', 1),
(42, 'setting', 1, 48, 'setting/site', 'Defaults', 0, '', '', 1),
(43, 'setting', 1, 49, 'setting/websites', 'Websites', 0, '', '', 1),
(44, 'setting', 1, 50, 'setting/keys', 'Keys', 0, '', '', 1),
(45, 'user', 1, 12, 'user/index', 'Users', 0, '', '', 1),
(46, 'banner', 1, 37, 'banner/manage', 'Manage', 0, '', '', 1),
(47, 'banner', 1, 38, 'banner/create', 'Create New Banner', 0, '', '', 1),
(48, 'banner', 1, 39, 'banner/status', 'Change Banner Status', 0, '', '', 0),
(49, 'file', 1, 30, 'file/file-status', 'Change File Status', 0, '', '', 0),
(50, 'folder', 1, 34, 'folder/folder-status', 'Change folder Status', 0, '', '', 0),
(51, 'folder', 1, 35, 'folder/search-file', 'Search Files under folder', 0, '', '', 0),
(52, 'form', 1, 18, 'form/submitted', 'Submitted', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_page`
--

DROP TABLE IF EXISTS `cf_page`;
CREATE TABLE IF NOT EXISTS `cf_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_active` int(1) NOT NULL DEFAULT '0',
  `page_code` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_blurb` text,
  `page_blurb_length` int(4) NOT NULL DEFAULT '0',
  `page_body` text,
  `page_image` varchar(255) DEFAULT NULL,
  `menu_id` varchar(255) NOT NULL DEFAULT '0',
  `websites_id` varchar(255) NOT NULL DEFAULT '0',
  `page_author` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `show_author` int(1) NOT NULL DEFAULT '0',
  `page_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_date_modified` datetime DEFAULT NULL,
  `show_date` int(1) NOT NULL DEFAULT '0',
  `page_tag` varchar(255) DEFAULT NULL,
  `allow_comment` int(1) NOT NULL DEFAULT '0',
  `page_type` varchar(255) NOT NULL DEFAULT 'pages',
  `page_view` int(11) DEFAULT '0',
  `page_meta_title` varchar(255) DEFAULT NULL,
  `page_meta_keywords` varchar(255) DEFAULT NULL,
  `page_meta_description` varchar(255) DEFAULT NULL,
  `page_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`),
  KEY `page_code` (`page_code`),
  KEY `menu_id` (`menu_id`),
  KEY `websites_id` (`websites_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `cf_page`
--

INSERT INTO `cf_page` (`page_id`, `page_active`, `page_code`, `page_title`, `page_blurb`, `page_blurb_length`, `page_body`, `page_image`, `menu_id`, `websites_id`, `page_author`, `user_id`, `show_author`, `page_date`, `page_date_modified`, `show_date`, `page_tag`, `allow_comment`, `page_type`, `page_view`, `page_meta_title`, `page_meta_keywords`, `page_meta_description`, `page_sort`) VALUES
(19, 1, NULL, 'How much it costs to call directly to heaven from Nepal?', '<p>An American   decided to write a book about famous churches around the World. So he bought   a plane ticket and took a trip to China   . On his first day he was inside a church taking photographs when   he Noticed a golden telephone mounted on the wall with a sign that   read "$10,000 per call". The American, being intrigued, asked a priest who   was strolling by what?The telephone was used for. The priest replied   that it was a direct line to heaven and that for $10,000 you could talk to   God.</p>\r\n<p>The American thanked the priest and went along his way.?</p>\r\n<p>Next   stop was in Japan .   There, at a very large cathedral, he saw the Same golden telephone with the same   sign under it.</p>\r\n<p>', 0, '<p>An American   decided to write a book about famous churches around the World. So he bought   a plane ticket and took a trip to China   . On his first day he was inside a church taking photographs when   he Noticed a golden telephone mounted on the wall with a sign that   read "$10,000 per call". The American, being intrigued, asked a priest who   was strolling by what?The telephone was used for. The priest replied   that it was a direct line to heaven and that for $10,000 you could talk to   God.</p>\r\n<p>The American thanked the priest and went along his way.?</p>\r\n<p>Next   stop was in Japan .   There, at a very large cathedral, he saw the Same golden telephone with the same   sign under it.</p>\r\n<p><!-- pagebreak --></p>\r\n<p>He wondered if this was the same kind of telephone he saw   in China   and He asked a nearby nun what its purpose was.</p>\r\n<p>She told him that it was   a direct line to heaven and that for $10,000 He Could talk to   God.?</p>\r\n<p>"O.K., thank you," said the American.?He then traveled to   Pakistan ,   Srilanka ,   Russia ,   Germany   and France.</p>\r\n<p>In every church he saw the same golden telephone with the same   "$10,000 Per call" sign under it.?The American, upon leaving   Vermont   decided to travel to up to?Nepal   to See if?Nepalese had the same phone.</p>\r\n<p>He?arrived in?Nepal ,   and again, in the first church he entered, there Was the same golden   telephone, but this s time the sign under it read "One Rupee per   call."</p>\r\n<p>The American was surprised so he asked the priest about the   sign. "Father, I''ve traveled all over World and I''ve seen this same   golden Telephone in many churches. I''m told that it is a direct line   to?Heaven, But in rest of the world price was $10,000 per call.</p>\r\n<p>Why   is it so cheap here?"</p>\r\n<p>Readers, it is your turn........ Think ....before   you scroll down...</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>The priest smiled and answered, "You''re   in?Nepal   now, Son -?it''s a Local Call?". This is the only heaven on the   Earth.?</p>\r\n<p>KEEP SMILING</p>\r\n<p>If you are proud to be ?Nepalese, pass this   on!!!</p>', NULL, ',93,94,', ',1,2,4,', 'Got this in email as forward from Aneeta Gurung', 11, 1, '2009-04-12 19:16:58', NULL, 1, 'Nepal,Nepali,test', 1, 'blog', 926, 'How much it costs to call directly to heaven from Nepal?', 'Nepal,Nepali,Proud to be nepalese,email forward', '', 0),
(37, 1, NULL, 'Kushal''s First Youtube Video', '<p>{{banner 2}}</p>\r\n<p>Hey! Its me Kushal Bashyal. I am 5months and 3weeks old today. I am very happy today and trying to jump. Wanna watch me jump. So, what you think? My grand mom is trying to hold me but she is very tired but i am enjoying a lot and jumping and jumping and making everyone happy. Hope you like it. Hi nanu sis, saru &amp; yeshu aunt this is for you to see me. And, everyone else as well :)</p>\r\n<p>{{banner 2}}</p>\r\n<div style="margin: 0pt auto; width: 480px; height: 385px; display: block;">\r\n<object width="480" height="385" data="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" type="application/x-shockwave-flash">\r\n<param name="allowFullScreen" value="true" />\r\n<param name="allowscriptaccess" value="always" />\r\n<param name="src" value="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" />\r\n<param name="allowfullscreen" value="true" />\r\n</object>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>', 0, '<p>{{banner 2}}</p>\r\n<p>Hey! Its me Kushal Bashyal. I am 5months and 3weeks old today. I am very happy today and trying to jump. Wanna watch me jump. So, what you think? My grand mom is trying to hold me but she is very tired but i am enjoying a lot and jumping and jumping and making everyone happy. Hope you like it. Hi nanu sis, saru &amp; yeshu aunt this is for you to see me. And, everyone else as well :)</p>\r\n<p>{{banner 2}}</p>\r\n<div style="margin: 0pt auto; width: 480px; height: 385px; display: block;">\r\n<object width="480" height="385" data="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" type="application/x-shockwave-flash">\r\n<param name="allowFullScreen" value="true" />\r\n<param name="allowscriptaccess" value="always" />\r\n<param name="src" value="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" />\r\n<param name="allowfullscreen" value="true" />\r\n</object>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>', NULL, ',93,', ',1,2,4,', 'Damodar Bashyal', 11, 1, '2009-06-06 05:45:32', NULL, 1, 'Kushal Bashyal,test', 1, 'blog', 975, 'Cute Little Happy Baby Jumping - codefight.org', 'Kushal Bashyal, Baby, Baby Jumping,Happy Baby', 'This is kushal 5months, happy and jumping with the help of grandmom', 0),
(54, 1, NULL, 'Canonical Page For All Pages That Have No Content', '<p>Blank.</p>\n<p>This is parked page for seo stuff. Inplace of meta nofollow probably i''ll use this page as canonical page.</p>', 0, '<p>Blank.</p>\n<p>This is parked page for seo stuff. Inplace of meta nofollow probably i''ll use this page as canonical page.</p>', NULL, ',0,', ',0,', 'Damodar Bashyal', 0, 1, '2010-04-16 22:32:00', NULL, 1, '', 1, 'page', 2684, 'Replacement page for meta noindex, nofollow | codefight .org', 'meta,noindex,nofollow,search,engine,page,rank', 'Remove your less value pages from search index to give more priority to main pages.', 0),
(67, 1, NULL, 'Contact Us', '<p>Please fill the form below to contact us.</p>\n<p>{{form contact_us}}</p>', 0, '<p>Please fill the form below to contact us.</p>\n<p>{{form contact_us}}</p>', NULL, ',83,', ',1,2,3,', '', 0, 0, '2010-11-01 00:00:00', NULL, 0, '', 0, 'page', 4, 'Contact Us', 'contact us,codefight cms,text link ads review,zoosper', 'Contact us for any enquiry regarding our websites.', 0),
(68, 1, NULL, 'Privacy Policy', '<p>We don''t sell your details. We don''t use your data to spam or for any other reason.</p>', 0, '<p>We don''t sell your details. We don''t use your data to spam or for any other reason.</p>', NULL, ',71,', ',2,3,', '', 0, 0, '2010-01-20 00:00:00', NULL, 0, '', 0, 'page', 0, 'Privacy Policy - codefight.org', 'privacy, policy, codefight, cms, open, source, content, management, system', 'we don''t sell your details. Codefight is a free content management system.', 0),
(69, 1, NULL, 'Google made it easy to search our sites.', '<p>Please enter the word you are looking for</p>\n<div class="google_custom_search_engine">\n<div id="cse" style="width: 100%;">Loading</div>\n<script src="http://www.google.com/jsapi" type="text/javascript"></script>\n<script type="text/javascript"><!--\n   google.load(''search'', ''1'');\n   google.setOnLoadCallback(function(){\n      new google.search.CustomSearchControl(''010442767483169701592:ibrawdecaa8'').draw(''cse'');\n   }, true);\n// --></script>\n</div>', 0, '<p>Please enter the word you are looking for</p>\n<div class="google_custom_search_engine">\n<div id="cse" style="width: 100%;">Loading</div>\n<script src="http://www.google.com/jsapi" type="text/javascript"></script>\n<script type="text/javascript"><!--\n   google.load(''search'', ''1'');\n   google.setOnLoadCallback(function(){\n      new google.search.CustomSearchControl(''010442767483169701592:ibrawdecaa8'').draw(''cse'');\n   }, true);\n// --></script>\n</div>', NULL, ',85,', ',1,2,3,', '', 0, 0, '2010-11-15 00:00:00', NULL, 0, '', 0, 'page', 9, 'Google made it easy to search our sites - codefight.org', 'google,search,made,easy,with,site search,codefight,tenthweb', 'Please enter the word you are looking for in our sites codefight and tenthweb.', 0),
(70, 1, NULL, 'Codefight CMS', '<h1>{{parse-tag url=''http://codefight.org/'' rel=''external,nofollow'' title=''Codefight CMS''}} - A light weight Codeigniter php framework cms.</h1>\r\n<div style="display:block;float:right;margin:0 0 15px;"><a title="Codefight - simple php cms using codeigniter" rel="nofollow external" href="http://cmsigniter.com/download-codefight-cms" target="_blank"><img src="http://skin.zoosper.com/media/upload/Codefight-CMS-Sfotware-md.png" border="0" alt="Download Latest SEO Friendly Codefight BLOG CMS" /></a></div>\r\n<p>Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.</p>\r\n<p>The latest version will have a multiple website manager. The new version is almost ready and is in staging for testing purpose before its official release.</p>\r\n<p>If you would like to get informed about the latest releases and news please do subscribe to our feed.</p>\r\n<p>Since Codefight CMS is available for use free of charge, I would appreciate and welcome any feedback, contributions to the code and help translating language files into your language.&nbsp;&nbsp;&nbsp;</p>\r\n<p>You can use this CMS in any way you want: You can modify it as you like and use commercially for free.</p>\r\n<p>I hope one day it will be one of the top {{parse-tag title=''Codeigniter CMS''}}</p>\r\n<p>&nbsp;</p>\r\n<p><a class="download-button" title="Download Codefight CMS" href="http://codefight.org/download-latest-codefight-cms/"><span title="download codefight cms 2.0"><span title="Download multiple website cms manager 2.0">Download</span></span></a></p>\r\n<p>&nbsp;</p>\r\n<p><a title="Watch video on codefight cms" href="http://www.youtube.com/watch?v=Z0cBtJvFov4&amp;feature=youtu.be&amp;ref=codefight.org" target="_blank"><img title="codefight CMS preview video on youtube." src="http://skin.zoosper.com/media/codefight-cms-2-0-preview.png" alt="Codefight CMS 2.0 preview" /></a></p>\r\n<h6>Codefight CMS 2.0, a multiple website management software, based on codeigniter 2.0 php framework.</h6>', 0, '<h1>{{parse-tag url=''http://codefight.org/'' rel=''external,nofollow'' title=''Codefight CMS''}} - A light weight Codeigniter php framework cms.</h1>\r\n<div style="display:block;float:right;margin:0 0 15px;"><a title="Codefight - simple php cms using codeigniter" rel="nofollow external" href="http://cmsigniter.com/download-codefight-cms" target="_blank"><img src="http://skin.zoosper.com/media/upload/Codefight-CMS-Sfotware-md.png" border="0" alt="Download Latest SEO Friendly Codefight BLOG CMS" /></a></div>\r\n<p>Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.</p>\r\n<p>The latest version will have a multiple website manager. The new version is almost ready and is in staging for testing purpose before its official release.</p>\r\n<p>If you would like to get informed about the latest releases and news please do subscribe to our feed.</p>\r\n<p>Since Codefight CMS is available for use free of charge, I would appreciate and welcome any feedback, contributions to the code and help translating language files into your language.&nbsp;&nbsp;&nbsp;</p>\r\n<p>You can use this CMS in any way you want: You can modify it as you like and use commercially for free.</p>\r\n<p>I hope one day it will be one of the top {{parse-tag title=''Codeigniter CMS''}}</p>\r\n<p>&nbsp;</p>\r\n<p><a class="download-button" title="Download Codefight CMS" href="http://codefight.org/download-latest-codefight-cms/"><span title="download codefight cms 2.0"><span title="Download multiple website cms manager 2.0">Download</span></span></a></p>\r\n<p>&nbsp;</p>\r\n<p><a title="Watch video on codefight cms" href="http://www.youtube.com/watch?v=Z0cBtJvFov4&amp;feature=youtu.be&amp;ref=codefight.org" target="_blank"><img title="codefight CMS preview video on youtube." src="http://skin.zoosper.com/media/codefight-cms-2-0-preview.png" alt="Codefight CMS 2.0 preview" /></a></p>\r\n<h6>Codefight CMS 2.0, a multiple website management software, based on codeigniter 2.0 php framework.</h6>', NULL, ',75,', ',1,', '', 0, 0, '2010-12-20 00:00:00', NULL, 0, '', 0, 'page', 4, 'Codefight CMS - Codeigniter Multiple Website Manager', 'Codeigniter,cms,codefight,website,manager,php,multiple,website', 'Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.', 0),
(71, 1, NULL, 'Codefight PHP Content Management System (CMS)', '<p>\n<script src="/skin/frontend/default/js/prototype.js" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/lightbox.js" type="text/javascript"></script>\n</p>\n<h1>Codefight PHP Content Management System (CMS)</h1>\n<div class="banner"><span class="download_link"><a href="http://code.google.com/p/cmsdamu/downloads/list">Download Pre-release Code</a>\n<script src="http://ohloh.net/p/318042/widgets/project_thin_badge.js" type="text/javascript"></script>\n</span><a title="Make money online from sponsored tweets. Its that easy to make money online working from home." href="http://bit.ly/3qzpDq" target="_blank">Today''s Preview Brought To You By Sponsored Tweets.</a></div>\n<p>This is only screenshot Preview of Codefight Content Management System (CMS) which is built with the help of <a title="CodeIgniter - Open source PHP web application framework" href="http://codeigniter.com">codeigniter</a> php framework</p>\n<p>This is still under development. So far the below items from screen shot are completed. If you want to give suggestions and feedbacks, you can do so at our forum <a title="Tenthweb is a place to express your opinions and ask questions on our very own forum." href="http://tenthweb.com/forums/viewforum.php?f=49">tenthweb.com</a></p>\n<p>For backend demo visit:<a title="content management system built with php framework codeigniter - demo (codefight)" href="http://codefight.org/demo/admin.html" target="_blank">http://codefight.org/demo/admin.html</a> <br /> For frontend demo visit: <a href="http://codefight.org/demo/home.html" target="_blank">http://codefight.org/demo/home.html</a> <br /> To download code visit: <a href="http://code.google.com/p/cmsdamu/downloads/list" target="_blank">http://code.google.com/p/cmsdamu/downloads/list</a> <br /> <br /> [please leave a comment in our forum.]</p>\n<p class="notice"><strong>Update: 13.03.2009</strong><br /> Codefight homepage is now powered by codefight cms</p>\n<p><em><strong>This screenshot is outdated. Demo is newer than screenshot. Download can be newer than demo.</strong></em></p>\n<table style="width: 780px;" border="0" cellspacing="10" cellpadding="4" align="center">\n<tbody>\n<tr>\n<td width="260" align="left" valign="top"><a title="Login Form" rel="lightbox[codefight]" href="/media/upload/screenshots/login.jpg"><img src="/media/upload/screenshots/login_thumb.jpg" alt="login thumb" width="250" height="108" /></a></td>\n<td width="260" align="left" valign="top"><a title="Welcome Page After Login" rel="lightbox[codefight]" href="/media/upload/screenshots/welcome.jpg"><img src="/media/upload/screenshots/welcome_thumb.jpg" alt="welcome thumb" width="250" height="88" /></a></td>\n</tr>\n<tr>\n<td width="260" align="left" valign="top"><a title="Groups View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/groups_view.jpg"><img src="/media/upload/screenshots/groups_view_thumb.jpg" alt="groups view thumb" width="250" height="155" /></a></td>\n<td align="left" valign="top"><a title="Groups Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/group_edit.jpg"><img src="/media/upload/screenshots/group_edit_thumb.jpg" alt="group edit thumb" width="250" height="175" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Groups Create" rel="lightbox[codefight]" href="/media/upload/screenshots/group_create.jpg"><img src="/media/upload/screenshots/group_create_thumb.jpg" alt="group create thumb" width="250" height="107" /></a></td>\n<td align="left" valign="top"><a title="Users View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users.jpg"><img src="/media/upload/screenshots/users_thumb.jpg" alt="users thumb" width="250" height="74" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Users Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users_edit.jpg"><img src="/media/upload/screenshots/users_edit_thumb.jpg" alt="users edit thumb" width="250" height="163" /></a></td>\n<td align="left" valign="top"><a title="Menu View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus.jpg"><img src="/media/upload/screenshots/menus_thumb.jpg" alt="menus thumb" width="250" height="191" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Menu Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus_edit.jpg"><img src="/media/upload/screenshots/menus_edit_thumb.jpg" alt="menus edit thumb" width="250" height="180" /></a></td>\n<td align="left" valign="top"><a title="Pages View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages.jpg"><img src="/media/upload/screenshots/pages_thumb.jpg" alt="pages thumb" width="250" height="158" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Pages Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages_edit.jpg"><img src="/media/upload/screenshots/pages_edit_thumb.jpg" alt="pages edit thumb" width="250" height="204" /></a></td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', 0, '<p>\n<script src="/skin/frontend/default/js/prototype.js" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/lightbox.js" type="text/javascript"></script>\n</p>\n<h1>Codefight PHP Content Management System (CMS)</h1>\n<div class="banner"><span class="download_link"><a href="http://code.google.com/p/cmsdamu/downloads/list">Download Pre-release Code</a>\n<script src="http://ohloh.net/p/318042/widgets/project_thin_badge.js" type="text/javascript"></script>\n</span><a title="Make money online from sponsored tweets. Its that easy to make money online working from home." href="http://bit.ly/3qzpDq" target="_blank">Today''s Preview Brought To You By Sponsored Tweets.</a></div>\n<p>This is only screenshot Preview of Codefight Content Management System (CMS) which is built with the help of <a title="CodeIgniter - Open source PHP web application framework" href="http://codeigniter.com">codeigniter</a> php framework</p>\n<p>This is still under development. So far the below items from screen shot are completed. If you want to give suggestions and feedbacks, you can do so at our forum <a title="Tenthweb is a place to express your opinions and ask questions on our very own forum." href="http://tenthweb.com/forums/viewforum.php?f=49">tenthweb.com</a></p>\n<p>For backend demo visit:<a title="content management system built with php framework codeigniter - demo (codefight)" href="http://codefight.org/demo/admin.html" target="_blank">http://codefight.org/demo/admin.html</a> <br /> For frontend demo visit: <a href="http://codefight.org/demo/home.html" target="_blank">http://codefight.org/demo/home.html</a> <br /> To download code visit: <a href="http://code.google.com/p/cmsdamu/downloads/list" target="_blank">http://code.google.com/p/cmsdamu/downloads/list</a> <br /> <br /> [please leave a comment in our forum.]</p>\n<p class="notice"><strong>Update: 13.03.2009</strong><br /> Codefight homepage is now powered by codefight cms</p>\n<p><em><strong>This screenshot is outdated. Demo is newer than screenshot. Download can be newer than demo.</strong></em></p>\n<table style="width: 780px;" border="0" cellspacing="10" cellpadding="4" align="center">\n<tbody>\n<tr>\n<td width="260" align="left" valign="top"><a title="Login Form" rel="lightbox[codefight]" href="/media/upload/screenshots/login.jpg"><img src="/media/upload/screenshots/login_thumb.jpg" alt="login thumb" width="250" height="108" /></a></td>\n<td width="260" align="left" valign="top"><a title="Welcome Page After Login" rel="lightbox[codefight]" href="/media/upload/screenshots/welcome.jpg"><img src="/media/upload/screenshots/welcome_thumb.jpg" alt="welcome thumb" width="250" height="88" /></a></td>\n</tr>\n<tr>\n<td width="260" align="left" valign="top"><a title="Groups View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/groups_view.jpg"><img src="/media/upload/screenshots/groups_view_thumb.jpg" alt="groups view thumb" width="250" height="155" /></a></td>\n<td align="left" valign="top"><a title="Groups Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/group_edit.jpg"><img src="/media/upload/screenshots/group_edit_thumb.jpg" alt="group edit thumb" width="250" height="175" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Groups Create" rel="lightbox[codefight]" href="/media/upload/screenshots/group_create.jpg"><img src="/media/upload/screenshots/group_create_thumb.jpg" alt="group create thumb" width="250" height="107" /></a></td>\n<td align="left" valign="top"><a title="Users View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users.jpg"><img src="/media/upload/screenshots/users_thumb.jpg" alt="users thumb" width="250" height="74" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Users Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users_edit.jpg"><img src="/media/upload/screenshots/users_edit_thumb.jpg" alt="users edit thumb" width="250" height="163" /></a></td>\n<td align="left" valign="top"><a title="Menu View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus.jpg"><img src="/media/upload/screenshots/menus_thumb.jpg" alt="menus thumb" width="250" height="191" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Menu Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus_edit.jpg"><img src="/media/upload/screenshots/menus_edit_thumb.jpg" alt="menus edit thumb" width="250" height="180" /></a></td>\n<td align="left" valign="top"><a title="Pages View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages.jpg"><img src="/media/upload/screenshots/pages_thumb.jpg" alt="pages thumb" width="250" height="158" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Pages Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages_edit.jpg"><img src="/media/upload/screenshots/pages_edit_thumb.jpg" alt="pages edit thumb" width="250" height="204" /></a></td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', NULL, ',72,', ',1,', '', 0, 0, '2011-01-01 00:00:00', NULL, 0, '', 0, 'page', 104, 'Codefight PHP Content Management System &#40;CMS&#41; Preview', 'codefight,cms,demo,preview,codeigniter,2.0,multiple,website,manager', 'This is only screenshot Preview of Codefight Content Management System &#40;CMS&#41; which is built with the help of codeigniter php framework', 0),
(72, 1, NULL, 'About Us', '<p>We are a collection of professionals focused on the benefits of text link ads.&nbsp;    Our goal is to build a long-standing, comprehensive review website of internet    marketers and affiliate marketers. Differing from most websites, we aim to develop    relationships, observe the internet atmosphere, and report our observations    and experiences to you, the consumer.&nbsp; We want you to benefit from our    observations, reports, and informational blogs for years to come, so we will    work hard to cement our professional review site in the industry.</p>\r\n<p>Yes, we love to hear constructive feedbacks from our visitors, guests and members.</p>\r\n<p>Yes, we read every comment.&nbsp; We enjoy reading and manually approving each    comment -- you are heard and don''t go unnoticed.</p>\r\n<p>We will try to scrub all the details before publishing, and we would love to    hear if we miss any spots.</p>\r\n<p>Thank you for your assistance and continued membership.</p>\r\n<p>Kind regards,</p>\r\n<p>TextLinkAdsReview.com</p>', 0, '<p>We are a collection of professionals focused on the benefits of text link ads.&nbsp;    Our goal is to build a long-standing, comprehensive review website of internet    marketers and affiliate marketers. Differing from most websites, we aim to develop    relationships, observe the internet atmosphere, and report our observations    and experiences to you, the consumer.&nbsp; We want you to benefit from our    observations, reports, and informational blogs for years to come, so we will    work hard to cement our professional review site in the industry.</p>\r\n<p>Yes, we love to hear constructive feedbacks from our visitors, guests and members.</p>\r\n<p>Yes, we read every comment.&nbsp; We enjoy reading and manually approving each    comment -- you are heard and don''t go unnoticed.</p>\r\n<p>We will try to scrub all the details before publishing, and we would love to    hear if we miss any spots.</p>\r\n<p>Thank you for your assistance and continued membership.</p>\r\n<p>Kind regards,</p>\r\n<p>TextLinkAdsReview.com</p>', NULL, ',82,', ',1,2,', '', 0, 0, '2010-01-20 00:00:00', NULL, 0, '', 0, 'page', 1, 'About Us - Text Link Ads Review', 'about us, text link ads review,about text link ads review, about TLAr', 'Our goal is to build a long-standing, comprehensive review website of internet marketers and affiliate marketers.', 0),
(73, 1, NULL, 'Search Text Link Ads Review', '<form action="http://textlinkadsreview.com/search/">\r\n<div><input name="cx" type="hidden" value="partner-pub-9567128729272204:5rf39g-1qd8" /> <input name="cof" type="hidden" value="FORID:11" /> <input name="ie" type="hidden" value="ISO-8859-1" /> <input name="q" size="31" type="text" /> <input name="sa" type="submit" value="Search" /></div>\r\n</form>\r\n<p>\r\n<script src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=en" type="text/javascript"></script>\r\n</p>\r\n<p>&nbsp;</p>\r\n<p>\r\n<script type="text/javascript"><!--\r\n  var googleSearchIframeName = "cse-search-results";\r\n  var googleSearchFormName = "cse-search-box";\r\n  var googleSearchFrameWidth = 795;\r\n  var googleSearchDomain = "www.google.com";\r\n  var googleSearchPath = "/cse";\r\n// --></script>\r\n<script src="http://www.google.com/afsonline/show_afs_search.js" type="text/javascript"></script>\r\n</p>', 0, '<form action="http://textlinkadsreview.com/search/">\r\n<div><input name="cx" type="hidden" value="partner-pub-9567128729272204:5rf39g-1qd8" /> <input name="cof" type="hidden" value="FORID:11" /> <input name="ie" type="hidden" value="ISO-8859-1" /> <input name="q" size="31" type="text" /> <input name="sa" type="submit" value="Search" /></div>\r\n</form>\r\n<p>\r\n<script src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=en" type="text/javascript"></script>\r\n</p>\r\n<p>&nbsp;</p>\r\n<p>\r\n<script type="text/javascript"><!--\r\n  var googleSearchIframeName = "cse-search-results";\r\n  var googleSearchFormName = "cse-search-box";\r\n  var googleSearchFrameWidth = 795;\r\n  var googleSearchDomain = "www.google.com";\r\n  var googleSearchPath = "/cse";\r\n// --></script>\r\n<script src="http://www.google.com/afsonline/show_afs_search.js" type="text/javascript"></script>\r\n</p>', NULL, ',0,', ',0,', '', 0, 0, '2010-01-21 00:00:00', NULL, 0, '', 0, 'page', 0, 'Search Text Link Ads Review - TextLinkAdsReview.com', 'Google,Search, text link ads review,search text link ads review, search TLAr', 'Google Search for Text Link Ads Review.', 0),
(74, 1, NULL, 'Online Advertising | Text Link Ads | Banner Ads', '<p>Text link advertising is currently one of the most popular methods of internet    marketing. Here at TextLinkAdsReview.com, we realize the importance of text    link advertising in our modern marketing world, so we will write reviews on    different text link advertisement options. Whether you want to sell text link    ads or you want to buy text link ads, we have listed and reviewed many different    text link agencies on our website, and we are continuously working to review    more advertising options for your business.</p>\n<p>We realize there are many advertising companies and text link brokers available    to you, and only TextLinkAdsReview.com will review these many companies and    offer information to help you find the best marketing agency for your business.    These agencies charge a miniscule commission to find your ideal advertising    fit, but the advertising will help you increase your Google page rank slowly    by time.</p>\n<p>Text link ads are very positive for your business.&nbsp; They boost your SEO    (Search Engine Optimization) rating, and they are often better than pay-per-click    (PPC) advertising. PPC advertising can often lead to revenue-sharing clicking    - when a website that shares revenues with yours influences friends or family    to click your banner to decrease your revenue (and increase their own).&nbsp;    Also, because visitors trust text link ads more than flashy banners, visitors    are more apt to click text link ads.&nbsp; Viewed as a recommendation from the    site owner, a text link ad draws more traffic to your site.&nbsp; As for those    who own well-established, high-traffic sites, you can sell space on your site    to text link advertisers. Whether you would like to purchase text link space    or you would like to rent space on your site, the text link advertising business    is a win-win:&nbsp; You could either receive higher potential buyer traffic    for a flat fee, or you could receive residual income -- monthly rental income    that your don''t have to work for.</p>\n<p>There are numerous top advertising agencies who offer online and offline advertising    options, and our aim is to include most of them in our reviews. So keep in touch    with our blog posts and subscribe to our RSS.</p>\n<p>-TextLinkAdsReview.com</p>', 0, '<p>Text link advertising is currently one of the most popular methods of internet    marketing. Here at TextLinkAdsReview.com, we realize the importance of text    link advertising in our modern marketing world, so we will write reviews on    different text link advertisement options. Whether you want to sell text link    ads or you want to buy text link ads, we have listed and reviewed many different    text link agencies on our website, and we are continuously working to review    more advertising options for your business.</p>\n<p>We realize there are many advertising companies and text link brokers available    to you, and only TextLinkAdsReview.com will review these many companies and    offer information to help you find the best marketing agency for your business.    These agencies charge a miniscule commission to find your ideal advertising    fit, but the advertising will help you increase your Google page rank slowly    by time.</p>\n<p>Text link ads are very positive for your business.&nbsp; They boost your SEO    (Search Engine Optimization) rating, and they are often better than pay-per-click    (PPC) advertising. PPC advertising can often lead to revenue-sharing clicking    - when a website that shares revenues with yours influences friends or family    to click your banner to decrease your revenue (and increase their own).&nbsp;    Also, because visitors trust text link ads more than flashy banners, visitors    are more apt to click text link ads.&nbsp; Viewed as a recommendation from the    site owner, a text link ad draws more traffic to your site.&nbsp; As for those    who own well-established, high-traffic sites, you can sell space on your site    to text link advertisers. Whether you would like to purchase text link space    or you would like to rent space on your site, the text link advertising business    is a win-win:&nbsp; You could either receive higher potential buyer traffic    for a flat fee, or you could receive residual income -- monthly rental income    that your don''t have to work for.</p>\n<p>There are numerous top advertising agencies who offer online and offline advertising    options, and our aim is to include most of them in our reviews. So keep in touch    with our blog posts and subscribe to our RSS.</p>\n<p>-TextLinkAdsReview.com</p>', NULL, ',75,', ',2,', '', 0, 0, '2010-01-20 00:00:00', NULL, 0, '', 0, 'page', 0, 'Text Link Ads Review | Buy Text Link Ads | Sell Text Link Ads', 'buying,selling,monetizing,text,link,advertising,banner,ppc', 'We review different Advertising Platforms like Text Link Ads and many more.', 0),
(100, 1, NULL, 'My Experience with CodeIgniter', '<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">', 0, '<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;"><!-- pagebreak --></p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">In vehicula arcu eu nibh tincidunt pharetra. Vestibulum non laoreet turpis. Vestibulum egestas, nibh quis tempor cursus, risus quam ornare nulla, quis ultricies augue dolor eget sapien. Sed quis leo nisi, sed porttitor ante. Quisque eget nisl quam, in rutrum quam. Quisque ullamcorper porttitor nibh sit amet imperdiet. In vehicula vulputate sem, vitae tempor nulla auctor tristique. Cras eget varius odio. Cras vel dolor arcu, at malesuada justo. Donec cursus mi a enim mattis et convallis risus malesuada. Mauris elementum nunc in nisi egestas nec dapibus urna condimentum. In odio metus, rutrum pulvinar sagittis at, euismod nec dolor. Maecenas quis nulla id ipsum sagittis aliquam. Etiam aliquet augue a eros eleifend vitae auctor nulla rutrum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Aenean at risus in sem consectetur aliquet sed eu mi. Morbi dignissim malesuada purus vitae condimentum. Suspendisse sit amet urna urna. Fusce vitae tortor nisl, nec cursus diam. Nam cursus consequat ipsum ac volutpat. In eu eleifend ipsum. Maecenas venenatis augue vitae eros viverra ultricies. Donec sit amet consectetur libero. Vivamus aliquam sollicitudin eros in sodales. Cras dapibus, neque eget accumsan molestie, purus dui tincidunt ligula, id ultrices massa lacus mollis eros. Vivamus velit massa, accumsan ut imperdiet sed, egestas eu mi. Nam ut ligula tempus neque pharetra feugiat. Curabitur varius imperdiet lectus non suscipit. Aliquam erat volutpat. Morbi laoreet libero ut sapien convallis faucibus placerat velit egestas. Fusce non lorem lacus, non consectetur tellus.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Sed lacus ligula, commodo at molestie in, pharetra in risus. Etiam tristique dapibus ipsum, eu dignissim nisl rutrum in. Nulla facilisi. Duis sed purus eu nulla eleifend aliquet. Fusce vulputate, nunc ac egestas convallis, est quam lacinia eros, sit amet tincidunt odio ante a lectus. Donec molestie condimentum sapien non pulvinar. Mauris mi lacus, tristique vel vestibulum pretium, pulvinar nec est. Ut lacinia nisl at dolor consequat vitae semper sapien vulputate. Maecenas mattis, ipsum tincidunt pellentesque lobortis, elit augue suscipit tortor, et faucibus urna lacus eget risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus volutpat lacinia felis, dictum adipiscing lorem cursus et. Donec gravida aliquet velit, vel ultrices quam hendrerit nec. Morbi non nibh neque, id faucibus quam. Suspendisse eget erat orci.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Proin gravida purus id lacus adipiscing pretium. Proin volutpat, augue ut molestie adipiscing, urna mauris porttitor felis, a ultricies elit tellus id turpis. Cras a placerat lectus. Curabitur mattis venenatis arcu eu facilisis. Nulla at justo et mi ultrices lacinia. In eu lacus vitae purus iaculis mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc tincidunt dui in felis pharetra cursus nec posuere mi. Maecenas at viverra urna. Etiam ullamcorper luctus eros, at dignissim tellus malesuada vel. Duis sit amet mauris nisi.</p>', NULL, ',86,93,96,', ',1,', 'Seth Bryant', 11, 1, '2011-04-15 01:41:40', NULL, 1, 'codeigniter,test', 1, 'blog', 859, 'My Experience with CodeIgniter', 'codeigniter,codefight', 'With CodeIgniter, you can easily organize the different sections of the PHP application including configuration files, controllers, models, scripts and views.', 0),
(102, 1, NULL, 'Advertising in Applications', '<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">', 0, '<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;"><!-- pagebreak --></p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">In vehicula arcu eu nibh tincidunt pharetra. Vestibulum non laoreet turpis. Vestibulum egestas, nibh quis tempor cursus, risus quam ornare nulla, quis ultricies augue dolor eget sapien. Sed quis leo nisi, sed porttitor ante. Quisque eget nisl quam, in rutrum quam. Quisque ullamcorper porttitor nibh sit amet imperdiet. In vehicula vulputate sem, vitae tempor nulla auctor tristique. Cras eget varius odio. Cras vel dolor arcu, at malesuada justo. Donec cursus mi a enim mattis et convallis risus malesuada. Mauris elementum nunc in nisi egestas nec dapibus urna condimentum. In odio metus, rutrum pulvinar sagittis at, euismod nec dolor. Maecenas quis nulla id ipsum sagittis aliquam. Etiam aliquet augue a eros eleifend vitae auctor nulla rutrum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Aenean at risus in sem consectetur aliquet sed eu mi. Morbi dignissim malesuada purus vitae condimentum. Suspendisse sit amet urna urna. Fusce vitae tortor nisl, nec cursus diam. Nam cursus consequat ipsum ac volutpat. In eu eleifend ipsum. Maecenas venenatis augue vitae eros viverra ultricies. Donec sit amet consectetur libero. Vivamus aliquam sollicitudin eros in sodales. Cras dapibus, neque eget accumsan molestie, purus dui tincidunt ligula, id ultrices massa lacus mollis eros. Vivamus velit massa, accumsan ut imperdiet sed, egestas eu mi. Nam ut ligula tempus neque pharetra feugiat. Curabitur varius imperdiet lectus non suscipit. Aliquam erat volutpat. Morbi laoreet libero ut sapien convallis faucibus placerat velit egestas. Fusce non lorem lacus, non consectetur tellus.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Sed lacus ligula, commodo at molestie in, pharetra in risus. Etiam tristique dapibus ipsum, eu dignissim nisl rutrum in. Nulla facilisi. Duis sed purus eu nulla eleifend aliquet. Fusce vulputate, nunc ac egestas convallis, est quam lacinia eros, sit amet tincidunt odio ante a lectus. Donec molestie condimentum sapien non pulvinar. Mauris mi lacus, tristique vel vestibulum pretium, pulvinar nec est. Ut lacinia nisl at dolor consequat vitae semper sapien vulputate. Maecenas mattis, ipsum tincidunt pellentesque lobortis, elit augue suscipit tortor, et faucibus urna lacus eget risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus volutpat lacinia felis, dictum adipiscing lorem cursus et. Donec gravida aliquet velit, vel ultrices quam hendrerit nec. Morbi non nibh neque, id faucibus quam. Suspendisse eget erat orci.</p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">Proin gravida purus id lacus adipiscing pretium. Proin volutpat, augue ut molestie adipiscing, urna mauris porttitor felis, a ultricies elit tellus id turpis. Cras a placerat lectus. Curabitur mattis venenatis arcu eu facilisis. Nulla at justo et mi ultrices lacinia. In eu lacus vitae purus iaculis mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc tincidunt dui in felis pharetra cursus nec posuere mi. Maecenas at viverra urna. Etiam ullamcorper luctus eros, at dignissim tellus malesuada vel. Duis sit amet mauris nisi.</p>', NULL, ',109,93,', ',1,2,', '', 11, 1, '2011-04-30 19:52:22', NULL, 1, 'advertising,test', 1, 'blog', 350, 'Advertising in Applications - TLAr', 'advertising,angry birds,application,advertiser,advertise,traditional advertising', 'One example of this is in ', 0),
(103, 1, NULL, 'Download Latest Codefight CMS', '<p><a title="Download Codefight CMS" href="http://codefight.org/" target="_blank"><img title="Codefight CMS" src="http://skin.zoosper.com//media/codefight-cms-2-0-preview.png" alt="Download Codefight CMS" width="500" height="296" /></a></p>', 0, '<p><a title="Download Codefight CMS" href="http://codefight.org/" target="_blank"><img title="Codefight CMS" src="http://skin.zoosper.com//media/codefight-cms-2-0-preview.png" alt="Download Codefight CMS" width="500" height="296" /></a></p>', NULL, ',81,', ',1,', '', 0, 0, '2011-12-27 23:10:28', NULL, 0, '', 0, 'page', 0, 'Download Latest Codeigniter cms - Codefight CMS', 'codefight,codeigniter,cms,download,free,multi-site manager,wysiwyg cms,simple and easy cms', 'Download open source softwares', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_page_access`
--

DROP TABLE IF EXISTS `cf_page_access`;
CREATE TABLE IF NOT EXISTS `cf_page_access` (
  `page_id` int(11) NOT NULL,
  `group_id` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_page_access`
--

INSERT INTO `cf_page_access` (`page_id`, `group_id`) VALUES
(2, '1_3_2'),
(4, '1_3_2'),
(5, '1_3_2'),
(7, '1_3_2'),
(8, '1_3_2'),
(9, '1_3_2'),
(10, '1_3_2'),
(11, '1_3_2'),
(12, '1_3_2'),
(13, '1_3_2'),
(14, '1_3_2'),
(15, '1_3_2'),
(16, '1_3_2'),
(17, '1_3_2'),
(18, '1_3_2'),
(19, '1_3_2'),
(20, '1_3_2'),
(21, '1_3_2'),
(22, '1_3_2'),
(23, '1_3_2'),
(24, '1_3_2'),
(25, '1_3_2'),
(26, '1_3_2'),
(27, '1_3_2'),
(29, '1_3_2'),
(30, '1_3_2'),
(31, '1_3_2'),
(32, '1_3_2'),
(33, '1_3_2'),
(36, '1_3_2'),
(37, '1_3_2'),
(38, '1_3_2'),
(39, '1_3_2'),
(40, '1_3_2'),
(41, '1_3_2'),
(42, '1_3_2'),
(43, '1_3_2'),
(44, '1_3_2'),
(47, '1_3_2'),
(48, '1_3_2'),
(49, '1_3_2'),
(50, '1_3_2'),
(51, '1_3_2'),
(52, '1_3_2'),
(53, '1_3_2'),
(54, '1_2'),
(55, '1_3_2'),
(56, '1_3_2'),
(57, '1_3_2'),
(58, '1_3_2'),
(59, '1_3_2'),
(60, '1_3_2'),
(61, '1_2'),
(62, '1_3_2'),
(63, '1_3_2'),
(64, '1_3_2'),
(65, '1_3_2'),
(66, '1_3_2'),
(67, '1_3_2'),
(68, '1_3_2'),
(69, '1_3_2'),
(70, '1_3_2'),
(71, '1_3_2'),
(72, '1_3_2'),
(73, '1_3_2'),
(74, '1_3_2'),
(75, '1_3_2'),
(76, '1_3_2'),
(77, '1_3_2'),
(78, '1_3_2'),
(79, '1_3_2'),
(80, '1_3_2'),
(81, '1_3_2'),
(82, '1_3_2'),
(83, '1_3_2'),
(84, '1_3_2'),
(85, '1_3_2'),
(86, '1_3_2'),
(87, '1_3_2'),
(88, '1_2'),
(89, '1_2'),
(90, '1_2'),
(91, '1_2'),
(92, '1_2'),
(93, '1_2'),
(94, '1_2'),
(95, '1_2'),
(96, '1_2'),
(97, '1_2'),
(98, '1_2'),
(99, '1_2'),
(100, '1_2'),
(101, '1_2'),
(102, '1_2'),
(103, '1_2');

-- --------------------------------------------------------

--
-- Table structure for table `cf_page_comment`
--

DROP TABLE IF EXISTS `cf_page_comment`;
CREATE TABLE IF NOT EXISTS `cf_page_comment` (
  `page_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `page_url` varchar(300) DEFAULT NULL,
  `page_comment_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `cf_page_comment`
--

INSERT INTO `cf_page_comment` (`page_comment_id`, `name`, `email`, `comment`, `time`, `url`, `page_id`, `page_url`, `page_comment_status`) VALUES
(5, 'pending comment', 'pending@comment.com', 'This is pending comment example. Written for feed, incase there are not any.', '2009-03-14 03:48:52', 'http://www.codefight.org/', 7, NULL, 0),
(4, 'Test Test', 'dbashyal@gmail.com', 'Test only 1st ever comment', '2009-03-13 06:33:30', 'http://www.codefight.org/', 7, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_page_tag`
--

DROP TABLE IF EXISTS `cf_page_tag`;
CREATE TABLE IF NOT EXISTS `cf_page_tag` (
  `page_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_page_tag`
--

INSERT INTO `cf_page_tag` (`page_id`, `tag`) VALUES
(37, 'Kushal-Bashyal'),
(37, 'test'),
(19, 'Nepal'),
(19, 'Nepali'),
(19, 'test'),
(102, 'advertising'),
(102, 'test'),
(100, 'codeigniter'),
(100, 'test'),
(70, '');

-- --------------------------------------------------------

--
-- Table structure for table `cf_sessions`
--

DROP TABLE IF EXISTS `cf_sessions`;
CREATE TABLE IF NOT EXISTS `cf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `cf_setting`
--

DROP TABLE IF EXISTS `cf_setting`;
CREATE TABLE IF NOT EXISTS `cf_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` varchar(300) NOT NULL,
  `setting_info` varchar(100) NOT NULL,
  `setting_form` varchar(25) NOT NULL,
  `setting_option` varchar(250) NOT NULL,
  `websites_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_id`),
  KEY `setting_id` (`setting_id`),
  KEY `setting_key` (`setting_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `cf_setting`
--

INSERT INTO `cf_setting` (`setting_id`, `setting_key`, `setting_value`, `setting_info`, `setting_form`, `setting_option`, `websites_id`) VALUES
(2, 'site_enabled', '1', 'Site Enabled', 'radio', '1=YES|0=NO', 1),
(3, 'site_comment', '0', 'Registration required to post comments', 'radio', '1=YES|0=NO', 1),
(4, 'meta_title', 'Codefight CMS 1', 'Default Meta Title', 'textbox', 'codefight.org', 1),
(5, 'meta_keyword', 'codefight, code fight, content, management, system, free, php, download', 'Default Meta Keywords', 'textbox', 'codefight, code fight, content, management, system, free, php, download', 1),
(6, 'meta_description', 'download free content management system built with codeigniter free php framework.', 'Default Meta Description', 'textarea', 'download free content management system built with codeigniter free php framework.', 1),
(7, 'default_template', 'white', 'Default Template', 'select', '', 1),
(8, 'email_sender', 'noreply@codefightcms.com', 'From Email Address', 'textbox', 'noreply@codefight.org', 1),
(9, 'site_name', 'Codefight CMS 1', 'Website Name', 'textbox', 'CodeFight', 1),
(10, 'combine_css', '0', 'Combine CSS Files', 'radio', '1=YES|0=NO', 1),
(11, 'minify_css', '0', 'Minify CSS', 'radio', '1=YES|0=NO', 1),
(12, 'minify_html', '0', 'Minify html source code', 'radio', '1=YES|0=NO', 1),
(13, 'pagination_page_links', '5', 'Display Total Pagination Page Links', 'textbox', '2', 1),
(14, 'pagination_per_page', '3', 'Display Total Articles Per Page', 'textbox', '5', 1),
(15, 'google_analytics_id', 'UA-852764-5', 'Google Analytics Web Property ID', 'textbox', 'UA-852764-5', 1),
(16, 'display_view_path', '0', 'Do you want to display template path?', 'radio', '0=NO|1=YES', 1),
(1, 'websites_id', '1', 'Load settings for website:', 'select', '-', 1),
(71, 'default_template', 'white', 'Default Template', 'select', '', 3),
(70, 'meta_description', 'This website hosts just skin files for our websites.', 'Default Meta Description', 'textarea', 'download free content management system built with codeigniter free php framework.', 3),
(68, 'meta_title', 'Codefight CMS 3', 'Default Meta Title', 'textbox', 'codefight.org', 3),
(69, 'meta_keyword', 'codefight,cms,skin', 'Default Meta Keywords', 'textbox', 'codefight, code fight, content, management, system, free, php, download', 3),
(67, 'site_comment', '0', 'Registration required to post comments', 'radio', '1=YES|0=NO', 3),
(66, 'site_enabled', '1', 'Site Enabled', 'radio', '1=YES|0=NO', 3),
(65, 'websites_id', '3', 'Load settings for website:', 'select', '-', 3),
(64, 'display_view_path', '0', 'Do you want to display template path?', 'radio', '0=NO|1=YES', 2),
(63, 'google_analytics_id', 'UA-852764-15', 'Google Analytics Web Property ID', 'textbox', 'UA-852764-5', 2),
(62, 'pagination_per_page', '2', 'Display Total Articles Per Page', 'textbox', '5', 2),
(61, 'pagination_page_links', '2', 'Display Total Pagination Page Links', 'textbox', '2', 2),
(60, 'minify_html', '0', 'Minify html source code', 'radio', '1=YES|0=NO', 2),
(59, 'minify_css', '0', 'Minify CSS', 'radio', '1=YES|0=NO', 2),
(58, 'combine_css', '0', 'Combine CSS Files', 'radio', '1=YES|0=NO', 2),
(56, 'email_sender', 'noreply@codefightcms.com', 'From Email Address', 'textbox', 'noreply@codefight.org', 2),
(57, 'site_name', 'Codefight CMS 2', 'Website Name', 'textbox', 'CodeFight', 2),
(55, 'default_template', 'white', 'Default Template', 'select', '', 2),
(54, 'meta_description', 'We review different advertising platforms that will help advertiser and publisher both to choose the better media partner.', 'Default Meta Description', 'textarea', 'download free content management system built with codeigniter free php framework.', 2),
(53, 'meta_keyword', 'Text Link Ads Review, Text Link Reviews, Advertising Reviews, Page Rank Reviews', 'Default Meta Keywords', 'textbox', 'codefight, code fight, content, management, system, free, php, download', 2),
(52, 'meta_title', 'Codefight CMS 2', 'Default Meta Title', 'textbox', 'codefight.org', 2),
(51, 'site_comment', '0', 'Registration required to post comments', 'radio', '1=YES|0=NO', 2),
(50, 'site_enabled', '1', 'Site Enabled', 'radio', '1=YES|0=NO', 2),
(49, 'websites_id', '2', 'Load settings for website:', 'select', '-', 2),
(72, 'email_sender', 'noreply@codefightcms.com', 'From Email Address', 'textbox', 'noreply@codefight.org', 3),
(73, 'site_name', 'Codefight CMS 3', 'Website Name', 'textbox', 'CodeFight', 3),
(74, 'combine_css', '0', 'Combine CSS Files', 'radio', '1=YES|0=NO', 3),
(75, 'minify_css', '0', 'Minify CSS', 'radio', '1=YES|0=NO', 3),
(76, 'minify_html', '0', 'Minify html source code', 'radio', '1=YES|0=NO', 3),
(77, 'pagination_page_links', '2', 'Display Total Pagination Page Links', 'textbox', '2', 3),
(78, 'pagination_per_page', '3', 'Display Total Articles Per Page', 'textbox', '5', 3),
(79, 'google_analytics_id', 'UA-852764-5', 'Google Analytics Web Property ID', 'textbox', 'UA-852764-5', 3),
(80, 'display_view_path', '0', 'Do you want to display template path?', 'radio', '0=NO|1=YES', 3),
(82, 'default_recipients', 'noreply@codefightcms.com', 'Default Store Email Recipient', 'textbox', 'test@example.com', 1),
(83, 'default_recipients', 'noreply@codefightcms.com', 'Default Store Email Recipient', 'textbox', 'test@example.com', 2),
(84, 'default_recipients', 'noreply@codefightcms.com', 'Default Store Email Recipient', 'textbox', 'test@example.com', 3),
(85, 'websites_id', '4', 'Load settings for website:', 'select', '-', 4),
(86, 'site_enabled', '1', 'Site Enabled', 'radio', '1=YES|0=NO', 4),
(87, 'site_comment', '0', 'Registration required to post comments', 'radio', '1=YES|0=NO', 4),
(88, 'meta_title', 'Codefight CMS 4', 'Default Meta Title', 'textbox', 'codefight.org', 4),
(89, 'meta_keyword', 'damodar,bashyal,butwal,nepal', 'Default Meta Keywords', 'textbox', 'codefight, code fight, content, management, system, free, php, download', 4),
(90, 'meta_description', 'Personal website of damodar bashyal.', 'Default Meta Description', 'textarea', 'download free content management system built with codeigniter free php framework.', 4),
(91, 'default_template', 'white', 'Default Template', 'select', '', 4),
(92, 'email_sender', 'noreply@codefightcms.com', 'From Email Address', 'textbox', 'noreply@codefight.org', 4),
(93, 'site_name', 'Codefight CMS 4', 'Website Name', 'textbox', 'CodeFight', 4),
(94, 'combine_css', '0', 'Combine CSS Files', 'radio', '1=YES|0=NO', 4),
(95, 'minify_css', '0', 'Minify CSS', 'radio', '1=YES|0=NO', 4),
(96, 'minify_html', '0', 'Minify html source code', 'radio', '1=YES|0=NO', 4),
(97, 'pagination_page_links', '2', 'Display Total Pagination Page Links', 'textbox', '2', 4),
(98, 'pagination_per_page', '3', 'Display Total Articles Per Page', 'textbox', '5', 4),
(99, 'google_analytics_id', 'UA-852764-5', 'Google Analytics Web Property ID', 'textbox', 'UA-852764-5', 4),
(100, 'display_view_path', '0', 'Do you want to display template path?', 'radio', '0=NO|1=YES', 4),
(101, 'default_recipients', 'noreply@codefightcms.com', 'Default Store Email Recipient', 'textbox', 'test@example.com', 4),
(102, 'google_plus', '103583381097797606705', 'Google Plus Publisher ID', 'textbox', '103583381097797606705', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_setting_keys`
--

DROP TABLE IF EXISTS `cf_setting_keys`;
CREATE TABLE IF NOT EXISTS `cf_setting_keys` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` varchar(300) NOT NULL,
  `setting_info` varchar(100) NOT NULL,
  `setting_form` varchar(25) NOT NULL,
  `setting_option` varchar(250) NOT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `setting_id` (`setting_id`),
  KEY `setting_key` (`setting_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `cf_setting_keys`
--

INSERT INTO `cf_setting_keys` (`setting_id`, `setting_key`, `setting_value`, `setting_info`, `setting_form`, `setting_option`) VALUES
(2, 'site_enabled', '1', 'Site Enabled', 'radio', '1=YES|0=NO'),
(3, 'site_comment', '0', 'Registration required to post comments', 'radio', '1=YES|0=NO'),
(4, 'meta_title', 'codefight.org', 'Default Meta Title', 'textbox', 'codefight.org'),
(5, 'meta_keyword', 'codefight, code fight, content, management, system, free, php, download', 'Default Meta Keywords', 'textbox', 'codefight, code fight, content, management, system, free, php, download'),
(6, 'meta_description', 'download free content management system built with codeigniter free php framework.', 'Default Meta Description', 'textarea', 'download free content management system built with codeigniter free php framework.'),
(7, 'default_template', 'default', 'Default Template', 'select', ''),
(8, 'email_sender', 'noreply@codefight.org', 'From Email Address', 'textbox', 'noreply@codefight.org'),
(9, 'site_name', 'CodeFight', 'Website Name', 'textbox', 'CodeFight'),
(10, 'combine_css', '0', 'Combine CSS Files', 'radio', '1=YES|0=NO'),
(11, 'minify_css', '0', 'Minify CSS', 'radio', '1=YES|0=NO'),
(12, 'minify_html', '0', 'Minify html source code', 'radio', '1=YES|0=NO'),
(13, 'pagination_page_links', '2', 'Display Total Pagination Page Links', 'textbox', '2'),
(14, 'pagination_per_page', '3', 'Display Total Articles Per Page', 'textbox', '5'),
(15, 'google_analytics_id', 'UA-852764-5', 'Google Analytics Web Property ID', 'textbox', 'UA-852764-5'),
(16, 'display_view_path', '0', 'Do you want to display template path?', 'radio', '0=NO|1=YES'),
(1, 'websites_id', '1', 'Load settings for website:', 'select', '-'),
(81, 'default_recipients', '', 'Default Store Email Recipient', 'textbox', 'test@example.com'),
(82, 'google_plus', '', 'Google Plus Publisher ID', 'textbox', '103583381097797606705');

-- --------------------------------------------------------

--
-- Table structure for table `cf_tag_cloud`
--

DROP TABLE IF EXISTS `cf_tag_cloud`;
CREATE TABLE IF NOT EXISTS `cf_tag_cloud` (
  `tag` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `type` varchar(15) NOT NULL DEFAULT 'page',
  `websites_id` int(11) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `content` text,
  KEY `count` (`count`),
  KEY `websites_id` (`websites_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_tag_cloud`
--

INSERT INTO `cf_tag_cloud` (`tag`, `title`, `count`, `type`, `websites_id`, `meta_title`, `meta_description`, `meta_keyword`, `content`) VALUES
('Baby-Jumping', ' Baby Jumping', 0, 'blog', 4, NULL, NULL, NULL, NULL),
('Baby-Jumping', ' Baby Jumping', 0, 'blog', 2, NULL, NULL, NULL, NULL),
('Baby-Jumping', ' Baby Jumping', 0, 'blog', 1, NULL, NULL, NULL, NULL),
('Baby', ' Baby', 0, 'blog', 4, NULL, NULL, NULL, NULL),
('Baby', ' Baby', 0, 'blog', 2, NULL, NULL, NULL, NULL),
('Baby', ' Baby', 0, 'blog', 1, NULL, NULL, NULL, NULL),
('Kushal-Bashyal', 'Kushal Bashyal', 1, 'blog', 4, NULL, NULL, NULL, NULL),
('Kushal-Bashyal', 'Kushal Bashyal', 1, 'blog', 2, NULL, NULL, NULL, NULL),
('Kushal-Bashyal', 'Kushal Bashyal', 1, 'blog', 1, NULL, NULL, NULL, NULL),
('Happy-Baby', 'Happy Baby', 0, 'blog', 1, NULL, NULL, NULL, NULL),
('Happy-Baby', 'Happy Baby', 0, 'blog', 2, NULL, NULL, NULL, NULL),
('Happy-Baby', 'Happy Baby', 0, 'blog', 4, NULL, NULL, NULL, NULL),
('advertising', 'advertising', 1, 'blog', 1, NULL, NULL, NULL, NULL),
('advertising', 'advertising', 1, 'blog', 2, NULL, NULL, NULL, NULL),
('codeigniter', 'codeigniter', 1, 'blog', 1, NULL, NULL, NULL, NULL),
('codeigniter', 'codeigniter', 0, 'blog', 2, NULL, NULL, NULL, NULL),
('Nepal', 'Nepal', 1, 'blog', 1, NULL, NULL, NULL, NULL),
('Nepal', 'Nepal', 1, 'blog', 2, NULL, NULL, NULL, NULL),
('Nepal', 'Nepal', 1, 'blog', 4, NULL, NULL, NULL, NULL),
('Nepali', 'Nepali', 1, 'blog', 1, NULL, NULL, NULL, NULL),
('Nepali', 'Nepali', 1, 'blog', 2, NULL, NULL, NULL, NULL),
('Nepali', 'Nepali', 1, 'blog', 4, NULL, NULL, NULL, NULL),
('Proud-to-be-nepalese', 'Proud to be nepalese', 0, 'blog', 1, NULL, NULL, NULL, NULL),
('Proud-to-be-nepalese', 'Proud to be nepalese', 0, 'blog', 2, NULL, NULL, NULL, NULL),
('Proud-to-be-nepalese', 'Proud to be nepalese', 0, 'blog', 4, NULL, NULL, NULL, NULL),
('email-forward', 'email forward', 0, 'blog', 1, NULL, NULL, NULL, NULL),
('email-forward', 'email forward', 0, 'blog', 2, NULL, NULL, NULL, NULL),
('email-forward', 'email forward', 0, 'blog', 4, NULL, NULL, NULL, NULL),
('test', 'test', 4, 'blog', 1, NULL, NULL, NULL, NULL),
('test', 'test', 3, 'blog', 2, NULL, NULL, NULL, NULL),
('test', 'test', 2, 'blog', 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cf_trim`
--

DROP TABLE IF EXISTS `cf_trim`;
CREATE TABLE IF NOT EXISTS `cf_trim` (
  `trim_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `long_url` varchar(255) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `creator` char(15) NOT NULL,
  `referrals` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`trim_id`),
  UNIQUE KEY `long` (`long_url`),
  KEY `referrals` (`referrals`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cf_trim`
--

INSERT INTO `cf_trim` (`trim_id`, `long_url`, `created`, `creator`, `referrals`) VALUES
(1, 'http://codefight.org/', 1281169085, '127.0.0.1', 7),
(2, 'http://www.localhost.com/phpmyadmin', 1286608782, '127.0.0.1', 1),
(3, 'http://skin.zoosper.com/admin/trim', 1293918570, '220.244.123.85', 1),
(4, 'http://zoosper.com/q/Codefight-CMS', 1295045500, '60.241.160.134', 1),
(5, 'http://www.kqzyfj.com/click-4006920-10854117?sid=ltat', 1352892850, '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_user`
--

DROP TABLE IF EXISTS `cf_user`;
CREATE TABLE IF NOT EXISTS `cf_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `active` char(1) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(34) NOT NULL DEFAULT '',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `is_admin` int(11) DEFAULT '0',
  `is_author` int(1) NOT NULL DEFAULT '0',
  `profile_link` varchar(255) DEFAULT NULL,
  `profile` text,
  `photo_small` varchar(255) DEFAULT NULL,
  `photo_large` varchar(255) DEFAULT NULL,
  `intro` text,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `cf_user`
--

INSERT INTO `cf_user` (`user_id`, `active`, `email`, `username`, `password`, `firstname`, `lastname`, `group_id`, `is_admin`, `is_author`, `profile_link`, `profile`, `photo_small`, `photo_large`, `intro`) VALUES
(11, '1', 'test@test.com', NULL, '098f6bcd4621d373cade4e832627b4f6', 'Damodar', 'Bashyal', 1, 1, 1, 'https://plus.google.com/103583381097797606705', '<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>', NULL, NULL, NULL),
(46, '1', 'author@test.com', NULL, '098f6bcd4621d373cade4e832627b4f6', 'Author', 'Author', 4, 1, 1, NULL, NULL, NULL, NULL, NULL),
(47, '1', 'notauthor@test.com', NULL, 'test', 'Not', 'Author', 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(48, '2', 'cancelleduser@test.com', NULL, '098f6bcd4621d373cade4e832627b4f6', 'Cancelled', 'User', 2, 0, 0, '', '<p>This is cancelled user''s profile :)</p>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cf_websites`
--

DROP TABLE IF EXISTS `cf_websites`;
CREATE TABLE IF NOT EXISTS `cf_websites` (
  `websites_id` int(11) NOT NULL AUTO_INCREMENT,
  `websites_name` varchar(255) DEFAULT NULL,
  `websites_url` varchar(255) NOT NULL,
  `websites_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`websites_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cf_websites`
--

INSERT INTO `cf_websites` (`websites_id`, `websites_name`, `websites_url`, `websites_status`) VALUES
(1, 'Codefight CMS', 'http://local.codefight.org/', 1),
(2, 'Tips-Tricks', 'http://local.learntipsandtricks.com/', 1),
(3, 'Zoosper', 'http://local.zoosper.com/', 1),
(4, 'Coupon Gift Deals', 'http://local.coupongiftdeals.com/', 1);
SET FOREIGN_KEY_CHECKS=1;
