<?php 
 
 require "../connection/conn.php";
 $id=$_GET['id'];
 $del="delete from admin where `admin_id`=$id";
 $conn->query($del);
 header("location:admin_list.php");


?>