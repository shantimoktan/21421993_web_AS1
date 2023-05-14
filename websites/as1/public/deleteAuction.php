<?php
require 'databaseConnection.php';
if ($databaseConnection->query('DELETE FROM auction WHERE id = '. $_GET['id'])){
    header("Location: auctions.php?delete=auction");
}
?>