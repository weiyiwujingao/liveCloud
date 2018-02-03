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
           
			
			<label class="labelTd03 La" for="Zjid"><i class="W130">开始时间：</i><input type="text" value="<?php echo date('Y-m-d H:i:s',$content[3]);?>" class="W350 Wdate"/></label>
			<label class="labelTd03 La" for="Ti"><i  class="W130">结束时间：</i><input type="text" value="<?php echo date('Y-m-d H:i:s',$content[4]);?>" class="W350 Wdate"/></label>
    		<label class="labelTd03 La" for="Ti"><i  class="W130">IP：</i><?php if($content[5]==1){?><input name="" type="checkbox" value="" checked="true"/><?php }else{?><input name="" type="checkbox" value=""/><?php }?></label>
    		
            <div class="labelTd03" for="Nc3"><i class="W130">相关视频：</i><input type="text" value="<?php echo $content[20];?>"  id="ecorpdesc" class="W350" /><?php if($content[11]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
			<div class="labelTd03" for="Nc4"><i class="W130">产品信息：</i><input type="text" value="<?php echo $content[12];?>" id="eprocdesc" class="W350" /><?php if($content[13]==1){?><input name="" type="checkbox" value="" checked="true" class="Vm Ml5"/><?php }else{?><input name="" type="checkbox" value="" class="Vm Ml5"/><?php }?>是否显示</div>
     		
       	    <div class="labelTd03"><i class="W130">当前在线人数：</i><input type="text" class="W30 L" id="eonlinenum1" value="<?php echo $content[16];?>"/><em class="L">至</em><input type="text" class="W30 L" id="eonlinenum2" value="<?php echo $content[17];?>"/></div>
         
			<div class="labelTd03"><i class="W130">所有嘉宾：</i>
			<select id="euserid">
			<option href="#" value="0">请选择嘉宾</option>
     	 	<?php foreach($userlist as $key=>$item):?>
			<?php if($item['isadmin']==0){?>
        	<option href="#" <?php if($content[21]==$item['id']){echo 'selected="selected"';} ?>  value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
			<?php }?>
            <?php endforeach;?>			
			</select>
			</div>

			<div class="labelTd03"><i class="W130">所有主持人：</i>
			<select id="eadmin">	
			<option href="#" value="0">请选择主持人</option>
     	 	<?php foreach($userlist as $key=>$item):?>
			<?php if($item['isadmin']==1){?>
        	<option href="#" <?php if($content[23]==$item['id']){echo 'selected="selected"';} ?> value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
			<?php }?>
            <?php endforeach;?>			
			</select>
			</div>


            <label class="labelTd03 Mt12" for="Nc8"><i class="W130">备注：</i><textarea type="text" class="W450" rows="5" ><?php echo $content[18];?></textarea><var></var></label>	
 </div>
</body>
</html>

