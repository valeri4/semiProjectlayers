-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2015 at 07:52 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fs_net`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_login`
--

CREATE TABLE IF NOT EXISTS `auto_login` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_u_id` int(11) NOT NULL,
  `a_u_hash` varchar(40) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `auto_login`
--

INSERT INTO `auto_login` (`a_id`, `a_u_id`, `a_u_hash`) VALUES
(10, 65, '4c45e8f0d4462f5d41a864631f54fdf59e3de8c4'),
(11, 66, 'b77a557af6df88af99417bd190d6e7d2d0564d3a'),
(12, 67, '86dcedf3333e1888f1494d9bb50370ffc789df15'),
(13, 68, '581b67ccde59a1373dc3f949887466965fc00d6a'),
(14, 69, '738051ec2a5533967766cdec605d7aef1a2170a5'),
(15, 70, '364326859c9bceb22c1647eb0251eb6da1403692'),
(16, 71, '4444c76e2ebb6c0c86c75f2d1678b25537ef1ae7'),
(17, 72, '31fba6d2698a52802d271e9e8d9b2caad29ddc42'),
(18, 73, 'f42e8f53ce8ada8e3b083ed6fa338f8e4f6dda48'),
(19, 74, '63b53d4bc2a34ae18317e37aa4ecb0b71f894266'),
(20, 75, 'e62c00df1361278a96b5d9c769cf65f6dadb5ca8');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE IF NOT EXISTS `friend_request` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `req_u_id` int(11) NOT NULL,
  `req_friend_id` int(11) NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`req_id`, `req_u_id`, `req_friend_id`) VALUES
(12, 75, 74);

-- --------------------------------------------------------

--
-- Table structure for table `new_friend_temp`
--

CREATE TABLE IF NOT EXISTS `new_friend_temp` (
  `newf_id` int(11) NOT NULL AUTO_INCREMENT,
  `newf_u_id` int(11) NOT NULL,
  `newf_friend_id` int(11) NOT NULL,
  PRIMARY KEY (`newf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `p_id` int(50) NOT NULL AUTO_INCREMENT,
  `u_id` varchar(60) NOT NULL,
  `p_post` text NOT NULL,
  `p_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_postUid` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_uniqid` (`p_postUid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=264 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `u_id`, `p_post`, `p_time`, `p_postUid`) VALUES
(181, '70', 'fgdfgdfgjsdhgkjhfsdgjkdfhgkjlsdhglkjfhglkjshglkjsdhgsld', '2015-10-18 12:41:56', '632656234bafea3622.34625938562393945e5ec'),
(182, '70', 'fgdfgdfgjsdhgkjhfsdgjkdfhgkjlsdhglkjfhglkjshglkjsdhgsld', '2015-10-18 12:41:56', '632656234bafea3622.34625938562393948b89f'),
(183, '70', 'fgdfgdfgjsdhgkjhfsdgjkdfhgkjlgsld', '2015-10-18 12:42:21', '632656234bafea3622.34625938562393ad66448'),
(184, '70', 'dsfsdfsdfsdffffffffffffffff', '2015-10-18 12:47:48', '632656234bafea3622.34625938562394f413280'),
(185, '70', 'dsfsdfsdfsdffffffffffffff32432423424ff', '2015-10-18 12:49:43', '632656234bafea3622.3462593856239567829c3'),
(186, '70', 'dfsdfsdfsdfsdfffff', '2015-10-18 19:40:46', '632656234bafea3622.346259385623f5be35578'),
(187, '70', 'cvxcvcxvxcvxcv', '2015-10-18 19:50:34', '632656234bafea3622.346259385623f80a38ea1'),
(188, '70', 'xzvvcxvxcv', '2015-10-18 19:52:19', '632656234bafea3622.346259385623f873bdfae'),
(189, '70', 'xcvxcvxcvxcvxc', '2015-10-18 19:54:45', '632656234bafea3622.346259385623f90597fa3'),
(190, '70', 'dfgdgdfgdfgdfgdfg', '2015-10-18 19:56:48', '632656234bafea3622.346259385623f9803ea02'),
(191, '70', 'sdgdfgfggggg', '2015-10-18 19:58:01', '632656234bafea3622.346259385623f9c93563f'),
(192, '70', 'zxvcvcxvcxvxcvxcv', '2015-10-18 19:59:04', '632656234bafea3622.346259385623fa0824ef6'),
(193, '70', 'fgfdgdfgdfgdfgdfg', '2015-10-18 20:01:55', '632656234bafea3622.346259385623fab356337'),
(194, '70', 'dfdsfsdfsdf', '2015-10-18 20:02:12', '632656234bafea3622.346259385623fac42a7d9'),
(195, '70', 'bcxvbcvbcvbcvbcvbc', '2015-10-19 12:27:44', '632656234bafea3622.346259385624e1c0aa1e1'),
(210, '70', 'ddsfdsf', '2015-10-19 20:48:45', '632656234bafea3622.346259385625572d18927'),
(211, '70', 'dfdsfsdfsdfsdf', '2015-10-19 21:18:41', '632656234bafea3622.3462593856255e3121737'),
(212, '70', 'fdgdfgdggfdg', '2015-10-19 21:19:56', '632656234bafea3622.3462593856255e7c6716a'),
(213, '70', 'vbcvbcvbvcbcb', '2015-10-19 21:20:28', '632656234bafea3622.3462593856255e9cc1758'),
(214, '70', 'xcvxvxcvxcv', '2015-10-19 21:23:09', '632656234bafea3622.3462593856255f3d6a896'),
(215, '70', 'cvcxvcxvxvx', '2015-10-19 21:23:12', '632656234bafea3622.3462593856255f40823b2'),
(235, '67', 'dhfghgfhfghfg', '2015-10-23 11:52:23', '20902561c39b5bdaa00.46193523562a1f7734feb'),
(236, '67', 'hghjghjg', '2015-10-23 11:52:37', '20902561c39b5bdaa00.46193523562a1f855b380'),
(238, '67', 'dfsdf3dsfdsfsdfsdfsdfsdf', '2015-10-30 14:50:23', '20902561c39b5bdaa00.46193523563383af39701'),
(242, '69', 'xzCZXCzxCXZCzxCZXCZXC', '2015-10-31 09:34:08', '239595622c75f8ec260.1208304456348b100f35d'),
(243, '69', 'DSFSDFSDFSDFSDFSDFSDFSD', '2015-10-31 09:34:12', '239595622c75f8ec260.1208304456348b14136ab'),
(244, '69', 'fgdfgdfgdfg3525435345345', '2015-10-31 09:34:15', '239595622c75f8ec260.1208304456348b17ed3ea'),
(245, '71', 'fsdfsfsdfsdfsdgfdgdfhjjgfjhgkhjkjhgkjghkhjgkgjhkghjkghj', '2015-10-31 16:32:39', '319755634ec827c7135.391820795634ed277e421'),
(246, '71', 'gfhdfghdgfhdgfhdgfhdfghgfdhdfghfgdhdfghgdfh', '2015-10-31 16:32:42', '319755634ec827c7135.391820795634ed2ad8261'),
(247, '71', 'fghdhdhdfghgfdhdfghgdfhdgfhgfd', '2015-10-31 16:32:46', '319755634ec827c7135.391820795634ed2e0291c'),
(248, '71', 'fghgfdhgdfhgfdhgdfhdfgfhdfghdgfgfdhdgfhgfdh', '2015-10-31 16:32:50', '319755634ec827c7135.391820795634ed3291362'),
(249, '67', 'dsfsdfdsfsdfds', '2015-11-01 15:04:38', '20902561c39b5bdaa00.4619352356362a0636eca'),
(250, '72', 'Nullam imperdiet imperdiet nibh, a blandit lorem semper ac. Integer ornare, lorem a sagittis dapibus, ex sem semper ex, eget auctor risus magna nec nunc. Quisque egestas mattis turpis nec venenatis. Donec posuere imperdiet sagittis. Suspendisse vitae dolor quis orci tincidunt cursus. Donec eu eleifend enim. Donec ex mauris, luctus et mauris porttitor, molestie egestas dui. Ut in tempor ex.', '2015-11-07 17:38:51', '12898563e315d7b78f8.09548310563e372b2a74c'),
(252, '72', 'Phasellus lacinia elit vel mauris molestie, ac aliquam elit rhoncus. Cras sollicitudin ligula leo, sit amet tincidunt enim finibus quis. Aliquam at ex ligula. Vivamus a ipsum non velit dapibus ultrices. Nulla facilisi. Nunc elit felis, egestas a pellentesque sagittis, fermentum vitae velit. Aliquam vitae sagittis felis, eget fringilla tortor. Duis accumsan ante eget placerat rhoncus. Duis nisi nulla, pretium vel ornare vitae, ornare porta mauris. Aliquam pretium dictum placerat. Sed diam diam, viverra egestas dolor a, venenatis aliquam nunc.', '2015-11-07 17:39:09', '12898563e315d7b78f8.09548310563e373d12a5b'),
(253, '72', 'Proin bibendum placerat turpis id pretium. Proin leo velit, maximus eget aliquam ac, imperdiet a risus. Praesent magna ante, porta sed lorem nec, sodales mollis lorem. Aenean eget tristique mi. Nulla euismod vitae arcu fermentum scelerisque. Sed sit amet sem sit amet magna faucibus venenatis quis eget odio. Nullam at efficitur ipsum. Nulla at velit risus. Aliquam finibus nibh at augue scelerisque blandit. Praesent in eleifend massa. Maecenas imperdiet fermentum mi, quis accumsan nisi rhoncus a. Sed eleifend eget diam sed fringilla.', '2015-11-07 17:39:18', '12898563e315d7b78f8.09548310563e37462b71a'),
(254, '73', 'Pellentesque auctor ex diam, pulvinar elementum ex pretium id. Maecenas eu dui ut diam blandit ornare eu ac diam. Proin nisi odio, sodales et tempor ac, porttitor id eros. Fusce congue eget nulla vel placerat. Phasellus non congue elit. Fusce eget ante non sem viverra euismod in eget arcu. Donec lorem ante, feugiat a cursus at, interdum eget ligula.', '2015-11-07 17:43:51', '23245563e37d7b63843.92686622563e3857b4722'),
(255, '73', 'Vivamus fermentum tellus et erat fermentum varius. Duis rutrum aliquet massa in tristique. Vivamus id metus quis enim cursus sagittis. Curabitur rutrum fermentum imperdiet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent bibendum semper sodales. Cras id ultricies mauris. Nam porta molestie viverra. Proin sollicitudin nisl eu vestibulum sodales. Sed et massa sed augue porta rhoncus id et odio. Ut velit nibh, dignissim dapibus dolor a, placerat convallis lacus. Suspendisse potenti.', '2015-11-07 17:44:01', '23245563e37d7b63843.92686622563e3861b0ec5'),
(256, '73', 'Quisque et tristique nunc. Nunc vehicula nisl quis quam elementum, sit amet rutrum risus accumsan. Mauris sit amet accumsan ipsum. Vivamus gravida aliquet mauris, eget fermentum sem efficitur sit amet. Nunc eget est sem. Sed in sapien semper, blandit sapien vel, viverra elit. Integer mi ex, euismod ac ullamcorper ac, laoreet quis massa. Praesent fermentum aliquet arcu blandit convallis. Morbi ultrices dui in tortor pharetra, quis porttitor dolor vulputate. Donec mollis ligula a lacus tempor feugiat. Donec fermentum sem sit amet magna volutpat, vitae interdum sapien mattis. Nulla varius finibus felis quis hendrerit. Duis gravida purus luctus pretium dictum.', '2015-11-07 17:44:10', '23245563e37d7b63843.92686622563e386a0d38a'),
(257, '74', 'Quisque vehicula rhoncus purus id porttitor. Curabitur finibus, ante sit amet euismod luctus, nulla neque pretium enim, sed egestas lorem lacus sed mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae efficitur ligula. Nam in odio sagittis, mattis turpis ut, auctor massa. Maecenas porttitor ultricies justo vel ultricies. Nulla tincidunt eu orci vitae facilisis. Etiam eu lorem dui. Cras in rutrum elit.', '2015-11-07 17:48:53', '630563e38b90411e0.37764003563e3985c9058'),
(258, '74', 'Quisque vehicula rhoncus purus id porttitor. Curabitur finibus, ante sit amet euismod luctus, nulla neque pretium enim, sed egestas lorem lacus sed mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae efficitur ligula. Nam in odio sagittis, mattis turpis ut, auctor massa. Maecenas porttitor ultricies justo vel ultricies. Nulla tincidunt eu orci vitae facilisis. Etiam eu lorem dui. Cras in rutrum elit.', '2015-11-07 17:48:55', '630563e38b90411e0.37764003563e3987c2369'),
(259, '74', 'Quisque vehicula rhoncus purus id porttitor. Curabitur finibus, ante sit amet euismod luctus, nulla neque pretium enim, sed egestas lorem lacus sed mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae efficitur ligula. Nam in odio sagittis, mattis turpis ut, auctor massa. Maecenas porttitor ultricies justo vel ultricies. Nulla tincidunt eu orci vitae facilisis. Etiam eu lorem dui. Cras in rutrum elit.', '2015-11-07 17:48:57', '630563e38b90411e0.37764003563e39895691a'),
(260, '74', 'Quisque vehicula rhoncus purus id porttitor. Curabitur finibus, ante sit amet euismod luctus, nulla neque pretium enim, sed egestas lorem lacus sed mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae efficitur ligula. Nam in odio sagittis, mattis turpis ut, auctor massa. Maecenas porttitor ultricies justo vel ultricies. Nulla tincidunt eu orci vitae facilisis. Etiam eu lorem dui. Cras in rutrum elit.', '2015-11-07 17:48:59', '630563e38b90411e0.37764003563e398b26411'),
(261, '75', 'Praesent feugiat imperdiet auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tortor nibh, ullamcorper at velit ac, tincidunt viverra mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas non est sem. Cras egestas sed odio at ornare. Suspendisse pulvinar lorem velit, sit amet lobortis lacus pellentesque ut. Pellentesque sed mi imperdiet, aliquet tellus ac, rutrum neque. In tincidunt iaculis dolor non convallis. Praesent venenatis ex ac consectetur ornare. Praesent a dolor at quam rutrum vestibulum non eget arcu. Aliquam aliquam leo quis dolor finibus, id aliquam orci tincidunt. Morbi in commodo mi. Morbi tincidunt ipsum a nisi aliquet accumsan. Nulla eget mauris id ligula lobortis ullamcorper eget ut enim.', '2015-11-07 17:58:25', '20408563e3b7a51ca45.32924190563e3bc15ccac'),
(262, '75', 'Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed viverra dictum tortor, quis semper ex commodo eu. Etiam ligula erat, suscipit a dui id, dapibus semper mauris. Sed accumsan dictum augue et sagittis. Aliquam mattis vulputate neque, ut ullamcorper nulla pharetra nec. Aliquam tempus porttitor pharetra. Integer euismod varius lobortis. Donec molestie enim ligula, a finibus dolor tincidunt ut. Aenean hendrerit risus eget quam ultrices, sit amet rhoncus justo euismod.', '2015-11-07 17:58:30', '20408563e3b7a51ca45.32924190563e3bc69b1f0'),
(263, '75', 'In sit amet elit justo. Quisque est magna, volutpat a molestie vitae, tincidunt iaculis risus. Integer sed arcu mollis, sagittis nulla id, venenatis tortor. Aliquam erat volutpat. Suspendisse potenti. Vivamus tempor turpis sit amet sem scelerisque, sollicitudin hendrerit mi placerat. Donec efficitur eros eget neque tincidunt, nec feugiat tellus aliquet. Proin ac nunc eget felis imperdiet pretium. Maecenas euismod ornare odio et suscipit. Nulla facilisi. Sed molestie risus augue.', '2015-11-07 17:58:36', '20408563e3b7a51ca45.32924190563e3bccd976e');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`f_id`, `u_id`, `friend_id`) VALUES
(11, 69, 67),
(12, 67, 69),
(13, 71, 67),
(14, 67, 71),
(15, 71, 72),
(16, 72, 71),
(17, 72, 67),
(18, 67, 72),
(19, 72, 74),
(20, 74, 72),
(21, 73, 74),
(22, 74, 73);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_uID` varchar(60) DEFAULT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pwd` varchar(60) NOT NULL,
  `u_f_name` varchar(50) NOT NULL,
  `u_l_name` varchar(50) NOT NULL,
  `u_b_day` date NOT NULL,
  `u_gender` tinyint(4) NOT NULL,
  `u_about` text NOT NULL,
  `u_userName` varchar(50) NOT NULL,
  `u_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_image` varchar(10) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email` (`u_email`),
  UNIQUE KEY `uuId` (`u_uID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_uID`, `u_email`, `u_pwd`, `u_f_name`, `u_l_name`, `u_b_day`, `u_gender`, `u_about`, `u_userName`, `u_reg_date`, `u_image`) VALUES
(67, '20902561c39b5bdaa00.46193523', 'valeri4@gmail.com', '$2a$08$lEt.qoDqm3YSMPuJz2EFvefZJwVLWIR4OEeCgNrTSoIAWy2H.G1JG', 'Valera', 'Dubina', '1989-04-20', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id magna a orci iaculis cursus at et mauris. Ut gravida, turpis in luctus mollis, turpis mi eleifend risus, sit amet porttitor mauris eros id velit. Nullam rhoncus est id diam dignissim, vel tincidunt metus suscipit. Fusce eget lorem tortor. Aliquam ut augue tristique, mollis nulla id, molestie arcu. Donec ultrices eros eu elit elementum, ac accumsan purus feugiat. Maecenas fermentum consectetur lorem, vitae elementum justo pretium et. Praesent condimentum, lacus a eleifend mattis, tellus neque accumsan purus, vel pulvinar metus purus et nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer eget auctor velit. Etiam laoreet libero a diam facilisis, nec auctor metus vive', 'loki', '2015-10-12 22:52:37', 'user_uuid'),
(68, '24951561e5c8b2dc9c3.28377450', 'test@test.com', '$2y$10$Kt2Asdtw.UgVQ2dANEoXP.fQyn6OfEEzOPisYUA1DjH3OpJm7bbNO', 'Test', 'Test Test', '1999-10-07', 1, 'zczxczxczcbfhgdhgfhdghj', 'new_user', '2015-10-14 13:45:47', 'def_img'),
(69, '239595622c75f8ec260.12083044', 'new@new.com', '$2y$10$4B4InVAwUqwsTMeF0XLTi.Qrkohy8WnMkWv7WMpSiwvbCg8qNWtFu', 'new_new', 'new_test', '1999-10-05', 1, 'cvxvxcvxcvxcvxcvxcvxcvxcvxcvcvxcvxcvxcvxcvxcvxcvxcvxc', 'new', '2015-10-17 22:10:39', 'def_img'),
(70, '632656234bafea3622.34625938', 'tet@tet.com', '$2y$10$CsZuIhDY88Ys9Du9wZwNOOaqUpHoKeX5bFISMHPhlJEcbMPmUcGz2', 'TEEEEEE', 'dvxcvxcvxcvxcvxc', '1999-10-12', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In accumsan eros id dui sagittis consequat. Suspendisse tempor condimentum odio in condimentum. Ut porttitor sem congue purus mattis bibendum. Vivamus lorem justo, vestibulum et nunc ac, sagittis vestibulum orci. Integer elementum est id orci sodales, eu interdum lacus tincidunt. Nullam gravida odio neque, tincidunt aliquam lacus euismod ut. Nulla ac suscipit urna.', 'tet', '2015-10-18 07:35:12', 'user_uuid'),
(71, '319755634ec827c7135.39182079', 'duro@duro.com', '$2y$10$It2um4spnpcZImK9heQ6B.cHW7Jph3GMVWl.gB7aJOX5cghZSav/6', 'Quintilian', 'Duro', '1999-06-07', 1, 'Sed dignissim suscipit elit, vitae tempus elit fermentum quis. In elementum arcu quis ante efficitur, in porta ipsum imperdiet. Praesent posuere vel nunc eu maximus. Nunc enim orci, sollicitudin sit amet turpis eget, scelerisque blandit ante. Sed purus sapien, pretium non aliquet et, vulputate vitae lacus. Nulla facilisi. Praesent dignissim, elit in consequat viverra, nisl sem condimentum magna, eget consectetur ex nunc id dui. Curabitur sodales cursus lorem, suscipit mollis mauris aliquet at.', 'Artz', '2015-10-31 16:29:54', 'def_img'),
(72, '12898563e315d7b78f8.09548310', 'Robert@Hawk.com', '$2y$10$.7apKmDkzTIUONzouW7QY.VBNAkTE4FSwDIkABrUDOdNGJJ9M/Rzu', 'Robert ', 'Hawk', '1985-04-11', 1, 'Phasellus lacinia elit vel mauris molestie, ac aliquam elit rhoncus. Cras sollicitudin ligula leo, sit amet tincidunt enim finibus quis. Aliquam at ex ligula. Vivamus a ipsum non velit dapibus ultrices. Nulla facilisi. Nunc elit felis, egestas a pellentesque sagittis, fermentum vitae velit. Aliquam vitae sagittis felis, eget fringilla tortor. Duis accumsan ante eget placerat rhoncus. Duis nisi nulla, pretium vel ornare vitae, ornare porta mauris. Aliquam pretium dictum placerat. Sed diam diam, viverra egestas dolor a, venenatis aliquam nunc.', 'Knother', '2015-11-07 17:14:05', 'user_uuid'),
(73, '23245563e37d7b63843.92686622', 'patty@corwin.com', '$2a$10$p.6.PWdIi/9LOdj/31uR1Oj1yv1d9c19gsiP10Hnm/EWrlAxnKkTW', 'Patty ', 'Corwin', '1974-05-15', 0, 'Proin bibendum placerat turpis id pretium. Proin leo velit, maximus eget aliquam ac, imperdiet a risus. Praesent magna ante, porta sed lorem nec, sodales mollis lorem. Aenean eget tristique mi. Nulla euismod vitae arcu fermentum scelerisque. Sed sit amet sem sit amet magna faucibus venenatis quis eget odio. Nullam at efficitur ipsum. Nulla at velit risus. Aliquam finibus nibh at augue scelerisque blandit. Praesent in eleifend massa. Maecenas imperdiet fermentum mi, quis accumsan nisi rhoncus a. Sed eleifend eget diam sed fringilla.', 'Theirsen', '2015-11-07 17:41:43', 'user_uuid'),
(74, '630563e38b90411e0.37764003', 'demo@user.com', '$2y$10$OCzcG5PxEYtAsehF5VAxI.XYUjqChH8U4OSNLdK8cLSyldZBIaZCi', 'Demo ', 'User', '1984-12-26', 1, 'Nam a placerat sapien. Vivamus accumsan erat commodo, ultrices diam sit amet, condimentum urna. Integer magna orci, tempus ut faucibus vel, faucibus pellentesque ex. Nullam in semper quam. Donec aliquam, turpis sit amet pellentesque condimentum, erat lorem pulvinar ex, ut porta quam orci et mi. Phasellus consectetur, est vitae aliquam mattis, ligula nunc tristique leo, maximus maximus mi ex ac purus. Vestibulum facilisis elit nunc, at malesuada nulla molestie at. Ut elementum tincidunt orci, condimentum auctor metus porttitor ac. Nullam viverra lacus nibh. Nunc sed venenatis urna, nec molestie mauris.', 'Demo_test', '2015-11-07 17:45:29', 'user_uuid'),
(75, '20408563e3b7a51ca45.32924190', 'john@glover.com', '$2y$10$pJhLOw21FRKLupfw1jgveuwWdlIYoKyEHo9rxqlvOF0sQd5dTX7yq', 'John ', 'Glover', '1965-06-10', 1, 'Nullam lacinia maximus congue. Nullam maximus magna et neque imperdiet imperdiet. Aenean luctus metus id est pharetra consequat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent quis justo bibendum, egestas magna ut, semper turpis. Ut lorem augue, pharetra nec sollicitudin sit amet, ullamcorper a magna. Morbi mauris risus, tristique a sodales sit amet, vehicula vitae lorem.', 'Prept1980', '2015-11-07 17:57:14', 'user_uuid');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
