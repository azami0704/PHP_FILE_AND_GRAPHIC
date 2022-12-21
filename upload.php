<?php
include_once "./db/pdo.php";
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
if(isset($_GET['upload'])&&$_GET['upload']=='success'){
    echo "上傳成功";
}
if(isset($_GET['delete'])&&$_GET['delete']=='success'){
    echo "刪除成功";
}
if(isset($_GET['edit'])&&$_GET['edit']=='success'){
    echo "編輯成功";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->
<form action="./api/uploadapi.php" method="post" enctype="multipart/form-data">
    <ul>
        <li>描述:<input type="text" name="description"></li>
        <li>檔案:<input type="file" name="file_name"></li>
        <li><input type="submit" name="">上傳</li>
    </ul>
</form>

<div class="container">
    <div class="row">
    <ul class="file-list w-100">
    <li class="d-flex align-items-center border border-1 w-100 bg-primary text-white file-list">
                <div class="row-piece text-center"></div>
                <div class="row-piece text-center">檔名</div>
                <div class="row-piece text-center">描述</div>
                <div class="row-piece text-center">檔案類型</div>
                <div class="row-piece text-center">檔案大小</div>
                <div class="row-piece text-center">操作</div>
    </li>
<!----建立一個連結來查看上傳後的圖檔---->  
<?php
$file = all('upload');
if(count($file)>0){
    foreach($file as $item){
        if(isImg($item['type'])){
            $img_src = "./upload/{$item['file_name']}";
        }else {
            $img_src = "./upload/file.png";
        }
        $size = round(($item['size']/1024),2);
        // $img_src = "./upload/{$item['file_name']}";
        ?>
        <!-- <div class="col-3">
        <div class="card" >
        <img src="<?=$img_src?>" class="card-img-top img-fluid" alt="<?=$item['description']?>">
        <div class="card-body">
            <div>檔名:<?=$item['file_name']?></div>
            <div>描述:<?=$item['description']?></div>
            <div>檔案類型:<?=$item['type']?></div>
            <div>檔案大小:<?=$size?>MB</div>
        </div>
        </div>
        </div> -->
            
            <li class="d-flex align-items-center border border-1 w-100 file-list">
                <div class="row-piece"><img src="<?=$img_src?>" alt="<?=$item['description']?>" class="img-fluid"></div>
                <div class="row-piece text-center"><?=$item['file_name']?></div>
                <div class="row-piece text-center"><?=$item['description']?></div>
                <div class="row-piece text-center text-collapse"><?=$item['type']?></div>
                <div class="row-piece text-center"><?=$size?>KB</div>
                <div class="row-piece text-center">
                    <a class="btn btn-warning" href="./edit_form.php?id=<?=$item['id']?>">編輯</a>
                    <a class="btn btn-danger" href="./api/delete_upload.php?id=<?=$item['id']?>">刪除</a>
                </div>
            </li>
            
    <?php
    }
}else{
    echo "目前尚無資料";
}
?>
</ul>

</div>
</div>
</body>
</html>