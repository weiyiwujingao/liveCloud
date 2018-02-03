<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-审核管理-问题审核</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=ub/Css/Modules/Basis.css,ui/Css/CloudCom/CloudCom.css,Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css,ue/Css/Clouds/NewStyle.css,ue/Css/Clouds/CldRoad.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body>
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
<i class="osHg tAlignL Mt10"><?=$type_name?>路演（<?=$params['username']?> <?=$params['sid']?>）</i>
<dl id="C1a" class="NTabs PstR">
    <dt class="mpLab">
        <a href="/?g=aW5mby9JbmZvY2xhc3M%3D&sid=<?php echo $sid;?>&style=1"  <?php if( $params['style']==1 ) echo 'class="CM"'; ?> >问题审核</a>
        <a href="/?g=aW5mby9JbmZvY2xhc3M%3D&sid=<?php echo $sid;?>&style=2" <?php if( $params['style']==2 ) echo 'class="CM"'; ?>>发布管理</a>
		<a href="/?g=aW5mby9JbmZvY2xhc3M%3D&sid=<?php echo $sid;?>&style=3" <?php if( $params['style']==3 ) echo 'class="CM"'; ?>>垃圾箱</a>
    </dt>
    <dd class="hAuto" style="display:block;">
        <form class="FmSrch ComWrp" id="Search" name="Search">
            <label>用户昵称：<input type="text" value="<?php echo (isset($_GET['asker'])&& $_GET['asker'])?$_GET['asker']:''?>" name="asker" id ="asker" /></label>
            <label>提问对象：<input type="text" value="<?php echo (isset($_GET['replyer'])&& $_GET['replyer'])?$_GET['replyer']:''?>" name="replyer" id='replyer' /></label>
			  <label style="vertical-align:middle">状态：
                <select id="audit" name='audit'>
                    <option value ='-4'>全部</option>
                    <option <?php if(isset($_GET['audit'])&& $_GET['audit']==-1){echo 'selected="selected"';} ?> value='-1'>未审核</option>
                    <option <?php if(isset($_GET['audit'])&& $_GET['audit']==-2){echo 'selected="selected"';} ?> value ='-2'>已审核</option>
					<option <?php if(isset($_GET['audit'])&& $_GET['audit']==-3){echo 'selected="selected"';} ?> value ='-3'>已发布</option>
					<option <?php if(isset($_GET['audit'])&& $_GET['audit']==-4){echo 'selected="selected"';} ?> value ='-4'>审核未通过</option>
                </select>
            </label><br>
            <label for=" ">提问时间：<input type="text" class="InpDate W100" onClick="showCalendar(this)" value="<?php echo (isset($_GET['begintime'])&& $_GET['begintime'])?$_GET['begintime']:''?>" id="begintime" name="begintime"/> - <input type="text" class="InpDate W100" onClick="showCalendar(this)" value="<?php echo (isset($_GET['endtime'])&& $_GET['endtime'])?$_GET['endtime']:''?>" id="endtime" name="endtime"/></label>
			<label for=" ">提问时间：<input type="text" class="InpDate W100" onClick="showCalendar(this)" value="<?php echo (isset($_GET['rbegintime'])&& $_GET['rbegintime'])?$_GET['rbegintime']:''?>" id="rbegintime" name="rbegintime"/> - <input type="text" class="InpDate W100" onClick="showCalendar(this)" value="<?php echo (isset($_GET['rendtime'])&& $_GET['rendtime'])?$_GET['rendtime']:''?>" id="rendtime" name="rendtime"/></label>
          
            <a href="javascript:Search()" id="searchUrl"  class="BtnSrch">搜索</a>
        </form>
        
        
    </dd>
</dl>
    
    <p class="SRTitle Mt10">
	<?php 
		if($del)
		{
	?>
	<a href="javascript:void(0);" class="BtnSrch TitBtn1 R" onClick="DelRecord(0,3);">还原</a>
	<?php 
		}
	?>
	查询结果：</p>
     <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
       <thead>
        <tr>
          <th width="4%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
          <th width="8%">ID</th>
          <th width="20%">发表人</th>
          <th width="12%">对象</th>
          <th width="12%">内容</th>
		  <th width="12%">更新时间</th>
		  <th width="12%">删除时间</th>
          <th width="10%">状态</th>
          <th width="10%">操作</th>
        </tr>
       </thead>
       <tbody id="TabM">
		<?php 
			if(!empty($infoList))
			{
				foreach($infoList as $key =>$val)
				{
					$askarr = explode('-',$val['asker']);
					$ask='';
					if(count($askarr)>2)
					{
						for($i=0;$i<count($askarr)-1;$i++)
						{
							$ask.=$askarr[$i].'-';
						}
						$ask=rtrim($ask,'-');
					}else
					{
						$ask=$askarr[0];
					}

					echo '<tr class="" id="'.$val['id'].'">';
					echo '<td><input type="checkbox" name="box_id" value="'.$val['id'].'"/></td>';
					echo '<td><a style="color:#276FA3;" target="blank" href="http://roadshow.cnfol.com/show/'.$val['id'].'">'.$val['id'].'&nbsp;</a></td>';
					echo '<td class="Nrp">'.$ask.'</td>';
					echo '<td class="Nrp">'.$val['replyer'].'</td>';
					echo '<td class="Nrp">'.$val['question'].'</td>';
					echo '<td class="Nrp">'.date('Y-m-d H:i:s',$val['atime']).'</td>';
					echo '<td class="Nrp">'.date('Y-m-d H:i:s',$val['rtime']).'</td>';
					echo '  <td class="Nrp">'.$status[$val['audit']].'</td>';
					echo '  <td class="spTd">';
					if($del)
					{
						echo '<a onClick="DelRecord('.$val['id'].',3);" class="btnStyleA L" href="javascript:void(0);">还原</a>';
					}
					echo '</td></tr>';
	      
				}
			}
		?>

	   </tbody>
    </table>
 <div class="page">
<i class="pageL L">共有 <a href="####" id="totalP"><?php echo $count; ?></a> 条数据 <?php $this->widget('Pagination', array('pages' => $pages,'pagesize'=>$pagesize,'url'=>$url)); ?>
</i></div>

</section>
<!--弹出窗-->
<div id="TMconfirmTmk" class="MsContent"></div>
<!--审核删除-->
<div id="TMdelMsTipTmk" class="MsContent">
	<div class="mgTpMain w250 L">
    	<div class="mgTpTitle">信息提示</div>
        <div class="mgTpCont">
        	<p id='msg_dialog'>你确定要还原吗？</p>
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureDel">确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>


<!--end window-->
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,Cm/Js/Jquery16.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,Cm/Js/Forms.js,ue/Js/Cloud/DiaFix.js" type="text/javascript"></script>
<script type="text/javascript" src="http://roadshow.cloud.cnfol.com/js/selectCheck.js"></script>

<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
Tables("TabM","Ccl","Ocl");
function checkNum( val,obj ){
	if(val!=''){
		if( val.match(/^[0-9]*$/)){
			C.G(obj).className ="Ok";
			C.G(obj).innerHTML = '';
			_r2= true;
		}else{
			C.G(obj).className ="No";
			C.G(obj).innerHTML = "请输入合法的数字";
		}
	}else{
		C.G(obj).className ="No";
		C.G(obj).innerHTML = "该项不能为空！";
	}
}
</script>
<script charset="utf-8" type="text/javascript">
//复选
function getCheckboxIds(checkbox_name){
	var vInput=$('input=[name=box_id]');
	var ids=new Array();
	for(var i=0;i<vInput.length;i++){ 
		var obj=vInput.eq(i); 
		if(vInput.eq(i).attr('checked')){   
			ids.push(vInput.eq(i).val());
		}
	}
	return ids;
}
//还原
function MakeSureDel(id,type){
	Dialog.Close();
	var Data="&id="+id+"&type="+type+"&sid="+"<?php echo $params['sid']?>";
	/*添加审核是否通过*/

	var Url="<?php echo yii::app()->createUrl('info/examineordel');?>";

	C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
	function goBackVal(Bj){ 
		if(Bj.errorno=='000')
		{
			alert(Bj.msg);
			location.reload();
		}else
		{
			alert(Bj.msg);
		}
	}
}
function DelRecord(rid,type)
{
	if(rid == 0)
	{
		var ids = getCheckboxIds('box_id');
		if(ids.length==0)
		{
			MsgAlter('TMconfirmTmk',"请选中要审核的记录");
		}else
		{
			if(type==3)
			{
				$('#msg_dialog').html('你确定要还原吗？');
				Dialog('TMdelMsTipTmk');
			}
			C.G('SureDel').onclick = function () 
			{
				MakeSureDel(ids,type);
			};
		};
			
		
	}else if(rid != 0)
	{
		if(type==3)
		{
			$('#msg_dialog').html('你确定要还原吗？');
			Dialog('TMdelMsTipTmk');
		}
		
		C.G('SureDel').onclick = function () {
			MakeSureDel(rid,type);
		};
	}
}

function Search(){
	var url = "&style=<?php echo $params['style'];?>&sid=<?php echo  $_GET['sid'];?>";
	if(C.G('asker').value){
		 url+="&asker="+C.G('asker').value;
	}
	if(C.G('endtime').value){
		 url+="&endtime="+C.G('endtime').value;
	}
	if(C.G('begintime').value)
	{
		 url+="&begintime="+C.G('begintime').value;
	}
	if(C.G('rendtime').value){
		 url+="&rendtime="+C.G('rendtime').value;
	}
	if(C.G('rbegintime').value)
	{
		 url+="&rbegintime="+C.G('rbegintime').value;
	}
	if(C.G('replyer').value)
	{
		 url+="&replyer="+C.G('replyer').value;
	}
	if(C.G('audit').value)
	{
		 url+="&audit="+C.G('audit').value;
	}
	if(url){
		location.href="<?php echo yii::app()->createUrl('info/Infoclass');?>"+encodeURI(url);
	}
}

</script>
</body>
</html>
