<?php

$conn=mysqli_connect("localhost","root","","file_upload");
$id=$_GET['id'];
$sql="DELETE FROM `image` WHERE `id`='$id'";
$result=mysqli_query($conn,$sql);

if($result){
    header("location: index.php");
}




?>
