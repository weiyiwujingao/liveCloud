<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>股市直播-直播管理-直播点击</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body class="Mh0 tAlignL">
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
	<i class="osHg tAlignL">路演点击</i>
    <p class="SearBar">
		 <span><i>日期：</i><input type="text" id="data" value="<?php echo isset($_GET["data"])?$_GET["data"]:''?>" class="Wdate" onClick="showCalendar(this)" /></span>
		<a class="searBtnBig" href="javascript:;" id="searchBtn">搜索</a>
    </p>
     <p class="SRTitle Mt9"><?php if($lj){?><a class="InsBtn02 R" href="<?php echo yii::app()->createUrl('ui/uilist&t=livestockhits');?>" style="font-size:12px;">路演每天累加</a><?php }?>查询结果：</p>
    <table class="serchResult" width="100%" border="0" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th width="20%">日期</th>
        <th width="40%">IP</th>
        <th width="40%">PV</th>
      </tr>
    </thead>
	<tbody id="TabM">
      <?php 
       $i=0;
      	if(!empty($list)){
      		foreach($list as $item){ ?>
      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->id ?>">
        <td class="Nrp" title="<?php echo $item->day?>"><?php echo $item->day?></td>
        <td class="Nrp" title="<?php echo $item->ip?>"><?php echo $item->ip?></td>
        <td class="Nrp" title="<?php echo $item->pv?>"><?php echo $item->pv?></td>
      </tr>
      <?php $i++;} }?>
     </tbody>
    </table>
    <div class="page">
<i class="pageL L">共有 <a href="####" id="totalP"><?php echo $total; ?></a> 条数据 <?php $this->widget('Pagination', array('pages' => $pages,'pagesize'=>$pagesize,'url'=>$url)); ?></i></div>
</section>
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,ua/js/Clouds/Tables.js,Cm/Js/Dialog.js,Cm/Js/Forms.js,ua/js/Clouds/Calendar.js" type="text/javascript"></script>
<script charset="utf-8" type="text/javascript">
Tables("TabM","Ccl","Ocl");

/*author by jiameng1015@126.com
 * date:2012.08.15
 * description:整理需要的参数发送请求到指定url地址;
 */
function Search(){
	var url = "";
	if(C.G('data')){
		 url+="&data="+C.G('data').value;
	}
	if(url!=""){
		window.location.href="<?php echo yii::app()->createUrl('ui/uilist');?>"+encodeURI(url);
		return false;
	}
}
/*给搜索按钮加上监听事件    回车搜索*/
function keyHandler(event) {
    if(event.keyCode == 13) {
    	Search();	
	}		
}
C.AddEvent(C.G("data"),"keypress",keyHandler);//搜索绑定回车事件
C.AddEvent(C.G('searchBtn'),"click",Search);//搜索

if(top.C.G("CM1")){
	setTimeout(function(){top.C.G("CM1").style.height="600px";top.C.Ehs("CM1","Ifr")},500);
}
</script>
</body>
</html>
