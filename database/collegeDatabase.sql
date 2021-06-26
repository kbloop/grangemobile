-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 11, 2019 at 12:51 AM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `collegeData`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturerTable`
--

CREATE TABLE `lecturerTable` (
  `staffNumber` int(6) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `moduleNo1` int(6) NOT NULL,
  `moduleNo2` int(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pword` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains all lecturer records for the example database.';

--
-- Dumping data for table `lecturerTable`
--

INSERT INTO `lecturerTable` (`staffNumber`, `firstName`, `lastName`, `moduleNo1`, `moduleNo2`, `email`, `pword`) VALUES
(123001, 'Charlie', 'Cullen', 999001, 999003, 'charlie@here.com', '$2y$10$kGUSLJZSN5jUoleZB5lsAOYsj0dJ3Dzd5DtSqgT6zrLhaT17oDYVO'),
(123002, 'Hugh', 'McAtamney', 999002, 999009, 'hugh@there.com', '$2y$10$opPBrxN/ChEcStc7XP/Tx.nLWoIreO9cwqOfO.A5Hu3GYAKNdXm62'),
(123003, 'Keith', 'Gardiner', 999006, 999008, 'keith@there.com', '$2y$10$yRnAyP6mqd1LO.1M0K0OD.IdW/pbni6vIhdB3Tcwaxtb/WghokL4O'),
(123004, 'Paula', 'McGloin', 999004, 999005, 'paula@there.com', '$2y$10$Sa7w2At6qyBo35CiI.ph/epUloSE7LDfwg1usqYX7DqcEmj0x2S1u'),
(123005, 'James', 'Wogan', 999007, 999010, 'james@there.com', '$2y$10$zrLpKB7YQsSBeYf4yVS5Mucg1rI5SA8UtUHgHp6h1gN9M9.Yk2S1C');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `senderID` int(11) NOT NULL,
  `recipientID` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msgID` int(11) NOT NULL,
  `msg` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`senderID`, `recipientID`, `timeStamp`, `msgID`, `msg`) VALUES
(154, 124, '2019-04-25 15:42:02', 0, 'ALO, THIS BE ANOTHER TEST'),
(123001, 124, '2019-04-26 14:21:14', 4, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
(123001, 124, '2019-05-10 17:31:20', 6, 'asdfasdfasdf'),
(123001, 124, '2019-05-10 04:53:53', 9, 'afsdfa'),
(123001, 157, '2019-05-10 18:42:20', 57, 'GARY MOORE TESTTTER'),
(123001, 124, '2019-05-10 17:31:33', 74, 'Quadruple testy test'),
(123001, 160, '2019-05-10 18:36:21', 81, 'This asiodfgasdfklha dfhjasdl fkjahsdlkfhas ldkfhjadsf'),
(123001, 124, '2019-05-10 03:45:17', 691, 'adsfasdfa'),
(123001, 158, '2019-05-10 18:36:05', 786, 'asdfasdfasdf'),
(123001, 124, '2019-05-10 04:57:19', 1714, 'This is another tset'),
(123001, 160, '2019-05-10 21:04:33', 3635, 'asdfasdfadfsgsdfg'),
(123001, 124, '2019-05-10 17:29:49', 366338, 'jykgkhjgkhj'),
(123001, 153, '2019-05-10 18:41:51', 46487270, 'JOE PASS TEST ');

-- --------------------------------------------------------

--
-- Table structure for table `moduleTable`
--

CREATE TABLE `moduleTable` (
  `moduleNo` int(6) NOT NULL,
  `moduleName` varchar(30) NOT NULL,
  `credits` int(2) NOT NULL,
  `website` varchar(30) NOT NULL,
  `dueDate` date NOT NULL,
  `location` varchar(25) NOT NULL,
  `room` varchar(10) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `long` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains all module records for the example database.';

--
-- Dumping data for table `moduleTable`
--

INSERT INTO `moduleTable` (`moduleNo`, `moduleName`, `credits`, `website`, `dueDate`, `location`, `room`, `lat`, `long`) VALUES
(999001, 'Dynamic Web Development', 15, 'www.dynWeb.ie', '2013-05-14', 'Aungier Street', '4037', '53.338545', '-6.26607'),
(999002, 'Human Computer Interaction', 10, 'www.hci.ie', '2013-04-09', 'Aungier Street', '2005', '53.338545', '-6.26607'),
(999003, 'Introduction to Programming', 15, 'www.jscriptIntro.ie', '2013-01-11', 'Kevin Street', '1045', '53.337015', '-6.267933'),
(999004, 'Design Principles', 15, 'www.designIntro.ie', '2013-04-25', 'Bolton Street', '0130', '53.351406', '-6.268724'),
(999005, 'Design Practice', 10, 'www.designPract.ie', '2013-01-11', 'Cathal Brugha Street', '0123', '53.352044', '-6.259514'),
(999006, 'Digital Audio', 10, 'www.dspAudio.com', '2013-05-10', 'Aungier Street', '3025', '53.338545', '-6.26607'),
(999007, 'Digital Signal Processing', 10, 'www.dspGeneral.ie', '2013-04-04', 'Kevin Street', '2103', '53.337015', '-6.267933'),
(999008, 'History of Digital Media', 5, 'www.itsbeendone.ie', '2013-03-28', 'Aungier Street', '0120', '53.338545', '-6.26607'),
(999009, 'Digital Asset Management', 5, 'www.contentStore.ie', '2013-05-30', 'Bolton Street', '1004', '53.351406', '-6.268724'),
(999010, 'Production Skills', 10, 'www.webDevPro.ie', '2013-04-02', 'Aungier Street', '1089', '53.338545', '-6.26607');

-- --------------------------------------------------------

--
-- Table structure for table `studentTable`
--

CREATE TABLE `studentTable` (
  `studentID` int(6) NOT NULL,
  `password` varchar(250) DEFAULT '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa',
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `moduleNo1` int(6) NOT NULL,
  `moduleNo2` int(6) NOT NULL,
  `courseID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains all student records for the example database.';

--
-- Dumping data for table `studentTable`
--

INSERT INTO `studentTable` (`studentID`, `password`, `firstName`, `lastName`, `moduleNo1`, `moduleNo2`, `courseID`) VALUES
(123, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Kermit', 'Frog', 999003, 999008, 888001),
(124, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Gonzo', 'Great', 999001, 999009, 888001),
(125, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Cookie', 'Monster', 999004, 999005, 888002),
(126, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Fozzie', 'Bear', 999006, 999010, 888001),
(127, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Bunsen', 'Honeydew', 999007, 999009, 888003),
(128, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Miss', 'Piggy', 999002, 999003, 888003),
(129, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Gobo', 'Fraggle', 999008, 999010, 888002),
(130, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Mokey', 'Fraggle', 999002, 999005, 888001),
(131, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Red', 'Fraggle', 999006, 999008, 888003),
(132, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Wembley', 'Fraggle', 999004, 999007, 888003),
(133, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Travelling', 'Matt', 999002, 999003, 888002),
(134, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Convincing', 'John', 999004, 999008, 888001),
(135, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Cotterpin', 'Doozer', 999008, 999009, 888002),
(136, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Judge', 'Dog', 999003, 999007, 888003),
(137, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Doctor', 'Astro', 999005, 999001, 888001),
(138, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Sneaky', 'Snake', 999006, 999008, 888002),
(139, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Sunni', 'Gummi', 999009, 999010, 888002),
(140, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Cubbi', 'Gummi', 999004, 999008, 888001),
(141, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Papa', 'Smurf', 999008, 999009, 888003),
(142, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Lazy', 'Smurf', 999001, 999002, 888001),
(143, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Vanity', 'Smurf', 999008, 999010, 888002),
(144, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Joe', 'Frasier', 999004, 999006, 888003),
(145, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Muhammad', 'Ali', 999003, 999005, 888002),
(146, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'George', 'Foreman', 999002, 999003, 888001),
(147, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Larry', 'Holmes', 999001, 999002, 888001),
(148, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Marvin', 'Hagler', 999004, 999005, 888003),
(149, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'John', 'Coltrane', 999002, 999006, 888002),
(150, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Sonny', 'Rawlins', 999009, 999010, 888002),
(151, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Coleman', 'Hawkins', 999006, 999007, 888003),
(152, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Wes', 'Montgomery', 999002, 999004, 888001),
(153, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Joe', 'Pass', 999006, 999009, 888001),
(154, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Charlie', 'Christian', 999008, 999010, 888002),
(155, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Stanley', 'Jordan', 999004, 999007, 888003),
(156, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Rory', 'Gallagher', 999006, 999009, 888003),
(157, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Gary', 'Moore', 999001, 999008, 888002),
(158, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Jimi', 'Hendrix', 999004, 999008, 888001),
(159, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Paco', 'Pena', 999005, 999009, 888003),
(160, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Andres', 'Segovia', 999003, 999007, 888003),
(161, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'Bootsy', 'Collins', 999004, 999005, 888002),
(162, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'George', 'Clinton', 999003, 999010, 888002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturerTable`
--
ALTER TABLE `lecturerTable`
  ADD PRIMARY KEY (`staffNumber`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`msgID`),
  ADD UNIQUE KEY `msgID` (`msgID`);

--
-- Indexes for table `moduleTable`
--
ALTER TABLE `moduleTable`
  ADD PRIMARY KEY (`moduleNo`);

--
-- Indexes for table `studentTable`
--
ALTER TABLE `studentTable`
  ADD PRIMARY KEY (`studentID`);
