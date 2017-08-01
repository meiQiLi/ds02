<?php
require_once '../lib/string.func.php';
//�ϴ����ļ���Ϣ������$_FILES��
// print_r($_FILES);exit;
// $filename=$_FILES['myFile']['name'];
// $type=$_FILES['myFile']['type'];
// $tmp_name=$_FILES['myFile']['tmp_name'];
// $error=$_FILES['myFile']['error'];
// $size=$_FILES['myFile']['size'];

function uploadFile($fileInfo,$path = "uploads",$allowExt= array("gif","jpeg","jpg","png","wbmp"), $maxSize = 1048576,$imgFlag = true){
// $allowExt = array(
//         "gif",
//         "jpeg",
//         "jpg",
//         "png",
//         "wbmp"
//     );
//     $maxSize = 1048576; // 2M
//     $imgFlag = true;
    // �жϴ�����Ϣ
    if ($fileInfo['$error'] == UPLOAD_ERR_OK) {
        $ext = getExt($fileInfo['name']);
        // �ж��ϴ��ļ������Ƿ�������Χ��
        if (! in_array($ext, $allowExt)) {
            exit("�Ƿ��ļ�����");
        }
        if ($fileInfo['size'] > $maxSize) {
            exit("�ļ�����");
        }
        if ($imgFlag) {
            // ��֤�ϴ�ͼƬ�Ƿ���������ͼƬ����
            // getimagesize($filename);
            $info = getimagesize($fileInfo['tmp_name']);
            // var_dump($info);exit;
            if (! $info) {
                exit("����������ͼƬ����");
            }
        }
        // ��Ҫ�ж��ļ��Ƿ���ͨ��http post��ʽ�ϴ���
        // is_uploaded_file($tmp_name);

        $filename = getUniName() . "." . $ext;
        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $destination = $path . "/" . $filename;
        if (is_uploaded_file($fileInfo['tmp_name'])) {
            if (move_uploaded_file($fileInfo['tmp_name'], $destination)) {
                $mes = "�ļ��ϴ��ɹ�";
            } else {
                $mes = "�ļ��ƶ�ʧ��";
            }
        } else {
            $mes = "�ļ�����ͨ��http post��ʽ�ϴ���";
        }
    } else {
        switch ($fileInfo['$error']) {
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
    }
    return $mes;
}
