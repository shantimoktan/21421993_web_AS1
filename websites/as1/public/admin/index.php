<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
$pageName = 'Admin Home';
include 'mainLayout.php';

// executing all auction data
$auctions = $databaseConnection->prepare('SELECT * FROM auction');
$auctions->execute();
$auctions = $auctions->fetchAll();
echo '<h1>All Listings</h1>';
foreach ($auctions as $auction) {
    // executing max price of auction according to auction id
    $maxBidPrice = $databaseConnection->prepare('SELECT auctionId, MAX(bid) AS max_price FROM bids WHERE auctionId = ' . $auction['id']);
    $maxBidPrice->execute();
    $bidPrice = $maxBidPrice->fetch();

    // executing category data according to auction id
    $categories = $databaseConnection->prepare('SELECT * FROM `category` WHERE id = ' . $auction['categoryId']);
    $categories->execute();
    $categories = $categories->fetch();
?>
    <ul class="productList">

        <li>
            <img src="../product.png" alt="product name">
            <article>
                <!-- displaying auctions -->
                <h2><?= $auction['title'] ?></h2>
                <h3><?= $categories['name'] ?></h3>
                <p><?= $auction['description'] ?></p>
                <!-- displaying maximum price of auction-->
                <p class="price">Current bid: £<?= ($bidPrice['auctionId'] == $auction['id']) ? $bidPrice['max_price'] : '' ?></p>
                <!-- link for more description of auction -->
                <a href="auction.php?id=<?= $auction['id'] ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
    </ul>
    <hr />
<?php
}
require '../footerLayout.php';
?>