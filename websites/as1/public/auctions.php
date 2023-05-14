<?php
session_start();
if (!isset($_SESSION['auctionUser'])) {
    header("Location: login.php");
}
$pageName = 'Auctions';
include 'mainLayout.php';

// executing all auctions data
$auctions = $databaseConnection->prepare('SELECT * FROM auction');
$auctions->execute();
$auctions = $auctions->fetchAll();
?>
<main>
    <a style="float:right; font-size:20px; padding: 20px;" href='addAuction.php'>Add New Auction</a>
    <h1>My Auctions</h1>
    <?php
    foreach ($auctions as $auction) {
        // executing category data according to auction id
        $category = $databaseConnection->prepare('SELECT * FROM category WHERE id = ' . $auction['categoryId']);
        $category->execute();
        $category = $category->fetch();

        // executing max price of auction according to auction id
        $maxPrice = $databaseConnection->prepare('SELECT auctionId, MAX(bid) AS max_price FROM bids WHERE auctionId = ' . $auction['id']);
        $maxPrice->execute();
        $maxPrice = $maxPrice->fetch();

        // auctions of logged in user shown
        if ($auction['full_name'] == $_SESSION['auctionUser']) {
    ?>
            <ul class="productList">

                <li>
                    <img src="product.png" alt="product name">
                    <article>
                        <!-- displaying auctions -->
                        <h2><?= $auction['title'] ?></h2>
                        <h3><?= $category['name'] ?></h3>
                        <p><?= $auction['description'] ?></p>
                        <!-- displaying maximum price of the product -->
                        <p class="price">Current bid: £<?= ($maxPrice['auctionId'] == $auction['id']) ? $maxPrice['max_price'] : '' ?></p>
                        <!-- editing auction link -->
                        <p><a href="editAuction.php?id=<?php echo $auction['id']; ?>">Edit</a></p>
                        <!-- deleting auction link -->
                        <p><a href="deleteAuction.php?id=<?php echo $auction['id']; ?>">Delete</a></p>
                        <a href="auction.php?id=<?= $auction['id'] ?>" class="more auctionLink">More &gt;&gt;</a>

                    </article>
                </li>
            </ul>

            <hr />
    <?php
        }
    }
    include 'footerLayout.php';
    ?>