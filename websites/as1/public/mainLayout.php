<?php
include 'databaseConnection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>ibuy - <?= $pageName ?></title>
    <link rel="stylesheet" href="ibuy.css" />
</head>

<body>
    <header>
        <h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

        <form action="#">
            <input type="text" name="search" placeholder="Search for anything" />
            <input type="submit" name="submit" value="Search" />
        </form>
    </header>
    <nav>
        <ul>
            <li><a class="categoryLink" href="index.php">Home</a></li>
            <li><a class="categoryLink" href="auctions.php">My Auctions</a></li>
            <?php
            if (!isset($_SESSION['auctionUser'])) {
                echo '<li><a class="categoryLink" href="login.php">Log In</a></li>';
                echo '<li><a class="categoryLink" href="register.php">Register</a></li>';
            } else {
                echo '<li><a class="categoryLink" href="logout.php">Log out</a></li>';
            }
            ?>
        </ul>
    </nav>
    <nav style="font-size: 12px;">
        <ul>
            <?php
            // executing all category data
            $categories = $databaseConnection->prepare('SELECT * FROM category');
            $categories->execute();
            $categories = $categories->fetchAll();
            foreach ($categories as $category) {
                echo '<li><a class="categoryLink" href="category.php?id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>
    <img src="banners/1.jpg" alt="Banner" />
    <main>