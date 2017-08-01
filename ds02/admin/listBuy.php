<?php
require_once '../include.php';
checkLogined();
$sql="select u.username,p.pName,p.iPrice,b.num from food_pro p right join food_buy b on p.id=b.productid right join food_user u on u.id=b.userid where p.pName is not null";

$rows=fetchAll($sql);

if(!$rows){
	alertMes("sorry,û�ж���!","index.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>����</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">

                    <!--���-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">�û�����</th>
                                <th width="25%">��Ʒ����</th>
                                <th width="25%">��Ʒ�۸�</th>
                                <th width="15%">��Ʒ����</th>
                                <th>��Ʒ�ܼ�</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--�����id��for�����c1 ��Ҫѭ������-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['username'];?></label></td>
                                <td><?php echo $row['pName'];?></td>
                                <td><?php echo $row['iPrice'];?></td>
                                <td><?php echo $row['num'];?></td>
                                <td><?php echo $row['num']*$row['iPrice']?>Ԫ</td>


                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
</body>

</html>
