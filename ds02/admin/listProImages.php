<?php
require_once '../include.php';
checkLogined();
$rows=getProInfo();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>

<div class="details">

                    <!--���-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">���</th>
                                <th width="20%">��Ʒ����</th>
                                <th>��ƷͼƬ</th>
                                <th>����</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--�����id��for�����c1 ��Ҫѭ������-->
                                <td><input  type="checkbox" id="c<?php echo $row['id'];?>" class="check" value=<?php echo $row['id'];?>><label for="c1" class="label"><?php echo $row['id'];?></label></td>

                                <td><?php echo $row['pName']; ?></td>
								<td>
					                        			<?php
					                        			$proImgs=getAllImgByProId($row['id']);
					                        			foreach($proImgs as $img):
					                        			?>
					                        			<img width="100" height="100" src="uploads/<?php echo $img['albumPath'];?>" alt=""/> &nbsp;&nbsp;
					                        			<?php endforeach;?>
					             </td>
					             <td>

					             	<input type="button" value="�������ˮӡ" onclick="doImg('<?php echo $row['id'];?>','waterText')" class="btn"/>

					             	<br/>

					             </td>




                            </tr>
                           <?php  endforeach;?>
                        </tbody>
                    </table>
                </div>
 <script type="text/javascript">
 		function doImg(id,act){
			window.location="doAdminAction.php?act="+act+"&id="+id;
 	 	}
 </script>
</body>
</html>