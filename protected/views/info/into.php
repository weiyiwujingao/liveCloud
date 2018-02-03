<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-审核管理</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body>
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
	<i class="osHg tAlignL">审核管理</i>
	<input type="hidden" id="hidCid" value=""/>
	<form class="SearBar" id="SearBar" name="SearBar" action="<?php echo yii::app()->createUrl('Show/Infoclass')?>">
        <span style="padding:0 0 20px 20px;">请输入路演ＩＤ：</span>
        <input type="text" value="" id="sid" class="L"/>
        <a href="javascript:search(0);" class="searBtnBig" id="searchBtn">进入</a>
    </form>
</section>

<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,Cm/Js/Jquery16.js" type="text/javascript"></script>
<script>
function search()
{
	 var url='';
	if(C.G('sid').value){
		 url+="&sid="+C.G('sid').value;
	}

	if(url){
		location.href="<?php echo yii::app()->createUrl('info/Infoclass');?>"+encodeURI(url);
	}
}
</script>
</body>
</html>
