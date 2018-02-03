<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-查看详细信息</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<!–[if lt IE]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body class="Mh0">
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<div class="uMgUList">
	<i class="osHg tAlignL Tl">查看详情</i>
    <div class="SearBar Tl">
       <label class="labelTd03 La" for="Nm"><i class="W130">主题：</i><input type="text" class="W350" id="edittopic" value="<?php echo $content[1];?>"/></label>
            <label class="hAuto labelTd03 Pst"><i class="W130">主题图片：</i>
			<img src="<?php echo $content[2];?>" class="rePic" style="float:left;" id="EdithdImg" />	</label>
            <div class="labelTd03" for="Jj"><i class="W130">分类名称：</i>
			<div class="Move Ml80 W98"><h2>所有分类</h2>
			<select class="W98 H120"  size=“10” multiple="" id="eclassid">
			<?php $i=0?>
			<?php if($classlist){?>
     	 	<?php foreach($classlist as $key=>$item){?>
        	<option href="####" value="<?php echo $item['id']?>"><?php echo($item['classname'])?></option>
        	<?php $i++;?>
            <?php }}?>
			</select></div>
			<a href="####" class="MBtn Ff01 Mbtnpos09">添加>></a>
			<a href="####" class="MBtn Ff01  Mbtnpos10"><<移出</a>
			<div class="Move Ml300 Mt140 W98"><h2>需要添加的分类</h2>
			<select class="W98 H120"  size=“10” multiple="">
			<?php $i=0?>
			<?php if($class){?>
     	 	<?php foreach($class as $key=>$item){?>
        	<option href="####" value="<?php echo $item['id']?>"><?php echo($item['classname'])?></option>
        	<?php $i++;?>
            <?php }}?>
			</select></div>
			</div>
			<label class="labelTd03 La" for="Zjid"><i class="W130">开始时间：</i><input type="text" value="<?php echo date('Y-m-d H:i:s',$content[3]);?>" class="W350 Wdate"/></label>
			<label class="labelTd03 La" for="Ti"><i  class="W130">结束时间：</i><input type="text" value="<?php echo date('Y-m-d H:i:s',$content[4]);?>" class="W350 Wdate"/></label>
    		<label class="labelTd03 La" for="Ti"><i  class="W130">IP：</i><?php if($content[5]==1){?><input name="" type="checkbox" value="" checked="true"/><?php }else{?><input name="" type="checkbox" value=""/><?php }?></label>
    		<div class="labelTd03" for="Nc1"><i class="W130">嘉宾介绍链接：</i><input type="text" value="<?php echo $content[6];?>"  id="edescurl" class="W350" /><?php if($content[7]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
			<div class="labelTd03" for="Nc2"><i class="W130">历史路演：</i><input type="text" value="<?php echo $content[8];?>"  id="ehistorydesc" class="W350" /><?php if($content[9]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
            <div class="labelTd03" for="Nc3"><i class="W130">公司信息：</i><input type="text" value="<?php echo $content[10];?>"  id="ecorpdesc" class="W350" /><?php if($content[11]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
			<div class="labelTd03" for="Nc4"><i class="W130">产品信息：</i><input type="text" value="<?php echo $content[12];?>" id="eprocdesc" class="W350" /><?php if($content[13]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
     		<label class="labelTd03 La" for="Nc5"><i class="W130">频道链接文字：</i><input type="text" value="<?php echo $content[14];?>" id="echannlename" class="W350" /></label>
			<div class="labelTd03" for="Nc6"><i class="W130">频道链接：</i><input type="text" value="<?php echo $content[15];?>" class="W350" /><?php if($content[19]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
       	    <div class="labelTd03"><i class="W130">当前在线人数：</i><input type="text" class="W30 L" id="eonlinenum1" value="<?php echo $content[16];?>"/><em class="L">至</em><input type="text" class="W30 L" id="eonlinenum2" value="<?php echo $content[17];?>"/></div>
             <div class="labelTd03" style="clear:both; _margin-top:6px;" for="Jj"><i class="W130">邀请嘉宾：</i>
			<div class="Move Ml80 W198"><h2>所有嘉宾</h2>
			<select class="W198 H120"  size=“10” multiple="" id="euserid">
			<?php $i=0?>
			<?php if($userlist){?>
     	 	<?php foreach($userlist as $key=>$item){?>
        	<option href="####" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
        	<?php $i++;?>
            <?php }}?>	
			</select></div>
			<a href="####" class="MBtn Ff01 Mbtnpos11">添加>></a>
			<a href="####" class="MBtn Ff01 Mbtnpos12"><<移出</a>
			<div class="Move Ml380 Mt160 W198"><h2>需要邀请的嘉宾</h2>
			<select class="W198 H120"  size=“10” multiple="">
			<?php $i=0?>
			<?php if($user){?>
     	 	<?php foreach($user as $key=>$item){?>
        	<option href="####" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
        	<?php $i++;?>
            <?php }}?>	
			</select></div>
			</div>
            <label class="labelTd03 Mt12" for="Nc8"><i class="W130">备注：</i><textarea type="text" class="W450" rows="5" ><?php echo $content[18];?></textarea><var></var></label>	
 </div>
</body>
</html>

