<?php
function reg(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	$arr['regTime']=time();
	$uploadFile=uploadFile();

	//print_r($uploadFile);
	if($uploadFile&&is_array($uploadFile)){
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "ע��ʧ��";
	}
//	print_r($arr);exit;
	if(insert("food_user", $arr)){
		$mes="ע��ɹ�!<br/>3���Ӻ���ת����½ҳ��!<meta http-equiv='refresh' content='3;url=login.php'/>";
	}else{
		$filename="uploads/".$uploadFile[0]['name'];
		if(file_exists($filename)){
			unlink($filename);
		}
		$mes="ע��ʧ��!<br/><a href='reg.php'>����ע��</a>|<a href='index.php'>�鿴��ҳ</a>";
	}
	return $mes;
}
function login(){
	$username=$_POST['username'];
	//addslashes():ʹ�÷�б�����������ַ�
	//$username=addslashes($username);
	$username=mysql_escape_string($username);
	$password=md5($_POST['password']);
	$sql="select * from food_user where username='{$username}' and password='{$password}'";
	//$resNum=getResultNum($sql);
	$row=fetchOne($sql);
	//echo $resNum;
	if($row){
		$_SESSION['loginFlag']=$row['id'];
		$_SESSION['username']=$row['username'];
		$mes="��½�ɹ���<br/>3���Ӻ���ת����ҳ<meta http-equiv='refresh' content='3;url=index.php'/>";
	}else{
		$mes="��½ʧ�ܣ�<a href='login.php'>���µ�½</a>";
	}
	return $mes;
}

function userOut(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}

	session_destroy();
	header("location:index.php");
}



