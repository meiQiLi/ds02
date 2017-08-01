<?php
function addAlbum($arr){
    insert("food_album", $arr);
}


//通过商品id得到商品一张图片位置
function getProImgById($id){
    $sql="select albumPath from food_album where pid={$id} limit 1";
    $row=fetchOne($sql);
    return $row;
}


//根据商品id得到所有图片
function getProImgsById($id){
    $sql="select albumPath from food_album where pid={$id}";
    $rows=fetchAll($sql);
    return $rows;
}


//图片文字水印
function doWaterText($id){
    $rows=getProImgsById($id);
    foreach ($rows as $row){
        $filename="../image_350/".$row['albumPath'];
        waterText($filename);
    }
    $mes="操作成功";
    return $mes;
}











