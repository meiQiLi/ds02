<?php
require_once '../include.php';
checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.pName like '%{$keywords}%'":null;
//�õ����ݿ���������Ʒ
$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from food_pro as p join food_cate c on p.cId=c.id {$where}  ";
$totalRows=getResultNum($sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from food_pro as p join food_cate c on p.cId=c.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
//print_r($rows);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="��&nbsp;&nbsp;��" class="add" onclick="addPro()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>��Ʒ�۸�</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-��ѡ��-</option>
                                        <option value="iPrice asc" >�ɵ͵���</option>
                                        <option value="iPrice desc">�ɸߵ���</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>�ϼ�ʱ�䣺</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-��ѡ��-</option>
                                        <option value="pubTime desc" >���·���</option>
                                        <option value="pubTime asc">��ʷ����</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>����</span>
                                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                            </div>
                        </div>
                    </div>
                    <!--���-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">���</th>
                                <th width="20%">��Ʒ����</th>
                                <th width="10%">��Ʒ����</th>
                                <th width="10%">�Ƿ��ϼ�</th>
                                <th width="15%">�ϼ�ʱ��</th>
                                <th width="10%">����۸�</th>
                                <th>����</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach ($rows as $row):?>
                            <tr>
                                <!--�����id��for�����c1 ��Ҫѭ������-->
                                <td><input type="checkbox" id="c<?php echo $row['id'];?>" class="check" value=<?php echo $row['id'];?>><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['pName'];?></td>
                                <td><?php echo $row['cName'];?></td>
                                <td>
                                  <?php echo $row['isShow']==1?"�ϼ�":"�¼�";?>
                                </td>
                                 <td><?php echo date("Y-m-d H:i:s",$row['pubTime']);?></td>
                                  <td><?php echo $row['iPrice'];?>Ԫ</td>
                                <td align="center">
                                				<input type="button" value="����" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['pName'];?>')"><input type="button" value="�޸�" class="btn" onclick="editPro(<?php echo $row['id'];?>)"><input type="button" value="ɾ��" class="btn"onclick="delPro(<?php echo $row['id'];?>)">
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">
					                        		<tr>
					                        			<td width="20%" align="right">��Ʒ����</td>
					                        			<td><?php echo $row['pName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">��Ʒ���</td>
					                        			<td><?php echo $row['cName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">��Ʒ����</td>
					                        			<td><?php echo $row['pSn'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">��Ʒ����</td>
					                        			<td><?php echo $row['pNum'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">��Ʒ�۸�</td>
					                        			<td><?php echo $row['mPrice'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">����۸�</td>
					                        			<td><?php echo $row['iPrice'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">��ƷͼƬ</td>
					                        			<td>
                                                      	<?php
					                        			$proImgs=getAllImgByProId($row['id']);
					                        			foreach($proImgs as $img):
					                        			?>
					                        			<img width="100" height="100" src="uploads/<?php echo $img['albumPath'];?>" alt=""/> &nbsp;&nbsp;
                                                        <?php endforeach;?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">�Ƿ��ϼ�</td>
					                        			<td>
                                                           <?php echo $row['isShow']==1?"�ϼ�":"�¼�";?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">�Ƿ�����</td>
					                        			<td>
                                                          <?php echo $row['isHot']==1?"����":"����";?>
					                        			</td>
					                        		</tr>
					                        	</table>
					                        	<span style="display:block;width:80%; ">
					                        	��Ʒ����<br/>
                                                <?php echo $row['pDesc'];?>
					                        	</span>
					                        </div>

                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//�Ƿ�ģʽ�Ի���
	      draggable:true,//�Ƿ�������ק
	      resizable:true,//�Ƿ������϶�
	      title:"��Ʒ���ƣ�"+t,//�Ի������
	      show:"slide",
	      hide:"explode"
	});
}
	function addPro(){
		window.location='addPro.php';
	}
	function editPro(id){
		window.location='editPro.php?id='+id;
	}
	function delPro(id){
		if(window.confirm("��ȷ��Ҫɾ������һ�β��ף���ɾ����ϧ!")){
			window.location="doAdminAction.php?act=delPro&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listPro.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>