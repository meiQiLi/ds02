<?php
require_once 'include.php';
$id=$_REQUEST['id'];
$proInfo=getProById($id);
$proImgs=getProImgsById($id);
if (!($proImgs&&is_array($proImgs))){
    alertMes("��ƷͼƬ����", "index.php");
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>��Ʒ����</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<link type="text/css" rel="stylesheet" media="all" href="styles/jquery.jqzoom.css"/>
<script src="scripts/jquery-1.6.js" type="text/javascript"></script>
<script src="scripts/jquery.jqzoom-core.js" type="text/javascript"></script>
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false,
			title:false,
			zoomWidth:410,
			zoomHeight:410
        });

});
</script>
</head>

<body class="grey">
<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">

			<div class="rightArea">
			               ��ӭ������ʳ���ͣ�
				<?php if(isset($_SESSION['username'])):?>
				<span>��ӭ��</span>
                <?php echo $_SESSION['username'];?>
                <a href="index.php">[��ҳ]</a>
                <a href="buypro.php">[�ҵĶ���]</a>
				<a href="doAction.php?act=userOut">[�˳�]</a>
				<?php else:?>
				<a href="index.php">[��ҳ]</a><a href="login.php">[��¼]</a><a href="reg.php">[���ע��]</a>
				<?php endif;?>

			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="img/logo.png" alt="��ʳ����"></a>
			</div>


		</div>
	</div>

</div>
<div class="userPosition comWidth">
	<strong><a href="index.php">��ҳ</a></strong>
	<span>&nbsp;&gt;&nbsp;</span>
	<a href="#"><?php echo $proInfo['cName'];?></a>
	<span>&nbsp;&gt;&nbsp;</span>
	<em><?php echo $proInfo['pSn'];?></em>
</div>
<div class="description_info comWidth">
	<div class="description clearfix">
		<div class="leftArea">
			<div class="description_imgs">
				<div class="big">
					<a href="image_800/<?php echo  $proImgs[0]['albumPath'];?>" class="jqzoom" rel='gal1'  title="triumph" >
           			 <img width="309" height="340" src="image_350/<?php  echo $proImgs[0]['albumPath'];?>"  title="triumph">
	        		</a>
				</div>
				<ul class="des_smimg clearfix" id="thumblist" >
					<?php foreach($proImgs as $key=>$proImg):?>
					<li><a class="<?php echo $key==0?"zoomThumbActive":"";?> active" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'image_350/<?php echo $proImg['albumPath'];?>',largeimage: 'image_800/<?php echo $proImg['albumPath'];?>'}"><img src="image_50/<?php echo $proImg['albumPath'];?>" alt=""></a></li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="rightArea">
			<div class="des_content">
				<h3 class="des_content_tit"><?php echo $proInfo['pName'];?></h3>
				<div class="dl clearfix">
					<div class="dt">�г���</div>
					<div class="dd clearfix"><span class="des_money"><em>��</em><?php echo $proInfo['mPrice'];?></span></div>
				</div>
				<div class="dl clearfix">
					<div class="dt">�����</div>
					<div class="dd clearfix"><span class="des_money"><em>��</em><?php echo $proInfo['iPrice'];?></span></div>
				</div>

				<div class="des_position">
					<div class="dl clearfix">
					    <div class="dt">��Ʒ����</div>
					    <div class="dd clearfix"><span class="hg"><em><?php echo $proInfo['pDesc'];?></em></span></div>
				    </div>




					<div class="dl">
						<div class="dt des_num">����</div>
						<div class="dd clearfix">
							<div class="des_number">
								<div class="reduction"></div>
								<div class="des_input">
									<input type="text" id="number">
								</div>
								<div class="plus"></div>
							</div>

						</div>
					</div>
				</div>
<div class="hr_15"></div>
				<div class="shop_buy">
<!-- 					<a href="#" class="shopping_btn"></a> -->
                    <a href="javascript:addbuy(<?php echo $proInfo['id']?>);" class="shopping_btn"></a>
				</div>
<script type="text/javascript">
    function addbuy(id){

             //ajax����php�ű�������ݵ���� food_buy
        var url="addbuy.php";
        var data={"productid":id,"num":parseInt($("#number").val())};
        var success=function(response){
             if(response.errno==0){
                 alert('Ԥ���ɹ�');
                 }else{
                   alert('Ԥ��ʧ��');
                     };
            }
             $.post(url,data,success,"json");
        }
</script>
			</div>
		</div>
	</div>
</div>


<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">��վ���</a><i>|</i><a href="#">��վ����</a><i>|</i> <a href="#">��ϵ����</a><i>|</i>�ͷ����ߣ�1234</p>
	<p>Copyright &copy; ��Ȩ����&nbsp;&nbsp;&nbsp;</p>

</div>

</body>
</html>

