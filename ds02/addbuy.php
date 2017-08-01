 <?php
//Ԥ������
//1.���մ��ݹ�����post����
$productid=intval($_POST['productid']);
$num=intval($_POST['num']);
//2.׼��Ҫ��ӵ�Ԥ������
session_start();
$userid=$_SESSION['loginFlag'];//��ǰ��¼�û�������id
//����id�õ���Ʒ��Ϣ
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ds02","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $sql="select iPrice from food_pro where id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($productid));
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    $price=$data['iPrice'];
    $createtime=time();
    //3.���Ԥ�����ݵ���Ӳ���(�жϹ��ﳵ�����Ƿ��Ѿ��������Ʒ)
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



//4.����������ӵĽ��
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

















