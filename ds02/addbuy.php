 <?php
//预定操作
//1.接收传递过来的post参数
$productid=intval($_POST['productid']);
$num=intval($_POST['num']);
//2.准备要添加的预定数据
session_start();
$userid=$_SESSION['loginFlag'];//当前登录用户的主键id
//根据id得到商品信息
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ds02","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sql="select iPrice from food_pro where id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($productid));
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    $price=$data['iPrice'];
    $createtime=time();
    //3.完成预定数据的添加操作(判断购物车当中是否已经加入该商品)
    $sql="select * from food_buy where productid=? and userid=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($productid,$userid));
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    if ($data){
        $sql="update food_buy set num=num+? where userid=? and productid=?";
        $params=array($num,$userid,$productid);
    }else {
        $sql="insert into food_buy(productid,num,userid,price,createtime) values(?,?,?,?,?)";
        $params=array($productid,$num,$userid,$price,$createtime);
    }


    $stmt2=$pdo->prepare($sql);
    $stmt2->execute($params);
    $rows=$stmt2->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}



//4.返回最终添加的结果
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

















