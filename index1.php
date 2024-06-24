<?php
require_once('classes/database.php');
session_start();

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if ($con->delete($id)) {
        header('location:index.php?status=success');
    }else{
        echo "Something went wrong.";
    }
}
 
?>