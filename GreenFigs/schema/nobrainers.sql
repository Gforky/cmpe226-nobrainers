-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2017 at 03:13 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nobrainers`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(1) NOT NULL,
  `CategoryName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'vegetables'),
(2, 'fruit'),
(3, 'meat'),
(4, 'seafood'),
(5, 'pasta'),
(6, 'condiment'),
(7, 'dairy');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(10) NOT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `LastName` varchar(7) DEFAULT NULL,
  `Email` varchar(43) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `StreetName` varchar(19) DEFAULT NULL,
  `AptNum` varchar(3) DEFAULT NULL,
  `City` varchar(14) DEFAULT NULL,
  `State` varchar(10) DEFAULT NULL,
  `Zip` varchar(7) DEFAULT NULL,
  `Country` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `LastName`, `Email`, `Password`, `StreetName`, `AptNum`, `City`, `State`, `Zip`, `Country`) VALUES
(0, 'Green', 'Figs', 'greenfigs@greenfigs.com', 'welcomegreenfigs', '1 Washington Square', '123', 'San Jose', 'CA', '95192', 'United States'),
(1, 'Harrison', 'Reilly', 'Sed.nulla.ante@orcilacusvestibulum.ca', 'CDB22IEJ8TO', '596-8831 Mi Ave', '871', 'Racine', 'WI', '40808', 'United States'),
(2, 'Vladimir', 'Ayers', 'Aenean.euismod@arcu.com', 'CMJ42AKF1ZZ', '975-823 Tempus St.', '708', 'Butte', 'MT', '41305', 'United States'),
(3, 'Cullen', 'Gibbs', 'dapibus.ligula@nuncinterdumfeugiat.co.uk', 'JVT96DAC8PM', '3757 Interdum. Av.', '142', 'Dallas', 'TX', '49873', 'United States'),
(4, 'Kalia', 'Sosa', 'congue@consectetuer.org', 'HQL61ERX6LS', '519-5884 Odio. Rd.', '383', 'Vancouver', 'WA', '27318', 'United States'),
(5, 'Carlos', 'Hampton', 'aliquam.eu.accumsan@liberomaurisaliquam.edu', 'PZZ53PQQ3OM', '7428 Ornare St.', '413', 'Saint Louis', 'MO', '61380', 'United States'),
(6, 'Jacqueline', 'Burke', 'nunc@adlitora.co.uk', 'OVT67GOD1IX', '488-8017 Sed Ave', '748', 'Carson City', 'NV', '70259', 'United States'),
(7, 'Rama', 'Bentley', 'arcu@sem.org', 'VUP16RXS3BJ', '1383 Mauris Street', '538', 'Boston', 'MA', '12345', 'United States'),
(8, 'Quyn', 'Berry', 'ultrices.sit.amet@urnaconvalliserat.ca', 'YFR72QVL9KI', '8096 Nunc Street', '889', 'Toledo', 'OH', '13694', 'United States'),
(9, 'Kendall', 'Adkins', 'ultrices.iaculis@semperet.ca', 'EGW86QMG7MD', '314-1360 Eu', '34', 'Orlando', 'FL', '46539', 'United States'),
(10, 'Leilani', 'Wallace', 'et.rutrum@dictumeueleifend.edu', 'EDJ81KYA5MW', '582-495 Dui Rd.', '898', 'Jefferson City', 'MO', '40857', 'United States'),
(12, 'Luwen', 'Miao', 'luwen.miao@sjsu.edu', '123456', '12345 miao st', '555', 'Sunnyvale', 'CA', '95123', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `customerphone`
--

CREATE TABLE `customerphone` (
  `Phone` varchar(14) NOT NULL,
  `CustomerID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customerphone`
--

INSERT INTO `customerphone` (`Phone`, `CustomerID`) VALUES
('1-152-350-0853', 2),
('1-234-234-2345', 12),
('1-355-581-5317', 8),
('1-408-211-5325', 9),
('1-563-713-4226', 10),
('1-575-715-5036', 1),
('1-726-393-7780', 6),
('1-728-607-5063', 4),
('1-808-737-5558', 7),
('1-896-213-1041', 5),
('1-964-912-7686', 3);

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `FarmerID` int(1) NOT NULL,
  `FirstName` varchar(7) NOT NULL,
  `LastName` varchar(8) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Password` varchar(11) NOT NULL,
  `StreetName` varchar(18) DEFAULT NULL,
  `AptNum` int(3) DEFAULT NULL,
  `City` varchar(12) DEFAULT NULL,
  `State` varchar(4) DEFAULT NULL,
  `Zip` varchar(6) DEFAULT NULL,
  `Country` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`FarmerID`, `FirstName`, `LastName`, `Email`, `Password`, `StreetName`, `AptNum`, `City`, `State`, `Zip`, `Country`) VALUES
(1, 'Kylan', 'Reed', 'kylan.reed@gmail.com', 'BHS09YXL4QF', '7276 Tempor St.', 841, 'Akron', 'OH', '18571', 'United States'),
(2, 'Jocelyn', 'Gould', 'jocelyn.gould@gmail.com', 'GVQ91NQP1NF', '167-448 Ipsum Ave', 889, 'Houston', 'TX', '87641', 'United States'),
(3, 'Andrew', 'Valencia', 'andrew.valencia@gmail.com', 'ITI67QKY6HS', '481-6931 Arcu. Rd.', 657, 'Des Moines', 'IO', '48209', 'United States'),
(4, 'Erich', 'Beck', 'erich.beck@gmail.com', 'IEY27GIE7OZ', '2497 Quam Av.', 739, 'Cedar Rapids', 'IO', '48978', 'United States'),
(5, 'Veda', 'Hurst', 'veda.hurst@gmail.com', 'PYE81AZO5LM', '971-9721 Vel, Road', 702, 'Bloomington', 'MN', '43950', 'United States'),
(6, 'testa', 'testa', 'aaa@gmail.com', 'aaa', 'One St', 1, 'Sunnyvale', 'CA', '95134', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `farmerphone`
--

CREATE TABLE `farmerphone` (
  `Phone` varchar(14) NOT NULL,
  `FarmerID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `farmerphone`
--

INSERT INTO `farmerphone` (`Phone`, `FarmerID`) VALUES
('1-134-339-5858', 4),
('1-173-193-4861', 2),
('1-293-249-1234', 6),
('1-333-414-4046', 1),
('1-592-174-8040', 5),
('1-992-771-8236', 3);

-- --------------------------------------------------------

--
-- Table structure for table `iscontained`
--

CREATE TABLE `iscontained` (
  `RecipeName` varchar(40) NOT NULL,
  `CustomerID` int(1) NOT NULL,
  `ProductID` int(2) NOT NULL,
  `Amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `iscontained`
--

INSERT INTO `iscontained` (`RecipeName`, `CustomerID`, `ProductID`, `Amount`) VALUES
('20 No-Guilt Diabetic Banana Bread ', 1, 29, 6),
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 20, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 37, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 38, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 20, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 37, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 38, 1),
('Apricot-Mustard Chicken Sandwiches', 1, 14, 2),
('Cajun Chicken Ragout', 0, 27, 1),
('Cajun Chicken Ragout', 0, 32, 1),
('Cajun Chicken Ragout', 0, 36, 1),
('Cajun Chicken Ragout', 4, 27, 1),
('Cajun Chicken Ragout', 4, 32, 1),
('Cajun Chicken Ragout', 4, 36, 1),
('Cajun Chicken Ragout', 9, 27, 1),
('Cajun Chicken Ragout', 9, 32, 1),
('Cajun Chicken Ragout', 9, 36, 1),
('Chicken with Sourdough-Mushroom Stuffing', 1, 2, 1),
('Fettuccini Carbonara', 0, 19, 1),
('Fettuccini Carbonara', 0, 21, 1),
('Fettuccini Carbonara', 0, 32, 1),
('Fettuccini Carbonara', 0, 43, 1),
('Fettuccini Carbonara', 7, 19, 1),
('Fettuccini Carbonara', 7, 21, 1),
('Fettuccini Carbonara', 7, 32, 1),
('Fettuccini Carbonara', 7, 43, 1),
('Filet Mignon', 0, 6, 1),
('Filet Mignon', 0, 19, 1),
('Filet Mignon', 0, 21, 1),
('Filet Mignon with Rich Balsamic Glaze', 0, 3, 1),
('Filet Mignon with Rich Balsamic Glaze', 0, 6, 1),
('Filet Mignon with Rich Balsamic Glaze', 0, 14, 1),
('Filet Mignon with Rich Balsamic Glaze', 0, 18, 1),
('Filet Mignon with Rich Balsamic Glaze', 1, 3, 1),
('Filet Mignon with Rich Balsamic Glaze', 1, 6, 1),
('Filet Mignon with Rich Balsamic Glaze', 1, 14, 1),
('Filet Mignon with Rich Balsamic Glaze', 1, 18, 1),
('Filet Mignon with Rich Balsamic Glaze', 3, 3, 1),
('Filet Mignon with Rich Balsamic Glaze', 3, 6, 1),
('Filet Mignon with Rich Balsamic Glaze', 3, 14, 1),
('Filet Mignon with Rich Balsamic Glaze', 3, 18, 1),
('French Fries', 9, 8, 2),
('French Fries', 9, 14, 1),
('French Fries', 9, 21, 1),
('Fried Cabbage and Egg Noodles', 0, 8, 2),
('Fried Cabbage and Egg Noodles', 0, 21, 1),
('Fried Cabbage and Egg Noodles', 1, 8, 2),
('Fried Cabbage and Egg Noodles', 1, 21, 1),
('Fried Cabbage and Egg Noodles', 6, 8, 2),
('Fried Cabbage and Egg Noodles', 6, 21, 1),
('Fried Chicken', 1, 19, 1),
('Fried Chicken', 1, 21, 1),
('Fried Pork Chop', 0, 8, 2),
('Fried Pork Chop', 0, 11, 1),
('Fried Pork Chop', 0, 13, 1),
('Fried Pork Chop', 3, 8, 2),
('Fried Pork Chop', 3, 11, 1),
('Fried Pork Chop', 3, 13, 1),
('In-Your-Sleep Chili', 1, 14, 3),
('Maryland Fried Chicken with Creamy Gravy', 1, 29, 11),
('Orange Chicken', 5, 19, 1),
('Orange Chicken', 5, 21, 1),
('Orange Chicken', 12, 19, 1),
('Orange Chicken', 12, 21, 1),
('Original Hot Brown', 1, 2, 3),
('Rich and Creamy Beef Stroganoff', 1, 19, 3),
('Skinny Slow Cooker Recipes ', 1, 14, 5),
('test', 12, 19, 1),
('test', 12, 21, 1),
('World''s Best Honey Garlic Pork Chops', 1, 19, 7);

-- --------------------------------------------------------

--
-- Table structure for table `isincludedproduct`
--

CREATE TABLE `isincludedproduct` (
  `OrderID` bigint(63) NOT NULL,
  `ProductID` int(2) NOT NULL,
  `Amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `isincludedproduct`
--

INSERT INTO `isincludedproduct` (`OrderID`, `ProductID`, `Amount`) VALUES
(20150708223456, 2, 2),
(20150709223456, 2, 3),
(20150710223456, 2, 15),
(20150805223456, 14, 5),
(20150806223456, 19, 1),
(20150807223456, 19, 29),
(20150901223456, 2, 6),
(20150902223456, 29, 2),
(20150903223456, 14, 10),
(20160210223456, 14, 3),
(20160211223456, 19, 17),
(20160212223456, 14, 2),
(20160322223456, 2, 1),
(20160323223456, 19, 4),
(20160324223456, 29, 6),
(20160404223456, 2, 1),
(20160405223456, 29, 3),
(20160406223456, 19, 5),
(20170102223456, 14, 19),
(20170103223456, 14, 21),
(20170104223456, 29, 35),
(20170213223456, 2, 5),
(20170214223456, 14, 1),
(20170215223456, 14, 2),
(20170419223456, 29, 35),
(20170420223456, 19, 23),
(20170421223456, 14, 3),
(201705040551401, 2, 2),
(201705040551471, 3, 3),
(201705040551501, 7, 12),
(201705040552015, 6, 3),
(201705040552095, 7, 1),
(201705040552135, 8, 3),
(201705040552175, 11, 22),
(201705040552215, 20, 1),
(201705040552215, 37, 1),
(201705040552215, 38, 1),
(201705040552255, 27, 1),
(201705040552255, 32, 1),
(201705040552255, 36, 1),
(201705041453261, 103, 2),
(201705050257121, 2, 3),
(201705050257181, 27, 1),
(201705050257181, 32, 1),
(201705050257181, 36, 1),
(2017050405545712, 3, 3),
(2017050405550412, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `isincludedrecipe`
--

CREATE TABLE `isincludedrecipe` (
  `RecipeName` varchar(40) NOT NULL,
  `CustomerID` int(1) NOT NULL,
  `OrderId` bigint(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `isincludedrecipe`
--

INSERT INTO `isincludedrecipe` (`RecipeName`, `CustomerID`, `OrderId`) VALUES
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 201705040552215),
('Cajun Chicken Ragout', 4, 201705040552255),
('Cajun Chicken Ragout', 9, 201705050257181);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` bigint(63) NOT NULL,
  `CustomerID` int(2) NOT NULL,
  `DayTime` int(10) NOT NULL,
  `Date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CustomerID`, `DayTime`, `Date`) VALUES
(20150708223456, 1, 223456, '2015-07-08'),
(20150709223456, 1, 223456, '2015-07-09'),
(20150710223456, 1, 223456, '2015-07-10'),
(20150805223456, 1, 223456, '2015-08-05'),
(20150806223456, 1, 223456, '2015-08-06'),
(20150807223456, 1, 223456, '2015-08-07'),
(20150901223456, 1, 223456, '2015-09-01'),
(20150902223456, 1, 223456, '2015-09-02'),
(20150903223456, 1, 223456, '2015-09-03'),
(20160210223456, 1, 223456, '2016-02-10'),
(20160211223456, 1, 223456, '2016-02-11'),
(20160212223456, 1, 223456, '2016-02-12'),
(20160322223456, 1, 223456, '2016-03-22'),
(20160323223456, 1, 223456, '2016-03-23'),
(20160324223456, 1, 223456, '2016-03-24'),
(20160404223456, 1, 223456, '2016-04-04'),
(20160405223456, 1, 223456, '2016-04-05'),
(20160406223456, 1, 223456, '2016-04-06'),
(20170102223456, 1, 223456, '2017-01-02'),
(20170103223456, 1, 223456, '2017-01-03'),
(20170104223456, 1, 223456, '2017-01-04'),
(20170213223456, 1, 223456, '2017-02-13'),
(20170214223456, 1, 223456, '2017-02-14'),
(20170215223456, 1, 223456, '2017-02-15'),
(20170419223456, 1, 223456, '2017-04-19'),
(20170420223456, 1, 223456, '2017-04-20'),
(20170421223456, 1, 223456, '2017-04-21'),
(201705040551401, 1, 55140, '2017-05-04'),
(201705040551471, 1, 55147, '2017-05-04'),
(201705040551501, 1, 55150, '2017-05-04'),
(201705040552015, 5, 55201, '2017-05-04'),
(201705040552095, 5, 55209, '2017-05-04'),
(201705040552135, 5, 55213, '2017-05-04'),
(201705040552175, 5, 55217, '2017-05-04'),
(201705040552215, 5, 55221, '2017-05-04'),
(201705040552255, 5, 55225, '2017-05-04'),
(201705041453261, 1, 145326, '2017-05-04'),
(201705050257121, 1, 25712, '2017-05-05'),
(201705050257181, 1, 25718, '2017-05-05'),
(2017050405545712, 12, 55457, '2017-05-04'),
(2017050405550412, 12, 55504, '2017-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `Name` varchar(13) NOT NULL,
  `Description` varchar(74) DEFAULT NULL,
  `Certification` varchar(11) DEFAULT NULL,
  `CategoryID` int(1) DEFAULT NULL,
  `FarmerID` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Price`, `Name`, `Description`, `Certification`, `CategoryID`, `FarmerID`) VALUES
(1, '6.62', 'sugar', 'libero et tristique pellentesque', 'non-gmo', 6, 3),
(2, '4.81', 'penne', 'faucibus. Morbi vehicula.', 'gluten-free', 5, 1),
(3, '4.81', 'parsley', 'vestibulum lorem', 'organic', 1, 3),
(4, '7.59', 'chicken', 'pharetra', 'gluten-free', 3, 2),
(5, '7.09', 'shrimp', 'tristique senectus et netus et malesuada fames ac', 'gluten-free', 4, 2),
(6, '2.43', 'beef', 'Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus', 'gluten-free', 3, 4),
(7, '3.62', 'pasta-sauce', 'eros turpis non enim. Mauris', 'organic', 6, 4),
(8, '3.72', 'parsley', 'euismod urna. Nullam lobortis quam', 'organic', 1, 2),
(9, '4.15', 'romain-hearts', 'erat. Vivamus nisi. Mauris', 'non-gmo', 1, 4),
(10, '5.31', 'pasta-sauce', 'vel', 'gluten-free', 6, 3),
(11, '5.33', 'pork', 'nulla magna', 'gluten-free', 3, 2),
(12, '7.10', 'pork', 'Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus', 'gluten-free', 3, 3),
(13, '2.17', 'soy-milk', 'magnis', 'organic', 7, 2),
(14, '4.06', 'sugar', 'et', 'gluten-free', 6, 1),
(15, '3.93', 'strawberry', 'libero lacus', 'organic', 2, 3),
(16, '4.38', 'pasta-sauce', 'aptent taciti sociosqu ad litora torquent per conubia', 'non-gmo', 6, 4),
(17, '1.00', 'sugar', 'ornare', 'non-gmo', 6, 3),
(18, '1.67', 'pepper', 'mi enim', 'gluten-free', 6, 4),
(19, '3.91', 'tomato', 'malesuada', 'gluten-free', 1, 1),
(20, '8.14', 'shrimp', 'eget', 'gluten-free', 4, 2),
(21, '3.22', 'salt', 'luctus', 'non-gmo', 6, 3),
(22, '2.90', 'sugar', 'enim nec tempus', 'gluten-free', 6, 3),
(23, '6.89', 'pasta-sauce', 'feugiat. Lorem ipsum dolor sit amet', 'non-gmo', 6, 4),
(24, '9.99', 'romain-hearts', 'massa non', 'non-gmo', 1, 3),
(25, '8.12', 'cherry', 'libero. Proin mi. Aliquam gravida', 'organic', 2, 5),
(26, '1.20', 'chicken', 'non', 'organic', 3, 1),
(27, '3.42', 'beef', 'rutrum. Fusce dolor quam', 'gluten-free', 3, 1),
(28, '1.21', 'tomato', 'vulputate', 'non-gmo', 2, 1),
(29, '1.43', 'penne', 'mauris sapien', 'organic', 5, 1),
(30, '7.36', 'penne', 'torquent per conubia nostra', 'organic', 5, 5),
(31, '4.17', 'parsley', 'non', 'gluten-free', 1, 1),
(32, '1.68', 'pasta-sauce', 'consequat', 'non-gmo', 6, 1),
(33, '7.71', 'pork', 'Duis elementum', 'organic', 3, 2),
(34, '9.08', 'halibut', 'imperdiet nec', 'non-gmo', 4, 5),
(35, '9.75', 'lobster', 'nascetur ridiculus mus.', 'gluten-free', 4, 2),
(36, '3.46', 'salt', 'in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum', 'non-gmo', 6, 2),
(37, '5.00', 'tomato', 'viverra. Maecenas iaculis aliquet diam. Sed diam lorem', 'non-gmo', 1, 4),
(38, '5.83', 'lobster', 'orci quis lectus. Nullam suscipit', 'gluten-free', 4, 4),
(39, '2.58', 'lobster', 'dui. Fusce aliquam', 'gluten-free', 4, 3),
(40, '3.18', 'parsley', 'sodales at', 'non-gmo', 1, 4),
(41, '6.32', 'milk', 'augue ac ipsum. Phasellus vitae mauris', 'gluten-free', 7, 1),
(42, '9.66', 'halibut', 'faucibus orci luctus et ultrices posuere cubilia', 'organic', 4, 4),
(43, '2.47', 'chicken', 'egestas nunc sed libero. Proin sed turpis nec mauris blandit', 'organic', 3, 3),
(44, '4.67', 'blueberry', 'id magna et', 'gluten-free', 2, 3),
(45, '1.75', 'shrimp', 'justo faucibus lectus', 'organic', 4, 3),
(46, '9.68', 'pasta-sauce', 'ut aliquam iaculis', 'gluten-free', 6, 4),
(47, '9.13', 'soy-milk', 'eleifend egestas. Sed pharetra', 'non-gmo', 7, 2),
(48, '7.63', 'penne', 'dapibus ligula. Aliquam erat volutpat. Nulla', 'organic', 5, 1),
(49, '3.54', 'beef', 'et magnis dis', 'gluten-free', 3, 3),
(50, '2.99', 'strawberry', 'felis orci', 'organic', 2, 1),
(103, '123.00', 'aaa', 'aaa', 'non-gmo', 1, 6),
(104, '150.00', 'cacabibi', 'bbbyiyi', 'non-gmo', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `RecipeName` varchar(40) NOT NULL,
  `CustomerID` int(1) NOT NULL,
  `Type` varchar(8) DEFAULT NULL,
  `Description` longtext,
  `DayTime` int(10) NOT NULL,
  `Date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`RecipeName`, `CustomerID`, `Type`, `Description`, `DayTime`, `Date`) VALUES
('20 No-Guilt Diabetic Banana Bread ', 1, 'Customer', ' Preheat oven to 350 degrees F. Grease the bottom and 1/2 inch up the sides of an 8x4x2-inch loaf pan or line with parchment paper; set aside.\r\n In a large bowl stir together all-purpose flour, whole wheat flour, baking powder, pumpkin pie spice, baking soda, and salt. Make a well in the center of the flour mixture; set aside.\r\n In a medium bowl combine mashed bananas, brown sugar, coconut milk, egg, and oil. Add banana mixture all at once to flour mixture; stir just until moistened (batter should be lumpy). Spoon batter into prepared loaf pan. Sprinkle with macadamia nuts and coconut.\r\n Bake for 45 to 50 minutes or until a toothpick inserted near center comes out clean, covering loaf loosely with foil for the last 20 minutes of baking to prevent overbrowning. Cool in pan on a wire rack for 10 minutes. Remove from pan. Cool completely on wire rack. Wrap and store overnight before slicing. Makes 12 (1 slice each) servings', 223457, '2017-04-19'),
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 'Chef', 'nascetur ridiculus mus. Proin vel', 223517, '2017-01-02'),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 'Customer', 'neque. Morbi', 223517, '2017-03-09'),
('Apricot-Mustard Chicken Sandwiches', 1, 'Customer', 'In a large skillet, cook onion and garlic in hot oil over medium heat about 4 minutes or until tender. Stir in shredded chicken, mustard, apricot preserves, vinegar, bourbon, and cayenne pepper. Heat through. If necessary, simmer, uncovered, about 5 minutes or until desired consistency.\r\n Spoon about 1/2 cup chicken mixture on each bun bottom. Top with red onion if desired. Add bun tops.', 223456, '2017-04-19'),
('Cajun Chicken Ragout', 0, 'Chef', 'neque tellus', 223517, '2017-04-28'),
('Cajun Chicken Ragout', 4, 'Customer', 'adipiscing elit. Aliquam', 223517, '2017-02-04'),
('Cajun Chicken Ragout', 9, 'Customer', 'tortor at risus. Nunc ac sem ut', 223517, '2017-05-02'),
('Chicken with Sourdough-Mushroom Stuffing', 1, 'Customer', 'Line a 5-1/2- to 6-quart slow cooker with a disposable cooker liner. Lightly coat liner with cooking spray; set aside. Reserve 1 teaspoon of the lemon peel. In a small bowl combine remaining lemon peel, sage, seasoned salt and pepper. Remove 3/4 of the mixture and rub onto chicken legs. Place chicken in slow cooker.\r\nMeanwhile, melt butter in a skillet; add mushrooms and garlic. Cook and stir 3 to 5 minutes or until just tender. Stir in remaining sage mixture. Transfer mushroom mixture to a large bowl. Add bread cubes, and shredded carrot. Drizzle with chicken broth, tossing gently.\r\nLightly pack stuffing on top of chicken. Cover and cook on high-heat setting for 4 to 5 hours.\r\nTransfer stuffing and chicken to a platter.\r\nIn a bowl combine reserved lemon peel, walnuts, and parsley; sprinkle over chicken. Makes 8 servings.', 223456, '2016-02-10'),
('Fettuccini Carbonara', 0, 'Chef', 'enim diam vel arcu. Curabitur', 223517, '2017-03-06'),
('Fettuccini Carbonara', 7, 'Customer', 'Suspendisse', 223517, '2017-02-13'),
('Filet Mignon', 0, 'Chef', ' Preheat the oven to 500 degrees F.\r\n\r\nPlace the beef on a baking sheet and pat the outside dry with a paper towel. Spread the butter on with your hands. Sprinkle evenly with the salt and pepper. Roast in the oven for exactly 22 minutes for rare and 25 minutes for medium-rare.\r\n\r\nRemove the beef from the oven, cover it tightly with aluminum foil, and allow it to rest at room temperature for 20 minutes. Remove the strings and slice the filet thickly. ', 223517, '2017-05-06'),
('Filet Mignon with Rich Balsamic Glaze', 0, 'Chef', 'magna eros. Proin ultrices.', 223517, '2017-04-23'),
('Filet Mignon with Rich Balsamic Glaze', 1, 'Customer', 'sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo, it''s delicious', 223517, '2017-05-02'),
('Filet Mignon with Rich Balsamic Glaze', 3, 'Customer', 'scelerisque neque. Nullam nisl. Maecenas malesuada', 223517, '2017-04-30'),
('French Fries', 9, 'Customer', '    1. Slice potatoes into French fries, and place into cold water so they won''t turn brown while you prepare the oil.\r\n    2. Heat oil in a large skillet over medium-high heat. While the oil is heating, sift the flour, garlic salt, onion salt, (regular) salt, and paprika into a large bowl. Gradually stir in enough water so that the mixture can be drizzled from a spoon.\r\n    3. Dip potato slices into the batter one at a time, and place in the hot oil so they are not touching at first. The fries must be placed into the skillet one at a time, or they will clump together. Fry until golden brown and crispy. Remove and drain on paper towels.\r\n', 223517, '2017-02-01'),
('Fried Cabbage and Egg Noodles', 0, 'Chef', 'metus. Aenean sed pede nec ante blandit viverra. Donec tempus', 223517, '2017-02-09'),
('Fried Cabbage and Egg Noodles', 1, 'Customer', 'dolor elit', 223517, '2017-05-02'),
('Fried Cabbage and Egg Noodles', 6, 'Customer', 'Aliquam ornare', 223517, '2017-03-26'),
('Fried Chicken', 1, 'Customer', 'Fry chicken using oil', 222538, '2017-05-03'),
('Fried Pork Chop', 0, 'Chef', 'sapien. Aenean massa. Integer vitae', 223517, '2017-01-26'),
('Fried Pork Chop', 3, 'Customer', 'Duis sit amet diam eu dolor egestas rhoncus. Proin', 223517, '2017-01-02'),
('In-Your-Sleep Chili', 1, 'Customer', 'In a large skillet, cook ground beef and onion until meat is brown; drain off fat.\r\nIn a 3 1/2- to 4-quart slow cooker, combine ground beef mixture, beans, undrained tomatoes and green chiles, and vegetable juice.\r\nCover; cook on low-heat setting for 4 to 6 hours on on high-heat setting for 2 to 3 hours. If desired, top each serving with green onions, sour cream, and/or cheddar cheese.', 223456, '2016-02-12'),
('Maryland Fried Chicken with Creamy Gravy', 1, 'Customer', 'In a small bowl combine the egg and the 3 tablespoons milk. In a shallow bowl combine crushed crackers, thyme, paprika, and pepper. Dip chicken pieces, 1 at a time, in egg mixture; roll in cracker mixture.\r\nIn a large skillet brown chicken in hot oil over medium heat for 10 to 15 minutes, turning occasionally. Drain well.\r\nAdd the 1 cup milk to skillet. Heat just to boiling. Reduce heat to medium-low; cover tightly. Cook for 35 minutes. Uncover; cook about 10 minutes more or until chicken is no longer pink (170 degrees F for breasts; 180 degrees F for thighs and drumsticks). Transfer chicken to a serving platter, reserving drippings for gravy. Cover chicken and keep warm. Prepare Creamy Gravy. Makes 6 servings.', 223457, '2015-08-09'),
('Orange Chicken', 5, 'Customer', 'Fry chicken with orange juice', 55251, '2017-05-04'),
('Orange Chicken', 12, 'Customer', 'Fry chicken with orange jucy', 44026, '2017-05-03'),
('Original Hot Brown', 1, 'Customer', 'Melt the butter in a saucepan over medium heat. Stir in flour with a whisk or fork, and continue to cook and stir until it begins to brown slightly. Gradually whisk in the milk so that no lumps form, then bring to a boil, stirring constantly. Mix in 6 tablespoons of Parmesan cheese and then stir in the beaten egg to thicken. Do not allow the sauce to boil once the egg has been mixed in. Remove from the heat and stir in the cream.\r\nPreheat the oven''s broiler. For each hot brown, place two slices of toast into the bottom of an individual sized casserole dish. Cover with a liberal amount of roasted turkey and tomato slices. Spoon sauce over the top of each one and sprinkle with some of the remaining Parmesan cheese.\r\nPlace the dishes under the broiler and cook until the top is speckled brown, about 5 minutes. Remove from the broiler and arrange two slices of bacon in a cross shape on top of each sandwich. Serve immediately.', 223456, '2015-08-09'),
('Rich and Creamy Beef Stroganoff', 1, 'Customer', 'Place the beef into a large bowl. Stir in the red wine, salt, and black pepper. Marinate for 10 minutes, then remove the beef and pat dry with a paper towel. Reserve the remaining marinade.\r\nHeat the olive oil in a large skillet over medium heat. Stir in the beef; cook and stir until browned, then transfer to a plate, 5 to 7 minutes. Drain any remaining grease from the skillet. Melt 2 tablespoons butter over medium heat. Stir in the onion, garlic, and a pinch of salt. Cook and stir until the onion is soft and translucent. Transfer the onion mixture to the plate with the prepared beef; set aside.\r\nMelt another 2 tablespoons butter in the same skillet over medium heat, and stir in the mushrooms. Cook and stir until the mushrooms are tender, about 10 minutes. Place the cooked mushrooms in a bowl and set aside. Melt 1/4 cup of butter in the skillet. Whisk in the flour, cook and stir until the flour no longer tastes raw, about 4 minutes. Slowly whisk in the beef stock. Bring to a boil, stirring constantly, then reduce heat to medium low. Pour in the reserved red wine marinade, Worcestershire sauce, prepared mustard, and red pepper flakes, then add the beef and onion mixture. Cover and simmer until the meat is tender, about 1 hour. Season with salt and black pepper.\r\nStir in the mushrooms, sour cream, and cream cheese about 5 minutes before serving.', 223457, '2016-02-12'),
('Skinny Slow Cooker Recipes ', 1, 'Customer', ' Coat a medium nonstick skillet with cooking spray. Heat over medium-high heat; add chicken. Cook and stir about 3 minutes or until light brown. Drain off fat\r\n In a 3 1/2- or 4-quart slow cooker layer carrots, chicken, onions, garlic, and ginger.\r\n In a medium bowl whisk together broth, coconut milk, curry powder, and salt. Pour over the mixture in cooker.\r\n Cover and cook on low-heat setting for 6 to 8 hours or on high-heat setting for 3 to 4 hours.\r\n To serve, stir in cilantro and lemon juice.', 223456, '2017-04-19'),
('test', 12, 'Customer', 'test', 144616, '2017-05-04'),
('World''s Best Honey Garlic Pork Chops', 1, 'Customer', 'Preheat grill for medium heat and lightly oil the grate.\r\nWhisk ketchup, honey, soy sauce, and garlic together in a bowl to make a glaze.\r\nSear the pork chops on both sides on the preheated grill. Lightly brush glaze onto each side of the chops as they cook; grill until no longer pink in the center, about 7 to 9 minutes per side. An instant-read thermometer inserted into the center should read 145 degrees F (63 degrees C).', 223455, '2015-08-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `customerphone`
--
ALTER TABLE `customerphone`
  ADD PRIMARY KEY (`Phone`,`CustomerID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`FarmerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `farmerphone`
--
ALTER TABLE `farmerphone`
  ADD PRIMARY KEY (`Phone`,`FarmerID`),
  ADD KEY `farmerphone_ibfk_1` (`FarmerID`);

--
-- Indexes for table `iscontained`
--
ALTER TABLE `iscontained`
  ADD PRIMARY KEY (`RecipeName`,`CustomerID`,`ProductID`),
  ADD KEY `iscontained_ibfk_2` (`CustomerID`),
  ADD KEY `iscontained_ibfk_3` (`ProductID`);

--
-- Indexes for table `isincludedproduct`
--
ALTER TABLE `isincludedproduct`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `isincludedproduct_ibfk_2` (`ProductID`);

--
-- Indexes for table `isincludedrecipe`
--
ALTER TABLE `isincludedrecipe`
  ADD PRIMARY KEY (`RecipeName`,`CustomerID`,`OrderId`),
  ADD KEY `isincludedrecipe_ibfk_3` (`OrderId`),
  ADD KEY `isincludedrecipe_ibfk_4` (`CustomerID`,`RecipeName`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `FarmerID` (`FarmerID`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`RecipeName`,`CustomerID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` bigint(63) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2017050405550413;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerphone`
--
ALTER TABLE `customerphone`
  ADD CONSTRAINT `customerphone_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmerphone`
--
ALTER TABLE `farmerphone`
  ADD CONSTRAINT `farmerphone_ibfk_1` FOREIGN KEY (`FarmerID`) REFERENCES `farmer` (`FarmerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iscontained`
--
ALTER TABLE `iscontained`
  ADD CONSTRAINT `iscontained_ibfk_3` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `iscontained_ibfk_4` FOREIGN KEY (`RecipeName`,`CustomerID`) REFERENCES `recipe` (`RecipeName`, `CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `isincludedproduct`
--
ALTER TABLE `isincludedproduct`
  ADD CONSTRAINT `isincludedproduct_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isincludedproduct_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON UPDATE CASCADE;

--
-- Constraints for table `isincludedrecipe`
--
ALTER TABLE `isincludedrecipe`
  ADD CONSTRAINT `isincludedrecipe_ibfk_3` FOREIGN KEY (`OrderId`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isincludedrecipe_ibfk_4` FOREIGN KEY (`CustomerID`,`RecipeName`) REFERENCES `recipe` (`CustomerID`, `RecipeName`) ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`FarmerID`) REFERENCES `farmer` (`FarmerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
