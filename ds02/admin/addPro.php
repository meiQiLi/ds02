<?php
require_once '../include.php';
checkLogined();
$rows=getAllCate();
// print_r($rows);
if(!$rows){
	alertMes("û����Ӧ���࣬������ӷ���!!", "addCate.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="gbk">
<title>-.-</title>
<link href="styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="gbk" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="gbk" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="ɾ������">ɾ��</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>�����Ʒ</h3>
<form action="doAdminAction.php?act=addPro" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#c9e4fe">
	<tr>
		<td align="right">��Ʒ����</td>
		<td><input type="text" name="pName"  placeholder="��������Ʒ����"/></td>
	</tr>
	<tr>
		<td align="right">��Ʒ����</td>
		<td>
		<select name="cId">
			<?php foreach($rows as $row):?>
				<option value="<?php echo $row['id'];?>"><?php echo $row['cName'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">��Ʒ����</td>
		<td><input type="text" name="pSn"  placeholder="��������Ʒ����"/></td>
	</tr>
	<tr>
		<td align="right">��Ʒ����</td>
		<td><input type="text" name="pNum"  placeholder="��������Ʒ����"/></td>
	</tr>
	<tr>
		<td align="right">��Ʒ�г���</td>
		<td><input type="text" name="mPrice"  placeholder="��������Ʒ�г���"/></td>
	</tr>
	<tr>
		<td align="right">��Ʒ�����</td>
		<td><input type="text" name="iPrice"  placeholder="��������Ʒ�����"/></td>
	</tr>
	<tr>
		<td align="right">��Ʒ����</td>
		<td>
			<textarea name="pDesc" id="editor_id" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">��Ʒͼ��</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">��Ӹ���</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="������Ʒ"/></td>
	</tr>
</table>
</form>
</body>
</html>