<?php
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>��ʳ����ϵͳ</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
    <div class="head">
            <div class="logo fl"><a href="#"></a></div>
            <h3 class="head_text fr">��̨����ϵͳ</h3>
    </div>
    <div class="operation_user clearfix">
       <!--   <div class="link fl"><a href="#"></a><span>&gt;&gt;</span><a href="#">��Ʒ����</a><span>&gt;&gt;</span>��Ʒ�޸�</div>-->
        <div class="link fr">
            <b>��ӭ��
            <?php
				if(isset($_SESSION['adminName'])){
					echo $_SESSION['adminName'];
				}elseif(isset($_COOKIE['adminName'])){
					echo $_COOKIE['adminName'];
				}
            ?>

            </b>&nbsp;&nbsp;&nbsp;&nbsp;<span></span><a href="doAdminAction.php?act=logout" class="icon icon_e">�˳�</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <!--�Ҳ�����-->
            <div class="cont">
                <div class="title">��̨����</div>
      	 		<!-- Ƕ����ҳ��ʼ -->
                <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%" height="522"></iframe>
                <!-- Ƕ����ҳ���� -->
            </div>
        </div>
        <!--����б�-->
        <div class="menu">
            <div class="cont">
                <div class="title">����Ա</div>
                <ul class="mList">
                    <li>
                        <h3><span onclick="show('menu1','change1')" id="change1">+</span>��Ʒ����</h3>
                        <dl id="menu1" style="display:none;">
                        	<dd><a href="addPro.php" target="mainFrame">�����Ʒ</a></dd>
                            <dd><a href="listPro.php" target="mainFrame">��Ʒ�б�</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu2','change2')" id="change2">+</span>�������</h3>
                        <dl id="menu2" style="display:none;">
                        	<dd><a href="addCate.php" target="mainFrame">��ӷ���</a></dd>
                            <dd><a href="listCate.php" target="mainFrame">�����б�</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span  onclick="show('menu3','change3')" id="change3" >+</span>��������</h3>
                        <dl id="menu3" style="display:none;">
                            <dd><a href="listBuy.php" target="mainFrame">�����б�</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu4','change4')" id="change4">+</span>�û�����</h3>
                        <dl id="menu4" style="display:none;">
                        	<dd><a href="addUser.php" target="mainFrame">����û�</a></dd>
                            <dd><a href="listUser.php" target="mainFrame">�û��б�</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu5','change5')" id="change5">+</span>����Ա����</h3>
                        <dl id="menu5" style="display:none;">
                        	<dd><a href="addAdmin.php" target="mainFrame">��ӹ���Ա</a></dd>
                            <dd><a href="listAdmin.php" target="mainFrame">����Ա�б�</a></dd>
                        </dl>
                    </li>

                         <li>
                        <h3><span onclick="show('menu6','change6')" id="change6">+</span>��ƷͼƬ����</h3>
                        <dl id="menu6" style="display:none;">
                            <dd><a href="listProImages.php" target="mainFrame">��ƷͼƬ�б�</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">
    	function show(num,change){
	    		var menu=document.getElementById(num);
	    		var change=document.getElementById(change);
	    		if(change.innerHTML=="+"){
	    				change.innerHTML="-";
	        	}else{
						change.innerHTML="+";
	            }
    		   if(menu.style.display=='none'){
    	             menu.style.display='';
    		    }else{
    		         menu.style.display='none';
    		    }
        }
    </script>
</body>
</html>