<?php
function addAlbum($arr){
    insert("food_album", $arr);
}


//ͨ����Ʒid�õ���Ʒһ��ͼƬλ��
function getProImgById($id){
    $sql="select albumPath from food_album where pid={$id} limit 1";
    $row=fetchOne($sql);
    return $row;
}


//������Ʒid�õ�����ͼƬ
function getProImgsById($id){
    $sql="select albumPath from food_album where pid={$id}";
    $rows=fetchAll($sql);
    return $rows;
}


//ͼƬ����ˮӡ
function doWaterText($id){
    $rows=getProImgsById($id);
    foreach ($rows as $row){
        $filename="../image_350/".$row['albumPath'];
        waterText($filename);
    }
    $mes="�����ɹ�";
    return $mes;
}











