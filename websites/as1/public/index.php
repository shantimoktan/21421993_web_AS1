<?php
session_start();
$pageName = 'Home';
include 'mainLayout.php';
echo '<h1>Latest Auctions Listed</h1>';
// latest 10 auctions data
$latestAuctions = $databaseConnection->prepare('SELECT * FROM `auction` ORDER BY created_on DESC LIMIT 10');
$latestAuctions->execute();
$auctions = $latestAuctions->fetchAll();

foreach ($auctions as $auction) {
    // executing category data according to auction id
    $categories = $databaseConnection->prepare('SELECT * FROM `category` WHERE id = ' . $auction['categoryId']);
    $categories->execute();
    $categories = $categories->fetch();

    // executing max price of auction according to auction id
    $maxBidPrice = $databaseConnection->prepare('SELECT auctionId, MAX(bid) AS max_price FROM bids WHERE auctionId = ' . $auction['id']);
    $maxBidPrice->execute();
    $bidPrice = $maxBidPrice->fetch();
?>
    <ul class="productList">
        <li>
            <img src="product.png" alt="<?= $auction['title']?>">
            <article>
                <!-- displaying auctions -->
                <h2><?= $auction['title'] ?></h2>
                <h3><?= $categories['name'] ?></h3>
                <p><?= $auction['description'] ?></p>
                <!-- displaying maximum price of auction-->
                <p class="price">Current bid: £<?=($bidPrice['auctionId'] == $auction['id']) ? $bidPrice['max_price'] : ''?></p>
                <!-- link for more description of auction -->
                <a href="auction.php?id=<?= $auction['id'] ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
    </ul>
    <hr />
<?php
}
include 'footerLayout.php';
?>