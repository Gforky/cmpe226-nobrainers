-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2017 at 10:27 PM
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
  `CustomerID` int(2) NOT NULL,
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
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 20, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 37, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 38, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 20, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 37, 1),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 38, 1),
('Cajun Chicken Ragout', 0, 27, 1),
('Cajun Chicken Ragout', 0, 32, 1),
('Cajun Chicken Ragout', 0, 36, 1),
('Cajun Chicken Ragout', 4, 27, 1),
('Cajun Chicken Ragout', 4, 32, 1),
('Cajun Chicken Ragout', 4, 36, 1),
('Cajun Chicken Ragout', 9, 27, 1),
('Cajun Chicken Ragout', 9, 32, 1),
('Cajun Chicken Ragout', 9, 36, 1),
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
('Fried Pork Chop', 3, 13, 1);

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
(201704220016540, 2, 2),
(201704220017000, 3, 15),
(201704220017070, 4, 5),
(201704220017110, 2, 2),
(201704220419160, 20, 1),
(201704220419160, 37, 1),
(201704220419160, 38, 1),
(201704220459290, 2, 5),
(201705032223441, 2, 2),
(201705032224131, 20, 1),
(201705032224131, 37, 1),
(201705032224131, 38, 1),
(2017050205043812, 20, 1),
(2017050205043812, 37, 1),
(2017050205043812, 38, 1);

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
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 201704220419160),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 201705032224131),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 2017050205043812);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` bigint(63) NOT NULL,
  `CustomerID` int(2) NOT NULL,
  `Year` int(10) NOT NULL,
  `Month` int(2) NOT NULL,
  `Day` int(2) NOT NULL,
  `DayTime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CustomerID`, `Year`, `Month`, `Day`, `DayTime`) VALUES
(201704220016540, 0, 2017, 4, 22, 1654),
(201704220017000, 0, 2017, 4, 22, 1700),
(201704220017070, 0, 2017, 4, 22, 1707),
(201704220017110, 0, 2017, 4, 22, 1711),
(201704220419160, 0, 2017, 4, 22, 41916),
(201704220459290, 0, 2017, 4, 22, 45929),
(201705032223441, 1, 2017, 5, 3, 222344),
(201705032224131, 1, 2017, 5, 3, 222413),
(2017050205043812, 12, 2017, 5, 2, 50438);

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
  `Year` int(10) NOT NULL,
  `Month` int(2) NOT NULL,
  `Day` int(2) NOT NULL,
  `DayTime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`RecipeName`, `CustomerID`, `Type`, `Description`, `Year`, `Month`, `Day`, `DayTime`) VALUES
('Alaskan Cod and Shrimp with Fresh Tomato', 0, 'Chef', 'nascetur ridiculus mus. Proin vel', 2017, 1, 2, 223517),
('Alaskan Cod and Shrimp with Fresh Tomato', 1, 'Customer', 'neque. Morbi', 2017, 3, 9, 223517),
('Cajun Chicken Ragout', 0, 'Chef', 'neque tellus', 2017, 4, 28, 223517),
('Cajun Chicken Ragout', 4, 'Customer', 'adipiscing elit. Aliquam', 2017, 2, 4, 223517),
('Cajun Chicken Ragout', 9, 'Customer', 'tortor at risus. Nunc ac sem ut', 2017, 5, 2, 223517),
('Fettuccini Carbonara', 0, 'Chef', 'enim diam vel arcu. Curabitur', 2017, 7, 6, 223517),
('Fettuccini Carbonara', 7, 'Customer', 'Suspendisse', 2017, 2, 13, 223517),
('Filet Mignon', 0, 'Chef', ' Preheat the oven to 500 degrees F.\r\n\r\nPlace the beef on a baking sheet and pat the outside dry with a paper towel. Spread the butter on with your hands. Sprinkle evenly with the salt and pepper. Roast in the oven for exactly 22 minutes for rare and 25 minutes for medium-rare.\r\n\r\nRemove the beef from the oven, cover it tightly with aluminum foil, and allow it to rest at room temperature for 20 minutes. Remove the strings and slice the filet thickly. ', 2017, 5, 6, 223517),
('Filet Mignon with Rich Balsamic Glaze', 0, 'Chef', 'magna eros. Proin ultrices.', 2017, 4, 23, 223517),
('Filet Mignon with Rich Balsamic Glaze', 1, 'Customer', 'sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo, it''s delicious', 2017, 5, 2, 223517),
('Filet Mignon with Rich Balsamic Glaze', 3, 'Customer', 'scelerisque neque. Nullam nisl. Maecenas malesuada', 2017, 6, 30, 223517),
('French Fries', 9, 'Customer', '    1. Slice potatoes into French fries, and place into cold water so they won''t turn brown while you prepare the oil.\r\n    2. Heat oil in a large skillet over medium-high heat. While the oil is heating, sift the flour, garlic salt, onion salt, (regular) salt, and paprika into a large bowl. Gradually stir in enough water so that the mixture can be drizzled from a spoon.\r\n    3. Dip potato slices into the batter one at a time, and place in the hot oil so they are not touching at first. The fries must be placed into the skillet one at a time, or they will clump together. Fry until golden brown and crispy. Remove and drain on paper towels.\r\n', 2017, 7, 1, 223517),
('Fried Cabbage and Egg Noodles', 0, 'Chef', 'metus. Aenean sed pede nec ante blandit viverra. Donec tempus', 2017, 8, 9, 223517),
('Fried Cabbage and Egg Noodles', 1, 'Customer', 'dolor elit', 2017, 5, 2, 223517),
('Fried Cabbage and Egg Noodles', 6, 'Customer', 'Aliquam ornare', 2017, 3, 26, 223517),
('Fried Chicken', 1, 'Customer', 'Fry chicken using oil', 2017, 5, 3, 222538),
('Fried Pork Chop', 0, 'Chef', 'sapien. Aenean massa. Integer vitae', 2017, 1, 26, 223517),
('Fried Pork Chop', 3, 'Customer', 'Duis sit amet diam eu dolor egestas rhoncus. Proin', 2017, 9, 2, 223517);

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
