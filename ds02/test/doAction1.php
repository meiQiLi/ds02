<?php
require_once '../lib/string.func.php';
require_once 'upload.func.php';
$fileInfo=$_FILES['myFile'];
$info=uploadFile($fileInfo);
echo $info;