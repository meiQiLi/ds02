<?php
//���һ������
function addCate(){
    $arr=$_POST;
    if (insert("food_cate", $arr)){
        $mes="������ӳɹ���<br/><a href='addCate.php'>�������</a>|<a href='listCate.php'>�鿴����</a>";
    }else {
        $mes="�������ʧ�ܣ�<br/><a href='addCate.php'>�������</a>|<a href='listCate.php'>�鿴����</a>";
    }
    return $mes;
}

//����ID�õ�ָ��������Ϣ
function getCateById($id){
    $sql="select id,cName from food_cate where id={$id}";
    return fetchOne($sql);
}

//�޸ķ���
function editCate($where){
    $arr=$_POST;
    if (update("food_cate", $arr,$where)){
        $mes="�����޸ĳɹ���<br/><a href='listCate.php'>�鿴����</a>";
    }else {
        $mes="�����޸�ʧ�ܣ�<br/><a href='listCate.php'>�����޸�</a>";
    }
    return $mes;
}

//ɾ������
function delCate($id){
    $res=checkProExist($id);
    if (!$res){
    $where="id=".$id;
    if(delete("food_cate",$where)){
        $mes="����ɾ���ɹ���<br/><a href='listCate.php'>�鿴����</a>|<a href='addCate.php'>��ӷ���</a>";
    }else {
        $mes="ɾ��ʧ�ܣ�<br/><a href='listCate.php'>�����²���</a>";
    }
    return $mes;
    }else {
        alertMes("����ɾ�����࣬����ɾ���÷����µ���Ʒ", "listPro.php");
    }
}

//�õ����з���
function getAllCate(){
    $sql="select id,cName from food_cate";
    $rows=fetchAll($sql);
    return $rows;
}













