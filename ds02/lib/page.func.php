<?php
// require_once '../include.php';
// $sql="select * from food_admin";
// $totalRows=getResultNum($sql);
// //echo $totalRows;
// $pageSize=2;
// //�õ���ҳ����
// $totalPage=ceil($totalRows/$pageSize);
// $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
// if($page<1||$page==null||!is_numeric($page)){
//     $page=1;
// }
// if ($page>=$totalPage)$page=$totalPage;
// $offset=($page-1)*$pageSize;
// $sql="select * from food_admin limit {$offset},{$pageSize}";
// $rows=fetchAll($sql);
// //print_r($rows);
// foreach ($rows as $row){
//     echo "��ţ�".$row['id'],"<br/>";
//     echo "����Ա�����ƣ�".$row['username'],"<hr/>";
// }
// echo showPage($page, $totalPage);
// echo "<hr/>";
// echo showPage($page, $totalPage,"cid=5&pid=6");
function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
    $where=($where==null)?null:"&".$where;
    $url = $_SERVER['PHP_SELF'];
    $index = ($page == 1) ? "��ҳ" : "<a href='{$url}?page=1{$where}'>��ҳ</a>";
    $last = ($page == $totalPage) ? "βҳ" : "<a href='{$url}?page={$totalPage}{$where}'>βҳ</a>";
    $prev = ($page == 1) ? "��һҳ" : "<a href='{$url}?page=" . ($page - 1) . "{$where}'>��һҳ</a>";
    $next = ($page == $totalPage) ? "��һҳ" : "<a href='{$url}?page=" . ($page + 1) . "{$where}'>��һҳ</a>";
    $str = "�ܹ�($totalPage)ҳ/��ǰ�ǵ�($page)ҳ";
    for ($i = 1; $i <= $totalPage; $i ++) {
        // ��ǰҳ������
        if ($page == $i) {
            $p .= "[{$i}]";
        } else {
            $p .= "<a href='{$url}?page={$i}'>[{$i}]</a>";
        }
    }
    $pageStr=$str.$sep . $index.$sep . $prev .$sep. $p .$sep. $next .$sep. $last;
    return $pageStr;
}