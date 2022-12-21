<?php
include_once "../db/pdo.php";

if(isset($_POST['id'])){
    if(!empty($_FILES['file_name']['name'])){
        print_r($_FILES);
        $file = find('upload',$_POST['id']);
        // $fileName = explode(".",$file['file_name'])[0];
        // $substr  = explode(".",$_FILES['file_name']['name']);
        // $sub = array_pop($substr);
        // echo $fileName;

        //若有更新圖片,就把舊的移到delete資料夾&新增一個新的檔案
        $file_str_array = explode(".",$_FILES['file_name']['name']);
        $sub = array_pop($file_str_array);
        $file_name = date('Ymdhis').'.'.$sub;
        rename("../upload/{$file['file_name']}","../delete/{$file['file_name']}");
        move_uploaded_file($_FILES['file_name']['tmp_name'],"../upload/".$file_name);
        $description = $_POST['description'];
        $size = $_FILES['file_name']['size'];
        $type = $_FILES['file_name']['type'];
        
        update('upload',['file_name'=>$file_name,
                        'type'=>$type,
                        'size'=>$size,
                        'description'=>$description
                        ],$_POST['id']);
                        $status ="success";
    }else{
        $description =  $_POST['description'];
        update('upload',['description'=>$description],$_POST['id']);
        $status ="success";
    }
}else{
    echo "資料有誤請確認";
    $status ="fail";
}
header("location:../upload.php?edit={$status}");
?>