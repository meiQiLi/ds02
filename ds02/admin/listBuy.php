<?php
require_once '../include.php';
checkLogined();
$sql="select u.username,p.pName,p.iPrice,b.num from food_pro p right join food_buy b on p.id=b.productid right join food_user u on u.id=b.userid where p.pName is not null";

$rows=fetchAll($sql);

if(!$rows){
	alertMes("sorry,没有订单!","index.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>订单</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">

                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">用户名称</th>
                                <th width="25%">商品名称</th>
                                <th width="25%">商品价格</th>
                                <th width="15%">商品数量</th>
                                <th>商品总计</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['username'];?></label></td>
                                <td><?php echo $row['pName'];?></td>
                                <td><?php echo $row['iPrice'];?></td>
                                <td><?php echo $row['num'];?></td>
                                <td><?php echo $row['num']*$row['iPrice']?>元</td>


                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
</body>

</html>
