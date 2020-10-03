-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 11:01 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamescope`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `codes_id` int(10) UNSIGNED NOT NULL,
  `codes_title` varchar(30) NOT NULL,
  `codes_desc` text NOT NULL,
  `codes_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `codes_carpic` text NOT NULL,
  `codes_boxpic` text NOT NULL,
  `codes_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`codes_id`, `codes_title`, `codes_desc`, `codes_date`, `codes_carpic`, `codes_boxpic`, `codes_active`, `user_id`) VALUES
(1, 'Bridge Constructor Portal', '100% Achievement Guide:\r\nNote: You must complete the game to get all these achievements.\r\n\r\nExtended Testing Opportunity - Finish every test chamber in Chapter #1.\r\nFood and Artificial Sunlight - Finish every test chamber in Chapter #2.\r\nPost-Insignificance - Finish every test chamber in Chapter #3.\r\nOfficial Pre-Admittance - Finish every test chamber in Chapter #4.\r\nFull Chief Custodian candidate - Finish every test chamber in Chapter #5.\r\nSpectacularly Lonely - Finish every test chamber in Chapter #6.\r\n\r\nConvoy Achievements:\r\n66% Loss - 20 Convoys delivered.\r\n66% Delivery - 40 Convoys delivered.\r\n0% Non-Delivery - 60 Convoys delivered.\r\n\r\nPortal Achievements\r\nFor Science! - 1,000 Portal Transitions.\r\nFor More Science! - 5,000 Portal Transitions.\r\n\r\nMisc. Achievements:\r\nCentrifugal Convoy Adjustment System - Passed through the same portal 15 times.\r\nEntry-Exit Relay Repeater System - 30 times back and forth through the same portal.\r\nAerial Mobility Support System - Bounced 25 times on the repulsion gel\r\nwith the same vehicle.\r\nNo Hard Feelings - First turret decomissioned.\r\nYou monster - 100 Test Vehicles destroyed.', '2017-12-30 19:59:54', 'tables_attrs/codes/codes_id_1/images/Bridge-Constructor-Portal banner.jpg', 'tables_attrs/codes/codes_id_1/images/Portalbox.png', 1, 2),
(3, 'FIFA 18 codes', 'Star Skill Moves:\r\nBall Juggle (while standing) – Hold LT + tap RB/Hold L2 + tap R1\r\nFoot Fake (while standing) – Hold LB + RB/Hold R1 + L1\r\n\r\nStar Skill Moves:\r\nBody Feint Right – RS flick ?\r\nBody Feint Left – RS flick ?\r\nStepover Right – RS ???\r\nStepover Left – RS ???\r\nReverse Stepover Right – RS ???\r\nReverse Stepover Left – RS ???\r\nBall Roll left – RS Hold ?\r\nBall Roll Right – RS Hold ?\r\nDrag Back (while standing) – RB + LS flick ?/R1 + LS flick ?\r\n\r\nStar Skill Moves:\r\nHeel Flick – RS flick ??\r\nFlick Up – RS flick ???\r\nRoulette Right – RS rotate from down 270 degrees clockwise\r\nRoulette Left – RS rotate from down 270 degree anti-clockwise\r\nFake Left & Go Right – RS ?????\r\nFake Right & Go Left – RS ?????', '2017-12-30 19:59:54', 'tables_attrs/codes/codes_id_3/images/fifa18banner.jpg', 'tables_attrs/codes/codes_id_3/images/fifa18b.jpg', 1, 2),
(5, 'Batman Arkham Knight', 'Splash the like button for more Batman Arkham Knight!', '2017-12-30 22:29:52', 'tables_attrs/codes/codes_id_5/images/batmanbanner.jpg', 'tables_attrs/codes/codes_id_5/images/batmanbox.jpg', 1, 3),
(6, 'WWE 2K BATTLEGROUNDS', 'Steam achievements: Successfully complete the indicated task to unlock the corresponding achievement. To view your achievements and stats in Steam, select \"Community\", \"My profile\", \"View all my games\", then the game and view stats.', '2020-10-02 20:37:01', 'tables_attrs/codes/codes_id_6/images/WWE 2K BATTLEGROUNDS banner.jpg', 'tables_attrs/codes/codes_id_6/images/WWE 2K BATTLEGROUNDS2.jpg', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `comment_text` text NOT NULL,
  `comment_pdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `comment_pdate`, `user_id`) VALUES
(1, 'OMG GREAT NEWSSSSS OMFG', '2017-12-30 22:30:39', 3),
(2, 'thx', '2017-12-30 22:30:55', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments_codes`
--

CREATE TABLE `comments_codes` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `codes_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments_mods`
--

CREATE TABLE `comments_mods` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `mods_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments_news`
--

CREATE TABLE `comments_news` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `news_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments_news`
--

INSERT INTO `comments_news` (`comment_id`, `news_id`) VALUES
(1, 7),
(2, 7),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `comments_trainers`
--

CREATE TABLE `comments_trainers` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `trainers_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments_walkthroughs`
--

CREATE TABLE `comments_walkthroughs` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `walkthroughs_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mods`
--

CREATE TABLE `mods` (
  `mods_id` int(11) UNSIGNED NOT NULL,
  `mods_title` varchar(30) NOT NULL,
  `mods_desc` text NOT NULL,
  `mods_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mods_carpic` text NOT NULL,
  `mods_boxpic` text NOT NULL,
  `mods_download` text NOT NULL,
  `mods_active` tinyint(1) UNSIGNED DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mods`
--

INSERT INTO `mods` (`mods_id`, `mods_title`, `mods_desc`, `mods_date`, `mods_carpic`, `mods_boxpic`, `mods_download`, `mods_active`, `user_id`) VALUES
(2, 'Battlefield 1 mod 3.0', 'Battlefield Remastered 3.0 has finally has gone gold after a 2 years development. Download and play it now on multiplayer or epic single player battles!', '2017-12-30 19:58:48', 'tables_attrs/mods/mods_id_2/images/bf banner.jpg', 'tables_attrs/mods/mods_id_2/images/bf3box.jpg', 'tables_attrs/mods/mods_id_2/download/hw3.docx', 1, 2),
(3, 'BRONZE AGE: TOTAL WAR', 'Trace the history of the great civilizations of the Bronze Age period of greatest prosperity to the time of the disastrous invasions of barbarian tribes destroyed them. The player will be given the opportunity to change the course of world history to lead one of 17 playing nations. Flip the invasion of barbarian tribes examples of the role of the Egyptian Pharaoh, Hittite Tabarna, Mycenaean Vanakt and others. Or on the contrary lead the crowd from a desperate tramps are ready to challenge the powers that be, win fame and fortune in the war and set a new world order.', '2017-12-30 19:58:48', 'tables_attrs/mods/mods_id_3/images/bacar.png', 'tables_attrs/mods/mods_id_3/images/babox.jpeg', 'tables_attrs/mods/mods_id_3/download/hw3.docx', 1, 2),
(5, 'Call of Duty Black Ops 3 Mod', 'Returning to Call of Duty Black Ops III Zombies with christmas themed mod by MJPW. New skins in Shadows of Evil, Der Eisendrache, Origins, Zetsubou No Shima and more. Livestream highlights.', '2017-12-30 22:24:52', 'tables_attrs/mods/mods_id_5/images/blackops3banner.png', 'tables_attrs/mods/mods_id_5/images/blackops3box.png', 'tables_attrs/mods/mods_id_5/download/hw3.docx', 1, 3),
(6, 'The American Civil War: Revive', 'The American Civil War Mod: Revived is a single player mod for Mount and Blade: Warband that is built upon an old civil war mod that ceased development, that was called, \"A House Divided\".', '2020-10-02 20:30:21', 'tables_attrs/mods/mods_id_6/images/The American Civil War banner.jpg', 'tables_attrs/mods/mods_id_6/images/The American Civil War1.jpg', 'tables_attrs/mods/mods_id_6/download/The American Civil War1.jpg', 1, 4),
(7, 'WWE 2K BATTLEGROUNDS', 'Steam achievements:\r\nSuccessfully complete the indicated task to unlock the corresponding achievement. To view your achievements and stats in Steam, select \"Community\", \"My profile\", \"View all my games\", then the game and view stats.', '2020-10-02 20:35:23', 'tables_attrs/mods/mods_id_7/images/WWE 2K BATTLEGROUNDS banner.jpg', 'tables_attrs/mods/mods_id_7/images/wwe2kb.jpg', 'tables_attrs/mods/mods_id_7/download/wwe2kb.jpg', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) UNSIGNED NOT NULL,
  `news_title` varchar(30) NOT NULL,
  `news_desc` text NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `news_carpic` text NOT NULL,
  `news_boxpic` text NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_desc`, `news_date`, `news_carpic`, `news_boxpic`, `user_id`) VALUES
(2, 'DooM 4', 'Doom (stylized as DOOM and originally known as Doom 4) is an upcoming first-person shooter video game developed by id Software and published by Bethesda Softworks. The game will be a reboot of the Doom series and is the first major installment in the series since the release of Doom 3 in 2004. Doom is set to be released on Microsoft Windows, PlayStation 4, and Xbox One.\r\n\r\nDoom will feature a large arsenal of weapons, which can be collected and freely switched by players throughout the game. Many classic weapons, including the super shotgun and BFG 9000, will make a return. In addition, melee weapons such as the chainsaw, which can cut enemies in half, are also featured. Many enemies from the original games like the Revenant, Mancubus, and Cyberdemon return as well, some of them redesigned. As the combat system of the game puts emphasis on momentum and speed, the game allows players to perform movements like sprinting and double-jumping. A combat system known as \"push forward combat\" is featured, which discourages players from taking cover behind obstacles or resting to regain health also known as a health-regeneration system. Players instead collect health and armour pick-ups scattered throughout levels, or kill enemies to regain health. A new mechanic introduced in Doom is the melee execution system. It allows players to perform a melee-takedown similar to that of brutal doom when players deal enough damage to enemies. Enemies available for melee-takedown will be highlighted.', '2017-12-30 19:57:57', 'tables_attrs/news/news_id_2/images/doom4.jpg', 'tables_attrs/news/news_id_2/images/doom4_1.jpg', 2),
(4, 'Assassins Creed Origins', 'Assassins Creed Origins is an action-adventure video game developed by Ubisoft Montreal and published by Ubisoft. It will be the tenth major installment in the Assassins Creed series and the successor to 2015s Assassins Creed Syndicate. It is scheduled to be released worldwide for Microsoft Windows, PlayStation 4, and Xbox One X.\r\n\r\nThe game is set in Ancient Egypt during the Ptolemaic period and recounts the secret fictional history of real-world events. The story explores the origins of the centuries-long conflict between the Brotherhood of Assassins, who fight for peace by promoting liberty and The Order of the Ancients—forerunners to the Templar Order—who desire peace through the forceful imposition of order.', '2017-12-30 19:57:57', 'tables_attrs/news/news_id_4/images/AssassinsCreed-Banner.jpg', 'tables_attrs/news/news_id_4/images/Assassins-Creed-Origins.jpg', 2),
(6, 'Nintendo Switch shipments', 'The Nintendo Switch is on track to be more successful than its predecessor console, the Wii U, by leaps and bounds. In September 2017 Nintendo had shipped out 7.6 million units of the system and by March 2018 those numbers may have reached as high as 14 million. This is a re-estimation based on improved data from an earlier one which saw Nintendo expect to ship only 10 million of the portable and home console.', '2017-12-30 22:01:30', 'tables_attrs/news/news_id_6/images/nintendo-banner.jpg', 'tables_attrs/news/news_id_6/images/nintendobox.jpg', 2),
(7, 'Star Wars Battlefront 2', 'The single-player story mode campaign in Star Wars Battlefront II takes place in the Star Wars galaxy, beginning around the time of Return of the Jedi, but largely between it and Star Wars: The Force Awakens. Emperor Palpatine plots to lure an unsuspecting Rebel Alliance fleet into a trap using himself and the second Death Star, being constructed above the Forest Moon of Endor, as bait, seeking to crush the Rebellion against his Galactic Empire once and for all. The Imperial Special Forces commando unit Inferno Squad, led by Commander Iden Versio, daughter of Admiral Garrick Versio, and made up of Agents Gideon Hask and Del Meeko, is crucial to the success of this planned Battle of Endor, but the Empire underestimates the strength of the Rebellion as its fleet gathers at Sullust.', '2017-12-30 22:17:18', 'tables_attrs/news/news_id_7/images/starwarsbanner.jpg', 'tables_attrs/news/news_id_7/images/starwarsbox.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `pictures_id` int(11) UNSIGNED NOT NULL,
  `pictures_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`pictures_id`, `pictures_link`) VALUES
(1, 'tables_attrs/mods/mods_id_1/images/gtav redux_0.jpg'),
(2, 'tables_attrs/mods/mods_id_1/images/gtav.jpg'),
(3, 'tables_attrs/mods/mods_id_1/images/gtav redux_0.jpg'),
(4, 'tables_attrs/mods/mods_id_1/images/gtav.jpg'),
(5, 'tables_attrs/mods/mods_id_2/images/Bf3image.jpg'),
(6, 'tables_attrs/mods/mods_id_5/images/'),
(7, 'tables_attrs/mods/mods_id_6/images/The American Civil War2.jpg'),
(8, 'tables_attrs/mods/mods_id_7/images/WWE 2K BATTLEGROUNDS2.jpg'),
(9, 'tables_attrs/walkthroughs/walkthroughs_id_5/images/Mafia Definitive Edition2.jpg'),
(10, 'tables_attrs/trainers/trainers_id_5/images/STATE OF DECAY 22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pictures_mods`
--

CREATE TABLE `pictures_mods` (
  `pictures_id` int(11) UNSIGNED NOT NULL,
  `mods_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures_mods`
--

INSERT INTO `pictures_mods` (`pictures_id`, `mods_id`) VALUES
(3, 1),
(4, 1),
(5, 2),
(6, 5),
(7, 6),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pictures_trainers`
--

CREATE TABLE `pictures_trainers` (
  `pictures_id` int(11) UNSIGNED NOT NULL,
  `trainers_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures_trainers`
--

INSERT INTO `pictures_trainers` (`pictures_id`, `trainers_id`) VALUES
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pictures_walkthroughs`
--

CREATE TABLE `pictures_walkthroughs` (
  `pictures_id` int(11) UNSIGNED NOT NULL,
  `walkthroughs_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures_walkthroughs`
--

INSERT INTO `pictures_walkthroughs` (`pictures_id`, `walkthroughs_id`) VALUES
(9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainers_id` int(11) UNSIGNED NOT NULL,
  `trainers_title` varchar(30) NOT NULL,
  `trainers_desc` text NOT NULL,
  `trainers_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `trainers_carpic` text NOT NULL,
  `trainers_boxpic` text NOT NULL,
  `trainers_download` text NOT NULL,
  `trainers_active` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainers_id`, `trainers_title`, `trainers_desc`, `trainers_date`, `trainers_carpic`, `trainers_boxpic`, `trainers_download`, `trainers_active`, `user_id`) VALUES
(1, 'Tom Clancys Rainbow Six: Siege', 'Tom Clancys Rainbow Six Siege is a tactical shooter video game developed by Ubisoft Montreal and published by Ubisoft. It was released worldwide on December 1, 2015, for Microsoft Windows, PlayStation 4 and Xbox One. The game puts heavy emphasis on environmental destruction and cooperation between players. Players assume control of an attacker or a defender in different gameplay modes such as hostage rescuing and bomb defusing. The title has no campaign, but features a series of short missions that can be played solo. These missions have a loose narrative, focusing on recruits going through training to prepare them for future encounters with the White Masks, a terrorist group that threatens the safety of the world.', '2017-12-30 19:59:25', 'tables_attrs/trainers/trainers_id_1/images/rainbow-banner.jpg', 'tables_attrs/trainers/trainers_id_1/images/r6box.jpg', 'tables_attrs/trainers/trainers_id_1/download/hw3.docx', 1, 2),
(2, 'LEGO Marvel Super Heroes 2', 'Inside Gwenpools room which is located on the second floor of Avengers Mansion you will be able to enter the following codes on the computer to unlock the corresponding character. This feature becomes unlocked as part of the tutorial in the Avengers Mansion when you have completed the first mission.', '2017-12-30 19:59:25', 'tables_attrs/trainers/trainers_id_2/images/legobanner.jpg', 'tables_attrs/trainers/trainers_id_2/images/LEGObox.jpg', 'tables_attrs/trainers/trainers_id_2/download/hw3.docx', 1, 2),
(5, 'STATE OF DECAY 2: JUGGERNAUT E', 'State of Decay 2: Juggernaut Edition (+1 Trainer) [Cheat Happens]\r\n\r\nUnlock more options including updates for this State of Decay 2: Juggernaut Edition Trainer', '2020-10-02 20:51:14', 'tables_attrs/trainers/trainers_id_5/images/STATE OF DECAY 2 banner .jpg', 'tables_attrs/trainers/trainers_id_5/images/STATE OF DECAY 21.jpg', 'tables_attrs/trainers/trainers_id_5/download/State of Decay 2 Juggernaut Edition Trainer', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL,
  `user_username` varchar(15) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_lname` varchar(25) NOT NULL,
  `user_avatar` text NOT NULL,
  `user_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_username`, `user_fname`, `user_lname`, `user_avatar`, `user_admin`) VALUES
(2, 'aviadkatav@gmail.com', '$2y$10$5G2VJrKCok0rBXgw3qDPhuJH1MGCEeSeU54h57inrXT3yVYZ7w5FO', 'aviad', 'aviad', 'kattav', 'images/users/user_id_2/aviad.jpg', 1),
(3, 'evilair1@hotmail.com', '$2y$10$.u0Lxbb1yv7lSZVp68TioeO5mje91rmzrBl4rLu2Sd37O.WehZl5u', 'user1', 'user', 'user', 'images/unavailable_avatar.png', 0),
(4, 'shahar.al2013@gmail.com', '$2y$10$MQXONSBw/Z1GELwEoR5ZQeETTKEEiPX6hU5qVIPrc8x2bbNRguhGq', 'shahar', 'Shahar', 'al', 'images/unavailable_avatar.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `videos_id` int(11) UNSIGNED NOT NULL,
  `videos_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`videos_id`, `videos_link`) VALUES
(1, 'https://www.youtube.com/embed/GVuxscKWDPs'),
(2, 'https://www.youtube.com/embed/AmP_wdxn7Qw'),
(3, 'https://www.youtube.com/embed/T7l0Mz8U7a0'),
(4, 'https://www.youtube.com/embed/3w-3qINOSMY'),
(5, 'https://www.youtube.com/embed/TOxuNbXrO28'),
(6, 'https://www.youtube.com/embed/vMXq-4UDZ4c'),
(7, 'https://www.youtube.com/embed/eKGqtZc-xsQ'),
(8, 'https://www.youtube.com/embed/LTSp30K2d5o'),
(9, 'https://www.youtube.com/embed/Nt_cPLr0Ic8'),
(10, 'https://www.youtube.com/embed/ovCzo_jmyZY'),
(11, ' https://www.youtube.com/embed/edvnX8TwSTI'),
(12, ' https://www.youtube.com/embed/tLIWNJU0hGA'),
(13, 'https://www.youtube.com/embed/1DJKsUO9elI'),
(14, 'https://www.youtube.com/embed/XELztMsPLlI'),
(15, 'https://www.youtube.com/embed/vMXq-4UDZ4c'),
(16, ' https://www.youtube.com/embed/tLIWNJU0hGA'),
(17, ' https://www.youtube.com/embed/edvnX8TwSTI'),
(18, 'https://www.youtube.com/embed/acXXyruMtaY'),
(19, 'https://www.youtube.com/embed/fLPpOFIAxos'),
(20, 'https://www.youtube.com/embed/VwwKxCGiDKg'),
(21, 'https://www.youtube.com/watch?v=wXqghv3iUk4&t'),
(22, 'https://www.youtube.com/watch?v=cP07f4091mM'),
(23, 'https://www.youtube.com/watch?v=cP07f4091mM'),
(24, 'https://www.youtube.com/watch?v=MJ8uxK4722A'),
(25, 'https://www.youtube.com/watch?v=jA_3-QcKxEw');

-- --------------------------------------------------------

--
-- Table structure for table `videos_codes`
--

CREATE TABLE `videos_codes` (
  `videos_id` int(11) UNSIGNED NOT NULL,
  `codes_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos_codes`
--

INSERT INTO `videos_codes` (`videos_id`, `codes_id`) VALUES
(10, 2),
(11, 4),
(20, 5),
(23, 6);

-- --------------------------------------------------------

--
-- Table structure for table `videos_mods`
--

CREATE TABLE `videos_mods` (
  `videos_id` int(11) UNSIGNED NOT NULL,
  `mods_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos_mods`
--

INSERT INTO `videos_mods` (`videos_id`, `mods_id`) VALUES
(6, 1),
(7, 2),
(8, 3),
(9, 4),
(19, 5),
(21, 6),
(22, 7);

-- --------------------------------------------------------

--
-- Table structure for table `videos_news`
--

CREATE TABLE `videos_news` (
  `videos_id` int(11) UNSIGNED NOT NULL,
  `news_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos_news`
--

INSERT INTO `videos_news` (`videos_id`, `news_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `videos_trainers`
--

CREATE TABLE `videos_trainers` (
  `videos_id` int(11) UNSIGNED NOT NULL,
  `trainers_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos_trainers`
--

INSERT INTO `videos_trainers` (`videos_id`, `trainers_id`) VALUES
(12, 1),
(13, 2),
(14, 4),
(25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `videos_walkthroughs`
--

CREATE TABLE `videos_walkthroughs` (
  `videos_id` int(11) UNSIGNED NOT NULL,
  `walkthroughs_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos_walkthroughs`
--

INSERT INTO `videos_walkthroughs` (`videos_id`, `walkthroughs_id`) VALUES
(15, 1),
(16, 2),
(17, 3),
(18, 4),
(24, 5);

-- --------------------------------------------------------

--
-- Table structure for table `walkthroughs`
--

CREATE TABLE `walkthroughs` (
  `walkthroughs_id` int(11) UNSIGNED NOT NULL,
  `walkthroughs_title` varchar(30) NOT NULL,
  `walkthroughs_desc` text NOT NULL,
  `walkthroughs_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `walkthroughs_carpic` text NOT NULL,
  `walkthroughs_boxpic` text NOT NULL,
  `walkthroughs_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `walkthroughs`
--

INSERT INTO `walkthroughs` (`walkthroughs_id`, `walkthroughs_title`, `walkthroughs_desc`, `walkthroughs_date`, `walkthroughs_carpic`, `walkthroughs_boxpic`, `walkthroughs_active`, `user_id`) VALUES
(3, 'Call of Duty: WWII', 'Getting Tesla Gun in The Final Reich:\r\nAfter unlocking the Bunker and Salt Mine, go inside the Command Room and interact with the crank until it stops. Then, go inside the Emperor Room and interact with the machine in front of Barbarossas statue. Next, continue killing zombies near the machine to charge it up. Keep killing zombies in the nearby area until the Nind Power Machine floats into a hole in the ceiling. After charging the Mind Power Device, go to the Command Room and interact with the button on the upper section of the room to cause the Mind Power Device to start moving; the machine will come to a stop at certain locations. You must keep the Mind Power Device moving. To do this, stay inside the red circle on the ground and continue killing nearby zombies to charge the MPD again. Eventually, the MPD will move near an Electrical Generator, right next to the Schnellblitz Machine.', '2017-12-30 20:00:29', 'tables_attrs/walkthroughs/walkthroughs_id_3/images/codww2Banner.jpeg', 'tables_attrs/walkthroughs/walkthroughs_id_3/images/Call-of-Duty-WW2bx.jpg', 1, 2),
(4, 'Battlefield 1', 'This complete Walkthrough guides you through every step of the Battlefield 1 campaign. The IGN Battlefield One wiki guide will lead you through every chapter of Battlefield 1s story and single-player.', '2017-12-30 20:00:29', 'tables_attrs/walkthroughs/walkthroughs_id_4/images/bf banner.jpg', 'tables_attrs/walkthroughs/walkthroughs_id_4/images/bf3box.jpg', 1, 2),
(5, 'Mafia Definitive Edition', 'Mafia Definitive Edition Walkthrough Part 1 and until the last part will include the full Mafia Definitive Edition Gameplay on PC. This Mafia 1 Remake Gameplay is recorded in 1440p HD 60FPS on PC and will include the full game, all endings and all boss fights. ', '2020-10-02 20:46:27', 'tables_attrs/walkthroughs/walkthroughs_id_5/images/Mafia Definitive Edition banner.jpg', 'tables_attrs/walkthroughs/walkthroughs_id_5/images/Mafia Definitive Edition1.jpg', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`codes_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments_codes`
--
ALTER TABLE `comments_codes`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `news_id` (`codes_id`);

--
-- Indexes for table `comments_mods`
--
ALTER TABLE `comments_mods`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `news_id` (`mods_id`);

--
-- Indexes for table `comments_news`
--
ALTER TABLE `comments_news`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `comments_trainers`
--
ALTER TABLE `comments_trainers`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `news_id` (`trainers_id`);

--
-- Indexes for table `comments_walkthroughs`
--
ALTER TABLE `comments_walkthroughs`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `news_id` (`walkthroughs_id`);

--
-- Indexes for table `mods`
--
ALTER TABLE `mods`
  ADD PRIMARY KEY (`mods_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`pictures_id`);

--
-- Indexes for table `pictures_mods`
--
ALTER TABLE `pictures_mods`
  ADD PRIMARY KEY (`pictures_id`),
  ADD KEY `mods_id` (`mods_id`),
  ADD KEY `pictures_id` (`pictures_id`);

--
-- Indexes for table `pictures_trainers`
--
ALTER TABLE `pictures_trainers`
  ADD PRIMARY KEY (`pictures_id`),
  ADD KEY `mods_id` (`trainers_id`),
  ADD KEY `pictures_id` (`pictures_id`);

--
-- Indexes for table `pictures_walkthroughs`
--
ALTER TABLE `pictures_walkthroughs`
  ADD PRIMARY KEY (`pictures_id`),
  ADD KEY `mods_id` (`walkthroughs_id`),
  ADD KEY `pictures_id` (`pictures_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainers_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`videos_id`);

--
-- Indexes for table `videos_codes`
--
ALTER TABLE `videos_codes`
  ADD PRIMARY KEY (`videos_id`),
  ADD KEY `mods_id` (`codes_id`),
  ADD KEY `pictures_id` (`videos_id`);

--
-- Indexes for table `videos_mods`
--
ALTER TABLE `videos_mods`
  ADD PRIMARY KEY (`videos_id`),
  ADD KEY `mods_id` (`mods_id`),
  ADD KEY `pictures_id` (`videos_id`);

--
-- Indexes for table `videos_news`
--
ALTER TABLE `videos_news`
  ADD PRIMARY KEY (`videos_id`),
  ADD KEY `mods_id` (`news_id`),
  ADD KEY `pictures_id` (`videos_id`);

--
-- Indexes for table `videos_trainers`
--
ALTER TABLE `videos_trainers`
  ADD PRIMARY KEY (`videos_id`),
  ADD KEY `mods_id` (`trainers_id`),
  ADD KEY `pictures_id` (`videos_id`);

--
-- Indexes for table `videos_walkthroughs`
--
ALTER TABLE `videos_walkthroughs`
  ADD PRIMARY KEY (`videos_id`),
  ADD KEY `mods_id` (`walkthroughs_id`),
  ADD KEY `pictures_id` (`videos_id`);

--
-- Indexes for table `walkthroughs`
--
ALTER TABLE `walkthroughs`
  ADD PRIMARY KEY (`walkthroughs_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `codes_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mods`
--
ALTER TABLE `mods`
  MODIFY `mods_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `pictures_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainers_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `videos_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `walkthroughs`
--
ALTER TABLE `walkthroughs`
  MODIFY `walkthroughs_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `codes`
--
ALTER TABLE `codes`
  ADD CONSTRAINT `codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments_codes`
--
ALTER TABLE `comments_codes`
  ADD CONSTRAINT `comments_codes_ibfk_1` FOREIGN KEY (`codes_id`) REFERENCES `codes` (`codes_id`),
  ADD CONSTRAINT `comments_codes_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`);

--
-- Constraints for table `comments_mods`
--
ALTER TABLE `comments_mods`
  ADD CONSTRAINT `comments_mods_ibfk_1` FOREIGN KEY (`mods_id`) REFERENCES `mods` (`mods_id`),
  ADD CONSTRAINT `comments_mods_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`);

--
-- Constraints for table `comments_news`
--
ALTER TABLE `comments_news`
  ADD CONSTRAINT `comments_news_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`),
  ADD CONSTRAINT `comments_news_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`);

--
-- Constraints for table `comments_trainers`
--
ALTER TABLE `comments_trainers`
  ADD CONSTRAINT `comments_trainers_ibfk_1` FOREIGN KEY (`trainers_id`) REFERENCES `trainers` (`trainers_id`),
  ADD CONSTRAINT `comments_trainers_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`);

--
-- Constraints for table `comments_walkthroughs`
--
ALTER TABLE `comments_walkthroughs`
  ADD CONSTRAINT `comments_walkthroughs_ibfk_1` FOREIGN KEY (`walkthroughs_id`) REFERENCES `walkthroughs` (`walkthroughs_id`),
  ADD CONSTRAINT `comments_walkthroughs_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`);

--
-- Constraints for table `mods`
--
ALTER TABLE `mods`
  ADD CONSTRAINT `mods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pictures_mods`
--
ALTER TABLE `pictures_mods`
  ADD CONSTRAINT `pictures_mods_ibfk_1` FOREIGN KEY (`mods_id`) REFERENCES `mods` (`mods_id`),
  ADD CONSTRAINT `pictures_mods_ibfk_2` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`pictures_id`);

--
-- Constraints for table `pictures_trainers`
--
ALTER TABLE `pictures_trainers`
  ADD CONSTRAINT `pictures_trainers_ibfk_1` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`pictures_id`),
  ADD CONSTRAINT `pictures_trainers_ibfk_2` FOREIGN KEY (`trainers_id`) REFERENCES `trainers` (`trainers_id`);

--
-- Constraints for table `pictures_walkthroughs`
--
ALTER TABLE `pictures_walkthroughs`
  ADD CONSTRAINT `pictures_walkthroughs_ibfk_1` FOREIGN KEY (`pictures_id`) REFERENCES `pictures` (`pictures_id`),
  ADD CONSTRAINT `pictures_walkthroughs_ibfk_2` FOREIGN KEY (`walkthroughs_id`) REFERENCES `walkthroughs` (`walkthroughs_id`);

--
-- Constraints for table `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `videos_codes`
--
ALTER TABLE `videos_codes`
  ADD CONSTRAINT `videos_codes_ibfk_1` FOREIGN KEY (`codes_id`) REFERENCES `codes` (`codes_id`),
  ADD CONSTRAINT `videos_codes_ibfk_2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`videos_id`);

--
-- Constraints for table `videos_mods`
--
ALTER TABLE `videos_mods`
  ADD CONSTRAINT `videos_mods_ibfk_1` FOREIGN KEY (`mods_id`) REFERENCES `mods` (`mods_id`),
  ADD CONSTRAINT `videos_mods_ibfk_2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`videos_id`);

--
-- Constraints for table `videos_news`
--
ALTER TABLE `videos_news`
  ADD CONSTRAINT `videos_news_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`),
  ADD CONSTRAINT `videos_news_ibfk_2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`videos_id`);

--
-- Constraints for table `videos_trainers`
--
ALTER TABLE `videos_trainers`
  ADD CONSTRAINT `videos_trainers_ibfk_1` FOREIGN KEY (`trainers_id`) REFERENCES `trainers` (`trainers_id`),
  ADD CONSTRAINT `videos_trainers_ibfk_2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`videos_id`);

--
-- Constraints for table `videos_walkthroughs`
--
ALTER TABLE `videos_walkthroughs`
  ADD CONSTRAINT `videos_walkthroughs_ibfk_1` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`videos_id`),
  ADD CONSTRAINT `videos_walkthroughs_ibfk_2` FOREIGN KEY (`walkthroughs_id`) REFERENCES `walkthroughs` (`walkthroughs_id`);

--
-- Constraints for table `walkthroughs`
--
ALTER TABLE `walkthroughs`
  ADD CONSTRAINT `walkthroughs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
