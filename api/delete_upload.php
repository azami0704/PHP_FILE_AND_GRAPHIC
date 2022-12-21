<?php
include_once "../db/pdo.php";

$file = find('upload',$_GET['id']);

if(file_exists("../upload/".$file['file_name'])){
    unlink("../upload/".$file['file_name']);
    del('upload',$_GET['id']);
    header("location:../upload.php?delete=success");
}else{
    header("location:../upload.php?delete=fail");
}
?>