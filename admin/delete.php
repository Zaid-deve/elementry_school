<?php 

session_start();
if(!isset($_SESSION['admin_id']))header("login.php?r=delete&bid=null")or die();
if(empty($_GET['bid']))die("Something Went Wrong !");

include "../db/db_conn.php";
$bid = htmlentities($_GET['bid']);
$qry = mysqli_query($conn,"DELETE FROM blogs WHERE bid = '{$bid}'");
header("Location:dashboard.php");


?>