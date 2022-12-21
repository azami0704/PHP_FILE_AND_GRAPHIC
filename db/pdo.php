<?php
session_start();
date_default_timezone_set("Asia/Taipei");
$db = "mysql:local=localhost;charset=utf8;dbname=file";
$pdo =new PDO($db,'root','');
// $db = "mysql:local=localhost;charset=utf8;dbname=s1110420";
// $pdo =new PDO($db,'s1110420','s1110420');


//function區
function all($table,...$args){
    global $pdo;
    $sql="select * from $table ";

    if(isset($args[0])){
        if(is_array($args[0])){
            //是陣列 ['acc'=>'mack','pw'=>'1234'];
            //是陣列 ['product'=>'PC','price'=>'10000'];
            $tmp=[];
            foreach($args[0] as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql=$sql ." WHERE ". join(" && " ,$tmp);
        }else{
            //是字串
            $sql=$sql . $args[0];
        }
    }

    if(isset($args[1])){
        $sql = $sql . $args[1];
    }

    //echo $sql;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

//傳回指定id的資料
                    //['acc'=>'mack','pw'=>1234];
                    // 1,200,312
function find($table,$id){
    global $pdo;
    $sql="select * from `$table` ";

    if(is_array($id)){
        foreach($id as $key => $value){
            $tmp[]="`$key`='$value'";
        }

        $sql = $sql . " where " . join(" && ",$tmp);

    }else{

        $sql=$sql . " where `id`='$id'";
    }
    //echo $sql;
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

//給定條件更新資料(多筆或單筆)
function update($table,$col,...$args){
    global $pdo;

    $sql="update $table set ";

    if(is_array($col)){
        foreach($col as $key => $value){
            $tmp[]="`$key`='$value'";
        }

        $sql = $sql .  join(",",$tmp);

    }else{
        echo "錯誤,請提供以陣列型式的更新資料";
    }

    if(isset($args[0])){
        if(is_array($args[0])){
            $tmp=[];
            foreach($args[0] as $key => $value){
                $tmp[]="`$key`='$value'";
            }
    
            $sql = $sql . " where " . join(" && ",$tmp);
    
        }else{
    
            $sql=$sql . " where `id`='{$args[0]}'";
        }
    }


   // echo $sql;
    //$t=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    //$t=$pdo->exec($sql);
    
    return $pdo->exec($sql);
}


//新增資料
/**
 * `['school_num'=>'911799',
 *  'class_code'=>'101',
 *  'seat_num'=>51,
 *  'year'=>2000]`
 */
function insert($table,$cols){
    global $pdo;

    $keys=array_keys($cols);
    //dd(join("','",$cols));

    $sql="insert into $table (`" . join("`,`",$keys) . "`) values('" . join("','",$cols) . "')";
    //$sql="insert into $table (`";
    //$sql=$sql . join("`,`",$keys);
    //$sql=$sql . "`) values('";
    //$sql=$sql . join("','",$cols);
    //$sql=$sql . "')";

    // echo $sql;
    return $pdo->exec($sql);
}

//刪除資料
function del($table,$id){
    global $pdo;
    $sql="delete from `$table` ";

    if(is_array($id)){
        foreach($id as $key => $value){
            $tmp[]="`$key`='$value'";
        }

        $sql = $sql . " where " . join(" && ",$tmp);

    }else{

        $sql=$sql . " where `id`='$id'";
    }

    //echo $sql;
    return $pdo->exec($sql);
}

//萬用sql函式
function q($sql){
    global $pdo;
    //echo $sql;
    return $pdo->query($sql)->fetchAll();
}

//判斷是否為img
function isImg($type) {
    $fileType = explode("/",$type)[1];
    switch($fileType){
        case "gif":
        case "jpeg":
        case "png":
            return true;
        break;
        default:
            return false;
        break;
    }
}

?>