<?php
//将该用户下的所有购物车数据删除
session_start();
$userid=$_SESSION['loginFlag'];
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ds02","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sql="delete from food_buy where userid=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($userid));
    $rows=$stmt->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}

if ($rows){
    $response=array(
        'errno'  =>0,
        'errmsg' =>'success',
        'data'   =>true
    );
}else {
    $response=array(
        'errno'  =>-1,
        'errmsg' =>'fail',
        'data'   =>false
    );
}

echo json_encode($response);