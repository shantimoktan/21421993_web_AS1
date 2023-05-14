<?php
include '../databaseConnection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title> ibuy - <?= $pageName ?></title>
    <link rel="stylesheet" href="../ibuy.css" />
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
            <li><a class="categoryLink" href="adminCategories.php">Categories</a></li>
            <li><a class="categoryLink" href="manageAdmins.php">Admins</a></li>
            <li><a class="categoryLink" href="logout.php">Log out</a></li>
        </ul>
    </nav>
    <nav style="font-size: 12px;">
        <ul>
            <?php
            // executing all category data
            $category = $databaseConnection->prepare('SELECT * FROM category');
            $category->execute();
            $category = $category->fetchAll();
            foreach ($category as $categories) {
                echo '<li><a class="categoryLink" href="category.php?id=' . $categories['id'] . '">' . $categories['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>
    <img src="../banners/1.jpg" alt="Banner" />
    <main>