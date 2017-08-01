<?php
//�����Ʒ
function addPro(){
    $arr=$_POST;
    $arr['pubTime']=time();
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    if (is_array($uploadFiles)&&$uploadFiles){
        foreach ($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
            thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
            thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
            thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
        }
    }
    $res=insert("food_pro", $arr);
    $pid=getInsertId();
    if ($res&&$pid){
        foreach ($uploadFiles as $uploadFile){
            $arr1['pid']=$pid;
            $arr1['albumPath']=$uploadFile['name'];
            addAlbum($arr1);
        }
        $mes="<p>��ӳɹ���</p><a href='addPro.php' target='mainFrame'>�������</a>|<a href='listPro.php' target='mainFrame'>�鿴��Ʒ�б�</a>";
    }else {
        foreach ($uploadFiles as $uploadFile){
            if (file_exists("../image_800/".$uploadFile['name'])){
                unlink("../image_800/".$uploadFile['name']);
            }
            if (file_exists("../image_50/".$uploadFile['name'])){
                unlink("../image_50/".$uploadFile['name']);
            }
            if (file_exists("../image_220/".$uploadFile['name'])){
                unlink("../image_220/".$uploadFile['name']);
            }
            if (file_exists("../image_350/".$uploadFile['name'])){
                unlink("../image_350/".$uploadFile['name']);
            }
        }
        $mes="<p>���ʧ�ܣ�</p><a href='addPro.php' target='mainFrame'>�������</a>";
    }
    return $mes;
}


//�༭��Ʒ
function editPro($id){
    $arr=$_POST;
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    if (is_array($uploadFiles)&&$uploadFiles){
        foreach ($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
            thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
            thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
            thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
        }
    }
    $where="id={$id}";
    $res=update("food_pro", $arr,$where);
    $pid=$id;
    if ($res&&$pid){
        if ($uploadFiles&&is_array($uploadFiles)){
        foreach ($uploadFiles as $uploadFile){
            $arr1['pid']=$pid;
            $arr1['albumPath']=$uploadFile['name'];
            addAlbum($arr1);
        }
        }
        $mes="<p>�༭�ɹ���</p>|<a href='listPro.php' target='mainFrame'>�鿴��Ʒ�б�</a>";
    }else {
     if (is_array($uploadFiles)&&$uploadFiles){
        foreach ($uploadFiles as $uploadFile){
            if (file_exists("../image_800/".$uploadFile['name'])){
                unlink("../image_800/".$uploadFile['name']);
            }
            if (file_exists("../image_50/".$uploadFile['name'])){
                unlink("../image_50/".$uploadFile['name']);
            }
            if (file_exists("../image_220/".$uploadFile['name'])){
                unlink("../image_220/".$uploadFile['name']);
            }
            if (file_exists("../image_350/".$uploadFile['name'])){
                unlink("../image_350/".$uploadFile['name']);
            }
        }
     }
        $mes="<p>�༭ʧ�ܣ�</p><a href='listPro.php' target='mainFrame'>���±༭</a>";
    }
    return $mes;
}


//ɾ����Ʒ
function delPro($id){
    $where="id=$id";
    $res=delete("food_pro",$where);
    $proImgs=getAllImgByProId($id);
    if ($proImgs&&is_array($proImgs)){
        foreach ($proImgs as $proImg){
            if (file_exists("uploads/".$proImg['albumPath'])){
                unlink("uploads/".$proImg['albumPath']);
            }
            if (file_exists("../image_50/".$proImg['albumPath'])){
                unlink("../image_50/".$proImg['albumPath']);
            }
            if (file_exists("../image_220/".$proImg['albumPath'])){
                unlink("../image_220/".$proImg['albumPath']);
            }
            if (file_exists("../image_350/".$proImg['albumPath'])){
                unlink("../image_350/".$proImg['albumPath']);
            }
            if (file_exists("../image_800/".$proImg['albumPath'])){
                unlink("../image_800/".$proImg['albumPath']);
            }
        }
    }
    $where1="pid={$id}";
    $res1=delete("food_album",$where1);
    if ($res&&$res1){
        $mes="ɾ���ɹ���<br/><a href='listPro.php' target='mainFrame'>�鿴��Ʒ�б�</a>";
    }else {
        $mes="ɾ��ʧ�ܣ�<br/><a href='listPro.php' target='mainFrame'>����ɾ��</a>";
    }
    return $mes;
}




//�õ�������Ʒ��Ϣ
function getAllProByAdmin(){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from food_pro as p join food_cate c on p.cId=c.id";
    $rows=fetchAll($sql);
    return $rows;
}


//������Ʒid�õ���Ʒ��Ӧ��Ϣ
function getAllImgByProId($id){
   $sql="select a.albumPath from food_album a where pid={$id}";
   $rows=fetchAll($sql);
   return $rows;
}


//����id�õ���Ʒ��Ϣ
function getProById($id){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from food_pro as p join food_cate c on p.cId=c.id where p.id={$id}";
    $row=fetchOne($sql);
    return $row;
}


//����cid���˷������Ƿ�����Ʒ
function checkProExist($cid){
    $sql="select * from food_pro where cId={$cid}";
    $rows=fetchAll($sql);
    return $rows;
}


//�õ�������Ʒ
function getAllPros(){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from food_pro as p join food_cate c on p.cId=c.id";
    $rows=fetchAll($sql);
    return $rows;
}


//����cid�õ������µ���Ʒ
function getProByCid($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from food_pro as p join food_cate c on p.cId=c.id where p.cId={$cid} limit 4";
    $rows=fetchAll($sql);
    return $rows;
}


//�õ������µ�С��Ʒ
function getSmallProsByCid($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from food_pro as p join food_cate c on p.cId=c.id where p.cId={$cid} limit 4,4";
    $rows=fetchAll($sql);
    return $rows;
}


//�õ���Ʒid����Ʒ����
function getProInfo(){
    $sql="select id,pName from food_pro order by id asc";
    $rows=fetchAll($sql);
    return $rows;
}














