<?php
//����Ƿ��й���Ա
function checkAdmin($sql){
   return fetchOne($sql);
}

//����Ƿ��й���Ա��¼
function checkLogined(){
    if($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
        alertMes("���ȵ�¼", "login.php");
    }
}

//��ӹ���Ա
function addAdmin(){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if (insert("food_admin", $arr)){
        $mes="��ӳɹ���<br/><a href='addAdmin.php'>�������</a>|<a href='listAdmin.php'>�鿴����Ա�б�</a>";
    }else {
        $mes="���ʧ�ܣ�<br/><a href='addAdmin.php'>�������</a>";
    }
    return $mes;
}

//�õ����й���Ա
function getAllAdmin(){
    $sql="select id,username,email from food_admin";
    $rows=fetchAll($sql);
    return $rows;
}

function getAdminByPage($pageSize=2){
    $sql="select * from food_admin";
    global $totalRows;
    $totalRows=getResultNum($sql);
    global $totalPage;
    global $page;
    //echo $totalRows;
//     $pageSize=2;
    //�õ���ҳ����
    $totalPage=ceil($totalRows/$pageSize);
    //$pageSize=2;
    $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if ($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,username,email from food_admin limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    return $rows;
}

//�༭����Ա
function editAdmin($id){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if (update("food_admin", $arr,"id={$id}")){
        $mes="�༭�ɹ���<br/><a href='listAdmin.php'>�鿴����Ա�б�</a>";
    }else {
        $mes="�༭ʧ�ܣ�<br/><a href='listAdmin.php'>�������޸�</a>";
    }
    return $mes;
}

//ɾ������Ա
function delAdmin($id){
    if (delete("food_admin","id={$id}")){
        $mes="ɾ���ɹ���<br/><a href='listAdmin.php'>�鿴����Ա�б�</a>";
    }else {
        $mes="ɾ��ʧ�ܣ�<br/><a href='listAdmin.php'>������ɾ��</a>";
    }
    return $mes;
}

//ע������Ա
function logout(){
  $_SESSION=array();
  if (isset($_COOKIE[session_name()])){
      setcookie(session_name(),"",time()-1);
  }
  if(isset($_COOKIE['adminId'])){
      setcookie("adminId","",time()-1);
  }
  if(isset($_COOKIE['adminName'])){
      setcookie("adminName","",time()-1);
  }
  session_destroy();
  header("location:login.php");
}


//����û�
function addUser(){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    $arr['regTime']=time();
    $uploadFile=uploadFile("../uploads");

    if($uploadFile&&is_array($uploadFile)){
        $arr['face']=$uploadFile[0]['name'];
    }else{
        return "���ʧ��<a href='addUser.php'>�������</a>";
    }

    if(insert("food_user", $arr)){
        $mes="��ӳɹ�!<br/><a href='addUser.php'>�������</a>|<a href='listUser.php'>�鿴�б�</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes="���ʧ��!<br/><a href='addUser.php'>�������</a>|<a href='listUser.php'>�鿴�б�</a>";
    }
    return $mes;
}


/**
 * ɾ���û��Ĳ���
 * @param int $id
 * @return string
 */
function delUser($id){
    $sql="select face from food_user where id=".$id;
    $row=fetchOne($sql);
    $face=$row['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/".$face);
    }
    if(delete("food_user","id={$id}")){
        $mes="ɾ���ɹ�!<br/><a href='listUser.php'>�鿴�û��б�</a>";
    }else{
        $mes="ɾ��ʧ��!<br/><a href='listUser.php'>������ɾ��</a>";
    }
    return $mes;
}
/**
 * �༭�û��Ĳ���
 * @param int $id
 * @return string
 */
function editUser($id){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if(update("food_user", $arr,"id={$id}")){
        $mes="�༭�ɹ�!<br/><a href='listUser.php'>�鿴�û��б�</a>";
    }else{
        $mes="�༭ʧ��!<br/><a href='listUser.php'>�������޸�</a>";
    }
    return $mes;
}

















