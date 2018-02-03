<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!–[if lt IE9]> 
<script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script>
<![endif]–>
<title>后台首页</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ub/Css/CustomerService/SerCenter.css" />
<script type="text/javascript" src="http://hs.cnfol.com/Cm/Js/Base.js" charset="utf-8"></script>
</head>
<body class="RightW">
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com";
</script>
        <p class="F14">
        <?php if($_GET['message']=='user_not'):?>        
         <?php echo '用户不存在';?>！
       <?php else:?>
         <?php echo $_GET['message'];?>！
       <?php endif;?>
       </p>
<script type="text/javascript">
if(top.C.G("CM1")){
	setTimeout(function () { top.C.G("CM1").style.height = "600px"; top.C.Ehs("CM1", "Ifr") }, 500);
}
</script>
</body>
</html>
