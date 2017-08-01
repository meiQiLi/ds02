<?php
require_once '../lib/string.func.php';
require_once 'upload.func.php';
//print_r($_FILES);
foreach ($_FILES as $val){
    $mes=uploadFile($val);
    echo $mes;
}