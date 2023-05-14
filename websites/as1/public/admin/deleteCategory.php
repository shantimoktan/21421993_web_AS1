<?php
require '../databaseConnection.php';
$databaseConnection->query('DELETE FROM auction WHERE categoryId = '. $_GET['id']);
if ($databaseConnection->query('DELETE FROM category WHERE id = '. $_GET['id'])){
    header("Location: adminCategories.php?delete=category");
}