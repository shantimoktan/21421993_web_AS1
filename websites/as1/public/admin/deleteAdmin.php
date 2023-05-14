<?php
require '../databaseConnection.php';
if ($databaseConnection->query('DELETE FROM admins WHERE id = '. $_GET['id'])){
    header("Location: manageAdmins.php?delete=admin");
}
?>