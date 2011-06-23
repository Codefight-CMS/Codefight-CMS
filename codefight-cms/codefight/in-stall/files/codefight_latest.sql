-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2011 at 10:17 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `codefight`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_banner`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cf_file`
--

INSERT INTO `cf_file` (`file_id`, `file_title`, `file_description`, `folder_id`, `file_name`, `file_path`, `file_type`, `file_ext`, `file_size`, `is_image`, `image_width`, `image_height`, `file_access`, `file_access_members`, `file_status`, `file_publish_date`, `file_expire_date`) VALUES
(11, 'Software Box', 'Codefight software package box', 2, 'Codefight-CMS-A-Codeigniter-CMS.jpg', 'media/gallery/', 'image/jpeg', '.jpg', 191.14, 1, 716, 762, 'public', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Screenshot', 'This is a screenshot image file.', 2, 'codefight-1.2_.0_.png', 'media/gallery/', 'image/png', '.png', 13.76, 1, 720, 285, 'public', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Codefight CMS 2.0 Youtube video', 'Codefight cms preview', 1, 'codefight-cms-2-0-preview.png', 'media/', 'image/png', '.png', 59.80, 1, 500, 296, 'public', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cf_folder`
--

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
(1, 0, '/', 'Home', 1, NULL, 'all', NULL, 0),
(2, 1, '/gallery/', 'gallery', 1, 'codefight-1.2_.0-2_.png', 'public', NULL, 1),
(3, 1, '/banners/', 'banners', 1, '', 'public', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_data_int`
--

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
(2, 16, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n \nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?\n\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.');

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_data_varchar`
--

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
(8, 17, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_group`
--

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
(15, 'submit', 'Submit', 'submit', '', '', '', 'varchar', 0),
(16, 'message', 'Your Message', 'textarea', 'trim|required', '', 'class="txtFld"', 'text', 0),
(17, 'gender', 'Gender', 'radio', '', 'm=Male|f=Female', '', 'varchar', 1),
(18, 'newsletters_options[]', 'Select newsletters you would like to subscribe', 'checkbox', '', '1=maths|2=computer|3=science', '', 'varchar', 0),
(20, 'file', 'file', 'file', 'trim|required', '', 'class=&quot;txtFld&quot;', 'text', 0),
(21, 'receive_by', 'Who do you want to receive this submission?', 'select', 'trim|required', 'Admin=Admin|Sales=Sales|Support=Support', 'class=&quot;txtFld&quot;', 'varchar', 0),
(22, 'contact_number', 'Contact Number', 'textbox', 'trim', '', 'class="txtFld"', 'varchar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_item_to_group`
--

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
(4, 22, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_form_submitted`
--

CREATE TABLE IF NOT EXISTS `cf_form_submitted` (
  `form_submitted_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_group_id` int(11) NOT NULL,
  `form_status` int(11) NOT NULL,
  PRIMARY KEY (`form_submitted_id`),
  KEY `form_groups_id` (`form_group_id`,`form_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `cf_form_submitted`
--

INSERT INTO `cf_form_submitted` (`form_submitted_id`, `form_group_id`, `form_status`) VALUES
(8, 4, 0),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_group`
--

CREATE TABLE IF NOT EXISTS `cf_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `group_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `groups_title` (`group_title`),
  KEY `groups_sort` (`group_sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cf_group`
--

INSERT INTO `cf_group` (`group_id`, `group_title`, `group_description`, `group_sort`) VALUES
(1, 'Administrator', 'Users who have admin access rights go to this group.', 0),
(2, 'Public', 'General users go to this group.', 2),
(3, 'Registered User', 'Registered User Group.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_menu`
--

CREATE TABLE IF NOT EXISTS `cf_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_active` int(1) NOT NULL DEFAULT '0',
  `menu_parent_id` int(11) DEFAULT '0',
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL,
  `menu_type` varchar(255) NOT NULL DEFAULT 'pages',
  `menu_meta_title` varchar(70) DEFAULT NULL,
  `menu_meta_keywords` varchar(200) DEFAULT NULL,
  `menu_meta_description` varchar(150) DEFAULT NULL,
  `menu_sort` int(11) NOT NULL DEFAULT '0',
  `websites_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `cf_menu`
--

INSERT INTO `cf_menu` (`menu_id`, `menu_active`, `menu_parent_id`, `menu_link`, `menu_title`, `menu_type`, `menu_meta_title`, `menu_meta_keywords`, `menu_meta_description`, `menu_sort`, `websites_id`) VALUES
(72, 1, 0, 'codefight-cms-preview-built-with-codeigniter-2.0-framework-demo-code', 'Preview / Demo', 'page', '', '', '', 4, ',1,'),
(86, 1, 0, 'releases', 'Releases', 'blog', '', '', '', 9, ',1,3,'),
(71, 1, 0, 'privacy-policy', 'Privacy Policy', 'page', '', '', '', 7, ',3,4,'),
(40, 1, 0, 'http://twitter.com/dbashyal', 'Twitter', 'favourite-links', '', '', '', 1, ',1,2,3,'),
(41, 1, 0, 'http://www.linkedin.com/in/dbashyal', 'Linked In', 'favourite-links', '', '', '', 2, ',1,2,3,'),
(75, 1, 0, 'home', 'Home', 'page', '', '', '', 0, ',1,2,3,4,'),
(88, 1, 0, 'jobs', 'JOBS', 'blog', '', '', '', 20, ',1,'),
(69, 1, 0, 'http://zoosper.com', 'zoosper', 'sponsored-links', '', '', '', 0, ',1,2,3,'),
(70, 1, 0, 'http://codefight.org/', 'Codefight CMS', 'blog-roll', '', '', '', 0, ',2,3,4,'),
(80, 1, 0, 'blog', 'Blog', 'page', '', '', '', 3, ',1,2,3,4,'),
(81, 1, 0, 'http://cmsigniter.com/download-codefight-cms', 'Downloads', 'page', '', '', '', 2, ',1,3,'),
(82, 1, 0, 'about-us', 'About Us', 'page', '', '', '', 5, ',2,3,4,'),
(83, 1, 0, 'contact-us', 'Contact Us', 'page', '', '', '', 6, ',1,2,3,4,'),
(84, 1, 0, 'http://www.tenthweb.com/forums/viewforum.php?title=codefight.org&f=49', 'Forum', 'page', '', '', '', 1, ',1,3,'),
(109, 1, 0, 'advertising', 'Advertising', 'blog', '', '', '', 1, ',2,'),
(85, 1, 0, 'search', 'Search', 'page', '', '', '', 8, ',2,3,4,'),
(89, 1, 0, 'web-resources', 'Web Resources', 'blog', '', '', '', 11, ',1,'),
(90, 1, 0, 'codeigniter', 'Codeigniter', 'blog', '', '', '', 13, ',1,'),
(91, 1, 0, 'zend', 'Zend', 'blog', '', '', '', 12, ',1,'),
(92, 1, 0, 'magento', 'Magento', 'blog', '', '', '', 14, ',1,'),
(93, 1, 0, 'diary', 'Diary', 'blog', '', '', '', 15, ',1,'),
(94, 1, 0, 'nepal', 'Nepal', 'blog', '', '', '', 16, ',1,'),
(95, 1, 0, 'australia', 'Australia', 'blog', '', '', '', 17, ',1,'),
(96, 1, 0, 'guest-articles', 'Guest Articles', 'blog', '', '', '', 18, ',1,'),
(97, 1, 0, 'tips', 'Tips', 'blog', '', '', '', 19, ',1,'),
(98, 1, 0, 'http://www.shiflett.org/', 'Chris Shiflett', 'blog-roll', '', '', '', 1, ',1,'),
(99, 1, 0, 'http://www.derekallard.com/', 'Derek Allard', 'blog-roll', '', '', '', 3, ',1,'),
(100, 1, 0, 'http://www.haughin.com/', 'Elliot Haughin', 'blog-roll', '', '', '', 2, ',1,'),
(101, 1, 0, 'http://www.michaelwales.com/', 'Michael Wales', 'blog-roll', '', '', '', 4, ',1,'),
(102, 0, 0, 'http://forums.zoosper.com/', 'Forums', 'sponsored-links', '', '', '', 0, ',1,'),
(103, 1, 0, 'http://astore.zoosper.com/node/22/cat/Books', 'Zoosper Shopping Centre', 'sponsored-links', '', '', '', 0, ',1,'),
(104, 1, 0, 'http://www.clixGalore.com/PSale.aspx?BID=528&amp;AfID=86513&amp;AdID=26', 'Earn Commission For Life', 'sponsored-links', '', '', '', 0, ',1,'),
(105, 1, 0, 'http://www.dpbolvw.net/click-3424053-10422157', 'Host Monster', 'favourite-links', '', '', '', 4, ',1,'),
(106, 1, 0, 'http://www.facebook.com/codefight', 'Facebook', 'favourite-links', '', '', '', 0, ',1,'),
(107, 1, 0, 'http://astore.zoosper.com/node/22/cat/Books', 'Zoosper Shopping Centre', 'favourite-links', '', '', '', 3, ',1,'),
(108, 1, 0, 'codefight-cms', 'CodeFight CMS', 'blog', '', '', '', 10, ',1,'),
(110, 1, 0, 'affiliate-marketing', 'Affiliate Marketing', 'blog', '', '', '', 2, ',2,'),
(111, 1, 0, 'google-page-rank', 'Google Page Rank', 'blog', '', '', '', 5, ',2,'),
(112, 1, 0, 'search-engine-optimization', 'Search Engine Optimization', 'blog', '', '', '', 6, ',2,'),
(113, 1, 0, 'http://astore.zoosper.com/search?node=22&keywords=money&x=12&y=11&preview=', 'Make Easy Money - Books', 'blog-roll', '', '', '', 0, ',2,'),
(114, 1, 0, 'alexa', 'Alexa', 'blog', '', '', '', 3, ',2,'),
(115, 1, 0, 'social-media', 'Social Media', 'blog', '', '', '', 7, ',2,'),
(116, 1, 0, 'facebook', 'Facebook', 'blog', '', '', '', 4, ',2,'),
(117, 1, 0, 'twitter', 'Twitter', 'blog', '', '', '', 8, ',2,'),
(118, 1, 0, 'adsense', 'Adsense', 'blog', '', '', '', 0, ',2,');

-- --------------------------------------------------------

--
-- Table structure for table `cf_page`
--

CREATE TABLE IF NOT EXISTS `cf_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_active` int(1) NOT NULL DEFAULT '0',
  `page_code` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_blurb` text,
  `page_blurb_length` int(4) NOT NULL DEFAULT '0',
  `page_body` text,
  `menu_id` varchar(255) NOT NULL DEFAULT '0',
  `websites_id` varchar(255) NOT NULL DEFAULT '0',
  `page_author` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `cf_page`
--

INSERT INTO `cf_page` (`page_id`, `page_active`, `page_code`, `page_title`, `page_blurb`, `page_blurb_length`, `page_body`, `menu_id`, `websites_id`, `page_author`, `show_author`, `page_date`, `page_date_modified`, `show_date`, `page_tag`, `allow_comment`, `page_type`, `page_view`, `page_meta_title`, `page_meta_keywords`, `page_meta_description`, `page_sort`) VALUES
(19, 1, NULL, 'How much it costs to call directly to heaven from Nepal?', '<p>An American   decided to write a book about famous churches around the World. So he bought   a plane ticket and took a trip to China   . On his first day he was inside a church taking photographs when   he Noticed a golden telephone mounted on the wall with a sign that   read "$10,000 per call". The American, being intrigued, asked a priest who   was strolling by what?The telephone was used for. The priest replied   that it was a direct line to heaven and that for $10,000 you could talk to   God.</p>\r\n<p>The American thanked the priest and went along his way.?</p>\r\n<p>Next   stop was in Japan .   There, at a very large cathedral, he saw the Same golden telephone with the same   sign under it.</p>\r\n<p>', 0, '<p>An American   decided to write a book about famous churches around the World. So he bought   a plane ticket and took a trip to China   . On his first day he was inside a church taking photographs when   he Noticed a golden telephone mounted on the wall with a sign that   read "$10,000 per call". The American, being intrigued, asked a priest who   was strolling by what?The telephone was used for. The priest replied   that it was a direct line to heaven and that for $10,000 you could talk to   God.</p>\r\n<p>The American thanked the priest and went along his way.?</p>\r\n<p>Next   stop was in Japan .   There, at a very large cathedral, he saw the Same golden telephone with the same   sign under it.</p>\r\n<p><!-- pagebreak --></p>\r\n<p>He wondered if this was the same kind of telephone he saw   in China   and He asked a nearby nun what its purpose was.</p>\r\n<p>She told him that it was   a direct line to heaven and that for $10,000 He Could talk to   God.?</p>\r\n<p>"O.K., thank you," said the American.?He then traveled to   Pakistan ,   Srilanka ,   Russia ,   Germany   and France.</p>\r\n<p>In every church he saw the same golden telephone with the same   "$10,000 Per call" sign under it.?The American, upon leaving   Vermont   decided to travel to up to?Nepal   to See if?Nepalese had the same phone.</p>\r\n<p>He?arrived in?Nepal ,   and again, in the first church he entered, there Was the same golden   telephone, but this s time the sign under it read "One Rupee per   call."</p>\r\n<p>The American was surprised so he asked the priest about the   sign. "Father, I''ve traveled all over World and I''ve seen this same   golden Telephone in many churches. I''m told that it is a direct line   to?Heaven, But in rest of the world price was $10,000 per call.</p>\r\n<p>Why   is it so cheap here?"</p>\r\n<p>Readers, it is your turn........ Think ....before   you scroll down...</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>The priest smiled and answered, "You''re   in?Nepal   now, Son -?it''s a Local Call?". This is the only heaven on the   Earth.?</p>\r\n<p>KEEP SMILING</p>\r\n<p>If you are proud to be ?Nepalese, pass this   on!!!</p>', ',93,94,', ',4,', 'Got this in email as forward from Aneeta Gurung', 1, '2009-04-12 19:16:58', NULL, 1, 'Nepal,Nepali,Proud to be nepalese,email forward', 1, 'blog', 924, 'How much it costs to call directly to heaven from Nepal?', 'Nepal,Nepali,Proud to be nepalese,email forward', '', 0),
(37, 1, NULL, 'Kushal''s First Youtube Video', '<p>{{banner 2}}</p>\r\n<p>Hey! Its me Kushal Bashyal. I am 5months and 3weeks old today. I am very happy today and trying to jump. Wanna watch me jump. So, what you think? My grand mom is trying to hold me but she is very tired but i am enjoying a lot and jumping and jumping and making everyone happy. Hope you like it. Hi nanu sis, saru &amp; yeshu aunt this is for you to see me. And, everyone else as well :)</p>\r\n<p>{{banner 2}}</p>\r\n<div style="margin: 0pt auto; width: 480px; height: 385px; display: block;">\r\n<object width="480" height="385" data="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" type="application/x-shockwave-flash">\r\n<param name="allowFullScreen" value="true" />\r\n<param name="allowscriptaccess" value="always" />\r\n<param name="src" value="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" />\r\n<param name="allowfullscreen" value="true" />\r\n</object>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>', 0, '<p>{{banner 2}}</p>\r\n<p>Hey! Its me Kushal Bashyal. I am 5months and 3weeks old today. I am very happy today and trying to jump. Wanna watch me jump. So, what you think? My grand mom is trying to hold me but she is very tired but i am enjoying a lot and jumping and jumping and making everyone happy. Hope you like it. Hi nanu sis, saru &amp; yeshu aunt this is for you to see me. And, everyone else as well :)</p>\r\n<p>{{banner 2}}</p>\r\n<div style="margin: 0pt auto; width: 480px; height: 385px; display: block;">\r\n<object width="480" height="385" data="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" type="application/x-shockwave-flash">\r\n<param name="allowFullScreen" value="true" />\r\n<param name="allowscriptaccess" value="always" />\r\n<param name="src" value="http://www.youtube.com/v/eJA-LeXnqgc&amp;hl=en_US&amp;fs=1&amp;rel=0&amp;color1=0x234900&amp;color2=0x4e9e00" />\r\n<param name="allowfullscreen" value="true" />\r\n</object>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>', ',93,', ',4,', 'Damodar Bashyal', 1, '2009-06-06 05:45:32', NULL, 1, 'Kushal Bashyal, Baby, Baby Jumping,Happy Baby', 1, 'blog', 973, 'Cute Little Happy Baby Jumping - codefight.org', 'Kushal Bashyal, Baby, Baby Jumping,Happy Baby', 'This is kushal 5months, happy and jumping with the help of grandmom', 0),
(54, 1, NULL, 'Canonical Page For All Pages That Have No Content', '<p>Blank.</p>\n<p>This is parked page for seo stuff. Inplace of meta nofollow probably i''ll use this page as canonical page.</p>', 0, '<p>Blank.</p>\n<p>This is parked page for seo stuff. Inplace of meta nofollow probably i''ll use this page as canonical page.</p>', ',0,', ',0,', 'Damodar Bashyal', 1, '2010-04-16 22:32:00', NULL, 1, '', 1, 'page', 2684, 'Replacement page for meta noindex, nofollow | codefight .org', 'meta,noindex,nofollow,search,engine,page,rank', 'Remove your less value pages from search index to give more priority to main pages.', 0),
(67, 1, NULL, 'Contact Us', '<p>Please fill the form below to contact us.</p>\n<p>{{form contact_us}}</p>', 0, '<p>Please fill the form below to contact us.</p>\n<p>{{form contact_us}}</p>', ',83,', ',1,2,3,', '', 0, '2010-11-01 00:00:00', NULL, 0, '', 0, 'page', 4, 'Contact Us', 'contact us,codefight cms,text link ads review,zoosper', 'Contact us for any enquiry regarding our websites.', 0),
(68, 1, NULL, 'Privacy Policy', '<p>We don''t sell your details. We don''t use your data to spam or for any other reason.</p>', 0, '<p>We don''t sell your details. We don''t use your data to spam or for any other reason.</p>', ',71,', ',2,3,', '', 0, '2010-01-20 00:00:00', NULL, 0, '', 0, 'page', 0, 'Privacy Policy - codefight.org', 'privacy, policy, codefight, cms, open, source, content, management, system', 'we don''t sell your details. Codefight is a free content management system.', 0),
(69, 1, NULL, 'Google made it easy to search our sites.', '<p>Please enter the word you are looking for</p>\n<div class="google_custom_search_engine">\n<div id="cse" style="width: 100%;">Loading</div>\n<script src="http://www.google.com/jsapi" type="text/javascript"></script>\n<script type="text/javascript"><!--\n   google.load(''search'', ''1'');\n   google.setOnLoadCallback(function(){\n      new google.search.CustomSearchControl(''010442767483169701592:ibrawdecaa8'').draw(''cse'');\n   }, true);\n// --></script>\n</div>', 0, '<p>Please enter the word you are looking for</p>\n<div class="google_custom_search_engine">\n<div id="cse" style="width: 100%;">Loading</div>\n<script src="http://www.google.com/jsapi" type="text/javascript"></script>\n<script type="text/javascript"><!--\n   google.load(''search'', ''1'');\n   google.setOnLoadCallback(function(){\n      new google.search.CustomSearchControl(''010442767483169701592:ibrawdecaa8'').draw(''cse'');\n   }, true);\n// --></script>\n</div>', ',85,', ',1,2,3,', '', 0, '2010-11-15 00:00:00', NULL, 0, '', 0, 'page', 9, 'Google made it easy to search our sites - codefight.org', 'google,search,made,easy,with,site search,codefight,tenthweb', 'Please enter the word you are looking for in our sites codefight and tenthweb.', 0),
(70, 1, NULL, 'Codefight CMS', '<h1>Codefight CMS - A light weight Codeigniter php framework cms.</h1>\n<div style="display:block;float:right;margin:0 0 15px;"><a title="Codefight - simple php cms using codeigniter" rel="nofollow external" href="http://cmsigniter.com/download-codefight-cms" target="_blank"><img src="http://skin.zoosper.com/media/upload/Codefight-CMS-Sfotware-md.png" border="0" alt="Download Latest SEO Friendly Codefight BLOG CMS" /></a></div>\n<p>Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.</p>\n<p>The latest version will have a multiple website manager. The new version is almost ready and is in staging for testing purpose before its official release.</p>\n<p>If you would like to get informed about the latest releases and news please do subscribe to our feed.</p>\n<p>Since Codefight CMS is available for use free of charge, I would appreciate and welcome any feedback, contributions to the code and help translating language files into your language.&nbsp;&nbsp;&nbsp;</p>\n<p>You can use this CMS in any way you want: You can modify it as you like and use commercially for free.</p>\n<p class="clear">&nbsp;</p>\n<p><a href="http://videos.tenthweb.com/index/watch/yt/KnVsHoA6YB4/?t=codefight+CMS+2.0+preview"><img title="codefight CMS preview video on youtube." src="http://skin.zoosper.com/media/codefight-cms-2-0-preview.png" alt="Codefight CMS 2.0 preview" /></a></p>\n<h6>Codefight CMS 2.0, a multiple website management software, based on codeigniter 2.0 php framework.<br /></h6>', 0, '<h1>Codefight CMS - A light weight Codeigniter php framework cms.</h1>\n<div style="display:block;float:right;margin:0 0 15px;"><a title="Codefight - simple php cms using codeigniter" rel="nofollow external" href="http://cmsigniter.com/download-codefight-cms" target="_blank"><img src="http://skin.zoosper.com/media/upload/Codefight-CMS-Sfotware-md.png" border="0" alt="Download Latest SEO Friendly Codefight BLOG CMS" /></a></div>\n<p>Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.</p>\n<p>The latest version will have a multiple website manager. The new version is almost ready and is in staging for testing purpose before its official release.</p>\n<p>If you would like to get informed about the latest releases and news please do subscribe to our feed.</p>\n<p>Since Codefight CMS is available for use free of charge, I would appreciate and welcome any feedback, contributions to the code and help translating language files into your language.&nbsp;&nbsp;&nbsp;</p>\n<p>You can use this CMS in any way you want: You can modify it as you like and use commercially for free.</p>\n<p class="clear">&nbsp;</p>\n<p><a href="http://videos.tenthweb.com/index/watch/yt/KnVsHoA6YB4/?t=codefight+CMS+2.0+preview"><img title="codefight CMS preview video on youtube." src="http://skin.zoosper.com/media/codefight-cms-2-0-preview.png" alt="Codefight CMS 2.0 preview" /></a></p>\n<h6>Codefight CMS 2.0, a multiple website management software, based on codeigniter 2.0 php framework.<br /></h6>', ',75,', ',1,', '', 0, '2010-12-20 00:00:00', NULL, 0, '', 0, 'page', 4, 'Codefight CMS - Codeigniter Multiple Website Manager', 'Codeigniter,cms,codefight,website,manager,php,multiple,website', 'Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.', 0),
(71, 1, NULL, 'Codefight PHP Content Management System (CMS)', '<p>\n<script src="/skin/frontend/default/js/prototype.js" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/lightbox.js" type="text/javascript"></script>\n</p>\n<h1>Codefight PHP Content Management System (CMS)</h1>\n<div class="banner"><span class="download_link"><a href="http://code.google.com/p/cmsdamu/downloads/list">Download Pre-release Code</a>\n<script src="http://ohloh.net/p/318042/widgets/project_thin_badge.js" type="text/javascript"></script>\n</span><a title="Make money online from sponsored tweets. Its that easy to make money online working from home." href="http://bit.ly/3qzpDq" target="_blank">Today''s Preview Brought To You By Sponsored Tweets.</a></div>\n<p>This is only screenshot Preview of Codefight Content Management System (CMS) which is built with the help of <a title="CodeIgniter - Open source PHP web application framework" href="http://codeigniter.com">codeigniter</a> php framework</p>\n<p>This is still under development. So far the below items from screen shot are completed. If you want to give suggestions and feedbacks, you can do so at our forum <a title="Tenthweb is a place to express your opinions and ask questions on our very own forum." href="http://tenthweb.com/forums/viewforum.php?f=49">tenthweb.com</a></p>\n<p>For backend demo visit:<a title="content management system built with php framework codeigniter - demo (codefight)" href="http://codefight.org/demo/admin.html" target="_blank">http://codefight.org/demo/admin.html</a> <br /> For frontend demo visit: <a href="http://codefight.org/demo/home.html" target="_blank">http://codefight.org/demo/home.html</a> <br /> To download code visit: <a href="http://code.google.com/p/cmsdamu/downloads/list" target="_blank">http://code.google.com/p/cmsdamu/downloads/list</a> <br /> <br /> [please leave a comment in our forum.]</p>\n<p class="notice"><strong>Update: 13.03.2009</strong><br /> Codefight homepage is now powered by codefight cms</p>\n<p><em><strong>This screenshot is outdated. Demo is newer than screenshot. Download can be newer than demo.</strong></em></p>\n<table style="width: 780px;" border="0" cellspacing="10" cellpadding="4" align="center">\n<tbody>\n<tr>\n<td width="260" align="left" valign="top"><a title="Login Form" rel="lightbox[codefight]" href="/media/upload/screenshots/login.jpg"><img src="/media/upload/screenshots/login_thumb.jpg" alt="login thumb" width="250" height="108" /></a></td>\n<td width="260" align="left" valign="top"><a title="Welcome Page After Login" rel="lightbox[codefight]" href="/media/upload/screenshots/welcome.jpg"><img src="/media/upload/screenshots/welcome_thumb.jpg" alt="welcome thumb" width="250" height="88" /></a></td>\n</tr>\n<tr>\n<td width="260" align="left" valign="top"><a title="Groups View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/groups_view.jpg"><img src="/media/upload/screenshots/groups_view_thumb.jpg" alt="groups view thumb" width="250" height="155" /></a></td>\n<td align="left" valign="top"><a title="Groups Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/group_edit.jpg"><img src="/media/upload/screenshots/group_edit_thumb.jpg" alt="group edit thumb" width="250" height="175" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Groups Create" rel="lightbox[codefight]" href="/media/upload/screenshots/group_create.jpg"><img src="/media/upload/screenshots/group_create_thumb.jpg" alt="group create thumb" width="250" height="107" /></a></td>\n<td align="left" valign="top"><a title="Users View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users.jpg"><img src="/media/upload/screenshots/users_thumb.jpg" alt="users thumb" width="250" height="74" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Users Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users_edit.jpg"><img src="/media/upload/screenshots/users_edit_thumb.jpg" alt="users edit thumb" width="250" height="163" /></a></td>\n<td align="left" valign="top"><a title="Menu View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus.jpg"><img src="/media/upload/screenshots/menus_thumb.jpg" alt="menus thumb" width="250" height="191" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Menu Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus_edit.jpg"><img src="/media/upload/screenshots/menus_edit_thumb.jpg" alt="menus edit thumb" width="250" height="180" /></a></td>\n<td align="left" valign="top"><a title="Pages View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages.jpg"><img src="/media/upload/screenshots/pages_thumb.jpg" alt="pages thumb" width="250" height="158" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Pages Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages_edit.jpg"><img src="/media/upload/screenshots/pages_edit_thumb.jpg" alt="pages edit thumb" width="250" height="204" /></a></td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', 0, '<p>\n<script src="/skin/frontend/default/js/prototype.js" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>\n<script src="/skin/frontend/default/js/lightbox.js" type="text/javascript"></script>\n</p>\n<h1>Codefight PHP Content Management System (CMS)</h1>\n<div class="banner"><span class="download_link"><a href="http://code.google.com/p/cmsdamu/downloads/list">Download Pre-release Code</a>\n<script src="http://ohloh.net/p/318042/widgets/project_thin_badge.js" type="text/javascript"></script>\n</span><a title="Make money online from sponsored tweets. Its that easy to make money online working from home." href="http://bit.ly/3qzpDq" target="_blank">Today''s Preview Brought To You By Sponsored Tweets.</a></div>\n<p>This is only screenshot Preview of Codefight Content Management System (CMS) which is built with the help of <a title="CodeIgniter - Open source PHP web application framework" href="http://codeigniter.com">codeigniter</a> php framework</p>\n<p>This is still under development. So far the below items from screen shot are completed. If you want to give suggestions and feedbacks, you can do so at our forum <a title="Tenthweb is a place to express your opinions and ask questions on our very own forum." href="http://tenthweb.com/forums/viewforum.php?f=49">tenthweb.com</a></p>\n<p>For backend demo visit:<a title="content management system built with php framework codeigniter - demo (codefight)" href="http://codefight.org/demo/admin.html" target="_blank">http://codefight.org/demo/admin.html</a> <br /> For frontend demo visit: <a href="http://codefight.org/demo/home.html" target="_blank">http://codefight.org/demo/home.html</a> <br /> To download code visit: <a href="http://code.google.com/p/cmsdamu/downloads/list" target="_blank">http://code.google.com/p/cmsdamu/downloads/list</a> <br /> <br /> [please leave a comment in our forum.]</p>\n<p class="notice"><strong>Update: 13.03.2009</strong><br /> Codefight homepage is now powered by codefight cms</p>\n<p><em><strong>This screenshot is outdated. Demo is newer than screenshot. Download can be newer than demo.</strong></em></p>\n<table style="width: 780px;" border="0" cellspacing="10" cellpadding="4" align="center">\n<tbody>\n<tr>\n<td width="260" align="left" valign="top"><a title="Login Form" rel="lightbox[codefight]" href="/media/upload/screenshots/login.jpg"><img src="/media/upload/screenshots/login_thumb.jpg" alt="login thumb" width="250" height="108" /></a></td>\n<td width="260" align="left" valign="top"><a title="Welcome Page After Login" rel="lightbox[codefight]" href="/media/upload/screenshots/welcome.jpg"><img src="/media/upload/screenshots/welcome_thumb.jpg" alt="welcome thumb" width="250" height="88" /></a></td>\n</tr>\n<tr>\n<td width="260" align="left" valign="top"><a title="Groups View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/groups_view.jpg"><img src="/media/upload/screenshots/groups_view_thumb.jpg" alt="groups view thumb" width="250" height="155" /></a></td>\n<td align="left" valign="top"><a title="Groups Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/group_edit.jpg"><img src="/media/upload/screenshots/group_edit_thumb.jpg" alt="group edit thumb" width="250" height="175" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Groups Create" rel="lightbox[codefight]" href="/media/upload/screenshots/group_create.jpg"><img src="/media/upload/screenshots/group_create_thumb.jpg" alt="group create thumb" width="250" height="107" /></a></td>\n<td align="left" valign="top"><a title="Users View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users.jpg"><img src="/media/upload/screenshots/users_thumb.jpg" alt="users thumb" width="250" height="74" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Users Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/users_edit.jpg"><img src="/media/upload/screenshots/users_edit_thumb.jpg" alt="users edit thumb" width="250" height="163" /></a></td>\n<td align="left" valign="top"><a title="Menu View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus.jpg"><img src="/media/upload/screenshots/menus_thumb.jpg" alt="menus thumb" width="250" height="191" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Menu Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/menus_edit.jpg"><img src="/media/upload/screenshots/menus_edit_thumb.jpg" alt="menus edit thumb" width="250" height="180" /></a></td>\n<td align="left" valign="top"><a title="Pages View Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages.jpg"><img src="/media/upload/screenshots/pages_thumb.jpg" alt="pages thumb" width="250" height="158" /></a></td>\n</tr>\n<tr>\n<td align="left" valign="top"><a title="Pages Edit Page" rel="lightbox[codefight]" href="/media/upload/screenshots/pages_edit.jpg"><img src="/media/upload/screenshots/pages_edit_thumb.jpg" alt="pages edit thumb" width="250" height="204" /></a></td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', ',72,', ',1,', '', 0, '2011-01-01 00:00:00', NULL, 0, '', 0, 'page', 104, 'Codefight PHP Content Management System &#40;CMS&#41; Preview', 'codefight,cms,demo,preview,codeigniter,2.0,multiple,website,manager', 'This is only screenshot Preview of Codefight Content Management System &#40;CMS&#41; which is built with the help of codeigniter php framework', 0),
(72, 1, NULL, 'About Us', '<p>We are a collection of professionals focused on the benefits of text link ads.&nbsp;    Our goal is to build a long-standing, comprehensive review website of internet    marketers and affiliate marketers. Differing from most websites, we aim to develop    relationships, observe the internet atmosphere, and report our observations    and experiences to you, the consumer.&nbsp; We want you to benefit from our    observations, reports, and informational blogs for years to come, so we will    work hard to cement our professional review site in the industry.</p>\n<p>Yes, we love to hear constructive feedbacks from our visitors, guests and members.</p>\n<p>Yes, we read every comment.&nbsp; We enjoy reading and manually approving each    comment -- you are heard and don''t go unnoticed.</p>\n<p>We will try to scrub all the details before publishing, and we would love to    hear if we miss any spots.</p>\n<p>Thank you for your assistance and continued membership.</p>\n<p>Kind regards,</p>\n<p>TextLinkAdsReview.com</p>', 0, '<p>We are a collection of professionals focused on the benefits of text link ads.&nbsp;    Our goal is to build a long-standing, comprehensive review website of internet    marketers and affiliate marketers. Differing from most websites, we aim to develop    relationships, observe the internet atmosphere, and report our observations    and experiences to you, the consumer.&nbsp; We want you to benefit from our    observations, reports, and informational blogs for years to come, so we will    work hard to cement our professional review site in the industry.</p>\n<p>Yes, we love to hear constructive feedbacks from our visitors, guests and members.</p>\n<p>Yes, we read every comment.&nbsp; We enjoy reading and manually approving each    comment -- you are heard and don''t go unnoticed.</p>\n<p>We will try to scrub all the details before publishing, and we would love to    hear if we miss any spots.</p>\n<p>Thank you for your assistance and continued membership.</p>\n<p>Kind regards,</p>\n<p>TextLinkAdsReview.com</p>', ',82,', ',2,', '', 0, '2010-01-20 00:00:00', NULL, 0, '', 0, 'page', 1, 'About Us - Text Link Ads Review', 'about us, text link ads review,about text link ads review, about TLAr', 'Our goal is to build a long-standing, comprehensive review website of internet marketers and affiliate marketers.', 0),
(73, 1, NULL, 'Search Text Link Ads Review', '<form action="http://textlinkadsreview.com/search/">\r\n<div><input name="cx" type="hidden" value="partner-pub-9567128729272204:5rf39g-1qd8" /> <input name="cof" type="hidden" value="FORID:11" /> <input name="ie" type="hidden" value="ISO-8859-1" /> <input name="q" size="31" type="text" /> <input name="sa" type="submit" value="Search" /></div>\r\n</form>\r\n<p>\r\n<script src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=en" type="text/javascript"></script>\r\n</p>\r\n<p>&nbsp;</p>\r\n<p>\r\n<script type="text/javascript"><!--\r\n  var googleSearchIframeName = "cse-search-results";\r\n  var googleSearchFormName = "cse-search-box";\r\n  var googleSearchFrameWidth = 795;\r\n  var googleSearchDomain = "www.google.com";\r\n  var googleSearchPath = "/cse";\r\n// --></script>\r\n<script src="http://www.google.com/afsonline/show_afs_search.js" type="text/javascript"></script>\r\n</p>', 0, '<form action="http://textlinkadsreview.com/search/">\r\n<div><input name="cx" type="hidden" value="partner-pub-9567128729272204:5rf39g-1qd8" /> <input name="cof" type="hidden" value="FORID:11" /> <input name="ie" type="hidden" value="ISO-8859-1" /> <input name="q" size="31" type="text" /> <input name="sa" type="submit" value="Search" /></div>\r\n</form>\r\n<p>\r\n<script src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=en" type="text/javascript"></script>\r\n</p>\r\n<p>&nbsp;</p>\r\n<p>\r\n<script type="text/javascript"><!--\r\n  var googleSearchIframeName = "cse-search-results";\r\n  var googleSearchFormName = "cse-search-box";\r\n  var googleSearchFrameWidth = 795;\r\n  var googleSearchDomain = "www.google.com";\r\n  var googleSearchPath = "/cse";\r\n// --></script>\r\n<script src="http://www.google.com/afsonline/show_afs_search.js" type="text/javascript"></script>\r\n</p>', ',0,', ',0,', '', 0, '2010-01-21 00:00:00', NULL, 0, '', 0, 'page', 0, 'Search Text Link Ads Review - TextLinkAdsReview.com', 'Google,Search, text link ads review,search text link ads review, search TLAr', 'Google Search for Text Link Ads Review.', 0),
(74, 1, NULL, 'Online Advertising | Text Link Ads | Banner Ads', '<p>Text link advertising is currently one of the most popular methods of internet    marketing. Here at TextLinkAdsReview.com, we realize the importance of text    link advertising in our modern marketing world, so we will write reviews on    different text link advertisement options. Whether you want to sell text link    ads or you want to buy text link ads, we have listed and reviewed many different    text link agencies on our website, and we are continuously working to review    more advertising options for your business.</p>\n<p>We realize there are many advertising companies and text link brokers available    to you, and only TextLinkAdsReview.com will review these many companies and    offer information to help you find the best marketing agency for your business.    These agencies charge a miniscule commission to find your ideal advertising    fit, but the advertising will help you increase your Google page rank slowly    by time.</p>\n<p>Text link ads are very positive for your business.&nbsp; They boost your SEO    (Search Engine Optimization) rating, and they are often better than pay-per-click    (PPC) advertising. PPC advertising can often lead to revenue-sharing clicking    - when a website that shares revenues with yours influences friends or family    to click your banner to decrease your revenue (and increase their own).&nbsp;    Also, because visitors trust text link ads more than flashy banners, visitors    are more apt to click text link ads.&nbsp; Viewed as a recommendation from the    site owner, a text link ad draws more traffic to your site.&nbsp; As for those    who own well-established, high-traffic sites, you can sell space on your site    to text link advertisers. Whether you would like to purchase text link space    or you would like to rent space on your site, the text link advertising business    is a win-win:&nbsp; You could either receive higher potential buyer traffic    for a flat fee, or you could receive residual income -- monthly rental income    that your don''t have to work for.</p>\n<p>There are numerous top advertising agencies who offer online and offline advertising    options, and our aim is to include most of them in our reviews. So keep in touch    with our blog posts and subscribe to our RSS.</p>\n<p>-TextLinkAdsReview.com</p>', 0, '<p>Text link advertising is currently one of the most popular methods of internet    marketing. Here at TextLinkAdsReview.com, we realize the importance of text    link advertising in our modern marketing world, so we will write reviews on    different text link advertisement options. Whether you want to sell text link    ads or you want to buy text link ads, we have listed and reviewed many different    text link agencies on our website, and we are continuously working to review    more advertising options for your business.</p>\n<p>We realize there are many advertising companies and text link brokers available    to you, and only TextLinkAdsReview.com will review these many companies and    offer information to help you find the best marketing agency for your business.    These agencies charge a miniscule commission to find your ideal advertising    fit, but the advertising will help you increase your Google page rank slowly    by time.</p>\n<p>Text link ads are very positive for your business.&nbsp; They boost your SEO    (Search Engine Optimization) rating, and they are often better than pay-per-click    (PPC) advertising. PPC advertising can often lead to revenue-sharing clicking    - when a website that shares revenues with yours influences friends or family    to click your banner to decrease your revenue (and increase their own).&nbsp;    Also, because visitors trust text link ads more than flashy banners, visitors    are more apt to click text link ads.&nbsp; Viewed as a recommendation from the    site owner, a text link ad draws more traffic to your site.&nbsp; As for those    who own well-established, high-traffic sites, you can sell space on your site    to text link advertisers. Whether you would like to purchase text link space    or you would like to rent space on your site, the text link advertising business    is a win-win:&nbsp; You could either receive higher potential buyer traffic    for a flat fee, or you could receive residual income -- monthly rental income    that your don''t have to work for.</p>\n<p>There are numerous top advertising agencies who offer online and offline advertising    options, and our aim is to include most of them in our reviews. So keep in touch    with our blog posts and subscribe to our RSS.</p>\n<p>-TextLinkAdsReview.com</p>', ',75,', ',2,', '', 0, '2010-01-20 00:00:00', NULL, 0, '', 0, 'page', 0, 'Text Link Ads Review | Buy Text Link Ads | Sell Text Link Ads', 'buying,selling,monetizing,text,link,advertising,banner,ppc', 'We review different Advertising Platforms like Text Link Ads and many more.', 0),
(100, 1, NULL, 'My Experience with CodeIgniter', '<p>CodeIgniter is not just a web development app, it is a powerful PHP-based framework designed for PHP coders seeking simple yet effective toolkit that can inspire them to develop full-featured web applications. Developers like me live in the real world. We need to deal with all of the hassles of shared <a href="http://www.webhostgear.com/" target="_blank"> hosting </a> accounts and clients with short deadlines. We don''t need to hassle around with inadequate and mediocre development tools hampered by poorly-designed user interfaces and thin documentation. CodeIgniter solves these problems so I can focus on other, more pressing issues.</p>\r\n<p>', 0, '<p>CodeIgniter is not just a web development app, it is a powerful PHP-based framework designed for PHP coders seeking simple yet effective toolkit that can inspire them to develop full-featured web applications. Developers like me live in the real world. We need to deal with all of the hassles of shared <a href="http://www.webhostgear.com/" target="_blank"> hosting </a> accounts and clients with short deadlines. We don''t need to hassle around with inadequate and mediocre development tools hampered by poorly-designed user interfaces and thin documentation. CodeIgniter solves these problems so I can focus on other, more pressing issues.</p>\r\n<p><!-- pagebreak --></p>\r\n<p>CodeIgniter allows me to save time and energy by providing tools and templates that give me a head start in the PHP game. Instead of writing PHP code by scratch, CodeIgniter writes all the basic "plumbing" for me so I can focus on the particulars of my project. I, for example, frequently take advantage of CodeIgniter''s built-in libraries instead of writing everything myself. With CodeIgniter, you can easily organize the different sections of the PHP application including configuration files, controllers, models, scripts and views. In the past I found many PHP development environments (IDEs) to be clunky, out-dated, and unmanageable. CodeIgniter is different. Its easy-to-use IDE gives you access to all of your files in a clear, organized fashion. It is simple and intuitive, allowing you to create great web pages with little prep-time.</p>\r\n<p>One thing that sets CodeIgniter apart from many other PHP web development applications is that it easily handles all PHP versions and configurations, an important feature for developers who work in diverse environments with many different clients, each having their own <a href="http://www.webhostgear.com/php-hosting.php/" target="_blank"> PHP web hosting </a> solution. If you are like me, you hardly spend all of your time in heterogeneous environments. That doesn''t matter with CodeIgniter. It will happily work with whatever version or versions you want!</p>\r\n<p>CodeIgniter does not require command lines, inflexible coding frameworks, or any templating languages (although it can work with templates if that is your cup of tea; it just doesn''t force you to do so). The documentation is clearly written so that even non-techies can grasp the system quickly and with minimal effort. It even comes stock with a number of useful features such as classes for file uploading, email, FTP and Zip compression. Another class I found handy was the validation class, which allows you to handle data validation with rules that are defined and assigned to specific objects. You can also use data validation to create automatic error messages when data does not pass muster.</p>\r\n<p>The auto-loading feature allows you to implement changes application wide by setting global models for libraries and plugins. Its included helpers cover CAPTCHA, cookie, directory, download, form, HTML, email, security and XML. If there is one thing CodeIgniter excels at, it''s saving you time. It should be pretty clear to you now that CodeIgniter it full of time-saving features helping you to focus less on mundane details and more on your job''s specifics.</p>\r\n<p>CodeIgniter even lets you create your own libraries -- or more precisely folders of classes in your libraries directory. You can create completely new libraries, or you can extend or replace native libraries. All classes can be extended or replaced except for the database classes. If you''re familiar with object-oriented programming, this feature will be a godsend for you.</p>\r\n<p>You can also create your own core system classes with this application. The core system classes are run automatically every time you start the program. CodeIgniter allows you to extend, edit or completely replace the native core system classes with your own alternatives although this is only recommended for experienced coders.</p>\r\n<p>CodeIgniter was a breeze for me to install. It requires PHP version 4.3.2 or newer and one of the following databases: MySQL, MySQLi, MS SQL, ODBC, Oracle, Postgre or SQLite. Most people (myself included) use MySQL, but it''s good to know it supports some of the other big names.</p>\r\n<p>Best of all, CodeIgniter is available as freeware so there is no charge for downloading and using this software! Even though EllisLab Network offers the CodeIgniter software free of charge, they still provide user forums, a wiki and a bug tracker to help support the application and its community of users.</p>\r\n<p>If you are looking for the best way to streamline your PHP web development process, then CodeIgniter may be just the application that you need - I know it was for me.</p>', ',96,', ',1,', 'Seth Bryant', 1, '2011-04-15 01:41:40', NULL, 1, 'codeigniter', 1, 'blog', 717, 'My Experience with CodeIgniter', 'codeigniter,codefight', 'With CodeIgniter, you can easily organize the different sections of the PHP application including configuration files, controllers, models, scripts and views.', 0),
(102, 1, NULL, 'Advertising in Applications', '<p>As iPads and other tablets become more popular, internet advertisers are attempting to tap into the new marketing potential. From magazines to game applications, many companies are finding innovative ways to capture the attention of tablet users. Let''s look at some ways companies are changing the face of advertising.</p>\r\n<h2>Traditional Advertising</h2>\r\n<p>Magazines with traditional advertising tactics of using edgy, attention-grabbing ads are still using similar ads in the new tablet issues. Initial research about magazine applications has found that readers expect to see advertisements in the tablet applications. In fact, many users look forward to perusing advertisements in print media and would be disappointed to find them missing in the magazines designed for tablets.</p>\r\n<p>', 0, '<p>As iPads and other tablets become more popular, internet advertisers are attempting to tap into the new marketing potential. From magazines to game applications, many companies are finding innovative ways to capture the attention of tablet users. Let''s look at some ways companies are changing the face of advertising.</p>\r\n<h2>Traditional Advertising</h2>\r\n<p>Magazines with traditional advertising tactics of using edgy, attention-grabbing ads are still using similar ads in the new tablet issues. Initial research about magazine applications has found that readers expect to see advertisements in the tablet applications. In fact, many users look forward to perusing advertisements in print media and would be disappointed to find them missing in the magazines designed for tablets.</p>\r\n<p><!-- pagebreak --></p>\r\n<h2>Advertising Within Applications</h2>\r\n<p>Moving forward, companies are also finding ways to sneak advertising into applications. Many free applications make money entirely off of the advertising potential. For example, a free game may use advertising revenue to make money, sneaking the advertisements into unobtrusive places.</p>\r\n<p>One example of this is in "Angry Birds." The application is available in both a free version and a purchased version. In the free version, "Angry Birds" players can try out the game for a few levels. Once the player reaches the end of the free version, s/he is given the option to purchase the full version. In a sense, "Angry Birds" advertises for itself.</p>\r\n<p>Other games, like solitaire, sell advertising to other companies. Once the free solitaire application is downloaded, users find that advertisements pop up in between each game. When you think about the low amount of time needed to play a game of solitaire, the advertising potential is pretty high and can be very effective.</p>\r\n<p>Other Advertising/Application Tips</p>\r\n<p>Of course, applications still need to be user-friendly and usable to make advertising effective. This means the application needs to have few or no bugs. If the application does not work properly, the user may forego the application -- and never see the advertising. Other additional tips include:</p>\r\n<ul>\r\n<li>\r\n<p>Make the application easy to use. This means that anywhere you question whether users need instructions, provide them. Also, using intuitive symbols and icons can help users better navigate your application.</p>\r\n</li>\r\n<li>\r\n<p>Make ads clear. If an advertisement does not clearly state its purpose and how to purchase the product, a customer will quickly skip it.</p>\r\n</li>\r\n<li>\r\n<p>Shake it up. With the tablet''s versatility, ads can use video and other forms of media to intrigue a customer. But in that same light, multiple advertisements in a single application benefit from using different advertisements throughout, so shake it up.</p>\r\n</li>\r\n<li>\r\n<p>Use how to videos. Short videos that provide the user with some information applicable to the advertisement will be more successful than simple advertisements.</p>\r\n</li>\r\n<li>\r\n<p>Feed them the product. The best way to ensure an interested party actually purchases the product is to link them directly with the sales page rather than the home page of the advertising company.</p>\r\n</li>\r\n<li>\r\n<p>Link it, link it, link it. With the tablets'' abilities to link customers directly to the desired product, magazines and applications are finding that linking directly from a magazine''s  or an application''s advertisement to the product will produce more buyers than indirect links -- or complete lack of links.</p>\r\n</li>\r\n</ul>\r\n<p>Applications and tablet magazines are becoming much more used in our ever-expanding tablet culture. As research is developed and users respond to the advertisements on applications, we find that interactive advertisements and direct links seem to be the most effective forms of tablet advertisements.</p>', ',109,', ',2,', 'Christa Palm', 1, '2011-04-30 19:52:22', NULL, 1, 'advertising', 1, 'blog', 260, 'Advertising in Applications - TLAr', 'advertising,angry birds,application,advertiser,advertise,traditional advertising', 'One example of this is in ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cf_page_access`
--

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
(102, '1_2');

-- --------------------------------------------------------

--
-- Table structure for table `cf_page_comment`
--

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

CREATE TABLE IF NOT EXISTS `cf_page_tag` (
  `page_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_page_tag`
--

INSERT INTO `cf_page_tag` (`page_id`, `tag`) VALUES
(102, 'advertising'),
(100, 'codeigniter'),
(37, 'Kushal-Bashyal'),
(37, 'Baby'),
(37, 'Baby-Jumping'),
(37, 'Happy-Baby'),
(19, 'Nepal'),
(19, 'Nepali'),
(19, 'Proud-to-be-nepalese'),
(19, 'email-forward'),
(73, '');

-- --------------------------------------------------------

--
-- Table structure for table `cf_sessions`
--

CREATE TABLE IF NOT EXISTS `cf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_sessions`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_setting`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `cf_setting`
--

INSERT INTO `cf_setting` (`setting_id`, `setting_key`, `setting_value`, `setting_info`, `setting_form`, `setting_option`, `websites_id`) VALUES
(2, 'site_enabled', '1', 'Site Enabled', 'radio', '1=YES|0=NO', 1),
(3, 'site_comment', '0', 'Registration required to post comments', 'radio', '1=YES|0=NO', 1),
(4, 'meta_title', 'Codefight CMS 1', 'Default Meta Title', 'textbox', 'codefight.org', 1),
(5, 'meta_keyword', 'codefight, code fight, content, management, system, free, php, download', 'Default Meta Keywords', 'textbox', 'codefight, code fight, content, management, system, free, php, download', 1),
(6, 'meta_description', 'download free content management system built with codeigniter free php framework.', 'Default Meta Description', 'textarea', 'download free content management system built with codeigniter free php framework.', 1),
(7, 'default_template', '3columnsBlack', 'Default Template', 'select', '', 1),
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
(71, 'default_template', 'skinmanager', 'Default Template', 'select', '', 3),
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
(55, 'default_template', 'textlinkadsreview', 'Default Template', 'select', '', 2),
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
(91, 'default_template', 'default', 'Default Template', 'select', '', 4),
(92, 'email_sender', 'noreply@codefightcms.com', 'From Email Address', 'textbox', 'noreply@codefight.org', 4),
(93, 'site_name', 'Codefight CMS 4', 'Website Name', 'textbox', 'CodeFight', 4),
(94, 'combine_css', '0', 'Combine CSS Files', 'radio', '1=YES|0=NO', 4),
(95, 'minify_css', '0', 'Minify CSS', 'radio', '1=YES|0=NO', 4),
(96, 'minify_html', '0', 'Minify html source code', 'radio', '1=YES|0=NO', 4),
(97, 'pagination_page_links', '2', 'Display Total Pagination Page Links', 'textbox', '2', 4),
(98, 'pagination_per_page', '3', 'Display Total Articles Per Page', 'textbox', '5', 4),
(99, 'google_analytics_id', 'UA-852764-5', 'Google Analytics Web Property ID', 'textbox', 'UA-852764-5', 4),
(100, 'display_view_path', '0', 'Do you want to display template path?', 'radio', '0=NO|1=YES', 4),
(101, 'default_recipients', 'noreply@codefightcms.com', 'Default Store Email Recipient', 'textbox', 'test@example.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cf_setting_keys`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

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
(81, 'default_recipients', '', 'Default Store Email Recipient', 'textbox', 'test@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `cf_tag_cloud`
--

CREATE TABLE IF NOT EXISTS `cf_tag_cloud` (
  `tag` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `type` varchar(15) NOT NULL DEFAULT 'page',
  `websites_id` int(11) NOT NULL DEFAULT '0',
  KEY `count` (`count`),
  KEY `websites_id` (`websites_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_tag_cloud`
--

INSERT INTO `cf_tag_cloud` (`tag`, `title`, `count`, `type`, `websites_id`) VALUES
('advertising', 'advertising', 1, 'blog', 2),
('codeigniter', 'codeigniter', 1, 'blog', 1),
('Kushal-Bashyal', 'Kushal Bashyal', 1, 'blog', 4),
('Baby', ' Baby', 1, 'blog', 4),
('Baby-Jumping', ' Baby Jumping', 1, 'blog', 4),
('Happy-Baby', 'Happy Baby', 1, 'blog', 4),
('Nepal', 'Nepal', 1, 'blog', 4),
('Nepali', 'Nepali', 1, 'blog', 4),
('Proud-to-be-nepalese', 'Proud to be nepalese', 1, 'blog', 4),
('email-forward', 'email forward', 1, 'blog', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cf_trim`
--

CREATE TABLE IF NOT EXISTS `cf_trim` (
  `trim_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `long_url` varchar(255) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `creator` char(15) NOT NULL,
  `referrals` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`trim_id`),
  UNIQUE KEY `long` (`long_url`),
  KEY `referrals` (`referrals`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cf_trim`
--

INSERT INTO `cf_trim` (`trim_id`, `long_url`, `created`, `creator`, `referrals`) VALUES
(1, 'http://codefight.org/', 1281169085, '127.0.0.1', 6),
(2, 'http://www.localhost.com/phpmyadmin', 1286608782, '127.0.0.1', 1),
(3, 'http://skin.zoosper.com/admin/trim', 1293918570, '220.244.123.85', 1),
(4, 'http://zoosper.com/q/Codefight-CMS', 1295045500, '60.241.160.134', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_user`
--

CREATE TABLE IF NOT EXISTS `cf_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `active` char(1) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(34) NOT NULL DEFAULT '',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `cf_user`
--

INSERT INTO `cf_user` (`user_id`, `active`, `email`, `password`, `firstname`, `lastname`, `group_id`) VALUES
(11, '1', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'Damodar', 'Bashyal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_websites`
--

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
(1, 'Codefight CMS 1', 'http://www.localhost.com/codefight_172/', 1),
(2, 'Codefight CMS 2', 'http://www.localhost.com/codefight_172_local2/', 1),
(3, 'Codefight CMS 3', 'http://www.localhost.com/codefight_172_local3/', 1),
(4, 'Codefight CMS 4', 'http://www.localhost.com/codefight_172_local4/', 1);
