<?php
require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,username,password,email,sex from food_user where id='{$id}'";
$row=fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
<title>Insert title here</title>
</head>
<body>
<h3>�༭�û�</h3>
<form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">�û���</td>
		<td><input type="text" name="username" placeholder="<?php echo $row['username'];?>"/></td>
	</tr>
	<tr>
		<td align="right">����</td>
		<td><input type="password" name="password"/></td>
	</tr>
	<tr>
		<td align="right">����</td>
		<td><input type="text" name="email" placeholder="<?php echo $row['email'];?>"/></td>

	</tr>
	<tr>
		<td align="right">�Ա�</td>
		<td><input type="radio" name="sex" value="1"  <?php echo $row['sex']=="��"?"checked='checked'":null;?>/>��
		<input type="radio" name="sex" value="2" <?php echo $row['sex']=="Ů"?"checked='checked'":null;?>/>Ů
		<input type="radio" name="sex" value="3" <?php echo $row['sex']=="����"?"checked='checked'":null;?>/>����
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="�༭�û�"/></td>
	</tr>

</table>
</form>
</body>
</html>
