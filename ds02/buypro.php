<?php
require_once 'include.php';
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<!-- <meta charset="utf-8"> -->
<title>����</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<script src="scripts/jquery-1.6.js" type="text/javascript"></script>
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
			               ��ӭ������ʳ���ͣ�
				<?php if(isset($_SESSION['username'])):?>
				<span>��ӭ��</span>
                <?php echo $_SESSION['username'];?>
                <a href="index.php">[��ҳ]</a>
				<a href="doAction.php?act=userOut">[�˳�]</a>
				<?php else:?>
				<a href="login.php">[��¼]</a><a href="reg.php">[���ע��]</a>
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
<div class="shoppingCart comWidth">

	<div class="hr_25"></div>


	<div class="shopping_item">
		<h3 class="shopping_tit">����<input type="button" value="��ն���" class="backCar" onclick="clearbuy()">
		 <script type="text/javascript">
		   function clearbuy(){
			   var url="clearall.php";
			   var success=function(response){
				   if(response.errno==0){
					   $(".products").remove();
					   }

				   }
			   $.get(url,success,"json");
			   }
		 </script>
		</h3>

		<div class="shopping_cont pb_10">
			<div class="cart_inner">
				<div class="cart_head clearfix">
					<div class="cart_item t_name">��Ʒ����</div>
					<div class="cart_item t_price">�г���</div>
					<div class="cart_item t_price">�����</div>
					<div class="cart_item t_num">����</div>
					<div class="cart_item t_subtotal">С��</div>
					<div class="cart_item t_return">����</div>
				</div>
				<?php
				  try {
				      $pdo=new PDO("mysql:host=localhost;dbname=ds02","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				      $pdo->query("set names gbk");
                      $sql="select p.id,p.pImg,p.pName,p.mPrice,p.iPrice,b.num from food_pro p right join food_buy b on p.id=b.productid where b.userid=?";
                      $stmt=$pdo->prepare($sql);
                      //session_start();
                      $userid=$_SESSION['loginFlag'];
                      $stmt->execute(array($userid));
                      $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
				  }catch (PDOException $e){
				      echo $e->getMessage();
				  }
				?>
				<?php
				  $total=0;
				  foreach ($data as $product):
				?>
				<div class="cart_cont clearfix products" id="tr-<?php echo $product['id']?>">
					<div class="cart_item t_name">
						<div class="cart_shopInfo clearfix">

							<div class="cart_shopInfo_cont">

								<p class="cart_info"><?php echo $product['pName']?></p>
							</div>
						</div>
					</div>
					<div class="cart_item t_price">
						<?php echo $product['mPrice']?>Ԫ
					</div>
					<div class="cart_item t_price">
						<span id="p-<?php echo $product['id']?>"><?php echo $product['iPrice']?></span>Ԫ
					</div>

					<div class="cart_item t_num"><input type="text" name="goods_number" value="<?php echo $product['num']?>" size="4" style="text-align:center;border: #B2B2B2 solid 1px;margin-top:10px;" onblur="changeNum(<?php echo $product['id']?>,this.value)" id="product-<?php echo $product['id']?>"></div>
					<div class="cart_item t_subtotal t_red">��<span id="total-<?php echo $product['id']?>"><?php echo $product['num']*$product['iPrice']?></span></div>
					<div class="cart_item t_return"><a href="javascript:delPro(<?php echo $product['id']?>);">ɾ��</a></div>
				</div>
                <?php
                  $total+=$product['iPrice']*$product['num'];
                  endforeach;
                ?>
                 <script type="text/javascript">
                   function changeNum(productid,num){
                       //ͨ��ajax����Ӧ��Ʒ���������޸Ĳ���
                       var url="changeNum.php";
                       var data={'productid':productid,'num':num};
                       var success=function(response){
                           if(response.errno==0){
                               var price=$("#product-"+productid).val()*$("#p-"+productid).html();
                               $("#total-"+productid).html(price);
                               }
                           }
                       $.post(url,data,success,"json");
                       }

                   function delPro(productid){
                       //ͨ��ajax����Ʒ��id���ݸ�PHP�ű��������ݱ��ɾ��
                       var url="deleteProduct.php";
                       var data={"productid":productid};
                       var success=function(response){
                           if(response.errno==0){
                               $("#tr-"+productid).remove();
                               }

                           }
                       $.get(url,data,success,"json");

                       }
                 </script>

			</div>
		</div>
	</div>
	<div class="hr_25"></div>
	<div class="shopping_item">
		<h3 class="shopping_tit">�����ܼ�</h3>
		<div class="shopping_cont padding_shop clearfix">
			<div class="cart_count fr">
				<div class="cart_rmb">
					<i>�ܼƣ�</i><span>��<?php echo $total?></span>
				</div>

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
