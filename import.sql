SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(4) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Binod Chaudhary', 'binodchaudhary@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(2, 'Shanti Moktan', 'shantimoktan@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id` int(4) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `categoryId` int(4) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id`, `full_name`, `title`, `description`, `categoryId`, `created_on`, `end_date`) VALUES
(1, 'User 1', 'Product 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia veniam iusto molestias quae sed animi nisi porro nulla est ab magni illo perferendis ipsa voluptate ea ullam sequi nesciunt distinctio, doloremque vero temporibus. Harum voluptate modi, vero iure amet voluptatem quas ad omnis cum minima distinctio laborum explicabo dignissimos consectetur quis atque mollitia aliquam asperiores tempora repellat necessitatibus maxime accusamus? Eveniet, impedit? Adipisci nobis facere, tenetur quod dolorum reprehenderit ea aut neque, quo minus recusandae, qui ipsam. Eos, velit autem ipsam voluptatum excepturi nulla voluptatem quam laboriosam. Exercitationem, deleniti! Ratione consequuntur itaque animi dicta, cumque nobis. Quia?', 4, '2023-04-20', '2023-04-24'),
(2, 'User 2', 'Product 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia veniam iusto molestias quae sed animi nisi porro nulla est ab magni illo perferendis ipsa voluptate ea ullam sequi nesciunt distinctio, doloremque vero temporibus. Harum voluptate modi, vero iure amet voluptatem quas ad omnis cum minima distinctio laborum explicabo dignissimos consectetur quis atque mollitia aliquam asperiores tempora repellat necessitatibus maxime accusamus? Eveniet, impedit? Adipisci nobis facere, tenetur quod dolorum reprehenderit ea aut neque, quo minus recusandae, qui ipsam. Eos, velit autem ipsam voluptatum excepturi nulla voluptatem quam laboriosam. Exercitationem, deleniti! Ratione consequuntur itaque animi dicta, cumque nobis. Quia?', 1, '2023-04-23', '2023-04-27'),
(3, 'User 1', 'Product 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia veniam iusto molestias quae sed animi nisi porro nulla est ab magni illo perferendis ipsa voluptate ea ullam sequi nesciunt distinctio, doloremque vero temporibus. Harum voluptate modi, vero iure amet voluptatem quas ad omnis cum minima distinctio laborum explicabo dignissimos consectetur quis atque mollitia aliquam asperiores tempora repellat necessitatibus maxime accusamus? Eveniet, impedit? Adipisci nobis facere, tenetur quod dolorum reprehenderit ea aut neque, quo minus recusandae, qui ipsam. Eos, velit autem ipsam voluptatum excepturi nulla voluptatem quam laboriosam. Exercitationem, deleniti! Ratione consequuntur itaque animi dicta, cumque nobis. Quia?', 3, '2023-04-22', '2023-04-30'),
(4, 'User 1', 'Product 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia veniam iusto molestias quae sed animi nisi porro nulla est ab magni illo perferendis ipsa voluptate ea ullam sequi nesciunt distinctio, doloremque vero temporibus. Harum voluptate modi, vero iure amet voluptatem quas ad omnis cum minima distinctio laborum explicabo dignissimos consectetur quis atque mollitia aliquam asperiores tempora repellat necessitatibus maxime accusamus? Eveniet, impedit? Adipisci nobis facere, tenetur quod dolorum reprehenderit ea aut neque, quo minus recusandae, qui ipsam. Eos, velit autem ipsam voluptatum excepturi nulla voluptatem quam laboriosam. Exercitationem, deleniti! Ratione consequuntur itaque animi dicta, cumque nobis. Quia?', 2, '2023-04-24', '2023-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(4) NOT NULL,
  `auctionId` int(4) NOT NULL,
  `bid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `auctionId`, `bid`) VALUES
(1, 1, 300),
(2, 1, 500),
(3, 2, 100),
(4, 4, 1200),
(5, 3 ,4200);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Home & Garden'),
(2, 'Electronics'),
(3, 'Fashion'),
(4, 'Sport'),
(5, 'Health'),
(6, 'Motors'),
(7, 'Households');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(4) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `reviewText` varchar(200) NOT NULL,
  `auctionId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `full_name`, `reviewText`, `auctionId`, `date`) VALUES
(1, 'User 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia', 1, '2023-04-25 14:15:06'),
(2, 'User 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia', 1, '2023-04-25 14:15:06'),
(3, 'User 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia', 2, '2023-04-25 14:15:06'),
(4, 'User 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia', 3, '2023-04-25 14:15:06'),
(5, 'User 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos omnis officia', 4, '2023-04-25 14:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'User 1', 'user1@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(2, 'User 2', 'user2@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
