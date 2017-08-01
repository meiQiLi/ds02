<?php
session_start();
//1.���ղ������������
$productid=intval($_GET['productid']);
$userid=$_SESSION['loginFlag'];

//2.ɾ�����ݱ�
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ds02","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sql="delete from food_buy where productid=? and userid=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($productid,$userid));
    $rows=$stmt->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}

//3.���ش�����
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











