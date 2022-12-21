<?php
include_once "../db/pdo.php";
if($_FILES['file_name']['error']==0){
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    //整理檔案名稱(這邊以上傳時間命名)
    $file_str_array = explode(".",$_FILES['file_name']['name']);
    $sub = array_pop($file_str_array);
    $file_name = date('Ymdhis').'.'.$sub;
    move_uploaded_file($_FILES['file_name']['tmp_name'],"../upload/".$file_name);

    // move_uploaded_file($_FILES['file_name']['tmp_name'],"../upload/".$_FILES['file_name']['name']);
    $description = $_POST['description'];
    $size = $_FILES['file_name']['size'];
    $type = $_FILES['file_name']['type'];
    
    //新增資料表資料
    insert("upload",['file_name'=>$file_name,
                     'type'=>$type,
                     'size'=>$size,
                     'description'=>$description
                    ]);
    // header("location:../upload.php?upload=success");
}else{
    echo "上傳失敗，請聯絡網站管理員";
}



?>