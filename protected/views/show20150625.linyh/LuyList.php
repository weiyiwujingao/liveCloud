<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>路演中心-嘉宾管理-嘉宾列表</title>
<link type="text/css" rel="stylesheet" href="http://hs.cnfol.com/f=Cm/Css/Base.css,ua/css/cloud/window.css,ua/css/cloud/Inner.css,ua/css/cloud/Calendar.css,ug/Css/Back2/Ins/Insback.css" />
<!–[if lt IE9]><script src="http://hs.cnfol.com/Cm/Js/Html5.js"></script><![endif]–>
</head>
<body class="Mh1" style="min-height:1500px">
<iframe src="http://cloud.cnfol.com/isuserlogin.php" width="1" height="1" style="display:none"></iframe>
<script charset="utf-8" type="text/javascript">
document.domain="cnfol.com"
</script>
<section class="uMgUList">
	<i class="osHg tAlignL">路演列表</i>
	<input type="hidden" id="hidCid" value="<?php echo $_GET['cid'];?>"/>
	<?php 
//	date_default_timezone_set('Asia/Chongqing');
	?>
    <p class="SearBar">
            <span><i>主题：</i><input type="text" value="<?php echo (isset($_GET['keyword'])&& $_GET['keyword'])?$_GET['keyword']:''?>" id="keyword"/></span>
			<a href="javascript:Search();" class="searBtnBig" id="searchBtn">搜索</a>
    </p>
	 <?php if($add){?><a href="javascript:void(0);" class="addBtn" onClick="Dialog('TMaddPowerTmk');">添加</a><?php }?>
	 <p class="SRTitle"><?php if($del){?><a href="javascript:void(0);" class="delBtn R" onClick="DelRecord(0);">删除</a><?php }?>查询结果：</p>
      <table  cellspacing="0" cellpadding="0" border="0" width="100%" class="serchResult MyMsgTab" id="Fa1">      
      <thead>
      <tr>
      	<th width="4%"><label class="Ca" for="Ca"><input type="checkbox" id="Ca" /></label></th>
        <th width="6%">路演ID</th>
        <th width="15%">主题</th>
        <th width="15%">开始时间</th>
        <th width="15%">结束时间</th>
		<th width="15%">嘉宾介绍链接</th>
        <th width="15%">更新日期</th>
        <th width="15%">操作</th>
      </tr>	  
	 </thead>
    <tbody id="TabM">
    <?php if($sign ==1){?>
   	 <?php 
	       $i=0;
	      	if($showList){
	      		foreach($showList as $item){
	      ?>
	      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->sid ;?>">
	      	<td><input type="checkbox" name="box_id" value="<?php echo $item->sid;?>"/></td>
	        <td><a target="blank" style="color:#276FA3;" href="http://roadshow.cnfol.com/show/<?php echo $item->sid;?>"><?php echo $item->sid;?>&nbsp;</a></td>
	        <td class="Nrp" title="<?php echo $item->Showmsg['topic'];?>"><?php echo $item->Showmsg['topic'];?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',$item->Showmsg['starttime']) ;?>"><?php echo @date('Y-m-d H:i',$item->Showmsg['starttime']) ;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo @date('Y-m-d H:i',$item->Showmsg['endtime']) ;?>"><?php echo @date('Y-m-d H:i',$item->Showmsg['endtime']) ;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo $item->Showmsg['descurl'];?>"><?php echo $item->Showmsg['descurl'];?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',$item->Showmsg['addtime']) ;?>"><?php echo @date('Y-m-d H:i',$item->Showmsg['addtime']) ;?>&nbsp;</td>
	        <td class="spTd"><a href="<?php echo yii::app()->createUrl('Show/lookinfo&id='.$item->sid);?>" class="btnStyleA L">查看</a><?php if($edit){?><a href="javascript:void(0);" class="btnStyleA L" onClick="EditShowMsg('<?php echo $item->sid ;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->sid?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?></td>
	      </tr>
	       <?php $i++;}}?>
    <?php }else{?>
	    <?php 
	       $i=0;
	      	if($showList){
	      		foreach($showList as $item){
	      ?>
	      <tr class="<?php echo $i%2==0?'':'evenTr'?>" id="<?php echo $item->id ;?>">
	      	<td><input type="checkbox" name="box_id" value="<?php echo $item->id;?>"/></td>
	        <td><a style="color:#276FA3;" target="blank" href='http://roadshow.cnfol.com/show/<?php echo $item->id;?>'><?php echo $item->id;?>&nbsp;</a></td>
	        <td class="Nrp" title="<?php echo $item->topic;?>"><?php echo $item->topic;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',"$item->starttime") ;?>"><?php echo @date('Y-m-d H:i',"$item->starttime") ;?>&nbsp;</td>
			<td class="Nrp" title="<?php echo @date('Y-m-d H:i',"$item->endtime") ;?>"><?php echo @date('Y-m-d H:i',"$item->endtime") ;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo $item->descurl;?>"><?php echo $item->descurl;?>&nbsp;</td>
	        <td class="Nrp" title="<?php echo @date('Y-m-d H:i',"$item->addtime") ;?>"><?php echo @date('Y-m-d H:i',"$item->addtime") ;?>&nbsp;</td>
	        <td class="spTd"><a href="<?php echo yii::app()->createUrl('Show/lookinfo&id='.$item->id);?>" class="btnStyleA L">查看</a><?php if($edit){?><a href="javascript:void(0);" class="btnStyleA L" onClick="EditShowMsg('<?php echo $item->id ;?>');">修改</a><?php }?><?php if($del){?><a onClick="DelRecord(<?php echo $item->id?>);" class="btnStyleA L" href="javascript:void(0);">删除</a><?php }?></td>
	      </tr>
	       <?php $i++;}}?>
       <?php }?>
     </tbody>
    </table>
    <div class="page">
<i class="pageL L">共有 <a href="####" id="totalP"><?php echo $count; ?></a> 条数据 <?php $this->widget('Pagination', array('pages' => $pages,'pagesize'=>$pagesize,'url'=>$url)); ?>
</i></div>
</section>
<!--弹出窗-->
<div id="TMconfirmTmk" class="MsContent"></div>
<!--delete-->
<div id="TMdelMsTipTmk" class="MsContent">
	<div class="mgTpMain w250 L">
    	<div class="mgTpTitle">信息提示</div>
        <div class="mgTpCont">
        	<p>你确定要删除吗？</p>
        	<span><a href="javascript:void(0);" class="sumitBtn" id="SureDel">确定</a><a href="javascript:void(0);"  class="cancelBtn" onClick="Dialog.Close();">取消</a></span>	
        </div>
    </div>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();"></a>
</div>
<!--添加路演-->
<div id="TMaddPowerTmk" class="MsContent">
<!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
    <dl class="mgTpMain W698 L Psr">
    	<dt class="mgTpTitle">添加路演</dt>
        <dd class="mgTpCont" style="display:block;">
		  <form id="Sm1" class="vFmV">
            <label class="labelTd03 La" for="Nm"><i class="W130">主题：</i><input type="text" id="Addtopic" class="W350" /><var id="AddCompRt"></var></label>
            <label class="hAuto labelTd03 Pst"><i class="W130">上传图片：</i><!-- <input type="text" class="W190" id="AddNm4" /> -->
			<img src="" class="rePic" style="float:left;" id="AddhdImg" /><a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
            <div class="labelTd03 Borno" for="Jj"><i class="W130">分类名称：</i>
			<div class="Move Ml80 W98"><h2>所有分类</h2>
			<select class="W98 H120"  size=“10” multiple="" id="classid">
			<?php $i=0?>
     	 	<?php foreach($classlist as $key=>$item):?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['classname'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>
			</select></div>
			<a href="####" class="MBtn Ff01 Mbtnpos" onClick="addOne('classid','addclass');">添加>></a>
			<a href="####" class="MBtn Ff01  Mbtnpos01" onClick="removeOne('addclass');"><<移出</a>
			<div class="Move Ml300 Mt140 W98"><h2>需要添加的分类</h2>
			<select class="W98 H120"  size=“10” multiple="" id="addclass">		
			</select></div>
			</div>
			<label class="labelTd03 La" for="Astarttime"><i class="W130">开始时间：</i><input type="text" value=""  preset="Rqd"  id="Astarttime" class="W350 Wdate" onclick="showCalendar(this)"  /><var></var></label>
			<label class="labelTd03 La" for="Aendtime"><i  class="W130">结束时间：</i><input type="text" value=""  preset="Rqd"  id="Aendtime" class="W350 Wdate" onclick="showCalendar(this)"  /><var></var></label>
    		<label class="labelTd03 La" for="Ti"><i  class="W130">IP：</i><input type="checkbox" value="" name="" id="Ashowip"/></label>
    		<div class="labelTd03" for="Nc1"><i class="W130">嘉宾介绍链接：</i><input type="text" value="" id="Adescurl" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="Ashowdesc" />是否显示</div>
			<div class="labelTd03" for="Nc2"><i class="W130">历史路演：</i><input type="text" value="" id="Ahistorydesc" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="Ashowhistory"/>是否显示</div>
            <div class="labelTd03" for="Nc3"><i class="W130">公司信息：</i><input type="text" value="" id="Acorpdesc" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="Ashowcorp" />是否显示</div>
			<div class="labelTd03" for="Nc4"><i class="W130">产品信息：</i><input type="text" value="" id="Aprocdesc" class="W350" /><input  name="" type="checkbox" value="" class="Vm Ml5" id="Ashowproc" />是否显示</div>
     		<label class="labelTd03 La" for="Nc5"><i class="W130">频道链接文字：</i><input type="text" value="" id="Achannlename" class="W350" /></label>
			<div class="labelTd03" for="Nc6"><i class="W130">频道链接：</i><input type="text" value="" id="Achannlelink" class="W350" /><input  id="Ahits" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
       	    <div class="labelTd03"><i class="W130">当前在线人数：</i><input type="text" value=""  class="W30 L" id="Aonlinenum1"/><em class="L">至</em><input type="text" class="W30 L" id="Aonlinenum2" onblur="checkNum(this.value,'addPh')"/><var id="addPh"></var></div>
            <div class="labelTd03 Borno" style="clear:both; _margin-top:6px;" for="Jj"><i class="W130">邀请嘉宾：</i>
			<div class="Move Ml80 W198"><h2>所有嘉宾</h2>
			<select class="W198 H120"  size=“10” multiple="" id="userid">			
			<?php $i=0?>
     	 	<?php foreach($userlist as $key=>$item):?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>			
			</select></div>
			<a href="####" class="MBtn Ff01 Mbtnpos03" onClick="addOne('userid','adduser');">添加>></a>
			<a href="####" class="MBtn Ff01 Mbtnpos04" onClick="removeOne('adduser');"><<移出</a>
			<div class="Mbtnpos09">（其中必须至少有一位是主持人）</div>
			<div class="Move Ml380 Mt160 W198"><h2>需要邀请的嘉宾</h2>
			<select class="W198 H120"  size=“10” multiple="" id="adduser">
			</select></div>
			</div>
            <label class="labelTd03 Mt12" for="Nc8"><i class="W130">备注：</i><textarea type="text" value="" id="Amemo" class="W450" rows="5"> </textarea><var></var></label>
            <span class="pm10 Pst"><a href="javascript:void(0);"  onClick="Fmadd('Sm1');checkNum(C.G('Aonlinenum1').value,'addPh');checkNum(C.G('Aonlinenum2').value,'addPh');" class="sumitBtn" id="Subtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="addRST"></i></span>	
          </form>
	    </dd>
    </dl>
    <a href="javascript:void(0);" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>
<!--修改路演-->
<div id="TMmodifyPowerTmk" class="MsContent">
<!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
  <dl class="mgTpMain W698 L">
    	<dt class="mgTpTitle">修改路演</dt>
        <dd class="mgTpCont" style="display:block;">
          <input type="hidden" class="norTxtBox" id="aid"/>
		   <input type="hidden" id="hidValue"/>
		  <form id="Sm2" class="vFmV">
            <label class="labelTd03 La" for="Nm"><i class="W130">主题：</i><input type="text" class="W350" id="edittopic"/><var id="EdtCompRt"></var></label>
            <label class="hAuto labelTd03 Pst"><i class="W130">主题图片：</i><!-- <input type="text" class="W190" id="AddNm4" /> -->
			<img src="" class="rePic" style="float:left;" id="EdithdImg" /><a href="javascript:Dialog.Mask(C.G('TMImgsUploadTmk'));" class="sentPicBtn" onClick="Dialog('TMImgsUploadTmk');" >上传图片</a>
			</label>
            <div class="labelTd03 Borno" for="Jj"><i class="W130">分类名称：</i>
			<div class="Move Ml80 W98"><h2>所有分类</h2>
			<select class="W98 H120"  size=“10” multiple="" id="eclassid">
			<?php $i=0?>
     	 	<?php foreach($classlist as $key=>$item):?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['classname'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>
			</select></div>
			<a href="####" class="MBtn Ff01 Mbtnpos" onClick="addOne('eclassid','aclassname');">添加>></a>
			<a href="####" class="MBtn Ff01  Mbtnpos01" onClick="removeOne('aclassname');"><<移出</a>
			<div class="Move Ml300 Mt140 W98"><h2>需要添加的分类</h2>
			<select class="W98 H120"  size=“10” multiple=""  id="aclassname">
			</select></div>
			</div>
			<label class="labelTd03 La" for="Zjid"><i class="W130">开始时间：</i><input type="text" value=""  preset="Rqd"  id="estarttime" class="W350 Wdate" onclick="showCalendar(this)" /><var></var></label>
			<label class="labelTd03 La" for="Ti"><i  class="W130">结束时间：</i><input type="text" value=""  preset="Rqd"  id="eendtime" class="W350 Wdate" onclick="showCalendar(this)"  /><var></var></label>
    		<label class="labelTd03 La" for="Ti"><i  class="W130">IP：</i><input type="checkbox" value="" name="" id="eshowip"/></label>
    		<div class="labelTd03" for="Nc1"><i class="W130">嘉宾介绍链接：</i><input type="text" value=""  id="edescurl" class="W350" /><input id="eshowdesc" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
			<div class="labelTd03" for="Nc2"><i class="W130">历史路演：</i><input type="text" value=""  id="ehistorydesc" class="W350" /><input  id="eshowhistory" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
            <div class="labelTd03" for="Nc3"><i class="W130">公司信息：</i><input type="text" value=""  id="ecorpdesc" class="W350" /><input  id="eshowcorp" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
			<div class="labelTd03" for="Nc4"><i class="W130">产品信息：</i><input type="text" value="" id="eprocdesc" class="W350" /><input  id="eshowproc" name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
     		<label class="labelTd03 La" for="Nc5"><i class="W130">频道链接文字：</i><input type="text" value="" id="echannlename" class="W350" /></label>
			<div class="labelTd03" for="Nc6"><i class="W130">频道链接：</i><input type="text" value="" id="echannlelink" class="W350" /><input id="Ehits"  name="" type="checkbox" value="" class="Vm Ml5">是否显示</div>
       	    <div class="labelTd03"><i class="W130">当前在线人数：</i><input type="text" class="W30 L" id="eonlinenum1"/><em class="L">至</em><input type="text" class="W30 L" id="eonlinenum2"/><var id="edtPh"></var></div>
             <div class="labelTd03 Borno" style="clear:both; _margin-top:6px;" for="Jj"><i class="W130">邀请嘉宾：</i>
			<div class="Move Ml80 W198"><h2>所有嘉宾</h2>
			<select class="W198 H120"  size=“10” multiple="" id="euserid">
			<?php $i=0?>
     	 	<?php foreach($userlist as $key=>$item):?>
        	<option href="#" value="<?php echo $item['id']?>"><?php echo($item['username'])?></option>
        	<?php $i++;?>
            <?php endforeach;?>	
			</select></div>
			<a href="####" class="MBtn Ff01 Mbtnpos03" onClick="addOne('euserid','ausername');">添加>></a>
			<a href="####" class="MBtn Ff01 Mbtnpos04" onClick="removeOne('ausername');"><<移出</a>
			<div class="Mbtnpos09">（其中必须至少有一位是主持人）</div>
			<div class="Move Ml380 Mt160 W198"><h2>需要邀请的嘉宾</h2>
			<select class="W198 H120"  size=“10” multiple="" id="ausername">
			</select></div>
			</div>
            <label class="labelTd03 Mt12" for="Nc8"><i class="W130">备注：</i><textarea type="text" value="" id="ememo" class="W450" rows="5" > </textarea><var></var></label>
            <span class="pm10 Pst"><a href="javascript:void(0);"  onClick="Fmedit('Sm2');checkNum(C.G('eonlinenum1').value,'edtPh');checkNum(C.G('eonlinenum2').value,'edtPh');" class="sumitBtn">确定</a><a href="javascript:void(0);" class="cancelBtn" onClick="Dialog.Close();location.reload();">取消</a><i id="editRST"></i></span>	
          </form>
	    </dd>
    </dl>
    <a href="####" class="closeBtn L" onClick="Dialog.Close();location.reload();"></a>
</div>

<div id="TMImgsUploadTmk" class="MsContent"><!--[if IE 6]><iframe class="WiF" src="####" scrolling="no" frameborder="0"></iframe><![endif]-->
	<?php $this->widget('application.widget.Upload');?>
</div>
<!--end window-->
<script charset="utf-8" src="http://hs.cnfol.com/f=Cm/Js/Base.js,Cm/Js/Dialog.js,Cm/Js/Tabs.js,Cm/Js/Checkbox.js,ua/js/Clouds/Tables.js,ua/js/Clouds/Calendar.js,Cm/Js/Menus.js,Cm/Js/Forms.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/selectCheck.js"></script>
<script charset="utf-8" type="text/javascript">
Checkbox("Fa1");
Menus("Cs1");
Tables("TabM","Ccl","Ocl");
Forms("Sm1","Sm2");
if(top.C.G("CM1")){
	setTimeout(function(){top.C.G("CM1").style.height="600px";top.C.Ehs("CM1","Ifr")},500);
}

function Compare(str) {
    var obj = C.G(str),
        ifr = top.C.G('Ifr'),
        objh = obj.offsetTop + obj.offsetHeight;

//    alert(obj.offsetTop + " : " +  obj.offsetHeight + " : " + ifr.offsetHeight);
        
    if(ifr.offsetHeight < objh){
        setTimeout(function(){
            ifr.style.height = objh + "px";
            Dialog.Mask && Dialog.Mask(str);
        },50);
    }
}

var BE = false;
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
function Search(){
	var url = "";
	if(C.G('keyword')){
		var url="&keyword="+C.G('keyword').value;
		if(C.G('hidCid')){
			url+="&cid="+C.G('hidCid').value;
			}
	}
	if(url){
		if(C.G('hidCid').value){
			location.href="<?php echo yii::app()->createUrl('Show/Showclasslist');?>"+encodeURI(url);
		}else{
			location.href="<?php echo yii::app()->createUrl('Show/Showlist');?>"+encodeURI(url);
			}
	}
}
//C.AddEvent(C.G('searchBtn'),"click",Search);

function getCheckboxIds(checkbox_name) 
{ 
	
	var vInput=document.getElementsByTagName("INPUT");
	var ids=new Array();
	for(var i=0;i<vInput.length;i++){ 
		var obj=vInput[i]; 
		if(vInput[i].checked==true) 
		{   
			ids.push(vInput[i].value);
		  
		} 
	}
	return ids;
	 
} 

function MakeSureDel(id){
	Dialog.Close();
	var Url="<?php echo yii::app()->createUrl('Show/Delshow');?>";
	var Data="&id="+id;
	C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
	function goBackVal(Bj){ 
		if(Bj.errorno=='000'){
			if(id.length>1){
				var aTr = C.Gs('TabM', 'input', true); 
				for (var i = 0, l = aTr.length; i < l; i++) {
					if (aTr[i].checked) {
						aTr[i].parentNode.parentNode.parentNode.removeChild(aTr[i].parentNode.parentNode);
					}
				}
			}else{
				var oId = id + '';//隐式转换参数类型
				var tr = C.G(oId);
				tr.parentNode.removeChild(tr);
				}
			C.G("totalP").innerHTML = parseInt(C.G("totalP").innerHTML)-1;
		}else{
			alert(Bj.msg);
		}
	}
}	
function DelRecord(rid){
	if(rid == 0){
		var ids = getCheckboxIds('box_id');
		if(ids.length==0){
			MsgAlter('TMconfirmTmk',"请选中要删除的记录");
		}else{
			Dialog('TMdelMsTipTmk');
			C.G('SureDel').onclick = function () {
				MakeSureDel(ids);
			};
			}
		}else if(rid != 0){
			Dialog('TMdelMsTipTmk');
			C.G('SureDel').onclick = function () {
				MakeSureDel(rid);
			};
		}
		
}

function Fmadd(Id)
{  
	var Fm=C.G(Id);
	Forms(Id);
//	Forms.Vf(Fm);/*前端表单验证*/
	Fmadd.prototype = {
            Gi:function()
            {
				var Str="";
				Str+="&Addtopic="+C.G('Addtopic').value;
//				Str+="&Atopicpic="+C.G('Atopicpic').value;

				var hdImg = C.G('AddhdImg').src;
				var arrs = hdImg.split("?");
					if( arrs[0] && arrs[1] ){/*判断是否上传图片，如果未上传。。*/
						Str+="&Atopicpic="+'';
					}else{
						Str+="&Atopicpic="+C.G('AddhdImg').src;/*上传则传入数据*/
					}
					
				Str+="&Astarttime="+C.G('Astarttime').value;
				Str+="&Aendtime="+C.G('Aendtime').value;


				var VST = C.G('Astarttime').value;
				var VET = C.G('Aendtime').value;
				var As = false;				
				var STime = new Date(Date.parse(VST.replace(/-/g, "/"))),
					ETime = new Date(Date.parse(VET.replace(/-/g, "/")));
				var StrST = VST.slice(0, 10);
				    StrET = VET.slice(0, 10);
				    if(VST && VET){
				    	if (StrST == StrET && STime.getTime() >= ETime.getTime()) {
				    		As = false;
							alert('结束时间必须晚于开始时间！');
						} else if(StrST > StrET){
							As = false;
							alert('结束时间必须晚于开始时间！');
							}else{
								As = true;
								}
				    }
				    
				if(C.G('Ashowip').checked == true){
				     Str+="&Ashowip=1";
				}else{
					Str+="&Ashowip=0";
					}
				Str+="&Adescurl="+C.G('Adescurl').value;
				if(C.G('Ashowdesc').checked == true){
				     Str+="&Ashowdesc=1";
				}else{
					Str+="&Ashowdesc=0";
					}
				Str+="&Ahistorydesc="+C.G('Ahistorydesc').value;
				if(C.G('Ashowhistory').checked == true){
				     Str+="&Ashowhistory=1";
				}else{
					Str+="&Ashowhistory=0";
					}						
				Str+="&Acorpdesc="+C.G('Acorpdesc').value;
				if(C.G('Ashowcorp').checked == true){
				     Str+="&Ashowcorp=1";
				}else{
					Str+="&Ashowcorp=0";
					}			
				Str+="&Aprocdesc="+C.G('Aprocdesc').value;
				if(C.G('Ashowproc').checked == true){
				     Str+="&Ashowproc=1";
				}else{
					Str+="&Ashowproc=0";
					}	
				if(C.G('Ahits').checked == true){
					   Str+="&Ahits=1";
					}else{
				       Str+="&Ahits=0";
					 }
				Str+="&Achannlename="+C.G('Achannlename').value;
				Str+="&Achannlelink="+C.G('Achannlelink').value;
				Str+="&Aonlinenum1="+C.G('Aonlinenum1').value;
				Str+="&Aonlinenum2="+C.G('Aonlinenum2').value;
				Str+="&Amemo="+C.G('Amemo').value;
				//添加分类名称，邀请的嘉宾
				Str+="&Aclassids="+getclassid('addclass');
				Str+="&Auserids="+getclassid('adduser');
				/*前端验证   下拉选择框*/
				var _var = true;
				var _r = false;
				var _m = true;
				if((getclassid('addclass')).length == 0){
					alert('请选择分类！');
					_m = true;
				}else{
					_m = false;
				}
				if((getclassid('adduser')).length == 0){
					alert('您邀请的嘉宾中必须要有一个嘉宾！');
					_r = true;
				}else{
					_r = false;
				}				
				 var str = "AddCompRt|Addtopic";
			 	 CheckIsExist('',str);
				if(Fm.V==true  && As == true && _r == false && BE == true && _m == false){
				
					var Url="<?php echo yii::app()->createUrl('Show/Addshow');?>";
					var Data=Str;
					if (C.G("Subtn").className.indexOf('disabled') == -1) { 
					    C.EXHR(function(Bj){Fmadd.prototype.Cb(Bj);},"POST", Url,Data);
					C.AddClass(C.G("Subtn"),"disabled");
					}
				}
            },
            Cb:function(Bj)
			{ 
            	C.DelClass(C.G("Subtn"),"disabled");
				Rt = C.G('addRST');
				switch (Bj.errorno)
				{
					case "1000":
						C.AddClass(Rt,"Tjok");
						Rst=Bj.error;
						Dialog.Close('TMaddPowerTmk');
//						location.reload();
						location.replace('<?php echo yii::app()->createUrl('Show/Showlist');?>');
					break;
					default:
						C.AddClass(Rt,"Tjno");
						Rst=Bj.error;
					break;
				} 
				Rt.innerHTML=Rst;
			}
    }
Fmadd.prototype.Gi(Id);
	}

function addOne(obj,myobj){
	var classid = C.G(obj).value;
	if(classid){
	    var classname = C.G(obj).options[C.G(obj).selectedIndex].innerHTML;	
	    var option=C.G(myobj);
		var opt = C.G(myobj).options;
		var sign = true;
		for(var i=0;i<opt.length;i++){
	      	if(opt[i].value == classid){
				sign = false;
	        }
		}
		if(sign == true){
			option.options.add(new Option(classname,classid));	
		}
	}else{
         alert('请选择要移动的');
		}
		
}
	function removeOne(id){
        var obj=document.getElementById(id);
       // index,要删除选项的序号，这里取当前选中选项的序号
        var index=obj.selectedIndex;
        obj.options.remove(index);
  }

	  function getclassid(id){
		  var ids=new Array();
		  var aOps = C.G(id).options;
		  var l= aOps.length;
		  for (var i = 0;i < l; i++){
			  ids.push(aOps[i].value);
		  }
		  return ids;
		  }


	  function EditShowMsg(Id){
			var Url="<?php echo yii::app()->createUrl('Show/Getshowmsg');?>";
			var Data="&Id="+Id;
			C.EXHR(function(Bj){ myValue(Bj);},"POST", Url, Data);
			function myValue(Bj)
			{
				if(Bj.errorno=='000'){
					var arrs = Bj.content.split("|");	
					C.G("aid").value= arrs[0];
					C.G("edittopic").value= arrs[1];
					C.G("hidValue").value= arrs[1];
					C.G("EdithdImg").src= arrs[2];
					C.G("estarttime").value= changeTimeFormat(parseInt(arrs[3])*1000);
					C.G("eendtime").value= changeTimeFormat(parseInt(arrs[4])*1000);
					if(arrs[5] == 1){
		            	C.G('eshowip').checked = true;
		                }
					C.G("edescurl").value= arrs[6];
					if(arrs[7] == 1){
		            	C.G('eshowdesc').checked = true;
		                }
					C.G("ehistorydesc").value= arrs[8];
					if(arrs[9] == 1){
		            	C.G('eshowhistory').checked = true;
		                }
					C.G("ecorpdesc").value= arrs[10];
					if(arrs[11] == 1){
		            	C.G('eshowcorp').checked = true;
		                }
					C.G("eprocdesc").value= arrs[12];
					if(arrs[13] == 1){
		            	C.G('eshowproc').checked = true;
		                }
	                if(arrs[19] == 1){
						C.G('Ehits').checked = true;
	                }
					C.G("echannlename").value= arrs[14];
					C.G("echannlelink").value= arrs[15];
					C.G("eonlinenum1").value= arrs[16];
					C.G("eonlinenum2").value= arrs[17];
					C.G("ememo").value= arrs[18];


					var editdtp = C.G("aclassname");
					editdtp.options.length = 0;
					var newOption=document.createElement("OPTION");
					for(var i=0;i<Bj.classlist.count;i++){
						editdtp.options.add(new Option(Bj.classlist[i].classname,Bj.classlist[i].id)); 
					}

					var editdtp = C.G("ausername");
					editdtp.options.length = 0;
					var newOption=document.createElement("OPTION");
					for(var i=0;i<Bj.userlist.count;i++){
						editdtp.options.add(new Option(Bj.userlist[i].username,Bj.userlist[i].id)); 
					}
				
				Dialog('TMmodifyPowerTmk');
				
				Compare("TMmodifyPowerTmk");
			}else{
				alert(Bj.content);
			}
		  }
			Dialog('TMmodifyPowerTmk');
		}

	  function Fmedit(Id){
			var Fm=C.G(Id);
			Forms(Id);
//			Forms.Vf(Fm);/*前端表单验证*/
			Fmedit.prototype = {
					Dt:function()
					{
						var Str="";
						Str+="&aid="+C.G('aid').value;
						Str+="&edittopic="+C.G('edittopic').value;

						var hdImg = C.G('EdithdImg').src;
						var arrs = hdImg.split("?");
							if( arrs[0] && arrs[1] ){/*判断是否上传图片，如果未上传。。*/
								Str+="&etopicpic="+'';
							}else{
								Str+="&etopicpic="+C.G('EdithdImg').src;/*上传则传入数据*/
							}
						Str+="&estarttime="+C.G('estarttime').value;
						Str+="&eendtime="+C.G('eendtime').value;
						
						if(C.G('eshowip').checked == true){
						     Str+="&eshowip=1";
						}else{
							Str+="&eshowip=0";
							}
						Str+="&edescurl="+C.G('edescurl').value;
						if(C.G('eshowdesc').checked == true){
						     Str+="&eshowdesc=1";
						}else{
							Str+="&eshowdesc=0";
							}
						Str+="&ehistorydesc="+C.G('ehistorydesc').value;
						if(C.G('eshowhistory').checked == true){
						     Str+="&eshowhistory=1";
						}else{
							Str+="&eshowhistory=0";
							}						
						Str+="&ecorpdesc="+C.G('ecorpdesc').value;
						if(C.G('eshowcorp').checked == true){
						     Str+="&eshowcorp=1";
						}else{
							Str+="&eshowcorp=0";
							}			
						Str+="&eprocdesc="+C.G('eprocdesc').value;
						if(C.G('eshowproc').checked == true){
						     Str+="&eshowproc=1";
						}else{
							Str+="&eshowproc=0";
							}	
						if(C.G('Ehits').checked == true){
							   Str+="&ehits=1";
							}else{
						       Str+="&ehits=0";
							 }
						Str+="&echannlename="+C.G('echannlename').value;
						Str+="&echannlelink="+C.G('echannlelink').value;
						Str+="&eonlinenum1="+C.G('eonlinenum1').value;
						Str+="&eonlinenum2="+C.G('eonlinenum2').value;
						Str+="&ememo="+C.G('ememo').value;
						//添加分类名称，邀请的嘉宾
						Str+="&eclassids="+getclassid('aclassname');
						Str+="&euserids="+getclassid('ausername');
						return Str;
					},
		            Gi:function()
		            {
						var _var = true;
						var _r = false;
						var _m = true;
						if((getclassid('aclassname')).length == 0){
							alert('请选择分类！');
							_m = true;
						}else{
							_m = false;
						}
						if((getclassid('ausername')).length == 0){
							alert('您邀请的嘉宾中必须要有一个嘉宾！');
							 _r = true;
							}else{
							 _r = false;
							}

						var VST = C.G('estarttime').value;
						var VET = C.G('eendtime').value;
						var Es = false;				
						var STime = new Date(Date.parse(VST.replace(/-/g, "/"))),
							ETime = new Date(Date.parse(VET.replace(/-/g, "/")));
						var StrST = VST.slice(0, 10);
						    StrET = VET.slice(0, 10);
						    if(VST && VET){
						    	if (StrST == StrET && STime.getTime() >= ETime.getTime()) {
						    		Es = false;
									alert('结束时间必须晚于开始时间！');
								} else if(StrST > StrET){
									Es = false;
									alert('结束时间必须晚于开始时间！');
									}else{
										Es = true;
										}
						    }
						if(C.G("hidValue").value == C.G("edittopic").value){//如果两值相等即没有修改
							BE = true;
							C.G("EdtCompRt").className = 'Ok';
							C.G("EdtCompRt").innerHTML = "";
						}
						if( BE == false){//再次验证
							var str = "EdtCompRt|edittopic";
						 	CheckIsExist('',str);
						}
						if(Fm.V==true && Es == true && _r == false && BE == true && _m == false){
							var Url="<?php echo yii::app()->createUrl('Show/Saveshow');?>";
							var Data=Fmedit.prototype.Dt();
							C.EXHR(function(Bj){Fmedit.prototype.Cb(Bj);},"POST", Url,Data);
							}
	
		            },
		            Cb:function(Bj)
					{ 
		            	try{
		            		Rt = C.G('editRST');
						}catch(e){}
		            	if(Bj.errorno=="1000"){
		            		C.AddClass(Rt,"Tjok");
		    				Rst=Bj.error;
		    				Dialog.Close('TMmodifyPowerTmk');
							location.reload();
		        			}else{
		        				C.AddClass(Rt,"Tjno");
		        				Rst=Bj.error;
		            			}
						   Rt.innerHTML=Rst;
					}
		    }
		Fmedit.prototype.Gi(Id);
		}
	  
	  function changeTimeFormat(time) {
		    var date = new Date(time);
		    var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1;
		    var currentDate = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
		    var hh = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
		    var mm = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
		    return date.getFullYear() + "-" + month + "-" + currentDate+" "+hh + ":" + mm;
		    //返回格式：yyyy-MM-dd hh:mm
		}

	  /*author by yuexl
	   * date:2012.07.12;
	   * description:判断所填路演是否已经存在;
	   */
	   function CheckIsExist(e,rtID){
			 var val = rtID.split("|");//拆分字符串
			  var Rt = C.G(val[0]);
			  if(C.G(val[1]).value==''){//内容为空
				  C.AddClass(Rt,"No");	
				  Rt.innerHTML = "该项不能为空";
				   BE = false;
			  }else{
			 	 var Url="<?php echo yii::app()->createUrl('show/checkisexist');?>";
			 	 var Data = "&Name="+C.G(val[1]).value;
			 		 C.EXHR(function(Bj){ goBackVal(Bj);},"POST", Url, Data);  
			 			function goBackVal(Bj){
			 				if(Bj.errorno=='000'){
				 				 BE = true;
				 				C.DelClass(Rt,"No");
			 					C.AddClass(Rt,"Ok");
			 					Rt.innerHTML = '';			 					
			 				}else{
			 					 BE = false;
			 					C.DelClass(Rt,"Ok");
			 					C.AddClass(Rt,"No");
			 					Rt.innerHTML = Bj.msg;
			 				}
			 			}
			 	}
		}
	   C.AddEvent(C.G('Addtopic'),"blur",CheckIsExist,'AddCompRt|Addtopic');//给添加公司名称文本框添加onblur事件;
	   C.AddEvent(C.G('edittopic'),"change",CheckIsExist,'EdtCompRt|edittopic');//给添加公司名称文本框添加onchange事件;
</script>
</body>
</html>
