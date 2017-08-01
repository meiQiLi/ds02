<?php
session_start();
//��ɶ����ݱ���޸Ĳ���
//1.���ղ���//2.�������
$productid=intval($_POST['productid']);
$num=intval($_POST['num']);
$userid=$_SESSION['loginFlag'];


//3.��ɸ��²���
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ds02","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sql="update food_buy set num=? where userid=? and productid=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($num,$userid,$productid));
    $rows=$stmt->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}

//4.���ؽ��
if ($rows){
    $response=array(
        'errno'  =>0,
        'errmsg' =>'success',
        'data'   =>true,
    );
}else {
    $response=array(
        'errno'  =>-1,
        'errmsg' =>'fail',
        'data'   =>false,
    );
}


echo json_encode($response);






