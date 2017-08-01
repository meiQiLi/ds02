<?php
require_once '../include.php';
checkLogined();
$sql="select id,username,email from food_user";
$rows=fetchAll($sql);
if(!$rows){
	alertMes("sorry,û���û�,�����!","addUser.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="��&nbsp;&nbsp;��" class="add"  onclick="addUser()">
                        </div>

                    </div>
                    <!--���-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">���</th>
                                <th width="25%">�û�����</th>
                                <th width="25%">�û�����</th>
                                <th>����</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--�����id��for�����c1 ��Ҫѭ������-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['email'];?></td>

                                <td align="center"><input type="button" value="�޸�" class="btn" onclick="editUser(<?php echo $row['id'];?>)"><input type="button" value="ɾ��" class="btn"  onclick="delUser(<?php echo $row['id'];?>)"></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
</body>
<script type="text/javascript">

	function addUser(){
		window.location="addUser.php";
	}
	function editUser(id){
			window.location="editUser.php?id="+id;
	}
	function delUser(id){
			if(window.confirm("��ȷ��Ҫɾ����ɾ��֮�󲻿��Իָ�Ŷ������")){
				window.location="doAdminAction.php?act=delUser&id="+id;
			}
	}
</script>
</html>
