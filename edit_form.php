<?php
include_once "./db/pdo.php";
$item = find('upload',$_GET['id']);
// print_r($item);
?>

<div class="container news">
<h1 class="news-title">檔案編輯</h1>
<form action="./api/editApi.php" method="post" class="news-form" enctype="multipart/form-data">
<?php
// foreach($rows as $item){
?>
<input type="hidden" name="id" value=<?=$item['id']?>>
<div class="form-group">
    <label for="title" class="title">檔案名稱</label>
    <div><?=$item['file_name']?></div>
</div>
<div class="form-group">
    <label for="description" class="title">描述</label>
    <textarea name="description" id="description" rows="15"><?=$item['description']?></textarea>
</div>
<div class="form-group">
    <label for="type" class="title">檔案格式</label>
    <div><?=$item['type']?></div>
</div>
<div>
    <a href="./upload/<?=$item['file_name']?>">
    <img src="./upload/<?=$item['file_name']?>" alt=""></a>
    重新上傳檔案:
    <input type="file" name="file_name">
</div>
<div class="form-btn">
            <input type="submit" value="確認修改" class="btn btn-attention">
            <input type="reset" value="重置修改" class="btn btn-main">
        </div>
        <?php
    // }
    ?>
</form>
</div>