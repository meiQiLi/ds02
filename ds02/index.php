<?php
require_once 'include.php';
$cates=getAllCate();
//print_r($cates);
if (!($cates&&is_array($cates))){
    alertMes("对不起，网站维护中！","http://www.baidu.com");
}
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>首页</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<body>
<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">

			<div class="rightArea">
			               欢迎来到美食美客！
				<?php if(isset($_SESSION['username'])):?>
				<span>欢迎您</span>
                <?php echo $_SESSION['username'];?>
                <a href="buypro.php">[我的订单]</a>
				<a href="doAction.php?act=userOut">[退出]</a>
				<?php else:?>
				<a href="login.php">[登录]</a><a href="reg.php">[免费注册]</a>
				<?php endif;?>

			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="img/logo.png" alt="美食美客"></a>
			</div>


		</div>
	</div>

</div>
<div class="hr_25"></div>

<?php foreach ($cates as $cate):?>
<div class="shopTit comWidth">
	<span class="icon"></span><h3 id="<?php echo $cate['cName'];?>"><?php echo $cate['cName'];?></h3>

</div>
<div class="shopList comWidth clearfix">
	<div class="leftArea">
		<div class="banner_bar banner_sm">
			<ul class="imgBox">
				<li><a href="#"><img src="img/banner/banner_sm_01.jpg" alt="banner"></a></li>

			</ul>

		</div>
	</div>
	<div class="rightArea">
		<div class="shopList_top clearfix">
		<?php
		  $pros=getProByCid($cate['id']);
		  if ($pros&&is_array($pros)):
		  foreach ($pros as $pro):
		  $proImg=getProImgById($pro['id']);
		?>
			<div class="shop_item">
				<div class="shop_img">
					<a href="proDetails.php?id=<?php echo $pro['id'];?>"target="_blank"><img height="200" width="187" src="image_220/<?php echo $proImg['albumPath'];?>" alt=""></a>
				</div>
				<div class="hr_15"></div>
				<h3><?php echo $pro['pName'];?></h3>
				<p><?php echo $pro['iPrice'];?>元</p>
			</div>
         <?php
          endforeach;
          endif;
         ?>
		</div>
		<div class="shopList_sm clearfix">
		<?php
		$prosSmall=getSmallProsByCid($cate['id']);
		if ($prosSmall&&is_array($prosSmall)):
		foreach ($prosSmall as $proSmall):
		$proSmallImg=getProImgById($proSmall['id']);
		?>
			<div class="shopItem_sm">
				<div class="shopItem_smImg">
					<a href="proDetails.php?id=<?php echo $proSmall['id'];?>" target="_blank"><img width="95" height="95" src="image_220/<?php echo $proSmallImg['albumPath'];?>" alt=""></a>
				</div>
				<div class="shopItem_text">
					<p><?php echo $proSmall['pName'];?></p>
					<h3>￥<?php echo $proSmall['iPrice'];?>	</h3>
				</div>
			</div>
		 <?php
          endforeach;
          endif;
         ?>


		</div>
	</div>
</div>
<?php endforeach;?>
<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">本站简介</a><i>|</i><a href="#">本站公告</a><i>|</i> <a href="#">联系我们</a><i>|</i>客服热线：1234</p>
	<p>Copyright &copy; 版权所有&nbsp;&nbsp;&nbsp;</p>
</div>
</body>
</html>

