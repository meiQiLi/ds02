<?php
require_once 'string.func.php';
// header("content-type:text/html;charset=utf-8");
//print_r($_FILES);
/**
 * �����ϴ��ļ���Ϣ
 * @return array
 */
function buildInfo(){
    if (!$_FILES){
        return;
    }
	$i=0;
	foreach($_FILES as $v){
		//���ļ�
		if(is_string($v['name'])){
			$files[$i]=$v;
			$i++;
		}else{
			//���ļ�
			foreach($v['name'] as $key=>$val){
				$files[$i]['name']=$val;
				$files[$i]['size']=$v['size'][$key];
				$files[$i]['tmp_name']=$v['tmp_name'][$key];
				$files[$i]['error']=$v['error'][$key];
				$files[$i]['type']=$v['type'][$key];
				$i++;
			}
		}
	}
	return $files;
}

function uploadFile($path="uploads",$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=true){
    if (!file_exists($path)){
        mkdir($path,0777,true);
    }
    $i=0;
    $files=buildInfo();
    if (!($files&&is_array($files))){
        return ;
    }
    foreach ($files as $file){
        if ($file['error']===UPLOAD_ERR_OK){
            $ext=getExt($file['name']);
            //����ļ���չ��
            if (!in_array($ext, $allowExt)){
                exit("�Ƿ��ļ�����");
            }
            //����Ƿ���������ͼƬ����
            if ($imgFlag){
                if (!getimagesize($file['tmp_name'])){
                    exit("����������ͼƬ����");
                }
            }
            //����ϴ��ļ���С
            if ($file['size']>$maxSize){
                exit("�ϴ��ļ�����");
            }
            if (!is_uploaded_file($file['tmp_name'])){
                exit("����ͨ��HTTP POST��ʽ�ϴ���");
            }
            $filename=getUniName().".".$ext;
            $destination=$path."/".$filename;
            if (move_uploaded_file($file['tmp_name'], $destination)){
                $file['name']=$filename;
                unset($file['error'],$file['tmp_name'],$file['size'],$file['type']);
                $uploadedFiles[$i]=$file;
                $i++;
            }
        }else {
            switch ($file['$error']) {
                case 1:
                    $mes = "�����������ļ��ϴ��ļ��Ĵ�С"; // UPLOAD_ERR_INI_SIZE
                    break;
                case 2:
                    $mes = "�����˱������ϴ��ļ��Ĵ�С"; // UPLOAD_ERR_FORM_SIZE
                    break;
                case 3:
                    $mes = "�ļ����ֱ��ϴ�"; // UPLOAD_ERR_PARTIAL
                    break;
                case 4:
                    $mes = "û���ļ����ϴ�"; // UPLOAD_ERR_NO_FILE
                    break;
                case 6:
                    $mes = "û���ҵ���ʱĿ¼"; // UPLOAD_ERR_NO_TMP_DIR
                    break;
                case 7:
                    $mes = "�ļ�����д"; // UPLOAD_ERR_CANT_WRITE
                    break;
                case 8:
                    $mes = "����PHP����չ�����ж����ļ��ϴ�"; // UPLOAD_ERR_EXTENSION
                    break;
            }
            echo $mes;
        }
    }
    return $uploadedFiles;
}